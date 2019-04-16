
<?php
function enviarMailBienvenida($emailDestino,$passDestino){

    require_once "../../mysteryshopper/etc/phpmailer/class.phpmailer.php";
    require_once "../../mysteryshopper/etc/phpmailer/class.smtp.php";

    $mail = new PHPMailer();
    //$mail->SMTPDebug = 3;                       // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.salvadorhairdressing.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'atc@salvadorhairdressing.com';    // SMTP username
    $mail->Password = 'atencion.14';                         // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->CharSet = 'UTF-8';

    $message = "";
    $status = "false";

    $subject = 'Salvador Hairdressing: Mystery Shopper - Bienvenido';

    $toemail = $emailDestino; // Your Email Address
    $topassword = $passDestino;
    //$toname = "Salvador Hair"; // Your Name
    $email = 'noreply@salvadorhairdressing.com';
    $name = 'Salvador Hairdressing';
    

    $mail->SetFrom( $email , $name );
    $mail->AddAddress( $toemail );
    $mail->Subject = $subject;

    $htmlContent1 = file_get_contents("../etc/correos/bienvenido.php");
    $htmlContent2 = "<tr>
                  <td class='free-text'>
                      <br><table class='tabla1'>
                      <tr class='tr1'>
                        <th class='th1' colspan='2'>Datos de Acceso</th>
                      </tr>
                      <tr class='tr1'>
                        <td class='td1'><b>Usuario:</b></td>
                        <td class='td1'>$toemail</td>
                      </tr>
                      <tr class='tr1'>
                        <td class='td1'><b>Contraseña:</b></td>
                        <td class='td1'>$topassword</td>
                      </tr>
                    </table>
                  </td>
              </tr>";
    $htmlContent3 = file_get_contents("../etc/correos/bienvenido2.php");

    $variable = $htmlContent1.$htmlContent2.$htmlContent3;
    
    $body = "$variable";

    $mail->MsgHTML( $body );
    $sendEmail = $mail->Send();

    if( $sendEmail == true ):
    $msg = "<b>¡Participante Aprobado Éxitosamente!</b> Este recibirá un correo siendo informado.<br><br><b>Aviso:</b> No se pueden programar visitas, hasta que el cliente no responda la encuesta inicial.";
        $clase = "alert alert-success alert-dismissable fade in";
        return "1";
    else:
            $msg = "<strong>Error</strong> al enviar Correo Informativo al Cliente.<br>";
            $clase = "alert alert-danger alert-dismissable fade in";
            return "0";
    endif;
    echo "<div class='$clase'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        $msg</div>";   
}
function enviarEmailFactura($idp){

    $emailFac = getCorreo($idp);
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

    $subject = "Salvador Hairdressing: Mystery Shopper - El participante $emailFac ha adjuntado su factura";
    $email = 'noreply@salvadorhairdressing.com';
    $name = 'Salvador Hairdressing';    

    $mail->SetFrom( $email , $name );
    $mail->AddAddress( 'prog.web@salvadorhairdressing.com' );
    $archivo = $src;
       
    $mail->Subject = $subject;

    $body = "Nueva factura de Mystery Shopper";

    $mail->MsgHTML( $body );
    $mail->AddAttachment($archivo);
    $sendEmail = $mail->Send();

    if( $sendEmail == true ):
    $msg = "<b>¡Participante Aprobado Éxitosamente!</b> Este recibirá un correo siendo informado.<br><br><b>Aviso:</b> No se pueden programar visitas, hasta que el cliente no responda la encuesta inicial.";
        $clase = "alert alert-success alert-dismissable fade in";
        return "1";
    else:
            $msg = "<strong>Error</strong> al enviar Correo Informativo al Cliente.<br>";
            $clase = "alert alert-danger alert-dismissable fade in";
            return "0";
    endif;
    // echo "<div class='$clase'>
    //     <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
    //     $msg</div>";   

}
function enviarEmailRechazado($emailRech){

    require_once "../../mysteryshopper/etc/phpmailer/class.phpmailer.php";
    require_once "../../mysteryshopper/etc/phpmailer/class.smtp.php";

    $mail = new PHPMailer();
    $mail->SMTPDebug = 0;                        
    $mail->isSMTP();                                    
    $mail->Host = 'mail.salvadorhairdressing.com';               
    $mail->SMTPAuth = true;                               
    $mail->Username = 'atc@salvadorhairdressing.com';  
    $mail->Password = 'atencion.14';                         
    $mail->SMTPSecure = 'ssl';                            
    $mail->Port = 465;     
    $mail->CharSet = 'UTF-8';     

    $message = "";
    $status = "false";
    $subject = 'Salvador Hairdressing: Mystery Shopper - Rechazado';       

    $toemail = $emailRech;  

    $email = 'noreply@salvadorhairdressing.com';
    $name = 'Salvador Hairdressing';         

    $mail->SetFrom( $email , $name );
    $mail->AddAddress( $toemail );
    $mail->Subject = $subject;       

    $htmlContent1 = file_get_contents("../etc/correos/rechazado.php");
    $variable = $htmlContent1;

    $body = $variable;
    $mail->MsgHTML( $body );
    $sendEmail = $mail->Send();
    
    if ($sendEmail == true) {
        $msg = "<b>¡Participante Rechazado!</b><br><br>Este recibirá un correo siendo informado.";
        $clase = "alert alert-success alert-dismissable fade in";
    }else{
        $msg = "<strong>Error</strong> al enviar Correo Informativo al Cliente.<br>";
        $clase = "alert alert-danger alert-dismissable fade in";

    }
    echo "<div class='$clase' style='background-color: #dff0d8;color: #3c763d;border: none;border-radius: 0;position: relative;
    font-size: 19px;line-height: 22px;padding: 16px;'>
    <a href='#' class='close' data-dismiss='alert' aria-label='close'></a>
    $msg</div><br><br>";
    echo "<div style='width:200px;margin-left: auto;margin-right: auto;'><a href='../../../intranet/mysteryshopper/'><button type='button' class='btn-primary' style='padding: 9px;font-size: 17px;margin: 30px 0 10px;margin-right: 10px;
    line-height: 20px;padding: 5px 35px;height: 50px;border: 2px solid #d34a4a;background: #d34a4a;transition: all 0.4s;
    color: white;border-radius: 100px;cursor: pointer;'>Regresar a Intranet</button></a></div>";
}

