<?php

error_log(1);
error_reporting(1);

function checkEnc($userid){

	$user = base64_decode($userid);

	$sqlinit = "SELECT id, titulo, descripcion, activaasignar FROM intranet_encuestas WHERE activaasignar = 1;";
	$resultinit = (array) json_decode(miBusquedaSQL($sqlinit),true);
	$ret=$ret2="";
	if($resultinit[0] == "0"){ // no hay resultados
		$ret = "<p>No hay encuestas disponibles por asignar.</p>";
	} else{ // si hay resultados
		foreach ($resultinit as $re) {
			$ret .= "<ul><li><a data-toggle='modal' data-ui='".$userid."' data-tipo='2' data-ei='".$re["id"]."' href='#miniprompt'>Asignar: ".ucwords($re["titulo"])."</a></li></ul>";
		}
	}

	$sql = "SELECT A.idencuesta, A.idusuario, B.titulo, B.descripcion FROM intranet_encuestas_user A INNER JOIN intranet_encuestas B ON A.idencuesta = B.id WHERE idusuario = '".$user."';";
	$result = (array) json_decode(miBusquedaSQL($sql),true);

	if($result[0] == "0"){ // no hay resultados
		$ret2 = "<p>No hay encuestas por responder actualmente.</p>";
	} else{ // si hay resultados
		foreach ($result as $r) {
			$ret2 .= "<ul><li><a data-toggle='modal' data-ui='".$userid."' data-tipo='1' data-ei='".$r["idencuesta"]."' href='#miniprompt'>".$r["titulo"]."</a></li></ul>";
		}
	}

	$ret3 = "<ul><li><a data-toggle='modal' data-ui='".$userid."' data-tipo='3' data-ei='1' href='#miniprompt'>ENCUESTA DE SATISFACCIÓN DEL FRANQUICIADO</a></li></ul>";

	$arreglo = array ( $ret, $ret2, $ret3 );
	
  	return json_encode($arreglo);
}

function checkEncDesc($formid){

	$sql = "SELECT id, titulo, descripcion, preguntas FROM intranet_encuestas WHERE id = ".$formid;
	$result = miBusquedaSQL($sql);	

	if($result == '["0"]'){ // no hay resultados
		echo "<p>Hubo un erorr al cargar la información de esta encuesta.</p>";
	} else{ // si hay resultados
		echo $result;
	}
	return;
}

function getEncResp($formid, $paso){
	if ($paso == 1) {
		$sql = "SELECT A.idresp, A.idenc, A.iduser, A.respuestas, B.titulo, B.preguntas FROM intranet_encuestas_respuestas A INNER JOIN intranet_encuestas B ON A.idenc = B.id WHERE A.idresp = $formid";
		$result = (array) json_decode(miBusquedaSQL($sql),true);	

		if($result == '["0"]'){ // no hay resultados
			echo "<p>Hubo un erorr al cargar la información de esta encuesta.</p>";
		} else{ // si hay resultados
			$preguntas = (array) json_decode($result[0]["preguntas"], true);
			$respuestas = (array) json_decode($result[0]["respuestas"], true);

			$cantidad = count($preguntas[0]);
			$i=0;$tabla='<table class="table table-bordered">
						    <thead>
						      <tr>
						        <th>Pregunta</th>
						        <th>Resp.</th>
						        <th>Comentario</th>
						      </tr>
						    </thead>
						    <tbody>';

			while ($i < $cantidad) {
				$tabla .= '<tr>
							<td>'.$preguntas[0][$i].'</td>
						    <td>'.translate($respuestas["P$i"]).'</td>
						    <td>'.$respuestas["C$i"].'</td>
						   </tr>';
				$i++;
			}
			$tabla .= '</tbody></table>';
			echo $tabla;
		}
	} else if ($paso == 2){
		$sql = "SELECT idresp, iduser FROM intranet_encuestas_respuestas WHERE idenc = $formid";
		$result = (array) json_decode(miBusquedaSQL($sql),true);
		$usuarios = "<ul><strong>Encuesta Respondida por:</strong><br>";
		foreach ($result as $res) {
			$usuarios .= "<li><a href='#' onclick='loadEncuestasCRM(".$res["idresp"].",6);'>".$res["iduser"]."</a></li>";
		}
		$usuarios .= "</ul>";
		echo $usuarios;
	}

	return;
}

function translate($what){
	if($what == "1"){
		$thishere = "Si";
	} else if($what == "2"){
		$thishere = "No";
	}
	return $thishere;
}

function encuestaInit($id, $user){

	$sql = "SELECT idenc, iduser FROM intranet_encuestas_respuestas WHERE idenc = $id and iduser = '".$user."'";
	$uno = miBusquedaSQL($sql);
	$action = "";

	($uno == '["0"]') ? getEncuesta($id, $user) : $action = "Ya respondiste esta encuesta.";

	return $action;

//	$sql = "SELECT A.id, A.titulo, A.descripcion, A.preguntas, B.idusuario, C FROM intranet_encuestas A INNER JOIN intranet_encuestas_user B ON A.id = B.idencuesta LEFT JOIN intranet_encuestas_respuestas C ON A.id = C.idenc WHERE ";


}

