@extends('auth.master')

@section('content')
<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Login</h1>
</div>

<form class="user" method="POST" action="{{ route('login.action') }}">
    @csrf
    <div class="form-group">
        <label>E- Mail</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="user@example.com">
        <div class="invalid-feedback">
            {{ $errors->first('email') }}
        </div>
    </div>

    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Login</button>
  </form>
</form>
<hr>
<div class="text-center">
    <a class="small" href="{{ route('register') }}">Create an Account!</a>
</div>
@endsection