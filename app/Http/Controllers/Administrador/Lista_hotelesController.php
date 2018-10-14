<?php

namespace hotel\Http\Controllers\Administrador;

use hotel\Http\Controllers\Controller;
use hotel\hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Lista_hotelesController extends Controller
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
        
        $hoteles = hotel::orderBy('id','ASC')->paginate(5); //Ordena los hoteles  de forma ascendente y retorna la vista
        return view('admin.lista_hoteles')->with('hoteles', $hoteles);
    }

    public function mostrar()
    {
        $hoteles = hotel::orderBy('id','ASC')->paginate(5); //Ordena los hoteles  de forma ascendente y retorna la vista
        return view('admin.lista_hoteles')->with('hoteles', $hoteles);
    }

     public function destroy($id)
    {
        $hotel = Hotel::find($id); // Esta funcion elimina el hotel seleccionado
        $hotel->delete();
        return redirect()->route('lista_hoteles');
    }


}
