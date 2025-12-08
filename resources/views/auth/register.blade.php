@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="card" style="max-width: 500px; margin: 50px auto;">
    <h2>Register</h2>
    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>Konfirmasi Password:</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <button type="submit" class="btn">Register</button>
        <p style="margin-top: 15px;">Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
    </form>
</div>
@endsection