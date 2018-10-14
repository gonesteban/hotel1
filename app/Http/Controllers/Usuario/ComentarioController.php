<?php

namespace hotel\Http\Controllers\Usuario;

use hotel\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComentarioController extends Controller
{
	public function index()
	{
			return view('');
	}
	public function show($id)
 {
	 $comentario = DB::table('comentario')   // obtenemos todos los datos de la habitacion y la retornamos a la vista de reserva
	 							 ->select('comentario.id','comentario.id_habitacion','comentario.comentarios')
								 ->where('comentario.id_habitacion', $id)->get(); // se obtiene el primer resultado

	 return view('comentarios', compact('comentario'));

	}
	public function store($id)
    {

    }

}
