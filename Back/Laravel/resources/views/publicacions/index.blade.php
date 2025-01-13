@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="my-4 text-center">Llista de publicacions</h1>
    <a href="{{ route('publicacions.create') }}" class="btn btn-primary mb-3">Crear una nova publicació</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID_publicació</th>
                    <th>Títol</th>
                    <th>Contingut</th>
                    <th>Id_usuari</th>
                    <th>Especialitat</th>
                    <th>Accions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($publicacions as $publicacio)
                <tr>
                    <td>{{ $publicacio->id }}</td>
                    <td>{{ $publicacio->titol }}</td>
                    <td>{{ $publicacio->contingut }}</td>
                    <td>{{ $publicacio->id_usuari }}</td>
                    <td>{{ $publicacio->especialitat }}</td>
                    <td>
                        <a href="{{ route('publicacions.edit', $publicacio->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <a href="{{ route('publicacions.show', $publicacio->id) }}" class="btn btn-info">Veure Detalls</a>
                        <form action="{{ route('publicacions.destroy', $publicacio->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás segur d\'eliminar la publicació?')">Sí, eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
