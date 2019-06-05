<?php

function sendEmailContactToDep($datos) {

    $datosArray = get_object_vars(json_decode($datos));

    $nombre = $datosArray['name'];
    $apellido = $datosArray['lastname'];
    $phone = $datosArray['phone'];
    $email = $datosArray['email'];
    $asociado = $datosArray['asociado'];
    $date = $datosArray['date'];
    $country = nombrePaises(base64_decode($datosArray['country']));
    $salon = base64_decode($datosArray['salon']);
    $q1 = changeNumToAns($datosArray['group1']);
    $q2 = changeNumToAns($datosArray['group2']);
    $q4 = changeNumToAns($datosArray['group4']);
    $comments = $datosArray['comments'];

    $rdobtn = $_POST['group3'];
    $rdo = '';
    list($ids, $nombres) = explode(';', $salon);

    foreach($rdobtn as $val){
      $rdo .= changeNumToAns($val).'. ';
    }

    $to = "rrpp@salvadorhairdressing.com"; // this is your Email address
    $subject = "Salvador Hairdressing App - Nueva Cita";

    $subject = "Contáctanos [".$nombre ." ".$apellido."] - Salvador Hairdressing";
    $message = $nombre . " " . $apellido . "ha escrito un nuevo mensaje de contacto.";

    $plantilla = file_get_contents("../c/mails/correocontact.html");

    $plantilla = str_replace("%nombre%",$nombre,$plantilla);
    $plantilla = str_replace("%apellido%",$apellido,$plantilla);
    $plantilla = str_replace("%phone%",$phone,$plantilla);
    $plantilla = str_replace("%email%",$email,$plantilla);
    $plantilla = str_replace("%asociado%",$asociado,$plantilla);
    $plantilla = str_replace("%date%",$date,$plantilla);
    $plantilla = str_replace("%country%",$country,$plantilla);
    $plantilla = str_replace("%salon%",$nombres,$plantilla);
    $plantilla = str_replace("%q1%",$q1,$plantilla);
    $plantilla = str_replace("%q2%",$q2,$plantilla);
    $plantilla = str_replace("%q3%",$rdo,$plantilla);
    $plantilla = str_replace("%q4%",$q4,$plantilla);
    $plantilla = str_replace("%comments%",$comments,$plantilla);

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    $headers .= 'Bcc: sistemas@salvadorhairdressing.com, programacion@salvadorhairdressing.com';

    $enviar = mail($to,$subject,$plantilla,$headers);
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    // You cannot use header and echo together. It's one or the other.

    if ($enviar == true) {
    	$respuesta = 1;
    } else {
    	$respuesta = 0;
    }

    return $respuesta;

}

