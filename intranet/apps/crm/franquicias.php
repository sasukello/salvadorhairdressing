<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (isset($_POST['tipof'])) {
	    $accion = $_POST['tipof'];
	    switch ($accion) {
		    case 'fq1':
		    	$consulta = "Listado de Solicitudes Pendientes";
		    	echo cargarFranquiciados($accion, $consulta);

		    break;

		    case 'fq2':
		    	$consulta = "Listado de Solicitudes Activas";
		    	echo cargarFranquiciados($accion, $consulta);

		    break;
	    
		    case 'fq3':
		    	$consulta = "Listado de Solicitudes Finalizadas";
		    	echo cargarFranquiciados($accion, $consulta);

		    break;

		    case 'fq4':
		    	$consulta = "Listado de Solicitudes Rechazadas";
		    	echo cargarFranquiciados($accion, $consulta);

		    break;

		    case 'fq01':
		    	$consulta = "Listado de Solicitudes";
		    	echo cargarFranquiciados($accion, $consulta);

		    break;

		    case 'f1':
	    		$id = $_POST['idfq'];
		    	echo cargarInfoFranq($id);

		    break;

		    case 'q1':
	    		$idf = $_POST['idfq'];
		    	echo cargarCuestFranq($idf);

		    break;

		    case 'r1':
		    	$idf = $_POST['idfq'];
		    	echo cargarFormAdicional($idf);
		    	break;

		    break;

	    }
    }
}

function cargarFranquiciados($accion, $consulta){
	include "../../sec/seguro.php";
    $miresultado = consultFranquiciados($accion);
    echo "<h3>Reporte de Clientes con ClientCard:</h3>
        <p><b>Consulta:</b> <label style= 'color:#d34a4a'>".$consulta."</label></p>
        <p><div class='dataTables_wrapper form-inline dt-bootstrap'>
        <table id='franq' class='table table-striped table-bordered dt-responsive nowrap'>
            <thead>
              <tr>
                <th>Franquiciado</th>
                <th>Nombre</th>
                <th>Pais</th>
                <th>Ciudad</th>
                <th>Celular</th>
              </tr>
            </thead>
        <tbody>";
    foreach($miresultado as $mr){
        echo $mr;
    }
    echo "</tbody></table></div></p>";
    return;
}

function consultFranquiciados($accion){    /* CONSULTAR LISTADOS DE CLIENTES EN SALÓN */
	include "../../sec/libcon.php";
	$dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    switch ($accion) {
    	case 'fq1':
    		$sql = "SELECT idform, respuestas FROM `web_franquicias_forms` WHERE status=0";
    		break;

    	case 'fq2':
    		$sql = "SELECT idform, respuestas FROM `web_franquicias_forms` WHERE status=1";
    		break;

    	case 'fq3':
    		$sql = "SELECT idform, respuestas FROM `web_franquicias_forms` WHERE status=2";
    		break;

    	case 'fq4':
    		$sql = "SELECT idform, respuestas FROM `web_franquicias_forms` WHERE status=3";
    		break;

    	case 'fq01':
    		$sql = "SELECT idform, respuestas FROM `web_franquicias_forms`";
    		break;
    	
    	default:
    		# code...
    		break;
    }

    $result = array();
    $i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
        	$id = json_decode($rw['idform']);
        	$newRespuesta = (array) json_decode($rw['respuestas'], true, 512, JSON_UNESCAPED_UNICODE);
            $result[$i] = "<tr><td>".tipoFranquicia($newRespuesta['tipo'])."</td><td><a href='#miniprompt' data-toggle='modal' data-tipo='f1' data-ui='".$id."' data-ei='0'>".$newRespuesta['nombre']." ".$newRespuesta['apellido']."</a></td><td>".$newRespuesta['pais']."</td><td>".$newRespuesta['ciudad']."</td><td style='text-align: center;'>".$newRespuesta['movil']."</td></tr>";
            $i++;
        }
    } else {
        $result = "<tr><td>No se encontró ningún resultado</td></tr>";
        
    }
    return $result;
}

function tipoFranquicia($tipo){
	switch ($tipo) {
		case 's1':
			$franquicia = 'Operador';
			return $franquicia;
			break;

		case 's2':
			$franquicia = 'Inversionista';
			return $franquicia;
			break;

		case 's3':
			$franquicia = 'Master';
			return $franquicia;
			break;

		case 's4':
			$franquicia = 'Con Unidad de Negocio';
			return $franquicia;
			break;

		case 's5':
			$franquicia = 'Flag Ship';
			return $franquicia;
			break;
		
		default:
			# code...
			break;
	}
}

