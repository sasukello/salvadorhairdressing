<?php 

  (isset($_GET["lang"]) && !empty($_GET["lang"]) ? $idioma = $_GET["lang"] : $idioma = "es_VE");

  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/library/funciones.php";
  include_once($path);

  $flag = showFlag($idioma);

 ?>

  <div class="navbar paraabajo">
    <div class="navbar-header">
      <div class="basic-wrapper"> 
        <div class="navbar-brand"> <a href="/"><img src="#" srcset="/c/img/60-bs.png 1x, c/img/60-bb.png 2x" class="logo-light" alt="" /></a> </div>
        <a class="btn responsive-menu" data-toggle="collapse" data-target=".navbar-collapse"><i></i></a>
      </div>
    </div>
    <nav class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class=""><?php echo _('<a href="/"><i class="budicon-home"></i></a>'); ?></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle js-activated"><?php echo _('Nosotros'); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php echo _('<li><a href="/nosotros.php">Nuestra Marca</a></li>
            <li><a href="/modelos">Modelos de Negocio</a></li>
            <li><a href="/servicios.php">Nuestros Servicios</a></li>
            <li><a href="/fsmag.php">FS magazine</a></li>
            <li><a href="/salvadoracademy">Salvador Academy</a></li>
            <li><a href="/careers">Trabaja Con Nosotros</a></li>'); ?>
          </ul>
        </li>
        <li class="" style="display:none;"><?php echo _('<a href="http://www.salvadorhairdressing.com/noticias.php">Noticias</a>'); ?>
        <li class=""><?php echo _('<a href="http://www.salvadorhairdressing.com/franquicias.php">Franquicias</a>'); ?>
        </li>
        <li class=""><?php echo _('<a href="/ubicaciones">Ubicaciones</a>'); ?>
        </li>
        <li class=""><?php echo _('<a href="/academy">The Academy</a>'); ?>
        </li>
        <li class=""><?php echo _('<a href="/contacto.php">Contacto</a>'); ?>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle js-activated"><?php echo _('Aplicaciones'); ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><?php echo _('<a href="/app/">Salvador Hairdressing App</a>'); ?></li>
            <li><?php echo _('<a href="/cc">ClientCard</a>'); ?></li>
            <li><?php echo _('<a href="/mysteryshopper">Mystery Shopper</a>'); ?></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle js-activated"><?php echo $flag;?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="javascript:switchlang('es_VE');"><img src="/c/img/lang/langes.png" width="30"> <?php echo _(' Español'); ?> </a></li>
            <li><a href="javascript:switchlang('en_US');"><img src="/c/img/lang/langeng.png" width="30"> <?php echo _(' Inglés'); ?></a></li>
            <li><a href="javascript:switchlang('it_IT');"><img src="/c/img/lang/langit.png" width="30"> <?php echo _(' Italiano'); ?></a></li>
          </ul>
        </li>
        <!--li class=""><?php //echo _('<a href="https://www.salvadorhairdressing.com/shop/barbershop" target="_blank"><i class="budicon-shopping-cart"></i> Boutique</a>'); ?></li-->
      </ul>
    </nav>
  </div></div>