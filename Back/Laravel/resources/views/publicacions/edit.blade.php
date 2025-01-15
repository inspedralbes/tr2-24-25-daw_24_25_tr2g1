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

        {{-- <div class="mb-3">
            <label for="estat" class="form-label">Estat</label>
            <select class="form-select" name="estat" id="estat" required>
                <option value="activa" {{ old('estat', $publicacio->estat) == 'activa' ? 'selected' : '' }}>Activa</option>
                <option value="inactiva" {{ old('estat', $publicacio->estat) == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
            </select>
        </div> --}}

        <div class="mb-3">
            <label for="especialitat" class="form-label">Especialitat</label>
            <select class="form-select" name="especialitat" id="especialitat" required>
                <option value="">Selecciona una Especialitat</option>
                <option value="Matemáticas" {{ old('especialitat', $publicacio->especialitat) == 'Matemáticas' ? 'selected' : '' }}>Matemáticas</option>
                <option value="Inglés" {{ old('especialitat', $publicacio->especialitat) == 'Inglés' ? 'selected' : '' }}>Inglés</option>
                <option value="Ciencias" {{ old('especialitat', $publicacio->especialitat) == 'Ciencias' ? 'selected' : '' }}>Ciencias</option>
                <option value="Biologia" {{ old('especialitat', $publicacio->especialitat) == 'Biologia' ? 'selected' : '' }}>Biologia</option>
                <option value="Pogramacio" {{ old('especialitat', $publicacio->especialitat) == 'Pogramacio' ? 'selected' : '' }}>Pogramacio</option>
                <option value="Geografia" {{ old('especialitat', $publicacio->especialitat) == 'Geografia' ? 'selected' : '' }}>Geografia</option>
                <option value="Tecnologia" {{ old('especialitat', $publicacio->especialitat) == 'Tecnologia' ? 'selected' : '' }}>Tecnologia</option>
                <option value="Quimica" {{ old('especialitat', $publicacio->especialitat) == 'Quimica' ? 'selected' : '' }}>Quimica</option>
            </select>
        </div>
        {{-- fecha inicio y final --}}
        <div class="mb-3">
            <label for="data_inici" class="form-label">Data d'inici</label>
            <input type="date" class="form-control" name="data_publicacio" id="data_publicacio" value="{{ old('data_publicacio', $publicacio->data_publicacio) }}" required>
        </div>

        {{-- hora inicio y final --}}
        <div class="mb-3">
            <label for="hora_inici" class="form-label
            ">Hora d'inici</label>
            <input type="time" class="form-control" name="hora_inici" id="hora_inici" value="{{ old('hora_inici', $publicacio->hora_inici) }}" required>
        </div>
        <div class="mb-3">
            <label for="hora_final" class="form-label">Hora final</label>
            <input type="time" class="form-control" name="hora_final" id="hora_final" value="{{ old('hora_final', $publicacio->hora_final) }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Actualizar Publicació</button>
        <a href="{{ route('publicacions.index') }}" class="btn btn-secondary">Tornar a la llista de publicacions</a>
    </form>
</div>
@endsection
