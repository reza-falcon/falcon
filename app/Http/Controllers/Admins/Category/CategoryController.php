<?php

namespace App\Http\Controllers\Admins\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //basic view
    public function index(Request $request)
    {
        return view('admins.categories.category');
    }
    public function store(Request $request)
    {
        return $request->all();
    }
}
