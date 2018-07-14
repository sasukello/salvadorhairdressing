<?php
function opcionLista($salon){?>
    <h3>Selecciona la Opción a Consultar:</h3>
        <div class="btn-group">
            <a href="#home" class="btn btn-primary" onClick="cargarc('<?php echo $salon;?>', 'c')">Clientes Registrados</a>
            <a href="#home" class="btn btn-primary">Clientes Sin Registrar</a>
        </div>
    
<?php }

function listacc1($paso, $user){
    include "../sec/libfunc.php";
        $resulta = "";
        $error = hacerpostcc("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$user&clave=&funcion=regionesusuario", $resulta);
        if ($error == ""){
            if (session_status() === PHP_SESSION_NONE) {
            session_start();
            }

            $manage = (array) json_decode($resulta, true);  

            
            if($paso === '1'){ ?>    
                <p><div class="form-group"><label class="control-label col-sm-4" for="paises">País:</label><div class="col-sm-6"><select onChange="listaSuc(this.value, '<?php echo $user;?>', 'e');" name='paises' class="form-control"><option value="">Selecciona una opción</option>
                <?php } else if($paso === '0'){ ?>
                <p><div class="form-group"><label class="control-label col-sm-4" for="paises">País:</label><div class="col-sm-6"><select onChange="listaSuc(this.value, '<?php echo $user;?>', 'f');" name='paises' class="form-control"><option value="">Selecciona una opción</option>
                <?php } else if($paso === 'app1'){ ?>
                <p><div class="form-group"><label class="control-label col-sm-4" for="paises">País:</label><div class="col-sm-4"><select onChange="listaSuc(this.value, '<?php echo $user;?>', 'app2');" name='paises' class="form-control"><option value="">Selecciona una opción</option>
                <?php } else if($paso === 'app3'){ ?>
                <p><div class="form-group"><label class="control-label col-sm-4" for="paises">País:</label><div class="col-sm-4"><select onChange="listaSuc(this.value, '<?php echo $user;?>', 'app4');" name='paises' class="form-control"><option value="">Selecciona una opción</option>
                <?php } else if($paso === 'cc2a'){ ?>
                <p><div class="form-group"><label class="control-label col-sm-4" for="paises">País:</label><div class="col-sm-4"><select onChange="listaSuc(this.value, '<?php echo $user;?>', 'cc2a');" name='paises' class="form-control"><option value="">Selecciona una opción</option>
                <?php } else if($paso === 'cc2b'){ ?>
                <p><div class="form-group"><label class="control-label col-sm-4" for="paises">País:</label><div class="col-sm-4"><select onChange="mostrarB('<?php echo $paso;?>');" name='paises' class="form-control"><option value="">Selecciona una opción</option>
                <?php }

                foreach ($manage as $d) {
                        echo "<option value='".$d["CODIGO"]."'>".$d["DESCRIPCION"]."</option>";
                }
                echo "</select></div>";
                /*if($paso  === 'app1'){
                    echo "<div class='col-sm-2'><input type='button' onClick='alerta();return;false;' name='botoncito' class='btn btn-active' value='Todas las Regiones'></div>";
                } else*/ 
                if($paso  === 'cc2b'){
                    echo "<div class='col-sm-2'><input type='hidden' name='estado' value='".$paso."'></div>";
                }
                echo "</div></p>";
                return;
            } else{
                $msg = "<b>Ha ocurrido un error:</b> " . $error;
                return $msg;
            }
}

function listacc2($pais, $user, $estado){
    include "../sec/libfunc.php";
        $resulta = "";
        $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$user&region=$pais&funcion=salonesusuario", $resulta);
        if ($error == ""){
            if (session_status() === PHP_SESSION_NONE) {
            session_start();
            }

            $manage = (array) json_decode($resulta, true);    ?>    
            <p><div class="form-group">
                <label class="control-label col-sm-4" for="salon">Salón:</label>
                <div class="col-sm-6"><select name='salon' class="form-control" onChange="mostrarB('<?php echo $estado;?>');"><option value="">Selecciona una opción</option>
            <?php foreach ($manage as $d) {
                echo "<option value='".base64_encode($d["CODIGOSALON"]).";".base64_encode($d["NOMBRESALON"]).";".base64_encode($d["RUTALIVE"])."'>".$d["ALIAS"]." --- ".$d["NOMBRESALON"]."</option>";
            }
            echo "</select></div></div><input type='hidden' name='estado' value='$estado'></p>";
            return;
        }
        else{
            $msg = "<b>Ha ocurrido un error:</b> " . $error;
            return $msg;
        }
}

