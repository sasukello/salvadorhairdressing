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
error_reporting(0);
if(isset($_GET['t'])){
    $tipo = $_GET['t'];
} else if(isset($_GET['pv'])){
    $pv = base64_decode($_GET['pv']);
    $tipo = 3;
    } else{
        header("location:index.php?e=1");
    }

if(isset($_SESSION["fecha_visita"])){
    $fecha = $_SESSION["fecha_visita"];
    $idvisita = $_SESSION["id_visita"];
}

include '../etc/func.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitEncuestaPart'])) {
            $_SESSION["nombre"] = htmlspecialchars($_POST['nombre']);
            $_SESSION["apellido"] = htmlspecialchars($_POST['apellido']);
            $_SESSION["id"] = htmlspecialchars($_POST['id']);
            $_SESSION["tipocta"] = htmlspecialchars($_POST['tipocta']);
            $_SESSION["banco"] = htmlspecialchars($_POST['banco']);
            $_SESSION["nrocta"] = htmlspecialchars($_POST['nrocta']);
            $_SESSION["swift"] = htmlspecialchars($_POST['swift']);
            procesarEncuestaPart($iduser, $tipo);            

    } else if(isset ($_POST['enviarPV'])){
            $_SESSION["P1"] = htmlspecialchars($_POST['P1']);
            $_SESSION["P2"] = htmlspecialchars($_POST['P2']);
            $_SESSION["P3"] = htmlspecialchars($_POST['P3']);
            $_SESSION["P4"] = htmlspecialchars($_POST['P4']);
            $_SESSION["P5"] = htmlspecialchars($_POST['P5']);
            $_SESSION["P6"] = htmlspecialchars($_POST['P6']);
            $_SESSION["P7"] = htmlspecialchars($_POST['P7']);
            $_SESSION["P8"] = htmlspecialchars($_POST['P8']);
            $_SESSION["P9"] = htmlspecialchars($_POST['P9']);
            $_SESSION["P10"] = htmlspecialchars($_POST['P10']);
            $_SESSION["C1"] = htmlspecialchars($_POST['C1']);
            $_SESSION["C2"] = htmlspecialchars($_POST['C2']);
            $_SESSION["C3"] = htmlspecialchars($_POST['C3']);
            $_SESSION["C4"] = htmlspecialchars($_POST['C4']);
            $_SESSION["C5"] = htmlspecialchars($_POST['C5']);
            $_SESSION["C6"] = htmlspecialchars($_POST['C6']);
            $_SESSION["C7"] = htmlspecialchars($_POST['C7']);
            $_SESSION["C8"] = htmlspecialchars($_POST['C8']);
            $_SESSION["C9"] = htmlspecialchars($_POST['C9']);
            $_SESSION["C10"] = htmlspecialchars($_POST['C10']); 
            $_SESSION["idvisita"] = htmlspecialchars($_POST['idvisita']); 
            $pvid = $_POST['idpv'];

            procesarPostEncuesta($iduser, $pvid);
        //echo count($_POST['enviarPV']);
        print_r($_POST);
        
    }
}
 $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "../../locale");
      textdomain("salvador_web");
/*
 * Pantalla de Encuesta para aplicar a ser Mistery Shopper.
 */
?>
<!DOCTYPE html>
<html lang="es_VE">
<head>
<?php include '../../c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<link rel="stylesheet" type="text/css" href="../css/styleMystery.css">
<title>Salvador Hairdressing - Mystery Shopper: Completa la Encuesta</title>

    <?php include '../../c/header.php'; ?>
    <?php include '../../library/funciones.php'; ?>
<style>.midiv{padding-top: 56px !important;padding-bottom: 44px !important;}</style>
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
</div>
<div class="dark-wrapper">
  <div class="container inner midiv">
    <div class="row ">
      <div class='alert alert-warning alert-dismissable fade in'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Aviso de Confidencialidad:</b> La información recolectada en este programa, así como tus datos son confidenciales. <b>Salvador Hairdressing</b> nunca revelará tu identidad a terceros. Igualmente, como participante, estás comprometido a no revelar tu involucramiento en este programa.
      </div>
    </div>
  </div>
</div>
<div class="container">
<div class="row">

                    <!-- /.intro image -->
    <?php if($tipo == 2){?>
    <div class="col-md-6 intro-pic wow slideInLeft">
        <img src="/mysteryshopper/images/bg.jpg" alt="image" class="img-responsive">
    </div>
    <?php } else if($tipo == 3){?>  
    <div class="col-md-2 intro-pic wow slideInLeft">
        <img src="/mysteryshopper/images/bg.jpg" alt="image" class="img-responsive">
    </div>
    <?php }?>
    <!-- /.intro content -->
    <?php if($tipo == 2){?>
    <div class="col-md-6 wow slideInRight">
    <?php } else if($tipo == 3){?>
    <div class="col-md-9 wow slideInRight"></div> 
    <?php }?>
        <h2 style="font-size: 30px !important;">Mystery Shopper: Encuestas</h2>
        <?php if($tipo == 2){ echo "<h3>Encuesta #0$tipo: Completa tus Datos</h3>"?>
            <form name="encuestaMS" method="post">
            <?php inputLocal($user) ;
            include '../../sitio/sec/ms/libfunc.php';?>
            <br><h3>Completa con tus datos bancarios:</h3>
            
            <br><div class='form-group'><label class='control-label col-sm-5' for='tipocta'>Tipo de Cuenta:</label><div class='col-sm-5'><select name='tipocta' class='form-control' required><option value=''>Seleccione su opción</option><option value='1'>Corriente/ Checking</option><option value='2'>Ahorro/ Savings</option></select></div></div>
            <br><div class='form-group'><label class='control-label col-sm-5' for='banco'>Nombre del Banco:</label><div class='col-sm-5'><input type='text' class='form-control' id='banco' name='banco' placeholder="Nombre del Banco" required /></div></div>
            <br><div class='form-group'><label class='control-label col-sm-5' for='nrocta'>Nro. de Cuenta:</label><div class='col-sm-5'><input type='text' class='form-control' id='nrocta' name='nrocta' placeholder="Número de Cuenta" required /></div></div>
            <br><div class='form-group'><label class='control-label col-sm-5' for='swift'>Código SWIFT o documento de identidad del titular dependiendo del caso que aplique:</label><div class='col-sm-5'><input type='text' class='form-control' id='swift' name='swift' placeholder="Código swift o documento" style="margin: 16px 0 0 0;" /></div></div>
            <div class="row">
            <br><div class='form-group'><div class='col-sm-offset-3 col-sm-6'><button type='submit' class='btn-primary' name='submitEncuestaPart'><b>Enviar</b></button></div></div></div>                   
            </form>
       <?php } else if($tipo == 3){
                inputPostVisita($iduser, $pv);
       } else {
           echo "   <div class='form-group'><label class='control-label col-sm-7' for='mensaje'>Encuesta no disponible</label></div><br>";
        } if($tipo == 2){ echo "<a href='index.php'><button type='button' class='btn-default' name='return'>Volver a Cuenta</button></a>"; }
        else if ($tipo == 3) { echo "<a href='visita.php?t=".base64_encode($idvisita)."'><button type='button' class='btn-default' name='return'>Regresar a Resumen de Visita</button></a>"; }?>
        <a href='logout.php'><button type="button" class="btn-default" data-toggle="modal" data-target="#elimreg">Cerrar Sesión</button></a>
    </div>
    </div>
</div>


<?php 
  include '../../c/footer.php';
?>
</body>
</html>  