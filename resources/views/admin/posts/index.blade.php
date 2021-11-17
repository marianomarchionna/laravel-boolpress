@extends('layouts.dashboard')

@section('content')

    @if (session('inserted'))
        <div class="alert alert-success">
            {{ session('inserted') }}
        </div>
    @endif

    @if (session('updated'))
        <div class="alert alert-primary">
            {{ session('updated') }}
        </div>
    @endif

    @if (session('deleted'))
        <div class="alert alert-danger">
            {{ session('deleted') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Category</th>
            <th scope="col">Tags</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td scope="row">{{ $post['id'] }}</td>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['slug'] }}</td>
                    <td>
                        @if ($post->category)
                            {{ $post->category->name }}
                        @endif
                    </td>
                    <td>
                        @if ($post->tags)
                            @foreach ($post->tags as $tag)
                                @if ($loop->last)
                                    {{ $tag->name }}
                                @else
                                    {{ $tag->name . ','}}
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.posts.show', $post->slug) }}"
                            class="btn btn-info">
                            Details
                        </a>
                        <a href="{{ route('admin.posts.edit', $post->slug) }}"
                            class="btn btn-warning">
                            Modify
                        </a>
                        <form class="d-inline-block delete-post" method="post" action="{{ route('admin.posts.destroy', $post->slug) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection