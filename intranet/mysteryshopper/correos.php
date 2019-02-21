<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
error_log(1);

require_once('phpmailer/class.phpmailer.php');// Requiere PHPMAILER para poder enviar el formulario desde el SMTP de google
require_once('phpmailer/class.smtp.php');

function mailRegistro($nombre, $correo, $password, $origen){

    $mail = new PHPMailer();
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.salvadorhairdressing.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'academy@salvadoracademy.com';    // SMTP username
    $mail->Password = 'Salvador_34';                         // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->CharSet = 'UTF-8';

    $message = "";
    $status = "false";

    if ($origen == 1) {
        $subject = 'Registro de Usuario Salvador Academy';
    } elseif ($origen == 2) {
        $subject = 'Recuperación de Contraseña Salvador Academy';
    }

    $toemail = $correo; // Your Email Address
    $toname = $nombre; // Your Name
    $email = 'academy@salvadoracademy.com';
    $name = 'Salvador Academy';

    $mail->SetFrom( $email , $name );
    $mail->AddAddress( $toemail , $toname );
    $mail->Subject = $subject;

    $variable = file_get_contents("componentes/mails/bienvenido.html");
    $variable = str_replace("%%nombre%%", $nombre, $variable);
    $variable = str_replace("%%email%%", $correo, $variable);
    $variable = str_replace("%%password%%", $password, $variable);

    // $referrer = $_SERVER['HTTP_REFERER'] ? '<br><br><br>Este formulario de contacto ha sido enviado desde: ' . $_SERVER['HTTP_REFERER'] : '';

    $body = "$variable";

    $mail->MsgHTML( $body );
    $sendEmail = $mail->Send();

    if( $sendEmail == true ):
        return "1";
    else:
        return "0";
    endif;

}

function mailPago($nombre, $correo, $voucher){

    $mail = new PHPMailer();
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.salvadorhairdressing.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'academy@salvadoracademy.com';    // SMTP username
    $mail->Password = 'Salvador_34';                         // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->CharSet = 'UTF-8';

    $message = "";
    $status = "false";
    $subject = 'Comprobante de Pago - Salvador Academy';
    $toemail = $correo; // Your Email Address
    $toname = $nombre; // Your Name
    $email = 'academy@salvadoracademy.com';
    $name = 'Salvador Academy';

    $mail->SetFrom( $email , $name );
    $mail->AddAddress( $toemail , $toname );
    $mail->Subject = $subject;

    $variable = file_get_contents("componentes/mails/recibo.html");
    $variable = str_replace("%%nombre%%", $nombre, $variable);
    $variable = str_replace("%%voucher%%", $voucher, $variable);

    $body = "$variable";

    $mail->MsgHTML( $body );
    $sendEmail = $mail->Send();

    if( $sendEmail == true ):
        return 1;
    else:
        return 0;
    endif;

}

?>