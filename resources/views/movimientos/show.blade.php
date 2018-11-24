@extends('layouts.app')

@section('content')

    <h1>Detalles del movimiento {{ $movimiento->id }}</h1>

    <table class="table table-bordered">
        <tr>
            <th>Tipo</th>
            <td>{{ $movimiento->tipo }}</td>
        </tr>
        <tr>
            <th>Fecha</th>
            <td>{{ $movimiento->movimiento_dato->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th>Categoría</th>
            <td>{{ $movimiento->categoria->name }}</td>
        </tr>
        <tr>
            <th>Cantidad</th>
            <td>{{ number_format($movimiento->money_decimal, 2) }}</td>
        </tr>
        <tr>
            <th>Descripción</th>
            <td>{{ $movimiento->descripcion }}</td>
        </tr>
    </table>

    @if ($movimiento->image)
        <a href="{{ asset($movimiento->image) }}" class="thumbnail" target="_blank">
            <img src="{{ asset($movimiento->image) }}" alt="{{ $movimiento->id }}">
        </a>
    @endif

@endsection