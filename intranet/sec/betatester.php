<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['beta_enviar'])) {

        $b_nombre = $_POST["beta_name"];
        $b_seleccion = $_POST["beta_seccion"];
        $b_mensaje = $_POST["beta_mensaje"];

        $enviar = guardarBeta($b_nombre, $b_seleccion, $b_mensaje);
        if($enviar == "true"){
            $mensaje="Hola";
        } else if($enviar == "false"){
            echo "no envio";
        }
    }
}

function estadoBeta($usuario){

    include "../sec/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    /* CONSULTAR LISTADOS DE CLIENTES EN SALÓN */
    $sql = "SELECT `usuario` FROM intranet_betatester WHERE `usuario` = '$usuario'";
    $result = array();
    $i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {

        	$result =   "<h1 class='wow fadeInLeft' style='float: right;margin:0px;'>
                            <button type='button' class='btn btn-primary' style='margin-top: 0px;' data-toggle='modal' data-target='#betatester' data-id='$usuario'><i class='pe-7s-star'></i> ¡Soy Beta Tester!</button>
                        </h1>";
        }
    } else {
        $result = "";
        
    }
    return $result;

}

function guardarBeta($usuario, $seccion, $mensaje){
    include "libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $final="false";

    /* CONSULTAR LISTADOS DE CLIENTES EN SALÓN */
    $sql = "INSERT INTO intranet_betatester_comment (usuario, seccion, comentarios) VALUES ('$usuario', '$seccion', '$mensaje')";
    if (mysqli_query($dbh, $sql)) {
        $final = "true";
        return $final;
    }
    return $final;
}


function modalBetaTester(){ ?>

        <!-- COMIENZO DE MODAL: BETA TESTER  -->
        <div id="betatester" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Envíanos tus mensajes, sugerencias o reportes de errores:</b></h4>
                    </div>
                    <div class="modal-body">
                        <form action="index.php" id="beta_form" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-sm-9" for="filtroventa">Envíanos tus comentarios para ayudarnos a mejorar.</label>
                                <br><br><div class="col-sm-12">
                                    <div class="list-group">
                                        <span class="list-group-item"><strong>Nombre:</strong> <span id="beta_nombre"></span></span>
                                        <span class="list-group-item"><strong>Sección:</strong> <select class="form-control" name="beta_seccion" required>
                                        <option>Selecciona una opción..</option><option value="LIVE">Salvador+ Live</option><option value="CRM-APPS">CRM - Apps</option><option value="CRM-CC">CRM - Client Card</option><option value="CRM-CONVENIOS">CRM - Convenios</option><option value="DESCARGAS">Descargas</option><option value="MINUTAS-REGION">Minutas - Region</option><option value="MINUTAS-SALON">Minutas - Salón</option><option value="MINUTAS-COMITE">Minutas - Comité</option><option value="IDIOMA">Ajustes - Idioma</option><option value="OTRO">Otro</option>
                                        </select></span>
                                        <span class="list-group-item"><strong>Mensaje:</strong> <textarea class="form-control" name="beta_mensaje" cols="8" rows="auto" required></textarea></span>
                                    </div>
                                    <input type="submit" class="btn-primary form-control input-lg" name="beta_enviar" value="Enviar Comentarios">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="pe-7s-close"></i></button>
                    </div>
                </div>

            </div>
        </div>
        <!-- FIN DE MODAL: BETATESTER -->
        
<?php return; }

?>