<?php
ob_start();
$user = "";$iduser = "";$codUser = "";$codPermiso = "";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION["codigo"])){

        $user = $_SESSION["usuario"];
        $iduser = $_SESSION["codigo"];
        $peruser = $_SESSION["permiso"];
        $codUser = base64_encode($iduser);
        $codPermiso = base64_encode($peruser);  

        $hash = $_SESSION["hash"];
        $arrayMenu = unserialize($_SESSION["accesos"]);
        if(isset($_SESSION["salon"])){
            $salon = $_SESSION["salon"];
        }
        if(isset($_SESSION["ruta"])){
            $rutabd = $_SESSION["ruta"];
        }
        if($hash == "s6a5486dasdas31"){
            $bandera = true;
        } else{
        //header("location:/intranet/logout.php");
        }
    } else{
      // header("location:/intranet/logout.php");
    }
}

//echo "<script>console.log('HOLA');</script>";
?>