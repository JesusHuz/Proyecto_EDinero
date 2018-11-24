@extends('layouts.app')

@section('content')

    <h1>Edicion de Movimientos {{ $movimiento->id }}</h1>

    {!! Form::model(
        $movimiento,
        [
            'route' => ['movimientos.update', $movimiento],
            'files' => 'true',//procesar archivos files
            'method' => 'PUT' //y metodo put crea un campo oculto apra el put pero seta post
        ]
    ) !!}

        @include('movimientos.partials.form')

    {!! Form::close() !!}

    

@endsection