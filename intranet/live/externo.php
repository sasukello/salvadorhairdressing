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
                list($datos,$var) = explode(";", $inv);
                $datos = base64_decode($datos);
                $marca = base64_decode($var);
                pedidoSugerido($marca, $datos);
                break;
            case 'ped_sug_mod':
                include "../sec/inventario.php";
                $datos = $_POST["datos"];
                $marca = $_POST["brand"];
                enviarPediSug($datos, $marca);
                break;
            case 'copia_sug':
                include "../sec/inventario.php";
                $mail = $_POST["d1"];
                $dat = $_POST["d2"];
                $adi = $_POST["d3"];
                enviarMailSug($mail, $dat, $adi);
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
            case 'rcc-ind':
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
                resumenventa3($user);
                break;
            case 'detalleventadashboard':
                include "../sec/intranetvarios.php";
                $datos = $_POST['datos'];
                detalleVD($datos);
                break;
            case 'desaso':
                include "../corporativo/rrhh/desaso.php";
                $datos = $_POST['datos'];
                ejecutardesbloquear($datos);
                break;
            case 'plus':
                $datos = $_POST['datos'];
                $datosdec = (array) json_decode($datos, true);
                //var_dump($datosdec);
                $action = base64_decode($datosdec["id"]);

                switch ($action) {
                    case 'P1':
                        $step = $_POST['step'];
                        switch ($step) {
                            case '1':
                                include "../sec/plus-productos.php";
                                echo armarTablaPlus(1);
                                break;

                            case '2':
                                include "../sec/plus-productos.php";
                                $marcas = loadProductosMarcas($action, base64_decode($datosdec["salon"]), base64_decode($datosdec["route"]));
                                echo populateselect('marca', $marcas);
                                break;

                            case '3': // click en cargar lineas
                                include "../sec/plus-productos.php";
                                $marcas = $_POST['adicional'];
                                $buscarLineas = loadProductosLineas($action, $marcas, base64_decode($datosdec["salon"]), base64_decode($datosdec["route"]));
                                echo populateselect('lineas', $buscarLineas);
                                break;

                            case '4': // consulta de productos - armar tabla
                                include "../sec/plus-productos.php";
                                echo armarTablaPlus2(1);
                                break;

                           case '5':
                                include "../sec/plus-productos.php";
                                 $marcas = $_POST['marcas'];
                                 $lineas = $_POST['lineas'];

                                 echo $buscarProductos = loadProductosActuales($action, $marcas, $lineas, base64_decode($datosdec["salon"]), base64_decode($datosdec["route"]));

                                 //echo loadProductosActuales($buscarProductos);
                                break;
                            case 'plusproductedit': // CARGA LA TABLA PRINCIPAL DEL ARCHIVO PRODUCTOS.PHP
                                include "../sec/plus-productos.php";
                                $marcas = $_POST['marca'];
                                $lineas = $_POST['linea'];
                                $buscarProductos = loadProductosActuales($action, $marcas, $lineas, base64_decode($datosdec["salon"]), base64_decode($datosdec["route"]));
                                echo $tabla = armarLiveEdit($buscarProductos, 1);


                                break;
                        }

                        
                        break;
                     case 'P2': // CONSULTA SERVICIOS - ABRO MODAL
                     $step = $_POST['step'];
                     switch ($step) {
                        case 'S1':
                           include "../sec/plus-productos.php";
                           echo armarTablaPlus(2);
                           break;
                        case 'S2': // Carga Tabla
                           include "../sec/plus-productos.php";
                           echo armarTablaPlus2(2);

                           break;
                        case 'S3': // Carga Valores de la Tabla
                           include "../sec/plus-productos.php";

                           $buscarServicios = loadServiciosActuales($action, base64_decode($datosdec["salon"]), base64_decode($datosdec["route"]));

                           echo $buscarServicios;

                           break;
                        
                        default:
                           # code...
                           break;
                     }
                     
                     break;

                     case 'P3': // ACTUALIZAR PRODUCTOS
                        $paso = $_POST["step"];
                        switch ($paso) {
                            case '1': // actualizo productos
                                include "../sec/plus-productos.php";
                                $user = $_POST["usuario"];
                                $ruta = $_POST["route"];
                                $save = saveHistorialProductos("p", $datos, $user, $paso, $ruta); // GUARDO LA MODIFICACIÓN DEL PRODUCTO
                                if($save == "1"){
                                    // actualizo precio
                                    echo $save;
                                }
                                break;

                            case '2':
                                include "../sec/plus-productos.php";
                                $user = $_POST["usuario"];
                                $ruta = $_POST["route"];
                                $save = saveHistorialProductos("p", $datos, $user, $paso, $ruta); // GUARDO EL PRODUCTO RECIEN CREADO
                                if($save == "1"){
                                    // ingreso producto nuevo
                                    echo $save;
                                }

                                break;

                            case '3':
                                include "../sec/plus-productos.php";
                                $user = $_POST["usuario"];
                                $ruta = $_POST["route"];
                                $save = saveHistorialProductos("s", $datos, $user, $paso, $ruta); // GUARDO EL PRODUCTO RECIEN CREADO
                                if($save == "1"){
                                    // actualizo precio
                                    echo $save;
                                }

                                break;
                             
                            default:
                                # code...
                                break;
                        }                     
                         break;
                     default:
                        # code...
                        break;
                }

                # code...
                break;
            default:
                break;
        }
    }
?>