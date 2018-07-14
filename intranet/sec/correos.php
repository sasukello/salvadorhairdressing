<?php
function enviarMailNotificacion($datos){
  list($user, $idsalon, $marca) = explode(";", $datos);
  $email = "alugox@gmail.com";
  $to = $email;
  $subject = "Salvador Hairdressing - Nuevo Pedido Sugerido";

  $htmlContent1 = file_get_contents("../componentes/plantillas/pedido.php");
  $htmlContent2 = "<tr>
                <td class='free-text'>
                    <br><table class='tabla1'>
                    <tr class='tr1'>
                      <th class='th1' colspan='2'>Datos del Pedido</th>
                    </tr>
                    <tr class='tr1'>
                      <td class='td1'><b>Generado por el Usuario:</b></td>
                      <td class='td1'>$user</td>
                    </tr>
                    <tr class='tr1'>
                      <td class='td1'><b>Salón Seleccionado:</b></td>
                      <td class='td1'>$idsalon</td>
                    </tr>
                    <tr class='tr1'>
                      <td class='td1'><b>Marca Seleccionada:</b></td>
                      <td class='td1'>$marca</td>
                    </tr>
                    <tr class='tr1'>
                      <td class='td1'><b>Generado el día:</b></td>
                      <td class='td1'>03-05-2017</td>
                    </tr>
                  </table>
                </td>
            </tr>";
  $htmlContent3 = file_get_contents("../componentes/plantillas/pedido2.php");

  $htmlContent = $htmlContent1.$htmlContent2.$htmlContent3;

  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";

  if(mail($to,$subject,$htmlContent,$headers)):
          $msg = "<div class='alert alert-success'><p><strong>¡El pedido fue guardado éxitosamente!</strong></p>
              <p>Recuerda que puedes guardar el reporte haciendo click en el botón de <span id='highlight'>Excel</span></p>.</div>";
          return $msg;
  else:
          $msg = "<div class='alert alert-danger'><p><strong>Error</strong> al enviar Correo Informativo al Cliente.<br></p>.</div>";
          return $msg;
  endif;
}



function enviarMailNotificacion2($mail, $dat, $adi){

  list($time, $usuario, $usuariocompl, $codsalon, $brand) = explode(";", $adi);
  $dat2 = json_decode($dat, true);

  $to = $mail;
  $subject = "Salvador Hairdressing - Nuevo Pedido Sugerido";
  $fecha = date("Y-m-d");

  $htmlContent1 = file_get_contents("../componentes/plantillas/pedido.php");
  $htmlContent2 = "<tr>
                      <td class='free-text'>
                          <br><table class='tabla1'>
                          <tr class='tr1'>
                            <th class='th1' colspan='2'>Datos del Pedido</th>
                          </tr>
                          <tr class='tr1'>
                            <td class='td1'><b>Generado por el Usuario:</b></td>
                            <td class='td1'>$usuariocompl ($usuario)</td>
                          </tr>
                          <tr class='tr1'>
                            <td class='td1'><b>Salón Seleccionado:</b></td>
                            <td class='td1'>$codsalon</td>
                          </tr>
                          <tr class='tr1'>
                            <td class='td1'><b>Marca Seleccionada:</b></td>
                            <td class='td1'>$brand</td>
                          </tr>
                          <tr class='tr1'>
                            <td class='td1'><b>Generado el día:</b></td>
                            <td class='td1'>$fecha</td>
                          </tr>
                        </table>
                      </td>
                  </tr>
                  <tr><td class='free-text'>
                    <br><table class='tabla1'>
                      <tr class='tr1'>
                        <th class='th1'>Cód.</th>
                        <th class='th1'>Descripción.</th>
                        <th class='th1'>Sugerido</th>
                      </tr></table></td></tr>";
  $htmlContent3 = "";
  foreach ($dat2 as $dt) {
    $htmlContent3 .= "<tr class='tr1'><td class='td1'>".$dt['CODIGO']."</td><td class='td1'>".$dt['DESCRIPCION']."</td><td class='td1'>".$dt['SUGERIDO']."</td></tr>";
  }

  $htmlContent4 = file_get_contents("../componentes/plantillas/pedido2.php");

  $htmlContent = $htmlContent1.$htmlContent2.$htmlContent3.$htmlContent4;

  //var_dump($htmlContent);
  //var_dump($to);
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

  $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
  $headers .= 'Bcc: programacion@salvadorhairdressing.com' . "\r\n";

  // Send email
  if(mail($to,$subject,$htmlContent,$headers)):
      $msg = "<div class='alert alert-success'><p><strong>¡El pedido sugerido fue enviado por correo éxitosamente!</strong></p>".
              //<p>Recuerda que puedes guardar el reporte en <span id='highlight'>Excel o PDF.</span></p>
              "</div>";
      return $msg;
  else:
      $msg = "<div class='alert alert-danger'><p><strong>Hubo un Error</strong> al enviar el Correo.<br></p>.</div>";
      return $msg;
  endif;
}

