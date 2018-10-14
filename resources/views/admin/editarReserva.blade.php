@extends('layouts.app')

@section('title', 'Busqueda')

@section('content')


	<div class= "container">
		<h2>Actualizar estado</h2>
		<h5>Estado</h5>
		<br>

		<form class="form-group" method="POST" action="/admin_reserva/{{$reserva->id}}">
        @method('PUT')
				@csrf
			<div class="row">
				<div class="col-md-8">
					<input type="text" placeholder="Activo" readonly="readonly"  class="form-control">
				</div>
				<div class="form-group">
					<input type="hidden" name="estado" value="1"  readonly="readonly"  class="form-control">
				</div>
				<center>
				<button type="submit"  class="btn btn-primary" >Actualizar</button>
				</center>
			</div>
		</form>
	</div>

	<div class= "container">

		<form class="form-group" method="POST" action="/admin_reserva/{{$reserva->id}}">
        @method('PUT')
				@csrf
			<div class="row">
				<div class="col-md-8">
					<input type="text" placeholder="Cancelado" readonly="readonly"  class="form-control">
				</div>
				<div class="form-group">
					<input type="hidden" name="estado" value="0"  readonly="readonly"  class="form-control">
				</div>
				<center>
				<button type="submit"  class="btn btn-primary" >Cancelar</button>
				</center>
			</div>
		</form>
	</div>

	

@endsection