function r1($datossalon, $estado){
    include "../sec/seguro.php";
    list($idsalon,$rutalive) = explode(";",$datossalon);
    $nomb = base64_decode($rutalive);
    $miresultado = cargarDatosCC(base64_decode($idsalon), $estado);
    echo "<h3>Reporte de Clientes con ClientCard:</h3>
        <p><b>Consulta para el salón:</b> <label style= 'color:#d34a4a'>".  /*$_SESSION["datossalon"]["NOMBREEMPRESA"]*/ $nomb."</label></p>
        <p><div class='dataTables_wrapper form-inline dt-bootstrap'>
        <table id='r1cc' class='table table-striped table-bordered dt-responsive nowrap'>
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>F. Nacimiento</th>
                <th>Género</th>
                <th>N° de ClientCard</th>
                <th>Estado</th>
              </tr>
            </thead>
        <tbody>";
    foreach($miresultado as $mr){
        echo $mr;
    }
    echo "</tbody></table></div></p>";
    return;
}

function cargarDatosCC($salon, $estado){
    include "../sec/libcon.php";
    $dbh = dbconncc();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    /* CONSULTAR LISTADOS DE CLIENTES EN SALÓN */
    $sql = "SELECT A.ORIGEN, A.CODIGOCLIENTE, B.CODIGO, B.NOMBRE, B.APELLIDO, B.TELEFONO, B.CORREO, B.FECHANACIMIENTO, B.GENERO, B.CLIENTCARD, B.ESTATUS FROM `MOVIMIENTOSPUNTOS` A INNER JOIN `CLIENTE` B ON A.`CODIGOCLIENTE` = B.`CODIGO` WHERE A.`ORIGEN` = '$salon' AND B.`ESTATUS` = $estado group by A.`CODIGOCLIENTE`";
    $result = array();
    $i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $apellido = trim(' '.$rw['APELLIDO']);
            $result[$i] = "<tr><td><a href='#mov1' data-toggle='modal' data-id='".$rw['NOMBRE'].$apellido."' data-whatever='".$rw['CODIGOCLIENTE']."'>".$rw['NOMBRE']." <i class='pe-7s-angle-right pe-5x pe-va' style='visibility: visible;font-size: 20px;vertical-align: middle;'></i></a></td><td>".$rw['TELEFONO']."</td><td>".$rw['CORREO']."</td><td>".$rw['FECHANACIMIENTO']."</td><td style='text-align: center;'>".genero($rw['GENERO'])."</td><td>".$rw['CLIENTCARD']."</td><td style='text-align: center;'>".estados($rw['ESTATUS'])."</td></tr>";
            $i++;
        }
    } else {
        $result = "<tr><td>No se encontró ningún resultado</td></tr>";
        
    }
    return $result;
}

function r2($idCliente){
    $result = cargarMovCC($idCliente);
   // $result2 = cargarMovCC($idCliente)[1];
    echo "<p><div class='dataTables_wrapper form-inline dt-bootstrap'>
        <table id='r2cc' class='table table-striped table-bordered dt-responsive nowrap'>
            <thead>
              <tr>
                <th>Fecha - Hora</th>
                <th>Descripción</th>
                <th>Origen</th>
                <th>Monto</th>
                <th>Puntos Afectados</th>
                <th>Doc. Origen</th>
              </tr>
            </thead>
        <tbody>";
    foreach($result[0] as $mr){
        echo $mr;
    }
    echo "</tbody></table></div></p><p><b>Total Puntos Acumulados:</b> ".$result[1];
    return;
}
 
function r3($salon, $idreport, $year){ 
    include "../sec/seguro.php";
    list($idsalon,$rutalive) = explode(";",$salon);
    $nomb = base64_decode($rutalive);
        
    $miresultado = ccEntregadasXmes(base64_decode($idsalon), $idreport, $year);
    echo "<h3>Reporte de ClientCards entregadas por Mes:</h3>
        <p><b>Consulta para el salón:</b> <label style= 'color:#d34a4a'>". $nomb."</label></p>
        <p><div class='dataTables_wrapper form-inline dt-bootstrap'>
        <table id='r1cc' class='table table-striped table-bordered dt-responsive nowrap'>
            <thead>
              <tr>
                <th>Año</th>
                <th>Mes</th>
                <th>ClientCard Entregadas</th>
              </tr>
            </thead>
        <tbody>";
        if(is_string($miresultado) === false){
            foreach($miresultado as $mr){
            echo $mr;
            }
        }
    echo "</tbody></table></div></p>";
    return;
}

