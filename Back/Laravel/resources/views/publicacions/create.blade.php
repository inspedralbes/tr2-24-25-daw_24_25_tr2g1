@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Crear Publicació</h1>
    <form action="{{ route('publicacions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Títol</label>
            <input type="text" class="form-control" name="titol" id="titol" required>
        </div>

        <div class="mb-3">
            <label for="contingut" class="form-label">Contingut</label>
            <textarea class="form-control" name="contingut" id="contingut" required></textarea>
        </div>

        <div class="mb-3">
            <label for="id_usuari" class="form-label">Usuari</label>
            <select class="form-select" name="id_usuari" id="id_usuari" required>
                <option value="">Selecciona un Usuari</option>
                @foreach($usuaris as $usuari)
                <option value="{{ $usuari->id }}">{{ $usuari->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="estat" class="form-label">Estat</label>
            <select class="form-select" name="estat" id="estat" required>
                <option value="">Selecciona un Estat</option>
                <option value="activa">Activa</option>
                <option value="inactiva">Inactiva</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Crear Publicació</button>
        <a href="{{ route('publicacions.index') }}" class="btn btn-secondary" Tornar a la llista de publicacions</a>
    </form>
</div>
@endsection