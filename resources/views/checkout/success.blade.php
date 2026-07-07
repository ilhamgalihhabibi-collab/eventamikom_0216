@extends('layouts.app')

@section('title', 'Pembayaran Sukses')

@section('content')
<main class="max-w-md mx-auto px-6 py-20 text-center">
    <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm flex flex-col items-center">
        <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mb-6">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h1 class="text-3xl font-black text-slate-800 mb-2">Pembayaran Sukses!</h1>
        <p class="text-slate-500 mb-6">Tiket Anda telah berhasil dipesan dan dikonfirmasi.</p>

        <div class="w-full bg-slate-50 rounded-2xl p-4 text-left space-y-3 mb-8 text-sm">
            <div class="flex justify-between">
                <span class="text-slate-400">Nomor Order:</span>
                <span class="font-bold text-slate-700">{{ $transaction->order_id }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Nama Event:</span>
                <span class="font-bold text-slate-700">{{ $transaction->event->title }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Nama Pemesan:</span>
                <span class="font-bold text-slate-700">{{ $transaction->customer_name }}</span>
            </div>
            <div class="flex justify-between border-t pt-2 mt-2">
                <span class="text-slate-400 font-bold">Total Bayar:</span>
                <span class="font-black text-indigo-600 text-base">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
            </div>
        </div>

        <a href="{{ route('home') }}" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 active:scale-95 transition-all block">
            Kembali ke Beranda
        </a>
    </div>
</main>
@endsection