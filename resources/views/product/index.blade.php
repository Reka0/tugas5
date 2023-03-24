@extends('layouts.template')
@section('konten')
<div class="row">
    <div class="col-md-12">
        <h2>Halaman Daftar Produk</h2>
        <br>
        <a href="product/create" class="btn btn-md btn-success">Tambah Produk</a>
        <a href='{{ url('keranjang') }}' class="btn btn-primary">Keranjang</a>
        <a href='{{ url('category') }}' class="btn btn-warning">Kategori</a>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Foto Produk</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Harga Produk</th>
                <th scope="col">Jumlah Produk</th>
                <th scope="col">Penjual</th>
                <th scope="col">Kategori</th>
                <th scope="col">Option</th>
              </tr>
            </thead>
            <tbody>
                @php
                    $nomor = 1;
                @endphp
                @foreach ($data as $dt)
                    <tr>
                      <th scope="row">{{$nomor++}}</th>
                        <td>
                            <img src="{{ asset('storage/'.$dt->photo)}}" style="max-height: 50px" alt="">
                        </td>
                        <td>
                            {{$dt->product_name}}
                        </td>
                        <td>
                            {{$dt->price}}
                        </td>
                        <td>
                            {{$dt->stock}}
                        </td>
                        <td>
                            {{$dt->seller}}
                        </td>
                        <td>
                            {{$dt->category_name}}
                        </td>
                      <td>
                        <form action="/produk/{{$dt->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="/produk/{{$dt->id}}/edit" class="btn btn-md btn-warning mr-2">Edit</a>
                            <input class="btn btn-md btn-danger" type="submit" value="Hapus">
                        </form>
                      </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
    </div>
</div>
@endsection
