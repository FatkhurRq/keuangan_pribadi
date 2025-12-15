@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Header -->
<div class="mb-8 lg:mb-10 animate-fade-in" data-chart="{{ base64_encode(json_encode($chartData)) }}" data-category="{{ base64_encode(json_encode($categoryData)) }}">
    <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-2">Dashboard</h1>
    <p class="text-gray-600 dark:text-gray-400 text-base lg:text-lg">Ringkasan keuangan pribadi Anda</p>
</div>

<!-- Stats Cards Grid -->
<div class="grid-auto mb-8">
    <!-- Total Pemasukan -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 p-6 space-y-2 border-l-4 border-green-500 hover:scale-105 transform transition-transform duration-300">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">Total Pemasukan</p>
                <p class="text-3xl font-bold text-green-600 dark:text-green-400">
                    Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                </p>
            </div>
            <div class="hidden sm:flex items-center justify-center w-16 h-16 rounded-full bg-green-100 dark:bg-green-900/20">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Pengeluaran -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 p-6 space-y-2 border-l-4 border-red-500 hover:scale-105 transform transition-transform duration-300">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">Total Pengeluaran</p>
                <p class="text-3xl font-bold text-red-600 dark:text-red-400">
                    Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                </p>
            </div>
            <div class="hidden sm:flex items-center justify-center w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/20">
                <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Saldo Akhir -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 p-6 space-y-2 {{ $saldo >= 0 ? 'border-l-4 border-blue-500' : 'border-l-4 border-orange-500' }} hover:scale-105 transform transition-transform duration-300">
        <div class="flex items-center justify-between">
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-600 dark:text-gray-400 uppercase tracking-wide">Saldo Akhir</p>
                <p class="text-3xl font-bold {{ $saldo >= 0 ? 'text-blue-600 dark:text-blue-400' : 'text-orange-600 dark:text-orange-400' }}">
                    Rp {{ number_format($saldo, 0, ',', '.') }}
                </p>
            </div>
            <div class="hidden sm:flex items-center justify-center w-16 h-16 rounded-full {{ $saldo >= 0 ? 'bg-blue-100 dark:bg-blue-900/20' : 'bg-orange-100 dark:bg-orange-900/20' }}">
                <svg class="w-8 h-8 {{ $saldo >= 0 ? 'text-blue-500' : 'text-orange-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Chart Pemasukan vs Pengeluaran -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 p-6">
        <div class="flex items-center gap-3 mb-6">
            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Grafik 12 Bulan Terakhir</h2>
        </div>
        <div class="relative" style="height: 300px;">
            <canvas id="chartTransaksi"></canvas>
        </div>
    </div>

    <!-- Chart Perbandingan Pemasukan vs Pengeluaran -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 p-6">
        <div class="flex items-center gap-3 mb-6">
            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Perbandingan Total</h2>
        </div>
        <div class="relative" style="height: 300px;">
            <canvas id="chartPerbandingan"></canvas>
        </div>
    </div>
</div>

<!-- Action Buttons -->
<div class="flex flex-col sm:flex-row gap-3 mb-8">
    <a href="{{ route('transaksi.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-medium transition-all duration-200 cursor-pointer bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white shadow-sm hover:shadow-md disabled:opacity-50 disabled:cursor-not-allowed flex-1 sm:flex-none justify-center sm:justify-start group">
        <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span>Tambah Transaksi</span>
    </a>
    <a href="{{ route('transaksi.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-medium transition-all duration-200 cursor-pointer bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors flex-1 sm:flex-none justify-center sm:justify-start">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
        </svg>
        <span>Lihat Semua</span>
    </a>
</div>

<!-- Category Charts Section -->
@if(count($categoryData['pemasukan']['labels']) > 0 || count($categoryData['pengeluaran']['labels']) > 0)
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Chart Kategori Pemasukan -->
    @if(count($categoryData['pemasukan']['labels']) > 0)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 p-6">
        <div class="flex items-center gap-3 mb-6">
            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Kategori Pemasukan</h2>
        </div>
        <div class="relative" style="height: 300px;">
            <canvas id="chartCategoryPemasukan"></canvas>
        </div>
    </div>
    @endif

    <!-- Chart Kategori Pengeluaran -->
    @if(count($categoryData['pengeluaran']['labels']) > 0)
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700 p-6">
        <div class="flex items-center gap-3 mb-6">
            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Kategori Pengeluaran</h2>
        </div>
        <div class="relative" style="height: 300px;">
            <canvas id="chartCategoryPengeluaran"></canvas>
        </div>
    </div>
    @endif
