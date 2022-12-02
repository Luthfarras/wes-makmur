@extends('template')
@section('content')
    <div class="container">
        <button type="button" class="btn btn-outline-primary" style="border-radius: 50px" data-bs-toggle="modal"
            data-bs-target="#add">
            Tambah +
        </button>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Foto</th>
                    <th>Harga</th>
                    <th>Deskripsi</th>
                    @if (Auth::user()->role == 'admin')
                    <th>Status</th>
                    @endif
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $produk)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $produk->namaProduk }}</td>
                        <td><img src="{{ asset('storage/' .$produk->foto) }}" alt="" srcset="" width="100px"></td>
                        <td>{{ $produk->harga }}</td>
                        <td>{{ $produk->descProduk }}</td>
                        @if (Auth::user()->role == 'admin')
                        <td>{{ $produk->status }}</td>
                        @endif
                        <td>{{ $produk->kategori->namaKategori }}</td>
                        <td>
                            <div class="d-flex">
                                @if (Auth::user()->role == 'admin')
                                <a href="aksespro/{{ $produk->id }}" class="btn btn-outline-success m-1" style="border-radius: 50px">Kelola</a>
                                @endif
                                <button type="button" class="btn btn-outline-warning m-1" style="border-radius: 50px"
                                data-bs-toggle="modal" data-bs-target="#edit{{ $produk->id }}">
                                Edit
                            </button>
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger m-1" style="border-radius: 50px"
                                type="submit">Hapus</button>
                            </form>
                        </div>
                        </td>
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="edit{{ $produk->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah produk</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('produk.update', $produk->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nama produk</label>
                                            <input type="text" class="form-control" name="namaProduk" value="{{ $produk->namaProduk }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Harga</label>
                                            <input type="number" class="form-control" name="harga" value="{{ $produk->harga }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Deskripsi</label>
                                            <textarea name="descProduk" class="form-control" id="" cols="30" rows="5">{{ $produk->descProduk }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Kategori</label>
                                            <select name="kategori_id" class="form-select" id="">
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id }}" @if($produk->kategori_id == $item->id) @selected($produk->kategori_id == $item->id) @endif>{{ $item->namaKategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-secondary" style="border-radius: 50px"
                                        data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit" class="btn btn-outline-success"
                                        style="border-radius: 50px">Ubah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Add-->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah produk</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control" name="namaProduk">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea name="descProduk" class="form-control" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select" id="">
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->namaKategori }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" style="border-radius: 50px"
                        data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-outline-success" style="border-radius: 50px">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
