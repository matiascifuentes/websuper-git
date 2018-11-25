<?php

namespace App\Http\Controllers\Administrador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Input;

use App\Product;
use App\Canasta;
use App\DetalleCanasta;

use DB;


class CanastasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  Obteniendo los datos de canastas.
        $canastas = Canasta::orderBy('id','ASC')->paginate();
        //  Enviando los datos a la vista.
        return view('administrador/canastas.index',["canastas"=>$canastas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //  Obteniendo los productos en el carro de canasta.
        $prodCanasta = \Session::get('prodCanasta');
        //  Calculando el total.
        $total = $this->total($prodCanasta);
        //  Enviando los datos al formulario para guardar.
        return view('administrador/canastas.create',["prodCanasta"=>$prodCanasta,"total"=>$total]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //  Obteniendo los productos en el carro de canasta.
        $prodCanasta = \Session::get('prodCanasta');
        if(!empty($prodCanasta)){
            //  Creando la canasta con los datos ingresados.
            $canasta = new Canasta;
            $canasta->nombre = $request->input('nombre');
            $canasta->descripcion = $request->input('descripcion');
            //  Mensajes de error.
            $messages = [
                'nombre.required' => 'Agrega el nombre de la canasta.',
                'descripcion.required' => 'Agrega una descripción para la canasta.',
            ];
            //  Validando los datos.
            $this->validate($request,['nombre'=>'required', 'descripcion'=>'required'],$messages);
            //  Guardando la canasta.
            $canasta->save();
            //  Obteniendo el id con el que se guardó la canasta.
            $id_canasta = $canasta->id;
            //  Guardando los productos de la canasta en detalle canasta.
            foreach ($prodCanasta as $item) {
                $detalle = new DetalleCanasta;
                $detalle->cod_c = $id_canasta;
                $detalle->cod_p = $item->id;
                $detalle->cantidad=$item->cantidad;
                $detalle->save();
            }
            //  Limpiando el carro de canasta.
            \Session::forget('prodCanasta');
        }
        //  Volviendo al index.
        return redirect()->route('canastas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  Obteniendo los datos asociados al id.
        $prodCanasta = DetalleCanasta::where('cod_c',$id)
                        ->join('productos','detalle_canasta.cod_p','=','productos.id')
                        ->get();
        //  Obteniendo el total de la canasta.
        $total = $this->total($prodCanasta);
        //  Enviando los datos a la vista.
        return view('administrador/canastas.show',["prodCanasta"=>$prodCanasta,"total"=>$total]);
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
        //  Eliminando la canasta.
        Canasta::destroy($id);
        return redirect()->route('canastas.index')->with('success','Registro eliminado satisfactoriamente');
    }


    public function buscador()
    {
        //  Cadena introducida por el usuario.
        $cadena = Input::get('search');
        //  Se separa la cadena en palabras.
        $palabras = explode(" ",$cadena);
        $i = 0;
        //  Recorriendo cada palabra obtenida.
        foreach ($palabras as $palabra){
            if($i == 0){
                $consulta = "SELECT * FROM productos WHERE (titulo ILIKE '%".$palabra."%') ";
            }
            //  Agregando una nueva condición a la consulta con la palabra obtenida.
            $consulta = $consulta."AND (titulo ILIKE '%".$palabra."%') ";
            $i = $i + 1;
        }
        //  Agregando orden y límite a la consulta.
        $consulta = $consulta."ORDER BY precio ASC LIMIT 10;";
        //  Ejecutando la consulta.
        $productos = DB::select($consulta);
        //  Enviando los datos a la vista.
        return view('administrador/canastas.search',["productos"=>$productos]);
    }

    private function total($array)
    {   
        //Retorna el total.
        $total = 0;
        foreach ($array as $item) {
            //  Se agrega al total el subtotal de cada item.
            $total += $item->precio * $item->cantidad;
        }
        //  Retornando el total.
        return $total;
    }
}