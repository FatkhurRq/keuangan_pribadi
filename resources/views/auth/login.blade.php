@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Masuk</h1>
            <p class="text-gray-600 dark:text-gray-400">Kelola keuangan pribadi Anda dengan mudah</p>
        </div>

        <!-- Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Email
                </label>
                <input 
                    type="email" 
                    id="email"
                    name="email" 
                    value="{{ old('email') }}" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition"
                    placeholder="user@example.com"
                >
                @error('email')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Password
                </label>
                <input 
                    type="password" 
                    id="password"
                    name="password" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="remember"
                    name="remember" 
                    class="h-4 w-4 text-blue-600 dark:bg-gray-700 dark:border-gray-600 rounded focus:ring-2 focus:ring-blue-500 transition"
                >
                <label for="remember" class="ml-3 text-sm text-gray-700 dark:text-gray-300">
                    Ingat saya
                </label>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg transition duration-200 transform hover:scale-105"
            >
                Masuk
            </button>
        </form>

        <!-- Register Link -->
        <div class="mt-6 text-center">
            <p class="text-gray-600 dark:text-gray-400">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-medium transition">
                    Daftar di sini
                </a>
            </p>
        </div>
    </div>
</div>
@endsection