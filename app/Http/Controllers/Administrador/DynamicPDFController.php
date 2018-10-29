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
    //Construccion informe diario de ventas

    //Index de pagina del informe diario.

    function index()
    {
     $pedido_data = $this->get_pedido_data();
     $date = Carbon::now();
     return view('administrador/dynamic_pdf')->with('pedido_data', $pedido_data)->with('date', $date); //Se envian los datos del informe diario a la vista.
    }

    //Funcion que obtiene todos los pedidos del dia.

    function get_pedido_data()
    {
      $date = Carbon::now();
      $currentDate = $date->format('Y-m-d');
     $pedido_data = DB::table('pedidos')->whereRaw('DATE("created_at") = ?',[$currentDate])->get();
     return $pedido_data;
    }

    //Funcion que calcula la cantidad total de ventas diarias realizadas.

    function get_pedido_cant_ventas()
    {
      $date = Carbon::now();
      $currentDate = $date->format('Y-m-d');
    $total_pedidos = DB::table('pedidos')->select(DB::raw('COUNT(*) as ventas_cant'))->whereRaw('DATE("created_at") = ?',[$currentDate])->first();
     return $total_pedidos;
    }

    //Funcion que calcula el dinero total de ventas del dia.

    function get_pedido_total_ventas()
    {
      $date = Carbon::now();
      $currentDate = $date->format('Y-m-d');
     $total_pedidos = DB::table('pedidos')->select(DB::raw('SUM(subtotal) as ventas_total'))->whereRaw('DATE("created_at") = ?',[$currentDate])->first();
     return $total_pedidos;
    }

    //Funcion que genera el pdf del informe de ventas diarias.

    function pdf()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_pedido_data_to_html());
     return $pdf->stream('ventas_diario.pdf');
    }

    //Constructor de contenido del pdf.

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
    //Fin construccion informe ventas diario
    
    //-------------------------------------//

    //Contruccion informe mensual de ventas

    //Index de pagina info_mes.

    function index_mes()
    { 
      $mes = $this->get_mes();
      $totalPedidos = $this->get_totalPedidos();
      $total_mes = $this->get_totalVentas();
      return view('administrador/info_mes')->with('mes',$mes)->with('totalPedidos',$totalPedidos)->with('total_mes',$total_mes); // Se envian todos los datos que corresponden a la vista.
    }

    //Funcion que obtiene el nombre del mes actual.

    protected function get_mes()
    {
      $date = DB::SELECT("SELECT TO_CHAR(CURRENT_DATE,'MONTH') AS mes;");
      foreach($date as $fecha)
      {
        $mes = $fecha->mes;
      }
      return $mes; 
    }

    //Funcion que obtiene el total de pedidos del mes.

    protected function get_totalPedidos()
    {
      $pedidos = DB::SELECT("SELECT COUNT(*) AS t_pedidos 
                            FROM pedidos 
                            WHERE extract(month FROM current_date) = extract(month FROM created_at);");
      foreach($pedidos as $pedido)
      {
        $pedid_mes = $pedido->t_pedidos;       
      }
      return $pedid_mes;
    }

    //Funcion que calcula el total de ventas del mes.
    
    protected function get_totalVentas()
    {
      $ventas  = DB::SELECT("SELECT SUM(subtotal) AS t_mes 
                              FROM pedidos 
                              WHERE extract(month FROM current_date) = extract(month FROM created_at);");
      foreach($ventas as $venta)
      {
        $totalMes = $venta->t_mes;
      }
      return $totalMes;
    }
    //Generador archivo pdf
    function pdf_mes()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_vmes_to_html());
     return $pdf->stream('ventas_mes.pdf'); 
    }

    //Constructor de contenido del pdf   
    protected function convert_vmes_to_html()
    {
      $mes = $this->get_mes();
      $pedidos_mes = $this->get_totalPedidos();
      $total_venta = $this->get_totalVentas();

      $output = '
     <h3 align="center">Informe de ventas del mes de:  '.$mes.'</h3>
     <table width="50%" align="center" style="border-collapse: collapse; border: 0px;">
        <tr>
          <th style="border: 1px solid; padding:12px;" width="20%">Pedidos Totales</th>
          <th style="border: 1px solid; padding:12px;" width="30%">Venta Total ($CLP)</th>
        </tr>
        <tr>
          <td style="border: 1px solid; padding:12px;">'.$pedidos_mes.'</td>
          <td style="border: 1px solid; padding:12px;">'.$total_venta.'</td>
        </tr>
      </table>
      <h3 align="center">Cantidad pedidos del mes: '.$pedidos_mes.'</h3>
      <h3 align="center">Total vendido del mes: '.$total_venta.'</h3>';
      return $output;
    }
    //Fin contruccion informe mensual de ventas
}