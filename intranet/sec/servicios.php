<?php

include_once("seguro.php");
include_once("libfunc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['pantallainicio'])) {
      pantallainicioservicios();
    } //pide la pantalla de inicio    
    else if (isset($_POST['listadoserviciossalon'])) {
      listadoserviciossalon();
    } //pide la pantalla de servicios en salon
    else if (isset($_POST['listadoservicios'])) {
      mostrarlistadoservicios($_POST['desde'], $_POST['hasta']);
    } //pide la pantalla listado servicios
    
}  //Request del post




function pantallainicioservicios(){ 
  
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveservicios.php";
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

            
              echo '<button type="submit" class="btn" name="listadoservicios" id="listadoservicios" style="color:red;height:50px; width:200px" onclick="return listaservicios();">'.$trlistaservicios.'</button>';
            
       echo '</div>

        </div>       

      
        <div class="form-group"> 

            <div class="col-sm-offset-4 col-sm-6">

              <button type="button" class="btn btn-default" id="btserviciossalon" onclick="return listadoserviciossalon()">'.serviciossalon().'</button>

            </div>

        </div>
        
        <div id="listadoespera" class="form-group" style = "float:left;width:100%;"> 
        </div>  
       </div> ';
    
    echo '<script>

        document.getElementById("desde").valueAsDate = new Date();

        document.getElementById("hasta").valueAsDate = new Date();

    </script> ';  } //Pantalla de seleccion de servicios

  function  serviciossalon(){
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveservicios.php"; 
    require_once "armarconsulta.php";
    require_once "libfunc.php";
    $rutasalon = base64_decode($_SESSION["ruta"]);

    $error = hacerpost($rutasalon."/apilivesalon.php?", "clavebd=salvasis1&consultas=".serviciosactivos(), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);   
        $_SESSION["listaserviciosactivos"] = $manage[0];         
        return $trserviciossalon . " - " . count($manage[0]);
    }
    else{ 
        return "<b>Hubo un error al cargar los servicios activos:</b> " . $error;
  }
      
   
} //Servicios realizados en el dia

function listadoserviciossalon(){
  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveservicios.php";
  
  echo "<div class='text-center'><h2>".$trserviciossalon.":</h2></div>";

    echo "<br><div id='vt4_wrapper' class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

        <table id='vt4' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';><thead>";

    echo "<tr><th style='text-align:center;'>".$trservicionombre." - <i class='glyphicon glyphicon-list-alt wow fadeInUp' data-wow-delay='0.2s' style='text-align:center;'></i></th>";            
            echo "<th>".$trserviciosrealizados."</th>";            
        echo "</tr></thead>

              <tbody>";               
        if (count($_SESSION["listaserviciosactivos"])> 0){ 
        foreach ($_SESSION["listaserviciosactivos"] as $linea){

                   echo "<tr>";                   
                   echo "<td>".$linea['DESCRIPCION'] ."</td>";                   
                   echo "<td>".$linea['REALIZADOS'] ."</td>";

                   
                   echo "</tr>";

               }
           }
    echo "</tbody>

          </table>

          </div>";

    
} //Listado de SERVICIOS REALIZADOS EN EL DIA

function obtenerlistadoservicios($desde, $hasta){
    require_once "armarconsulta.php";
    require_once "libfunc.php";   
    global $rutabd;

    $fdesde = date_create($desde); 
    $desde  = date_format($fdesde, 'm/d/Y');
    $fhasta = date_create($hasta); 
    $hasta  = date_format($fhasta, 'm/d/Y');
    $rutasalon = base64_decode($rutabd);
        
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".listadoservicios($desde, $hasta), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);           
        return $manage[0];   
    }
    else{ 
        return "<b>Hubo un error al cargar el listado de servicios:</b> " . $error;
    }
   
 
  
}


function mostrarlistadoservicios($desde, $hasta){
  //Indica el tipo de tabla  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveservicios.php";

  
  $datosservicios = obtenerlistadoservicios($desde, $hasta);
 
if (is_string($datosservicios)){
           echo $datosservicios;
} //muestra el error
elseif (count($datosservicios)> 0){ 
    echo "<br><div id='vt4_wrapper' class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

        <table id='vt4' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';><thead>";

    
    echo "<tr><th colspan=3>".$trsrdesde."=".$desde." / ".$trsrhasta."=".$hasta." </th></tr>
          <tr><th>".$trservicionombre."</th><th>".$trsrtipo."</th><th>".$trserviciosrealizados."</th>";
            echo "<th>".$trsrtotal."</th>";            
            echo "<th>".$trsrmonto."</th>";            
            echo "<th>".$trsrdescuentolineas."</th>";            
            echo "<th>".$trsrdescuentoglobal."</th>";
            echo "<th>".$trsrmontoredimido."</th>";
            
        echo "</tr></thead>

              <tbody>";       
        
          foreach ($datosservicios as $linea){

                   echo "<tr>";                   
                   echo "<td>".$linea['DESCRIPCION'] ."</td>";
                   echo "<td>".$linea['TIPO'] ."</td>";
                   echo "<td>".number_format($linea['REALIZADOS'], 0, '', ',')."</td>";
                   echo "<td>".number_format($linea['PRECIOSINIMPUESTO'] - $linea['DESCLINEAS'] - $linea['DESCUENTOGLOBAL'] - $linea['MONTOREDIMIDO'], 2, '.', ',')."</td>";
                   echo "<td>".number_format($linea['PRECIOSINIMPUESTO'], 2, '.', ',')."</td>";                   
                   echo "<td>".number_format($linea['DESCLINEAS'], 2, '.', ',')."</td>";                   
                   echo "<td>".number_format($linea['DESCUENTOGLOBAL'], 2, '.', ',')."</td>";
                   echo "<td>".number_format($linea['MONTOREDIMIDO'], 2, '.', ',')."</td>";
                   
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

              <button type="button" class="btn btn-default" id="btasociadossalon" onclick="return seleccioneslistadoasociados('."'".'d'."'".')">$listaservasociados</button>              

            </div>                                 

        </div>  ';

} //datos de los SERVICOS
else {
  echo $trclnohayresultados;
}    
} //mostrar listado servicios

?>