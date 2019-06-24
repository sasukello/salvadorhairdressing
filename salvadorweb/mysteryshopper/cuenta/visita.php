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
if(isset($_SESSION["fecha_visita"])){
    $fecha = $_SESSION["fecha_visita"];
    $idvisita = $_SESSION["id_visita"];
}

include '../etc/func.php';
include '../etc/msfactura.php';
    if (isset($_POST['btnEnvioFactura'])) {  
        if (isset($_FILES["file"])) {
            // $file   =   $_FILES["file"];
            // $nombre =   $file["name"];
            // $tipo   =   $file["type"];
            // $tamano =   $file["size"];
            // $rutaP  =   $file["tmp_name"];
            $nombre=$_FILES["file"]["name"];
            $tipo = $_FILES["file"]["type"];
            $tamano = $_FILES["file"]["size"];
            $contenido_archivo=addslashes($_FILES["file"]["tmp_name"]);
            procesarFacturaEncuesta($iduser,$idvisita);
        }  
    }
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
<title>Salvador Hairdressing - Mystery Shopper: <?php echo _("Consulta tus Visitas Programadas"); ?></title>
<link rel="stylesheet" type="text/css" href="../css/styleMystery.css">

    <?php include '../../c/header.php'; ?>
    <?php include '../../library/funciones.php'; ?>
    
<style type="text/css" media="screen">
.inner{padding-top: 56px!important;}#fileArchivo,.btn_class{font-size: 15px !important;}#btnEnvioFactura{border-radius: 5px;}
.botonClass{border: 2px solid #d34a4a !important;background: transparent !important;transition: all 0.4s !important;
color: #d34a4a !important;border-radius: 100px;}.botonClass:hover{background: #d34a4a !important;
color: white !important;}
::-webkit-file-upload-button{border: 2px solid #d34a4a !important;background: none !important;color: red;padding: 1em;border-radius: 100px;}
::-webkit-file-upload-button:hover{background: #d34a4a !important;color: white !important;}
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
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b><?php echo _('Aviso de Confidencialidad:</b> La información recolectada en este programa, así como tus datos son confidenciales. <b>Salvador Hairdressing</b> nunca revelará tu identidad a terceros. Igualmente, como participante, estás comprometido a no revelar tu involucramiento en este programa.');?>
      </div>
    <div class="col-md-7 blog-content col-md-offset-2 wow slideInRight">
        <div class="box text-center" style="background: white; border: 1px solid #ddd;">
            <h2 style="color:#e32028;">Mystery Shopper: <?php echo _("Resumen de Visita"); ?></h2>
                 <?php if(isset($_GET["e"])){
                    echo "<div class='$clase'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                    $msg</div>";        
                }
                ?>
                <?php listarVisitaCompleta($id, $iduser, 1);?>
                <br>
                <form id="Formulario" action="" method="POST" enctype="multipart/form-data">
                    <label style="color:#252424 !important;"><?php echo _("Adjuntar Factura de Pago"); ?></label>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="file" name="file" id="fileArchivo">
                        </div>
                        <div class="col-md-6" style="">
                        <button type="submit" id="btnFac" name="btnEnvioFactura" class="" disabled="disabled" style="margin: 5%;"><?php echo _("Enviar");?></button>
                        </div>    
                    </div>           
                </form>
                <div id="resp" style="color: #e91e63;text-align: left;margin: 13px 0 0 0;font-weight: bold;"></div>                
                <br><a href='index.php'><button type="button" class="btn-default" name="return"><?php echo _("Volver a Cuenta"); ?></button></a>
                <a href='logout.php'><button type="button" class="btn-default" data-toggle="modal" data-target="#elimreg"><?php echo _("Cerrar Sesión"); ?></button></a>    
        </div>
      </div>    
    </div>
  </div>
</div>
<script src="/mysteryshopper/js/jquery.js"></script>
<script src="/mysteryshopper/js/alertify.js"></script>
<script src="/mysteryshopper/js/wow.min.js"></script>
<link rel="stylesheet" type="text/css" href="../cssAlert/alertify.css">
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
    $("#fileArchivo").change(function () {
        var file_Extension = ['jpeg', 'jpg', 'png', 'pdf'];
        if ($.inArray($(this).val().split('.').pop().toLowerCase(), file_Extension) == -1) {
            alertify
            .alert("Extensiones Permitidas: "+file_Extension.join(', '),function(){});
            document.getElementById('fileArchivo').value = "";          
            $("#btnFac").prop("disabled", this.files.length == 0).removeClass('botonClass');
        }
        else{
            $("#btnFac").prop("disabled", this.files.length == 0).addClass('botonClass');
        }
    });
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