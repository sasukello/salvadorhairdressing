<?php

/*
 * Plantilla donde se le pide al usuario Rellenar el formularios con sus datos personales.
 */

ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user="";
$estado="";

include '../sitio/sec/ms/libfunc.php';

if (isset($_GET["e"])) {
    $estado = $_GET["e"];
    if($estado == 2){
        $msg = "<div class='alert alert-danger'>Las Contraseñas ingresadas <strong>no coinciden</strong>.</div>";
    }
} else if(isset ($_GET["uu"])){
    $user = base64_decode($_GET["uu"]);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pasotres'])) {
        procesoRegistro();
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salvador Hairdressing - Mystery Shopper: Registro de Usuario</title>
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
                            <div class="logo wow fadeInDown"> <a href="/mysteryshopper"><img src="images/salvador-logo-wh.jpg" alt="logo"></a></div>

                            <!-- /.main title -->
                            <h1 class="wow fadeInLeft">
                                Mystery Shopper
                            </h1><h2>Registra tus datos:</h2>

				<!-- /.header paragraph -->
                            <div class="landing-text wow fadeInUp">
                                <p>Completa el Siguiente Formulario, para tener acceso y poder participar en el portal de <b>Salvador Hairdressing: Mystery Shopper<br></p>
                            </div>




                        </div> 

                        <!-- /.signup form -->
                        <div class="col-md-5">

                            <div class="signup-header wow fadeInUp">
                                <h3 class="form-title text-center">FORMULARIO DE REGISTRO:</h3>
                                <form class="form-header" role="form" method="POST" id="registroMS">
                                    <input type="hidden" name="u" value="503bdae81fde8612ff4944435">
                                    <input type="hidden" name="id" value="bfdba52708">
					<?php 
						if(isset($msg)){
						    echo $msg;
						}
			
			    ?> <div class='form-group'>
                                  <input class='form-control input-lg' name='email' id='email' type='email' placeholder='Correo electronico' value='<?php echo $user; ?>' required>
                                    </div>
                                    <div class='form-group'>
                                        <input class='form-control input-lg' name='password' id='password' type='password' placeholder='Ingresa tu contraseña' required>
                                    </div>
                                    <div class='form-group'>
                                        <input class='form-control input-lg' name='cpassword' id='cpassword' type='password' placeholder='Confirma tu contraseña' required>
                                    </div>
                                    <div class='form-group'>
                                  <input class='form-control input-lg' name='nombre' id='nombre' type='text' placeholder='Ingresa tu nombre' required>
                                    </div>
                                    <div class='form-group'>
                                  <input class='form-control input-lg' name='apellido' id='apellido' type='text' placeholder='Ingresa tu apellido' required>
                                    </div>
                                    <div class='form-group'>
                                  <input class='form-control input-lg' name='docfiscal' id='docfiscal' type='text' placeholder='Número de Identificación' required>
                                    </div>
                                    <div class='form-group'>
                                  <select class='form-control input-lg' name='paises' id='paises' required>
					<option value=''>Seleccione su país</option><?php selecPaises(); ?>
				</select>
                                    </div>
                                    <div class='form-group'>
                                  <input class='form-control input-lg' name='estado' id='estado' type='text' placeholder='Estado' required>
                                    </div>
                                    <div class='form-group'>
                                  <input class='form-control input-lg' name='ciudad' id='ciudad' type='text' placeholder='Ciudad' required>
                                    </div>
                                    <div class='form-group'>
                                  <input class='form-control input-lg' name='phone' id='phone' type='text' placeholder='Número telefónico' required>
                                    </div>
                                    <div class='form-group'>
                                  <label class='control-label col-sm-6' for='nacimiento' style='color: white;'>Fecha de Nacimiento (dd-mm-aaaa):</label><div class='col-sm-6'><input class='form-control input-lg' name='nacimiento' id='nacimiento' type='date' placeholder='Fecha de Nacimiento' required>
                                    </div></div>
                                    <div class='form-group'>
                                        <textarea class='form-control' id='direccion1' name='direccion' col="30" row="4" placeholder="Ingrese su Dirección" required /></textarea>
                                    </div>

				<div class='form-group last'>
                                        <input type='submit' name='pasotres' class='btn btn-warning btn-block btn-lg' value='CONFIRMAR REGISTRO'>
                                    </div>
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
                        <a class="navbar-brand site-name" href="#top"><img src="images/salvador-logo-wh.jpg" alt="logo"></a>
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