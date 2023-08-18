@php
    $no = 1;    
@endphp

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
        <a href="{{ route('form.barang') }}" class="btn btn-secondary mb-4">Tambah Barang</a>
        <div class="table-responsive">
            <table class="table w-100" id="dataTable">
                <thead>
                    <tr>
                        <th class="p-2">No</th>
                        <th>Nama</th>
                        <th>Harga (Rp.)</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Gambar Barang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga (Rp.)</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Gambar Barang</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @if ($barangData->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">
                                <span class="font-italic">Data Barang Kosong</span>
                            </td>
                        </tr>
                    @else
                        @foreach ($barangData as $item)
                            <tr class="{{ $item->isActive == true ? 'table-success' : 'table-danger' }}">
                                <td class="p-3">{{ $no++ }}</td>
                                <td>{{ $item->nama_barang }}</td>
                                <td>{{ number_format($item->harga_barang) }}</td>
                                <td>{{ $item->kategori_barang }}</td>
                                <td>{{ $item->desc_barang }}</td>
                                <td>
                                    <a href="{{ Storage::url('uploads/pic_barang/' . $item['pic_barang']) }}">{{ $item->pic_barang }}</a>
                                </td>
                                <td class="d-flex flex-lg-row flex-md-col justify-content-start align-items-center">
                                    <div class="mr-1">
                                        <a href="{{ route('form.barang', $item->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit Barang">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </div>

                                    <form action="{{ route('barang.delete', $item->id) }}" class="mr-1" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete Barang">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                    @if ($item->isActive == true)
                                    <form action="{{ route('barang.update.status', ['barang_id' => $item->id, 'isActive' => 'false']) }}" class="" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Non Aktifkan Barang">
                                            <i class="fas fa-arrow-down"></i>
                                        </button>
                                    </form>
                                    @elseif ($item->isActive == false)    
                                    <form action="{{ route('barang.update.status', ['barang_id' => $item->id, 'isActive' => 'true']) }}" class="" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Aktifkan Barang">
                                            <i class="fas fa-arrow-up"></i>
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