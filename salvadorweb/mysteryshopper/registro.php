<?php
/*
 * Plantilla donde se le pide al usuario Rellenar el formularios con sus datos personales.
 */
ob_start();
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user="";
$estado="";
include '../sitio/sec/ms/libfunc.php';
//include "funcionesMistery/funciones.php";

if (isset($_GET["e"])) {
    $estado = $_GET["e"];
    if($estado == 2){
        $msg = "<div class='alert alert-danger'>Las Contraseñas ingresadas <strong>no coinciden</strong>.</div>";
    }
}else if(isset ($_GET["uu"])){
    $user = base64_decode($_GET["uu"]);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['pasotres'])) {
        procesoRegistro();
    }
}
  $language = (isset($_REQUEST["lang"])) ? trim(strip_tags($_REQUEST["lang"])) : "es_VE";
  putenv("LC_ALL=$language");
  setlocale(LC_ALL, $language);
  bindtextdomain("salvador_web", "../locale");
  textdomain("salvador_web");

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['e'])) {
      $error = $_GET["e"];
    }
  }
 ?>
<!DOCTYPE html>
<html lang="es_VE">
<head>
<?php include '../c/ganalytics.html'; ?>  
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="UX WEB VE">
<title><?php echo _('Mystery Shopper: Registro de usuario'); ?> - Salvador Hairdressing</title>
  <?php 
  $ubi = "registroms";
  include '../c/header.php'; ?>
</head>
<body>
<div id="preloader"><div class="textload"><?php echo _('Cargando'); ?></div><div id="status"><div class="spinner"></div></div></div>
<main class="body-wrapper">
  <div class="row">

    <?php 
      include '../c/navbar.php'; 
      include '../library/formularios.php'; 
    ?>
  
    <div class="image-container set-full-height background-contact">
	   <style type="text/css">
  input[type="checkbox"], input[type="radio"]{
    display: none;
  }
</style>

