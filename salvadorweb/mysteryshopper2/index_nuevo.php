<?php
/*
 * Página Principal para la sección Mistery Shopper de Salvador Hairdressing
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
} else{
    // remove all session variables
    session_unset();
    // destroy the session 
    session_destroy();
}
$estado = "";
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ms_pasouno'])) {
        require_once "../sitio/sec/ms/libfunc.php";
        $tipo = $_POST["tipo"];
        if ($tipo == 'a') {
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
        $mensaje = "<div class='alert alert-danger'>Hubo un erorr en la conexión al sitio de <strong>Mystery Shopper</strong>. Por favor, intenta realizar las operaciones desde tu Cuenta Corporativa.</div>";
    } else if($estado == 6){
        $mensaje = "<div class='alert alert-success'>¡El participante fue <strong>aprobado éxitosamente</strong>!</div>";
    }  
}
?>
<!DOCTYPE html>
<html lang="es_VE">

    <?php 
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "../locale");
      textdomain("salvador_web");
     ?>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title><?php echo _('Mystery Shopper'); ?> - Salvador Hairdressing</title>

    <?php include '../c/header.php'; ?>
    <?php include '../library/funciones.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">

    <?php include '../c/navbar.php'; ?>

<div class="inner2">
    <!-- /.parallax full screen background image -->
        <div class="tp-fullscreen dark-wrapper landing parallax" style="background-image:url('/c/img/bg.jpg');" data-img-width="2000" data-img-height="1333" data-diff="100">

            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">

                            <!-- /.logo -->
                            <!--<div class="logo wow fadeInDown"> <a href=""><img src="images/salvador-logo-wh.jpg" alt="logo"></a></div>-->
                            <!-- /.main title -->
                            <h1 class="wow fadeInLeft">
                                Mystery Shopper
                            </h1>

                            <!-- /.header paragraph -->
                            <div class="landing-text wow fadeInUp">
                                <p>¿Quieres ser un <i><b>Mystery Shopper</b></i> para Salvador Hairdressing?<br>Ingresa tu correo en el siguiente formulario para entrar a tu cuenta o registrar tus datos.<br></p>
                            </div>          

                            <!-- /.header button -->
                            <div class="head-btn wow fadeInLeft">
                                <a href="#intro" class="btn-primary">Conoce más...</a>
                               <!-- <a href="#download" class="btn-default">Download</a>-->
                            </div>



                        </div> 
                
                        <!-- /.signup form -->
                        <div class="col-md-5">
                            <div class="signup-header wow fadeInUp">
                                <h3 id="ingresaemail" class="form-title text-center"><strong>INGRESA TU CORREO ELÉCTRONICO...</strong></h3>
                                <?php echo $mensaje;?>
                                <form class="form-header" role="form" method="POST" id="ms_email">
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
        </div>
</div>
 

  <!--div class="tp-fullscreen-container revolution">
    <div class="tp-fullscreen">
      <ul>
        <li data-transition="fade">
          <h1 class="tp-caption large sfr" style="z-index: 2;" data-x="50" data-y="250" data-speed="900" data-start="800" data-easing="Sine.easeOut">Mystery Shopper</h1>
          <div class="tp-caption small sfb" data-x="50" data-y="350" data-speed="900" data-start="1500" data-endspeed="100" data-easing="Sine.easeOut" style="z-index: 2;">
            ¿Quieres ser un <b>Mystery Shopper</b> de Salvador Hairdressing?
            <br><br>Ingresa tu correo en el formulario de rergistro para<br> entrar a tu cuenta o registrar tus datos.
            <br><br>
            <a href="#beneficios"><button type="button" class="btn btn-default">
              <div class="col-md-9 col-sm-9 col-xs-9 download-boton"><h3 class="boton-app">Conoce más</h3></div>
            </button></a>
            <a href="#beneficios"><button type="button" class="btn btn-default">
              <div class="col-md-9 col-sm-9 col-xs-9 download-boton"><h3 class="boton-app">Regístrate</h3></div>
            </button></a>

          </div>
          <div class="tp-caption tp-fade fadeout fullscreenvideo" data-x="0" data-y="0" data-speed="1000" data-start="1100" data-easing="Power4.easeOut" data-elementdelay="0.01" data-endelementdelay="0.1" data-endspeed="1500" data-endeasing="Power4.easeIn" data-autoplay="true" data-autoplayonlyfirsttime="false" data-nextslideatend="true" data-dottedoverlay="twoxtwo" data-volume="mute" data-forceCover="1" data-aspectratio="16:9" data-forcerewind="on" style="z-index: 1;">
          <video class="" preload="none" width="100%" poster='../c/img/bg.jpg'>
            </video>
        </li>
      </ul>
    </div>
  </div>
  </.revolution --> 
  <div class="dark-wrapper" id="beneficios">    
    <div class="container inner nopadding-bottom">
      <div class="blog row">
        <div class="text-center title-app">
          <!--h1>Mystery Shopper</h1-->
        </div>
        <div class="col-md-12">
        <div class="col-md-4 padding3top">      
        <img src="../c/img/app/main2.png">
        </div>
        <div class="col-md-8 blog-content padding3top">
          <div class="blog-posts classic-view">
            <div class="col-md-12 post">
              <div class="box text-center">
                <h3 class="post-title padding-bottom3"><!--i class="budicon-search-1 icon-main"--></i>Mystery Shopper</h3>
                <div class="post-content text-left">
                  <p style="font-size: 17px; text-align: justify;">Salvador se esfuerza en prestar a su clientela un servicio de excelencia, demostrando en todo momento que día a día nos enfocamos en superarnos a nosotros mismos y a las expectativas de quienes requieren de nuestros servicios y productos.
                  <br><br>Por este motivo, nace el programa <b>Mystery Shopper de Salvador Hairdressing</b>, con la finalidad de obtener una evaluación completa de parte de nuestros clientes al momento de visitar nuestras unidades de negocio.
                  <br><br>Te invitamos a ser una herramienta clave en nuestro objetivo de mejora continua, siendo nuestro Mystery Shopper (Cliente Misterioso), y así ayudarnos a detectar aquellos aspectos que debemos mejorar.</p>
                </div>
                <!-- .post-footer --> 
              </div>
              <!-- /.box --> 
            </div>

          </div>
          <!-- /.classic-view -->          
        </div>
        <!-- /.blog-content -->   
        </div>
        <!--div class="padding3top padding-bottom3 text-center"><h4>Salvador Hairdressing se complace en acercarte más a nuestros servicios simplificando tu vida.</h4></div-->
      </div>
      <!-- /.blog --> 
    </div>
    <!--/.container --> 
  </div>
  <!--/.dark-wrapper -->

  <div class="offset"></div>

  <div class="parallax3 inverse-wrapper customers" id="descargar" style="background-image: url(/c/img/bg5.jpg); background-size: cover;">
    <div class="container inner">
        <div class="col-md-8 col-md-offset-2 col-sm-12 text-center">
          <h1 class="wow fadeInLeft" style="font-size: 35px;">¿Quieres ser un Mystery Shopper?</h1>
          <h3 class="download-text wow fadeInRight">Ingresa tu correo en el siguiente formulario para entrar a tu cuenta o registrar tus datos.</h3>
          
          <!-- /.download buttons -->
          <button type="button" class="btn btn-default">
            <div class="col-md-3 col-sm-3 col-xs-3 download-boton"><i class="fab iconapp-size fa-apple"></i></div>
            <div class="col-md-9 col-sm-9 col-xs-9 download-boton"> <a href="https://itunes.apple.com/us/app/salvador-hairdressing/id1141677463?mt=8" target="_blank"><span style="color: white;">Disponible en la</span><br><h3 class="boton-app">App Store</h3></a></div>
          </button>
          <button type="button" class="btn btn-default">
            <div class="col-md-3 col-sm-3 col-xs-3 download-boton"><i class="fab iconapp-size fa-android"></i></div>
            <div class="col-md-9 col-sm-9 col-xs-9 download-boton"> <a href="https://play.google.com/store/apps/details?id=im.ea.mook.salvador&hl=es" target="_blank"><span style="color: white;">Disponible en la</span><br><h3 class="boton-app">Play Store</h3></a></div>
          </button>
    </div>
  </div>
</div>

 <?php include '../c/footer.php';?>

</body>
</html>