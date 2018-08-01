<?php
include_once("seguro.php");
function opcionVentaTotal($salon, $paso){
    if(isset($_SESSION["vtadia"])){
        unset($_SESSION["vtadia"]);
    } else if(isset($_SESSION["vtadiaadicional"])){
        unset($_SESSION["vtadiaadicional"]);
    } else if(isset($_SESSION["tv"])){
        unset($_SESSION["tv"]);
    }
    if($paso == 1){
        $_SESSION["calendar_live"] = 1;
        filtroRangoVta();
        return;
    } else if ($paso == 2){
        $desde = $_POST["desde"];
        $hasta = $_POST["hasta"];
        $_SESSION["tabla_basica"] = "1";
        opcionVentaTotalResultado($desde, $hasta, $salon);
        return;
        }
}
// PASO 1
function filtroRangoVta(){
    include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/ventas.php");
    $opc = $_GET['o'];
    
    echo "<form action='?o=$opc' id='filtrosSalon' method='POST' class='form-horizontal'>";?>
            <div class="form-group">
                <label class="control-label col-sm-4" for="rango"><?php echo $trvtarango; ?></label>
                <div class="col-sm-6">
                    <input type='text' class="form-control" id="date_desde" name='desde' placeholder="mm/dd/aaaa" required />  <?php echo $trRangoA; ?> <input type='text' class="form-control" id="date_hasta" name='hasta' placeholder="mm/dd/aaaa" required />
                </div>
            </div>
            <div class="form-group"> 
                <div class="col-sm-offset-4 col-sm-6">
                  <button type="submit" class="btn" name="submitRangoVTA"><?php echo $trvtaboton1; ?></button>
                </div>
            </div>
    </form>
<?php }

//PASO 2
function opcionVentaTotalResultado($desde, $hasta, $salon){
    require_once "armarconsulta.php";
    list($idsalon,$rutasalon) = explode(";", $salon);
    
    $rutasalon2 = base64_decode($rutasalon);
    
    $desde1 = date_create($desde);
    $desde2 = date_format($desde1, 'm/d/Y');

    $hasta1 = date_create($hasta);
    $hasta2 = date_format($hasta1, 'm/d/Y');
    
    $filtros = $desde2.";".$hasta2;
    
    $resulta = "";
    $error = hacerpost("$rutasalon2/apilivesalon.php?", "clavebd=salvasis1&consultas=".ventatotal($desde2, $hasta2), $resulta);
    if ($error == ""){
        $_SESSION["filtros_ventas"] = base64_encode($filtros);
        $manage = (array) json_decode($resulta, true);
        tablaVenta($manage, $desde2, $hasta2, $rutasalon2);
        return;
    }
    else{ 
        echo "<div class='alert alert-warning'>
                    $trpaso2Error<br>$error
                  </div>";
        return;
    }    
}

