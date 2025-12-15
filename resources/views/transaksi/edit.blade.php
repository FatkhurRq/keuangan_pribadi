@extends('layouts.app')

@section('title', 'Edit Transaksi')

@section('content')
<!-- Header -->
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Edit Transaksi</h1>
    <p class="text-gray-600 dark:text-gray-400">Ubah data transaksi yang sudah tercatat</p>
</div>

<!-- Form Card -->
<div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
    <form action="{{ route('transaksi.update', $transaksi->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Jenis Transaksi -->
        <div>
            <label for="jenis" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Jenis Transaksi <span class="text-red-600">*</span>
            </label>
            <select 
                id="jenis"
                name="jenis" 
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition"
            >
                <option value="">-- Pilih Jenis --</option>
                <option value="pemasukan" {{ old('jenis', $transaksi->jenis) == 'pemasukan' ? 'selected' : '' }}>📈 Pemasukan</option>
                <option value="pengeluaran" {{ old('jenis', $transaksi->jenis) == 'pengeluaran' ? 'selected' : '' }}>📉 Pengeluaran</option>
            </select>
            @error('jenis')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Kategori -->
        <div>
            <label for="kategori" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Kategori <span class="text-red-600">*</span>
            </label>
            <input 
                type="text" 
                id="kategori"
                name="kategori" 
                value="{{ old('kategori', $transaksi->kategori) }}"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition"
                placeholder="contoh: Gaji, Makan, Transportasi"
            >
            @error('kategori')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Jumlah -->
        <div>
            <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Jumlah <span class="text-red-600">*</span>
            </label>
            <div class="relative">
                <span class="absolute left-4 top-2 text-gray-500 dark:text-gray-400 font-medium">Rp</span>
                <input 
                    type="number" 
                    id="jumlah"
                    name="jumlah" 
                    value="{{ old('jumlah', $transaksi->jumlah) }}"
                    step="1"
                    min="0"
                    required
                    class="w-full pl-12 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition"
                    placeholder="0"
                >
            </div>
            @error('jumlah')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggal -->
        <div>
            <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Tanggal <span class="text-red-600">*</span>
            </label>
            <input 
                type="date" 
                id="tanggal"
                name="tanggal" 
                value="{{ old('tanggal', $transaksi->tanggal->format('Y-m-d')) }}"
                required
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition"
            >
            @error('tanggal')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Keterangan -->
        <div>
            <label for="keterangan" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Keterangan (Opsional)
            </label>
            <textarea 
                id="keterangan"
                name="keterangan" 
                rows="4"
                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition resize-none"
                placeholder="Tambahkan catatan atau deskripsi (opsional)"
            >{{ old('keterangan', $transaksi->keterangan) }}</textarea>
            @error('keterangan')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex gap-4 pt-4">
            <button 
                type="submit" 
                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 rounded-lg transition duration-200 transform hover:scale-105 flex items-center justify-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update Transaksi
            </button>
            <a 
                href="{{ route('transaksi.index') }}" 
                class="flex-1 bg-gray-300 hover:bg-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-900 dark:text-white font-medium py-3 rounded-lg transition duration-200 flex items-center justify-center gap-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Batal
            </a>
        </div>
    </form>
</div>
@endsection