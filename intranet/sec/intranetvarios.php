<?php
error_reporting(1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['beta_enviar'])) {
        $b_nombre = $_POST["beta_name"];
        $b_seleccion = $_POST["beta_seccion"];
        $b_mensaje = $_POST["beta_mensaje"];

        $enviar = guardarBeta($b_nombre, $b_seleccion, $b_mensaje);
        if($enviar == "true"){
            $mensaje="Hola";
        } else if($enviar == "false"){
            echo "No envio";
        }
    }
}

function estadoBeta($usuario){
    include "../sec/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    /* CONSULTAR LISTADOS DE CLIENTES EN SALÓN */
    $sql = "SELECT `usuario` FROM intranet_betatester WHERE `usuario` = '$usuario'";
    $result = array();
    $i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
        $result =   "<h1 class='wow fadeInLeft' style='float: right;margin:0px;'>
                            <button type='button' class='btn btn-primary' style='margin-top: 0px;' data-toggle='modal' data-target='#betatester' data-id='$usuario'><i class='pe-7s-star'></i> ¡Soy Beta Tester!</button>
                    </h1>";
        }
    } else {
        $result = "";
    }
    return $result;
}



function guardarBeta($usuario, $seccion, $mensaje){

    include "libcon.php";

    $dbh = dbconn();

    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {

        die('Error en Conexión: ' . mysqli_error($dbh));

        exit;

    }

    $final="false";

    /* CONSULTAR LISTADOS DE CLIENTES EN SALÓN */

    $sql = "INSERT INTO intranet_betatester_comment (usuario, seccion, comentarios) VALUES ('$usuario', '$seccion', '$mensaje')";

    if (mysqli_query($dbh, $sql)) {

        $final = "true";

        return $final;
    }
    return $final;
}


function modalBetaTester(){ ?>

        <!-- COMIENZO DE MODAL: BETA TESTER  -->

        <div id="betatester" class="modal fade" role="dialog">

            <div class="modal-dialog">
                <!-- Modal content-->

                <div class="modal-content">

                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title"><b>Envíanos tus mensajes, sugerencias o reportes de errores:</b></h4>

                    </div>

                    <div class="modal-body">

                        <form action="index.php" id="beta_form" method="post" class="form-horizontal">

                            <div class="form-group">

                                <label class="control-label col-sm-9" for="filtroventa">Envíanos tus comentarios para ayudarnos a mejorar.</label>

                                <br><br><div class="col-sm-12">

                                    <div class="list-group">

                                        <span class="list-group-item"><strong>Nombre:</strong> <span id="beta_nombre"></span></span>

                                        <span class="list-group-item"><strong>Sección:</strong> <select class="form-control" name="beta_seccion" required>

                                        <option>Selecciona una opción..</option><option value="LIVE">Salvador+ Live</option><option value="CRM-APPS">CRM - Apps</option><option value="CRM-CC">CRM - Client Card</option><option value="CRM-CONVENIOS">CRM - Convenios</option><option value="DESCARGAS">Descargas</option><option value="MINUTAS-REGION">Minutas - Region</option><option value="MINUTAS-SALON">Minutas - Salón</option><option value="MINUTAS-COMITE">Minutas - Comité</option><option value="IDIOMA">Ajustes - Idioma</option><option value="OTRO">Otro</option>

                                        </select></span>

                                        <span class="list-group-item"><strong>Mensaje:</strong> <textarea class="form-control" name="beta_mensaje" cols="8" rows="auto" required></textarea></span>

                                    </div>

                                    <input type="submit" class="btn-primary form-control input-lg" name="beta_enviar" value="Enviar Comentarios">

                                </div>

                            </div>

                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="pe-7s-close"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: BETATESTER -->

<?php return; }

function modalVentasDashboard(){ 
    include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/intranetvarios.php"); ?>
        <!-- COMIENZO DE MODAL: DETALLES DASHBOARD  -->
        <div id="modaldashboard" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b><?php echo $trmodaldashboard.": "; ?><span id="aliasvd"></span></b></h4>
                    </div>
                    <div class="modal-body">
                        <span id="contenedormodaldashboard"></span>
                     </div> 
                    <div class="modal-footer">                        
                        <button type="button" class="btn btn-default" data-dismiss="modal">x</button>
                    </div>                          
                </div>
            </div>
         </div>
    <!-- FIN DE MODAL: Detalles Dashboard -->

<?php }

function detalleVD($datos){
    include "../sec/libfunc.php";
    $cod = base64_decode($datos);
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "idsalon=$cod&funcion=detalleventadashboard", $resulta);

    if ($error == ""){

        $manage = (array) json_decode($resulta, true);  
        tablaDetalleVD($manage);      
        return;
    }

    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        echo $msg;
        return;
    }
}

function tablaDetalleVD($datos){
   if (session_status() === PHP_SESSION_NONE) {
                session_start();
   }
   include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/intranetvarios.php"); ?>
    <div class="table-responsive" style="margin-left: -10px;margin-right: -10px;">          
        <table class="table table-condensed table-bordered">
            <thead>
                <tr>
                  <th style="padding: 10px 20px;"><?php echo $trdbclfecha; ?></th>
                  <th style="padding: 10px 7px;"><?php echo $trdbcltotal; ?></th>
                  <th style="padding: 10px 7px;"><?php echo $trdbclinventario; ?></th>
                  <th style="padding: 10px 7px;"><?php echo $trdbclservicios; ?></th>
                  <th style="padding: 10px 7px;"><?php echo $trdbclclientestotales; ?></th>
                  <th style="padding: 10px 7px;"><?php echo $trdbclclientesperdidos; ?></th>
                </tr>
            </thead>
            <tbody>

<?php

    if(empty(array_filter($datos))){
        echo "<tr><td colspan='6' style='text-align: center;'>N/D</td></tr>";
    }

        foreach ($datos as $dt) {
             if($dt["TOTALMONTO"] !== ""){
               $resulta .=             "<tr><td style='vertical-align: middle;'>".$dt["FECHASALON"]."</td>";
               $resulta .=                 trendingMonto($dt["TOTALMONTO"], $dt["PROMTOTALMONTO"]);
               $resulta .=                 trendingMonto($dt["VENTASINVENTARIOMONTO"], $dt["PROMVENTASINVENTARIOMONTO"]);
               $resulta .=                 trendingMonto($dt["VENTASSERVICIOSMONTO"], $dt["PROMVENTASSERVICIOSMONTO"]);
               $resulta .=                 trendingMonto($dt["CLIENTESATENDIDOS"], $dt["PROMCLIENTESATENDIDOS"]);
               $resulta .=                 trendingMonto($dt["CLIENTESENESPERA"], $dt["PROMCLIENTESENESPERA"]);
               $resulta .=             "</tr>";
            }
           }
           echo $resulta; 
           ?>

            </tbody>
        </table>
    </div>                                   

<?php  }


function resumenventa1($user){

    include "../sec/libfunc.php";
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$user&clave=&funcion=regionesusuario", $resulta);

    if ($error == ""){

        $final = $resulta;
        $manage = (array) json_decode($final, true);        
        foreach ($manage     as $region) {

            $miregion = $region['CODIGO'];
            $miregiondesc = $region['DESCRIPCION'];
            $resulta2 = "";
            $error2 = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$user&region=$miregion&funcion=salonesusuario", $resulta2);
            if ($error2 == ""){
                $final2 = $resulta2;
                $manage2 = (array) json_decode($final2, true);
            }
        }

        return;
    }

    else{

        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        echo $msg;
        return;

    }
}



function resumenventa3($user){

    include "../sec/libfunc.php";
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$user&clave=&funcion=resumenventaintranet", $resulta);
    if ($error == ""){
        $final = $resulta;
        $manage = (array) json_decode($final, true);        

        echo rventas1($manage);
        return;

    }
    else{

        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        echo $msg;
        return;

    }    
}

function rventas1($datos){

    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/intranetvarios.php";
    foreach ($datos as $dat) {  ?>

    <div class="col-lg-6 col-md-12 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="orange">
                <!--<i class="material-icons pe-7s-note2"></i>-->
                <?php echo verificarRegion($dat["CODIGO"]); ?>
            </div>
            <div class="card-content">
                <p class="category"><?php echo $tabventas.": ".date("d/m",strtotime("-1 days"));?></p>
                <h3 class="title"><?php echo $dat["DESCRIPCION"]; ?></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <div class="table-responsive" style="margin-left: -10px;margin-right: -10px;">          
                    <table id="<?php echo 'trvd'.$dat['CODIGO']; ?>" class="table table-condensed table-bordered">
                      <thead>
                        <tr>
                          <th onclick="sortTable(<?php echo '0, '.(string)$dat['CODIGO']; ?>)" style="padding: 10px 20px;">Salón</th>
                          <th onclick="sortTable(<?php echo '1, '.(string)$dat['CODIGO']; ?>)" style="padding: 10px 7px;">Total (Imp. exc)</th>
                          <th onclick="sortTable(<?php echo '2, '.(string)$dat['CODIGO']; ?>)" style="padding: 10px 7px;">Inventario</th>
                          <th onclick="sortTable(<?php echo '3, '.(string)$dat['CODIGO']; ?>)" style="padding: 10px 7px;">Servicios</th>
                          <th onclick="sortTable2(<?php echo (string)$dat['CODIGO']; ?>)" style="padding: 10px 7px;">Clientes Totales</th>
                          <th onclick="sortTable(<?php echo '5, '.(string)$dat['CODIGO']; ?>)" style="padding: 10px 7px;">Clientes Perdidos</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($dat as $dt) {

                    if(substr( $dt["CODIGOSALON"], 0, 1 ) !== "S"){ continue; } else {
                        if($dt[0]["TOTALMONTO"] == ""){
                            echo "<tr><td><a href = '#' data-toggle='modal' data-target='#modaldashboard' data-ns='".$dt['ALIAS']."' data-cs='". base64_encode($dt['CODIGOSALON'])."'>".$dt["ALIAS"]."</td><td colspan='5' style='text-align: center;'>N/D</td></tr>";
                        } else if($dt[0]["TOTALMONTO"] !== ""){ ?>
                            <tr>
                                <td style="vertical-align: middle;"><a href = "#" data-toggle="modal" data-target="#modaldashboard" data-ns="<?php echo $dt["ALIAS"]; ?>" data-cs="<?php echo base64_encode($dt["CODIGOSALON"]); ?>"><?php echo $dt["ALIAS"]; ?></a></td>
                            <?php echo trendingMonto($dt[0]["TOTALMONTO"], $dt[0]["PROMTOTALMONTO"]);
                                echo trendingMonto($dt[0]["VENTASINVENTARIOMONTO"], $dt[0]["PROMVENTASINVENTARIOMONTO"]);
                                echo trendingMonto($dt[0]["VENTASSERVICIOSMONTO"], $dt[0]["PROMVENTASSERVICIOSMONTO"]);
                                echo trendingMonto($dt[0]["CLIENTESATENDIDOS"], $dt[0]["PROMCLIENTESATENDIDOS"]);
                                echo trendingMonto($dt[0]["CLIENTESENESPERA"], $dt[0]["PROMCLIENTESENESPERA"]);
                                echo "</tr>";
                        } } } ?>

                    </tbody>
                  </table>
                  </div>                                   
                </div>
            </div>
        </div>
    </div>
<?php }



}



