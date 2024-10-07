<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'role' => session('user_role'),
        ]);
        // 5
    }
}
