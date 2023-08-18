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
            <a href="{{ route('form.user') }}" class="btn btn-secondary mb-4">Tambah User</a>
            <div class="table-responsive">
                <table class="table table-striped w-100" id="dataTable">
                    <thead>
                        <tr>
                            <th class="p-2">No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th>Alamat Lengkap</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>No. Telp</th>
                            <th>Email</th>
                            <th>Alamat Lengkap</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @if ($userData->isEmpty())
                            <tr>
                                <td colspan="10" class="text-center">
                                    <span class="font-italic">Data User Kosong</span>
                                </td>
                            </tr>
                        @else
                            @foreach ($userData as $item)
                                <tr>
                                    <td class="p-3">{{ $no++ }}</td>
                                    <td>{{ $item->first_name . ' ' . $item->last_name }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ $item->no_telp }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->alamat_lengkap }}</td>
                                    <td class="d-flex flex-lg-row flex-md-col justify-content-start align-items-center">
                                        <div class="mx-1">
                                            <a href="{{ route('form.user', $item->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit User">
                                                <i class="fas fa-user-edit"></i>
                                            </a>
                                        </div>

                                        <form action="{{ route('user.delete', $item->id) }}" class="" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Delete User">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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