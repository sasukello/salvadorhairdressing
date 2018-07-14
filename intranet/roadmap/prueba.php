<?php
include "../sec/seguro.php";
$_SESSION["ubicacion"] = "default";
$_SESSION["calendar_live"] = 0;
$arrayMenu = unserialize($_SESSION["accesos"]);

include "../sec/libfunc.php";
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

                        <!-- / Reporte de Proyectos -->
                        <div class="col-md-6">
                        <div class="panel box-v6">
                            <div class="panel-heading">
                              <br><h4>Reporte de Proyectos:
                                <span class="icon-options-vertical icons pull-right"></span>
                              </h4>
                            </div>
                            <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="MG"></span><span data-letters="EC"></span>
                                      <a data-toggle="modal" data-target="#info"><h4>Proyecto de Sistemas</h4></a>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> 70 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                             <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="MG"></span><span data-letters="EC"></span><span data-letters="AL"></span>
                                      <a data-toggle="modal" data-target="#info"><h4>Nueva Franquicia</h4></a>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:56%"> 56 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                             <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="AL"></span><span data-letters="EC"></span><span data-letters="MC"></span><span data-letters="EJ"></span>
                                      <a data-toggle="modal" data-target="#info"><h4>Prueba Num. 3</h4></a>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:14%"> 14 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                             <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="MG"></span><span data-letters="EC"></span>
                                      <a data-toggle="modal" data-target="#info"><h4>Prueba Num. 4</h4></a>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:92%"> 92 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                             <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="MG"></span><span data-letters="EC"></span>
                                      <a data-toggle="modal" data-target="#info"><h4>Prueba Num. 5</h4></a>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:42%"> 42 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
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

    <!-- COMIENZO DE MODAL: NUEVO PROYECTO  -->
        <div id="newproject" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Agregar Nuevo Proyecto:</b></h4>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" id="beta_form" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-9" for="filtroventa">Agrega la información de tu nuevo proyecto.</label>
                                <br><br><div class="col-sm-12">
                                    <div class="list-group">
                                        <span class="list-group-item"><strong>Nombre del Proyecto:</strong> <input class="form-control" name="beta_mensaje" cols="8" rows="auto" required></input></span>


                                        <div class="form-group row list-group-item sel formulario">

                                          <div class="col-xs-6">
                                            <span><strong>Categoría:</strong> <select class="form-control" name="beta_seccion" required>
                                            <option>Selecciona una opción..</option><option value="LIVE">Nueva Franquicia</option><option value="CRM-APPS">Proyecto Sistemas</option><option value="CRM-CC">Opción 3</option><option value="CRM-CONVENIOS">Opción 4</option><option value="DESCARGAS">Opción 5</option><option value="MINUTAS-REGION">Opción 6</option>
                                            </select></span>
                                          </div>

                                          <div class="col-xs-6">
                                            <span><strong>Región:</strong> <select class="form-control" name="beta_seccion" required>
                                            <option>Selecciona una opción..</option><option value="OTRO">No Aplica</option><option value="LIVE">Región 1</option><option value="CRM-APPS">Región 2</option><option value="CRM-CC">Región 3</option><option value="CRM-CONVENIOS">Región 4</option><option value="DESCARGAS">Región 5</option><option value="MINUTAS-REGION">Región 6</option><option value="MINUTAS-SALON">Región 7</option><option value="MINUTAS-COMITE">Región 8</option><option value="IDIOMA">Región 9</option>
                                            </select></span>

                                        </div>
                                      </div>


                                        <!--span class="list-group-item"><strong>Categoría:</strong> <select class="form-control" name="beta_seccion" required>
                                        <option>Selecciona una opción..</option><option value="LIVE">Salvador+ Live</option><option value="CRM-APPS">CRM - Apps</option><option value="CRM-CC">CRM - Client Card</option><option value="CRM-CONVENIOS">CRM - Convenios</option><option value="DESCARGAS">Descargas</option><option value="MINUTAS-REGION">Minutas - Region</option><option value="MINUTAS-SALON">Minutas - Salón</option><option value="MINUTAS-COMITE">Minutas - Comité</option><option value="IDIOMA">Ajustes - Idioma</option><option value="OTRO">Otro</option>
                                        </select></span-->

                                        <span class="list-group-item"><strong>Fecha de Inicio:</strong>


                                        </span>

                                        <span class="list-group-item"><strong>Descripción del Proyecto:</strong> <textarea class="form-control" name="beta_mensaje" cols="8" rows="auto" required></textarea></span>
                                    </div>
                                    <input type="submit" class="btn-primary form-control input-lg" name="beta_enviar" value="Agregar Proyecto">
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
        <!-- FIN DE MODAL: NUEVO PROYECTO -->

        <!-- COMIENZO DE MODAL: VER PORYECTO  -->
        <div id="info" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Proyecto: NUEVA FRANQUICIA EN ZULIA</b></h4>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" id="beta_form" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="filtroventa" style="text-align: center;">Información Detallada del Proyecto.</label>
                                <br><br><div class="col-sm-12">
                                    <div class="list-group">
                                        <span class="list-group-item"><strong>Nombre del Proyecto: </strong> XXXXXXXXXXXXXXXXXXXXXXXXXXXX </span>

                                        <div class="form-group row list-group-item sel">

                                          <div class="col-xs-6 bord">
                                            <span><strong>Estado:</strong> ACTIVO</span>
                                          </div>

                                          <div class="col-xs-6">
                                            <span><strong>Fecha de Inicio:</strong> 99/99/9999</span>

                                          </div>
                                        </div>

                                        <div class="form-group row list-group-item sel">

                                          <div class="col-xs-6 bord">
                                            <span><strong>Categoría:</strong> NUEVA FRANQUICIA</span>
                                          </div>

                                          <div class="col-xs-6">
                                            <span><strong>Región:</strong> ZULIA</span>

                                          </div>
                                        </div>

                                        <span class="list-group-item"><strong>Descripción del Proyecto:</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>

                                        <span class="list-group-item"><strong>Personal a cargo:</strong> XXXXXXX XXXXX, XXXXXXXXX XXX, XXXXXXXXX XXXXXXXXXX</span>

                                        <span class="list-group-item"><strong>Actividades Pendientes:</strong>
                                        <ul class="list-group">
                                          <div class="panel-group" id="accordion">
                                              <div class="panel panel-default">

                                                <div class="panel-heading" style="height: 35px;">
                                                  <h4 class="panel-title">
                                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Búsqueda de Local</a>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;  padding-top: 4px;">
                                                      <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="80"
                                                        aria-valuemin="0" aria-valuemax="80" style="width:80%">
                                                          80%
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </h4>
                                                </div>

                                                <div id="collapse1" class="panel-collapse collapse">
                                                  
                                                  <div>
                                                    <div class="well" style="max-height: 300px;overflow: auto;">
                                                      <ul class="list-group checked-list-box">
                                                        <li class="list-group-item clist" data-checked="true">Llamar a Propietario</li>
                                                        <li class="list-group-item clist" data-checked="true">Tarea 2</li>
                                                        <li class="list-group-item clist">Local Alquilado</li>
                                                      </ul>
                                                      <span class="clist"><input type="text" class="form-control" placeholder="Nueva Tarea" name="task"></span>
                                                    </div>
                                                  </div>

                                                </div>  
                                              </div>
                                              <div class="panel panel-default">
                                                
                                                <div class="panel-heading" style="height: 35px;">
                                                  <h4 class="panel-title">
                                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Actividad Pendiente 2</a>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                                                      <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="45"
                                                        aria-valuemin="0" aria-valuemax="100" style="width:45%">
                                                          45%
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </h4>
                                                </div>

                                                <div id="collapse2" class="panel-collapse collapse">
                                                  
                                                  <div>
                                                    <div class="well" style="max-height: 300px;overflow: auto;">
                                                      <ul class="list-group checked-list-box">
                                                        <li class="list-group-item clist">Leerla hasta entenderla</li>
                                                        <li class="list-group-item clist" data-checked="true">Leer la ubicación del usuario</li>
                                                        <li class="list-group-item clist">Investigar hasta entender la intención</li>
                                                      </ul>
                                                      <span class="clist"><input type="text" class="form-control" placeholder="Nueva Tarea" name="task"></span>
                                                    </div>
                                                  </div>

                                                </div> 
                                              </div>
                                              <div class="panel panel-default">

                                                <div class="panel-heading" style="height: 35px;">
                                                  <h4 class="panel-title">
                                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Actividad Pendiente 3</a>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                                                      <div class="progress">
                                                        <div class="progress-bar" role="progressbar" aria-valuenow="35"
                                                        aria-valuemin="0" aria-valuemax="100" style="width:35%">
                                                          35%
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </h4>
                                                </div>

                                                <div id="collapse3" class="panel-collapse collapse">
                                                  
                                                  <div>
                                                    <div class="well" style="max-height: 300px;overflow: auto;">
                                                      <ul class="list-group checked-list-box">
                                                        <li class="list-group-item clist">Leerla hasta entenderla</li>
                                                        <li class="list-group-item clist" data-checked="true">Leer la ubicación del usuario</li>
                                                        <li class="list-group-item clist">Investigar hasta entender la intención</li>
                                                      </ul>
                                                      <span class="clist"><input type="text" class="form-control" placeholder="Nueva Tarea" name="task"></span>
                                                    </div>
                                                  </div>

                                                </div>
                                              </div>
                                            </div> 
                                        </ul>
                                        </span>

                                        <span class="list-group-item"><strong>Actividades Completadas:</strong>
                                        <ul class="list-group">
                                          <div class="panel-group" id="completada">
                                              <div class="panel panel-default">
                                                
                                                <div class="panel-heading" style="height: 35px;">
                                                  <h4 class="panel-title">
                                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <a data-toggle="collapse" data-parent="#completada" href="#completada1">Actividad Completada 1</a>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                                                      <span class="pe-7s-check" style="font-size: 28px; color: #27C24C;"></span>
                                                    </div>
                                                  </h4>
                                                </div>

                                                <div id="completada1" class="panel-collapse collapse">
                                                  
                                                  <div>
                                                    <div class="well" style="max-height: 300px;overflow: auto;">
                                                      <ul class="list-group checked-list-box">
                                                        <li class="list-group-item clist" data-checked="true">Llamar a Propietario</li>
                                                        <li class="list-group-item clist" data-checked="true">Tarea 2</li>
                                                        <li class="list-group-item clist" data-checked="true">Local Alquilado</li>
                                                      </ul>
                                                      <span class="clist"><input type="text" class="form-control" placeholder="Nueva Tarea" name="task"></span>
                                                    </div>
                                                  </div>

                                                </div>
                                              </div>
                                              <div class="panel panel-default">
                                                
                                                <div class="panel-heading" style="height: 35px;">
                                                  <h4 class="panel-title">
                                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                                    <a data-toggle="collapse" data-parent="#completada" href="#completada2">Actividad Completada 2</a>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-xs-4" style="text-align: right;">
                                                      <span class="pe-7s-check" style="font-size: 28px; color: #27C24C;"></span>
                                                    </div>
                                                  </h4>
                                                </div>

                                                <div id="completada2" class="panel-collapse collapse">
                                                  
                                                  <div>
                                                    <div class="well" style="max-height: 300px;overflow: auto;">
                                                      <ul class="list-group checked-list-box">
                                                        <li class="list-group-item clist" data-checked="true">Llamar a Propietario</li>
                                                        <li class="list-group-item clist" data-checked="true">Tarea 2</li>
                                                        <li class="list-group-item clist" data-checked="true">Local Alquilado</li>
                                                      </ul>
                                                      <span class="clist"><input type="text" class="form-control" placeholder="Nueva Tarea" name="task"></span>
                                                    </div>
                                                  </div>

                                                </div>
                                              </div>
                                            </div> 
                                        </ul>
                                        </span>
                                        
                                    </div>
                                    <div style="text-align: right;">
                                    <a href="#" data-toggle="modal" data-target="#tarea" class="opciones">Añadir Actividad</a>
                                    <a href="#" data-toggle="modal" data-target="#participante" class="opciones">Añadir Participante</a>
                                    <a href="#" data-toggle="modal" data-target="#modificar" class="opciones">Modificar</a>
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


        <!-- COMIENZO DE MODAL: MODIFICAR PORYECTO  -->
        <div id="modificar" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Proyecto: NUEVA FRANQUICIA EN ZULIA</b></h4>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" id="beta_form" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-12" for="filtroventa" style="text-align: center;">Información Detallada del Proyecto.</label>
                                <br><br><div class="col-sm-12">
                                    <div class="list-group">
                                        
                                        <!--div class="form-group row list-group-item sel formulario">
                                        <div class="col-md-10">
                                        <span class="list-group-item"><strong>Nombre del Proyecto:</strong> <input class="form-control" name="beta_mensaje" cols="8" rows="auto" required></input></span>
                                        </div>
                                        <div class="col-md-2">
                                        <label class="switch">
                                          <input type="checkbox" checked>
                                          <span class="slider round"></span>
                                        </label>
                                        </div>
                                        </div-->


                                        <div class="row list-group-item sel formulario">
                                          <div class="col-xs-9">
                                          <span><strong>Nombre del Proyecto:</strong> <input class="form-control" name="beta_mensaje" cols="8" rows="auto" required></input></span> 
                                          </div>
                                          <div class="col-xs-3" style="padding-left: 30px;">
                                            <span><strong>Estado:</strong></span>
                                            <label class="switch">
                                              <input type="checkbox" checked>
                                              <span class="slider round"></span>
                                            </label>
                                          </div>
                                        </div>


                                        <div class="form-group row list-group-item sel formulario">
                                          <div class="col-xs-6">
                                            <span><strong>Fecha de Inicio:</strong><input class="form-control" name="beta_mensaje" cols="8" rows="auto" required></input></span>
                                          </div>
                                          <div class="col-xs-6">
                                            <span><strong>Fecha Estimada de Finalización:</strong><input class="form-control" name="beta_mensaje" cols="8" rows="auto" required></input></span>
                                          </div>
                                        </div>

                                         <div class="form-group row list-group-item sel formulario">
                                          <div class="col-xs-6">
                                            <span><strong>Categoría:</strong> <select class="form-control" name="beta_seccion" required>
                                            <option>Selecciona una opción..</option><option value="LIVE">Nueva Franquicia</option><option value="CRM-APPS">Proyecto Sistemas</option><option value="CRM-CC">Opción 3</option><option value="CRM-CONVENIOS">Opción 4</option><option value="DESCARGAS">Opción 5</option><option value="MINUTAS-REGION">Opción 6</option>
                                            </select></span>
                                          </div>
                                          <div class="col-xs-6">
                                            <span><strong>Región:</strong> <select class="form-control" name="beta_seccion" required>
                                            <option>Selecciona una opción..</option><option value="OTRO">No Aplica</option><option value="LIVE">Región 1</option><option value="CRM-APPS">Región 2</option><option value="CRM-CC">Región 3</option><option value="CRM-CONVENIOS">Región 4</option><option value="DESCARGAS">Región 5</option><option value="MINUTAS-REGION">Región 6</option><option value="MINUTAS-SALON">Región 7</option><option value="MINUTAS-COMITE">Región 8</option><option value="IDIOMA">Región 9</option>
                                            </select></span>
                                        </div>
                                        </div>

                                        <span class="list-group-item"><strong>Descripción del Proyecto:</strong> <textarea class="form-control" name="beta_mensaje" cols="8" rows="auto" required></textarea></span>

                                        <span class="list-group-item"><strong>Personal a cargo:</strong> <input class="form-control" name="beta_mensaje" cols="8" rows="auto" required></input></span>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Guardar</button>
                        <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- FIN DE MODAL: MODIFICAR PROYECTO -->


