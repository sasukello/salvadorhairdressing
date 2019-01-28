<?php

	require('funciones.php');
	require('libcon.php');

	function getCategoriasFAQ(){
		$result = array();
		$sql = "SELECT id, value, llave FROM web_franquicias_meta WHERE meta = 'CATEGORIA' ORDER BY (id) ASC;";
		$result = (array)json_decode(miBusquedaSQL($sql), true);

		return $result;
	}

	function armarCategoriasFAQ(){
		$result = getCategoriasFAQ();
		$lista="";
		foreach ($result as $r) {
			$lista .= '<li><a href="#'.$r["id"].'">'.strtoupper($r["value"]).'</a></li>';
		}
		return $lista;
	}

	function getMainContent($categoria){
		//armar seccion de cada categoria recibida
		$result = array();
		$sql = "SELECT titulo, contenido, categoria FROM web_franquicias_faq WHERE categoria = $categoria ORDER BY (orden) ASC ;";
		$result = (array)json_decode(miBusquedaSQL($sql), true);

		return $result;
	}

	function armarMainContent(){
		$categoria = getCategoriasFAQ();
		$body="";
		foreach ($categoria as $cat) {
			$contenido = getMainContent($cat["id"]);
			if($contenido[0] == "0"){
				continue;
			} else{
				$body .= '<ul id="'.$cat["id"].'" class="cd-faq-group">
						<li class="cd-faq-title"><h2>'.$cat["value"].'</h2>';

			foreach ($contenido as $content) {
				$body .= '<a class="cd-faq-trigger" href="#0">'.$content["titulo"].'</a>
				<div class="cd-faq-content">
					<p>'.$content["contenido"].'</p>
				</div>';
			}
			$body .="</li></ul>";
			}
			
		}
		return $body;
	}
?>