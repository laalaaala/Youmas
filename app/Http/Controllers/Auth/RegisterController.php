<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\UserRegisteredMailable;
use App\Models\Business;
use App\Models\Company;
use App\Models\Customer;
use App\Models\Family;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Error;
use Exception;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    // use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function company()
    {
        return view('auth.company.register');
    }

    public function customer()
    {
        return view('auth.customer.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:users',
            'phone' => 'unique:users'
        ]);
        $noValidationData = $request->toArray();
        // dd($noValidationData['type']);
        /**
         *  Create main user 
         * 
         **/

        try {
            $user = User::create([
                'email' => $data['email'],
                'password' => bcrypt($noValidationData['password']),
                'phone' => $noValidationData['phone'],
                'type' => $noValidationData['type'],
            ]);

            if ($noValidationData['type'] == 'business') {

                
                $user->location()->create([
                    'street' => $noValidationData['location']['street'],
                    'street_number' => $noValidationData['location']['street_number'],
                    'lat' => $noValidationData['location']['lat'],
                    'lng' => $noValidationData['location']['lng'],
                    'zip_code' => $noValidationData['location']['zip_code'],
                    'city' => $noValidationData['location']['city'],
                    'formatted_address' => $noValidationData['location']['formatted_address'],
                ]);
                
                $verification_token = Uuid::uuid4()->toString();
                
                $user->verification_token = $verification_token;
                $user->save();
                
                /**
                 *  Register company
                 */
                $this->businessRegister($user, $request);
                
                // dd('business');
                
                $mail_data = [
                    'user_email' => $user->email,
                    'name' => $user->business->name,
                    'verification_token' => $verification_token
                ];
                Mail::send(new UserRegisteredMailable($mail_data));
            } else {
                /**
                 * Register customer
                 */

                $user->location()->create([
                    'street' => $noValidationData['location']['street'],
                    'street_number' => $noValidationData['location']['street_number'],
                    'zip_code' => $noValidationData['location']['zip_code'],
                    'city' => $noValidationData['location']['city'],
                    'formatted_address' => $noValidationData['location']['formatted_address'],
                ]);
                $this->customerRegister($user, $request);

                $verification_token = Uuid::uuid4()->toString();

                $user->verification_token = $verification_token;
                $user->save();


                $mail_data = [
                    'user_email' => $user->email,
                    'name' => $user->customer->first_name . ' ' . $user->customer->last_name,
                    'verification_token' => $verification_token
                ];
                Mail::send(new UserRegisteredMailable($mail_data));
            }
            return redirect('/login?verify=1');

            // if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            //     return redirect('/dashboard');
            // }
        } catch (Exception $error) {
            dd($error->getMessage());
            return response()->json([
                'message' => 'There has been an error creating the user.',
                'status' => false,
            ], 422);
        }
    }

    public function businessRegister($user, $request)
    {
        $business = [
            'name' => $request['name'],
            'branch_id' => $request['branch'],
            'person_to_contact' => $request['person_to_contact'],
            'ust_id' => $request['ust_id'],
        ];

        $days = [
            'montag',
            'dienstag',
            'mittwoch',
            'donnerstag',
            'freitag',
            'samstag',
        ];
        try {
            $business = $user->business()->create($business);

            foreach ($days as $day) {
                $business->openingHours()->create([
                    'day' => $day,
                    'start' => '08:00',
                    'end' => '18:00',
                ]);
            }

            return true;
        } catch (Exception $error) {
            dd($error->getMessage());
            return response()->json([
                'message' => $error->getMessage(),
                'status' => false,
            ], 400);
        }
    }

    public function customerRegister($user, $request)
    {
        $customer = [
            'salutation' => $request['salutation'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'date_of_birth' => $request['date_of_birth'],
            'user_id' => $user->id,
        ];

        try {
            $user->customer()->create($customer);

            return true;
        } catch (Exception $error) {
            dd($error->getMessage());
            return response()->json([
                'message' => $error->getMessage(),
                'status' => false,
            ], 400);
        }
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
