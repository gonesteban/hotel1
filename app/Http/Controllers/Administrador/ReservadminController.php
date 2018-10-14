<?php

namespace hotel\Http\Controllers\Administrador;

use hotel\Http\Controllers\Controller;
use hotel\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class ReservadminController extends Controller
{
/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.reserva.buscador_tipo');
    }
    public function mostrar() // funcion que entrega las reservas en la pagina personal del usuario
    {

         $reserva = Reserva::orderBy('id','ASC')->paginate(3);

         return view('admin.reservas')->with('reserva', $reserva);
    }
    public function mostrar1()// funcion que entrega las reservas en la pagina personal del usuario
    {

         $reserva = Reserva::orderBy('id','ASC')->paginate(3);

         return view('admin.reservas')->with('reserva', $reserva);
    }

    public function mostrar2()// funcion que entrega las reservas en la pagina de administrador
    {

         $reserva = Reserva::orderBy('id','ASC')->paginate(3);

         return view('admin.reservas')->with('reserva', $reserva);
    }


    public function buscador(Request $request)
    {
         $fi = $request->fecha_ingreso;
         $ff = $request->fecha_salida;

         $conta = DB::table('reserva')
                ->join('habitacion', 'habitacion.id', '=', 'reserva.id_habitacion')
                ->select('reserva.id_habitacion',DB::raw('count(*) as contador'))
                ->where([
                            ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                            ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                            ])
                ->orwhere([
                            ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                            ['reserva.fecha_salida', '>', $request->fecha_salida],
                            ])
                ->orwhere([
                            ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                            ['reserva.fecha_salida', '=', $request->fecha_salida],
                            ])
                ->orwhere([
                            ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                            ])
                ->orwhere([
                            ['reserva.fecha_salida', '=', $request->fecha_salida],
                            ])
                ->orwhere([
                            ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                            ['reserva.fecha_salida', '<', $request->fecha_salida],
                    ])
                ->groupBy('reserva.id_habitacion')
                ->get();



        // aca realizamos la busqueda de las habitacion segun los campos proporcionados por el cliente

        $habitacion = DB::table('habitacion')
                      ->join('hotel', 'hotel.id', '=', 'habitacion.id_hotel')
                      ->join('ciudad', 'ciudad.id', '=', 'hotel.id_ciudad')
                      ->join('pais', 'pais.id', '=', 'ciudad.id_pais')
                      ->select('habitacion.id', 'hotel.nombre_hotel','ciudad.nombre_ciudad', 'habitacion.tipo_habitacion', 'habitacion.capacidad', 'habitacion.precio','habitacion.cantidad')

                      ->where([
                            ['habitacion.tipo_habitacion', '=', $request->tipo_habitacion], //compara en la base de datos, el tipo de habitacion, ciudad y pais que dio el cliente
                            ['ciudad.nombre_ciudad', '=', $request->nombre_ciudad],
                             ['pais.nombre_pais', '=', $request->nombre_pais],
                             ['habitacion.capacidad', '=', $request->capacidad],
                             ['habitacion.estado', '=', 1]
                            ])

                      ->get();


                      if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) )
                      {

                        return view('admin.reserva.buscador_regi',compact('habitacion'), compact('conta','fi','ff'));
                        

                      }
                      else{
                            return view('admin.reserva.errorfecha_busca');  // manda error si la fecha de salida es menor a la de ingreso
                      }

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reserva.create');
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
                        ->where([
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_ingreso', '<', $request->fecha_ingreso],
                            ['reserva.fecha_salida', '>', $request->fecha_ingreso],
                            ])
                        ->orwhere([
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_ingreso', '<', $request->fecha_salida],
                            ['reserva.fecha_salida', '>', $request->fecha_salida],
                            ])
                        ->orwhere([
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                            ['reserva.fecha_salida', '=', $request->fecha_salida],
                            ])
                         ->orwhere([
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_ingreso', '=', $request->fecha_ingreso],
                            ])
                         ->orwhere([
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_salida', '=', $request->fecha_salida],
                            ])
                         ->orwhere([
                            ['habitacion.id', '=',$request->id_habitacion],
                            ['reserva.fecha_ingreso', '>', $request->fecha_ingreso],
                            ['reserva.fecha_salida', '<', $request->fecha_salida],
                    ])
                        ->get();

                        $cantotal = $request->cantidad + $reserva->count();
                        // return $cantotal;

                        if (($request->input('fecha_ingreso')) <= ($request->input('fecha_salida')) ) {

                            if ($cantotal <= $cantidad->cantidad) {
                                 $cos = DB::table('habitacion')
                                        ->select('habitacion.precio', 'habitacion.capacidad')
                                        ->where('habitacion.id', $request->id_habitacion)->first();

                                if($cos->capacidad  >= $request->input('num_personas')){

                                    $fi = Carbon::parse($request->input('fecha_ingreso'));
                                    $ff = Carbon::parse($request->input('fecha_salida'));
                                    $dias = $ff->diffIndays($fi);
                                    if($dias == 0){
                                        $dias++;
                                    }


                                     for ($i=0; $i < $request->cantidad; $i++) {
                                        $reserva = new Reserva();
                                        $reserva->id_users = $request->input('id_users');
                                        $reserva->id_habitacion = $request->input('id_habitacion');
                                        $reserva->num_personas = $request->input('num_personas');
                                        $reserva->costo = $dias * $cos->precio;
                                        $reserva->fecha_ingreso = $request->input('fecha_ingreso');
                                        $reserva->fecha_salida = $request->input('fecha_salida');
                                        $reserva->estado = $request->input('estado');
                                        $reserva->save();
                                    }




                                    return view('admin.reserva.guardado');
                                }
                                else{
                                    return view('admin.reserva.errornumper');
                                }
                            }
                            else {
                                return view('admin.reserva.nodisponibilidad');
                            }
                        }
                        else{
                            return view('admin.reserva.errorfecha');
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
        $habitacion = DB::table('habitacion')
                      ->where('habitacion.id', $id)->first();

        return view('admin.reserva.reservar', compact('habitacion'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reserva = Reserva::find($id);//busca la id recibida en la base de datos
        return view('admin.editarReserva')->with('reserva', $reserva); //reotrna la vista de edición de habitación
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
        return redirect()->route('reservaciones'); //redirije a la ruta lista_habitaciones
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reser = Reserva::find($id);
        $reser->delete();
        return redirect()->route('reserva');
    }
    public function destroy1($id)
    {
        $reser = Reserva::find($id);
        $reser->delete();
        return redirect()->route('reservaciones');
    }
}
