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
     $date = Carbon::now();
     return $pdf->stream('Ventas_diarias_'.$date.'.pdf');
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
     $date = Carbon::now();
     return $pdf->stream('Ventas_mensuales_'.$date.'pdf'); 
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


     //-------------------------------------//

    //Construccion informe reparto mensual


    function get_repartidossres() //obtiene los repartidores
    {

     $repartidores = DB::table('repartidores')->get();
     return $repartidores;
    }

    function get_tventas_rep() //numero de ventas mensuales
    {

     $repartidores = DB::SELECT("SELECT COUNT(*) AS CANTIDAD 
                                FROM entrega
                                WHERE EXTRACT(MONTH FROM created_at) = (SELECT EXTRACT(month FROM CURRENT_DATE))
                                AND repartidor_id = 1");
     return $repartidores;
    }


    function get_repartidores() //obtiene los repartidores
    {

     $repartidores = DB::SELECT("SELECT e.repartidor_id AS rep_id, COUNT(repartidor_id) AS cantidad_ventas, r.name AS rep_name, SUM(subtotal) AS total_ventas
      FROM repartidores r, entrega e, pedidos p
      WHERE r.id = e.repartidor_id
      AND e.pedido_id = p.id
      AND EXTRACT(MONTH FROM e.updated_at) = (SELECT EXTRACT(month FROM CURRENT_DATE))
      GROUP BY e.repartidor_id, r.name");

     return $repartidores;
    }

     function get_rep_diario()
    {

     $repartidores = DB::SELECT("SELECT e.repartidor_id AS rep_id, COUNT(repartidor_id) AS cantidad_ventas, r.name AS rep_name, SUM(subtotal) AS total_ventas
      FROM repartidores r, entrega e, pedidos p
      WHERE r.id = e.repartidor_id
      AND e.pedido_id = p.id
      AND e.updated_at >= current_date
      GROUP BY e.repartidor_id, r.name");

     return $repartidores;
    }

    function index_reparto_mes()
    {
     $repartidores_data = $this->get_repartidores();
     $date = Carbon::now();
     $date = $date->format('F Y');
     $t_ventas = $this->get_tventas_rep();
     return view('administrador/info_repart_mes')->with('rep_data', $repartidores_data)->with('date', $date); //Se envian los datos del informe diario a la vista.
    }

    function index_reparto_diario()
    {
     $repartidores_data = $this->get_rep_diario();
     $date = Carbon::now();
     $date = $date->format('d-m-y');
     return view('administrador/info_repart_diario')->with('rep_data', $repartidores_data)->with('date', $date); //Se envian los datos del informe diario a la vista.
    }

    function index_conect_mes()
    {
     $region_data = $this->get_region();
     $date = Carbon::now();
     $date = $date->format('F Y');
     return view('administrador/info_conect_mes')->with('regi_data', $region_data)->with('date', $date); //Se envian los datos del informe diario a la vista.
    }
    function get_region() //obtiene las regiones
    {

     $regiones = DB::SELECT("SELECT u.region AS region_nom, COUNT(region) AS cantidad_pedidos,SUM(subtotal) AS total_ventas
      FROM entrega e, users u, pedidos p
      WHERE u.id = p.user_id
      AND e.pedido_id = p.id
      AND EXTRACT(MONTH FROM e.created_at) = (SELECT EXTRACT(month FROM CURRENT_DATE))
      GROUP BY u.region");

     return $regiones;
    }

    function pdf_region_mes()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_region_to_html());
     $date = Carbon::now();
     return $pdf->stream('Ventas_region_'.$date.'.pdf');
    }
    function convert_region_to_html()
    {
      $date = Carbon::now();
      $currentDate = $date->format('m-y');
      $region_data = $this->get_region();

     $output = '
     <h3 align="center">Informe de Conecciones mensuales '.$currentDate.'</h3>
     <table width="50%" align="center" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Region</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Cantidad de conexiones</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Total Ventas</th>
   </tr>';  
     foreach($region_data as $reg)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$reg->region_nom.'</td>
       <td style="border: 1px solid; padding:12px;">'.$reg->cantidad_pedidos.'</td>
       <td style="border: 1px solid; padding:12px;">$'.$reg->total_ventas.'</td>
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }

    function pdf_reparto_mes()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_repmes_to_html());
     $date = Carbon::now();
     return $pdf->stream('Entregas_mensuales_'.$date.'.pdf');
    }

    //Constructor de contenido del pdf.

    function convert_repmes_to_html()
    {
      $date = Carbon::now();
      $currentDate = $date->format('m-y');
      $rep_data = $this->get_repartidores();

     $output = '
     <h3 align="center">Informe de reparto del mes '.$currentDate.'</h3>
     <table width="50%" align="center" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Id</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Nombre</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Cantidad repartos</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Total venta mensual</th>
   </tr>';  
     foreach($rep_data as $rep)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$rep->rep_id.'</td>
       <td style="border: 1px solid; padding:12px;">'.$rep->rep_name.'</td>
       <td style="border: 1px solid; padding:12px;">'.$rep->cantidad_ventas.'</td>
       <td style="border: 1px solid; padding:12px;">$'.$rep->total_ventas.'</td>
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }

    function pdf_reparto_diario()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_repdiario_to_html());
     $date = Carbon::now();
     return $pdf->stream('Entregas_diarias_'.$date.'.pdf');
    }

    //Constructor de contenido del pdf.

    function convert_repdiario_to_html()
    {
      $date = Carbon::now();
      $currentDate = $date->format('d-m-y');
      $rep_data = $this->get_rep_diario();

     $output = '
     <h3 align="center">Informe de entregas al día '.$currentDate.'</h3>
     <table width="50%" align="center" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="20%">Id</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Nombre</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Cantidad entregas</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Total ($)</th>
   </tr>';  
     foreach($rep_data as $rep)
     {
      $output .= '
      <tr>
       <td style="border: 1px solid; padding:12px;">'.$rep->rep_id.'</td>
       <td style="border: 1px solid; padding:12px;">'.$rep->rep_name.'</td>
       <td style="border: 1px solid; padding:12px;">'.$rep->cantidad_ventas.'</td>
       <td style="border: 1px solid; padding:12px;">$'.$rep->total_ventas.'</td>
      </tr>
      ';
     }
     $output .= '</table>';
     return $output;
    }
}