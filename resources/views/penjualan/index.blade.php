@extends('layouts.app')

@section('title', 'Penjualan')

@section('content')
<div class="bg-blue-500 text-white p-4 flex justify-between items-center">
    <div class="text-lg font-bold">PENJUALAN <span class="text-sm font-light">LIST</span></div>
    <div class="flex items-center">
        <i class="fas fa-user mr-2"></i> Kasir
    </div>
</div>
<div class="p-4">
    <div class="bg-white p-4 rounded shadow">
        <div class="flex justify-between items-center mb-4">
            <div>
                <label>Show 
                    <select class="border border-gray-300 rounded p-1">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select> entries
                </label>
            </div>
            <a href="{{ route('penjualan.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Penjualan</a>
        </div>
        <div class="flex justify-between items-center mb-4">
            <div></div>
            <div>
                <label>Search: <input type="text" class="border border-gray-300 rounded p-1"></label>
            </div>
        </div>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">No.</th>
                    <th class="py-2 px-4 border-b">Kode Penjualan</th>
                    <th class="py-2 px-4 border-b">Tanggal</th>
                    <th class="py-2 px-4 border-b">Nama Pelanggan</th>
                    <th class="py-2 px-4 border-b">Nama Kasir</th>
                    <th class="py-2 px-4 border-b">Jumlah Barang</th>
                    <th class="py-2 px-4 border-b">Total</th>
                    <th class="py-2 px-4 border-b">Lihat/Hapus</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualans as $penjualan)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $loop->iteration }}</td>
                    <td class="py-2 px-4 border-b">{{ $penjualan->kode_penjualan }}</td>
                    <td class="py-2 px-4 border-b">{{ $penjualan->tanggal }}</td>
                    <td class="py-2 px-4 border-b">{{ $penjualan->nama_pelanggan }}</td>
                    <td class="py-2 px-4 border-b">{{ $penjualan->nama_kasir }}</td>
                    <td class="py-2 px-4 border-b">{{ $penjualan->jumlah_barang }}</td>
                    <td class="py-2 px-4 border-b">{{ $penjualan->total }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('penjualan.show', $penjualan->id) }}" class="text-blue-500"><i class="fas fa-eye"></i> Lihat</a> 
                        <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="flex justify-between items-center mt-4">
            <div>Showing {{ $penjualans->firstItem() }} to {{ $penjualans->lastItem() }} of {{ $penjualans->total() }} entries</div>
            <div class="flex items-center">
                {{ $penjualans->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
