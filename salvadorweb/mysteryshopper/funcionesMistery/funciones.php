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
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION["email"] = $user;
          // session_unset();
          // session_destroy();
          // session_start();
        
        header("Location: /mysteryshopper/login.php?t=1");
        
    } else {
        // SI NO ENCUENTRA COINCIDENCIA -> VERIFICA SI ES USUARIO CORPORATIVO
        // header("Location: http://gruposalvador.dyndns.org/sitio/sec/ms/logserv.php?u=".base64_encode($user  )."");

        $resulta = "";
        $error = hacerpost("http://gruposalvador.dyndns.org/sitio/sec/ms/logserv.php?","u=".base64_encode($user),$resulta);

        $numero=(int) $error; // si es 1 encontro usuario 
        if ($error == 0 ) {  //Usuario es nuevo       
            $userc = base64_encode($user);
            header("Location: /mysteryshopper/registro.php?uu=$userc");     
        }else if ($error == 1) { // Es un usuario registrado
            header("Location: /mysteryshopper/login.php?t=2&uu=".base64_encode($user)); 
        }else{
            echo "Entre aqui".$error."-";
        }
        return;
    }
}
function procesoRegistro(){
    require_once "../../sitio/sec/ms/libcon.php";
    require_once "../../sitio/sec/ms/libmail.php";

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
            enviarAvisoNuevoUsuario($email, $nombre." ". $apellido, $pais, $estado." ".$ciudad,                    $phone,$nacimiento,$direccion);
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
function hacerpost($url, $parametros, &$resultado){
    //La funcion devuelve espacio en blanco si la variable resultado va cargada, de lo contrario devuelve error
    // abrimos la sesion cURL
    $ch = curl_init();                
    // definimos la URL a la que hacemos la peticion
    curl_setopt($ch, CURLOPT_URL,$url);
    // indicamos el tipo de peticion: POST
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);              
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    // recibimos la respuesta y la guardamos en una variable
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $remote_server_output = curl_exec ($ch);
    // cerramos la sesion cURL
    curl_close ($ch);
    //Comenzamos el manejo de errores
    if ($remote_server_output == "") {
        $remote_server_output = "Error 1: Fallo de conexion.";
    }
    if (strtoupper(substr($remote_server_output, 0, 1)) == "["){
        $resultado = $remote_server_output;
        return "";        
    }
    else {
        //Dio error
        $resultado = "";
        return $remote_server_output;
    }
}


?>