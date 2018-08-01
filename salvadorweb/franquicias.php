<!DOCTYPE html>
<html lang="es_VE">

    <?php 
      $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
      putenv("LC_ALL=$language");
      setlocale(LC_ALL, $language);
      bindtextdomain("salvador_web", "./locale");
      textdomain("salvador_web");

      if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['e'])) {
          $error = $_GET["e"];
         }
      }
     ?>

<head>
  <?php include 'c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title><?php echo _('Franquicias'); ?> - Salvador Hairdressing</title>
  <?php 
  $ubi = "contacto";
  include 'c/header.php'; ?>

</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php 
      include 'c/navbar.php'; 
      include 'library/formularios.php'; 
    ?>
  
    <div class="image-container set-full-height background-contact">

      <?php 

        if (isset($error)) {
          if ($error == 'success') {
            include 'c/html/fq-gracias.php'; 
          } elseif ($error == 'fail') {
            include 'c/html/fq-error.php'; 
          }
        } else {
          include 'c/html/franquicia.php'; 
        }

      ?>

  </div>
  
<?php include 'c/footer.php'; ?>

  <script type="text/javascript">
    $(document).ready(function () {
      //Initialize tooltips
      $('.nav-tabs > li a[title]').tooltip();
      
      //Wizard
      $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
          var $target = $(e.target);
          if ($target.parent().hasClass('disabled')) {
              return false;
          }
      });

      $(".franq1").click(function (e) {
          var tf = validate_empty('tipo');

          if (tf == 1) {
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
          }
      });
      $(".franq2").click(function (e) {
          var ci = validate_empty('ci');
          var nombre = validate_empty('nombre');
          var apellido = validate_empty('apellido');
          var ffnn = validate_empty('ffnn', 'language');
          var direccion = validate_empty('direccion');
          var pais = validate_empty('pais');
          var estado = validate_empty('estado');
          var ciudad = validate_empty('ciudad');
          var telf = validate_empty('telf');
          var movil = validate_empty('movil');
          var correo = validate_empty('correo');
          var nivel = validate_empty('nivel');

          if (ci == 1 && nombre == 1 && apellido == 1 && ffnn == 1 && direccion == 1 && pais == 1 && estado == 1 && ciudad == 1 && telf == 1 && movil == 1 && correo == 1 && nivel == 1) {
            var $active = $('.wizard .nav-tabs li.active');
            $active.next().removeClass('disabled');
            nextTab($active);
          }
      });
      $(".prev-step").click(function (e) {
          var $active = $('.wizard .nav-tabs li.active');
          prevTab($active);
      });
    });

    function nextTab(elem) {
        $(elem).next().find('a[data-toggle="tab"]').click();
    }
    function prevTab(elem) {
        $(elem).prev().find('a[data-toggle="tab"]').click();
    }
  </script>
  <script src="/c/js/materialize.js"></script>
  <script src="/c/js/picker.date.js"></script>
  <script type="text/javascript">
     $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15, // Creates a dropdown of 15 years to control year,
      today: 'Hoy',
      clear: 'Limpiar',
      close: 'Aceptar',
      closeOnSelect: false // Close upon selecting a date,
    });      
  </script>

</body>
</html>