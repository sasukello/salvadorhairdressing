<?php
ob_start();
$user = "";$iduser = "";

if (session_status() === PHP_SESSION_NONE) {
    session_start();

//var_dump($_SESSION);
    if(isset($_SESSION["codigo"])){
        $user = $_SESSION["usuario"];
        $iduser = $_SESSION["codigo"];
        $peruser = $_SESSION["permiso"];
        $hash = $_SESSION["hash"];
        $arrayMenu = unserialize($_SESSION["accesos"]);
        $_SESSION['ubicacion'] = "live";
        $_SESSION['tabla_basica'] = 1;
        $_SESSION['tabla_responsive'] = 1;
        $_SESSION['tabla_completa'] = "1";        
        $salon = $_SESSION["salon"];
        $rutabd = $_SESSION["ruta"];
        
        if($hash == "s6a5486dasdas31"){
            $bandera = true;
        } else{
        header("location:../logout.php");
        }
    } else{
       header("location:../logout.php");
    }
}
$iduser2 = $iduser;
include "../sec/libfunc.php";
include "../sec/ventas.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitSalon'])) {
        $salon = $_POST["salones"];
        menuLiveCargar($iduser, $salon);
    } else if(isset($_POST['submitvtadia'])){
        if(!empty($_POST['is'])){
            $consulta = 1;
        }
    }
    /******************* CXC ********************/
   /* else if(isset($_POST['submitCXC'])){
        $paso = $_POST["paso"];
        $cxc = 1;
    }*/
    
    /***** DETALLE DE PROMOCIONES (Paso 2) ******/
        else if(isset($_POST['filt'])){       
        if(!empty($_POST['consultar'])){
           $promocion = 1;
        }
    }
    /******** INVENTARIO ESTADISTICO 
    else if(isset($_POST['submitInventa'])){       
        $inventa = 1;
        $codigomarca = $_POST['marca'];
        $codigolinea = $_POST['linea'];
    }************/
}
?>
<!DOCTYPE html>
<html>
        <head>
        <title>Salvador+ Live (Intranet) - Salvador Hairdressing</title>
        <?php   include "../componentes/header.php"; ?>
        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">

        <!--
        <div id="preloader"></div>-->
        <div id="top"></div>

        <!-- /.cabecera -->
        <?php menu1HeaderIntranet($iduser2, $_SESSION['ubicacion'], $arrayMenu); ?>
			  
                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <!-- /.intro section -->
        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">

                        <!-- /.titulo -->
                        <p><h2>SalvadorPlus Live</h2>
                        <p><?php echo "<b>Salón:</b> <label style= 'color:#d34a4a'>". $_SESSION["datossalon"]["NOMBREEMPRESA"] . "</label>"; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.menu de opciones -->
        <?php if(!isset($_GET['o']) && (!isset($_GET['vd'])) && $_SERVER["REQUEST_METHOD"] != "POST"){
            echo "<div class='or-spacer'>
                    <div class='mask'></div>
                    <span><i>Menú</i></span>
                  </div>";
        } else { ?>
        <div id="client" style="padding-top: 20px;"> 
            <div class="container">
                <div class="row">
                    <?php 
                    /******** modulo de opciones ************/
                    if(isset($_GET['o'])){
                        $_GET   = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
                        $opc = $_GET['o'];
                        if($opc=="nx"){
                            echo "<div class='alert alert-danger'><strong>¡Error!</strong> La conexión con el servidor no fue éxitosa.</div>";
                        } else{
                            opcionesLlamar($opc, $salon.";".$rutabd);
                            if(isset($_GET['p']) && ($_GET['p'] == 11)){
                                header("Location: ?o=$opc");
                            }
                        }

                    /******** modulo de ventas ************/
                        
                    } else if(isset($_GET['vd']) && !empty($_GET['vd'])){
                        $tipo = $_GET['vd'];
                        if(isset($_GET['p']) && ($_GET['p'] == 11)){
                                header("Location: ?vd=$tipo");
                        }
                        $_SESSION["tabla_completa"] = "1";
                        $_SESSION["tabla_responsive"] = "1";
                        $filt = base64_decode($_SESSION["filtros_ventas"]);
                        opcionVentaDetalleResultado($filt, $tipo, $rutabd);
                    }
                    if(isset($consulta)){
                        if($consulta == 1){
                            $_SESSION["tabla_completa"] = "1";
                            $total = $_POST['is'];
                            $filtro = $_POST['filt'];
                            $totalarr = explode(',',$total);
                            ventaDiaResultado($totalarr, $filtro, $rutabd);
                        }
                    }
                    
                    
                    /******** detalle promociones ************/
                    if (isset($promocion)){
                       include "../sec/promo.php";
                       $total = $_POST['consultar'];                        
                       opcionPromociones($salon.";".$rutabd, 2, $total[0]);
                    } 

                    /******** INVENTARIO ESTADISTICO ************/
                    if (isset($inventa)){
                       include "../sec/inventa.php";
                       $_SESSION["tabla_completa"] = "0";
                       mostrarinventario($codigomarca, $codigolinea, $salon.";".$rutabd);
                    } ?>
                </div>
            </div>
        </div> <?php } ?>
        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center" id="regiones">
                        <br><h2>Opciones de Salón:</h2>
                    <?php
                    $arrayrestr = unserialize(base64_decode($_SESSION["restricciones"]));
                    foreach ($arrayrestr as $restr) {
                        echo menuLiveMostrar($restr);
                    }
                    ?>
                    </div>
                </div>
            </div>
            <?php if ($peruser == "11" || $peruser == "50"){ 
                echo '<div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center" id="regiones">
                        <br><h2>Operaciones:</h2>';
                    
                    $arrayrestr = unserialize(base64_decode($_SESSION["restricciones"]));
                    //foreach ($arrayrestr as $restr) {
                        echo menuLivePlusMostrar($restr, $salon, $rutabd);
                    //}
                    
                    echo '</div>
                </div>
            </div>';

            }?>
            

        </div>
                
        <!-- COMIENZO DE MODAL: CLICK EN TOTAL  -->
        <div id="filtroventas" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Consulta el Resumen de las Ventas por Día:</b></h4>
                    </div>
                    <div class="modal-body">
                        <form action="" id="formcat" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-9" for="filtroventa">¿Consultar por Servicios, Inventario o Ambos?</label>
                                <br><br><div class="col-sm-12">
                                    <div class="list-group">
                                        <a href="salon.php?vd=S" id="probando" class="list-group-item">Servicios</a>
                                        <a href="salon.php?vd=I" class="list-group-item">Inventario</a>
                                        <a href="salon.php?vd=A" class="list-group-item">Ambos</a>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="tipo" value="2a" />

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: ADD -->

        <!-- COMIENZO DE MODAL: OPERACIONES  -->
        <div id="operacionesplus" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span id="oper-titulo"></span></h4>
                    </div>
                    <div class="modal-body" style="display: inline-block;">
                        <input type="hidden" name="loaded" value="0">
                        <input type="hidden" name="keepmehere" value="0">
                        <span id="oper-body"></span>
                        <span id="oper-body2"></span>
                    </div>
                    <div class="modal-footer">
                        <span id="oper-footer"></span><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: OPERACIONES -->

        <?php include "../componentes/footer.php"; ?>  
    </body>
</html>
<?php ob_end_flush(); ?>