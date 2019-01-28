<?php

include_once("seguro.php");
include_once("libfunc.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['pantallainicio'])) {
      pantallainicioclientes("L");
    } //pide la pantalla de inicio
    elseif (isset($_POST['pantallaperdidos'])) {
      pantallainicioclientes("P");
    } //pide la pantalla de inicio
    elseif (isset($_POST['listadoclientesespera'])) {
      listadoclientesespera();
    } //pide el listado de clientes en espera
    elseif (isset($_POST['listadoclientes'])){    
      mostrarlistadoclientes($_POST['desde'], $_POST['hasta']);
    }//Pide el listado de clientes
    elseif (isset($_POST['listadoclientesdetalles'])){    
      mostrardetallelistadoclientes($_POST['filtroclientes']);
    }//Pide el listado de clientes
    elseif (isset($_POST['listadoclientesservicios'])){    
      mostrarlistadoclientesservicio($_POST['filtroclientes']);
    }//Pide el listado de clientes
    elseif (isset($_POST['listadoclientesperdidos'])){    
      mostrarlistadoclientesperdidos($_POST['dias'], $_POST['visitas']);
    }//Pide el listado de clientes perdidos
}  //Request del post

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET['m'])) {
      mostrardetallesespera($_GET['m']);
    } //carga los datos de servicios realizados de clientes en espera
}  //Request del get

function pantallainicioclientes($tipo){ 
  //$tipo indica si es el listado de clientes o los clientes perdidos que se quieren mostrar
  //L: Indica listado de clientes
  //P: Indica Clientes perdidos
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveclientes.php";
    global $salon;
  echo '
        <div id = "contenedor">
        <div class="form-group">';

if ($tipo == "L"){
    //Muestra los filtros de listado
   echo '
                <label class="control-label col-sm-4" for="rango">'.$trclseleccionerango.':</label> 
                <div class="col-sm-6">

                    <input type="date" class="form-control" id="desde" name="desde" required />  a <input type="date" class="form-control" id="hasta" name="hasta" required />

                </div> ';
}
elseif ($tipo == "P"){
    //Muestra los filtros de perdido
   echo '       <div class="col-sm-6">'.$trclexplicacion.'</div> 
                <div class="col-sm-6">
                    '.$trclvisitas.'<input type="number" class="form-control" id="visitas" name="visitas" value = 5  style="width: 30%;" required>
                    '.$trcldias.   '<input type="number" class="form-control" id="dias"    name="dias"    value = 90 style="width: 30%;" required>
                </div> ';
}

  echo '      </div>     

        <div class="form-group"> 

            <div class="col-sm-offset-4 col-sm-6">';

            if ($tipo == "L"){
              echo '<button type="submit" class="btn" name="listadoclientes" id="listadoclientes" style="color:red;height:50px; width:200px" onclick="return listaclientes();">'.$trcllistadocliente.'</button>';
            }elseif ($tipo == "P"){

              echo '<button type="submit" class="btn" name="clientelistado" style="color:red;height:50px; width:200px" onclick="return clientesperdidos();">'.$trclclientesperdidos.'</button>';
            }  
       echo '</div>

        </div>       

      
        <div class="form-group"> 

            <div class="col-sm-offset-4 col-sm-6">

              <button type="button" class="btn btn-default" id="btclientesespera" onclick="return listaclientesespera()">'.$trclclientessalon.'&nbsp'.clientessalon().'</button>

            </div>

        </div>
        
        <div id="listadoespera" class="form-group" style = "float:left;width:100%;"> 
        </div>  
       </div> ';
    if ($tipo == "L"){
    echo '<script>

        document.getElementById("desde").valueAsDate = new Date();

        document.getElementById("hasta").valueAsDate = new Date();

    </script> '; }?>
    <!-- COMIENZO DE MODAL: clientesespera  -->

        <div id="clientesespera" class="modal fade" role="dialog">

            <div class="modal-dialog  modal-lg">



                <!-- Modal content-->

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title"><b><?php echo $_SESSION["datossalon"]["NOMBREEMPRESA"] ?></b></h4>

                    </div>

                    <div class="modal-body">

                        <input type="hidden" class="form-control" id="recipient-name">

                        <span id="texto"></span>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

                    </div>

                </div>

            </div>

        </div>

        <!-- FIN DE MODAL: F.VTA -->
<?php } //Pantalla de seleccion de clientes

function clientessalon(){
    require_once "armarconsulta.php";
    require_once "libfunc.php";
    $rutasalon = base64_decode($_SESSION["ruta"]);

    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".clientesenespera(), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);   
        $_SESSION["listaclientesespera"] = $manage[0];   
    }
    else{ 
        return "<b>Hubo un error al cargar los clientes en espera:</b> " . $error;
    }
   
 
  return count($manage{0});
}

