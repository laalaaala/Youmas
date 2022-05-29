<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    public function index(Request $request)
    {
        return view('business.index');
    }

    public function filter(Request $request)
    {
        $data = $request->all();
        $radius = array_key_exists('radius', $data) ? $data['radius'] : '';
        $coordinates = array_key_exists('lat', $data) ? [
            'latitude' => $data['lat'],
            'longitude' => $data['lng'],
        ] : '';

        $branch = array_key_exists('branch', $data) && $data['branch'] != 'any' ? $data['branch'] : false;
        /**
         * Get businesses within a specific radio
         */

        $businesses = Business::when($branch, function ($q) use ($branch) {
            return $q->where('branch_id', $branch);
        })
            ->whereHas('user', function ($q) use ($radius, $coordinates) {
                if ($coordinates) {
                    $q->whereHas('location', function ($q) use ($radius, $coordinates) {
                        $q->isWithinMaxDistance($coordinates, $radius);
                    });
                }
            })
            ->whereHas('user', function ($q) {
                $q->whereHas('subscription', function ($q) {
                    $q->where('status', 'active')->orWhere('status', 'trial');
                });
            })
            ->with('user')
            ->with('branch')
            ->with('pictures')
            ->get();

        return response()->json([
            'data' => $businesses,
            'status' => true
        ]);
    }


    public function show($id)
    {
        $user = Auth::user();
        if(!$user) {
            $business = Business::where('id', $id)
            ->with('services')
            ->with('user')
            ->with('branch')
            ->with('pictures')->with('openingHours')->first();
            
            $business_service_categories = ServiceCategory::where('branch_id', $business->branch_id)->with('subCategories')->get();
            
            return view('business.show', compact('business', 'business_service_categories'));
        } else {
            $business = Business::where('id', $id)
            ->with('services')
            ->with('user')
            ->with('branch')
            ->with('pictures')->with('openingHours')->first();
            
            $favorites = $business->favorites()->get()->toArray();
            $is_favorite = false;
            if($favorites){
                foreach($favorites as $favorite){
                    if($favorite['id'] == $user->id) {
                        $is_favorite = true;
                        break; 
                    }
                }
            }

            $business_service_categories = ServiceCategory::where('branch_id', $business->branch_id)->with('subCategories')->get();
            return view('business.show', compact('business', 'business_service_categories', 'is_favorite'));

        }
    }
}
