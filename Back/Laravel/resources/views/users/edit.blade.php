@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 text-center">Editar usuari</h1>
        <form action="{{ route('users.update', $usuari->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="correu" class="form-label">Email:</label>
                <input type="email" class="form-control" id="correu" name="correu" value="{{ $usuari->correu }}">
            </div>
            <div class="mb-3">
                <label for="correualternatiu" class="form-label">Correo alternativo:</label>
                <input type="email" class="form-control" id="correualternatiu" name="correualternatiu" value="{{ $usuari->correualternatiu }}">
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
                <label for="pregunta_secreta" class="form-label">Pregunta Secreta:</label>
                <select class="form-control" id="pregunta_secreta" name="pregunta_secreta" required>
                    <option value="Quin és nom del teu primer amic?" {{ $usuari->pregunta_secreta == 'Quin és nom del teu primer amic?' ? 'selected' : '' }}>Quin és nom del teu primer amic?</option>
                    <option value="On vas fer la ESO?" {{ $usuari->pregunta_secreta == 'On vas fer la ESO?' ? 'selected' : '' }}>On vas fer la ESO?</option>
                    <option value="Quin és el teu cotxe preferit?" {{ $usuari->pregunta_secreta == 'Quin és el teu cotxe preferit?' ? 'selected' : '' }}>Quin és el teu cotxe preferit?</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="resposta_secreta" class="form-label">Resposta Secreta:</label>
                <input type="text" class="form-control" id="resposta_secreta" name="resposta_secreta" value="{{ $usuari->resposta_secreta }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
