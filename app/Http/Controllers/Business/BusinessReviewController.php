<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\BusinessReview;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessReviewController extends Controller
{
    public function create($id, Request $request)
    {
        $data = $request->all();
        if (!array_key_exists('token', $data)) {
            abort(403);
        }

        $user = User::find($id);

        $review = BusinessReview::where('token', $data['token'])->first();

        if (!$review || !$user) {
            abort(403);
        }

        if ($review->status == 'completed') {
            return redirect('/dashboard');
        }

        $business = $user->business()->with('user')->first();
        return view('business.reviews.create', compact('business', 'review'));
    }

    public function store($id, Request $request)
    {
        $data = $request->all();

        if (!array_key_exists('token', $data)) {
            abort(403);
        }

        // $user = Auth::user();
        $business = User::find($id);
        $average = ($data['ambient'] + $data['service'] + $data['cleanliness']) / 3;

        try {

            $review = BusinessReview::where('token', $data['token'])->first();

            if ($review->status == 'completed') {
                abort(403);
            }

            $review->ambient = $data['ambient'];
            $review->service = $data['service'];
            $review->cleanliness = $data['cleanliness'];
            $review->comment = $data['comment'];
            $review->average = $average;
            $review->status = 'completed';
            $review->save();

            return response()->json([
                'message' => 'Review sent successfully',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            dd($error->getMessage());
            return response()->json([
                'message' => 'There has been an error',
                'status' => false
            ], 422);
        }
    }

    public function filter(Request $request)
    {
        $data = $request->all();

        $stars = array_key_exists('stars', $data) ? $data['stars'] : null;
        $service = array_key_exists('service', $data) ? $data['service'] : null;

        $reviews = BusinessReview::when($stars, function ($query) use ($stars) {
            $query->where('average', '>', $stars);
        })
            ->when($service, function ($query) use ($service) {
                $query->where('service_id', $service);
            })
            ->with('customer')
            ->with('service')
            ->get();

        return response()->json([
            'data' => $reviews,
            'status' => true
        ], 200);
    }
}
