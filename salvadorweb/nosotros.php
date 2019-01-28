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
<meta name="author" content="">
<title><?php echo _('Nosotros'); ?> - Salvador Hairdressing</title>

    <?php include 'c/header.php'; ?>
    <?php include 'library/funciones.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include 'c/navbar.php'; ?>


  <div class="tp-fullscreen-container revolution">
    <div class="tp-fullscreen">
      <ul>
        <li data-transition="fade"> <img src="style/video/nyc.jpg" alt="" data-bgfit="cover" data-bgposition="center top" data-bgrepeat="no-repeat" />
          <!--<div class="tp-caption large text-center sfb" data-x="center" data-y="293" data-speed="900" data-start="800" data-endspeed="100" data-easing="Sine.easeOut" style="z-index: 2;"><img src="c/img/60-a-min.png"></div>
          <div class="tp-caption medium text-center sfb" data-x="center" data-y="387" data-speed="900" data-start="1500" data-endspeed="100" data-easing="Sine.easeOut" style="z-index: 2; font-style: italic;">Pasión por la belleza</div>-->
          <div class="tp-caption tp-fade fadeout fullscreenvideo"
      data-x="0"
      data-y="0"
      data-speed="1000"
      data-start="1100"
      data-easing="Power4.easeOut"
      data-elementdelay="0.01"
      data-endelementdelay="0.1"
      data-endspeed="1500"
      data-endeasing="Power4.easeIn"
      data-autoplay="true"
      data-autoplayonlyfirsttime="false"
      data-nextslideatend="true"
        data-dottedoverlay="twoxtwo"
        data-volume="mute" data-forceCover="1" data-aspectratio="16:9" data-forcerewind="on" style="z-index: 1;">
            <video class="" preload="none" width="100%" height="100%" 
poster='style/video/nyc.jpg' loop>
              <source src='style/video/salva3.mp4' type='video/mp4' />
              <source src='style/video/nyc.webm' type='video/webm' />
            </video>
          </div>
        </li>
      </ul>
      <div class="tp-bannertimer tp-bottom"></div>
    </div>
    <!-- /.tp-fullscreen-container --> 
  </div>
  <!-- /.revolution -->
  
  <div class="dark-wrapper">    
    <div class="container inner2 nopadding-bottom">
      <div class="blog row">
        <div class="col-sm-7 blog-content">
          <div class="blog-posts classic-view">
            <div class="post">
              <div class="box text-center">
                <h2 class="post-title padding-bottom3"><?php echo _('Misión'); ?></h2>
                <div class="post-content text-left">
                  <p><?php echo _('Exceder las expectativas de toda la familia, al proveer un servicio de belleza personalizado e integral, basado en la excelencia y a la vanguardia de las últimas innovaciones y tendencias, respaldados por recursos de calidad comprobada, los más reconocidos aliados comerciales y el más calificado, ético y responsable capital humano, con alto sentido de responsabilidad social.'); ?></p>
                </div>
                <!-- .post-footer --> 
              </div>
              <!-- /.box --> 
            </div>

            <div class="post">
              <div class="box text-center">
                <h2 class="post-title padding-bottom3"><?php echo _('Visión'); ?></h2>
                <div class="post-content text-left">
                  <p><?php echo _('Ser el concepto de belleza integral dirigido a toda la familia, más reconocido a nivel nacional e internacional, por nuestra trayectoria, calidad de atención y excelencia profesional.'); ?></p>
                </div>
                <!-- .post-footer --> 
              </div>
              <!-- /.box --> 
            </div>

            <div class="post">
              <div class="box text-center">
                <h2 class="post-title padding-bottom3"><?php echo _('Valores'); ?></h2>
                <div class="post-content text-left">
                  <ul>
                    <?php echo _('<li>Humildad</li>
                    <li>Innovación</li>
                    <li>Honestidad</li>
                    <li>Responsabilidad</li>
                    <li>Pasión</li>
                    <li>Profesionalismo</li>
                    <li>Dedicación</li>
                    <li>Constancia</li>
                    <li>Trabajo en Equipo</li>
                    <li>Integridad</li>
                    <li>Responsabilidad Social</li>'); ?>
                  </ul>
                </div>
                <!-- .post-footer --> 
              </div>
              <!-- /.box --> 
            </div>

          </div>
          <!-- /.classic-view -->          
        </div>
        <!-- /.blog-content -->
        
        <aside class="col-sm-4 col-md-offset-1 sidebar side-color">
          <div class="sidebox widget">
            <h1 class="salvador-side"><br>Salvador</h1>
            <h6 class="subtitle">Hairdressing</h6>
            <span class="video-side"><iframe width="440" height="260" src="https://www.youtube.com/embed/-65WyGr0Ku0?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></span>
            <h3 class="welcome-style"><?php echo _('¡Bienvenido a la Excelencia!'); ?></h3>
            <div class="clearfix"></div>
          </div>
          <?php include 'c/minititulares.php'; ?>
        </aside>
        <!-- /column .sidebar --> 
        
      </div>
      <!-- /.blog --> 
    </div>
    <!--/.container --> 
  </div>
  <!--/.dark-wrapper -->

 <?php 
    conceptosbar("nos", $language);

    include 'c/footer.php';

?>

</body>
</html>