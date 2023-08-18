@php
    $noBarang = 1;
    $noUser = 1
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

    <h1>Daftar Pengguna</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Depan</th>
                <th>Nama Belakang</th>
                <th>No. Telp</th>
                <th>Alamat Lengkap</th>
                <th>Email</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            @if ($userData->isEmpty())
                <tr>
                    <td colspan="10"> Daftar User Kosong </td>
                </tr>
            @else
                @foreach ($userData as $item)
                    <tr>
                        <td>{{ $noUser++ }}</td>
                        <td>{{ $item->first_name != null ? $item->first_name : '-' }}</td>
                        <td>{{ $item->last_name != null ? $item->last_name : '-' }}</td>
                        <td>{{ $item->no_telp != null ? $item->no_telp : '-' }}</td>
                        <td>{{ $item->alamat_lengkap != null ? $item->alamat_lengkap : '-' }}</td>
                        <td>{{ $item->email != null ? $item->email : '-' }}</td>
                        <td>{{ $item->username != null ? $item->username : '-' }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>
</html>