@extends('layouts.app')

@section('title', 'Guardado')

@section('content')

	<h2 align="center">Reservacion</h2>
	<table class="table table-responsive table-striped">
    <div align="center" class="alert alert-danger" role="alert">No existe disponibilidad</div>
    <div align="center">
    	<a href="/reservadmin/create" class="btn btn-primary" onClick="javascript:history.go(-1)">volver</a>
    </div>
@endsection