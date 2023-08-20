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
    <h1>Data Payment</h1>
    <table>
        <thead>
            <th>Kode Pesanan</th>
            <th>Tagihan</th>
            <th>Bayar</th>
            <th>Kembali</th>
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
</body>
</html>