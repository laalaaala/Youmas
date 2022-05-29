<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeWorkingHours;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeWorkingHoursController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $business = $user->business;

        $employees_ids = $business->employees()->pluck('id')->toArray();



        $employees_working_hours = EmployeeWorkingHours::whereIn('employee_id', $employees_ids)->get();

        return response()->json([
            'data' => $employees_working_hours,
            'status' => true
        ], 200);
    }

    public function store($id, Request $request)
    {
        $employee = Employee::find($id);

        try {
            $employee->workingHours()->create([
                'start' => Carbon::parse($request->startDateTime),
                'end' => Carbon::parse($request->endDateTime),
                'title' => 'Working hours',
                'employee_name' => $employee->first_name . ', ' . $employee->last_name,
                'class' => 'event-1',
            ]);

            return response()->json([
                'message' => 'Working hours successfully added',
                'data' => $employee->workingHours,
                'status' => true
            ], 200);
        } catch (Exception $error) {
            dd($error->getMessage());
        }
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        $employee_hours = $employee->workingHours;

        return response()->json([
            'data' => $employee_hours,
            'status' => true
        ], 200);
    }

    public function destroy($id, Request $request)
    {

        $employee = Employee::find($id);
        $employee->workingHours()->where('id', $request->workingHoursId)->delete();


        return response()->json([
            'data' => $employee->workingHours,
            'status' => true
        ], 200);
    }

    public function massDelete($id, Request $request) {
        try {
            $employee = Employee::find($id);
            $data = $request->all();
            $working_hours_to_delete = EmployeeWorkingHours::where('start', '>=', Carbon::parse($data['start']))->where('end', '<', Carbon::parse($data['end'])->addDay())->delete();
            return response()->json(["message" => "Zeiten wurden erfolgreich entfernt", "status" => false], 200);
        } catch (\Exception $error) {
            return response()->json(["message" => $error->getMessage()], 422);
        }
    }
}
