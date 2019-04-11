<?php
function enviarAvisoNuevoUsuario($email, $nombrec, $pais, $dir1, $phone, $nac, $dir2){



          $paises = array(

          "1" => "<img src='http://www.salvadorhairdressing.com/images/flags/ve1.png' alt='Venezuela'></img>",

          "2" => "<img src='http://www.salvadorhairdressing.com/images/flags/pty1.png'></img>",

          "3" => "<img src='http://www.salvadorhairdressing.com/images/flags/usa1.png'></img>",

          "72" => "<img src='http://www.salvadorhairdressing.com/images/flags/domrep1.png'></img>",

          "249" => "<img src='http://www.salvadorhairdressing.com/images/flags/co1.png'></img>",

          "302" => "<img src='http://www.salvadorhairdressing.com/images/flags/ec1.png'></img>",

          "304" => "<img src='http://www.salvadorhairdressing.com/images/flags/cu1.png' alt='Curacao'></img>",

          "378" => "<img src='http://www.salvadorhairdressing.com/images/flags/per1.png' alt='Peru'></img>"    );



          $age = getEdad($nac);

          $mailcod = base64_encode($email);

          $id = getIdByEmail($email);

    //$to = "mgiurdanella@gmail.com";

    $to = "prog.web@salvadorhairdressing.com";

    $subject = "Salvador Hairdressing: Mystery Shopper - ¡Nueva Solicitud de Participante!";



    $htmlContent1 = file_get_contents("../sitio/sec/ms/correos/nuevoregistro.php");

    //$htmlContent1 = file_get_contents("correos/nuevoregistro.php");

    $htmlContent2 = "<tr><td><b>Email:</b></td><td>$email</td></tr>

                    <tr><td><b>Nombre:</b></td><td>$nombrec</td></tr>

                    <tr><td><b>País:</b></td><td>$paises[$pais]</td></tr>

                    <tr><td><b>Localidad:</b></td><td>$dir1</td></tr>

                    <tr><td><b>Teléfono:</b></td><td>$phone</td></tr>

                    <tr><td><b>Edad:</b></td><td>$age</td></tr>

                    <tr><td><b>Dirección:</b></td><td>$dir2.</td></tr>

                    <tr><td colspan='2' style='text-align: center;'><br><b>¿Aprobar?</b></td></tr><tr><td style='text-align: center;background:lightcoral;color:#ffffff;border-top-left-radius: 5px;'><br><a href='http://www.salvadorhairdressing.com/mysteryshopper/admin/partEstado.php?mail=$mailcod&t=1' style='color:#ffffff;'> Si </a></td><td style='text-align: center;background:lightpink;color:#ffffff;border-top-right-radius: 5px;'><br><a href='http://www.salvadorhairdressing.com/mysteryshopper/admin/partEstado.php?mail=$mailcod&t=2' style='color:#ffffff;'> No </a></td></tr>";

    $htmlContent3 = file_get_contents("../sitio/sec/ms/correos/nuevoregistro2.php");

    //$htmlContent3 = file_get_contents("correos/nuevoregistro2.php");

    // Set content-type header for sending HTML email



    $htmlContent = $htmlContent1.$htmlContent2.$htmlContent3;



    $headers = "MIME-Version: 1.0" . "\r\n";

    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";



    // Additional headers

    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";

    //$headers .= 'Cc: oym@salvadorhairdressing.com, sistemas@salvadorhairdressing.com' . "\r\n";

    $headers .= 'Bcc: prog.web@salvadorhairdressing.com' . "\r\n";



    // Send email

    if(mail($to,$subject,$htmlContent,$headers)):

        return "1";

    else:

        return "0";

    endif;



}
function getIdByEmail($email) {

    require_once "libcon.php";

    $dbh = dbconn();

    mysqli_set_charset($dbh, "utf8");

    if (!$dbh) {
        die("Error en Conexión: " . mysqli_error($dbh));
        exit();
    }
    $sql = "SELECT id FROM ms_usuario WHERE correo = $email";

    $consulta = mysqli_query($dbh,$sql);

    $resultado = mysqli_num_rows($consulta);
    $id = null;
    if ($resultado > 0) {
        $rw = mysqli_fetch_array($consulta,MYSQLI_ASSOC);
        $id = $rw["id"];
    }
    return $id;
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

    $dbh = dbconncc();

    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {

        die('Error en Conexión: ' . mysqli_error($dbh));

        exit;

    }



    $sql = "SELECT NOMBRE FROM SALONES WHERE CODIGO = '$ids' LIMIT 1";

    $search = mysqli_query($dbh, $sql);

    $match = mysqli_num_rows($search);

    if ($match > 0) {

            while ($rw = mysqli_fetch_array($search)) {

                $name = $rw['NOMBRE'];

                return $name;

            }

    } else{

      $name = "CONTACTAR A NUESTRO EQUIPO";

      return $name;

        //NO HAY CORREO

    }  

}



function getEdad($nacimiento){

  $edad = 0;

  if((date('F') - date('F', strtotime($nacimiento))) << 0){

                    $edad = date('Y') - date('Y', strtotime($nacimiento));

                    $edad = $edad - 1;

                } else if((date('F') - date('F', strtotime($nacimiento))) == 0){

                    if((date('d') - date('d', strtotime($nacimiento))) >= 0){

                        $edad = date('Y') - date('Y', strtotime($nacimiento));

                    } else if((date('d') - date('d', strtotime($nacimiento))) << 0){

                        $edad = date('Y') - date('Y', strtotime($nacimiento));

                        $edad = $edad - 1;

                    }

                }

                return $edad;

}



//enviarAvisoNuevoUsuario('alugox@gmail.com', '$nombrec', 1, '$dir1', '$phone', '$nac', '$dir2');



?>

