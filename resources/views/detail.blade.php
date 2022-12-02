@extends('template')
@section('content')
    <div class="container">
        <a href="/" class="btn btn-outline-info" style="border-radius: 50px">Kembali</a>
        <div class="row justify-content-center">
            <div class="col-lg-8 mb-5">
                <div class="card">
                    <div class="card-header">{{ $post->tanggalDibuat }} <span class="badge bg-dark">{{ $post->kategori->namaKategori }}</span></div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->judul }}</h5>
                        <footer class="blockquote-footer mt-2">
                            <i>by {{ $post->user->name }}</i>
                        </footer>
                        <p class="card-text">{{ $post->isi }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <h5 class="text-center p-4">Rekomendasi Produk untuk Anda</h5>
            @foreach ($data as $produk)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ asset('storage/' . $produk->foto) }}" class="card-img-top" alt="" srcset="">
                        <div class="card-body">
                            <h5 class="card-title">{{ $produk->namaProduk }}</h5>
                            <p class="text-secondary">{{ $produk->harga }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
