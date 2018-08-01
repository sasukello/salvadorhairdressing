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
  <?php include '../c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title><?php echo _('App Móvil'); ?> - Salvador Hairdressing</title>

    <?php include '../c/header.php'; ?>
    <?php include '../library/funciones.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include '../c/navbar.php'; ?>


  <div class="tp-fullscreen-container revolution">
    <div class="tp-fullscreen">
      <ul>
        <li data-transition="fade"> <img src="../c/img/app/main1.jpg"  alt="" data-bgposition="right top" data-bgfit="cover" data-bgrepeat="no-repeat" />
          <h1 class="tp-caption large sfr text-black" data-x="50" data-y="220" data-speed="900" data-start="800" data-easing="Sine.easeOut">Salvador Hairdressing<br>App Móvil</h1>
          <div class="tp-caption medium sfr" data-x="50" data-y="380" data-speed="900" data-start="1500" data-easing="Sine.easeOut">
            <h4>¡Toda la excelencia de Salvador Hairdressing, ahora en tus manos!</h4><br>
            <a href="#beneficios"><button type="button" class="btn btn-default">
              <div class="col-md-9 col-sm-9 col-xs-9 download-boton"><h3 class="boton-app">Beneficios</h3></div>
            </button></a>
            <a href="#descargar"><button type="button" class="btn btn-default">
              <div class="col-md-9 col-sm-9 col-xs-9 download-boton"><h3 class="boton-app">Descargar</h3></div>
            </button><br><br></a>
            <h4>Disponible para: <a href="#"><i class="fab padding-icon fa-apple"></i> IOS</a> <a href="#"><i class="fab padding-icon fa-android"></i> Android</a></h4>
          </div>
        </li>
      </ul>
    </div>
  </div>
  
  <div class="dark-wrapper" id="beneficios">    
    <div class="container inner nopadding-bottom">
      <div class="blog row">
        <div class="text-center title-app">
          <h1>Explora, Descubre y Vive la belleza<br><small>Con la nueva <b>App de Salvador Hairdressing</b>.</small></h1>
        </div>
        <div class="col-md-12">
        <div class="col-md-4 padding3top">
          
          <img src="../c/img/app/main2.png">
        </div>
        <div class="col-md-8 blog-content padding3top">
          <h2 class="text-center">Beneficios</h2>
          <div class="blog-posts classic-view">
            <div class="col-md-6 post">
              <div class="box text-center">
                <h3 class="post-title padding-bottom3"><i class="budicon-date-1 icon-main"></i>Sistema de Citas</h3>
                <div class="post-content text-left">
                  <p>Al descargar nuestra App para teléfonos inteligentes "Salvador Hairdressing", tendrás acceso a nuestro exclusivo sistema de citas.</p>
                </div>
                <!-- .post-footer --> 
              </div>
              <!-- /.box --> 
            </div>

            <div class="col-md-6 post">
              <div class="box text-center">
                <h3 class="post-title padding-bottom3"><i class="budicon-bell icon-main"></i>Notificaciones</h3>
                <div class="post-content text-left">
                  <p>Recibe notificaciones de nuestras promociones, descuentos y precios especiales, mediante notificaciones push en la aplicación.</p>
                </div>
                <!-- .post-footer --> 
              </div>
              <!-- /.box --> 
            </div>

            <div class="col-md-6 post">
              <div class="box text-center">
                <h3 class="post-title padding-bottom3"><i class="budicon-mail icon-main"></i>Contacto</h3>
                <div class="post-content text-left">
                  <p>Dentro de la aplicación encontrarás nuestro formulario de contacto donde podrás enviar tus comentarios, sugerencias o reclamos, para ayudarnos a mantener nuestro nivel de calidad.</p>
                </div>
                <!-- .post-footer --> 
              </div>
              <!-- /.box --> 
            </div>

            <div class="col-md-6 post">
              <div class="box text-center">
                <h3 class="post-title padding-bottom3"><i class="budicon-cash-dollar icon-main"></i>Descuento</h3>
                <div class="post-content text-left">
                  <p>Al programar tu primera cita mediante nuestra aplicación, podrás obtener un 50% de descuento en el servicio reservado, solo aplica para esa primera cita.</p>
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
      </div>
      <!-- /.blog --> 
    </div>
    <!--/.container --> 
  </div>
  <!--/.dark-wrapper -->

  <div class="light-wrapper inner">
    <h1 class="text-center title-app">Galería</h1>
    <div class="swiper-wrapper"> <a class="arrow-left" href="#"></a> <a class="arrow-right" href="#"></a>
      <div class="swiper-container gallery">
        <div class="swiper">
          <div class="item margin-gallery">
            <figure class="frame"><img src="../c/img/app/img-01.jpg" alt="" /></figure>
          </div>
          <!-- /.item -->
          <div class="item margin-gallery">
            <figure class="frame"><img src="../c/img/app/img-02.jpg" alt="" /></figure>
          </div>
          <!-- /.item -->
          <div class="item margin-gallery">
            <figure class="frame"><img src="../c/img/app/img-03.jpg" alt="" /></figure>
          </div>
          <!-- /.item -->
          <div class="item margin-gallery">
            <figure class="frame"><img src="../c/img/app/img-04.jpg" alt="" /></figure>
          </div>
          <!-- /.item -->
          <div class="item margin-gallery">
            <figure class="frame"><img src="../c/img/app/img-05.jpg" alt="" /></figure>
          </div>
          <!-- /.item -->
          <div class="item margin-gallery">
            <figure class="frame"><img src="../c/img/app/img-06.jpg" alt="" /></figure>
          </div>
          <!-- /.item -->
          <div class="item margin-gallery">
            <figure class="frame"><img src="../c/img/app/img-07.jpg" alt="" /></figure>
          </div>
          <!-- /.item -->
          <div class="item margin-gallery">
            <figure class="frame"><img src="../c/img/app/img-08.jpg" alt="" /></figure>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="parallax3 inverse-wrapper customers" id="descargar" style="background-image: url(/c/img/bg5.jpg); background-size: cover;">
    <div class="container inner">
        <div class="col-md-8 col-md-offset-2 col-sm-12 text-center">
          <h1 class="wow fadeInLeft large-font">¡Descárgala ahora!</h1>
          <h3 class="download-text wow fadeInRight">Con la nueva App para teléfonos inteligentes de Salvador Hairdressing, simplifica tu vida y vive la <strong>"Experiencia Salvador"</strong> donde quiera que estés.</h3>
          
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

  <div class="light-wrapper row text-center" style="margin-top: 50px;">
    <h1 class="text-center">Código QR</h1>
    <h4>Accede Directamente al Escanear este Código:</h4><br>
      <img src="../c/img/app/qr.png" alt="" height="270px" width="270px">
  </div>

 <?php include '../c/footer.php';?>

</body>
</html>