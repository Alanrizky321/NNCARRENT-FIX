<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard'); // This refers to the 'resources/views/dashboard.blade.php' file
    }
    
}
