@extends('layouts.app')

@section('title', 'Konfirmasi Pembayaran')

@section('content')
<main class="max-w-md mx-auto px-6 py-20 text-center">
    <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-sm flex flex-col items-center">
        <div class="w-20 h-20 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-6">
            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>

        <h1 class="text-3xl font-black text-slate-800 mb-2">Konfirmasi Tiket</h1>
        <p class="text-slate-500 mb-6">Tinggal satu langkah lagi untuk mengamankan tiketmu.</p>

        <div class="w-full bg-slate-50 rounded-2xl p-4 text-left space-y-3 mb-8 text-sm">
            <div class="flex justify-between">
                <span class="text-slate-400">Nomor Order:</span>
                <span class="font-bold text-slate-700">{{ $transaction->order_id }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-slate-400">Nama Event:</span>
                <span class="font-bold text-slate-700">{{ $event->title }}</span>
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

        <button id="pay-button" class="w-full py-4 bg-indigo-600 text-white rounded-2xl font-bold hover:bg-indigo-700 active:scale-95 transition-all block">
            Pilih Metode Pembayaran
        </button>
    </div>
</main>

<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function (e) {
        e.preventDefault();
        
        window.snap.pay('{{ $transaction->snap_token }}', {
            onSuccess: function(result){
                window.location.href = "{{ route('checkout.success', $transaction->id) }}";
            },
            onPending: function(result){
                alert("Menunggu pembayaran Anda! Silakan selesaikan pembayaran sesuai instruksi.");
                window.location.href = "{{ route('home') }}";
            },
            onError: function(result){
                alert("Pembayaran gagal, silakan coba lagi!");
            },
            onClose: function(){
                alert('Anda menutup halaman pembayaran sebelum selesai.');
            }
        });
    });
</script>
@endsection