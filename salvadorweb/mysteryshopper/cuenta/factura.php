<?php

// if (isset($_FILES["file"])) {
	
// 	$file 	= 	$_FILES["file"];
// 	$nombre = 	$file["name"];
// 	$tipo 	= 	$file["type"];
// 	$tamano = 	$file["size"];
// 	$rutaP  =	$file["tmp_name"];
// 	$destin = "../facturasMs/";

// 	if ($tamano < 1000) {

// 		echo "Limite maximo es un 1MB";
// 	}
// 	else if ($tipo != "image/jpeg" && $tipo != "image/jpg" && $tipo != "image/png" && $tipo != "application/pdf") {

// 		echo "Formato no válido";
// 	}
// 	else{
// 		$src = $destin.$nombre;
// 		move_uploaded_file($rutaP,$src);
// 		echo "Archivo enviado exitosamente";

// 	require_once "../etc/phpmailer/class.phpmailer.php";
//     require_once "../etc/phpmailer/class.smtp.php";

//     $mail = new PHPMailer(true);

//     $mail->isSMTP();                                      // Set mailer to use SMTP
//     $mail->Host = 'mail.salvadorhairdressing.com';                  // Specify main and backup SMTP servers
//     $mail->SMTPAuth = true;                               // Enable SMTP authentication
//     $mail->Username = 'atc@salvadorhairdressing.com';    // SMTP username
//     $mail->Password = 'atencion.14';                         // SMTP password
//     $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//     $mail->Port = 465;                                    // TCP port to connect to
//     $mail->CharSet = 'UTF-8';


//     $subject = "Salvador Hairdressing: Mystery Shopper - Resumen de Visita: El participante ha adjuntado su factura";
//     $email = 'noreply@salvadorhairdressing.com';
//     $name = 'Salvador Hairdressing';    

//     $mail->SetFrom( $email , $name );
//     $mail->AddAddress( 'prog.web@salvadorhairdressing.com' );
//     $archivo = $src;
       
//     $mail->Subject = $subject;

//     $body = "Nueva factura de Mystery Shopper";

//     $mail->MsgHTML( $body );
// 	$mail->AddAttachment($archivo);

//     $sendEmail = $mail->Send();

//     if( $sendEmail == true ):
//     $msg = "<b>¡Participante Aprobado Éxitosamente!</b> Este recibirá un correo siendo informado.<br><br><b>Aviso:</b> No se pueden programar visitas, hasta que el cliente no responda la encuesta inicial.";
//         $clase = "alert alert-success alert-dismissable fade in";
//         return "1";
//     else:
//             $msg = "<strong>Error</strong> al enviar Correo Informativo al Cliente.<br>";
//             $clase = "alert alert-danger alert-dismissable fade in";
//             return "0";
//     endif;
//     // echo "<div class='$clase'>
//     //     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
//     //     $msg</div>";   


// 	}

// }

?>