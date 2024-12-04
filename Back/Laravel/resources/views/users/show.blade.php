@extends('layouts.app')


@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Detalls de l'usuari</h1>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Nom: {{ $user->nom }}</h5>
                <p class="card-text">Cognom1: {{ $user->cognom1 }}</p>
                <p class="card-text">Cognom2: {{ $user->cognom2 }}</p>
                <p class="card-text">Email: {{ $user->email }}</p>
                <p class="card-text">Role: {{ $user->rol }}</p>
                <p class="card-text">Data Naixement: {{ $user->data_naixement }}</p>
                <p class="card-text">Telefon: {{ $user->telefon }}</p>
                <p class="card-text">Biografia: {{ $user->biografia }}</p>
            </div>
        </div>

        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar</a>
    </div>
@endsection
