@extends('layouts.app')

@section('title', 'Busqueda')

@section('content')


	<div class= "container">
		<h2>Editar habitacion</h2>

		<form class="form-group" method="POST" action="/habitacion/{{$habitacion->id}}">
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
				<input type="text" name="tipo_habitacion" value="{{$habitacion->tipo_habitacion}}" class="form-control">
			</div>
      <div class="form-group">
				<label for="">Capacidad</label>
				<input type="text" name="capacidad" value="{{$habitacion->capacidad}}" class="form-control">
			</div>
      <div class="form-group">
				<label for="">Precio</label>
				<input type="text" name="precio" value="{{$habitacion->precio}}" class="form-control">
			</div>
			<div class="form-group">
				<label for="">Cantidad</label>
				<input type="text" name="cantidad" value="{{$habitacion->cantidad}}" class="form-control">
			</div>
			<center>
			<button type="submit"  class="btn btn-primary" >Actualizar</button>
			</center>
	</div>

</form>
@endsection
