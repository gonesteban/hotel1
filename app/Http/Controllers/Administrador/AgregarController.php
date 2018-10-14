<?php

namespace hotel\Http\Controllers\Administrador;

use hotel\Http\Controllers\Controller;
use hotel\Agregar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgregarController extends Controller
{
    public function create()
    {
    	return view('ingresar');
    }

    public function store(Request $request)
    {   //obtenemos el id del hotel, por medio del nombre del hotel que el usuario ingreso
      $id_hotel = DB::table('hotel')
                  ->select( 'hotel.id')
                  ->where('hotel.nombre_hotel', $request->nombre_hotel )
                  ->get();

      //Guardamos en la base de datos los datos de la habitacion
    	$agregar = new Agregar;
    	$agregar->id_hotel = $id_hotel[0]->id; //coloca el id que obtuvimos por medio del nombre del hotel
    	$agregar->tipo_habitacion = $request->input('tipo_habitacion');
    	$agregar->capacidad = $request->input('capacidad');
    	$agregar->precio = $request->input('precio');
    	$agregar->cantidad = $request->input('cantidad');
      $agregar->valor_oferta = $request->input('valor_oferta');
      $agregar->fecha_inicio = $request->input('fecha_inicio');
      $agregar->fecha_final = $request->input('fecha_final');
      $agregar->estado = $request->input('estado');
    	$agregar ->save();
    	return redirect('/ingresar')->with('status', 'Se ha ingresado la habitación correctamente');
    }
}
