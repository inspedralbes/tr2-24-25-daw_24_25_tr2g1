@extends('layouts.app')

@section('page-style')
<style>
    /* Estilo para la tabla */
    table.table {
        border-radius: 10px;
        overflow: hidden;
        background-color: #f9f9f9;
    }

    table th {
        background-color: #007bff;
        color: white;
        text-align: center;
        padding: 10px;
    }

    table td {
        vertical-align: middle;
        text-align: center;
        padding: 10px;
    }

    /* Estilo para las imágenes */
    .img-thumbnail {
        border: 2px solid #dee2e6;
        border-radius: 50%;
    }

    /* Botones */
    .btn-primary {
        background-color: #007bff;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-danger:hover {
        background-color: #a71d2a;
    }

    /* Encabezado */
    h1 {
        font-weight: bold;
        color: #007bff;
        text-shadow: 1px 1px 2px #00000022;
    }

    /* Contenedor */
    .container {
        margin-top: 20px;
        padding: 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
@endsection

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Llista d'usuaris</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Crear un nou usuari</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped ">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Email</th>
                        <th>Correualternatiu</th>
                        {{-- <th>Password</th> --}}
                        <th>Rol</th>
                        <th>Accions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuaris as $usuari)
                        <tr>
                            <td>{{ $usuari->id }}</td>
                            <td>{{ $usuari->correu }}</td>
                            <td>{{ $usuari->correualternatiu }}</td>
                            <td>{{ $usuari->rol }}</td>
                            {{-- <td>{{ $usuari->password }}</td> --}}
                            <td>
                                <a href="{{ route('users.edit', $usuari->id) }}" class="btn btn-primary">Editar</a>
                                <form action="{{ route('users.destroy', $usuari->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