function ccEntregadasXmes($idsalon, $idreport, $year){
    include "../sec/libcon.php";
    $dbh = dbconncc();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    /* CONSULTAR LISTADOS DE CC ENTREGADAS POR SALON Y POR MES */
    
    $sql = "SELECT YEAR(`FECHACREADO`) AS 'YEAR', MONTH(`FECHACREADO`) AS 'MES', B.ORIGEN as ORIGEN, D.NOMBRE, COUNT(*) as TOTAL
 FROM `CLIENTE` A INNER JOIN `MOVIMIENTOSPUNTOS` B on A.CODIGO = B.CODIGOCLIENTE 
INNER JOIN
    (
        SELECT CODIGOCLIENTE, MIN(FECHA) minFecha
        FROM MOVIMIENTOSPUNTOS
        GROUP BY CODIGOCLIENTE
    ) C on B.CODIGOCLIENTE = C.CODIGOCLIENTE AND
B.FECHA = C.minFecha 
INNER JOIN (
    	SELECT CODIGO, NOMBRE FROM SALONES
    ) D on B.ORIGEN = D.CODIGO
    WHERE B.ORIGEN IN ('$idsalon') AND YEAR(`FECHACREADO`) = $year GROUP BY MONTH(`FECHACREADO`), B.ORIGEN ORDER BY B.ORIGEN ASC, YEAR(`FECHACREADO`) ASC, MONTH(`FECHACREADO`) ASC";
    
    $result = array();
    $i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $result[$i] = "<tr><td>".$rw['YEAR']."</td><td>".$rw['MES']." - ".meses($rw['MES'])."</td><td>".$rw['TOTAL']."</td></tr>";
            $i++;
        }
    } else {
        $result = "<tr><td>No se encontró ningún resultado</td></tr>";
        
    }
    return $result;
}

function cargarMovCC($idC){
    include "../sec/libcon.php";
    //include "../sec/libfunc.php";
    $dbh = dbconncc();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    /* CONSULTAR MOVIMIENTOS DE UN USUARIO */
    $sql = "SELECT A.FECHA, A.HORA, A.TIPO, A.DESCRIPCION,  A.ORIGEN, A.MONTOTRANSACCION, A.PUNTOSAFECTADOS, A.CODIGOCLIENTE, A.DOCUMENTOORIGEN, B.CODIGO, B.NOMBRE, B.REGIONSALON FROM `MOVIMIENTOSPUNTOS` A INNER JOIN `SALONES` B ON A.ORIGEN = B.CODIGO WHERE A.`CODIGOCLIENTE` = '$idC'";
    $result = array();
    $i = 0;$totalp=0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $result[$i] = "<tr><td>".$rw['FECHA']." - ".$rw['HORA']."</td><td>".$rw['DESCRIPCION']."</td><td>".$rw['NOMBRE']."</td><td>".$rw['MONTOTRANSACCION']."</td><td>".tipo($rw['TIPO'])." ".$rw['PUNTOSAFECTADOS']."</td><td>".$rw['DOCUMENTOORIGEN']."</td></tr>";
            $i++;
            if($rw['TIPO'] == "I"){
                $totalp = $totalp + $rw['PUNTOSAFECTADOS'];
            } else if($rw['TIPO'] == "E"){
                $totalp = $totalp - $rw['PUNTOSAFECTADOS'];
            }
        }
    } else {
        $result = "<tr><td>No se encontró ningún resultado</td></tr>";
        
    }
    return array($result, $totalp);
}

function cargarSuc(){
    include "../sec/libcon.php";
    //include "../sec/libfunc.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    /* CONSULTAR MOVIMIENTOS DE UN USUARIO */
    $sql = "SELECT A.ID, A.CODIGO, A.CODIGOAPP, B.CAMPO, B.CAMPO2 FROM `web_salones` A INNER JOIN `ms_configuracion` B ON A.`REGIONSALON` = B.`CAMPO`";
    $result = array();
    $i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            if($rw["CODIGOAPP"] > "0"){
                $result[$i] = $rw;
                $i++;
            }
        }
    } else {
        $result = "<tr><td>No se encontró ningún resultado</td></tr>";
        
    }
    return $result;
}

function appr1($datossalon, $estado, $arraysuc){
    include "../sec/seguro.php";
    list($idsalon,$rutalive) = explode(";",$datossalon);
    $ids = base64_decode($idsalon);
    $nomb = base64_decode($rutalive);
    $miresultado = compararSalones($arraysuc, $ids);
    
    echo "<h3>Reporte de Clientes 'App' del Salón:</h3>
          <p><b>Consulta para el salón:</b> <label style= 'color:#d34a4a'>".$nomb."</label></p>";
    $resultado = app1($miresultado);
    
    echo "<p><div class='dataTables_wrapper form-inline dt-bootstrap'>
        <table id='r1app' class='table table-striped table-bordered dt-responsive nowrap'>
            <thead>
              <tr>
                <th>Usuario</th>
                <th>Correo</th>
                <th>País Registrado</th>
                <th>Última Cita</th>
              </tr>
            </thead>
        <tbody>";
    foreach($resultado as $r){
        $fech = date_create($r["Fecha"]);
        echo "<tr>";
        echo "<td>".$r['Usu']."</td><td>".$r['Usuario']."</td><td>".$r['Pais']."</td><td>".date_format($fech,"Y-m-d H:i:s")."</td>";
        echo "</tr>";
    }
    echo "</tbody></table></div></p>";
    return;
}

function appr2($datossalon, $estado, $arraysuc){
    include "../sec/seguro.php";
    list($idsalon,$rutalive) = explode(";",$datossalon);
    $ids = base64_decode($idsalon);
    $nomb = base64_decode($rutalive);
    $miresultado = compararSalones($arraysuc, $ids);
    
    echo "<h3>Reporte de Historial de Citas Programadas:</h3>
          <p><b>Consulta para el salón:</b> <label style= 'color:#d34a4a'>".$nomb."</label></p>";
    $resultado = app2($miresultado);
    //var_dump($_POST);
    echo "<p><div class='dataTables_wrapper form-inline dt-bootstrap'>
        <table id='r1app' class='table table-striped table-bordered dt-responsive nowrap'>
            <thead>
              <tr>
                <th>Fecha de Cita</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Servicio Apartado</th>
                <th>Asociado</th>
                <th>Salón</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
              </tr>
            </thead>
        <tbody>";
    foreach($resultado as $r){
        $fech = date_create($r["Fecha"]);
        $fechcre = date_create($r["FCreacion"]);
        echo "<tr>";
        echo "
              <td>".date_format($fech,"Y-m-d H:i:s")."</td>";
        echo "<td>".$r['Nombre']."</td>
              <td>".$r['Email']."</td>
              <td>".$r['Servicio']."</td>
              <td>".$r['Estilista']."</td>
              <td>".$r['Sucursal']."</td>
              <td>".estadoApp($r['Estado'],$r['Obs'])."</td>
              <td>".date_format($fechcre,"Y-m-d H:i:s")."</td>
              </tr>";
    }
    echo "</tbody></table></div></p>";
    return;
}

function compararSalones($array, $salon){
    foreach($array as $a){
        if($a["ID"] === $salon){
            return $a["CODIGOAPP"];
        } else{ continue;}
    }
}

function app2($idsalon){
   
    $resulta = "";
    
    $error = hacerpost("http://app.salvadorhairdressing.com/mob.php", "accion=rapp4&dato=$idsalon", $resulta);
    if ($error == ""){

        $manage  = (array)json_decode($resulta, true); 
        return $manage;
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        return $msg;
    }
}

function estadoApp($estado, $observacion){
    if($estado == '1'){
        return "Activa";
    } else if($estado == '0'){
        return $observacion;
    }
}

function genero($id){
    switch ($id) {
        case "0":
            return "No Indica";
            break;
        case "1":
            return "<i class='pe-7s-female pe-5x pe-va' style='visibility: visible;'></i> F";
            break;
        case "2":
            return "<i class='pe-7s-male pe-5x pe-va' style='visibility: visible;'></i> M";
            break;
        default:
            break;
    }
}

function estados($id){
    switch ($id) {
        case "0":
                return "<i class='pe-7s-close-circle pe-5x pe-va' style='visibility: visible;font-size: 20px;vertical-align: middle;color: red;'></i>";
            break;
        case "1":
            return "<i class='pe-7s-check pe-5x pe-va' style='visibility: visible;font-size: 20px;vertical-align: middle;color: green;'></i>";
            break;
        case "2":
            return "Suspendido";
            break;
        default:
            break;
    }
}

