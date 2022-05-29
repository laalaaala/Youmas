<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\BusinessOpeningHours;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessOpeningHoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $business = $user->business;

        return response()->json([
            'data' => $business->openingHours,
            'status' => true
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessOpeningHours  $businessOpeningHours
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessOpeningHours $businessOpeningHours)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessOpeningHours  $businessOpeningHours
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessOpeningHours $businessOpeningHours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessOpeningHours  $businessOpeningHours
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $business = $user->business;
        $business->openingHours()->delete();
        $data = $request->all();

        try {

            foreach ($data as $key => $item) {
                $business->openingHours()->create([
                    'day' => $key,
                    'start' => $item['start'],
                    'end' => $item['end'],
                ]);
            }
            return response()->json([
                'message' => 'Opening hours successfully updated',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => $error->getMessage(),
                'status' => false
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessOpeningHours  $businessOpeningHours
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessOpeningHours $businessOpeningHours)
    {
        //
    }
}
