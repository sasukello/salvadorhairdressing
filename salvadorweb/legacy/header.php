<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="style/images/favicon.png">
<title>Franquicias - Salvador Hairdressing</title>

<link rel="shortcut icon" href="/demo/c/img/salvador-favi-hq.png">
<!-- Bootstrap core CSS -->
<link href="/demo/style/css/bootstrap.min.css" rel="stylesheet">
<link href="/demo/style/css/plugins.css" rel="stylesheet">
<link href="/demo/style.css" rel="stylesheet">
<link href="/demo/style/css/color/red.css" rel="stylesheet">
<link href="/demo/style/css/custom.css" rel="stylesheet">

<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
<link href="/demo/style/type/icons.css" rel="stylesheet">
<link href="/demo/c/fonts/fa/fontawesome.min.css" rel="stylesheet">
<link href="/demo/c/fonts/fa/fa-brands.min.css" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<link href="/demo/legacy/css/style.css" rel="stylesheet" type="text/css" />
<link href="/demo/legacy/css/redes_buzon_tienda.css" rel="stylesheet" type="text/css" />  

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<?php 
    if(isset($ubi)){
        switch ($ubi) {
            case 'contacto':
            echo '<link href="/demo/c/css/form.css" rel="stylesheet">
                <link href="/demo/c/css/form2.css" rel="stylesheet">';
                break;
        }
    }

 ?>

 <style type="text/css">
     .custom-date-style {
        background-color: red !important;
    }
</style>
           
    </head>
    <body >
<div id="preloader2"><div class="textload">Cargando</div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">
  <div class="navbar">

    <?php //include '../c/navbar.php'; ?>

  
 <div class="post-parallax parallax inverse-wrapper" style="background-image: url(/demo/c/img/main/franquicias-main-1.jpg);">
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
           <?php //conceptosbar("mod"); ?>
      </div>
    </div>
  </div>

