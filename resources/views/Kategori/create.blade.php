@extends('layouts.layout')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('kategori.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Kategori</label>
                                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                    name="nama_kategori" value="{{ old('nama_kategori') }}"
                                    placeholder="Masukkan kategori">

                                <!-- error message untuk kategori -->
                                @error('nama_kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection