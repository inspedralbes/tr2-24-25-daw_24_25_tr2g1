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
                    @foreach ($usuaris as $usuari)
                        <option value="{{ $usuari->id }}">{{ $usuari->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="especialitat" class="form-label">Especialitat</label>
                <select class="form-select" name="especialitat" id="especialitat" required>
                    <option value="">Selecciona una Especialitat</option>
                    <option value="Matemáticas">Matemáticas</option>
                    <option value="Inglés">Inglés</option>
                    <option value="Ciencias">Ciencias</option>
                    <option value="Biologia">Biologia</option>
                    <option value="Pogramacio">Pogramacio</option>
                    <option value="Geografia">Geografia</option>
                    <option value="Tecnologia">Tecnologia</option>
                    <option value="Quimica">Quimica</option>
                </select>
            </div>
            {{-- fecha inicio y final  --}}
            <div class="mb-3">
                <label for="data_inici" class="form-label">Data d'inici</label>
                <input type="date" class="form-control" name="data_publicacio" id="data_publicacio" required>
            </div>

            {{-- hora inicio y final  --}}
            <div class="mb-3">
                <label for="hora_inici" class="form-label">Hora d'inici</label>
                <input type="time" class="form-control" name="hora_inici" id="hora_inici" required>
            </div>
            <div class="mb-3">
                <label for="hora_final" class="form-label">Hora final</label>
                <input type="time" class="form-control" name="hora_final" id="hora_final" required>
            </div>

            <button type="submit" class="btn btn-success">Crear Publicació</button>
            <a href="{{ route('publicacions.index') }}" class="btn btn-secondary">Tornar a la llista de publicacions</a>
        </form>
    </div>
@endsection
