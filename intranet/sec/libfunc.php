<?php
//*********************************************
//*** funcion para manejar el Login Web     ***
//*********************************************

set_time_limit(30);
error_reporting(1);
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function intra_uno($user, $contra){
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$user&clave=$contra&funcion=opcionespermitidas", $resulta);
    if ($error == ""){
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        $final = $resulta;

        $manage = (array) json_decode($final);
        $tamaño = count($manage);
        $accesos = array();

        for($i=1;$i<$tamaño;$i++){
            $accesos[$i] = $manage[$i]->NOMBREITEM;
        }

        $_SESSION["accesos"] = serialize($accesos);
        $_SESSION["codigo"] = $manage[0]->CODIGO;
        $_SESSION["usuario"] = $manage[0]->NOMBRECOMPLETO;
        $_SESSION["idioma"] = $manage[0]->IDIOMA;
        $_SESSION["permiso"] = $manage[0]->NIVEL;
        $_SESSION["todoinfo"] = $final;

        $_SESSION["idiomaruta"] = "/home/sopor907/public_html/intranet/lang/";
        //$_SESSION["idiomaruta"] = "C:/xampp/htdocs/Salvador/intranet/lang/";


        $_SESSION["hash"] = "s6a5486dasdas31";
        header("location: index.php");
        return;
    }
    else{
        //header("location: login.php?m=".$error);
        return validate_input($error);
    }

    return $resulta;
    }

