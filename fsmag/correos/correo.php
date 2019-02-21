<?php

error_reporting(0);

function enviarMensaje($datos){

    list($nombre,$apellido,$email,$mensaje) = explode(";", $datos);

    $to = "alugox@gmail.com";

    $subject = "FS magazine - Nuevo Mensaje";

    $htmlContent1 = file_get_contents("correos/bienvenido1.html");

    $htmlContent2 = "<span class='header-sm'>Nombre y Apellido:</span> <b>$nombre $apellido</b><br />

                                      <span class='header-sm'>Correo:</span> <b>$email</b><br />

                                      <span class='header-sm'>Mensaje:</span> <b>$mensaje</b><br /><br />";


    $htmlContent3 = file_get_contents("correos/bienvenido2.html");

    $REMOTE_USER = (isset($_SERVER["REMOTE_USER"]))?$_SERVER["REMOTE_USER"]:"";
    $REMOTE_ADDR = (isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"";
    $Message .= "REMOTE USER: ". $REMOTE_USER."\n";
    $Message .= "REMOTE ADDR: ". $REMOTE_ADDR."\n";


    $htmlContent = $htmlContent1.$htmlContent2.$htmlContent3."<br>".$Message;

    // Set content-type header for sending HTML email

    $headers = "MIME-Version: 1.0" . "\r\n";

    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers

    $headers .= 'From: FS magazine <marketing@fsinter.com>' . "\r\n";

    //$headers .= 'Cc: ' . "\r\n";

   //$headers .= 'Bcc: ' . "\r\n";

    // Send email
    if(mail($to,$subject,$htmlContent,$headers)){
        //return "1";
        //$almacen = guardarDatos($datos);
            //if($almacen == "[1]"){
                header("Location: gracias.php");
            //} else{
                //header("Location: error.php?e=2"); 
            //}
    } else{
        //return "0"; 
         header("Location: error.php?e=1"); 
    }

    return;
}

function enviarMensaje2($datos){

    list($nombre,$apellido,$email,$mensaje) = explode(";", $datos);

    $to = "alugox@gmail.com";

    $subject = "FS magazine - Nuevo Mensaje";

    $htmlContent1 = file_get_contents("correos/bienvenido1.html");

    $htmlContent2 = "<span class='header-sm'>Nombre y Apellido:</span> <b>$nombre $apellido</b><br />

                                      <span class='header-sm'>Correo:</span> <b>$email</b><br />

                                      <span class='header-sm'>Mensaje:</span> <b>$mensaje</b><br /><br />";


    $htmlContent3 = file_get_contents("correos/bienvenido2.html");

    $REMOTE_USER = (isset($_SERVER["REMOTE_USER"]))?$_SERVER["REMOTE_USER"]:"";
    $REMOTE_ADDR = (isset($_SERVER["REMOTE_ADDR"]))?$_SERVER["REMOTE_ADDR"]:"";
    $Message .= "REMOTE USER: ". $REMOTE_USER."\n";
    $Message .= "REMOTE ADDR: ". $REMOTE_ADDR."\n";


    $htmlContent = $htmlContent1.$htmlContent2.$htmlContent3."<br>".$Message;

    // Set content-type header for sending HTML email

    $headers = "MIME-Version: 1.0" . "\r\n";

    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers

    $headers .= 'From: FS magazine <marketing@fsinter.com>' . "\r\n";

    //$headers .= 'Cc: ' . "\r\n";

   //$headers .= 'Bcc: ' . "\r\n";

    // Send email
    if(mail($to,$subject,$htmlContent,$headers)){
        //return "1";
        //$almacen = guardarDatos($datos);
            //if($almacen == "[1]"){
                header("Location: gracias.php");
            //} else{
                //header("Location: error.php?e=2"); 
            //}
    } else{
        //return "0"; 
         header("Location: error.php?e=1"); 
    }

    return;
}

?>