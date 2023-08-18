<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\User;
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
        $jumlahBarang = Barang::count();
        $jumlahUser = User::whereHasRole('user')->count();

        return view('admin.dashboard', compact('pageName', 'jumlahBarang', 'jumlahUser'));
    }

    public function userDashboard() {
        $barangData = Barang::where('isActive', true)->get();

        return view('index', compact('barangData'));
    }
}