//*********************************************
//*** funcion para hacer post desde php     ***
//*********************************************
function hacerpost($url, $parametros, &$resultado){
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

//*********************************************
//*** funcion para poblar el menu principal ***
//*********************************************
function menu($nombre){
    switch($nombre){
        case 'Accesoremoto1':?>
        <div class="col-sm-6 feat-list">
            <i class="pe-7s-note pe-5x pe-va wow fadeInUp" data-wow-delay="0.5s"></i>
            <div class="inner">
                <a href="live"><h4>Salvador+ Live</h4></a>
                <p>Encuentra aquí los últimos movimientos y reportes de operaciones de tu salón. <span style="font-weight: bold;font-size:12px;">(El correcto funcionamiento depende de la conexión a internet de tu salón)</span></p>
            </div>
        </div>
        <?php break;
        case 'Descargas1':?>
        <div class="col-sm-6 feat-list">
            <i class="pe-7s-cloud-download pe-5x pe-va wow fadeInUp"></i>
            <div class="inner">
                <?php echo "<a href='descargas/admin/index.php'><h4>Descargas</h4></a>"; ?>
                <p>En esta sección, encontrarás en un sólo lugar todos los recursos necesarios de Salvador Hairdressing, para tu disposición.
                </p>
            </div>
        </div>
        <?php break;
        case 'MysteryShopper1':?>
            <div class="col-sm-6 feat-list">
                <i class="pe-7s-users pe-5x pe-va wow fadeInUp" data-wow-delay="0.4s"></i>
                <div class="inner">
                    <a href="/mysteryshopper/admin"><h4>Mystery Shopper</h4></a>
                    <p>Acceso directo al panel de Administrador del programa: Mystery Shopper. ¡Programa visitas y Consulta Reportes desde aquí!</p>
                </div>
            </div>
        <?php break;
        case 'Auditoria1':?>
            <div class="col-sm-6 feat-list">
                <i class="pe-7s-note2 pe-5x pe-va wow fadeInUp" data-wow-delay="0.2s"></i>
                <div class="inner">
                    <a href="auditorias"><h4>Auditoría</h4></a>
                    <p>Sección de Formularios Online, para la auditoría y revisión de indices de los Salones de Salvador Hairdressing.</p>
                </div>
            </div>
       <?php break;
        case 'Salvadorstore1':?>
        <div class="col-sm-6 feat-list">
            <i class="pe-7s-cart pe-5x pe-va wow fadeInUp" data-wow-delay="0.3s"></i>
            <div class="inner">
                <a href="//www.salvadorstore.com/store/admin123" target="_blank"><h4>Salvador Store</h4></a>
                <p>Acceso directo al panel de Administrador de Salvador Beauty Store. ¡La excelencia online en compras!</p>
            </div>
        </div>
        <?php break;
        case 'Minutas1':?>
        <div class="col-sm-6 feat-list">
            <i class="pe-7s-note pe-5x pe-va wow fadeInUp" data-wow-delay="0.5s"></i>
            <div class="inner">
                <a href="minutas"><h4>Minutas</h4></a>
                <p>Acceso directo al Listado de Minutas. En esta sección encontrarás comentarios, observaciones, notificaciones y avisos pendientes de las actividades de tu salón.</p>
            </div>
        </div>
        <?php break;
    }
}

function menuheader($ubicacion, $accesos){
    list($usuario, $ubica) = explode(";", $ubicacion);
    $useroptions = '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-user pe-5x pe-va wow fadeInUp"></i> '.$usuario.'<span class="caret"></span><span id="notHead"><span id="notHead" class="notificationHead"><i class="pe-7s-info pe-5x pe-va"></i></span></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/intranet/live/ayuda.php"><i class="pe-7s-help1 pe-5x pe-va"></i> Ayuda</a></li>
                        <li><a href="/intranet/ayuda/novedades.php"><i class="pe-7s-info pe-5x pe-va"></i> Novedades <span class="badge newnews">Nuevo</span></a></li>
                        <li><a href="/intranet/live/ajustes.php"><i class="pe-7s-tools pe-5x pe-va"></i> Ajustes</a></li>
                        <li class="divider"></li>
                        <li><a href="/intranet/logout.php">Salir</a></li>
                    </ul>
                </li>';
    switch($ubica){
        case 'cp':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                <li><a href="/intranet">Volver: Intranet</a></li>
                <?php echo $useroptions;?>
            </ul>
        </div>
        <?php break;
        case 'desc':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
            <?php foreach($accesos as $a){
                    menu3($a);
                } ?>
                <li><a href="/intranet/"><i class="pe-7s-global pe-5x pe-va wow fadeInUp"></i> Intranet</a></li>
                <?php echo $useroptions;?>
            </ul>
        </div>
        <?php break;
        case 'aud':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
            <li><a href="./">Auditorias</a></li>
            <li><a href="/intranet/">Volver: Intranet</a></li>
                <?php echo $useroptions;?>
            </ul>
        </div>
        <?php break;
        case 'live':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                <?php foreach($accesos as $a){
                    menu3($a);
                } ?>
                <li><a href="/intranet/"><i class="pe-7s-global pe-5x pe-va wow fadeInUp"></i> Intranet</a></li>
                    <?php echo $useroptions;?>
            </ul>
        </div>
        <?php break;
        case 'minutas':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                 <?php foreach($accesos as $a){
                    menu3($a);
                } ?>
                <li><a href="/intranet/"><i class="pe-7s-global pe-5x pe-va wow fadeInUp"></i> Intranet</a></li>
                <?php echo $useroptions;?>
            </ul>
        </div>
        <?php break;
        case 'descmin':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                <?php foreach($accesos as $a){
                    menu3($a);
                } ?>
                <li><a href="/intranet/"><i class="pe-7s-global pe-5x pe-va wow fadeInUp"></i> Intranet</a></li>
                <?php echo $useroptions;?>
            </ul>
        </div>
       <?php break;
        case 'default':?>

        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                <?php
                foreach($accesos as $a){
                    menu3($a);
                } ?>
                <!--<li><a href="/intranet/cp">Panel de Control</a></li>-->
                <?php echo $useroptions;?>
            </ul>

        </div>
        <?php break;
        case 'ayuda':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                <?php foreach($accesos as $a){
                    menu3($a);
                } ?>
                <li><a href="/intranet/"><i class="pe-7s-global pe-5x pe-va wow fadeInUp"></i> Intranet</a></li>
                <?php echo $useroptions;?>
            </ul>
        </div>
       <?php break;
       case 'cms':?>
        <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
            <ul class="nav navbar-nav">
                <?php foreach($accesos as $a){
                    menu3($a);
                } ?>
                <li><a href="/intranet/"><i class="pe-7s-global pe-5x pe-va wow fadeInUp"></i> Intranet</a></li>
                <?php echo $useroptions;?>
            </ul>
        </div>
       <?php break;
    }
}

function debug_to_console( $data ) {
    $output = $data;
    if ( is_array( $output ) )
        $output = implode( ',', $output);

    echo "<script>console.log( 'Debug: " . $output . "' );</script>";
}

function menu3($nombre){
    //debug_to_console($nombre);
    switch($nombre){
        case 'Accesoremoto1':?>
            <li><a href="/intranet/live"><i class="pe-7s-note pe-5x pe-va wow fadeInUp"></i> Salvador+ Live</a></li>
        <?php break;
        case 'CRM1':
        $bandera1=$bandera2=$bandera3=0;?>
            <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-note pe-5x pe-va wow fadeInUp"></i> CRM <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href='#'><strong>Apps:</strong></a></li>
                  <li class="divider"></li>
                  <?php
                    switch('CRMClientCard1'){
                        case 'CRMClientCard1':
                        $bandera1 = 1;
                        $contenido1 = "<li><a href='/intranet/apps'>ClientCard</a></li>";
                        break;
                    }
                    switch ('CRMApp1') {
                        case 'CRMApp1':
                        $bandera2 = 1;
                        $contenido2 = "<li><a href='/intranet/apps'>Salvador App</a></li>";
                        break;
                    }
                    /*switch ('CRMConvenios1') {
                        case 'CRMConvenios1':
                        $bandera3 = 1;
                        $contenido3 = "<li class='divider'></li>
                                <li><a href='#'><strong>Mercadeo:</strong></a></li>
                                <li class='divider'></li>
                              <li><a href='/intranet/apps'>Promociones y Convenios</a></li>";
                        break;
                    } */
                    if(isset($bandera1)){
                        if($bandera1=1){echo $contenido1;}
                    }
                    if (isset($bandera2)){
                        if($bandera2=1){echo $contenido2;}

                    }
                    if(isset($bandera3) && isset($contenido3)){
                        if($bandera3=1){echo $contenido3;}

                    }

                    ?>
                    <li class="divider"></li>
                    <li><a href='#'><strong>Franquiciados:</strong></a></li>
                    <li class="divider"></li>
                    <li><a href='/intranet/apps'>Encuestas</a></li>
                </ul>
            </li>
            <!--<li>
                <a href="/intranet/cms" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-note pe-5x pe-va wow fadeInUp"></i> CMS <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href='/intranet/cms'> Principal</a></li>
                  <li class="divider"></li>
                  <li><a href='/intranet/cms/web'>Salvador Web</a></li>
                  <li><a href='/intranet/cms/fs'>FS Magazine</a></li>
                  <li><a href='/intranet/cms/cicara'> Cicara</a></li>
                </ul>
            </li>-->
            <li>
                <a href="/intranet/corporativo/" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-note pe-5x pe-va wow fadeInUp"></i> Corporativo <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href='/intranet/corporativo'> Principal</a></li>
                  <li class="divider"></li>
                  <li><a href='/intranet/corporativo/admin'>Administracion</a></li>
                 </ul>
            </li>

        <?php break;
        case 'Directorio1':
            echo '<li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-calendar pe-5x pe-va wow fadeInUp"></i> Directorio <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="/intranet/directorio"><i class="pe-7s-note pe-5x pe-va wow fadeInUp"></i> Directorio de Proveedores</a></li>
                </ul>
            </li>';
            break;
        case 'Descargas1':
        $bandera4=0;$bandera5=0;
        switch ('MantenimientodeDescargas1') {
            case 'MantenimientodeDescargas1':
                $bandera4=1;
                $contenido1="<li><a href='/intranet/descargas/admin'>Actualizar Contenidos</a></li>";
                break;
        }
        switch ('DescargarArchivos1') {
            case 'DescargarArchivos1':
                $bandera5=1;
                $contenido2="<li><a href='/intranet/descargas/cuenta'>Descargar Contenidos</a></li>";
                break;
        } ?>

        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-cloud-download pe-5x pe-va wow fadeInUp"></i> Descargas <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <?php
              if(isset($bandera4)){
                if($bandera4=1){
                //echo $contenido1;
                }
              }
              if (isset($bandera5)){
                if($bandera5=1){
                echo $contenido2;
                }
              } ?>
            </ul>
        </li>
        <?php break;
        case 'MysteryShopper1':?>
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="pe-7s-users pe-5x pe-va wow fadeInUp"></i> Mystery Shopper <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href='/intranet/mysteryshopper'>Sección de Administrador</a></li>
              <li><a href='/mysteryshopper'>Sección de Participante</a></li>
            </ul>
        </li>
        <?php break;
        case 'Auditoria1':?>
            <li><a href="/intranet/auditorias"><i class="pe-7s-note2 pe-5x pe-va wow fadeInUp"></i> Auditorias</a></li>
       <?php break;
        case 'Salvadorstore1':?>
        <li><a href="//www.salvadorstore.com/store/admin123"><i class="pe-7s-cart pe-5x pe-va wow fadeInUp"></i> Salvador Store</a></li>
        <?php break;
        case 'Minutas1':?>
        <li><a href="/intranet/minutas"><i class="pe-7s-note pe-5x pe-va wow fadeInUp"></i> Minutas <span id="notHead"></span></a></li>
        <?php break;
    }
}

//*********************************************
//*** funcion para poblar el menu principal ***
//*********************************************
function regionCargar($usuario){
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&clave=&funcion=regionesusuario", $resulta);
    if ($error == ""){
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        $final = $resulta;

        $manage = (array) json_decode($final);
        $tamaño = count($manage);

        foreach ($manage as $region) {
            echo regionBanderas($region->CODIGO);
        }
        return;
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        echo $msg;
        return;
    }
}

function app1($idsalon){

    $resulta = "";

    $error = hacerpost("http://app.salvadorhairdressing.com/mob.php", "accion=rapp3&dato=$idsalon", $resulta);
    if ($error == ""){

        $manage  = (array)json_decode($resulta, true);
        return $manage;
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        return $msg;
    }
}

function regionBanderas($id){
    switch ($id) {
        case '1':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Venezuela'><img id='flag' alt='ven' src='/images/flags/ve128.png' class='wow fadeInUp'></a>";
            break;
        case '2':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Panamá'><img alt='pty' src='/images/flags/pty128.png' class='wow fadeInUp' data-wow-delay='0.2s'></a>";
            break;
        case '3':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Estados Unidos'><img alt='usa' src='/images/flags/usa128.png' class='wow fadeInUp' data-wow-delay='0.3s'></a>";
            break;
        case '72':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='República Dominicana'><img alt='repdom' src='/images/flags/domrep128.png' class='wow fadeInUp'></a>";
            break;
        case '249':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Colombia'><img alt='col' src='/images/flags/col128.png' class='wow fadeInUp' data-wow-delay='0.5s'></a>";
            break;
        case '302':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Ecuador'><img alt='ec' src='/images/flags/ec128.png' class='wow fadeInUp' data-wow-delay='0.6s'></a>";
            break;
        case '304':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Curazao'><img alt='crz' src='/images/flags/cu128.png' class='wow fadeInUp' data-wow-delay='0.7s'></a>";
            break;
        case '376':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='México'><img alt='mex' src='/images/flags/mex.png' class='wow fadeInUp' data-wow-delay='0.8s'></a>";
            break;
        case '378':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Perú'><img alt='per' src='/images/flags/per.png' class='wow fadeInUp' data-wow-delay='0.9s'></a>";
            break;
        case '380':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' title='Chile'><img alt='chl' src='/images/flags/chile128.png' class='wow fadeInUp' data-wow-delay='1s'></a>";
            break;
        case '382':
            echo "<a href='?r=$id' data-toggle='tooltip' data-placement='top' role='button' title='Costa Rica'><img alt='ven' src='/images/flags/cr128.png' class='wow fadeInUp' data-wow-delay='1.1s'></a>";
            break;
        default:
            break;
    }
}

function salonesCargar($usuario, $region){
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&region=$region&funcion=salonesusuario", $resulta);
    if ($error == ""){
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        $final = $resulta;

        $manage = (array) json_decode($final);
        $tamaño = count($manage);
        ?>
        <form action='index.php' method="POST" name='salonSeleccion'>
        <label class='control-label col-md-offset-2 col-sm-3' for='salones'>Selecciona un Salón:</label>
        <div class='col-sm-6'><select class='form-control' id='salones' name='salones' onChange='mostrarBoton()' required><option>Selecciona una opción</option>
        <?php foreach ($manage as $region) {
            echo "<option value='".base64_encode($region->CODIGOSALON).";".base64_encode($region->RUTALIVE)."'>".$region->ALIAS." --- ".$region->NOMBRESALON."</option>";
        } echo "</select></div><br><br><span id='boton' class='col-sm-12'></span></form>";

        return;
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        return $msg;
    }
}

function salonesCargarIntra1($usuario, $region){
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&region=$region&funcion=salonesusuario", $resulta);
    if ($error == ""){
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        $final = $resulta;

        $manage = (array) json_decode($final);
        $tamaño = count($manage);
        $color="";
        ?>
        <form action='index.php' method="POST" name='salonSeleccion'>
        <label class='control-label col-md-offset-2 col-sm-3' for='salones'>Selecciona un Salón:</label>
        <div class='col-sm-6'><select class='form-control' id='salones' name='salones' onChange='mostrarBoton()' required><option>Selecciona una opción</option>
        <?php foreach ($manage as $region) {
            if($region->RUTALIVE == ""){
                $color = "#f6d0d6";
            } else {$color="white";}
            echo "<option value='".base64_encode($region->CODIGOSALON).";".base64_encode($region->RUTALIVE)."' style='background-color:$color;'>".$region->ALIAS." --- ".$region->NOMBRESALON."</option>";
        } echo "</select></div><br><br><span id='boton' class='col-sm-12'></span></form>";

        return;
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        return $msg;
    }
}

function menuLiveCargar($iduser, $salon){
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$iduser&clave=&funcion=opcioneslive", $resulta);
    if ($error == ""){
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }

        $final = $resulta;

        $manage = (array) json_decode($final);
        $tamaño = count($manage);
        $restricciones = array();

        for($i=0;$i<$tamaño;$i++){
            $restricciones[$i] = $manage[$i]->IDRESTRICCION;
        }

        $_SESSION["restricciones"] = base64_encode(serialize($restricciones));
        list($idsalon,$rutalive) = explode(";",$salon);
        $_SESSION["salon"] = $idsalon;
        $_SESSION["ruta"] = $rutalive;
        header("location: salon.php");
        return;
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        return $msg;
    }
}

