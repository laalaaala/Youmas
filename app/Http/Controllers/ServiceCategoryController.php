<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Auth;

class ServiceCategoryController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $categories = ServiceCategory::where('branch_id', $user->business->branch_id)->get();

        return response()->json([
            'data' => $categories,
            'status' => true
        ], 200);
    }
    
}
