@extends('layouts.template')
@section('konten')
<div class="row">
    <div class="col-md-12">
        <h2>Tambah Produk</h2>
        <br>
        <a href="{{ url('product') }}" class="btn btn-secondary"><--Kembali</a>
        <form action="/product" method="post" enctype="multipart/form-data">
            @csrf
            @method('post')
            <div class="mb-3">
                <label for="product_name">Nama Produk</label>
                <input type="text" class="form-control" name="product_name" placeholder="Masukkan Nama Produk">
            </div>
            <div class="mb-3">
                <label for="photo">Foto Produk</label>
                <input type="file" class="form-control" name="photo" placeholder="Pilih">
            </div>
            <div class="mb-3">
                <label for="description">Deskripsi Produk</label>
                <textarea name="description" id="" cols="30" rows="10" placeholder="Masukkan Deskripsi Produk" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label for="price">Harga Produk</label>
                <input type="number" class="form-control" name="price" placeholder="Masukkan Harga Produk">
            </div>
            <div class="mb-3">
                <label for="product_name">Jumlah Produk</label>
                <input type="number" class="form-control" name="stock" placeholder="Masukkan Jumlah Produk">
            </div>
            <div class="mb-3">
                <label for="seller_name">Penjual</label>
                <input type="text" class="form-control" name="seller" placeholder="Masukkan Penjual">
                {{-- <select class="form-control" name="seller_id" id="" placeholder="">
                    <option value="" selected disabled>Pilih Penjual</option>
                    @foreach ($seller as $sell)
                        <option value="{{ $sell->id }}">{{$sell->seller_name}}</option>
                    @endforeach
                </select> --}}
            </div>
            <div class="mb-3">
                <label for="category">Kategori</label>
                <select class="form-control" name="category_id" id="">
                    <option value="" selected disabled>Pilih Kategori</option>
                    @foreach ($category as $kt)
                        <option value="{{ $kt->id }}">{{$kt->category_name}}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit" value="Simpan" class="btn btn-md btn-success">
        </form>
    </div>
</div>
@endsection
