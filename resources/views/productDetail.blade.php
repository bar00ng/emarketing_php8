@extends('master')

@section('content')
<!-- Product section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="row gx-4 gx-lg-5 align-items-center">
            <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ isset($barangData->pic_barang) ? Storage::url('uploads/pic_barang/' . $barangData->pic_barang) : 'https://dummyimage.com/600x700/dee2e6/6c757d.jpg' }}" alt="..." /></div>
            <div class="col-md-6">
                <h1 class="display-5 fw-bolder">{{ $barangData->nama_barang }}</h1>
                <div class="fs-5 mb-3">
                    <span>
                        {{ 'Rp. ' . number_format($barangData->harga_barang) }}
                    </span>
                </div>
                <p class="lead">
                    {{ $barangData->desc_barang }}
                </p>
            </div>
        </div>
    </div>
</section>    
@endsection
