@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>Benvingut al CRUD</h1>
        <p>
            <a href="{{ route('publicacions.index') }}" class="btn btn-primary">publicacions</a>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">usuaris</a>
        </p>
    </div>
@endsection