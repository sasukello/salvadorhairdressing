<?php
    // REPORTE DE POST ENCUESTA
    error_reporting(1);
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION["id_visita"])){
        $idvisita = $_SESSION["id_visita"];
    } else{
        $idvisita = 0;
    }

    include '../etc/func.php';
    if(isset($_GET["c"])){
        $contenido = base64_decode($_GET["c"]); //id encuesta respuesta
        $user = base64_decode($_GET["u"]);
    }
?>
<html>
    <head>
        <title>Salvador Hairdressing - Mistery Shopper: Consulta de Participante</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<!-- CSS Files -->
        <link href="/mysteryshopper/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/font-awesome.min.css" rel="stylesheet">
        <link href="/mysteryshopper/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="/mysteryshopper/css/animate.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/owl.theme.css" rel="stylesheet">

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
            </div>
        </nav>
    </div>

    <!-- /.intro section -->
    <div id="intro2">
        <div class="container">
            <div class="row">	

                <!-- /.intro content -->
                <div class="col-md-6 wow ">
                    <?php //listarVisitaCompleta($visita, $idparticipante, 2);   
                     reportePostVisita($contenido, $user);
                    //BOTON DE REGRESO ?>
                    <br><a href="partResumen.php?<?php echo "v=".  base64_encode($idvisita) ."&vi=".  base64_encode($user) ?>"><button type="button" class="btn-default">Volver al Resumen de la Visita</button></a>
                </div>
            </div>			  
        </div>
    </div>
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
        });
    </script>
    <script>
        new WOW().init();
    </script>
</body>
</html>
