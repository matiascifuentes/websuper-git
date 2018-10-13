<?php

namespace App\Http\Controllers\Administrador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;

use Illuminate\Support\Facades\Input;

use App\Product;
use App\Canasta;
use App\DetalleCanasta;

class CanastasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $canastas = Canasta::orderBy('id','ASC')->paginate();
        return view('administrador/canastas.index',["canastas"=>$canastas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
        $prodCanasta = \Session::get('prodCanasta');
        $total = $this->total($prodCanasta);
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
        $prodCanasta = \Session::get('prodCanasta');
        if(!empty($prodCanasta)){
            $canasta = new Canasta;
            $canasta->nombre = $request->input('nombre');
            $canasta->descripcion = $request->input('descripcion');
            $messages = [
                'nombre.required' => 'Agrega el nombre de la canasta.',
                'descripcion.required' => 'Agrega una descripción para la canasta.',
            ];

            $this->validate($request,['nombre'=>'required', 'descripcion'=>'required'],$messages);
            $canasta->save();

            $id_canasta = $canasta->id;
        
            foreach ($prodCanasta as $item) {
                $detalle = new DetalleCanasta;
                $detalle->cod_c = $id_canasta;
                $detalle->cod_p = $item->id;
                $detalle->cantidad=$item->cantidad;
                $detalle->save();
            }
            \Session::forget('prodCanasta');
        }
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
        //
        $prodCanasta = DetalleCanasta::where('cod_c',$id)
                        ->join('productos','detalle_canasta.cod_p','=','productos.id')
                        ->get();
        $total = $this->total($prodCanasta);
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
        //
        Canasta::destroy($id);
        return redirect()->route('canastas.index')->with('success','Registro eliminado satisfactoriamente');
    }


    public function buscador()
    {
        $productos = Product::where('titulo', 'like', '%'.Input::get('search').'%')
                ->orderBy('precio', 'asc')->paginate(10);
        return view('administrador/canastas.search',["productos"=>$productos]);
    }

    public function search($search){
        $search = urldecode($search);
        $productos = Product::select()
                ->where('titulo', 'LIKE', '%'.$search.'%')
                ->orderBy('id', 'desc')
                ->get();
        return "hola";
        /*if (count($productos) == 0){
            return view('canastas.search')
            ->with('message', 'No hay resultados que mostrar')
            ->with('search', $search);
        } else{
            return view('canastas.search')
            ->with('comments', $productos)
            ->with('search', $search);
        }*/
    }


    private function total($array)
    {
        $total = 0;
        foreach ($array as $item) {
            $total += $item->precio * $item->cantidad;
        }
        return $total;
    }
}