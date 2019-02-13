<?php
error_reporting(1);

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

function resumenventa1($user){
    include "../sec/libfunc.php";
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$user&clave=&funcion=regionesusuario", $resulta);
    if ($error == ""){
        $final = $resulta;
        $manage = (array) json_decode($final, true);
        
        $miregion = array();
        $i=0;     
        foreach ($manage as $region) {
            $miregion[$i] = $region['CODIGO'];
            $i++;
        }

        $resulta2 = "";
            $error2 = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$user&region=$miregion&funcion=resumenventaintranet", $resulta2);
            if ($error2 == ""){
                $final2 = $resulta2;
                $manage2 = (array) json_decode($final2, true);
                
                var_dump($manage2);
//                resumenventa2($miregion, $miregiondesc, $manage2);
            }





            /*$miregiondesc = $region['DESCRIPCION'];
            $resulta2 = "";
            $error2 = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$user&region=$miregion&funcion=salonesusuario", $resulta2);
            if ($error2 == ""){
                $final2 = $resulta2;
                $manage2 = (array) json_decode($final2, true);
                resumenventa2($miregion, $miregiondesc, $manage2);
            }*/
        }
        return;
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        echo $msg;
        return;
    }
}

function resumenventa2($cod, $desc, $salones){
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }
    include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/intranetvarios.php"; ?>
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="card card-stats">
            <div class="card-header" data-background-color="white">
                <i class="material-icons pe-7s-note2"></i>
            </div>
            <div class="card-content">
                <p class="category"><?php echo $tabventas." ".date("d/m",strtotime("-1 days"));?></p>
                <h3 class="title"><?php echo $desc;?></h3>
            </div>
            <div class="card-footer">
                <div class="stats">                   
                    <div class='table-responsive'>
                    <table id="<?php echo $cod;?>" class="table table-striped table-bordered table-hover table-condensed" width="100%">
                        <thead>
                            <tr>
                                <th><?php echo $tabsalon; ?></th>
                                <th style="padding: 10px 7px;">Total (Imp. exc)</th>
                                <th style="padding: 10px 7px;">Inventario</th>
                                <th style="padding: 10px 7px;">Servicios</th>
                                <th style="padding: 10px 7px;">Clientes Totales</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <?php foreach ($salones as $sal) { 
                                echo "<tr><th>".$sal['ALIAS']."</th><th></th><th></th><th></th><th></th></tr>";
                                
                            }
                            ?>
                        </tfoot>
                    </table>
                    </div>   
                </div>
                <span id="componente6"></span>
            </div>
        </div>
    </div>
    
<?php }

function resumenventa3($user){
    include "../sec/libfunc.php";
    $resulta = "";
    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&clave=&funcion=resumenventaintranet", $resulta);
    if ($error == ""){
        if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        $final = $resulta;
        
        $manage = (array) json_decode($final);        
        
//        foreach ($manage as $region) {
//            echo regionBanderas($region->CODIGO);
//        }
        return;
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        echo $msg;
        return;
    }    
}

function modalResumenVentas(){ ?>

        <!-- COMIENZO DE MODAL:   -->
        <div id="resumenventas" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><b>Resumen de Ventas: <span id="respais"></span></b></h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-center"><b>Para el día:</b> xx/xx/xxxx</p>
                        <span id="rescontenido"></span>
                        <?php echo tablaModalResVent();?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="pe-7s-close"></i></button>
                    </div>
                </div>

            </div>
        </div>
        <!-- FIN DE MODAL:  -->
        
<?php return; }

function tablaModalResVent(){ ?>
    <div class="table-responsive">          
        <table class="table table-condensed">
          <thead>
            <tr>
              <th style="padding: 10px 7px;">Total (Imp. exc)</th>
              <th style="padding: 10px 7px;">Inventario</th>
              <th style="padding: 10px 7px;">Servicios</th>
              <th style="padding: 10px 7px;">Clientes Totales</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td>841.409,00 <img src="/intranet/componentes/images/trending-down-r.png"></td>
            <td>23.543,00 <img src="/intranet/componentes/images/trending-down-r.png"></td>
            <td>817.866,00 <img src="/intranet/componentes/images/trending-up-g.png"></td>
            <td>44,00 <img src="/intranet/componentes/images/trending-down-r.png"></td>
          </tr>
        </tbody>
      </table>
      </div>
        
<?php }

function rventas1($usuario){ ?>
    <div class="card-content">
        <p class="category">Ventas del día 20/07</p>
        <h3 class="title">Venezuela</h3>
    </div>
    <div class="card-footer">
        <div class="stats">
        <div class="table-responsive" style="margin-left: -10px;margin-right: -10px;">          
        <table class="table table-condensed">
          <thead>
            <tr>
              <th style="padding: 10px 20px;">Salón</th>
              <th style="padding: 10px 20px;">Resultado</th>
            </tr>
        </thead>
        <tbody>
          <tr>
            <td>SALVADOR EXPRESS, C.A.</td>
            <td><button type='button' class="btn" data-toggle='modal' data-target='#resumenventas' data-title='SALVADOR EXPRESS, C.A.'>Ver Resultados</button></td>
          </tr>
          <tr>
            <td>KIDS 2009, C.A.</td>
            <td><button type='button' class="btn" data-toggle='modal' data-target='#resumenventas' data-title='KIDS 2009, C.A.'>Ver Resultados</button></td>
          </tr>
          <tr>
            <td>OPERADORA ACARIGUA, C.A.</td>
            <td>No reporto cierre del día</td>
          </tr>
          <tr>
            <td>SALVADOR INSTITUTO DE BELLEZA DELICIAS NORTE, C.A.</td>
            <td>No reporto cierre del día</td>
          </tr>
        </tbody>
      </table>
      </div>
    </div>
    </div>
<?php }

?>