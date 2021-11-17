@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Contatti</h1>
                <form action="{{ route('contacts.send') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nome</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Messaggio</label>
                        <input type="message" name="message" id="message" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Invia" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection