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
if (isset($_GET["t"])) {
    $id = base64_decode($_GET['t']);
}else{
    header("location:index.php?e=4");
}
$msg = ""; $clase= "";
if(isset($_GET["e"])){
    $error = $_GET["e"];
    if($error == 5){
        $msg = "<strong>¡Tus respuestas han sido enviados éxitosamente!</strong>";
        $clase = "alert alert-success alert-dismissable fade in";
    }
    else{
        $msg="";$clase="";
    }
}else{
    $msg = "";
    $clase="";
}
include '../etc/func.php';
 /*
 * Pantalla de Resumen de Visita - Mistery Shopper.
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
<title>Salvador Hairdressing - Mistery Shopper: Consulta tus Visitas Programadas</title>
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
    <div class="col-md-7 blog-content col-md-offset-2 wow slideInRight">
        <div class="box text-center" style="background: white; border: 1px solid #ddd;">
            <h2 style="color:#e32028;">Mystery Shopper: Resumen de Visita</h2>
                 <?php if(isset($_GET["e"])){
                    echo "<div class='$clase'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    $msg</div>";        
                }
                ?>
                <?php listarVisitaCompleta($id, $iduser, 1);?>
                <br><a href='index.php'><button type="button" class="btn-default" name="return">Volver a Cuenta</button></a>
                <a href='logout.php'><button type="button" class="btn-default" data-toggle="modal" data-target="#elimreg">Cerrar Sesión</button></a>    
        </div>
      </div>    
    </div>
  </div>
</div>
<script src="/mysteryshopper/js/jquery.js"></script>|
<script src="/mysteryshopper/js/wow.min.js"></script>

<script>
    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();
        
    });
</script> 
<script>
    new WOW().init();
</script>
<?php 
  include '../../c/footer.php';
?>
</body>
</html>
<?php ob_end_flush(); ?>