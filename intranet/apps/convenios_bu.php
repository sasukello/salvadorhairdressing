<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $accion = $_POST['action'];
    }
    switch ($accion) {
        case 'r1':
        echo listasalonxregion($_POST['datos']);
        break;

    }
}

function listasalonxregion($region){
    
       if (session_status() === PHP_SESSION_NONE) {
           session_start();
           }
       include "../sec/libfunc.php";
    
       echo 'Usuario: '.$_SESSION['codigo'].'<br>';
       $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=".$_SESSION["codigo"]."&region=$region&funcion=salonesusuario", $resulta);

       if ($error == ""){


           $manage = (array) json_decode($resulta);        
           $listaSalones = "";
           foreach ($manage as $salon) {
               $listaSalones .= '<input type="checkbox" name="salon[]" value= "'.$salon->CODIGOSALON.'"/> '.$salon->ALIAS.' <br />';
           } 
           
                      
       }

       else{

           $msg = "<b>Ha ocurrido un error:</b> " . $error;

           return $msg;

       }
    

    return $listaSalones;

    

}



function listaregiones($usuario){

    $resulta = "";

    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&clave=&funcion=regionesusuario", $resulta);

    if ($error == ""){

        if (session_status() === PHP_SESSION_NONE) {

        session_start();

        }

        $final = $resulta;

        

        $manage = (array) json_decode($final);
        
        $listaregiones = ""; 
        foreach ($manage as $region) {
            if ($listaregiones != ""){
                $listaregiones .= ", ";
            }
            $listaregiones .= $region->CODIGO;
        }

        return $listaregiones;

    }

    else{

        $msg = "<b>Ha ocurrido un error:</b> " . $error;

        return $msg;

    }

}




function listasalones($usuario){

    $lr = listaregiones($usuario);

    $arrRegiones = explode(",", $lr);

    $listaSalones = "";

    foreach ($arrRegiones as $region){
       $resulta = "";

       $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&region=$region&funcion=salonesusuario", $resulta);

       if ($error == ""){

           if (session_status() === PHP_SESSION_NONE) {

           session_start();

           }

           $final = $resulta;

           

           $manage = (array) json_decode($final);        

           foreach ($manage as $salon) {
               if ($listaSalones != ""){
                   $listaSalones .= ", ";
               }
               $listaSalones .= "'".$salon->CODIGOSALON."'";

           } 
           
                      
       }

       else{

           $msg = "<b>Ha ocurrido un error:</b> " . $error;

           return $msg;

       }
    }

    return $listaSalones;

    

}

function listaconvenios(){


  include "../sec/libcon.php";
  include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php");
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    /* CONSULTAR LISTADOS DE CLIENTES EN SALÓN */
    $sql = "SELECT * FROM WEB_CONVENIOS where id not in (SELECT IDCONVENIO FROM WEB_CONVENIOS_SALONES_EXCEPTUADOS WHERE SALONAPLICA IN (".listasalones($_SESSION["codigo"])."))";

    $result = array();
    $i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            $result[$i] = "<tr><td><a href='#mov1' data-toggle='modal' data-id='".$rw['NOMBRE']."' data-whatever='".$rw['CODIGOCLIENTE']."'><i class='pe-7s-expand1 pe-5x pe-va' style='visibility: visible;font-size: 20px;vertical-align: middle;'></i> - ".$rw['NOMBRE']."</a></td><td>".$rw['TELEFONO']."</td><td>".$rw['CORREO']."</td><td>".$rw['FECHANACIMIENTO']."</td><td style='text-align: center;'>".genero($rw['GENERO'])."</td><td>".$rw['CLIENTCARD']."</td><td style='text-align: center;'>".estados($rw['ESTATUS'])."</td></tr>";
            $i++;
        }
    } else {
        $result = "<tr><td colspan = 5>$trcvnSinResultado</td></tr>";
        
    }
    return $result;

}

function regionCargarselect($usuario, $regiondefecto){
    include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php");

    $resulta = "";

    $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=$usuario&clave=&funcion=regionesusuario", $resulta);

    if ($error == ""){

        if (session_status() === PHP_SESSION_NONE) {

        session_start();

        }

        $final = $resulta;

        

        $manage = (array) json_decode($final);        

        $tamaño = count($manage);
        $resulta = "<select class='form-control'  onchange='listarsalones()' id = 'txtlistaregiones' style = 'padding-left: 25px; background-repeat: no-repeat; background-position: 3px 50%;'>";

        $resulta .= '<option value = "-1">'.$trcvnseleccionaregion.'</option>';

        foreach ($manage as $region) {

            $resulta .= '<option value="'.$region->CODIGO.'"';
            if ($region->CODIGO == $regiondefecto){
              $resulta .= ' selected ';
            }
            $resulta .= regionBanderasimagen($region->CODIGO). '>'.$region->DESCRIPCION.'</option>';
        }
        $resulta .= "</select>";
        return $resulta; 
    }
    else{
        $msg = "<b>Ha ocurrido un error:</b> " . $error;
        return $msg;
    }
}

