@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
<h1>Laporan Keuangan</h1>

<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin: 20px 0;">
    <div class="card" style="text-align: center;">
        <h3>Total Pemasukan</h3>
        <h2 style="color: #28a745;">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h2>
    </div>
    <div class="card" style="text-align: center;">
        <h3>Total Pengeluaran</h3>
        <h2 style="color: #dc3545;">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h2>
    </div>
    <div class="card" style="text-align: center;">
        <h3>Saldo Akhir</h3>
        <h2 style="color: {{ $saldo >= 0 ? '#28a745' : '#dc3545' }};">Rp {{ number_format($saldo, 0, ',', '.') }}</h2>
    </div>
</div>

<div class="card">
    <h3>Detail Transaksi</h3>
    @if($transaksi->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $t)
                <tr>
                    <td>{{ $t->tanggal->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($t->jenis) }}</td>
                    <td>{{ $t->kategori }}</td>
                    <td>{{ $t->keterangan ?? '-' }}</td>
                    <td style="color: {{ $t->jenis == 'pemasukan' ? '#28a745' : '#dc3545' }}; font-weight: bold;">
                        {{ $t->jenis == 'pemasukan' ? '+' : '-' }} Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr style="background: #f8f9fa; font-weight: bold;">
                    <td colspan="4" style="text-align: right;">SALDO AKHIR:</td>
                    <td style="color: {{ $saldo >= 0 ? '#28a745' : '#dc3545' }};">
                        Rp {{ number_format($saldo, 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        </table>
    @else
        <p>Belum ada transaksi untuk dilaporkan.</p>
    @endif
</div>
@endsection