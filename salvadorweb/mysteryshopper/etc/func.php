<?php
function consultaPartEstado($iduser){
    require_once "../../sitio/sec/ms/libcon.php";
    $estados = array(0 => "Verificación Pendiente", 1 => "Aprobada", 2 => "No aprobada");
    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }    
    $sql = "SELECT status FROM ms_usuario WHERE id = $iduser";
    $search = mysqli_query($dbh, $sql);
    $match1 = mysqli_num_rows($search);
    if ($match1 > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $estado = $rw['status'];
            echo "<b>".$estados[$estado]."</b>";
        }
        } else {
        $estado = "<b>No Disponible</b>";
        echo $estado;
    }
}

function listarEncuestas($iduser){
    require_once "../../sitio/sec/ms/libcon.php";    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }    
    // CONSULTO LISTA DE ENCUESTAS ACTIVAS DEL GRUPO 1
    $sql = "SELECT id, descripcion from ms_encuesta WHERE estado = 1 and grupo < 20";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $id = $rw['id'];
            $desc = $rw['descripcion'];
            
            // CONSULTO SI ENCUESTA HA SIDO RESPONDIDA O NO
            $sql2 = "SELECT id_encuesta from `ms_encuesta_respuestas` WHERE id_usuario = $iduser AND id_encuesta = $id";
            $search2 = mysqli_query($dbh, $sql2);
            $match2 = mysqli_num_rows($search2);
            if ($match2 > 0) {
                if(isset($_GET['i'])){
                    $info = base64_decode($_GET['i']);
                    echo "$desc - <i><a href='#'>Ver Respuestas</a></i><br>";
                } else {
                    echo "<strong><i>$desc</i></strong> - <i>Encuesta Respondida</i><br>";
                }
                } else {
                    echo "<strong><i>$desc</i></strong> - <a href='encuesta.php?t=$id'>¡Click Aquí!</a><br>";
            }
        }
    } else {
        echo "No hay encuestas disponibles en este momento.";
    }
}

function listarPostEncuestas($iduser, $fecha, $idvisita, $tipo){
    $_SESSION["fecha_visita"] = $fecha;
    $_SESSION["id_visita"] = $idvisita;
    require_once "../../sitio/sec/ms/libcon.php";    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    if($tipo == 1){
    echo "<br><h4 style='padding: 15px;'>Encuestas Post-Visitas:</h4>
    <h6>Puedes consultar las encuestas, más sólo podrán ser respondidas a partir del día de tu visita.</h6>";} else
    if($tipo == 2){
    echo "<br><br><h4>Encuestas Post-Visitas:</h4>";  
    }
    
    // CONSULTO LISTA DE ENCUESTAS POST-VISITAS ACTIVAS (GRUPO 20)
    $fechaactual = date("Y-m-d");
    $sql = "SELECT id, descripcion from ms_encuesta WHERE estado = 1 and grupo >= 20";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    echo "<ul class='list-group'>";
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $id = $rw['id'];
            $desc = $rw['descripcion'];
            
            // CONSULTO SI ENCUESTA HA SIDO RESPONDIDA O NO
            $sql2 = "SELECT id_encuesta, id_encuesta_respuestas from `ms_encuesta_respuestas` WHERE id_usuario = $iduser AND id_encuesta = $id and id_visita = $idvisita";
            $search2 = mysqli_query($dbh, $sql2);
            $match2 = mysqli_num_rows($search2);
            if ($match2 > 0) {
                $rw2 = mysqli_fetch_array($search2);
                $idrespuesta = $rw2['id_encuesta_respuestas'];
                if($tipo == 1){
                    echo "<li class='list-group-item'>$desc <span class='badge'><i>Encuesta Respondida</i></span></li>";} else
                if($tipo == 2){
                    echo "<li class='list-group-item'>$desc <span class='badge'><a href='reporteEncuesta.php?c=".base64_encode($idrespuesta)."&u=".base64_encode($iduser)."'>Ver Respuestas</a></span></li>";}
                } else {
                    if($tipo == 1){
                    echo "<li class='list-group-item'>$desc <span class='badge'><a href='encuesta.php?pv=".base64_encode($id)."'>Responder</a></span></li>";} else
                    if($tipo == 2){
                    echo "<li class='list-group-item'>$desc <span class='badge'><i>Encuesta No Respondida</i></span></li>";}
                    }
            }
    } else {
        echo "<br>No hay encuestas disponibles en este momento.";
    }
    echo "</ul>";
}

