<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION["usuario"])){
        $user = $_SESSION["usuario"];
        $iduser = $_SESSION["iduser"];
        $hash = $_SESSION["hash"];
        if($hash == "465g5gf688gr"){
            $bandera = true;
        } else{
        header("location:logout.php");
        }
    } else{
        header("location:logout.php");
    }
}
error_reporting(0);
if(isset($_GET['t'])){
    $tipo = $_GET['t'];
} else if(isset($_GET['pv'])){
    $pv = base64_decode($_GET['pv']);
    $tipo = 3;
    } else{
        header("location:index.php?e=1");
    }

if(isset($_SESSION["fecha_visita"])){
    $fecha = $_SESSION["fecha_visita"];
    $idvisita = $_SESSION["id_visita"];
}

include '../etc/func.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitEncuestaPart'])) {
            $_SESSION["nombre"] = htmlspecialchars($_POST['nombre']);
            $_SESSION["apellido"] = htmlspecialchars($_POST['apellido']);
            $_SESSION["id"] = htmlspecialchars($_POST['id']);
            $_SESSION["tipocta"] = htmlspecialchars($_POST['tipocta']);
            $_SESSION["banco"] = htmlspecialchars($_POST['banco']);
            $_SESSION["nrocta"] = htmlspecialchars($_POST['nrocta']);
            $_SESSION["swift"] = htmlspecialchars($_POST['swift']);
            procesarEncuestaPart($iduser, $tipo); 
    } else if(isset ($_POST['enviarPV'])){
            $_SESSION["P1"] = htmlspecialchars($_POST['P1']);
            $_SESSION["P2"] = htmlspecialchars($_POST['P2']);
            $_SESSION["P3"] = htmlspecialchars($_POST['P3']);
            $_SESSION["P4"] = htmlspecialchars($_POST['P4']);
            $_SESSION["P5"] = htmlspecialchars($_POST['P5']);
            $_SESSION["P6"] = htmlspecialchars($_POST['P6']);
            $_SESSION["P7"] = htmlspecialchars($_POST['P7']);
            $_SESSION["P8"] = htmlspecialchars($_POST['P8']);
            $_SESSION["P9"] = htmlspecialchars($_POST['P9']);
            $_SESSION["P10"] = htmlspecialchars($_POST['P10']);
            $_SESSION["C1"] = htmlspecialchars($_POST['C1']);
            $_SESSION["C2"] = htmlspecialchars($_POST['C2']);
            $_SESSION["C3"] = htmlspecialchars($_POST['C3']);
            $_SESSION["C4"] = htmlspecialchars($_POST['C4']);
            $_SESSION["C5"] = htmlspecialchars($_POST['C5']);
            $_SESSION["C6"] = htmlspecialchars($_POST['C6']);
            $_SESSION["C7"] = htmlspecialchars($_POST['C7']);
            $_SESSION["C8"] = htmlspecialchars($_POST['C8']);
            $_SESSION["C9"] = htmlspecialchars($_POST['C9']);
            $_SESSION["C10"] = htmlspecialchars($_POST['C10']); 
            $_SESSION["idvisita"] = htmlspecialchars($_POST['idvisita']); 
            $pvid = $_POST['idpv'];

            procesarPostEncuesta($iduser, $pvid); 
        //echo count($_POST['enviarPV']);
        print_r($_POST);
        
    }
}