function cargarInfoFranq($id){
	include "../../cms/library/common.php";

	$sql = "SELECT * FROM `web_franquicias_forms` WHERE idform=$id";
	$contenido = (array) json_decode(miBusquedaSQL($sql), true, 512, JSON_UNESCAPED_UNICODE);

	foreach ($contenido as $ct) {
		$contenido = (array) json_decode($ct['respuestas']);
		$idfranq = $ct['idform'];
	}

	$result = '<div class="row">
				  <div class="col-sm-12">
				  	<div class="list-group" id="datosper">
					  	<div class="form-group row list-group-item sel" style="background: #dcdcdc;">
						     <div class="col-sm-12"><b>Tipo de Franquiciado:</b> '.changeNum($contenido['tipo']).'</div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-8">
						       <div><b>Nombre:</b></div>
						       <div style="text-transform: capitalize;">'.$contenido['nombre'].' '.$contenido['apellido'].'</div>
						     </div>
						     <div class="col-sm-4">
						       <div><b>Identificación:</b></div>
						       <div>'.$contenido['ci'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-6">
						       <div><b>Fecha de Nacimiento:</b></div>
						       <div>'.$contenido['ffnn'].'</div>
						     </div>
						     <div class="col-sm-6">
						       <div><b>Pais:</b></div>
						       <div style="text-transform: capitalize;">'.$contenido['pais'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-6">
						       <div><b>Estado/Región:</b></div>
						       <div style="text-transform: capitalize;">'.$contenido['estado'].'</div>
						     </div>
						     <div class="col-sm-6">
						       <div><b>Ciudad:</b></div>
						       <div style="text-transform: capitalize;">'.$contenido['ciudad'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						       <div class="col-sm-12"><b>Teléfonos de Contacto:</b></div>
						       <div class="col-sm-4"><b>Hab.:</b><br> '.$contenido['telf'].' </div>
						       <div class="col-sm-4"><b>Móvil:</b><br> '.$contenido['movil'].'</div>
						       <div class="col-sm-4"><b>Ofic.:</b><br> '.$contenido['oficina'].'</div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>Correo Electrónico:</b></div>
						       <div>'.$contenido['correo'].'</div>
						     </div>
						</div>';
						if ($contenido['tipo'] !== 's5') {
							$result .= '<div class="col-sm-12 pt-10">
							   <div class="text-center">
							   		<button type="button" onclick="cargarPreguntas(\''.$idfranq.'\');" class="btn btn-default">Ver Solicitud</button>
							   		<button type="button" onclick="cargarRespuestas(\''.$idfranq.'\');" class="btn btn-default">Ver Segundo Formulario</button>
							   </div>
							</div>';
						}
				    $result .= '</div>
				  </div>
				</div>';

    return $result;
}