<!-- Modal Participante -->
  <div class="modal fade" id="participante" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Añadir Participante</h4>
        </div>
        <div class="modal-body">
          <span><strong>Nombre de Usuario:</strong> <input class="form-control" name="beta_mensaje" cols="8" rows="auto" required></input></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Actividad -->
  <div class="modal fade" id="tarea" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Añadir Actividad</h4>
        </div>
        <div class="modal-body">
          <span><strong>Nombre de la Actividad:</strong> <input class="form-control" name="beta_mensaje" cols="8" rows="auto" required></input></span>
          <span><strong>Tareas Relacionadas:</strong> <input class="form-control" name="beta_mensaje" cols="8" rows="auto" required></input></span>
          <form>
            <input type="radio" name="gender" value="pendiente" checked> Pendiente 
            <input type="radio" name="gender" value="finalizada"> Finalizada
          </form> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>



        <?php include "../componentes/footer.php"; ?>
    </body>
</html>
<?php ob_end_flush(); ?>

<script type="text/javascript">
  $(function () {
    $('.list-group.checked-list-box .list-group-item').each(function () {
        
        // Settings
        var $widget = $(this),
            $checkbox = $('<input type="checkbox" class="hidden" />'),
            color = ($widget.data('color') ? $widget.data('color') : "primary"),
            style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };
            
        $widget.css('cursor', 'pointer')
        $widget.append($checkbox);

        // Event Handlers
        $widget.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });
          

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $widget.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $widget.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$widget.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $widget.addClass(style + color + ' active');
            } else {
                $widget.removeClass(style + color + ' active');
            }
        }

        // Initialization
        function init() {
            
            if ($widget.data('checked') == true) {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
            }
            
            updateDisplay();

            // Inject the icon if applicable
            if ($widget.find('.state-icon').length == 0) {
                $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
            }
        }
        init();
    });
    
    $('#get-checked-data').on('click', function(event) {
        event.preventDefault(); 
        var checkedItems = {}, counter = 0;
        $("#check-list-box li.active").each(function(idx, li) {
            checkedItems[counter] = $(li).text();
            counter++;
        });
        $('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
    });
});
</script>