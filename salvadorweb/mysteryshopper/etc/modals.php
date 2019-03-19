<?php
function partPend(){
        require_once "../../sitio/sec/ms/libcon.php";    
        $dbh = dbconn();
        mysqli_set_charset($dbh, 'utf8');
        if (!$dbh) {
            die('Error en Conexión: ' . mysqli_error($dbh));
            exit;
        }
       
        // CONSULTO LISTA DE ENCUESTAS ACTIVAS DEL GRUPO 1
        $paises = array(
          "1" => "<img src='/images/flags/ve1.png' alt='Venezuela'></img>",
          "2" => "<img src='/images/flags/pty1.png'></img>",
          "3" => "<img src='/images/flags/usa1.png'></img>",
          "72" => "<img src='/images/flags/domrep1.png'></img>",
          "249" => "<img src='/images/flags/co1.png'></img>",
          "302" => "<img src='/images/flags/ec1.png'></img>",
          "304" => "<img src='/images/flags/cu1.png' alt='Curacao'></img>");
        
        $sql = "SELECT * from ms_usuario WHERE status = 0";
        $search = mysqli_query($dbh, $sql);
        $match = mysqli_num_rows($search);
        if ($match > 0) {
            echo "<div class='table-responsive' style='overflow-x:auto;'>
                    <table class='table table-hover table-condensed'><thead><tr>
                    <th>Aprobar</th>
                    <th>Participante</th>
                    <th>Correo</th>
                    <th>País</th>
                    <th>Localidad</th>
                    <th>Más datos</th>
                  </tr></thead><tbody id='myTable'>";
            while ($rw = mysqli_fetch_array($search)) {
                $id = $rw['id'];
                $nombre = ucwords($rw['nombre']);
                $apellido = ucwords($rw['apellido']);
                $correo = $rw['correo'];
                $pais = $rw['pais'];
                $estado = ucwords($rw['estado']);
                $ciudad = ucwords($rw['ciudad']);
                $docfiscal = $rw['docfiscal'];
                $direccion = $rw['direccion'];
                $nacimiento = $rw['nacimiento'];
                $telefono = $rw['telefono'];
                $fecha = $rw['fecha_registro'];
                $year = date('d-m-Y', strtotime($fecha));
                $edad= 0;
                
                if((date('F') - date('F', strtotime($nacimiento))) << 0){
                    $edad = date('Y') - date('Y', strtotime($nacimiento));
                    $edadf = $edad - 1;
                } else if((date('F') - date('F', strtotime($nacimiento))) == 0){
                    if((date('d') - date('d', strtotime($nacimiento))) >= 0){
                        $edad = date('Y') - date('Y', strtotime($nacimiento));
                        $edadf = $edad - 1;
                    } else if((date('d') - date('d', strtotime($nacimiento))) << 0){
                        $edad = date('Y') - date('Y', strtotime($nacimiento));
                        $edadf = $edad - 1;
                    }
                }
                
                $idsecret = base64_encode($id);$correosecret = base64_encode($correo);
                echo "<tr id='' class='principal'>";
                ?>
                <td><div class="btn-group">
                  <a class="supp" href=<?php echo 'partEstado.php?a='.$idsecret.'&re='.$correosecret;?> onclick="window.open(this.href,'targetWindow','toolbar=no,location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=560, top=50, left=250'); return false;"><button type="button" class="btn btn-sm" id='aprobarSi'>Aprobar</button></a>
                  <a class="suppDos" href=<?php echo 'partEstado.php?r='.$idsecret.'';?> onclick="window.open(this.href,'targetWindow','toolbar=no,location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=560, top=50, left=250'); return false;"><button type="button" class="btn btn-sm" id='aprobarNo'>Rechazar</button></a>
                </div>
                </td>
                <style>
                    .tooltip21 {position: relative;display: inline-block;}
                    .tooltip21 .tooltiptext {visibility: hidden;width: 120px;background-color: #d34a4a;
                        color: #fff;text-align: center;border-radius: 6px;
                        font-size: 10px !important;position: absolute;z-index: 1;top: 100%;
                        left: 50%;margin-left: -60px;}
                    .tooltip21:hover .tooltiptext {visibility: visible;}
                </style>
                <?php
                echo "<td><a href='#' data-toggle='tooltip' data-placement='top' title='Registrado el $year'>$nombre $apellido</a></td>
                        <td>$correo</td>
                        <td>$paises[$pais]</td>
                        <td>$ciudad, $estado</td>
                        <td><div class='tooltip21'><a href='#'>Mas</a><span class='tooltiptext'>Edad: $edadf - Direccion: $direccion</span></div>
                        </td></tr>";
            }
                echo "</tbody></table></div>";
            } else {
            echo "No hay solicitudes pendientes en este momento.";
        }
    } 
