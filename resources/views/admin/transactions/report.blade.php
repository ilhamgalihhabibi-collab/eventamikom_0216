<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi Amikom Event Hub</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; line-height: 1.4; }
        h2 { text-align: center; margin-bottom: 2px; text-transform: uppercase; color: #1e293b; }
        .subtitle { text-align: center; margin-bottom: 20px; color: #4f46e5; font-weight: bold; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #cbd5e1; padding: 10px 8px; text-align: left; }
        th { background-color: #f1f5f9; font-weight: bold; color: #475569; font-size: 11px; text-transform: uppercase; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-mono { font-family: monospace; font-size: 11px; color: #4f46e5; }
        .badge-success { color: #16a34a; font-weight: bold; }
        .badge-pending { color: #d97706; font-weight: bold; }
        .badge-failed { color: #dc2626; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Laporan Rekapitulasi Transaksi Penjualan Tiket</h2>
    <div class="subtitle">AMIKOM EVENT HUB</div>
    <p style="color: #64748b; font-size: 11px;">Tanggal Cetak: {{ date('d F Y H:i') }} WIB</p>
    
    <table>
        <thead>
            <tr>
                <th style="width: 5%;" class="text-center">No</th>
                <th style="width: 20%;">Order ID</th>
                <th style="width: 25%;">Nama Pelanggan</th>
                <th style="width: 25%;">Nama Event</th>
                <th style="width: 15%;" class="text-right">Total Harga</th>
                <th style="width: 10%;" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $trx)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="font-mono">{{ $trx->order_id }}</td>
                <td>
                    <strong>{{ $trx->customer_name }}</strong><br>
                    <span style="color: #64748b; font-size: 10px;">{{ $trx->customer_email }}</span>
                </td>
                <td>{{ $trx->event->title ?? $trx->event->name ?? 'Event Dihapus' }}</td>
                <td class="text-right" style="font-weight: bold;">Rp {{ number_format($trx->total_price, 0, ',', '.') }}</td>
                <td class="text-center">
                    <span class="badge-{{ strtolower($trx->status ?? 'success') }}">{{ strtoupper($trx->status ?? 'SUCCESS') }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="color: #94a3b8; padding: 20px;">Belum ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>