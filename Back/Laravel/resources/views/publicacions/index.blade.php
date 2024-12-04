@extends('layouts.app')

@section('content')
<div class="container">

    <h1 class="my-4 text-center">Llista de publicacions</h1>
    <a href="{{ route('publicacions.create') }}" class="btn btn-primary mb-3">Crear una nova publicació</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Id_publiació</th>
                    <th>Títol</th>
                    <th>Contingut</th>
                    <th>Id_usuari</th>
                    <th>Estat</th>
                    <th>Contador de visites</th>
                    <th>Data de la publiació</th>
                    <th>Hora d'inici</th>
                    <th>Hora final</th>
                    <th>Dia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <img src="{{ asset('/img/' . $product->image) }}" alt="{{ $product->title }}" class="img-thumbnail" width="50">
                    </td>
                    <td>{{ $product->category_id }}</td>
                    <td>{{ $product->size_id }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Ver Detalles</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar el producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection