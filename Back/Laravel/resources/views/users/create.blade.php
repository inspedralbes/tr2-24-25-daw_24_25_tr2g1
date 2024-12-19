@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Crear un nuevo usuari</h1>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom:</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="mb-3">
            <label for="cognom1" class="form-label">Cognom1:</label>
            <input type="text" class="form-control" id="cognom1" name="cognom1" required>
        </div>
        <div class="mb-3">
            <label for="cognom2" class="form-label">Cognom2:</label>
            <input type="text" class="form-control" id="cognom2" name="cognom2" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="rol" class="form-label">Role:</label>
            <select class="form-control" id="rol" name="rol" required>
                <option value="alumne">Alumne</option>
                <option value="mentor">Mentor</option>
                <option value="professor">Professor</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="data_naixement" class="form-label">Data Naixement:</label>
            <input type="date" class="form-control" id="data_naixement" name="data_naixement" required>
        </div>
        <div class="mb-3">
            <label for="telefon" class="form-label">Telefon:</label>
            <input type="text" class="form-control" id="telefon" name="telefon" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Foto de perfil:</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <div class="mb-3">
            <label for="biografia" class="form-label">Biografia:</label>
            <textarea class="form-control" id="biografia" name="biografia"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
@endsection