function partAct($tipo,$id){
    require_once "../../sitio/sec/ms/libcon.php";    
        $dbh = dbconn();
        mysqli_set_charset($dbh, 'utf8');
        if (!$dbh) {
            die('Error en Conexión: ' . mysqli_error($dbh));
            exit;
        }    
        $paises = array(
          "1" => "<img src='/images/flags/ve1.png' alt='Venezuela'></img>",
          "2" => "<img src='/images/flags/pty1.png'></img>",
          "3" => "<img src='/images/flags/usa1.png'></img>",
          "72" => "<img src='/images/flags/domrep1.png'></img>",
          "249" => "<img src='/images/flags/co1.png'></img>",
          "302" => "<img src='/images/flags/ec1.png'></img>",
          "304" => "<img src='/images/flags/cu1.png' alt='Curacao'></img>");
        
        // CONSULTO LISTA DE ENCUESTAS ACTIVAS DEL GRUPO 1
        $sql = "";
        $numero=1;
        if ($tipo == 1){
        $sql = "SELECT * from ms_usuario WHERE status = 1 ORDER BY pais ASC"; $numero=8;} else 
            if ($tipo == 2 || $tipo == 4){
            $sql = "SELECT * from ms_usuario WHERE status = 1 AND id = $id LIMIT 1"; 
            $numero = 8;
        } else if ($tipo == 3){
            $sql = "SELECT * FROM ms_usuario A INNER JOIN `ms_usuario_visitas` B on A.id = B.id_usuario";
            $numero = 7;
        }
        $search = mysqli_query($dbh, $sql);
        $match = mysqli_num_rows($search);
        if ($match > 0) {
            echo "<div class='table-responsive' style='overflow-x:auto;'>
                        <table class='table table-hover table-condensed'>
                            <thead>
                                  <tr>";
                                  if($tipo == 1){
                                        echo "<th>Estado</th>";
                                    }
                                    echo "<th>Nombre</th>";
                                    if($tipo == 1){
                                        echo "<th>Edad</th>";
                                    }
                                    if($tipo == 2 || $tipo == 4){ echo "
                                    <th>Correo</th>";}
                                    echo "<th>País</th>
                                    <th>Localidad</th>";
                                    if($tipo == 2 || $tipo == 4){ echo "
                                    <th>Fecha de Registro</th>";}
                                    if($tipo == 1){ echo "
                                    <th>Consultar</th>"; }
                                  echo "</tr>
                                </thead>
                                <tbody>";
            while ($rw = mysqli_fetch_array($search)) {
                $id = $rw['id'];
                $nombre = ucwords($rw['nombre']);
                $apellido = ucwords($rw['apellido']);
                $correo = $rw['correo'];
                $pais = $rw['pais'];
                $nacimiento = $rw['nacimiento'];
                $estado = ucwords($rw['estado']);
                $ciudad = ucwords($rw['ciudad']);
                $fecha = $rw['fecha_registro'];
                $edad = 0;
                if((date('F') - date('F', strtotime($nacimiento))) << 0){
                    $edad = date('Y') - date('Y', strtotime($nacimiento));
                    $edadf = $edad - 1;
                } else if((date('F') - date('F', strtotime($nacimiento))) == 0){
                    if((date('d') - date('d', strtotime($nacimiento))) >= 0){
                        $edad = date('Y') - date('Y', strtotime($nacimiento));
                        $edadf = $edad - 1;
                    } else if((date('d') - date('d', strtotime($nacimiento))) << 0){
                        $edad = date('Y') - date('Y', strtotime($nacimiento));
                        $edadf = $edad - 1;
                    }
                }
                
                echo "<tr>";
                if($tipo == 1){
                    $idsecret = base64_encode($id);
                    echo "<td>".getEstado($id)."</td>";
                    echo "<td><button type='button' data-toggle='modal' class='btn btn-link' data-id='$idsecret' data-target='#partActivos2'>$nombre $apellido</button></td>";
                    echo "<td><button type='button' data-toggle='modal' class='btn btn-link' data-id='$idsecret' data-target='#partActivos2'>$edadf</button></td>";
                    echo "<td>$paises[$pais]</td>
                        <td>$estado, $ciudad</td>";
                    echo "<td><button type='button' data-toggle='modal' class='btn open-AddBookDialog' data-id='$idsecret' data-target='#partActivos2'>Ver Resumen</button>";
                } else if($tipo == 2 || $tipo == 4){
                            echo "<td>$nombre $apellido</td>
                                    <td>$correo</td>";
                            echo "<td>$paises[$pais]</td>
                                    <td>$estado, $ciudad</td>
                                    <td>$fecha</td>";
               } echo "</td></tr>";
            }
            echo "<thead><tr><th colspan=$numero style='color:white;'></th></tr></thead></tbody></table></div>";
            if($tipo === 2 || $tipo == 4){partDatosBancarios($id, $correo, $tipo);}
        } else {
            echo "No hay participantes activos en este momento.";
        }
}
    
function partAprobarPend($userid) {
    require_once "../../sitio/sec/ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    $sql = "UPDATE ms_usuario SET status = 1 where id = '$userid'";
    if (mysqli_query($dbh, $sql)) {
        
        
        header("location:../../mysteryshopper/cuenta/mailcontroller.php?t=" . base64_encode($userid) . "&tt=2");
        //header("location:index.php?e=1");
    } else {
        header("location:index.php?e=2");
    }
}

function partRechazarPend($userid){
    require_once "../../sitio/sec/ms/libcon.php";
    require_once "correos.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
        
        $sqlDos = "SELECT correo FROM ms_usuario WHERE id = '$userid'";
        $consulta = mysqli_query($dbh, $sqlDos);
        $rw = mysqli_fetch_array($consulta);
        if ($rw > 0) {
            $emailRec = $rw["correo"];            
            enviarEmailRechazado($emailRec);
        }     

    $sql = "UPDATE ms_usuario SET status = 2 where id = '$userid'";
    if (mysqli_query($dbh, $sql)) {

        header("location:index.php?e=3");

    } else {
        header("location:index.php?e=4");
    }
}

function partAprobarCorreo($mail, $tipo){
    require_once "../../sitio/sec/ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    
    $sql = "";
    $id = getID($mail);
    
    if($tipo == 1){
        $sql = "UPDATE ms_usuario SET status = 1 where id = $id";
    } else if ($tipo == 2){
        $sql = "UPDATE ms_usuario SET status = 2 where id = $id";
    }

    if (mysqli_query($dbh, $sql)) {
        if($tipo == 1){
            header("location: ../../mysteryshopper/cuenta/mailcontroller.php?t=" . base64_encode($id) . "&tt=2"); // APROBADO
        } else if($tipo == 2) {
            header("location: ../index.php?e=4"); // RECHAZADO
        }
    } else {
        header("location: ../index.php?e=5"); // ERROR AL ACTUALIZAR EL ESTADO
    }
}

function partResumen($iduser){
    require_once "../../sitio/sec/ms/libcon.php";    
    require_once "func.php";    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    echo "<div class='visitaTexto1'><b>ENCUESTAS:</b><br>";
    listarEncuestas($iduser);
    echo "<br><b>VISITAS PROGRAMADAS:</b><br>";
    listarVisitas($iduser);
    
    echo "</div>";
    
}

function partDatosBancarios($idpart, $correo, $tipo){
    require_once "../../sitio/sec/ms/libcon.php";    
    require_once "func.php";    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $tipoctaarray = array(1 => "CORRIENTE", 2 => "AHORRO");
    
    $sql = "select * from ms_encuesta_respuestas where id_encuesta = 2 and id_usuario = $idpart LIMIT 1";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        if($tipo == 1){
            echo "<div class='table-responsive'>
                    <table class='table table-hover table-condensed'>
                    <thead>
                        <tr>
                        <th>Banco</th>
                        <th>Tipo de Cuenta</th>
                        <th>Doc. Fiscal</th>
                        <th>Nro. de Cuenta</th>
                        <th>Codigo SWIFT (Si aplica)</th>
                        </tr>
                    </thead><tbody>";
            while ($rw = mysqli_fetch_array($search)) {
                $banco = $rw['P5'];
                $docf = $rw['P3'];
                $tipocta = $rw['P4'];
                $nrocta = $rw['P6'];
                $swift = $rw['P7'];
                echo "<tr>
                        <td>$banco</td>
                        <td>$tipoctaarray[$tipocta]</td>
                        <td>$docf</td>
                        <td>$nrocta</td>
                        <td>$swift</td>";
            }
                echo "</tr><thead><tr><th colspan=5></th></tr></thead></tbody></table></div>";
        } else if($tipo == 2){
            $regionen = $_GET['r'];
            $region = base64_decode($regionen);
            progDos($idpart, $region);
        }
    } else {
    if($tipo == 1){
       echo "<br><ul class='list-group' style='width: 70%;margin-left:auto;margin-right:auto;text-align:center;'><li class='list-group-item list-group-item-warning'><h6>El participante aún no ha indicado sus datos bancarios.</h6></li></ul>";
    } else if($tipo == 2){
       echo "<br><div style='width: 70%;margin-left:auto;margin-right:auto;text-align:center;'>No se puede programar una visita. Ya que el participante aún no ha indicado sus datos bancarios.<br><br><a href='../../mysteryshopper/cuenta/mailcontroller.php?ii=". base64_encode($idpart) ."&cc=". base64_encode($correo) ."&tt=1'><input type='button' name='prueba2' value='Enviar Recordatorio' /></a></div>";
    }
    }
}

function partVisitasProgramadas($idpart){
    require_once "../../sitio/sec/ms/libcon.php";    
        $dbh = dbconn();
        mysqli_set_charset($dbh, 'utf8');
        if (!$dbh) {
            die('Error en Conexión: ' . mysqli_error($dbh));
            exit;
        }    
        $sql = "SELECT * from ms_usuario_visitas WHERE id_usuario = $idpart";
        $search = mysqli_query($dbh, $sql);
        $match = mysqli_num_rows($search);
        if ($match > 0) {
            echo "<h4 style='text-align:center;'>Histórico de Visitas:</h4><div class='list-group' style='width:70%;margin-left:auto;margin-right:auto;'>";
            while ($rw = mysqli_fetch_array($search)) {
                $id = $rw['id'];
                $descr = $rw['visita_descripcion'];
                $fecha = $rw['visita_fecha'];?>
                <a href='partResumen.php?v=<?php echo base64_encode($id)."&vi=".  base64_encode($idpart); ?>' class='list-group-item list-group-item-warning' style='text-align:center;' onclick="window.open(this.href,'targetWindow','toolbar=no,location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=480, top=100, left=270'); return false;"><h6><strong>Descripción:</strong> <?php echo $descr ?> --- <strong>Fecha:</strong> <?php echo $fecha ?></h6></a>
            <?php }
            echo "</div>";
        } else {
            echo "<ul class='list-group' style='width: 70%;margin-left:auto;margin-right:auto;text-align:center;'><li class='list-group-item list-group-item-warning'><h6>No hay visitas programadas.</h6></li></ul>";
        }
}
   
function progUno(){ //PROGRAMAR VISITA
        require_once "../../sitio/sec/ms/libcon.php";    
        $dbh = dbconn();
        mysqli_set_charset($dbh, 'utf8');
        if (!$dbh) {
            die('Error en Conexión: ' . mysqli_error($dbh));
            exit;
        }
        
          $paises = array(
          "1" => "<img src='/images/flags/ve1.png' alt='Venezuela'></img>",
          "2" => "<img src='/images/flags/pty1.png'></img>",
          "3" => "<img src='/images/flags/usa1.png'></img>",
          "72" => "<img src='/images/flags/domrep1.png'></img>",
          "249" => "<img src='/images/flags/co1.png'></img>",
          "302" => "<img src='/images/flags/ec1.png'></img>",
          "304" => "<img src='/images/flags/cu1.png' alt='Curacao'></img>");
          
        // CONSULTO LISTA DE ENCUESTAS ACTIVAS DEL GRUPO 1
        //$sql = "SELECT * from ms_usuario WHERE status = 1 ORDER BY pais ASC";
        $sql = "SELECT A.id as iden, A.nombre, A.apellido, A.pais, A.estado, A.ciudad, A.nacimiento, coalesce(B.visita_asistencia, '-1') as asist FROM `ms_usuario` A LEFT JOIN ms_usuario_visitas B on A.id = B.id_usuario WHERE A.`status` = 1 ORDER BY A.`nombre` ASC";
        $search = mysqli_query($dbh, $sql);
        $match = mysqli_num_rows($search);
        if ($match > 0) {
            echo "<div class='table-responsive'>
                        <table class='table table-hover table-condensed'>
                        <thead>
                            <tr>                            
                            <th>País</th> 
                            <th>Localidad</th>
                            <th>Participante</th>
                            <th>Edad</th>
                            <th>Programar</th>
                            </tr>
                        </thead><tbody>";
            while ($rw = mysqli_fetch_array($search)) {
                $id = $rw['iden'];
                $nombre = ucwords($rw['nombre']);
                $apellido = ucwords($rw['apellido']);
                $pais = $rw['pais'];
                $estado = ucwords($rw['estado']);
                $ciudad = ucwords($rw['ciudad']);
                $nacimiento = $rw['nacimiento'];
                $asistio = $rw['asist'];
                $edad = 0;
                if((date('F') - date('F', strtotime($nacimiento))) << 0){
                    $edad = date('Y') - date('Y', strtotime($nacimiento));
                    $edadf = $edad - 1;
                } else if((date('F') - date('F', strtotime($nacimiento))) == 0){
                    if((date('d') - date('d', strtotime($nacimiento))) >= 0){
                        $edad = date('Y') - date('Y', strtotime($nacimiento));
                        $edadf = $edad - 1;
                    } else if((date('d') - date('d', strtotime($nacimiento))) << 0){
                        $edad = date('Y') - date('Y', strtotime($nacimiento));
                        $edadf = $edad - 1;
                    }
                }
                
                if($asistio == '0'){
                    $status = "-  <a href='#' data-toggle='tooltip' data-placement='top' title='Visita Programada'><img src='/mysteryshopper/images/schedule_clock.png' width='32px' height='32px'></img></a>";
                } else{
                    $status = "";
                }
                
                $idsecret = base64_encode($id);
                $paissecret = base64_encode($pais);
                echo "<tr>
                        <td>";
                        ?>
                        <a class='btn btn-link' href=<?php echo 'visitaProgramar.php?p='.$idsecret.'&r='.$paissecret.'';?>
                            onclick="window.open(this.href,'targetWindow','toolbar=no,location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=560, top=50, left=250'); return false;">

                         <?php echo "$paises[$pais]</a>"; 

                         // if(isset($status)){echo $status;} 
                         echo "</td><td>"?>

                            <a class='btn btn-link' href=<?php echo 'visitaProgramar.php?p='.$idsecret.'&r='.$paissecret.'';?> 
                                onclick="window.open(this.href,'targetWindow','toolbar=no,location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=560, top=50, left=250'); return false;">

                            <?php echo "$estado, $ciudad</td>";?>
                            <!-- PARTICIPANTES -->
                            <?php echo "<td>" ?>
                                <a class='btn btn-link' href=<?php echo 'visitaProgramar.php?p='.$idsecret.'&r='.$paissecret.'';?> 
                                onclick="window.open(this.href,'targetWindow','toolbar=no,location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=560, top=50, left=250'); return false;">

                            <?php echo "$nombre $apellido</a>";
                            if(isset($status)){echo $status;}
                             echo "</td>";?>


                            <?php echo "<td>$edadf</td>"; ?> 

                        <td>
                            <a href=<?php echo 'visitaProgramar.php?p='.$idsecret.'&r='.$paissecret.'';?>           onclick="window.open(this.href,'targetWindow','toolbar=no,location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=560, top=50, left=250'); return false;">
                            <button type='button' class='btn open-AddBookDialog' id='programarVisita'>Elegir</button>
                            </a>

                        <?php
                         echo "</td></tr>";
            }
            echo "<tr></tr></tbody></table></div>";
        } else {
            echo "No hay participantes disponibles en este momento.";
        }
}

function progDos($id, $region){
    require_once "../../sitio/sec/ms/libcon.php";    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    
    $sql = "SELECT ID, CODIGO from web_salones where REGIONSALON = $region AND ESTADO != 3";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    echo "<div class='contenidoInferior'><form name='progVisita' method='post'><div class='form-group'><label class='control-label col-sm-4' for='salones'>Selecciona un salón:</label><div class='col-sm-6'><select class='form-control' id='salones' name='salones' required>";
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            echo "<option value='".$rw['ID']."'>".$rw['CODIGO']."</option>";
        }
    } else {
        echo "<option value=''>No disponible</option>";
    }
    echo "</select></div></div><br><br>
    <div class='form-group'>
        <label class='control-label col-sm-4' for='forma'>Forma de Pago:</label>
        <div class='col-sm-6'><select class='form-control' id='forma' name='forma' required><option value='1'>Transferencia</option><option value='2'>Efectivo</option><option value='3'>Cheque</option><option value='4'>Gift Card</option><option value='5'>Otro</option></select></div>
    </div><br>
    <div class='form-group'>
        <label class='control-label col-sm-4' for='forma'>Observación sobre el Pago:</label>
        <div class='col-sm-6'><textarea class='form-control' id='obspago1' name='obspago' required>Una vez llenadas las encuestas, y enviada la factura, el pago será realizado en un plazo de 15 a 20 días.</textarea></div>
    </div><br><br>
    <div class='form-group'>
        <label class='control-label col-sm-4' for='fecha'>Fecha de la visita:</label>
        <div class='col-sm-6'><input type='date' class='form-control' id='fecha' placeholder='DIA-MES-AÑO' name='fecha' required value='' /></div>
    </div><br>
    <div class='form-group'>
        <label class='control-label col-sm-4' for='mensaje'>Descripcion:</label>
        <div class='col-sm-6'><input type='text' class='form-control' id='descripcion' name='descripcion' required value='Visita a Salón' /></div>
    </div><br>
    <div class='form-group'>
        <label class='control-label col-sm-4' for='mensaje'>Instrucciones para la visita:</label>
        <div class='col-sm-6'><textarea class='form-control' id='mensaje1' name='mensaje' placeholder='Instrucciones para el Usuario' name='mensaje' required></textarea></div>
    </div><br><br>
    <div class='form-group'>
        <label class='control-label col-sm-4' for='mensaje'>Servicios a Pedir:</label>
        <div class='col-sm-6'><input type='text' class='form-control' id='servicios' placeholder='Indicar Servicios a Hacerse por el Usuario' name='servicios' required value='' /></div>
    </div><br>
    <div class='form-group'> 
        <div class='col-sm-offset-4 col-sm-6'>
        <input type='hidden' value='$id' name='part' />
        <button type='submit' class='btn btn-primary' id='programarVisita' name='postProgVisita'>Programar Visita</button>
        </div>
   </div></form></div>";    
}

