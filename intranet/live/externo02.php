<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['f'])) {
        include "../sec/ventas.php";
        $fact = $_GET["f"];
        list($correlativo,$tipo,$ruta) = explode(";", $fact);
        mostrarfactura($correlativo, $tipo, $ruta);
        
    }
}
    else if(isset($_POST['action'])){
        $accion = $_POST['action'];
    switch ($accion) {
        case 'ped_sug':
            include "../sec/inventario.php";
            $inv = $_POST["datos"];
            list($datos,$idsalon,$ruta,$var) = explode(";", $inv);
            $idsalon = base64_decode($idsalon);
            $ruta = base64_decode($ruta);
            //echo base64_decode($datos);
            $var = base64_decode($var);
            //echo base64_decode($idusuario);
            list($marca,$user) = explode(";", $var);
            pedidoSugerido($user, $idsalon, $marca, $ruta);
            break;
        case 'r1':
            include "../sec/libfunc.php";
            $id = $_POST["datos"];
            regionCargar($id);
            break;
        case 'r1b':
            include "../apps/cc.php";
            $salon = $_POST['datos'];
            r1($salon);
            break;
        case 'r2':
            include "../apps/cc.php";
            $clienteID = $_POST['datos'];
            r2($clienteID);
            break;
        case 'rcc':
            include "../apps/cc.php";
            $data = $_POST['datos'];
            list($paso, $user) = explode(";",$data);
            listacc1($paso, $user);
            break;
        case 'rcc-gen':
            include "../apps/cc.php";
            $data = $_POST['datos'];
            list($paso, $user) = explode(";",$data);
            listacc1("cc2b", $user);
            break; 
        case 'rcc2':
            include "../apps/cc.php";
            $data = $_POST['datos'];
            list($pais, $user, $estado) = explode(";",$data);
            listacc2($pais, $user, $estado);
            break;
        case 'app1':
            include "../apps/cc.php";
            $user = $_POST['datos'];
            
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
                if(!isset($_SESSION["suc"])){
                    $sucursales = cargarSuc();
                    $_SESSION["suc"] = $sucursales;//echo "sesion iniciada";
                } else {// echo "ya tengo mis salones";
            } listacc1("app1", $user);
            break;
        case 'app3':
            include "../apps/cc.php";
            $user = $_POST['datos'];
            
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
                if(!isset($_SESSION["suc"])){
                    $sucursales = cargarSuc();
                    $_SESSION["suc"] = $sucursales;//echo "sesion iniciada";
                } else { /* echo "ya tengo mis salones";*/ }
                listacc1("app3", $user);
            break;
        case 'cc2':
            include "../apps/cc.php";
            $data = $_POST['datos'];
            list($pais,$user,$paso) = explode(";", $data);
            listacc2($pais, $user, $paso);
            break;
        case 'apps-est1':
            include "../apps/cc.php";
            $data = $_POST['datos'];
            if($_POST['datos'] === "1"){
                loadEst1();
            }
            break;
        case 'postintranet':
            include "../sec/libfunc.php";
            $user = $_POST["datos"];
            echo tareasPendientes($user);
            break;
        case 'postintranetbeta':
            include "../sec/betatester.php";
            $user = $_POST['datos'];
            echo estadoBeta($user);
            break;   
        case 'postintranet3':
            include "../sec/intranetvarios.php";
            $user = $_POST['datos'];
            echo "no";
            //resumenventa1($user);
            break;
        default:
            break;
    }
    }
?>