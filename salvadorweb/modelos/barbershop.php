<!DOCTYPE html>
<html lang="es_VE">

    <?php 
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "../locale");
      textdomain("salvador_web");

      if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['country'])) {
          $country = $_GET["country"];
        } else{
          $country = "";
        }
      }
     ?>

<head>
<?php include '../c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="style/images/favicon.png">
<title>Modelos de Negocio: UOMO - Salvador Hairdressing</title>

  <?php include '../c/header.php'; ?>
  <?php include '../library/funciones.php'; ?>

<link href="/style/css/barber.css" rel="stylesheet">
<script src="/c/js/typed.min.js" type="text/javascript"></script>
<script src="/c/js/demos.js"></script>

</head>
<body>
<div id="preloader"><div class="textload">Cargando</div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include '../c/navbar.php'; ?>
  
  <div class="inner2">
    <div class="post-parallax parallax inverse-wrapper" style="background-image: url(/c/img/barbershop.jpg);">
      <div class="overlay">
        <div class="container head-page">
          <div class="item caption-overlay">
              <div class="category cat9 logo-concepto">
                <img class="logo-settings" src="/c/img/mdn/barber/barberpb.png" alt="logo">
              </div>
          </div>
        </div>
      </div>
    </div>
  </div> 

  <div class="bg-typed text-center">
    <h1 class="light-color-brb">
      <div class="type-wrap">
        <span id="typed3"></span>
      </div>
    </h1>
  </div>

  <div class="bg-dscp" id="concepto">
    <div class="container">
      <div class="row">
        <div class="col-md-5 mt-0 mb-0" id="ocultar2">
          <img src="../c/img/barber.png" height="550">
        </div>
        <div class="col-md-7 col-sm-12" id="pad-onmob2">
          <div class="text-center"><img src="/c/img/mdn/barber/barberpb.png" alt="logo"></div><br>
          <p class="par-concepto text-black">Descripcion</p><br>
        </div>
      </div>
    </div>
  </div>

  <div class="dark-wrapper mb50">
    <div class="container inner">
      <div class="col-md-6">
        <h2 class="two-lines title-services">Servicios Barber Shop</h2>
        <h1 class="just-services">Cortes y Estilos </h1>
        <h1 class="just-services">Tratamiento de Barbas</h1>
        <h1 class="just-services">Servicio de Colorimetría</h1>
        <h1 class="just-services">Rasuradas de Barbas</h1>
        <h1 class="just-services">Otros Servicios</h1>
      </div>
      <div class="col-md-6">
        <h2 class="two-lines title-services">Nuestra Historia</h2>
        <div class="row">
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <div class="row">
          <div class="col-md-8 col-sm-8 col-xs-12 pl-0">
            <img class="marc" src="/c/img/mdn/barber/services-2.jpg">
          </div>
          <div class="col-md-4 col-sm-4 col-xs-12 pr-0">
            <img class="marc" src="/c/img/mdn/barber/services-3.jpg">
          </div>
        </div>
      </div>
    </div>
    <div class="container inner advice-div">
    <h1 class="advice-txt">Lorem ipsum dolor sit amet</h1>
  </div>
  </div> 
  
  <div class="divide30"></div><div class="divide30"></div><div class="divide30"></div>

  <div class="post-parallax parallax inverse-wrapper" style="background-image: url(/c/img/bann-1.jpg);">
    <div class="overlay">
      <div class="container prs-pd">
        <div class="item caption-overlay">
          <div class="row">
            <ul class="text-center">
              <li class="horario"><span class="week-txt">LUN</span> <br> 8:00 - 20:00</li>
              <li class="horario"><span class="week-txt">MAR</span> <br> 8:00 - 20:00</li>
              <li class="horario"><span class="week-txt">MIE</span> <br> 8:00 - 20:00</li>
              <li class="horario"><span class="week-txt">JUE</span> <br> 8:00 - 20:00</li>
              <li class="horario"><span class="week-txt">VIE</span> <br> 8:00 - 20:00</li>
              <li class="horario"><span class="week-txt">SÁB</span> <br> 8:00 - 18:00</li>
              <li class="horario"><span class="week-txt">DOM</span> <br> 10:00 - 18:00</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="dark-wrapper mb50" id="ubicaciones">
    <div class="container inner">
      <div class="row">
        <div class="title-brb text-center mt10">Encuéntranos</div>
        <div class="two-lines2"></div>
        <div class="divide30"></div>
        <div class="col-sm-12">
          <div id="map"></div>  
        </div>
      </div>    
    </div>
  </div>
  
  <div class="light-wrapper">
    <div class="container">
      <div class="row">

        <?php conceptosbar("mod", $language); ?>

        <div class="divide30"></div>
      </div>
    </div>
  </div>
  
</main>

<?php include'../c/footer-barber.php'; ?>
  
</main>

</body>
</html>