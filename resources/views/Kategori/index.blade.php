@extends('layouts.index')

@section('content')
<div class="container">
    <h3 class="text-center my-4">Kategori</h3>
    <div class="card border-0 shadow-sm rounded">
        <div class="card-body">
            <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success mb-3">TAMBAH KATEGORI</a>
            @if($kategori->isEmpty())
                <div class="alert alert-danger">Data Products belum tersedia.</div>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">NAMA KATEGORI</th>
                            <th scope="col" style="width: 20%">AKTIVITAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $index => $k)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $k->nama_kategori }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda yakin?');" action="{{ route('kategori.destroy', $k->id) }}" method="POST">
                                        <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
