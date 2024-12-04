@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Editar publicacio</h1>
    <form action="{{ route('publicacions.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titol" class="form-label">Títol</label>
            <input type="text" class="form-control" name="titol" id="titol" value="{{ old('titol', $publicacio->titol) }}" required>
        </div>

        <div class="mb-3">
            <label for="contingut" class="form-label">Contingut</label>
            <textarea class="form-control" name="contingut" id="contingut" required>{{ old('contingut', $publiacio->contingut) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Comptador de visites</label>
            <input type="number" class="form-control" name="views_count" id="views_count" value="{{ old('views_count', $publicacio->views_count) }}" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Hora d'inici</label>
            <input type="text" class="form-control" name="horainici" id="horainici" value="{{ old('horainici', $product->horainici) }}" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Hora Final</label>
            <input type="text" class="form-control" name="horafi" id="horafi" value="{{ old('horafi', $product->horafi) }}" required>
        </div>

        <button type="submit" class="btn btn-warning">Actualizar Publicació</button>
        <a href="{{ route('publicacions.index') }}" class="btn btn-secondary">Tornar a la llista de publicacions</a>
    </form>
</div>
@endsection