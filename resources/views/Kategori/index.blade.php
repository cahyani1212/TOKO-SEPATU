@extends('layouts.layout')

@section('content')
<div class="p-6">
<div class="bg-gradient-to-r from-red-700 to-gray-900 text-white p-6 rounded-lg mb-8 shadow-xl">
                <h1 class="text-3xl font-extrabold text-center">Selamat Datang di Upik Cabon Store</h1>
                <p class="text-center text-gray-300 mt-2">Pantau stok barang dengan mudah dan cepat!</p>
            </div>
    <div class="card border-0 shadow-lg rounded-lg overflow-hidden">
        <div class="card-body bg-white p-6">
            <a href="{{ route('kategori.create') }}" class="inline-flex items-center justify-center btn btn-md mb-3 bg-gradient-to-r from-red-700 to-gray-900 text-white p-3 rounded-lg shadow-md hover:scale-105 transform transition-transform duration-300">
                <i class="fas fa-plus mr-2"></i>TAMBAH KATEGORI
            </a>
            @if($kategori->isEmpty())
                <div class="alert alert-danger text-center py-4 rounded-lg shadow-md">Data kategori belum tersedia.</div>
            @else
                <div class="overflow-x-auto">
                    <table class="table-auto w-full border-collapse border border-gray-300 shadow-sm rounded-lg overflow-hidden">
                        <thead>
                            <tr class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                                <th scope="col" class="px-4 py-2 text-center">NO</th>
                                <th scope="col" class="px-4 py-2 text-center">NAMA KATEGORI</th>
                                <th scope="col" class="px-4 py-2 text-center" style="width: 20%">AKTIVITAS</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($kategori as $index => $k)
                                <tr class="border-t border-gray-300 hover:bg-gray-100 transition-colors duration-200">
                                    <td class="px-4 py-2 text-center font-medium text-gray-700">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2 text-gray-600">{{ $k->nama_kategori }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('kategori.destroy', $k->id) }}" method="POST">
                                            <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-sm bg-blue-500 text-white py-1 px-3 rounded-full shadow hover:bg-blue-600 transition duration-200">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm bg-red-500 text-white py-1 px-3 rounded-full shadow hover:bg-red-600 transition duration-200">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'BERHASIL',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @elseif(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'GAGAL!',
            text: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection
