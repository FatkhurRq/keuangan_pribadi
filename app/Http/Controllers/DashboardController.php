<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transaksi = $user->transaksi()->latest()->take(5)->get();
        
        $totalPemasukan = $user->transaksi()->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $user->transaksi()->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        // Data untuk grafik 12 bulan terakhir
        $chartData = $this->getMonthlyChartData($user);
        
        // Data untuk grafik kategori
        $categoryData = $this->getCategoryChartData($user);

        return view('dashboard', compact('transaksi', 'totalPemasukan', 'totalPengeluaran', 'saldo', 'chartData', 'categoryData'));
    }

    private function getMonthlyChartData($user)
    {
        $months = [];
        $pemasukan = [];
        $pengeluaran = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->locale('id')->format('M Y');

            $pemasukanBulan = $user->transaksi()
                ->where('jenis', 'pemasukan')
                ->whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->sum('jumlah');

            $pengeluaranBulan = $user->transaksi()
                ->where('jenis', 'pengeluaran')
                ->whereYear('tanggal', $date->year)
                ->whereMonth('tanggal', $date->month)
                ->sum('jumlah');

            $pemasukan[] = $pemasukanBulan;
            $pengeluaran[] = $pengeluaranBulan;
        }

        return [
            'months' => $months,
            'pemasukan' => $pemasukan,
            'pengeluaran' => $pengeluaran
        ];
    }

    private function getCategoryChartData($user)
    {
        // Data kategori pemasukan
        $pemasukanByCategory = $user->transaksi()
            ->where('jenis', 'pemasukan')
            ->selectRaw('kategori, SUM(jumlah) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori')
            ->toArray();

        // Data kategori pengeluaran
        $pengeluaranByCategory = $user->transaksi()
            ->where('jenis', 'pengeluaran')
            ->selectRaw('kategori, SUM(jumlah) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori')
            ->toArray();

        return [
            'pemasukan' => [
                'labels' => array_keys($pemasukanByCategory),
                'data' => array_values($pemasukanByCategory)
            ],
            'pengeluaran' => [
                'labels' => array_keys($pengeluaranByCategory),
                'data' => array_values($pengeluaranByCategory)
            ]
        ];
    }
}