function enviarRecordatorioBanco($user){
    $to = $user;
    $subject = "Salvador Hairdressing: Mystery Shopper - Completa tu Información Bancaria";

    $htmlContent = file_get_contents("../../mysteryshopper/etc/correos/datosbancarios.php");

    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    //$headers .= 'Cc: arm_lug@outlook.com' . "\r\n";
    //$headers .= 'Bcc: welcome2@example.com' . "\r\n";

    // Send email
    if(mail($to,$subject,$htmlContent,$headers)):
        $msg = "Correo Recordatorio al Cliente fue <strong>Enviado Éxitosamente</strong>.<br>";
        $clase = "alert alert-success alert-dismissable fade in";
    else:
        $msg = "<strong>Error</strong> al enviar Correo Recordatorio al Cliente.<br>";
        $clase = "alert alert-danger alert-dismissable fade in";  
    endif;
    
    echo "<div class='$clase'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        $msg</div>";
}
function enviarNuevaCita($user, $fecha, $salones, $mensaje, $descripcion, $servicios){
    //Correo que le envia al usuario cuando le asigan una nueva visita
    require_once "phpmailer/class.phpmailer.php";
    require_once "phpmailer/class.smtp.php";

    list($salon,$salondir,$concepto,$imagen, $latitud, $longitud) = getSalon($salones);
    $date = date("j-m-Y", strtotime($fecha));

    $mail = new PHPMailer(true);

try {
    
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = "mail.salvadorhairdressing.com";
    $mail->SMTPAuth = true;
    $mail->Username = "atc@salvadorhairdressing.com";
    $mail->Password = 'atencion.14';
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8'; 

    $email = 'noreply@salvadorhairdressing.com';
    $name = 'Salvador Hairdressing';
    
    $mail->setFrom( $email , $name );
    $mail->AddAddress($user);

    $mail->isHTML(true);
    $mail->Subject = 'Salvador Hairdressing: Mystery Shopper - ¡Nueva Visita!';
    // $mail->Body = file_get_contents('../../mysteryshopper/etc/correos/nuevacita.php');
    $htmlContent1 = file_get_contents("../../mysteryshopper/etc/correos/nuevacita.php");
    $htmlContent2 = "<tr><td style='text-align:justify;'>
                                      <span class='header-sm'>Salón:</span> <b>Salvador $concepto $salon</b><br />
                                      <span class='header-sm'>Dirección del Salón:</span> <b>$salondir</b><br />
                                      <span class='header-sm'>Fecha apróximada de la visita:</span> <b>$date</b><br />
                                      <span class='header-sm'>Instrucciones:</span> <b>$mensaje</b><br />
                                      <span class='header-sm'>Servicios a Pedir:</span> <b>$servicios</b><br /><br/>
                                      <span style='text-align: justify;'>Una vez realizada tu visita como <b>Mystery Shopper</b> al salón, podrás rellenar un cuestionario sobre como te atendieron. Consulta <b>más detalles</b> de tu visita entrando a tu cuenta.</span><br><br>
                                    </td></tr><tr>
            <td align='center'><span class='header-sm'><i>Ver dirección en Mapa:</i></span>
            <br><img src='https://maps.googleapis.com/maps/api/staticmap?center=$latitud,$longitud&zoom=16&size=280x280&markers=color:red%7CLabel:S%7C$latitud,$longitud&key=AIzaSyC58dYC8K9L2_0kTQXJx3I9pqpt1587Lxg'></img>
            </td>";

    $htmlContent3 = file_get_contents("../../mysteryshopper/etc/correos/nuevacita2.php");

    $contenido = $htmlContent1.$htmlContent2.$htmlContent3;

    $mail->Body = $contenido;
    $mail->send();
        $msg = "<strong>¡La visita fue programada éxitosamente!</strong><br><br>El correo con Aviso de Nueva Visita fue enviado al Cliente <strong>Éxitosamente</strong>.<br>";
        $clase = "alert alert-success alert-dismissable fade in";

} catch (Exception $e) {
        $msg = "<strong>Error</strong> al enviar Correo de Aviso al Cliente.<br>";
        $clase = "alert alert-danger alert-dismissable fade in";  
}
    echo "<div class='$clase'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        $msg</div>"; 
}

