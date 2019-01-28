<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function pasoserver($user){
    require_once "libcon.php";
        $nombre = strtoupper($user);
        $con = Conectarfb();
        $sql = "SELECT CODIGO, NOMBRECOMPLETO, CLAVE, NIVEL FROM usuarios WHERE CODIGO = '$nombre'";
        $result = ibase_query($con, $sql);

        $rawdata = array();
        $i = 0;

        while ($row = ibase_fetch_object($result)) {
            $rawdata[$i] = $row;
            $i++;
        }

        $array = json_encode($rawdata);
        $array2 = json_decode($array);

        $codigo = $array2[0]->CODIGO;
        $nombre = $array2[0]->NOMBRECOMPLETO;
        $nivel = $array2[0]->NIVEL;
        
        if ($codigo != "") {
            // USUARIO CORPORATIVO ENCONTRADO, INICIO SESIÓN
            session_start();    
            $_SESSION["codigo"] = $codigo;
            $_SESSION["nombre"] = $nombre;
            $_SESSION["nivel"] = $nivel;
            header("location: http://www.salvadorhairdressing.com/mysteryshopper/login.php?t=2&uu=".  base64_encode($codigo));
            return;
        } else if ($codigo == "") {
            // NO ES USUARIO CORPORATIVO, LLEVO A PANTALLA DE REGISTRO
            session_start();    
            $userc = base64_encode($user);
            header("Location: http://www.salvadorhairdressing.com/mysteryshopper/registro.php?uu=$userc");
        }
        return;
}

function comprobacionserver($user, $password){
    require_once "libcon.php";

        $nombre = strtoupper($user);

        $con = Conectarfb();
        $sql = "SELECT hash('$password'), CLAVEHASH, CODIGO, NOMBRECOMPLETO FROM usuarios WHERE CODIGO = '$nombre'";
        $result = ibase_query($con, $sql);

        $rawdata = array();
        $i = 0;

        while ($row = ibase_fetch_object($result)) {
            $rawdata[$i] = $row;
            $i++;
        }
        
        $array = json_encode($rawdata);
        $array2 = json_decode($array);
        
        $usuarioTemp = $array2[0]->CODIGO;
        $nombreUsuarioTemp = $array2[0]->NOMBRECOMPLETO;
        $clavehash1 = $array2[0]->HASH;
        $clavehash2 = $array2[0]->CLAVEHASH;
        
        $usuario = ucwords($usuarioTemp);
        $nombreUsuario = ucwords(strtolower($nombreUsuarioTemp));
        //$nombreUsuario = ucwords(strtolower($nombreUsuario));
        
        $cod = base64_encode(strtoupper($usuario));
        $nomcod = base64_encode($nombreUsuario);
            
        if($clavehash1 === $clavehash2){
            header("location: http://www.salvadorhairdressing.com/mysteryshopper/admin/verification.php?cs=$cod&us=$nomcod");
            return;
        } else {
            //CLAVES NO COINCIDEN
            header("location: http://www.salvadorhairdressing.com/mysteryshopper/login.php?t=2&uu=$cod&e=1");
            return;    
        }
}

function comprobacionserverExterno($user, $password, $p1, $p2){
    require_once "libcon.php";

        $nombre = strtoupper($user);

        $con = Conectarfb();
        $sql = "SELECT hash('$password'), CLAVEHASH, CODIGO, NOMBRECOMPLETO FROM usuarios WHERE CODIGO = '$nombre'";
        $result = ibase_query($con, $sql);

        $rawdata = array();
        $i = 0;

        while ($row = ibase_fetch_object($result)) {
            $rawdata[$i] = $row;
            $i++;
        }
        
        $array = json_encode($rawdata);
        $array2 = json_decode($array);
        
        $usuarioTemp = $array2[0]->CODIGO;
        $nombreUsuarioTemp = $array2[0]->NOMBRECOMPLETO;
        $clavehash1 = $array2[0]->HASH;
        $clavehash2 = $array2[0]->CLAVEHASH;
        
        $usuario = ucwords($usuarioTemp);
        $nombreUsuario = ucwords(strtolower($nombreUsuarioTemp));
        //$nombreUsuario = ucwords(strtolower($nombreUsuario));
        
        $cod = base64_encode(strtoupper($usuario));
        $nomcod = base64_encode($nombreUsuario);
        
            
        if($clavehash1 === $clavehash2){
            header("location: http://www.salvadorhairdressing.com/mysteryshopper/admin/verification.php?cs=$cod&us=$nomcod&p1=$p1&p2=$p2");
            return;
        } else {
            //CLAVES NO COINCIDEN
            header("location: http://www.salvadorhairdressing.com/mysteryshopper/loginExterno.php?mail=$p1&t=$p2&e=1");
            return;    
        }
}

if(isset($_GET['u'])){
    $user = base64_decode($_GET['u']);
    pasoserver($user);
} else if(isset($_GET['uu'])){
    $user2 = base64_decode($_GET['uu']);
    $pass2 = base64_decode($_GET['pp']);
    if(isset($_GET['p1'])){
        $param1 = ($_GET['p1']);
        $param2 = ($_GET['p2']);
        comprobacionserverExterno($user2, $pass2, $param1, $param2);
    } else if (!isset($_GET['p1'])){
        comprobacionserver($user2, $pass2);
    }    
} else {
    echo "Acceso Denegado!";
}

?>
