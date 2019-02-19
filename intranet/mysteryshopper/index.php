<?php
ob_start();

include "../sec/seguro.php";

$_SESSION["ubicacion"] = "default";

include "../sec/libfunc.php";
require_once "../../mysteryshopper/etc/func.php";

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
             $msg = "<strong>Sucedió algo inesperado!.</strong><br>".$referir;
            $clase = "alert alert-warning alert-dismissable fade in";
        }
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mystery Shopper: Área de Administrador (Intranet) - Salvador Hairdressing</title>
        <?php include "../componentes/header.php"; ?>
        <link href="/mysteryshopper/css/estilo.css" rel="stylesheet" media="screen">

    </head>

    <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader 
        <div id="preloader"></div>-->
        <div id="top"></div>

        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); 
            include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php"); ?>

                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">
                        <h2>Mystery Shopper</h2>
                        <p>Área de Administrador</p>
                    </div>
                </div>
        <div id="intro" style="padding: 50px 0 20px;">
            <div class="container">
                <div class="row">

                    <!-- /.intro content -->
                    <div class="col-md-12 wow slideInRight">
                        <?php if(isset($_GET["e"])){
                            echo "<div class='$clase'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            $msg</div>";        
                        } else if(isset($referir)){
                            echo "<div class='$clase'>
                            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                            $msg</div>";
                            }?>
                        
                        <p id="landingText1">Consulta en esta área el estado de los participantes y encuestas:</p>
                        <div class="row">
                          <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                              <img src="/intranet/componentes/images/ms/pend.png" alt="...">
                              <div class="caption">
                                <h3>Participantes Pendientes</h3>
                                <p><button type="button" class="btn-default" data-toggle="modal" data-target="#partPendientes">Consultar</button></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                              <img src="/intranet/componentes/images/ms/active.png" alt="...">
                              <div class="caption">
                                <h3>Participantes Activos</h3>
                                <p><button type="button" class="btn-default" data-toggle="modal" data-target="#partActivos">Consultar</button></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                              <img src="/intranet/componentes/images/ms/programar.png" alt="...">
                              <div class="caption">
                                <h3>Programar Visita</h3>
                                <p><button type="button" class="btn-default" data-toggle="modal" data-target="#progVisita">Programar</button></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                              <img src="/intranet/componentes/images/ms/reporte.png" alt="...">
                              <div class="caption">
                                <h3>Reportes de Visita</h3>
                                <p><button type="button" class="btn-default" data-toggle="modal" data-target="#repVisita">Consultar</button></p>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                              <img src="/intranet/componentes/images/ms/email.png" alt="...">
                              <div class="caption">
                                <h3>Invitar a un Participante</h3>
                                <p><button type="button" class="btn-default" data-toggle="modal" data-target="#invitarP">Invitar</button></p>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>			  
            </div>
        </div>
        
        <?php include 'indexBody.php';?>
        <!-- /.footer -->
        <?php include '../componentes/footer.php' ?>

        <!-- /.javascript files
        <script src="/mysteryshopper/js/custom.js"></script> -->
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
    </body>
</html>
<?php ob_end_flush(); ?>
