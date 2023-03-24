@extends('layouts.template')
@section('konten')
<div class="row">
    <div class="col-md-12">
        <h2>Tambah Kategori</h2>
        <br>
        <a href="{{ url('category') }}" class="btn btn-secondary"><--Kembali</a>
        <form action="/category" method="post">
            @csrf
            @method('post')
            <div class="mb-3">
                <label for="category_name">Nama Kategori</label>
                <input type="text" class="form-control" name="category_name" placeholder="Masukkan Nama Kategori">
            </div>
            <input type="submit" value="Simpan" class="btn btn-md btn-success">
        </form>
    </div>
</div>
@endsection
