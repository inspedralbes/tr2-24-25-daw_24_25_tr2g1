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
            <label for="estat" class="form-label">Estat</label>
            <select class="form-select" name="estat" id="estat" required>
                <option value="">Selecciona un Estat</option>
                <option value="actiu">Actiu</option>
                <option value="inactiu">Inactiu</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="views_count" class="form-label">Comptador de visites</label>
            <input type="number" class="form-control" name="views_count" id="views_count"></label>
        </div>

        <div class="mb-3">
            <label for="horainici" class="form-label">Hora d'inici</label>
            <input type="text" class="form-control" name="horainici" id="horainici" required>
        </div>

        <div class="mb-3">
            <label for="horafi" class="form-label">Hora Final</label>
            <input type="text" class="form-control" name="horafi" id="horafi" required>
        </div>

        <div class="mb-3">
            <label for="dia" class="form-label">Dia</label>
            <input type="date" class="form-control" name="dia" id="dia" required>
        </div>

        <button type="submit" class="btn btn-success">Crear Publicació</button>
        <a href="{{ route('publicacions.index') }}" class="btn btn-secondary" Tornar a la llista de publicacions</a>
    </form>
</div>
@endsection