function menuLiveMostrar($restric){
    switch ($restric){
        case '104':
            echo "<div class='col-sm-4 feat-list'>
                    <i class='pe-7s-note pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                    <div class='inner'>
                        <a href='?o=".base64_encode('104')."'><h4>Resumen de Ventas</h4></a>
                        <p>Reportes y Facturas de Ventas.</p>
                    </div>
                </div>";
            break;
        case '105':
            echo "<div class='col-sm-4 feat-list'>
                    <i class='pe-7s-calculator pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                    <div class='inner'>
                        <a href='?o=".base64_encode('105')."&p=11'><h4>Cuentas X Cobrar</h4></a>
                        <p>Reportes de Cuentas por Cobrar.</p>
                    </div>
                </div>";
            break;
        case '106':
            echo "<div class='col-sm-4 feat-list'>
                    <i class='pe-7s-calculator pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                    <div class='inner'>
                        <a href='?o=".base64_encode('106')."&p=11'><h4>Cuentas X Pagar</h4></a>
                        <p>Reportes de Cuentas por Pagar.</p>
                    </div>
                </div>";
            break;
        case '107':
            echo "<div class='col-sm-4 feat-list'>
                    <i class='pe-7s-speaker pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                    <div class='inner'>
                        <a href='?o=".base64_encode('107')."' id='linkespera'><h4>Promociones</h4></a>
                        <p>Reportes de Promociones Activas y Pasadas.</p>
                    </div>
                </div>";
            break;
        case '109':
            echo "<div class='col-sm-4 feat-list'>
                    <i class='pe-7s-graph3 pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                    <div class='inner'>
                        <a href='?o=".base64_encode('109')."'><h4>Inventario Estadístico</h4></a>
                        <p>Reporte del Estado del Inventario Físico.</p>
                    </div>
                </div>";
            break;
        case '111':
            echo "<div class='col-sm-4 feat-list'>
                    <i class='pe-7s-scissors pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                    <div class='inner'>
                        <a href='?o=".base64_encode('111')."'><h4>Servicios</h4></a>
                        <p>Reportes sobre las Ventas de Servicios.</p>
                    </div>
                </div>";
            break;
        case '113':
            echo "<div class='col-sm-4 feat-list'>
                    <i class='pe-7s-users pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                    <div class='inner'>
                        <a href='?o=".base64_encode('113')."'><h4>Asociados</h4></a>
                        <p>Reportes sobre el Desempeño de Asociados.</p>
                    </div>
                </div>";
            break;
        case '115':
            echo "<div class='col-sm-4 feat-list'>
                    <i class='pe-7s-users pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                    <div class='inner'>
                        <a href='?o=".base64_encode('115')."'><h4>Clientes</h4></a>
                        <p>Reporte General de Clientes.</p>
                    </div>
                </div>
                <div class='col-sm-4 feat-list'>
                    <i class='pe-7s-delete-user pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                    <div class='inner'>
                        <a href='?o=".base64_encode('115P')."'><h4>Clientes Perdidos</h4></a>
                        <p>Reportes de Clientes Perdidos.</p>
                    </div>
                </div>";
            break;
    }
}

