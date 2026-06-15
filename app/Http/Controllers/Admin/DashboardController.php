<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        // Set data default (kosongan) agar aman dari eror
        $totalPendapatan = 0;
        $tiketTerjual = 0;
        $totalEvents = 0;
        $pesananPending = 0;
        $recentTransaksi = collect([]); // Membuat array kosong objek Laravel

        // Cek jika model/tabel Event ada di database, baru kita hitung
        if (class_exists('App\Models\Event')) {
            $totalEvents = \App\Models\Event::count();
        }

        // Cek jika model/tabel Transaction ada di database, baru kita hitung
        if (class_exists('App\Models\Transaction')) {
            $totalPendapatan = \App\Models\Transaction::where('payment_status', 'success')->sum('total_price') ?? 0;
            $tiketTerjual = \App\Models\Transaction::where('payment_status', 'success')->sum('qty') ?? 0;
            $pesananPending = \App\Models\Transaction::where('payment_status', 'pending')->count() ?? 0;
            
            // Ambil 5 transaksi terbaru beserta relasi eventnya
            $recentTransaksi = \App\Models\Transaction::with('event')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
        }

        // Kirim semua data ke view
        return view('admin.dashboard', compact(
            'totalPendapatan',
            'tiketTerjual',
            'totalEvents',
            'pesananPending',
            'recentTransaksi'
        ));
    }
}