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
                                <h4 align="center" class="title">Comentarios de la habitacion</h4>
                                <br>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <tr>  <!--mostramos los nombres de las variables en la cabezera de la tabla-->
                                                    <th>ID Habitacion</th>
                                                    <th>Comentarios</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                              @foreach($comentario as $comen) <!--recorre todos los registro de los comentarios encontrados y los muestra en la vista-->
                                              <tr>

                                              <td>{{$comen->id}}</td>
                                              <td>{{$comen->comentarios}}</td>
                                              </tr>
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
