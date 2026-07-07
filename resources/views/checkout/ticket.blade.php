<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>E-Tiket {{ $transaction->order_id }}</title>
    <style>
        body { font-family: sans-serif; color: #333; line-height: 1.5; }
        .ticket-box { border: 2px dashed #4f46e5; padding: 20px; max-width: 600px; margin: 0 auto; }
        .header { text-align: center; border-bottom: 2px solid #333; padding-bottom: 10px; }
        .title { font-size: 24px; font-weight: bold; color: #4f46e5; }
        .info-table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        .info-table td { padding: 8px 0; }
        .info-table td.label { font-weight: bold; color: #666; width: 30%; }
        .footer { text-align: center; margin-top: 30px; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <div class="ticket-box">
        <div class="header">
            <div class="title">AMIKOM EVENT HUB</div>
            <p>Bukti Pembayaran & Tiket Resmi</p>
        </div>
        <table class="info-table">
            <tr>
                <td class="label">Order ID</td>
                <td>: {{ $transaction->order_id }}</td>
            </tr>
            <tr>
                <td class="label">Nama Acara</td>
                <td>: <strong>{{ $transaction->event->name }}</strong></td>
            </tr>
            <tr>
                <td class="label">Nama Pembeli</td>
                <td>: {{ $transaction->customer_name }}</td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td>: {{ $transaction->customer_email }}</td>
            </tr>
            <tr>
                <td class="label">Status</td>
                <td>: <span style="color: green; font-weight: bold;">{{ strtoupper($transaction->status) }}</span></td>
            </tr>
            <tr>
                <td class="label">Total Bayar</td>
                <td>: Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
            </tr>
        </table>
        <div class="footer">
            <p>Bawa E-Tiket ini saat menghadiri acara untuk proses verifikasi Check-In.</p>
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
    </div>
</body>
</html>