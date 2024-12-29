@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Produk Terlaris (Metode AHP dan SAW)</h1>

    <h3>Bobot Kriteria (AHP):</h3>
    <ul class="list-group mb-4">
        <li class="list-group-item">Jumlah Terjual: <strong>{{ $bobot['jumlah'] }}</strong></li>
        <li class="list-group-item">Harga Jual: <strong>{{ $bobot['harga_satuan'] }}</strong></li>
    </ul>

    <h3>Hasil Perhitungan (SAW):</h3>
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah Terjual</th>
                <th>Harga Jual</th>
                <th>Normalisasi Jumlah</th>
                <th>Normalisasi Harga</th>
                <th>Skor Akhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $p)
            <tr>
                <td>{{ $p['nama_brg'] }}</td>
                <td>{{ $p['jumlah'] }}</td>
                <td>Rp {{ number_format($p['harga_satuan'], 2, ',', '.') }}</td>
                <td>{{ round($p['normalisasi_jumlah'], 4) }}</td>
                <td>{{ round($p['normalisasi_harga'], 4) }}</td>
                <td><strong>{{ round($p['skor'], 4) }}</strong></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Produk Paling Laris:</h3>
    <p><strong>{{ $produk[0]['nama_brg'] }}</strong> dengan skor <strong>{{ round($produk[0]['skor'], 4) }}</strong>.
    </p>
</div>
@endsection