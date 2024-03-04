<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('isadmin');
    }
    
    public function index()
    {
        return view('admin.dashboard');
    }
}
