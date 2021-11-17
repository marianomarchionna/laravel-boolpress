@extends('layouts.dashboard')

@section('content')

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Slug</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td scope="row">{{ $tag['id'] }}</td>
                    <td>{{ $tag['name'] }}</td>
                    <td>{{ $tag['slug'] }}</td>
                    <td>
                        <a href="{{ route('admin.tags.show', $tag->slug) }}"
                            class="btn btn-info">
                            Details
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection