<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $favs = $user->favorites()->with('pictures')->with('user')->with('services')->get();
        return view('dashboard.favorites', compact('favs'));
    }

    public function store($id)
    {
        $user = Auth::user();
        $business = Business::find($id);
        $business->favorites()->attach($user->id);
    }

    public function delete($id, Request $request)
    {
        $user = Auth::user();
        $business = Business::find($id);
        $business->favorites()->detach($user->id);
    }
}
