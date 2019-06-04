<?php
function comprobacionserver($user, $password){
    require_once "libcon.php";

        $nombre = strtoupper($user);
        $nombreUsuario = "";
        $permisoUsuario = "";

        $con = Conectarfb();
        $sql = "SELECT hash('$password'), CLAVEHASH, CODIGO, NOMBRECOMPLETO, NIVEL FROM usuarios WHERE CODIGO = '$nombre'";
        $result = ibase_query($con, $sql);

        $rawdata = array();
        $i = 0;

        while ($row = ibase_fetch_object($result)) {
            $rawdata[$i] = $row;
            $i++;
        }
        
        $array = json_encode($rawdata);
        $array2 = json_decode($array);
        
        $usuarioTemp = $array2[0]->CODIGO;
        $nombreUsuarioTemp = $array2[0]->NOMBRECOMPLETO;
        $permisoUsuario = $array2[0]->NIVEL;
        $clavehash1 = $array2[0]->HASH;
        $clavehash2 = $array2[0]->CLAVEHASH;
        
        $usuario = ucwords($usuarioTemp);
        $nombreUsuario = ucwords(strtolower($nombreUsuarioTemp));
        //$nombreUsuario = ucwords(strtolower($nombreUsuario));
        
        $cod = base64_encode(strtoupper($usuario));
        $nomcod = base64_encode($nombreUsuario);
        $permcod = base64_encode($permisoUsuario);
            
        if($clavehash1 === $clavehash2){
            header("location: http://www.salvadorhairdressing.com/intranet/verification.php?cs=$cod&us=$nomcod&ps=$permcod");
            return;
        } else if ($clavehash1 !== $clavehash2){
            //CLAVES NO COINCIDEN
            header("location: http://www.salvadorhairdressing.com/intranet/login.php?e=1&user=$usuarioTemp&h1=$clavehash1&h2=$clavehash2&sql=$sql");
            return;    
        }
}

if(isset($_GET['uu'])){
    $user = base64_decode($_GET['uu']);
    $pass = base64_decode($_GET['pp']);
    comprobacionserver($user, $pass);
} else {
    echo "Acceso Denegado!";
}
?>
