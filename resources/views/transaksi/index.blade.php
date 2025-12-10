@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">
    <div>
        <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-2">Daftar Transaksi</h1>
        <p class="text-gray-600 dark:text-gray-400">Kelola semua transaksi keuangan Anda</p>
    </div>
    <a href="{{ route('transaksi.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-medium transition-all duration-200 cursor-pointer bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white shadow-sm inline-flex justify-center sm:justify-start whitespace-nowrap">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span>Tambah Transaksi</span>
    </a>
</div>

<!-- Filter Bar (Hidden on Mobile) -->
<div class="hidden md:flex gap-3 mb-6 flex-wrap">
    <div class="flex-1 min-w-xs">
        <input 
            type="text" 
            placeholder="Cari kategori..." 
            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200"
            id="search-kategori"
        >
    </div>
    <select id="filter-jenis" class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all duration-200 min-w-xs">
        <option value="">Semua Jenis</option>
        <option value="pemasukan">Pemasukan</option>
        <option value="pengeluaran">Pengeluaran</option>
    </select>
</div>

<!-- Transactions Table (Desktop) -->
<div class="hidden md:block bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 p-6">
    @if($transaksi->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Tanggal</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Jenis</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Kategori</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300">Keterangan</th>
                        <th class="px-6 py-3 text-right font-semibold text-gray-700 dark:text-gray-300">Jumlah</th>
                        <th class="px-6 py-3 text-center font-semibold text-gray-700 dark:text-gray-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($transaksi as $t)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors duration-200" data-jenis="{{ $t->jenis }}" data-kategori="{{ $t->kategori }}">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $t->tanggal->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">
                            @if($t->jenis == 'pemasukan')
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300 text-xs font-semibold">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 11a1 1 0 011-1h1V9a1 1 0 011-1h2a1 1 0 011 1v1h1a1 1 0 110 2H4a1 1 0 01-1-1z"></path>
                                    </svg>
                                    Pemasukan
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300 text-xs font-semibold">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 9a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"></path>
                                    </svg>
                                    Pengeluaran
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $t->kategori }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400 truncate">{{ Str::limit($t->keterangan ?? '-', 30) }}</td>
                        <td class="px-6 py-4 text-sm font-bold text-right {{ $t->jenis == 'pemasukan' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                            {{ $t->jenis == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                <a 
                                    href="{{ route('transaksi.edit', $t->id) }}" 
                                    class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900/40 text-xs font-medium transition-all duration-200"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="inline-flex items-center gap-1 px-2 py-1 rounded-lg bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/40 text-xs font-medium transition-all duration-200"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="px-6 py-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <p class="text-gray-600 dark:text-gray-400 mb-4 text-lg font-medium">Belum ada transaksi</p>
            <a href="{{ route('transaksi.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-medium transition-all duration-200 cursor-pointer bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Transaksi Pertama
            </a>
        </div>
    @endif
</div>

<!-- Transactions Cards (Mobile) -->
@if($transaksi->count() > 0)
        <div class="md:hidden space-y-3">
        @foreach($transaksi as $t)
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 p-4 hover:shadow-md transition-shadow duration-300" data-jenis="{{ $t->jenis }}" data-kategori="{{ $t->kategori }}">
            <div class="flex items-start justify-between mb-3">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-1">
                        @if($t->jenis == 'pemasukan')
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-green-100 dark:bg-green-900/20 text-green-700 dark:text-green-300 text-xs font-semibold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M4 11a1 1 0 011-1h1V9a1 1 0 011-1h2a1 1 0 011 1v1h1a1 1 0 110 2H4a1 1 0 01-1-1z"></path>
                                </svg>
                                Masuk
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300 text-xs font-semibold">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 9a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"></path>
                                </svg>
                                Keluar
                            </span>
                        @endif
                        <span class="text-xs text-gray-500">{{ $t->tanggal->format('d/m/Y') }}</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 dark:text-white text-sm">{{ $t->kategori }}</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ Str::limit($t->keterangan ?? '-', 40) }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-sm {{ $t->jenis == 'pemasukan' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                        {{ $t->jenis == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                    </p>
                </div>
            </div>
            
            <div class="border-t border-gray-200 dark:border-gray-700 pt-3 flex gap-2">
                <a 
                    href="{{ route('transaksi.edit', $t->id) }}" 
                    class="flex-1 inline-flex justify-center items-center gap-1 px-3 py-2 rounded-lg bg-blue-100 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-900/40 text-xs font-medium transition-all duration-200"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
                <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="w-full inline-flex justify-center items-center gap-1 px-3 py-2 rounded-lg bg-red-100 dark:bg-red-900/20 text-red-700 dark:text-red-300 hover:bg-red-200 dark:hover:bg-red-900/40 text-xs font-medium transition-all duration-200"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="md:hidden bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 px-6 py-12 text-center">
        <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <p class="text-gray-600 dark:text-gray-400 mb-4 text-lg font-medium">Belum ada transaksi</p>
        <a href="{{ route('transaksi.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-medium transition-all duration-200 cursor-pointer bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Transaksi Pertama
        </a>
    </div>
@endif

<script>
    document.getElementById('search-kategori')?.addEventListener('input', function(e) {
        const search = e.target.value.toLowerCase();
        document.querySelectorAll('table tbody tr').forEach(row => {
            const kategori = row.dataset.kategori.toLowerCase();
            row.style.display = kategori.includes(search) ? '' : 'none';
        });
    });

    document.getElementById('filter-jenis')?.addEventListener('change', function(e) {
        const filter = e.target.value;
        document.querySelectorAll('table tbody tr').forEach(row => {
            const jenis = row.dataset.jenis;
            row.style.display = !filter || jenis === filter ? '' : 'none';
        });
    });
</script>
@endsection