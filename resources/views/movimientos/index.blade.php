@extends('layouts.app')

@section('content')
    
    <h1>{{ $title }}</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Categoria</th>
                <th>Cantidad</th>
                <th colspan="2" >Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movimientos as $movimiento)
            <tr>
                <td>{{ $movimiento->movimiento_dato->format('d/m/Y')}}</td>
                <td>{{ $movimiento->tipo }}</td>
                <td>{{ $movimiento->categoria->name }}</td>
                <td>{{ number_format($movimiento->money_decimal, 2) }}</td>
                <td>
                    <a href="{{ route ('movimientos.show',$movimiento) }}">
                        Detalles
                    </a>
                </td>
                <td>
                    <a href="{{ route ('movimientos.edit',$movimiento) }}">
                        Editar
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text center mx-auto">

        @if(Request::get('tipo'))

            {!! $movimientos->appends('tipo', Request::get('tipo'))->links() !!}<!-- se le agrega con appends una variable llamada tipo con el valor que viene en ella-->

        @else

            {!! $movimientos->links() !!}

        @endif
        
    </div>

@endsection