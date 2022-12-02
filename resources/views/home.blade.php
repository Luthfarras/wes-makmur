@extends('template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @foreach ($data as $post)
        <div class="col-md-4 mb-2 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->judul }}</h5>
                    <footer class="blockquote-footer mt-2">
                        <i>by {{ $post->user->name }}</i>
                        <p class="text-secondary">{{ $post->tanggalDibuat }}</p>
                    </footer>
                    <p class="card-text">{{ Str::limit($post->isi, 100) }}<a href="detail/{{ $post->id }}">Read More</a></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $data->links() }}
</div>
@endsection
