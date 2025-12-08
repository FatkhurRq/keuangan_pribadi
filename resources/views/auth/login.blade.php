@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="card" style="max-width: 500px; margin: 50px auto;">
    <h2>Login</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group">
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="remember"> Ingat Saya
            </label>
        </div>
        <button type="submit" class="btn">Login</button>
        <p style="margin-top: 15px;">Belum punya akun? <a href="{{ route('register') }}">Register di sini</a></p>
    </form>
</div>
@endsection