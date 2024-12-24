@extends('layouts.layout')

@section('content')
<div class="container">
    <h2>Perbandingan Kriteria AHP</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('ahp.store') }}" method="POST">
        @csrf

        <!-- Dropdown Kriteria 1 -->
        <div class="form-group">
            <label for="kriteria_1">Kriteria 1</label>
            <select class="form-control" id="kriteria_1" name="kriteria_1" required>
                @foreach($kriteria as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kriteria }}</option>
                @endforeach
            </select>
        </div>

        <!-- Dropdown Kriteria 2 -->
        <div class="form-group">
            <label for="kriteria_2">Kriteria 2</label>
            <select class="form-control" id="kriteria_2" name="kriteria_2" required>
                @foreach($kriteria as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kriteria }}</option>
                @endforeach
            </select>
        </div>

        <!-- Input untuk nilai perbandingan -->
        <div class="form-group">
            <label for="nilai">Nilai Perbandingan</label>
            <input type="number" class="form-control" id="nilai" name="nilai" min="1" step="0.1" required>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary">Simpan Perbandingan</button>
    </form>

    <!-- Tombol untuk menghitung bobot AHP -->
    <a href="{{ route('ahp.hitung') }}" class="btn btn-success mt-3">Hitung Bobot AHP</a>
</div>
@endsection
