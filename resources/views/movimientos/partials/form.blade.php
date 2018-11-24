<div class="form-group{{ $errors->has('movimiento_dato') ? ' has-error' : '' }}">
        {!! Form::label('movimiento_dato', 'Fecha') !!}
    
        {!! Form::date('movimiento_dato',
            ($movimiento->movimiento_dato) ? $movimiento->movimiento_dato->format('Y-m-d') : date('Y-m-d'),
            [
                'required',
                'class' => 'form-control'
            ]
        ) !!}
    
        @if($errors->has('movimiento_dato'))
            <span class="help-block">
                <strong>{{ $errors->first('movimiento_dato') }}</strong>
            </span>
        @endif
    </div> 

<div class="form-group {{ $errors->has('tipo') ? ' has-error' : '' }} ">
    {!! Form::label('tipo','Tipo') !!}

    {!! Form::select('tipo',

        ['Egreso' => 'Egreso','Ingreso' => 'Ingreso', ],
        null,
        [
            'required',//propiedades para el label
            'class' => 'form-control'
        ]
    ) !!}

    @if($errors->has('tipo'))
        <span class="help-block">
            <strong>{{ $errors->first('tipo') }}</strong>
        </span>
    @endif

</div> 


<div class="form-group {{ $errors->has('categoria_id') ? ' has-error' : '' }} ">
                            
    {!! Form::label('categoria_id','Categoria') !!}

    {!! Form::select('categoria_id',
        $categorias,
        null,
        [
            'required',
            'class' => 'form-control'
        ]    
    )  !!}

   <!--cuando se vea errores le nombre regresara al input y mostrar error-->

    @if($errors->has('categoria_id'))
        <span class="help-block">
            <strong>{{ $errors->first('categoria_id') }}</strong>
        </span>
    @endif

</div> 

<div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
        {!! Form::label('descripcion', 'Descripción:') !!}
    
        {!! Form::textarea('descripcion',
            null,
            [
                'required',
                'placeholder' => 'Descripción',
                'autocomplete' => 'off',
                'maxlength' => 1000,
                'class' => 'form-control'
            ]
        ) !!}
    
        @if($errors->has('descripcion'))
            <span class="help-block">
                <strong>{{ $errors->first('descripcion') }}</strong>
            </span>
        @endif
    </div> 

<div class="form-group {{ $errors->has('money_decimal') ? ' has-error' : '' }} ">
    {!! Form::label('money_decimal','Monto') !!}

    {!! Form::number('money_decimal',
        null,
        [
            'required',//propiedades para el label
            'placeholder' => 'Monto',
            'min' => 0.00,
            'step' => 0.01,
            'class' => 'form-control'
        ]
    ) !!}

    @if($errors->has('money_decimal'))
        <span class="help-block">
            <strong>{{ $errors->first('money_decimal') }}</strong>
        </span>
    @endif

</div> 

<div class="form-group {{ $errors->has('image') ? ' has-error' : '' }} ">
    {!! Form::label('image','Imagen') !!}

    {!! Form::file('image',
        ['class' => 'form-control' ]
    ) !!}

    @if($errors->has('image'))
        <span class="help-block">
            <strong>{{ $errors->first('image') }}</strong>
        </span>
    @endif

</div> 

<div class="form-group">
    <button type="submit" class="btn btn-primary">Guardar</button>
</div>

@section('scripts')
    <script type="text/javascript">
        jQuery(function($) {
            $('#categoria_id').select2({
                placeholder: 'Seleccione una categoria',
                tags: true,//nos dejara crea nuevos elementos
                tokenSeparators: [',']
            }); //para usar select2
        });
    </script>
@endsection

