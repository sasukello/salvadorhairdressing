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
<title>Salvador Academy - Salvador Hairdressing</title>

    <?php include '../c/header.php'; ?>
    <?php include '../library/funciones.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include '../c/navbar.php'; ?>


  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(/c/img/salvadoracademy/main-section.jpg);">
    <div class="overlay">
    <div class="container inner text-center">
      <div class="headline text-center">
        <h2><?php echo _('Salvador Academy'); ?></h2>
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
    <div class="container inner2 nopadding-bottom">
      <div class="blog row">
        <div class="col-md-4 blog-content">

          <div class="item post">
            <figure class="main marginbt0"><img src="/c/img/salvadoracademy/section.jpg" alt="" /></figure>
            <div class="box text-center">
              <div class="category cat16"><span><a target="_blank" href="//salvadoracademy.com/"><h3 class="marginbt0 text-white">
                <?php echo _('¡Inscríbete ya!'); ?></h3></a></span></div>
              <h4 class="post-title"><br><small><strong><i><?php echo _('¡Aprende un Arte, Sé un Profesional!'); ?></i></strong></small></h4>
              <p style="font-size: 16px;"><br><?php echo _('Nuestra Misión es Liderizar en el mercado de la capacitación y formación de capital humano, con sello de excelencia, en servicios de belleza integral, con iniciativas innovadoras que mejoren la calidad de vida y estilo de los profesionales.'); ?></p>
            </div>            
          </div>  
        </div>

        <div class="col-md-7 col-md-offset-1 ">

          <div class="item post">
            <div class="row" style="margin-top: 20px;">

              <div class="box text-center">
                <div class="category cat16"><span class="sinpadding"><a href="#"><?php echo _('Cursos Destacados'); ?></a></span></div>
                <p><div class="meta"><?php echo _('Consulta nuestras ofertas más populares entre nuestros estudiantes:'); ?></div>
                <div class="col-md-6 text-center publicidad">
                <div class="item caption-overlay"><img class="imagen-pub" src="/c/img/salvadoracademy/barberia.jpg" alt="" />
                  <div class="caption bottom-left box-center">
                    <div class="text-center pubcaption2">
                      <a target="_blank" href="http://salvadoracademy.com/programas/index.php">
                        <span class="text-center">
                          <h2 class="no-margin pubinfo">
                            <span class="subtitle-pub"><?php echo _('Barbería'); ?></span>
                          </h2>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
             <div class="col-md-6 text-center publicidad">
                <div class="item caption-overlay"><img class="imagen-pub" src="/c/img/salvadoracademy/maquillaje.jpg" alt="" />
                  <div class="caption bottom-left box-center">
                    <div class="text-center pubcaption2">
                      <a target="_blank" href="http://salvadoracademy.com/programas/index.php">
                        <span class="text-center">
                          <h2 class="no-margin pubinfo">
                            <span class="subtitle-pub"><?php echo _('Maquillaje'); ?></span>
                          </h2>
                        </span>
                      </a>
                    </div>
                  </div>
                </div>
              </div></p>
              </div>
            </div>


          </div>
        </div>

        
        </div>
      </div>
    </div>

<div class="offset"></div>
 <?php 
    include '../c/footer.php';
?>
</body>
</html>