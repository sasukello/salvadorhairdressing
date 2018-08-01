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
<meta name="author" content="">
<link rel="shortcut icon" href="style/images/favicon.png">
<title><?php echo _('Modelos de Negocio'); ?> - Salvador Hairdressing</title>

    <?php include '../c/header.php'; ?>
    <?php include '../library/funciones.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include '../c/navbar.php'; 

      if($language != ""){
        $url = '?lang='.$language;
      }
    ?>
  
<div id="sticky-filter" class="sticky-filter dark-wrapper container">
    <ul>
      <li><a href="#instituto">Instituto de Belleza</a></li>
      <li><a href="#express">Express</a></li>
      <li><a href="#uomo">UOMO</a></li>
      <li><a href="#kids">Kids</a></li>
      <li><a href="#nailsbar">Nailsbar</a></li>
      <li><a href="#beautystore">Beauty Store</a></li>
    </ul>
  </div>

  <section id="instituto" class="light-wrapper">
    <div class="container inner">
      <div class="text-center"><?php echo _('<a href="/modelos/instituto.php">'); ?><img src="/c/img/logos/instituto-logo.png"></a></div>
      <div class="divide20"></div>
      <div class="cbp-panel">
        <div class="cbp cbp-onepage-grid">
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/inst/1.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/inst/1b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            <!--/.cbp-caption-activeWrap --> 
            </a> </div>
          <!--/.cbp-item -->
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/inst/2.jpg">
            <div class="cbp-caption-defaultWrap"><img src="/c/img/mdn/inst/2b.jpg" alt="" /></div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            <!--/.cbp-caption-activeWrap --> 
            </a> </div>
          <!--/.cbp-item -->
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/inst/3.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/inst/3b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            <!--/.cbp-caption-activeWrap --> 
            </a> </div>
          <!--/.cbp-item -->
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/inst/4.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/inst/4b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            <!--/.cbp-caption-activeWrap --> 
            </a> </div>
          <!--/.cbp-item -->
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/inst/5.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/inst/5b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            <!--/.cbp-caption-activeWrap --> 
            </a> </div>
          <!--/.cbp-item -->
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/inst/6.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/inst/6b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            <!--/.cbp-caption-activeWrap --> 
            </a> </div>
          <!--/.cbp-item --> 
          
        </div>
        <!--/.cbp --> 
        
      </div>
      <!--/.cbp-panel --> 
    </div>
    <!-- /.container --> 
  </section>
  <!-- /#conceptual -->


  <section id="express" class="light-wrapper">
    <div class="container inner">
      <div class="text-center"><?php echo _('<a href="/modelos/express.php">'); ?><img src="/c/img/logos/express-logo.png"></a></div>
      <div class="divide20"></div>
      <div class="cbp-panel">
        <div class="cbp cbp-onepage-grid">
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/exp/1.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/exp/1b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/exp/2.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/exp/2b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/exp/3.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/exp/3b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/exp/4.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/exp/4b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/exp/5.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/exp/5b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>          
        </div>
        
      </div>
    </div>
  </section>

  <section id="uomo" class="light-wrapper">
    <div class="container inner">
      <div class="text-center"><?php echo _('<a href="/modelos/uomo.php">'); ?><img src="/c/img/logos/uomologo.png"></a></div>
      <div class="divide20"></div>
      <div class="cbp-panel">
        <div class="cbp cbp-onepage-grid">
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/uomo/1b.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/uomo/1.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/uomo/2b.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/uomo/2.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/uomo/3b.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/uomo/3.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/uomo/4b.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/uomo/4.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/uomo/5b.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/uomo/5.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/uomo/6b.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/uomo/6.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>          
        </div>
        
      </div>
    </div>
  </section>

  <section id="kids" class="light-wrapper">
    <div class="container inner">
      <div class="text-center"><?php echo _('<a href="/modelos/kids.php">'); ?><img src="/c/img/logos/kids-logo.png"></a></div>
      <div class="divide20"></div>
      <div class="cbp-panel">
        <div class="cbp cbp-onepage-grid">
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/kids/1.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/kids/1b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/kids/2.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/kids/2b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/kids/3.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/kids/3b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/kids/4.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/kids/4b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/kids/5.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/kids/5b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>        
        </div>
        
      </div>
    </div>
  </section>

  <section id="nailsbar" class="light-wrapper">
    <div class="container inner">
      <div class="text-center"><?php echo _('<a href="/modelos/nailsbar.php">'); ?><img src="/c/img/logos/nails-logo.png"></a></div>
      <div class="divide20"></div>
      <div class="cbp-panel">
        <div class="cbp cbp-onepage-grid">
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/nails/1.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/nails/1b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/nails/2.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/nails/2b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/nails/3.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/nails/3b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/nails/4.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/nails/4b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/nails/5.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/nails/5b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/nails/6.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/nails/6b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>          
        </div>
        
      </div>
    </div>
  </section>

  <section id="beautystore" class="light-wrapper">
    <div class="container inner">
      <div class="text-center"><?php echo _('<a href="/modelos/beautystore.php">'); ?><img src="/c/img/logos/beauty-logo.png"></a></div>
      <div class="divide20"></div>
      <div class="cbp-panel">
        <div class="cbp cbp-onepage-grid">
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/store/1.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/store/1b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/store/2.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/store/2b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/store/3.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/store/3b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/store/4.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/store/4b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
          
          <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/mdn/store/5.jpg">
            <div class="cbp-caption-defaultWrap"> <img src="/c/img/mdn/store/5b.jpg" alt="" /> </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> </div>
      
        </div>
        
      </div>
    </div>
  </section>

 <?php 
    conceptosbar("nos", $language);

    include '../c/footer.php';

?>

</body>
</html>