<?php

/*
 * PROCESO DE LOGIN PARA LA CUENTA DE MISTERY SHOPPER
 */

ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user="";
$tlogin="";

if(isset($_GET["t"])){
    $tlogin = $_GET["t"];
    if($tlogin == "1"){
        if(isset($_SESSION["email"])){
            $user = $_SESSION["email"];
            if(isset($_GET["e"])){
                $emsg = $_GET["e"];
                if($emsg == 2){
                    $msg="<div class='alert alert-warning'><strong>Error en Contraseña.</strong></div>";
                }
            }  
        }else{
            header("location:index.php");
        }
    } else if($tlogin == "2"){
        if(isset($_GET["uu"])){
            $user = base64_decode($_GET["uu"]);
            $_SESSION['codigo'] = $user;
            //$nombre = $_SESSION["nombre"];
            //$nivel = $_SESSION["nivel"];
            if(isset($_GET["e"])){
                $emsg = $_GET["e"];
                if($emsg == 1){
                    $msg="<div class='alert alert-warning'><strong>Error</strong> en Contraseña Corporativa.</div>";
                }
            }
        }else{
            header("location:index.php");
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ms_pasodos'])) {
        if($_POST['tipo'] == 'c'){
            // USUARIO TIPO 1
            require_once "../sitio/sec/ms/libfunc.php";
            $email = $_POST['email'];
            $password = $_POST['password'];
            comprobarLoginPart($email, $password); 
        } else if($_POST['tipo'] == 'd'){
            // USUARIO TIPO 2
            require_once "../sitio/sec/ms/libfunc.php";
            $email = $_POST['email'];
            $password = $_POST['password'];
            comprobarLoginCorp($email, $password); 
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salvador Hairdressing - Mystery Shopper: Inicia Sesión</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<!-- CSS Files -->
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet" media="screen">
        <link href="css/owl.theme.css" rel="stylesheet">
        <link href="css/owl.carousel.css" rel="stylesheet">

        <link href="css/css-index.css" rel="stylesheet" media="screen">
        <link href="css/css-index-red.css" rel="stylesheet" media="screen">
        <link href="css/estilo.css" rel="stylesheet" media="screen">

        <!-- Google Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" />

    </head>

    <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader -->
        <div id="preloader"></div>
        <div id="top"></div>

        <!-- /.parallax full screen background image -->
        <div class="fullscreen landing parallax" style="background-image:url('images/bg.jpg');" data-img-width="2000" data-img-height="1333" data-diff="100">

            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">

                            <!-- /.logo -->
                            <!--<div class="logo wow fadeInDown"> <a href=""><img src="images/salvador-logo-wh.jpg" alt="logo"></a></div>-->

                            <!-- /.main title -->
                            <h1 class="wow fadeInLeft">
                                Mystery Shopper
                            </h1>
                        </div> 

                        <!-- /.signup form -->
                        <div class="col-md-5">

                            <div class="signup-header wow fadeInUp">
                                <h3 class="form-title text-center">INICIA SESIÓN</h3>
                                <form class="form-header" role="form" method="POST" id="ms_email">
                                    <input type="hidden" name="u" value="503bdae81fde8612ff4944435">
                                    <input type="hidden" name="id" value="bfdba52708">
                <?php 
                        if(isset($msg)){
                            echo $msg;
                        }
                if($tlogin == "1"){
                    echo "<div class='form-group'>
                          <input class='form-control input-lg' name='email' id='email' type='text' value='$user' placeholder='Ingresa tu correo eléctronico' readonly required>
                            </div>
                            <div class='form-group'>
                                <input class='form-control input-lg' name='password' id='password' type='password' placeholder='Ingresa tu contraseña' autofocus required>
                            </div>
                                <input type='hidden' name='tipo' value='c'>

                        <div class='form-group last'>
                                <input type='submit' name='ms_pasodos' class='btn btn-warning btn-block btn-lg' value='ENTRAR'>
                            </div>";
                    } else if($tlogin == "2"){
                    echo "<div class='form-group'>
                          <input class='form-control input-lg' name='email' id='email' type='text' value='$user' placeholder='Usuario Corporativo' readonly required>
                            </div>
                            <div class='form-group'>
                                <input class='form-control input-lg' name='password' id='password' type='password' placeholder='Ingresa tu contrasela' autofocus required>
                            </div>
                                <input type='hidden' name='tipo' value='d'>

                        <div class='form-group last'>
                                <input type='submit' name='ms_pasodos' class='btn btn-warning btn-block btn-lg' value='ENTRAR'>
                            </div>";

                    }?>
                    <p class="privacy text-center">Tu información no será compartida. Lee nuestra <a href="privacy.html">política de privacidad</a>.</p>
                                </form>
                            </div>				

                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <!-- NAVIGATION -->
        <div id="menu">
            <nav class="navbar-wrapper navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-backyard">
                            <span class="sr-only">Mystery Shopper</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!--<a class="navbar-brand site-name" href="#top"><img src="images/salvador-logo-wh.jpg" alt="logo"></a>-->
                    </div>

                    <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
                        <ul class="nav navbar-nav">
                            <li><a href="/mysteryshopper">Mystery Shopper</a></li>
                            <li><a href="/nosotros.php">Nosotros</a></li>
                            <li><a href="/franquicias.php">Franquicias</a></li>
                            <li><a href="/ubicaciones.php">Ubicaciones</a></li>
                            <li><a href="/contactenos.php">Contáctanos</a></li>
                            <li><a href="/cc">ClientCard</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <!-- /.footer -->
        <footer id="footer">
            <div class="container">
                <div class="col-sm-4 col-sm-offset-4">
                    <!-- /.social links -->
                    <div class="social text-center">
                        <ul>
                        <li><a class="wow fadeInUp" href="http://www.facebook.com/mundosalvador" data-wow-delay="0.2s"><i class="fa fa-facebook-square"></i></a></li>
                        <li><a class="wow fadeInUp" href="http://www.twitter.com/mundosalvador"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="wow fadeInUp" href="http://www.instagram.com/mundosalvador" data-wow-delay="0.6s"><i class="fa fa-instagram"></i></a></li>
                        <li><a class="wow fadeInUp" href="https://www.youtube.com/user/salvadorpeluqueria" data-wow-delay="0.4s"><i class="fa fa-youtube-play"></i></a></li>
                           
                        </ul>
                    </div>	
                    <div class="text-center wow fadeInUp" style="font-size: 14px;">Copyright Backyard 2015, Salvador Peluquerías</div>
                    <a href="#" class="scrollToTop"><i class="pe-7s-up-arrow pe-va"></i></a>
                </div>	
            </div>	
        </footer>

        <!-- /.javascript files -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/custom.js"></script>
        <script src="js/jquery.sticky.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/owl.carousel.min.js"></script>
        <script>
            new WOW().init();
        </script>
    </body>
</html>
<?php ob_end_flush(); ?>
