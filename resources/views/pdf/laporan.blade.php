<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Order PDF</title>

    <style>
        h1 {
           text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
        }
        
    </style>
</head>
<body>
    <h1>Laporan Order</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama Konsumen</th>
                <th>Jenis Layanan</th>
                <th>Jenis Pembayaran</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->konsumen->nama }}</td>
                <td>{{ $item->layanan->nama }}</td>
                <td>{{ $item->pembayaran->nama }}</td>
                <td>{{ $item->jumlah }} Kg</td>
                <td>Rp. {{ $item->total_harga }}</td>
                <td>{{ ucfirst($item->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>