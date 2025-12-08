<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $transaksi = $user->transaksi()->latest()->take(5)->get();
        
        $totalPemasukan = $user->transaksi()->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $user->transaksi()->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('dashboard', compact('transaksi', 'totalPemasukan', 'totalPengeluaran', 'saldo'));
    }
}