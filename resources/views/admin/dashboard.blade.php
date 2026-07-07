@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden mt-6">
    <div class="p-8 border-b flex justify-between items-center">
        <h3 class="font-black text-xl">Transaksi Terakhir</h3>
        <a href="#" class="text-indigo-600 font-bold hover:underline">Lihat Semua</a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                    <th class="px-8 py-4 w-1/4">Tgl Transaksi</th>
                    <th class="px-8 py-4 w-1/4">Pembeli</th>
                    <th class="px-8 py-4 w-1/4">Event</th>
                    <th class="px-8 py-4 w-[10%]">Status</th>
                    <th class="px-8 py-4 text-right">Total</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">
                @forelse($recentTransactions as $tx)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-8 py-6 text-sm text-slate-600 max-w-xs break-all">
                            {{ $tx->created_at->format('d M Y - H:i') }} <br>
                            <span class="text-xs text-slate-400">#{{ $tx->order_id }}</span>
                        </td>
                        <td class="px-8 py-6">
                            <p class="font-bold uppercase tracking-wide text-xs truncate max-w-[150px]">{{ $tx->customer_name }}</p>
                            <p class="text-xs text-slate-400 truncate max-w-[150px]">{{ $tx->customer_email }}</p>
                        </td>
                        <td class="px-8 py-6 font-medium text-slate-600 max-w-xs truncate">
                            {{ $tx->event->title ?? '-' }}
                        </td>
                        <td class="px-8 py-6 whitespace-nowrap">
                            @if($tx->status === 'settlement' || $tx->status === 'success')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-xs font-bold uppercase">Success</span>
                            @elseif($tx->status === 'pending')
                                <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-xs font-bold uppercase">Pending</span>
                            @else
                                <span class="px-3 py-1 bg-rose-100 text-rose-700 rounded-lg text-xs font-bold uppercase">{{ $tx->status }}</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 font-black text-indigo-600 whitespace-nowrap text-right">
                            Rp {{ number_format($tx->total_price, 0, ',', '.') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-8 py-10 text-center text-slate-500">Belum ada transaksi</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection