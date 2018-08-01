<?php

include_once("seguro.php");
include_once("libfunc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['pantallainicio'])) {
      pantallainicioasociados();
    } //pide la pantalla de inicio    
    elseif (isset($_POST['listadoasociadossalon'])) {
      listadoasociadossalon();      
    } //pide el listado de asociados en salon
    elseif (isset($_POST['listadoasociados'])){    
      mostrarlistadoasociados($_POST['desde'], $_POST['hasta']);
    }//Pide el listado de asociados
    elseif (isset($_POST['listadoasociadosdetalles'])){    
      mostrardetallelistadoasociados($_POST['filtroasociados'], $_POST['desdedet'], $_POST['hastadet']);
    }//Pide el listado de asociados detalles
    elseif (isset($_POST['listadoasociadosservicios'])){    
      mostrarlistadoasociadosservicio($_POST['filtroasociados']);
    }//Pide el listado asociados contra servicios realizados
    elseif (isset($_POST['listadoasociadosclientes'])){    
      mostrarlistadoasociadosclientes($_POST['filtroasociados']);
    }//Pide el listado de clientes perdidos
    elseif (isset($_POST['conciliaciondiaria'])){    
      mostrarconciliaciondiaria($_POST['asociado'], $_POST['fecha']);
    }//Pide la conciliacion diaria
    elseif (isset($_POST['servicios'])){    
      asociadosserviciosrealizados($_POST['asociado'], $_POST['desde'], $_POST['hasta']);
    }//Muestra los servicios realizados
    elseif (isset($_POST['clientes'])){    
      asociadosclientesatendidos($_POST['asociado'], $_POST['desde'], $_POST['hasta']);
    }//Muestra los servicios realizados
}  //Request del post




function pantallainicioasociados(){ 
  
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveasociados.php";
    global $salon;
  echo '
        <div id = "contenedor">
        <div class="form-group">';

    //Muestra los filtros de listado
   echo '
                <label class="control-label col-sm-4" for="rango">'.$trasseleccionerango.':</label> 
                <div class="col-sm-6">

                    <input type="date" class="form-control" id="desde" name="desde" required />  a <input type="date" class="form-control" id="hasta" name="hasta" required />

                </div> ';

  echo '      </div>     

        <div class="form-group"> 

            <div class="col-sm-offset-4 col-sm-6">';

            
              echo '<button type="submit" class="btn" name="listadoasociados" id="listadoasociados" style="color:red;height:50px; width:200px" onclick="return listaasociados();">'.$trascomisiones.'</button>';
            
       echo '</div>

        </div>       

      
        <div class="form-group"> 

            <div class="col-sm-offset-4 col-sm-6">

              <button type="button" class="btn btn-default" id="btasociadossalon" onclick="return listadoasociadossalon()">'.asociadossalon().'</button>

            </div>

        </div>
        
        <div id="listadoespera" class="form-group" style = "float:left;width:100%;"> 
        </div>  
       </div> ';
    
    echo '<script>

        document.getElementById("desde").valueAsDate = new Date();

        document.getElementById("hasta").valueAsDate = new Date();

    </script> ';  } //Pantalla de seleccion de asociados


function  asociadossalon(){
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveasociados.php"; 
    require_once "armarconsulta.php";
    require_once "libfunc.php";
    $rutasalon = base64_decode($_SESSION["ruta"]);

    $error = hacerpost($rutasalon."/apilivesalon.php?", "clavebd=salvasis1&consultas=".asociadosactivos(), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);   
        $_SESSION["listaasociadosactivos"] = $manage[1];         
        return $trasasociadosactivos . " - " . count($manage[1]) . "/" . $trasasociadossalon  ." - " .$manage[0][0]["TRABAJADO"];
    }
    else{ 
        return "<b>Hubo un error al cargar los asociados activos:</b> " . $error;
    }
      
   
} //Asociados en salon

