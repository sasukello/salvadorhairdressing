<?php


include "../sec/seguro.php";
$_SESSION["ubicacion"] = "formacion";
$arrayMenu = unserialize($_SESSION["accesos"]);
$code64 = base64_encode($iduser);

include "../sec/libfunc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

}

?>

<!DOCTYPE html>
<html>
        <head>
        <title>Salvador Hairdressing - Intranet</title>
        <?php include "../componentes/header.php"; ?>
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
                <div class="row row-feat">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">
                        <h2>Formación</h2>
                    </div>
                </div>
                <div class="row row-feat">
                    <!-- /.CONTENIDO PRINCIPAL -->
                    <div class="col-md-12">
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                              <img src="/intranet/componentes/images/ms/pend.png" alt="...">
                              <div class="caption">
                                <p class="text-center"><button type="button" class="btn-default" data-toggle="modal" data-target="#form1" data-tipo="load1">Ver Cursos</button></p>
                              </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <div class="thumbnail">
                              <img src="/intranet/componentes/images/ms/pend.png" alt="...">
                              <div class="caption">
                                <p class="text-center"><button type="button" class="btn-default" data-toggle="modal" data-target="#form1" data-tipo="load2">Evaluar Cursos</button></p>
                              </div>
                            </div>
                        </div>                    
                    </div>
                </div>
                    
        
        <!-- COMIENZO DE MODAL: MOV1  -->
        <div id="form1" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span id="form1titulo"></span></h4>
                    </div>
                    <div class="modal-body">
                        <span id="form1body1"></span>
                        <span id="form1body2"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: MOV1 -->


        <!-- COMIENZO DE MODAL: MINI PROMPT  -->
        <div id="form2" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span id="mini-titulo"></span></h4>
                    </div>
                    <div class="modal-body">
                        <span id="mini-extra-info"></span>
                        <span id="mini-body"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        <span id="mini-footer"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: MINI PROMPT -->
        
        </div></div>

        <?php include "../componentes/footer.php"; ?>
        <script src="/intranet/componentes/js/formacion.js"></script>
    </body>
</html>