/*function enviarNuevaCita($user, $fecha, $salones, $mensaje, $descripcion, $servicios){

    list($salon,$salondir,$concepto,$imagen, $latitud, $longitud) = getSalon($salones);

    //$salon = getSalon($salones);
    //setlocale(LC_TIME, 'es_ES.UTF-8');
    $date = date("j-m-Y", strtotime($fecha));
    $to = $user;

    $subject = "Salvador Hairdressing: Mystery Shopper - ¡Nueva Visita!";
    $htmlContent1 = file_get_contents("../../mysteryshopper/etc/correos/nuevacita.php");
    $htmlContent2 = "<tr><td style='text-align:justify;'>
                                      <span class='header-sm'>Salón:</span> <b>Salvador $concepto $salon</b><br />
                                      <span class='header-sm'>Dirección del Salón:</span> <b>$salondir</b><br />
                                      <span class='header-sm'>Fecha apróximada de la visita:</span> <b>$date</b><br />
                                      <span class='header-sm'>Instrucciones:</span> <b>$mensaje</b><br />
                                      <span class='header-sm'>Servicios a Pedir:</span> <b>$servicios</b><br /><br/>
                                      <span style='text-align: justify;'>Una vez realizada tu visita como <b>Mystery Shopper</b> al salón, podrás rellenar un cuestionario sobre como te atendieron. Consulta <b>más detalles</b> de tu visita entrando a tu cuenta.</span><br><br>
                                    </td></tr><tr>
            <td align='center'><span class='header-sm'><i>Ver dirección en Mapa:</i></span>
            <br><img src='https://maps.googleapis.com/maps/api/staticmap?center=$latitud,$longitud&zoom=16&size=280x280&markers=color:red%7CLabel:S%7C$latitud,$longitud&key=AIzaSyC58dYC8K9L2_0kTQXJx3I9pqpt1587Lxg'></img>
            </td>";

    $htmlContent3 = file_get_contents("../../mysteryshopper/etc/correos/nuevacita2.php");

    $htmlContent = $htmlContent1.$htmlContent2.$htmlContent3;
    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    // $headers .= 'Cc: alejo.jesus.magne@gmail.com' . "\r\n";
    // $headers .= 'Bcc: programacion@salvadorhairdressing.com' . "\r\n";

    // Send email
    if(mail($to,$subject,$htmlContent,$headers)):

        $msg = "<strong>¡La visita fue programada éxitosamente!</strong><br><br>El correo con Aviso de Nueva Visita fue enviado al Cliente <strong>Éxitosamente</strong>.<br>";
        $clase = "alert alert-success alert-dismissable fade in";
    else:
        $msg = "<strong>Error</strong> al enviar Correo de Aviso al Cliente.<br>";
        $clase = "alert alert-danger alert-dismissable fade in";  
    endif;
    
    echo "<div class='$clase'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        $msg</div>"; 

}*/

