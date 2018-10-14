@extends('layouts.app')

@section('title', 'Guardado')

@section('content')

    <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <br>
                                <h4 align="center" class="title">Botela</h4>
                                <br>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover table-striped"> <!-- se crea la tabla para mostras los datos de la boleta-->
                                            <thead>
                                                <tr> <!-- nos muestra el detalle de la boleta que debera cancelar el cliente-->
                                                    <th>Fecha de ingreso</th>
                                                    <th>Fecha de salida</th>
                                                    <th>Cantidad de habitaciones reservadas</th>
                                                    <th>Precio por habitacion</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            	<tr>
                                                                    <td>{{$reserva->fecha_ingreso}}</td> <!-- muestra la fecha de ingreso-->
                                                                    <td>{{$reserva->fecha_salida}}</td> <!-- muestra la fecha de salida-->
                                                                    <td>{{$cant}}</td>				<!-- muestra la cantidad de habitaciones que reservara de un tipo-->
                                                                    <td>{{$reserva->costo}}</td>	<!-- muestra el costo de cada habitacion-->
                                                                    <td>{{$total}}</td>				<!-- muestra el total que debera cancelar el cliente-->
                                                                   
                                                </tr>
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

		<table class="table table-responsive table-striped">
	    <div align="center" class="alert alert-success">Reserva realizada con exito</div>
        <div align="center">
    	<a  href="/reservas" class="btn btn-primary">volver</a><!-- retorna la vista principal de las reservas-->
    </div>
    </div>
@endsection