function tipo($estado){
    switch ($estado) {
        case "I":
            return "<i class='pe-7s-plus pe-5x pe-va' style='visibility: visible;font-size: 20px;vertical-align: middle;color: green;'></i>";
            break;
        case "E":
            return "<i class='pe-7s-less pe-5x pe-va' style='visibility: visible;font-size: 20px;vertical-align: middle;color: red;'></i>";
            break;
        case "":
            return "No Indicado";
            break;
        default:
            break;
    }
}

function banderas($id){
    switch ($id) {
        case '1':
            return "<a href='' data-toggle='tooltip' data-placement='top' title='Venezuela'><img id='flag' alt='ven' src='/images/flags/ve128.png'></a>";
            break;
        case '2':
            return "<a href='' data-toggle='tooltip' data-placement='top' title='Panamá'><img alt='pty' src='/images/flags/pty128.png'></a>";
            break; 
        case '3':
            return "<a href='' data-toggle='tooltip' data-placement='top' title='Estados Unidos'><img alt='usa' src='/images/flags/usa128.png'></a>";
            break;
        case '72':
            return "<a href='' data-toggle='tooltip' data-placement='top' title='República Dominicana'><img alt='repdom' src='/images/flags/domrep128.png'></a>";
            break;
        case '249':
            return "<a href='' data-toggle='tooltip' data-placement='top' title='Colombia'><img alt='col' src='/images/flags/col128.png' class='wow fadeInUp'></a>";
            break;
        case '302':
            return "<a href='' data-toggle='tooltip' data-placement='top' title='Ecuador'><img alt='ec' src='/images/flags/ec128.png'></a>";
            break;
        case '304':
            return "<a href='' data-toggle='tooltip' data-placement='top' title='Curazao'><img alt='crz' src='/images/flags/cu128.png'></a>";
            break;
        case '376':
            return "<a href='' data-toggle='tooltip' data-placement='top' title='México'><img alt='mex' src='/images/flags/mex.png'></a>";
            break;
        case '378':
            return "<a href='' data-toggle='tooltip' data-placement='top' title='Perú'><img alt='per' src='/images/flags/per.png'></a>";
            break;
        case '380':
            return "<a href='' data-toggle='tooltip' data-placement='top' title='Chile'><img alt='chl' src='/images/flags/chile128.png'></a>";
            break;
        case '382':
            return "<a href='' data-toggle='tooltip' data-placement='top' role='button' title='Costa Rica'><img alt='ven' src='/images/flags/cr128.png'></a>";
            break;
        default:
            break;
    }
}

function miBusquedaSQL($sql){

    $dbh = dbconncc();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        echo "Error BD";
        exit;
    }
    $textsql = $sql;
    $search = mysqli_query($dbh, $textsql) or die("<div class='alert alert-danger'><strong>Error 002:</strong>".mysqli_error($dbh)."</div>");
    $result = array();
    $i = 0;
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $result[$i] = $rw;
            $i++;
        }

    } else {
        $result[0] = "0";
    }
    return json_encode($result);
}