function sendEmailFranqToDep($datos){

    $datosArray = $datos;

    $tipo = changeNum($datosArray['tipo']);
    $ci = $datosArray['ci'];
    $nombre = $datosArray['nombre'];
    $apellido = $datosArray['apellido'];
    $ffnn = $datosArray['ffnn'];
    $direccion = $datosArray['direccion'];
    $pais = $datosArray['pais'];
    $estado = $datosArray['estado'];
    $ciudad = $datosArray['ciudad'];
    $telf = $datosArray['telf'];
    $oficina = $datosArray['oficina'];
    $movil = $datosArray['movil'];
    $correo = $datosArray['correo'];
    $nivel = $datosArray['nivel'];

    /* Origen del Formulario */
    $origen = $datosArray['tipo'];

    switch ($origen) {
        case 's1':

            /* Preguntas Plantilla Correo */
            $pregunta1 = '¿Cómo supo de nosotros?';
            $pregunta2 = '¿En cuál país desea abrir su negocio?';
            $pregunta3 = '¿Su cónyuge participará?';
            $pregunta4 = '¿Está interesado en invertir solo o con un socio, cuantos? Si la respuesta es si, indique cuantos';
            $pregunta5 = '¿Cuánto estaría dispuesto a invertir en su unidad de negocio?';
            $pregunta6 = '¿Es usted propietario de algún negocio o franquicia? Si la respuesta es sí, por favor especifique el nombre.';
            $pregunta7 = '¿Conoce a algún franquiciado de Salvador? Si la respuesta es sí, por favor indique el nombre.';
            $pregunta8 = '¿Estaría Ud. involucrado en la operación de franquicia? Si la respuesta es sí, por favor escriba su nombre y apellido.';
            $pregunta9 = '¿Dedicación a tiempo completo?';
            $pregunta10 = '¿En cuánto tiempo quiere aperturar su negocio?';
            $pregunta11 = '¿Cuenta con un lugar para la franquicia? Si la respuesta es sí, por favor indique la dirección del local.';
            $ansq4 = '';
            $ansq6 = '';
            $ansq7 = '';
            $ansq8 = '';
            $ansq11 = '';

            /* Datos Enviados en Formulario - variable - */
            if (array_key_exists('ansq4', $datosArray)) {
                $ansq4 = $datosArray['ansq4'];
            } if (array_key_exists('ansq6', $datosArray)) {
                $ansq6 = $datosArray['ansq6'];
            } if (array_key_exists('ansq7', $datosArray)){
                $ansq7 = $datosArray['ansq7'];
            } if (array_key_exists('ansq8', $datosArray)){
                $ansq8 = $datosArray['ansq8'];
            } if (array_key_exists('ansq11', $datosArray)){
                $ansq11 = $datosArray['ansq11'];
            } 

            /* Datos Enviados en Formulario */
            $resp1 = changeNum($datosArray['quest1']);
            $resp2 = $datosArray['quest2'];
            $resp3 = changeNum($datosArray['quest3']);
            $resp4 = changeNum($datosArray['quest4']). '. ' .$ansq4;
            $resp5 = changeNum($datosArray['quest5']);
            $resp6 = changeNum($datosArray['quest6']). '. ' .$ansq6;
            $resp7 = changeNum($datosArray['quest7']). '. ' .$ansq7;
            $resp8 = changeNum($datosArray['quest8']). '. ' .$ansq8;
            $resp9 = changeNum($datosArray['quest9']);
            $resp10 = changeNum($datosArray['quest10']);
            $resp11 = changeNum($datosArray['quest11']). '. ' .$ansq11;

            break;
        case 's2':
           
            /* Preguntas Plantilla Correo */
            $pregunta1 = '¿Cómo supo de nosotros?';
            $pregunta2 = '¿En cuál país desea abrir su negocio?';
            $pregunta3 = '¿Está interesado en invertir solo o con un socio, cuantos? Si la respuesta es si, indique cuantos. ';
            $pregunta4 = '¿Cuánto estaría dispuesto a invertir en su unidad de negocio?';
            $pregunta5 = '¿Es usted propietario de algún negocio o franquicia? Si la respuesta es sí, por favor especifique el nombre.';
            $pregunta6 = '¿Conoce a algún franquiciado de Salvador? Si la respuesta es sí, por favor indique el nombre.';
            $pregunta7 = '¿Estaría usted dispuesto al aprendizaje para el manejo de la franquicia?';
            $pregunta8 = '¿Tiene personal considerado para llevar a cabo la operación? Si la respuesta es sí, por favor especifique.';
            $pregunta9 = '¿En cuánto tiempo quiere aperturar su negocio?';
            $pregunta10 = '¿Está interesado en operar toda una región o país? Si la respuesta es sí, por favor especifique.';
            $pregunta11 = '¿Cuenta con un lugar para la franquicia? Si la respuesta es sí, por favor indique la dirección del local.';
            $ansq23 = '';
            $ansq25 = '';
            $ansq26 = '';
            $ansq28 = '';
            $ansq30 = '';
            $ansq31 = '';

            /* Datos Enviados en Formulario - variable - */
            if (array_key_exists('ansq23', $datosArray)) {
                $ansq23 = $datosArray['ansq23'];
            } if (array_key_exists('ansq25', $datosArray)) {
                $ansq25 = $datosArray['ansq25'];
            } if (array_key_exists('ansq26', $datosArray)){
                $ansq26 = $datosArray['ansq26'];
            } if (array_key_exists('ansq28', $datosArray)){
                $ansq28 = $datosArray['ansq28'];
            } if (array_key_exists('ansq30', $datosArray)){
                $ansq30 = $datosArray['ansq30'];
            } if (array_key_exists('ansq31', $datosArray)){
                $ansq31 = $datosArray['ansq31'];
            }

            /* Datos Enviados en Formulario */
            $resp1 = changeNum($datosArray['quest21']);
            $resp2 = $datosArray['quest22'];
            $resp3 = changeNum($datosArray['quest23']). '. ' .$ansq23;
            $resp4 = changeNum($datosArray['quest24']);
            $resp5 = changeNum($datosArray['quest25']). '. ' .$ansq25;
            $resp6 = changeNum($datosArray['quest26']). '. ' .$ansq26;
            $resp7 = changeNum($datosArray['quest27']);
            $resp8 = changeNum($datosArray['quest28']). '. ' .$ansq28;
            $resp9 = changeNum($datosArray['quest29']);
            $resp10 = changeNum($datosArray['quest30']). '. ' .$ansq30;
            $resp11 = changeNum($datosArray['quest31']). '. ' .$ansq31;

            break;
        case 's3':
            
            /* Preguntas Plantilla Correo */
            $pregunta1 = '¿Cómo supo de nosotros?';
            $pregunta2 = '¿En qué zona, región o país desea desarrollar la marca?';
            $pregunta3 = '¿Su cónyuge participará?';
            $pregunta4 = '¿Está interesado en invertir solo o con un socio, cuantos? Si la respuesta es si, indique cuantos. ';
            $pregunta5 = '¿Tiene perfectamente conocimiento de lo que es un franquiciado Master?';
            $pregunta6 = '¿Es usted propietario de algún negocio o franquicia? Si la respuesta es sí, por favor especifique el nombre.';
            $pregunta7 = '¿Cuántas unidades puede abrir?';
            $pregunta8 = '¿Tiene experiencia en el manejo de marcas? Si la respuesta es sí, por favor especifique.';
            $pregunta9 = '¿Dedicación a tiempo completo?';
            $pregunta10 = '¿Está interesado en operar toda una región o país? Si la respuesta es sí, por favor especifique.';
            $pregunta11 = '';
            $ansq44 = '';
            $ansq46 = '';
            $ansq48 = '';
            $ansq50 = '';

            /* Datos Enviados en Formulario - variable - */
            if (array_key_exists('ansq44', $datosArray)) {
                $ansq44 = $datosArray['ansq44'];
            } if (array_key_exists('ansq46', $datosArray)) {
                $ansq46 = $datosArray['ansq46'];
            } if (array_key_exists('ansq48', $datosArray)){
                $ansq48 = $datosArray['ansq48'];
            } if (array_key_exists('ansq50', $datosArray)){
                $ansq50 = $datosArray['ansq50'];
            }

            /* Datos Enviados en Formulario */
            $resp1 = changeNum($datosArray['quest41']);
            $resp2 = $datosArray['quest42'];
            $resp3 = changeNum($datosArray['quest43']);
            $resp4 = changeNum($datosArray['quest44']). '. ' .$ansq44;
            $resp5 = changeNum($datosArray['quest45']);
            $resp6 = changeNum($datosArray['quest46']). '. ' .$ansq46;
            $resp7 = changeNum($datosArray['quest47']);
            $resp8 = changeNum($datosArray['quest48']). '. ' .$ansq48;
            $resp9 = changeNum($datosArray['quest49']);
            $resp10 = changeNum($datosArray['quest50']). '. ' .$ansq50;
            $resp11 = '';

            break;
        case 's4':
            
            /* Preguntas Plantilla Correo */
            $pregunta1 = '¿Cómo supo de nosotros?';
            $pregunta2 = '¿En cuál país trabaja o tiene establecido su unidad de negocio?';
            $pregunta3 = '¿Su cónyuge participará?';
            $pregunta4 = '¿Está interesado en invertir solo o con un socio, cuantos? Si la respuesta es si, indique cuantos. ';
            $pregunta5 = '¿Cuánto estaría dispuesto a invertir en su unidad de negocio?';
            $pregunta6 = '¿Tiene usted conocimiento de operaciones con franquicias?';
            $pregunta7 = '¿Conoce a algún franquiciado de Salvador? Si la respuesta es sí, por favor indique el nombre del franquiciado. ';
            $pregunta8 = '¿Dedicación a tiempo completo?';
            $pregunta9 = '';
            $pregunta10 = '';
            $pregunta11 = '';
            $ansq64 = '';
            $ansq67 = '';

            /* Datos Enviados en Formulario - variable - */
            if (array_key_exists('ansq64', $datosArray)) {
                $ansq64 = $datosArray['ansq64'];
            } if (array_key_exists('ansq67', $datosArray)) {
                $ansq67 = $datosArray['ansq67'];
            } 

            /* Datos Enviados en Formulario */
            $resp1 = changeNum($datosArray['quest61']);
            $resp2 = $datosArray['quest62'];
            $resp3 = changeNum($datosArray['quest63']);
            $resp4 = changeNum($datosArray['quest64']). '. ' .$ansq64;
            $resp5 = changeNum($datosArray['quest65']);
            $resp6 = changeNum($datosArray['quest66']);
            $resp7 = changeNum($datosArray['quest67']). '. ' .$ansq67;
            $resp8 = changeNum($datosArray['quest68']);
            $resp9 = '';
            $resp10 = '';
            $resp11 = '';

            break;
        case 's5':

            /* Preguntas Plantilla Correo */
            $pregunta1 = 'Tipo de Franquicia: Flag Ship';
            $pregunta2 = '';
            $pregunta3 = '';
            $pregunta4 = '';
            $pregunta5 = '';
            $pregunta6 = '';
            $pregunta7 = '';
            $pregunta8 = '';
            $pregunta9 = '';
            $pregunta10 = '';
            $pregunta11 = '';

            /* Datos Enviados en Formulario */
            $resp1 = 'Es cuando se tiene un negocio salón de belleza ya existente y quieres adquirir los derechos de conocimiento (know how) para el funcionamiento de la unidad de negocio.';
            $resp2 = '';
            $resp3 = '';
            $resp4 = '';
            $resp5 = '';
            $resp6 = '';
            $resp7 = '';
            $resp8 = '';
            $resp9 = '';
            $resp10 = '';
            $resp11 = '';

            break;
        
        default:
            # code...
            break;
    }

    $to = "prog.web@salvadorhairdressing.com"; // this is your Email address
    //$subject = "Salvador Hairdressing App - Nueva Cita";

    $subject = "Nueva Solicitud de Franquicias - [".$nombre ." ".$apellido."]";
    $message = $nombre . " " . $apellido . " está interesado en Franquicias.";

    $plantilla = file_get_contents("../c/mails/correofranquicias.html");

    /* Reemplazo de datos básicos HTML */
    $plantilla = str_replace("%tipo%",$tipo,$plantilla);
    $plantilla = str_replace("%ci%",$ci,$plantilla);
    $plantilla = str_replace("%nombre%",$nombre,$plantilla);
    $plantilla = str_replace("%apellido%",$apellido,$plantilla);
    $plantilla = str_replace("%ffnn%",$ffnn,$plantilla);
    $plantilla = str_replace("%direccion%",$direccion,$plantilla);
    $plantilla = str_replace("%pais%",$pais,$plantilla);
    $plantilla = str_replace("%estado%",$estado,$plantilla);
    $plantilla = str_replace("%ciudad%",$ciudad,$plantilla);
    $plantilla = str_replace("%telf%",$telf,$plantilla);
    $plantilla = str_replace("%oficina%",$oficina,$plantilla);
    $plantilla = str_replace("%movil%",$movil,$plantilla);
    $plantilla = str_replace("%correo%",$correo,$plantilla);
    $plantilla = str_replace("%nivel%",$nivel,$plantilla);

    /* Reemplazo de preguntas HTML */
    $plantilla = str_replace("%pregunta1%",$pregunta1,$plantilla);
    $plantilla = str_replace("%pregunta2%",$pregunta2,$plantilla);
    $plantilla = str_replace("%pregunta3%",$pregunta3,$plantilla);
    $plantilla = str_replace("%pregunta4%",$pregunta4,$plantilla);
    $plantilla = str_replace("%pregunta5%",$pregunta5,$plantilla);
    $plantilla = str_replace("%pregunta6%",$pregunta6,$plantilla);
    $plantilla = str_replace("%pregunta7%",$pregunta7,$plantilla);
    $plantilla = str_replace("%pregunta8%",$pregunta8,$plantilla);
    $plantilla = str_replace("%pregunta9%",$pregunta9,$plantilla);
    $plantilla = str_replace("%pregunta10%",$pregunta10,$plantilla);
    $plantilla = str_replace("%pregunta11%",$pregunta11,$plantilla);

    /* Reemplazo de respuestas HTML */ 
    $plantilla = str_replace("%resp1%",$resp1,$plantilla);
    $plantilla = str_replace("%resp2%",$resp2,$plantilla);
    $plantilla = str_replace("%resp3%",$resp3,$plantilla);
    $plantilla = str_replace("%resp4%",$resp4,$plantilla);
    $plantilla = str_replace("%resp5%",$resp5,$plantilla);
    $plantilla = str_replace("%resp6%",$resp6,$plantilla);
    $plantilla = str_replace("%resp7%",$resp7,$plantilla);
    $plantilla = str_replace("%resp8%",$resp8,$plantilla);
    $plantilla = str_replace("%resp9%",$resp9,$plantilla);
    $plantilla = str_replace("%resp10%",$resp10,$plantilla);
    $plantilla = str_replace("%resp11%",$resp11,$plantilla);

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    $headers .= 'Bcc: programacion@salvadorhairdressing.com';

    $enviar = mail($to,$subject,$plantilla,$headers);
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    // You cannot use header and echo together. It's one or the other.

    if ($enviar == true) {
        $respuesta = 1;
    } else {
        $respuesta = 0;
    }

    return $respuesta;

}

?>