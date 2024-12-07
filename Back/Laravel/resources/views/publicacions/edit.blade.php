@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Editar Publicació</h1>
    <form action="{{ route('publicacions.update', $publicacio->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titol" class="form-label">Títol</label>
            <input type="text" class="form-control" name="titol" id="titol" value="{{ old('titol', $publicacio->titol) }}" required>
        </div>

        <div class="mb-3">
            <label for="contingut" class="form-label">Contingut</label>
            <textarea class="form-control" name="contingut" id="contingut" required>{{ old('contingut', $publicacio->contingut) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="estat" class="form-label">Estat</label>
            <select class="form-select" name="estat" id="estat" required>
                <option value="activa" {{ old('estat', $publicacio->estat) == 'activa' ? 'selected' : '' }}>Activa</option>
                <option value="inactiva" {{ old('estat', $publicacio->estat) == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar Publicació</button>
        <a href="{{ route('publicacions.index') }}" class="btn btn-secondary">Tornar a la llista de publicacions</a>
    </form>
</div>
@endsection
