<?php
function resultadoPromTotal($ruta, $tipo, $nombre){
    require_once "armarconsulta.php";
    $error = hacerpost("$ruta/apilivesalon.php?", "clavebd=salvasis1&consultas=".analisispromocion($tipo, $nombre), $resulta);
    if ($error == ""){        
        $manage  = (array)json_decode($resulta, true);              
        return $manage;   
    }
    else{ 
        $msg = "<b>Hubo un error al cargar los resultados:</b> " . $error;
        return $msg;
    }
} //resultadopromtotal

function opcionPromociones($salon, $paso, $nombre){
     require_once "libfunc.php";
    list($idsalon,$rutasalon) = explode(";", $salon);
    $rutasalon = base64_decode($rutasalon);    
    ?>  
        <div class="text-center">
      <?php echo "<h2>Listado de Promociones</h2>"; if ($paso==2){echo "<h4>Detalle Diario para: <b>".$nombre."</b></h4>";} ?>
      </div>
      <form name="promoform" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
      <div class="dataTables_wrapper form-inline dt-bootstrap dt-responsive" style="overflow-x: scroll;">
          <table id="vt" class="table table-striped table-bordered promo_table" cellspacing="0" width="100%">
              <thead>
            <tr>
                <?php 
                     if($paso==1){
                         echo "<th rowspan='2'><div class='feat-list font-icon'><i class='pe-7s-plus pe-5x pe-va wow fadeInUp animated' data-wow-delay='0.2s' style='text-align: center; visibility: visible; animation-name: fadeInUp;'></i></div></th>";
                         echo "<th rowspan='2'>Estado</th>";                    
                     }
                ?>
                <th rowspan="2"><?php if($paso==1){echo "Nombre Promo";} elseif ($paso==2){echo "Fecha";} ?></th>
                <?php 
                     if($paso==1){
                         echo "<th rowspan='2'>Fecha Inicio</th>";
                         echo "<th rowspan='2'>Fecha Final</th>";
                     }
                ?>
                <th colspan="2">Facturado Con Promo</th>
                <th colspan="2">Facturado Sin Promo</th>                         
                <th rowspan="2"><?php if($paso==1){echo "Dia semana mas utilizada";} elseif ($paso==2){echo "Dia Semana";} ?></th>
                <th rowspan="2">Hora mas Utilizada</th>
                <th rowspan="2">Clientes Nuevos</th>
                <th rowspan="2">Clientes Existentes</th>                
            </tr>
            <tr>
                <th>Monto</th>
                <th>Transacciones</th>
                <th>Monto</th>
                <th>Transacciones</th>                
            </tr>
        </thead>
        <tbody>
           <?php 
               if($paso == 1){
                  //Lista de promociones
                  $resultados = resultadoPromTotal($rutasalon, "T", "");                  
               }
               elseif ($paso == 2){
                  //Detalle de Promociones de promociones
                  $resultados = resultadoPromTotal($rutasalon, "D", $nombre);
               }
               else{
                  echo "No disponible";
               }                  
               foreach ($resultados[0] as $linea){
                   $linea['ESTADO'] = trim($linea['ESTADO']);
                   echo "<tr>";
                   if ((($linea['ESTADO']=="ACTIVA") || ($linea['ESTADO']=="HISTORICO")) &&($paso == 1)) { echo "<td style='text-align:center;'><input type='radio' name='consultar[]' value='".$linea['NOMBREPROMO']."'> (+)</input></td>";}
                   if ($paso == 2){
                      echo "<td>".$linea['FECHA']."</td>"; 
                   }
                   elseif ($paso == 1){
                      echo "<td>";
                      if ($linea['ESTADO']=="ACTIVA"){
                          echo "<img src='/intranet/componentes/images/di.png' width='32px' height='32px' alt='".$linea['ESTADO']."'>";} 
                      elseif ($linea['ESTADO']=="HISTORICO") {
                          echo "<img src='/intranet/componentes/images/pending.png' width='32px' height='32px' alt='".$linea['ESTADO']."'>";} 
                      elseif ($linea['ESTADO']=="PROGRAMADA") {
                          echo "<img src='/intranet/componentes/images/sc.png' width='32px' height='32px' alt='".$linea['ESTADO']."'>";} 
                      else {
                          echo $linea['ESTADO'];
                      }
                      echo "</td>"; 
                      echo "<td>".$linea['NOMBREPROMO']."</td>"; 
                      echo "<td>".$linea['FECHAINICIO']."</td>";
                      echo "<td>".$linea['FECHAFIN']."</td>";
                    } 

                   
                   if($linea['ESTADO']=="PROGRAMADA"){
                      echo "<td></td>";
                      echo "<td></td>";
                      echo "<td></td>";
                      echo "<td></td>";                   
                      echo "<td></td>";
                      echo "<td></td>";
                      echo "<td></td>";
                      echo "<td></td>";                   
                   } else {
                      echo "<td>".number_format((float)$linea['FACTURADOCONPROMO'], 2, '.', ',')."</td>";
                      echo "<td>".number_format((float)$linea['FACTURASCONPROMO'], 2, '.', ',')."</td>";
                      echo "<td>".number_format((float)$linea['FACTURADOSINPROMO'], 2, '.', ',')."</td>";
                      echo "<td>".number_format((float)$linea['FACTURASSINPROMO'], 2, '.', ',')."</td>";
                      echo "<td>".diasemanafb($linea['DIAMASUTILIZADA'])."</td>";
                      echo "<td>".number_format((float)$linea['HORAMASUTILIZADA'], 0, '.', ',')."</td>";
                      echo "<td>".number_format((float)$linea['CLIENTESNUEVOS'], 0, '.', ',')."</td>";
                      echo "<td>".number_format((float)$linea['CLIENTESRECURRENTES'], 0, '.', ',')."</td>";                   
                   }
                   echo "</tr>";
               }            
            ?>    
            </tbody>
            </table>
          </div>
          <?php if ($paso == 1) { echo '
          <div class="col-sm-6 feat-list">
              <input type="hidden" name="filt" value="<?php echo $filtro; ?>">
              <button type="submit" name="submitpromo" class="btn btn-default">
                  <span class="pe-7s-right-arrow  pe-5x pe-va wow fadeInUp"></span> Consultar Selección(es)
            </button>
        </div>';} else if($paso == 2) {?>
          <div class="col-sm-6 feat-list">
              <button type="button" name="return" class="btn btn-default">
                  <a href="javascript:history.go(-1)" id="backbtn"><span class="pe-7s-left-arrow  pe-5x pe-va wow fadeInUp" style="font-size: 17px;font-weight: bold;"></span> Regresar</a>
            </button>
        </div>
        <?php } ?>
      </form>   

<?php } ?>