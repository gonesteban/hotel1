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
                                                <tr>
                                                    <th>ID Habitacion</th>
                                                    <th>Nombre Hotel</th>
                                                    <th>Tipo de habitacion</th>
                                                    <th>Capacidad</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>Disponibles</th>
                                                    <th>Desde</th>
                                                    <th>Hasta</th>

                                                    <th>Reservar</th>


                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($habitacion as $habitacion)
                                                    <?php $variable = 0 ?>
                                                    @foreach($conta as $contador)
                                                        @if($habitacion->id == $contador->id_habitacion)
                                                            <?php $variable++ ?>
                                                            @if($habitacion->cantidad > $contador->contador)

                                                                 <tr>
                                                                    <td>{{$habitacion->id}}</td>
                                                                    <td>{{$habitacion->nombre_hotel}}</td>
                                                                    <td>{{$habitacion->tipo_habitacion}}</td>
                                                                    <td>{{$habitacion->capacidad}}</td>
                                                                    <td>{{$habitacion->precio}}</td>
                                                                    <td>{{$habitacion->cantidad}}</td>
                                                                    <td>{{$habitacion-> cantidad - $contador->contador}}</td>

                                                                    <td>
                                                                        <a href="{{ route('reservadmin.show', $habitacion->id) }}" class="btn btn-primary">Reservar</a>
                                                                    </td>
                                                                </tr>
                                                            @endif

                                                        @endif



                                                    @endforeach

                                                    @if($variable == 0)
                                                         <tr>
                                                                    <td>{{$habitacion->id}}</td>
                                                                    <td>{{$habitacion->nombre_hotel}}</td>
                                                                    <td>{{$habitacion->tipo_habitacion}}</td>
                                                                    <td>{{$habitacion->capacidad}}</td>
                                                                    <td>{{$habitacion->precio}}</td>
                                                                    <td>{{$habitacion->cantidad}}</td>
                                                                    <td>{{$habitacion-> cantidad}}</td>
                                                                    <td>
                                                                        <a href="{{ route('reservadmin.show', $habitacion->id) }}" class="btn btn-primary">Reservar</a>

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
            <a href="/reserva_admin" class="btn btn-primary">volver</a>
    </div>

@endsection
