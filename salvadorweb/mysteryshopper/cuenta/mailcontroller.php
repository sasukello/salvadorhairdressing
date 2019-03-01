<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salvador Hairdressing - Mistery Shopper</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<!-- CSS Files -->
        <link href="/mysteryshopper/css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/font-awesome.min.css" rel="stylesheet">
        <link href="/mysteryshopper/css/animate.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/css-index.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/css-index-red.css" rel="stylesheet" media="screen">
        <link href="/mysteryshopper/css/estilo.css" rel="stylesheet" media="screen">

        <!-- Google Fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" />
    </head>
    <body>

<?php
    require_once "../etc/correos.php";
    
    if(isset($_GET['ii'])){
        $idp = base64_decode($_GET['ii']);
        $correop = base64_decode($_GET['cc']);
        if(isset($_GET['tt'])){
            $tipo = $_GET['tt'];
            if($tipo == 1){
                // ENVIAR RECORDATORIO DE COMPLETAR DATOS BANCARIOS
                enviarRecordatorioBanco($correop);            
            }
        } else if(!isset ($_GET['bb'])){
                enviarRecordatorioBanco($correop);            
        }
    } else if(isset ($_GET['re'])){
        // PROGRAMAR NUEVA CITA - CORREO DE AVISO AL CLIENTE
        $correo = base64_decode($_GET['re']);
        $fecha = base64_decode($_GET['f']);
        $salones = base64_decode($_GET['s']);
        $mensaje = base64_decode($_GET['m']);
        $descripcion = base64_decode($_GET['d']);
        $servicios = base64_decode($_GET['ss']);
        
        enviarNuevaCita($correo, $fecha, $salones, $mensaje, $descripcion, $servicios);            
    } else if(isset($_GET['t'])){
        $idp = base64_decode($_GET['t']);
        if($_GET['tt'] == 2){
            // PARTICIPANTE APROBADO
            $email = getCorreo($idp);
            $pass = getPassword($idp);
            if(enviarMailBienvenida($email, $pass) == "1"){ // PARTICPANTE APROBADO
                $msg = "<b>¡Participante Aprobado Éxitosamente!</b> Este recibirá un correo siendo informado.<br><br><b>Aviso:</b> No se pueden programar visitas, hasta que el cliente no responda la encuesta inicial.";
                $clase = "alert alert-success alert-dismissable fade in";
                echo "<div class='$clase'>
                        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                        $msg</div><br>";
            } else if(enviarMailBienvenida($email, $pass) == "0"){ // ERROR AL ACTUALIZAR EL ESTADO
                header("location: ../index.php?e=5"); 
            }
        }
    } else if (isset($_GET["reg"])){
        $bandera = $_GET["reg"];
        if($bandera == 1){
            enviarAvisoNuevoUsuario();
        }
    }
?>
<br><div style="width:200px;margin-left: auto;margin-right: auto;"><a href="../../../intranet/mysteryshopper/"><button type="button" class="btn-primary" style="padding: 9px;">Regresar a Intranet</button></a></div>
</body>
</html>
