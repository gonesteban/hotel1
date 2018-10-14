@extends('layouts.app')

@section('title', 'Error_fecha')

@section('content')

	<h2 align="center">Capacidad maxima</h2>
	<table class="table table-responsive table-striped">
    <div align="center" class="alert alert-danger" role="alert">Excediste la capacidad maxima de personas en la habitacion</div>
    <div align="center">
    	<a href="/reservadmin/create" class="btn btn-primary" onClick="javascript:history.go(-1)">volver</a>
    </div>
@endsection