function cargarCuestFranq($id){
	include "../../cms/library/common.php";

	$sql = "SELECT respuestas FROM `web_franquicias_forms` WHERE idform=$id";
	$all = (array) json_decode(miBusquedaSQL($sql), true, 512, JSON_UNESCAPED_UNICODE);

	foreach ($all as $a) {
		$all = json_decode($a['respuestas'], true, 512, JSON_UNESCAPED_UNICODE);
		$tipofranq = $all['tipo'];
	}

	switch ($tipofranq) {
		case 's1':
			$result = '<div class="row">
				  <div class="col-sm-12">
				  	<div class="list-group" id="datosper">
					  	<div class="form-group row list-group-item sel" style="background: #dcdcdc;">
						     <div class="col-sm-12"><b>Encuesta:</b> Salvador Franquicias</div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Cómo supo de nosotros?</b></div>
						       <div>'.changeNum($all['quest1']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿En cuál país desea abrir su negocio?</b></div>
						       <div>'.$all['quest2'].'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Su cónyuge participará?</b></div>
						       <div>'.changeNum($all['quest3']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Está interesado en invertir solo o con un socio, cuantos? <small>Si la respuesta es si, indique cuantos.</small></b></div>
						       <div>'.changeNum($all['quest4']).'. '.$all['ansq4'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Cuánto estaría dispuesto a invertir en su unidad de negocio?</b></div>
						       <div>'.changeNum($all['quest5']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Es usted propietario de algún negocio o franquicia? <small>Si la respuesta es sí, por favor especifique el nombre.</small></b></div>
						       <div>'.changeNum($all['quest6']).'. '.$all['ansq6'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Conoce a algún franquiciado de Salvador? <small>Si la respuesta es sí, por favor indique el nombre.</small></b></div>
						       <div>'.changeNum($all['quest7']).'. '.$all['ansq7'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Estaría Ud. involucrado en la operación de franquicia? <small>Si la respuesta es sí, por favor escriba su nombre y apellido.</small></b></div>
						       <div>'.changeNum($all['quest8']).'. '.$all['ansq8'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Dedicación a tiempo completo?</b></div>
						       <div>'.changeNum($all['quest9']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿En cuánto tiempo quiere aperturar su negocio?</b></div>
						       <div>'.changeNum($all['quest10']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Cuenta con un lugar para la franquicia? <small>Si la respuesta es sí, por favor indique la dirección del local.</small></b></div>
						       <div>'.changeNum($all['quest11']).'. '.$all['ansq11'].'</div>
						     </div>
						</div>
						<div class="col-sm-12 pt-10">
							<div class="text-center">
							    <button type="button" onclick="goBackDatos();" class="btn btn-default">Volver</button>
							</div>
						</div>
				    </div>
				  </div>
				</div>';
			break;

		case 's2':
			$result = '<div class="row">
				  <div class="col-sm-12">
				  	<div class="list-group" id="datosper">
					  	<div class="form-group row list-group-item sel" style="background: #dcdcdc;">
						     <div class="col-sm-12"><b>Encuesta:</b> Salvador Franquicias</div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Cómo supo de nosotros?</b></div>
						       <div>'.changeNum($all['quest21']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿En cuál país desea abrir su negocio?</b></div>
						       <div>'.$all['quest22'].'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Está interesado en invertir solo o con un socio, cuantos? <small>Si la respuesta es si, indique cuantos.</small></b></div>
						       <div>'.changeNum($all['quest23']).'. '.$all['ansq23'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Cuánto estaría dispuesto a invertir en su unidad de negocio?</b></div>
						       <div>'.changeNum($all['quest24']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Es usted propietario de algún negocio o franquicia? <small>Si la respuesta es sí, por favor especifique el nombre.</small></b></div>
						       <div>'.changeNum($all['quest25']).'. '.$all['ansq25'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Conoce a algún franquiciado de Salvador? <small>Si la respuesta es sí, por favor indique el nombre.</small></b></div>
						       <div>'.changeNum($all['quest26']).'. '.$all['ansq26'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Estaría usted dispuesto al aprendizaje para el manejo de la franquicia?</b></div>
						       <div>'.changeNum($all['quest27']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Tiene personal considerado para llevar a cabo la operación? <small>Si la respuesta es sí, por favor especifique.</small></b></div>
						       <div>'.changeNum($all['quest28']).'. '.$all['ansq28'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿En cuánto tiempo quiere aperturar su negocio?</b></div>
						       <div>'.changeNum($all['quest29']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Está interesado en operar toda una región o país? <small>Si la respuesta es sí, por favor especifique.</small></b></div>
						       <div>'.changeNum($all['quest30']).'. '.$all['ansq30'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Cuenta con un lugar para la franquicia? <small>Si la respuesta es sí, por favor indique la dirección del local.</small></b></div>
						       <div>'.changeNum($all['quest31']).'. '.$all['ansq31'].'</div>
						     </div>
						</div>
						<div class="col-sm-12 pt-10">
							<div class="text-center">
							    <button type="button" onclick="goBackDatos();" class="btn btn-default">Volver</button>
							</div>
						</div>
				    </div>
				  </div>
				</div>';
			break;

		case 's3':
			$result = '<div class="row">
				  <div class="col-sm-12">
				  	<div class="list-group" id="datosper">
					  	<div class="form-group row list-group-item sel" style="background: #dcdcdc;">
						     <div class="col-sm-12"><b>Encuesta:</b> Salvador Franquicias</div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Cómo supo de nosotros?</b></div>
						       <div>'.changeNum($all['quest41']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿En qué zona, región o país desea desarrollar la marca?</b></div>
						       <div>'.$all['quest42'].'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Su cónyuge participará?</b></div>
						       <div>'.changeNum($all['quest43']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Está interesado en invertir solo o con un socio, cuantos? <small>Si la respuesta es si, indique cuantos.</small></b></div>
						       <div>'.changeNum($all['quest44']).'. '.$all['ansq44'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Tiene perfectamente conocimiento de lo que es un franquiciado Master?</b></div>
						       <div>'.changeNum($all['quest45']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Es usted propietario de algún negocio o franquicia? <small>Si la respuesta es sí, por favor especifique el nombre.</small></b></div>
						       <div>'.changeNum($all['quest46']).'. '.$all['ansq46'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Cuántas unidades puede abrir?</b></div>
						       <div>'.changeNum($all['quest47']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Tiene experiencia en el manejo de marcas? <small>Si la respuesta es sí, por favor especifique.</small></b></div>
						       <div>'.changeNum($all['quest48']).'. '.$all['ansq48'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Dedicación a tiempo completo?</b></div>
						       <div>'.changeNum($all['quest49']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Está interesado en operar toda una región o país? <small>Si la respuesta es sí, por favor especifique.</small></b></div>
						       <div>'.changeNum($all['quest50']).'. '.$all['ansq50'].'</div>
						     </div>
						</div>
						<div class="col-sm-12 pt-10">
							<div class="text-center">
							    <button type="button" onclick="goBackDatos();" class="btn btn-default">Volver</button>
							</div>
						</div>
				    </div>
				  </div>
				</div>';
			break;

		case 's4':
			$result = '<div class="row">
				  <div class="col-sm-12">
				  	<div class="list-group" id="datosper">
					  	<div class="form-group row list-group-item sel" style="background: #dcdcdc;">
						     <div class="col-sm-12"><b>Encuesta:</b> Salvador Franquicias</div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Cómo supo de nosotros?</b></div>
						       <div>'.changeNum($all['quest61']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿En cuál país trabaja o tiene establecido su unidad de negocio?</b></div>
						       <div>'.$all['quest62'].'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Su cónyuge participará?</b></div>
						       <div>'.changeNum($all['quest63']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Está interesado en invertir solo o con un socio, cuantos? <small>Si la respuesta es si, indique cuantos.</small></b></div>
						       <div>'.changeNum($all['quest64']).'. '.$all['ansq64'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Cuánto estaría dispuesto a invertir en su unidad de negocio?</b></div>
						       <div>'.changeNum($all['quest65']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Tiene usted conocimiento de operaciones con franquicias?</b></div>
						       <div>'.changeNum($all['quest66']).'.</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Conoce a algún franquiciado de Salvador? <small>Si la respuesta es sí, por favor indique el nombre del franquiciado.</small></b></div>
						       <div>'.changeNum($all['quest67']).'. '.$all['ansq67'].'</div>
						     </div>
						</div>
						<div class="form-group row list-group-item sel">
						     <div class="col-sm-12">
						       <div><b>¿Dedicación a tiempo completo?</b></div>
						       <div>'.changeNum($all['quest68']).'.</div>
						     </div>
						</div>
						<div class="col-sm-12 pt-10">
							<div class="text-center">
							    <button type="button" onclick="goBackDatos();" class="btn btn-default">Volver</button>
							</div>
						</div>
				    </div>
				  </div>
				</div>';
			break;
		
		default:
			# code...
			break;
	}

	return $result;
}