function menuLivePlusMostrar($opc, $salon, $rutabd){
    $show = "<div class='col-sm-4 feat-list'>
                    <i class='pe-7s-delete-user pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                    <div class='inner'>
                        <a href='#operacionesplus' data-toggle='modal' id='#operacionesplus' data-backdrop='static' data-keyboard='false' data-id='".base64_encode('P1')."' data-location='".$salon."' data-where='".$rutabd."'><h4>Productos</h4></a>
                        <p>Consulta y Modifica Productos.</p>
                    </div>
                </div>
                <div class='col-sm-4 feat-list'>
                    <i class='pe-7s-scissors pe-5x pe-va wow fadeInUp' data-wow-delay='0.2s'></i>
                    <div class='inner'>
                        <a href='#operacionesplus' data-toggle='modal' id='#operacionesplus' data-backdrop='static' data-keyboard='false' data-id='".base64_encode('P2')."' data-location='".$salon."' data-where='".$rutabd."'><h4>Servicios</h4></a>
                        <p>Consulta y Modifica Servicios.</p>
                    </div>
                </div>";
    return $show;

}

function opcionesLlamar($op, $salon){
        $opc = base64_decode($op);
        switch ($opc) {
        case '104': // VENTAS
        list($idsalon,$rutasalon) = explode(";", $salon);
        if($_SERVER["REQUEST_METHOD"] == "POST"){
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if(isset($_POST["submitRangoVTA"])){
                    opcionVentaTotal($salon.";".$rutasalon, 2);
                    break;
                }
        } else{
            opcionVentaTotal($salon, 1);
            break;
        }
        case '105': // CXC
            include 'ctax.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if(isset($_POST["submcxc1"])){
                    listadoCXC($salon, 2);
                    break;
                }
            } else{
            listadoCXC($salon, 1);
            break;}
        case '106': // CXP
            include 'ctax.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if(isset($_POST["submcxp1"])){
                    listadoCXP($salon, 2);
                    break;
                }
            } else{
            listadoCXP($salon, 1);
            break;}
        case '107': // PROMOS
            include 'promo.php';
            $_SESSION["tabla_basica"] = 1;$_SESSION["tabla_completa"] = 0;
            opcionPromociones($salon, 1, "");
            break;
        case '109': // INV ESTD
            include 'inventario.php';
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                if(isset($_POST["submitInventa"])){
                    opcionInventario($salon, 2);
                    break;
                } else if(isset($_POST["submInvSug"])){
                    pedidoSugerido($datos);
                    break;
                }
            } else{
            opcionInventario($salon, 1);
            break;
            }
        case '111': // SERVICIOS
            include "servicios.php";
            $_SESSION["servicio"] = 1;
            $_SESSION["tabla_completa"] = "1";
            $_SESSION["tabla_basica"] = "1";
            unset($_SESSION["cliente"]);
            unset($_SESSION["asociado"]);
            pantallainicioservicios();
            break;

        case '113': // ASOCIADOS
            include "asociados.php";
            $_SESSION["asociado"] = 1;
            $_SESSION["tabla_completa"] = "1";
            $_SESSION["tabla_basica"] = "1";
            unset($_SESSION["cliente"]);
            unset($_SESSION["servicio"]);
            pantallainicioasociados();
            break;

        case '115': // CLIENTES
            $_SESSION["tabla_completa"] = "1";
            $_SESSION["tabla_basica"] = "1";
            include 'clientes.php';
            $_SESSION["cliente"] = 1;
            unset($_SESSION["asociado"]);
            unset($_SESSION["servicio"]);
            pantallainicioclientes("L");
            break;

        case '115P': // CLIENTES
            $_SESSION["tabla_completa"] = "1";
            $_SESSION["tabla_basica"] = "1";
            include 'clientes.php';
            $_SESSION["cliente"] = 1;
            pantallainicioclientes("P");
            break;
        default:
            break;
    }
}

