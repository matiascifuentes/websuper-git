<?php

namespace App\Http\Controllers\Administrador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;


use App\Product;
use App\Historial;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Product::orderBy('id','ASC')->paginate();
        return view('administrador/productos.index',["productos"=>$productos]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('administrador/productos.create');
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
        $producto = new Product;
        $producto->titulo = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categoria = $request->input('categoria');
        $producto->descripcion = $request->input('descripcion');
        $producto->supermercado = $request->input('supermercado');
        $producto->img = $request->input('img');
        $producto->url = $request->input('url');

        $messages = [
            'nombre.required' => 'Agrega el nombre del producto.',
            'precio.required' => 'Agrega el precio del producto.',
            'precio.min' => 'El precio debe ser mayor o igual a 1',
            'precio.numeric' => 'El precio debe ser un valor numérico',
            'precio.integer' => 'El precio debe ser un número entero',
            'categoria.required' => 'Agrega la categoría del producto.',
            'descripcion.required' => 'Agrega una descripción del producto.',
            'supermercado.required' => 'Agrega el supermercado al cual pertenece el producto.',
            'img.required' => 'Agrega una imagen al producto.',
            'url.required' => 'Agrega una url al producto.',
            
        ];
        

        $this->validate($request,[ 'nombre'=>'required', 'precio'=>'required|numeric|integer|min:1', 'categoria'=>'required', 'descripcion'=>'required', 'supermercado'=>'required', 'img'=>'required', 'url'=>'required'],$messages);
        
        $producto->save();
        return redirect()->route('productos.index')->with('success','Registro creado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $producto = Product::where('id',$id)->first();
        $historial = Historial::where('id_prod',$id)->get(['fecha','precio']);
        return view('administrador/productos.show',["producto"=>$producto,"historial"=>$historial]);
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
        $producto=Product::find($id);
        return view('administrador/productos.edit',["producto"=>$producto]);
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
        $producto = Product::find($id);
        $producto->titulo = $request->input('nombre');
        $producto->precio = $request->input('precio');
        $producto->categoria = $request->input('categoria');
        $producto->descripcion = $request->input('descripcion');
        $producto->supermercado = $request->input('supermercado');
        $producto->img = $request->input('img');
        $producto->url = $request->input('url');

        $messages = [
            'nombre.required' => 'Agrega el nombre del producto.',
            'precio.required' => 'Agrega el precio del producto.',
            'precio.min' => 'El precio debe ser mayor o igual a 1',
            'precio.numeric' => 'El precio debe ser un valor numérico',
            'precio.integer' => 'El precio debe ser un número entero',
            'categoria.required' => 'Agrega la categoría del producto.',
            'descripcion.required' => 'Agrega una descripción del producto.',
            'supermercado.required' => 'Agrega el supermercado al cual pertenece el producto.',
            'img.required' => 'Agrega una imagen al producto.',
            'url.required' => 'Agrega una url al producto.',
            
        ];
        

        $this->validate($request,[ 'nombre'=>'required', 'precio'=>'required|numeric|integer|min:1', 'categoria'=>'required', 'descripcion'=>'required', 'supermercado'=>'required', 'img'=>'required', 'url'=>'required'],$messages);


        $producto->save();
        return redirect()->route('productos.index')->with('success','Registro actualizado satisfactoriamente');
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
        Product::destroy($id);

        return redirect()->route('productos.index')->with('success','Registro eliminado satisfactoriamente');
    }
}
