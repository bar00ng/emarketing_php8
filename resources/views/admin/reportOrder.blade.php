@php
    $no = 1;
@endphp
<!DOCTYPE html>
<html lang="en">
    <style>
        .table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }

        .table, .table>thead>tr>th, .table>tbody>tr>td {
            border: 1px solid black;
        }

        .table>thead>tr>th {
            background-color: lightgray;
            padding: 5px;
        }

        .table>tbody>tr> {
            text-align: center;
        }

        /* Gaya untuk garis bawah */
        .garis-bawah {
            border-bottom: 1px solid black;
            margin-bottom: 20px;
        }

        .footer-text {
            font-size: 12px;
            text-align: center;
            max-width: 200px;
            margin-top: 20px;
            margin-left: auto;
            margin-right: 0;
        }
    </style>
<body>
    <table style="border: none; border-collapse: collapse;">
        <tr>
            <td rowspan="2" style="vertical-align: middle;">
                <img src="{{ public_path('app_logo.png') }}" alt="Logo Perusahaan" style="width: 90px; margin-right: 20px;">
            </td>
            <td style="vertical-align: middle; text-align:center;">
                <p style="font-size: 16px; font-weight: bold;">PT Auto Daya Keisindo</p>
            </td>
        </tr>
        <tr>
            <td style="vertical-align: middle; text-align:center;">
                <p>Jl. Kapten Tandean No.8, RT. 1/ RW. 2, Kuningan Bar, Kec. Mampang Prpt, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta, 12730</p>
                <p>Telepon: 0812-1909-2020</p>
            </td>
        </tr>
    </table>

    <div class="garis-bawah"></div>

    <!-- Isi konten lainnya -->
    <h3 style="text-align: center;">Daftar Order</h3>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Pemesanan</th>
                <th>Tanggal Pesan</th>
                <th>Atas Nama</th>
                <th>Item</th>
                <th>Total Pesanan</th>
                <th>Status</th>
            </tr>
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
                            <p>- {{ $detail->barang->nama_barang . ' - ' . $detail->qty . ' Pcs' }}</p>
                        @endforeach
                    </td>
                    <td>{{ number_format($item->total_pesanan) }}</td>
                    <td>
                        @if ($item->status == 'Selesai')
                            <span class="text-success" style="color: green;">Selesai</span>
                        @else
                            <span class="text-danger" style="color: red">Belum Selesai</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="footer-text">
        <p>Jakarta, {{ \Carbon\Carbon::now()->locale('id_ID')->isoFormat('dddd, D MMMM YYYY') }}</p>
        <p>Administrator</p>
        <br><br><br><br>
        <p>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
    </div>
</body>
</html>