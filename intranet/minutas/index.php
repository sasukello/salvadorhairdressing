<?php
error_reporting(1);

include "../sec/seguro.php";
$_SESSION["ubicacion"] = "minutas";
$arrayMenu = unserialize($_SESSION["accesos"]);

include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/minutaslang.php";
include "../sec/libfunc.php";


//caragaminsalon();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $valoregion = $_POST["valoregion"];

    if (isset($_POST['minutasalon'])) {

        $salones = 1;

    } elseif (isset($_POST['submitSalon'])){
       list($idsalon,$rutasalon) = explode(";", $_POST['salones']);      
       $saloncargarminuta =  base64_decode($idsalon);
       cargarnombresalon($saloncargarminuta);
    } elseif (isset($_POST['minutaregion'])){       
       $regioncargarminuta =  $valoregion;
       cargarnombreregion($regioncargarminuta);
    } elseif (isset($_POST['minutacomite'])){
      $comitecargarminuta = 'comite';
    }





}

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['r'])) {

        $pedirtipo = $_GET['r'];

    }

}


function caragaminsalon(){
  //Cargar privilegio de usuario
  //81= VERIFICAR REGION
  //85= VERIFICAR SALON
  $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=selectall&iduser=".$_SESSION["codigo"], $resulta);
  $nombrearray = json_decode($resulta, true);
     if ($error==""){
         $accesosminuta = $nombrearray;          
     }
     else
     {
         $accesosminuta = array();         
     } 

     var_dump($accesosminuta);
     return;

}


function cargarprivilegiosusuario(){
  //Cargar privilegio de usuario
  //81= VERIFICAR REGION
  //85= VERIFICAR SALON
  $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=privilegiosusuarios&iduser=".$_SESSION["codigo"], $resulta);
  $nombrearray = json_decode($resulta, true);
     if ($error==""){
         $accesosminuta = $nombrearray;          
     }
     else
     {
         $accesosminuta = array();         
     } 

     $_SESSION["accesosminuta"] = $accesosminuta;
     

}


function cargarnombresalon($idsalon){
     global $salonnombre;
     global $salonalias;
     $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "funcion=nombresalon&idsalon=".$idsalon, $resulta);
     $nombrearray = json_decode($resulta, true);
     if ($error==""){
         $salonnombre = $nombrearray[0]["NOMBRE"]; 
         $salonalias  = $nombrearray[0]["PREFIJORESPALDO"];
     }
     else
     {
         $salonnombre = $error; 
         $salonalias  = $error;
     }     
}

function cargarnombreregion($idregion){
     global $regionnombre;
     $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "funcion=nombreregion&idregion=".$idregion, $resulta);
     $nombrearray = json_decode($resulta, true);
     if ($error==""){
         $regionnombre = $nombrearray[0]["DESCRIPCION"]; 
     }
     else
     {
         $regionnombre = $error; 
     }     
}


//Carga las minutas del salon
function cargarminutasalon($idsalon ){
   include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/minutaslang.php"; 
   include_once "script.php";
   $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=minutasalon&idsalon=".$idsalon."&iduser=".$_SESSION["codigo"], $resulta);


   ?>
    <input type = "hidden" name = "salones" value = "<?php echo $idsalon ?>">
    
   <?php 
   if ($error == "") {

      $registros = (array)json_decode($resulta, true); 
      datosminuta($registros, "", "salon");
      //var_dump($registros);
   }
   else

      echo "Ha ocurrido el siguiente " . $error;  
}

function cargarminutacomite(){
   include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/minutaslang.php"; 
   include_once "script.php";
   $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=minutacomite&idsalon=".$idsalon."&iduser=".$_SESSION["codigo"], $resulta);
   
   if ($error == "") {
      $registros = (array)json_decode($resulta, true); 
      datosminuta($registros, "", "comite");
   }
   else
      echo "Ha ocurrido el siguiente " . $error;  
}