function tablaVenta($datos, $desde, $hasta, $rutasalon){
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/ventas.php";    
    ?>
      <div class="text-center">
       <?php echo "<h2>".$trvtatitulo1."</h2><h4>".$trvtatitulo2." ".$desde." $trRangoB ".$hasta."</h4></div>";?>
      <div class="row">
            <div class="col-md-8 col-sm-8 text-center" id="regiones">
                <div class="col-sm-6 feat-list">
                <i class="pe-7s-cash pe-5x pe-va wow fadeInUp" data-wow-delay="0.2s" id="txNg"></i>
                <div class="inner">
                    <a href="#" data-toggle="modal" data-target="#filtroventas">
                        <h4 id="txNg"><?php echo "<b>". $trvtatitulo3 ."</b><br>Bs. ". number_format((float)$datos[0][0]["TOTAL"], 2, '.', ','); ?></h4></a>
                    </div>
                </div></div>
        </div>      
      <br><div class="dataTables_wrapper form-inline dt-bootstrap">
      <table id="vt3" class="table table-striped table-bordered dt-responsive" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th colspan="2"><?php echo $trVTAT1;?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($datos[0] as $dat){
        echo "<tr><td><h4>$trvtaNeto</h4></td><td><a href='salon.php?vd=A&p=11' class='btn btn-link'>".number_format((float)$dat["NETO"], 2, '.', ',')."</a></td></tr>
                <tr><td><h4>$trvtaImp</h4></td><td><a href='salon.php?vd=A&p=11' class='btn btn-link'>".number_format((float)$dat["MONTOIMPUESTO"], 2, '.', ',')."</a></td></tr>
                <tr><th colspan='2' id='txDest'>$trVTAT2</th></tr>
                <tr><td><h4>$trvtaEfec</h4></td><td><a href='salon.php?vd=A&p=11' class='btn btn-link'>".number_format((float)$dat["EFECTIVO"], 2, '.', ',')."</a></td></tr>
                <tr><td><h4>$trvtaECXC</h4></td><td><a href='salon.php?vd=A&p=11' class='btn btn-link'>".number_format((float)$dat["CXCEFECTIVO"], 2, '.', ',')."</a></td></tr>
                <tr><td><h4>$trVTAChequeC</h4></td><td><a href='salon.php?vd=A&p=11' class='btn btn-link'>".number_format((float)$dat["CXCCHEQUE"], 2, '.', ',')."</a></td></tr>
                <tr><td><h4>$trvtaChTr</h4></td><td><a href='salon.php?vd=A&p=11' class='btn btn-link'>".number_format((float)$dat["CHEQUE"], 2, '.', ',')."</a></td></tr>
                <tr><td><h4>$trVTATDB</h4></td><td><a href='salon.php?vd=A&p=11' class='btn btn-link'>".number_format((float)$dat["TARJETADEBITO"], 2, '.', ',')."</a></td></tr>
                <tr><td><h4>$trVTATDC</h4></td><td><a href='salon.php?vd=A&p=11' class='btn btn-link'>".number_format((float)$dat["TAARJETACREDITO"], 2, '.', ',')."</a></td></tr>
                <tr><td><h4>$trVTACredito</h4></td><td><a href='salon.php?vd=A&p=11' class='btn btn-link'>".number_format((float)$dat["CREDITO"], 2, '.', ',')."</a></td></tr>
                <tr><td><h4>$trVTAPropina</h4></td><td><a href='salon.php?vd=A&p=11' class='btn btn-link'>".number_format((float)$dat["PROPINA"], 2, '.', ',')."</a></td></tr>";
        echo "<tr><th colspan='2' id='txDest'>$trVTAT3</th></tr>
            <tr><td><h4>$trVTAinv</h4></td><td><a href='salon.php?vd=I&p=11' class='btn btn-link'>".number_format((float)$datos[1][0]["INVENTARIO"], 2, '.', ',')."</a></td></tr>
            <tr><td><h4>$trVTASer</h4></td><td><a href='salon.php?vd=S&p=11' class='btn btn-link'>".number_format((float)$datos[2][0]["SERVICIOS"], 2, '.', ',')."</a></td></tr>";
        }?>
    </tbody>
    </table>
  </div>
<?php }

// PASO 3: DETALLE DIARIO
function opcionVentaDetalleResultado($filtros, $tipo, $rutabd){
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/ventas.php";    
    require_once "armarconsulta.php";
    list($desde,$hasta) = explode(";", $filtros);    
    $resulta = "";
    $error = hacerpost(base64_decode($rutabd)."/apilivesalon.php?", "clavebd=salvasis1&consultas=".ventadia($desde, $hasta, $tipo), $resulta);
    if ($error == ""){
        $manage = (array) json_decode($resulta, true);        
        tablaVentaDetalle($manage, $filtros, $tipo);
        return;
    }
    else{
        echo "<div class='alert alert-warning'>
                    $trpaso3Error<br>$error
                  </div>";
    }
}

