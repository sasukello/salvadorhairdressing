<?php
   

   if (session_status() === PHP_SESSION_NONE) {
       session_start();
    }

   if ($_SERVER["REQUEST_METHOD"] == "GET") {
      if (isset($_GET["m"])){
      $m = $_GET["m"];      
      pedirlinea($m, base64_decode($_SESSION["ruta"]));}
   }
   function urlsafe_b64decode($string) {
    $data = str_replace(array('-','_','.'),array('+','/','='),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
   }
   function pedirinventarioestadistico($marca, $linea, $rutasalon){
      require_once "armarconsulta.php";
      require_once "libfunc.php";
    if ($linea==""){
      $linea = 0;
    }    
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".inventarioestadistico($marca, $linea), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);      
        return $manage;
    }
    else{ 
        echo "Error al recuperar el inventario - ".$error;
    }
   }//Pide el inventario estadistico

   function pedirmarca($rutasalon){
      require_once "armarconsulta.php";
      require_once "libfunc.php";

    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".listamarcas(), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);      
        foreach ($manage[0] as $linea){
          echo "<option value='".$linea["CODIGO"]."'>".$linea["NOMBRE"]."</option>";  
        } //Recorre las marcas  
    }
    else{ 
        $msg = "<b>Hubo un error al cargar los resultados:</b> " . $error;
        echo "<option value='error'> ". $msg . "</option>";
    }
   }//Pide la lista de marcas
   
   function pedirnombremarca($marca, $rutasalon){
      require_once "armarconsulta.php";
      require_once "libfunc.php";

    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".nombremarca($marca), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);              
        return $manage[0][0]["NOMBRE"];        

    }
    else{ 
        return "<b>Hubo un error al cargar los resultados:</b> " . $error;
    }
   }//Pide elnombre  de marca

   function pedirnombrelinea($linea, $rutasalon){
      
      if ($linea==""){
         return "Todas las lineas";
         exit;
      }
      
      require_once "armarconsulta.php";
      require_once "libfunc.php";

    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".nombrelinea($linea), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);      
        return $manage[0][0]["NOMBRE"];

    }
    else{ 
        return "<b>Hubo un error al cargar los resultados:</b> " . $error;
    }
   }//Pide elnombre  de linea


   function pedirlinea($marca, $rutabd){
      require_once "armarconsulta.php";
      require_once "libfunc.php";      
      include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveestadistico.php";
    $error = hacerpost("$rutabd/apilivesalon.php?", "clavebd=salvasis1&consultas=".listalineas($marca), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);      
        echo '
        <div class="form-group">

                <label class="control-label col-sm-4" for="rango">'.$trseleccionalinea.':</label>
        <div class="col-sm-6">

                    <select name="linea" class="form-control" tabindex="1">

                                                        <option value="">-'.$trtodaslineas.'-</option>';


        foreach ($manage[0] as $linea){
          echo "<option value='".$linea["CODIGO"]."'>".$linea["NOMBRE"]."</option>";            
        } //Recorre las marcas	
                            echo '</select>

                    

                </div></div>';
    }
    else{ 
        $msg = "<b>Hubo un error al cargar los resultados:</b> " . $error;
        echo "<option value='error'> ". $msg . "</option>";
    }
   }//Pide la lista de lineas

   function pedirfiltro($salon){
   	  list($idsalon,$rutasalon) = explode(";", $salon); 
   	  $rutasalon = base64_decode($rutasalon);      
      include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveestadistico.php";
   	  echo '
      <form action="salon.php" id="filtrosinventa" method="post" class="form-horizontal">

        <div class="form-group">

                <label class="control-label col-sm-4" for="rango">'.$trseleccionamarca.':</label>

                <div class="col-sm-6">

                    <select name="marca" class="form-control" tabindex="1" onchange="loading(this.value, \'2b\');" required>

                                                        <option value="">-'.$trseleccionaOpcion.'-</option>';

                                                        
                                                        pedirmarca($rutasalon);

                    echo '</select>

                    

                </div>                
                

            </div>
        <span id = "texto"></span>                    
        <div class="form-group"> 

            <div class="col-sm-offset-4 col-sm-6">

              <button type="submit" class="btn" name="submitInventa">'.$trconsultar.'</button>

            </div>

        </div>

    </form>';
   }//Pantalla para pedir el filtro
   
   function mostrarinventario($marca,$linea,$salon){
      include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveestadistico.php";
   	  list($idsalon,$rutasalon) = explode(";", $salon); 
   	  $rutasalon = base64_decode($rutasalon);?>
   	      <div class="text-center">
      <h2><?php echo $trinventarioestadistico ?></h2><br>
      <h4><?php echo $trmarca ?> = <?php echo pedirnombremarca($marca, $rutasalon) ?> - <?php echo $trlinea ?> = <?php echo pedirnombrelinea($linea, $rutasalon) ?></h4>
      </div>
      <form name="pedido" action="salon.php" method="post">
          <?php $inventario = pedirinventarioestadistico($marca, $linea, $rutasalon);
                $marcaactual = "0"; $lineaactual = "0";                                 
                $i=0;
                foreach ($inventario[0] as $item){                    
                   //Determina si comienza otra marca o linea                                     
                   if (($item["MARCA"] != $marcaactual) || ($item["LINEA"] != $lineaactual)){                      
                      if ($marcaactual!="0") {
                       //Evita que se pongan los cierres de div antes de la aperturas
                       echo "</div>        
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
                                    <a data-toggle="collapse" href="#collapse'.$i.'">'. $trmarca .': '.$item["MARCA"]. ' - ' . $trlinea .': '. $item["LINEA"] .' </a>
                                 </h4>
                              </div>
                            <div id="collapse'.$i.'" class="panel-collapse collapse">
                         <div class="panel-body">Panel Body 
                      ';
                      $marcaactual = $item["MARCA"]; $lineaactual = $item["LINEA"]; 

                   }//Cambio de marca linea
                } //Recorre los items del inventario

         ?>
          <?php if ($paso == 1) { echo '
          <div class="col-sm-6 feat-list">
              <input type="hidden" name="filt" value="<?php echo $filtro; ?>">
              <button type="submit" name="submitpromo" class="btn btn-default">
                  <span class="pe-7s-right-arrow  pe-5x pe-va wow fadeInUp"></span> Consultar Selección(es)
            </button>
        </div>';}

        }//Pantalla para pedir el filtro 
    
   

?>