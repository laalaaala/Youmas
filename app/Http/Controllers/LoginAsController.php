<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;

class LoginAsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    public function loginAsUser($id)
    {
        // Log out current user        
        $log_in_token = Uuid::uuid4()->toString();
        $previous_url = url()->previous();

        Auth::user()->logged_in_token = $log_in_token;
        Auth::user()->save();

        $user = User::find($id);
        $user->login_as = $log_in_token;
        $user->save();

        Cookie::queue('logged_in_token', $log_in_token, 120);
        Cookie::queue('previous_url', $previous_url, 120);

        Auth::logout();

        // Login as User


        Auth::login($user);
        return redirect('/dashboard');
    }

    public function endSession()
    {
        // Delete previous token
        $user = $this->user;
        $user->login_as = null;
        $user->save();

        $logged_in_token = Cookie::get('logged_in_token');
        $previous_url = Cookie::get('previous_url') ? Cookie::get('previous_url') : '/';
        $previous_user = User::where('logged_in_token', $logged_in_token)->first();

        if (!$logged_in_token) {
            Auth::logout();
            return redirect('/');
        }

        // Logging in previous
        Auth::login($previous_user);
        return redirect($previous_url);
    }
}
