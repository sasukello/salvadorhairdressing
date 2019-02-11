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
$msg="";$clase="";
if(isset($_GET["e"])){
    $error = $_GET["e"];
    if($error == 1){
        $msg = "<strong>Encuesta No Encontrada</strong><br>";
        $clase = "alert alert-warning alert-dismissable fade in";
    } else if($error == 2){
        $msg = "<strong>¡Tus datos han sido enviados éxitosamente!</strong><br>Está atento a nuestra respuesta.<br>";
        $clase = "alert alert-success alert-dismissable fade in";
    } else if($error == 3){
        $msg = "<strong>Hubo un problema al procesar tu solicitud.</strong><br>Por favor, intenta de nuevo.<br>";
        $clase = "alert alert-danger alert-dismissable fade in";
    } else if($error == 4){
        $msg = "<strong>Visita Programada No Encontrada.</strong><br>";
        $clase = "alert alert-warning alert-dismissable fade in";
    } else if($error == 5){
        $msg = "<strong>¡Tus respuestas han sido enviados éxitosamente!</strong>";
        $clase = "alert alert-success alert-dismissable fade in";
    } 
    else{
        $msg="";$clase="";
    }
} else{
    $msg = "";
    $clase="";
}
    require_once "../etc/func.php";

/*
 * Panel de Cuenta de Usuario Participante.
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salvador Hairdressing - Mistery Shopper: Participante</title>
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
                    <div class="col-md-6 intro-pic wow slideInLeft">
                        <img src="/mysteryshopper/images/bg.jpg" alt="image" class="img-responsive">
                    </div>	

                    <!-- /.intro content -->
                    <div class="col-md-6 wow slideInRight">
                        <h2>Mystery Shopper: Participante</h2>
                        
        <?php if(isset($_GET["e"])){
            echo "<div class='$clase'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
            $msg</div>";        
        }?>
        <b>¡Bienvenido a nuestro grupo de Mistery Shoppers!</b>
        <br><br>ESTADO DE PARTICIPACIÓN: <?php consultaPartEstado($iduser); ?>
        <br><br><div class="cuentaTexto1"><b><i>ENCUESTAS DISPONIBLES:</i></b></div> <?php listarEncuestas($iduser); ?>
        <br><div class="cuentaTexto1"><b><i>VISITAS PROGRAMADAS:</i></b></div> <?php listarVisitas($iduser); ?>
        <br><div class="cuentaTexto1"><b><i>MANUAL DE PARTICIPANTE:</i></b></div>
        <a href="#" data-toggle="modal" data-target="#manualMS" style="text-decoration: none;">Consultar Manual de Mystery Shopper</a>
        <br><a href='logout.php'><button type="button" class="btn-default" data-toggle="modal" data-target="#elimreg">Cerrar Sesión</button></a>
        <!--<div class="btn-section"><a href="#top" class="btn-default">¡Unéte al Programa!</a></div>-->

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
            
                <!-- COMIENZO DE MODAL: MANUAL DE MS  -->
                <div id="manualMS" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">CONSULTA DE MANUAL DE MYSTERY SHOPPER</h4>
                            </div>
                            <div class="modal-body">

                               <div class='post-body entry-content' expr:id='&quot;post-body-&quot; + data:post.id' itemprop='articleBody' oncontextmenu='return false' ondragstart='return false' onmousedown='return false' onselectstart='return false'>
                                  <div id="pdf" style="margin-left: auto;margin-right: auto;text-align: center;">
                                        <object width="800" height="480" type="application/pdf" data="../images/Manual-Cliente-Misterioso-de-Salvador-Hairdressing.pdf?#zoom=90&scrollbar=0&toolbar=0&navpanes=0" id="pdf_content">
                                          <p>Hubo un error al cargar el manual de Mystery Shopper. Por favor, intenta de nuevo.</p>
                                        </object>
                                   </div>
                               </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>

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