function listadoasociadossalon(){
  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveasociados.php";
  
  echo "<div class='text-center'><h2>".$trasasociadossalon.":</h2></div>";

    echo "<br><div id='vt4_wrapper' class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

        <table id='vt4' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';><thead>";

    echo "<tr><th>".$trasasociadocodigo."</th><th style='text-align:center;'>".$trasasociadonombre." - <i class='glyphicon glyphicon-list-alt wow fadeInUp' data-wow-delay='0.2s' style='text-align:center;'></i></th>";

    
            echo "<th>".$trasasociadotelefono."</th>";
            echo "<th>".$trasasociadotrabajos."</th>";            
        echo "</tr></thead>

              <tbody>";               
        if (count($_SESSION["listaasociadosactivos"])> 0){ 
        foreach ($_SESSION["listaasociadosactivos"] as $linea){

                   echo "<tr>";                   
                   echo "<td>".$linea['CODIGO'] ."</td>";
                   echo "<td style='text-align:center;'>".$linea['NOMBRE']."</td>";
                   echo "<td><a href='tel:".$linea['TELEFONO']."'>".$linea['TELEFONO'] ."</a></td>";                                      
                   echo "<td>".$linea['TRABAJOS'] ."</td>";

                   
                   echo "</tr>";

               }
           }
    echo "</tbody>

          </table>

          </div>";

    
} //Listado de asociados en salon

function obtenerlistadoasociados($desde, $hasta){
    require_once "armarconsulta.php";
    require_once "libfunc.php";   
    global $rutabd;

    $fdesde = date_create($desde); 
    $desde  = date_format($fdesde, 'm/d/Y');
    $fhasta = date_create($hasta); 
    $hasta  = date_format($fhasta, 'm/d/Y');
    $rutasalon = base64_decode($rutabd);
        
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".listadocomisiones($desde, $hasta), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);           
        return $manage[0];   
    }
    else{ 
        return "<b>Hubo un error al cargar el listado de asociados:</b> " . $error;
    }
   
 
  
}

function obtenerlistadoasociadosdetalle($desde, $hasta, $asociados){
    require_once "armarconsulta.php";
    require_once "libfunc.php";   
    global $rutabd;    
    $fdesde = date_create($desde); 
    $desde  = date_format($fdesde, 'm/d/Y');
    $fhasta = date_create($hasta); 
    $hasta  = date_format($fhasta, 'm/d/Y');
    $rutasalon = base64_decode($rutabd);
        
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".listadocomisionesdetalles($desde, $hasta, $asociados), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);           
        return $manage[0];   
    }
    else{ 
        return "<b>Hubo un error al cargar el listado de asociados:</b> " . $error;
    }
   
 
  
}

function obtenerasociadosserviciosrealizados($desdedet, $hastadet, $asociados){
    require_once "armarconsulta.php";
    require_once "libfunc.php";   
    global $rutabd;    
    $fdesde    = date_create($desdedet); 
    $desdedet  = date_format($fdesde, 'm/d/Y');    
    $fhasta    = date_create($hastadet); 
    $hastadet  = date_format($fhasta, 'm/d/Y');    
    $rutasalon = base64_decode($rutabd);
        
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".serviciosasociados($desdedet, $hastadet, $asociados), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);           
        return $manage[0];   
    }
    else{ 
        return "<b>Hubo un error al cargar el listado de servicios:</b> " . $error;
    }
}

function obtenerasociadosclientesatendidos($desdedet, $hastadet, $asociados){
    require_once "armarconsulta.php";
    require_once "libfunc.php";   
    global $rutabd;    
    $fdesde    = date_create($desdedet); 
    $desdedet  = date_format($fdesde, 'm/d/Y');    
    $fhasta    = date_create($hastadet); 
    $hastadet  = date_format($fhasta, 'm/d/Y');    
    $rutasalon = base64_decode($rutabd);
        
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".clientesatendidos($desdedet, $hastadet, $asociados), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);           
        return $manage[0];   
    }
    else{ 
        return "<b>Hubo un error al cargar el listado de clientes atendidos:</b> " . $error;
    }
}