function verificarRegion($codigoReg){

    switch ($codigoReg) {

        case '1':

            # VEN

            $flag = "<img src='http://www.salvadorhairdressing.com/images/flags/ve1.png' width='30px' height='22px'>";

            return $flag;

            break;

        case '2':

            # PAN

            $flag = "<img src='http://www.salvadorhairdressing.com/images/flags/pty1.png' width='30px' height='22px'>";

            return $flag;

            break;

        case '3':

            # USA

            $flag = "<img src='http://www.salvadorhairdressing.com/images/flags/usa1.png' width='30px' height='22px'>";

            return $flag;

            break;

        case '72':

            # REPDOM

            $flag = "<img src='http://www.salvadorhairdressing.com/images/flags/domrep1.png' width='30px' height='22px'>";

            return $flag;

            break;

        case '249':

            # COL

            $flag = "<img src='http://www.salvadorhairdressing.com/images/flags/co1.png' width='30px' height='22px'>";

            return $flag;

            break;

        case '302':

            # EC

            $flag = "<img src='http://www.salvadorhairdressing.com/images/flags/ec1.png' width='30px' height='22px'>";

            return $flag;

            break;

        case '304':

            # CURZ

            $flag = "<img src='http://www.salvadorhairdressing.com/images/flags/cu1.png' width='30px' height='22px'>";

            return $flag;

            break;

        case '376':

            # MX

            $flag = "<img src='http://www.salvadorhairdressing.com/images/flags/mex.png' width='30px' height='22px'>";

            return $flag;

            break;

        case '378':

            # PE

            $flag = "<img src='http://www.salvadorhairdressing.com/images/flags/per.png' width='30px' height='22px'>";

            return $flag;

            break;

        case '380':

            # CH

            $flag = "<img src='http://www.salvadorhairdressing.com/images/flags/chile128.png' width='30px' height='22px'>";

            return $flag;

            break;

        case '382':

            # CR

            $flag = "<img src='http://www.salvadorhairdressing.com/images/flags/cr128.png' width='30px' height='22px'>";

            return $flag;

            break;

            

        default:

            # code...

            break;

    }



}



function trendingMonto($actual, $promedio){

    if($actual > $promedio){

        $resultado = "<td style='text-align: center;'>".number_format($actual,2)."<br><div style='width: 85%;'><a href='#c6' data-toggle='tooltip' data-placement='bottom' title='Monto por encima del promedio de últ. 30 dias'><img src='/intranet/componentes/images/trending-up-g.png'></a></div></td>";

        return $resultado;

    } else if($actual < $promedio){

        $resultado = "<td style='text-align: center;'>".number_format($actual,2)."<br><div style='width: 85%;'><a href='#c6' data-toggle='tooltip' data-placement='bottom' title='Monto por debajo del promedio de últ. 30 dias'><img src='/intranet/componentes/images/trending-down-r.png'></a></div></td>";

        return $resultado;

    } else if($actual == $promedio){

        $resultado = "<td style='text-align: center;'>".number_format($actual,2)."<br><div style='width: 85%;'><a href='#c6' data-toggle='tooltip' data-placement='bottom' title='Monto se mantiene igual al promedio de últ. 30 dias'><img src='/intranet/componentes/images/trendin-flat-g.png'></a></div></td>";

        return $resultado;

    }

}

?>