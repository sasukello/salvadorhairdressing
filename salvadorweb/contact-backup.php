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
  <?php include 'c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<link rel="shortcut icon" href="/style/images/favicon.png">
<title><?php echo _('Contáctanos'); ?> - Salvador Hairdressing</title>
  <?php 
  $ubi = "franq";
  include 'c/header.php'; ?>
</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include 'c/navbar.php'; ?>
  
  <div class="light-wrapper">
    <div class="container inner" style="padding-bottom: 50px;">
      <div class="thin">
        <h3 class="section-title text-center"><?php echo _('Contacto'); ?></h3>
        <p class="text-center"><?php echo _('¿Qué te pareció tu visita a nuestros salones? Envíanos tus comentarios.'); ?></p>
      </div>
      <!-- /.thin -->
      <div class="divide10"></div>
      <div class="row">
        <div class="col-sm-4">
          <div class="caption-overlay">
            <?php echo _('<figure class="borde-ads"><a href="#"><img src="/c/img/ads/contact1.jpg" alt="" /> </a></figure>
            <div class="caption bottom-right">
              <div class="title">
                <h3 class="main-title layer">Aceite de Argán de Salvador</h3>
              </div>'); ?>
            </div>
          </div>
        </div>
        <!-- /column -->
        <div class="col-sm-4">
          <div class="caption-overlay">
            <figure class="borde-ads"><a href="#"><img src="/c/img/ads/contact2.jpg" alt="" /> </a></figure>
            <div class="caption bottom-right">
              <div class="title">
                <h3 class="main-title layer"><?php echo _('¡25 tonos especialmente para tí!'); ?></h3>
              </div>
              <!--/.title --> 
            </div>
            <!--/.caption --> 
          </div>
        </div>
        <!-- /column -->
        <div class="col-sm-4">
          <div class="caption-overlay">
            <figure class="borde-ads"><a href="#"><img src="/c/img/ads/contact3.jpg" alt="" /> </a></figure>
            <div class="caption bottom-right">
              <div class="title">
                <h3 class="main-title layer"><?php echo _('Client Card: ¡Activa tu Cuenta!'); ?></h3>
              </div>
              <!--/.title --> 
            </div>
            <!--/.caption --> 
          </div>
        </div>
        <!-- /column --> 
      </div>
      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
  </div>
  <!-- /.light-wrapper -->
  
  <div class="dark-wrapper">
    <div class="container" style="padding-bottom: 50px;">
      <?php include 'c/contacto.html'; ?>
    </div> 
  </div>
  
</main>
<?php include 'c/footer.php'; ?>

</body>
</html>