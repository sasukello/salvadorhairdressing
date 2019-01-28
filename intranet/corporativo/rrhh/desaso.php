<?php 
 function  ListaAsociadosDesbloquear($DatoSalon){    
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/talentohumano.php";    
    require_once "../../sec/armarconsulta.php";  
    list($idsalon,$nombresalon,$rutasalon) = explode(";", $DatoSalon);
    $resulta = "";
    echo $trthSalon . " " . base64_decode($nombresalon);
    $error = hacerpost(base64_decode($rutasalon)."/apilivesalon.php?", "clavebd=salvasis1&consultas=".listaasociados(), $resulta);
    if ($error == ""){
        $manage = (array) json_decode($resulta, true);        
        tablaAsociadosDesbloquear($manage, $rutasalon);
        return;
    }
    else{
        echo "<div class='alert alert-warning'>
                    $trpaso3Error<br>$error
                  </div>";
    }
};

function ejecutardesbloquear($datos){

    require_once "../sec/armarconsulta.php";  
    require_once "../sec/libfunc.php";  

    

    list($codigoasociado, $rutabd) = explode(";", $datos);

    $rutasalon = base64_decode($rutabd);
    
    
    
    $error = hacerpost("$rutasalon/apilivesalon.php?", "clavebd=salvasis1&consultas=".consultadesbloquear($codigoasociado), $resulta);
    if ($error == ""){                
        return "";   
    }
    else{ 
        return "<b>Hubo un error al desbloquear:</b> " . $error;
    }   

};

function tablaAsociadosDesbloquear($manage, $rutasalon){
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/talentohumano.php";        
    ?><div class="text-center">
      <?php echo $trthDesbloquear." ".$trthAsociado;?></h4>
      </div><div class="row">
            <div class="col-md-8 col-sm-8 text-center" id="regiones">
                <div class="col-sm-6 feat-list">                
                </div>
            </div>
        </div>
      <form name="desasoform" action="index.php" method="post">
      <div class="dataTables_wrapper form-inline dt-bootstrap dt-responsive">
      <table id="tadesaso" class="table display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <?php echo "<th>$trthCodigo</th>
                <th>$trthAsociado</th>
                <th>$trthDesbloquear</th>";?>
            </tr>
        </thead>
        <tbody>
                <?php 
                foreach ($manage[0] as $item) {
                echo "<tr><td>".$item['CODIGO']."</td>";
                echo "<td>".$item['NOMBRE']."</td>";
                echo "<td id='".$item['CODIGO']."'><input type='button' value='".$trthDesbloquear."' id='".$item['CODIGO']."' name='desbloquear[]' onclick=" .'"desbloquearasociado('. "'".$item['CODIGO'] .";".$rutasalon."')". '"' ."/></td>";                
                echo "</tr>";
                }?>
            </tbody>
            </table>
          </div>
       </div>
      </form>

<?php };
?>