@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{ $user->name }}</h2>

                <p>La mail è: {{ $user->email }}</p>
            </div>
        </div>
    </div>
@endsection