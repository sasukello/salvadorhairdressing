<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="style/images/favicon.png">
<title>Franquicias - Salvador Hairdressing</title>

  <?php include 'demo/c/header.php'; ?>
  <?php include 'demo/library/funciones.php'; ?>

</head>
<body>
<div id="preloader2"><div class="textload">Cargando</div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">
  <div class="navbar">

    <?php include 'demo/c/navbar.php'; ?>

  
 <div class="post-parallax parallax inverse-wrapper" style="background-image: url(../c/img/main/franquicias-main-1.jpg);">
    <div class="overlay">
    <div class="container inner">
      <!-- /.headline --> 

      <br><br><br><br>
      <div class="item caption-overlay">
        <div class="caption bottom-left">
          <div class="layer box">
            <h4 class="post-title text-right"><!--label class="title-concepto">Un concepto exclusivo para caballeros.</label!-->
              <a class="sec-title" href="#solicitar"><i class="budicon-note-7 icon-main"></i> Solicita tu Franquicia</a>
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
           <?php conceptosbar("mod"); ?>
      </div>
    </div>
  </div>


  <div class="light-wrapper" id="solicitar">
    <div class="container inner">
      <div class="divide10"></div>

           <?php include "franquicias.php"; ?>
            </div>
    <!-- /.container --> 
  </div>
  <!-- /.light-wrapper -->

   <?php include 'demo/c/footer.php'; ?>




</body>
</html>