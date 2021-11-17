@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{ $category->name }}</h2>

                <small>Lo slug è: {{ $category->slug }}</small>
            </div>
            <div class="col-12 m-5">
                <h2>Lista dei post collegati alla categoria {{ $category->name }}</h2>
                <ul>
                    @forelse ($category->posts as $post)
                        <li><a href="{{ route('admin.posts.show', $post->slug) }}">{{ $post->title }}</a></li>
                    @empty
                        <p>Nessun post collegato a questa categoria</p>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endsection