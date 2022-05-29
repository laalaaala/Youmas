<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminStatsController extends Controller
{
    public function index()
    {

        return view('admin.stats');
    }

    public function user(Request $request)
    {
        $data = $request->all();
        $users = [
            [
                'name' => 'Customers',
                'data' => []
            ],
            [
                'name' => 'Businesses',
                'data' => []
            ],
        ];

        if ($data['period'] == 'month') {
            // Last month data
            while (Carbon::parse($data['today']) >= Carbon::parse($data['first_day'])) {

                // Get customers per current day
                $customers_count = User::whereDate('created_at', Carbon::parse($data['first_day']))->where('type', 'customer')->get()->count();
                array_push($users[0]['data'], $customers_count);

                // Get businesses per current day
                $businesses_count = User::whereDate('created_at', Carbon::parse($data['first_day']))->where('type', 'business')->get()->count();
                array_push($users[1]['data'], $businesses_count);

                // Add day to current day
                $data['first_day'] = Carbon::parse($data['first_day'])->addDays(1);
            }
        } else {
            // Last year data

            while (Carbon::parse($data['today']) >= Carbon::parse($data['first_day'])) {

                // Get customers per current day
                $customers_count = User::whereMonth('created_at', Carbon::parse($data['first_day']))->whereYear('created_at', Carbon::parse($data['first_day']))->where('type', 'customer')->count();
                array_push($users[0]['data'], $customers_count);
                
                // Get businesses per current day
                $businesses_count = User::whereMonth('created_at', Carbon::parse($data['first_day']))->whereYear('created_at', Carbon::parse($data['first_day']))->where('type', 'business')->count();
                array_push($users[1]['data'], $businesses_count);

                // Add day to current day
                $data['first_day'] = Carbon::parse($data['first_day'])->addMonths(1);
            }
        }

        return response()->json([
            'data' => $users,
            'status' => true
        ], 200);
    }

    public function revenue(Request $request)
    {
        $data = $request->all();


        $revenue = [
            'name' => 'Total Revenue',
            'data' => []
        ];
        $total_revenue = 0;

        if ($data['period'] == 'month') {
            // Get revenue from last month
            while (Carbon::parse($data['today']) >= Carbon::parse($data['first_day'])) {
                $transactions = Transaction::whereDate('created_at', Carbon::parse($data['first_day']))->get();

                foreach($transactions as $transaction){
                    $total_revenue = $total_revenue + $transaction->youmas_revenue;
                }
                array_push($revenue['data'], $total_revenue);

                
                // Add day to current day
                $data['first_day'] = Carbon::parse($data['first_day'])->addDays(1);
            }
        } else {
            while (Carbon::parse($data['today']) >= Carbon::parse($data['first_day'])) {
                $transactions = Transaction::whereMonth('created_at', Carbon::parse($data['first_day']))->whereYear('created_at', Carbon::parse($data['first_day']))->get();

                foreach($transactions as $transaction){
                    $total_revenue = $total_revenue + $transaction->youmas_revenue;
                }
                array_push($revenue['data'], $total_revenue);
                
                
                // Add month to current month
                $data['first_day'] = Carbon::parse($data['first_day'])->addMonths(1);
            }
        }

        return response()->json([
            'data' => $revenue,
            'status' => true
        ], 200);
    }
}