function inputPostVisita($iduser, $idpv){
    require_once "../../sitio/sec/ms/libcon.php";    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $fecha = $_SESSION["fecha_visita"];
    $idvisita = $_SESSION["id_visita"];
    
    $i=9;
    $sql = "SELECT * FROM ms_encuesta A INNER JOIN ms_encuesta_contenido B ON A.id = B.id_encuesta WHERE A.id = $idpv LIMIT 1";
    $search = mysqli_query($dbh, $sql);
    $match1 = mysqli_num_rows($search);
    if ($match1 > 0) {
        $rw = mysqli_fetch_array($search);
        $idpv = $rw['id'];
        echo "<h4>Encuesta ".$rw['descripcion']."</h4>";
        echo"<br><br><form name='encuestapv' method='post'><table class='table'>
    <thead><tr>
        <input type='hidden' name='idpv' value='$idpv'>
        <input type='hidden' name='idvisita' value='$idvisita'>
        <th class='col-sm-6'>Pregunta</th>
        <th class='col-sm-1'>Opciones</th>
        <th class='col-sm-3'>Observaciones<br>(Favor sea lo más conciso posible):</th>
      </tr></thead><tbody>";
        while ($rw[$i-1] != "") {
            $id_num = $i - 8;
            echo"<tr><td class='danger text-justify'><h6>".$rw[$i-1]."</h6></td>
                
          <td><label class='radio-inline'><input type='radio' name='P$id_num' value='1' required>Si</label><label class='radio-inline'><input type='radio' name='P$id_num' value='2'>No</label></td>
          <td><div class='form-group'><textarea class='form-control' rows='1' id='comment' resize='no' name='C$id_num' required></textarea><span id='coments'></span></div></td></tr>";
          $i++;
        } //echo "</tbody></table>";
            $fechaactual = date("Y-m-d");
            if($fecha <= $fechaactual){
                echo "</tbody></table><input type='submit' class='btn-default' id='botonuno' name='enviarPV' value='Enviar Respuestas'></input>";

            } else{
                echo "<thead><tr><th class='col-sm-6'><h6>Podrás enviar tus respuestas el día programado para la Visita.</h6></th>
                    <th class='col-sm-1'></th><th class='col-sm-3'></th></tr></thead></tbody></table>";
            }
          echo "</form>";   
    }
}


