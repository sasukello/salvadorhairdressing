<?php

include "../../sec/seguro.php";
$_SESSION["ubicacion"] = "default";
$_SESSION["calendar_live"] = 1;
$_SESSION["tabla_basica"] = 1;
$arrayMenu = unserialize($_SESSION["accesos"]);
$code64 = base64_encode($iduser);

include "../../sec/libfunc.php";
include "desaso.php";

$salon = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST["subcc1"])){        
        $_SESSION["tabla_completa"] = "1";
        $_SESSION["tabla_responsive"] = 1;
        $region = $_POST["paises"];
        $salon = $_POST["salon"];                 
    } 


}

?>

<!DOCTYPE html>
<html>
        <head>
        <title>Salvador Hairdressing - Intranet</title>
        <?php include "../../componentes/header.php"; ?>
        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">
        <!-- /.preloader 
        <div id="preloader"></div>-->
        <div id="top"></div>

        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); ?>

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

                        <!-- / titulo -->
                        <br><h2>Talento Humano</h2>
                        <p>Operaciones para el departamento de Talento Humano</p>
                    </div>
                </div>
                <div class="row row-feat">
                    <!-- /.CONTENIDO PRINCIPAL -->
                    <div class="col-lista">
                         <?php                              
                             if ($salon !== "") {                               
                                ListaAsociadosDesbloquear($salon);       
                             } //Si no se trajo el salon
                         ?>
                    </div>
                    <!-- /.Opciones del Menu -->
                    <div class="col-md-12">
                    <div class="row"><a href="../" class="btn btn-default" role="button" aria-pressed="true">Regresar a Corporativo</a></div>
                    <p></p>
                    <?php if($peruser == "50"){
                        foreach ($arrayMenu as $opc) {
                            switch ($opc) {
                                case 'DesbloqueoRemotoparaAsociados1':
                                    echo "<div class='col-sm-4 feat-list'>
                                            <i class='pe-7s-delete-user pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                                            <div class='inner'>
                                                <a href='#desaso' data-toggle='modal' data-u='".$iduser."' data-id='app3'><h4>Desbloqueo de Asociados</h4></a>                                                
                                                <p>Desbloquea Asociados desde la Intranet.</p>
                                            </div>
                                        </div>";
                                    break;
                                
                                default:
                                    # code...
                                    break;
                            }
                        }
                    } else{

                        echo "No tienes opciones disponibles para ver.";
                    }

                    ?>
                    </div>
                </div>
            </div>
        </div>        
        <!-- COMIENZO DE MODAL: DESBLOQUEO ASOCIADOS  -->
        <div id="desaso" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Desbloqueo de asociados - <i>Selecciona el salón a consultar:</i></b></h4>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" method="post">
                        <span id='contenido-modal5'></span>
                        <span id='contenido-modal6'></span>
                        <span id='contenido-modal7'></span>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: DESBLOQUEO ASOCIADOS -->

        <?php include "../../componentes/footer.php"; ?>
        <script src="/intranet/componentes/js/corp-rrhh.js" type="text/javascript"></script>
    </body>
</html>

