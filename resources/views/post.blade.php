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
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Tanggal</th>
                    @if (Auth::user()->role == 'admin')
                    <th>Status</th>
                    @endif
                    <th>Kategori</th>
                    <th>Editor</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $post)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $post->judul }}</td>
                        <td>{{ $post->isi }}</td>
                        <td>{{ $post->tanggalDibuat }}</td>
                        @if (Auth::user()->role == 'admin')
                        <td>{{ $post->status }}</td>
                        @endif
                        <td>{{ $post->kategori->namaKategori }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>
                            <div class="d-flex">
                                @if (Auth::user()->role == 'admin')
                                <a href="akses/{{ $post->id }}" class="btn btn-outline-success m-1" style="border-radius: 50px">Kelola</a>
                                @endif
                                <button type="button" class="btn btn-outline-warning m-1" style="border-radius: 50px"
                                data-bs-toggle="modal" data-bs-target="#edit{{ $post->id }}">
                                Edit
                            </button>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger m-1" style="border-radius: 50px"
                                type="submit">Hapus</button>
                            </form>
                        </div>
                        </td>
                    </tr>
                    <!-- Modal Edit -->
                    <div class="modal fade" id="edit{{ $post->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Post</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('post.update', $post->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3">
                                            <label for="" class="form-label">Judul</label>
                                            <input type="text" class="form-control" name="judul" value="{{ $post->judul }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Isi</label>
                                            <textarea name="isi" class="form-control" id="" cols="30" rows="5">{{ $post->isi }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Tanggal Postingan</label>
                                            <input type="date" class="form-control" name="tanggalDibuat" value="{{ $post->tanggalDibuat }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Kategori</label>
                                            <select name="kategori_id" class="form-select" id="">
                                                @foreach ($kategori as $item)
                                                    <option value="{{ $item->id }}" @if($post->kategori_id == $item->id) @selected($post->kategori_id == $item->id) @endif>{{ $item->namaKategori }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Editor</label>
                                            <input type="text" disabled value="{{ Auth::user()->name }}" class="form-control">
                                        </div>
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">                
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Post</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Isi</label>
                            <textarea name="isi" class="form-control" id="" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Postingan</label>
                            <input type="date" class="form-control" name="tanggalDibuat">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Kategori</label>
                            <select name="kategori_id" class="form-select" id="">
                                @foreach ($kategori as $item)
                                    <option value="{{ $item->id }}">{{ $item->namaKategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Editor</label>
                            <input type="text" disabled value="{{ Auth::user()->name }}" class="form-control">
                        </div>
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
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
