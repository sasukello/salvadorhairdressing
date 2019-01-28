<!DOCTYPE html>
<html lang="es_VE">

    <?php 
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "./locale");
      textdomain("salvador_web");
     ?>

<head>
<?php include 'c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Bienvenido a la Excelencia! Salvador Hairdressing es la franquicia en crecimiento lider del sector de belleza en América Latina, con presencia en más de 5 países a lo largo del continenente americano.">
<meta name="author" content="Salvador Hairdressing">
<title>Salvador Hairdressing - <?php echo _('¡Bienvenido a la Excelencia!'); ?></title>

    <?php include 'c/header.php'; ?>    

<style>
.paraabajo{
  bottom: 0px;
  top: 0px;
}
</style>
</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('¡Bienvenido a la Excelencia!'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php include 'c/navbar.php'; ?>

  <div class="tp-fullscreen-container revolution">
    <div class="tp-fullscreen">
      <ul>
        <li data-transition="cube" data-masterspeed="800"> <img src="c/img/main/bg10.jpg"  alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />
        </li>
        <li data-transition="slideleft" data-masterspeed="800"> <img src="c/img/main/bg8.jpg"  alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />
        <li data-transition="incube" data-masterspeed="800"> <img src="c/img/main/bg9.jpg"  alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />
        </li>
        <li data-transition="boxslide" data-masterspeed="800"> <img src="c/img/main/bg7.jpg"  alt="" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" />
        </li>
        </li>
        </li>
      </ul>
      <div class="tp-bannertimer tp-bottom"></div>
    </div>
  </div>

  <div class="row" style="padding-right: 0px;background: #000;">
  <div class="col-md-12">
          <div style="padding-top:10px;padding-bottom: 10px;">
            <div class="cbp-panel">
              <div class="cbp cbp-onepage-grid">
                <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/main/b1-full2.jpg" data-title-id="title-1">
                  <div class="cbp-caption-defaultWrap"> <img src="c/img/main/b12.jpg" alt="" /> </div>
                  <div class="cbp-caption-activeWrap">
                    <div class="cbp-l-caption-alignCenter">
                      <div class="cbp-l-caption-body">
                        <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                      </div>
                    </div>
                  </div>
                  </a> 
                <div id="title-1" class="hidden">
                  <?php echo _('<h3>Tips: Aceite de Argán Salvador</h3>
                  <p>El cabello dañado, normalmente también está seco, especialmente cuando es rizado. Para una hidratación profunda, nuestro Aceite de Argán es el indicado. Le devuelve el brillo a tu cabello sin dejar residuos de grasa.</p>'); ?>
              </div>
            </div>
                  <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/main/b1-full.jpg" data-title-id="title-2">
                  <div class="cbp-caption-defaultWrap"> <img src="c/img/main/b1.jpg" alt="" /> </div>
                  <div class="cbp-caption-activeWrap">
                    <div class="cbp-l-caption-alignCenter">
                      <div class="cbp-l-caption-body">
                        <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                      </div>
                    </div>
                  </div>
                  </a> 
                <div id="title-2" class="hidden">
                  <?php echo _('<h3>¡Llegó el gran día!</h3>
                  <p>Hoy recibimos con felicidad y orgullo el <b>Mara De Oro</b> como Franquicia venezolana con mayor expansión internacional.</p>'); ?>
              </div>
            </div>

            <div class="cbp-item"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="/c/img/main/b3-full2.jpg" data-title-id="title-3">
                  <div class="cbp-caption-defaultWrap"> <img src="c/img/main/b32.jpg" alt="" /> </div>
                  <div class="cbp-caption-activeWrap">
                    <div class="cbp-l-caption-alignCenter">
                      <div class="cbp-l-caption-body">
                        <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                      </div>
                    </div>
                  </div>
                  </a> 
                <div id="title-3" class="hidden">
                <?php echo _('<h3>¡Sé un cliente VIP!</h3>
                <p>Solicita tu ClientCard en tu salón preferido para que te conviertas en un cliente VIP. Acumula puntos que puedes cambiar por descuentos en los servicios.</p><h3 class="text-right"><a href="http://salvadorhairdressing.com/cc/" target="_blank">¡Conoce más aquí!</a></h3>'); ?>
              </div>
            </div>
          </div>
        </div>
  </div>
  </div>
</div>

  <div class="row">
  <div class="dark-wrapper">
    <div class="container inner">
      <div class="thin">
        <?php echo _('<h3 class="section-title text-center">Un mundo, <span style="font-style: underline;">tú mundo</span></h3>'); ?>
      </div>
      <div class="divide10"></div>
      <div class="cbp-panel">
        <div id="js-grid-mosaic" class="cbp">
          <div class="cbp-item print motion"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="c/img/main/5c.jpg"  data-title-id="title-main1">
            <div class="cbp-caption-defaultWrap">
              <div class="fix">
                <img src="c/img/main/5c.jpg" alt="" />
                <div class="desc">
                    <p class="desc_content" style=""><b><?php echo _('Conoce nuestros 6 Modelos de Negocio y Franquicias.'); ?></b></p>
                </div>
              </div>
            </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a>
            <div id="title-main1" class="hidden">
              <?php echo _('<h3>Bienvenido a la Excelencia Salvador</h3>
              <p>¡Celebra nuestro 60° Aniversario con nosotros!</p>
              <p><a href="/modelos/"><b>Conoce aquí todo sobre nuestros Modelos de Negocio y Franquicias.</b></a></p>'); ?>
            </div>
          </div>
          
          <div class="cbp-item print web"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="c/img/main/7b.jpg" data-title-id="title-main2">
            <div class="cbp-caption-defaultWrap">
              <div class="fix">
              <img src="c/img/main/7.jpg" alt="" />
              <div class="desc">
                <p class="desc_content" style=""><b><?php echo _('¡Sé un Mystery Shopper!'); ?></b></p>
              </div>
              </div>
            </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div></a>
            <div id="title-main2" class="hidden">
              <?php echo _('<h3>Sé un Mystery Shopper para Salvador Hairdressing</h3>
              <p>Forma parte de nuestro exclusivo programa de Clientes Misteriosos.</p>
              <p><a href="/mysteryshopper"><b>¡Aplica ahora!</b></a></p>'); ?>
            </div>            
          </div>

            
          <div class="cbp-item print"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="c/img/main/5.jpg" data-title-id="title-main5">
            <div class="cbp-caption-defaultWrap"> 
              <div class="fix">
                <img src="c/img/main/5.jpg" alt="" />
                <div class="desc">
                    <p class="desc_content" style=""><b><?php echo _('¡Programa tu cita con nuestra App para dispositivos móvil!'); ?></b></p>
                </div>
              </div>
            </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> 
          <div id="title-main5" class="hidden">
              <?php echo _('<h3>Conoce todo sobre la App Salvador Hairdressing</h3>
              <p>Programa tus citas con días de antelación, consulta nuestros servicios disponibles, así como el salón Salvador más cerca de tu localidad. ¡Todo desde la palma de tu mano!</p>
              <p><a href="/app"><b>¡Empieza ahora!</b></a></p>'); ?>
            </div></div>
          
          <div class="cbp-item web logo"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="c/img/main/3b.jpg" data-title-id="title-main3">
            <div class="cbp-caption-defaultWrap">
              <div class="fix">
                <img src="c/img/main/3.jpg" alt="" />
                <div class="desc">
                    <p class="desc_content" style=""><b>ClientCard Salvador</b></p>
                </div>
              </div>
              </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a>
            <div id="title-main3" class="hidden">
              <?php echo _('<h3>¿Quieres ser VIP?</h3>'); ?>
              <p><?php  /* xgettext:no-php-format */ echo _('Acumula puntos al tener una ClientCard Salvador, los cuales podrás cambiar por descuentos de hasta el 75% en el pago de tu factura.'); ?></p>
              <p><b><?php echo _('<a href="/cc">¡Conoce más!</a>'); ?></b></p>
            </div>
          </div>
          
          <div class="cbp-item web"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="c/img/main/4d.jpeg" data-title-id="title-main4">
            <div class="cbp-caption-defaultWrap"> 
              <div class="fix">
              <?php echo _('<img src="c/img/main/4c.jpg" alt="" /> 
              <div class="desc">
                    <p class="desc_content" style=""><b>¡Aprende un arte!'); ?></b></p>
                </div>
              </div>
            </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> <div id="title-main4" class="hidden">
              <?php echo _('<h3>Academia Salvador - <i>Aprende un arte</i></h3>
              <p>Formamos estilistas con iniciativas que mejoren la calidad de vida y estilo de los profesionales, bajo el sello del Grupo Salvador.</p>
              <p><b><a href="http://www.salvadoracademy.com" target="_blank">Visitar Web</a></b></p>'); ?>
            </div>
          </div>
          
          <div class="cbp-item print logo"> <a class="cbp-caption fancybox-media" data-rel="portfolio" href="c/img/main/8b.jpg" data-title-id="title-main8">
            <div class="cbp-caption-defaultWrap">
              <div class="fix">
              <img src="c/img/main/8c.jpg" alt="" /> 
              <div class="desc">
                    <p class="desc_content" style=""><b><?php echo _('Esmaltes Salvador Professional'); ?></b></p>
                </div>
              </div>
            </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-title"><span class="cbp-plus"></span></div>
                </div>
              </div>
            </div>
            </a> <div id="title-main8" class="hidden">
              <?php echo _('<h3>Esmaltes Salvador Profesional</h3>
              <p>Conoce los 23 tonos de los nuevos Esmaltes de la línea Salvador Professional.</p>
              <p><b><a href="#">¡Conócelos!</a></b></p>'); ?>
            </div>
          </div>          
        </div>        
      </div>
    </div>
  </div>
  </div>

  <div class="post-parallax parallax inverse-wrapper parallax1" style="background-image: url(c/img/seccion.jpg);">
    <div class="overlay">
    <div class="container inner text-center">
      <div class="headline text-center">
        <div class="col-md-6 col-md-offset-6">  
        <img src="c/img/salvador.png">
      </div>
      </div>
      <!-- /.headline -->
    </div>
    <!--/.container -->
  </div>
  </div>



  <div class="light-wrapper">
    <div class="container inner nopadding-bottom">
      <div class="row">
        <div class="col-md-4">
          <?php include 'c/mininovedades.php'; ?>
        </div>
        <div class="col-md-8">
          <div class="item post">
              <figure class="main sinmargen"><img src="c/img/mapamundi.jpg" alt="" /></figure>
              <div class="box text-center">
                <div class="category cat16"><span class="sinpadding"><?php echo _('<a href="/ubicaciones">Ubicaciones</a>'); ?></span></div>
                <p><div class="meta"><span class="comments"><?php echo _('<a href="/ubicaciones"> Cada vez más cerca de tí</a>'); ?></span></div></p>
              </div>
          </div>
        </div>
      </div> 
    </div>
  </div>


    <?php include 'c/footer.php'; ?>


</body>
</html>