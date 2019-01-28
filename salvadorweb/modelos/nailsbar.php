<!DOCTYPE html>
<html lang="es_VE">

    <?php 
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "../locale");
      textdomain("salvador_web");
     
      if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['country'])) {
          $country = $_GET["country"];
        } else{
          $country = "";
        }
      }
      ?>

<head>
  <?php include '../c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="/style/images/favicon.png">
<title>Modelos de Negocio: Nailsbar - Salvador Hairdressing</title>

  <?php include '../c/header.php'; ?>
  <?php include '../library/funciones.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload">Cargando</div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">
      <?php include '../c/navbar.php'; ?>

<div class="inner2">
  <div class="post-parallax parallax inverse-wrapper" style="background-image: url(/c/img/mdn/nails/main1.jpg);">
    <div class="overlay">
    <div class="container inner">
      <!-- /.headline --> 

      <br><br><br><br>
      <div class="item caption-overlay">
        <div class="caption bottom-left">
          <div class="layer box">
            <div class="category cat9 logo-concepto"><span><a id="foto-concepto" href="#"><img src="/c/img/logos/nails-logo.png"></a></span></div>
            <h4 class="post-title text-right"><!--label class="title-concepto">Un concepto exclusivo para caballeros.</label!-->
              <a class="sec-title" href="#concepto"><i class="budicon-shop icon-main"></i>Concepto</a>
              <a class="sec-title" href="#ubicaciones"><i class="budicon-location-1 icon-main"></i>Ubicaciones</a>
            </h4>
          </div>
          <!-- /.layer -->
        </div>
      </div>
      <!-- /.caption -->

    </div>
    <!--/.container --> 
  </div>
  </div>
  <!--/.parallax --> 
</div>

  <div class="light-wrapper" id="concepto" style="background-image: linear-gradient(to top, #aeaeae 0%, #ededed 100%);">
    <div class="container">
      <div class="row">
        <!--/column -->
        <div class="col-md-5" id="ocultar2" style="margin-top: 0; margin-bottom: 0;">
          <img src="../c/img/nailsbar600.png" height="600">
        </div>
        <div class="col-md-7 col-sm-12" id="pad-onmob2">
          <div class="text-center"><img src="/c/img/logos/nails-logo.png"></div><br>
          <p class="par-concepto text-black">Es nuestro más novedoso concepto, donde la calidad y el profesionalismo de su capital humano se fusionan con nuestro excelente servicio para lograr la satisfacción de nuestros clientes.<br><br>Se ofrecen servicios integrales para el cuidado de manos y pies, dirigido al público en general, desde el manicure tradicional hasta el manicure y pedicura más detallado de acabado profesional, masajes relajantes, exfoliantes, hidratantes, servicio de Pedi Spa, limpieza, esculpido y pulido de uñas, además de diseños y colores de esmaltes, texturas, aplicaciones y diferentes materiales.</p>
        </div>
        <!--/column -->
      </div>
      <!--/.row -->
    </div>
    <!--/.container --> 
  </div>
  <!-- /.light-wrapper -->


  <div class="dark-wrapper mb50" id="ubicaciones">
    <div class="container inner2">
      <h3 class="section-title text-center">Ubicaciones</h3>
      <div class="divide30"></div>

            <?php echo loadUbicaciones(5,1, $country); ?>

    </div>
  </div>
  
  <div class="light-wrapper">
    <div class="container" style="padding-bottom: 50px;">
      <div class="row">
           <?php conceptosbar("mod", $language); ?>
      </div>
    </div>
  </div>

<div class="slide-portfolio-overlay"></div><!-- overlay that appears when slide portfolio content is open -->
</main>

<div class="slide-portfolio-item-content dark-wrapper slide-portfolio-item-1">
  <div class="slide-portfolio-item-detail">
    <div class="inner2">
      <span id="contentslideubi"></span>

      <div class="divide25"></div>
      <div class="row text-center">
          <h3>Google Map</h3>
          <div id="map" style="height: 360px;">
            <span id="mapslideubi"></span>
          </div>          
      </div>

    </div>
  </div>
</div>

<a href="#0" class="slide-portfolio-item-content-close"><i class="budicon-cancel-1"></i></a> <!-- close slide portfolio content --> 
<?php include '../c/footer.php'; ?>

</body>
</html>