function progTres($participante, $salones){
    $forma = $_POST["forma"];
    $fecha = $_POST["fecha"]; //fecha de la visita
    $mensaje = $_POST["mensaje"]; // instrucciones para la visita
    $obspago = $_POST["obspago"];
    $descripcion = $_POST["descripcion"]; // descripcion de la visita
    $servicios = $_POST["servicios"]; // servicios a pedir por el usuario
            
    require_once "../../sitio/sec/ms/libcon.php";    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    
    $sql = "INSERT INTO ms_usuario_visitas (id_usuario, id_salon, visita_fecha, visita_descripcion, visita_observacion, visita_servicios, forma_pago, observacion_pago) 
        VALUES ($participante, '$salones', '$fecha', '$descripcion', '$mensaje', '$servicios', '$forma', '$obspago')";   
    
    if (mysqli_query($dbh, $sql)) {
        //echo "<script type='text/javascript'>alert('¡La visita fue programada éxitosamente!');</script>";
        $sql1 = "SELECT correo from ms_usuario WHERE id = $participante LIMIT 1";
        $search = mysqli_query($dbh, $sql1);
        $match = mysqli_num_rows($search);
        if ($match > 0) {
            $rw = mysqli_fetch_array($search);
            $correo = base64_encode($rw['correo']);
            $fechae = base64_encode($fecha);
            $salonese = base64_encode($salones);
            $mensajee = base64_encode($mensaje); 
            $descripcione = base64_encode($descripcion);
            $serviciose = base64_encode($servicios);

            header("Location: ../../mysteryshopper/cuenta/mailcontroller.php?re=$correo&f=$fechae&s=$salonese&m=$mensajee&d=$descripcione&ss=$serviciose");
                
            }        
    } else {
        echo "Error de ejecución: ".die(mysqli_error($dbh));
        echo "<script type='text/javascript'>alert('die(mysqli_error($dbh))');</script>";
        return;
    }
}

