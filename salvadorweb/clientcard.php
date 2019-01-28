<!DOCTYPE html>
<html lang="es_VE">

    <?php 
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "locale");
      textdomain("salvador_web");
     ?>

<head>
<?php include 'c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title>Salvador Academy - Salvador Hairdressing</title>

    <?php include 'c/header.php'; ?>
    <?php include 'library/funciones.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include 'c/navbar.php'; ?>


  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(/c/img/salvadoracademy/main-section.jpg);">
    <div class="overlay">
    <div class="container inner text-center">
      <div class="headline text-center">
        <h2><?php echo _('ClientCard'); ?></h2>
      </div>
      <!-- /.headline --> 
      <div class="item caption-overlay">
        <div class="caption bottom-left">
          <div class="layer box">
            <h4 class="post-title text-right">
              <i class="budicon-scissors icon-main"></i> <?php echo _('¡Aprende un Arte, Sé un Profesional!'); ?>
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
        <span class="text-center"><h1 id="bienvenido">Bienvenido</h1></span>
          <div class="col-md-4 box-text">
            <div class="box text-center">
              <h3 class="descripcion wow fadeInDown delay-03s"><i class="size-icon fa fa-id-card" aria-hidden="true"></i> Client Card</h3>
              <p class="parrafo wow fadeInDown delay-03s">Es una tarjeta de identificación de Salvador Hairdressing. Esta tarjeta facilita el reconocimiento de los gustos y preferencias del usuario, al tiempo que este se beneficia con la acumulación de puntos que podrán ser canjeados por servicios en próximas visitas.</p>
            </div>
          </div>
          <div class="col-md-4 box-text">
            <div class="box text-center">
              <h3 class="descripcion wow fadeInDown delay-06s"><i class="size-icon fa fa-question-circle" aria-hidden="true"></i> ¿Cómo la obtengo?</h3>
              <p class="parrafo wow fadeInDown delay-06s">Por tiempo limitado, en tu visita a nuestros salones ya puedes obtener nuestra exclusiva ClientCard. Solo visita Salvador Hairdressing en cualquiera de nuestras Unidades de Negocio, luego de facturar algún servicio, te será entregada la tarjeta ClientCard.</p>
            </div>
          </div>
          <div class="col-md-4 box-text">
            <div class="box text-center">
              <h3 class="descripcion wow fadeInDown delay-09s"><i class="size-icon far fa-arrow-alt-circle-up" aria-hidden="true"></i> Acumular puntos</h3>
              <p class="parrafo wow fadeInDown delay-09s">Por cada visita acumulas puntos que luego serán canjeados por servicios en nuestras Unidades de Negocio, o acumula puntos pidiendo una cita desde tu hogar con nuestro servicio de belleza a domicilio. Cuanto más la utilizas, más sumas, más ganas, más beneficios para ti.</p>
            </div>
          </div>
      </div>
    </div>

    <style type="text/css">
      .size-icon{
        font-size: 30px;
        vertical-align: middle;
        padding-right: 10px;
      }
      .pl-0{
        padding-left: 0px!important;
      }
      .cc-bg{
        background-color: #00000080;
      }
      #form-first-name, #form-password, #form-email{
        background-color: #fff;
        color: #000;
      }
      .icc{
        float: right;
      }
    </style>

  <div class="post-parallax parallax inverse-wrapper" style="background-image: url(/c/img/bg-cc.jpg);">
    <div class="overlay">
      <div class="container inner2 prs-pd">
        <div class="item caption-overlay">
          <div class="row">
            
              <div class="col-md-6 blog-content">
                <div class="item post">
                      
                  <div class="box cc-bg text-center" style="margin-right: 50px;">
                    <h1>¿Primera Vez?  <i class="icc fas fa-pencil-alt"></i></h1>

                    <h4 class="post-title"><small><strong><?php echo _('¡Regístrate y sé un cliente VIP!'); ?></strong></small></h4>
                    
                    <div>
                      <p style="font-size: 16px; text-align: justify;"><br><?php echo _('Ingresa el número de tu Salvador <b>ClientCard</b> para comenzar el proceso de registro:'); ?></p>
                      <form role="form" action="" method="post" class="registration-form">
                          <div class="form-group">
                              <label class="sr-only" for="form-first-name">Serial de la ClientCard</label>
                              <input type="text" name="ccnumero" placeholder="Serial de la ClientCard..." value="" class="form-first-name form-control" id="form-first-name" required>
                          </div>
                          <input type="submit" class="btn" name="submitIndex" value="Registrar">
                          <?php echo"<br><span></span>";
                          if (isset($msg2) && ($msg2 != "")) {
                                    echo '<br><div class="alert alert-warning">' . $msg2 . '</div>'; 
                                } ?>
                      </form>
                    </div>
                  </div>            
                </div>  
              </div>

              <div class="col-md-6 blog-content">
                <div class="item post">
                  <div class="box cc-bg text-center" style="margin-left: 50px;">
                    <h1>¿Ya Tienes Cuenta? <i class="icc fas fa-lock"></i></h1>
                    <h4 class="post-title"><small><strong><?php echo _('¡Inicia sesión con tu cuenta y maneja tus datos!'); ?></strong></small></h4>
                    <div>
                      <p style="font-size: 16px; text-align: justify;"><br><?php echo _('Ingresa el número de tu Salvador <b>ClientCard</b> para comenzar el proceso de registro:'); ?></p>
                      <form role="form" action="index.php" method="post" class="login-form">
                          <div class="form-group">
                              <label class="sr-only" for="usuario">Correo Eléctronico</label>
                              <input type="text" name="usuario" placeholder="Correo Eléctronico..." class="form-email form-control" id="form-email">
                          </div>
                          <div class="form-group">
                              <label class="sr-only" for="password">Contraseña</label>
                              <input type="password" name="password" placeholder="Contraseña..." class="form-password form-control" id="form-password">
                          </div>
                              <button type="submit" class="btn" name="postlogin">Entrar</button>
                              <?php
                              if (isset($msg) && ($msg != "")) {
                                  echo '<br><div class="alert alert-warning">' . $msg . '</div>'; 
                              }
                          ?>
                      </form>
                    </div>
                  </div>            
                </div>  
              </div>  

          </div>
        </div>
      </div>
    </div>
  </div>


 <?php 
    include 'c/footer.php';
?>
</body>
</html>