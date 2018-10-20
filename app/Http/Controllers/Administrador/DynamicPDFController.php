<?php

namespace App\Http\Controllers\Administrador;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use DB;
use PDF;

class DynamicPDFController extends Controller
{
    function index()
    {
     $pedido_data = $this->get_pedido_data();
     $date = Carbon::now();
     return view('administrador/dynamic_pdf')->with('pedido_data', $pedido_data)->with('date', $date);
    }

    function get_pedido_data()
    {
      $date = Carbon::now();
      $currentDate = $date->format('Y-m-d');
     $pedido_data = DB::table('pedidos')->whereRaw('DATE("created_at") = ?',[$currentDate])->get();
     return $pedido_data;
    }

    function get_pedido_cant_ventas()
    {
      $date = Carbon::now();
      $currentDate = $date->format('Y-m-d');
    $total_pedidos = DB::table('pedidos')->select(DB::raw('COUNT(*) as ventas_cant'))->whereRaw('DATE("created_at") = ?',[$currentDate])->first();
     return $total_pedidos;
    }

    function get_pedido_total_ventas()
    {
      $date = Carbon::now();
      $currentDate = $date->format('Y-m-d');
     $total_pedidos = DB::table('pedidos')->select(DB::raw('SUM(subtotal) as ventas_total'))->whereRaw('DATE("created_at") = ?',[$currentDate])->first();
     return $total_pedidos;
    }

    function pdf()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_pedido_data_to_html());
     return $pdf->stream();
    }

    function convert_pedido_data_to_html()
    {
      $date = Carbon::now();
      $currentDate = $date->format('Y-m-d');
      $pedido_data = $this->get_pedido_data();
      $pedido_t= $this->get_pedido_total_ventas();
      $pedido_c= $this->get_pedido_cant_ventas();
     $output = '
     <h3 align="center">Informe de ventas del día '.$currentDate.'</h3>
     <table width="50%" align="center" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Id Venta</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Total ($CLP)</th>
   </tr>';  
     foreach($pedido_data as $pedido)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$pedido->id.'</td>
       <td style="border: 1px solid; padding:12px;">'.$pedido->subtotal.'</td>
      </tr>
      ';
     }
     $output .= '</table>
     <h3 align="center">Cantidad de ventas diarias: '.$pedido_c->ventas_cant.'</h3>
     <h3 align="center">Total de ventas diarias: $'.$pedido_t->ventas_total.'</h3>';
     return $output;
    }
}