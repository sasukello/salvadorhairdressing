<?php

/*cs=$cod&us=$nomcod"
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function finishLogin($code, $user, $permiso){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION["codigo"] = $code;
    $_SESSION["usuario"] = $user;
    $_SESSION["permiso"] = $permiso;
    $_SESSION["hash"] = "s6a5486dasdas31";
    header("location: index.php");
    return;
}

if(isset($_GET['cs'])){
    $codigosec = base64_decode($_GET['cs']);
    $nombresec = base64_decode($_GET['us']);
    $permsec = base64_decode($_GET['ps']);
    finishLogin($codigosec, $nombresec, $permsec);
} else {
    echo "Acceso Denegado!";
}

?>