function reportePostVisita($idencuestarespuesta, $idusuario){
    require_once "../../sitio/sec/ms/libcon.php";    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    $i=2;$j=4;$k=14;$si=0;$no=0;
    //$sql1 = "SELECT * FROM ms_encuesta A INNER JOIN ms_encuesta_contenido B ON A.id = B.id_encuesta WHERE A.id = $idencuesta LIMIT 1";
    //$sql2 = "";
    $sql = "SELECT * FROM `ms_encuesta_respuestas` WHERE id_encuesta_respuestas = $idencuestarespuesta";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        $rw = mysqli_fetch_array($search);
        $idencuesta = $rw['id_encuesta'];
        $sql2 = "SELECT descripcion FROM `ms_encuesta` WHERE id = $idencuesta";
        $search2 = mysqli_query($dbh, $sql2);
        $match2 = mysqli_num_rows($search2);
        if ($match2 > 0) {
            $rw2 = mysqli_fetch_array($search2);
            $descripcion = $rw2['descripcion'];
            $sql3 = "SELECT * FROM `ms_encuesta_contenido` WHERE id_encuesta = $idencuesta";
            $search3 = mysqli_query($dbh, $sql3);
            $match3 = mysqli_num_rows($search3);
            if ($match3 > 0) {
                $rw3 = mysqli_fetch_array($search3);
                echo "<h4>Respuestas sobre ".$descripcion."</h4><br>";
                 echo "<ul class='list-group'>";
                 while ($rw3[$i] != "") {
                    $id_num = $i - 1;
                    echo "<li class='list-group-item'><span class='badge'>PREGUNTA #$id_num</span> <h6>".$rw3[$i]."</h6></li>";
                    if($rw[$j] == 1){$clase = "success";$si++;} else if($rw[$j] == 2){$clase = "danger";$no++;}
                    if ($clase == "success") {
                        
                    echo "<li class='list-group-item list-group-item-$clase'><strong>Comentario:</strong><span style='float:right;'>R=SI</span> " .$rw[$k]."</li>";

                    }else if ($clase == "danger"){

                       echo "<li class='list-group-item list-group-item-$clase'><strong>Comentario:</strong><span style='float:right;'>R=NO</span> " .$rw[$k]."</li>"; 
                    }


                    //echo "Otro: ".$rw[$j];
                    $i++;
                    $j++;$k++;
                }echo "</ul><ul class='list-group' style='width:30%;float:left;'>
                    <li class='list-group-item'><strong><i>Leyendas:</i></strong></li>
                    <li class='list-group-item list-group-item-success'>Afirmativo</li>
                    <li class='list-group-item list-group-item-danger'>Rechazo</li>
                    </ul>";
                $subtotal = 10 / ($si + $no);
                $total = ($si) * 10 * $subtotal;
                $estado = "";
                if($total <= 50){
                    $estado = "GRAVE";
                } else if($total > 50 && $total < 75){
                    $estado = "NO SATISFACTORIO";
                } else if ($total >= 75 && $total <= 90){
                    $estado = "SATISFACTORIO";
                } else if($total > 90){
                    $estado = "EXCELENTE";
                }
                
                $si = round($si * 10 * $subtotal) . "%";
                $no = round($no * 10 * $subtotal) . "%";
                echo "<ul class='list-group' style='width:65%;float:right;'>
                        <li class='list-group-item'><strong><i>Resultados:</i></strong></li>
                        <li class='list-group-item'>Resultado: $estado<br> 
                        <div class='progress'>
                          <div class='progress-bar progress-bar-success' role='progressbar' style='width:$si'>
                            Si ($si)
                          </div>
                          <div class='progress-bar progress-bar-danger' role='progressbar' style='width:$no'>
                            No ($no)
                          </div>
                        </div></li>
                        </ul><br>";
            }
        }
    }
}

function listarVisitas($iduser){
    require_once "../../sitio/sec/ms/libcon.php";    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }    
    $dbh->options(MYSQLI_OPT_CONNECT_TIMEOUT, 500);
    $sql = "SELECT B.id, B.visita_descripcion, B.visita_fecha FROM `ms_usuario` A INNER JOIN `ms_usuario_visitas` B ON A.id = B.id_usuario WHERE  `id_usuario` = $iduser";
    //$sql = "SELECT id, descripcion FROM ms_encuesta WHERE estado = 1";
    $search = mysqli_query($dbh, $sql);
    $match1 = mysqli_num_rows($search);
    if ($match1 > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $id = base64_encode($rw['id']);
            $desc = $rw['visita_descripcion'];
            $fecha = $rw['visita_fecha'];
            echo "Visita: $desc | Fecha: $fecha - <a href='visita.php?t=$id'>Consultar</a><br>";
        }
    } else {
        echo "No hay visitas programadas en este momento.<br>";
    }
}

