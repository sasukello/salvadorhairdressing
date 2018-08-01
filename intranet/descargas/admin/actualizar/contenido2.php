<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$nomusu="";
$perusu = "50";
if (isset($_SESSION["codigo"])) {
    $usuario = $_SESSION["codigo"];
    $nomusu = $_SESSION["usuario"];
    $perusu = $_SESSION["permiso"] = '50';
}
$alerta = "";
if (isset($_GET['est'])) {
    // id index exists
    $alerta = $_GET['est'];
}
$clase = "";
?>
<html xmlns="http://www.w3.org/1999/xhtml"  class="no-js">
    <head>        
        <title>Salvador Peluquerías - Área de Descargas: Administrador</title>
        <script src="/descargas/componentes/js/funciones.js"></script>
    </head>
    <body>
        <?php
            include '../../componentes/header.php';
        ?>
        <?php include_once("../../s/analyticstracking.php"); ?>
        <div class="menuMain">
            <div class="contenedorIngreso">
                <?php
                if ($alerta == 1) {
                    echo "<div class='alertaNoExiste'>Contenido añadido éxitosamente.</div><br>";
                } else if ($alerta == 2) {
                    echo "<div class='alertaNoExiste'>Contenido modificado éxitosamente.</div><br>";
                } else if($alerta == 3){
                    echo "<div class='alertaNoExiste'>Contenido eliminado éxitosamente.</div><br>";
                } else if($alerta == 4){
                    echo "<div class='alertaNoExiste'>Ocurrió un error durante la última operación :(  - Intenta de nuevo.</div><br>";
                } else if($alerta == 5){
                    echo "<div class='alertaNoExiste'>Lo sentimos, este formato de archivo no está permitido.</div><br>";
                } else if($alerta == 6){
                    echo "<div class='alertaNoExiste'>Este archivo no es una imágen.</div><br>";
                } else if($alerta == 7){
                    echo "<div class='alertaNoExiste'>Uno de los archivos a subir ya se encuentra en el servidor.</div><br>";
                } else if($alerta == 8){
                    echo "<div class='alertaNoExiste'>Lo sentimos, tu archivo supera el límite de tamaño permitido.</div><br>";
                } else if($alerta == 8){
                    echo "<div class='alertaNoExiste'>Al parecer no se subieron todos los archivos, intenta de nuevo.</div><br>";
                } else if($alerta == 9){
                    echo "<div class='alertaNoExiste'>Hubo un error con la conexión a la Base de Datos.</div><br>";
                }
                ?>
                <div class="textoIngreso">
                    <h2>ACTUALIZAR CONTENIDOS</h2>
                    <br><p id="landingText1" style="width: 50%;">En esta sección encontrarás todas las opciones necesarias, para el manejo de los archivos que se encuentran en el servidor de <b>SALVADOR DESCARGAS</b>.
                    <br><br><br><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addreg">Añadir Contenido</button>  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#modreg">Modificar Contenido</button>  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#elimreg">Eliminar Contenido</button> !--> <br><br></p>
                    <br><br><a href='../actualizar' class='botones'>Página Anterior</a>
                
                            <!-- COMIENZO DE MODAL: ADD  -->
                            <div id="addreg" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><b>AÑADIR NUEVO CONTENIDO</b></h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Añadir nuevo archivo, imágen, documento y otros:</p><br>
                                                <form action="../../componentes/multiupload.php" id="formcont" method="post" class="form-horizontal" enctype="multipart/form-data">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="padre">Departamento:</label>
                                                    <div class="col-sm-6">
                                                    <select name="padre" class="form-control" tabindex="4" onchange="showLoad(this.value, '3a');" required>
                                                        <option value="">-Selecciona una Opción-</option>
                                                        <?php require_once '../../s/nk5w7835.php';
                                                        listarSelectDepartamentos('3a')?>
                                                    </select>
                                                    </div>
                                                </div>
                                                    
                                                    <div class="form-group"><div id="txtHint" class='txt'></div></div>
                                                    <div class="form-group"><div id="txtHint2" class='txt'></div></div>
                                                <input type="hidden" name="tipo" value="3a" />
                                                <?php if(isset($usuario)){echo "<input type='hidden' name='usuario' value='$usuario' />";} ?>
                                                <div class="form-group"> 
                                                    <div class="col-sm-offset-4 col-sm-6">
                                                      <button type="submit" class="botones" name="postcontenido">Subir Archivo</button>
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
                            
                            <!-- COMIENZO DE MODAL: ELIM  -->
                            <div id="elimreg" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">ELIMINAR CONTENIDO EN SERVIDOR</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>¡Advertencia! Una vez eliminado el archivo, este no podrá ser recuperado.</p><br>
                                            <form action="POST" id="formcont" method="post" class="form-horizontal">
                                                <div class="form-group">
                                                    <label class="control-label col-sm-4" for="padre">Departamento:</label>
                                                    <div class="col-sm-6">
                                                    <select name="padre" class="form-control" tabindex="4" onchange="showLoad(this.value, '3c');" required>
                                                        <option value="">-Selecciona una Opción-</option>
                                                        <?php require_once '../../s/nk5w7835.php';
                                                        listarSelectDepartamentos('3c')?>
                                                    </select>
                                                    </div>
                                                </div>
                                                    
                                                    <div class="form-group"><div id="txtHint" class='txt'></div></div>
                                                    <div class="form-group"><div id="txtHint2" class='txt'></div></div>
                                                <input type="hidden" name="tipo" value="3a" />
                                                <?php if(isset($usuario)){echo "<input type='hidden' name='usuario' value='$usuario' />";} ?>
                                                <div class="form-group"> 
                                                    <div class="col-sm-offset-4 col-sm-6">
                                                      <button type="submit" class="botones" name="postcontenido">Eliminar Archivo</button>
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
                            <!-- FIN DE MODAL: ELIM -->
                </div>
            </div><br></br>
                    <?php
                    include '../../componentes/footer.php';
                    ?>
            </div>
    </body>
</html>