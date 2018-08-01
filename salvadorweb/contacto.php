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
<title><?php echo _('Contáctanos'); ?> - Salvador Hairdressing</title>
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
            include 'c/html/gracias.php'; 
          } elseif ($error == 'fail') {
            include 'c/html/error.php'; 
          }
        } else {
          include 'c/html/contacto.php'; 
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

    $(".boton1").click(function (e) {
        var name = validate_empty('name');
        var lastname = validate_empty('lastname');
        var phone = validate_empty('phone');
        var email = validate_empty('email');

        if (name == 1 && lastname == 1 && phone == 1 && email == 1) {
          var $active = $('.wizard .nav-tabs li.active');
          $active.next().removeClass('disabled');
          nextTab($active);
        } 
    });
    $(".boton2").click(function (e) {
        var date = validate_empty('txtBirth');
        var country = validate_empty('country');
        var salon = validate_empty('salon');

        if (date == 1 && country == 1 && salon == 1) {
          var $active = $('.wizard .nav-tabs li.active');
          $active.next().removeClass('disabled');
          nextTab($active);
        }  
    });
    $(".boton3").click(function (e) {
        /*var group1 = validateN_empty('group1');
        var group2 = validateN_empty('group2');
        var group3 = validateN_empty('group3');
        var group4 = validateN_empty('group4');*/
        var comments = validate_empty('comments', 'language');

        if (comments == 1) {
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