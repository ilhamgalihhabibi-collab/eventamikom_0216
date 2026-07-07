<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function create(Event $event)
    {
        $categories = \App\Models\Category::all();
        return view('checkout.create', compact('event', 'categories'));
    }

    public function store(Request $request, Event $event)
    {
        $request->validate([
            'customer_name'  => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        if ($event->stock <= 0) {
            return back()->with('error', 'Mohon maaf, tiket untuk acara ini sudah habis.');
        }

        $orderId = 'TRX-' . time() . '-' . Str::random(5);
        $totalPrice = $event->price + 5000;

        // --- INTEGRASI SNAP MIDTRANS ---
        // 1. Konfigurasi Kredensial Environment Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false; // Mode Sandbox
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // 2. Susun Paket Array Data Transaksi untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
            ],
        ];

        try {
            // 3. Generate Snap Token Asli dari Midtrans API
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Menyimpan transaksi ke database dengan snap_token asli dari Midtrans
            $transaction = Transaction::create([
                'event_id'       => $event->id,
                'order_id'       => $orderId,
                'customer_name'  => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'qty'            => 1,
                'total_price'    => $totalPrice,
                'status'         => 'pending', // Menggunakan huruf kecil sesuai standar response status Midtrans
                'snap_token'     => $snapToken
            ]);

            // Mengurangi stok tiket event
            $event->decrement('stock', 1);

            // Mengarahkan ke halaman rute pembayaran menggunakan ID Transaksi (Route Model Binding)
            return redirect()->route('checkout.payment', $transaction->id);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran ke Midtrans: ' . $e->getMessage());
        }
    }

    // Menyesuaikan parameter agar tetap menggunakan Route Model Binding (Transaction $transaction)
    public function payment(Transaction $transaction)
    {
        $categories = \App\Models\Category::all();
        $event = $transaction->event;
        return view('checkout.payment', compact('transaction', 'event', 'categories'));
    }

    // Menambahkan fungsi sukses yang divalidasi langsung ke API Midtrans
    public function success(Transaction $transaction)
    {
        $categories = \App\Models\Category::all();

        // Validasi status pembayaran asli dari Midtrans (Mencegah manipulasi URL)
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;

        try {
            // Mengecek status transaksi di Midtrans berdasarkan order_id database
            $midtransStatus = \Midtrans\Transaction::status($transaction->order_id);

            // SOLUSI ERROR: Menggunakan sintaks array [] untuk membaca response status
            if (in_array($midtransStatus['transaction_status'], ['capture', 'settlement'])) {
                $transaction->update(['status' => 'success']); //
            }
        } catch (\Exception $e) {
            // Jika transaksi gagal dicek ke Midtrans, kembalikan ke beranda dengan pesan error
            return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan atau gagal diakses oleh sistem pembayaran.');
        }

        return view('checkout.success', compact('transaction', 'categories'));
    }
}