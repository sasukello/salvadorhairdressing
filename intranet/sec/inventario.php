<?php

function opcionInventario($salon, $paso){
    if($paso == 1){
        pedirfiltro($salon);
        return;
    } else if($paso == 2){
        $codigomarca = $_POST['marca'];
        $codigolinea = $_POST['linea'];
        $_SESSION["tabla_basica"] = "1";
        $_SESSION["tabla_completa"] = "1";
        $_SESSION["tabla_responsive"] = "1";
        inventarioGeneral($codigomarca, $codigolinea, $salon);
        return;
    }
}

function pedirfiltro($salon){
    list($idsalon,$rutasalon) = explode(";", $salon);
    $rutasalon = base64_decode($rutasalon);
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveestadistico.php";
    echo '<div class="text-center"><h3>Inventario Estadístico</h3></div>
      <form action="?o='.  base64_encode(109).'" id="filtrosinventa" method="post" class="form-horizontal">
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

function inventarioGeneral($marca, $linea, $salon){
    require_once "armarconsulta.php";
    list($idsalon,$rutasalon) = explode(";", $salon);
    $rutasalon2 = base64_decode($rutasalon);

    if ($linea==""){
      $linea = 0;
    }

    $error = hacerpost("$rutasalon2/apilivesalon.php?", "clavebd=salvasis1&consultas=".  inventarioestadistico($marca, $linea), $resulta);
    if ($error == ""){
        $manage = (array) json_decode($resulta, true);
        tablaInventarioGeneral($manage, $salon);
        return;
    } else{
        echo "<div class='alert alert-warning'>$error</div>";
        return;
    }
}

function tablaInventarioGeneral($datos, $salon){
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveestadistico.php";
    list($idsalon,$rutasalon) = explode(";", $salon);
    $sugerido = array(); $i=0;
    ?>
    <script>
    function titul(id){
        newTitle = "Salvador Hairdressing - Reporte de Inventario: "+id;
        if (document.title != newTitle) {
            document.title = newTitle;
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        var marca = document.getElementById('marcaname').innerHTML;
        titul(marca);
    }, false);
    </script>
    <!-- <title>Salvador Hairdressing - Inventario:  </title>
    onLoad(titul(<?php //echo $datos[0][0]["MARCA"]?>));-->



    <div class="text-center">
       <?php
       if (isset($datos[0][0]['MARCA'])) {
            $nmarca = $datos[0][0]['MARCA'];
       } else {$nmarca = "No hubo resultados";}

       echo "<h2>".$trInvTit."</h2><h4>".$trInvSubt." - <span id='marcaname'>".$nmarca."</span></h4></div>";?>
      <form name="inventarioform" action="salon.php" method="post">
      <div class="dataTables_wrapper form-inline dt-bootstrap dt-responsive">
      <table id="vt3" class="table display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <?php echo "<th>$trInvth2</th>
                <th>$trInvth3</th>
                <th>$trInvth4</th>
                <th>$trInvth5</th>
                <th>$trInvth6</th>
                <th>$trInvth7</th>
                <th>$trInvth8</th>
                <th>$trInvth9</th>
                <th>$trInvth10</th>
                    <th>Sugerido</th>
                        ";?>
            </tr>
        </thead>
        <tbody>
                <?php
                foreach ($datos[0] as $item) {
                echo "<tr><td>".$item['LINEA']."</td>";
                echo "<td>".$item['CODIGO']."</td>";
                echo "<td>".$item['DESCRIPCION']."</td>";
                echo "<td>".number_format((float)$item['EXISTENCIA_ACTUAL'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['SELLOUT'], 2, '.', ',')."</td>";
                echo "<td>".$item['FECHACOMPRA']."</td>";
                echo "<td>".$item['FECHAVENTA']."</td>";
                echo "<td>".number_format((float)$item['VENTASPERDIDAS'], 2, '.', ',')."</td>";
                echo "<td>".sino($item['DESCONTINUADO'])."</td>";


                $sugerido = $item['SELLOUT'] + $item['VENTASPERDIDAS'] ;
                $sugerido2 = $sugerido - $item['EXISTENCIA_ACTUAL'];
                if($sugerido == 0 && $sugerido2 == 0){
                    if($item['EXISTENCIAMINIMA'] == 0){
                        $sugeridofinal = 3;
                    } else{
                        $sugeridofinal = $item['EXISTENCIAMINIMA'];
                    }
                } else if($sugerido2 < 0){
                    $sugeridofinal = 0;
                } else {
                    $sugeridofinal = $sugerido2;
                }
                $i++;
                echo "<td>".$sugeridofinal."</td>";
                echo "</tr>";

                }?>
        </tbody>
        </table>
          </div>
              <input type = 'hidden' id = 'invent'>
              <span id="oculto"></span><br> <div class="text-center">
                <!--<button type="submit" name='submInvSug' id="button-js" onclick="PreSubmit(this.form); return false;" class="btn btn-default" style="margin-top: 0px;font-weight: bold;">
                  <span class="pe-7s-right-arrow  pe-5x pe-va wow fadeInUp"></span> <?php echo $trInvBtn1;?>
                </button>-->
                <button type='button' id="abrirSuge" class="btn btn-default one-time" data-toggle='modal' data-target='#pedidosugeridoventana' data-psug="<?php echo base64_encode(json_encode($datos));?>" data-var="<?php echo base64_encode($datos[0][0]['MARCA']);?>" onclick="blockButton();return false;"  style="margin-top: 0px;font-weight: bold;">
                    <span class="pe-7s-right-arrow  pe-5x pe-va wow fadeInUp"></span> <?php echo $trInvBtn1;?>
                </button>
                <span class="btnreg">
                    <button type='button' name='return' id="btnReg" class='btn btn-default' onclick="volver()" data-psug="<?php echo base64_encode(109);?>" style="margin-top: 0px;font-weight: bold;">
                        <span class='pe-7s-left-arrow  pe-5x pe-va wow fadeInUp' style='font-size: 17px;'></span> <?php echo $trInvBtn2;?>
                    </button>
                </span>
        </div>
      </form>

    <script type="text/javascript">
    window.onload = function () {
        if (! localStorage.justOnce) {
            localStorage.setItem("justOnce", "true");
            window.location.reload();
        }
    }
    </script>
<?php  modalSugerido(); }

function pedidoSugerido($marca, $datos){
    //require_once "libfunc.php";
    //require_once "armarconsulta.php";
    //var_dump($datos);
    $dato = json_encode($datos);
    $dato = json_decode($datos, true);
    echo "<table class='table' id='tablaSug'><thead><tr><th colspan='6' style='padding: 5px;text-align: center;'>$marca</th></tr><tr><th>LINEA</th><th>CODIGO</th><th>DESCRIPCION</th><th>EX.ACTUAL</th><th>SELLOUT</th><th>SUGERIDO</th></tr></thead><tbody>";
    foreach ($dato[0] as $dat) {
        $cond = sino($dat['DESCONTINUADO']);
        if($cond == "Si"){
            continue;
        } else if($cond == "No"){
            $sugerido = $dat['SELLOUT'] + $dat['VENTASPERDIDAS'] ;
                $sugerido2 = $sugerido - $dat['EXISTENCIA_ACTUAL'];
                if($sugerido == 0 && $sugerido2 == 0){
                    if($dat['EXISTENCIAMINIMA'] == 0){
                        $sugeridofinal = 3;
                    } else{
                        $sugeridofinal = $dat['EXISTENCIAMINIMA'];
                    }
                } else if($sugerido2 < 0){
                    $sugeridofinal = 0;
                } else {
                    $sugeridofinal = $sugerido2;
                }
            if($sugeridofinal == 0){
                continue;
            } else if($sugeridofinal !== 0){
                echo "<tr><td><i class='pe-7s-check' style='font-weight: bold;color: green;'></i> ".$dat['LINEA']."</td>";
                echo "<td>".$dat['CODIGO']."</td>";
                echo "<td>".$dat['DESCRIPCION']."</td>";
                echo "<td>".number_format((float)$dat['EXISTENCIA_ACTUAL'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$dat['SELLOUT'], 2, '.', ',')."</td>";
                echo "<td><input type='text' class='form-control input-sm' name='csugerido' value='$sugeridofinal'></input></td>";
            }
        }
    }
    echo "</tbody></table>";
    return;
}

function modalSugerido(){
        include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/liveestadistico.php"; ?>
        <!-- COMIENZO DE MODAL: PED. SUGERIDO  -->
        <div id="pedidosugeridoventana" class="modal fade" role="dialog">
            <div class="modal-dialog  modal-lg">
                <form id='miformu' name='formPedidoSugerido' method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b><?php echo "<i>$trModalTitulo</i>: ". $_SESSION["datossalon"]["NOMBREEMPRESA"]; ?></b></h4>
                    </div>

                    <div class="modal-body">
                      <h4 class="modal-title">
                      </h4>
                        <input type="hidden" class="form-control" id="recipient-name">
                        <span id="texto"></span>
                        <span id="texto2"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="osboton" class="btn btn-default" onclick="miclick();"><?php echo $trenviarord;?></button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-bottom: 10px;"><?php echo $trcerrar;?></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    <!-- FIN DE MODAL: PED. SUGERIDO -->
    <!-- FIN DE MODAL: PED. SUGERIDO2 -->
      <div class="modal fade" id="opcSugerido" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <span id="sugerido-header"></span>

            </div>
            <div class="modal-body">
                <span id="sugerido-body"></span>
                <span id="resultcopia"></span>
            </div>
            <div class="modal-footer">
                <span id="sugerido-footer"></span>
                <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-bottom: 10px;">x</button>
            </div>
          </div>
        </div>
      </div>
    <!-- FIN DE MODAL: PED. SUGERIDO2 -->

<?php }

function enviarCorreoInv1($user, $idsalon, $marca){
    require_once "correos.php";
    $datos = $user.";".$idsalon.";".$marca;
    $variable = enviarMailNotificacion($datos);
    echo $variable;
    return;
}

function enviarMailSug($mail, $dat, $adi){
    require_once "correos.php";
    //$dat1 = json_encode($dat);
    //$dat2 = json_decode($dat1, true);
    //$dat2 = json_decode($dat, true);


    //var_dump($dat2);
    $variable = enviarMailNotificacion2($mail, $dat, $adi);
    echo $variable;
    return;
}

function sino($dato){
    if($dato == "V"){
        return "Si";
    } else if($dato == "F"){
        return "No";
    }
}

function enviarPediSug($datos, $brand){
    require_once "libfunc.php";
    $resulta = "";

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $usuario = $_SESSION["codigo"];
    $usuariocom = $_SESSION["usuario"];
    $codsalon = $_SESSION["datossalon"]["CODIGOSALON"];
    date_default_timezone_set('America/Caracas');
    $time = date("ymdHi");

    $adicionales = $time.";".$usuario.";".$usuariocom.";".$codsalon.";".$brand;

    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&datos=$datos&datosad=$adicionales&funcion=enviarsugerido", $resulta);
    if ($error == ""){ // SE GUARDO INFORMACION DEL PEDIDO SUGERIDO EN LA BD DEL SERVER,
        echo '<div class="alert alert-success">
          <strong>¡Su pedido fue almacenado éxitosamente!</strong>
        </div>';
        echo "<input type='hidden' id='recipient-adic' value='$adicionales'>";
        $email = getMailSalon($codsalon);
        enviarMailSug($email, $datos, $adicionales);
        enviarPediSugPost();
        return;
    } else{
        $msg = $error;
        echo '<div class="alert alert-danger">
          <strong>¡Hubo un error!</strong> Sucedió un error al momento de almacenar tu pedido.<br><br><strong>Detalle:</strong> '.$msg.'
        </div>';

        return;
    }
        //enviarPediSugPost();
}

function enviarPediSugPost(){

    echo "<strong><i>Otras opciones a tomar:</i></strong>"; ?>
    <br><br><div class="row">
        <div id='contenido-modal-pre2'>
            <a data-toggle="modal" data-opc="copy" href="#opcSugerido"><div class="selector2" style="width: 300px;">
                <dl class="selector1 color1">
                    <dd>Enviar</dd>
                </dl>
                <dl class="selector1 color1b">
                    <dt>Copia al Correo</dt>
                </dl>
            </div></a>
            <!--<a data-toggle="modal" data-opc="download" href="#opcSugerido"><div class="selector2" style="width: 300px;">
                <dl class="selector1 color2">
                    <dd>Descargar</dd>
                </dl>
                <dl class="selector1 color2b">
                    <dt>Formato del Pedido</dt>
                </dl>
            </div></a>-->
        </div>
    </div>
    <div class="row"><span id="texto2b"></span></div>
<?php }

function getMailSalon($codsalon){
    include '../cms/library/common.php';
    $sql = "SELECT correo1, correo2 FROM web_salones WHERE ID = '".$codsalon."';";

    $search = (array) json_decode(miBusquedaSQL($sql), true);
    $email1 = $search[0]["CORREO1"];
    $email2 = $search[0]["CORREO2"];

    if($email2 == "default"){
      $email2 = "compras@salvadorhairdressing.com";
    }
    return $email2;
}


?>
