<!DOCTYPE html>
<html lang="es_VE">

    <?php 
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "../../locale");
      textdomain("salvador_web");
     ?>

<head>
<?php include '../../c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title><?php echo _('FAQ: Preguntas Frecuentes'); ?> - Salvador Hairdressing</title>

    <?php include '../../c/header.php'; ?>
    <?php include '../../library/franquicias.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include '../../c/navbar.php'; ?>

  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(/c/img/main/faq.jpg);">
    <div class="overlay">
    <div class="container inner text-center">
      <div class="headline text-center">
        <h2><?php echo _('FAQ: Preguntas Frecuentes'); ?></h2>
      </div>
      <!-- /.headline --> 
      <div class="item caption-overlay">
        <div class="caption bottom-left">
          <div class="layer box">
            <h4 class="post-title text-right">
              <a class="sec-title" href="/franquicias.php"><i class="budicon-arrow-left-1 icon-main"></i> <?php echo _('Regresar a Franquicias'); ?></a>
            </h4>
          </div>
          <!-- /.layer -->
        </div>
      </div>
    </div>
    <!--/.container --> 
  </div>
  </div>

  <div class="dark-wrapper">

    <div class="container inner">
      <div class="row">
        
    <?php 
    $categorias = armarCategoriasFAQ();
    $bodyprinc = armarMainContent();

    $html = file_get_contents("../../c/html/index.html");
    $html = str_replace("%categorias%",$categorias,$html);
    $html = str_replace("%bodyprincipal%",$bodyprinc,$html);

    echo $html;?>

      </div>
    </div>
  </div>

 <?php 
    include '../../c/footer.php';
  ?>

</body>
</html>