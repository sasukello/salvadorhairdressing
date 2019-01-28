<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="style/images/favicon.png">
<title>App - Salvador Hairdressing</title>

    <?php include '../c/header.php'; ?>
    <?php include '../library/funciones.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload">Cargando</div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include '../c/navbar.php'; ?>


  <div class="tp-fullscreen-container revolution">
    <div class="tp-fullscreen">
      <ul>
        <li data-transition="fade"> <img src="/c/img/bg1.jpg"  alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />
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
        <div class="text-center title-app">
          <h1>Explora, Descubre y Vive la belleza, con la nueva App de Salvador Hairdressing.</h1>
          
          
        </div>
        <div class="col-md-12">
        <div class="col-md-4 padding3top">
          <img src="/c/img/app.png">
        </div>
        <div class="col-md-8 blog-content padding3top">
          <h2 class="text-center">Beneficios</h2>
          <div class="blog-posts classic-view">
            <div class="col-md-6 post">
              <div class="box text-center">
                <h3 class="post-title padding-bottom3"><i class="budicon-date-1 icon-main"></i>Sistema de Citas</h3>
                <div class="post-content text-left">
                  <p>Al descargar nuestra App para teléfonos inteligentes "Salvador Hairdressing", tendrás acceso a nuestro exclusivo sistema de citas.</p>
                </div>
                <!-- .post-footer --> 
              </div>
              <!-- /.box --> 
            </div>

            <div class="col-md-6 post">
              <div class="box text-center">
                <h3 class="post-title padding-bottom3"><i class="budicon-bell icon-main"></i>Notificaciones</h3>
                <div class="post-content text-left">
                  <p>Recibe notificaciones de nuestras promociones, descuentos y precios especiales, mediante notificaciones push en la aplicación.</p>
                </div>
                <!-- .post-footer --> 
              </div>
              <!-- /.box --> 
            </div>

            <div class="col-md-6 post">
              <div class="box text-center">
                <h3 class="post-title padding-bottom3"><i class="budicon-mail icon-main"></i>Contacto</h3>
                <div class="post-content text-left">
                  <p>Dentro de la aplicación encontrarás nuestro formulario de contacto donde podrás enviar tus comentarios, sugerencias o reclamos, para ayudarnos a mantener nuestro nivel de calidad.</p>
                </div>
                <!-- .post-footer --> 
              </div>
              <!-- /.box --> 
            </div>

            <div class="col-md-6 post">
              <div class="box text-center">
                <h3 class="post-title padding-bottom3"><i class="budicon-cash-dollar icon-main"></i>Descuento</h3>
                <div class="post-content text-left">
                  <p>Al programar tu primera cita mediante nuestra aplicación, podrás obtener un 50% de descuento en el servicio reservado, solo aplica para esa primera cita.</p>
                </div>
                <!-- .post-footer --> 
              </div>
              <!-- /.box --> 
            </div>

          </div>
          <!-- /.classic-view -->          
        </div>
        <!-- /.blog-content -->   
        </div>
        
      </div>
      <!-- /.blog --> 
      <div class="padding3top padding-bottom3 text-center"><h3>Salvador Hairdressing se complace en acercarte más a nuestros servicios simplificando tu vida.</h3></div>
    </div>
    <!--/.container --> 
  </div>
  <!--/.dark-wrapper -->

 <?php 

    include '../c/footer.php';

?>

</body>
</html>