function enviarAvisoEncueRespon($idp){

    $emailEn = getCorreo($idp);
    // $descripc = getEncuesta($idEnc);
    
    $to = "prog.web@salvadorhairdressing.com";

    $subject = "Salvador Hairdressing: Mystery Shopper-Encuestas Post-Visitas: $emailEn ¡ha completado todas las encuestas";

    $htmlContent = file_get_contents("../etc/correos/enviar_aviso_encuesta.php");

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    $headers .= 'Cc: eduardocolmenares@gmail.com' . "\r\n";
    $headers .= 'Bcc: prog.web@salvadorhairdressing.com' . "\r\n";
    
    if(mail($to,$subject,$htmlContent,$headers)):
        $msg = "<strong>¡El envio de correo ha sido exitoso!</strong>.<br>";
        $clase = "alert alert-success alert-dismissable fade in";

    else:
       $msg = "<strong>Error</strong> al enviar Correo de Aviso al Administrador.<br>";
       $clase = "alert alert-danger alert-dismissable fade in";  

    endif;
     // echo "<div class='$clase'>
     //    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
     //    $msg</div>"; 
}

function enviarRecordatorioProgr($idpart){

    $name = getNombre($idpart);
  
    $to = "prog.web@salvadorhairdressing.com";
    
    $subject = "Salvador Hairdressing: Mystery Shopper - $name ¡ha completado sus datos bancarios!";

    $htmlContent = file_get_contents("../etc/correos/datosbancariosafter.php");

    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    $headers .= 'Cc: eduardocolmenares@gmail.com' . "\r\n";
    $headers .= 'Bcc: prog.web@salvadorhairdressing.com' . "\r\n";

    // Send email
    if(mail($to,$subject,$htmlContent,$headers)):
        //header('location: /mysteryshopper/index.php?e=1');
        include '../index.php?e=1';
//
//        $msg = "<strong>¡La visita fue programada éxitosamente!</strong><br><br>El correo con Aviso de Nueva Cita fue enviado al Cliente <strong>Éxitosamente</strong>.<br>";
//        $clase = "alert alert-success alert-dismissable fade in";
    else:
        header('location: /mysteryshopper/index.php?e=0');
//        $msg = "<strong>Error</strong> al enviar Correo de Aviso al Cliente.<br>";
//        $clase = "alert alert-danger alert-dismissable fade in";  
    endif;    
//    echo "<div class='$clase'>
//        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
//        $msg</div>"; 
}