/*
 * Pantalla de Encuesta para aplicar a ser Mistery Shopper.
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salvador Hairdressing - Mystery Shopper: Completa la Encuesta</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<!-- CSS Files -->
        <link href="/mysteryshopper/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/font-awesome.min.css" rel="stylesheet">
        <link href="/mysteryshopper/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="/mysteryshopper/css/animate.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/owl.theme.css" rel="stylesheet">
        <link href="/mysteryshopper/css/owl.carousel.css" rel="stylesheet">

        <link href="/mysteryshopper/css/css-index.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/css-index-red.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/estilo.css" rel="stylesheet" media="screen">

        <!-- Google Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" />

    </head>

    <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader -->
        <div id="preloader"></div>
        <div id="top"></div>

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
                        <a class="navbar-brand site-name" href="#top"><img src="/mysteryshopper/images/salvador-logo-wh.jpg" alt="logo"></a>
                    </div>

                    <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#intro2">Mystery Shopper</a></li>
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
        <div id="intro2">
            <div class="container">
                <div class='alert alert-warning alert-dismissable fade in'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Aviso de Confidencialidad:</b> La información recolectada en este programa, así como tus datos son confidenciales. <b>Salvador Hairdressing</b> nunca revelará tu identidad a terceros. Igualmente, como participante, estás comprometido a no revelar tu involucramiento en este programa.
                </div>
                <div class="row">

                    <!-- /.intro image -->
                    <?php if($tipo == 2){?>
                    <div class="col-md-6 intro-pic wow slideInLeft">
                        <img src="/mysteryshopper/images/bg.jpg" alt="image" class="img-responsive">
                    </div>
                    <?php } else if($tipo == 3){?>	
                    <div class="col-md-2 intro-pic wow slideInLeft">
                        <img src="/mysteryshopper/images/bg.jpg" alt="image" class="img-responsive">
                    </div>
                    <?php }?>
                    <!-- /.intro content -->
                    <?php if($tipo == 2){?>
                    <div class="col-md-6 wow slideInRight">
                    <?php } else if($tipo == 3){?>
                    <div class="col-md-9 wow slideInRight"></div> 
                    <?php }?>
                        <h2>Mystery Shopper: Encuestas</h2>
                        <?php if($tipo == 2){ echo "<h3>Encuesta #0$tipo: Completa tus Datos</h3>"?>
                            <form name="encuestaMS" method="post">
                            <?php inputLocal($user) ;
                            include '../../sitio/sec/ms/libfunc.php';?>
                            <br><h3>Completa con tus datos bancarios:</h3>
                            
                            <br><div class='form-group'><label class='control-label col-sm-5' for='tipocta'>Tipo de Cuenta:</label><div class='col-sm-5'><select name='tipocta' class='form-control' required><option value=''>Seleccione su opción</option><option value='1'>Corriente/ Checking</option><option value='2'>Ahorro/ Savings</option></select></div></div>
                            <br><div class='form-group'><label class='control-label col-sm-5' for='banco'>Nombre del Banco:</label><div class='col-sm-5'><input type='text' class='form-control' id='banco' name='banco' placeholder="Nombre del Banco" required /></div></div>
                            <br><div class='form-group'><label class='control-label col-sm-5' for='nrocta'>Nro. de Cuenta:</label><div class='col-sm-5'><input type='text' class='form-control' id='nrocta' name='nrocta' placeholder="Número de Cuenta" required /></div></div>
                            <br><div class='form-group'><label class='control-label col-sm-5' for='swift'>Código SWIFT (Si aplica):</label><div class='col-sm-5'><input type='text' class='form-control' id='swift' name='swift' placeholder="Código SWIFT"/></div></div>
                            <br><div class='form-group'><div class='col-sm-offset-3 col-sm-6'><button type='submit' class='btn-primary' name='submitEncuestaPart'><b>Enviar</b></button></div></div>                   
                            </form>
                       <?php } else if($tipo == 3){
                                inputPostVisita($iduser, $pv);
                       } else {
                           echo "   <div class='form-group'><label class='control-label col-sm-7' for='mensaje'>Encuesta no disponible</label></div><br>";
                        } if($tipo == 2){ echo "<a href='index.php'><button type='button' class='btn-default' name='return'>Volver a Cuenta</button></a>"; }
                        else if ($tipo == 3) { echo "<a href='visita.php?t=".base64_encode($idvisita)."'><button type='button' class='btn-default' name='return'>Regresar a Resumen de Visita</button></a>"; }?>
                        <a href='logout.php'><button type="button" class="btn-default" data-toggle="modal" data-target="#elimreg">Cerrar Sesión</button></a>
                    </div>
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
                    <div class="text-center wow fadeInUp" style="font-size: 14px;">Copyright 2016. Salvador Peluquerías</div>
                    <a href="#" class="scrollToTop"><i class="pe-7s-up-arrow pe-va"></i></a>
                </div>	
            </div>	
        </footer>

        <!-- /.javascript files -->
        <script src="/mysteryshopper/js/jquery.js"></script>
        <script src="/mysteryshopper/js/bootstrap.min.js"></script>
        <script src="/mysteryshopper/js/custom.js"></script>
        <script src="/mysteryshopper/js/jquery.sticky.js"></script>
        <script src="/mysteryshopper/js/wow.min.js"></script>
        <script src="/mysteryshopper/js/owl.carousel.min.js"></script>
        <script src="/mysteryshopper/js/funciones.js"></script>
        <script>
            new WOW().init();
        </script>
    </body>
</html>
<?php ob_end_flush(); ?>