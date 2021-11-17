@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Visualizzazione post {{ $post->id }}</h1>
                <h2>{{ $post->title }}</h2>
                <p>{!! $post->content !!}</p>

                <small>Lo slug è: {{ $post->slug }}</small><br>
                <small>Categoria di appartenenza: <a href="{{ route('admin.categories.show', $post->category->slug) }}">{{ $post->category->name }}</a></small><br>
                
                <small>Tag di appartenenza: 
                    @foreach ($post->tags as $tag)
                        <a href="{{ route('admin.tags.show', $tag->slug) }}">
                            @if ($loop->last)
                                {{ $tag->name }}
                            @else
                                {{ $tag->name . ','}}
                            @endif
                        </a>
                    @endforeach
                </small>
            </div>
        </div>
    </div>
@endsection