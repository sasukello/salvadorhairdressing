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
<title>FS magazine - Salvador Hairdressing</title>

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
        <li data-transition="fade"> 
          <div class="tp-caption large text-center sfb" data-x="center" data-y="220" data-speed="900" data-start="800" data-endspeed="100" data-easing="Sine.easeOut" style="z-index: 2;"><img src="/c/img/logos/logo-fs-most-01min.png"></div>
          <div class="tp-caption medium text-center sfb" data-x="center" data-y="450" data-speed="900" data-start="1500" data-endspeed="100" data-easing="Sine.easeOut" style="z-index: 2; font-style: italic; color: rgb(201, 151, 9);">Il magazine di bellezza</div>
          <div class="tp-caption tp-fade fadeout fullscreenvideo" data-x="0" data-y="0" data-speed="1000" data-start="1100" data-easing="Power4.easeOut" data-elementdelay="0.01" data-endelementdelay="0.1" data-endspeed="1500" data-endeasing="Power4.easeIn" data-autoplay="true" data-autoplayonlyfirsttime="false" data-nextslideatend="true" data-dottedoverlay="twoxtwo" data-volume="mute" data-forceCover="1" data-aspectratio="16:9" data-forcerewind="on" style="z-index: 1;">
            <video class="" preload="none" width="100%" poster='c/img/fs/bg-main-24.jpg'>
            </video>
          </div>
        </li>
      </ul>
    </div>
    <!-- /.tp-fullscreen-container --> 
  </div>
  <!-- /.revolution -->
  
  <div class="dark-wrapper">    
    <div class="container inner2 nopadding-bottom">
      <div class="blog row">
        <div class="col-md-12">


        <div class="col-md-7">
          <div class="item post">
              <figure class="main sinmargen" style="height: 450px;"><iframe style="width:100%; height:450px;" src="//e.issuu.com/embed.html#3474702/56697535" frameborder="0" allowfullscreen></iframe></figure>
              <div class="box text-center">
                <div class="category cat16"><span class="sinpadding"><a href="//fsinter.com/ediciones/actual.php" target="_blank"><?php echo _('Edición 37'); ?></a></span></div>
                <p><div class="meta"><?php echo _('Revista fs magazine. Edición 37.'); ?></div></p>
              </div>
          </div>
        </div>

        <div class="col-md-4 col-md-offset-1 blog-content">

          <div class="item post">
            <figure class="main marginbt0"><img src="/c/img/fs/bg-main-1.jpg" alt="" /></figure>
            <div class="box text-center">
              <div class="category cat16"><span><a target="_blank" href="//fsinter.com/"><h3 class="marginbt0 text-white"><?php echo _('Visítanos'); ?></h3></a></span></div>
              <h4 class="post-title"><br><a target="_blank" href="//fsinter.com/"><img src="/c/img/logos/logo-fs-most-01min.png" height="50px"> <small><i>Il magazine di bellezza</i></small></a></h4>
              <p style="font-size: 16px;"><br><?php echo _('Somos un espacio de lectura para los apasionados de la belleza, con todas las novedades en diversos temas y los análisis de expertos en looks y tendencias, traemos a nuestros lectores los mejores complementos presentando lo más actual del mundo de la moda y las pasarelas.'); ?></p>
            </div>            
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

<div class="offset"></div>

 <?php 

    include 'c/footer.php';

?>

</body>
</html>