<!DOCTYPE html>
<html lang="es_VE">
<?php
  $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
  putenv("LC_ALL=$language");
  setlocale(LC_ALL, $language);
  bindtextdomain("salvador_web", "../locale");
  textdomain("salvador_web");
?>
<?php 
require "../intranet/noticias/conexion.php";
$conex = mysqli_connect($server,$serveruser,$password,$name);
if (mysqli_connect_errno()) {
    echo "Fallo la conexión";
    exit();
}
mysqli_set_charset($conex,"utf8");
$id = $_GET['id'];
$sql = "SELECT * FROM salvador_noticias WHERE id = '$id'";
  $consulta = mysqli_query($conex,$sql);
  $res = mysqli_fetch_array($consulta,MYSQLI_ASSOC);
  $titulo=$res['titulo'];
  $descrip=$res['descripcion'];
  $url_image=$res['url_img'];

?>
<head>
<?php include 'c/ganalytics.html'; ?>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title>Noticias - Salvador Hairdressing</title>
<?php include 'c/header.php'; ?>
</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">
    <?php include 'c/navbar.php'; ?>
  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(c/img/contact/instituto.jpg);">
    <div class="overlay">
      <div class="container inner text-center">
        <div class="headline text-center">
          <!-- <h2><?php //echo _('The Academy'); ?></h2> -->
        </div>
        <!-- /.headline -->
      </div>
    <!--/.container -->
    </div>
  </div>
  <div class="dark-wrapper">
    <div class="container inner">
      <div class="row">
        <div class="col-sm-6">
          <figure><img src="intranet/noticias/img/<?php echo $url_image;?>" alt=""/></figure>
        </div>
        <div class="col-sm-6" style="text-align: justify;">
          <h3 class="section-title"><?php echo $titulo; ?></h3>
          <?php echo $descrip; ?>
          <br>
          <a href="index.php" class="btn btn-default"><?php echo _("Más noticia")?></a>
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
<?php
  include 'c/footer.php';
?>
</body>
</html>