function obtenerconciliaciondiaria($asociado, $fecha){
    require_once "armarconsulta.php";
    require_once "libfunc.php";   
    global $rutabd;    
    $fdesde = date_create($fecha); 
    $fecha  = date_format($fdesde, 'm/d/Y');    
    $rutasalon = base64_decode($rutabd);
        
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".conciliaciondiaria($fecha, $asociado), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);           
        return $manage[0];   
    }
    else{ 
        return "<b>Hubo un error al cargar la conciliacion diaria:</b> " . $error;
    }
   
 
  
}




function mostrarlistadoasociados($desde, $hasta){
  //Indica el tipo de tabla  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveasociados.php";

  
  $datosasociados = obtenerlistadoasociados($desde, $hasta);

  echo "<div class='text-center'><h2>".$trascomisiones.":</h2></div>";
if (is_string($datosasociados)){
           echo $datosasociados;
} //muestra el error
elseif (count($datosasociados)> 0){ 
    echo "<br><div id='vt4_wrapper' class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

        <table id='vt4' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';><thead>";

    
    echo "<tr><th colspan=3>".$trasdesde."=".$desde." / ".$trashasta."=".$hasta." </th></tr>
          <tr><th>".$trasasociadocodigo."</th><th>".$trasestatus."</th><th style='text-align:center;'>".$trasasociadonombre."</th>";
            echo "<th>".$trasporcentajeservicio."</th>";            
            echo "<th>".$trasserviciosrealizados."</th>";            
            echo "<th>".$trasneto."</th>";
            echo "<th>".$trascomision."<br><small>".$trasdesde."=".$desde." / ".$trashasta."=".$hasta."</small></th>";
            echo "<th>".$trasmontogcr."</th>";
            echo "<th>".$trascomisiongcr."</th>";            
        echo "</tr></thead>

              <tbody>";       
        
          foreach ($datosasociados as $linea){

                   echo "<tr";
                   if ($linea['ESTATUS'] == "I"){
                      echo " class = 'alert alert-danger' style='background-color: #f2dede;'";}
                   echo ">";                   
                   echo "<td>".$linea['CODIGO'] ."</td>";
                   echo "<td>".$linea['ESTATUS'] ."</td>";
                   echo "<td>".$linea['NOMBRE'] ."</td>";
                   echo "<td>".number_format($linea['PORCSERVICIO'], 2, '.', ',')."</td>";
                   echo "<td>".number_format($linea['SERVICIOSREALIZADOS'], 0, '', ',')."</td>";
                   echo "<td>".number_format($linea['NETO'], 2, '.', ',')."</td>";                   
                   echo "<td>".number_format($linea['COMISION'], 2, '.', ',')."</td>";
                   echo "<td>".number_format($linea['MONTOGCR'], 2, '.', ',')."</td>";
                   echo "<td>".number_format($linea['COMISIONGCR'], 2, '.', ',')."</td>";
                   echo "</tr>";

               }
           
    echo '</tbody>

          </table>

          </div>';

   //Coloca las fechas para los detalles
   echo '<input type = "hidden" id= "fechadesde" value = '.$desde.'>       <input type = "hidden" id= "fechahasta" value = '.$hasta.'>';

   //Botones de opciones disponibles
   echo '
   <div class="form-group"> 

            <div class="col-sm-offset-4 col-sm-6"  style="width: 100%;margin-left: 0;"">

              <button type="button" class="btn btn-default" id="btasociadossalon" onclick="return seleccioneslistadoasociados('."'".'d'."'".')">'.$trasdetallesdiarios.'</button>
              <button type="button" class="btn btn-default" id="btasociadossalon" onclick="return seleccioneslistadoasociados('."'".'s'."'".')">'.$trasserviciosrealizados.'</button>
              <button type="button" class="btn btn-default" id="btasociadossalon" onclick="return seleccioneslistadoasociados('."'".'c'."'".')">'.$trasclientesatendidos.'</button>

            </div>                                 

        </div>  ';

} //datos de los asociados
else {
  echo $trclnohayresultados;
}    
} //mostrar listado asociados

