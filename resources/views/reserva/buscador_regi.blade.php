@extends('layouts.app')

@section('title', 'reserva')

@section('content')
    <!--En esta seccion se mostraran todos las habitaciones segun el tipo que ha seleccionado -->
    <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <br>
                                <h4 align="center" class="title">Habitaciones</h4>
                                <br>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>  <!--mostramos los nombres de las variables en la cabezera de la tabla-->
                                                    <th>ID Habitacion</th>
                                                    <th>Nombre Hotel</th>
                                                    <th>Tipo de habitacion</th>
                                                    <th>Capacidad</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>Disponibles</th>
                                                    <th>Reservar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($habitacion as $habitacion) <!-- recorremos las habitacion que se encontraron en la busqueda-->
                                                    <?php $variable = 0 ?>  <!-- inicializamos una variable en 0 con la que veremos si existieron o no coicidencias en las fechas-->
                                                    @foreach($conta as $contador)  <!-- recorremos los id de las habitacion con las coincidencias que se encontraron en la busqueda-->
                                                        @if($habitacion->id == $contador->id_habitacion)<!-- revisamos si la habitacion coincide con algun registro de las reservas-->
                                                            <?php $variable++ ?>                        <!-- si coincide con alguno se le suma uno a la variable-->
                                                            @if($habitacion->cantidad > $contador->contador) <!-- revisa si las coincidencias en una fecha determinada supera la cantidad de habitaciones a disposicion para reservar-->

                                                                 <tr>       <!-- muestra en pantalla los datos de la habitacion disponibles para poder reservar-->
                                                                    <td>{{$habitacion->id}}</td>
                                                                    <td>{{$habitacion->nombre_hotel}}</td>
                                                                    <td>{{$habitacion->tipo_habitacion}}</td>
                                                                    <td>{{$habitacion->capacidad}}</td>
                                                                    <td>{{$habitacion->precio}}</td>
                                                                    <td>{{$habitacion->cantidad}}</td>
                                                                    <td>{{$habitacion-> cantidad - $contador->contador}}</td><!-- muestra las habitaciones disponibles-->
                                                                    <td><a href="{{ route('reserva.show', $habitacion->id) }}" class="btn btn-primary">Reservar</a><a  href="{{ route('comentarios.show', $habitacion->id) }}" class="btn btn-danger">Valoracion</a></td>
                                                                </tr>
                                                            @endif

                                                        @endif

                                                    @endforeach

                                                    @if($variable == 0) <!-- si la varible sigue en 0 significa que la habitacion no tiene ninguna reserva y se puede reservar-->
                                                         <tr>       <!-- muestra todas las habitaciones disponibles a reservar-->
                                                                    <td>{{$habitacion->id}}</td>
                                                                    <td>{{$habitacion->nombre_hotel}}</td>
                                                                    <td>{{$habitacion->tipo_habitacion}}</td>
                                                                    <td>{{$habitacion->capacidad}}</td>
                                                                    <td>{{$habitacion->precio}}</td>
                                                                    <td>{{$habitacion->cantidad}}</td>
                                                                    <td>{{$habitacion-> cantidad}}</td>
                                                                    <td>
                                                                        <a href="{{ route('reserva.show', $habitacion->id) }}" class="btn btn-primary">Reservar</a><a  href="{{ route('comentarios.show', $habitacion->id) }}" class="btn btn-danger">Valoracion</a>  <!-- nos manda al formulario para realizar la reserva-->
                                                                    </td>
                                                                </tr>

                                                    @endif

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div align="center">
            <a href="/reserva" class="btn btn-primary">volver</a> <!-- volvemos a la pagina principal de la reserva-->
    </div>

@endsection
