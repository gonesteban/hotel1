<!DOCTYPE html>
<html>
<head>
	<title>Reporte de ventas</title>
</head>
<body>

	<table class = "table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Precio</th>
				<th>Fecha Ingreso</th>
				<th>Fecha Salida</th>

			</tr>
		</thead>
		<tbody>
			@foreach($reserva as $rese)
				<tr>
					<td>{{ $rese->id}}</td>
					<td>{{ $rese->costo}}</td>
					<td>{{ $rese->fecha_ingreso}}</td>
					<td>{{ $rese->fecha_salida}}</td>
				</tr>
			@endforeach
		</tbody>
	</table>


</body>
</html>
