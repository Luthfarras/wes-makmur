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
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $kategori)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kategori->namaKategori }}</td>
                        <td>{{ $kategori->descKategori }}</td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-outline-warning mx-2" style="border-radius: 50px"
                                data-bs-toggle="modal" data-bs-target="#edit{{ $kategori->id }}">
                                Edit
                            </button>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger" style="border-radius: 50px"
                                    type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="edit{{ $kategori->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Kategori</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('kategori.update', $kategori->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="" class="form-label">Nama Kategori</label>
                                            <input type="text" class="form-control" name="namaKategori" value="{{ $kategori->namaKategori }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Deskripsi</label>
                                            <textarea name="descKategori" class="form-control" id="" cols="30" rows="5">{{ $kategori->descKategori }}</textarea>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" name="namaKategori">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Deskripsi</label>
                            <textarea name="descKategori" class="form-control" id="" cols="30" rows="5"></textarea>
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
