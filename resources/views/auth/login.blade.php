@extends('base')

@section('content')
    <h1>Se connecter</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <form action="{{ route('login') }}" method="post" class="vstack gap-3">
                @csrf
                <div class="form-group">
                    <label for="title">Email:</label>
                    <input class="form-control" type="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe:</label>
                    <input class="form-control" type="text" name="password">
                </div>

                <button class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </div>
@endsection