function regionBanderasimagen($id){
    switch ($id) {
        case '1':
            $img = '/images/flags/ve128.png';
            break;

        case '2':
            $img = '/images/flags/pty128.png';
            break; 

        case '3':
            $img = '/images/flags/usa128.png';
            break;

        case '72':
            $img = '/images/flags/domrep128.png';
            break;

        case '249':

            $img = '/images/flags/col128.png';

            break;

        case '302':
            $img = '/images/flags/ec128.png';
            break;

        case '304':
            $img = '/images/flags/cu128.png';
            break;

        case '376':
            $img = '/images/flags/mex.png';
            break;

        case '378':
            $img = '/images/flags/per.png';
            break;

        case '380':
            $img = '/images/flags/chile128.png';
            break;

        case '382':
            $img = '/images/flags/cr128.png';
            break;

        default:
            break;
    }

    return 'style="background-image: url('.$img.'); padding-left: 25px; background-repeat: no-repeat; background-position: 3px 50%;"';
}




function modalconvenio(){
    if (session_status() === PHP_SESSION_NONE) {
    session_start();
    }

    $_SESSION["calendar_live"] = 1;
  include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php");

   //Modal para agregar minuta
   echo' <!-- Modal -->
     <div class="modal fade" id="modalconvenios" role="dialog">
        <div class="modal-dialog">
   
          <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">'.$trConvenioTitulo.'</h4>
               </div>
               <div class="modal-body col-lg-12 col-md-12 col-sm-12">
               <div class="form-group col-lg-12 col-md-12 col-sm-12">
                  <div class="col-lg-4 col-md-4 col-sm-12"><label for="txtlistaregiones">'.$trcvnRegion.': </label></div>          
                  <div class="col-lg-8 col-md-8 col-sm-12">'. regionCargarselect($_SESSION['codigo'], '') . '</div>'; ?>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <div class="col-lg-4 col-md-6 col-sm-12"><label for="inputdefault"><?php echo $trcvnDescripcion; ?>: </label></div>
                          <div class="col-lg-8 col-md-6 col-sm-12"><input class="form-control" name="txtNombreConvenio" id="txtNombreConvenio" type="text" required></div>
                        </div>
                        <div class="form-group form-inline col-lg-6 col-md-6 col-sm-12">
                          <div class="col-lg-4 col-md-4 col-sm-6"><label for="txtDesde"><?php echo $trcvnDesde; ?>: </label></div>
                          <div class="col-lg-4 col-md-4 col-sm-6"><input class="form-control" name="txtDesde" id="date_desde" type="text" required></div>
                        </div>
                        <div class="form-group form-inline col-lg-6 col-md-6 col-sm-12">
                          <div class="col-lg-4 col-md-4 col-sm-6"><label for="txtHasta"><?php echo $trcvnHasta; ?>: </label></div>
                          <div class="col-lg-4 col-md-4 col-sm-6"><input class="form-control" name="txtHasta" id="date_hasta" type="text" required></div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <div class="col-lg-4 col-md-6 col-sm-12"><label for="txtComoFacturar"><?php echo $trcvnComoFacturar; ?>: </label></div>
                          <div class="col-lg-8 col-md-6 col-sm-12"><textarea class="form-control" name="txtComoFacturar" id="txtComoFacturar" type="text"></textarea></div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <div class="col-lg-4 col-md-6 col-sm-12"><label for="txtTerminos"><?php echo $trcvnTerminos; ?>: </label></div>
                          <div class="col-lg-8 col-md-6 col-sm-12"><textarea class="form-control" name="txtTerminos" id="txtTerminos" type="text"></textarea></div>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                          <div class="col-lg-4 col-md-6 col-sm-12"><label for="cntSalones"><?php echo $trcvnSalonesExcepto; ?>: </label></div>
                          <div class="col-lg-8 col-md-6 col-sm-12"><div class="container form-control" style="border:2px solid #ccc; height: 100px; overflow-y: scroll;" id="cntSalones"></div></div>
                        </div>

                       </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" onclick='agregarminuta()'><?php echo $trmnabrir; ?></button>
               </div>
            </div>
        </div>
     </div>

<?php } ?>