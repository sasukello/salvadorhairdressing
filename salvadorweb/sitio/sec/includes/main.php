<?php

/*
 * SALVADOR: FUNCIONES PARA CONTACTO - ASOCIADOS
 */
function getRegiones(){
    require_once "sitio/sec/ms/libcon.php";
    $dbh = dbconncc();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    
    $sql = "SELECT * FROM REGIONES";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            echo "<option value='".$rw['CODREGION']."'>".ucwords(strtolower($rw['NOMBRE']))."</option>";
        }
        
    }else {
        echo "<option value=''>No se encontraron resultados.</option>";
    }
    return;
}

function getSalones($id){
    require_once "../ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    echo "<br><br><label class='' for='salon'>Salón: </label> <select name='salon' value='' required>";

    $sql = "SELECT * FROM web_salones where REGIONSALON = '$id' AND ESTADO = 1";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            echo "<option value='".$rw['ID'].",".$rw['FRANQUICIA']."'>".$rw['NOMBRECOMPLETO']."</option>";
            
        }
        echo "</select>";?>
            <br><br><label class="" for="nombre">Nombre: </label> <input type="text" name="nombre" value="" placeholder="Ingresa tu nombre" required>
            <br><br><label class="" for="codigo">Codigo en Salón: </label> <input type="text" name="codigo" value="" placeholder="Ingresa tu código"  required>
            <br><br><label class="" for="comentario">Comentarios: </label> <textarea cols="30" rows="7" name="comentario" value="" placeholder="Ingresa tus comentarios" required></textarea>
            <br><br><input type="submit" name="submAsoc" class="" value="Enviar Comentarios">
        <?php
    }else {
        echo "<option value=''>No se encontraron resultados.</option>";
    }
    return;
}

function getIconNombre($id, $selector){
    require_once "../ms/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
        
    if($selector == 1){ // ICONO DE REGION
    $sql = "select campo3 from ms_configuracion where campo = $id LIMIT 1";
    $query = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($query);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($query)) {
            $url = $rw['campo3'];
            return $url;
        }
    } else { 
        return $id;
    }
} else if($selector == 2){ // NOMBRE DEL SALON
    $sql = "select NOMBRECOMPLETO from web_salones where ID = '$id' LIMIT 1";
    $query = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($query);
    if($match > 0){
        while($rw = mysqli_fetch_array($query)){
            $nombre = $rw['NOMBRECOMPLETO'];
            return $nombre;
        }
    } else {
        return $id;
    }
}}

function procesarForm(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['submAsoc'])) {
            $region = $_POST["region"];
            $salon = $_POST["salon"]; //fecha de la visita
            $nombre = $_POST["nombre"]; // instrucciones para la visita
            $codigo = $_POST["codigo"];
            $comentario = $_POST["comentario"]; // descripcion de la visita
            
            list($idsalon, $franquicia) = explode(",", $salon);
            if($franquicia == 0){
                //NO ES FRANQUICIA
                sendMail("talentohumano@salvadorhairdressing.com", "".$region.";".$salon.";".$nombre.";".$codigo.";".$comentario);
                return;
            } else if($franquicia == 1){
                //ES FRANQUICIA
                
            }
        }
    }
}

function sendMail($destinatario, $contenido){
    
    list($reg, $sal, $nomb, $cod, $coment) = explode(";", $contenido);
    list($region, $franquicia) = explode(",", $reg);
    $to = "alugox@gmail.com";
    $subject = "Salvador Hairdressing: Nuevo Comentario de Asociado";

    $htmlContent1 = file_get_contents("../ms/correos/contactoasociado.php");
    $htmlContent2 = "<tr>
              <td class='free-text'>
                  <br><table class='tabla1'>
                  <tr class='tr'>
                    <th class='th' colspan='2'>Detalles del Mensaje:</th>
                  </tr>
                  <tr class='tr'>
                    <td class='td'><b>Region:</b></td>
                    <td class='td'><img src='".getIconNombre($region,1)."'></td>
                  </tr>
                  <tr class='tr'>
                    <td class='td'><b>Salón:</b></td>
                    <td class='td'>".getIconNombre($sal,2)."</td>
                  </tr>
                  <tr class='tr'>
                    <td class='td'><b>Nombre del Asociado:</b></td>
                    <td class='td'>$nomb</td>
                  </tr>
                  <tr class='tr'>
                    <td class='td'><b>Código:</b></td>
                    <td class='td'>$cod</td>
                  </tr>
                  <tr class='tr'>
                    <td class='td'><b>Mensaje:</b></td>
                    <td class='td'>$coment</td>
                  </tr>
                </table>
              </td>
          </tr>";
    $htmlContent3 = file_get_contents("sitio/sec/ms/correos/contactoasociado2.php");
    
    // Set content-type header for sending HTML email
    $htmlContent = $htmlContent1.$htmlContent2.$htmlContent3;

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    // Additional headers
    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    //$headers .= 'Cc: oym@salvadorhairdressing.com, sistemas@salvadorhairdressing.com' . "\r\n";
    //$headers .= 'Bcc: programacion@salvadorhairdressing.com' . "\r\n";

    // Send email
    if(mail($to,$subject,$htmlContent,$headers)):
      return "1";

    else:
    return "0";
    endif;
}

if(isset($_GET['a'])){
    $reg = $_GET['a'];
    getSalones($reg);
} else{
    //echo "Acceso Restringido";
}
?>