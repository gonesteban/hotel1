<?php

namespace hotel\Http\Controllers\Administrador;

use hotel\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use PDF;

class ReporteventaController extends Controller
{
  public function index()
	{
			return view('');
	}



  public function busqueda (Request $request)//Funcion que genera un reporte de ventas asociado  las reservas de cierto hotel  dentro de cierta fecha.
  {

          $reserva=DB::table('reserva')//Consulta que obtiene los anuncios que cumple con las condiciones (región y fecha) dadas por la secretaria
          ->select('reserva.id','reserva.costo','reserva.fecha_ingreso','reserva.fecha_salida')
          ->where([                                                           //condicionamos si la fecha de ingreso consultada esta entre medio de la fecha de ingreso con la de salida de las ya reservaa
                      ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                      ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                      ])
          ->orwhere([                                                         //condicionamos si la fecha de salida consultada esta entre medio de la fecha de ingreso con la de salida de las ya reservada
                      ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                      ['reserva.fecha_salida', '>', $request->fecha_salida],
                      ])
          ->orwhere([                                                         //condicionamos si la fecha de ingreso y salida de la consulta coincide con la de las reservadas
                      ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                      ['reserva.fecha_salida', '=', $request->fecha_salida],
                      ])
          ->orwhere([                                                         //condicionamos si solo reserva un dia
                      ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                      ])
          ->orwhere([
                      ['reserva.fecha_salida', '=', $request->fecha_salida],
                      ])
          ->orwhere([                                                        //condicionamos si la fecha consultada contiene a una fecha ya reservada
                      ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                      ['reserva.fecha_salida', '<', $request->fecha_salida],
                      ])
          ->get();

          //dd($reserva->all());



          //return view('admin.fechas')->with('reserva', $reserva);

          $pdf = PDF::loadView('admin.fechas', compact('reserva'));
          return $pdf->download('reserva.pdf');


  }

}
