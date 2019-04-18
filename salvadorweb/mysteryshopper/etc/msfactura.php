<?php
function procesarFacturaEncuesta($usuario){
 	
    if (isset($_FILES["file"])) {    
    $file   =   $_FILES["file"];
    $nombre =   $file["name"];
    $tipo   =   $file["type"];
    $tamano =   $file["size"];
    $rutaP  =   $file["tmp_name"];
    $destin = "../facturasMs/";

    if ($tamano > 1024*1024) {
       // echo "Limite maximo es un 1MB";
       header("location: ../cuenta/index.php?e=".base64_encode($iduser)."&e=6");
    }
    else if ($tipo != "image/jpeg" && $tipo != "image/jpg" && $tipo != "image/png" && $tipo != "application/pdf") {
       	// echo "Formato no válido";
      	header("location: ../cuenta/index.php?e=".base64_encode($iduser)."&e=7");
    }
    else{
        $src = $destin.$nombre;
        move_uploaded_file($rutaP,$src);
        echo "Archivo enviado exitosamente";

        require_once "../../mysteryshopper/etc/phpmailer/class.phpmailer.php";
        require_once "../../mysteryshopper/etc/phpmailer/class.smtp.php";         
    
	    $mail = new PHPMailer(true);

	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'mail.salvadorhairdressing.com';                  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = 'atc@salvadorhairdressing.com';    // SMTP username
	    $mail->Password = 'atencion.14';                         // SMTP password
	    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 465;                                    // TCP port to connect to
	    $mail->CharSet = 'UTF-8';
	    $emailFac = getCorreo($usuario);
	    $subject = "Salvador Hairdressing: Mystery Shopper - El participante $emailFac ha adjuntado su factura";
	    $email = 'noreply@salvadorhairdressing.com';
	    $name = 'Salvador Hairdressing';    

	    $mail->SetFrom( $email , $name );
	    $mail->AddAddress( 'prog.web@salvadorhairdressing.com' );
	    $archivo = $src;
	       
	    $mail->Subject = $subject;
	    $htmlContent1 = file_get_contents("../etc/correos/facturaMs.php");
	    $body = $htmlContent1;

	    $mail->MsgHTML( $body );
	    $mail->AddAttachment($archivo);
	    $sendEmail = $mail->Send();

	    if( $sendEmail == true ):
	   		header("location: ../cuenta/index.php?e=".base64_encode($iduser)."&e=8"); 	
	    // $msg = "<b>¡Participante Aprobado Éxitosamente!</b> Este recibirá un correo siendo informado.<br><br><b>Aviso:</b> No se pueden programar visitas, hasta que el cliente no responda la encuesta inicial.";
	    //     $clase = "alert alert-success alert-dismissable fade in";
	    //     return "1";
	    else:
            $msg = "<strong>Error</strong> al enviar Correo Informativo al Cliente.<br>";
            $clase = "alert alert-danger alert-dismissable fade in";
            return "0";
	    endif;
	    // echo "<div class='$clase'>
	    //     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
	    //     $msg</div>";   
        }
    }
}
function getCorreo($idp){
    require_once "../../sitio/sec/ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $email = "";

    $sql = "SELECT correo FROM ms_usuario WHERE id = $idp LIMIT 1";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    if ($match > 0) {
            while ($rw = mysqli_fetch_array($search)) {
                $email = $rw['correo'];
                return $email;
            }
    } else{
        //NO HAY CORREO
    }
}
?>