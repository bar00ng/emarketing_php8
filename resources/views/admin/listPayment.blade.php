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
                        <th>Tagihan</th>
                        <th>Nominal dibayarkan</th>
                        <th>Kembalian</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Kode Pesanan</th>
                        <th>Tagihan</th>
                        <th>Nominal dibayarkan</th>
                        <th>Kembalian</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if ($paymentData->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">
                                <span class="font-italic">Daftar Pembayaran Kosong</span>
                            </td>
                        </tr>
                    @else
                        @foreach ($paymentData as $item)
                            <tr>
                                <td class="p-3">{{ $item->kd_pesanan }}</td>
                                <td>{{ number_format($item->order->total_pesanan) }}</td>
                                <td>{{ number_format($item->nominal_payment) }}</td>
                                <td>{{ number_format($item->kembali_payment) }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection