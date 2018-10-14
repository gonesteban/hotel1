<?php

namespace hotel\Http\Controllers\Administrador;

use hotel\Http\Controllers\Controller;
use hotel\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Lista_usuariosController extends Controller
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
        $users = User::orderBy('id','ASC')->paginate(20); //Ordena y muestra de forma ascendente los usuarios registrados en la base de datos
        return view('admin.lista_usuarios')->with('users', $users);
    }

    public function mostrar()
    {
        $users = hotel::orderBy('id','ASC')->paginate(20); //Ordena y muestra de forma ascendente los usuarios registrados en la base de datos
        return view('admin.lista_usuarios.index')->with('usuarios', $users);
    }

     public function destroy($id)
    {
        $user = user::find($id); //Esta funcion elimina el usuario seleccionado
        $user -> delete();
        return redirect()->route('lista_usuarios');
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

         $user = user::find($id); //Esta funcion realiza la modificacion del usuario
          $user-> name = $request->name;
          $user-> apellidos = $request->apellidos;
          $user-> email = $request->email;
          $user-> telefono = $request->telefono;
          $user->save();
         return redirect()->route('home');
    }
}
