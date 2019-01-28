<!DOCTYPE html>
<html lang="es_VE">

    <?php 
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "./locale");
      textdomain("salvador_web");
     ?>

<head>
    <?php include '../c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="style/images/favicon.png">
<title>Franquicias - Salvador Hairdressing</title>

  <?php 
  $ubi = "contacto";
  include '../c/header.php';
  include '../library/funciones.php'; ?>

</head>
<body>
<div id="preloader2"><div class="textload">Cargando</div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">
  <div class="navbar">

    <?php include '../c/navbar.php'; ?>

  
 <div class="post-parallax parallax inverse-wrapper" style="background-image: url(../c/img/main/franquicias-main-1.jpg);">
    <div class="overlay">
    <div class="container inner">
      <!-- /.headline --> 

      <br><br><br><br>
      <div class="item caption-overlay">
        <div class="caption bottom-left">
          <div class="layer box">
            <h4 class="post-title text-right"><!--label class="title-concepto">Un concepto exclusivo para caballeros.</label!-->
              <a class="sec-title" href="#solicitar"><i class="budicon-note-7 icon-main"></i> <?php echo _('Solicita tu Franquicia'); ?></a>
              <a class="sec-title" href="faq"><i class="budicon-note-7 icon-main"></i> <?php echo _('Preguntas Frecuentes'); ?></a>
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

  <div class="light-wrapper">
    <div class="container inner">
      <div class="divide10"></div>
      <div class="row">
           <?php conceptosbar("mod", $language); ?>
      </div>
    </div>
  </div>


  <div class="light-wrapper" id="solicitar">
    <div class="container inner">
      <div class="divide10"></div>

           <?php //include "franquicias.php"; ?>
            </div>
    <!-- /.container --> 
  </div>
  <!-- /.light-wrapper -->

   <?php include '../c/footer.php'; ?>




</body>
</html>