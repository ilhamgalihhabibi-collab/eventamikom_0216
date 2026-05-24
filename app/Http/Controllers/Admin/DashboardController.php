<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEvents     = Event::count();
        $totalPendapatan = Transaction::where('payment_status', 'success')->sum('total_price');
        $tiketTerjual    = Transaction::where('payment_status', 'success')->sum('qty');
        $pesananPending  = Transaction::where('payment_status', 'pending')->count();
        $recentTransaksi = Transaction::with('event')
                            ->latest()
                            ->take(10)
                            ->get();

        return view('admin.dashboard', compact(
            'totalEvents',
            'totalPendapatan',
            'tiketTerjual',
            'pesananPending',
            'recentTransaksi'
        ));
    }
}