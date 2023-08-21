@php
    $no = 1;
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
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
    </head>
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
    <h3 style="text-align: center;">Daftar Payment</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Kode Pesanan</th>
                <th>Tagihan</th>
                <th>Bayar</th>
                <th>Kembali</th>
            </tr>
        </thead>
        <tbody>
            @if ($paymentData->isEmpty())
                <tr>
                    <td colspan="10" class="text-center">
                        <span class="font-italic">Data Pembayaran Kosong</span>
                    </td>
                </tr>
            @else
                @foreach ($paymentData as $item)
                <tr>
                    <td>{{ $item->kd_pesanan }}</td>
                    <td>{{ number_format($item->order->total_pesanan) }}</td>
                    <td>{{ number_format($item->nominal_payment) }}</td>
                    <td>{{ number_format($item->kembali_payment) }}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
    </table>

    <div class="footer-text">
        <p>Jakarta, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <p>Administrator</p>
        <br><br><br><br>
        <p>{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</p>
    </div>
</body>
</html>