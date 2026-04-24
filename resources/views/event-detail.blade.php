@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex flex-col md:flex-row gap-12">
        
        <div class="w-full md:w-1/3 space-y-8">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
                {{-- Pastikan gambar ini ada di public/images/ --}}
                <img src="{{ asset('assets/concert.png') }}" alt="Event" class="w-full h-auto object-cover min-h-[300px]">
            </div>

            <div class="bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
                <h3 class="font-bold text-slate-800 mb-4">Penyelenggara</h3>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 font-bold">
                        AB
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-800">ABP Productions</h4>
                        <p class="text-xs text-slate-500">Verified Organizer</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full md:w-2/3 space-y-8">
            <div class="space-y-4">
                <span class="px-4 py-1 bg-indigo-100 text-indigo-600 rounded-full text-xs font-bold uppercase tracking-wider">
                    Music Festival
                </span>
                <h1 class="text-5xl font-extrabold text-slate-900 leading-tight">
                    Jazz Night 2024: A Celebration of Rhythm & Melody
                </h1>
                <div class="flex flex-wrap gap-6 text-slate-500 font-medium">
                    <div class="flex items-center gap-2">
                        <span>📅 Saturday, 16 Nov 2024</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span>📍 The Blue Note Lounge, Metropolis</span>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <h3 class="text-xl font-bold text-slate-800">Deskripsi Event</h3>
                <p class="text-slate-600 leading-relaxed text-lg">
                    Nikmati malam yang tak terlupakan dengan alunan jazz dari musisi internasional. Jazz Night 2024 hadir untuk membawa Anda ke dalam perjalanan melodi yang menenangkan dan ritme yang menggugah jiwa.
                </p>
                <p class="text-slate-600 leading-relaxed text-lg">
                    Tahun ini kami menghadirkan <strong>The Jazz Collective, Luna Vance</strong>, dan artis favorit lainnya. Acara ini juga dilengkapi dengan food stall premium dan area networking yang nyaman.
                </p>
            </div>

            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 p-8 rounded-[40px] shadow-2xl text-white flex flex-col md:flex-row justify-between items-center gap-8">
                <div>
                    <p class="text-indigo-100 font-medium mb-1">HARGA TIKET</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-5xl font-black">Rp 150.000</span>
                        <span class="text-indigo-200">/ orang</span>
                    </div>
                    <p class="mt-4 text-sm text-indigo-100 flex items-center gap-2">
                        ℹ️ Sisa stok: <span class="underline font-bold text-white">42 Tiket lagi!</span>
                    </p>
                </div>
                <a href="/checkout" class="bg-white text-indigo-600 px-10 py-5 rounded-2xl font-black text-xl hover:bg-slate-50 transition-all shadow-lg active:scale-95">
                    Pesan Sekarang
                </a>
            </div>

            <div class="space-y-4 pt-4">
                <h3 class="text-xl font-bold text-slate-800">Kebijakan Tiket</h3>
                <ul class="space-y-3 text-slate-600">
                    <li class="flex items-center gap-3">✅ E-Ticket akan dikirimkan otomatis setelah pembayaran berhasil.</li>
                    <li class="flex items-center gap-3">✅ Tiket dapat dican di pintu masuk (Check-in).</li>
                    <li class="flex items-center gap-3 text-red-500 font-medium underline">⚠️ Tiket yang sudah dibeli tidak dapat direfund.</li>
                </ul>
            </div>
        </div>

    </div>
</div>
@endsection