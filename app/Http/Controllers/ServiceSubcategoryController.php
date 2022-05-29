<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceSubcategoryController extends Controller
{

    public function index($category_id)
    {
        $subcategories = ServiceSubcategory::where('category_id', $category_id)->get();

        return response()->json([
            'data' => $subcategories,
            'status' => true
        ], 200);
    }
}
