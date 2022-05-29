<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        /**
         * Redirect to proper dashboard
         */


        if ($user->type == 'business' && !$user->subscription || $user->type == 'business' && $user->subscription->status == 'inactive') {
            $subscription = $user->subscription;
            $user = User::where('id', $user->id)->with('subscription')
                ->with('location')
                ->with('business')
                ->with('stripeAccount')
                ->first();

            return view('business.subscriptions.index', compact('user', 'subscription'));
        } elseif ($user->type == 'business' && $user->subscription) {
            $user = User::where('id', $user->id)
                ->with('location')
                ->with('business')
                ->with('stripeAccount')
                ->first();

            return view('business.dashboard', compact('user'));
        } elseif ($user->type == 'customer') {
            $user = User::where('id', $user->id)
                ->with('location')
                ->with('customer')
                ->first();

            return view('customer.dashboard', compact('user'));
        } elseif ($user->type == 'admin') {
            $user = Auth::user();
            return view('admin.dashboard', compact('user'));
        }
    }

    public function planningCalendar()
    {

        $user = Auth::user();
        $employees = $user->business->employees;

        return view('dashboard.planning-calendar', compact('user', 'employees'));
    }
}
