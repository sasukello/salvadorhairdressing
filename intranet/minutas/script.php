<?php
error_reporting(1);
include_once("../sec/seguro.php");

   include_once("../sec/libfunc.php");
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if(isset($_POST["accion"])){  
       if (isset($_POST['idminuta'])) {
          //acccion = A: Abrir, C: Cerrar, V: Verificar
          $parametros="&idminuta=".$_POST["idminuta"]."&iduser=".$_POST["iduser"]."&tipominuta=".$_POST["tipominuta"]."&accion=".$_POST["accion"]."&razon=".$_POST["razon"];
          $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=modificarminutas&".$parametros, $resulta);
          if ($error == ""){        
             $message = "";
          }
          else{ 
             $message = "Error al hacer post - ".$error;
          }
          echo $message;
       }
     } //Acciones sobre la minuta, Abrir, cerrar, verificar

     elseif (isset($_POST['funcion'])){
       $registros = (array)json_decode($_POST['registros'], true); 
       echo datosminuta($registros, $_POST['semilla'],$_POST['tipominuta']);
       exit;
    }

     elseif(isset($_POST["semilla"])){
       if ($_POST['tipominuta']=='salon') {
          //Carga los parametros para grabar (Detalles 1 = Verdero 0 =  Falso)
          $parametros="&idsalon=".$_POST["idsalon"]."&semilla=".$_POST["semilla"]."&detalles=".$_POST["detalles"];
          $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=buscarminutassalon&".$parametros, $resulta);
          if ($error == ""){        
             $message = $resulta;
          }
          else{ 
             $message = "Error al buscar - ".$error;
          }
          echo $message;
       } //En caso que sea busqueda en minuta de salon
       elseif ($_POST['tipominuta']=='region') {
          //Carga los parametros para grabar (Detalles 1 = Verdero 0 =  Falso)
          $parametros="&idregion=".$_POST["idregion"]."&semilla=".$_POST["semilla"]."&detalles=".$_POST["detalles"];
          $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=buscarminutasregion&".$parametros, $resulta);
          if ($error == ""){        
             $message = $resulta;
          }
          else{ 
             $message = "Error al buscar - ".$error;
          }
          echo $message;
        }  //En caso que sea busqueda en minuta de region
       elseif ($_POST['tipominuta']=='comite') {
          //Carga los parametros para grabar (Detalles 1 = Verdero 0 =  Falso)
          $parametros="&semilla=".$_POST["semilla"]."&detalles=".$_POST["detalles"];
          $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=buscarminutascomite&".$parametros, $resulta);
          if ($error == ""){        
             $message = $resulta;
          }
          else{ 
             $message = "Error al buscar - ".$error;
          }
          echo $message;
       } //En caso que sea busqueda en minuta de comite
       
     } //Busca la minuta segun la semilla
     
    //agrega la minuta 
    elseif (isset($_POST['datosminuta'])){   
        
       
       $parametros="&idsalon=".$_POST["idsalon"]."&idregion=".$_POST["idregion"]."&iduser=".$_POST["iduser"]."&datosminuta=".$_POST["datosminuta"]."&tipominuta=".$_POST["tipominuta"]."&prioridad=".$_POST["prioridad"];

       $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=agregarminutas&".$parametros, $resulta);
          if ($error == ""){
             $registros = (array)json_decode($resulta, true);        
             $message = datosminuta($registros, "", $_POST['tipominuta']);             
          }
          else{ 
             $message = "Error al grabar - ".$error;
          }

       echo $message;
       exit;
    }//Agrega la minuta

    //marca los detalles como leidos
    elseif (isset($_POST['detalleagregado'])){ 
        
       
       $parametros="&iduser=".$_POST["iduser"]."&detalleagregado=".$_POST["detalleagregado"]."&tipominuta=".$_POST["tipominuta"]."&codigominuta=".$_POST["codigominuta"]."&idsalon=".$_POST["idsalon"]."&idregion=".$_POST["idregion"];

       $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=agregardetalles&".$parametros, $resulta);
          if ($error == ""){
             $registros = (array)json_decode($resulta, true);        
             $message = datosminuta($registros, "", $_POST['tipominuta']);             
          }
          else{ 
             $message = "Error al grabar - ".$error;
          }
        //echo "Error ".$resulta;
       echo $message;
       exit;
    }//Marca los detalles como leidos

    //agrega un detalle nuevo
    elseif (isset($_POST['detallesleidos'])){   
        
       
       $parametros="&iduser=".$_POST["iduser"]."&detallesleidos=".$_POST["detallesleidos"]."&tipominuta=".$_POST["tipominuta"];

       $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=detallesleidos&".$parametros, $resulta);
          if ($error == ""){
             $message = "";             
          }
          else{ 
             $message = "Error al marcar leidos - ".$error;
          }

       echo $message;
       exit;
    }//agrega un detalle nuevo

    else if(isset($_POST['action'])){
      if($_POST["action"] == "updtprior"){

        $idmin = $_POST["idminuta"];
        $tipomin = $_POST["tipominuta"];
        $valor = $_POST["valorupdt"];

      $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=chargeminsalon&idminuta=".$idmin."&tipomin=".$tipomin."&valoru=".$valor, $resulta);
          if ($error == ""){
             $message = "";             
          }
          else{
             $message = "Error - ".$error;
          }

       echo $message;
       exit;
     } else if($_POST['action'] == 'sMM'){ // enviar Mail con Minutas en Ventana
          $datos = $_POST["datos"];
          $paso = $_POST["paso"];
          switch ($paso) {
            case 'initsal':
              echo searchMinutaMail($datos, $paso);
              break;
            case 'sendSal':
              $c1 = $_POST["correo1"];
              $c2 = $_POST["correo2"];
              $idsalon = $_POST["idsalon"];
              echo sendMinutaMail($datos, $c1, $c2, $idsalon, $paso);
              break;
            case 'sendReg':
              $c1 = $_POST["correo1"];
              $idsalon = $_POST["idsalon"];
              echo sendMinutaMail($datos, $c1, '', $idsalon, $paso);
              break;
            case 'sendCom':
              $c1 = $_POST["correo1"];
              $idsalon = $_POST["idsalon"];
              echo sendMinutaMail($datos, $c1, '', $idsalon, $paso);
              break;
            default:
              # code...
              break;
          }
          
       }
    }
    

} //Cierra el REQUEST


