<?php
include '../../mysteryshopper/etc/modals.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

if(isset($_SESSION["usuario"])){
    $user = $_SESSION["usuario"];
    $iduser = $_SESSION["codigo"];
    $hash = $_SESSION["hash"];
    if($hash == "s6a5486dasdas31"){
        $bandera = true;
    } else{
    header("location:error.php");
    }
} else{
    header("location:error.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['postProgVisita'])) {

        $salones = $_POST["salones"];
        /*$forma = $_POST["forma"];
        $fecha = $_POST["fecha"]; //fecha de la visita
        $mensaje = $_POST["mensaje"]; // instrucciones para la visita
        $obspago = $_POST["obspago"];
        $descripcion = $_POST["descripcion"]; // descripcion de la visita
        $servicios = $_POST["servicios"]; // servicios a pedir por el usuario*/

        $participante = $_POST["part"];

        progTres($participante, $salones);
        }
    }

?>
<html>
    <head>
        <title>Salvador Hairdressing - Mistery Shopper: Programar Visita</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<!-- CSS Files -->
        <link href="/mysteryshopper/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/font-awesome.min.css" rel="stylesheet">
        <link href="/mysteryshopper/fonts/icon-7-stroke/css/pe-icon-7-stroke.css" rel="stylesheet">
        <link href="/mysteryshopper/css/animate.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/owl.theme.css" rel="stylesheet">

        <link href="/mysteryshopper/css/css-index.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/css-index-red.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/estilo.css" rel="stylesheet" media="screen">

        <!-- Google Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" />

    </head>
    
<?php
        if(isset($_GET['p'])){
        $iden = $_GET['p'];
        $regionen = $_GET['r'];
        $id = base64_decode($iden);
        $region = base64_decode($regionen);
        }
        partAct(2,$id);
        //progDos($id, $region);
?>