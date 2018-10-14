<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Hotel ICI</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="pagina/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="pagina/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="pagina/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="pagina/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="pagina/css/pe-icon-7-stroke.css" rel="stylesheet" />
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="blue" data-image="pagina/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<div class="sidebar-wrapper">
            <div class="logo">
                <a class="simple-text" href="{{ url('/digitador') }}">
                    <img src="pagina/img/leon.png" border="0" width="200" height="100">
                </a>
            </div>

            <ul class="nav">
                <li>
                    <a href="d_lista_habitaciones">
                        <i class="pe-7s-note2"></i>
                        <p>Habitaciones Hotel {{ Auth::user()->name }}</p>
                    </a>
                </li>
                <li>
                    <a href="d_ingresar_habitacion">
                        <i class="pe-7s-note2"></i>
                        <p>Ingresar Habitacion</p>
                    </a>
                </li>
                <li class="active">
                    <a href="d_listado_habitaciones">
                        <i class="pe-7s-note2"></i>
                        <p>Habitaciones por confirmar</p>
                    </a>
                </li>


                <li class="active-pro">
                    <a href="">
                        <i class="pe-7s-rocket"></i>
                        <p>Creciendo cada Dia</p>
                    </a>
                </li>


							
            </ul>
    	</div>
    </div>

    <div class="main-panel">
		<nav class="navbar navbar-default navbar-fixed">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="secretaria">Bienvenido a Hoteles ICI </a>
                </div>
                <div class="collapse navbar-collapse">
                  <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                  <p>
                                      <i class="pe-7s-menu"></i>
                                      {{ Auth::user()->name }}
                                      <b class="caret"></b>
                                  </p>

                            </a>
                          @guest
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                              </li>
                          @else
                            <ul class="dropdown-menu">
                              <li><a href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">Salir</a>
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      @csrf
                                  </form>
                              </li>
                            </ul>
                          @endguest
                      </li>
                      <li class="separator hidden-lg"></li>
                  </ul>

                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Habitaciones a la espera de confirmación</h4>
                            </div>
                            <div class="content">
                                <form>
                                    <div class="content table-responsive table-full-width">
                                        <table class="table table-hover table-striped">

                                            <thread>
                                            <th>Id Habitacion</th>
                                            <th>Nombre Hotel</th>
                                            <th>Tipo Habitacion</th>
                                            <th>Capacidad</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Eliminar Solicitud</th>
                                            </thread>

                                        <tbody>
                                        @foreach($habitacion as $habi)
                                        <tr>

                                        @if( $habi->nombre_hotel == Auth::user()->name )
                                            <td>{{$habi->id}}</td>
                                            <td>{{$habi->nombre_hotel}}</td>
                                            <td>{{$habi->tipo_habitacion}}</td>
                                            <td>{{$habi->capacidad}}</td>
                                            <td>{{$habi->precio}}</td>
                                            <td>{{$habi->cantidad}}</td>
                                            <td><a  href="{{route('d_habitaciones.cancel', $habi->id)}}" class="btn btn-danger">Anular</a></td>
                                        @endif

                                        </tr>
                                        @endforeach
                                        </tbody>
                                        </table>

                                         <td> <a  href="digitador" onclick=""class="btn btn-back">Volver</a></td>

                                    </div>

                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>



    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="pagina/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="pagina/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="pagina/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="pagina/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="pagina/js/light-bootstrap-dashboard.js?v=1.4.0"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="pagina/js/demo.js"></script>

</html>
