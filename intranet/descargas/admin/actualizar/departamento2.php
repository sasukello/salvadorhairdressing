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
    if (isset($_POST['postregistro'])) {
        include ("../../s/nk5w7835.php");
            $tipo = $_POST["tipo"];;
            if($tipo == '1a'){
                $nombre = $_POST["titulo"];
                $descripcion = $_POST["descripcion"];
                $usu = $_POST["usuario"];
                addRegistro($nombre, $descripcion, $usu, $tipo);
                } else if($tipo == '1b'){
                    $nombre = $_POST["titulo"];
                    $url = $_POST["padre"];
                    $nnombre = $_POST["newuser"];
                    $ndescrip = $_POST["newdesc"];
                    $usuario = $_POST["usuario"];
                    modRegistro($nombre, $url, $nnombre, $ndescrip, $usuario, $tipo);
                } else if($tipo == '1c'){
                    $usuario = $_POST["usuario"];
                    $categoriaelegida = $_POST["categoria"];
                    $tipo = $_POST["tipo"];
                    ocultarRegistro($categoriaelegida, $usuario, $tipo);
                }
            }
        }
$alerta = "";
if (isset($_GET['est'])) {
    // id index exists
    $alerta = $_GET['est'];
}
$clase = "";
error_reporting(0);
?>
<html xmlns="http://www.w3.org/1999/xhtml"  class="no-js">
    <head>        
        <script src="/intranet/descargas/componentes/js/funciones.js"></script>
    </head>
    <body>
        <div class="menuMain">
            <div class="contenedorIngreso">
                <?php
                if ($alerta == 1) {
                    echo "<div class='alertaNoExiste'>Departamento añadido éxitosamente.</div><br>";
                } else if ($alerta == 2) {
                    echo "<div class='alertaNoExiste'>Departamento modificado éxitosamente.</div><br>";
                } else if($alerta == 3){
                    echo "<div class='alertaNoExiste'>Departamento ocultada éxitosamente.</div><br>";
                } else if($alerta == 4){
                    echo "<div class='alertaNoExiste'>Ocurrió un error durante la última operación :(  - Intenta de nuevo.</div><br>";
                }
                ?>
                <div class="textoIngreso">
                    <h2>ACTUALIZAR DEPARTAMENTOS</h2>
                    <br><p id="landingText1">En esta sección encontrarás todas las opciones necesarias, para el manejo de los Departamentos, dentro de <b>SALVADOR DESCARGAS</b>.
                    <br><br><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addreg">Añadir Registro</button>   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modreg">Modificar Registro</button>   <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#elimreg">Ocultar Registro</button><br><br></p>
                
                            <!-- COMIENZO DE MODAL: ADD REGISTRO  -->
                            <div id="addreg" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><b>AÑADIR REGISTRO</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Añadir nueva categoría o grupo de Departamento:</p><br>
                                            <form action="" id="formdep" method="post" class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="titulo">Nombre:</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" id="titulo" placeholder="Ingrese el nombre" name="titulo" required value="" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="descripcion">Descripción:</label>
                                                    <div class="col-sm-6"> 
                                                      <input type="text" class="form-control" id="descripcion" placeholder="Ingrese la descripción" name="descripcion" required>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="tipo" value="1a" />
                                                <?php if(isset($usuario)){echo "<input type='hidden' name='usuario' value='$usuario' />";} ?>
                                                <div class="form-group"> 
                                                    <div class="col-sm-offset-4 col-sm-6">
                                                      <button type="submit" class="botones" name="postregistro">Añadir</button>
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
                            <!-- FIN DE MODAL: ADD REGISTRO -->

                            <!-- COMIENZO DE MODAL: MOD REGISTRO  -->
                            <div id="modreg" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><b>MODIFICAR REGISTRO</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Modificar categoría o grupo de Departamento ya creado:</p><br>
                                            <form action="" id="formdep" method="post" class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="padre">Departamento:</label>
                                                    <div class="col-sm-6">
                                                    <select name="padre" class="form-control" tabindex="4" onchange="showLoad(this.value, '1c');" required>
                                                        <option value="">-Selecciona una Opción-</option>
                                                        <?php require_once '../../s/nk5w7835.php';
                                                        listarSelectDepartamentos('1b')?>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="form-group"><div id="txtHint" class='txt'></div></div>
                                                <div class="form-group"><div id="txtHint2" class='txt'></div></div>
                                                <input type="hidden" name="tipo" value="1b" />
                                                <?php if(isset($usuario)){echo "<input type='hidden' name='usuario' value='$usuario' />";} ?>
                                                <div class="form-group"> 
                                                    <div class="col-sm-offset-4 col-sm-6">
                                                      <button type="submit" class="botones" name="postregistro">Modificar</button>
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
                            <!-- FIN DE MODAL: MOD REGISTRO -->
                            
                            <!-- COMIENZO DE MODAL: ELIM REGISTRO  -->
                            <div id="elimreg" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><b>OCULTAR REGISTRO</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Ocultar Registros de las siguientes Categorías o Departamentos:</p>
                                            <form action="" method="POST">
                                            <input type="hidden" name="tipo" value="1c" />
                                            <ol id='lista3'>
                                                <?php require_once '../../s/nk5w7835.php';
                                                listarSelectDepartamentos('1c'); ?>
                                            <?php if(isset($usuario)){echo "<input type='hidden' name='usuario' value='$usuario' />";} ?>
                                                <div class="form-group"> 
                                                    <div class="col-sm-offset-4 col-sm-4">
                                                      <button type="submit" class="botones" name="postregistro">Ocultar</button>
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
                            <!-- FIN DE MODAL: ELIM REGISTRO -->
                </div>
            </div>
            </div>
    </body>
</html>