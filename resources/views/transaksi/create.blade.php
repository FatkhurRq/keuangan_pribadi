@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<!-- Header -->
<div class="mb-8 animate-fade-in">
    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-2">Tambah Transaksi Baru</h1>
    <p class="text-gray-600 dark:text-gray-400">Catat transaksi keuangan Anda dengan mudah</p>
</div>

<!-- Form Card -->
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 p-6 lg:p-8">
    <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Jenis Transaksi -->
        <div class="space-y-2">
            <label for="jenis" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                Jenis Transaksi <span class="text-red-600">*</span>
            </label>
            <div class="grid grid-cols-2 gap-3 sm:gap-4">
                <label class="relative cursor-pointer">
                    <input 
                        type="radio"
                        name="jenis"
                        value="pemasukan"
                        {{ old('jenis') == 'pemasukan' ? 'checked' : '' }}
                        required
                        class="sr-only peer"
                    >
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border-2 border-gray-200 dark:border-gray-700 p-4 peer-checked:border-green-500 peer-checked:bg-green-50 dark:peer-checked:bg-green-900/20 transition-all duration-200">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span class="font-semibold text-gray-900 dark:text-white">Pemasukan</span>
                        </div>
                    </div>
                </label>

                <label class="relative cursor-pointer">
                    <input 
                        type="radio"
                        name="jenis"
                        value="pengeluaran"
                        {{ old('jenis') == 'pengeluaran' ? 'checked' : '' }}
                        required
                        class="sr-only peer"
                    >
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border-2 border-gray-200 dark:border-gray-700 p-4 peer-checked:border-red-500 peer-checked:bg-red-50 dark:peer-checked:bg-red-900/20 transition-all duration-200">
                        <div class="flex items-center justify-center gap-2">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                            </svg>
                            <span class="font-semibold text-gray-900 dark:text-white">Pengeluaran</span>
                        </div>
                    </div>
                </label>
            </div>
            @error('jenis')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori -->
        <div class="space-y-2">
            <label for="kategori" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                Kategori <span class="text-red-600">*</span>
                <span class="text-xs text-gray-500 font-normal">(contoh: Gaji, Makan, Transportasi)</span>
            </label>
            <input 
                type="text" 
                id="kategori"
                name="kategori" 
                value="{{ old('kategori') }}"
                required
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200"
                placeholder="Masukkan kategori transaksi"
            >
            @error('kategori')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Two Column Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Jumlah -->
            <div class="space-y-2">
                <label for="jumlah" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Jumlah <span class="text-red-600">*</span>
                </label>
                <div class="relative">
                    <span class="absolute left-4 top-3.5 text-gray-500 dark:text-gray-400 font-semibold text-lg">Rp</span>
                    <input 
                        type="number" 
                        id="jumlah"
                        name="jumlah" 
                        value="{{ old('jumlah') }}"
                        step="1"
                        min="0"
                        required
                        class="w-full pl-12 pr-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200"
                        placeholder="0"
                    >
                </div>
                @error('jumlah')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal -->
            <div class="space-y-2">
                <label for="tanggal" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    Tanggal <span class="text-red-600">*</span>
                </label>
                <input 
                    type="date" 
                    id="tanggal"
                    name="tanggal" 
                    value="{{ old('tanggal', date('Y-m-d')) }}"
                    required
                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200"
                >
                @error('tanggal')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Keterangan -->
        <div class="space-y-2">
            <label for="keterangan" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                Keterangan <span class="text-xs text-gray-500 font-normal">(Opsional)</span>
            </label>
            <textarea 
                id="keterangan"
                name="keterangan" 
                rows="4"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200 resize-none"
                placeholder="Tambahkan catatan atau deskripsi tambahan (opsional)"
            >{{ old('keterangan') }}</textarea>
            <p class="mt-1 text-xs text-gray-500">Max 255 karakter</p>
            @error('keterangan')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
            <button 
                type="submit" 
                class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-medium transition-all duration-200 cursor-pointer bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white shadow-sm flex-1 group"
            >
                <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Simpan Transaksi</span>
            </button>
            <a 
                href="{{ route('transaksi.index') }}" 
                class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-medium transition-all duration-200 cursor-pointer bg-gray-100 hover:bg-gray-200 active:bg-gray-300 text-gray-900 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white shadow-sm flex-1"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                <span>Batal</span>
            </a>
        </div>
    </form>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.5s ease-out;
    }
</style>
@endsection