function mostrarconciliaciondiaria($asociado, $fecha){
  //Indica el tipo de tabla  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveasociados.php";

  
  $datosasociados = obtenerconciliaciondiaria($asociado, $fecha);
   
  echo "asociado ".$asociado. " Fecha ".$fecha;

  echo "<div class='text-center'><h2>".$trascomisiones.":</h2></div>";
if (is_string($datosasociados)){
           echo $datosasociados;
} //muestra el error
elseif (count($datosasociados)> 0){ 
    echo "<br><div id='vt4_wrapper' class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

        <table id='vt4' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';><thead>";

    
    echo "<tr><th>".$trascontrol."</th><th>".$trascliente."</th><th>".$trasdescripcion."</th>";
            echo "<th>".$trasmonto."</th>";                        
        echo "</tr></thead>

              <tbody>";       
        
          foreach ($datosasociados as $linea){

                   echo "<tr>";                   
                   echo "<td>".$linea['CORRELATIVOPRINCIPAL'] ."</td>";
                   echo "<td>".$linea['CLIENTE'] ."</td>";
                   echo "<td>".$linea['DESCRIPCION'] ."</td>";
                   echo "<td>".number_format($linea['MONTO'], 2, '.', ',')."</td>";                   
                   echo "</tr>";

               }
           
    echo '</tbody>

          </table>

          </div>';


} //datos de los asociados
else {
  echo $trclnohayresultados;
}    
} //mostrar concliacion diaria