function listarVisitaCompleta($id, $user, $tipo){
    require_once "../../sitio/sec/ms/libcon.php";
    $asistencia = array(0 => "Programada", 1 => "Encuestas Respondidas", 2 => "Visita Finalizada", 3 => "No Asistió");
    $salones = array();$salonesph = array();$salonesdir = array();$salonesconc = array();
    $idvisita = $id;
    $dbhcc = dbconn();
    mysqli_set_charset($dbhcc, 'utf8');
    if (!$dbhcc) {
        die('Error en Conexión: ' . mysqli_error($dbhcc));
        exit;
    }
    
    $sqlcc = "SELECT ID, CODIGO, NOMBRECOMPLETO, CONCEPTO, DIRECCION, TELEFONO1 from web_salones";
    $searchcc = mysqli_query($dbhcc, $sqlcc);
    $matchcc = mysqli_num_rows($searchcc);
    if ($matchcc > 0) {
        while ($rwcc = mysqli_fetch_array($searchcc)) {
            $salones[$rwcc['ID']] = $rwcc['NOMBRECOMPLETO'];
            $salonesph[$rwcc['ID']] = $rwcc['TELEFONO1'];
            $salonesconc[$rwcc['ID']] = $rwcc['CONCEPTO'];
            $salonesdir[$rwcc['ID']] = ucwords(strtolower($rwcc['DIRECCION']));
        }
    } else {
        echo "";
    }
    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $sql = "SELECT * FROM `ms_usuario_visitas` WHERE `id` = $id LIMIT 1";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $id = $rw['id'];
            $id_usuario = $rw['id_usuario'];
            $id_salon = $rw['id_salon'];
            $desc = $rw['visita_descripcion'];
            $fecha = $rw['visita_fecha'];
            $vis_obser = $rw['visita_observacion'];
            $servicios = $rw['visita_servicios'];
            $obs_pago = $rw['observacion_pago'];
            $vis_asist = $rw['visita_asistencia'];
            
            if($user == $id_usuario){
                //print_r($salones());
            if($tipo == 1){echo "<h4>MS#00$id</h4>";}
            if($tipo == 1){echo "<br><div class='form-group'><label class='control-label col-sm-5'>Fecha Programada:</label><div class='col-sm-5'><input type='text' class='form-control' name='fecha' value='$fecha' readonly></div></div>";} 
            else if($tipo == 2){ // fecha visita
                        echo "<br><div class='form-group'><label class='control-label col-sm-5'>Fecha Programada: <a href='#newfechams' onclick='edVisitaMS($id);'><img src='/mysteryshopper/images/edit-icon-mini.png'></a></label><div class='col-sm-5'><input type='text' class='form-control' name='fecha' value='$fecha' readonly></div></div><span id='newfechams'></span><input type='hidden' name='hiddate' id='hiddate'>";
                    }
                echo "<br><div class='form-group'><label class='control-label col-sm-5'>Descripción:</label><div class='col-sm-5'><input type='text' class='form-control' name='desc' value='$desc' readonly></div></div>";
                if($tipo == 1){ echo "<br><div class='form-group'><label class='control-label col-sm-5'>Salón Asignado: <a href='#' data-toggle='popover' data-placement='bottom' data-trigger='focus' title='Teléfono: $salonesph[$id_salon]' data-content='Dirección: $salonesdir[$id_salon]'><img src='/mysteryshopper/images/search_mini.png'></a></label><div class='col-sm-5'><input type='text' class='form-control' name='id_salon' value='$salones[$id_salon]' readonly></div></div>";}
                else if($tipo == 2){ // salon
                    echo "<br><div class='form-group'><label class='control-label col-sm-5'>Salón Asignado: <a href='#' data-toggle='popover' data-placement='bottom' data-trigger='focus' title='Teléfono: $salonesph[$id_salon]' data-content='Dirección: $salonesdir[$id_salon]'><img src='/mysteryshopper/images/search_mini.png'></a> <a href='#newsalonms' onclick='editarMS($id, 3);'><img src='/mysteryshopper/images/edit-icon-mini.png'></a></label><div class='col-sm-5'><input type='text' class='form-control' name='id_salon' value='$salones[$id_salon]' readonly></div></div><span id='newsalonms'></span><input type='hidden' name='hidsalon' id='hidsalon'>";
                }
            if($tipo == 1){
                echo "<br><div class='form-group'><label class='control-label col-sm-5'>Instrucciones:</label><div class='col-sm-5'><input type='text' class='form-control' name='vis_obser' value='$vis_obser' readonly></div></div>
                    <br><div class='form-group'><label class='control-label col-sm-5'>Servicios a pedir:</label><div class='col-sm-5'><input type='text' class='form-control' name='servicios' value='$servicios' readonly></div></div>";
            } else if($tipo == 2){
                echo "<br><div class='form-group'><label class='control-label col-sm-5'>Instrucciones: <a href='#newinstrms' onclick='editarMS($id, 1);'><img src='/mysteryshopper/images/edit-icon-mini.png'></a></label><div class='col-sm-5'><textarea class='form-control' rows='3' id='vis_obser' name='vis_obser' readonly>$vis_obser</textarea></div></div><br><br><span id='newinstrms'></span><input type='hidden' name='hiddins' id='hiddins'>";

                echo "<br><div class='form-group'><label class='control-label col-sm-5'>Servicios a pedir: <a href='#newservms' onclick='editarMS($id, 2);'><img src='/mysteryshopper/images/edit-icon-mini.png'></a></label><div class='col-sm-5'><input type='text' class='form-control' name='servicios' value='$servicios' readonly></div></div><span id='newservms'></span><input type='hidden' name='hiddserv' id='hiddserv'>";
            }
                echo "<br><h4>Información Financiera:</h4>
                    <br><div class='form-group'><label class='control-label col-sm-5'>Observación sobre el Pago:</label><div class='col-sm-5'><textarea class='form-control' name='obs_pago' readonly style='min-height: 0px;padding:10px !important;height: 116px;'>$obs_pago</textarea></div></div>
                    <br><br><h4>Información de Asistencia:</h4>
                    <br><div class='form-group'><label class='control-label col-sm-5'>Estado:</label><div class='col-sm-5'><input type='text' class='form-control' name='asistencia' value='$asistencia[$vis_asist]' readonly></div></div>";
                    listarPostEncuestas($user, $fecha, $idvisita, $tipo);
            
            } else{
                echo "<br><br>Acceso Denegado.";
            }
        }
    } else {
        echo "<br><br>No hay visitas programadas en este momento.";
    }
}

