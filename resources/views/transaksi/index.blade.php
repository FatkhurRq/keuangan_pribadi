@extends('layouts.app')

@section('title', 'Daftar Transaksi')

@section('content')
<h1>Daftar Transaksi</h1>

<a href="{{ route('transaksi.create') }}" class="btn btn-success">Tambah Transaksi</a>

<div class="card">
    @if($transaksi->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jenis</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $t)
                <tr>
                    <td>{{ $t->tanggal->format('d/m/Y') }}</td>
                    <td>{{ ucfirst($t->jenis) }}</td>
                    <td>{{ $t->kategori }}</td>
                    <td>{{ $t->keterangan ?? '-' }}</td>
                    <td style="color: {{ $t->jenis == 'pemasukan' ? '#28a745' : '#dc3545' }};">
                        Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                    </td>
                    <td>
                        <a href="{{ route('transaksi.edit', $t->id) }}" class="btn" style="padding: 5px 10px;">Edit</a>
                        <form action="{{ route('transaksi.destroy', $t->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="padding: 5px 10px;" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada transaksi.</p>
    @endif
</div>
@endsection