@extends('layouts.app')

@section('title', 'Busqueda')

@section('content')


	<div class= "container">
		<h2>Editar Hotel</h2>

		<form class="form-group" method="POST" action="/hoteles/{{$hoteles->id}}">
        @method('PUT')
				@csrf
			<div class="form-group">
				<label for="">Id Hotel</label>
				<input type="text" name="id" value="{{$hoteles->id}}" readonly="readonly"  class="form-control">
			</div>
			<div class="form-group">
				<label for="">Nombre Hotel</label>
				<input type="text" name="nombre_hotel" value="{{$hoteles->nombre_hotel}}"  class="form-control">
			</div>
      <div class="form-group">
				<label for="">Id Ciudad</label>
				<input type="text" name="id_ciudad" value="{{$hoteles->id_ciudad}}" class="form-control">
			</div>
			<center>
			<button type="submit"  class="btn btn-primary" >Actualizar</button>
			</center>
	</div>

</form>
@endsection