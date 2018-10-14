@extends('layouts.app')

@section('title', 'Busqueda')

@section('content')


	<div class= "container">
		<h2>Confirmar habitacion</h2>

		<form class="form-group" method="POST" action="/s_confirmar/{{$habitacion->id}}">
        @method('PUT')
				@csrf
			<div class="form-group">
				<label for="">Id Habitacion</label>
				<input type="text" name="id" value="{{$habitacion->id}}" readonly="readonly"  class="form-control">
			</div>
			<div class="form-group">
				<label for="">Id Hotel</label>
				<input type="text" name="nombre_hotel" value="{{$habitacion->id_hotel}}" readonly="readonly"  class="form-control">
			</div>
      <div class="form-group">
				<label for="">Tipo Habitacion</label>
				<input type="text" name="tipo_habitacion" value="{{$habitacion->tipo_habitacion}}" readonly="readonly" class="form-control">
			</div>
      <div class="form-group">
				<label for="">Capacidad</label>
				<input type="text" name="capacidad" value="{{$habitacion->capacidad}}" readonly="readonly" class="form-control">
			</div>
      <div class="form-group">
				<label for="">Precio</label>
				<input type="text" name="precio" value="{{$habitacion->precio}}" readonly="readonly" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Cantidad</label>
				<input type="text" name="cantidad" value="{{$habitacion->cantidad}}" readonly="readonly" class="form-control">
			</div>
			<div class="form-group">
				<input type="hidden" name="estado" value="1" class="form-control">
			</div>
			<center>
			<button type="submit"  class="btn btn-primary" >Aceptar Habitación</button>
			<a href="/s_confirmar_datos" class="btn btn-primary">volver</a>
			</center>
	</div>

</form>
@endsection