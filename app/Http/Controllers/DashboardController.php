<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * show application dashboard
     */
    public function index()
    {
        return view('dashboard');
    }
}