function inputLocal($correo){
    require_once "../../sitio/sec/ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }    
    $sql = "SELECT docfiscal, nombre, apellido, pais FROM ms_usuario WHERE correo = '$correo'";
    $search = mysqli_query($dbh, $sql);
    $match1 = mysqli_num_rows($search);
    if ($match1 > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $docfiscal = $rw['docfiscal'];
            $nombre = $rw['nombre'];
            $apellido = $rw['apellido'];
            $pais = $rw['pais'];
            echo "<br><div class='form-group'><label class='control-label col-sm-5' for='nombre'>Nombre:</label><div class='col-sm-5'><input type='text' class='form-control' id='nombre' name='nombre' required value='$nombre' /></div></div>
                <br><div class='form-group'><label class='control-label col-sm-5' for='apellido'>Apellido:</label><div class='col-sm-5'><input type='text' class='form-control' id='apellido' name='apellido' required value='$apellido' /></div></div>
                <br><div class='form-group'><label class='control-label col-sm-5' for='id'>N° de Identificación:</label><div class='col-sm-5'><input type='text' class='form-control' id='id' name='id' required value='$docfiscal' /></div></div>";
            return;
            }
        } else {
        $estado = "";
        echo "<div class='form-group'><label class='control-label col-sm-7' for='estado'>$estado</label></div>";
        return;
    }    
}

function procesarEncuestaPart($usuario, $tipo){
    
    $nombre = $_SESSION["nombre"];
    $apellido = $_SESSION["apellido"];
    $id = $_SESSION["id"];
    $tipocta = $_SESSION["tipocta"];
    $banco = $_SESSION["banco"];
    $nrocta = $_SESSION["nrocta"];
    $swift = $_SESSION["swift"];
            
    require_once "../../sitio/sec/ms/libcon.php";

    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $sql = "INSERT INTO ms_encuesta_respuestas (id_encuesta, id_usuario, P1, P2, P3, P4, P5, P6, P7, P8, P9) 
            VALUES ($tipo, $usuario, '$nombre', '$apellido', '$id', '$tipocta', '$banco', '$nrocta', '$swift', '', '')";

    if (mysqli_query($dbh, $sql)) {
        require_once "correos.php";
        enviarRecordatorioProgr($usuario);
        header('location: /mysteryshopper/cuenta/index.php?e=2');
        
        exit;
    } else {
        die(mysqli_error($dbh));
        header('location: /mysteryshopper/cuenta/index.php?e=3');
        exit;
    }

}

