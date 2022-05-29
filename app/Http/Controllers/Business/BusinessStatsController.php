<?php

namespace App\Http\Controllers\Business;

use App\Models\Bookings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class BusinessStatsController extends Controller
{
    public function index()
    {
        return view('business.statistics.index');
    }

    public function all(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $business = $user->business;

        $statistics = [
            [
                'name' => 'bookings',
                'data' => []
            ],
            [
                'name' => 'revenue',
                'data' => []
            ],
            [
                'name' => 'cancellations',
                'data' => []
            ],
        ];

        $employees_ids = $business->employees()->pluck('id')->toArray();

        if ($data['period'] == 'month') {
            // Last month data
            while (Carbon::parse($data['today']) >= Carbon::parse($data['first_day'])) {

                // Get bookings per current day
                $total_bookings = Bookings::whereIn('employee_id', $employees_ids)
                    ->whereDate('created_at', Carbon::parse($data['first_day']))
                    ->get()
                    ->count();

                array_push($statistics[0]['data'], $total_bookings);

                // Get businesses per current day
                $total_revenue = $user->businessTransactions()->where('status', 'completed')->whereDate('created_at', Carbon::parse($data['first_day']))->get()->sum('business_revenue');
                array_push($statistics[1]['data'], $total_revenue);

                // Get cancellations per current day 
                $total_cancellations = Bookings::where('status', 'cancelled')->whereDate('created_at', Carbon::parse($data['first_day']))->get()->count();
                array_push($statistics[2]['data'], $total_cancellations);
                
                $data['first_day'] = Carbon::parse($data['first_day'])->addDays(1);
            }
        } else {
            // Last year data
            
            while (Carbon::parse($data['today']) >= Carbon::parse($data['first_day'])) {
                
                // Get bookings per current day
                $total_bookings = Bookings::whereMonth('created_at', Carbon::parse($data['first_day']))->whereYear('created_at', Carbon::parse($data['first_day']))->count();
                array_push($statistics[0]['data'], $total_bookings);
                
                // Get businesses per current day
                $total_revenue = $user->businessTransactions()->where('status', 'completed')->whereMonth('created_at', Carbon::parse($data['first_day']))->whereYear('created_at', Carbon::parse($data['first_day']))->get()->sum('business_revenue');
                array_push($statistics[1]['data'], $total_revenue);
                
                // Get cancellations per current day 
                $total_cancellations = Bookings::where('status', 'cancelled')->whereMonth('created_at', Carbon::parse($data['first_day']))->whereYear('created_at', Carbon::parse($data['first_day']))->count();
                array_push($statistics[2]['data'], $total_cancellations);

                // Add day to current day
                $data['first_day'] = Carbon::parse($data['first_day'])->addMonths(1);
            }
        }




        return response()->json([
            'data' => $statistics,
            'status' => true
        ], 200);
    }
}