function enviarMinutasMail($datos, $destinatarios, $identificador, $tipo){
  list($c1, $c2) = explode(";", $destinatarios);

  if($tipo == "salon"){
    $tip = "Salón";
  } else if($tipo == "region"){
    $tip = "Región";
  } else if($tipo == "comite"){$tip = "Minutas";}
    $to = $c1;
    $subject = "Salvador Hairdressing - Minutas";
    $fecha = date("Y-m-d");

    $htmlContent1 = file_get_contents("../componentes/plantillas/minutassalon1.html");
    $htmlContent3 = file_get_contents("../componentes/plantillas/minutassalon2.html");
    $htmlContent2 = '<td class="header-md" style="padding-bottom: 15px; text-align: center;">
                    '.$tip.': '.$identificador.'</td></tr></table></td></tr><tr><td valign="top" width="100%" style="background-color: #ffffff;"><center>';
    foreach ($datos as $d) {
          $cabecera = substr($d, 0, strpos($d, "}[")+1);
          $cabecera = array(json_decode($cabecera, true));

          $header = '<table cellpadding="0" cellspacing="0" width="600" class="w320">
                <tr>
                  <td style="padding-bottom: 75px;">
                    <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate !important;">
                      <tr style="text-align: right!important">

                        <td class="info-block">
                          <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate !important;">
                            <tr>
                              <td class="block-rounded">
                                <table cellpadding="0" cellspacing="0" width="100%">
                                  <tr>
                                    <td style="padding: 15px;">
                                      <div class="col-lg-8 col-md-12 col-sm-12">
                                        <div class="card card-stats">
                                          <div class="card-content" align="left">
                                            <img align="left" src="http://www.salvadorhairdressing.com/correos/dashboard/salon.png" style="border-radius: 10px; margin-top: -60px; box-shadow: 3px 3px 3px #888888;">
                                            <p class="category" style="text-align: right;">Minutas</p>';
          $middle = '<h3 style="border-bottom: 2px solid #0cb4c9;  text-align: right;">Minuta por: '.$cabecera[0]["USUARIOCREADO"].', el '.$cabecera[0]["FECHACREADO"].' a las '.$cabecera[0]["HORACREADO"].'</h3>
                                            <h4>Descripcion: </h4>
                                            <small>'.$cabecera[0]["DESCRIPCION"].'</small>';
          $footer = '</div></div></div>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>

                      </tr>
                    </table>
                  </td>
                </tr>
              </table>';

  $resaltar="";
  $detalle0 = '<div id="'.$i.'" class=""><div class="panel-body">';
  $detalle  = substr($d, strpos($d, "}[")+1, strlen($d));
  $detalle = json_decode($detalle, true);
  $detalle1 = "";
  foreach ($detalle as $lineadetalle) {
    $detalle1 .= '<div style = "border-top: 5px solid lightgray;padding: 10px; width: 100%;"><p style="font-size:75%;text-align:left;padding:0">'.$trmncreadopor .' '. $lineadetalle["USUARIOGENERADO"] . ' ' . $trmnfechacreado . ' ' . $lineadetalle["FECHAGENERADO"] . ' ' . $trmnhoracreado . ' ' . $lineadetalle["HORAGENERADO"] .'</p><p style="text-align:justify">'.str_ireplace($resaltar, '<mark>'.$resaltar.'</mark>', $lineadetalle["DESCRIPCIONDETALLE"]).'</p></div>';
  }

  $detalle2 = "</div></div>";

  $detallef = $detalle0.$detalle1.$detalle2;

          $htmlContent2 .= $header.$middle.$detallef.$footer;
          $i++;
  }


    $htmlContent = $htmlContent1.$htmlContent2.$htmlContent3;

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    $headers .= 'Cc: '.$c2.'' . "\r\n";

    // Send email
    if(mail($to,$subject,$htmlContent,$headers)):
        $msg = "<div class='alert alert-success'><p><strong>¡Las minutas fueron enviadas éxitosamente a tu correo!</strong></p></div>";
        return $msg;
    else:
        $msg = "<div class='alert alert-danger'><p><strong>Hubo un Error</strong> al enviar el Correo.<br></p>.</div>";
        return $msg;
    endif;

    //return $htmlContent;

}
?>
