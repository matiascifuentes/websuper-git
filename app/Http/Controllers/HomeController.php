<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Product;
use App\Historial;

class HomeController extends Controller
{
    /**
     * Constructor que asigna middleware de seguridad.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mostrar el index de cliente.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  Obteniendo todos los productos.
        $productos = Product::orderBy('id','ASC')->paginate();
        //  Enviando los productos a la vista del cliente.
        return view('home.index',["productos"=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Mostrar el detalle de un producto.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { 
        if(!is_numeric($id)){
            //  Si el id no es un número(ingreso indebido por url), se redirige al home.
            return redirect('/home');
        }
        //  Obteniendo datos del producto.
        $producto = Product::where('id',$id)->first();
        $historial = Historial::where('id_prod',$id)->get(['fecha','precio']);
        if(!$producto){
            //  Si no hay resultados no existe el producto y se envia al home.
            return redirect('/home');
        }
        //  Enviando los datos a la vista.
        return view('home.show',["producto"=>$producto,"historial"=>$historial]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
