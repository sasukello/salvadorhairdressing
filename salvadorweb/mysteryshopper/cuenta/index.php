<?php 
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION["usuario"])){
        $user = $_SESSION["usuario"];
        $iduser = $_SESSION["iduser"];
        $hash = $_SESSION["hash"];
        if($hash == "465g5gf688gr"){
            $bandera = true;
        }else{
        header("location:logout.php");
        }
    }else{
        header("location:logout.php");
    }
}
$msg="";
$clase="";
if(isset($_GET["e"])){
    $error = $_GET["e"];
    if($error == 1){
        $msg = "<strong>Encuesta No Encontrada</strong><br>";
        $clase = "alert alert-warning alert-dismissable fade in";
    } else if($error == 2){
        $msg = "<strong>¡Tus datos han sido enviados éxitosamente!</strong><br>Está atento a nuestra respuesta.<br>";
        $clase = "alert alert-success alert-dismissable fade in";
    } else if($error == 3){
        $msg = "<strong>Hubo un problema al procesar tu solicitud.</strong><br>Por favor, intenta de nuevo.<br>";
        $clase = "alert alert-danger alert-dismissable fade in";
    } else if($error == 4){
        $msg = "<strong>Visita Programada No Encontrada.</strong><br>";
        $clase = "alert alert-warning alert-dismissable fade in";
    } else if($error == 5){
        $msg = "<strong>¡Tus respuestas han sido enviados éxitosamente!</strong>";
        $clase = "alert alert-success alert-dismissable fade in";
    } 
    else{
        $msg="";$clase="";
    }
} else{
    $msg = "";
    $clase="";
}
    require_once "../etc/func.php";

/*
 * Panel de Cuenta de Usuario Participante.
 */
 $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "../../locale");
      textdomain("salvador_web");
?>  
<!DOCTYPE html>
<html lang="es_VE">
<head>
<?php include '../../c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title>Mystery Shopper - Salvador Hairdressing</title>
<link rel="stylesheet" type="text/css" href="../css/styleMystery.css">

    <?php include '../../c/header.php'; ?>
    <?php include '../../library/funciones.php'; ?>


<style type="text/css" media="screen">
.inner{
    padding-top: 56px!important;
}
</style>
</head>
<body>
<div id="preloade2r"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">
    <?php include '../../c/navbar.php'; ?>
  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(../images/bg.jpg);">
    <div class="container inner text-center">
      <div class="headline text-center">
        <h2>Mystery Shopper</h2>
      </div>
      <!-- /.headline --> 
    </div>
    <!--/.container --> 
  </div>
<div class="dark-wrapper">
  <div class="container inner">
    <diw class="row ">
      <div class='alert alert-warning alert-dismissable fade in'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Aviso de Confidencialidad:</b> La información recolectada en este programa, así como tus datos son confidenciales. <b>Salvador Hairdressing</b> nunca revelará tu identidad a terceros. Igualmente, como participante, estás comprometido a no revelar tu involucramiento en este programa.
      </div>
      <div class="col-md-7 blog-content col-md-offset-2">
        <div class="box text-center ">
             <h2 style="color:#e32028;">Mystery Shopper: Participante</h2>
              <?php 
                if(isset($_GET["e"])){
                  echo "<div class='$clase'>
                  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                  $msg</div>";        
                } 
              ?>
        <b style="color:font-weight: 700;">¡Bienvenido a nuestro grupo de Mistery Shoppers!</b>
        <br><br>ESTADO DE PARTICIPACIÓN: <?php consultaPartEstado($iduser); ?>
        <br><br><div class="cuentaTexto1"><b><i style="color:#e32028;">ENCUESTAS DISPONIBLES:</i></b></div> <?php listarEncuestas($iduser); ?>
        <br><div class="cuentaTexto1"><b><i style="color:#e32028;">VISITAS PROGRAMADAS:</i></b></div> <?php listarVisitas($iduser); ?>
        <br><div class="cuentaTexto1"><b><i style="color:#e32028;">MANUAL DE PARTICIPANTE:</i></b></div>
        <a href="#" data-toggle="modal" data-target="#manualMS" style="text-decoration: none; color:#e32028;">Consultar Manual de Mystery Shopper</a>
        <br><a href='logout.php'><button type="button" class="btn-default" data-toggle="modal" data-target="#elimreg">Cerrar Sesión</button></a>
        </div>
      </div>
    </div>
  </div>
</div> 
<?php 
  include '../../c/footer.php';
?>
</body>
</html>