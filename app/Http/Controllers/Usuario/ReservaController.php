<?php

namespace hotel\Http\Controllers\Usuario;

use hotel\Http\Controllers\Controller;
use hotel\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reserva.buscador_tipo');
    }
    public function mostrar() // funcion que entrega las reservas en la pagina personal del usuario
    {

         $reserva = Reserva::orderBy('id','ASC')->paginate(3);

         return view('ReservaUser')->with('reserva', $reserva);
    }
    public function mostrar1()// funcion que entrega las reservas en la pagina personal del usuario
    {

         $reserva = Reserva::orderBy('id','ASC')->paginate(3);

         return view('PerfilUser')->with('reserva', $reserva);
    }

    public function mostrar2()// funcion que entrega las reservas en la pagina de administrador
    {

         $reserva = Reserva::orderBy('id','ASC')->paginate(3);

         return view('admin.reservas')->with('reserva', $reserva);
    }


public function buscador(Request $request)
    {
        // realizamos una consulta a la base de datos para obtener los id de las habitaciones y que cuente las reservas realizadas en una misma fecha para cada habitacion
         $conta = DB::table('reserva') //consultamos en la tabla reserva
                ->join('habitacion', 'habitacion.id', '=', 'reserva.id_habitacion') //se conecta la tabla reservacon habitacion
                ->select('reserva.id_habitacion',DB::raw('count(*) as contador')) // consultamos por el id habitacion y contamos las coicidencias
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
                ->groupBy('reserva.id_habitacion')  //agrupamos las coincidencias por el id de la habitacion
                ->get();


        // aca realizamos la busqueda de las habitacion segun los campos proporcionados por el cliente

        $habitacion = DB::table('habitacion') //consultamos en la tabla habitacion y se le asigna la busqueda a una variable
                      ->join('hotel', 'hotel.id', '=', 'habitacion.id_hotel') //se une la tabla hotel con habitacion
                      ->join('ciudad', 'ciudad.id', '=', 'hotel.id_ciudad') //se une la tabla hotel con ciudad
                      ->join('pais', 'pais.id', '=', 'ciudad.id_pais') //se une la tabla ciudad con pais
                      ->select('habitacion.id', 'hotel.nombre_hotel','ciudad.nombre_ciudad', 'habitacion.tipo_habitacion', 'habitacion.capacidad', 'habitacion.precio','habitacion.cantidad') //consultamos por algunos campos de las diferentes tablas

                      ->where([                                             //compara en la base de datos, el tipo de habitacion, ciudad y pais que dio el cliente. Asi mostramos las habitaciones que cumplen con esa condicion
                            ['habitacion.tipo_habitacion', '=', $request->tipo_habitacion],
                            ['ciudad.nombre_ciudad', '=', $request->nombre_ciudad],
                             ['pais.nombre_pais', '=', $request->nombre_pais],
                             ['habitacion.capacidad', '=', $request->capacidad],
                             ['habitacion.estado', '=', 1]
                            ])

                      ->get();

                      if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) )
                      {
                            return view('reserva.buscador_regi',compact('habitacion'), compact('conta')); //retornamos la variable habitacion(con la que buscamos el pais, ciudad y tipo) y conta(con la que buscamos las fechas en donde coincide)
                      }
                      else{
                            return view('reserva.errorfecha_busca');  // manda error si la fecha de salida es menor a la de ingreso
                      }
        //return $request->tipo_habitacion;
                       // return $conta;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reserva.create'); //retornamos a la vista del formulario
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //buscamos el numero de habitaciones que existen en el hotel de un tipo en especifico
        $cantidad = DB::table('habitacion')
                    ->select('habitacion.cantidad')
                    ->where('habitacion.id', $request->id_habitacion)->first();
                    // return $cantidad->cantidad;
        // $cantotal = $request->cantidad + $cantidad->cantidad;

        $reserva = DB::table('reserva')
                        ->join('habitacion', 'habitacion.id', '=', 'reserva.id_habitacion')
                        ->join('hotel', 'hotel.id', '=', 'habitacion.id_hotel')
                        ->select('habitacion.id', 'hotel.nombre_hotel', 'habitacion.tipo_habitacion', 'habitacion.capacidad', 'habitacion.precio')
                        // ->where('habitacion.id', '=',$request->id_habitacion)
                        ->where([               //condicionamos si la fecha de ingreso consultada esta entre medio de la fecha de ingreso con la de salida de las ya reservaa
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                            ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                            ])
                        ->orwhere([             //condicionamos si la fecha de salida consultada esta entre medio de la fecha de ingreso con la de salida de las ya reservada
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                            ['reserva.fecha_salida', '>', $request->fecha_salida],
                            ])
                        ->orwhere([             //condicionamos si la fecha de ingreso y salida de la consulta coincide con la de las reservadas
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                            ['reserva.fecha_salida', '=', $request->fecha_salida],
                            ])
                         ->orwhere([                //condicionamos si solo reserva un dia
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                            ])
                         ->orwhere([    //condicionamos si solo reserva un dia
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_salida', '=', $request->fecha_salida],
                            ])
                         ->orwhere([                //condicionamos si la fecha consultada contiene a una fecha ya reservada
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                            ['reserva.fecha_salida', '<', $request->fecha_salida],
                    ])
                        ->get();

                        $cantotal = $request->cantidad + $reserva->count(); //obtenemos la cantidad total de reservaciones a realizar en una fecha
                        // return $cantotal;

                        if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) { //Revisamos si la fecha de salida es menos a la de ingreso

                            if ($cantotal <= $cantidad->cantidad) {   // revisamos si la cantidad total a reservar supera la cantidad de habitaciones de un tipo especifico
                                 $cos = DB::table('habitacion')             // obtenemos el costo de la habitacion
                                        ->select('habitacion.precio', 'habitacion.capacidad')
                                        ->where('habitacion.id', $request->id_habitacion)->first();

                                if($cos->capacidad  >= $request->input('num_personas')){ // revisamos si el numero de personas supera la capacidad permitida en la habitacion

                                    $fi = Carbon::parse($request->input('fecha_ingreso')); // obtenemos la fecha de ingreso
                                    $ff = Carbon::parse($request->input('fecha_salida')); // obtenemos la fecha de salida
                                    $dias = $ff->diffIndays($fi);    // sacamos los numeros de dias entre la fecha de salida con la de ingreso
                                    if($dias == 0){ // si la diferencia es cero se le suma uno
                                        $dias++;
                                    }


                                     for ($i=0; $i < $request->cantidad; $i++) {           // reservamos el numero de habitacion que el usuario desea
                                        $reserva = new Reserva();           // guardamos en la tabla reserva de la base de datos los datos ingresados
                                        $reserva->id_users = $request->input('id_users');
                                        $reserva->id_habitacion = $request->input('id_habitacion');
                                        $reserva->num_personas = $request->input('num_personas');
                                        $reserva->costo = $dias * $cos->precio;                        //calculamos el costo total de la habitacion, por el precio de la habitacion por los dias que estara
                                        $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                        $reserva->fecha_salida = $request->input('fecha_salida');
                                        $reserva->estado = $request->input('estado');
                                        $reserva->save();       // se guarda en la base de datos
                                    }

                                    $cant = $request->cantidad;         //obtenemos la cantidad de habitacion a reservar
                                    $total = $request->cantidad * $reserva->costo; //obtenemos el costo total que debera cancelar el clientes

                                    return view('reserva.guardado', compact('reserva'), compact('total', 'cant')); // retornamos los datos de la reserva, la cantidad de habitacion y el costo total
                                    // return $cantidadhabitacion;
                                }
                                else{
                                    return view('reserva.errornumper'); // manda a la vista de error si el numero de persona supera a la permitida en la habitacion
                                }
                            }
                            else {
                                return view('reserva.nodisponibilidad'); // manda a la vista de error si no hay disponibilidad para la fecha determinada
                            }
                        }
                        else{
                            return view('reserva.errorfecha');  // manda error si la fecha de salida es menor a la de ingreso
                        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
   {
        $habitacion = DB::table('habitacion')   // obtenemos todos los datos de la habitacion y la retornamos a la vista de reserva
                      ->where('habitacion.id', $id)->first(); // se obtiene el primer resultado

        return view('reserva.reservar', compact('habitacion'));

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
        $reser = Reserva::find($id); //borramos una reservacion que el cliente desee
        $reser->delete();
        return redirect()->route('reserva');
    }
    public function destroy1($id)
    {
        $reser = Reserva::find($id);  //borramos una reservacion que el cliente desee y nos manda a la vista de todas las reservaciones
        $reser->delete();
        return redirect()->route('reservaciones');
    }
}
