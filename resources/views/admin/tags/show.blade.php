@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{ $tag->name }}</h2>

                <small>Lo slug è: {{ $tag->slug }}</small>
            </div>
            <div class="col-12 m-5">
                <h2>Lista dei post collegati al tag {{ $tag->name }}</h2>
                <ul>
                    @forelse ($tag->posts as $post)
                        <li><a href="{{ route('admin.posts.show', $post->slug) }}">{{ $post->title }}</a></li>
                    @empty
                        <p>Nessun post collegato a questo tag</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection