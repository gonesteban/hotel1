@extends('layouts.app')

@section('title', 'Error_fecha')

@section('content')
	
	<!--muestra una vista de error si la fecha de inicio es mayor a la de salida-->
	<h2 align="center">Comentario</h2>
	<table class="table table-responsive table-striped">
    <div align="center" class="alert alert-success" role="alert">El comentario fue realizado con exito</div>
    <div align="center">
    	<a href="/reservas" class="btn btn-primary" >volver</a>
    </div>
@endsection