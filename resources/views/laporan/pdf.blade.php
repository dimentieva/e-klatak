<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
            color: #0BB4B2;
        }

        .printed {
            text-align: right;
            font-size: 10px;
            color: #777;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px 6px;
            text-align: left;
        }

        th {
            background-color: #0BB4B2;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .summary-container {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            gap: 30px;
            flex-wrap: wrap;
        }

        .summary-card {
            flex: 1;
            min-width: 220px;
            background-color: #0BB4B2;
            padding: 20px;
            border-radius: 10px;
            color: white;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .summary-card p {
            margin: 0;
        }

        .summary-title {
            font-weight: bold;
            font-size: 14px;
        }

        .summary-value {
            margin-top: 6px;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Laporan Seluruh Penjualan</h2>
    <div class="printed">
        Dicetak tanggal: {{ now()->format('d-m-Y H:i') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kasir</th>
                <th>Tanggal</th>
                <th>No Nota</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $totalPendapatan = 0;
                $totalBarangTerjual = 0;
            @endphp

            @foreach($semuaTransaksi as $transaksi)
                @php
                    $subtotalTransaksi = 0;
                    $jumlahDetail = count($transaksi->detailTransaksi);
                    $pajakPerDetail = $jumlahDetail > 0 ? $transaksi->pajak / $jumlahDetail : 0;
                @endphp

                @foreach($transaksi->detailTransaksi as $detail)
                    @php
                        $subtotal = $detail->sub_total + $pajakPerDetail;
                        $subtotalTransaksi += $subtotal;
                        $totalBarangTerjual += $detail->jumlah;
                    @endphp
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $transaksi->user->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->format('d/m/Y') }}</td>
                        <td>{{ $transaksi->nomor_nota ?? '-' }}</td>
                        <td>{{ $detail->produk->nama_produk ?? '-' }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach

                @php
                    $totalPendapatan += $subtotalTransaksi;
                @endphp
            @endforeach
        </tbody>
    </table>

    <div class="summary-container">
        <div class="summary-card">
            <p class="summary-title">Total Pendapatan</p>
            <p class="summary-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="summary-card">
            <p class="summary-title">Total Produk Terjual</p>
            <p class="summary-value">{{ $totalBarangTerjual }} pcs</p>
        </div>
    </div>
</body>
</html>
