<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION["codigo"])){
        $user = $_SESSION["usuario"];
        $iduser = $_SESSION["codigo"];
        $hash = $_SESSION["hash"];
        if($hash == "s6a5486dasdas31"){
            $bandera = true;
        } else{
        //header("location:logout.php");
        }
    } else{
       // header("location:logout.php");
    }
}

require_once "../etc/func.php";

if(isset($_GET["e"])){
    $error = $_GET["e"];
    if($error == 1){
        $msg = "El Participante ha sido aprobado <strong>éxitosamente.</strong><br>";
        $clase = "alert alert-success alert-dismissable fade in";
    } else if($error == 2){
        $msg = "<strong>Error</strong> al actualizar el estado del participante.<br>";
        $clase = "alert alert-danger alert-dismissable fade in";
    } else if($error == 3){
        $msg = "La solicitud del Participante fue rechazada éxitosamente.<br>";
        $clase = "alert alert-warning alert-dismissable fade in";        
    } else if($error == 4){
        $msg = "Error al actualizar estado del participante.<br>";
        $clase = "alert alert-danger alert-dismissable fade in";   
    } else if($error == 5){
        $msg = "Correo Recordatorio al Cliente fue <strong>Enviado Éxitosamente</strong>.<br>";
        $clase = "alert alert-success alert-dismissable fade in";         
    } else if($error == 6){
        $msg = "<strong>Error</strong> al enviar Correo Recordatorio al Cliente.<br>";
        $clase = "alert alert-danger alert-dismissable fade in";         
    }
    else{
        $msg = "";
        $clase = "";
    }
} else{
    $msg = "";
    $clase = "";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['referir'])) {
        $referir = procesarReferidos();
        if($referir == "TRUE"){
            $msg = "<strong>Las invitaciones fueron enviadas éxitosamente.</strong><br>";
            $clase = "alert alert-success alert-dismissable fade in";
        } else if ($referir == "FALSE"){
            $msg = "<strong>Hubo un error al enviar las invitaciones. Intenta de nuevo.</strong><br>";
            $clase = "alert alert-danger alert-dismissable fade in";
        } else{
             $msg = "<strong>¡Correos enviados!.</strong><br>";
            $clase = "alert alert-warning alert-dismissable fade in";
        }
    }
}
/*
 * Panel de Cuenta de Usuario Administrador.
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salvador Hairdressing - Mistery Shopper: Área de Administrador</title>
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
        <div id="intro" style="padding: 50px 0 20px;">
            <div class="container">
                <div class="row">

                    <!-- /.intro image -->
                    <div class="col-md-6 intro-pic wow slideInLeft">
                        <img src="/mysteryshopper/images/bg.jpg" alt="image" class="img-responsive">
                    </div>	

                    <!-- /.intro content -->
                    <div class="col-md-6 wow slideInRight">
                        <h2>Mystery Shopper:<br>Área de Administrador</h2>
                        <?php if(isset($_GET["e"])){
                            echo "<div class='$clase'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            $msg</div>";        
                        }?>
                        
                        <p id="landingText1">Consulta en esta área el estado de los participantes y encuestas:</p>
                        <button type="button" class="btn-default" data-toggle="modal" data-target="#partPendientes"><b>Participantes Pendientes</b></button>
                        <button type="button" class="btn-default" data-toggle="modal" data-target="#partActivos"><b>Participantes Activos</b></button>
                        <button type="button" class="btn-default" data-toggle="modal" data-target="#progVisita"><b>Programar Visita</b></button>
                        <button type="button" class="btn-default" data-toggle="modal" data-target="#repVisita"><b>Reportes de Visita</b></button>
                        <button type="button" class="btn-default" data-toggle="modal" data-target="#invitarP"><b>Invitar a un Participante</b></button>
                        <br><a href='logout.php'><button type="button" class="btn-default" data-toggle="modal" data-target="#elimreg">Cerrar Sesión</button></a>
                        <!--<div class="btn-section"><a href="#top" class="btn-default">¡Unéte al Programa!</a></div>-->

                    </div>
                </div>			  
            </div>
        </div>
        
        <?php include 'indexBody.php';?>
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
                    <div class="text-center wow fadeInUp" style="font-size: 14px;">
                        Copyright 2016. Salvador Hairdressing</div>
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
            $(document).ready(function(){
                $('[data-toggle="popover"]').popover(); 
                $('[data-toggle="tooltip"]').tooltip(); 
            });
            $(document).on("click", ".open-AddBookDialog", function () {
                var myBookId = $(this).data('id');
                $(".modal-body #bookId").val( myBookId );
            });
            $(document).on("click", ".btn-link", function () {
                var myBookId = $(this).data('id');
                $(".modal-body #bookId").val( myBookId );
            });
            $(document).on("hidden.bs.modal", function(){
                $(".txt").html("");
            });
            $("#cancel_edit").click(function(){
                window.open('','_parent',''); 
                window.close(); 
            });

        </script>
        <script>
            new WOW().init();
        </script>
    </body>
</html>
<?php ob_end_flush(); ?>
