@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Detalls de la publicació</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h2 class="card-title">{{ $publicacio->titol }}</h2>
            <p class="card-text"><strong>Contingut:</strong> {{ $publicacio->contingut }}</p>
            {{-- <p class="card-text"><strong>Comptador de visites:</strong> {{ $publicacio->views_count }}</p> --}}
            <p class="card-text"><strong>Estat:</strong> {{ $publicacio->estat }}</p>
            <p class="card-text"><strong>Especialitat:</strong> {{ $publicacio->especialitat }}</p>
            <p class="card-text"><strong>Hora d'inici:</strong> {{ $publicacio->hora_inici }}</p>
            <p class="card-text"><strong>Hora final:</strong> {{ $publicacio->hora_final }}</p>

            <p class="card-text"><strong>Dia:</strong> {{ $publicacio->dia }}</p>
        </div>
    </div>

    <a href="{{ route('publicacions.index') }}" class="btn btn-secondary">Tornar a la llista de publicacions</a>
</div>
@endsection