function obtenerlistadoclientes($desde, $hasta){
    require_once "armarconsulta.php";
    require_once "libfunc.php";   
    global $rutabd;
    $rutasalon = base64_decode($rutabd);
    $fdesde = date_create($desde); 
    $desde  = "'".date_format($fdesde, 'm/d/Y')."'";
    $fhasta = date_create($hasta); 
    $hasta  = "'".date_format($fhasta, 'm/d/Y')."'";
    echo "Desde ".$desde." Hasta ".$hasta;
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".listadoclientes($desde,$hasta), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);           
        return $manage[0];   
    }
    else{ 
        return "<b>Hubo un error al cargar los clientes en espera:</b> " . $error;
    }
   
 
  
}

function obtenerlistadoclientesdetalles($filtroclientes){
    require_once "armarconsulta.php";
    require_once "libfunc.php";   
    global $rutabd;
    $rutasalon = base64_decode($rutabd);
        
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".listadoclientesdetalles($filtroclientes), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);           
        return $manage[0];   
    }
    else{ 
        return "<b>Hubo un error al cargar los clientes en espera:</b> " . $error;
    }
   
 
  
}

function obtenerclientesservicios($filtroclientes){
    require_once "armarconsulta.php";
    require_once "libfunc.php";   
    global $rutabd;
    $rutasalon = base64_decode($rutabd);
        
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".clientesservicios($filtroclientes), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);           
        return $manage[0];   
    }
    else{ 
        return "<b>Hubo un error al cargar los clientes en espera:</b> " . $error;
    }
   
 
  
}


function mostrarlistadoclientes($desde, $hasta){
  //Indica el tipo de tabla  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveclientes.php";

  
  $datosclientes = obtenerlistadoclientes($desde, $hasta);

  echo "<div class='text-center'><h2>".$trcllistadocliente.":</h2></div>";
if (is_string($datosclientes)){
           echo $datosclientes;
} //muestra el error
elseif (count($datosclientes)> 0){ 
    echo "<br><div id='vt4_wrapper' class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

        <table id='vt4' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';><thead>";

    
    echo "<tr><th>".$trclcbclientecodigo."</th><th style='text-align:center;'>".$trclcbnombrecliente." - <i class='glyphicon glyphicon-list-alt wow fadeInUp' data-wow-delay='0.2s' style='text-align:center;'></i></th>";

    
            echo "<th>".$trclcbtelfcliente."</th>";            
            echo "<th>".$trclcbcorreocliente."</th>";
            echo "<th>".$trclcbdircliente."</th>";
            echo "<th>".$trclcbfechanacimiento."</th>";
            echo "<th>".$trclcbtieneclientcard."</th>";
            echo "<th>".$trclvisitasperiodo."</th>";
            echo "<th>".$trclgastospromedioperiodo."</th>";
        echo "</tr></thead>

              <tbody>";       
        
          foreach ($datosclientes as $linea){

                   echo "<tr>";                   
                   echo "<td>".$linea['CLIENTECODIGO'] ."</td>";
                   echo "<td style='text-align:center;'>".$linea['NOMBRE']." - <i class='glyphicon glyphicon-resize-full'></i></td>";
                   echo "<td><a href='tel:".$linea['TELEFONO']."'>".$linea['TELEFONO'] ."</a></td>";
                   echo "<td><a href='mailto:".$linea['CORREO']."'>".$linea['CORREO'] ."</a></td>";
                   echo "<td>".$linea['DIRECCION'] ."</td>";
                   echo "<td>".$linea['FECHANACIMIENTO'] ."</td>";
                   echo "<td>".$linea['TIENECLIENTCARD'] ."</td>";                  
                   echo "<td>".$linea['VISITASPERIODO'] ."</td>";
                   echo "<td>".number_format($linea['GASTOPROMEDIOPERIODO'], 2, '.', ',') ."</td>";
                   echo "</tr>";

               }
           
    echo '</tbody>

          </table>

          </div>

           <input type="hidden" name="filt" value="">

              <span id="oculto"></span><div class="text-center">

              <button type="submit" name="submitvtadia" id="button-clientes" onclick="seleccioneslistadoclientes()" class="btn btn-default" style="margin-top: 0px;">

                  <span class="pe-7s-right-arrow  pe-5x pe-va wow fadeInUp"></span> '.$trclbtndetallescliente.'

            </button>

            <button type="submit" name="submitvtadia" id="button-clientes" onclick="seleccionesserviciosclientes()" class="btn btn-default" style="margin-top: 0px;">

                  <span class="pe-7s-right-arrow  pe-5x pe-va wow fadeInUp"></span> '.$trclbtnservicioscliente.'

            </button>

            ';
} //datos de los clientes
else {
  echo $trclnohayresultados;
}    
} //mostrar listado clientes

