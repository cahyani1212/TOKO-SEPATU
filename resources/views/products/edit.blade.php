@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Produk</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_produk">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $product->nama_produk) }}">
            </div>

            <!-- Tambahkan input lainnya seperti deskripsi_produk, harga_produk, dll -->

            <button type="submit" class="btn btn-primary">Update Produk</button>
        </form>
    </div>
@endsection
