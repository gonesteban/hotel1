<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <!--<link rel="icon" type="image/png" href="pagina/img/favicon.ico">-->
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
    <div class="sidebar" data-color="purple" data-image="pagina/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a class="simple-text" href="{{ url('/administrador') }}">
                    <img src="pagina/img/leon.png" border="0" width="200" height="100">
                </a>
            </div>
            <ul class="nav">
                <li>
                    <a href="lista_hoteles">
                        <i class="pe-7s-note2"></i>
                        <p>Hoteles</p>
                    </a>
                </li>
                <li>
                    <a href="/lista_habitaciones">
                        <i class="pe-7s-note2"></i>
                        <p>Habitaciones </p>
                    </a>
                </li>
                <li >
  					         <a href="/reserva_admin">
  						         <i class="pe-7s-note2"></i>
  						         <p>Reservar</p>
  					         </a>
  				      </li>
                <li>
                    <a href="/reservaciones">
                        <i class="pe-7s-note2"></i>
                        <p>Administrar Reservas</p>
                    </a>
                </li>

                <li>
                    <a href="/ingresar">
                        <i class="pe-7s-note2"></i>
                        <p>agregar </p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <i class="pe-7s-note2"></i>
                        <p>Reportes</p>
                    </a>
                </li>
                <li>
                    <a href="/lista_usuarios">
                        <i class="pe-7s-note2"></i>
                        <p>Usuarios </p>
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
                    <a class="navbar-brand" href="administrador">Bienvenido a Hoteles ICI </a>
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

        <div class="content text-center"> <!-- Aca se rellena para que muestre los hoteles -->
            <h1>Genera tu informe</h1><br><br>
            <div class="container">

              <form class="form-group" method="POST" action="/admin_reporte">
                @csrf

                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="">Tipo Habitacion</label>
                              <select name="tipo_habitacion" class="form-control">
                                <option value="Gold " selected="selected">Gold</option>
                                <option value="Silver"  selected="selected">Silver</option>
                                <option value="Golden"  selected="selected">Golden</option>
                                <option value="Classic"  selected="selected">Classic</option>


                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="">Fecha Inicio</label>
                              <input type="date" name="fecha_ingreso" class="form-control" required>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                              <label for="">Fecha Fin</label>
                              <input type="date" name="fecha_salida" class="form-control" required>
                          </div>
                      </div>
                  </div>


                  <div align="center">
                    <div class="form-group">
                    <button class="btn btn-primary" type="submit">Generar Reporte de Ventas</button>
                  </div>
                  </div>

                  <div class="clearfix"></div>
              </form>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    <ul>
                        <li>
                            <a href="#">
                                Inicio
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                ICI
                            </a>
                        </li>
                    </ul>
                </nav>
                <p class="copyright pull-right">
                    &copy; <script>document.write(new Date().getFullYear())</script> <a href="">Team ICI</a>, Software
                </p>
            </div>
        </footer>

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

    <script type="text/javascript">
        $(document).ready(function(){

            demo.initChartist();

            $.notify({
                icon: 'pe-7s-like2',
                message: "Bienvenido:  Administrador {{ Auth::user()->name }} que tengas un hermoso dia"

            },{
                type: 'info',
                timer: 4000
            });

        });
    </script>

</html>
