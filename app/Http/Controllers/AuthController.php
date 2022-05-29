<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function register(Request $request)
    {

        $data = $request->all(['name', 'email', 'password']);
        $password = $data['password'];
        $data['password'] = bcrypt($data['password']);


        try {
            $user = User::create($data);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return response()->json([
                    'result' => false,
                    'message' => 'Ya existe una cuenta con el correo especificado',
                ], 422);
            }
        }

        if (Auth::attempt(['email' => $data['email'], 'password' => $password])) {
            return response()->json('Has iniciado sesión', 200);
        } else {
            return response()->json('NO has iniciado sesión', 422);
        }
    }
}
