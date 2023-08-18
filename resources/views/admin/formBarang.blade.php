@extends('admin.master')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('form.barang.action', isset($barangData) ? ['barang_id' => $barangData->id] : []) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" placeholder="Nama Barang" value="{{ isset($barangData) ? $barangData->nama_barang : old('nama_barang')}}" autofocus>
                <div class="invalid-feedback">
                    {{ $errors->first('nama_barang') }}
                </div>
            </div>

            <div class="form-group">
                <label>Kategori Barang</label>
                <select name="kategori_barang" class="form-control @error('kategori_barang') is-invalid @enderror">
                    <option value="t-shirt" {{ old('kategori_barang') == 't-shirt' ? 'selected' : '' }} {{ isset($barangData) && $barangData->kategori_barang == 't-shirt' ? 'selected' : '' }}>T- shirt</option>
                    <option value="jaket" {{ old('kategori_barang') == 'jaket' ? 'selected' : '' }} {{ isset($barangData) && $barangData->kategori_barang == 'jaket' ? 'selected' : '' }}>Jaket</option>
                    <option value="shorts" {{ old('kategori_barang') == 'shorts' ? 'selected' : '' }} {{ isset($barangData) && $barangData->kategori_barang == 'shorts' ? 'selected' : '' }}>Shorts</option>
                    <option value="pants" {{ old('kategori_barang') == 'pants' ? 'selected' : '' }} {{ isset($barangData) && $barangData->kategori_barang == 'pants' ? 'selected' : '' }}>Pants</option>
                    <option value="sweater" {{ old('kategori_barang') == 'sweater' ? 'selected' : '' }} {{ isset($barangData) && $barangData->kategori_barang == 'sweater' ? 'selected' : '' }}>Sweater</option>
                </select>
                <div class="invalid-feedback">
                    {{ $errors->first('kategori_barang') }}
                </div>
            </div>

            <div class="form-group">
                <label>Harga</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control @error('harga_barang') is-invalid @enderror" placeholder="000.00" value="{{ isset($barangData) ? $barangData->harga_barang : old('harga_barang') }}" name="harga_barang">
                    <div class="invalid-feedback">
                        {{ $errors->first('harga_barang') }}
                    </div>
                </div>
            </div>
        
            <div class="form-group">
                <label>Deskripsi Barang</label>
                <textarea name="desc_barang" id="" cols="30" rows="3" class="form-control @error('desc_barang') is-invalid @enderror" placeholder="Masukkan Deskripsi Barang">{{ isset($barangData) ? $barangData->desc_barang : old('desc_barang') }}</textarea>
                <div class="invalid-feedback">
                    {{ $errors->first('desc_barang') }}
                </div>
            </div>
        
            <div class="form-group">
                <label>Display Picture</label>
                @if (isset($barangData) && $barangData->pic_barang)
                    <div>
                        <label for="">
                            <span>Current File : </span>
                            <span>
                                <a href="{{ Storage::url('uploads/pic_barang/' . $barangData['pic_barang']) }}">{{ $barangData->pic_barang }}</a>
                            </span> 
                        </label>
                    </div>
                    <input type="hidden" name="current_pic_barang" value="{{ $barangData->pic_barang }}">
                @endif
                <input type="file" class="form-control @error('pic_barang') is-invalid @enderror" name="pic_barang" accept="image/*">
                <div class="invalid-feedback">
                    {{ $errors->first('pic_barang') }}
                </div>
            </div>

            @if (isset($barangData))
                <button type="submit" class="btn btn-warning btn-block">Edit</button>
            @else
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            @endif
        </form>
    </div>
</div>
@endsection