function menu1HeaderIntranet($usuario, $ubicacion, $accesos){
    ?>
        <div class="fullscreen landing parallax" style="background-image:url('/intranet/componentes/images/bg/bg7b.jpg');background-repeat: no-repeat;height:175px;" data-img-width="2000" data-img-height="1333" data-diff="100">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7 col-sm-6">
                            <div class="logo wow fadeInDown"> <a href="/intranet"><img src="/images/60-años-min.png" alt="logo"></a>
                                <h1 class="wow fadeInLeft" style="float: right;margin:0px;">
                                Intranet
                                </h1>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-6">
                            <span id="componente5"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- NAVIGATION -->
        <div id="menu">
            <nav class="navbar-wrapper navbar-default" role="navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-backyard">
                            <span class="sr-only">Intranet</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!--<a class="navbar-brand site-name" href="#top"><img src="images/salvador-logo-wh.jpg" alt="logo"></a>-->
                    </div>
                    <?php
                    if(isset($ubicacion)){
                        menuheader($usuario.";".$ubicacion, $accesos);
                    } else if(!isset($ubicacion)){
                        $ubi = "default";
                        menuheader($usuario.";".$ubi, $accesos);
                    }
                    ?>
                </div>
            </nav>
        </div>
    <?php
}

function datossalon($ruta){
   /*
    ["NOMBREEMPRESA"]
    ["DIRECCION"]
    ["RIF"]
    ["TELEFONO"]
    ["GERENTE"]
    ["CODIGOSALON"]
    ["CIUDAD"]
    ["PAIS"]
    ["SUCURSAL"]
   */

   require_once "armarconsulta.php";
   list($idsalon,$rutabd) = explode(";", $ruta);
   $rutabd = base64_decode($rutabd);
   if ($rutabd == ""){
    return "<form action='index.php' method='POST' name='ponerTicket'><input type = 'hidden' name = 'codigosalon' value=".base64_decode($idsalon)."><h4>No se ha configurado el salon para la conexion Live, <input type = 'submit' name = 'ponerTicket' value = 'click aqui' style='border: 0; color:blue; background-color: transparent;'> para comunicarlo al departamento de sistemas.</h4></form>";
    exit;
   }
    $error = hacerpost($rutabd."/apilivesalon.php?", "clavebd=salvasis1&consultas=".consultadatossalon(), $resulta);
    if ($error == ""){
        $manage  = (array)json_decode($resulta, true);
        if (session_status() === PHP_SESSION_NONE) {
           session_start();
        }
        $_SESSION["datossalon"] = $manage[0][0];
        return "";
    }
    else{
        return "<b>Hubo un error al conectar con el salón:</b>" . $error . ".<br>Ruta= " .$rutabd;
    }
}

function diasemanafb($dia){

    //Devuelve el nombre del dia de la semana
    //en base a lo devuelto por weekofday firebird
    //Se utiliza esta funcion para traductor
    switch ($dia) {
        case 0:
            return "Domingo";
            break;
        case 1:
            return "Lunes";
            break;
        case 2:
            return "Martes";
            break;
        case 3:
            return "Miercoles";
            break;
        case 4:
            return "Jueves";
            break;
        case 5:
            return "Viernes";
            break;
        case 6:
            return "Sabado";
            break;
        default:
            # code...
            break;
    }
}

function menuMinutas($iduser, $minseleccion){
    if($minseleccion == '12'){
        header("Location: regiones.php");
        return;
    } else if($minseleccion == '13'){

    }
}

function tareasPendientes($usuario){
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&funcion=tareaspendientes", $resulta);
    if ($error == ""){
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }

        echo $resulta;
        return;
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        return $msg;
    }
}

function unique_multidim_array($array, $key) {
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}

?>
