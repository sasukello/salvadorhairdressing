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
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="style/images/favicon.png">
<title><?php echo _('Servicios'); ?> - Salvador Hairdressing</title>

    <?php include 'c/header.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">
    <?php include 'c/navbar.php'; ?>



  <div class="tp-fullscreen-container revolution">
    <div class="tp-fullscreen">
      <ul>
        <li data-transition="fade"> <img src="c/img/main/serviciosmodel.jpg"  alt="" data-bgposition="center left" data-bgfit="cover" data-bgrepeat="no-repeat" />
          <h1 class="tp-caption large sfr" data-x="560" data-y="280" data-speed="900" data-start="800" data-easing="Sine.easeOut"><?php echo _('Servicios Exclusivos'); ?></h1>
          <div class="tp-caption medium sfr" data-x="770" data-y="380" data-speed="900" data-start="1500" data-easing="Sine.easeOut"><img src="c/img/salvadorblanco.png"></div>
        </li>
      </ul>
    </div>
    <!-- /.tp-fullscreen-container --> 
  </div>
  <!-- /.revolution -->


  <div class="container servicesclass">
    <div class="tp-fullscreen-container col-md-12 no-padding no-margin" id="cabello">
      <div class="col-md-6 col-sm-6 no-padding no-margin">
        <div class="content">
            <div class="item1">
              <div class="content-overlay1"></div> 
              <img src="c/img/services/cabello3.jpg" style="max-width: 100%;">
              <div class="content-details1 fadeIn-right">
                <h1 class="text-white"><?php echo _('Cabello'); ?></h1>
                <p>
                  <div class="col-md-12 text-left">

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Crea tu propio estilo con los cortes que son tendencia en el mundo de la belleza.">
                        <div class="card card-services">
                          <h4 class="text-white">Corte</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Utilizando productos de calidad alistamos tu cabello para el estilo que prefieras.">
                        <div class="card card-services">
                          <h4 class="text-white">Shampoo</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Luce sensacional con el cabello a tu medida (corto, mediano, largo o extra largo).">
                        <div class="card card-services">
                          <h4 class="text-white">Secado</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Profesionales especializados en peinados para toda ocasión.">
                        <div class="card card-services">
                          <h4 class="text-white">Peinado</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Tendencias en ondas permanentes, según sea tu estilo.">
                        <div class="card card-services">
                          <h4 class="text-white">Permanente</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Coloración para todos los estilos, con los mejores productos del mercado.">
                        <div class="card card-services">
                          <h4 class="text-white">Tinte</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Cambia tu look con el mejor High lights y luce radiante en todo momento.">
                        <div class="card card-services">
                          <h4 class="text-white">Mechas</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Si tienes tu estilo, tenemos las más innovadoras técnicas para lograr lisos impactantes.">
                        <div class="card card-services">
                          <h4 class="text-white">Desriz</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Tu cabello maltratado ya no es un problema, confía en la experiencia de nuestros profesionales.">
                        <div class="card card-services">
                          <h4 class="text-white">Tratamientos</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Protege el cabello en el uso de herramientas térmicas, este tratamiento reproduce los efectos de la queratina en el cabello.">
                        <div class="card card-services">
                          <h4 class="text-white">Thermolisis</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Con productos reconocidos a nivel mundial, realizamos innovadores tratamientos de queratina.">
                        <div class="card card-services">
                          <h4 class="text-white">Kerathermi</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Juego de luces y sombras que crean profundidad, volumen y texturas en tu cabello.">
                        <div class="card card-services">
                          <h4 class="text-white">Coloración Técnica</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Técnicas para lisos extremos.">
                        <div class="card card-services">
                          <h4 class="text-white">Planchado</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-6 info-services2">
                      <?php echo _('<a href="#cabello" data-toggle="tooltip" title="Tratamientos fortificantes anti-rotura para cabellos frágiles proporcionando fuerza a la fibra capilar.">
                        <div class="card card-services">
                          <h4 class="text-white">Tratamiento Antiquiebre</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                  </div>
                  <!-- /.box --> 
                </p>
              </div>
            </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 no-padding no-margin" id="manos">
        <div class="content">
            <div class="item1">
              <div class="content-overlay1"></div> 
              <?php echo _('<img src="c/img/services/manos1.jpg" style="max-width: 100%;">'); ?>
              <div class="content-details1 fadeIn-left">
                <h1 class="text-white"><?php echo _('Manos y Pies'); ?></h1>
                <p>
                  <div class="col-md-12 text-left">
                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#manos" data-toggle="tooltip" title="Luce uñas y manos perfectas con nuestras técnicas de manicure.">
                        <div class="card card-services">
                          <h4 class="text-white">Mant. de Uñas</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#manos" data-toggle="tooltip" title="Diferentes técnicas que te hacen lucir diferente, sistema de uñas en gel, esculpidas, baño en resina.">
                        <div class="card card-services">
                          <h4 class="text-white">Sistema de Uñas</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#manos" data-toggle="tooltip" title="Cambia el look de tus uñas cada semana con los colores y los esmaltes que prefieras.">
                        <div class="card card-services">
                          <h4 class="text-white">Cambio de Esmalte</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#manos" data-toggle="tooltip" title="El tradicional sistema de uñas también encuéntralos aquí.">
                        <div class="card card-services">
                          <h4 class="text-white">Uñas Postizas</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#manos" data-toggle="tooltip" title="Cuida tu sistema cada cierto tiempo, con nuestro mantenimiento de uñas.">
                        <div class="card card-services">
                          <h4 class="text-white">Adicionales</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#manos" data-toggle="tooltip" title="Desde lo más chic hasta las decoraciones más clásicas.">
                        <div class="card card-services">
                          <h4 class="text-white">Decoraciones</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#manos" data-toggle="tooltip" title="Cuidado para tus pies con tratamientos especiales.">
                        <div class="card card-services">
                          <h4 class="text-white">Pedi Spa</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                  </div>
                  <!-- /.box --> 
                </p>
              </div>
            </div>
        </div>
      </div>
    </div>
    <!--/.tp-fullscreen-container --> 
  </div>

  <div class="container servicesclass">
    <div class="tp-fullscreen-container col-md-12 no-padding no-margin" id="depilacion">
      <div class="col-md-6 col-sm-6 no-padding no-margin">
        <div class="content">
            <div class="item1">
              <div class="content-overlay1"></div> 
              <?php echo _('<img src="c/img/services/depilacion.jpg" style="max-width: 100%;">
              <div class="content-details1 fadeIn-right">
                <h1 class="text-white">Depilación</h1>'); ?>
                <p>
                  <div class="col-md-12 text-left">

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Axilas perfectas y sin vellos en sólo 5 minutos.">
                        <div class="card card-services">
                          <h4 class="text-white">Axila</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Técnica de pinzas o cera, para una delineación perfecta.">
                        <div class="card card-services">
                          <h4 class="text-white">Cejas</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Labios sensuales y sin vellos.">
                        <div class="card card-services">
                          <h4 class="text-white">Bozo</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Tratamiento de cera caliente que alivia los dolores de las manos y pies. También tiene el beneficio de suavizar la piel.">
                        <div class="card card-services">
                          <h4 class="text-white">Parafinas</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Elimina los vellos que crecen en la barbilla y que recubren esa parte de la cara.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Mentón</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Distintas técnicas depilatorias, para depilar los vellos indeseados de las orejas y el interior de nariz.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Nariz y Orejas</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Un rostro sin vellos es sinónimo de higiene y perfección.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Cara</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Luce una sexi línea del bikini con nuestra depilación exacta.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Ingle</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Los vellos de las piernas ya no son un problema, tenemos las más novedosas técnicas de depilación de piernas completas o media pierna.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Piernas</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Depilación de la línea de vellos que sobresale del bikini.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Semi Ingle</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Elige la que te haga sentir más femenina y sexy.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Línea del Bikini</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Resulta muy importante  en algunas épocas del año, pues es una de las zonas visibles del cuerpo en la playa.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Barriga</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Para quienes desean los brazos libres de vellos.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Brazos</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="En el rostro también aparecen incómodos pelitos que nos pueden jugar malas pasadas. Elimínelos ya.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Rostro</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="La imagen del hombre depilado, cada vez está más de moda. Elimina los vellos de tus pectorales.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Pecho</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Elimina los vellos que aparecen en la espalda.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Espalda</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Depilación de vellos en la zona del abdomen.">
                        <div class="card card-services">
                          <h4 class="text-white">Depilación de Abdomen</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Porque ellos buscan una barba perfecta.">
                        <div class="card card-services">
                          <h4 class="text-white">Facial</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                  </div>
                  <!-- /.box --> 
                </p>
              </div>
            </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 no-padding no-margin" id="rostro">
        <div class="content">
            <div class="item1">
              <div class="content-overlay1"></div> 
              <?php echo _('<img src="c/img/services/rostro.jpg" style="max-width: 100%;">
              <div class="content-details1 fadeIn-left">
                <h1 class="text-white">Rostro</h1>'); ?>
                <p>
                  <div class="col-md-12 text-left">

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Mejora el aspecto de tu piel eliminando los famosos “puntos negros” o “barritos” que se van acumulando con el tiempo.">
                        <div class="card card-services">
                          <h4 class="text-white">Limpieza de Cutis</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Consigue un rostro perfecto para toda ocasión con nuestros profesionales de la belleza.">
                        <div class="card card-services">
                          <h4 class="text-white">Maquillaje</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Técnica empleada para corregir la forma de las cejas, no de un modo definitivo pero sí durante varios años.">
                        <div class="card card-services">
                          <h4 class="text-white">Cejas Permanentes</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Logra una definición perfecta en tus cejas, haciendo que la ceja se vea poblada y uniforme.">
                        <div class="card card-services">
                          <h4 class="text-white">Cejas Semi-Permanentes</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Es un tratamiento de masaje no invasivo, que mejora el estado de nuestro rostro, reduciendo la retención de líquidos.">
                        <div class="card card-services">
                          <h4 class="text-white">Drenaje Linfático Facial</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Logra una piel sana, limpia y radiante con nuestro tratamiento de hidratación">
                        <div class="card card-services">
                          <h4 class="text-white">Hidratación</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Soluciones integrales para combatir el acné, eligiendo el procedimiento que más se ajuste a tu tipo de piel.">
                        <div class="card card-services">
                          <h4 class="text-white">Anti-Acné</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Tendencia de tratamientos anti-arrugas, utilizando técnicas  que te ayuden a combatir los signos de la edad.">
                        <div class="card card-services">
                          <h4 class="text-white">Anti-Edad</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                  </div>
                  <!-- /.box --> 
                </p>
              </div>
            </div>
        </div>
      </div>
    </div>
    <!--/.tp-fullscreen-container --> 
  </div>

  <div class="container servicesclass">
    <div class="tp-fullscreen-container col-md-12 no-padding" id="depilacion">
      <div class="col-md-6 col-sm-6 no-padding no-margin">
        <div class="content">
            <div class="item1">
              <div class="content-overlay1"></div> 
              <?php echo _('<img src="c/img/services/masajes.jpg" style="max-width: 100%;">
              <div class="content-details1 fadeIn-right">
                <h1 class="text-white">Masajes</h1>'); ?>
                <p>
                  <div class="col-md-12 text-left">

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Logra hidratación, una piel más densa y más nutrida. Tiene efectos anticelulíticos, ayuda contra el estrés y mejora la elasticidad de tu piel.">
                        <div class="card card-services">
                          <h4 class="text-white">Choco-Terapia</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Excelente para limpiar y purificar tu piel, el vino ayuda a estimular la circulación, reducir el abdomen y reafirmar los glúteos.">
                        <div class="card card-services">
                          <h4 class="text-white">Vino-Terapia</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Tratamiento a base de agua del mar. Mejora el sistema inmunológico, la circulación e  hidratación de la piel.">
                        <div class="card card-services">
                          <h4 class="text-white">Talaso-Terapia</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Masaje a base de cañas de bambú, logrando la relajación física, combate el cansancio y el agotamiento; remodela la silueta; elimina la celulitis, y mejora la circulación.">
                        <div class="card card-services">
                          <h4 class="text-white">Bambú-Terapia</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="El Masaje a base de coco es un excelente elemento hidratante y relajante. Su ralladura es perfecta para exfoliar y el  aceite de coco es un gran lubricante para el cuerpo.">
                        <div class="card card-services">
                          <h4 class="text-white">Coco-Terapia</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Esta técnica consiste en pequeños golpes enérgicos en las zonas afectadas como el abdomen, los muslos, los glúteos o las caderas. Reduce el volumen y grasa localizada.">
                        <div class="card card-services">
                          <h4 class="text-white">Masajes para Flacidez</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Olvídate de la piel de naranja. Realiza este tratamiento que acompañamos de productos eficaces para eliminar la celulitis.">
                        <div class="card card-services">
                          <h4 class="text-white">Masajes Anticelulítico</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Acción manual para mejorar tu energía y activando sensaciones  en emocional, mental, espiritual.">
                        <div class="card card-services">
                          <h4 class="text-white">Masajes Anti-Stress Energético</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#depilacion" data-toggle="tooltip" title="Tratamiento de exfoliación corporal con masaje hidratante.">
                        <div class="card card-services">
                          <h4 class="text-white">Masaje Hidratante con Exfoliación</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                  </div>
                  <!-- /.box --> 
                </p>
              </div>
            </div>
        </div>
      </div>
      <div class="container col-md-6 col-sm-6 no-padding no-margin" id="rostro">
        <div class="content">
            <div class="item1">
              <div class="content-overlay1"></div> 
              <?php echo _('<img src="c/img/services/domicilio2.jpg" style="max-width: 100%;">
              <div class="content-details1 fadeIn-left">
                <h1 class="text-white">Servicios a Domicilio</h1>'); ?>
                <p>
                  <div class="col-md-12 text-left">

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Crea tu propio estilo con los cortes que son tendencia en el mundo de la belleza.">
                        <div class="card card-services">
                          <h4 class="text-white">Corte</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Consigue un rostro perfecto para toda ocasión con nuestros profesionales de la belleza.">
                        <div class="card card-services">
                          <h4 class="text-white">Maquillaje</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Luce uñas y manos perfectas con nuestras técnicas de manicure.">
                        <div class="card card-services">
                          <h4 class="text-white">Manicure</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Cuidado para tus pies con tratamientos especiales.">
                        <div class="card card-services">
                          <h4 class="text-white">Pedicure</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Luce sensacional con el cabello a tu medida (corto, mediano, largo o extra largo).">
                        <div class="card card-services">
                          <h4 class="text-white">Secado</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Técnica de pinzas o cera, para una delineación perfecta.">
                        <div class="card card-services">
                          <h4 class="text-white">Cejas</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                    <div class="col-md-6 info-services2">
                      <?php echo _('<a href="#rostro" data-toggle="tooltip" title="Consigue un rostro perfecto para una ocasión especial con nuestros profesionales de la belleza.">
                        <div class="card card-services">
                          <h4 class="text-white">Maquillaje para Novia</h4> 
                        </div>
                      </a>'); ?>
                    </div>

                  </div>
                  <!-- /.box --> 
                </p>
                <br>
                <a target="_blank" href="http://salvadorstore.com/store/ve/"><button type="button" class="btn btn-default botoncomprar">
                  <div class="col-md-9 col-sm-9 col-xs-9"><i class="budicon-shopping-cart buy-boton"></i> <?php echo _('Solicitar'); ?></div>
                </button></a>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  
   <?php include 'c/footer.php'; ?>

</body>
</html>