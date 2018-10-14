<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', 'HomeController@index')-> name('home');


/*Usuario*/
Route::get('/perfil', function () {
    return view('PerfilUser');
})->name('perfil');

Route::get('/reservas', function () {
    return view('ReservaUser');
});

Route::resource('reserva', 'Usuario\ReservaController');

Route::post('reserva/buscador', 'Usuario\ReservaController@buscador');
Route::post('reserva/store', 'Usuario\ReservaController@store');
Route::post('reserva/guardarcomentario', 'HabitacionController@guardarcomentario');

Route::get('reserva/{id}',['as' => 'reserva.show', 'uses' => 'Usuario\ReservaController@show']);
Route::get('habitacion/{id}',['as' => 'habitacion.comentario', 'uses' => 'HabitacionController@comentario']);

Route::get('reservas/{id}/destroy',[
    'uses' => 'Usuario\ReservaController@destroy',
    'as'   => 'reserva.destroy']
  );
  Route::get('reservas/{id}/destroy1',[
      'uses' => 'Usuario\ReservaController@destroy1',
      'as'   => 'reserva.destroy1']
    );

Route::get('/reservas',
    [
    'uses' => 'Usuario\ReservaController@mostrar',
    'as'   => 'reserva']);


Route::get('/perfil', 'Usuario\ReservaController@mostrar1');
Route::resource('comentarios', 'Usuario\ComentarioController');
Route::get('/comentarios', 'Usuario\ComentarioController@index')->name('comentarios');

Route::resource('habitacion', 'HabitacionController');
Route::post('/habitacion/{id}', 'HabitacionController@update');
Route::resource('users', 'Administrador\Lista_usuariosController');
Route::post('/users/{id}', 'Administrador\Lista_usuariosController@update');
Route::get('/reservaciones',
    [
    'uses' => 'Usuario\ReservaController@mostrar2',
    'as'   => 'reservaciones']);



Route::resource('hotel', 'HotelController');


Route::get('lista_habitaciones/{id}/destroy',[
    'uses' => 'HabitacionController@destroy',
    'as'   => 'lista_habitaciones.destroy']
);

/*Administrador */

Route::get('/administrador', function () {
    return view('/admin/administrador');
});

Route::resource('reporte', 'Administrador\ReporteventaController');
Route::post('/admin_reporte', 'Administrador\ReporteventaController@busqueda');

Route::get('fechas', function () {
    return view('/admin/fechas');
});



Route::get('/lista_habitaciones', 'HabitacionController@index')->name('lista_habitaciones');
Route::get('/lista_hoteles', 'Administrador\Lista_hotelesController@index')->name('lista_hoteles');
Route::get('/lista_usuarios', 'Administrador\Lista_usuariosController@index')->name('lista_usuarios');

Route::get('/ingresar_habitacion', function () {
    return view('/admin/ingresar_habitacion');
});
Route::get('/ingresar_hotel', function () {
    return view('/admin/ingresar_hotel');
});

Route::get('/reportes', function () {
    return view('/admin/reportes_admin');
});

                    /*Ingresar habitaciones y hoteles admin*/
Route::get('/ingresar', 'Administrador\AgregarController@create');
Route::post('/agregado_habitacion', 'Administrador\AgregarController@store');
Route::post('/agregado_hotel', 'Administrador\Agregar_hotelController@store');



                    /*Rserva Admin */
Route::get('/reserva_admin', function () {
        return view('/admin/reserva_admin');
    });

Route::resource('admin_reserva', 'Administrador\ReservadminController');
Route::post('reservadmin/buscador', 'Administrador\ReservadminController@buscador');
Route::post('reservadmin/store', 'Administrador\ReservadminController@store');
Route::get('reservadmin/{id}',['as' => 'reservadmin.show', 'uses' => 'Administrador\ReservadminController@show']);

                    /*Destroy*/

Route::get('lista_hoteles/{id}/destroy',[
    'uses' => 'Administrador\Lista_hotelesController@destroy',
    'as'   => 'lista_hoteles.destroy']
);
Route::get('lista_usuarios/{id}/destroy',[
    'uses' => 'Administrador\Lista_usuariosController@destroy',
    'as'   => 'lista_usuarios.destroy']
);


/*Digitador*/

Route::get('/digitador', function () {
    return view('/digitador/digitador');
});


Route::get('/d_ingresar_habitacion', 'Digitador\Digitador_agregarController@create');
Route::post('/d_agregado_habitacion', 'Digitador\Digitador_agregarController@store');


Route::get('/d_listado_habitaciones', 'Digitador\Digitador_agregarController@index')->name('d_listado_habitaciones');
Route::get('/d_lista_habitaciones', 'Digitador\Digitador_agregarController@index2')->name('d_lista_habitaciones');
Route::resource('d_habitaciones', 'Digitador\Digitador_agregarController');

Route::get('d_lista_habitaciones/{id}/destroy',[
    'uses' => 'Digitador\Digitador_agregarController@destroy',
    'as'   => 'd_habitaciones.destroy']
);

Route::get('d_listado_habitaciones/{id}/cancel',[
    'uses' => 'Digitador\Digitador_agregarController@cancel',
    'as'   => 'd_habitaciones.cancel']
);


/*Secretaria*/

Route::get('/secretaria', function () {
    return view('/secretaria/secretaria');
});

                    /*Hoteles*/
Route::get('/s_listado_hoteles', 'Secretaria\SecretariaController@index')->name('s_listado_hotel');
Route::resource('hoteles', 'Secretaria\SecretariaController');

Route::post('/hoteles/{id}', 'Secretaria\SecretariaController@update');

                    /*Habitaciones*/
Route::get('/s_listado_habitaciones', 'Secretaria\S_habitacionController@index')->name('s_listado_habitaciones');
Route::resource('habitaciones', 'Secretaria\S_habitacionController');




/*Route::post('/habitaciones/{id}', 'HabitacionController@update');*/


                    /*Confirmar Datos*/

Route::get('/s_confirmar_datos', 'Secretaria\S_confirmarController@index')->name('s_confirmar_datos');
Route::resource('s_confirmar', 'Secretaria\S_confirmarController');



/*Recepcionista*/

Route::get('/recepcionista', function () {
    return view('/recepcionista/recepcionista');
});
Route::resource('r_reservaciones', 'Recepcionista\RecepcionistaController');
Route::get('/r_reservaciones',
    [
    'uses' => 'Recepcionista\RecepcionistaController@mostrar',
    'as'   => 'r_reservaciones']);

Route::get('r_reserva/{id}/destroy',[
      'uses' => 'Recepcionista\RecepcionistaController@destroy',
      'as'   => 'r_reserva.destroy']
    );
