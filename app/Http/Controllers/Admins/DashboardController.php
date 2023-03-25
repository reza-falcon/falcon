<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //admin dashbmoard
    public function index(Request $request)
    {
        return view('admins.dashboard');
    }
}