function getEncuesta($id, $user){

	$sql = "SELECT A.id, A.titulo, A.descripcion, A.preguntas, B.idusuario FROM intranet_encuestas A INNER JOIN intranet_encuestas_user B ON A.id = B.idencuesta WHERE A.id = $id AND B.idusuario = '".$user."';";

	$uno = miBusquedaSQL($sql);


	if($uno == '["0"]'){
		echo "Hubo un error al cargar la Encuesta.";
	} else{
		$resultados = (array) json_decode($uno, true);
		$preguntas = json_decode($resultados[0]["preguntas"], true);
		//var_dump($resultados);
		$i=0;

	echo '<form name="formfranq" method="post">
	<table class="table">
    <thead><tr>
        <input name="idpv" value="3" type="hidden">
        <input name="idvisita" value="45" type="hidden">
        <th class="col-sm-6">Pregunta</th>
        <th class="col-sm-1">Opciones</th>
        <th class="col-sm-3">Observaciones<br>(Favor sea lo más conciso posible):</th>
      </tr>
      </thead>
      <tbody>
      ';
      	
    foreach ($preguntas[0] as $preg) {
		echo '<tr>
			<td class="danger text-justify bordewhite"><h6 class="padquestion">'.$preg.'</h6></td>
            <td><label class="radio-inline"><input name="P'.$i.'" value="1" required="" type="radio">Si</label><label class="radio-inline"><input name="P'.$i.'" value="2" type="radio">No</label></td>
          	<td><div class="form-group"><textarea class="form-control" rows="1" id="comment" resize="no" name="C'.$i.'"></textarea></div></td>
          	</tr>';
          	$i++;

			//echo "Pregunta: ".$preg."<br><br>";
		}

      echo '</tbody></table><input class="btn-default" id="botonuno" name="enviarFormFranq" value="Enviar Respuestas" type="submit"></form>';

	}

	return;
}

function saveEncuestaResult($codigo, $idencuesta, $iduser){
	$sql = "INSERT INTO intranet_encuestas_respuestas (idenc, iduser, respuestas) VALUES (".$idencuesta.", '".$iduser."', '".$codigo."');";

	//echo $sql;

	$uno = miActionSQL($sql);
	if($uno == 1 || $uno == "1"){
		sendEncuestaResult($iduser, $idencuesta);
		$msg = '<div class="alert alert-success"><strong>¡Respuestas almacenadas satisfactoriamente!</strong> Gracias por su aporte.</div>';
	} else{
		$msg = '<div class="alert alert-warning"><strong>Hubo un error al guardar sus comentarios.</strong> Por favor, intente de nuevo. Error: '.$uno.'</div>';
	}

	return $msg;
}

function asignarUsers1($user, $idencuesta){


	

    if(file_exists('../componentes/data.json'))  
   	{
        $current_data = file_get_contents('../componentes/data.json');  
        $array_data = json_decode($current_data, true);  
        $extra = array(  
             'userName' => "Este es el usuario de prueba",  
             'fullname' => "Este es el nombre completo de prueba"  
        );
        $array_data[] = $extra;  
        $final_data = json_encode($array_data);  
        if(file_put_contents('../componentes/data.json', $final_data))  
        {
             $message = "<label class='text-success'>File Appended Success fully</p>";  
        }
   	} else {
        $error = 'JSON File not exits';  
   	}


	$sql1 = "SELECT * FROM intranet_encuestas_user WHERE idencuesta = $idencuesta;";

	$res1 = (array) json_decode(miBusquedaSQL($sql1), true);

	$ret1 = '<p><strong>Usuarios Asignados</strong>: ';

	if($res1[0] == "0"){ // no hay resultados
		$ret1 .= ' <span class="badge badge-warning">Ninguno</span> ';
	} else{ // si hay resultados
		foreach ($res1 as $re) {
			$ret1 .= ' <span id="user'.$re["idusuario"].'" class="badge badge-success">'.$re["idusuario"].'</span> ';
		}
	}
	$ret1 .= "</p><p><span id='newUserA'></span></p>";

	$ret2 =	'<div class="form-group row">
        <label for="testNoBtn" class="col-sm-2 col-form-label">Usuario:</label>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control" id="testNoBtn">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                        </ul>
                    </div>
                </div>
            </div>
        </div>';


	//echo "U: ".$user." - E: ".$idencuesta;
	return $ret1." ".$ret2;
}

function asignarUsers2($data, $user){

	//$userid = base64_decode($data["user"]);
	$formuid = $data["form"];
	$sql1 = "INSERT INTO intranet_encuestas_user (idencuesta, idusuario) VALUES (".$formuid.", '".$user."');";

	$res1 = miActionSQL($sql1);

	echo $res1;


	return;
}

class Car {
    function Car() {
        $this->model = "VW";
    }
}

function sendEncuestaResult($iduser, $idencuesta){

	$to = "programacion@salvadorhairdressing.com"; // this is your Email address

    $subject = "Salvador Intranet - Encuesta respondida por: " .$iduser;

    $plantilla = file_get_contents("../../componentes/plantillas/encuesta.html");

    $encuesta = searchNombreEncuesta($idencuesta);

    $plantilla = str_replace("%encuesta%",$encuesta,$plantilla);
    $plantilla = str_replace("%user%",$iduser,$plantilla);

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    $headers .= 'Bcc: programacion@salvadorhairdressing.com, e.colmenares@salvadorhairdressing.com';
    mail($to,$subject,$plantilla,$headers);
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    // You cannot use header and echo together. It's one or the other.

}

function searchNombreEncuesta($valor){

	$sql = "SELECT titulo FROM intranet_encuestas WHERE id = ".$valor."";
	$uno = (array)json_decode(miBusquedaSQL($sql), true);
	$titulo = '';

	if($uno[0] == '["0"]'){ // no hay resultados
		$titulo = 'No disponible';
	} else{ // si hay resultados
		$titulo = $uno[0]['titulo'];
	}
	return $titulo;

}

?>


