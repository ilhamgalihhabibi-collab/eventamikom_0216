@extends('layouts.admin')

@section('title', 'Dashboard - Admin')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Selamat datang kembali di panel pengelolaan Amikom EventHub.')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Pendapatan</p>
        <p class="text-2xl font-black text-slate-900 mt-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
    </div>

    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Tiket Terjual</p>
        <p class="text-2xl font-black text-slate-900 mt-2">{{ $tiketTerjual }} Tiket</p>
    </div>

    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Event</p>
        <p class="text-2xl font-black text-slate-900 mt-2">{{ $totalEvents }} Konten</p>
    </div>

    <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Pesanan Pending</p>
        <p class="text-2xl font-black text-amber-500 mt-2">{{ $pesananPending }} Transaksi</p>
    </div>
</div>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm p-8">
    <h3 class="text-lg font-black text-slate-900 mb-4">Transaksi Terbaru</h3>
    <p class="text-sm text-slate-500">Silakan cek menu <a href="{{ route('admin.transactions.index') }}" class="text-indigo-600 font-bold hover:underline">Laporan Transaksi</a> untuk melihat detail lengkap data masuk.</p>
</div>
@endsection