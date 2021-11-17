@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Creazione nuovo post</h1>
                
                <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="title">Titolo</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="content">Contenuto</label>
                        <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- inserimento cover post --}}
                    <div class="form-group">
                        <label class="d-block" for="image">Immagine di copertina</label>
                        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- fine inserimento cover post --}}

                    <div class="form-group">
                        <label for="category_id">Categoria</label>
                        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
                            <option value="">-- Seleziona la categoria --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : null }}
                                    >{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <p>Seleziona i tag:</p>
                        @foreach ($tags as $tag)
                            <div class="form-check form-check-inline">
                                <input 
                                {{ in_array($tag->id, old('tags', [])) ? 'checked' : null }}
                                value="{{ $tag->id }}" id="{{ 'tag' . $tag->id }}" type="checkbox" name="tags[]" class="form-check-input">
                                <label for="{{ 'tag' . $tag->id }}" class="form-check-label">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Crea nuovo post</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection