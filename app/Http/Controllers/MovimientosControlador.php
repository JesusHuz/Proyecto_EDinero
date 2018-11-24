<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Http\Requests\StoreMovimiento;
use App\Movimiento;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MovimientosControlador extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');//que siempre verifique que este autorizado
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Movimientos';
        $movimientos = Movimiento::where('user_id', auth()->user()->id);//solo movimientos del usuario en secion
        
        if ($request->has('tipo')) {//si existe tipo deve er ingreso o egreso
            $movimientos = $movimientos->where('tipo', $request->get('tipo'));
            $tittle = 'Movimientos de ' . $request->get('tipo');
        }

        $movimientos = $movimientos->orderBy('movimiento_dato', 'desc')->paginate();//paginado viene 15 pro defecto(numero)

        return view('movimientos.index', compact('movimientos','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::orderBy('name')->pluck('name','id');//pluck con cuales se va a construir le select que usaremos

        return view('movimientos.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreMovimiento\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovimiento $request)// predeterminado Request $request pero se creo uno store movimientos
    {
        // Es equivalente a (new Movement)->fill($request()->all());
        //todo lo qeu viene por le request se llenara de manera masiva con todas las  informacion del forumulario
        $movimiento = new Movimiento($request->all());
        $movimiento->money = $request->get('money_decimal') * 100;//sebe convertirce a centabo

        $categoria = $request->get('categoria_id');

        // Asegura la existencia de la categoría en la base de datos
        if (!is_numeric($categoria)) {
            $newCategoria = Categoria::firstOrCreate(['name' => ucwords($categoria)]);//firs si no la consigue la crea, ucwords la priemra letra es mayuscula
            $movimiento->categoria_id = $newCategoria->id;
        }

        // Asigna el ID del usuario en sesión
        $movimiento->user_id = auth()->user()->id;//del usuario autentificado queremos que se asigne esa propiedad

        if ($request->hasFile('image')) {//si nos esta llegando una imagen si existe
            // Archivo del input type file con name "image"
            $image = $request->file('image');

            /*
            // Para usar un nombre de archivo personalizado se usa storeAs() en lugar de store()
            $filepath = str_slug($image->getClientOriginalName())
                . date('YmdHis.')
                . $image->extension();
            $file = $image->storeAs('images/movements', $filepath);
            */

            // Sube la imagen a la carpeta public/images/movements
            $file = $image->store('images/movimientos');

            // Guarda la ruta de la imagen en el campo image
            $movimiento->image = $file;
        }

        // Guarda en la base de datos
        $movimiento->save();

        return redirect()->route('movimientos.show', $movimiento);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movimiento = Movimiento::where('user_id', auth()->user()->id)//que le dueño sea el de la secion activa
        ->where('id', $id) //donde el id de movimiento sea el que este llegando a la funcion show
        ->first();// devuelve el primer registro

        return view('movimientos.show', compact('movimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categorias = Categoria::orderBy('name')->pluck('name', 'id');

        $movimiento = Movimiento::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->first();

        return view('movimientos.edit', compact('categorias', 'movimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMovimiento $request, $id)//requerimientos
    {
        $movimiento = Movimiento::where('user_id', auth()->user()->id)
            ->where('id', $id)
            ->first();

        $movimiento->tipo = $request->get('tipo');
        $movimiento->movimiento_dato = $request->get('movimiento_dato');
        $movimiento->money = $request->get('money_decimal') * 100;
        $movimiento->descripcion = $request->get('descripcion');

        $categoria = $request->get('categoria_id');

        // Asegura la existencia de la categoría en la base de datos
        if (!is_numeric($categoria)) {
            $newCategoria = Categoria::firstOrCreate(['name' => ucwords($categoria)]);
            $movimiento->categoria_id = $newCategoria->id;
        }

        if ($request->hasFile('image')) {
            // Archivo del input type file con name "image"
            $image = $request->file('image');

            // Sube la imagen a la carpeta public/images/movements
            $file = $image->store('images/movimientos');

            // Guarda la ruta de la imagen en el campo image
            $movimiento->image = $file;
        }

        // Guarda en la base de datos
        $movimiento->save();

        return redirect()->route('movimientos.show', $movimiento);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
