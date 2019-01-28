<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$nomusu="";
$perusu = "50";
if (isset($_SESSION["codigo"])) {
    $usuario = $_SESSION["codigo"];
    $nomusu = $_SESSION["usuario"];
    $perusu = $_SESSION["permiso"];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['postcategoria'])) {
        include ("../../s/nk5w7835.php");
            $tipo = $_POST["tipo"];;
            if($tipo == '2a'){
                $categoria = $_POST["categoria"];
                $depart = $_POST["padre"];
                $usu = $_POST["usuario"];
                addCategoria($categoria, $depart, $usu, $tipo);
                } else if($tipo == '2b'){
                    $id = $_POST["idCategoria"];
                    $nnombre = $_POST["titulonuevo"];
                    $usuario = $_POST["usuario"];
                    modCategoria($id, $nnombre, $usuario, $tipo);
                } else if($tipo == '2c'){
                    $usuario = $_POST["usuario"];
                    $categoriaelegida = $_POST["categoria"];
                    $tipo = $_POST["tipo"];
                    ocultarCategoria($categoriaelegida, $usuario, $tipo);
                }
            } else if(isset($_POST['postcategoria2'])) {
                include ("../../s/nk5w7835.php");
                $usuario = $_POST["usuario"];
                $categoriaelegida = $_POST["categoria"];
                desocultarCategoria($categoriaelegida, $usuario, $tipo);
            }
        }
$alerta = "";
if (isset($_GET['est'])) {
    // id index exists
    $alerta = $_GET['est'];
}
$clase = "";
error_reporting(1);
?>
<html xmlns="http://www.w3.org/1999/xhtml"  class="no-js">
    <head>        
                <?php include "../../componentes/header.php"; ?>

        <script src="/intranet/descargas/componentes/js/funciones.js"></script>
    </head>
    <body>
        <div class="menuMain">
            <div class="contenedorIngreso">
                <?php
                if ($alerta == 1) {
                    echo "<div class='alertaNoExiste' style='background:green;'>Categoría añadida éxitosamente.</div><br>";
                } else if ($alerta == 2) {
                    echo "<div class='alertaNoExiste' style='background:green;'>Categoría modificada éxitosamente.</div><br>";
                } else if($alerta == 3){
                    echo "<div class='alertaNoExiste' style='background:green;'>Categoría ocultada éxitosamente.</div><br>";
                } else if($alerta == 4){
                    echo "<div class='alertaNoExiste' style='background:lightsalmon;'>Ocurrió un error durante la última operación :(  - Intenta de nuevo.</div><br>";
                } else if($alerta == 5){
                    echo "<div class='alertaNoExiste' style='background:lightgreen;color: black;'>Categoría desocultada éxitosamente.</div><br>";
                } 
                ?>
                <div class="textoIngreso">
                    <h2>ACTUALIZAR CATEGORÍAS</h2>
                    <br><p id="landingText1" style="width: 50%;">En esta sección encontrarás todas las opciones necesarias, para el manejo de las categorías creadas en <b>SALVADOR DESCARGAS</b>.
                    <br><br><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addreg">Crear Categoría</button>   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modreg">Modificar Categoría</button>   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#elimreg">Ocultar Categoría</button><br><br></p>
                            <!-- COMIENZO DE MODAL: ADD  -->
                            <div id="addreg" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><b>AÑADIR NUEVA CATEGORÍA</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Añadir Nueva Categoría en el Departamento Correspondiente:</p><br>
                                            <form action="" id="formcat" method="post" class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="padre">Departamento:</label>
                                                    <div class="col-sm-6">
                                                    <select name="padre" class="form-control" tabindex="4" onchange="" required>
                                                        <option value="">-Selecciona una Opción-</option>
                                                        <?php require_once '../../s/nk5w7835.php';
                                                        listarSelectDepartamentos('1b')?>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="titulo">Nombre:</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="categoria" placeholder="Ingrese el nombre de la categoría" name="categoria" required value="" />
                                                    </div>
                                                </div>
                                                <input type="hidden" name="tipo" value="2a" />
                                                <?php if(isset($usuario)){echo "<input type='hidden' name='usuario' value='$usuario' />";} ?>
                                                <div class="form-group"> 
                                                    <div class="col-sm-offset-4 col-sm-6">
                                                      <button type="submit" class="botones" name="postcategoria">Crear</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- FIN DE MODAL: ADD -->

                            <!-- COMIENZO DE MODAL: MOD  -->
                            <div id="modreg" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><b>MODIFICAR CATEGORÍA EXISTENTE</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Modificar categorías ya creadas:</p><br>
                                            <form action="" id="formdep" method="post" class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="padre">Departamento:</label>
                                                    <div class="col-sm-6">
                                                    <select name="padre" class="form-control" tabindex="4" onchange="showLoad(this.value, '2b');" required>
                                                        <option value="">-Selecciona una Opción-</option>
                                                        <?php require_once '../../s/nk5w7835.php';
                                                        listarSelectDepartamentos('2b')?>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group"><div id="txtHint" class='txt'></div></div>
                                                <div class="form-group"><div id="txtHint2" class='txt'></div></div>
                                                
                                                <input type="hidden" name="tipo" value="2b" />
                                                <?php if(isset($usuario)){echo "<input type='hidden' name='usuario' value='$usuario' />";} ?>
                                                <div class="form-group"> 
                                                    <div class="col-sm-offset-4 col-sm-6">
                                                      <button type="submit" class="botones" name="postcategoria">Modificar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- FIN DE MODAL: MOD -->
                            
                            <!-- COMIENZO DE MODAL: OCULTAR  -->
                            <div id="elimreg" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                  <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><b>OCULTAR CATEGORÍAS</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Deshabilita permanente o temporalmente algunas categorías.</p>
                                            <form action="" method="POST" style="text-align: left;">
                                            <input type="hidden" name="tipo" value="2c" />
                                            <ol id='lista3'>
                                                <?php require_once '../../s/nk5w7835.php';
                                                listarSelectDepartamentos('2c'); ?>
                                                <?php if(isset($usuario)){echo "<input type='hidden' name='usuario' value='$usuario' />";} ?>
                                                <div class="form-group"> 
                                                    <div class="col-sm-offset-2 col-sm-4">
                                                      <button type="submit" class="botones" name="postcategoria2">Mostrar</button>
                                                    </div>
                                                    <div class="col-sm-offset-1  col-sm-4">
                                                      <button type="submit" class="botones" name="postcategoria">Ocultar</button>
                                                    </div>
                                                    
                                                </div>
                                            </ol>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>

                                </div> 
                            </div>
                            <!-- FIN DE MODAL: ELIM -->
                </div>
            </div>
            </div>
    </body>
</html>