<?php
error_reporting(1);

// incude "../sec/seguro.php";
include "libreria.php";
$_SESSION["ubicacion"] = "roadmap";
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
      <meta charset="utf-8" />
      <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
      <link rel="icon" type="image/png" href="assets/img/favicon.png">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
      <title>
        RoadMap - Corporativo Salvador
      </title>
      
      <link href="estilos20.css" rel="stylesheet">
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
      <!--     Fonts and icons     -->
      <link rel="stylesheet" type="text/css" href="assets/css/material-icons.css" />
      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
      <!-- CSS Files -->
      <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="" background="assets/img/cover.jpg" style="background-repeat: no-repeat; background-size: cover;">

  <div class="wrapper" >
    
   <?php $ubi="proyectos"; include "assets/side-bar.php"; ?>

     <!-- FIN DEL MENU -->

    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo"><h1><i class="pe-7s-note2"> </i>  Roadmap</h1></a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#pablo">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
    <div class="content" id="contentRoadmap">
        <div class="container-fluid">

            <?php echo proyectos(2); ?>
        </div>
    </div>
    </div>
          
          
      
            <div id="minimodal" class="modal fade" role="dialog">
              <div class="modal-dialog modal-md">
                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title"><span id="m-titulo"></span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <span id="m-body"></span>
                  </div>
                  
                </div>
                </div>
            </div>

            <!-- COMIENZO DE MODAL: NUEVO PROYECTO JP  -->
            <div id="newproject" class="modal fade" role="dialog">
                <div class="modal-dialog modal-md">
             <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                          
                          <h4 class="modal-title"><b>  Información Detallada del Nuevo Proyecto.<span id="prtit"></span></b><span class="pe-7s-note modpr"></span></h4><button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form method="post" action="libreria.php"> 
                        <div class="modal-body">
                        <!-- FORMULARIO NUEVO -->
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Nombre de Proyecto</label>
                                    <input type="text" class="form-control" required name="nombrepr">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Categoria</label>
                                        <select class="form-control form-control-sm" name="categoriapr" required><option value="">Seleccionar</option>
                                              <option value="1">Publicidad</option>    
                                              <option value="2">Academia</option>    
                                              <option value="3">Recursos Humanos</option>    
                                              <option value="4">Recepcion</option>    
                                              <option value="5">Sistemas</option>  
                                        </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Responsable</label>
                                    <input type="text" class="form-control" required name="responsable">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Fecha estimada de cierre</label>
                                    <br><input class="form-control" type="date" name="fechacierre" required> 
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Breve descripción: </label>
                                    <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea><br>
                                </div>
                            </div>
                            <input type="submit" name="valider" class="btn btn-info" value="Guardar"> 
                            <button type="button" class="btn" data-dismiss="modal">Cerrar</button>
                    </form>
                </div>
                </div> 
            </div>
            <!-- FIN DE MODAL: NUEVO PROYECTO JP -->       


 <?php include ('assets/footer.php') ?>
    
    </body>
</html>