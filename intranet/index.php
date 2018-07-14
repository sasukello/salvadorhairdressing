<?php
ob_start();
error_reporting(0);
include "sec/seguro.php";
include "sec/intranetvarios.php";
include "sec/libfunc.php";

$_SESSION["tabla_basica"] = 1;
$_SESSION["ubicacion"] = "default";

?>

<!DOCTYPE html>
<html>
        <head>
        <title>Salvador Hairdressing - Intranet</title>
        <?php include "componentes/header.php"; ?>
        <link rel="stylesheet" href="//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css">
        </head>



        <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader 
        <div id="preloader"></div>-->
        <div id="top"></div>

        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu);
            //debug_to_console($arrayMen);
            include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/intranetvarios.php"); ?>

                        </div>

                    </div>

                </div> 

            </div> 

        </div>



        <!-- /.seccion principal -->

        <div id="main">

            <div class="container">

                <div class="row">

                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">

                        <?php if(isset($mensaje)){ ?>

                            <br><div class="alert alert-success">

                              <?php echo mensajeenviado; ?>

                            </div>

                        <?php } 



                        echo "<br><h2>$ibienven</h2>

                        <p>$ibienven2.

                        <br><b><i>$ibienven3</i></b></p>"; ?>

                    </div>

                </div>

                <div class="row row-feat">

                    <div class="col-md-12">

                        <!-- /.CONTENIDO PRINCIPAL -->

                        <div id="c1">

                            <div class="col-lg-3 col-md-6 col-sm-6">

                                    <div class="card card-stats">

                                        <div class="card-header" data-background-color="red">

                                            <i class="material-icons pe-7s-global"></i>

                                        </div>

                                        <div class="card-content">

                                            <p class="category"><?php echo $imodalmreg;?></p>

                                            <h3 class="title"><?php echo $imodalmreg2;?></h3>

                                        </div>

                                        <div class="card-footer">

                                            <div class="stats">

                                                <span id="componente1"></span>

                                            </div>

                                        </div>

                                    </div>

                            </div>

                        </div>

                        <div id="c2">

                            <div class="col-lg-3 col-md-6 col-sm-6">

                                    <div class="card card-stats">

                                        <div class="card-header" data-background-color="blue">

                                            <i class="material-icons pe-7s-scissors"></i>

                                        </div>

                                        <div class="card-content">

                                            <p class="category"><?php echo $imodalmreg;?></p>

                                            <h3 class="title"><?php echo $imodalmreg3;?></h3>

                                        </div>

                                        <div class="card-footer">

                                            <div class="stats">

                                                <span id="componente2"></span>

                                            </div>

                                        </div>

                                    </div>

                            </div>

                        </div>

                        <div id="c3">

                            <div class="col-lg-3 col-md-6 col-sm-6">

                                    <div class="card card-stats">

                                        <div class="card-header" data-background-color="green">

                                            <i class="material-icons pe-7s-folder"></i>

                                        </div>

                                        <div class="card-content">

                                            <p class="category"><?php echo $imodalmreg;?></p>

                                            <h3 class="title"><?php echo $imodalmreg4;?></h3>

                                        </div>

                                        <div class="card-footer">

                                            <div class="stats">

                                                <!--<i class="material-icons text-danger pe-7s-info"></i> <a href="#"> Texto...</a>-->

                                                <span id="componente3"></span>

                                            </div>

                                        </div>

                                    </div>

                            </div>

                        </div>

                        <div id="c4">

                            <div class="col-lg-3 col-md-6 col-sm-6">

                                    <div class="card card-stats">

                                        <div class="card-header" data-background-color="purple">

                                            <i class="material-icons pe-7s-note2"></i>

                                        </div>

                                        <div class="card-content">

                                            <p class="category"><?php echo $imodalmreg;?></p>

                                            <h3 class="title"><?php echo $imodalmreg5;?></h3>

                                        </div>

                                        <div class="card-footer">

                                            <div class="stats">

                                                <!--<i class="material-icons text-danger pe-7s-info"></i> <a href="#"> Texto...</a>-->

                                                <span id="componente4"></span>

                                            </div>

                                        </div>

                                    </div>

                            </div>

                        </div>

                    </div>

                   <?php /*if($iduser == "CGARCIA"){
                    var_dump($arrayMenu);
                    if (array_key_exists('13', $arrayMenu)) {
                        echo "<div class='row'>
                        <div id='c7'><h4><a href='directorio'>Entrar a Directorio</a></h4></div></div>"; 
                    }

                   } */?>

                </div>

                <?php if($iduser == "ALUGO" || $iduser == "ECOLMENARES" || $iduser == "MGIURDANELLA"){

                echo "<div class='row'>

                    <div id='c6'><h1 class='loadtext' data-text='Cargando...''>Cargando...</h1></div>                        

                </div>"; } else {echo "";} ?>

                </div>

            </div>

        </div>



        <?php 

            modalBetaTester();
            modalVentasDashboard();
            //modalResumenVentas();
            include "componentes/footer.php"; 
            //echo $peruser;
        ?>

        <script src="/intranet/componentes/js/intranet.js" type="text/javascript"></script>     
        <script>
            $(document).ready(function() {
                cargaInicial(<?php echo "'".$iduser."'";?>);
            });
        </script>
    </body>
</html>

<?php ob_end_flush(); ?>