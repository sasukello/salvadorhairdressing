<!DOCTYPE html>
<html lang="es_VE">

    <?php
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "../locale");
      textdomain("salvador_web");

      if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["e"])){
          if ($_GET["e"] == 0) {
            $mensajealert = '<div class="dark-wrapper"><div class="container" style="margin-top: 50px;"><div class="row"><div class="alert alert-success"><strong>'. _('¡Mensaje Enviado Exitosamente!</strong> Gracias por querer formar parte de nuestro equipo de trabajo, evaluaremos toda la información suministrada y pronto nos comunicaremos contigo.').'</div></div></div></div>';
          } elseif ($_GET["e"] == 1) {
            $mensajealert = '<div class="dark-wrapper"><div class="container" style="margin-top: 50px;"><div class="row"><div class="alert alert-danger"><strong>'. _('¡Lo sentimos, ha ocurrido un error inesperado!</strong> Te invitamos a completar la información nuevamente para así recibir todos tus datos.').'</div></div></div></div>';
          }
        }
      }

     ?>

<head>
<?php include '../c/ganalytics.html'; ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title>The Academy - Salvador Hairdressing</title>

    <?php include '../c/header.php'; ?>
    <?php include '../library/funciones.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include '../c/navbar.php'; ?>

  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(/c/img/academy/bg1.jpg);">
    <div class="overlay">
      <div class="container inner text-center">
        <div class="headline text-center">
          <h2><?php echo _('The Academy'); ?></h2>
        </div>
        <!-- /.headline -->
      </div>
    <!--/.container -->
    </div>
  </div>

  <?php
      if (isset($mensajealert)) {
        echo $mensajealert;
      }
  ?>
  <div class="dark-wrapper">
    <div class="container inner">
      <div class="row">
        <div class="col-sm-5">
          <figure><img src="/c/img/academy/bg.jpg" alt="" /></figure>
        </div>
        <div class="col-sm-7" style="text-align: justify;">
          <h3 class="section-title"><?php echo _('La formación de nuestra esencia'); ?></h3>
          <?php echo _('<p>Somos una <b>escuela de belleza</b>, cuya misión es formar profesionales en el área de la belleza y el estilismo, desde cualquier <b>latitud</b>.</p> <p>Promovemos una <b>educación superior</b> y de fácil acceso aspirando a la excelencia de nuestros alumnos, de tal manera que puedan adaptarse rápidamente a las exigencias de actualización de un mercado muy dinámico, como lo es la belleza y el estilismo en todas sus áreas.</p>
            <p>Hacemos la diferencia a través del <b>material pedagógico y las capacitaciones internacionales</b> con las más novedosas tendencias en la belleza, elevando la capacidad pedagógica de nuestros monitores.</p>'); ?>
        </div>
      </div>
    </div>
  </div>



  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(/c/img/careers/main.jpg);">
    
  </div>


  <div class="dark-wrapper">
    <div class="container inner">

      <div class="blog row">
        <div class="col-md-12">
         <div class="col-sm-7">
          <div class="row">

          </div>
          

        </div>

        </div>
      </div>
    </div>
  </div>


    <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(/c/img/main/franquicias-main-1.jpg);">
    <div class="overlay">
    <div class="container inner text-center">
      <div class="headline text-center">
        <h2><?php echo _('¡Bienvenido a la Excelencia!');?></h2>
      </div>
      <!-- /.headline -->
    </div>
    <!--/.container -->
  </div>
  </div>
  <main></main>

  <div class="slide-portfolio-overlay"></div><!-- overlay that appears when slide portfolio content is open -->

 <?php
    include '../c/footer.php';
  ?>

</body>

<div class="slide-portfolio-item-content dark-wrapper slide-portfolio-item-form">
  <div class="slide-portfolio-item-detail">
    <div class="inner2">

      <input type="hidden" name="langsw" id="langsw" value="<?php echo $language; ?>">
      <span id="contentslideform"></span>

    </div>
  </div>
</div>

<a href="#0" class="slide-portfolio-item-content-close"><i class="budicon-cancel-1"></i></a> <!-- close slide portfolio content -->

</html>
