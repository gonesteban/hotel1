@extends('layouts.app')

@section('title', 'Busqueda')

@section('content')


	<div class= "container">
		<h2>Editar habitacion</h2>

		<form class="form-group" method="POST" action="/d_habitaciones/{{$habitacion->id}}">
        @method('PUT')
				@csrf
	            <div class="form-group">
					<label for="">Id Habitacion</label>
					<input type="text" name="id" value="{{$habitacion->id}}" readonly="readonly"  class="form-control">
				</div>
           		<div class="form-group">
                    <label for="">Valor de la Oferta</label>
                    <input type="text" name="valor_oferta" class="form-control" placeholder="Valor oferta" required>
                </div>
                <div class="form-group">
                    <label for="">Fecha Inicial Oferta</label>
                    <input type="date" name="fecha_inicio"  min="<?php echo date('Y-m-d');?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="">Fecha Final Oferta</label>
                    <input type="date" name="fecha_final"  min="<?php echo date('Y-m-d');?>" class="form-control" required>
                </div>
			<center>
			<button type="submit"  class="btn btn-primary" >Actualizar</button>
			</center>
	</div>

</form>
@endsection
