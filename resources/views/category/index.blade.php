@extends('layouts.template')
@section('konten')
<div class="row">
    <div class="col-md-12">
        <h2>Halaman Daftar Kategori</h2>
        <br>
        <a href="{{ url('product') }}" class="btn btn-secondary"><--Kembali</a>
        <a href="category/create" class="btn btn-md btn-success">Tambah Kategori</a>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Option</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($data as $dt)
                    <tr>
                      <th scope="row">1</th>
                        <td>
                            {{$dt->category_name}}
                        </td>
                      <td>
                        <form action="/category/{{$dt->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="/category/{{$dt->id}}/edit" class="btn btn-md btn-warning mr-2">Edit</a>
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
