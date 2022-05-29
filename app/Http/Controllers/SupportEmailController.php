<?php

namespace App\Http\Controllers;

use App\Mail\SupportMailable;
use App\Mail\UserSupportMailable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SupportEmailController extends Controller
{

    public function index()
    {
        return view('dashboard.support');
    }

    public function sendEmail(Request $request)
    {
        $user = Auth::user();


        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'message' => 'required'
        ]);

        if ($user->type == 'business') {
            $data['subject'] = 'Business';
        } else if ($user->type = 'customer') {
            $data['subject'] = 'Customer';
        }

        try {
            Mail::send(new SupportMailable($data));
            Mail::send(new UserSupportMailable($data));
            Session::flash('success', 'Message sent successfully, we will contact you soon!');
            return redirect()->back();
        } catch (Exception $error) {
            Session::flash('error', 'We had an error sending your message.');
            return redirect()->back();
        }
    }
}