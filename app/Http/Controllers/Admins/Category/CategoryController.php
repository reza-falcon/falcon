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
        $create = Category::create([
            'title' => $request->category,
        ]);
        if ($create) {
            return Response::json([
                'status' => true,
                'message' => 'Category successfully added',
            ]);
        }
        return Response::json([
            'status' => false,
            'message' => 'Somthing went wrong, may be network error',
        ]);
    }
    // datatable get all category
    public function get_all_category(Request $request)
    {

        $order_col = $_REQUEST['order'][0]['column'];
        $order_dir = $_REQUEST['order'][0]['dir'];
        $columns = ['title', 'created_at', 'status', 'status'];

        // *********************************************************
        $all_categories = Category::select();
        // filter by date
        $count = $all_categories->count();
        $all_categories = $all_categories->orderBy($columns[$order_col], $order_dir)->get();
        $data = array();
        $i = 0;
        foreach ($all_categories as $value) {
            $data[$i]['responsive_id'] = "";
            $data[$i]['title'] = $value->title;
            $data[$i]['create_date'] = date('d M Y', strtotime($value->created_at));
            $data[$i]['status'] = $value->status;
            $data[$i]['action'] = '<button class="btn btn-danger btn-sm">Delete</button>';
            $i++;
        }
        // return Response::json($data);
        return Response::json([
            'draw' => $request->draw,
            'recordsTotal' => $count,
            'recordsFiltered' => $count,
            'data' => $data,
        ]);
    }
}
