<?php

namespace hotel\Http\Controllers\Secretaria;

use hotel\Http\Controllers\Controller;
use hotel\Habitacion;
use hotel\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class S_habitacionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //$habitacion = Habitacion::orderBy('id','ASC')->paginate(5);
        //return view('admin.lista_habitaciones')->with('habitacion', $habitacion);
        $habitacion = DB::table('habitacion') //Aqui se consultan los datos de la habitación
                    ->join('hotel','hotel.id', '=', 'habitacion.id_hotel') //se conecta la tabla habitación con la tabla hotel para obtener los datos de hotel y habitacion
                    ->select('habitacion.id', 'hotel.nombre_hotel', 'habitacion.tipo_habitacion', 'habitacion.capacidad', 'habitacion.precio','habitacion.cantidad')
                    ->where('habitacion.estado', '=', 1)
                    ->paginate(20);
        return view('secretaria.listado_habitaciones')->with('habitacion', $habitacion); //retorna los datos de la habitación
        //return view('admin.lista_habitaciones',compact('habitacion'));
    }



    public function edit($id)
    {
        $habitacion = Habitacion::find($id);//busca la id recibida en la base de datos
        return view('secretaria.editarHabitacion')->with('habitacion', $habitacion); //reotrna la vista de edición de habitación
    }

   


    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function update(Request $request, $id) //esta función recibe datos de edición y la id de la habitación que se desea editar
    {
      $habitacion = Habitacion::find($id); //Busca la id recibida en la tabla habitacion
      $habitacion-> tipo_habitacion = $request->tipo_habitacion; //En las siguientes lineas remplaza los datos a modificar en la base de datos
      $habitacion-> capacidad = $request->capacidad;
      $habitacion-> precio = $request->precio;
      $habitacion-> cantidad = $request->cantidad;
      $habitacion->save(); //Guarda los datos modificados en la base de datos
      return redirect()->route('s_listado_habitaciones'); //redirije a la ruta lista_habitaciones
    }



     /*public function destroy($id)
    {
        $habitacion = Habitacion::find($id); //Esta funcion elimina la habitacion requerida en la base de datos
        $habitacion -> delete(); //Elimina los datos de la habitacion
        return redirect()->route('lista_habitaciones');
    }*/


}