function mostrardetallelistadoclientes($filtroclientes){
  //Indica el tipo de tabla  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveclientes.php";
  

  $datosclientes = obtenerlistadoclientesdetalles($filtroclientes);


  echo "<div class='text-center'><h2>".$trcllistadocliente.":</h2></div>";
  
  $clienteactual = "0"; 
  $i=0;

  foreach ($datosclientes as $item){                    
    //Determina si comienza otra marca o linea                                     
    if (($item["CLIENTECODIGO"] != $clienteactual)){                      
                      if ($clienteactual!="0") {
                       //Evita que se pongan los cierres de div antes de la aperturas
                       echo "</tbody></table></div>        
                       </div>
                       </div>
                       </div>"; 
                      }
                      //Abre los div
                      $i++;
                      echo '
                         <div class="panel-group">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse'.$i.'">';
                                       echo "<br><div class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

                                               <table id='vt' class='dt-responsive' cellspacing='0' width='100%';><thead>";

                                                echo "<tr><th>".$trclcbnombrecliente."</th>";    
                                                echo "<th>".$trclcbtelfcliente."</th>";            
                                                echo "<th>".$trclcbcorreocliente."</th>";
                                                
                                                echo "</tr></thead>

                                                      <tbody>";       
        
                                                     echo "<tr>";                   

                                                        echo "<td>".$item['NOMBRE']."</td>";
                                                        echo "<td><a href='tel:".$item['TELEFONO']."'>".$item['TELEFONO'] ."</a></td>";
                                                        echo "<td><a href='mailto:".$item['CORREO']."'>".$item['CORREO'] ."</a></td>";
                   
                                                     echo "</tr>";

               
           
                                                echo '</tbody>

                                                </table>

                                            </div>';

                                    echo' </a>
                                 </h4>
                              </div>
                            <div id="collapse'.$i.'" class="panel-collapse collapse">
                         <div class="panel-body">
                             <br><div id="vt'.$i.'_wrapper" class="dataTables_wrapper form-inline dt-bootstrap dt-responsive" style="overflow-x:scroll;"">
                                       <table id="vt'.$i.'" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%";><thead>
                                     <tr>';              
                                       echo "<th>".$trclcbperiodo."</th>";            
                                       echo "<th>".$trclcbmes."</th>";
                                       echo "<th>".$trclcbayo."</th>";            
                                       echo "<th>".$trclvisitasperiodo."</th>";
                                       echo "<th>".$trclgastospromedioperiodo."</th>";
                                     echo "</tr></thead>
                                     <tbody>";                             
                      $clienteactual = $item["CLIENTECODIGO"];

                   }//Cambio de cliente
                   echo "<tr>";                   

                   echo "<td>".$item['PERIODO'] ."</td>";
                   echo "<td>".$item['MES'] ."</td>";
                   echo "<td>".$item['AYO'] ."</td>";
                   echo "<td>".$item['VISITAS'] ."</td>";                          
                   echo "<td>".number_format($item['PROMGASTOS'], 2, '.', ',') ."</td>";
                   echo "</tr>";
                } //Recorre los detalles del cliente

                 echo "<input type='hidden' id='registros' value =".$i.">";

} //Mostrar detalle de listado de clientes

