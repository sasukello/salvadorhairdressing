<?
	function Xml_pais($ruta){
	$db = dbconn();
	$rs= mysql_query("select id,nombre from iweb_pais",$db);
	if(mysql_num_rows($rs)>0){
	$doc = new DOMDocument("1.0","utf-8");
	$doc->formatOutput = true; 
	$paises = $doc->createElement("paises"); //creamos un elemento 
	$doc->appendChild($paises);
	while($p = mysql_fetch_array($rs)){
		$pais = $doc->createElement("pais");
		$codigo = $doc->createElement("codigo"); //cremos elemento 
		$codigo->appendChild($doc->createTextNode("p".$p['id']));
		$pais->appendChild($codigo);
		$nombre = $doc->createElement("Nombre"); //cremos elemento 
		$nombre->appendChild($doc->createTextNode(utf8_encode($p['nombre'])));
		$pais->appendChild($nombre);
		$paises->appendChild($pais);   //pegamos  a 
	}
		$cad= $doc->saveXML();
		$fp=fopen($ruta."xml/paises.xml","w+");
		fwrite($fp,$cad);
		fclose($fp);
	}	
	}
 
	function Xml_ciudad($ruta){
		$db = dbconn();		
		$rs1= mysql_query("select id,nombre from iweb_pais",$db);
		if(mysql_num_rows($rs1)>0){
			while($pais = mysql_fetch_array($rs1)){
				$rs2= mysql_query("select * from iweb_ciudad where pais = '".$pais['id']."'",$db);
				$doc = new DOMDocument("1.0","utf-8");
				$doc->formatOutput = true;
				$ciudades = $doc->createElement("ciudades");
				$doc->appendChild($ciudades);
				if(mysql_num_rows($rs2)>0){
					while($c = mysql_fetch_array($rs2)){
						$ciudad = $doc->createElement("ciudad");
						$codigo = $doc->createElement("codigo"); //cremos elemento 
						$codigo->appendChild($doc->createTextNode("c".$c['id']));
						$ciudad->appendChild($codigo);
						$nombre = $doc->createElement("nombre"); //cremos elemento 
						$nombre->appendChild($doc->createTextNode(utf8_encode($c['nombre'])));
						$ciudad->appendChild($nombre);
						$ciudades->appendChild($ciudad);
					}
					$cad= $doc->saveXML();
					$fp=fopen($ruta."xml/"."p".$pais['id'].".xml","w+");
					fwrite($fp,$cad);
					fclose($fp);
				}
			}
	    }
	}
	
	function Xml_sucursal($ruta){
		$db = dbconn();
		$rs1= mysql_query("select id,nombre from iweb_pais",$db);
		if(mysql_num_rows($rs1)>0){
			while($pais = mysql_fetch_array($rs1)){
				$rs2= mysql_query("select * from iweb_ciudad where pais = '".$pais['id']."'",$db);
				if(mysql_num_rows($rs2)>0){
					while($c = mysql_fetch_array($rs2)){
							$rs3= mysql_query("select * from iweb_sucursales where ciudad = '".$c['id']."'",$db);
							if(mysql_num_rows($rs3)>0){
								//$asu=sitio_data("iweb_sucursales","*","ciudad = '".$c['id']."'");
								$doc = new DOMDocument("1.0","utf-8");
								$doc->formatOutput = true;
								$su= $doc->createElement("sucursales");
								$doc->appendChild($su);
								while($s = mysql_fetch_array($rs3)){
									$suc = $doc->createElement("sucursal");
									$codigo = $doc->createElement("codigo"); //cremos elemento 
									$codigo->appendChild($doc->createTextNode($s['id']));
									$suc->appendChild($codigo);
									$nombre = $doc->createElement("nombre"); //cremos elemento 
									$nombre->appendChild($doc->createTextNode(utf8_encode($s['nombre'])));
									$suc->appendChild($nombre);
									$concepto = $doc->createElement("concepto"); //cremos elemento 
									$concepto->appendChild($doc->createTextNode(utf8_encode($s['concepto'])));
									$suc->appendChild($concepto);
									$direccion = $doc->createElement("direccion"); //cremos elemento 
									$direccion->appendChild($doc->createTextNode(utf8_encode($s['direccion'])));
									$suc->appendChild($direccion);
									$telefono = $doc->createElement("telefono"); //cremos elemento 
									$telefono->appendChild($doc->createTextNode(utf8_encode($s['telefono'])));
									$suc->appendChild($telefono);
									$servicios = $doc->createElement("servicios"); //cremos elemento 
									$servicios->appendChild($doc->createTextNode(utf8_encode($s['servicios'])));
									$suc->appendChild($servicios);
									$servicios = $doc->createElement("servicios"); //cremos elemento 
									$servicios->appendChild($doc->createTextNode(utf8_encode($s['servicios'])));
									$suc->appendChild($servicios);
									$hora_llegada = $doc->createElement("hora_llegada"); //cremos elemento 
									$hora_llegada->appendChild($doc->createTextNode(utf8_encode($s['horall'])));
									$hora_salida = $doc->createElement("hora_salida"); //cremos elemento 
									$hora_salida->appendChild($doc->createTextNode(utf8_encode($s['horasa'])));
									$suc->appendChild($hora_salida);
									$gmap = $doc->createElement("gmap"); //cremos elemento 
									$gmap->appendChild($doc->createTextNode(c_gmaps($s['gmap'])));
									$suc->appendChild($gmap);
									$status = $doc->createElement("status"); //cremos elemento 
									$status->appendChild($doc->createTextNode(utf8_encode(iif($s['status']=="","",iif($s['status']=="1","Abierto","Pronta Inauguraci&oacute;n")))));
									$suc->appendChild($status);
									$su->appendChild($suc);
								}
								$cad= $doc->saveXML();
								$fp=fopen($ruta."xml/"."c".$c['id'].".xml","w+");
								fwrite($fp,$cad);
								fclose($fp);
						}	
					}	
				}
			}
		}	
	}


function c_gmaps($str){
	if($str!=""){
	$subcad ="";
	$str=addslashes($str);
	$str =str_ireplace('&amp;',"-",$str);
	echo $pos;
	$pos = stripos($str ,'-ll=');
	$subcad = substr($str,$pos+4,strlen($str));
	$pos= stripos($subcad ,"-spn=");
	$subcad = substr($subcad,0,$pos);
	return $subcad;
	}
} 

?>