//Carga las minutas de la region
function cargarminutaregion($idregion ){
   include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/minutaslang.php"; 
   include_once "script.php";
   $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=minutaregion&idregion=".$idregion."&iduser=".$_SESSION["codigo"], $resulta);
   ?>
    <input type = "hidden" name = "regiones" value = "<?php echo $idregion ?>">
    
   <?php 
   if ($error == "") {

      $registros = (array)json_decode($resulta, true); 
      //var_dump($registros);
      datosminuta($registros, "", "region");
   }
   else

      echo "Ha ocurrido el siguiente " . $error;  
}

?>
<!DOCTYPE html>
<html>
        <head>
        <title>Minutas - Salvador Hairdressing (Intranet)</title>
        <?php   include "../componentes/header.php"; ?>

        <!-- CSS Tether -->
        <link rel="stylesheet" href="../componentes/plugins/tether/shepherd-theme-arrows.css" />

        <style>
             .visible{
                 visibility: visible;
             }
             .oculto{
                 visibility: hidden;
             }
             .alert i{
    		position: inherit;
    		}
        </style>
        </head>
        <body onload="document.getElementById('cargando').style. display='none';" data-spy="scroll" data-target="#navbar-scroll">
        
        <!-- /.preloader -->
        <div id="top"></div>

        <!-- /.cabecera -->
        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu);?>

				  
                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">
        <div id="cargando" style="width: 100%; height: 100%; text-align: center"><br><br><img src='/mysteryshopper/images/loading.gif'></div>

                        <!-- /.feature title -->
                        <p><h2><?php echo $trminuta; 
                                     if(isset($salonalias)){
                                         echo " ".$salonalias;}
                                      elseif (isset($regionnombre)){
                                      echo " ".$regionnombre;
                                    } ?></h2>

                        <p><i><?php if (isset($pedirtipo)){
                                        echo $trseleccionatipominuta;  
                                       }
                                    elseif (isset($salones)){
                                      echo $trseleccionasalon;
                                    }   
                                    elseif (!isset($saloncargarminuta) && !isset($regioncargarminuta) && !isset($comitecargarminuta))  {
                                      cargarprivilegiosusuario();
                                      echo $trseleccionaregion; 
                                    }
                                    elseif (isset($salonnombre)){
                                      echo " ".$salonnombre;
                                    } 
                                    elseif (isset($comitecargarminuta)){
                                      echo $trminutacomite;
                                    } 
                                    

                        ?></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /.client section -->
        <div id="client"> 
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center" id="regiones">
                            <form action="index.php" method="post" class="form-horizontal">
                                <div class="form-group">
                                   <?php 
                                        if (isset($saloncargarminuta)){ 
                                    echo '
                                          <input type = "hidden" id = "mntipominuta" value="salon">
                                          <input type = "hidden" id = "mnidsalon" value="'.$saloncargarminuta.'">';}
                                        elseif (isset($regioncargarminuta)){ 
                                    echo '
                                          <input type = "hidden" id = "mntipominuta" value="region">
                                          <input type = "hidden" id = "mnidregion" value="'.$regioncargarminuta.'">';} 
                                          elseif (isset($comitecargarminuta)){ 
                                    echo '
                                          <input type = "hidden" id = "mntipominuta" value="comite">';} 

                                    if (isset($saloncargarminuta) || isset($regioncargarminuta) || isset($comitecargarminuta)) {
                                    echo '<input type = "hidden" id = "mnidusuario" value="'.$_SESSION["codigo"].'">                                          
                                          <div id="contenedorsuperior" class ="form-group"> 
                                             <div style = "float:left"> 
                                                <i class="pe-7s-plus" id="agregarminutaicon" data-toggle="modal" data-target="#modalnuevaminuta" data-toggle="tooltip" data-placement="top" title="'.$trmnnuevaminuta.'" style="cursor:pointer; float:left;text-align:left;font-size: 200%;"></i>&nbsp &nbsp&nbsp &nbsp
                                              </div>
                                             <div style = "float:left"> 
                                                <i class="pe-7s-search" id="buscarminutaicon" data-toggle="tooltip" data-placement="top" title="'.$trmnbuscarminuta.'" style="cursor:pointer;font-size: 200%;" onclick="mostrarbusqueda()"></i>
                                             </div>   
                                                <div id = "semillabusqueda" class = "oculto" style="float:left;">
                                                   <div style= "font-size: 75%;float:left;"><input type= "TEXT" id="semilla" onkeypress="return buscarminuta(event);"></div><br>
                                                   <div style= "font-size: 75%;float:left;"><input type= "checkbox" id="semilladetalle" name="semilladetalle">'.$trmnbuscardetalle.'</div>
                                                </div>
                                              
                                          </div>';
                                     //Modal para agregar minuta
                                     echo' <!-- Modal -->
                                       <div class="modal fade" id="modalnuevaminuta" role="dialog">
                                          <div class="modal-dialog">
    
                                            <!-- Modal content-->
                                              <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">'.$trmnnuevaminuta.'</h4>
                                                 </div>
                                                 <div class="modal-body">                                                                                                        
                                                    <textarea id = "datosnuevaminuta" name = "datosnuevaminuta" rows = "4" cols = "70"></textarea><br>
                                                    <input type = "radio" id = "prioridad" name = "prioridad" value = "0">'.$trmnprioridadbaja.'<br><input type = "radio" id = "prioridad" name = "prioridad" value = "1" checked>'.$trmnprioridadnormal.'<br><input type = "radio" id = "prioridad" name = "prioridad" value = "2">'.$trmnprioridadalta.'<br>
                                                 </div>
                                                 <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"';
                                                    echo " onclick='agregarminuta()'>".$trmnabrir."</button>
                                                 </div>
                                              </div>
      
                                          </div>
                                       </div>";
                                       echo '<!-- Modal Enviar Correo -->
                                       <div class="modal fade" id="sendmailMinutas" role="dialog">
                                          <div class="modal-dialog">
    
                                            <!-- Modal content-->
                                              <div class="modal-content">
                                                 <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title" id="tituSMM">'.$trmnmail1.'</h4>
                                                 </div>
                                                 <div class="modal-body">
                                                  <span id="modalMinuta">
                                                  </span>            
                                                 </div>
                                                 <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal"';
                                                    echo ">".$trmnmail2."</button>";
                                                 echo '</div>
                                              </div>
      
                                          </div>
                                       </div>';
                                     }
                                       echo '<div id="espera"></div>';                                   

                                        
                                   ?>
                                   <div id="contenedorprincipal" class="form-group"> 

                                    <?php if (isset($pedirtipo)){
                                       echo '
                                       <input type = "hidden" name = "valoregion" value = "'.$pedirtipo.'">
                                    <div class="col-sm-offset-4 col-sm-6">';
                                      if (in_array("Region1", array_column($_SESSION["accesosminuta"], 'NOMBREITEM'))) { echo '
                                       <button type="submit" class="btn" name="minutaregion" id="minutaregion" style="color:red;height:50px; width:200px">'.$trminutaregion.'</button>';
                                     }
                                     echo '</div>
                                    <div class="col-sm-offset-4 col-sm-6">';
                                      if (in_array("Salon1", array_column($_SESSION["accesosminuta"], 'NOMBREITEM'))) {
                                      echo '
                                       <button type="submit" class="btn" name="minutasalon" id="minutasalon" style="color:red;height:50px; width:200px">'.$trminutasalon.'</button>
                                        ';}
                                    echo '</div>';
                                    } //Elige el tipo si es region o salon
                                    elseif (isset($salones)){
                                       salonescargar($iduser, $valoregion); 
                                    } //Carga la lista de salones
                                    elseif (isset($saloncargarminuta)){
                                        cargarminutasalon($saloncargarminuta);
                                    }
                                    elseif (isset($regioncargarminuta)){
                                        cargarminutaregion($regioncargarminuta);
                                    }
                                    elseif (isset($comitecargarminuta)){
                                        cargarminutacomite();
                                    }
                                    else {
                                       
                                       if ((in_array("Salon1", array_column($_SESSION["accesosminuta"], 'NOMBREITEM'))) || (in_array("Region1", array_column($_SESSION["accesosminuta"], 'NOMBREITEM'))))  {
                                          regionCargar($iduser);
                                       }
                                       
                                      if (in_array("Comite1", array_column($_SESSION["accesosminuta"], 'NOMBREITEM'))) {
                                        echo '<p></p><div class="col-sm-offset-4 col-sm-6">';
                                        echo '
                                          <p>'.$trmnseleccioneminutacomite.'</p>
                                          <button type="submit" class="btn" name="minutacomite" style="color:red;height:50px; width:200px">'.$trminutacomite.'</button>
                                          ';
                                        echo '</div>';
                                        }
                                        

                                    }//Carga la lista de regiones?>

                                </div>        
                              </form>
                            </div>
                        </div>
                        <div class="row">
                          <?php if (isset($saloncargarminuta) || isset($regioncargarminuta) || isset($comitecargarminuta)){
                            if (isset($saloncargarminuta)){
                              $mivalor = "S";
                              $mivalor2 = $saloncargarminuta;
                            } else if (isset($regioncargarminuta)){
                              $mivalor = "R";
                              $mivalor2 = $regioncargarminuta;
                            } else if (isset($comitecargarminuta)){
                              $mivalor = "C";
                              $mivalor2 = $comitecargarminuta;
                            } ?>
                          <div class="col-md-8">
                            <button class="btn btn-default"><a href="/intranet/minutas/">Volver: Principal</a></button> <!--<button class="btn btn-default">Volver: Atrás</button>!-->
                          </div>
                          <div class="col-md-4" style="text-align: right;">
                            <button class="btn btn-default" data-toggle="modal" data-target="#sendmailMinutas" data-tip=<?php echo ''.$mivalor.''; ?> data-tip2=<?php echo ''.$mivalor2.''; ?>  >Enviar por Correo</button>
                          </div>
                          <?php } ?>
                        </div>      
                    </div>
                </div>
            </div>

        <?php include "../componentes/footer.php"; ?>  

        <script src="/intranet/componentes/js/opciones.js"></script>
        <script src="component/js/function.js"></script>
        <script type = "javascript">
           $(document).ready(function(){
               $('[data-toggle="tooltip"]').tooltip(); 
            });
        </script>

        <!-- Tether JS -->
        <script src="../componentes/plugins/tether/tether.js"></script>
        <script src="../componentes/plugins/tether/shepherd.min.js"></script>

        <style type="text/css">
          .shepherd-text{
            max-width: 480px;
          }
        </style>

        <script type="text/javascript">
          if (document.body.contains(document.getElementById('flag'))) {
              let tour = new Shepherd.Tour({
                defaults: {
                  classes: 'shepherd-theme-arrows',
                  showCancelLink: true
                }
              });

              tour.addStep('region', {
                title: 'Seleccione la Región',
                text: 'Seleccione la bandera de la región que deseas consultar para ver todas la minutas de la región seleccionada.',
                attachTo: '#flag top',
                advanceOn: '.docs-link click',
                buttons: []
              });

              tour.start();
          }

          if (document.body.contains(document.getElementById('minutaregion'))) {
              let tour = new Shepherd.Tour({
                defaults: {
                  classes: 'shepherd-theme-arrows',
                  showCancelLink: true
                }
              });

              tour.addStep('region', {
                title: 'Minuta de Región',
                text: 'En esta sección podrás consultar todas las minutas de la región seleccionada.',
                attachTo: '#minutaregion top',
                advanceOn: '.docs-link click',
                buttons: [
                    {
                      text: 'Cerrar',
                      classes: 'shepherd-button-secondary',
                      action: tour.cancel
                    }, {
                      text: 'Siguiente',
                      action: tour.next,
                      classes: 'shepherd-button-example-primary'
                    }
                  ]
              });

              tour.addStep('region', {
                title: 'Minuta de Salón',
                text: 'En esta sección podrás consultar todas las minutas del salón seleccionado.',
                attachTo: '#minutasalon bottom',
                advanceOn: '.docs-link click',
                buttons: [
                    {
                      text: 'Cerrar',
                      classes: 'shepherd-button-primary',
                      action: tour.cancel
                    }
                  ]
              });

              tour.start();
          }   

          if (document.body.contains(document.getElementById('agregarminutaicon'))) {
              let tour = new Shepherd.Tour({
                defaults: {
                  classes: 'shepherd-theme-arrows',
                  showCancelLink: true
                }
              });

              tour.addStep('region', {
                title: '<i class="pe-7s-plus"></i> Agregar Minuta',
                text: 'Al seleccionar esta opción podrás agregar una nueva minuta en esta sección.',
                attachTo: '#agregarminutaicon right',
                advanceOn: '.docs-link click',
                buttons: [
                    {
                      text: 'Cerrar',
                      classes: 'shepherd-button-secondary',
                      action: tour.cancel
                    }, {
                      text: 'Siguiente',
                      action: tour.next,
                      classes: 'shepherd-button-example-primary'
                    }
                  ]
              });

              tour.addStep('region', {
                title: '<i class="pe-7s-search"></i> Búsqueda de Palabra Clave',
                text: 'Con esta busqueda podrás encontrar las minutas que contengan la palabra escrita.',
                attachTo: '#buscarminutaicon right',
                advanceOn: '.docs-link click',
                buttons: [
                    {
                      text: 'Cerrar',
                      classes: 'shepherd-button-primary',
                      action: tour.cancel
                    }, {
                      text: 'Siguiente',
                      action: tour.next,
                      classes: 'shepherd-button-example-primary'
                    }
                  ]
              });

              if (document.body.contains(document.getElementById('mncolor1'))) {

                tour.addStep('region', {
                  title: 'Minuta',
                  text: 'Al hacer click sobre cada minuta podrás consultas los detalles añadidos a la misma.',
                  attachTo: '#mncolor1 bottom',
                  advanceOn: '.docs-link click',
                  buttons: [
                      {
                        text: 'Cerrar',
                        classes: 'shepherd-button-secondary',
                        action: tour.cancel
                      }, {
                        text: 'Siguiente',
                        action: tour.next,
                        classes: 'shepherd-button-example-primary'
                      }
                    ]
                });

                tour.addStep('region', {
                  title: '<i class="pe-7s-info"></i> Información de la Minuta',
                  text: 'Selecciona esta opción y podrás consultar información sobre la minuta.',
                  attachTo: '#infominuta right',
                  advanceOn: '.docs-link click',
                  buttons: [
                      {
                        text: 'Cerrar',
                        classes: 'shepherd-button-secondary',
                        action: tour.cancel
                      }, {
                        text: 'Siguiente',
                        action: tour.next,
                        classes: 'shepherd-button-example-primary'
                      }
                    ]
                });

                tour.addStep('region', {
                  title: '<i class="pe-7s-plus"></i> Agregar Información a la Minuta',
                  text: 'En esta opción puedes agregar información a la minuta seleccionada.',
                  attachTo: '#agregarinfominuta right',
                  advanceOn: '.docs-link click',
                  buttons: [
                      {
                        text: 'Cerrar',
                        classes: 'shepherd-button-secondary',
                        action: tour.cancel
                      }, {
                        text: 'Siguiente',
                        action: tour.next,
                        classes: 'shepherd-button-example-primary'
                      }
                    ]
                });

                tour.addStep('region', {
                  title: '<i class="pe-7s-pin"></i> Marcar Minuta como Importante',
                  text: 'Al hacer click sobre esta opción podrás marcarla como importante.',
                  attachTo: '#minutaimportante right',
                  advanceOn: '.docs-link click',
                  buttons: [
                      {
                        text: 'Cerrar',
                        classes: 'shepherd-button-secondary',
                        action: tour.cancel
                      }
                    ]
                });
                
              }

              tour.start();
          }
        </script>

    </body>
</html>
<?php ob_end_flush(); ?>