function mostrarlistadoclientesservicio($filtroclientes){
  //Indica el tipo de tabla  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveclientes.php";
  

  $datosclientes = obtenerclientesservicios($filtroclientes);


  echo "<div class='text-center'><h2>".$trcllistadocliente.":</h2></div>";
  
  $clienteactual = "0"; 
  $i=0;

  foreach ($datosclientes as $item){                    
    //Determina si comienza otra marca o linea                                     
    if (($item["CLIENTECODIGO"] != $clienteactual)){                      
                      if ($clienteactual!="0") {
                       //Evita que se pongan los cierres de div antes de la aperturas
                       echo "</tbody></table></div>        
                       </div>
                       </div>
                       </div>"; 
                      }
                      //Abre los div
                      $i++;
                      echo '
                         <div class="panel-group">
                            <div class="panel panel-default">
                              <div class="panel-heading">
                                 <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapse'.$i.'">';
                                       echo "<br><div class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

                                               <table id='vt' class='dt-responsive' cellspacing='0' width='100%';><thead>";

                                                echo "<tr><th>".$trclcbnombrecliente."</th>";    
                                                echo "<th>".$trclcbtelfcliente."</th>";            
                                                echo "<th>".$trclcbcorreocliente."</th>";
                                                
                                                echo "</tr></thead>

                                                      <tbody>";       
        
                                                     echo "<tr>";                   

                                                        echo "<td>".$item['NOMBRE']."</td>";
                                                        echo "<td><a href='tel:".$item['TELEFONO']."'>".$item['TELEFONO'] ."</a></td>";
                                                        echo "<td><a href='mailto:".$item['CORREO']."'>".$item['CORREO'] ."</a></td>";
                   
                                                     echo "</tr>";

               
           
                                                echo '</tbody>

                                                </table>

                                            </div>';

                                    echo' </a>
                                 </h4>
                              </div>
                            <div id="collapse'.$i.'" class="panel-collapse collapse">
                         <div class="panel-body">
                             <br><div id="vt'.$i.'_wrapper" class="dataTables_wrapper form-inline dt-bootstrap dt-responsive" style="overflow-x:scroll;"">
                                       <table id="vt'.$i.'" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%";><thead>
                                     <tr>';              
                                       echo "<th>".$trclcbasociado."</th>";                                       
                                       echo "<th>".$trclservicio."</th>";
                                       echo "<th>".$trclcantidadrealizada."</th>";
                                     echo "</tr></thead>
                                     <tbody>";                             
                      $clienteactual = $item["CLIENTECODIGO"];

                   }//Cambio de cliente
                   echo "<tr>";                                      
                   echo "<td>".$item['NOMBREASOCIADOS'] ."</td>";
                   echo "<td>".$item['DESCRIPCION'] ."</td>";
                   echo "<td>".$item['SERVICIOSREALIZADOS'] ."</td>";                                             
                   echo "</tr>";
                } //Recorre los detalles del cliente
                echo "<input type='hidden' id='registros' value =".$i.">";

} //Mostrar servicios de clientes

function listadoclientesespera(){
  //Indica el tipo de tabla
  $_SESSION["tabla_completa"] = "1";
//  $_SESSION["tabla_basica"] = "1";
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveclientes.php";
  
  echo "<div class='text-center'><h2>".$trclclientessalon.":</h2></div>";

    echo "<br><div id='vt4_wrapper' class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

        <table id='vt4' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';><thead>";

    echo "<tr><th>".$trclcbclientecodigo."</th><th style='text-align:center;'>".$trclcbnombrecliente." - <i class='glyphicon glyphicon-list-alt wow fadeInUp' data-wow-delay='0.2s' style='text-align:center;'></i></th>";

    
            echo "<th>".$trclcbtelfcliente."</th>";
            echo "<th>".$trclcbcorreocliente."</th>";
            echo "<th>".$trclcbhoraentrada."</th>";
            echo "<th>".$trclvisitas."</th>";
        echo "</tr></thead>

              <tbody>";       
        if (count($_SESSION["listaclientesespera"])> 0){ 
        foreach ($_SESSION["listaclientesespera"] as $linea){

                   echo "<tr>";                   
                   echo "<td>".$linea['CLIENTECODIGO'] ."</td>";
                   echo "<td style='text-align:center;'><a href='#clientesespera' data-toggle='modal' data-id='' data-whatever='".$linea['CORRELATIVO']."'>".$linea['CLIENTENOMBRE']." - <i class='glyphicon glyphicon-resize-full'></i></a></td>";
                   echo "<td><a href='tel:".$linea['CLIENTETELF']."'>".$linea['CLIENTETELF'] ."</a></td>";
                   echo "<td><a href='mailto:".$linea['CLIENTECORREO']."'>".$linea['CLIENTECORREO'] ."</a></td>";
                   echo "<td>".$linea['HORAIMPRESION'] ."</td>";
                   echo "<td>".$linea['VISITAS'] ."</td>";

                   
                   echo "</tr>";

               }
           }
    echo "</tbody>

          </table>

          </div>";
     echo '     <input type="hidden" name="filt" value="">

              <span id="oculto"></span><div class="text-center">

      <button type="submit" name="submitvtadia" id="button-clientes" onclick="seleccioneslistadoclientes()" class="btn btn-default" style="margin-top: 0px;">

                  <span class="pe-7s-right-arrow  pe-5x pe-va wow fadeInUp"></span> '.$trclbtndetallescliente.'

            </button>

            <button type="submit" name="submitvtadia" id="button-clientes" onclick="seleccionesserviciosclientes()" class="btn btn-default" style="margin-top: 0px;">

                  <span class="pe-7s-right-arrow  pe-5x pe-va wow fadeInUp"></span> '.$trclbtnservicioscliente.'

            </button>';

    
} //Listado de clientes en espera


