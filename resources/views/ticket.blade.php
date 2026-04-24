@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-indigo-600 flex flex-col items-center py-12 px-4">
    
    <div class="text-center mb-10 text-white">
        <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4 border-2 border-white/30">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h1 class="text-4xl font-bold mb-2">Pembayaran Berhasil!</h1>
        <p class="text-indigo-100">Tiket Anda telah terbit dan siap digunakan.</p>
    </div>

    <div class="relative w-full max-w-md">
        <div class="bg-slate-50 rounded-t-[40px] p-10 text-center border-b-2 border-dashed border-slate-200 relative">
            <p class="text-indigo-600 font-bold text-xs tracking-[0.2em] mb-2 uppercase">E-Ticket Resmi</p>
            <h2 class="text-2xl font-black text-slate-900">Jazz Night 2024: A Celebration</h2>
            
            <div class="absolute -bottom-4 -left-4 w-8 h-8 bg-indigo-600 rounded-full"></div>
            <div class="absolute -bottom-4 -right-4 w-8 h-8 bg-indigo-600 rounded-full"></div>
        </div>

        <div class="bg-white p-10 space-y-8">
            <div class="grid grid-cols-2 gap-y-8 text-left">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Nama Pembeli</p>
                    <p class="font-bold text-slate-800">Donni Prabowo</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Tanggal & Waktu</p>
                    <p class="font-bold text-slate-800">16 Nov, 19:30</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Order ID</p>
                    <p class="font-bold text-slate-800">TRX-99210</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Lokasi</p>
                    <p class="font-bold text-slate-800">Blue Note Lounge</p>
                </div>
            </div>

            <div class="bg-slate-50 rounded-3xl p-8 text-center border border-slate-100">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Scan QR untuk Check-in</p>
                <div class="w-40 h-40 mx-auto bg-white p-2 rounded-xl mb-4 flex items-center justify-center border border-slate-200">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=TKT-001293848" alt="QR Code" class="w-full h-full">
                </div>
                <p class="font-mono font-bold text-slate-600">TKT-001293848</p>
            </div>
        </div>

        <div class="bg-white rounded-b-[40px] p-10 pt-0 flex flex-col gap-4">
            <button class="w-full py-5 bg-indigo-600 text-white rounded-2xl font-bold text-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">
                Cetak / Simpan PDF
            </button>
            <a href="/" class="text-center text-slate-400 font-bold hover:text-slate-600 transition-all">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection