<?php 
      ob_start();
     

      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "../locale");
      textdomain("salvador_web");

     
      $estado = "";
      $mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ms_pasouno'])) {
       
        include "funcionesMistery/funciones.php";
        $tipo = $_POST["tipo"];
        if ($tipo == 'a') {
            // header("Location: https://www.google.com/");
            $user = $_POST["email"];
            pasouno($user);
        } else if($tipo == 'b') {
            $user = $_POST["email"];
            $pass = $_POST["password"];
            pasocc($user, $pass);
        }
    }
}
if (isset($_GET["e"])) {
    $estado = $_GET["e"];
    if($estado == 0){
        $mensaje = "<div class='alert alert-danger'><strong>Hubo un problema</strong> al guardar tu información. Por favor, intenta de nuevo.</div>";
    } else if($estado == 1){
        $mensaje = "<div class='alert alert-success'><strong>¡Tus datos han sido guardados éxitosamente!</strong> Espera nuestro correo de aprobación en los próximos días.</div>";
    } else if($estado == 2){
        $mensaje = "<div class='alert alert-warning'>Tu cuenta <strong>no se encuentra aprobada</strong>.</div>";
    } else if($estado == 3){
        $mensaje = "<div class='alert alert-warning'>Tu cuenta <strong>aún no se encuentra aprobada.</strong> Debes esperar nuestro correo de aprobación.</div>";
    } else if($estado == 4){
        $mensaje = "<div class='alert alert-warning'>El participante fue <strong>rechazado éxitosamente</strong></div>";
    } else if($estado == 5){
        $mensaje = "<div class='alert alert-danger'>Hubo un error en la conexión al sitio de <strong>Mystery Shopper</strong>. Por favor, intenta realizar las operaciones desde tu Cuenta Corporativa.</div>";
    } else if($estado == 6){
        $mensaje = "<div class='alert alert-success'>¡El participante fue <strong>aprobado éxitosamente</strong>!</div>";
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
            <p style="text-align: justify;"><?php echo _('Salvador se esfuerza en prestar a su clientela un servicio de excelencia, demostrando en todo momento que día a día nos enfocamos en superarnos a nosotros mismos y a las expectativas de quienes requieren de nuestros servicios y productos.
            <br><br>Por este motivo, nace el programa <b>Mystery Shopper de Salvador Hairdressing</b>, con la finalidad de obtener una evaluación completa de parte de nuestros clientes al momento de visitar nuestras unidades de negocio.
            <br><br>Te invitamos a ser una herramienta clave en nuestro objetivo de mejora continua, siendo nuestro Mystery Shopper (Cliente Misterioso), y así ayudarnos a detectar aquellos aspectos que debemos mejorar.');?></p>
          </div>
          <!-- .post-footer --> 
        </div>
      </div>
      <div class="col-md-5">
         <div class="signup-header wow fadeInUp" style="margin: 0 5% 0 5%;">
            <h3 id="ingresaemail" class="form-title text-center" style="padding-top:10% !important"><strong><?php echo _('INGRESA TU CORREO ELÉCTRONICO...'); ?></strong></h3>
            <?php echo $mensaje;?>
            <form action="index.php" class="form-header" role="form" method="POST" id="ms_email">
                <input type="hidden" name="u" value="503bdae81fde8612ff4944435">
                <input type="hidden" name="id" value="bfdba52708">
                <div class="form-group">
                    <input class="form-control input-lg" name="email" id="email" type="text" placeholder="Ingresa tu correo eléctronico" required>
                </div>
                <input type="hidden" name="tipo" value="a">
                <div class="form-group last">
                    <input type="submit" name="ms_pasouno" class="btn btn-warning btn-block btn-lg" value="COMENZAR">
                </div>
                <p class="privacy text-center">
                  <a href="#" onclick="cambiarLabel()">¿Usuario Corporativo?</a> -  <a href="#" onclick="regresarLabel()" style="text-decoration: none;">Participante</a><br>Tu información no será compartida. Lee nuestra <a href="privacy.html">política de privacidad</a>.
                </p>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php 
  include '../c/footer.php';
?>
<script>    
    function cambiarLabel(){
      document.getElementById("ingresaemail").innerHTML = "<strong>INGRESA TU USUARIO CORPORATIVO...</strong>";
      document.getElementsByName("email")[0].placeholder= "Ingresa tu Usuario Corporativo";
    }
    function regresarLabel(){
      document.getElementById("ingresaemail").innerHTML = "<strong>INGRESA TU CORREO ELÉCTRONICO...</strong>";
      document.getElementsByName("email")[0].placeholder= "Ingresa tu correo eléctronico";
    } 
</script> 
</body>
</html>