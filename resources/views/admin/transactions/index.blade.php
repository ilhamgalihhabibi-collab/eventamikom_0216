@extends('layouts.app')

@section('title', 'Manajemen Transaksi')

@section('content')
<div class="flex">
    <div class="flex-1 p-10 bg-slate-50 min-h-screen">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Manajemen Transaksi</h1>
                <p class="text-sm text-slate-500">Daftar seluruh riwayat pemesanan tiket masuk aplikasi.</p>
            </div>
            
            <div>
                <a href="{{ route('admin.transactions.pdf') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 px-5 rounded-xl transition-all shadow-sm active:scale-95">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Cetak Laporan PDF
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-100 border-b border-slate-200 text-slate-600 text-sm font-semibold">
                        <th class="p-4">No</th>
                        <th class="p-4">Order ID</th>
                        <th class="p-4">Nama Pelanggan</th>
                        <th class="p-4">Event</th>
                        <th class="p-4 text-center">Jumlah (Qty)</th>
                        <th class="p-4">Total Harga</th>
                        <th class="p-4">Status</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700 text-sm divide-y divide-slate-100">
                    @forelse($transactions as $index => $transaction)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="p-4 font-medium">{{ $transactions->firstItem() + $index }}</td>
                            <td class="p-4 font-mono text-xs text-indigo-600">{{ $transaction->order_id }}</td>
                            <td class="p-4">
                                <p class="font-semibold">{{ $transaction->customer_name }}</p>
                                <p class="text-xs text-slate-400">{{ $transaction->customer_email }}</p>
                            </td>
                            <td class="p-4 font-medium">{{ $transaction->event->title ?? $transaction->event->name ?? 'Event Dihapus' }}</td>
                            <td class="p-4 text-center">{{ $transaction->qty ?? 1 }}</td>
                            <td class="p-4 font-bold text-slate-900">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 text-xs font-bold rounded-full bg-emerald-100 text-emerald-700">
                                    {{ strtoupper($transaction->status ?? 'SUCCESS') }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-400">
                                Belum ada data transaksi yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection