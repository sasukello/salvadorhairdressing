<!DOCTYPE html>
<html lang="es_VE">

    <?php 
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "../locale");
      textdomain("salvador_web");

      if (session_status() === PHP_SESSION_NONE) {
          session_start();
      } else{
          session_unset();
          session_destroy();
      }
     ?>

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

  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(/c/img/academy/bg1.jpg);">
    <div class="container inner text-center">
      <div class="headline text-center">
        <h2>Mystery Shopper</h2>
      </div>
      <!-- /.headline --> 
    </div>
    <!--/.container --> 
  </div>

  
  <div class="dark-wrapper">

    <div class="container inner nopadding-bottom">
      <div class="row">
        <div class="col-sm-5">
          <figure><img src="/c/img/academy/bg.jpg" alt="" /></figure>
        </div>
        <div class="col-sm-7">
          <h3 class="section-title">The Academy</h3>
          <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas sed diam eget risus varius blandit sit amet non magna. Aenean lacinia bibendum nulla sed consectetur.  Cras mattis consectetur purus sit amet fermentum. Donec sed odio dui. Fusce dapibus, tellus ac cursus commodo, tortor mauris.</p>
          <p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Sed posuere consectetur est at lobortis. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
        </div>
      </div>
    </div>


    <div class="container inner2 nopadding-bottom">
      <div class="blog row">
        <div class="col-md-12">
          <div class="col-md-7">
            
          </div>

          <div class="col-md-4 col-md-offset-1 blog-content">
            <div class="item post">
              <!--<figure class="main marginbt0"><img src="/c/img/academy/bg2.jpg" alt="" /></figure>-->
              <div class="gallery-wrapper main marginbt0">
                  <div class="basic-slider marginbt0">
                    <div class="item"><img src="/c/img/academy/bg2.jpg" alt="" /></div>
                    <div class="item"><img src="/c/img/academy/bg2.jpg" alt="" /></div>
                  </div>
                  <!-- /.basic-slider --> 
                </div>
              <div class="box text-center">
                <div class="category cat16" style="z-index: 1;"><span><a target="_blank" href="#"><h3 class="marginbt0 text-white"><?php echo _('LAVORA CON NOI'); ?></h3></a></span></div>
                <h4 class="post-title"><br><small><i><b>Trabaja con Nosotros</b></i></small></a></h4>
                
                <p style="font-size: 16px;"><br><?php echo _('¿Quieres ser parte del Equipo de Profesionales de <b>Salvador Hairdressing</b>? Rellena el siguiente formulario, y estaremos en contacto contigo.'); ?></p>
                <p><button class="btn btn-active">INGRESA AQUÍ</button></p>
              </div>            
            </div>  
          </div>

        </div>
      </div>
    </div>
  </div>
 <?php 
    include '../c/footer.php';

?>
</body>
</html>