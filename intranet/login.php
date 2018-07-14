<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['intra_uno'])) {
        require_once "sec/libfunc.php";
        $tipo = $_POST["tipo"];
            if ($tipo == 'a') {
                $user = $_POST["name"];
                $pass = $_POST["passw"];

                $msg = intra_uno($user, $pass);
            }
        }
    }
?>
<!DOCTYPE html>
<html>
        <head>
        <title>Salvador Hairdressing - Intranet: Inicia Sesión</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<!-- CSS Files -->
        <link href="componentes/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="componentes/css/font-awesome.min.css" rel="stylesheet">
        <link href="componentes/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="componentes/css/animate.css" rel="stylesheet" media="screen">
        <link href="componentes/css/owl.theme.css" rel="stylesheet">
        <link href="componentes/css/owl.carousel.css" rel="stylesheet">

        <link href="componentes/css/css-index.css" rel="stylesheet" media="screen">
        <link href="componentes/css/css-index-red.css" rel="stylesheet" media="screen">
        <!--<link href="css/estilo.css" rel="stylesheet" media="screen"> -->

        <!-- Google Fonts -->
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" />

        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader -->
        <div id="top"></div>

        <!-- /.parallax full screen background image -->
        <div class="fullscreen parallax" style="background-image:url('componentes/images/bg/bg10.jpg');background-repeat: no-repeat;" data-img-width="2000" data-img-height="1125" data-diff="100">

            <div class="overlay" style="background-color: rgba(0, 0, 0, 0.3);">
                <div class="container">
                    <div class="logo wow fadeInDown"><a href="login.php"><img src="componentes/images/salvador.png" width="180px"></a></div>
                    <div class="row">
                        <div class="col-md-6" style="padding-top: 50px;">
                            <h1 class="white-text wow fadeInLeft">Intranet</h1>
                            <div class="white-text landing-text wow fadeInUp">
                                <p><b>Salvador Hairdressing: <i>Intranet</i></b><br>Ingresa tu usuario y contraseña corporativo en el siguiente formulario para entrar a la Intranet de Salvador Hairdressing.</p>
                            </div>	
                        </div>
                    
                        <div class="col-md-5 col-md-offset-1">           
                            <div class="signup-header wow fadeInUp">
                                <h3 id="ingresaemail" class="form-title text-center"><strong>INGRESA TU LOGIN CORPORATIVO</strong></h3>
                                <form class="form-header" role="form" action="login.php" method="POST" id="ms_email">
                                     <?php if(isset($msg)){
                                         echo "<div class='alert alert-danger'><strong>$msg</strong>.</div>";
                                         
                                    }?>
                                    <div class="form-group">
                                        <input class="form-control input-lg" name="name" id="name" type="text" placeholder="Ingresa tu usuario" required>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control input-lg" name="passw" id="passw" type="password" placeholder="Ingresa tu contraseña" required>
                                    </div>
                        			<input type="hidden" name="tipo" value="a">
                                    <div class="form-group last">
                                        <input type="submit" name="intra_uno" class="btn btn-warning" value="ENTRAR">
                                    </div><br>
                                </form>
                            </div>				
                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <style type="text/css">
            #footer {
                padding: 15px 0 0px;
               
            }
            .white-text{
                color: #fff;
                font-weight: normal;
            }
        </style>

        <footer id="footer" style="background: #26262a;">
            <div class="container" style="padding-bottom: 15px;">
                <div class="main-footer">
                    <div class="text-center">
                        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
                            <ul class="nav navbar-nav">
                                <li><a class="white-text" href="#">Intranet</a></li>
                                <li><a class="white-text" href="/mysteryshopper">Mystery Shopper</a></li>
                                <li><a class="white-text" href="/nosotros.php">Nosotros</a></li>
                                <li><a class="white-text" href="/franquicias.php">Franquicias</a></li>
                                <li><a class="white-text" href="/ubicaciones.php">Ubicaciones</a></li>
                                <li><a class="white-text" href="/contactenos.php">Contáctanos</a></li>
                                <li class="dropdown">
                                    <a class="white-text" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-global pe-5x pe-va wow fadeInUp"></i> Productos <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href='/cc'>Salvador ClientCard</a></li>
                                        <li class="divider"></li>
                                        <li><a href='/app'>Salvador Hairdressing App</a></li>
                                    </ul>
                                </li> 
                            </ul>
                        </div>
                    </div>
                    <a href="#" class="scrollToTop"><i class="pe-7s-up-arrow pe-va"></i></a>
                </div>
            </div>

            <div class="sub-footer" style="background: #000;     padding: 30px 0;">
                <div class="container">
                    <div class="col-sm-12">
                        <div class="row copmob">
                          <span><?php echo _('Salvador Hairdressing &copy; 2018. Todos los derechos reservados.'); ?></span>
                          <span class="icon-pos" style="float: right;">
                            <a target="_blank" href="https://salvadorhairdressing.com"><i style="color: #777; font-size: 22px; font-weight: normal;" class="pe-7s-global"></i></a>
                          </span>
                        </div>
                    </div>           
                </div>
            </div>
        </footer>

        <!-- /.footer -->
        <!--footer id="footer">
            <div class="container">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="social text-center">
                        <img src="/images/60-años-min.png" width="100%" height="100%"><br><br>
                    </div>	
                    <div class="text-center wow fadeInUp" style="font-size: 14px;">Copyright 2016-2017. Salvador Hairdressing</div>
                    <a href="#" class="scrollToTop"><i class="pe-7s-up-arrow pe-va"></i></a>
                </div>	
            </div>	
        </footer-->

        <!-- /.javascript files -->
        <script src="componentes/js/jquery.js"></script>
        <script src="componentes/bootstrap/js/bootstrap.min.js"></script>
        <script src="componentes/js/jquery.sticky.js"></script>
        <script src="componentes/js/wow.min.js"></script>
        <script src="componentes/js/owl.carousel.min.js"></script>
        <script>
                                    new WOW().init();
        </script>
    </body>
</html>