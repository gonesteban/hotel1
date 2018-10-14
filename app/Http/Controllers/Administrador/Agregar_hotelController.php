<?php

namespace hotel\Http\Controllers\Administrador;

use hotel\Http\Controllers\Controller;
use hotel\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Agregar_hotelController extends Controller
{
    public function store(Request $request)
    {
      $id_ciudad = DB::table('ciudad') //consultamos en la tabla ciudad 
                  ->select( 'ciudad.id') //seleccionamos los id de la ciudad
                  ->where('ciudad.nombre_ciudad', $request->nombre_ciudad) //colocamos la condicion para obtener el id de la ciudad
                  ->get();
                  //dd($id_ciudad[0]->id);
      //Guardamos en la base de datos del nuevo hotel
    	$agregar = new Hotel;
    	$agregar->nombre_hotel = $request->input('nombre_hotel'); //coloca el nombre del hotel puesto por el usuario
    	$agregar->id_ciudad = $id_ciudad[0]->id; //le igualamos el ide que obtuvimos antes
    	$agregar ->save();
    	return redirect('/ingresar')->with('status_hotel', 'Se ha ingresado el Hotel correctamente');
    }
}
