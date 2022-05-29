<?php

namespace App\Http\Controllers\Business;

use App\Models\Bookings;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BusinessBookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employees = $user->business->employees;

        return view('dashboard.booking-calendar', compact('employees', 'user'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        try {
            Bookings::create([
                'start' => Carbon::parse($data['start_date']),
                'end' => Carbon::parse($data['end_date']),
                'title' => 'Service Booking',
                'employee_id' => $data['employee'],
                'service_id' => $data['service'],
                'total_price' => 0,
                'total_duration' => $data['service_duration'],
            ]);

            return response()->json([
                'message' => 'Booking created successfully',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => $error->getMessage(),
                'status' => false
            ], 422);
        }
    }
}
