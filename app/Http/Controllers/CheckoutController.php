<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function show($id)
    {
        $business = Business::where('id', $id)->with('employees')->first();
        $businessUser = $business->user()->with('stripeAccount')->with('subscription')->first();
        $user = Auth::user();
        $customer = User::where('id', $user->id)->with('customer')->first();
        return view('checkout', compact('business', 'businessUser', 'customer'));
    }
}
