<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $business_id = $user->business->id;
        $services = Service::where('business_id', $business_id)->with('subCategory')->get();

        return view('dashboard.services', compact('services'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $business = $user->business;

        try {

            Service::create([
                'name' => $data['name'],
                'duration' => $data['duration'],
                'price' => $data['price'],
                'subcategory_id' => $data['subcategory'],
                'business_id' => $business->id
            ]);

            $services = Service::where('business_id', $business->id)->with('subCategory')->get();

            return response()->json([
                'data' => $services,
                'message' => 'Dienstleistungen erfolgreich hinzugefügt',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'There has been an error while creating the service',
                'status' => false
            ], 422);
        }
    }
    public function update(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        $business = $user->business;
        try {

            $service = Service::find($data['id']);
            $service->update(
                [
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'duration' => $data['duration'],
                    'subcategory_id' => $data['subcategory']
                ]
            );
            $service->save();
            $services = Service::where('business_id', $business->id)->with('subCategory')->get();

            return response()->json([
                'data' => $services,
                'message' => 'Service updated successfully',
                'status' => true,
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'There has been an error updating the service',
                'status' => true,
            ], 422);
        }
    }
    public function destroy($id)
    {

        $user = Auth::user();
        $business_id = $user->business->id;

        $service = Service::find($id);
        $service->delete();

        $services = Service::where('business_id', $business_id)->with('subCategory')->get();
        return response()->json([
            'message' => 'The service has been deleted successfully',
            'data' => $services,
            'status' => true
        ], 200);
    }
    public function businessServices($business_id)
    {
        $services = Service::where('business_id', $business_id)->get();

        return response()->json([
            'data' => $services,
            'status' => true
        ], 200);
    }
    public function subCategories()
    {
        $branch_id = Auth::user()->business->branch_id;
        $business_categories = ServiceCategory::where('branch_id', $branch_id)->get();
        $sub_categories = [];
        foreach ($business_categories as $business_category) {
            $business_sub_categories = $business_category->subCategories()->get();
            foreach ($business_sub_categories as $sub_category) {
                array_push($sub_categories, $sub_category);
            }
        }
        return response()->json([
            'data' => $sub_categories,
            'status' => true,

        ], 200);
    }
}