function mostrardetallelistadoasociados($asociados, $desdedet, $hastadet){
  //Indica el tipo de tabla  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveasociados.php";

  $datosdetalles = obtenerlistadoasociadosdetalle($desdedet, $hastadet, $asociados);

  echo "<div class='text-center'><h2>".$trascomisiones.":</h2></div>";

  if (is_string($datosdetalles)){
    echo "string ". $datosdetalles;
  } //muestra el error
  elseif (count($datosdetalles)> 0){ 

    $asociadoactual = "0"; 
    $i=0;

    foreach ($datosdetalles as $linea){    
      //Determina si comienza otro asociado
      if (($linea["CODIGO"] != $asociadoactual)){                      
        if ($asociadoactual!="0") {
          //Evita que se pongan los cierres de div antes de la aperturas
          echo "</tbody></table></div>        
                </div>
                </div>
                </div>"; 
        }
        //Abre los div
        $i++;
        echo '<div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse'.$i.'">';
        //************** esta es la tabla titulo del asociado
        echo '          <input type="hidden" id="idasociado'.$i.'" value ="'.$i.'"> ';
        echo "          <br><div id='vt4_wrapper' class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>
                              <table id='tx' class='dt-responsive' cellspacing='0' width='100%';><thead>";
        echo "                  <tr>
                                    <th>".$trasasociadocodigo."</th>
                                    <th>".$trasestatus."</th>
                                    <th>".$trasasociadonombre."</th>";
        echo "                      <th>".$trasporcentajeservicio."</th>";                        
        echo "                  </tr>
                              </thead>
                              <tbody>";       
        echo "                   <tr";
        if ($linea['ESTATUS'] == "I"){
          echo "                     class = 'alert alert-danger' style='background-color: #f2dede;'";
        }
        echo "                    >";                   
        echo "                       <td>".$linea['CODIGO'] ."</td>";
        echo "                       <td>".$linea['ESTATUS'] ."</td>";
        echo "                       <td>".$linea['NOMBRE'] ."</td>";
        echo "                       <td>".number_format($linea['PORCSERVICIO'], 2, '.', ',')."</td>";                   
        echo "                   </tr>";
        echo '                </tbody>
                              </table>
                            </div>';
        echo'         </a>';
        echo'       </h4>
                  </div>'; //panel heading
        echo'     <div id="collapse'.$i.'" class="panel-collapse collapse">
                    <div class="panel-body">
                      <br>
                      <div id="vt'.$i.'_wrapper" class="dataTables_wrapper form-inline dt-bootstrap dt-responsive" style="overflow-x:scroll;">
                         <table id="vt'.$i.'" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%";>
                            <thead>
                              <tr>';              
        echo "                   <th colspan=3>".$trasdesde."=".$desdedet." / ".$trashasta."=".$hastadet." </th>
                              </tr>";          
        echo "                <tr>
                                <th>".$trasfecha."</th>";            
        echo "                  <th>".$trasserviciosrealizados."</th>";            
        echo "                  <th>".$trasneto."</th>";
        echo "                  <th>".$trascomision."</th>";
        echo "                  <th>".$trasmontogcr."</th>";
        echo "                  <th>".$trascomisiongcr."</th>";            
        echo "                </tr>
                            </thead>
                            <tbody>";       
        $asociadoactual = $linea["CODIGO"];

      } //Cambio de asociados

        echo "              <tr>";                   
        echo "                  <td><a onclick='conciliaciondiariaasociados(".'"'.$linea['CODIGO'].'"'.",".'"'.$linea['FECHAVENTA'].'"'.")'>".$linea['FECHAVENTA']." - <i class='glyphicon glyphicon-resize-full'></i></td>"; 
        echo "                  <td>".number_format($linea['SERVICIOSREALIZADOS'], 0, '', ',')."</td>";
        echo "                  <td>".number_format($linea['NETO'], 2, '.', ',')."</td>";                   
        echo "                  <td>".number_format($linea['COMISION'], 2, '.', ',')."</td>";
        echo "                  <td>".number_format($linea['MONTOGCR'], 2, '.', ',')."</td>";
        echo "                  <td>".number_format($linea['COMISIONGCR'], 2, '.', ',')."</td>";
        echo "              </tr>";

    }//cierra el foreach
    //pone los cierres al ultimo registro
    echo "</tbody></table></div>        
                </div>
                </div>
                </div>"; echo '<input type="hidden" id="registros" value ="'.$i.'">';  
    //Botones de opciones disponibles
    /*echo '<div class="form-group"> 
            <input type="hidden" id="registros" value ="'.$i.'"> 
              <div class="col-sm-offset-4 col-sm-6">
                <button type="button" class="btn btn-default" id="btasociadossalon" onclick="return seleccionesdetallesasociados()">'.$trasconciliaciondiario.'</button>
              </div>
          </div>';        */
?>
    <!-- COMIENZO DE MODAL: conciliacion diaria  -->    
        <div id="modalconciliaciondiaria" class="modal fade" role="dialog">

            <div class="modal-dialog  modal-lg">

                <!-- Modal content-->

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title"><b><?php echo $trasconciliaciondiario;?></b></h4>

                    </div>

                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="recipient-name">

                        <span id="texto"></span>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $trascerrar ?></button>

                    </div>

                </div>

            </div>

        </div>

        <!-- FIN DE MODAL: F.VTA -->
<?php
  } //si la consulta devuelve resultados
  else {
    echo $trasnohayresultados;
  }    
} //mostrar listado asociados detalle diario

