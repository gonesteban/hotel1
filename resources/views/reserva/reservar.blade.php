@extends('layouts.app')

@section('title', 'reserva')

@section('content')

<div class= "container">
		<h2>Reservacion</h2> <!-- formulario para realizar la reserva-->
		<form class="form-group" method="POST" action="/reserva">
				@csrf
			<div class="form-group">
				<label for="">ID usuario</label> <!-- aca se coloca el id del usuario a reservar, este campo ya esta definido con el valor. El usuario no lo puede cambair-->
				<input  type="text" name="id_users" class="form-control" value="{{ Auth::user()->id}}" readonly="readonly"  required>
			</div>
			<div class="form-group">
				<label for="">ID Habitacion</label><!--se coloca el id de la habitacion a reservar, ya esta definido. El usuario no lo puede cambiar-->
				<input type="text" name="id_habitacion" class="form-control" value="{{$habitacion->id}}" readonly="readonly"  required>
			</div>
			<div class="form-group">
				<label for="">Numero Personas</label> <!-- se coloca la cantidad de personas que tendra la reserva de la habitacion-->
				<input type="text" name="num_personas" class="form-control" value="{{$habitacion->capacidad}}" readonly="readonly" required>
			</div>
			<div class="form-group">
				<label for="">Numero de habitaciones a reservar</label>  <!-- el usuario coloca el numero de habitacion que quiere reservar de un mismo tipo-->
				<input type="text" name="cantidad" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="">Fecha Ingreso</label> <!-- el usuario coloca la fecha de inicio de la reserva-->
				<input type="date" name="fecha_ingreso"  min="<?php echo date('Y-m-d');?>" class="form-control" required>
			</div>
			<div class="form-group">
				<label for="">Fecha Salida</label>  <!-- el usuario coloca la fecha de salida de la reserva-->
				<input type="date" name="fecha_salida" min="<?php echo date('Y-m-d');?>" class="form-control" required>
			</div>
			<div class="form-group">
				<input  type="hidden" name="estado" class="form-control" value="1">
			</div>

		<button type="submit" class="btn btn-primary">Guardar</button>	<!-- nos direcciona al controlador donde se almacena la reserva-->
		<a href="/reserva" class="btn btn-primary">volver</a>			<!-- nos direcciona a la vista principal de las reservas-->

</form>
</div>

@endsection
