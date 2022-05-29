<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\BusinessPicture;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BusinessPictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $business_pictures = $user->business->pictures;

        return response()->json([
            'data' => $business_pictures,
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
        $this->validate($request, [
            'file' => 'required',
        ]);

        $user = Auth::user();

        try {

            $fileName = $user->business->id . '_' . time() . '.' . $request->file->getClientOriginalExtension();
            $fileLink = '/files/businesses/' . $user->business->id . '/pictures/' . $fileName;
            $request->file->move(public_path() . '/files/businesses/' . $user->business->id . '/pictures/', $fileName);

            $user->business->pictures()->create(['link' => $fileLink, 'order' => 1]);
            $user->save();
            return response()->json([
                'data' => $user->business->pictures,
                'message' => 'Image uploaded successfully',
                'status' => true
            ], 200);
        } catch (Exception $error) {
            return response()->json($error->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessPicture  $businessPicture
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessPicture $businessPicture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessPicture  $businessPicture
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessPicture $businessPicture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessPicture  $businessPicture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessPicture $businessPicture)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessPicture  $businessPicture
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $business_picture = BusinessPicture::find($id);
        $business_picture->delete();
        $business = Auth::user()->business;


        return response()->json([
            'data' => $business->pictures,
            'message' => 'Image deleted successfully',
            'status' => true
        ], 200);
    }
}
