@php
    $no = 1;
@endphp

@extends('master')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="d-flex flex-column align-items-start gap-2 mb-2">
            <h1>Daftar Order</h1>

            <a href="{{ route('order.report') }}" class="btn btn-primary btn-sm">Generate Report</a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>No</th>
                    <th>Kode Pemesanan</th>
                    <th>Tanggal Pesan</th>
                    <th>Atas Nama</th>
                    <th>Item</th>
                    <th>Total Pesanan</th>
                    <th>Status</th>
                    <th>Action</th>
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
                            <td>
                                @if ($item->status == 'Selesai')
                                    <span class="text-success">Selesai</span>
                                @else
                                    <span class="text-danger">Belum Selesai</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('order.delete', $item->kd_pesanan) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>  
@endsection