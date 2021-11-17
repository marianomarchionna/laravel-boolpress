@extends('layouts.app')

@section('content')
    <ul>
        @foreach ($posts as $post)
            <li><a href="{{ route('show', $post->slug) }}">{{ $post->title }}</a></li>
        @endforeach
    </ul>
@endsection