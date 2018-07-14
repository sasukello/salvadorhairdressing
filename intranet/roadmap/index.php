<?php
error_reporting(1);

include "../sec/seguro.php";
$_SESSION["ubicacion"] = "default";
$_SESSION["calendar_live"] = 0;
$arrayMenu = unserialize($_SESSION["accesos"]);
$proyectnew = "";
include "../sec/libfunc.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['e'])) { 
        $proyectnew = $_GET['e'];
    }
}
?>

<!DOCTYPE html>
<html>
        <head>
        <title>Salvador Hairdressing - Intranet</title>
        <?php include "../componentes/header.php"; ?>
        <link href="estilos20.css" rel="stylesheet">

        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader 
        <div id="preloader"></div>-->
        <div id="top"></div>

        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); 
           // include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php"); ?>

                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <!-- /.seccion principal -->
        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="text-center titl text-center"><i class="pe-7s-note2"> </i><span> RoadMap </span></div>
                    <div class="col-md-12 col-sm-12 text-center feature-title">

                            <!-- / CONDICION REGISTRO EXITOSO JP -->
                       
                        <?php
                        if ($proyectnew=='1'){

                        $mensaje = 'Registro exitoso';
                        echo '<div class="alert alert-success">  '.$mensaje.' </div>';
                        }
                        if ($proyectnew=='0'){

                        $mensaje = 'Fallo Registro';
                        echo '<div class="alert alert-danger">  '.$mensaje.' </div>';
                        }
                        ?>
                                           


                        <!-- / Reporte de Proyectos -->
                        <div class="col-md-6">
                            <div class="panel box-v6">
                                <div class="panel-heading">
                                  <br><h4>Reporte de Proyectos:
                                    <span class="icon-options-vertical icons pull-right"></span>
                                  </h4>
                                </div>
                                    <span id="texto"></span>
                                    <span id="texto2"></span>
                            </div>
                        </div>

                      <!--Menú-->
                      <div class="col-md-5 col-md-offset-1">
                        <div class='or-spacer col-md-12 col-sm-12 text-center barr'>
                          <div class='mask'></div>
                          <span><i>Menú</i></span>
                        </div>

                        <div class='col-sm-11 feat-list barra'>
                            
                            <div class='inner'>
                                <a class="col-md-10"><i class='pe-7s-plus pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i><h4>Nuevo Proyecto</h4></a>
                                <p class="col-md-10">Si estás gestionando un nuevo proyecto, agregalo a tu historial de proyectos.</p>
                            </div>
                            <div class="col-md-10">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#newproject">Agregar</button>
                            </div>
                        </div>

                        <div class='col-sm-11 feat-list barra'>
                            <div class='inner'>
                                <a class="col-md-10"><i class='pe-7s-folder pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i><h4>Historial de Proyectos</h4></a>
                                <p class="col-md-10">Visualiza todos los proyectos en los cuales hayas participado.</p>
                            </div>
                            <div class="col-md-10">
                            <a href="proyectos.php" class="btn btn-info" role="button">Ver</a>
                            </div>
                        </div>

                        <div class='col-sm-11 feat-list barra'>
                            <div class='inner'>
                                <a class="col-md-10"><i class='pe-7s-tools pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i><h4>Agregar una Nueva Opción</h4></a>
                                <p class="col-md-10">Si estás gestionando un nuevo proyecto, agregalo a tu historial.</p>
                            </div>
                            <div class="col-md-10">
                            <button type="button" class="btn btn-info">Opción</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

         <!-- COMIENZO DE MODAL: VER PROYECTO  -->
        <div id="infopr" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Proyecto - <span id="prtit"></span></b><span class="pe-7s-note modpr"></span></h4>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" id="beta_form" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="filtroventa" style="text-align: center;">Información Detallada del Proyecto.</label>
                                <br><br><div class="col-sm-12">
                                    <div class="list-group">
                                    <span class="list-group-item"><strong>Nombre: </strong> <span id="prtit1"></span></span>
                                        <span id="modalprcontent"></span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- FIN DE MODAL: VER PROYECTO -->

<!-- COMIENZO DE MODAL: NUEVO PROYECTO JP  -->
        <div id="newproject" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Información Detallada del Nuevo Proyecto. - <span id="prtit"></span></b><span class="pe-7s-note modpr"></span></h4>
                    </div>

                   <form method="post" action="libreria.php"> 
                   <div class="modal-body">
                        <div class="form-group">
                               
                                <div class="col-sm-12">
                                    <div class="list-group">
                                    <span class="list-group-item"><strong>
                                        <!-- FORMULARIO JP  -->
                                                Nombre : <input type="text" name="nombrepr" class="form-control" required> 
                                                Categoria : 
                                                    <select class="form-control form-control-sm" name="categoriapr" required>
                                                        <option value="">Seleccionar</option>
                                                        <option value="1">Publicidad</option>    
                                                        <option value="2">Academia</option>    
                                                        <option value="3">Recursos Humanos</option>    
                                                        <option value="4">Recepcion</option>    
                                                        <option value="5">Sistemas</option>  
                                                    </select>
                                                Responsable : <input type="text" name="responsable" class="form-control" required>
                                                Fecha Estimada de Cierre:<br><input class="form-control" type="date" name="fechacierre" required> 
                                                <label for="descripcion">Breve Descripción : </label><textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea><br>  
                                                   
                                                
                                                
                                                <input type="submit" name="valider" class="btn btn-info" value="Guardar"> 
                                                <button type="button" class="btn" data-dismiss="modal">Cerrar</button>

                                        

                                                    <span id="modalprcontent"></span>
                                                </div>
                                            </div>
                                        </div>
                                   
                                </div>
                                <div class="modal-footer">
                                 <!--   <input type="submit" name="valider" class="btn btn-info" value="Guardar"> 
                                    <button type="button" class="btn" data-dismiss="modal">Cerrar</button> --> 
                                </div>
                                 </form>
                            </div>

                        </div>
                    </div>
        <!-- FIN DE MODAL: NUEVO PROYECTO JP -->




        <!-- COMIENZO DE MODAL: VER ACTIVIDADES  -->
        <div id="actipr" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Actividades para - <span id="practtit"></span></b></h4>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" id="beta_form" method="post" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="list-group">
                                        <span id="modalpracti"></span>
                                    </div>
                                    <div style="text-align: right;">
                                    <a href="#" data-toggle="modal" data-target="#tarea" class="opciones">Añadir Actividad</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- FIN DE MODAL: VER ACTIVIDADES -->

        <?php include "../componentes/footer.php"; ?>
        <script src="/intranet/componentes/js/roadmap.js" type="text/javascript"></script>     
        <script>
            $(document).ready(function() {
                initLoad(<?php echo "'".$iduser."'";?>);
            });
        </script>
    </body>
</html>
<?php ob_end_flush(); ?>