function referir1(){
    echo "Refiere o Invita a otra persona, para que pertenezca a nuestro grupo de participantes de <b><i>Mystery Shoppers</i></b>:";
    echo "<br><br><form class='form-header' role='form' method='POST' id='ms_referir'>
         <div class='form-group'>
            <label for='cantidad_e'>Ingresaré... </label>

            <div class='btn-group'>
                <button type='button' name='1' id='inputCorreos' class='btn btn-primary func' onclick=''>1 <span class='glyphicon glyphicon-envelope'></span></button>
                <button type='button' name='2' id='inputCorreos' class='btn btn-default func' onclick=''>2 <span class='glyphicon glyphicon-envelope'></span></button>
                <button type='button' name='3' id='inputCorreos' class='btn btn-default func' onclick=''>3 <span class='glyphicon glyphicon-envelope'></span></button>
                <button type='button' name='4' id='inputCorreos' class='btn btn-default func' onclick=''>4 <span class='glyphicon glyphicon-envelope'></span></button>
                <button type='button' name='5' id='inputCorreos' class='btn btn-default func' onclick=''>5 <span class='glyphicon glyphicon-envelope'></span></button>
                <button type='button' name='6' id='inputCorreos' class='btn btn-default func' onclick=''>6 <span class='glyphicon glyphicon-envelope'></span></button>
                <button type='button' name='7' id='inputCorreos' class='btn btn-default func' onclick=''>7 <span class='glyphicon glyphicon-envelope'></span></button>
                <button type='button' name='8' id='inputCorreos' class='btn btn-default func' onclick=''>8 <span class='glyphicon glyphicon-envelope'></span></button>
            </div>
        </div>

        <div class='form-group'>
                <label for='emails'>Ingrese aquí el (o los) correo eléctronico:<br></label>
                <input class='form-control input-lg' name='emails1' id='emails' type='email' placeholder='Correo eléctronico' required>
        </div>";
        echo "<span id='textoVacio'></span>";
        echo "<br><div class='form-group'>
        <button type='submit' class='btn btn-primary' id='referirBoton' name='referirOLD'>Enviar Invitaciones</button>
        </div>
        </form>";
}

