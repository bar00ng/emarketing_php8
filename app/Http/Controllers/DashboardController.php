<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function dashboardRedirect() {
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    }

    public function adminDashboard() {
        $pageName = "Dashboard";

        return view('admin.dashboard', compact('pageName'));
    }

    public function userDashboard() {
        return view('index');
    }
}