function enviarInvitaciones($array){
    require_once "../../mysteryshopper/etc/phpmailer/class.phpmailer.php";
    require_once "../../mysteryshopper/etc/phpmailer/class.smtp.php";

    $mail = new PHPMailer();
    //$mail->SMTPDebug = 3;                               // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'mail.salvadorhairdressing.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'atc@salvadorhairdressing.com';    // SMTP username
    $mail->Password = 'atencion.14';                         // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->CharSet = 'UTF-8';

    $message = "";
    $status = "false";

    $subject = 'Salvador Hairdressing: Mystery Shopper - ¡Sé un Cliente Misterioso!';

    $toemail = $array; // Your Email Address
    //$toname = "Salvador Hair"; // Your Name
    $email = 'atc@salvadorhairdressing.com';
    $name = 'Salvador Hairdressing';

    $mail->SetFrom( $email , $name );
    $mail->AddAddress( $toemail );
    $mail->Subject = $subject;

    $variable = file_get_contents("../../mysteryshopper/etc/correos/invitacion.php");

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

function enviarInvitaciones2($array){
    $to = "noreply@salvadorhairdressing.com";
    $subject = "Salvador Hairdressing: Mystery Shopper - ¡Sé un Cliente Misterioso!";

    $htmlContent = file_get_contents("../../mysteryshopper/etc/correos/invitacion.php");

    // Set content-type header for sending HTML email
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    $headers .= 'CC: '.$array. "\r\n";

    // Send email
    if(mail($to,$subject,$htmlContent,$headers)):
        //header('location: /mysteryshopper/index.php?e=1');
        //include '../index.php?e=1';
      return "1";
//
//        $msg = "<strong>¡La visita fue programada éxitosamente!</strong><br><br>El correo con Aviso de Nueva Cita fue enviado al Cliente <strong>Éxitosamente</strong>.<br>";
//        $clase = "alert alert-success alert-dismissable fade in";
    else:
        //header('location: /mysteryshopper/index.php?e=0');
      return "0";
//        $msg = "<strong>Error</strong> al enviar Correo de Aviso al Cliente.<br>";
//        $clase = "alert alert-danger alert-dismissable fade in";  
    endif;
    
//    echo "<div class='$clase'>
//        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
//        $msg</div>";    
}

/* FUNCIONES COMPLEMENTARIAS PARA LOS CORREOS */

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
function getEncuesta($idEnc){
    require_once "../../sitio/sec/ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $descrip = "";
    
    $sql = "SELECT descripcion FROM ms_encuesta WHERE id = $idEnc LIMIT 1";
    $consulta = mysqli_query($dbh, $sql);
    $resultado = mysqli_num_rows($consulta);
    if ($resultado > 0) {
        while ($rw = mysqli_fetch_array($consulta)) {
            $descrip = $rw['descripcion'];
            return $descrip;
        }
    } else {
    //No hay descripcion
    }    
}

function getPassword($idp){
    require_once "../../sitio/sec/ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $pass = "";

    $sql = "SELECT password FROM ms_usuario WHERE id = $idp LIMIT 1";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    if ($match > 0) {
            while ($rw = mysqli_fetch_array($search)) {
                $pass = $rw['password'];
                return $pass;
            }
    } else{
        //NO HAY RESULTADO
    }
}

function getNombre($idp){
    require_once "../../sitio/sec/ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $pass = "";

    $sql = "SELECT nombre FROM ms_usuario WHERE id = $idp LIMIT 1";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    if ($match > 0) {
            while ($rw = mysqli_fetch_array($search)) {
                $name = $rw['nombre'];
                return $name;
            }
    } else{
        //NO HAY CORREO
    }
}

function getSalon($ids){
    require_once "../../sitio/sec/ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    $sql = "SELECT NOMBRECOMPLETO, DIRECCION, LATITUD, LONGITUD, DESCRIPCION, IMAGEN FROM web_salones A INNER JOIN web_salones_conceptos B on A.CONCEPTO = B.ID WHERE A.ID = '$ids' LIMIT 1";
    
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    if ($match > 0) {
            while ($rw = mysqli_fetch_array($search)) {
                $name = $rw['NOMBRECOMPLETO'];
                $dir = $rw['DIRECCION'];
                $conc = $rw['DESCRIPCION'];
                $img = $rw['IMAGEN'];
                $lat = $rw['LATITUD'];
                $long = $rw['LONGITUD'];
                return array($name, $dir, $conc, $img, $lat, $long);
            }
    } else{
      $name = "CONTACTAR A NUESTRO EQUIPO";
      return $name;
        //NO HAY CORREO
    }  
}
?>

