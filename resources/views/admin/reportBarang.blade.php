@php
    $noBarang = 1;
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
    <h1>Daftar Barang</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @if ($barangData->isEmpty())
                <tr>
                    <td colspan="10"> Daftar Barang Kosong </td>
                </tr>
            @else
                @foreach ($barangData as $item)
                    <tr>
                        <td>{{ $noBarang++ }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->kategori_barang }}</td>
                        <td>{{ 'Rp. ' . number_format($item->harga_barang) }}</td>
                        <td>{{ $item->desc_barang }}</td>
                        <td>
                            @if ($item->isActive == true)
                                Aktif
                            @else
                                Tidak Aktif
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>