<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.users');
    }

    public function filter(Request $request)
    {

        $page_number = $request->page ? $request->page : 1;
        $name = $request->name ? $request->name : '';
        $email = $request->email ? $request->email : '';
        $type = $request->type ? $request->type : '';

        $builder = User::when($email != '', function ($query) use ($email) {
            $query->where('email', 'LIKE', '%' . $email . '%');
        })
            ->when($type != '', function ($query) use ($type) {
                $query->where('type', $type);
            })
            ->paginate(10, ['*'], 'page', $page_number)
            ->toArray();


        $pagination = [
            'total' => $builder['total'],
            'current_page' => $builder['current_page'],
            'last_page' => $builder['last_page'],
            'per_page' => $builder['per_page'],
        ];

        $users = $builder['data'];

        return response()->json([
            'data' => $users,
            'pagination' => $pagination,
            'status' => true
        ], 200);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        try {

            $user->delete();


            $builder = User::paginate(10, ['*'], 'page', 1)
                ->toArray();

            $pagination = [
                'total' => $builder['total'],
                'current_page' => $builder['current_page'],
                'last_page' => $builder['last_page'],
                'per_page' => $builder['per_page'],
            ];

            $users = $builder['data'];

            return response()->json([
                'data' => $users,
                'pagination' => $pagination,
                'status' => true
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'message' => 'There has been an error deleting the user',
                'status' => true
            ]);
        }
    }
}
