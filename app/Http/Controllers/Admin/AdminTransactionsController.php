<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminTransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        return view('admin.transactions', compact('transactions'));
    }

    public function filter(Request $request)
    {
        $page_number = $request->page ? $request->page : 1;
        $status = $request->status ? $request->status : '';

        $builder = Transaction::when($status != '', function ($query) use ($status) {
            $query->where('status', $status);
        })
            ->with('customer')
            ->with('business')
            ->paginate(10, ['*'], 'page', $page_number)
            ->toArray();
        $pagination = [
            'total' => $builder['total'],
            'current_page' => $builder['current_page'],
            'last_page' => $builder['last_page'],
            'per_page' => $builder['per_page'],
        ];

        $transactions = $builder['data'];

        return response()->json([
            'data' => $transactions,
            'pagination' => $pagination,
            'status' => true
        ], 200);
    }
}
