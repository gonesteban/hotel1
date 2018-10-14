<?php

namespace hotel\Http\Controllers;

use hotel\hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
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
       $user = Auth::User();
       if(!isset($user))
           return view('welcome');
       if($user->tipo == 'secretaria')
           return view('/secretaria/secretaria');
       if($user->tipo == 'recepcionista')
           return view('/recepcionista/recepcionista');
       if($user->tipo == 'digitador')
           return view('/digitador/digitador');

       else if($user->tipo == 'admin')
            return view('/admin/administrador');
            else
            return view('home');
       
   }
}
