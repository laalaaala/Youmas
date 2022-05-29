<?php

namespace App\Http\Controllers;

use App\Mail\BookingCreatedMailable;
use App\Mail\BusinessBookingCancelledMailable;
use App\Mail\CustomerBookingCancelledMailable;
use App\Models\Employee;
use App\Models\Bookings;
use App\Models\EmployeeWorkingHours;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmployeeAvailableHoursController extends Controller
{
    public function index(Request $request, $id)
    {
        $data = $request->all();
        $employee = Employee::find($id);
        $date = Carbon::parse($data['date'])->toDateString();
        $service_duration = intval($data['duration']);

        /**
         * Take difference
         */

        // Employee working hours
        $employee_working_hours = $employee->workingHours()->whereDate('start', 'LIKE', $date . '%')->first();

        // Employee booked hours (unavailable)
        $employee_booked_hours = $employee->bookings()->whereDate('start', 'LIKE', $date . '%')->get();


        // Set limit of working hours to employee_booking_hours(end time) minus service duration minutes
        if ($employee_working_hours) {
            $employee_working_hours['end'] = Carbon::parse($employee_working_hours['end'])->subMinutes($service_duration)->toDateTimeString();
        } else {
            return response()->json([
                'data' => [],
                'status' => true
            ]);
        }

        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $employee_working_hours->start);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $employee_working_hours->end);


        // prepare an array with formatted by 15m to iterate
        $formatted_employee_hours = [];
        for ($i = $to; $i <= $from; $to->addMinutes(15)) {
            array_push($formatted_employee_hours, $i->toDateTimeString());
        };

        // If bookings exists subtract those hours from available
        if (count($employee_booked_hours)) {
            foreach ($employee_booked_hours as $booked) {
                $booked_start_time_index = array_search($booked->start, $formatted_employee_hours);
                $booked_end_time_index = array_search($booked->end, $formatted_employee_hours);
                array_splice($formatted_employee_hours, $booked_start_time_index, $booked_end_time_index - $booked_start_time_index);
            }
        };

        return response()->json([
            'data' => $formatted_employee_hours,
            'status' => true
        ], 200);
    }

    public function store(Request $request, $id)
    {
        $data = $request->all();
        $employee = Employee::find($id);
        $customer = Auth::user();
        $end = Carbon::parse($data['booking']['time'])->addMinutes($data['booking']['total_duration'])->toDateTimeString();
        $business = $employee->business;
        try {
            $booking =  $employee->bookings()->create([
                'service_id' => $data['booking']['services'][0]['id'],
                'start' => $data['booking']['time'],
                'end' => $end,
                'title' => 'Service booking',
                'customer_id' => $customer->id,
                'total_price' => $data['booking']['total_price'],
                'total_duration' => $data['booking']['total_duration'],
                'transaction_id' => array_key_exists('transactionId', $data) ? $data['transactionId'] : null // cambiar a null
            ]);

            $service = Service::find($data['booking']['services'][0]['id'])->name;

            $mail_data = [
                'service_name' => $service,
                'employee' => $employee->first_name . " " . $employee->last_name,
                'booking_start' => $data['booking']['time'],
                'booking_end' => $end,
                'booking_created_date' => Carbon::parse($booking->created_at)->toDateTimeString(),
                'customer_name' => $customer->customer->first_name . " " . $customer->customer->last_name,
                'customer_salutation' => $customer->customer->salutation,
                'customer_EMAIL' => $customer->email,
                'customer_first_name' => $customer->customer->first_name,
                'customer_last_name' => $customer->customer->last_name,
                'customer_email' => $customer->email,
                'customer_mobile_phone' => $customer->phone,
                'customer_zip_code' => $customer->location->zip_code,
                'customer_city' => $customer->location->city,
                'business_email' => $business->user->email,
                'business_phone' => $business->user->phone,
                'business_name' => $business->name,
                'business_location' => $business->user->location,
                'total_price' => $booking->total_price
            ];

            Mail::send(new BookingCreatedMailable($mail_data));

            return response()->json([
                'message' => 'Booking created successfully',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            dd($error->getMessage());
            return response()->json([
                'message' => 'There has been an error while booking',
                'status' => false
            ], 400);
        }
    }

    public function bookedHours()
    {
        $user = Auth::user();
        $business = $user->business;

        $employees_ids = $business->employees()->pluck('id')->toArray();

        // dd($employees_ids);
        $employee_booked_hours = Bookings::whereIn('employee_id', $employees_ids)->where('status', '!=', 'cancelled')->where('status', '!=', 'refunded')->get();

        return response()->json([
            'data' => $employee_booked_hours,
            'status' => true
        ], 200);
    }


    public function bookedHoursShow($id)
    {
        $employee = Employee::find($id);

        $employee_booked_hours = Bookings::where('employee_id', $employee->id)->where('status', '!=', 'cancelled')->where('status', '!=', 'refunded')->get();

        return response()->json([
            'data' => $employee_booked_hours,
            'status' => true
        ], 200);
    }

    public function bookedHoursDelete(Request $request, $id)
    {
        $employee = Employee::find($id);

        $hours = $employee->bookings->where('id', $request->bookingHoursId)->first();
        $hours->status = 'cancelled';
        $hours->save();

        $customer = User::find($hours->customer_id);
        $business = $employee->business;

        if ($hours->customer_id) {

            $mail_data = [
                'employee' => $employee,
                'business_name' => $business->name,
                'booking_number' => $hours->id,
                'business_email' => $business->user->email,
                'customer_name' => $customer->customer->first_name . " " . $customer->customer->last_name,
                'customer_email' => $customer->email,
                'booking_start' => $hours->start,
                'total_price' => $hours->total_price,
                'service_name' => $hours->service->name,
            ];

            // Mail::send(new BusinessBookingCancelledMailable($mail_data));
            Mail::send(new CustomerBookingCancelledMailable($mail_data));
        }

        return response()->json([
            'data' => $employee->bookingHours,
            'status' => true
        ], 200);
    }

    public function destroy(Request $request, $id)
    {
        $data = $request->all();

        $working_hours = EmployeeWorkingHours::find($data['workingHoursId']);

        $employee = Employee::find($working_hours->employee_id);

        $bookings = $employee->bookings()->whereBetween('start', [$working_hours->start, $working_hours->end])->where('status', 'pending')->get();

        foreach ($bookings as $booking) {
            if ($booking->transaction_id) {
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

                $transaction = Transaction::find($booking->transaction_id);
                $refund_amount = round((($transaction->amount * 0.971) - 0.3), 2) * 100;
                $regex = "_secret_";
                $transaction_id = $transaction->transaction_id;
                $parts = explode($regex, $transaction_id);
                $payment_intent = $parts[0];

                try {
                    if ($transaction->status == 'pending') {
                        \Stripe\Refund::create([
                            'amount' => $refund_amount,
                            'payment_intent' => $payment_intent,
                        ]);

                        $transaction->status = 'refunded';
                        $transaction->save();
                    }
                } catch (Exception $error) {
                    dd($error->getMessage());
                }

            }
            $booking->status = 'cancelled';
            $booking->save();
        }

        $working_hours->delete();
    }
}
