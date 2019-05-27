<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../sec/seguro.php";
$_SESSION["ubicacion"] = "apps";
$_SESSION["calendar_live"] = 1;
$_SESSION["tabla_basica"] = 1;
$arrayMenu = unserialize($_SESSION["accesos"]);
$code64 = base64_encode($iduser);

include "../sec/libfunc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["subcc1"])){
        $_SESSION["datossalon"] = "";
        $_SESSION["tabla_completa"] = "1";
        $_SESSION["tabla_responsive"] = 1;
        $estado = $_POST["estado"];
        $salon = $_POST["salon"]; 
        if (isset($_POST["yearcc"])) {
            $year = htmlspecialchars($_POST["yearcc"]);
        }
        //datossalon($salon);   
        include "cc.php";
    } else if(isset ($_POST["subcc2"])){
        $_SESSION["datossalon"] = "";
        $_SESSION["tabla_completa"] = "1";
        $_SESSION["tabla_responsive"] = 1;
        $estado = $_POST["estado"];
        $pais = $_POST["paises"];
        $year = htmlspecialchars($_POST["yearcc"]);
        $userid1 = $_POST["info-in"];
        list($paso, $userid2) = explode(";", $userid1);
        //datossalon($salon);
        include "cc.php";
    } else if (isset($_POST["subccregion"])) {
        $_SESSION["datossalon"] = "";
        $_SESSION["tabla_completa"] = "1";
        $_SESSION["tabla_responsive"] = 1;
        $estado = $_POST["estado"];
        $region = $_POST["paises"];
        if (isset($_POST["yearcc"])) {
            $year = htmlspecialchars($_POST["yearcc"]);
        }
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

        <!-- /.preloader 
        <div id="preloader"></div>-->
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
                        <br><h2><?php echo $crm1;?></h2>
                        <p><?php echo $crm2;?></p>
                    </div>
                </div>
                <div class="row row-feat">
                    <!-- /.CONTENIDO PRINCIPAL -->
                    <div class="col-md-12">
                          <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#home"><?php echo $crm3;?></a></li>
                            <li><a data-toggle="tab" href="#menu1"><i class="pe-7s-id pe-5x pe-va" style="visibility: visible;"></i> <?php echo $crmcc1;?></a></li>
                            <li><a data-toggle="tab" href="#menu2" onClick="limpiarTab();return;false;"><i class="pe-7s-phone pe-5x pe-va" style="visibility: visible;"></i> <?php echo $crmapp1;?></a></li>
                            <li style="display: none;"><a data-toggle="tab" href="#menu3" onClick="limpiarTab();return;false;"><i class="pe-7s-phone pe-5x pe-va" style="visibility: visible;"></i> Convenios y Promociones</a></li>
                            <li><a data-toggle="tab" href="#forms" onClick="limpiarTab();return;false;"><i class="pe-7s-comment pe-5x pe-va" style="visibility: visible;"></i> Encuestas</a></li>
                            <?php if($peruser == 50 || $peruser == 1000){ echo'<li><a data-toggle="tab" href="#franquicias" onClick="limpiarTab();return;false;"><i class="pe-7s-box1 pe-5x pe-va" style="visibility: visible;"></i> Franquicias</a></li>';} ?>

                             <!--  <li><a data-toggle="tab" href="#noticias" onClick="limpiarTab();return;false;"><i class="pe-7s-note2 pe-5x pe-va" style="visibility: visible;padding-right: 4px;"></i>Cargar Noticias</a></li> -->
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
                                            r3($salon, $estado, $year);
                                        } else if($estado == '100'){
                                            appr1($salon, $estado, $_SESSION["suc"]);
                                        } else if($estado == '200'){
                                            appr2($salon, $estado, $_SESSION["suc"]);
                                        } 
                                    } else if(isset($_POST["subcc2"])){ // reporte general cc
                                        if($estado == 'cc2b'){
                                            //echo $pais." y ".$estado." y ".$userid2;
                                            r4($pais, $userid2, $estado, $year);
                                        }
                                    } else if (isset($_POST["subccregion"])) {
                                            echo "<span id='report1b'></span>";
                                            rregion($region, $estado);
                                    } else {?>
                            <h3><?php echo $crm3;?></h3>
                            <p><?php echo $crm4;?></p>
                               <?php } ?>
                          </div>
                            
                          <!-- TAB. CLIENTCARD -->  
                          <div id="menu1" class="tab-pane fade">
                            <h3><i class="pe-7s-id pe-5x pe-va" style="visibility: visible;"></i> <?php echo $crmcc1;?></h3>
                            <p><?php echo $crmcc2;?></p>
                            <div class="col-sm-6 feat-list">
                                <div class="inner">
                                    <a href="#report-area" onClick="cargar('<?php echo $iduser;?>', '0');return false;"><h4><?php echo $crmcc3;?></h4></a>
                                    <a href="#cccli2" data-toggle="modal" data-id="cc2a" data-user="<?php echo $iduser;?>"><h4><?php echo $crmcc4;?></h4></a>
                                    <span id="paso1"></span>
                                    <span id="paso2"></span>
                                </div>
                            </div>
                          </div>
                          
                          <!-- TAB. APP -->
                          <div id="menu2" class="tab-pane fade">
                            <h3><i class="pe-7s-phone pe-5x pe-va" style="visibility: visible;"></i> <?php echo $crmapp1;?></h3>
                            <p><?php echo $crmapp2;?></p>
                            <div class="col-sm-6 feat-list">
                                <div class="inner">
                                    <a href="#appcli" data-toggle='modal' data-u='<?php echo $iduser;?>' data-id='app1'><h4><?php echo $crmapp3;?></h4></a>
                                    <a href="#appcli" data-toggle='modal' data-u='<?php echo $iduser;?>' data-id='app3'><h4><?php echo $crmapp4;?></h4></a>
                                    <!--<a href="#appcli" data-toggle='modal' data-u='<?php echo $iduser;?>' data-id='apptest1'><h4>....</h4></a>-->

                                    <span id="paso1"></span>
                                    <span id="paso2"></span>
                                    <span id="paso31"></span>
                                </div>
                            </div>
                          </div>  
                          <div id="menu3" class="tab-pane fade">
                            <h3><i class="pe-7s-phone pe-5x pe-va" style="visibility: visible;"></i> <?php echo $trConvenioTitulo; ?></h3>
                            <p><?php echo $trConvenioDetalle; ?></p>
                            <div class="col-sm-10 feat-list">
                                <div class="inner">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalconvenios" data-u='<?php echo $iduser;?>'><?php echo $trcvnAgregarConvenio; ?></button>
                                    <h4><?php echo "Reporte: Listado de Convenios Activos";?></h4>
                                    
                                    <div class='dataTables_wrapper form-inline dt-bootstrap'>
                                    <table id="example" class="display table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th><?php echo $trcvnRegion; ?></th>
                                                <th><?php echo $trcvnDesde; ?></th>
                                                <th><?php echo $trcvnHasta; ?></th>
                                                <th><?php echo $trcvnDescripcion; ?></th>
                                                <th><?php echo $trcvnComoFacturar; ?></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th><?php echo $trcvnRegion; ?></th>
                                                <th><?php echo $trcvnDesde; ?></th>
                                                <th><?php echo $trcvnHasta; ?></th>
                                                <th><?php echo $trcvnDescripcion; ?></th>
                                                <th><?php echo $trcvnComoFacturar; ?></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    </div>
                                    
                                    <span id="paso1"></span>
                                    <span id="paso2"></span>             
                                </div>
                            </div>
                          </div> <!-- FIN CONVENIOS -->

                          <!-- TAB. ENCUESTAS -->  
                          <div id="forms" class="tab-pane fade">
                            <?php if($peruser >= 50){
                                echo '<h3><i class="pe-7s-pin pe-5x pe-va" style="visibility: visible;"></i> <strong>Asignar Encuestas</strong></h3>
                            <p>En este espacio podrás asignar encuestas a Usuarios Corporativos y Franquiciados:</p>
                            <div class="col-sm-6 feat-list">
                                <div class="inner">
                                    <span id="formspace2"><img src="/intranet/componentes/images/loading-sm.gif"></span>
                                </div>
                            </div><br>';
                            } ?>

                            <p><h3><i class="pe-7s-check pe-5x pe-va" style="visibility: visible;"></i> <strong>Responder Encuestas</strong></h3></p>
                            <p>En este espacio podrás encontrar una serie de encuestas para ayudarnos a seguir mejorando:</p>
                            <div class="col-sm-6 feat-list">
                                <div class="inner">
                                    <span id="formspace"><img src="/intranet/componentes/images/loading-sm.gif"></span>
                                </div>
                            </div><br>

                            <?php if($peruser == 50 || $peruser == 1000){
                                echo '<p><h3><i class="pe-7s-comment pe-5x pe-va" style="visibility: visible;"></i> <strong>Ver Encuestas Respondidas</strong>
                            </h3></p>
                            <p></p>
                            <div class="col-sm-6 feat-list">
                            <p>Consulta las Encuestas con Respuestas en este Espacio:</p>
                                <div class="inner">
                                    <span id="formspace3"><img src="/intranet/componentes/images/loading-sm.gif"></span>
                                </div>
                            </div><br><br>';
                            } ?>



                          </div><!-- FIN ENCUESTAS -->  

                          <!-- TAB. FRANQUICIAS -->  
                          <div id="franquicias" class="tab-pane fade">
                            <?php if($peruser == 50 || $peruser == 1000){
                                echo '<h3><i class="pe-7s-albums pe-5x pe-va" style="visibility: visible;"></i> <strong>Tipo de Franquicias</strong></h3>
                            <p>Consulta el listado y estado de tus solicitudes de Franquicias según el tipo de Franquiciado:</p>
                            <div class="col-sm-12 feat-list">
                                <div class="inner">
                                  <div id="fq-content">
                                  <div id="tabla-lista"></div>
                                    <span id="fq1"><!--img src="/intranet/componentes/images/loading-sm.gif"--><ul><li><a onClick="cargarListadoFranquicias(1);" href="#pendientes">Reporte: Listado de Solicitudes <!--Pendientes--></a></li></ul></span>
                                    <!--<span id="fq2"><ul><li><a onClick="cargarListadoFranquicias(2);" href="#activas">Reporte: Listado de Solicitudes Activas</a></li></ul></span>
                                    <span id="fq3"><ul><li><a onClick="cargarListadoFranquicias(3);" href="#finalizadas">Reporte: Listado de Solicitudes Finalizadas</a></li></ul></span>
                                    <span id="fq4"><ul><li><a onClick="cargarListadoFranquicias(4);" href="#rechazadas">Reporte: Listado de Solicitudes Rechazadas</a></li></ul></span>-->
                                </div>
                            </div><br>';
                            } ?>

                        </div><!-- FIN FRANQUICIAS -->  
                        </div>
                        <!-- COMIENZO NOTIFICA -->  
                        <!-- <div id="noticias" class="tab-pane fade"> 
                           <h3><i class="pe-7s-note2 pe-5x pe-va" style="visibility: visible;;">&nbsp;<?php echo $crmnoti;?></i></h3>
                           <p><?php //echo $crmnoti2;?></p>
                           <div class="form-group">
                               <form id="formu_notic" name="formu_notic" method="POST" enctype="multipart/form-data">
                                   <input type="file" name="archivo" id="archivo_file" class="form-control-file">
                                   <label style="font-weight: 100!important;">Contenido de la noticia:</label>
                                   <textarea name="contenido" id="contenido" class="form-control" rows="10">
                                       
                                   </textarea>
                                   <button type="submit" id="btn_noticia" name="btn_noticia" class="btn btn-info">Enviar</button>
                               </form>
                               <div id="resp" style="color: #e91e63;text-align: left;margin: 13px 0 0 0;font-weight: bold;"></div>
                           </div>
                        </div> -->
                         <!--ENDNOTICIAS--> 
                      </div>
                    </div>
                    <div id="report-area">
                        <div class="row row-feat">
                        <!-- /.CONTENIDO DINAMICO -->
                            <div class="col-md-12">
                                <div id="report" class='txt'></div>
                            </div>
                        </div>
                    </div>
        
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

        <!-- COMIENZO DE MODAL: CC2  -->
        <div id="cccli2" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>ClientCard - <i>Selecciona la opción a consultar:</i></b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="row text-center">
                        <div id='contenido-modal-pre2'>   
                            <a href="#" onClick="clirepgen();return false;"><div class="selector2">
                                <dl class="selector1 color1">
                                    <dd>REPORTE</dd>
                                </dl>
                                <dl class="selector1 color1b">
                                    <dt>GENERAL</dt>
                                </dl>
                            </div></a>
                            <a href="#" onClick="clirepind();return false;"><div class="selector2">
                                <dl class="selector1 color2">
                                    <dd>REPORTE</dd>
                                </dl>
                                <dl class="selector1 color2b">
                                    <dt>INDIVIDUAL</dt>
                                </dl>
                            </div></a>
                        </div>
                        <form action="index.php" method="post">
                            <input type="hidden" name="info-in" id="info-in" value="">
                        <span id='contenido-modal9'></span>
                        <span id='contenido-modal10'></span>
                        <span id='contenido-modal11'></span>
                        </form>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: CC2 -->
        
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
        
        <!-- COMIENZO DE MODAL: ESTADISTICAS  -->
        <div id="apps" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Salvador Apps - <i>Resumen Estadístico:</i></b></h4>
                    </div>
                    <div class="modal-body">
                        <span id='contenido-modal8'></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: ESTADISTICAS -->

        <!-- COMIENZO DE MODAL: CONVENIOS  -->
        <div id="modalconvenios" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b><?php echo $trConvenioTitulo; ?></b></h4>
                    </div>
                    <div class="modal-body col-sm-12">
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                            <input type= "hidden" id="codigoconvenio" value= "">
                            <label for="txtlistaregiones"><?php echo $trcvnRegion; ?>: </label></div>          
                            <div class="col-lg-8 col-md-8 col-sm-12" id="divlistaregion"></div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <div class="col-lg-4 col-md-6 col-sm-12"><label for="inputdefault"><?php echo $trcvnDescripcion; ?>: </label></div>
                          <div class="col-lg-8 col-md-6 col-sm-12"><input class="form-control" name="txtNombreConvenio" id="txtNombreConvenio" type="text" required></div>
                        </div>
                        <div class="form-group form-inline col-lg-6 col-md-6 col-sm-12">
                          <div class="col-lg-4 col-md-4 col-sm-6"><label for="txtDesde"><?php echo $trcvnDesde; ?>: </label></div>
                          <div class="col-lg-4 col-md-4 col-sm-6"><input class="form-control" name="txtDesde" id="date_desde" type="text" required></div>
                        </div>
                        <div class="form-group form-inline col-lg-6 col-md-6 col-sm-12">
                          <div class="col-lg-4 col-md-4 col-sm-6"><label for="txtHasta"><?php echo $trcvnHasta; ?>: </label></div>
                          <div class="col-lg-4 col-md-4 col-sm-6"><input class="form-control" name="txtHasta" id="date_hasta" type="text" required></div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <div class="col-lg-4 col-md-6 col-sm-12"><label for="txtComoFacturar"><?php echo $trcvnComoFacturar; ?>: </label></div>
                          <div class="col-lg-8 col-md-6 col-sm-12"><textarea class="form-control" name="txtComoFacturar" id="txtComoFacturar"></textarea></div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <div class="col-lg-4 col-md-6 col-sm-12"><label for="txtTerminos"><?php echo $trcvnTerminos; ?>: </label></div>
                          <div class="col-lg-8 col-md-6 col-sm-12"><textarea class="form-control" name="txtTerminos" id="txtTerminos"></textarea></div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <div class="col-lg-4 col-md-6 col-sm-12"><label for="cntSalones"><?php echo $trcvnSalonesExcepto; ?>: </label></div>
                          <div class="col-lg-8 col-md-6 col-sm-12"><div class="form-control" style="border:2px solid #ccc; height: 100px; overflow-y: scroll;" id="cntSalones"></div></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Confirmar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">x</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: CONVENIOS -->

        <!-- COMIENZO DE MODAL: MINI PROMPT  -->
        <div id="miniprompt" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span id="mini-titulo"></span></h4>
                    </div>
                    <div class="modal-body">
                        <span id="mini-body"></span>
                        <span id="mini-result"></span>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>-->
                        <span id="mini-footer"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: MINI PROMPT -->
        
        </div></div>

        <?php include "../componentes/footer.php"; ?>
        <script src="/intranet/componentes/js/apps.js"></script>
        <script src="/intranet/componentes/js/bootstrap-suggest.js"></script>

        <script>
            $('.automodal').modal('show');
            $(document).ready(function() {
                $('#r1cc').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel', 'csv', 'pdf'
                    ]
                  });
                   $('#r2cc').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel', 'csv', 'pdf'
                    ]
                  });
                  $('#r1app').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'excel', 'csv', 'pdf'
                    ]
                  });
                  $('#example').DataTable({
                      "ajax": {
                        "url": "convenios.php",
                        "dataSrc": "",
                        "type": "POST",
                        "data":{action:'postconvenios', datos: '<?php echo $iduser;?>' }
                      }
                  });
                  $('#r4').DataTable({
                    dom: 'Bfrtlip',
                    buttons: [ 'copy', 'excel', 'csv', 'pdf' ]

                  });
            });

           
            loadEncuestasCRM("<?php echo $code64;?>", 1);
        </script>


    </body>
</html>
<?php ob_end_flush(); ?>