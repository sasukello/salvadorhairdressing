<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (isset($_POST['action'])) {
        $accion = $_POST['action'];
        switch ($accion) {
        case 'r1':
        echo listasalonxregion($_POST['datos']);
        break;

        case 'r2':
        echo regionCargarselect($_POST['datos'], '');
        break;
    
        case 'postconvenios':
            $user = $_POST['datos'];
            /*$arr1 = array
                (
                  array("1",'VEN','2016','2017','DESCRIPCION1','FACT1'),
                  array("2",'USA','2017','2017','DESCRIPCION2','FACT2'),
                  array("3",'VEN','2017','2018','DESCRIPCION3','FACT3')
                );
            $arr2 = json_encode($arr1);*/
            
            echo listaconvenios($user);
            //echo $arr2;
        break;

        }
    }
}

function listasalonxregion($region){
       if (session_status() === PHP_SESSION_NONE) {
           session_start();
           }
       include "../sec/libfunc.php";

       $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=".$_SESSION["codigo"]."&region=$region&funcion=salonesusuario", $resulta);
       if ($error == ""){
           $manage = (array) json_decode($resulta);        
           $listaSalones = "";
           foreach ($manage as $salon) {
               $listaSalones .= '<input type="checkbox" name="salon[]" value= "'.$salon->CODIGOSALON.'"/> '.$salon->ALIAS.' <br />';
           }              
       }

       else{
           $msg = "<b>Ha ocurrido un error:</b> " . $error;
           return $msg;
       }
    return $listaSalones;
}

function listaregiones($usuario){
    include "../sec/libfunc.php";
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&clave=&funcion=regionesusuario", $resulta);
    if ($error == ""){
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        $final = $resulta;

        $manage = (array) json_decode($final);
        
        $listaregiones = ""; 
        foreach ($manage as $region) {
            if ($listaregiones != ""){
                $listaregiones .= ", ";
            }
            $listaregiones .= $region->CODIGO;
        }
        return $listaregiones;
    }

    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        return $msg;
    }
}

function listasalones($usuario){
    $lr = listaregiones($usuario);
    $arrRegiones = explode(",", $lr);
    $listaSalones = "";
    foreach ($arrRegiones as $region){
       $resulta = "";
       $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&region=$region&funcion=salonesusuario", $resulta);
       if ($error == ""){
           if (session_status() === PHP_SESSION_NONE) {
           session_start();
           }
           $final = $resulta;

           $manage = (array) json_decode($final);        
           foreach ($manage as $salon) {
               if ($listaSalones != ""){
                   $listaSalones .= ", ";
               }
               $listaSalones .= "'".$salon->CODIGOSALON."'";
           }            
       }
       else{
           $msg = "<b>Ha ocurrido un error:</b> " . $error;
           return $msg;
       }
    }
    return $listaSalones;
}

function listaconvenios($usuario){
  include "../sec/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    /* CONSULTAR LISTADOS DE CLIENTES EN SALÓN */
    $sql = "SELECT * FROM WEB_CONVENIOS where id not in (SELECT IDCONVENIO FROM WEB_CONVENIOS_SALONES_EXCEPTUADOS WHERE SALONAPLICA IN (".listasalones($usuario)."))";

    $result = array();
    $i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $result[$i] = $rw['ID'];
            $result[$i] = $rw['NOMBRECONVENIO'];
            $result[$i] = $rw['REGIONAPLICA'];
            $result[$i] = $rw['INICIO'];
            $result[$i] = $rw['FINAL'];
            $result[$i] = $rw['COMOFACTURAR'];
            $i++;
        }
    } else {
        /*$result[$i] = "No hay resultados actualmente,0,0,0,0,0";
        $result[$i] = "N/A";
        $result[$i] = "N/A";
        $result[$i] = "N/A";
        $result[$i] = "N/A";
        $result[$i] = "N/A";*/
        
        $result = array
                (
                  array("No hay resultados actualmente",'N/A','N/A','N/A','N/A','N/A'),
                );
    }
    $result2 = json_encode($result);
    return $result2;
}

function regionCargarselect($usuario, $regiondefecto){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
    include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php");
    include "../sec/libfunc.php";

    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&clave=&funcion=regionesusuario", $resulta);
    if ($error == ""){
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }

        $final = $resulta;

        $manage = (array) json_decode($final);        
        $tamaño = count($manage);
        $resulta = "<select class='form-control'  onchange='listarsalones()' id = 'txtlistaregiones' style = 'padding-left: 25px; background-repeat: no-repeat; background-position: 3px 50%;'>";
        $resulta .= '<option value = "-1">'.$trcvnseleccionaregion.'</option>';

        foreach ($manage as $region) {
            $resulta .= '<option value="'.$region->CODIGO.'"';
            if ($region->CODIGO == $regiondefecto){
              $resulta .= ' selected ';
            }
            $resulta .= regionBanderasimagen($region->CODIGO). '>'.$region->DESCRIPCION.'</option>';
        }
        $resulta .= "</select>";
        return $resulta; 
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        return $msg;
    }
}

function regionBanderasimagen($id){
    switch ($id) {
        case '1':
            $img = '/images/flags/ve128.png';
            break;

        case '2':
            $img = '/images/flags/pty128.png';
            break; 

        case '3':
            $img = '/images/flags/usa128.png';
            break;

        case '72':
            $img = '/images/flags/domrep128.png';
            break;

        case '249':

            $img = '/images/flags/col128.png';

            break;

        case '302':
            $img = '/images/flags/ec128.png';
            break;

        case '304':
            $img = '/images/flags/cu128.png';
            break;

        case '376':
            $img = '/images/flags/mex.png';
            break;

        case '378':
            $img = '/images/flags/per.png';
            break;

        case '380':
            $img = '/images/flags/chile128.png';
            break;

        case '382':
            $img = '/images/flags/cr128.png';
            break;

        default:
            break;
    }

    return 'style="background-image: url('.$img.'); padding-left: 25px; background-repeat: no-repeat; background-position: 3px 50%;"';
}


?>