function tablaVentaDetalle($datos, $fechas, $filtro){
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/ventas.php";    
    list($desde, $hasta) = explode(";", $fechas);        
    if($filtro == "A"){
        $filtro2 = "$trsub1";
    } else if($filtro == "S"){
        $filtro2 = "$trsub2";
    }else if ($filtro == "I"){
        $filtro2 = "$trVTAinv";
    }
    ?><div class="text-center">
      <?php echo "$trVTAsub3: ".$desde." ".$trRangoB." ".$hasta;?></h4>
      </div><div class="row">
            <div class="col-md-8 col-sm-8 text-center" id="regiones">
                <div class="col-sm-6 feat-list">
                <i class="pe-7s-cash pe-5x pe-va wow fadeInUp" id="vta" data-wow-delay="0.2s"></i>
                    <div class="inner">
                    <a href="#" data-toggle="modal" data-target="#filtroventas" id="botnprueba"><h4><?php echo "<b>$trsub3:</b> $filtro2"; ?></h4></a>
                    </div>
                </div>
            </div>
        </div>
      <form name="vtadiaform" action="salon.php" method="post">
      <div class="dataTables_wrapper form-inline dt-bootstrap dt-responsive">
      <table id="vt3" class="table display responsive nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <?php echo "<th>$trh1</th>
                <th>$trh2</th>
                <th>$trh3</th>
                <th>$trh4</th>
                <th>$trh5</th>
                <th>$trh6</th>
                <th>$trh7</th>
                <th>$trvtaEfec</th>
                <th>$trh8</th>
                <th>$trVTATDB</th>
                <th>$trVTATDC</th>
                <th>$trVTACredito</th>
                <th>$trh9</th>";?>
            </tr>
        </thead>
        <tbody>
                <?php 
                foreach ($datos[0] as $item) {
                echo "<tr><td>".$item['FECHAVENTA']."</td>";
                echo "<td>".number_format((float)$item['SUBTOTAL'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['DESCUENTO'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['DESCLINEAS'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['MONTONETO'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['MONTOIVA'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['TOTAL'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['EFECTIVO'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['CHEQUE'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['TDEBITO'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['TCREDITO'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['CREDITO'], 2, '.', ',')."</td>";
                echo "<td>".number_format((float)$item['TPROPINA'], 2, '.', ',')."</td>"; 
                echo "</tr>";
                }?>
            </tbody>
            </table>
          </div>
              <input type="hidden" name="filt" value="<?php echo $filtro; ?>">
              <span id="oculto"></span><br> <div class="text-center"> 
              <button type="submit" name='submitvtadia' id="button-js" onclick="return PreSubmit(this.form);" class="btn btn-default" style="margin-top: 0px;font-weight: bold;">
                  <span class="pe-7s-right-arrow  pe-5x pe-va wow fadeInUp"></span> <?php echo $trmensaje2;?>
            </button>
                  <span class="btnreg">
               <button type='button' name='return' class='btn btn-default' style="margin-top: 0px;font-weight: bold;">
                  <?php echo "<a href='?o=".  base64_encode(104)."' id='backbtn'>";?><span class='pe-7s-left-arrow  pe-5x pe-va wow fadeInUp' style='font-size: 17px;'></span> <?php echo $trmensaje1;?> </a>
            </button> </span>
        </div>
      </form>
<?php }

// PASO 4: FACTURAS POR DIA
function ventaDiaResultado($arraydias, $filtro, $rsalon){
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/ventas.php";    
    require_once "armarconsulta.php";
    $ruta = base64_decode($rsalon);

    $resulta = "";
    $error = hacerpost("$ruta/apilivesalon.php?", "clavebd=salvasis1&consultas=".ventadetalle($arraydias, $filtro), $resulta);
    if ($error == ""){
        
        $manage = (array) json_decode($resulta, true); 
        modTablaVenta($manage, $ruta, "1;$filtro");
        return;
    } else{
        echo "<div class='alert alert-warning'>
                    $trpaso4Error<br>$error
                  </div>";
        return;
    }
}

function modTablaVenta($manage, $ruta, $datos){
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/ventas.php";    
    list($tipo,$filtro) = explode(";", $datos);
    if($tipo == 1){

    $cabecera = array(2 => "$trh10",
            4 => "$trcliente", 5 => "$trrif", 6 => "$trfacfiscal", 7 => "$trsubtotal2",
            8 => "$trh3", 9 => "$trh4", 10 => "$trh5", 11 => "$trh6", 12 => "$trh7",
        13 => "$trvtaEfec", 14 => "$trcheque2", 15 => "$trtdb2", 16 => "$trtdc2", 17 => "$trVTACredito", 18 => "$trVTAPropina");
    
    
    echo "<div class='text-center'><h2>$trVTAsub4</h2><h4>$trsub4</h4></div>";
    echo "<div class='dataTables_wrapper form-inline dt-bootstrap dt-responsive' style='overflow-x:scroll;'>
        <table id='vt3' class='table table-striped table-bordered dt-responsive' cellspacing='0' width='100%' ><thead><tr>";
    echo "<th style='text-align:center;'>$trfecha2 - <i class='glyphicon glyphicon-list-alt wow fadeInUp' data-wow-delay='0.2s' style='text-align:center;'></i></th>";

    foreach($cabecera as $cab){
            echo "<th>".$cab."</th>";
        }
        echo "</tr></thead>
              <tbody>";       
        foreach ($manage[0] as $linea){
                   echo "<tr>";
                   //echo "<td style='text-align:center;'><input type='checkbox' name='fact[]' value='".$linea['FECHAVENTA']."'> (+)</input></td>";
                   
                   //echo "<td style='text-align:center;'><br></td>";
                   echo "<td style='text-align:center;'><a href='#facturaventa' data-toggle='modal' data-id='' data-whatever='".$linea['CORRELATIVO']."' data-whatevertu='".$linea['TIPO']."' data-whatevertri='".base64_encode($ruta)."'>".$linea['FECHAVENTA']."</a></td>";
                   echo "<td><a href='#facturaventa' data-toggle='modal' data-id='' data-whatever='".$linea['CORRELATIVO']."' data-whatevertu='".$linea['TIPO']."' data-whatevertri='".base64_encode($ruta)."'>".$linea['TIPO']." - ". $linea['CORRELATIVO'] ."</a></td>";
                   //echo "<td>".$linea['CORRELATIVO']."</td>";
                   echo "<td><a href='#facturaventa' data-toggle='modal' data-id='' data-whatever='".$linea['CORRELATIVO']."' data-whatevertu='".$linea['TIPO']."' data-whatevertri='".base64_encode($ruta)."'><b>".$linea['CLIENTENOMBRE']."</b></a></td>";
                   echo "<td>".$linea['CLIENTERIF']."</td>";
                   echo "<td>".$linea['FACTURAFISCAL']."</td>";
                   echo "<td>".number_format((float)$linea['SUBTOTAL'], 2, '.', ',')."</td>";
                   echo "<td>".number_format((float)$linea['DESCUENTO'], 2, '.', ',')."</td>"; 
                   echo "<td>".number_format((float)$linea['DESCLINEAS'], 2, '.', ',')."</td>"; 
                   echo "<td>".number_format((float)$linea['MONTONETO'], 2, '.', ',')."</td>"; 
                   echo "<td>".number_format((float)$linea['MONTOIVA'], 2, '.', ',')."</td>"; 
                   echo "<td>".number_format((float)$linea['TOTAL'], 2, '.', ',')."</td>";
                   echo "<td>".number_format((float)$linea['EFECTIVO'], 2, '.', ',')."</td>";
                   echo "<td>".number_format((float)$linea['CHEQUE'], 2, '.', ',')."</td>";
                   echo "<td>".number_format((float)$linea['TDEBITO'], 2, '.', ',')."</td>";
                   echo "<td>".number_format((float)$linea['TCREDITO'], 2, '.', ',')."</td>";
                   echo "<td>".number_format((float)$linea['CREDITO'], 2, '.', ',')."</td>";
                   echo "<td>".number_format((float)$linea['PROPINA'], 2, '.', ',')."</td>";
                   //echo "<td>".number_format((float)$linea['TPROPINA'], 0, '.', ',')."</td>"; 
                   echo "</tr>";
               }
    echo "</tbody>
          </table>
          </div>";
    echo "<div class='col-sm-6 feat-list'>
              <button type='button' name='return' class='btn btn-default'>
                  <a href='?vd=$filtro&p=11' id='backbtn'><span class='pe-7s-left-arrow  pe-5x pe-va wow fadeInUp' style='font-size: 17px;font-weight: bold;'></span> $trback</a>
            </button>
        </div>";
    modalFacturaVentas();
    return ;
    }
}

// PASO 5: FACTURA INDIVIDUAL
function mostrarfactura($correlativo, $tipo, $ruta){
    include "".$_SESSION["idiomaruta"].$_SESSION["idioma"]."/ventas.php";    
    require_once "armarconsulta.php";
    require_once "libfunc.php";
    $rutab = base64_decode($ruta);

    if($tipo == "FAC"){

        include "../componentes/plantillas/facventa.php";
        $corr = array(); $corr[] = $correlativo;

        $resulta = "";
        $error = hacerpost("$rutab/apilivesalon.php?", "clavebd=salvasis1&consultas=".facturaventa($corr, $tipo), $resulta);
        if ($error == ""){
            $manage = (array) json_decode($resulta, true); 
            facventa($manage);
            return;
        } else{
            echo "<div class='alert alert-warning'>
                    $trpaso5aError<br>$error
                  </div>";
            return;
        }  
    } else {
        echo "<div class='alert alert-warning'>
                    $trpaso5bError<br>$error
                  </div>";;
            return;
    }
}

function modalFacturaVentas(){
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/ventas.php";   ?> 
    <!-- COMIENZO DE MODAL: FACTURAS VENTAS  -->
        <div id="facturaventa" class="modal fade" role="dialog">
            <div class="modal-dialog  modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b><?php echo $_SESSION["datossalon"]["NOMBREEMPRESA"]; ?></b></h4>
                    </div>
                    <div class="modal-body">
                        <?php echo "$trrif:".  $_SESSION["datossalon"]["RIF"]; ?><br>
                        <?php echo "$trtelf1:".  $_SESSION["datossalon"]["TELEFONO"] ."<br>";
                        echo "$trsub5"; ?>
                        <input type="hidden" class="form-control" id="recipient-name">
                        <span id="texto"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo /*$trclose; */ "Cerrar";?></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: F.VTA -->
<?php }

?>