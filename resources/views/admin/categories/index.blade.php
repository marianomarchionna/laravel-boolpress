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
            @foreach ($categories as $category)
                <tr>
                    <td scope="row">{{ $category['id'] }}</td>
                    <td>{{ $category['name'] }}</td>
                    <td>{{ $category['slug'] }}</td>
                    <td>
                        <a href="{{ route('admin.categories.show', $category->slug) }}"
                            class="btn btn-info">
                            Details
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection