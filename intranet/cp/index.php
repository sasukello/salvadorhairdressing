<?phpob_start();$user = "";$iduser = "";if (session_status() === PHP_SESSION_NONE) {    session_start();    if(isset($_SESSION["codigo"])){        $user = $_SESSION["usuario"];        $iduser = $_SESSION["codigo"];        $peruser = $_SESSION["permiso"];        $hash = $_SESSION["hash"];        $arrayMenu = unserialize($_SESSION["accesos"]);        $_SESSION['ubicacion'] = "cp";                       if($hash == "s6a5486dasdas31"){            $bandera = true;        } else{        header("location:../logout.php");        }    } else{       header("location:../logout.php");    }}include "../sec/libfunc.php";?><!DOCTYPE html><html>        <head>        <title>Salvador Hairdressing - Intranet: CP</title>        <?php include "../componentes/header.php"; ?>        </head>        <body data-spy="scroll" data-target="#navbar-scroll">        <!-- /.preloader -->        <div id="top"></div>        <!-- /.cabecera -->        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu);?>        <!-- /.intro section -->        <div id="main">            <div class="container">                <div class="text-center">                    <!-- /.pricing title -->                    <br><br><h2 class="wow fadeInLeft">Bienvenido al <b>Panel de Control</b></h2>                    <div class="title-line wow fadeInRight"></div>                </div>                <div class="row package-option">                    <!-- /.package 1 -->                    <div class="col-sm-6">                        <div class="price-box wow fadeInUp">                            <div class="price-heading text-center">                                <!-- /.package icon -->                                <i class="pe-7s-radio pe-5x"></i>                                <!-- /.package name -->                                <h3>Sección de Administrador</h3>                            </div>                            <!-- /.price -->                            <div class="price-group text-center">                                <!--<span class="dollar">$</span>-->                                <span class="price">3</span>                                <span class="time">items</span>                            </div>                            <!-- /.package features -->                            <ul class="price-feature text-center">                                <li><a href="/intranet/descargas">Descargas</a></li>                                <li><a href="/intranet/cp/cc">ClientCard</a></li>                                <li><a href="/intranet/callcenter/">CallCenter</a></li>	                                <li><a href="lang.php">Actualizaciones de Idioma (LIVE)</a></li>                                <?php if ($iduser == "ALUGO"){                                   echo "<li><a href='cc/estadisticas.php'>ClientCard</a></li>";                                 }?>                            </ul>                        </div>                    </div>                    <!-- /.package 3 -->                    <div class="col-sm-6">                        <div class="price-box wow fadeInUp" data-wow-delay="0.4s">                            <div class="price-heading text-center">                                <!-- /.package icon -->                                <i class="pe-7s-science pe-5x"></i>                                <!-- /.package name -->                                <h3>Páginas Front-End</h3>                            </div>                            <!-- /.price -->                            <div class="price-group text-center">                                <!--<span class="dollar">$</span> -->                                <span class="price">8</span>                                <span class="time">items</span>                            </div>                            <!-- /.package features -->                            <ul class="price-feature text-center">                                <li><a href="/intranet/"><strong>Inicio</strong> Intranet</a></li>                                <li><a href="/cicaracaffe">Cicara Caffe</a></li>                                <li><a href="/cc">ClientCard</a></li>                                <li><a href="/movil/es">Web Móvil</a></li>                                <li><a href="/academia">Academia</a></li>                                <li><a href="/academia2">Academia: Nuevo Diseño</a></li>                                <li><a href="/mysteryshopper">Mystery Shopper</a></li>                                <li><a href="/intranet/auditorias">Auditorias</a></li>					                              </ul>                        </div>                    </div>                </div>            </div>        </div>        <?php include "../componentes/footer.php"; ?>    </body></html><?php ob_end_flush(); ?>