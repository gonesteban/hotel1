<?php

namespace hotel\Http\Controllers\Recepcionista;

use hotel\Http\Controllers\Controller;
use hotel\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RecepcionistaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recepcionista.lista_reservas');
    }

    public function mostrar()// funcion que entrega las reservas en la pagina de administrador
    {

         $reserva =Reserva::orderBy('id','ASC')->paginate(3);
         return view('recepcionista.lista_reservas')->with('reserva', $reserva);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reserva = Reserva::find($id);//busca la id recibida en la base de datos
        return view('recepcionista.editarReserva')->with('reserva', $reserva); //reotrna la vista de edición de habitación
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
        $reserva = Reserva::find($id); //Busca la id recibida en la tabla habitacion
        $reserva-> estado = $request->estado; //En las siguientes lineas remplaza los datos a modificar en la base de datos
        $reserva->save(); //Guarda los datos modificados en la base de datos
        return redirect()->route('r_reservaciones'); //redirije a la ruta lista_habitaciones
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $reser = Reserva::find($id);  //borramos una reservacion que el cliente desee y nos manda a la vista de todas las reservaciones
        $reser->delete();
        return redirect()->route('r_reservaciones');
    }
}
