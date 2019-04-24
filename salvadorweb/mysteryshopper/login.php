<?php

/*
 * PROCESO DE LOGIN PARA LA CUENTA DE MISTERY SHOPPER
 */

ob_start();
      error_reporting(E_ALL);
      ini_set("display_errors", 1);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user="";
$tlogin="";

if(isset($_GET["t"])){
    $tlogin = $_GET["t"];
    if($tlogin == "1"){
        if(isset($_SESSION["email"])){
            $user = $_SESSION["email"];
            if(isset($_GET["e"])){
                $emsg = $_GET["e"];
                if($emsg == 2){
                    $msg="<div class='alert alert-warning'><strong>Error en Contraseña.</strong></div>";
                }
            }  
        }else{
         	header("location:index.php");
        }
    } else if($tlogin == "2"){
        if(isset($_GET["uu"])){
            $user = base64_decode($_GET["uu"]);
            $_SESSION['codigo'] = $user;
            //$nombre = $_SESSION["nombre"];
            //$nivel = $_SESSION["nivel"];
            if(isset($_GET["e"])){
                $emsg = $_GET["e"];
                if($emsg == 1){
                    $msg="<div class='alert alert-warning'><strong>Error</strong> en Contraseña Corporativa.</div>";
                }
            }
        }else{

      		header("location:index.php");           
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['ms_pasodos'])) {    	 
        if($_POST['tipo'] == 'c'){
            // USUARIO TIPO 1
            require_once "../sitio/sec/ms/libfunc.php";
            $email = $_POST['email'];
            $password = $_POST['password'];
            comprobarLoginPart($email, $password); 
        }else if($_POST['tipo'] == 'd'){
            // USUARIO TIPO 2
            require_once "../sitio/sec/ms/libfunc.php";
            $email = $_POST['email'];
            $password = $_POST['password'];
            comprobarLoginCorp($email, $password); 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es_VE">
<head>
<?php include '../c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title>Mystery Shopper - Salvador Hairdressing</title>

    <?php include '../c/header.php'; ?>

    <?php include '../library/funciones.php'; ?>
<style type="text/css">
  .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control{
    background-color:rgba(29,29,33,0.06) !important;
    border-bottom-style: none !important;
  }
</style>
</head>
<body>
<div id="preloade2r"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">
    <?php include '../c/navbar.php'; ?>
  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(images/bg.jpg);">
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
    <diw class="row">
      <div class="col-md-7 blog-content">
        <div class="box text-center">
          <h3 class="post-title padding-bottom3"  style="color: #e32028;">Mystery Shopper</h3>
          <div class="post-content text-left">
            <p style="text-align: justify;">Salvador se esfuerza en prestar a su clientela un servicio de excelencia, demostrando en todo momento que día a día nos enfocamos en superarnos a nosotros mismos y a las expectativas de quienes requieren de nuestros servicios y productos.
            <br><br>Por este motivo, nace el programa <b>Mystery Shopper de Salvador Hairdressing</b>, con la finalidad de obtener una evaluación completa de parte de nuestros clientes al momento de visitar nuestras unidades de negocio.
            <br><br>Te invitamos a ser una herramienta clave en nuestro objetivo de mejora continua, siendo nuestro Mystery Shopper (Cliente Misterioso), y así ayudarnos a detectar aquellos aspectos que debemos mejorar.</p>
          </div>
          <!-- .post-footer --> 
        </div>
      </div>
      <?php if ($tlogin == "1") {?>
      <div class="col-md-5">
         <div class="signup-header wow fadeInUp" style="margin: 0 5% 0 5%;">
            <h3 id="ingresaemail" class="form-title text-center" style="padding-top:10% !important"><strong>INICIA SESIÓN</strong></h3>
            <form action="" class="form-header" role="form" method="POST" id="ms_email">
                <input type="hidden" name="u" value="503bdae81fde8612ff4944435">
                <input type="hidden" name="id" value="bfdba52708">
                <div class="form-group">
                    <input class="form-control input-lg" name="email" id="email" type="text" placeholder="Ingresa tu correo eléctronico" value="<?php echo $user ?>" readonly required>
                </div>
                <div class="form-group">
                    <input class="form-control input-lg" name="password" id="password" type="password" placeholder="Ingresa tu contraseña" autofocus required>
                </div>
                <input type="hidden" name="tipo" value="c">
                <div class="form-group last">
                    <input type="submit" name="ms_pasodos" class="btn btn-warning btn-block btn-lg" value="ENTRAR">
                </div>
                <?php 
                if(isset($_GET["e"])){
                    $emsg = $_GET["e"];
                    if($emsg == 2){
                        echo $msg="<div class='alert alert-warning'><strong>Error en Contraseña.</strong></div>";
                    }
                }  
                ?>
                <p class="privacy text-center">
                  <a href="#" onclick="cambiarLabel()">¿Usuario Corporativo?</a> -  <a href="#" onclick="regresarLabel()" style="text-decoration: none;">Participante</a><br>Tu información no será compartida. Lee nuestra <a href="privacy.html">política de privacidad</a>.
                </p>
            </form>
        </div>
      </div>
      <?php } else if ($tlogin == "2") {?>
      <div class="col-md-5">
         <div class="signup-header wow fadeInUp" style="margin: 0 5% 0 5%;">
            <h3 id="ingresaemail" class="form-title text-center" style="padding-top:10% !important"><strong>INICIA SESIÓN</strong></h3>
            <form action="" class="form-header" role="form" method="POST" id="ms_email">
                <input type="hidden" name="u" value="503bdae81fde8612ff4944435">
                <input type="hidden" name="id" value="bfdba52708">
                <div class="form-group">
                    <input class="form-control input-lg" name="email" id="email" type="text" value="<?php echo $user ?>" placeholder="Usuario Corporativo" readonly required>
                </div>
                <div class="form-group">
                    <input class="form-control input-lg" name="password" id="password" type="password" placeholder="Ingresa tu contraseña" autofocus required>
                </div>
                <input type="hidden" name="tipo" value="d">
                <div class="form-group last">
                    <input type="submit" name="ms_pasodos" class="btn btn-warning btn-block btn-lg" value="ENTRAR">
                </div>
                <p class="privacy text-center">
                  <a href="#" onclick="cambiarLabel()">¿Usuario Corporativo?</a> -  <a href="#" onclick="regresarLabel()" style="text-decoration: none;">Participante</a><br>Tu información no será compartida. Lee nuestra <a href="privacy.html">política de privacidad</a>.
                </p>
            </form>
        </div>
      </div>
      <?php }?>	      
    </div>
  </div>
</div>
<?php 
  include '../c/footer.php';
?>
</body>
</html>