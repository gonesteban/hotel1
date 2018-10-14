@extends('layouts.app')

@section('title', 'Error_fecha')

@section('content')

	<!--muestra error si la capacidad es superior a la capacidad de la habitacion-->
	<h2 align="center">Capacidad maxima</h2>
	<table class="table table-responsive table-striped">
    <div align="center" class="alert alert-danger" role="alert">Excediste la capacidad maxima de personas en la habitacion</div>
    <div align="center">
    	<a href="/reserva/create" class="btn btn-primary" onClick="javascript:history.go(-1)">volver</a>
    </div>
@endsection