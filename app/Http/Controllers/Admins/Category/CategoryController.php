<?php

namespace App\Http\Controllers\Admins\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //basic view
    public function index(Request $request)
    {
        return view('admins.categories.category');
    }
    public function store(Request $request)
    {
        $validation_rules = [
            'category' => 'required|min:5|max:191|string|unique:categories,title'
        ];
        $validator = Validator::make($request->all(), $validation_rules);
        if ($validator->fails()) {
            return Response::json([
                'status' => false,
                'message' => 'Please fix the following errors',
                'errors' => $validator->errors(),
            ]);
        }
        $create =Category::create([
            'title'=>$request->category,
        ]);
        if ($create) {
            return Response::json([
                'status'=>true,
                'message'=>'Category successfully added',
            ]);
        }
        return Response::json([
            'status'=>false,
            'message'=>'Somthing went wrong, may be network error',
        ]);
    }
}
