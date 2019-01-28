<?php
/*
 * Página Principal para la sección Mistery Shopper de Salvador Hairdressing
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
} else{
    // remove all session variables
    session_unset();
    // destroy the session 
    session_destroy();
}
$estado = "";
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ms_pasouno'])) {
        require_once "../sitio/sec/ms/libfunc.php";
        $tipo = $_POST["tipo"];
        if ($tipo == 'a') {
            $user = $_POST["email"];
            pasouno($user);
        } else if($tipo == 'b') {
            $user = $_POST["email"];
            $pass = $_POST["password"];
            pasocc($user, $pass);
        }
    }
}

if (isset($_GET["e"])) {
    $estado = $_GET["e"];
    if($estado == 0){
        $mensaje = "<div class='alert alert-danger'><strong>Hubo un problema</strong> al guardar tu información. Por favor, intenta de nuevo.</div>";
    } else if($estado == 1){
        $mensaje = "<div class='alert alert-success'><strong>¡Tus datos han sido guardados éxitosamente!</strong> Espera nuestro correo de aprobación en los próximos días.</div>";
    } else if($estado == 2){
        $mensaje = "<div class='alert alert-warning'>Tu cuenta <strong>no se encuentra aprobada</strong>.</div>";
    } else if($estado == 3){
        $mensaje = "<div class='alert alert-warning'>Tu cuenta <strong>aún no se encuentra aprobada.</strong> Debes esperar nuestro correo de aprobación.</div>";
    } else if($estado == 4){
        $mensaje = "<div class='alert alert-warning'>El participante fue <strong>rechazado éxitosamente</strong></div>";
    } else if($estado == 5){
        $mensaje = "<div class='alert alert-danger'>Hubo un erorr en la conexión al sitio de <strong>Mystery Shopper</strong>. Por favor, intenta realizar las operaciones desde tu Cuenta Corporativa.</div>";
    } else if($estado == 6){
        $mensaje = "<div class='alert alert-success'>¡El participante fue <strong>aprobado éxitosamente</strong>!</div>";
    }  
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salvador Hairdressing - Mystery Shopper</title>
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
                            <br><br><br><br>
                            <!-- /.main title -->
                            <h1 class="wow fadeInLeft">
                                Mystery Shopper
                            </h1>

                            <!-- /.header paragraph -->
                            <div class="landing-text wow fadeInUp">
                                <p>¿Quieres ser un <i><b>Mystery Shopper</b></i> para Salvador Hairdressing?<br>Ingresa tu correo en el siguiente formulario para entrar a tu cuenta o registrar tus datos.<br></p>
                            </div>				  

                            <!-- /.header button -->
                            <div class="head-btn wow fadeInLeft">
                                <a href="#intro" class="btn-primary">Conoce más...</a>
                               <!-- <a href="#download" class="btn-default">Download</a>-->
                            </div>



                        </div> 

                        <!-- /.signup form -->
                        <div class="col-md-5">

                            <div class="signup-header wow fadeInUp">
                                <h3 id="ingresaemail" class="form-title text-center"><strong>INGRESA TU CORREO ELÉCTRONICO...</strong></h3>
                                <?php echo $mensaje;?>
                                <form class="form-header" role="form" method="POST" id="ms_email">
                                    <input type="hidden" name="u" value="503bdae81fde8612ff4944435">
                                    <input type="hidden" name="id" value="bfdba52708">
                                    <div class="form-group">
                                        <input class="form-control input-lg" name="email" id="email" type="text" placeholder="Ingresa tu correo eléctronico" required>
                                    </div>
                    			<input type="hidden" name="tipo" value="a">
                                    <div class="form-group last">
                                        <input type="submit" name="ms_pasouno" class="btn btn-warning btn-block btn-lg" value="COMENZAR">
                                    </div>
                                    <p class="privacy text-center"><a href="#" onclick="cambiarLabel()"/>¿Usuario Corporativo?</a> -  <a href="#" onclick="regresarLabel()" style="text-decoration: none;"/>Participante</a><br>Tu información no será compartida. Lee nuestra <a href="privacy.html">política de privacidad</a>.</p>
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
                            <li><a href="#intro">Mystery Shopper</a></li>
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

        <!-- /.intro section -->
        <div id="intro">
            <div class="container">
                <div class="row">

                    <!-- /.intro image -->
                    <div class="col-md-6 intro-pic wow slideInLeft">
                        <img src="images/intro-image.jpg" alt="image" class="img-responsive">
                    </div>	

                    <!-- /.intro content -->
                    <div class="col-md-6 wow slideInRight">
                        <h2>Mystery Shopper de <b>Salvador Hairdressing</b></h2>
                        <p style="text-align: justify;"><b style="color:red;font-size: 22px;"><i>Salvador</i></b> se esfuerza en prestar a su clientela un servicio de excelencia, demostrando en todo momento que día a día nos enfocamos en superarnos a nosotros mismos y a las expectativas de quienes requieren de nuestros servicios y productos.<br><br>Te invitamos a ser una herramienta clave en nuestro objetivo de mejora continua, siendo nuestro Mystery Shopper (Cliente Misterioso), y así ayudarnos a detectar aquellos aspectos que debemos mejorar.
                        </p>
                        <div class="btn-section"><a href="#top" class="btn-default">¡Unéte al Programa!</a></div>
                    </div>
                </div>			  
            </div>
        </div>

        <!-- /.footer -->
        <footer id="footer">
            <div class="container">
                <div class="col-sm-4 col-sm-offset-4">
                    <!-- /.social links -->
                    <div class="social text-center">
                        <img src="/images/60-años-min.png" width="100%" height="100%"><br><br>
                        <ul>
                        <li><a class="wow fadeInUp" href="http://www.facebook.com/mundosalvador" data-wow-delay="0.2s"><i class="fa fa-facebook-square"></i></a></li>
                        <li><a class="wow fadeInUp" href="http://www.twitter.com/mundosalvador"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="wow fadeInUp" href="http://www.instagram.com/mundosalvador" data-wow-delay="0.6s"><i class="fa fa-instagram"></i></a></li>
                        <li><a class="wow fadeInUp" href="https://www.youtube.com/user/salvadorpeluqueria" data-wow-delay="0.4s"><i class="fa fa-youtube-play"></i></a></li>
                           
                        </ul>
                    </div>	
                    <div class="text-center wow fadeInUp" style="font-size: 14px;">Copyright 2016. Salvador Hairdressing</div>
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
        <script>
            function cambiarLabel(){
            document.getElementById('ingresaemail').innerHTML = '<strong>INGRESA TU USUARIO CORPORATIVO...</strong>';
            document.getElementsByName('email')[0].placeholder='Ingresa tu Usuario Corporativo';
        }
        function regresarLabel(){
            document.getElementById('ingresaemail').innerHTML = '<strong>INGRESA TU CORREO ELÉCTRONICO...</strong>';
            document.getElementsByName('email')[0].placeholder='Ingresa tu correo eléctronico';
        }        
        </script>
    </body>
</html>
