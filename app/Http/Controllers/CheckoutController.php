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

        
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false; 
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

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
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            $transaction = Transaction::create([
                'event_id'       => $event->id,
                'order_id'       => $orderId,
                'customer_name'  => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'qty'            => 1,
                'total_price'    => $totalPrice,
                'status'         => 'pending', 
                'snap_token'     => $snapToken
            ]);

            // Mengurangi stok tiket event
            $event->decrement('stock', 1);

            return redirect()->route('checkout.payment', $transaction->id);

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran ke Midtrans: ' . $e->getMessage());
        }
    }

    public function payment(Transaction $transaction)
    {
        $categories = \App\Models\Category::all();
        $event = $transaction->event;
        return view('checkout.payment', compact('transaction', 'event', 'categories'));
    }

    public function success(Transaction $transaction)
    {
        $categories = \App\Models\Category::all();

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;

        try {
            $midtransStatus = \Midtrans\Transaction::status($transaction->order_id);

            $statusArray = (array) $midtransStatus;
            
            if (in_array($statusArray['transaction_status'], ['capture', 'settlement'])) {
                $transaction->update(['status' => 'success']); 
            }
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan atau gagal diakses oleh sistem pembayaran.');
        }

        return view('checkout.success', compact('transaction', 'categories'));
    }
}