@extends('layouts.template')
@section('konten')
<div class="row">
    <div class="col-md-12">
        <h2>Edit Produk</h2>
        <br>
        <a href="{{ url('product') }}" class="btn btn-secondary"><--Kembali</a>
        <form action="/produk/{{$data->id}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="product_name">Nama Produk</label>
                <input type="text" class="form-control" name="product_name" value="{{ $data->product_name }}" placeholder="Masukkan Nama Produk">
            </div>
            <div class="mb-3">
                <label for="photo">Foto Produk</label>
                <input type="file" class="form-control" name="photo" placeholder="Pilih">
            </div>
            <div class="mb-3">
                <label for="description">Deskripsi Produk</label>
                <textarea name="description" id="" cols="30" rows="10" placeholder="Masukkan Deskripsi Produk" class="form-control"> {{ $data->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="product_name">Harga Produk</label>
                <input type="number" class="form-control" name="price" placeholder="Masukkan Harga Produk" value="{{ $data->price }}">
            </div>
            <div class="mb-3">
                <label for="product_name">Jumlah Produk</label>
                <input type="number" class="form-control" name="stock" placeholder="Masukkan Jumlah Produk" value="{{ $data->stock }}">
            </div>
            <div class="mb-3">
                <label for="product_name">Penjual</label>
                <select class="form-control" name="seller_id" id="" placeholder="">
                    @foreach ($seller as $sell)
                        <option   @if ($sell->name == $data->name) selected @endif value="{{ $sell->id }}">{{$sell->name}}  @if ($sell->name == $data->name) (Terpilih) @endif</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="category">Kategori</label>
                <select class="form-control" name="category_id" id="">
                    @foreach ($category as $kt)
                        <option value="{{ $kt->id }}" @if ($kt->category_name == $data->category_name) selected @endif>{{$kt->nama_kategori}} @if ($kt->category_name == $data->category_name) (Terpilih) @endif</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Simpan" class="btn btn-md btn-success">
        </form>
    </div>
</div>
@endsection
