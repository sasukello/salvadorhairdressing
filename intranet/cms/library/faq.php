<?php
error_reporting(1);
function initFAQ(){
	  $html = file_get_contents("componentes/html/faq1.html");
	  $html = str_replace("%body%",'',$html);
	  return $html;
}

function bodyFAQ($paso, $datos){
	switch ($paso) {
		case 'faq2':
			$html = file_get_contents("componentes/html/faq2.html");
			$html = str_replace("%body%",'',$html);
	  		return $html;
			break;

		case 'faq2a':
			require 'common.php';

			$sql = "INSERT INTO web_franquicias_meta (meta, value) VALUES ('CATEGORIA', '".$datos."');";
			$guarda = miActionSQL($sql);
			$msg = "";
			if($guarda == 1){
				$msg = "1";
			} else{
				$msg = "0";
			}
			return $msg;
			break;

		case 'faq3':
		require 'common.php';
			$faqCat = getCategFAQ();
			$micat = "";
			foreach ($faqCat as $cat) {
				$micat .= "<option value='".$cat["id"]."'>".strtoupper($cat["value"])."</option>";
			}
			$html = file_get_contents("componentes/html/faq3.html");
			$html = str_replace("%body%",'',$html);
			$html = str_replace("%selectOpc%",$micat,$html);
	  		return $html;
			break;

		case 'faq3a':
			require 'common.php';
			//var_dump($datos);
			$sql = "INSERT INTO web_franquicias_faq (titulo, contenido, categoria, fecha_creado, hora_creado) VALUES ('".$datos[0]."', '".$datos[1]."', '".$datos[2]."', CURDATE(), CURTIME());";
			$guarda = miActionSQL($sql);
			$msg = "";
			if($guarda == 1){
				$msg = "1";
			} else{
				$msg = "0";
			}
			return $msg;
			break;
		
		default:
			# code...
			break;
	}
	return;
}

function getCategFAQ(){
	$result = array();
	$sql = "SELECT id, value, llave FROM web_franquicias_meta WHERE meta = 'CATEGORIA' ORDER BY (id) ASC;";
	$result = (array)json_decode(miBusquedaSQL($sql), true);

	return $result;
}



?>