<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $days = Transaction::where('status', 'success')->whereDate('created_at', today())->sum('total_price');
        $month = Transaction::where('status', 'success')->whereMonth('created_at', today()->month)->sum('total_price');
        $year = Transaction::where('status', 'success')->whereYear('created_at', today()->year)->sum('total_price');
        $user = User::where('roles', 'USER')->count();
        return view('pages.admin.dashboard', compact('days', 'month', 'year', 'user'));
    }
}
