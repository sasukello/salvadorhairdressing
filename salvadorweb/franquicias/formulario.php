<?php
	//include("header.html");
	//include("iweb/sitio/funciones.php");
	//print_r($_POST);

	include ("../sitio/scripts/recaptchalib.php");
	$siteKey = "6LdmUQcUAAAAACBfgGVynDxcUrqAGBbu8GnRrivZ";
        $secret = "6LdmUQcUAAAAAOYIW8NSF9PbMFXRVstqpaCQjdIq";
        $lang = "es";
        $resp = null;
        $error = null;
        $reCaptcha = new ReCaptcha($secret);


	if($_POST){
/*		if ($_POST["g-recaptcha-response"]) {
                $resp = $reCaptcha->verifyResponse(
                    $_SERVER["REMOTE_ADDR"],
                    $_POST["g-recaptcha-response"]
                );
            }  

        if ($resp != null && $resp->success) {*/

		$f=$_REQUEST['f'];
		$nombres =limpia($_REQUEST['nombres']);
		$email =limpia($_REQUEST['email']);
		$apellidos=limpia($_REQUEST['apellidos']);
		$cedula = limpia($_REQUEST['cedula']);
		$fechanac_day = limpia($_REQUEST['fechanac_day']);
		$fechanac_month = limpia($_REQUEST['fechanac_month']);
		$fechanac_year = limpia($_REQUEST['fechanac_year']);
	        $direccion =  limpia($_REQUEST['direccion']);
		$ciudad = limpia($_REQUEST['ciudad']);
		$estado = limpia($_REQUEST['estado']);
		$pais = limpia($_REQUEST['pais']);
		$telefono= limpia($_REQUEST['telefono']);
		$telefono2 = limpia($_REQUEST['telefono2']);
		$movil = limpia($_REQUEST['movil']);
		$nivel = limpia($_REQUEST['nivel']);
		$nosotros =  limpia($_REQUEST['nosotros']);	             
		$pabrir = limpia($_REQUEST['pabrir']);	                
		$conyugue = limpia($_REQUEST['conyugue']);
		$invertir = limpia($_REQUEST['invertir']);
		$socio = limpia($_REQUEST['socio']);	
		$inversion = limpia($_REQUEST['inversion']);
		$otiempo =limpia($_REQUEST['otiempo']);
		$conocimiento = limpia($_REQUEST['conocimiento']);
		$propietario = limpia($_REQUEST['propietario']);
		$nombre_franquicia = limpia($_REQUEST['nombre_franquicia']);
		$periodo3 = limpia($_REQUEST['periodo3']);
		$experiencia_manejo = limpia($_REQUEST['experiencia_manejo']);
		$em_descripcion  = limpia($_REQUEST['em_descripcion']);
		$cfranquiciado= limpia($_REQUEST['cfranquiciado']);
		$nombre_franquiciado = limpia($_REQUEST['nombre_franquiciado']);
		$aprendizaje = limpia($_REQUEST['aprendizaje']);
		$personal = limpia($_REQUEST['personal']);
		$tipo_personal = limpia($_REQUEST['tipo_personal']);
		$involucrado = limpia($_REQUEST['involucrado']);
		$involucrado_nombre = limpia($_REQUEST['involucrado_nombre']);
		$dedicacion = limpia($_REQUEST['dedicacion']);
		$lugar= limpia($_REQUEST['lugar']);
		$direccion_lugar = limpia($_REQUEST['direccion_lugar']);
		$apertura= limpia($_REQUEST['apertura']);
		$tdesarrollo = limpia($_REQUEST['tdesarrollo']);
		$operar_rp = limpia($_REQUEST['operar_rp']);
		$region_onombre= limpia($_REQUEST['region_onombre']);
		
			
		if($f=="") $error.="- Debe seleccionar un tipo de franquicia<br/>";
		if($nombres=="") $error.="- Debe ingresar los nombres<br/>";
		else
			{
				    $html .= "<strong>Nombres:</strong> $nombres<br/>";
					$campos.="nombres,";
					$datos.="'".$nombres."',";
					
			}
		if($apellidos=="")	$error.="- Debe ingresar los apellidos<br/>";
		else
		{
				$html .= "<strong>Apellidos:</strong> $apellidos<br/>";
				$campos.="apellidos,";
				$datos.="'".$apellidos."',";
				
		}
		if($cedula=="")$error.="- Debe ingresar el n&uacute;mero de CI/ID<br/>";
		else
		{
				$html .= "<strong>CI/ID: Documento de identidad:</strong> $cedula<br/>";
				$campos.="ci,";
				$datos.="'".$cedula."',";
				
		}
		if(!validmail($email)) {$error.="- Debe ingresar el correo electr&oacute;nico<br/>";}
		else if($email!="") {
			$rm = sitio_data("masterdb","*","email = '$email'");
			$ro = sitio_data("operador","*","email = '$email'");
			$ri = sitio_data("inversionista","*","email = '$email'");
			$re = sitio_data("estilista","*","email = '$email'");
			if(count($rm[0])>0 or count($ro[0])>0 or count($ri[0])>0 or count($re[0])>0 ){
				$error.="- el correo electr&oacute;nico ya ha sido utilizado en otra solicitud<br/>";
			}
			else {
				$html .= "<strong>Correo electr&oacute;nico:</strong> $cedula<br/>";
				$campos.="email,";
				$datos.="'".$email."',";
		} 	
		}
		if($fechanac_day=="") $error.="- Debe ingresar el d&iacute;a de nacimiento<br/>";
		if($fechanac_month=="")$error.="- Debe ingresar el mes de nacimiento<br/>";
		if($fechanac_year=="") $error.="- Debe ingresar el a&ntilde;o de nacimiento<br/>";
		if($fechanac_day!="" && $fechanac_month!="" && $fechanac_year!="" && checkdate($fechanac_month,$fechanac_day,$fechanac_year)===false)
		$error.="- Debe ingresar fecha v&aacute;lida<br/>";
		else
		{
				$html .= "<strong>Fecha de nacimiento:</strong> $fechanac_month/$fechanac_day/$fechanac_year<br/>";
				$campos.="fecha_nac,";
				$datos.="'".date("Y-m-d",strtotime($fechanac_year."/".$fechanac_month."/".$fechanac_day))."',";
				
		}
	    if($direccion=="") $error.="- Debe ingresar una direcci&oacute;n<br/>";
		else
		{
				$html .= "<strong>Direcci&oacute;n:</strong> $direccion<br/>";
				$campos.="direccion,";
				$datos.="'".$direccion."',";
		}
		if($ciudad=="") $error.="- Debe ingresar una ciudad<br/>";
		else
		{
				$html .= "<strong>Ciudad:</strong> $direccion<br/>";
				$campos.="ciudad,";
				$datos.="'".$ciudad."',";
		}
		if($estado=="")$error.="- Debe ingresar un estado<br/>";
		else
		{
				$html .= "<strong>Estado:</strong> $estado<br/>";
				$campos.="estado,";
				$datos.="'".$estado."',";
		}
		if($pais=="")$error.="- Debe seleccionar un pa&iacute;s<br/>";
		else
		{
				$html .= "<strong>Pa&iacute;s:</strong> $pais<br/>";
				$campos.="pais,";
				$datos.="'".$pais."',";
		}
		if($telefono=="") $error.="- Debe ingresar un tel&eacute;fono de habitaci&oacute;n<br/>";
		else
		{
				$html .= "<strong>Tel&eacute;fono Hab.:</strong> $telefono<br/>";
				$campos.="tel_hab,";
				$datos.="'".$telefono."',";
		}
		if($telefono2=="")$error.="- Debe ingresar un tel&eacute;fono de oficina<br/>";
		else
		{
				$html .= "<strong>Tel&eacute;fono Hab.:</strong> $telefono2<br/>";
				$campos.="tel_ofi,";
				$datos.="'".$telefono2."',";
		}
		if($movil=="") $error.="- Debe ingresar un tel&eacute;fono m&oacute;vil<br/>";
		else
		{
				$html .= "<strong>Tel&eacute;fono m&oacute;vil:</strong> $movil<br/>";
				$campos.="tel_mov,";
				$datos.="'".$movil."',";
		}
		if($nivel=="") $error.="- Debe ingresar un nivel acad&eacute;mico<br/>";
		else
		{
				$html .= "<strong>Tel&eacute;fono m&oacute;vil:</strong> $movil<br/>";
				$campos.="academico,";
				$datos.="'".$nivel."',";
		}
		if($nosotros==""  && stripos("operador inversionista master estilista",$f)!== False) $error.="-  Por favor, indique c&oacute;mo supo de nosotros<br/>";
		else if(stripos("operador inversionista master estilista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;C&oacute;mo supo de nosotros?</strong> $movil<br/>";
				$campos.="nosotros,";
				$datos.="'".$nosotros."',";
		}
                
                                		
		if($pabrir==""  && stripos("operador inversionista master estilista",$f)!== False)  $error.="-  Por favor, seleccione un pa&iacute;s<br/>";
		else if(stripos("operador inversionista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;En cu&aacute;l pa&iacute;s desea usted abrir su unidad de negocio? </strong> $pabrir<br/>";
				$campos.="pabrir,";
				$datos.="'".$pabrir."',";
		}		
		
		if($conyugue==""  && stripos("operador master estilista",$f)!== False) $error.="- Por favor, indique si su c&oacute;nyuge participar&aacute;<br/>";
		else if(stripos("operador master estilista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Su c&oacute;nyuge participar&aacute;?</strong> $conyugue<br/>";
				$campos.="conyugue,";
				$datos.="'".iif($conyugue=="si","1","0")."',";
		}
		if($invertir ==""  && stripos("operador inversionista master estilista",$f)!== False) $error.="- Por favor, indique si est&aacute; interesado en invertir solo o con un socio<br/>";
		else if(stripos("operador inversionista master estilista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Est&aacute; usted interesado en invertir solo o con un socio y por qu&eacute;? </strong> $invertir<br/>";
				$campos.="invertir,";
				$datos.="'".iif($invertir=="si","1","0")."',";
		}		
		if($inversion=="" && stripos("operador inversionista estilista",$f)!== False) $error.="- Por favor, indique la disponibilidad de inversi&oacute;n para su unidad de negocio<br/>";
		else if(stripos("operador inversionista estilista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Cu&aacute;nto estar&iacute;a dispuesto a invertir en su unidad de negocio?  </strong> $inversion<br/>";
				$campos.="inversion,";
				$datos.="'".$inversion."',";
		}
	/*	if($otiempo=="" && stripos("operador inversionista estilista",$f)!== False)  $error.="- Por favor, indique el tiempo quiere tener operativa su unidad de negocio<br/>";
		else if(stripos("operador inversionista estilista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;En cu&aacute;nto tiempo quiere tener operativa su unidad de negocio?  </strong> $otiempo<br/>";
				$campos.="otiempo,";
				$datos.="'".$otiempo."',";
				
		}*/
		if($conocimiento=="" && stripos("estilista",$f)!== False)  $error.="- Por favor, indique si usted tiene conocimiento de operaciones con franquicias<br/>";
		else if(stripos("estilista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Tiene usted conocimiento de operaciones con franquicias? </strong> $conocimiento<br/>";
				$campos.="conocimiento,";
				$datos.="'".iif($conocimiento=="si","1","0")."',";
				
		}
		if($propietario=="" && stripos("operador inversionista master",$f)!== False)  $error.="- Por favor, indique si es usted propietario de alg&uacute;n negocio o franquicia<br/>";
		else if(stripos("operador inversionista master",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Es usted propietario de alg&uacute;n negocio o franquicia?  </strong> $propietario<br/>";
				$campos.="propietario,";
				$datos.="'".iif($propietario=="si","1","0")."',";
				
		}
		if($nombre_franquicia==""&& $propietario=="si" && stripos("operador inversionista master",$f)!== False)$error.="- por favor,  especifique el nombre de negocio o franquicia<br/>";
		else if($propietario=="si" && stripos("operador inversionista master",$f)!== False)
		{
				$html .= "<strong>nombre de negocio o franquicia:  </strong> $nombre_franquicia<br/>";
				$campos.="nombre_franquicia,";
				$datos.="'".$nombre_franquicia."',";
				
		}
		if($periodo3==""&&  stripos("master",$f)!== False)$error.="- Por favor, indique cu&aacute;ntas unidades puede abrir <br/>";
		else if(stripos("master",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Cu&aacute;ntas unidades puede abrir?  </strong> $periodo3<br/>";
				$campos.="periodo3,";
				$datos.="'".$periodo3."',";
				
		}
		if($experiencia_manejo=="" &&  stripos("master",$f)!== False) $error.="- Por favor, indique si usted tiene experiencia en el manejo de marcas<br/>";
		else if(stripos("master",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Tiene experiencia en el manejo de marcas? </strong> $experiencia_manejo<br/>";
				$campos.="experiencia_manejo,";
				$datos.="'".iif($experiencia_manejo=="si","1","0")."',";
				
		}
		if($em_descripcion=="" && $experiencia_manejo== "si" &&   stripos("master",$f)!== False)$error.="- Por favor, especifique en que &aacute;rea posee la experiencia<br/>";
		else if($experiencia_manejo== "si" &&  stripos("master",$f)!== False)
		{
				$html .= "<strong>experiencia en el manejo de marcas: </strong> $em_descripcion<br/>";
				$campos.="em_descripcion,";
				$datos.="'".$em_descripcion."',";
				
		}
		if($cfranquiciado=="" && stripos("operador inversionista estilista",$f)!== False) $error.="- Por favor, indique si conoce a alg&uacute;n franquiciado de Salvador<br/>";
		else if(stripos("operador inversionista estilista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Tiene experiencia en el manejo de marcas? </strong> $cfranquiciado<br/>";
				$campos.="cfranquiciado,";
				$datos.="'".iif($cfranquiciado=="si","1","0")."',";	
		}
		if($nombre_franquiciado==""  && $cfranquiciado=="si" &&  stripos("operador inversionista estilista",$f)!== False)$error.="- Por favor, indique el nombre del franquiciado<br/>";
		else if($cfranquiciado=="si" &&  stripos("operador inversionista estilista",$f)!== False)
		{
				$html .= "<strong> Nombre del franquiciado: </strong> $nombre_franquiciado<br/>";
				$campos.="nombre_franquiciado,";
				$datos.="'".$nombre_franquiciado."',";	
		}
		if($aprendizaje=="" &&  stripos("inversionista",$f)!== False) $error.="- Por favor, indique si usted estar&iacute;a dispuesto al aprendizaje para el manejo de la franquicia<br/>";
		else if(stripos("inversionista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Estar&iacute;a usted dispuesto al aprendizaje para el manejo de la franquicia?  </strong> $aprendizaje<br/>";
				$campos.="aprendizaje,";
				$datos.="'".iif($aprendizaje=="si","1","0")."',";	
		}
		if($personal=="" &&  stripos("inversionista",$f)!== False) $error.="- Por favor, indique si usted cuenta con el personal para llevar a cabo la operaci&oacute;n <br/>";
		else if(stripos("inversionista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Tiene personal considerado para llevar a cabo la operaci&oacute;n?   </strong> $personal<br/>";
				$campos.="personal,";
				$datos.="'".iif($personal=="si","1","0")."',";	
		}
		if($tipo_personal=="" && $personal=="si" &&  stripos("inversionista",$f)!== False) $error.="- Por favor, especifique el personal considerado para llevar a cabo la operaci&oacute;n<br/>";
		else if($personal=="si" &&  stripos("inversionista",$f)!== False)
		{
				$html .= "<strong>Personal: </strong> $tipo_personal<br/>";
				$campos.="tipo_personal,";
				$datos.="'".$tipo_personal."',";	
		}
		if($involucrado==""  &&  stripos("operador",$f)!== False) $error.="- Por favor, indique si usted estar&aacute; involucrado en la operaci&oacute;n de franquicia<br/>";
		else if(stripos("operador",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Estar&iacute;a Ud. involucrado en la operaci&oacute;n de franquicia?    </strong> $involucrado<br/>";
				$campos.="involucrado,";
				$datos.="'".iif($involucrado=="si","1","0")."',";	
		}
		if($involucrado_nombre==""  && $involucrado=="si" && stripos("operador",$f)!== False) $error.="- Por favor, escriba su nombre y apellido<br/>";
		else if($involucrado=="si" && stripos("operador",$f)!== False)
		{
				$html .= "<strong>Nombre y apellido: </strong> $involucrado_nombre<br/>";
				$campos.="involucrado_nombre,";
				$datos.="'".$involucrado_nombre."',";	
		}
		if($dedicacion=="" && stripos("operador master estilista",$f)!== False) $error.="- Por favor, indique si su dedicaci&oacute;n ser&aacute; a tiempo completo<br/>";
		else if(stripos("operador master estilista",$f)!== False)
		{
				$html .= "<strong>Dedicaci&oacute;n a tiempo completo : </strong> $dedicacion<br/>";
				$campos.="dedicacion,";
				$datos.="'".iif($dedicacion=="si","1","0")."',";	
		}
		if($lugar=="" && stripos("operador inversionista",$f)!== False) $error.="- Por favor, indique si usted cuenta con un lugar para la franquicia<br/>";
		else if(stripos("operador inversionista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Cuenta con un lugar para la franquicia?  </strong> $lugar<br/>";
				$campos.="lugar,";
				$datos.="'".iif($lugar=="si","1","0")."',";	
		}
		if($direccion_lugar=="" && $lugar=="si" && stripos("operador inversionista",$f)!== False) $error.="- Por favor, espesifique la direccion del lugar para la franquicia<br/>";
		else if($lugar=="si" && stripos("operador inversionista",$f)!== False)
		{
				$html .= "<strong> Direcci&oacute;n del local:  </strong> $direccion_lugar<br/>";
				$campos.="direccion_lugar,";
				$datos.="'".$direccion_lugar."',";	
		}
		if($apertura=="" && stripos("operador inversionista",$f)!== False) $error.="- Por favor, indique en cuanto tiempo quiere aperturar su unidad de negocio<br/>";
		else if(stripos("operador inversionista",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;En c&aacute;nto tiempo quiere aperturar su unidad de negocio?  </strong> $apertura<br/>";
				$campos.="apertura,";
				$datos.="'".$apertura."',";	
		}
		
		if($operar_rp=="" && stripos("inversionista master",$f)!== False) $error.="- Por favor, indique si usted est&aacute; interesado en operar toda una regi&oacute;n o pa&iacute;s<br/>";
		else if(stripos("inversionista master",$f)!== False)
		{
				$html .= "<strong><strong>&iquest;Est&aacute; interesado en operar toda una regi&oacute;n o pa&iacute;s?  </strong> $operar_rp<br/>";
				$campos.="operar_rp,";
				$datos.="'".iif($operar_rp=="si","1","0")."',";	
		}
		if($region_onombre=="" &&  $operar_rp=="si" && stripos("inversionista master",$f)!== False) $error.="-  Por favor, especifique la regi&oacute;n o pa&iacute;s que desea operar<br/>";
		else if($operar_rp=="si" && stripos("inversionista master",$f)!== False)
		{
				$html .= "<strong>regi&oacute;n o pa&iacute;s:  </strong> $region_onombre<br/>";
				$campos.="region_onombre,";
				$datos.="'".$region_onombre."',";	
		}
		
		if($error ==""){
		//$para="INFO@SALVADOR.COM.VE , ADMINISTRACION@SALVADOR.COM.VE , FRANQUICIAS@SALVADOR.COM.VE";
		/*$para="Info <INFO@SALVADOR.COM.VE>, FRANQUICIAS<FRANQUICIAS@SALVADOR.COM.VE>";
		$para2=$nombres.' '.$apellidos."<".$email.">";
		$de="Info";
		$dominio="www.salvador.com.ve";
		$asunto="Nueva solicitud de franquicia ".$f;
		$from_header="MIME-Version: 1.0"."\r\n";
		$from_header.="Content-type: text/html; charset=iso-8859-1"."\r\n"; 
		$from_header.="From: ".$de." <info@".$dominio.">"."\r\n";		
		$rs=iweb_guardar_data(iif($f=="master","masterdb",$f),"fecha,".substr($campos,0,strlen($campos)-1), "now(),".substr($datos,0,strlen($datos)-1));
		$cuerpo1='Estimado Administrador Sistema WEB Salvador.<br/>';
		$cuerpo1.='Se ha realizado una nueva solicitud de franquicia desde el sitio web con el siguiente c&oacute;digo: '.'F'.iif($f =="operador","O",iif($f =="estilista","E",iif($f =="master","M",iif($f =="inversionista","I",""))))."-".substr(str_pad($rs,6,"0",STR_PAD_LEFT),0,3)."-".substr(str_pad($rs,6,"0",STR_PAD_LEFT),3).'. <br/>Para visualizar los datos completos de la solicitud ingrese a: <a href="http://www.salvador.com.ve/iweb/" target="_blank"> www.salvador.com.ve</a>';
		$cuerpo2='Estimado usuario '.$nombres.' '.$apellidos.'<br/>Usted ha realizado una nueva solicitud de franquicia desde el sitio web.<br/> Le estaremos informando el estatus de su solicitud.<br/>';
		mail($para,$asunto,$cuerpo1,$from_header);
		mail($para2,$asunto,$cuerpo2,$from_header);*/
                //Graba los datos en el CRM
                //Arma la fecha de nacimiento
                $fechanacio =  $fechanac_month.'/'.$fechanac_day.'/'.$fechanac_year;
                //Arma el XML para enviar                    
                $XMLZOHO = '
                <Leads>
                   <row no="1">                       
                       <FL val="Tipo Franquicia">'.strtoupper($f).'</FL>
                       <FL val="First Name">'.$nombres.'</FL>
                       <FL val="Last Name">'.$apellidos.'</FL>
                       <FL val="Email">'.$email.'</FL>
                       <FL val="Phone">'.$telefono.'</FL>
                       <FL val="Fax">'.$telefono2.'</FL>
                       <FL val="Mobile">'.$movil.'</FL>
                       <FL val="Lead Source">'.$nosotros.'</FL>
                       <FL val="Lead Status">Por contactar</FL>
                       <FL val="Street">'.$direccion.'</FL>
                       <FL val="City">'.$ciudad.'</FL>
                       <FL val="State">'.$estado.'</FL>
                       <FL val="Country">'.$pais.'</FL>                                              
                       <FL val="Ingreso por">PAGINA WEB</FL>                       
                       <FL val="Documento de Identidad">'.$cedula.'</FL>                         
                       <FL val="Nivel Academico">'.$nivel.'</FL>
                       <FL val="En cual pais desea usted abrir?">'.$pabrir.'</FL>
                       <FL val="Fecha de Nacimiento">'.$fechanacio.'</FL>
                       <FL val="Su conyuge participara?">TRUE</FL>
                       <FL val="Cantidad de socios">'.$socio.'</FL>
                       <FL val="Invertira con un socio?">'.$invertir.'</FL>
                       <FL val="Monto estimado de la inversion">'.$inversion.'</FL>
                       <FL val="Nombre del negocio o franquicia">'.$nombre_franquicia.'</FL>
                       <FL val="Nombre del franquiciado">'.$nombre_franquiciado.'</FL>
                       <FL val="Conoce algun franquiciado de Salvador?">'.$cfranquiciado.'</FL>
                       <FL val="Es usted propietario de un negocio o franquicia?">'.$propietario.'</FL>
                       <FL val="Estaria involucrado en la operacion?">'.$involucrado.'</FL>
                       <FL val="Dedicacion a tiempo completo?">'.$dedicacion.'</FL>
                       <FL val="Direccion del local">'.$direccion_lugar.'</FL>
                       <FL val="Cuenta con un lugar para la franquicia?">'.$lugar.'</FL>                               
                       <FL val="Tiempo deseado para la apertura?">'.$apertura.'</FL>
                       <FL val="Cuantas unidades puede abrir?">'.$periodo3.'</FL>
                       <FL val="Tiene experiencia en el manejo de marca?">'.$experiencia_manejo.'</FL>
                       <FL val="En cual marca ha desarrollado la experiencia?">'.$em_descripcion.'</FL>
                       <FL val="Esta interesado en operar toda una region o pais?">'.$operar_rp.'</FL>
                       <FL val="Pais o Region de interes">'.$region_onombre.'</FL>
                       <FL val="Estaria dispuesto al aprendizaje para el manejo?">'.$aprendizaje.'</FL>   
                       <FL val="Tiene personal para llevar la operacion?">'.$personal.'</FL> 
                       <FL val="Nombre del personal considerado para la operacion">'.$tipo_personal.'</FL>    
                    </row>
                </Leads>';
                                
                
                // abrimos la sesión cURL                
                $ch = curl_init();                
                // definimos cada uno de los parámetros                                
                $VarPost = "newFormat=2&version=2&wfTrigger=true&duplicateCheck=1&authtoken=3e7729dbcf9b4134813967d1a4b2244e&scope=crmapi&xmlData=$XMLZOHO";
                // definimos la URL a la que hacemos la petición
                curl_setopt($ch, CURLOPT_URL,"https://crm.zoho.com/crm/private/xml/Leads/insertRecords?");
                // indicamos el tipo de petición: POST
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $VarPost);              
                curl_setopt($ch, CURLOPT_VERBOSE, 1);
                //Graba el XML antes de subirlo
                $file = fopen("archivo.txt", "w");
                fwrite($file,"https://crm.zoho.com/crm/private/xml/Leads/insertRecords?$VarPost" . PHP_EOL);                
                fclose($file);
                //Indica el nivel de cifrado
                //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);// Turn off the server and peer verification 
               // curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'rsa_rc4_128_sha'); //for godaddy server patch
                //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

                // recibimos la respuesta y la guardamos en una variable
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $remote_server_output = curl_exec ($ch);
                // cerramos la sesión cURL
                curl_close ($ch);
                
                $file1 = fopen("respuesta.txt", "w");
                fwrite($file1, $remote_server_output . PHP_EOL);                
                fclose($file1);
                  
                // hacemos lo que queramos con los datos recibidos
                // por ejemplo, los mostramos
                
                if (strpos($remote_server_output, "error") === false) {
                   if (strpos($remote_server_output, "Record(s) already exists") === false) {
                      $exito ="- Registro agregado exitosamente<br/>-$remote_server_output<br/>";
                      $error = ""; 
                   } 
                   else{
                      $exito ="";
                      $error = "La direccion de correo electronico ya esta registrada<br/> -$remote_server_output<br/>" ; 
                   } 
                   
                }                
                else {                
                   $exito ="";
                   $error = "Error al grabar el registro<br/> -$remote_server_output<br/>" ; 
                }
                $XMLZOHO="";
		$f="";
		$nombres="";
		$apellidos="";
		$cedula ="";
		$fechanac_day ="";
		$fechanac_month ="";
		$fechanac_year ="";
		$direccion ="";
		$ciudad ="";
		$estado ="";
		$pais ="";
		$telefono="";
		$telefono2 ="";
		$movil ="";
		$nivel ="";
		$nosotros ="";	
		//$pais_sucursal = limpia($_REQUEST['pais_sucursal']);               
		$pabrir ="";
		$conyugue = "";
		$invertir = "";
		$socio = "";		
		$inversion= "";
		$otiempo = "";
		$conocimiento = "";
		$propietario = "";
		$nombre_franquicia = "";
		$periodo3 = "";
		$experiencia_manejo= "";
		$em_descripcion  = "";
		$cfranquiciado= "";
		$nombre_franquiciado= "";
		$aprendizaje = "";
		$personal = "";
		$tipo_personal = "";
		$involucrado = "";
		$involucrado_nombre = "";
		$dedicacion = "";
		$lugar= "";
		$direccion_lugar = "";
		$apertura= "";
		$tdesarrollo = "";
		$operar_rp = "";
		$region_onombre= "";
		$email="";
	 }	
/*	} else {
                $error = "Verificación anti-spam no éxitosa. Intente de nuevo.";
            } */
        }
	?>

<div id="AVA_CONTENEDOR_PRINCIPAL">
		<div id="home_cont_keep_out"  class="border-header-center" style=" clear:both;width:997px; min-height:540px; height:auto; overflow:auto; margin: 0 auto; background-color:#fff;">
		<form action="<?=$_SERVER['PHP_SELF'];?>" name="form1" method="post">
			<div id="grey_box" style="width:877px;height:181px;margin:auto;"><img src="images/franchises.jpg" width="877" height="181" /></div>
			
			<div class="contenedor">
				<div style="margin-top:2px; width:100%;margin-botton:10px;float:left; ">
					<?php if($error<>"" && $_POST){?><div class="error"><div><?php=$error;?></div></div> <?php }?>
					<?php if($exito<>"" && $_POST){?><div class="exito"><div><?php=$exito;?></div></div><?php }?>
				</div>
				<div class="AVA_TITULO" style="margin:28px 0 0 0; height:100%;float:left;  overflow:auto;text-align:justify">FRANQUICIAS</div>
				<div class="line_cont" style="height:6px;float:left;width:100%;"><img src="images/hor_line_cont_large.jpg" width="877" height="6" /></div>
				<div class="item_formulario" id="franquiciado_operador">
                <b>Seleccione el tipo de franquicia:</b>
				<select name="f" id="f">
				      <option value="" <?php=iif($f=="",'selected="selected"',"")?>>Seleccione</option>
				      <option value="operador" <?php=iif($f=="operador",'selected="selected"',"")?>>Franquiciado Operador</option>
				      <option value="inversionista" <?php=iif($f=="inversionista",'selected="selected"',"")?>>Franquiciado Inversionista</option>
				      <option value="master" <?php=iif($f=="master",'selected="selected"',"")?>>Franquiciado Master</option>
				      <option value="estilista" <?php=iif($f=="estilista",'selected="selected"',"")?>>Franquiciado con Unidad de Negocio o Estilista</option>
					  <option value="flag" <?php=iif($f=="flag",'selected="selected"',"")?>>Franquiciado Flag ship</option>
			        </select>
				<script>
					$(document).ready(function(){
					$("#f").change(function(){
						$(".operador").css("display","none");
						$(".inversionista").css("display","none");
						$(".master").css("display","none");
						$(".estilista").css("display","none");
						$(".flag").css("display","none");
						$("."+$("#f").val()).css("display","block");
					});
					$("#f").change();
				});
				</script>	
				</div>
				
			
				<div class="AVA_TITULO" style="margin: 28px 0 0 0; height:100%; overflow:auto;text-align:justify;display:none">PERFIL DEL FRANQUICIADO</div>
				<div class="line_cont" style="height:6px;float:left;width:100%;display:none"><img src="images/hor_line_cont_large.jpg" width="877" height="6" /></div>
				<div class="item_formulario" id="franquiciado_operador" style="display:none">
					<ul>
						<li>Visi&oacute;n empresarial.-Perseguir el beneficio despu&eacute;s de conseguir la calidad en el servicio.</li>
						<li>Capacidad de gesti&oacute;n  y direcci&oacute;n. Habilidades organizativas.</li>
						<li>Esp&iacute;ritu emprendedor.</li>
						<li>Car&aacute;cter extrovertido con don de gentes, que disfruten con el trato p&uacute;blico.</li>
						<li>No precisa experiencia en el sector.</li>
						<li>Conocimiento b&aacute;sico del sistema de franquicia.</li>
						<li>Capacidad de cr&eacute;dito para hacer frente a la inversi&oacute;n inicial.</li>
					<ul>
                </div>
				<div class="operador">
					<div class="AVA_TITULO" style="margin: 28px 0 0 0; height:100%; overflow:auto;text-align:justify">FRANQUICIADO OPERADOR</div>
					<div class="line_cont" style="height:6px;float:left;width:100%;"><img src="images/hor_line_cont_large.jpg" width="877" height="6" /></div>
					<div class="item_formulario" id="franquiciado_operador">
						Es aquel que es emprendedor, que desea establecer un negocio o diversificarse con un nuevo negocio.
					</div>
				</div>
				<div class="inversionista">
				<div class="AVA_TITULO" style="margin: 28px 0 0 0; height:100%; overflow:auto;text-align:justify">FRANQUICIADO INVERSIONISTA</div>
				<div class="line_cont" style="height:6px;float:left;width:100%;"><img src="images/hor_line_cont_large.jpg" width="877" height="6" /></div>
				<div class="item_formulario" id="franquiciado_operador">
					Es aquel que es emprendedor que desea establecer un negocio o diversificarse con un nuevo negocio, dejando su operaci&oacute;n en manos de terceros.
                </div>
				</div>
				<div class="master">
					<div class="AVA_TITULO" style="margin: 28px 0 0 0; height:100%; overflow:auto;text-align:justify">FRANQUICIADO MASTER</div>
					<div class="line_cont" style="height:6px;float:left;width:100%;"><img src="images/hor_line_cont_large.jpg" width="877" height="6" /></div>
					<div class="item_formulario" id="franquiciado_operador">
						Es el inversionista que adquiere los derechos para el desarrollo operativo y de crecimiento de la marca en una regi&oacute;n o pa&iacute;s
					</div>
				</div>
				<div class="estilista">
				<div class="AVA_TITULO" style="margin: 28px 0 0 0; height:100%; overflow:auto;text-align:justify">FRANQUICIADO CON UNIDAD DE NEGOCIO</div>
				<div class="line_cont" style="height:6px;float:left;width:100%;"><img src="images/hor_line_cont_large.jpg" width="877" height="6" /></div>
				<div class="item_formulario" id="franquiciado_operador">
					Es aquel que tiene condiciones profesionales, econ&oacute;mica y actitudinales para establecerse como socio de una unidad de negocio ya establecida, remodelar un sal&oacute;n existente
                </div>
				</div>
				<div class="flag">
					<div class="AVA_TITULO" style="margin: 28px 0 0 0; height:100%; overflow:auto;text-align:justify">FRANQUICIADO FLAG SHIP</div>
					<div class="line_cont" style="height:6px;float:left;width:100%;"><img src="images/hor_line_cont_large.jpg" width="877" height="6" /></div>
					<div class="item_formulario" id="franquiciado_operador">
						 Es cuando se tiene un negocio sal&oacute;n de belleza ya existente y quieres adquirir los derechos de conocimiento (know how) para el funcionamiento de la unidad de negocio
					</div>
				</div>
                <div class="titulo_formulario">DATOS PERSONALES</div>
                
                <div class="contenedor_formulario">
                  <table width="870" border="0" cellpadding="2" cellspacing="0">
                    <tr>
                      <td width="199">Nombres:</td>
                      <td width="252"><input name="nombres" type="text" id="nombres" style=" width:85%" value="<?php=$nombres;?>"/></td>
                      <td width="184">Apellidos:</td>
                      <td width="219"><input name="apellidos" type="text" id="apellidos" style=" width:85%" value="<?php echo $apellidos;?>"/></td>
                    </tr>
                    <tr>
                      <td>CI/ID: Documento de identidad:</td>
                      <td><input name="cedula" type="text" id="cedula"  style=" width:85%" value="<?php=$cedula;?>" size="33"/></td>
                      <td>Fecha de nacimiento:</td>
                      <td>
					  <table >
                        <tbody>
                          <tr >
                            <td ><div>
                              <select id="fechanac_day" name="fechanac_day">
                                <option  value="">Dia</option>
                                <? for ($i =1 ; $i<=31;$i++){?>
                                <option <?php=iif($fechanac_day== $i,'selected="selected"',"")?>value="<?=iif($i<10,"0".$i,$i);?>">
                                  <?php=$i;?>
                                </option>
                                <? }?>
                              </select>
                              /
                              <select id="fechanac_month" name="fechanac_month" >
                                <option selected="selected" value="">Mes</option>
                                <?php for ($i =1 ; $i<=12;$i++){?>
                                <option <?=iif($fechanac_month== $i,'selected="selected"',"")?>value="<?php=iif($i<10,"0".$i,$i);?>">
                                  <?=$i;?>
                                </option>
                                <?php }?>
                              </select>
                              /
                              <select id="fechanac_year" name="fechanac_year">
                                <option selected="selected" value="">A&ntilde;o</option>
                                <?php for ($i=1961; $i<=date("Y");$i++){?>
                                <option <?php=iif($fechanac_year== $i,'selected="selected"',"")?>value="<?php=$i;?>">
                                  <?php=$i;?>
                                </option>
                                <?php }?>
                              </select>
                            </div></td>
                            <td ><div class="help"></div></td>
                          </tr>
                        </tbody>
                      </table></td>
                    </tr>
                    <tr>
                      <td>Direcci&oacute;n:</td>
                      <td><input name="direccion" type="text" id="direccion"  style=" width:85%" value="<?=$direccion;?>" size="33"/></td>
                      <td>Ciudad:</td>
                      <td><input name="ciudad" type="text" size="33"   style=" width:85%" value="<?php=$ciudad;?>"/></td>
                    </tr>
                    <tr>
                      <td>
                      Estado:</td>
                      <td><input name="estado" type="text" size="33"  style=" width:85%" value="<?php=$estado;?>"/></td>
                      <td>Pa&iacute;s:</td>
                      <td>
						<select name="pais" id="pais" style="width:90%;"> 
							<option value="" <?php=iif($pais=="",'selected="selected"','');?>>Seleccione pa&iacute;s</option> 
							<option value="United States" <?=iif($pais=="United States",'selected="selected"','');?>>United States</option> 
							<option value="Mexico" <?=iif($pais=="Mexico",'selected="selected"','');?>>Mexico</option> 
							<option value="Argentina" <?=iif($pais=="Argentina",'selected="selected"','');?>>Argentina</option> 
							<option value="Afghanistan" <?=iif($pais=="Afghanistan",'selected="selected"','');?>>Afghanistan</option> 
							<option value="Albania" <?=iif($pais=="Albania",'selected="selected"','');?>>Albania</option> 
							<option value="Algeria" <?=iif($pais=="Algeria",'selected="selected"','');?>>Algeria</option> 
							<option value="American Samoa" <?=iif($pais=="American Samoa",'selected="selected"','');?>>American Samoa</option> 
							<option value="Andorra" <?=iif($pais=="Andorra",'selected="selected"','');?>>Andorra</option> 
							<option value="Angola" <?=iif($pais=="Angola",'selected="selected"','');?>>Angola</option> 
							<option value="Anguilla" <?=iif($pais=="Anguilla",'selected="selected"','');?>>Anguilla</option> 
							<option value="Antarctica" <?=iif($pais=="Antarctica",'selected="selected"','');?>>Antarctica</option> 
							<option value="Antigua and Barbuda" <?=iif($pais=="Antigua and Barbuda",'selected="selected"','');?>>Antigua and Barbuda</option> 
							<option value="Argentina" <?=iif($pais=="Argentina",'selected="selected"','');?>>Argentina</option> 
							<option value="Armenia" <?=iif($pais=="Armenia",'selected="selected"','');?>>Armenia</option> 
							<option value="Aruba" <?=iif($pais=="Aruba",'selected="selected"','');?>>Aruba</option> 
							<option value="Australia" <?=iif($pais=="Australia",'selected="selected"','');?>>Australia</option> 
							<option value="Austria" <?=iif($pais=="Austria",'selected="selected"','');?>>Austria</option> 
							<option value="Azerbaijan" <?=iif($pais=="Azerbaijan",'selected="selected"','');?>>Azerbaijan</option> 
							<option value="Bahamas" <?=iif($pais=="Bahamas",'selected="selected"','');?>>Bahamas</option> 
							<option value="Bahrain" <?=iif($pais=="Bahrain",'selected="selected"','');?>>Bahrain</option> 
							<option value="Bangladesh" <?=iif($pais=="Bangladesh",'selected="selected"','');?>>Bangladesh</option> 
							<option value="Barbados" <?=iif($pais=="Barbados",'selected="selected"','');?>>Barbados</option> 
							<option value="Belarus" <?=iif($pais=="Belarus",'selected="selected"','');?>>Belarus</option> 
							<option value="Belgium" <?=iif($pais=="Belgium",'selected="selected"','');?>>Belgium</option> 
							<option value="Belize" <?=iif($pais=="Belize",'selected="selected"','');?>>Belize</option> 
							<option value="Benin" <?=iif($pais=="Benin",'selected="selected"','');?>>Benin</option> 
							<option value="Bermuda" <?=iif($pais=="Bermuda",'selected="selected"','');?>>Bermuda</option> 
							<option value="Bhutan" <?=iif($pais=="Bhutan",'selected="selected"','');?>>Bhutan</option> 
							<option value="Bolivia" <?=iif($pais=="Bolivia",'selected="selected"','');?>>Bolivia</option> 
							<option value="Bosnia and Herzegovina" <?=iif($pais=="Bosnia and Herzegovina",'selected="selected"','');?>>Bosnia and Herzegovina</option> 
							<option value="Botswana" <?=iif($pais=="Botswana",'selected="selected"','');?>>Botswana</option> 
							<option value="Bouvet Island" <?=iif($pais=="Bouvet Island",'selected="selected"','');?>>Bouvet Island</option> 
							<option value="Brazil" <?=iif($pais=="Brazil",'selected="selected"','');?>>Brazil</option> 
							<option value="British Indian Ocean Territory" <?=iif($pais=="British Indian Ocean Territory",'selected="selected"','');?>>British Indian Ocean Territory</option> 
							<option value="Brunei Darussalam" <?=iif($pais=="Brunei Darussalam",'selected="selected"','');?>>Brunei Darussalam</option> 
							<option value="Bulgaria" <?=iif($pais=="Bulgaria",'selected="selected"','');?>>Bulgaria</option> 
							<option value="Burkina Faso" <?=iif($pais=="Burkina Faso",'selected="selected"','');?>>Burkina Faso</option> 
							<option value="Burundi" <?=iif($pais=="Burundi",'selected="selected"','');?>>Burundi</option> 
							<option value="Cambodia" <?=iif($pais=="Cambodia",'selected="selected"','');?>>Cambodia</option> 
							<option value="Cameroon" <?=iif($pais=="Cameroon",'selected="selected"','');?>>Cameroon</option> 
							<option value="Canada" <?=iif($pais=="Canada",'selected="selected"','');?>>Canada</option> 
							<option value="Cape Verde" <?=iif($pais=="Cape Verde",'selected="selected"','');?>>Cape Verde</option> 
							<option value="Cayman Islands" <?=iif($pais=="Cayman Islands",'selected="selected"','');?>>Cayman Islands</option> 
							<option value="Central African Republic" <?=iif($pais=="Central African Republic",'selected="selected"','');?>>Central African Republic</option> 
							<option value="Chad" <?=iif($pais=="Chad",'selected="selected"','');?>>Chad</option> 
							<option value="Chile" <?=iif($pais=="Chile",'selected="selected"','');?>>Chile</option> 
							<option value="China" <?=iif($pais=="China",'selected="selected"','');?>>China</option> 
							<option value="Christmas Island" <?=iif($pais=="Christmas Island",'selected="selected"','');?>>Christmas Island</option> 
							<option value="Cocos (Keeling) Islands" <?=iif($pais=="Cocos (Keeling) Islands",'selected="selected"','');?>>Cocos (Keeling) Islands</option> 
							<option value="Colombia" <?=iif($pais=="Colombia",'selected="selected"','');?>>Colombia</option> 
							<option value="Comoros" <?=iif($pais=="Comoros",'selected="selected"','');?>>Comoros</option> 
							<option value="Congo" <?=iif($pais=="Congo",'selected="selected"','');?>>Congo</option> 
							<option value="Congo, The Democratic Republic of The" <?=iif($pais=="Congo, The Democratic Republic of The",'selected="selected"','');?>>Congo, The Democratic Republic of The</option> 
							<option value="Cook Islands" <?=iif($pais=="Cook Islands",'selected="selected"','');?>>Cook Islands</option> 
							<option value="Costa Rica" <?=iif($pais=="Costa Rica",'selected="selected"','');?>>Costa Rica</option> 
							<option value="Cote D'ivoire" <?=iif($pais=="Cote D'ivoire",'selected="selected"','');?>>Cote D'ivoire</option> 
							<option value="Croatia" <?=iif($pais=="Croatia",'selected="selected"','');?>>Croatia</option> 
							<option value="Cuba" <?=iif($pais=="Cuba",'selected="selected"','');?>>Cuba</option> 
							<option value="Cyprus" <?=iif($pais=="Cyprus",'selected="selected"','');?>>Cyprus</option> 
							<option value="Czech Republic" <?=iif($pais=="Czech Republic",'selected="selected"','');?>>Czech Republic</option> 
							<option value="Denmark" <?=iif($pais=="Denmark",'selected="selected"','');?>>Denmark</option> 
							<option value="Djibouti" <?=iif($pais=="Djibouti",'selected="selected"','');?>>Djibouti</option> 
							<option value="Dominica" <?=iif($pais=="Dominica",'selected="selected"','');?>>Dominica</option> 
							<option value="Dominican Republic" <?=iif($pais=="Dominican Republic",'selected="selected"','');?>>Dominican Republic</option> 
							<option value="Ecuador" <?=iif($pais=="Ecuador",'selected="selected"','');?>>Ecuador</option> 
							<option value="Egypt" <?=iif($pais=="Egypt",'selected="selected"','');?>>Egypt</option> 
							<option value="El Salvador" <?=iif($pais=="El Salvador",'selected="selected"','');?>>El Salvador</option> 
							<option value="Equatorial Guinea"  <?=iif($pais=="Equatorial Guinea",'selected="selected"','');?>>Equatorial Guinea</option> 
							<option value="Eritrea" <?=iif($pais=="Eritrea",'selected="selected"','');?>>Eritrea</option> 
							<option value="Estonia" <?=iif($pais=="Estonia",'selected="selected"','');?>>Estonia</option> 
							<option value="Ethiopia" <?=iif($pais=="Ethiopia",'selected="selected"','');?>>Ethiopia</option> 
							<option value="Falkland Islands (Malvinas)" <?=iif($pais=="Falkland Islands (Malvinas)",'selected="selected"','');?>>Falkland Islands (Malvinas)</option> 
							<option value="Faroe Islands" <?=iif($pais=="Faroe Islands",'selected="selected"','');?>>>Faroe Islands</option> 
							<option value="Fiji" <?=iif($pais=="Fiji",'selected="selected"','');?>>Fiji</option> 
							<option value="Finland" <?=iif($pais=="Finland",'selected="selected"','');?>>Finland</option> 
							<option value="France" <?=iif($pais=="France",'selected="selected"','');?>>France</option> 
							<option value="French Guiana" <?=iif($pais=="French Guiana",'selected="selected"','');?>>French Guiana</option> 
							<option value="French Polynesia" <?=iif($pais=="French Polynesia",'selected="selected"','');?>>French Polynesia</option> 
							<option value="French Southern Territories"  <?=iif($pais=="French Southern Territories",'selected="selected"','');?>>French Southern Territories</option> 
							<option value="Gabon" <?=iif($pais=="Gabon",'selected="selected"','');?>>Gabon</option> 
							<option value="Gambia" <?=iif($pais=="Gambia",'selected="selected"','');?>>Gambia</option> 
							<option value="Georgia" <?=iif($pais=="Georgia",'selected="selected"','');?>>Georgia</option> 
							<option value="Germany" <?=iif($pais=="Germany",'selected="selected"','');?>>Germany</option> 
							<option value="Ghana" <?=iif($pais=="Ghana",'selected="selected"','');?>>Ghana</option> 
							<option value="Gibraltar" <?=iif($pais=="Gibraltar",'selected="selected"','');?>>Gibraltar</option> 
							<option value="Greece" <?=iif($pais=="Greece",'selected="selected"','');?>>Greece</option> 
							<option value="Greenland" <?=iif($pais=="Greenland",'selected="selected"','');?>>Greenland</option> 
							<option value="Grenada"  <?=iif($pais=="Grenada",'selected="selected"','');?>>Grenada</option> 
							<option value="Guadeloupe" <?=iif($pais=="Guadeloupe",'selected="selected"','');?>>Guadeloupe</option> 
							<option value="Guam" <?=iif($pais=="Guam",'selected="selected"','');?>>Guam</option> 
							<option value="Guatemala" <?=iif($pais=="Guatemala",'selected="selected"','');?>>Guatemala</option> 
							<option value="Guinea" <?=iif($pais=="Guinea",'selected="selected"','');?>>Guinea</option> 
							<option value="Guinea-bissau" <?=iif($pais=="Guinea-bissau",'selected="selected"','');?>>Guinea-bissau</option> 
							<option value="Guyana" <?=iif($pais=="Guyana",'selected="selected"','');?>>Guyana</option> 
							<option value="Haiti" <?=iif($pais=="Haiti",'selected="selected"','');?>>Haiti</option> 
							<option value="Heard Island and Mcdonald Islands" <?=iif($pais=="Heard Island and Mcdonald Islands",'selected="selected"','');?>>Heard Island and Mcdonald Islands</option> 
							<option value="Holy See (Vatican City State)" <?=iif($pais=="Holy See (Vatican City State)",'selected="selected"','');?>>Holy See (Vatican City State)</option> 
							<option value="Honduras" <?=iif($pais=="Honduras",'selected="selected"','');?>>Honduras</option> 
							<option value="Hong Kong" <?=iif($pais=="Hong Kong",'selected="selected"','');?>>Hong Kong</option> 
							<option value="Hungary"<?=iif($pais=="Hungary",'selected="selected"','');?>>Hungary</option> 
							<option value="Iceland" <?=iif($pais=="Iceland",'selected="selected"','');?>>Iceland</option> 
							<option value="India" <?=iif($pais=="India",'selected="selected"','');?>>India</option> 
							<option value="Indonesia" <?=iif($pais=="Indonesia",'selected="selected"','');?>>Indonesia</option> 
							<option value="Iran, Islamic Republic of" <?=iif($pais=="Iran, Islamic Republic of",'selected="selected"','');?>>Iran, Islamic Republic of</option> 
							<option value="Iraq" <?=iif($pais=="Iraq",'selected="selected"','');?>>Iraq</option> 
							<option value="Ireland" <?=iif($pais=="Ireland",'selected="selected"','');?>>Ireland</option> 
							<option value="Israel" <?=iif($pais=="Israel",'selected="selected"','');?>>Israel</option> 
							<option value="Italy" <?=iif($pais=="Italy",'selected="selected"','');?>>Italy</option> 
							<option value="Jamaica" <?=iif($pais=="Jamaica",'selected="selected"','');?>>Jamaica</option> 
							<option value="Japan" <?=iif($pais=="Japan",'selected="selected"','');?>>Japan</option> 
							<option value="Jordan" <?=iif($pais=="Jordan",'selected="selected"','');?>>Jordan</option> 
							<option value="Kazakhstan" <?=iif($pais=="Kazakhstan",'selected="selected"','');?>>Kazakhstan</option> 
							<option value="Kenya" <?=iif($pais=="Kenya",'selected="selected"','');?>>Kenya</option> 
							<option value="Kiribati" <?=iif($pais=="Kiribati",'selected="selected"','');?>>Kiribati</option> 
							<option value="Korea, Democratic People's Republic of" <?=iif($pais=="Korea, Democratic People's Republic of",'selected="selected"','');?>>Korea, Democratic People's Republic of</option> 
							<option value="Korea, Republic of" <?=iif($pais=="Korea, Republic of",'selected="selected"','');?>>Korea, Republic of</option> 
							<option value="Kuwait" <?=iif($pais=="Kuwait",'selected="selected"','');?>>Kuwait</option> 
							<option value="Kyrgyzstan" <?=iif($pais=="Kyrgyzstan",'selected="selected"','');?>>Kyrgyzstan</option> 
							<option value="Lao People's Democratic Republic" <?=iif($pais=="Lao People's Democratic Republic",'selected="selected"','');?>>Lao People's Democratic Republic</option> 
							<option value="Latvia" <?=iif($pais=="Latvia",'selected="selected"','');?>>Latvia</option> 
							<option value="Lebanon" <?=iif($pais=="Lebanon",'selected="selected"','');?>>Lebanon</option> 
							<option value="Lesotho" <?=iif($pais=="Lesotho",'selected="selected"','');?>>Lesotho</option> 
							<option value="Liberia" <?=iif($pais=="Liberia",'selected="selected"','');?>>Liberia</option> 
							<option value="Libyan Arab Jamahiriya" <?=iif($pais=="Libyan Arab Jamahiriya",'selected="selected"','');?>>Libyan Arab Jamahiriya</option> 
							<option value="Liechtenstein" <?=iif($pais=="Liechtenstein",'selected="selected"','');?>>Liechtenstein</option> 
							<option value="Lithuania" <?=iif($pais=="Lithuania",'selected="selected"','');?>>Lithuania</option> 
							<option value="Luxembourg" <?=iif($pais=="Luxembourg",'selected="selected"','');?>>Luxembourg</option> 
							<option value="Macao" <?=iif($pais=="Macao",'selected="selected"','');?>>Macao</option> 
							<option value="Macedonia, The Former Yugoslav Republic of" <?=iif($pais=="Macedonia, The Former Yugoslav Republic of",'selected="selected"','');?>>Macedonia, The Former Yugoslav Republic of</option> 
							<option value="Madagascar" <?=iif($pais=="Madagascar",'selected="selected"','');?>>Madagascar</option> 
							<option value="Malawi" <?=iif($pais=="Malawi",'selected="selected"','');?>>Malawi</option> 
							<option value="Malaysia" <?=iif($pais=="Malaysia",'selected="selected"','');?>>Malaysia</option> 
							<option value="Maldives" <?=iif($pais=="Maldives",'selected="selected"','');?>>Maldives</option> 
							<option value="Mali" <?=iif($pais=="Mali",'selected="selected"','');?>>Mali</option> 
							<option value="Malta" <?=iif($pais=="Malta",'selected="selected"','');?>>Malta</option> 
							<option value="Marshall Islands" <?=iif($pais=="Marshall Islands",'selected="selected"','');?>>Marshall Islands</option> 
							<option value="Martinique" <?=iif($pais=="Martinique",'selected="selected"','');?>>Martinique</option> 
							<option value="Mauritania" <?=iif($pais=="Mauritania",'selected="selected"','');?>>Mauritania</option> 
							<option value="Mauritius" <?=iif($pais=="Mauritius",'selected="selected"','');?>>Mauritius</option> 
							<option value="Mayotte" <?=iif($pais=="Mayotte",'selected="selected"','');?>>Mayotte</option> 
							<option value="Mexico" <?=iif($pais=="Mexico",'selected="selected"','');?>>Mexico</option> 
							<option value="Micronesia, Federated States of" <?=iif($pais=="Micronesia, Federated States of",'selected="selected"','');?>>Micronesia, Federated States of</option> 
							<option value="Moldova, Republic of" <?=iif($pais=="Moldova, Republic of",'selected="selected"','');?>>Moldova, Republic of</option> 
							<option value="Monaco" <?=iif($pais=="Monaco",'selected="selected"','');?>>Monaco</option> 
							<option value="Mongolia" <?=iif($pais=="Mongolia",'selected="selected"','');?>>Mongolia</option> 
							<option value="Montserrat" <?=iif($pais=="Montserrat",'selected="selected"','');?>>Montserrat</option> 
							<option value="Morocco" <?=iif($pais=="Morocco",'selected="selected"','');?>>Morocco</option> 
							<option value="Mozambique" <?=iif($pais=="Mozambique",'selected="selected"','');?>>Mozambique</option> 
							<option value="Myanmar" <?=iif($pais=="Myanmar",'selected="selected"','');?>>Myanmar</option> 
							<option value="Namibia" <?=iif($pais=="Namibia",'selected="selected"','');?>>Namibia</option> 
							<option value="Nauru" <?=iif($pais=="Nauru",'selected="selected"','');?>>Nauru</option> 
							<option value="Nepal" <?=iif($pais=="Nepal",'selected="selected"','');?>>Nepal</option> 
							<option value="Netherlands" <?=iif($pais=="Netherlands",'selected="selected"','');?>>Netherlands</option> 
							<option value="Netherlands Antilles" <?=iif($pais=="Netherlands Antilles",'selected="selected"','');?>>Netherlands Antilles</option> 
							<option value="New Caledonia" <?=iif($pais=="New Caledonia",'selected="selected"','');?>>New Caledonia</option> 
							<option value="New Zealand" <?=iif($pais=="New Zealand",'selected="selected"','');?>>New Zealand</option> 
							<option value="Nicaragua"  <?=iif($pais=="Nicaragua",'selected="selected"','');?>>Nicaragua</option> 
							<option value="Niger" <?=iif($pais=="Niger",'selected="selected"','');?>>Niger</option> 
							<option value="Nigeria" <?=iif($pais=="Nigeria",'selected="selected"','');?>>Nigeria</option> 
							<option value="Niue" <?=iif($pais=="Niue",'selected="selected"','');?>>Niue</option> 
							<option value="Norfolk Island" <?=iif($pais=="Norfolk Island",'selected="selected"','');?>>Norfolk Island</option> 
							<option value="Northern Mariana Islands" <?=iif($pais=="Northern Mariana Islands",'selected="selected"','');?>>Northern Mariana Islands</option> 
							<option value="Norway" <?=iif($pais=="Norway",'selected="selected"','');?>>Norway</option> 
							<option value="Oman" <?=iif($pais=="Oman",'selected="selected"','');?>>Oman</option> 
							<option value="Pakistan" <?=iif($pais=="Pakistan",'selected="selected"','');?>>Pakistan</option> 
							<option value="Palau" <?=iif($pais=="Palau",'selected="selected"','');?>>Palau</option> 
							<option value="Palestinian Territory, Occupied" <?=iif($pais=="Palestinian Territory, Occupied",'selected="selected"','');?>>Palestinian Territory, Occupied</option> 
							<option value="Panama" <?=iif($pais=="Panama",'selected="selected"','');?>>Panama</option> 
							<option value="Papua New Guinea" <?=iif($pais=="Papua New Guinea",'selected="selected"','');?>>Papua New Guinea</option> 
							<option value="Paraguay" <?=iif($pais=="Paraguay",'selected="selected"','');?>>Paraguay</option> 
							<option value="Peru" <?=iif($pais=="Peru",'selected="selected"','');?>>Peru</option> 
							<option value="Philippines" <?=iif($pais=="Philippines",'selected="selected"','');?>>Philippines</option> 
							<option value="Pitcairn" <?=iif($pais=="Pitcairn",'selected="selected"','');?>>Pitcairn</option> 
							<option value="Poland" <?=iif($pais=="Poland",'selected="selected"','');?>>Poland</option> 
							<option value="Portugal" <?=iif($pais=="Portugal",'selected="selected"','');?>>Portugal</option> 
							<option value="Puerto Rico" <?=iif($pais=="Puerto Rico",'selected="selected"','');?>>Puerto Rico</option> 
							<option value="Qatar" <?=iif($pais=="Qatar",'selected="selected"','');?>>Qatar</option> 
							<option value="Reunion"  <?=iif($pais=="Reunion",'selected="selected"','');?>>Reunion</option> 
							<option value="Romania" <?=iif($pais=="Romania",'selected="selected"','');?>>Romania</option> 
							<option value="Russian Federation" <?=iif($pais=="Russian Federation",'selected="selected"','');?>>Russian Federation</option> 
							<option value="Rwanda" <?=iif($pais=="Rwanda",'selected="selected"','');?>>Rwanda</option> 
							<option value="Saint Helena" <?=iif($pais=="Saint Helena",'selected="selected"','');?>>Saint Helena</option> 
							<option value="Saint Kitts and Nevis" <?=iif($pais=="Saint Kitts and Nevis",'selected="selected"','');?>>Saint Kitts and Nevis</option> 
							<option value="Saint Lucia" <?=iif($pais=="Saint Lucia",'selected="selected"','');?>>Saint Lucia</option> 
							<option value="Saint Pierre and Miquelon" <?=iif($pais=="Saint Pierre and Miquelon",'selected="selected"','');?>>Saint Pierre and Miquelon</option> 
							<option value="Saint Vincent and The Grenadines" <?=iif($pais=="Saint Vincent and The Grenadines",'selected="selected"','');?>>Saint Vincent and The Grenadines</option> 
							<option value="Samoa" <?=iif($pais=="Samoas",'selected="selected"','');?>>Samoa</option> 
							<option value="San Marino" <?=iif($pais=="San Marino",'selected="selected"','');?>>San Marino</option> 
							<option value="Sao Tome and Principe" <?=iif($pais=="Sao Tome and Principe",'selected="selected"','');?>>Sao Tome and Principe</option> 
							<option value="Saudi Arabia" <?=iif($pais=="Saudi Arabia",'selected="selected"','');?>>Saudi Arabia</option> 
							<option value="Senegal" <?=iif($pais=="Senegal",'selected="selected"','');?>>Senegal</option> 
							<option value="Serbia and Montenegro" <?=iif($pais=="Serbia and Montenegro",'selected="selected"','');?>>Serbia and Montenegro</option> 
							<option value="Seychelles" <?=iif($pais=="Seychelles",'selected="selected"','');?>>Seychelles</option> 
							<option value="Sierra Leone" <?=iif($pais=="Sierra Leone",'selected="selected"','');?>>Sierra Leone</option> 
							<option value="Singapore" <?=iif($pais=="Singapore",'selected="selected"','');?>>Singapore</option> 
							<option value="Slovakia" <?=iif($pais=="Slovakia",'selected="selected"','');?>>Slovakia</option> 
							<option value="Slovenia" <?=iif($pais=="Slovenia",'selected="selected"','');?>>Slovenia</option> 
							<option value="Solomon Islands" <?=iif($pais=="Solomon Islands",'selected="selected"','');?>>Solomon Islands</option> 
							<option value="Somalia" <?=iif($pais=="Somalia",'selected="selected"','');?>>Somalia</option> 
							<option value="South Africa" <?=iif($pais=="South Africa",'selected="selected"','');?>>South Africa</option> 
							<option value="South Georgia and The South Sandwich Islands" <?=iif($pais=="South Georgia and The South Sandwich Islands",'selected="selected"','');?>>South Georgia and The South Sandwich Islands</option> 
							<option value="Spain" <?=iif($pais=="Spain",'selected="selected"','');?>>Spain</option> 
							<option value="Sri Lanka" <?=iif($pais=="Sri Lanka",'selected="selected"','');?>>Sri Lanka</option> 
							<option value="Sudan" <?=iif($pais=="Sudan",'selected="selected"','');?>>Sudan</option> 
							<option value="Suriname" <?=iif($pais=="Suriname",'selected="selected"','');?>>Suriname</option> 
							<option value="Svalbard and Jan Mayen" <?=iif($pais=="Svalbard and Jan Mayen",'selected="selected"','');?>>Svalbard and Jan Mayen</option> 
							<option value="Swaziland" <?=iif($pais=="Swaziland",'selected="selected"','');?>>Swaziland</option> 
							<option value="Sweden" <?=iif($pais=="Sweden",'selected="selected"','');?>>Sweden</option> 
							<option value="Switzerland" <?=iif($pais=="Switzerland",'selected="selected"','');?>>Switzerland</option> 
							<option value="Syrian Arab Republic" <?=iif($pais=="Syrian Arab Republic",'selected="selected"','');?>>Syrian Arab Republic</option> 
							<option value="Taiwan, Province of China" <?=iif($pais=="Taiwan, Province of China",'selected="selected"','');?>>Taiwan, Province of China</option> 
							<option value="Tajikistan" <?=iif($pais=="Tajikistan",'selected="selected"','');?>>Tajikistan</option> 
							<option value="Tanzania, United Republic of" <?=iif($pais=="Tanzania, United Republic of",'selected="selected"','');?>>Tanzania, United Republic of</option> 
							<option value="Thailand" <?=iif($pais=="Thailand",'selected="selected"','');?>>Thailand</option> 
							<option value="Timor-leste" <?=iif($pais=="Timor-leste",'selected="selected"','');?>>Timor-leste</option> 
							<option value="Togo" <?=iif($pais=="Togo",'selected="selected"','');?>>Togo</option> 
							<option value="Tokelau" <?=iif($pais=="Tokelau",'selected="selected"','');?>>Tokelau</option> 
							<option value="Tonga" <?=iif($pais=="Tonga",'selected="selected"','');?>>Tonga</option> 
							<option value="Trinidad and Tobago" <?=iif($pais=="Trinidad and Tobago",'selected="selected"','');?>>Trinidad and Tobago</option> 
							<option value="Tunisia" <?=iif($pais=="Tunisia",'selected="selected"','');?>>Tunisia</option> 
							<option value="Turkey" <?=iif($pais=="Turkey",'selected="selected"','');?>>Turkey</option> 
							<option value="Turkmenistan" <?=iif($pais=="Turkmenistan",'selected="selected"','');?>>Turkmenistan</option> 
							<option value="Turks and Caicos Islands" <?=iif($pais=="Turks and Caicos Islands",'selected="selected"','');?>>Turks and Caicos Islands</option> 
							<option value="Tuvalu" <?=iif($pais=="Tuvalu",'selected="selected"','');?>>Tuvalu</option> 
							<option value="Uganda" <?=iif($pais=="Uganda",'selected="selected"','');?>>Uganda</option> 
							<option value="Ukraine" <?=iif($pais=="Ukraine",'selected="selected"','');?>>Ukraine</option> 
							<option value="United Arab Emirates" <?=iif($pais=="United Arab Emirates",'selected="selected"','');?>>United Arab Emirates</option> 
							<option value="United Kingdom" <?=iif($pais=="United Kingdom",'selected="selected"','');?>>United Kingdom</option> 
							<option value="United States" <?=iif($pais=="United States",'selected="selected"','');?>>United States</option> 
							<option value="United States Minor Outlying Islands" <?=iif($pais=="United States Minor Outlying Islands",'selected="selected"','');?>>United States Minor Outlying Islands</option> 
							<option value="Uruguay" <?=iif($pais=="Uruguay",'selected="selected"','');?>>Uruguay</option> 
							<option value="Uzbekistan" <?=iif($pais=="Uzbekistan",'selected="selected"','');?>>Uzbekistan</option> 
							<option value="Vanuatu" <?=iif($pais=="Uzbekistan",'selected="selected"','');?>>Vanuatu</option> 
							<option value="Venezuela, Bolivarian Republic of" <?=iif($pais=="Venezuela, Bolivarian Republic of",'selected="selected"','');?>>Venezuela, Bolivarian Republic of</option> 
							<option value="Viet Nam" <?=iif($pais=="Viet Nam",'selected="selected"','');?>>Viet Nam</option> 
							<option value="Virgin Islands, British" <?=iif($pais=="Virgin Islands, British",'selected="selected"','');?>>Virgin Islands, British</option> 
							<option value="Virgin Islands, U.S." <?=iif($pais=="Virgin Islands, U.S.",'selected="selected"','');?>>Virgin Islands, U.S.</option> 
							<option value="Wallis and Futuna" <?=iif($pais=="Wallis and Futuna",'selected="selected"','');?>>Wallis and Futuna</option> 
							<option value="Western Sahara" <?=iif($pais=="Western Sahara",'selected="selected"','');?>>Western Sahara</option> 
							<option value="Yemen" <?=iif($pais=="Yemen",'selected="selected"','');?>>Yemen</option> 
							<option value="Zambia" <?=iif($pais=="Zambia",'selected="selected"','');?>>Zambia</option> 
							<option value="Zimbabwe" <?=iif($pais=="Zimbabwe",'selected="selected"','');?>>Zimbabwe</option>
						</select>
                      </td>
                    </tr>
                    <tr>
                      <td>Tel&eacute;fono Hab.:</td>
                      <td><input name="telefono" type="text" size="33" style=" width:85%" value="<?=$telefono;?>"/></td>
                      <td>
                      Tel&eacute;fono Oficina:</td>
                      <td><input name="telefono2" type="text" size="33" style=" width:85%" value="<?=$telefono2;?>"/></td>
                    </tr>
                    <tr>
                      <td>Tel&eacute;fono M&oacute;vil:</td>
                      <td><input name="movil" type="text" size="33" style=" width:85%" value="<?=$movil;?>"/></td>
                      <td>Nivel Acad&eacute;mico: </td>
                      <td><input name="nivel" type="text" id="nivel"   style=" width:85%" value="<?=$nivel;?>" size="33"/></td>
                    </tr>
					 <tr>
                      <td>Correo Electr&oacute;nico:</td>
                      <td><input name="email" type="text" size="33" style=" width:85%" value="<?=$email;?>"/></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </table>
                </div>
                
                
		<div class="titulo_formulario">CUESTIONARIO DE SOLICITUD</div>
		<div class="contenedor_formulario" id="informacion_basica">
				<div class="item_formulario operador inversionista master estilista">
				<strong>&iquest;C&oacute;mo supo de nosotros?</strong><br/>
					<label>
						<input type="radio" name="nosotros" id="nosotros" value="Es cliente" <?=iif($nosotros =="Es cliente",'checked="checked"','')?>/> Es cliente
					</label>
					<label>					
					<input type="radio" name="nosotros" id="nosotros" value="Por un amigo" <?=iif($nosotros =="Por un amigo",'checked="checked"','')?>/> Por un amigo 
					</label>
					<label>					
						<input type="radio" name="nosotros" id="nosotros" value="P&aacute;gina Web" <?=iif($nosotros =="P&aacute;gina Web",'checked="checked"','')?>/> P&aacute;gina Web 
					</label>
					<label>						
						<input type="radio" name="nosotros" id="nosotros" value="Buscador" <?=iif($nosotros =="Buscador",'checked="checked"','')?>/> Buscador 
					</label>
					<label>						
						<input type="radio" name="nosotros" id="nosotros" value="Otros" <?=iif($nosotros =="Otros",'checked="checked"','')?>//> Otros 
					</label><br/>	
				</div>
							
				<div class="item_formulario estilista operador master inversionista">
					<strong>&iquest;En cu&aacute;l pa&iacute;s desea usted abrir su unidad de negocio?</strong><br/>
					
					<select name="pabrir" id="pabrir" style="width:30%;"> 
							<option value="" <?=iif($pabrir=="",'selected="selected"','');?>>Seleccione pa&iacute;s</option> 
							<option value="United States" <?=iif($pabrir=="United States",'selected="selected"','');?>>United States</option> 
							<option value="Mexico" <?=iif($pabrir=="Mexico",'selected="selected"','');?>>Mexico</option> 
							<option value="Argentina" <?=iif($pabrir=="Argentina",'selected="selected"','');?>>Argentina</option> 
							<option value="Afghanistan" <?=iif($pabrir=="Afghanistan",'selected="selected"','');?>>Afghanistan</option> 
							<option value="Albania" <?=iif($pabrir=="Albania",'selected="selected"','');?>>Albania</option> 
							<option value="Algeria" <?=iif($pabrir=="Algeria",'selected="selected"','');?>>Algeria</option> 
							<option value="American Samoa" <?=iif($pabrir=="American Samoa",'selected="selected"','');?>>American Samoa</option> 
							<option value="Andorra" <?=iif($pabrir=="Andorra",'selected="selected"','');?>>Andorra</option> 
							<option value="Angola" <?=iif($pabrir=="Angola",'selected="selected"','');?>>Angola</option> 
							<option value="Anguilla" <?=iif($pabrir=="Anguilla",'selected="selected"','');?>>Anguilla</option> 
							<option value="Antarctica" <?=iif($pabrir=="Antarctica",'selected="selected"','');?>>Antarctica</option> 
							<option value="Antigua and Barbuda" <?=iif($pabrir=="Antigua and Barbuda",'selected="selected"','');?>>Antigua and Barbuda</option> 
							<option value="Argentina" <?=iif($pabrir=="Argentina",'selected="selected"','');?>>Argentina</option> 
							<option value="Armenia" <?=iif($pabrir=="Armenia",'selected="selected"','');?>>Armenia</option> 
							<option value="Aruba" <?=iif($pabrir=="Aruba",'selected="selected"','');?>>Aruba</option> 
							<option value="Australia" <?=iif($pabrir=="Australia",'selected="selected"','');?>>Australia</option> 
							<option value="Austria" <?=iif($pabrir=="Austria",'selected="selected"','');?>>Austria</option> 
							<option value="Azerbaijan" <?=iif($pabrir=="Azerbaijan",'selected="selected"','');?>>Azerbaijan</option> 
							<option value="Bahamas" <?=iif($pabrir=="Bahamas",'selected="selected"','');?>>Bahamas</option> 
							<option value="Bahrain" <?=iif($pabrir=="Bahrain",'selected="selected"','');?>>Bahrain</option> 
							<option value="Bangladesh" <?=iif($pabrir=="Bangladesh",'selected="selected"','');?>>Bangladesh</option> 
							<option value="Barbados" <?=iif($pabrir=="Barbados",'selected="selected"','');?>>Barbados</option> 
							<option value="Belarus" <?=iif($pabrir=="Belarus",'selected="selected"','');?>>Belarus</option> 
							<option value="Belgium" <?=iif($pabrir=="Belgium",'selected="selected"','');?>>Belgium</option> 
							<option value="Belize" <?=iif($pabrir=="Belize",'selected="selected"','');?>>Belize</option> 
							<option value="Benin" <?=iif($pabrir=="Benin",'selected="selected"','');?>>Benin</option> 
							<option value="Bermuda" <?=iif($pabrir=="Bermuda",'selected="selected"','');?>>Bermuda</option> 
							<option value="Bhutan" <?=iif($pabrir=="Bhutan",'selected="selected"','');?>>Bhutan</option> 
							<option value="Bolivia" <?=iif($pabrir=="Bolivia",'selected="selected"','');?>>Bolivia</option> 
							<option value="Bosnia and Herzegovina" <?=iif($pabrir=="Bosnia and Herzegovina",'selected="selected"','');?>>Bosnia and Herzegovina</option> 
							<option value="Botswana" <?=iif($pabrir=="Botswana",'selected="selected"','');?>>Botswana</option> 
							<option value="Bouvet Island" <?=iif($pabrir=="Bouvet Island",'selected="selected"','');?>>Bouvet Island</option> 
							<option value="Brazil" <?=iif($pabrir=="Brazil",'selected="selected"','');?>>Brazil</option> 
							<option value="British Indian Ocean Territory" <?=iif($pabrir=="British Indian Ocean Territory",'selected="selected"','');?>>British Indian Ocean Territory</option> 
							<option value="Brunei Darussalam" <?=iif($pabrir=="Brunei Darussalam",'selected="selected"','');?>>Brunei Darussalam</option> 
							<option value="Bulgaria" <?=iif($pabrir=="Bulgaria",'selected="selected"','');?>>Bulgaria</option> 
							<option value="Burkina Faso" <?=iif($pabrir=="Burkina Faso",'selected="selected"','');?>>Burkina Faso</option> 
							<option value="Burundi" <?=iif($pabrir=="Burundi",'selected="selected"','');?>>Burundi</option> 
							<option value="Cambodia" <?=iif($pabrir=="Cambodia",'selected="selected"','');?>>Cambodia</option> 
							<option value="Cameroon" <?=iif($pabrir=="Cameroon",'selected="selected"','');?>>Cameroon</option> 
							<option value="Canada" <?=iif($pabrir=="Canada",'selected="selected"','');?>>Canada</option> 
							<option value="Cape Verde" <?=iif($pabrir=="Cape Verde",'selected="selected"','');?>>Cape Verde</option> 
							<option value="Cayman Islands" <?=iif($pabrir=="Cayman Islands",'selected="selected"','');?>>Cayman Islands</option> 
							<option value="Central African Republic" <?=iif($pabrir=="Central African Republic",'selected="selected"','');?>>Central African Republic</option> 
							<option value="Chad" <?=iif($pabrir=="Chad",'selected="selected"','');?>>Chad</option> 
							<option value="Chile" <?=iif($pabrir=="Chile",'selected="selected"','');?>>Chile</option> 
							<option value="China" <?=iif($pabrir=="China",'selected="selected"','');?>>China</option> 
							<option value="Christmas Island" <?=iif($pabrir=="Christmas Island",'selected="selected"','');?>>Christmas Island</option> 
							<option value="Cocos (Keeling) Islands" <?=iif($pabrir=="Cocos (Keeling) Islands",'selected="selected"','');?>>Cocos (Keeling) Islands</option> 
							<option value="Colombia" <?=iif($pabrir=="Colombia",'selected="selected"','');?>>Colombia</option> 
							<option value="Comoros" <?=iif($pabrir=="Comoros",'selected="selected"','');?>>Comoros</option> 
							<option value="Congo" <?=iif($pabrir=="Congo",'selected="selected"','');?>>Congo</option> 
							<option value="Congo, The Democratic Republic of The" <?=iif($pabrir=="Congo, The Democratic Republic of The",'selected="selected"','');?>>Congo, The Democratic Republic of The</option> 
							<option value="Cook Islands" <?=iif($pabrir=="Cook Islands",'selected="selected"','');?>>Cook Islands</option> 
							<option value="Costa Rica" <?=iif($pabrir=="Costa Rica",'selected="selected"','');?>>Costa Rica</option> 
							<option value="Cote D'ivoire" <?=iif($pabrir=="Cote D'ivoire",'selected="selected"','');?>>Cote D'ivoire</option> 
							<option value="Croatia" <?=iif($pabrir=="Croatia",'selected="selected"','');?>>Croatia</option> 
							<option value="Cuba" <?=iif($pabrir=="Cuba",'selected="selected"','');?>>Cuba</option> 
							<option value="Cyprus" <?=iif($pabrir=="Cyprus",'selected="selected"','');?>>Cyprus</option> 
							<option value="Czech Republic" <?=iif($pabrir=="Czech Republic",'selected="selected"','');?>>Czech Republic</option> 
							<option value="Denmark" <?=iif($pabrir=="Denmark",'selected="selected"','');?>>Denmark</option> 
							<option value="Djibouti" <?=iif($pabrir=="Djibouti",'selected="selected"','');?>>Djibouti</option> 
							<option value="Dominica" <?=iif($pabrir=="Dominica",'selected="selected"','');?>>Dominica</option> 
							<option value="Dominican Republic" <?=iif($pabrir=="Dominican Republic",'selected="selected"','');?>>Dominican Republic</option> 
							<option value="Ecuador" <?=iif($pabrir=="Ecuador",'selected="selected"','');?>>Ecuador</option> 
							<option value="Egypt" <?=iif($pabrir=="Egypt",'selected="selected"','');?>>Egypt</option> 
							<option value="El Salvador" <?=iif($pabrir=="El Salvador",'selected="selected"','');?>>El Salvador</option> 
							<option value="Equatorial Guinea"  <?=iif($pabrir=="Equatorial Guinea",'selected="selected"','');?>>Equatorial Guinea</option> 
							<option value="Eritrea" <?=iif($pabrir=="Eritrea",'selected="selected"','');?>>Eritrea</option> 
							<option value="Estonia" <?=iif($pabrir=="Estonia",'selected="selected"','');?>>Estonia</option> 
							<option value="Ethiopia" <?=iif($pabrir=="Ethiopia",'selected="selected"','');?>>Ethiopia</option> 
							<option value="Falkland Islands (Malvinas)" <?=iif($pabrir=="Falkland Islands (Malvinas)",'selected="selected"','');?>>Falkland Islands (Malvinas)</option> 
							<option value="Faroe Islands" <?=iif($pabrir=="Faroe Islands",'selected="selected"','');?>>>Faroe Islands</option> 
							<option value="Fiji" <?=iif($pabrir=="Fiji",'selected="selected"','');?>>Fiji</option> 
							<option value="Finland" <?=iif($pabrir=="Finland",'selected="selected"','');?>>Finland</option> 
							<option value="France" <?=iif($pabrir=="France",'selected="selected"','');?>>France</option> 
							<option value="French Guiana" <?=iif($pabrir=="French Guiana",'selected="selected"','');?>>French Guiana</option> 
							<option value="French Polynesia" <?=iif($pabrir=="French Polynesia",'selected="selected"','');?>>French Polynesia</option> 
							<option value="French Southern Territories"  <?=iif($pabrir=="French Southern Territories",'selected="selected"','');?>>French Southern Territories</option> 
							<option value="Gabon" <?=iif($pabrir=="Gabon",'selected="selected"','');?>>Gabon</option> 
							<option value="Gambia" <?=iif($pabrir=="Gambia",'selected="selected"','');?>>Gambia</option> 
							<option value="Georgia" <?=iif($pabrir=="Georgia",'selected="selected"','');?>>Georgia</option> 
							<option value="Germany" <?=iif($pabrir=="Germany",'selected="selected"','');?>>Germany</option> 
							<option value="Ghana" <?=iif($pabrir=="Ghana",'selected="selected"','');?>>Ghana</option> 
							<option value="Gibraltar" <?=iif($pabrir=="Gibraltar",'selected="selected"','');?>>Gibraltar</option> 
							<option value="Greece" <?=iif($pabrir=="Greece",'selected="selected"','');?>>Greece</option> 
							<option value="Greenland" <?=iif($pabrir=="Greenland",'selected="selected"','');?>>Greenland</option> 
							<option value="Grenada"  <?=iif($pabrir=="Grenada",'selected="selected"','');?>>Grenada</option> 
							<option value="Guadeloupe" <?=iif($pabrir=="Guadeloupe",'selected="selected"','');?>>Guadeloupe</option> 
							<option value="Guam" <?=iif($pabrir=="Guam",'selected="selected"','');?>>Guam</option> 
							<option value="Guatemala" <?=iif($pabrir=="Guatemala",'selected="selected"','');?>>Guatemala</option> 
							<option value="Guinea" <?=iif($pabrir=="Guinea",'selected="selected"','');?>>Guinea</option> 
							<option value="Guinea-bissau" <?=iif($pabrir=="Guinea-bissau",'selected="selected"','');?>>Guinea-bissau</option> 
							<option value="Guyana" <?=iif($pabrir=="Guyana",'selected="selected"','');?>>Guyana</option> 
							<option value="Haiti" <?=iif($pabrir=="Haiti",'selected="selected"','');?>>Haiti</option> 
							<option value="Heard Island and Mcdonald Islands" <?=iif($pabrir=="Heard Island and Mcdonald Islands",'selected="selected"','');?>>Heard Island and Mcdonald Islands</option> 
							<option value="Holy See (Vatican City State)" <?=iif($pabrir=="Holy See (Vatican City State)",'selected="selected"','');?>>Holy See (Vatican City State)</option> 
							<option value="Honduras" <?=iif($pabrir=="Honduras",'selected="selected"','');?>>Honduras</option> 
							<option value="Hong Kong" <?=iif($pabrir=="Hong Kong",'selected="selected"','');?>>Hong Kong</option> 
							<option value="Hungary"<?=iif($pabrir=="Hungary",'selected="selected"','');?>>Hungary</option> 
							<option value="Iceland" <?=iif($pabrir=="Iceland",'selected="selected"','');?>>Iceland</option> 
							<option value="India" <?=iif($pabrir=="India",'selected="selected"','');?>>India</option> 
							<option value="Indonesia" <?=iif($pabrir=="Indonesia",'selected="selected"','');?>>Indonesia</option> 
							<option value="Iran, Islamic Republic of" <?=iif($pabrir=="Iran, Islamic Republic of",'selected="selected"','');?>>Iran, Islamic Republic of</option> 
							<option value="Iraq" <?=iif($pabrir=="Iraq",'selected="selected"','');?>>Iraq</option> 
							<option value="Ireland" <?=iif($pabrir=="Ireland",'selected="selected"','');?>>Ireland</option> 
							<option value="Israel" <?=iif($pabrir=="Israel",'selected="selected"','');?>>Israel</option> 
							<option value="Italy" <?=iif($pabrir=="Italy",'selected="selected"','');?>>Italy</option> 
							<option value="Jamaica" <?=iif($pabrir=="Jamaica",'selected="selected"','');?>>Jamaica</option> 
							<option value="Japan" <?=iif($pabrir=="Japan",'selected="selected"','');?>>Japan</option> 
							<option value="Jordan" <?=iif($pabrir=="Jordan",'selected="selected"','');?>>Jordan</option> 
							<option value="Kazakhstan" <?=iif($pabrir=="Kazakhstan",'selected="selected"','');?>>Kazakhstan</option> 
							<option value="Kenya" <?=iif($pabrir=="Kenya",'selected="selected"','');?>>Kenya</option> 
							<option value="Kiribati" <?=iif($pabrir=="Kiribati",'selected="selected"','');?>>Kiribati</option> 
							<option value="Korea, Democratic People's Republic of" <?=iif($pabrir=="Korea, Democratic People's Republic of",'selected="selected"','');?>>Korea, Democratic People's Republic of</option> 
							<option value="Korea, Republic of" <?=iif($pabrir=="Korea, Republic of",'selected="selected"','');?>>Korea, Republic of</option> 
							<option value="Kuwait" <?=iif($pabrir=="Kuwait",'selected="selected"','');?>>Kuwait</option> 
							<option value="Kyrgyzstan" <?=iif($pabrir=="Kyrgyzstan",'selected="selected"','');?>>Kyrgyzstan</option> 
							<option value="Lao People's Democratic Republic" <?=iif($pabrir=="Lao People's Democratic Republic",'selected="selected"','');?>>Lao People's Democratic Republic</option> 
							<option value="Latvia" <?=iif($pabrir=="Latvia",'selected="selected"','');?>>Latvia</option> 
							<option value="Lebanon" <?=iif($pabrir=="Lebanon",'selected="selected"','');?>>Lebanon</option> 
							<option value="Lesotho" <?=iif($pabrir=="Lesotho",'selected="selected"','');?>>Lesotho</option> 
							<option value="Liberia" <?=iif($pabrir=="Liberia",'selected="selected"','');?>>Liberia</option> 
							<option value="Libyan Arab Jamahiriya" <?=iif($pabrir=="Libyan Arab Jamahiriya",'selected="selected"','');?>>Libyan Arab Jamahiriya</option> 
							<option value="Liechtenstein" <?=iif($pabrir=="Liechtenstein",'selected="selected"','');?>>Liechtenstein</option> 
							<option value="Lithuania" <?=iif($pabrir=="Lithuania",'selected="selected"','');?>>Lithuania</option> 
							<option value="Luxembourg" <?=iif($pabrir=="Luxembourg",'selected="selected"','');?>>Luxembourg</option> 
							<option value="Macao" <?=iif($pabrir=="Macao",'selected="selected"','');?>>Macao</option> 
							<option value="Macedonia, The Former Yugoslav Republic of" <?=iif($pabrir=="Macedonia, The Former Yugoslav Republic of",'selected="selected"','');?>>Macedonia, The Former Yugoslav Republic of</option> 
							<option value="Madagascar" <?=iif($pabrir=="Madagascar",'selected="selected"','');?>>Madagascar</option> 
							<option value="Malawi" <?=iif($pabrir=="Malawi",'selected="selected"','');?>>Malawi</option> 
							<option value="Malaysia" <?=iif($pabrir=="Malaysia",'selected="selected"','');?>>Malaysia</option> 
							<option value="Maldives" <?=iif($pabrir=="Maldives",'selected="selected"','');?>>Maldives</option> 
							<option value="Mali" <?=iif($pabrir=="Mali",'selected="selected"','');?>>Mali</option> 
							<option value="Malta" <?=iif($pabrir=="Malta",'selected="selected"','');?>>Malta</option> 
							<option value="Marshall Islands" <?=iif($pabrir=="Marshall Islands",'selected="selected"','');?>>Marshall Islands</option> 
							<option value="Martinique" <?=iif($pabrir=="Martinique",'selected="selected"','');?>>Martinique</option> 
							<option value="Mauritania" <?=iif($pabrir=="Mauritania",'selected="selected"','');?>>Mauritania</option> 
							<option value="Mauritius" <?=iif($pabrir=="Mauritius",'selected="selected"','');?>>Mauritius</option> 
							<option value="Mayotte" <?=iif($pabrir=="Mayotte",'selected="selected"','');?>>Mayotte</option> 
							<option value="Mexico" <?=iif($pabrir=="Mexico",'selected="selected"','');?>>Mexico</option> 
							<option value="Micronesia, Federated States of" <?=iif($pabrir=="Micronesia, Federated States of",'selected="selected"','');?>>Micronesia, Federated States of</option> 
							<option value="Moldova, Republic of" <?=iif($pabrir=="Moldova, Republic of",'selected="selected"','');?>>Moldova, Republic of</option> 
							<option value="Monaco" <?=iif($pabrir=="Monaco",'selected="selected"','');?>>Monaco</option> 
							<option value="Mongolia" <?=iif($pabrir=="Mongolia",'selected="selected"','');?>>Mongolia</option> 
							<option value="Montserrat" <?=iif($pabrir=="Montserrat",'selected="selected"','');?>>Montserrat</option> 
							<option value="Morocco" <?=iif($pabrir=="Morocco",'selected="selected"','');?>>Morocco</option> 
							<option value="Mozambique" <?=iif($pabrir=="Mozambique",'selected="selected"','');?>>Mozambique</option> 
							<option value="Myanmar" <?=iif($pabrir=="Myanmar",'selected="selected"','');?>>Myanmar</option> 
							<option value="Namibia" <?=iif($pabrir=="Namibia",'selected="selected"','');?>>Namibia</option> 
							<option value="Nauru" <?=iif($pabrir=="Nauru",'selected="selected"','');?>>Nauru</option> 
							<option value="Nepal" <?=iif($pabrir=="Nepal",'selected="selected"','');?>>Nepal</option> 
							<option value="Netherlands" <?=iif($pabrir=="Netherlands",'selected="selected"','');?>>Netherlands</option> 
							<option value="Netherlands Antilles" <?=iif($pabrir=="Netherlands Antilles",'selected="selected"','');?>>Netherlands Antilles</option> 
							<option value="New Caledonia" <?=iif($pabrir=="New Caledonia",'selected="selected"','');?>>New Caledonia</option> 
							<option value="New Zealand" <?=iif($pabrir=="New Zealand",'selected="selected"','');?>>New Zealand</option> 
							<option value="Nicaragua"  <?=iif($pabrir=="Nicaragua",'selected="selected"','');?>>Nicaragua</option> 
							<option value="Niger" <?=iif($pabrir=="Niger",'selected="selected"','');?>>Niger</option> 
							<option value="Nigeria" <?=iif($pabrir=="Nigeria",'selected="selected"','');?>>Nigeria</option> 
							<option value="Niue" <?=iif($pabrir=="Niue",'selected="selected"','');?>>Niue</option> 
							<option value="Norfolk Island" <?=iif($pabrir=="Norfolk Island",'selected="selected"','');?>>Norfolk Island</option> 
							<option value="Northern Mariana Islands" <?=iif($pabrir=="Northern Mariana Islands",'selected="selected"','');?>>Northern Mariana Islands</option> 
							<option value="Norway" <?=iif($pabrir=="Norway",'selected="selected"','');?>>Norway</option> 
							<option value="Oman" <?=iif($pabrir=="Oman",'selected="selected"','');?>>Oman</option> 
							<option value="Pakistan" <?=iif($pabrir=="Pakistan",'selected="selected"','');?>>Pakistan</option> 
							<option value="Palau" <?=iif($pabrir=="Palau",'selected="selected"','');?>>Palau</option> 
							<option value="Palestinian Territory, Occupied" <?=iif($pabrir=="Palestinian Territory, Occupied",'selected="selected"','');?>>Palestinian Territory, Occupied</option> 
							<option value="Panama" <?=iif($pabrir=="Panama",'selected="selected"','');?>>Panama</option> 
							<option value="Papua New Guinea" <?=iif($pabrir=="Papua New Guinea",'selected="selected"','');?>>Papua New Guinea</option> 
							<option value="Paraguay" <?=iif($pabrir=="Paraguay",'selected="selected"','');?>>Paraguay</option> 
							<option value="Peru" <?=iif($pabrir=="Peru",'selected="selected"','');?>>Peru</option> 
							<option value="Philippines" <?=iif($pabrir=="Philippines",'selected="selected"','');?>>Philippines</option> 
							<option value="Pitcairn" <?=iif($pabrir=="Pitcairn",'selected="selected"','');?>>Pitcairn</option> 
							<option value="Poland" <?=iif($pabrir=="Poland",'selected="selected"','');?>>Poland</option> 
							<option value="Portugal" <?=iif($pabrir=="Portugal",'selected="selected"','');?>>Portugal</option> 
							<option value="Puerto Rico" <?=iif($pabrir=="Puerto Rico",'selected="selected"','');?>>Puerto Rico</option> 
							<option value="Qatar" <?=iif($pabrir=="Qatar",'selected="selected"','');?>>Qatar</option> 
							<option value="Reunion"  <?=iif($pabrir=="Reunion",'selected="selected"','');?>>Reunion</option> 
							<option value="Romania" <?=iif($pabrir=="Romania",'selected="selected"','');?>>Romania</option> 
							<option value="Russian Federation" <?=iif($pabrir=="Russian Federation",'selected="selected"','');?>>Russian Federation</option> 
							<option value="Rwanda" <?=iif($pabrir=="Rwanda",'selected="selected"','');?>>Rwanda</option> 
							<option value="Saint Helena" <?=iif($pabrir=="Saint Helena",'selected="selected"','');?>>Saint Helena</option> 
							<option value="Saint Kitts and Nevis" <?=iif($pabrir=="Saint Kitts and Nevis",'selected="selected"','');?>>Saint Kitts and Nevis</option> 
							<option value="Saint Lucia" <?=iif($pabrir=="Saint Lucia",'selected="selected"','');?>>Saint Lucia</option> 
							<option value="Saint Pierre and Miquelon" <?=iif($pabrir=="Saint Pierre and Miquelon",'selected="selected"','');?>>Saint Pierre and Miquelon</option> 
							<option value="Saint Vincent and The Grenadines" <?=iif($pabrir=="Saint Vincent and The Grenadines",'selected="selected"','');?>>Saint Vincent and The Grenadines</option> 
							<option value="Samoa" <?=iif($pabrir=="Samoas",'selected="selected"','');?>>Samoa</option> 
							<option value="San Marino" <?=iif($pabrir=="San Marino",'selected="selected"','');?>>San Marino</option> 
							<option value="Sao Tome and Principe" <?=iif($pabrir=="Sao Tome and Principe",'selected="selected"','');?>>Sao Tome and Principe</option> 
							<option value="Saudi Arabia" <?=iif($pabrir=="Saudi Arabia",'selected="selected"','');?>>Saudi Arabia</option> 
							<option value="Senegal" <?=iif($pabrir=="Senegal",'selected="selected"','');?>>Senegal</option> 
							<option value="Serbia and Montenegro" <?=iif($pabrir=="Serbia and Montenegro",'selected="selected"','');?>>Serbia and Montenegro</option> 
							<option value="Seychelles" <?=iif($pabrir=="Seychelles",'selected="selected"','');?>>Seychelles</option> 
							<option value="Sierra Leone" <?=iif($pabrir=="Sierra Leone",'selected="selected"','');?>>Sierra Leone</option> 
							<option value="Singapore" <?=iif($pabrir=="Singapore",'selected="selected"','');?>>Singapore</option> 
							<option value="Slovakia" <?=iif($pabrir=="Slovakia",'selected="selected"','');?>>Slovakia</option> 
							<option value="Slovenia" <?=iif($pabrir=="Slovenia",'selected="selected"','');?>>Slovenia</option> 
							<option value="Solomon Islands" <?=iif($pabrir=="Solomon Islands",'selected="selected"','');?>>Solomon Islands</option> 
							<option value="Somalia" <?=iif($pabrir=="Somalia",'selected="selected"','');?>>Somalia</option> 
							<option value="South Africa" <?=iif($pabrir=="South Africa",'selected="selected"','');?>>South Africa</option> 
							<option value="South Georgia and The South Sandwich Islands" <?=iif($pabrir=="South Georgia and The South Sandwich Islands",'selected="selected"','');?>>South Georgia and The South Sandwich Islands</option> 
							<option value="Spain" <?=iif($pabrir=="Spain",'selected="selected"','');?>>Spain</option> 
							<option value="Sri Lanka" <?=iif($pabrir=="Sri Lanka",'selected="selected"','');?>>Sri Lanka</option> 
							<option value="Sudan" <?=iif($pabrir=="Sudan",'selected="selected"','');?>>Sudan</option> 
							<option value="Suriname" <?=iif($pabrir=="Suriname",'selected="selected"','');?>>Suriname</option> 
							<option value="Svalbard and Jan Mayen" <?=iif($pabrir=="Svalbard and Jan Mayen",'selected="selected"','');?>>Svalbard and Jan Mayen</option> 
							<option value="Swaziland" <?=iif($pabrir=="Swaziland",'selected="selected"','');?>>Swaziland</option> 
							<option value="Sweden" <?=iif($pabrir=="Sweden",'selected="selected"','');?>>Sweden</option> 
							<option value="Switzerland" <?=iif($pabrir=="Switzerland",'selected="selected"','');?>>Switzerland</option> 
							<option value="Syrian Arab Republic" <?=iif($pabrir=="Syrian Arab Republic",'selected="selected"','');?>>Syrian Arab Republic</option> 
							<option value="Taiwan, Province of China" <?=iif($pabrir=="Taiwan, Province of China",'selected="selected"','');?>>Taiwan, Province of China</option> 
							<option value="Tajikistan" <?=iif($pabrir=="Tajikistan",'selected="selected"','');?>>Tajikistan</option> 
							<option value="Tanzania, United Republic of" <?=iif($pabrir=="Tanzania, United Republic of",'selected="selected"','');?>>Tanzania, United Republic of</option> 
							<option value="Thailand" <?=iif($pabrir=="Thailand",'selected="selected"','');?>>Thailand</option> 
							<option value="Timor-leste" <?=iif($pabrir=="Timor-leste",'selected="selected"','');?>>Timor-leste</option> 
							<option value="Togo" <?=iif($pabrir=="Togo",'selected="selected"','');?>>Togo</option> 
							<option value="Tokelau" <?=iif($pabrir=="Tokelau",'selected="selected"','');?>>Tokelau</option> 
							<option value="Tonga" <?=iif($pabrir=="Tonga",'selected="selected"','');?>>Tonga</option> 
							<option value="Trinidad and Tobago" <?=iif($pabrir=="Trinidad and Tobago",'selected="selected"','');?>>Trinidad and Tobago</option> 
							<option value="Tunisia" <?=iif($pabrir=="Tunisia",'selected="selected"','');?>>Tunisia</option> 
							<option value="Turkey" <?=iif($pabrir=="Turkey",'selected="selected"','');?>>Turkey</option> 
							<option value="Turkmenistan" <?=iif($pabrir=="Turkmenistan",'selected="selected"','');?>>Turkmenistan</option> 
							<option value="Turks and Caicos Islands" <?=iif($pabrir=="Turks and Caicos Islands",'selected="selected"','');?>>Turks and Caicos Islands</option> 
							<option value="Tuvalu" <?=iif($pabrir=="Tuvalu",'selected="selected"','');?>>Tuvalu</option> 
							<option value="Uganda" <?=iif($pabrir=="Uganda",'selected="selected"','');?>>Uganda</option> 
							<option value="Ukraine" <?=iif($pabrir=="Ukraine",'selected="selected"','');?>>Ukraine</option> 
							<option value="United Arab Emirates" <?=iif($pabrir=="United Arab Emirates",'selected="selected"','');?>>United Arab Emirates</option> 
							<option value="United Kingdom" <?=iif($pabrir=="United Kingdom",'selected="selected"','');?>>United Kingdom</option> 
							<option value="United States" <?=iif($pabrir=="United States",'selected="selected"','');?>>United States</option> 
							<option value="United States Minor Outlying Islands" <?=iif($pabrir=="United States Minor Outlying Islands",'selected="selected"','');?>>United States Minor Outlying Islands</option> 
							<option value="Uruguay" <?=iif($pabrir=="Uruguay",'selected="selected"','');?>>Uruguay</option> 
							<option value="Uzbekistan" <?=iif($pabrir=="Uzbekistan",'selected="selected"','');?>>Uzbekistan</option> 
							<option value="Vanuatu" <?=iif($pabrir=="Uzbekistan",'selected="selected"','');?>>Vanuatu</option> 
							<option value="Venezuela, Bolivarian Republic of" <?=iif($pabrir=="Venezuela, Bolivarian Republic of",'selected="selected"','');?>>Venezuela, Bolivarian Republic of</option> 
							<option value="Viet Nam" <?=iif($pabrir=="Viet Nam",'selected="selected"','');?>>Viet Nam</option> 
							<option value="Virgin Islands, British" <?=iif($pabrir=="Virgin Islands, British",'selected="selected"','');?>>Virgin Islands, British</option> 
							<option value="Virgin Islands, U.S." <?=iif($pabrir=="Virgin Islands, U.S.",'selected="selected"','');?>>Virgin Islands, U.S.</option> 
							<option value="Wallis and Futuna" <?=iif($pabrir=="Wallis and Futuna",'selected="selected"','');?>>Wallis and Futuna</option> 
							<option value="Western Sahara" <?=iif($pabrir=="Western Sahara",'selected="selected"','');?>>Western Sahara</option> 
							<option value="Yemen" <?=iif($pabrir=="Yemen",'selected="selected"','');?>>Yemen</option> 
							<option value="Zambia" <?=iif($pabrir=="Zambia",'selected="selected"','');?>>Zambia</option> 
							<option value="Zimbabwe" <?=iif($pabrir=="Zimbabwe",'selected="selected"','');?>>Zimbabwe</option>
						</select><br/>
				</div>
				
				
				<div class="item_formulario operador  master estilista">
					<strong>&iquest;Su c&oacute;nyuge participar&aacute;?</strong><br/>
					<label><input type="radio" name="conyugue" id="conyugue" value="true" <?=iif($conyugue=="True",'checked="checked"',"");?>/>
					Si </label>
					<label><input type="radio" name="conyugue" id="conyugue" value="false" <?=iif($conyugue=="False",'checked="checked"',"");?>/> 
					No</label>
				</div>
				<div class="item_formulario operador inversionista master estilista">
					<strong>&iquest;Est&aacute; usted interesado en invertir con un socio?</strong><br/>
					<label><input type="radio" value="true" id="invertir" name="invertir"  <?=iif($invertir=="si",'checked="checked"',"");?> />
					Si </label>
					<label><input type="radio" value="false" id="invertir" name="invertir" <?=iif($invertir=="no",'checked="checked"',"");?>/> 
					No</label><br/>
					
				</div>
				
				<div class="item_formulario operador inversionista estilista">
					<strong>&iquest;Cu&aacute;nto estar&iacute;a dispuesto a invertir en su unidad de negocio?</strong><br/>

					<select name="inversion" id="inversion" style="width:30%;"> 
						<option value="0 - 100,000.00" <?=iif($inversion=="0 - 100,000.00",'selected="selected"',"");?>>0 - 100,000.00 $</option>
						<option value="100,001.00 - 200,000.00" <?=iif($inversion=="100,001.00 - 200,000.00",'selected="selected"',"");?>>100,001.00 - 200,000.00 $</option>
						<option value="200,001.00 - m&aacute;s" <?=iif($inversion=="200,001.00 - más",'selected="selected"',"");?>>200,001.00 - m&aacute;s $</option>
					</select> <br />
					

				</div>

			<!--	<div class="item_formulario  operador inversionista estilista">
					<strong>&iquest;En cu&aacute;nto tiempo quiere tener operativa su unidad de negocio?</strong><br/>
					
					<select name="otiempo" id="otiempo" style="width:30%;"> 
						<option value="3 meses" <?=iif($otiempo=="3 meses",'selected="selected"',"");?>>3 meses</option>
						<option value="5 meses" <?=iif($otiempo=="5 meses",'selected="selected"',"");?>>5 meses</option>
						<option value="1 a&ntilde;o" <?=iif($otiempo=="1 año",'selected="selected"',"");?>>1 a&ntilde;o</option>
					</select>

				</div>-->

				<div class="item_formulario estilista">
					<strong>&iquest;Tiene usted conocimiento de operaciones con franquicias?</strong><br/>
					<label><input type="radio" name="conocimiento" id="conocimiento" value="si" <?=iif($conocimiento=="si",'checked="checked"',"");?>/>
					Si </label>
					<label><input type="radio" name="conocimiento" id="conocimiento" value="no" <?=iif($conocimiento=="no",'checked="checked"',"");?>/> 
					No</label>
				</div>				
								
				<div class="item_formulario operador inversionista master">
					<strong>&iquest;Es usted propietario de alg&uacute;n negocio o franquicia?</strong><br/>
					<label><input type="radio" name="propietario" id="propietario" value="true" <?=iif($propietario=="si",'checked="checked"',"");?>/>
					Si </label>
					<label><input type="radio" name="propietario" id="propietario" value="false" <?=iif($propietario=="no",'checked="checked"',"");?>/> 
					No<br/></label>
					
					Si la respuesta es s&iacute;, por favor especifique el nombre de negocio o franquicia. <br/>
					<input type="text" name="nombre_franquicia" id="nombre_franquicia" value="<?=$nombre_franquicia;?>" style="width:30%;"/> 
					<br/>

				</div>

				<div class="item_formulario master">
					<strong>&iquest;Cu&aacute;ntas unidades puede abrir?</strong><br/>
				
					<input type="text" name="periodo3" id="periodo3" value="<?=$periodo3;?>" style="width:30%;"/> 	<br />
				</div>
				
				
				<div class="item_formulario master">
					<strong>&iquest;Tiene experiencia en el manejo de marcas?</strong><br/>
					<label><input type="radio" name="experiencia_manejo" id="experiencia_manejo" value="true" <?=iif($experiencia_manejo=="true",'checked="checked"',"");?>/>
					Si </label>
					<label><input type="radio" name="experiencia_manejo" id="experiencia_manejo" value="false" <?=iif($experiencia_manejo=="false",'checked="checked"',"");?>/> 
					No</label><br/>
					Si la respuesta es s&iacute;, por favor especifique <br/>
					<input type="text" name="em_descripcion" id="em_descripcion"  value="<?=$em_descripcion;?>" style="width:30%;"/> <br />
				</div>
				
				<div class="item_formulario operador inversionista estilista">
					<strong>&iquest;Conoce a alg&uacute;n franquiciado de Salvador?</strong><br/>
					<label><input type="radio" value="true" id="cfranquiciado" name="cfranquiciado" <?=iif($cfranquiciado=="true",'checked="checked"',"");?>/>
					Si </label>
					<label><input type="radio" value="false" id="cfranquiciado" name="cfranquiciado" <?=iif($cfranquiciado=="false",'checked="checked"',"");?> />
					No</label><br/>
					Si la respuesta es s&iacute;, por favor indique el nombre del franquiciado. <br/>
					<input type="text" name="nombre_franquiciado" id="nombre_franquiciado"  value="<?=$nombre_franquiciado;?>" style="width:30%;"/> <br/>


				</div>	
				
				<div class="item_formulario inversionista">
				<strong>&iquest;Estar&iacute;a usted dispuesto al aprendizaje para el manejo de la franquicia?</strong><br/>
					<label><input type="radio" value="true" id="aprendizaje" name="aprendizaje" <?=iif($aprendizaje=="true",'checked="checked"',"");?>/>
					Si</label> 
					<label><input type="radio" value="false" id="aprendizaje" name="aprendizaje" <?=iif($aprendizaje=="false",'checked="checked"',"");?>/> 
					No</label><br/>
				</div>

				<div class="item_formulario inversionista">
					<strong>&iquest;Tiene personal considerado para llevar a cabo la operaci&oacute;n?</strong><br/>
					<label><input type="radio" value="true" id="personal" name="personal" <?=iif($personal=="true",'checked="checked"',"");?>/>
					Si</label> 
					<label><input type="radio" value="false" id="personal" name="personal" <?=iif($personal=="false",'checked="checked"',"");?>/> 
					No</label>
					<br/>
					Si la respuesta es s&iacute;, por favor especifique <br/>				
					<input type="text" name="tipo_personal" id="tipo_personal"  value="<?=$tipo_personal;?>" style="width:30%;"/> <br/>
				</div>
				
				<div class="item_formulario operador">
					<strong>&iquest;Estar&iacute;a Ud. involucrado en la operaci&oacute;n de franquicia?</strong><br/>
					<label><input type="radio" value="true" id="involucrado" name="involucrado" <?=iif($involucrado=="true",'checked="checked"',"");?>/>
					Si</label> 
					<label><input type="radio" value="false" id="involucrado" name="involucrado" <?=iif($involucrado=="false",'checked="checked"',"");?>/> 
					No</label>
					<br/>
					Si la respuesta es no, por favor escriba el nombre y apellido del operador. <br/>
					<input type="text" name="involucrado_nombre" id="involucrado_nombre" value="<?=$involucrado_nombre;?>" style="width:30%;"/> <br/>
				</div>

				<div class="item_formulario operador master estilista">
					<strong>Dedicaci&oacute;n a tiempo completo ?</strong><br/>
					<label><input type="radio" value="true" id="dedicacion" name="dedicacion" <?=iif($dedicacion=="true",'checked="checked"',"");?>/>
					Si</label> 
					<label><input type="radio" value="false" id="dedicacion" name="dedicacion" <?=iif($dedicacion=="false",'checked="checked"',"");?>/> 
					No</label>
				</div>	

				<div class="item_formulario operador inversionista">
					<strong>&iquest;Cuenta con un lugar para la franquicia?</strong><br/>
					<label><input type="radio" value="true" id="lugar" name="lugar" <?=iif($lugar=="true",'checked="checked"',"");?>/>
					Si</label> 
					<label><input type="radio" value="false" id="lugar" name="lugar" <?=iif($lugar=="false",'checked="checked"',"");?>/> 
					No</label>
					<br/>
					Si la respuesta es s&iacute;, por favor indique la direcci&oacuten del local <br/>
					<input type="text" name="direccion_lugar" id="direccion_lugar"  value="<?=$direccion_lugar;?>" style="width:30%;"/> <br/>
				</div>
				
				<div class="item_formulario operador inversionista">
					<strong>&iquest;En cu&aacute;nto tiempo quiere aperturar su unidad de negocio?</strong><br/>
					<select name="apertura" id="apertura" style="width:30%;"/> 
					<option value="3 mes" <?=iif($apertura=="3 meses",'selected="selected"',"");?>>3 meses</option>
					<option value="5 mes" <?=iif($apertura=="5 meses",'selected="selected"',"");?>>5 mes</option>
					<option value="1 a&ntilde;o" <?=iif($apertura=="1 a&ntilde;o",'selected="selected"',"");?>>1 a&ntilde;o</option>
					</select><br/>
				</div>			
				<div class="item_formulario inversionista master">
					<strong>&iquest;Est&aacute; interesado en operar toda una regi&oacute;n o pa&iacute;s?</strong><br/>
					<label><input type="radio" value="true" id="operar_rp" name="operar_rp"  <?=iif($operar_rp=="true",'checked="checked"',"");?>/>
					Si </label>
					<label><input type="radio" value="false" id="operar_rp" name="operar_rp" <?=iif($operar_rp=="false",'checked="checked"',"");?>/> 
					No</label>
					<br/>
					Si la respuesta es s&iacute;, por favor especifique <br/>
					<input type="text" name="region_onombre" id="region_onombre" value="<?=$region_onombre;?>" style="width:30%;"/> <br/>
				</div>
			<br><br><div class="g-recaptcha" data-sitekey="6LdmUQcUAAAAACBfgGVynDxcUrqAGBbu8GnRrivZ"></div>
				<div class="item_formulario">
					<input type="submit" name="enviar" id="enviar"  width="73" height="24" value="Enviar solicitud"/>
				</div>
				
		</div>
	</div>
	</form>
</div>
  <script src='https://www.google.com/recaptcha/api.js'></script>

  <?php  //include("footer.html");?>





