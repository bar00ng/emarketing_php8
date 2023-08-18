@extends('admin.master')

@section('content')
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('form.user.action', isset($userData) ? ['user_id' => $userData->id] : []) }}" method="POST">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>First Name</label>
                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="First Name" value="{{ isset($userData) ? $userData->first_name : old('first_name')}}" autofocus>
                    <div class="invalid-feedback">
                        {{ $errors->first('first_name') }}
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label>Last Name</label>
                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ isset($userData) ? $userData->last_name : old('last_name') }}" placeholder="Last Name (Opsional)">
                    <div class="invalid-feedback">
                        {{ $errors->first('last_name') }}
                    </div>
                </div>
            </div>
        
            <div class="form-group">
                <label>Alamat Lengkap</label>
                <input type="text" class="form-control @error('alamat_lengkap') is-invalid @enderror" name="alamat_lengkap" value="{{ isset($userData) ? $userData->alamat_lengkap : old('alamat_lengkap') }}" placeholder="Jl. Kebajikan No. 777">
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
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror" placeholder="812-000" value="{{ isset($userData) ? $userData->no_telp : old('no_telp') }}" name="no_telp">
                    <div class="invalid-feedback">
                        {{ $errors->first('no_telp') }}
                    </div>
                </div>
            </div>
        
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ isset($userData) ? $userData->username : old('username') }}" placeholder="Username">
                <div class="invalid-feedback">
                    {{ $errors->first('username') }}
                </div>
            </div>
        
            <div class="form-group">
                <label>E- Mail</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ isset($userData) ? $userData->email : old('email') }}" placeholder="user@example.com">
                <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                </div>
            </div>

            @if (!isset($userData))
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="Password">
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                </div>
            @endif
        
            
            <button type="submit" class="btn btn-primary btn-block">Save</button>
        </form>
    </div>
</div>
@endsection