function asociadosserviciosrealizados($asociados, $desdedet, $hastadet){
  //Indica el tipo de tabla  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveasociados.php";

  $datosdetalles = obtenerasociadosserviciosrealizados($desdedet, $hastadet, $asociados);

  echo "<div class='text-center'><h2>".$trasserviciosrealizados.":</h2></div>";

  if (is_string($datosdetalles)){
    echo "string ". $datosdetalles;
  } //muestra el error
  elseif (count($datosdetalles)> 0){ 

    $asociadoactual = "0"; 
    $i=0;

    foreach ($datosdetalles as $linea){    
      //Determina si comienza otro asociado
      if (($linea["CODIGO"] != $asociadoactual)){                      
        if ($asociadoactual!="0") {
          //Evita que se pongan los cierres de div antes de la aperturas
          echo "</tbody></table></div>        
                </div>
                </div>
                </div>"; 
        }
        //Abre los div
        $i++;
        echo '<div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse'.$i.'">';
        //************** esta es la tabla titulo del asociado
        echo '          <input type="hidden" id="idasociado'.$i.'" value ="'.$i.'"> ';
        echo "          <br><div id='vt4_wrapper' class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>
                              <table id='tx' class='dt-responsive' cellspacing='0' width='100%';><thead>";
        echo "                  <tr>
                                    <th>".$trasasociadocodigo."</th>
                                    <th>".$trasestatus."</th>
                                    <th>".$trasasociadonombre."</th>";        
        echo "                      <th>".$trasmejorservicio."</th>";        
        echo "                      <th>".$trasserviciosrealizados."</th>";        
        echo "                  </tr>
                              </thead>
                              <tbody>";       
        echo "                   <tr";
        if ($linea['ESTATUS'] == "I"){
          echo "                     class = 'alert alert-danger' style='background-color: #f2dede;'";
        }
        echo "                    >";                   
        echo "                       <td>".$linea['CODIGO'] ."</td>";
        echo "                       <td>".$linea['ESTATUS'] ."</td>";
        echo "                       <td>".$linea['NOMBRE'] ."</td>";
        echo "                       <td>".$linea['DESCRIPCION'] ."</td>";
        echo "                       <td>".number_format($linea['REALIZADOS'], 0, '', ',')."</td>";                   
        echo "                   </tr>";
        echo '                </tbody>
                              </table>
                            </div>';
        echo'         </a>';
        echo'       </h4>
                  </div>'; //panel heading
        echo'     <div id="collapse'.$i.'" class="panel-collapse collapse">
                    <div class="panel-body">
                      <br>
                      <div id="vt'.$i.'_wrapper" class="dataTables_wrapper form-inline dt-bootstrap dt-responsive" style="overflow-x:scroll;">
                         <table id="vt'.$i.'" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%";>
                            <thead>
                              <tr>';              
        echo "                   <th colspan=3>".$trasdesde."=".$desdedet." / ".$trashasta."=".$hastadet." </th>
                              </tr>";          
        echo "                <tr>";            
        echo "                   <th>".$trasdescripcion."</th>";
        echo "                   <th>".$trasserviciosrealizados."</th>";
        echo "                </tr>
                            </thead>
                            <tbody>";       
        $asociadoactual = $linea["CODIGO"];

      } //Cambio de asociados

        echo "              <tr>";                   
        echo "                  <td>".$linea['DESCRIPCION']."</td>"; 
        echo "                  <td>".number_format($linea['REALIZADOS'], 0, '', ',')."</td>";        
        echo "              </tr>";

    }//cierra el foreach
    //pone los cierres al ultimo registro
    echo "</tbody></table></div>        
                </div>
                </div>
                </div>"; echo '<input type="hidden" id="registros" value ="'.$i.'">';   
    //Botones de opciones disponibles
    /*echo '<div class="form-group"> 
            <input type="hidden" id="registros" value ="'.$i.'"> 
              <div class="col-sm-offset-4 col-sm-6">
                <button type="button" class="btn btn-default" id="btasociadossalon" onclick="return seleccionesdetallesasociados()">'.$trasconciliaciondiario.'</button>
              </div>
          </div>';        */
  } //si la consulta devuelve resultados
  else {
    echo $trasnohayresultados;
  }    
} //mostrar listado asociados servicios realizados

