<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Exception;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index()
    {
        return view('admin.faqs');
    }

    public function show()
    {
        $faqs = Faq::all();
        return view('faq', compact('faqs'));
    }

    public function filter(Request $request)
    {

        $page_number = $request->page ? $request->page : 1;

        $builder = Faq::paginate(10, ['*'], 'page', $page_number)
            ->toArray();


        $pagination = [
            'total' => $builder['total'],
            'current_page' => $builder['current_page'],
            'last_page' => $builder['last_page'],
            'per_page' => $builder['per_page'],
        ];

        $faq = $builder['data'];

        return response()->json([
            'data' => $faq,
            'pagination' => $pagination,
            'status' => true
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {

            Faq::create([
                'title' => $data['title'],
                'content' => $data['content'],
            ]);

            return response()->json(["message" => "FAQ has been created successfully"], 200);
        } catch (Exception $error) {
            return response()->json(["message" => "There has been a problem"], 422);
        }
    }

    public function update(Request $request)
    {
        $data = $request->all();
        try {
            $faq = Faq::find($data['id']);
            $faq->update([
                'title' => $data['title'],
                'content' => $data['content'],
            ]);
            $faq->save();
            return response()->json(["message" => "FAQ has been updated successfully."], 200);
        } catch (Exception $error) {
            return response()->json(["message" => "There has been a problem."], 422);
        }
    }

    public function destroy($id)
    {
        try {
            $faq = Faq::findOrFail($id);
            $faq->delete();
            return response()->json(["message" => "FAQ has been deleted successfully."], 200);
        } catch (Exception $error) {
            return response()->json(["message" => "There has been a problem."], 422);
        }
    }
}