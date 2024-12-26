@extends('layouts.layout')

@section('content')
<div class="container">
    <h1>Tambah User</h1>
    <form action="{{ route('user.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="admin">Admin</option>
                <option value="karyawan">karyawan</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </form>
</div>
@endsection