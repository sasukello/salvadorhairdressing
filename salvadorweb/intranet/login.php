<?php 
error_reporting(1);
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['intra_uno'])) {
      include_once "sec/libfunc.php";
      $tipo = $_POST["tipo"];
        if ($tipo == 'a') {
          $user = $_POST["name"];
          $pass = $_POST["passw"];
        }
     }
  }
?>
<!DOCTYPE html>
<html lang="es_VE">

    <?php        
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "../locale");
      textdomain("salvador_web");
     ?>

<head>
<?php include '../c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title><?php echo _('Intranet'); ?> - Salvador Hairdressing</title>

    <?php include '../c/header.php'; ?>
    <?php include '../library/franquicias.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include '../c/navbar.php'; ?>

  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(componentes/images/bg/bg7b.jpg);">
    <div class="overlay">
    <div class="container inner text-center">
      <div class="headline text-center">
        <h2><?php echo _('Intranet'); ?></h2>
      </div>
      <!-- /.headline --> 
      <div class="item caption-overlay">
        <div class="caption bottom-left">
          <div class="layer box">
            <h4 class="post-title text-right">
              <i class="budicon-cloud-upload icon-main"></i> <?php echo _('¡Bienvenido!'); ?>
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
        <div class="col-md-5">
            <div class="signup-header wow fadeInUp">
                <h3 id="ingresaemail" class="form-title text-center"><strong>INGRESA TU LOGIN CORPORATIVO</strong></h3>
                <form class="form-header" role="form" action="login.php" method="POST" id="ms_email">
                 <?php if(isset($msg)){
                     echo "<div class='alert alert-danger'><strong>$msg</strong>.</div>";
                }?>
                    <div class="form-group">
                        <input class="form-control input-lg" name="name" id="name" type="text" placeholder="Ingresa tu usuario" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control input-lg" name="passw" id="passw" type="password" placeholder="Ingresa tu contraseña" required>
                    </div>
          <input type="hidden" name="tipo" value="a">
                    <div class="form-group last">
                        <input type="submit" name="intra_uno" class="btn btn-warning btn-block btn-lg" value="ENTRAR">
                    </div><br>
                </form>
            </div>        
        </div>
        <div class="col-md-offset-1 col-md-6">
            <!-- /.main -->
            <h1 class="logo wow fadeInLeft">
                ¿Qué puedo hacer en la <i>Intranet</i>?
            </h1>
            <!-- /.header -->
            <div class="landing-text wow fadeInUp">
                <p>En la intranet de Salvador Hairdressing, tendrás acceso a una variedad de herramientras desarrolladas para facilitar el manejo de tu franquicia.</p>
                <p>Consulta en vivo los reportes de ventas, clientes, asociados e inventario de tus franquicias desde cualquier lugar del mundo.</p>
            </div>          
        </div>
        
      </div>
    </div>
  </div>

 <?php 
    include '../c/footer.php';
  ?>

</body>
</html>