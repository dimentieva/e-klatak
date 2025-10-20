<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; color: #333; }
        h2 { text-align: center; margin-bottom: 5px; color: #0BB4B2; }
        .printed { text-align: right; font-size: 10px; color: #777; }
        table { border-collapse: collapse; width: 100%; margin-top: 15px; }
        th, td { border: 1px solid #ccc; padding: 8px 6px; text-align: left; }
        th { background-color: #0BB4B2; color: white; }
        tbody tr:nth-child(even) { background-color: #f9f9f9; }
        .summary-container { margin-top: 20px; display: flex; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
        .summary-card { flex: 1; min-width: 160px; background-color: #0BB4B2; padding: 15px; border-radius: 10px; color: white; }
        .summary-card.yellow { background-color: #FFD700; color: #333; }
        .summary-title { font-weight: bold; font-size: 14px; }
        .summary-value { margin-top: 6px; font-size: 16px; font-weight: bold; }
    </style>
</head>
<body>
    <h2>Laporan Penjualan Fresh Market Klatak</h2>
    <div class="printed">
        Dicetak tanggal: {{ now()->format('d-m-Y H:i') }} <br>
        Periode: {{ $tanggalMulai }} s/d {{ $tanggalSelesai }}
    </div>

    {{-- Ringkasan --}}
    <div class="summary-container">
        <div class="summary-card">
            <p class="summary-title">Pendapatan Kotor</p>
            <p class="summary-value">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
        </div>
        <div class="summary-card">
            <p class="summary-title">Total Laba</p>
            <p class="summary-value">Rp {{ number_format($laba, 0, ',', '.') }}</p>
        </div>
        <div class="summary-card">
            <p class="summary-title">Total Rugi</p>
            <p class="summary-value">Rp {{ number_format($rugi, 0, ',', '.') }}</p>
        </div>
        @if($produkTerlaris)
        <div class="summary-card yellow">
            <p class="summary-title">Produk Terlaris</p>
            <p class="summary-value">{{ $produkTerlaris->produk->nama_produk ?? '-' }} ({{ $produkTerlaris->total_terjual }} pcs)</p>
        </div>
        @endif
    </div>

    {{-- Tabel Transaksi --}}
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>No Nota</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach($transaksi as $trx)
                @foreach($trx->detailTransaksi as $detail)
                    @php
                        $subtotal = $detail->jumlah * $detail->produk->harga_jual;
                    @endphp
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $trx->created_at->format('d-m-Y') }}</td>
                        <td>{{ $trx->nomor_nota }}</td>
                        <td>{{ $detail->produk->nama_produk ?? '-' }}</td>
                        <td>{{ $detail->jumlah }}</td>
                        <td>Rp {{ number_format($detail->produk->harga_jual, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
