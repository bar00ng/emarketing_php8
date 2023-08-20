@php
    $no = 1;
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
<body>
    <h1>Daftar Order {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</h1>
    <table>
        <thead>
            <th>No</th>
            <th>Kode Pemesanan</th>
            <th>Tanggal Pesan</th>
            <th>Atas Nama</th>
            <th>Item</th>
            <th>Total Pesanan</th>
            <th>Bayar</th>
            <th>Kembali</th>
            <th>Status</th>
        </thead>
        <tbody>
            @if ($orderData->isEmpty())
                <tr>
                    <td colspan="10" class="text-center">
                        <span class="font-italic">History Belanja Kosong</span>
                    </td>
                </tr>
            @else
                @foreach ($orderData as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item->kd_pesanan }}</td>
                    <td>{{ $item->tanggal_pesanan }}</td>
                    <td>{{ $item->pemesan_pesanan }}</td>
                    <td>
                        @foreach ($item->orderDetail as $detail)
                            <ul class="list-unstyled">
                                <li>{{ $detail->barang->nama_barang . ' - ' . $detail->qty . ' Pcs' }}</li>
                            </ul>
                        @endforeach
                    </td>
                    <td>{{ number_format($item->total_pesanan) }}</td>
                    <td>{{ number_format($item->payment->nominal_payment) }}</td>
                    <td>{{ number_format($item->payment->kembali_payment) }}</td>
                    <td>
                        @if ($item->status == 'Selesai')
                            <span class="text-success">Selesai</span>
                        @else
                            <span class="text-danger">Belum Selesai</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>