function datosminuta($registros, $resaltar, $tipominuta){

  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/minutaslang.php"; 

  if (count($registros) == 0){
    echo $trmnsinresultados;
  }


//show what we got going into sort
//echo '<pre>'.print_r($registros, 1).'</pre>';

  $i = 1;      
      foreach ($registros as $linea) {
         $cabecera = substr($linea, 0, strpos($linea, "}[")+1);                   
         $cabecera = array(json_decode($cabecera, true));

         //var_dump($cabecera);

         echo '<div class="panel-group">
         <div class="panel panel-default">                              
          <input type = "hidden" id = "mnidminuta'.$i.'" value="'.$cabecera[0]["CODIGO"].'">
          <input type = "hidden" id = "mnidnoleidos'.$i.'" value="'.$cabecera[0]["IDNOLEIDOS"].'">                              
          <div class="panel-heading"> ';
            if ($cabecera[0]["ESTATUS"] == 0) {
             $color = "<div id = 'mncolor".$i."' class='alert alert-success'>";
             $clasecerrar="visible";
             $claseabrir ="oculto";
             $claseverificar="oculto";
               if ($cabecera[0]["PRIORIDAD"] == 3) { // Marcada como Destacada
               $color = "<div id = 'mncolor".$i."' class='alert alert-info destmin'>";
             }
           } elseif ($cabecera[0]["ESTATUS"] == 1) {
             $color = "<div id = 'mncolor".$i."' class='alert alert-warning'>";
             $clasecerrar="oculto";
             $claseabrir ="visible";
             $claseverificar="visible";
           } elseif ($cabecera[0]["ESTATUS"] == 2) {
             $color = "<div id = 'mncolor".$i."' class='alert alert-danger'>";
             $clasecerrar="oculto";
             $claseabrir ="visible";
             $claseverificar="oculto";
           }

           echo $color;
                                          
           echo'<h4 class="panel-title">';

            //Imprime la cabecera
            //Para el popover 
             echo "<div style='float:top'><div style='float:left'><i class='pe-7s-info' style='float:left;text-align:left; cursor: pointer' id='infominuta' data-toggle='collapse' data-target='#mninfo".$i."'></i>&nbsp &nbsp&nbsp &nbsp</div>";
             echo '<i class="pe-7s-plus" data-toggle="modal" id="agregarinfominuta" data-target="#modalnuevodetalle'.$i.'" data-placement="top" title="'.$trmnnuevodetalle.'" style="cursor:pointer; float:left;text-align:left;"></i>';
             if ($cabecera[0]["PRIORIDAD"] == 3) {
               echo ' <i class="pe-7s-pin" data-toggle="modal" id="minutaimportante" data-target="#modaldestacado'.$i.'" data-i="3" data-placement="top" title="'.$trmndestacada.'" style="cursor:pointer; float:left;text-align:left;margin-left:1%;font-weight: bold;"></i>';
             } else if($cabecera[0]["PRIORIDAD"] != 3){
               echo ' <i class="pe-7s-pin" data-toggle="modal" id="minutaimportante" data-target="#modaldestacado'.$i.'" data-i="0" data-placement="top" title="'.$trmndestacada.'" style="cursor:pointer; float:left;text-align:left;margin-left:1%;"></i>';
             }

             
             echo "<span id='resultdest'></span>";
                                     //Modal para agregar detalle de minuta
             echo' <!-- Modal -->
             <div class="modal fade" id="modalnuevodetalle'.$i.'" role="dialog">
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">'.$trmnnuevodetalle.'</h4>
                </div>
                <div class="modal-body">                                                                                                        
                  <textarea id = "detallesnuevaminuta'.$i.'" name = "detallesnuevaminuta'.$i.'" rows = "4" cols = "70"></textarea>                                                    
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"';
                  echo " onclick='agregardetalle(".$i.")'>".$trmnabrir."</button>
                </div>
              </div>
            </div>
          </div>";

          echo "<div class='modal fade' id='modaldestacado".$i."' role='dialog'>
          <div class='modal-dialog'>

            <div class='modal-content'>
             <div class='modal-header'>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>
              <h4 class='modal-title'>".$trmndestacada."</h4>
            </div>
            <div class='modal-body'>";
             if($cabecera[0]["PRIORIDAD"] !== 3){
              echo "<button type='button' class='btn btn-default' onClick='marcardestacada(".$i.", 3)'>".$trmndestacadasi."</button>       
             <button type='button' class='btn btn-default' data-dismiss='modal'>".$trmndestacadano."</button>";
             } else if($cabecera[0]["PRIORIDAD"] == 3){
              echo "<button type='button' class='btn btn-default' data-dismiss='modal'>".$trmndestacadamantener."</button>       
             <button type='button' class='btn btn-default' onClick='marcardestacada(".$i.", 0)'>".$trmndestacadano."</button>";
             }
           echo "<br><span id='resultpinnednone'></span>
             <span id='resultpinned".$i."'></span></div>
           <div class='modal-footer'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>".$trmndestacadacerrar."</button>
          </div>
        </div>
      </div>
    </div>";

        //Botones de accion
        //En caso de verificar

        echo "<div style='float:right'>
        <i id='lbcerrar".$i."' class='pe-7s-close-circle $clasecerrar' style='cursor: pointer;float:right;text-align:right' data-toggle='tooltip' data-placement='bottom' title='".$trmncerrarminuta."' onclick='cerrarminuta(".'"'."$i".'"'.")'></i>
      </div>";

      if ($tipominuta == "salon"){
       $campobuscar=85;  
     } elseif ($tipominuta == "region"){
       $campobuscar=81;     
     }  
     else {
       $campobuscar="Comite1";     
     }                                
     if (in_array($campobuscar, array_column($_SESSION["accesosminuta"], 'NOMBREITEM'))){
      echo  "<div style='float:right'>
      &nbsp &nbsp&nbsp &nbsp&nbsp &nbsp<i data-toggle='modal' data-target='#myModal".$i."' id='lbabrir".$i."' class='pe-7s-unlock $claseabrir' data-toggle='tooltip' data-placement='bottom' title='".$trmnabrirminuta."' style='float:right;text-align:right;cursor: pointer' ></i>
    </div>";

    echo   "<div style='float:right'>
    <i id='lbverificar".$i."' class='pe-7s-check $claseverificar' data-toggle='tooltip' data-placement='bottom' title='".$trmnverificarminuta."' style='cursor:pointer; float:right;text-align:right' onclick='verificarminuta($i)'></i>
    </div>";  }


                                         //Info del popover
    echo' <!-- Modal -->
    <div class="modal fade" id="myModal'.$i.'" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
         <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">'.$trreapertura.'</h4>
        </div>
        <div class="modal-body">
          <p>'.$trindiquerazonapertura.'</p>
          <input type = "textarea" id = "razonapertura'.$i.'">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"';
          echo " onclick='abrirminuta($i)'>".$trmnabrir."</button>
        </div>
      </div>

    </div>
    </div>"; 


    echo '</div><br><div id="mninfo'.$i.'" class="collapse">'.
    '<p style="font-size:75%;text-align:left;padding:0">'.$trmncreadopor .' '. $cabecera[0]["USUARIOCREADO"] . ' ' . $trmnfechacreado . ' ' . $cabecera[0]["FECHACREADO"] . ' ' . $trmnhoracreado . ' ' . $cabecera[0]["HORACREADO"] .'</p>';
    if ($cabecera[0]["ESTATUS"]!=0) {
      echo '<p style="font-size:75%;text-align:left;padding:0">'.$trmncerradopor .' '. $cabecera[0]["USUARIOCERRADO"] . ' ' . $trmnfechacerrado . ' ' . $cabecera[0]["FECHACERRADO"] .'</p>';
      if ($cabecera[0]["ESTATUS"]==1) {     
        echo '<p style="font-size:75%;text-align:left;padding:0">'.$trmnpendienteverificacion.'</p>'; 
      }    
                                     } //Para los datos de cierre
                                     if ($cabecera[0]["ESTATUS"]==2) {
                                      echo '<p style="font-size:75%;text-align:left;padding:0">'.$trmnverificadopor .' '. $cabecera[0]["USUARIOVERIFICADO"] . ' ' . $trmnfechaverificado . ' ' . $cabecera[0]["FECHAVERIFICADO"] .'</p>';
                                     } //Para los datos de cierre

                                     //Muestra la descripcion
                                     echo '</div>'; //del colapsible  
                                     echo '<div id="espera'.$i.'"></div>';                                   
                                     echo '<a data-toggle="collapse" href="#collapse'.$i.'"';
                                     if ($cabecera[0]["IDNOLEIDOS"]!=""){
                                      echo ' onclick="marcardetallesleidos('.$i.')"';}
                                      echo '>';
                                      echo "<p></p>";
                                      echo "<p style='text-align:justify;padding:0'>";
                                      if ($cabecera[0]["NUEVOITEM"]!=""){
                                        echo "<small><label style='color:red'>*".$trmnminutanueva."*</label></small>";
                                      }
                                      echo str_ireplace($resaltar, "<mark>".$resaltar."</mark>", $cabecera[0]["DESCRIPCION"]);
                                      if ($cabecera[0]["IDNOLEIDOS"]!=""){
                                        echo "<br><div id = 'dvDetalles".$i."'><small><label style='color:red'>".$trmndetallesnoleidos."</label><i class='pe-7s-angle-down' style='cursor: pointer'></i></small></div>";
                                      }
                                      echo "</p>"; 

                                      echo ' </a>
                                    </h4></div>
                                  </div>
                                  <div id="collapse'.$i.'" class="panel-collapse collapse">
                                    <div class="panel-body">';
                                      $detalle  = substr($linea, strpos($linea, "}[")+1, strlen($linea)); 
                                      $detalle = json_decode($detalle, true);

                                      foreach ($detalle as $lineadetalle) {
                                      //Para el detalle 
                                       echo '<div style = "border-radius: 25px;border: 5px solid lightgray;';

                                       echo 'padding: 20px; width: 100%;"><p style="font-size:75%;text-align:left;padding:0">'.$trmncreadopor .' '. $lineadetalle["USUARIOGENERADO"] . ' ' . $trmnfechacreado . ' ' . $lineadetalle["FECHAGENERADO"] . ' ' . $trmnhoracreado . ' ' . $lineadetalle["HORAGENERADO"] .'</p>';                                     
                                       echo "<p style='text-align:justify'>".str_ireplace($resaltar, "<mark>".$resaltar."</mark>", $lineadetalle["DESCRIPCIONDETALLE"])."</p></div>";
                                     }
                                       echo "</div>        
                                     </div>
                                   </div>
                                 </div>"; 
         $i++;                  
      }
      echo "<input type='hidden' name='mintod' value='".base64_encode(serialize($registros))."'></button>";
      //var_dump($registros);
}


function sendMinutaMail($datos, $c1, $c2, $idsalon, $paso){
  if($paso == "sendSal"){
  require_once "../sec/correos.php";

    $dat1 = base64_decode($datos);
    $dat = unserialize($dat1);
    $correos = $c1.";".$c2;
    $nombresalon = searchMinutaMail($idsalon, "looksalon");
    echo enviarMinutasMail($dat, $correos, $nombresalon, "salon");
  } else if($paso == "sendReg"){
  require_once "../sec/correos.php";

    $dat1 = base64_decode($datos);
    $dat = unserialize($dat1);
    $correos = $c1;
    $nombresalon = searchMinutaMail($idsalon, "lookregion");
    echo enviarMinutasMail($dat, $correos, $nombresalon, "region");
  } else if($paso == "sendCom"){
  require_once "../sec/correos.php";

    $dat1 = base64_decode($datos);
    $dat = unserialize($dat1);
    $correos = $c1;
    $nombresalon = "Comité";
    echo enviarMinutasMail($dat, $correos, $nombresalon, "comite");
  }
  return;
}

function searchMinutaMail($datos, $paso){
  include_once("../sec/libcon.php");
  $dbh = dbconn();
      mysqli_set_charset($dbh, 'utf8');

      if (!$dbh) {
          die('Error en Conexión: ' . mysqli_error($dbh));
          exit;
      }

      if($paso == "initsal"){
        /* CONSULTAR CORREO DE FRANQUICIANTE DE UN SALÓN */
        $sql = "SELECT CORREO2 FROM web_salones where ID = '".$datos."';";
        $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
        $match = mysqli_num_rows($search);
        if ($match > 0) {
            while ($rw = mysqli_fetch_array($search)) {
                $resul = $rw['CORREO2'];
                if($resul == "default"){
                  $result = "ceo@salvadorhairdressing.com";
                } else {$result = $resul;}
            }
        } else {
          $result = "noindicacorreo@salvador.com.ve";
        }        
      } else if($paso == "looksalon"){
        /* CONSULTAR NOMBRE DE SALÓN */
        $sql = "SELECT CODIGO, NOMBRECOMPLETO FROM web_salones where ID = '".$datos."';";
        $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
        $match = mysqli_num_rows($search);
        if ($match > 0) {
            while ($rw = mysqli_fetch_array($search)) {
                $result = $rw['CODIGO'];
            }
        } else {
          $result = "N/I";
        }   
      } else if($paso == "lookregion"){
        /* CONSULTAR NOMBRE DE REGIÓN */
        $sql = "SELECT campo2 FROM ms_configuracion where campo = '".$datos."';";
        $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
        $match = mysqli_num_rows($search);
        if ($match > 0) {
            while ($rw = mysqli_fetch_array($search)) {
                $result = $rw['campo2'];
            }
        } else {
          $result = "N/I";
        }   
      }
      return $result;
}




?>