</div>
@endif

<!-- Recent Transactions -->
<div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Transaksi Terakhir</h2>
        </div>
        <a href="{{ route('transaksi.index') }}" class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
            Lihat lebih banyak →
        </a>
    </div>
    
    @if($transaksi->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 dark:text-white uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 dark:text-white uppercase tracking-wider">Jenis</th>
                        <th class="hidden md:table-cell px-6 py-4 text-left text-xs font-semibold text-gray-900 dark:text-white uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 dark:text-white uppercase tracking-wider">Jumlah</th>
                        <th class="hidden lg:table-cell px-6 py-4 text-left text-xs font-semibold text-gray-900 dark:text-white uppercase tracking-wider">Keterangan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($transaksi as $t)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white font-medium">{{ $t->tanggal->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($t->jenis == 'pemasukan')
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/20 text-green-800 dark:text-green-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M4 11a1 1 0 011-1h1V9a1 1 0 011-1h2a1 1 0 011 1v1h1a1 1 0 110 2H4a1 1 0 01-1-1z"></path>
                                    </svg>
                                    <span>Masuk</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900/20 text-red-800 dark:text-red-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 9a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"></path>
                                    </svg>
                                    <span>Keluar</span>
                                </span>
                            @endif
                        </td>
                        <td class="hidden md:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">{{ $t->kategori }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold {{ $t->jenis == 'pemasukan' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                            {{ $t->jenis == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                        </td>
                        <td class="hidden lg:table-cell px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($t->keterangan ?? '-', 30) }}</td>
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
            <a href="{{ route('transaksi.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg font-medium transition-all duration-200 cursor-pointer bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white shadow-sm hover:shadow-md disabled:opacity-50 disabled:cursor-not-allowed">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Transaksi Pertama
            </a>
        </div>
    @endif
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil data dari data attributes
    const headerEl = document.querySelector('[data-chart]');
    const chartData = JSON.parse(atob(headerEl.getAttribute('data-chart')));
    const categoryData = JSON.parse(atob(headerEl.getAttribute('data-category')));
    
    // Fungsi untuk mendapatkan theme (light/dark)
    const isDark = document.documentElement.classList.contains('dark') || 
                   window.matchMedia('(prefers-color-scheme: dark)').matches;
    
    const textColor = isDark ? 'rgba(209, 213, 219, 0.9)' : 'rgba(55, 65, 81, 0.9)';
    const gridColor = isDark ? 'rgba(75, 85, 99, 0.2)' : 'rgba(200, 200, 200, 0.2)';
    
    // Chart 1: Line Chart - Pemasukan vs Pengeluaran
    const ctx1 = document.getElementById('chartTransaksi');
    if (ctx1) {
        const chart1 = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: chartData.months,
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: chartData.pemasukan,
                        borderColor: 'rgb(34, 197, 94)',
                        backgroundColor: 'rgba(34, 197, 94, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgb(34, 197, 94)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 6
                    },
                    {
                        label: 'Pengeluaran',
                        data: chartData.pengeluaran,
                        borderColor: 'rgb(239, 68, 68)',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgb(239, 68, 68)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointHoverRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        labels: {
                            color: textColor,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: gridColor,
                            drawBorder: false
                        },
                        ticks: {
                            color: textColor,
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            color: textColor
                        }
                    }
                }
            }
        });
    }
    
    // Chart 2: Doughnut Chart - Perbandingan Total Pemasukan vs Pengeluaran
    const ctx2 = document.getElementById('chartPerbandingan');
    if (ctx2) {
        const totalPemasukan = chartData.pemasukan.reduce((a, b) => a + b, 0);
        const totalPengeluaran = chartData.pengeluaran.reduce((a, b) => a + b, 0);
        
        const chart2 = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: ['Pemasukan', 'Pengeluaran'],
                datasets: [{
                    data: [totalPemasukan, totalPengeluaran],
                    backgroundColor: [
                        'rgb(34, 197, 94)',
                        'rgb(239, 68, 68)'
                    ],
                    borderColor: [
                        isDark ? 'rgb(31, 41, 55)' : '#fff',
                        isDark ? 'rgb(31, 41, 55)' : '#fff'
                    ],
                    borderWidth: 3,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: textColor,
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            padding: 15
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.parsed || 0;
                                return context.label + ': Rp ' + value.toLocaleString('id-ID');
                            }
                        }
                    }
                }
            }
        });
    }
    
    // Chart 3: Bar Chart - Kategori Pemasukan
    const ctx3 = document.getElementById('chartCategoryPemasukan');
    if (ctx3 && categoryData.pemasukan.labels.length > 0) {
        const colors = [
            'rgb(34, 197, 94)', 'rgb(59, 130, 246)', 'rgb(139, 92, 246)',
            'rgb(236, 72, 153)', 'rgb(249, 115, 22)', 'rgb(6, 182, 212)',
            'rgb(168, 85, 247)', 'rgb(244, 114, 182)', 'rgb(75, 192, 192)', 'rgb(107, 114, 128)'
        ];
        
        const bgColors = categoryData.pemasukan.labels.map((_, i) => {
            const c = colors[i % colors.length];
            return c.replace('rgb', 'rgba').replace(')', ', 0.7)');
        });
        
        const borderColors = categoryData.pemasukan.labels.map((_, i) => colors[i % colors.length]);
        
        new Chart(ctx3, {
            type: 'bar',
            data: {
                labels: categoryData.pemasukan.labels,
                datasets: [{
                    label: 'Jumlah Pemasukan',
                    data: categoryData.pemasukan.data,
                    backgroundColor: bgColors,
                    borderColor: borderColors,
                    borderWidth: 2,
                    borderRadius: 5,
                    hoverBackgroundColor: borderColors
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: textColor,
                            font: { size: 12, weight: 'bold' }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { color: gridColor, drawBorder: false },
                        ticks: {
                            color: textColor,
                            callback: function(v) { return 'Rp ' + v.toLocaleString('id-ID'); }
                        }
                    },
                    y: {
                        grid: { display: false, drawBorder: false },
                        ticks: { color: textColor }
                    }
                }
            }
        });
    }
    
    // Chart 4: Bar Chart - Kategori Pengeluaran
    const ctx4 = document.getElementById('chartCategoryPengeluaran');
    if (ctx4 && categoryData.pengeluaran.labels.length > 0) {
        const colors = [
            'rgb(239, 68, 68)', 'rgb(249, 115, 22)', 'rgb(234, 179, 8)',
            'rgb(236, 72, 153)', 'rgb(168, 85, 247)', 'rgb(139, 92, 246)',
            'rgb(59, 130, 246)', 'rgb(6, 182, 212)', 'rgb(20, 184, 166)', 'rgb(244, 114, 182)'
        ];
        
        const bgColors = categoryData.pengeluaran.labels.map((_, i) => {
            const c = colors[i % colors.length];
            return c.replace('rgb', 'rgba').replace(')', ', 0.7)');
        });
        
        const borderColors = categoryData.pengeluaran.labels.map((_, i) => colors[i % colors.length]);
        
        new Chart(ctx4, {
            type: 'bar',
            data: {
                labels: categoryData.pengeluaran.labels,
                datasets: [{
                    label: 'Jumlah Pengeluaran',
                    data: categoryData.pengeluaran.data,
                    backgroundColor: bgColors,
                    borderColor: borderColors,
                    borderWidth: 2,
                    borderRadius: 5,
                    hoverBackgroundColor: borderColors
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: textColor,
                            font: { size: 12, weight: 'bold' }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        grid: { color: gridColor, drawBorder: false },
                        ticks: {
                            color: textColor,
                            callback: function(v) { return 'Rp ' + v.toLocaleString('id-ID'); }
                        }
                    },
                    y: {
                        grid: { display: false, drawBorder: false },
                        ticks: { color: textColor }
                    }
                }
            }
        });
    }
});
</script>
@endsection