<?php
include "../sec/seguro.php";
include "../sec/libfunc.php";

$_SESSION["ubicacion"] = "live";
function urlsafe_b64encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('-','_','.'),$data);
    return $data;
}

$directory = "../lang/";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idioma'])) {
       //carga la matriz que pasara
       $valores=array();
       $valores[]=$_POST["idioma"];
       $retornar=urlsafe_b64encode(serialize($valores));
       $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "funcion=grabaconfiguracionusuario&valores=".$retornar."
        &usuario=".$iduser, $resulta);
       if ($error == ""){
          $message = "<div class='alert alert-success'><strong>Configuracion actualizada</strong></div>";
          $_SESSION["idioma"] = $_POST["idioma"];
       }
       else{
           $message = "<div class='alert alert-danger'><strong>Error al actualizar</strong> - ".$error."</div>";
       }
    } //Presiono el botn para buscar los lenguajes
}
?>
<!DOCTYPE html>
<html>
        <head>
        <title>Salvador+ Live (Intranet) - Salvador Hairdressing</title>
        <?php   include "../componentes/header.php"; ?>
        </head>
<style>

    /* The switch - the box around the slider */

.switch {

  position: relative;

  display: inline-block;

  width: 60px;

  height: 34px;

}



/* Hide default HTML checkbox */

.switch input {display:none;}



/* The slider */

.slider {

  position: absolute;

  cursor: pointer;

  top: 0;

  left: 0;

  right: 0;

  bottom: 0;

  background-color: #ccc;

  -webkit-transition: .4s;

  transition: .4s;

}



.slider:before {

  position: absolute;

  content: "";

  height: 26px;

  width: 26px;

  left: 4px;

  bottom: 4px;

  background-color: white;

  -webkit-transition: .4s;

  transition: .4s;

}



input:checked + .slider {

  background-color: #2196F3;

}



input:focus + .slider {

  box-shadow: 0 0 1px #2196F3;

}



input:checked + .slider:before {

  -webkit-transform: translateX(26px);

  -ms-transform: translateX(26px);

  transform: translateX(26px);

}



/* Rounded sliders */

.slider.round {

  border-radius: 34px;

}



.slider.round:before {

  border-radius: 50%;

}

</style>

        <body data-spy="scroll" data-target="#navbar-scroll">
        <div id="top"></div>
        <!-- /.cabecera -->
        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu);?>

                        </div>
                    </div>
                </div> 
            </div> 
        </div>
<?php
if (isset($message)){
     echo $message;
} else { ?>
<form action="ajustes.php" id="filtrosinventa" method="post" class="form-horizontal">
        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">

                        <!-- /.feature title -->
                        <p><h2>SalvadorPlus Live</h2>
                        <p><i>Preferencias de Idioma:</i>
                            
                    </div>
                </div>
            </div>
        </div>
        <div id="client" style="padding-top:25px;"> 
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 text-center">
                    <h3>Idioma para la intranet</h3>

                    
                    <select name="idioma" class="form-control" tabindex="1">

                      <option value="">-Selecciona un Idioma-</option> <?php
                      
                           $scanned_directory = array_diff(scandir($directory), array('..', '.'));
                           foreach ($scanned_directory as $direct){
                            if (is_dir($directory.$direct)) {
                               echo "<option value=$direct ";
                                  if($direct==$_SESSION["idioma"]){
                                    echo "selected";
                                  }
                               echo">$direct</option>";}
                           }//foreach
                                                         
  echo '</select></div>
                </div><br><div class="row text-center">
                    <input type="submit" class="btn btn-action" value="Guardar Preferencia">
                </div>
            </div>	
        </div>
        </form>'; }?>
        <?php include "../componentes/footer.php"; ?>  
        <script src="/intranet/componentes/js/opciones.js"></script>
        <script>
            $(".make-switch").bootstrapSwitch();
       </script>
    </body>
</html>
<?php ob_end_flush(); ?>