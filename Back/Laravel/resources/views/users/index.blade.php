@extends('layouts.app')


@section('page-style')

@endsection

@section('content')
    <div class="container">

        <h1 class="my-4 text-center">Llista d'usuaris</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Crear un nou usuari</a>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Cognom1</th>
                    <th>Cognom2</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>data_naixement</th>
                    <th>telefon</th>
                    <th>foto_profile</th>
                    <th>biografia</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($usuaris as $usuari)
                        <tr>
                            <td>{{ $usuari->id }}</td>
                            <td>{{ $usuari->nom }}</td>
                            <td>{{ $usuari->cognom1 }}</td>
                            <td>{{ $usuari->cognom2 }}</td>
                            <td>{{ $usuari->email }}</td>
                            <td>{{ $usuari->rol }}</td>
                            <td>{{ $usuari->data_naixement }}</td>
                            <td>{{ $usuari->telefon }}</td>
                            <td> 
                                <img src="{{ asset('/img/' . $usaris->image) }}" alt="{{ $usuaris->title }}"
                                    class="img-thumbnail" width="50">
                            </td>
                            <td>{{ $user->biografia }}</td>

                            <td>
                                <a href="{{ route('usuaris.edit', $usuaris->id) }}" class="btn btn-primary">Editar</a>
                                <form action="{{ route('usuaris.destroy', $usuaris->id) }}" method="POST" class="d-inline">
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
