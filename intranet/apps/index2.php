<?php
include "../sec/seguro.php";
$_SESSION["ubicacion"] = "default";
$arrayMenu = unserialize($_SESSION["accesos"]);

//include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/minutaslang.php";
include "../sec/libfunc.php";
include "convenios.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["subcc1"])){
        //echo "hola!";
        $_SESSION["datossalon"] = "";
        $_SESSION["tabla_basica"] = 1;
        $_SESSION["tabla_completa"] = 1;
        $_SESSION["tabla_responsive"] = 1;
        $estado = $_POST["estado"];
        $salon = $_POST["salon"]; 
        //datossalon($salon);   
        include "cc.php";
    }
}
?>

<!DOCTYPE html>
<html>
        <head>
        <title>Salvador Hairdressing - Intranet</title>
        <?php include "../componentes/header.php"; ?>
        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader -->
        <div id="preloader"></div>
        <div id="top"></div>

        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); 
              include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php");?>

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
                        <br><h2>Aplicaciones Web</h2>
                        <p>Opciones Disponibles:</p>
                    </div>
                </div>
                <div class="row row-feat">
                    <!-- /.CONTENIDO PRINCIPAL -->
                    <div class="col-md-12">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home">Inicio</a></li>
                            <li><a data-toggle="tab" href="#menu1"><i class="pe-7s-id pe-5x pe-va" style="visibility: visible;"></i> ClientCard</a></li>
                            <li><a data-toggle="tab" href="#menu2" onClick="limpiarTab();return;false;"><i class="pe-7s-phone pe-5x pe-va" style="visibility: visible;"></i> Salvador App</a></li>
                            <li><a data-toggle="tab" href="#menu3" onClick="limpiarTab();return;false;"><i class="pe-7s-phone pe-5x pe-va" style="visibility: visible;"></i> Convenios y Promociones</a></li>                            
                          </ul>

                        <div class="tab-content">
                            
                            <!-- PRINCIPAL -->
                          <div id="home" class="tab-pane fade in active">
                              <?php if (isset($_POST["subcc1"])){
                                        if($estado == '1' || $estado == '0'){
                                            echo "<span id='report1b'></span>";
                                            r1($salon, $estado);
                                        } else if($estado == 'cc2a'){
                                            echo "<span id='report1b'></span>";
                                            r3($salon, $estado);
                                        } else if($estado == '100'){
                                            appr1($salon, $estado, $_SESSION["suc"]);
                                        } else if($estado == '200'){
                                            appr2($salon, $estado, $_SESSION["suc"]);
                                        }
                                    } else {?>
                            <h3>Inicio</h3>
                            <p>¡Bienvenido! En esta sección encontrarás información útil con respecto a las aplicaciones web y móviles de Salvador Hairdressing.</p>
                               <?php } ?>
                          </div>
                            
                          <!-- TAB. CLIENTCARD -->  
                          <div id="menu1" class="tab-pane fade">
                            <h3><i class="pe-7s-id pe-5x pe-va" style="visibility: visible;"></i> ClientCard</h3>
                            <p>Consulta los reportes de ClientCard con movimientos registrados en tu salón.</p>
                            <div class="col-sm-6 feat-list">
                                <div class="inner">
                                    <a href="#report-area" onClick="cargar('<?php echo $iduser;?>', '0');return false;"><h4>Reporte: Listado de Clientes con ClientCard</h4></a>
                                    <a href="#cccli" data-toggle="modal" data-id="cc2a" data-user="<?php echo $iduser;?>"><h4>Reporte: Listado de ClientCards entregadas por Salón</h4></a>
                                    <span id="paso1"></span>
                                    <span id="paso2"></span>
                                    <!--<a href="#r2"><h4>Reporte: Movimientos de Clientes con ClientCard</h4></a>
                                    <a href="#r3"><h4>Reporte: Tarjetas Activas</h4></a>-->
                                </div>
                            </div>
                          </div>
                          
                          <!-- TAB. APP -->
                          <div id="menu2" class="tab-pane fade">
                            <h3><i class="pe-7s-phone pe-5x pe-va" style="visibility: visible;"></i> Salvador App</h3>
                            <p>Consulta aquí el listado de tus Clientes inscritos en la App de Salvador Hairdressing para Android e iOS.</p>
                            <div class="col-sm-6 feat-list">
                                <div class="inner">
                                    <a href="#appcli" data-toggle='modal' data-u='<?php echo $iduser;?>' data-id='app1'><h4>Reporte: Listado de Clientes Inscritos en la App</h4></a>
                                    <a href="#appcli" data-toggle='modal' data-u='<?php echo $iduser;?>' data-id='app3'><h4>Reporte: Historial de Citas Programadas</h4></a>

                                    <span id="paso1"></span>
                                    <span id="paso2"></span>
                                    <!--<a href="#r2"><h4>Reporte: Movimientos de Clientes con ClientCard</h4></a>
                                    <a href="#r3"><h4>Reporte: Tarjetas Activas</h4></a>-->
                                </div>
                            </div>
                          </div>

                          <!-- TAB. convenios -->                          
                          <div id="menu3" class="tab-pane fade">
                            <h3><i class="pe-7s-phone pe-5x pe-va" style="visibility: visible;"></i> <?php echo $trConvenioTitulo; ?></h3>
                            <p><?php echo $trConvenioDetalle; ?></p>
                            <div class="col-sm-6 feat-list">
                                <button type="submit" class="btn btn-default" name="submitNuevoConvenio" data-toggle="modal" data-target="#modalconvenios"><?php echo $trcvnAgregarConvenio; ?></button>
                                <div class="inner">
                                    <?php
                                       /**************************************************/
                                       /*    Muestra el listado de promociones activas   */
                                       /**************************************************/
                                            
                                       /* Obtiene las regiones a las que tiene acceso el usuario logueado */ 
                                       echo "<table id='r1cc' class='table table-striped table-bordered dt-responsive nowrap'>
                                           <thead>
                                             <tr>
                                               <th> $trcvnRegion </th>
                                               <th> $trcvnDesde </th>
                                               <th> $trcvnHasta</th>
                                               <th> $trcvnDescripcion </th>
                                               <th> $trcvnComoFacturar</th>         
                                             </tr>
                                           </thead>
                                       <tbody>";
                                       echo listaconvenios(); 
                                       echo "</tbody></table></div></p>";
                                    ?>
                                    <span id="paso1"></span>
                                    <span id="paso2"></span>             
                                </div>
                            </div>
                          </div> <!--Div Convenios-->
                        </div>
                      </div>
                    </div>
                    <span id="report-area"
                        <div class="row row-feat">
                        <!-- /.CONTENIDO DINAMICO -->
                            <div class="col-md-12">
                                <div id="report" class='txt'></div>
                            </div>
                        </div>
                    </span>
        
        <!-- COMIENZO DE MODAL: MOVIMIENTOS  --> 
        <?php echo modalconvenio(); ?>
        
        <!-- COMIENZO DE MODAL: MOVIMIENTOS  -->
        <div id="mov1" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Historial de Movimientos para: <span id='modal-titulo'></span></b></h4>
                    </div>
                    <div class="modal-body">
                        <span id='contenido-modal'></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: MOVIMIENTOS -->
        
        <!-- COMIENZO DE MODAL: CC1  -->
        <div id="cccli" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>ClientCard - <i>Selecciona el salón a consultar:</i></b></h4>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" method="post">
                        <span id='contenido-modal2'></span>
                        <span id='contenido-modal3'></span>
                        <span id='contenido-modal4'></span>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: CC1 -->
        
        <!-- COMIENZO DE MODAL: MOV1  -->
        <div id="appcli" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Salvador App - <i>Selecciona el salón a consultar:</i></b></h4>
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
        <!-- FIN DE MODAL: MOV1 -->
            
                </div>
            </div>
        </div>

        <?php include "../componentes/footer.php"; ?>
        <script src="/intranet/componentes/js/apps.js"></script>
        <script>
            $('.automodal').modal('show');
            $(document).ready(function() {
                $('#r1cc').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf'
                    ]
                  });
                   $('#r2cc').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf'
                    ]
                  });
                  $('#r1app').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf'
                    ]
                  });
            } );
        </script>
    </body>
</html>
<?php ob_end_flush(); ?>