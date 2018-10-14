<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Hotel ICI</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="admin/css/bootstrap.min.css" rel="stylesheet" />
    <link href="admin/css/material-dashboard.css" rel="stylesheet" />
    <link href="admin/css/demo-documentation.css" rel="stylesheet" />
    <style media="screen">

        .page-header {
            height: 100vh;
        }

        .page-header .description {
            color: #ffffff;
        }

        .header-filter .container {
            padding-top: 33vh;
        }
    </style>
</head>

<body class="components-page">
    <nav class="navbar navbar-transparent navbar-fixed-top navbar-color-on-scroll">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                 <img src="pagina/img/leon.png" border="0" width="150" height="100">
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if (Route::has('login'))
                    @auth
                    <a class="btns blue" href="{{ url('/home') }}">Home</a>
                    @else
                    <li>
                        <a class="btns blue" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                    <li>
                        <a class="btns blue" href="{{ route('register') }}">Registrarse</a>
                    </li>
                    @endauth
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="page-header header-filter" style="background-image: url('admin/img/prueba.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h1 class="title ">Hoteles ICI</h1>
                    <h5 class="description">Los mejores Hoteles al mejor precio</h5>
                    <a href="/home" class="btns green">Ingresar</a>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer footer-transparent">
        <div class="container">
            <nav class="pull-left">
                <ul>
                    <li>
                        <a href="">
                            Sobre Nosotros
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Licencias
                        </a>
                    </li>
                </ul>
            </nav>
            <div class="social-area pull-right">
                <a class="btn btn-just-icon btn-twitter btn-simple" href="https://twitter.com">
                    <i class="fa fa-twitter"></i>
                </a>
                <a class="btn btn-just-icon btn-facebook btn-simple" href="https://www.facebook.com">
                    <i class="fa fa-facebook-square"></i>
                </a>
                <a class="btn btn-just-icon btn-google btn-simple" href="https://plus.google.com">
                    <i class="fa fa-google-plus"></i>
                </a>
                <a class="btn btn-just-icon btn-instagram btn-simple" href="https://www.instagram.com">
                    <i class="fa fa-instagram"></i>
                </a>
            </div>
            <div class="copyright">
                &copy;
                <script>
                    document.write(new Date().getFullYear())
                </script> TEAM ICI
            </div>
        </div>
    </footer>
</body>
<!--   Core JS Files   -->
<script src="admin/js/jquery-3.2.1.min.js" type="text/javascript"></script>
<script src="admin/js/bootstrap.min.js" type="text/javascript"></script>
<script src="admin/js/material.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="admin/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="admin/js/bootstrap-notify.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<!-- Material Dashboard javascript methods -->
<script src="admin/js/material-dashboard.js"></script>
<!-- Material Dashboard DEMO methods, don't include it in your project! -->
<script src="admin/js/demo.js"></script>
<script>
    var header_height;
    var fixed_section;
    var floating = false;

    $().ready(function() {
        suggestions_distance = $("#suggestions").offset();
        pay_height = $('.fixed-section').outerHeight();

        $(window).on('scroll', md.checkScrollForTransparentNavbar);
        demo.initDocumentationCharts();
    });
</script>

</html>
