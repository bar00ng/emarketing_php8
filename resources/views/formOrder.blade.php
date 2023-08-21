@php
    $no = 1;
@endphp

@extends('master')

@section('content')
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <h1>Keranjang Belanja</h1>

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @if (Cart::session(Auth::user()->id)->isEmpty())
                        <tr>
                            <td colspan="10" class="text-center">
                                <span class="font-italic">Keranjang Belanja Kosong</span>
                            </td>
                        </tr>
                    @else
                        @foreach (Cart::session(Auth::user()->id)->getContent() as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price*$item->quantity) }}</td>
                            <td>
                                <form action="{{ route('remove.from.cart', $item->id) }}" method="post">
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total Belanja</td>
                        <td colspan="2">{{ number_format(Cart::session(Auth::user()->id)->getTotal()) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <h1>Form Order</h1>

        <form action="{{ route('order.action') }}" method="post">
            @csrf
            <div class="form-group mb-3">
                <label>Nama Pemesan</label>
                <input type="text" class="form-control @error('pemesan_pesanan') is-invalid @enderror" name="pemesan_pesanan" value="{{ $errors->has('pemesan_pesanan') ? old('pemesan_pesanan') : Auth::user()->first_name . ' ' . Auth::user()->last_name }}" placeholder="Masukkan Nama Pemesan" id="nama-pemesan">
                <div class="invalid-feedback">
                    {{ $errors->first('pemesan_pesanan') }}
                </div>
            </div>
        
            <div class="form-group">
                <label>Total Belanja</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control @error('total_pesanan') is-invalid @enderror" value="{{ Cart::session(Auth::user()->id)->getTotal() }}" name="total_pesanan" readonly id="total-bayar"> 
                </div>
            </div>

            <div class="form-group">
                <label>Nominal Bayar</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control @error('bayar_pesanan') is-invalid @enderror" value="{{ old('bayar_pesanan') }}" name="bayar_pesanan" placeholder="000.00" id="bayar-pesanan">
                    <div class="invalid-feedback">
                        {{ $errors->first('bayar_pesanan') }}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Kembalian</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="number" class="form-control @error('kembali_pesanan') is-invalid @enderror" value="{{ old('kembali_pesanan') }}" name="kembali_pesanan" id="kembali-pesanan" readonly>
                    <div class="invalid-feedback">
                        {{ $errors->first('kembali_pesanan') }}
                    </div>
                </div>
            </div>

            <button class="btn btn-primary btn-block" type="submit">Order Now</button>
        </form>
    </div>
</section>  
@endsection

@section('script')
<script>
    $('#bayar-pesanan').on('keyup', function() {
        var $bayar = parseFloat($(this).val());
        var $totalBayar = parseFloat($("#total-bayar").val());
        
        if (!isNaN($bayar) && !isNaN($totalBayar)) {
            $('#kembali-pesanan').val($bayar - $totalBayar);
        } else {
            $('#kembali-pesanan').val('');
        }
    });
</script>
@endsection