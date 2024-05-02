<!DOCTYPE html>
<html>
<head>
    <title>Laundry Frzky</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
        }
        .container {
            width: 200px; /* Mengurangi lebar kontainer */
            height: 280px; /* Mengurangi tinggi kontainer */
            margin: 5px auto; /* Mengurangi margin */
            padding: 5px; /* Mengurangi padding */
            border: 1px solid #000;
            border-radius: 5px;
            text-align: left;
        }
        .header {
            font-size: 16px; /* Mengurangi ukuran font header */
            font-weight: bold;
            margin-bottom: 10px; /* Mengurangi margin */
            text-align: center;
        }
        .transaction-details {
            margin-bottom: 15px; /* Mengurangi margin */
        }
        .item {
            margin-bottom: 20px; /* Mengurangi margin */
            font-size: 12px; /* Mengurangi ukuran font item */
        }
        /* .footer {
            margin-top: 20px;
            font-size: 12px;
            font-style: italic;
        } */
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Struk Transaksi
        </div>
        <div class="transaction-details">
            <div class="item">Tanggal & Jam: {{ $order->created_at }}</div>
            <div class="item">Kode Transaksi: {{ $order->kode }}</div>
            <div class="item">Nama: {{ $order->konsumen->nama }}</div>
            <div class="item">Layanan: {{ $order->layanan->nama }}</div>
            <div class="item">Pembayaran: {{ $order->pembayaran->nama }}</div>
            <div class="item">Status: {{ ucfirst($order->status) }}</div>
            <div class="item">Total: Rp {{ number_format($order->total_harga) }}</div>
        </div>
        {{-- <div class="footer">
            Terima kasih telah laundry disini!
        </div> --}}
    </div>
</body>
</html>