<!--   Big container   -->
      <div class="container margin-contact">
          <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 mb-0">
              <div class="wizard">
                  <div class="text-center pt-50">
                      <h2 class="mb-5"><?php echo _('Formulario de Registro'); ?></h2>
                      <p class="mb-0"><?php echo _('Ayudanos a mejorar nuestros servicios. Haznos llegar tus comentarios.'); ?></p>
                  </div>
                   <form action="" method="POST">
                     <input type="hidden" name="u" value="503bdae81fde8612ff4944435">
                     <input type="hidden" name="id" value="bfdba52708">
 
                      <div class="tab-content">
                          <div class="tab-pane active" role="tabpanel" id="step1">
                              <div class="row">
                                <?php 
                                  if(isset($msg)){
                                  echo $msg;
                                }                  
                                ?>
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="fa fa-user" id="icon-input"></i>
                                  <input type="text" name="nombre" id="name" class="form-control" placeholder="<?php echo _('Nombre'); ?>" required>
                                  <span id="errorname"></span>
                                </div>
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="far fa-user" id="icon-input"></i>
                                  <input type="text" name="apellido" id="lastname" class="form-control" placeholder="<?php echo _('Apellido'); ?>" required>
                                  <span id="errorlastname"></span>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">                	
        						              <i class="fa fa-id-card" id="icon-input"></i>
                                  <input type="text" name="docfiscal" id="cedula" class="form-control" placeholder="<?php echo _('Número de Identificación'); ?>" required>
                                  <span id="errorcedula"></span>
                                </div>
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-envelope" id="icon-input"></i>
                                  <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _('Correo Electrónico'); ?>" value="<?php echo $user; ?>" required>
                                  <span id="erroremail"></span>
                                </div>
                              </div>
                              <div class="row">
                              	<div class="col-md-6 col-sm-12 inner-addon left-addon">
                              		<i class="fa fa-key" id="icon-input"></i>
                              		<input type="password" name="password" id="password" required class="form-control" placeholder="<?php echo _('Contraseña');?>" required>
                              		<span id="errorpassword"></span>
                              	</div>
                              	<div class="col-md-6 col-sm-12 inner-addon left-addon">
                              		<i class="fa fa-key" id="icon-input"></i>
                              		<input type="password" name="cpassword" id="confir_passw" required class="form-control" placeholder="<?php echo _('Confirma tu contraseña');?>">
                              		<span id="errorpasswordconfir"></span>
                              	</div>
                              </div>
                              <div class="row">
                              	<div class="col-md-6 col-sm-12 inner-addon left-addon">
                              		<!-- <i class="fa fa-caret-down" id="icon-input"></i> -->
                              		<select class="form-control" name="paises" id="paises">
                              			<option value=""><?php echo _('Seleccione su país');?></option>
                              			<option value="1">VENEZUELA</option>
                              			<option value="2">PANAMA</option>
                              			<option value="3">ESTADOS UNIDOS</option>
                              			<option value="72">REPUBLICA DOMINICANA</option>
                              			<option value="249">COLOMBIA</option>
                              			<option value="302">ECUADOR</option>
                              			<option value="304">CURAZAO</option>
                              			<option value="376">MEXICO</option>
                              			<option value="378">PERU</option>
                              			<option value="380">CHILE</option>
                              			<option value="382">COSTA RICA</option>
                              			<option value="430">ITALIA</option>
                              		</select>
                              	</div>
                              	<div class="col-md-6 col-sm-12 inner-addon left-addon">
                              		<i class="fa fa-globe" id="icon-input"></i>
                              		<input type="text" name="estado" id="estado" class="form-control" placeholder="<?php echo _('Estado');?>" required>
                              		<span id="errorestado"></span>
                              	</div>
                              </div>
                              <div class="row">
                              	<div class="col-md-6 col-sm-12 inner-addon left-addon">
                              	<i class="fa fa-globe" id="icon-input"></i>
                              	<input type="text" name="ciudad" id="ciudad" class="form-control"
                              	placeholder="<?php echo _('Ciudad');?>" required>
                              	<span id="errorcity"></span>
                              	</div>
                              	<div class="col-md-2 col-sm-12 inner-addon left-addon">
                              		<?php echo _("Fecha de Nacimiento");?>
                              	</div>
                              	<div class="col-md-4 col-sm-12 inner-addon left-addon">
                              		<i class="fa fa-calendar-alt" id="icon-input"></i>
                              		<input type="date" name="nacimiento" id="fechanac" class="form-control" required>
                              		<span id="errordate"></span>
                              	</div>
                              </div>
                              <div class="row">
                              	 <div class="col-md-6 col-sm-12 inner-addon left-addon">
                              	 	<i class="fas fa-map-marker-alt" id="icon-input"></i>
                              	 	<input type="text" name="direccion" id="direccion" 
                              	 	placeholder="<?php echo _('Dirección')?>" required>
                              	 	<span id="errordirection"></span>
                              	 </div>
                              	  <div class="col-md-6 col-sm-12 inner-addon left-addon">                	
        							              <i class="fas fa-phone" id="icon-input"></i>
                                  	<input type="text" name="phone" id="phone" required class="form-control" placeholder="<?php echo _('Teléfono'); ?>">
                                  	<span id="errorphone"></span>
                                </div>
                              </div>	
                             </div>
                             <ul class="list-inline pull-right">
                                <li><input type="submit" name="pasotres" value="<?php echo _('Enviar'); ?>" class="btn btn-primary next-step boton1"></li>
                             </ul>
                             <span id="errorboton1"></span>
                        </div>                     
                        <div class="clearfix"></div>
                      </div>
                  </form>
              </div>
            </div>
          </div><!-- end row -->
      </div> <!--  big container -->	
  	</div>
  
<?php include '../c/footer.php'; ?>

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
        var group1 = validateR_empty('group1');
        var group2 = validateR_empty('group2');
        //var group3 = validateR_empty('group3');
        var group4 = validateR_empty('group4');
        var comments = validate_empty('comments', 'language');

        if (comments == 1 && group1 == 1 && group2 == 1 && group4 == 1) {
          var $active = $('.wizard .nav-tabs li.active');
          $active.next().removeClass('disabled');
          nextTab($active);
          form.submit();
        } else {
          event.preventDefault();
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