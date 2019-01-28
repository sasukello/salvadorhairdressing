<?php
include "../../sec/seguro.php";
$_SESSION["ubicacion"] = "live";
$_SESSION["calendar_live"] = 1;
$_SESSION["tabla_basica"] = 1;
$_SESSION['tabla_responsive'] = 1;
$_SESSION['tabla_completa'] = "1"; 
$arrayMenu = unserialize($_SESSION["accesos"]);
$code64 = base64_encode($iduser);

include "../../sec/libfunc.php";
include "../../sec/plus-productos.php";

$lineas = ""; $marcas = ""; $action = ""; $datos = ""; $key = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if(isset($_GET["retrieveline"]) && !empty($_GET["retrieveline"])){$lineas = base64_decode($_GET["retrieveline"]);}
    if(isset($_GET["retrievebrands"]) && !empty($_GET["retrievebrands"])) { $marcas = base64_decode($_GET["retrievebrands"]);}
    if(isset($_GET["actiontrigger"]) && !empty($_GET["actiontrigger"])) { $action = $_GET["actiontrigger"];}
    if(isset($_GET["dataset"]) && !empty($_GET["dataset"])) { $datos = base64_decode($_GET["dataset"]);}
    if(isset($_GET["key"]) && !empty($_GET["key"])) { $key = $_GET["key"];}

} ?>

<!DOCTYPE html>
<html>
        <head>
        <title>Salvador+ Live (Intranet) - Salvador Hairdressing</title>
        <?php include "../../componentes/header.php"; ?>
        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader 
        <div id="preloader"></div>-->
        <div id="top"></div>

        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); ?>

                        </div>
                    </div>
                </div> 
            </div> 
        </div>
        
        <!-- /.seccion principal -->
        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">

                        <!-- / titulo -->
                        <br><h2>SalvadorPlus Live</h2>
                        <p>Operaciones - Productos: Editar</p>
                    </div>
                </div>
                <div class="row row-feat">
                    <!-- /.CONTENIDO PRINCIPAL -->
                    <div class="col-md-12">
                    <div class="row"><a href="../" class="btn btn-default" role="button" aria-pressed="true">Regresar a Selección de Salón</a></div>
                    <p></p>
                    <?php if($peruser == "50"){
                        echo '<br><h2>Editando Productos:</h2>';

                        loadOperacionesEdit($lineas, $marcas, $datos, $action);


                    } else{

                        echo "No posees los permisos necesarios para ver esta opción.";
                    }

                    ?>
                    </div>
                    <div class="col-md-12">
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

                    </div>
                </div>
            </div>
        </div>

        <!-- COMIENZO DE MODAL: MINI PROMPT  -->
        <div id="miniprompt" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><span id="mini-titulo"></span></h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="keepmehere" value="<?php echo $_GET["dataset"]; ?>">
                        <span id="mini-body"></span>
                    </div>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>-->
                        <span id="mini-footer"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN DE MODAL: MINI PROMPT -->

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

        <?php include "../../componentes/footer.php"; ?>

        <script>
            $(document).ready(function() {
                    $.ajax({
                        method : "POST",
                        url: '/intranet/live/externo.php',
                        data:{action:'plus', datos: '<?php echo $datos;?>', linea: '<?php echo $lineas;?>', marca: '<?php echo $marcas;?>', step: '<?php echo $action;?>', identificador: 'llamado desde el ajax'},
                        success:function(html) {
                            document.getElementById("tablelive").innerHTML = html;
                        }
                    });
            });
        </script>
    </body>
</html>