function referir2(){
    echo "Refiere o Invita a otra persona, para que pertenezca a nuestro grupo de participantes de <b><i>Mystery Shoppers</i></b>:";
    echo "<form class='form-header' role='form' method='POST' id='ms_referir'>
                <div class='form-group'>
                   <label for='cantidad_e'>Recuerda separar las direcciones de correo por una coma (,) </label>
               </div>
                <div class='form-group'>
                        <label for='emails'>Ingrese aquí el (o los) correo eléctronico:<br></label>
                        <span class='glyphicon glyphicon-envelope'></span><input class='form-control input-lg' name='emails1' id='emails' type='text' placeholder='Correo eléctronico' required>
                </div>";
        echo "<span id='textoVacio'></span>";
        echo "<br><div class='form-group'>
        <button type='submit' class='btn btn-primary' id='referirBoton2' name='referir'><span class='glyphicon glyphicon-envelope'>  </span>  Enviar Invitaciones</button>
        </div>
        </form>";
}

function getID($email){
    require_once "../../sitio/sec/ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    $sql = "SELECT id FROM ms_usuario WHERE correo = '$email' LIMIT 1";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    if ($match > 0) {
            while ($rw = mysqli_fetch_array($search)) {
                $id = $rw['id'];
                return $id;
            }
    } else{
        //NO HAY CORREO
    }
}