function r4($pais, $userid2, $estado, $year){
    $resulta = "";
    
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$userid2&region=$pais&funcion=salonesusuario", $resulta);
    if ($error == ""){

        $manage  = (array)json_decode($resulta, true); 
        $salones = array();
        $i=0;
        
        foreach ($manage as $sal) {
            $salones[$i] = $sal["CODIGOSALON"];
            $i++;
        }
        
        $salones2 = join("','",$salones);
        
        include "../sec/libcon.php";
        //include "../sec/libfunc.php";
        $dbh = dbconncc();
        mysqli_set_charset($dbh, 'utf8');

        if (!$dbh) {
            die('Error en Conexión: ' . mysqli_error($dbh));
            exit;
        }

        /* CONSULTAR MOVIMIENTOS DE UN USUARIO */
        $sql = "SELECT YEAR(`FECHACREADO`) AS 'ANO', MONTH(`FECHACREADO`) AS 'MES', B.ORIGEN as ORIGEN, D.NOMBRE, COUNT(*) as TOTAL
        FROM `CLIENTE` A INNER JOIN `MOVIMIENTOSPUNTOS` B on A.CODIGO = B.CODIGOCLIENTE 
        INNER JOIN
            (
                SELECT CODIGOCLIENTE, MIN(FECHA) minFecha
                FROM MOVIMIENTOSPUNTOS
                GROUP BY CODIGOCLIENTE
            ) C on B.CODIGOCLIENTE = C.CODIGOCLIENTE AND
        B.FECHA = C.minFecha
        INNER JOIN (
                SELECT CODIGO, NOMBRE FROM SALONES
            ) D on B.ORIGEN = D.CODIGO

        WHERE B.ORIGEN IN ('".$salones2."') AND YEAR(`FECHACREADO`) = ".$year." GROUP BY MONTH(`FECHACREADO`), B.ORIGEN ORDER BY B.ORIGEN ASC, YEAR(`FECHACREADO`) ASC, MONTH(`FECHACREADO`) ASC";

        $sqlregion = "SELECT NOMBRE, MONEDA FROM REGIONES WHERE CODREGION = ".$pais;
        $regionsearch = (array) json_decode(miBusquedaSQL($sqlregion), true);
        $regionname = $regionsearch[0]["NOMBRE"];

        
        $result = array();
        $j = 0;
        $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
        $match = mysqli_num_rows($search);
        if ($match > 0) {
            while ($rw = mysqli_fetch_array($search)) {
                //if($rw["CODIGOAPP"] > "0"){
                    $result[$j] = $rw;
                    $j++;
                //}
            }
            //cargoTabla
            echo "<h3>Reporte de 'ClientCards' entregadas por Mes x Salón:</h3>
                  <p><b>Consulta para la región:</b> <label style= 'color:#d34a4a'>".$regionname." - ".$year."</label></p>";

            echo "<p><div class='dataTables_wrapper form-inline dt-bootstrap'>
                <table id='r4' class='table table-striped table-bordered dt-responsive nowrap'>
                    <thead>
                      <tr>
                        <th>Año</th>
                        <th>Mes</th>
                        <th>Salón</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                <tbody>";
            foreach($result as $r){
                //$fech = date_create($r["Fecha"]);
                echo "<tr>";
                echo "<td>".$r['ANO']."</td><td>".$r['MES']."</td><td>".$r['NOMBRE']."</td><td>".$r['TOTAL']."</td>";
                echo "</tr>";
            }
            echo "</tbody></table></div></p>";
            return;

        } else {
            echo "<p><b>No se encontró ningún resultado</b></p>";

        }
        
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        echo $msg;
    }

}

function meses($id){
    switch ($id) {
        case '1':
            $mes = "Enero";
            break;
        case '2':
            $mes = "Febrero";
            break;
        case '3':
            $mes = "Marzo";
            break;
        case '4':
            $mes = "Abril";
            break;
        case '5':
            $mes = "Mayo";
            break;
        case '6':
            $mes = "Junio";
            break;
        case '7':
            $mes = "Julio";
            break;
        case '8':
            $mes = "Agosto";
            break;
        case '9':
            $mes = "Septiembre";
            break;
        case '10':
            $mes = "Octubre";
            break;
        case '11':
            $mes = "Noviembre";
            break;
        case '12':
            $mes = "Diciembre";
            break;
    }
    return $mes;
}

function hacerprueba($param){
    $resulta = "";
    
    $error = hacerpostcc("http://app.salvadorhairdressing.com/mob.php", "accion=t1&dato=Contacto", $resulta);
    if ($error == ""){

        echo $resulta;

        //$manage  = (array)json_decode($resulta, true); 
        //return $manage;
        return;
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        return $msg;
    }
}

function hacerpostcc($url, $parametros, &$resultado){
    //La funcion devuelve espacio en blanco si la variable resultado va cargada, de lo contrario devuelve error
    // abrimos la sesion cURL
    $ch = curl_init();                
    // definimos la URL a la que hacemos la peticion
    curl_setopt($ch, CURLOPT_URL,$url);
    // indicamos el tipo de peticion: POST
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);              
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    // recibimos la respuesta y la guardamos en una variable
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $remote_server_output = curl_exec ($ch);
    // cerramos la sesion cURL
    curl_close ($ch);
    //Comenzamos el manejo de errores
    if ($remote_server_output == "") {
        $remote_server_output = "Error 1: Fallo de conexion.";
    }
    if (strtoupper(substr($remote_server_output, 0, 1)) == "["){
        $resultado = $remote_server_output;
        return "";        
    }
    else {
        //Dio error
        $resultado = "";
        return $remote_server_output;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["action"])){
        if($_POST["action"] == "t1"){
            $dato = $_POST["datos"];
            hacerprueba($dato);
        }
    }
}

?>