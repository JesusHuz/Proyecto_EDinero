@extends('layouts.app')

@section('content')

    <h1>Movimiento nuevo</h1>

    {!! Form::model(
        $movimiento = new \App\Movimiento(['money' => 0.00]),
        [
            'route' => 'movimientos.store',
            'files' => 'true'
        ]
    ) !!}

        @include('movimientos.partials.form')

    {!! Form::close() !!}

@endsection
