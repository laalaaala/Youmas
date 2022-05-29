<?php

namespace App\Http\Controllers\Business;

use App\Models\Business;
use App\Models\Employee;
use App\Models\User;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BusinessEmployeeController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $business = $user->business;

        return view('dashboard.employees', compact('user', 'business'));
    }

    public function show($id)
    {
        $employee = Employee::find($id);

        return response()->json([
            'data' => $employee,
            'status' => true
        ], 200);
    }

    public function filter()
    {
        $user = Auth::user();

        $employees = $user->business->employees;

        return response()->json([
            'data' => $employees,
            'status' => true
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $employee = Employee::create([
            'first_name' => $data['first_name'],
            'profile_picture' => '',
            'last_name' => $data['last_name'],
            'genre' => $data['genre'],
            'business_id' => $data['business_id']
        ]);
        $employee->services()->sync(json_decode($data['services']));

        if (array_key_exists('image', $data) && $data['image']) {

            $imageName = $employee->id . '_' . time() . '.' . $data['image']->getClientOriginalExtension();
            $imageLink = '/files/employee/profile/' . $employee->id . '/' . $imageName;
            $request->image->move(public_path() . '/files/employee/profile/' . $employee->id, $imageName);

            $employee->update(['profile_picture' => $imageLink]);
        }

        $employee->save();

        $employees = $user->business->employees;

        return response()->json([
            'message' => 'Employee Created Successfully',
            'data' => $employees,
            'status' => true
        ], 200);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $user = Auth::user();
        try {

            $employee->delete();

            $employees = $user->business->employees;

            return response()->json([
                'data' => $employees,
                'message' => 'Employee Deleted successfully',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'There has been an error deleting the employee',
                'status' => true
            ]);
        }
    }
    public function deleteImage($id)
    {
        $employee = Employee::find($id);
        $user = Auth::user();
        try {
            $employee->update(
                [
                    'profile_picture' => ''
                ]
            );
            $employee->save();

            $employees = $user->business->employees;

            return response()->json([
                'data' => $employees,
                'message' => 'Employee Image deleted successfully',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'There has been an error deleting the employee image',
                'status' => true
            ], 422);
        }
    }
    public function update(Request $request)
    {
        $data = $request->all();
        $employee = Employee::find($data['id']);
        $user = Auth::user();

        try {

            $employee->update([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'genre' => $data['genre'],
            ]);
            $employee->save();

            $employee->services()->sync($data['services']);

            $employees = $user->business->employees;

            return response()->json([
                'data' => $employees,
                'message' => 'Employee updated successfully',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'There has been an error updating the employee',
                'status' => true
            ]);
        }
    }

    public function updateProfilePicture($id, Request $request)
    {
        $employee = Employee::find($id);
        try {

            $imageName = $employee->id . '_' . time() . '.' . $request->image->getClientOriginalExtension();
            $imageLink = '/files/employee/profile/' . $employee->id . '/' . $imageName;
            $request->image->move(public_path() . '/files/employee/profile/' . $employee->id, $imageName);

            $employee->update(['profile_picture' => $imageLink]);
            $employee->save();

            return response()->json([
                'message' => 'Employee profile image updated successfully',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'There has been an error updating the employee profile image',
                'status' => true
            ]);
        }
    }
}
