<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    // Tampilkan semua transaksi
    public function index()
    {
        $transaksi = Auth::user()->transaksi()->orderBy('tanggal', 'desc')->get();
        
        // Hitung total pemasukan dan pengeluaran
        $totalPemasukan = $transaksi->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $transaksi->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('transaksi.index', compact('transaksi', 'totalPemasukan', 'totalPengeluaran', 'saldo'));
    }

    // Tampilkan form tambah transaksi
    public function create()
    {
        return view('transaksi.create');
    }

    // Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        Auth::user()->transaksi()->create([
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    // Tampilkan form edit transaksi
    public function edit($id)
    {
        $transaksi = Auth::user()->transaksi()->findOrFail($id);
        return view('transaksi.edit', compact('transaksi'));
    }

    // Update transaksi
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'kategori' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $transaksi = Auth::user()->transaksi()->findOrFail($id);
        $transaksi->update([
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'kategori' => $request->kategori,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate!');
    }

    // Hapus transaksi
    public function destroy($id)
    {
        $transaksi = Auth::user()->transaksi()->findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus!');
    }

    // Tampilkan laporan
    public function laporan()
    {
        $transaksi = Auth::user()->transaksi()->orderBy('tanggal', 'desc')->get();
        
        $totalPemasukan = $transaksi->where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = $transaksi->where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('transaksi.laporan', compact('transaksi', 'totalPemasukan', 'totalPengeluaran', 'saldo'));
    }
}