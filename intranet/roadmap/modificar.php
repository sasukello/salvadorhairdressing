<?php
error_reporting(1);


// include "../sec/seguro.php";
include "libreria.php";
$_SESSION["ubicacion"] = "default";
$_SESSION["calendar_live"] = 0;
$arrayMenu = unserialize($_SESSION["accesos"]);
$proyectnew = "";
include "../sec/libfunc.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['idp'])) { 
        $idp = $_GET['idp'];
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
      
      <link href="pruebas/estilos.css" rel="stylesheet" type="text/css">

      <link href="estilos20.css" rel="stylesheet" type="text/css">
      <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
      <!--     Fonts and icons     -->
      <link rel="stylesheet" type="text/css" href="assets/css/material-icons.css" />
      <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> -->
      <!-- CSS Files -->
      <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
</head>

<body class="" background="assets/img/cover.jpg" style="background-repeat: no-repeat; background-size: cover;">

   <div class="wrapper" >
    
   <?php include "assets/side-bar.php" ?>

     <!-- FIN DEL MENU -->

    <div class="main-panel">
      <!-- Navbar -->


      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="#pablo"><h2><i class="pe-7s-note2"> </i>  Roadmap - Editar Proyecto</h1></a>
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
          <div class="row">
                
 <!-- Tabla modificar -->
<?php  echo verModifProyecto($idp); ?>

</div>
                </div>
              </div>
            </div>


                                      <footer class="footer" style="background-color: black; opacity: 0.5;"  >

        <?php if(isset($user)){echo "<span style='color: #fff;'>&nbsp&nbsp&nbspUsuario: ".$user."</span><input type='hidden' name='ui' value='".$iduser."'>";} else{ ?>
        <p class="conte1"><a href="#" class="lang_flag_es" onclick="cambiarIdiomaES();"></a>
        <a href="#" class="lang_flag_en" onclick="cambiarIdiomaEN();"></a></p><br><br><?php }?>

                            </div>
                        </form>
                    </div>

<!-- COMIENZO DE MODAL: NUEVO PROYECTO JP  -->
<div id="newproject" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
 <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><b>  Información Detallada del Nuevo Proyecto.<span id="prtit"></span></b><span class="pe-7s-note modpr"></span></h4>
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








  <!--   Core JS Files   -->
  <script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/material-dashboard.min.js?v=2.1.0" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();

    });
  </script>
          <script src="/intranet/componentes/js/roadmap.js" type="text/javascript"></script>     
        <script>
            $(document).ready(function() {
               // initLoad(<?php //echo "'".$iduser."'";?>);
            });
        </script>
    </body>
    </html>
<?php ob_end_flush(); ?>