function asociadosclientesatendidos($asociados, $desdedet, $hastadet){
  //Indica el tipo de tabla  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveasociados.php";

  $datosdetalles = obtenerasociadosclientesatendidos($desdedet, $hastadet, $asociados);

  echo "<div class='text-center'><h2>".$trasclientesatendidos.":</h2></div>";

  if (is_string($datosdetalles)){
    echo "string ". $datosdetalles;
  } //muestra el error
  elseif (count($datosdetalles)> 0){ 

    $asociadoactual = "0"; 
    $i=0;

    foreach ($datosdetalles as $linea){    
      //Determina si comienza otro asociado
      if (($linea["CODIGO"] != $asociadoactual)){                      
        if ($asociadoactual!="0") {
          //Evita que se pongan los cierres de div antes de la aperturas
          echo "</tbody></table></div>        
                </div>
                </div>
                </div>"; 
        }
        //Abre los div
        $i++;
        echo '<div class="panel-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a data-toggle="collapse" href="#collapse'.$i.'">';
        //************** esta es la tabla titulo del asociado
        echo '          <input type="hidden" id="idasociado'.$i.'" value ="'.$i.'"> ';
        echo "          <br><div id='vt4_wrapper' class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>
                              <table id='tx' class='dt-responsive' cellspacing='0' width='100%';><thead>";
        echo "                  <tr>
                                    <th>".$trasasociadocodigo."</th>
                                    <th>".$trasestatus."</th>
                                    <th>".$trasasociadonombre."</th>";        
        echo "                      <th>".$trasmejorcliente."</th>";        
        echo "                      <th>".$trasserviciosrealizados."</th>";   
        echo "                  </tr>
                              </thead>
                              <tbody>";       
        echo "                   <tr";
        if ($linea['ESTATUS'] == "I"){
          echo "                     class = 'alert alert-danger' style='background-color: #f2dede;'";
        }
        echo "                    >";                   
        echo "                       <td>".$linea['CODIGO'] ."</td>";
        echo "                       <td>".$linea['ESTATUS'] ."</td>";
        echo "                       <td>".$linea['NOMBRE'] ."</td>";
        echo "                       <td>".$linea['CLIENTENOMBRE'] ."</td>";
        echo "                       <td>".number_format($linea['REALIZADOS'], 0, '', ',')."</td>";                   
        echo "                   </tr>";
        echo '                </tbody>
                              </table>
                            </div>';
        echo'         </a>';
        echo'       </h4>
                  </div>'; //panel heading
        echo'     <div id="collapse'.$i.'" class="panel-collapse collapse">
                    <div class="panel-body">
                      <br>
                      <div id="vt'.$i.'_wrapper" class="dataTables_wrapper form-inline dt-bootstrap dt-responsive" style="overflow-x:scroll;">
                         <table id="vt'.$i.'" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%";>
                            <thead>
                              <tr>';              
        echo "                   <th colspan=3>".$trasdesde."=".$desdedet." / ".$trashasta."=".$hastadet." </th>
                              </tr>";          
        echo "                <tr>";            
        echo "                   <th>".$trasclientecodigo."</th>";    
        echo "                   <th>".$trascliente."</th>";
        echo "                   <th>".$trasclientetelefono."</th>";    
        echo "                   <th>".$trasclientecorreo."</th>";            
        echo "                   <th>".$trasserviciosrealizados."</th>
                                  <th>Última Visita</th>
                                  <th>Asociados</th>";
        echo "                </tr>
                            </thead>
                            <tbody>";       
        $asociadoactual = $linea["CODIGO"];

      } //Cambio de asociados

        echo "              <tr>";    
        echo "                  <td>".$linea['CLIENTECODIGO']."</td>"; 
        echo "                  <td>".$linea['CLIENTENOMBRE']."</td>"; 
        echo "                  <td><a href='tel:".$linea['TELEFONO']."'>".$linea['TELEFONO'] ."</a></td>";
        echo "                  <td><a href='mailto:".$linea['CORREO']."'>".$linea['CORREO'] ."</a></td>";
        echo "                  <td>".number_format($linea['REALIZADOS'], 0, '', ',')."</td>
                                <td>".$linea['ULTIMAVISITA'] ."</td>
                                <td>".bin2hex($linea['ASOCIADOS']) ."</td>";        
        echo "              </tr>";

    }//cierra el foreach
    //pone los cierres al ultimo registro
    echo "</tbody></table></div>        
                </div>
                </div>
                </div>"; echo '<input type="hidden" id="registros" value ="'.$i.'">';   
    //Botones de opciones disponibles
    /*echo '<div class="form-group"> 
            <input type="hidden" id="registros" value ="'.$i.'"> 
              <div class="col-sm-offset-4 col-sm-6">
                <button type="button" class="btn btn-default" id="btasociadossalon" onclick="return seleccionesdetallesasociados()">'.$trasconciliaciondiario.'</button>
              </div>
          </div>';        */
  } //si la consulta devuelve resultados
  else {
    echo $trasnohayresultados;
  }    
} //mostrar listado asociados clientes atendidos



?>