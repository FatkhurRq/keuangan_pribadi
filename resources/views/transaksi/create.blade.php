@extends('layouts.app')

@section('title', 'Tambah Transaksi')

@section('content')
<h1>Tambah Transaksi</h1>

<div class="card">
    <form action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Jenis Transaksi:</label>
            <select name="jenis" required>
                <option value="">Pilih Jenis</option>
                <option value="pemasukan" {{ old('jenis') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                <option value="pengeluaran" {{ old('jenis') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
        </div>
        <div class="form-group">
            <label>Jumlah:</label>
            <input type="number" name="jumlah" value="{{ old('jumlah') }}" step="0.01" required>
        </div>
        <div class="form-group">
            <label>Kategori:</label>
            <input type="text" name="kategori" value="{{ old('kategori') }}" required>
        </div>
        <div class="form-group">
            <label>Keterangan:</label>
            <textarea name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
        </div>
        <div class="form-group">
            <label>Tanggal:</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('transaksi.index') }}" class="btn">Batal</a>
    </form>
</div>
@endsection