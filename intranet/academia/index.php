<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../sec/seguro.php";
include "../sec/libfunc.php";
include "includes/admin.php";
include 'includes/respuestas.php'; 

$datos = datosPanelesDashboard();
$_SESSION["ubicacion"] = "academia";
$arrayMenu = unserialize($_SESSION["accesos"]);
if (isset($_SESSION["usuario"])) {
  $usernombre = $_SESSION["usuario"];
} else {
  $usernombre = "";
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Academia - Salvador Hairdressing (Intranet)</title>
    <?php include "../componentes/header.php"; ?>

    <!-- CSS Tether -->
    <link rel="stylesheet" href="../componentes/plugins/tether/shepherd-theme-arrows.css" />
    <link rel="stylesheet" href="componentes/css/font-awesome.min.css">
    <link rel="stylesheet" href="componentes/css/style-main.css">
    <!-- CSS | DataTables -->
    <link rel="stylesheet" type="text/css" href="componentes/DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="componentes/DataTables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="componentes/DataTables/Buttons-1.5.1/css/buttons.bootstrap4.min.css" />
    <link href="componentes/css/custom-bootstrap-margin-padding.css" rel="stylesheet" type="text/css">
</head>

<body onload="document.getElementById('cargando').style. display='none';" data-spy="scroll" data-target="#navbar-scroll">

    <!-- /.preloader -->
    <div id="top"></div>

    <!-- /.cabecera -->
    <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); ?>
    </div>
    </div>
    </div>
    </div>
    </div>

    <div id="main">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 text-center feature-title">
                    <div id="cargando" style="width: 100%; height: 100%; text-align: center"><br><br><img src='/mysteryshopper/images/loading.gif'></div>
                    <!-- Section: inner-header -->
                    <section class="inner-header">
                        <div class="container pt-0 pb-0">
                            <!-- Section Content -->
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h2 class="title text-white">Administrador</h2>
                                        <h6 class="text-uppercase letter-space-5 font-playfair text-uppercase text-white mb-40">Salvador Academy</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="">
                        <div class="container">
                            <div class="section-content">
                                <div class="row">
                                    <div class="col-sx-12 col-sm-4 col-md-3">
                                        <div class="info">
                                            <div class="list-group">
                                                <li class="list-group-item" style="background-color: #eee;">
                                                    <strong><i class="glyphicon glyphicon-user"></i>
                                                        <?php echo $usernombre ?></strong>
                                                    <input type="hidden" id="userid" value="<?php echo $userid; ?>">
                                                </li>
                                                <a href="" class="list-group-item pointer active-int"><i class="glyphicon glyphicon-home"></i> Inicio</a>
                                                <a onclick="showContent(1);" id="opt-1" class="list-group-item pointer"><i class="glyphicon glyphicon-book"></i> Cursos - Talleres</a>
                                                <a onclick="showContent(2);" id="opt-2" class="list-group-item pointer"><i class="glyphicon glyphicon-time"></i> Horarios</a>
                                                <a onclick="showContent(3);" id="opt-3" class="list-group-item pointer"><i class="glyphicon glyphicon-user"></i> Estudiantes</a>
                                                <a onclick="showContent(4);" id="opt-4" class="list-group-item pointer"><i class="glyphicon glyphicon-edit"></i> Profesores</a>
                                                <a onclick="showContent(5);" id="opt-5" class="list-group-item pointer"><i class="glyphicon glyphicon-list"></i> Inscripciones</a>
                                                <a onclick="showContent(6);" id="opt-6" class="list-group-item pointer"><i class="glyphicon glyphicon-credit-card"></i> Pagos</a>
                                                <a href="logout.php" class="list-group-item pointer"><i class="glyphicon glyphicon-off"></i> Cerrar Sesión</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-8 col-md-9">
                                        <div class="list-group">
                                            <li class="list-group-item" style="background-color: #eee;"><strong><span id="title-section"> Bienvenido:
                                                        <?php echo $usernombre ?></span></strong></li>
                                            <li class="list-group-item pt-20 pb-20">
                                                <span id="content-section">
                                                    <?php if (isset($mensaje)) {
                                                      echo $mensaje;
                                                    } ?>
                                                    <h2 class="text-uppercase font-26 line-bottom mt-0 line-height-1 mb-40">Salvador <span class="text-theme-colored">Academy</span></h2>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-4">
                                                            <a onclick="showContent(32);" class="pointer">
                                                                <div class="well well-sm">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-md-12 text-center">
                                                                            <h1 class="rating-num">
                                                                                <?php echo $datos['matchMorosos'] ?>
                                                                            </h1>
                                                                            <div>
                                                                                <span class="glyphicon glyphicon-user"></span> Estudiantes Morosos
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12 col-md-4">
                                                            <a onclick="showContent(6);" class="pointer">
                                                                <div class="well well-sm">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-md-12 text-center">
                                                                            <h1 class="rating-num">
                                                                                <?php echo $datos['matchPagos'] ?>
                                                                            </h1>
                                                                            <div>
                                                                                <span class="glyphicon glyphicon-credit-card"></span> Pagos Recientes
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="col-xs-12 col-md-4">
                                                            <a onclick="showContent(22);" class="pointer">
                                                                <div class="well well-sm">
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-md-12 text-center">
                                                                            <h1 class="rating-num">
                                                                                <?php echo $datos['matchCursos'] ?>
                                                                            </h1>
                                                                            <div>
                                                                                <span class="glyphicon glyphicon-th-list"></span> Cursos Activos
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </span>
                                            </li>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
  <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-theme-colored">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-white"><span id="myModalLabel"></span></h4>
        </div>
        <div class="modal-body">
          <span id="parte1"></span>
        </div>
        <div class="modal-footer">
          <span id="opcion-btn"></span>
          <button type="button" class="btn btn-default btn-lg btn-flat" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

    <?php include "../componentes/footer.php"; ?>

    <script src="/intranet/componentes/js/opciones.js"></script>
    <!-- Tether JS -->
    <script src="../componentes/plugins/tether/tether.js"></script>
    <script src="../componentes/plugins/tether/shepherd.min.js"></script>
    <script src="componentes/js/admin.js"></script>
</body>

</html>
<?php ob_end_flush(); ?> 