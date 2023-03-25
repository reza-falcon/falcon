<?php

namespace App\Http\Controllers\Clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // dashboard view\
    public function index(Request $request)
    {
        return view('clients.dashboard');
    }
}
