<?php

/*
 * LIBRERIA DE FUNCIONES PARA: MISTERY SHOPPER
 */

define("SITE_ROOT", "http://www.salvadorhairdressing.com");

function pasouno($user){    
    require_once "libcon.php";
    $dbh = dbconn();
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
    } else {
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
            
            enviarAvisoNuevoUsuario($email, $nombre." ". $apellido, $pais, $estado." ".$ciudad, $phone, $nacimiento, $direccion);

            header('location: /mysteryshopper/index.php?e=1');
            //header('location: /mysteryshopper/cuenta/mailcontroller.php?reg=1');
            exit;
        } else {
            die(mysqli_error($dbh));
            header('location: /mysteryshopper/index.php?e=0');
            exit;
        }        
        
    } else{
        // CONTRASEÑAS NO COINCIDEN, REGRESAR
        $cod = base64_encode($email);
        header("location: /mysteryshopper/registro.php?uu=$cod&e=2");
        //            header('location: /mysteryshopper/cuenta/mailcontroller.php?reg=1');
        exit;
    }
    

}

function selecPaises(){
    require_once "libcon.php";
    $dbh = dbconncc();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    
    $sql = "SELECT * FROM REGIONES";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            echo "<option value='".$rw['CODREGION']."'>".$rw['NOMBRE']."</option>";
        }
        
    }else {
        echo "<option value=''>No se encontraron resultados.</option>";
    }
    return;
}

function comprobarLoginCorp($user, $password){
    
        header("Location: http://gruposalvador.dyndns.org/sitio/sec/ms/logserv.php?uu=".base64_encode($user)."&pp=".  base64_encode($password));
        return;
        
}

function comprobarLoginCorpExterno($user, $password, $param1, $param2){
    
        header("Location: http://gruposalvador.dyndns.org/sitio/sec/ms/logserv.php?uu=".base64_encode($user)."&pp=".  base64_encode($password)."&p1=". base64_encode($param1) . "&p2=" . base64_encode($param2));
        return;
        
}

function comprobarLoginPart($user, $password){
    require_once "libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $estado = "";
    $sql = "SELECT * FROM ms_usuario WHERE correo = '$user' && password = '$password' LIMIT 1";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $iduser = $rw['id'];
            $estado = $rw['status'];
        }
        
        if($estado == 1){
            session_start();
            $_SESSION["iduser"] = $iduser;
            $_SESSION["usuario"] = $user;
            $_SESSION["hash"] = "465g5gf688gr";
            header("location:/mysteryshopper/cuenta/index.php");
            return;
        } else if($estado == 0){
            header("location:/mysteryshopper/index.php?e=2");
            return;
        } else if($estado == 2){
            header("location:/mysteryshopper/index.php?e=3");
            return;
        }
    }else {
        header("location:/mysteryshopper/login.php?t=1&e=2");
        return;
    }
    return;
}


?>
