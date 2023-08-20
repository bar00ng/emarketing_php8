@extends('admin.master')

@section('style')
    <link href="/assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="/assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="/assets/js/demo/datatables-demo.js"></script>
@endsection

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped w-100" id="dataTable">
                <thead>
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Tgl. Pesan</th>
                        <th>Atas Nama</th>
                        <th>Item</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Tgl. Pesan</th>
                        <th>Atas Nama</th>
                        <th>Item</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if ($orderData->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">
                                <span class="font-italic">Daftar Order Kosong</span>
                            </td>
                        </tr>
                    @else
                        @foreach ($orderData as $item)
                            <tr>
                                <td class="p-3">{{ $item->kd_pesanan }}</td>
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
                                <td class="d-flex flex-lg-row flex-md-col justify-content-start align-items-center">
                                    <form action="{{ route('order.delete', $item->kd_pesanan) }}" class="mr-1" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Order">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    @if ($item->status == 'Selesai')
                                        <form action="{{ route('order.update', ['kd_pesanan' => $item->kd_pesanan, 'value' => 'Belum Selesai']) }}" class="" method="post">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Tandai Belum Selesai">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    @elseif ($item->isActive == false)    
                                    <form action="{{ route('order.update', ['kd_pesanan' => $item->kd_pesanan, 'value' => 'Selesai']) }}" class="" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Tandai Selesai">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    @endif
                                    
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection