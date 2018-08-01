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

  

  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(/c/img/careers/main.jpg);">
    <div class="overlay">
    <div class="container inner text-center">
      <div class="headline text-center">
        <h2><?php echo _('Trabaja con Nosotros');?></h2>
      </div>
      <!-- /.headline -->
    </div>
    <!--/.container -->
  </div>
  </div>


  <div class="dark-wrapper">
    <div class="container inner">

      <div class="blog row">
        <div class="col-md-12">
         <div class="col-sm-7">
          <div class="row">
            <h3 class="section-title"><?php echo _('Una ventana a tú futuro');?></h3>
            <?php echo _('<h5 class="text-center">Únete a una de las franquicias con mayor crecimiento internacional.</h5>
            <p>Constantemente nos encontramos en la búsqueda de personal en las siguientes áreas:');?></p>
            <ul class="nodecorationlist">
              <li><h3 class="wrktitle"><?php echo _('BARBERO');?></h3></li>
              <p><?php echo _('Si eres...');?></p>
              <hr class="style16">
              <li><h3 class="wrktitle"><?php echo _('ESTILISTA');?></h3></li>
              <p><?php echo _('El Estilista Salvador embarca varias áreas...');?></p>
              <hr class="style16">
              <li><h3 class="wrktitle"><?php echo _('GERENTE DE NEGOCIOS/ STORE MANAGER');?></h3></li>
              <p><?php echo _('El Gerente de Negocios debe estar apegado a nuestros valores de marca...');?></p>
              <hr class="style16">
            </ul>
            <p><?php echo _('Si sientes que tienes lo necesario para formar parte de nuestro equipo, rellena uno de los siguientes formularios y comienza tu camino al éxito con nosotros.');?></p>
          </div>
          <!-- SECCIÓN DE FORMULARIOS -->
          <div class="row">
            <div id="slide-portfolio" class="image-grid">
              <div class="items-wrapper">
                <ul class="isotope items">
                  <li class="item marginbt10">
                    <figure class="icon-overlay">
                      <a href="#0" data-type="slide-portfolio-item-form" data-sid="S01" data-tipo="2"><?php echo _('<img src="/c/img/careers/prof-trabaja-con-nosotros.jpg" alt="" />');?></a>
                    </figure>
                  </li>
                  <li class="item marginbt10">
                    <figure class="icon-overlay">
                      <a href="#0" data-type="slide-portfolio-item-form" data-sid="S02" data-tipo="2"><?php echo _('<img src="/c/img/careers/admin-trabaja-con-nosotros.jpg" alt="" />');?></a>
                    </figure>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- FIN DE SECCIÓN DE FORMULARIOS -->



        </div>
        <aside class="col-sm-4 col-sm-offset-1 sidebar side-color mb20">
          <div class="sidebox widget">
            <h1 class="salvador-side"><br>Salvador</h1>
            <h6 class="subtitle">Hairdressing</h6>
            <span class="video-side"><iframe width="440" height="260" src="https://www.youtube.com/embed/-65WyGr0Ku0?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></span>
            <h3 class="welcome-style"><?php echo _('¡Bienvenido a la Excelencia!'); ?></h3>
            <div class="clearfix"></div>
          </div>
          <?php include '../c/minititulares.php'; ?>
        </aside>

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
