@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Crear un nuevo usuari</h1>
        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="correu" class="form-label">Email:</label>
                <input type="email" class="form-control" id="correu" name="correu" required>
            </div>
            <div class="mb-3">
                <label for="correualternatiu" class="form-label">Correo alternativo:</label>
                <input type="email" class="form-control" id="correualternatiu" name="correualternatiu" required>
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
                <label for="pregunta_secreta" class="form-label">Pregunta Secreta:</label>
                <select class="form-control" id="pregunta_secreta" name="pregunta_secreta" required>
                    <option value="Quin és nom del teu primer amic?">Quin és nom del teu primer amic?</option>
                    <option value="On vas fer la ESO?">On vas fer la ESO?</option>
                    <option value="Quin és el teu cotxe preferit?">Quin és el teu cotxe preferit?</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="resposta_secreta" class="form-label">Resposta Secreta:</label>
                <input type="text" class="form-control" id="resposta_secreta" name="resposta_secreta" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
@endsection