function procesarPostEncuesta($usuario, $pvid){
    $P1 = $_SESSION["P1"];
    $P2 = $_SESSION["P2"];
    $P3 = $_SESSION["P3"];
    $P4 = $_SESSION["P4"];
    $P5 = $_SESSION["P5"];
    $P6 = $_SESSION["P6"];
    $P7 = $_SESSION["P7"];
    $P8 = $_SESSION["P8"];
    $P9 = $_SESSION["P9"];
    $P10 = $_SESSION["P10"];
    $C1 = $_SESSION["C1"];
    $C2 = $_SESSION["C2"];
    $C3 = $_SESSION["C3"];
    $C4 = $_SESSION["C4"];
    $C5 = $_SESSION["C5"];
    $C6 = $_SESSION["C6"];
    $C7 = $_SESSION["C7"];
    $C8 = $_SESSION["C8"];
    $C9 = $_SESSION["C9"];
    $C10 = $_SESSION["C10"]; 
    $bandera = 0;
    if(isset($_SESSION["fecha_visita"])){
        $fecha = $_SESSION["fecha_visita"];
        $idvisita = $_SESSION["id_visita"];
        $bandera = 1;
    }
    
    require_once "../../sitio/sec/ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $sql = "INSERT INTO ms_encuesta_respuestas (id_encuesta, id_usuario, id_visita, P1, P2, P3, P4, P5, P6, P7, P8, P9, P10, C1, C2, C3, C4, C5, C6, C7, C8, C9, C10) 
            VALUES ($pvid, $usuario, $idvisita, '$P1', '$P2', '$P3', '$P4', '$P5', '$P6', '$P7', '$P8', '$P9', '$P10', '$C1', '$C2', '$C3', '$C4', '$C5', '$C6', '$C7', '$C8', '$C9', '$C10')";
    if (mysqli_query($dbh, $sql)) {
        if($bandera == 1){
            //CONSULTO SI EL PARTICIPANTE HA RESPONDIDO LAS ENCUESTA, DE TAL MANERA QUE SOLO RECIBIRA UN CORREO SI RESPONDE LAS 4 ENCUESTA
            $sql_enc = "SELECT COUNT(*) FROM ms_encuesta_respuestas WHERE id_usuario = $usuario AND id_visita = $idvisita";
            $con_enc = mysqli_query($dbh,$sql_enc);
            $results = mysqli_num_rows($con_enc);
            while ($res = mysqli_fetch_array($con_enc)) {
                if ($res[0] == 4) {
                    require_once 'correos.php';    
                    enviarAvisoEncueRespon($usuario);
                }    
            }         
            header('location: /mysteryshopper/cuenta/visita.php?t='.base64_encode($idvisita).'&e=5');
            exit;
        } else if ($bandera == 0){
            header('location: /mysteryshopper/cuenta/index.php?e=5');
            exit;
        }
    } else {
        die(mysqli_error($dbh));
        header('location: /mysteryshopper/cuenta/index.php?e=6');
        exit;
    }        
}


function procesarReferidos(){
    //require_once "../../sitio/sec/ms/libcon.php";    
    require_once "../../mysteryshopper/etc/correos.php";
    
    if(isset($_POST['referir'])){
        if(isset($_POST['totalMails'])){
            $cantidad = $_POST['totalMails'];
            $i=0;$j=1;
        } else {
            $cantidad = 1;
            $i=0;$j=1;
        }
        
        $recipientes = array();
        while($i != $cantidad){
            $valor = $_POST["emails$j"];
            $recipientes[] = $valor;
            $i++;$j++;
        }
        
        $email_to = implode(',', $recipientes); // your email address
        //$email_subject = "Contact Form Message"; // email subject line
        //$thankyou = "thankyou.htm"; // thank you page

        $sendMI = enviarInvitaciones($email_to);
        if($sendMI == "1"){
            $valor = "TRUE";
            return $valor;
        } else if($sendMI == "0"){
            $valor = "FALSE";
            return $valor."".$sendMI."".$email_to;
        }
        
    }
}

function cargaListSalon(){
    require_once "../../sitio/sec/ms/libcon.php";    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    
    $sql = "SELECT ID, CODIGO from web_salones where ESTADO != 3 ORDER BY CODIGO ASC";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    echo "<div class='col-sm-6'><select onchange='showbuttonMS();' class='form-control' id='salones' name='salon_new' required>";
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            echo "<option value='".$rw['ID']."'>".$rw['CODIGO']."</option>";
        }
    } else {
        echo "<option value=''>No disponible</option>";
    }
    echo "</select></div><br>";
    return;
}


?>
