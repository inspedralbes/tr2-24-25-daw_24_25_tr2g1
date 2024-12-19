@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Editar usuari</h1>
        <form action="{{ route('users.update', $usuari->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nom" class="form-label">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom" value="{{ $usuari->nom }}" >
            </div>
            <div class="mb-3">
                <label for="cognom1" class="form-label">Cognom1:</label>
                <input type="text" class="form-control" id="cognom1" name="cognom1" value="{{ $usuari->cognom1 }}" >
            </div>
            <div class="mb-3">
                <label for="cognom2" class="form-label">Cognom2:</label>
                <input type="text" class="form-control" id="cognom2" name="cognom2" value="{{ $usuari->cognom2 }}" >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $usuari->email }}">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
                <small class="form-text text-muted">Deja este campo vacío si no deseas cambiar la contraseña.</small>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirmar Password:</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Role:</label>
                <select class="form-control" id="rol" name="rol">
                    <option value="">Seleccioneu un rol</option>
                    <option value="alumne" {{ $usuari->rol == 'alumne' ? 'selected' : '' }}>Alumne</option>
                    <option value="mentor" {{ $usuari->rol == 'mentor' ? 'selected' : '' }}>Mentor</option>
                    <option value="professor" {{ $usuari->rol == 'professor' ? 'selected' : '' }}>Professor</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="data_naixement" class="form-label">Data Naixement:</label>
                <input type="date" class="form-control" id="data_naixement" name="data_naixement" value="{{ $usuari->data_naixement }}">
            </div>
            <div class="mb-3">
                <label for="telefon" class="form-label">Telefon:</label>
                <input type="text" class="form-control" id="telefon" name="telefon" value="{{ $usuari->telefon }}">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Foto de perfil:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <div class="mb-3">
                <label for="biografia" class="form-label">Biografia:</label>
                <textarea class="form-control" id="biografia" name="biografia">{{ $usuari->biografia }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