function mostrardetallesespera($correlativo){
   
  global  $rutabd;
  
    require_once "armarconsulta.php";

    require_once "libfunc.php";    

    $rutaespera = base64_decode($rutabd);

        include "../componentes/plantillas/facventa.php";

        $corr = array(); $corr[] = $correlativo;



        $resulta = "";

        $error = hacerpost($rutaespera."/apilivesalon.php?", "clavebd=salvasis1&consultas=".detalleclienteespera($corr), $resulta);

        if ($error == ""){

            $manage = (array) json_decode($resulta, true); 

            serviciosrealizados($manage);

            return;

        } else{

            header("location: salon.php?f=fallo");

            return;

        }  
    

} //mostrar detalle espera

function obtenerlistadoclientesperdidos($dias, $visitas){
    require_once "armarconsulta.php";
    require_once "libfunc.php";   
    global $rutabd;
    $rutasalon = base64_decode($rutabd);
        
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".clientesperdidos($dias, $visitas), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);           
        return $manage[0];   
    }
    else{ 
        return "<b>Hubo un error al cargar los clientes en espera:</b> " . $error;
    }
   
 
  
}

function mostrarlistadoclientesperdidos($dias, $visitas){
  //Indica el tipo de tabla  
  include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveclientes.php";

  
  $datosclientes = obtenerlistadoclientesperdidos($dias, $visitas);

  echo "<div class='text-center'><h2>".$trcllistadocliente.":</h2></div>";
if (is_string($datosclientes)){
           echo $datosclientes;
} //muestra el error
elseif (count($datosclientes)> 0){ 
    echo "<br><div id='vt4_wrapper' class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>

        <table id='vt4' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%';><thead>";

    
    echo "<tr><th>".$trclcbclientecodigo."</th><th style='text-align:center;'>".$trclcbnombrecliente." - <i class='glyphicon glyphicon-list-alt wow fadeInUp' data-wow-delay='0.2s' style='text-align:center;'></i></th>";

    
            echo "<th>".$trclcbtelfcliente."</th>";            
            echo "<th>".$trclcbcorreocliente."</th>";            
            echo "<th>".$trclcbfechanacimiento."</th>";
            echo "<th>".$trclcbtieneclientcard."</th>";
            echo "<th>".$trclfechaultimavisita."</th>";
            echo "<th>".$trcldiasultimavisita."</th>";
            echo "<th>".$trclvisitasrealizadas."</th>";
        echo "</tr></thead>

              <tbody>";       
        
          foreach ($datosclientes as $linea){

                   echo "<tr>";                   
                   echo "<td>".$linea['CODIGO'] ."</td>";
                   echo "<td style='text-align:center;'>".$linea['NOMBRE']." - <i class='glyphicon glyphicon-resize-full'></i></td>";
                   echo "<td><a href='tel:".$linea['TELEFONO']."'>".$linea['TELEFONO'] ."</a></td>";
                   echo "<td><a href='mailto:".$linea['CORREO']."'>".$linea['CORREO'] ."</a></td>";                   
                   echo "<td>".$linea['FECHANACIMIENTO'] ."</td>";
                   echo "<td>".$linea['TIENECLIENTCARD'] ."</td>";                  
                   echo "<td>".$linea['ULTIMAVISITA'] ."</td>";
                   echo "<td>".$linea['DIASULTIMAVISITA'] ."</td>";
                   echo "<td>".$linea['VISITASTOTAL'] ."</td>";
                   echo "</tr>";

               }
           
    echo '</tbody>

          </table>

          </div>

           <input type="hidden" name="filt" value="">

              <span id="oculto"></span><div class="text-center">

              <button type="submit" name="submitvtadia" id="button-clientes" onclick="seleccioneslistadoclientes()" class="btn btn-default" style="margin-top: 0px;">

                  <span class="pe-7s-right-arrow  pe-5x pe-va wow fadeInUp"></span> '.$trclbtndetallescliente.'

            </button>

            <button type="submit" name="submitvtadia" id="button-clientes" onclick="seleccionesserviciosclientes()" class="btn btn-default" style="margin-top: 0px;">

                  <span class="pe-7s-right-arrow  pe-5x pe-va wow fadeInUp"></span> '.$trclbtnservicioscliente.'

            </button>

            ';
} //datos de los clientes
else {
  echo $trclnohayresultados;
}    
} //mostrar listado clientes perdidos
            

