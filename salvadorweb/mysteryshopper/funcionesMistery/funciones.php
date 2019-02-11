<?php 
function pasouno($user){    
    require_once "../library/libcon.php";
    $dbh = conex();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }   

    $sql = "SELECT * FROM ms_usuario WHERE correo = '".$user."' LIMIT 1;";
    $search = mysqli_query($dbh, $sql);
    $match1 = mysqli_num_rows($search);
    if ($match1 > 0) {
        // SI ENCUENTRA COINCIDENCIA -> YA REGISTRADO
        session_start();    
        $_SESSION["email"] = $user;
        header("location:/mysteryshopper/login.php?t=1");
    }else {
        // SI NO ENCUENTRA COINCIDENCIA -> VERIFICA SI ES USUARIO CORPORATIVO
        header("Location: http://gruposalvador.dyndns.org/sitio/sec/ms/logserv.php?u=".base64_encode($user)."");
    }
    return;
}

function procesoRegistro(){
    require_once "libcon.php";
    require_once "libmail.php";

    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $docfiscal = $_POST["docfiscal"];
    $pais = $_POST["paises"];
    $estado = $_POST["estado"];
    $ciudad = $_POST["ciudad"];
    $phone = $_POST["phone"];
    $nacimiento = $_POST["nacimiento"];
    $direccion = $_POST["direccion"];
    $fechaactual = date("Y-m-d");

    if($password == $cpassword){
        //CONTRASEÑAS COINCIDEN, CONTINUAR
        $sql = "INSERT INTO ms_usuario (docfiscal, nombre, apellido, correo, password, pais, estado, ciudad, telefono, nacimiento, direccion, status, fecha_registro)

            VALUES ('$docfiscal', '$nombre', '$apellido', '$email', '$password', $pais, '$estado', '$ciudad', '$phone', '$nacimiento', '$direccion', 0, '$fechaactual')";

        if (mysqli_query($dbh, $sql)) {            
            enviarAvisoNuevoUsuario($email, $nombre." ". $apellido, $pais, $estado." ".$ciudad, $phone, $nacimiento,                    $direccion);
            header('location: /mysteryshopper/index.php?e=1');
            //header('location: /mysteryshopper/cuenta/mailcontroller.php?reg=1');
            exit;
        }else{
            die(mysqli_error($dbh));
            header('location: /mysteryshopper/index.php?e=0');
            exit;
        }           
    }else{
        // CONTRASEÑAS NO COINCIDEN, REGRESAR
        $cod = base64_encode($email);
        header("location: /mysteryshopper/registro.php?uu=$cod&e=2");
        //header('location: /mysteryshopper/cuenta/mailcontroller.php?reg=1');
        exit;
    }
}

?>