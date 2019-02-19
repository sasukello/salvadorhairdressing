<?php
ob_start();

$user = "";$iduser = "";



if (session_status() === PHP_SESSION_NONE) {

    session_start();

    if(isset($_SESSION["codigo"])){

        $user = $_SESSION["usuario"];

        $iduser = $_SESSION["codigo"];

        $peruser = $_SESSION["permiso"];

        $hash = $_SESSION["hash"];

        $_SESSION['ubicacion'] = "live";

        $salon = $_SESSION["salon"];

        $rutabd = $_SESSION["ruta"];

        

        if($hash == "s6a5486dasdas31"){

            $bandera = true;

        } else{

        header("location:../logout.php");

        }

    } else{

       header("location:../logout.php");

    }

}
?>