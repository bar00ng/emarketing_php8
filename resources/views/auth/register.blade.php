@extends('auth.master')

@section('content')
<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Register</h1>
</div>

<form action="{{ route('register.action') }}" method="POST">
    @csrf
    <div class="form-row">
        <div class="form-group col-md-6">
            <label>First Name</label>
            <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" autofocus>
            <div class="invalid-feedback">
                {{ $errors->first('first_name') }}
            </div>
        </div>
        <div class="form-group col-md-6">
            <label>Last Name</label>
            <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name (Opsional)">
            <div class="invalid-feedback">
                {{ $errors->first('last_name') }}
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Alamat Lengkap</label>
        <input type="text" class="form-control @error('alamat_lengkap') is-invalid @enderror" name="alamat_lengkap" value="{{ old('alamat_lengkap') }}" placeholder="Jl. Kebajikan No. 777">
        <div class="invalid-feedback">
            {{ $errors->first('alamat_lengkap') }}
        </div>
    </div>

    <div class="form-group">
        <label>Nomor Telepon</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">+62</span>
            </div>
            <input type="text" class="form-control @error('no_telp') is-invalid @enderror" placeholder="812-000" value="{{ old('no_telp') }}" name="no_telp">
            <div class="invalid-feedback">
                {{ $errors->first('no_telp') }}
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username">
        <div class="invalid-feedback">
            {{ $errors->first('username') }}
        </div>
    </div>

    <div class="form-group">
        <label>E- Mail</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="user@example.com">
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Password">
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
    </div>

    <button type="submit" class="btn btn-primary btn-block">Save</button>
</form>
<hr>
<div class="text-center">
    <a class="small" href="{{ route('login') }}">Saya sudah punya akun.</a>
</div>
@endsection