function cargarFormAdicional($idf){
	include "../../cms/library/common.php";

	$sql = "SELECT respuestas2 FROM `web_franquicias_forms` WHERE idform=$id";
	$all = (array) json_decode(miBusquedaSQL($sql), true, 512, JSON_UNESCAPED_UNICODE);
	$i=0;
	foreach ($all as $a) {
		$all = json_decode($a['respuestas2'], true, 512, JSON_UNESCAPED_UNICODE);
		$tipofranq = $all['tipo'];
		echo $i++;
	}

	return;
}

function changeNum($valor){
    switch ($valor) {
      case 's1':
        return 'Franquiciado Operador';
        break;
      case 's2':
        return 'Franquiciado Inversionista';
        break;
      case 's3':
        return 'Franquiciado Master';
        break;
      case 's4':
        return 'Franquiciado con Unidad de Negocio';
        break;
      case 's5':
        return 'Franquiciado Flag Ship';
        break;
      case 'opt-1':
        return 'Soy Cliente';
        break;
      case 'opt-2':
        return 'Por un amigo';
        break;
      case 'opt-3':
        return 'Página web';
        break;
      case 'opt-4':
        return 'Buscador';
        break;
      case 'opt-5':
        return 'Otros';
        break;
      case '1':
      case '3':
      case '5':
      case '7':
      case '9':
      case '11':
      case '13':
      case '21':
      case '23':
      case '25':
      case '27':
      case '29':
      case '31':
      case '33':
      case '41':
      case '43':
      case '45':
      case '47':
      case '49':
      case '51':
      case '53':
      case '61':
      case '63':
      case '65':
      case '67':
      case '69':
        return 'Si';
        break;
      case '2':
      case '4':
      case '6':
      case '8':
      case '10':
      case '12':
      case '14':
      case '22':
      case '24':
      case '26':
      case '28':
      case '30':
      case '32':
      case '34':
      case '42':
      case '44':
      case '46':
      case '48':
      case '50':
      case '52':
      case '54':
      case '62':
      case '64':
      case '66':
      case '68':
      case '70':
        return 'No';
        break;
      /*case '3':
        return 'Si';
        break;
      case '4':
        return 'No';
        break;*/
      case 'opt-6':
        return '$ 0 - 100.000,00';
        break;
      case 'opt-7':
        return '$ 100.001,00 - 200.000,00';
        break;
      case 'opt-8':
        return '$ 200.001,00 - más';
        break;
      case 'opt-9':
        return '3 meses';
        break;
      case 'opt-10':
        return '5 meses';
        break;
      case 'opt-11':
        return '1 año';
        break;

      default:
        # code...
        break;
    }
}

?>