function getEstado($id){
    require_once "../../sitio/sec/ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    $sql = "SELECT count(id_encuesta) as SI FROM ms_encuesta_respuestas WHERE id_usuario = '$id' AND id_encuesta = 2";
    $search = mysqli_query($dbh, $sql);
    while ($rw = mysqli_fetch_array($search)) {
        $contador = $rw['SI'];
        if($contador >= 1){
            //SI RESPONDIO
            $img = "<a href='#' data-toggle='tooltip' data-placement='top' title='Envió sus datos bancarios'><img src='/mysteryshopper/images/done-icon.png' width='32px' height='32px'></img></a>";
            return $img;
        } else if ($contador <=0){
            //NO HA RESPONDIDO
            $img = "<a href='#' data-toggle='tooltip' data-placement='top' title='Aún no ha enviado sus datos bancarios'><img src='/mysteryshopper/images/warning.png' width='32px' height='32px'></img></a>";
            return $img;
        }
    }

}

function reporteVisitasGeneral(){
        require_once "../../sitio/sec/ms/libcon.php";    
        $dbh = dbconn();
        mysqli_set_charset($dbh, 'utf8');
        if (!$dbh) {
            die('Error en Conexión: ' . mysqli_error($dbh));
            exit;
        }
       
        // CONSULTO LISTA DE ENCUESTAS ACTIVAS DEL GRUPO 1
        $paises = array(
          "1" => "<img src='/images/flags/ve1.png' alt='Venezuela'></img>",
          "2" => "<img src='/images/flags/pty1.png'></img>",
          "3" => "<img src='/images/flags/usa1.png'></img>",
          "72" => "<img src='/images/flags/domrep1.png'></img>",
          "249" => "<img src='/images/flags/co1.png'></img>",
          "302" => "<img src='/images/flags/ec1.png'></img>",
          "304" => "<img src='/images/flags/cu1.png' alt='Curacao'></img>");
        
        $sql = "SELECT A.*, B.id as ID2, B.nombre, B.apellido, B.correo, B.pais, B.estado, B.ciudad from ms_usuario_visitas A INNER JOIN ms_usuario B on A.id_usuario = B.id ORDER BY visita_asistencia ASC, visita_fecha ASC";
        $search = mysqli_query($dbh, $sql);
        $match = mysqli_num_rows($search);
        if ($match > 0) {
            echo "<div class='table-responsive' style='overflow-x:auto;'>
                    <table class='table table-hover table-condensed'><thead><tr>
                    <th stlye='text-align: center;'>Estado</th>
                    <th>Fecha de Visita</th>
                    <th>Participante</th>
                    <th>País</th>
                    <th>Localidad</th>
                    <th>Revisar Visita</th>
                  </tr></thead><tbody>";
            while ($rw = mysqli_fetch_array($search)) {
                $id = $rw['id'];
                $iduser = $rw['ID2'];
                $asistencia = $rw['visita_asistencia'];
                $visitafecha = $rw['visita_fecha'];
                $nombre = ucwords($rw['nombre']);
                $apellido = ucwords($rw['apellido']);
                $correo = $rw['correo'];
                $pais = $rw['pais'];
                $estado = ucwords($rw['estado']);
                $ciudad = ucwords($rw['ciudad']);
                
                setlocale (LC_TIME, "es_ES.UTF-8");
                $phpdate = strtotime( $visitafecha );
                //$fecha2 = date( 'd-M-Y', $phpdate );
                $fecha2 = strftime("%d-%b-%Y", $phpdate);
                $idsec = base64_encode($id);
                $idusersec = base64_encode($iduser);
                
                if($asistencia == 0){
                    //PROGRAMADA
                    $img = "<a href='#' data-toggle='tooltip' data-placement='top' title='Programada'><img src='/mysteryshopper/images/schedule_clock.png' width='32px' height='32px'></img></a>";
                    } else if ($asistencia == 1){
                        //NO HA RESPONDIDO
                        $img = "<a href='#' data-toggle='tooltip' data-placement='top' title='Encuestas Respondidas'><img src='/mysteryshopper/images/pending.png' width='32px' height='32px'></img></a>";
                    } else if ($asistencia == 2){
                        //NO HA RESPONDIDO
                        $img = "<a href='#' data-toggle='tooltip' data-placement='top' title='Visita Finalizada'><img src='/mysteryshopper/images/done-icon.png' width='32px' height='32px'></img></a>";
                    } else if ($asistencia == 3){
                        //NO HA RESPONDIDO
                        $img = "<a href='#' data-toggle='tooltip' data-placement='top' title='No Asistió'><img src='/mysteryshopper/images/x.png' width='32px' height='32px'></img></a>";
                    } 
                
                $correosecret = base64_encode($correo);
                echo "<tr class='clickable-row'>";
                ?>
                <?php
                echo "<td style='text-align:center;'><a href='#' data-toggle='tooltip' data-placement='top' title='Estado: $asistencia'>$img</a></td>
                        ";?><td><a href='partResumen.php?v=<?php echo"$idsec&vi=$idusersec";?>' onclick="window.open(this.href,'targetWindow','toolbar=no,location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=480, top=100, left=270'); return false;"><?php echo $fecha2;?></a></td>
                        <td><a href='partResumen.php?v=<?php echo"$idsec&vi=$idusersec";?>' onclick="window.open(this.href,'targetWindow','toolbar=no,location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=480, top=100, left=270'); return false;"><?php echo "$nombre $apellido";?></a></td>  
                        <?php echo "<td>$paises[$pais]</td>
                        <td>$ciudad, $estado</td>";?>
                        <td><a href='partResumen.php?v=<?php echo"$idsec&vi=$idusersec";?>' onclick="window.open(this.href,'targetWindow','toolbar=no,location=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=900, height=480, top=100, left=270'); return false;">
                        <button type="button" class="btn">Consultar Reporte</button></a></td></tr>
            <?php }
                echo "</tbody></table></div>";
            } else {
            echo "No hay visitas para mostrar en este momento.";
        }
}

function actualizarVisita($id, $contenido, $paso){
    require_once "../../sitio/sec/ms/libcon.php";    
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    if($paso == "1"){
        $sql = "UPDATE ms_usuario_visitas SET visita_fecha = '".$contenido."' where id = $id;";
    } else
    if($paso == "2"){
        $sql = "UPDATE ms_usuario_visitas SET visita_observacion = '".$contenido."' where id = $id;";
    } else
    if($paso == "3"){
        $sql = "UPDATE ms_usuario_visitas SET visita_servicios = '".$contenido."' where id = $id;";
    } else
    if($paso == "4"){
        $sql = "UPDATE ms_usuario_visitas SET id_salon = '".$contenido."' where id = $id;";
    }
        if (mysqli_query($dbh, $sql)) {
            $exito = 1;
        } else {
            $exito = 0;
        }
        return $exito;
}
?>
