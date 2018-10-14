<?php

namespace hotel\Http\Controllers\Digitador;

use hotel\Http\Controllers\Controller;
use hotel\Agregar;
use hotel\Hotel;
use hotel\Habitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Digitador_agregarController extends Controller
{
    public function create()
    {
    	return view('digitador.ingresa_habitacion');
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
    	return redirect('/d_ingresar_habitacion')->with('status', 'Se ha ingresado la habitación correctamente (Estado: Esperando aprobación de la Secretaria)');
    }


    public function index()
    {
        //$habitacion = Habitacion::orderBy('id','ASC')->paginate(5);
        //return view('admin.lista_habitaciones')->with('habitacion', $habitacion);
        $habitacion = DB::table('habitacion') //Aqui se consultan los datos de la habitación
                    ->join('hotel','hotel.id', '=', 'habitacion.id_hotel') //se conecta la tabla habitación con la tabla hotel para obtener los datos de hotel y habitacion
                    ->select('habitacion.id', 'hotel.nombre_hotel', 'habitacion.tipo_habitacion', 'habitacion.capacidad', 'habitacion.precio','habitacion.cantidad')
                    ->where('habitacion.estado', '=', 0)
                    ->get();
        return view('digitador.lista_habitaciones')->with('habitacion', $habitacion); //retorna los datos de la habitación
        //return view('admin.lista_habitaciones',compact('habitacion'));
    }

    public function index2()
    {
        //$habitacion = Habitacion::orderBy('id','ASC')->paginate(5);
        //return view('admin.lista_habitaciones')->with('habitacion', $habitacion);
        $habitacion = DB::table('habitacion') //Aqui se consultan los datos de la habitación
                    ->join('hotel','hotel.id', '=', 'habitacion.id_hotel') //se conecta la tabla habitación con la tabla hotel para obtener los datos de hotel y habitacion
                    ->select('habitacion.id', 'hotel.nombre_hotel', 'habitacion.tipo_habitacion', 'habitacion.capacidad', 'habitacion.precio','habitacion.cantidad')
                    ->where('habitacion.estado', '=', 1)
                    ->get();
        return view('digitador.habitaciones')->with('habitacion', $habitacion); //retorna los datos de la habitación
        //return view('admin.lista_habitaciones',compact('habitacion'));
    }

    public function edit($id)
    {
        $habitacion = Habitacion::find($id);//busca la id recibida en la base de datos
        return view('digitador.editarHabitacion')->with('habitacion', $habitacion); //reotrna la vista de edición de habitación
    }

    public function update(Request $request, $id) //esta función recibe datos de edición y la id de la habitación que se desea editar
    {
      $habitacion = Habitacion::find($id); //Busca la id recibida en la tabla habitacion
      $habitacion-> valor_oferta = $request->valor_oferta; //En las siguientes lineas remplaza los datos a modificar en la base de datos
      $habitacion-> fecha_inicio = $request->fecha_inicio;
      $habitacion-> fecha_final = $request->fecha_final;
      $habitacion->save(); //Guarda los datos modificados en la base de datos
      return redirect()->route('d_lista_habitaciones'); //redirije a la ruta lista_habitaciones
    }

    public function destroy($id)
    {
        $habitacion = Habitacion::find($id); //Esta funcion elimina la habitacion requerida en la base de datos
        $habitacion -> delete(); //Elimina los datos de la habitacion
        return redirect()->route('d_lista_habitaciones');
    }

    public function cancel($id)
    {
        $habitacion = Habitacion::find($id); //Esta funcion elimina la habitacion requerida en la base de datos
        $habitacion -> delete(); //Elimina los datos de la habitacion
        return redirect()->route('d_listado_habitaciones');
    }
}
