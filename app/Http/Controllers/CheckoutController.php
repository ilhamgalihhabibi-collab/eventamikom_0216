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

        // --- BYPASS TOKEN UNTUK SIMULASI ---
        $snapToken = 'BYPASS-TOKEN-' . Str::random(20);

        // Menyimpan transaksi dengan kolom lengkap termasuk 'qty', 'status', dan 'snap_token'
        $transaction = Transaction::create([
            'event_id'       => $event->id,
            'order_id'       => $orderId,
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'qty'            => 1, // Menyertakan field qty sesuai kebutuhan struktur database modul Anda
            'total_price'    => $totalPrice,
            'status'         => 'Pending', // Field status yang sudah dibuat melalui migrasi terbaru
            'snap_token'     => $snapToken // Field snap_token yang sudah dibuat melalui migrasi terbaru
        ]);

        // Mengurangi stok tiket event
        $event->decrement('stock', 1);

        // Mengarahkan ke halaman rute pembayaran/invoice sukses
        return redirect()->route('checkout.payment', $transaction->id);
    }

    public function payment(Transaction $transaction)
    {
        $categories = \App\Models\Category::all();
        $event = $transaction->event;
        return view('checkout.payment', compact('transaction', 'event', 'categories'));
    }
}