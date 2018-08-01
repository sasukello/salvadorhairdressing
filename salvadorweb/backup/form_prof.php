<?php
 include("header.html");
 include ("iweb/sitio/funciones.php");
  if($_POST){
	$ip = getRealIP();
	$nombre = limpia($_POST['nombre']); 
	$ci = limpia($_POST['ci']); 
	$apellido = limpia($_POST['apellido']); 
	$telefono = limpia($_POST['telefono']); 
	$fnac = limpia($_POST['fnac']);  
	$celular = limpia($_POST['celular']); 
	$email = limpia($_POST['email']); 	 
	$nacionalidad = $_POST['nacionalidad']; 
	$certificado =  $_POST['certificado']; 
	$edad =  limpia($_POST['edad']); 
	$civil =  limpia($_POST['civil']); 
	$rif =  limpia($_POST['rif']);
	$religion =  limpia($_POST['religion']); 
	$hijos =  limpia($_POST['hijos']); 
	$direccion =  limpia($_POST['direccion']); 
	$primaria = $_POST['primaria']; 
	$bachillerato	= $_POST['bachillerato']; 
	$universitaria  = $_POST['universitaria']; 
	$cursos= limpia($_POST['cursos']); 
	$familiar = $_POST['familiar']; 
	if(buscar($familiar,"Other")) $fotro=limpia($_POST['fotro']); 
	$vehiculo = limpia($_POST['vehiculo']); 
	$vivienda = limpia($_POST['vivienda']); 
	$cemp = $_POST['cemp'];
	$cnombre = limpia($_POST['cnombre']); 
	$ref_nombre = $_POST['ref_nombre']; 
	$ref_tel = $_POST['ref_tel']; 
	$comentario = limpia($_POST['comentario']);
	$tec_cap = $_POST['tec_cap']; 
	if(buscar($tec_cap,"Other"))  $tec_nombre=limpia($_POST['tec_nombre']); 
	$mp = $_POST['mp'];  
	if(buscar($mp,"Other"))	$mp_nombre=limpia($_POST['mp_nombre']);
	$medio = $_POST['medio']; 
	if($medio=="Other") $medio_m=limpia($_POST['medio_m']); 
	$es1 = $_POST['es1']; 
	$es2 = $_POST['es2']; 
	$br =  $_POST['br']; 
	$aexp = limpia($_POST['aexp']);
	/*$emp_nombre=$_POST['emp_nombre'];
	$emp_jefe = $_POST['emp_jefe'];
	$emp_mot = $_POST['emp_mot'];
	$emp_tel = $_POST['emp_tel'];*/
	$deacuerdo = limpia($_POST['deacuerdo']);
	if($nombre=="") $error = "- Debe ingresar un nombre<br/>";
	if($ci=="")  $error .=  "- Debe ingresar una c&eacute;dula<br/>";
	if($apellido=="")  $error .=  "- Debe ingresar un apellido<br/>";
	if($telefono=="")  $error .=  "- Debe ingresar un tel&eacute;fono<br/>";
	if(!datecheck($fnac))  $error .=  "- Debe ingresar una fecha nacimiento v&aacute;lida<br/>";
	if($celular=="")  $error .=  "- Debe ingresar un celular<br/>";
	if(!validmail($email))  $error .=  "- Debe ingresar una dirección de correo electr&oacute;nico<br/>";
	if($nacionalidad=="")  $error .=  "- Debe seleccionar una naconalidad<br/>";
	if($edad=="")  $error .=  "- Debe ingresar su edad<br/>";
	if($civil=="")  $error .=  "- Debe seleccionar su estado civil<br/>";
	if($rif=="")  $error .=  "- Debe ingresar su R.I.F.<br/>";
	if($religion=="")  $error .=  "- Debe ingresar una religi&oacute;n<br/>";
	if($direccion=="")  $error .=  "- Debe ingresar una direcci&oacute;n<br/>";
	if (buscar($familiar,"Other")&& $fotro=="") $error .=  "- Debe ingresar el campo otro en familiar <br/>";
	if ($cemp=="Si" && trim($cnombre)=="") $error .=  "- Debe ingresar el campo nombre  en disponibilidad de ingreso <br/>";
	$v = (count($tec_cap)==0 && count($mp)==0 &&  count($es1)==0 &&   count($es2)==0 &&  count($br)==0);
	if($v===true) $error .=  "- Debe seleccionar al menos alg&uacute;n rengl&oacute;n en formato de asociado <br/>";
	if(buscar($tec_cap,"Other") && $tec_nombre=="") $error .=  "- Debe ingresar el campo otro en t&eacute;cnico capilar <br/>";
	if(buscar($mp,"Other") && $tec_nombre=="") 		$error .=  "- Debe ingresar el campo otro en manicure pedicure <br/>";
	if($medio=="Other" && $medio_m=="")  $error .=  "- Debe ingresar el campo otro en medio  <br/>";	
	if ($v!==true && $aexp=="")	$error .=  "- Debe ingresar los a&ntilde;os de experiencia  <br/>";	
	/*if($v!==true && (ArrVacio($emp_nombre)==0 && ArrVacio($emp_mot)==0 && ArrVacio($emp_tel)==0 && ArrVacio($emp_jefe)==0)) $error .=  "- Debe ingresar todos los datos de alguna experiencia laboral <br/>";	*/
	if ($deacuerdo=="") 	$error .="- Debe aceptar la revisión de sus datos  <br/>";	
	if ($error==""){
		$para ="TALENTOHUMANO@SALVADORHAIRDRESSING.COM";
		//$para = "gentesalvador@salvador.com.ve,administracion@salvador.com.ve,info@salvador.com.ve";
		$de="Info";
		$dominio="www.salvadorhairdressing.com";
		$asunto="Nueva solicitud de Equipo Profesional";
		$from_header="MIME-Version: 1.0"."\r\n";
		$from_header.="Content-type: text/html; charset=iso-8859-1"."\r\n"; 
		$from_header.="From: ".$de." <info@".$dominio.">"."\r\n";
		$from_header.="Bcc: rrhh.servicio@salvadorhairdressing.com\r\n";
		$cuerpo='Ha recibido de su sitio WEB una  nueva forma de empleo profesional:<br />
		  <br />
		  <b>Datos Aportados:</b><br><br>
		  <span style="color:red">INFORMACI&Oacute;N PERSONAL</span><br>
		 Nombre: '.$nombre.'<br>
		 C.I: '.$ci.' <br>
		 Apellido: '.$apellido.'<br>
		 Tel&eacute;fono habitaci&oacute;n: '.$telefono.'<br>
		 Celular: '.$celular.'<br>
		 Fecha nacimiento: '.$fnac.' <br>
		 E-mail: '.$email.'<br>
		 Nacionalidad: '.$nacionalidad.'<br>
		 Certificado de Salud Vigente: '.$certificado.' <br>
		Edad: '.$edad.' <br>
		Estado Civil: '.$civil.'<br>
		R.I.F.: '.$rif.'<br>
		Religi&oacute;n: '.$religion.'<br>
		Direcci&oacute;n: '.$direccion.'<br>
		<br>
		<span style="color:red">ESTUDIOS REALIZADOS</span><br>
		 Primaria: '.$primaria.' <br>
		Bachillerato: '.$bachillerato.'<br>
		Universitaria: '.$universitaria.'<br>
		<br>
		<span style="color:red">CURSOS REALIZADOS</span><br/>
		'.$cursos.'<br>
		<br>
		<span style="color:red">CARGA FAMILIAR</span><br> 
		N&uacute;mero de Hijos: '.$hijos.'<br>';
		$cad=StrChange(ArrToCad($familiar),",Other",$fotro);
		$cuerpo.='Familiar: '.$cad.'<br>
		Veh&iacute;culo propio: '.$vehiculo.'<br>
		Vivienda: '.$vivienda.'<br> <br>
		<span style="color:red">DISPONIBILIDAD E INGRESOS</span><br>
		Conoce a alguien que trabaje en esta empresa: '.$cemp.'<br>';
		if($cemp<>"No")
			$cuerpo.='Nombre: '.$cnombre.'<br>';
		$cuerpo.='<br><span style="color:red">REFERENCIAS PERSONALES</span><br>';
		foreach($ref_nombre as $key => $value){
		if($value<>""){
			$cuerpo.='<b>Referencia '.($key+1).':</b><br>
					  Nombre: '.$value.' <br>
					  Tel&eacute;fono:'.$ref_tel[$key].'<br>
					  <br>';
			}		  
		}
		$cuerpo.='<span style="color:red">COMENTARIO</span><br>
		'.$comentario.'<br><br>

		<span style="color:red">FORMATO DE ASOCIACI&Oacute;N</span><br>';
		$cad=StrChange(ArrToCad($tec_cap),"Other",$tec_nombre);
		$cuerpo.=' T&eacute;cnico capilar: '.$cad.'<br>';
		$cad=StrChange(ArrToCad($$mp),"Other",$mp_nombre);
		$cuerpo.='Manicure Pedicure: '.$cad.'<br>';
		$cuerpo.='Estilista I:'.ArrToCad($es1).'<br>';
		$cuerpo.='Estilista II:'.ArrToCad($es2).'<br>';
		$cuerpo.='Barbero:'.ArrToCad($br).'<br>';
		$cuerpo.='A&ntilde;os de experiencia en el &aacute;rea: '.$aexp.'<br>';
		$cad=StrChange($medio,",Other",$medio_m);
		$cuerpo.='A trav&eacute;s de que medio se enter&oacute; de nosotros:'.$cad.'<br>
		  <br>';

		  $cuerpo.= "Declaro que los datos suministrados por mi en esta solicitud son ciertos y estar&eacute; de acuerdo que los mismos sean verificados por la empresa:<br>".iif($deacuerdo=="Si","Si","No")."<br><br/>";
		 	 $cuerpo.="<strong>Ip:</strong> $ip<br/>";
		if ($para<>"" and $de<>"" and $dominio<>"" and $asunto<>"" and $cuerpo<>"") {
		  $col="fecha,nombre,apellido,direccion,telf,cel,fnac,email,ci,nac,certificado,edad,civil,hijos,religion,primaria,bachillerato,universitaria,tec_capilar,tec_nombre,mani_pedi,mp_nombre,Estilista1,Estilista2,Barbero,medio,medio_m,anose,cursos,empresa,jefei,motivo,telh,familiar,fotro,vivienda,ref_nombre,ref_tel,comentario,aceptar,rif,vehiculo,cemp,cnombre,ipaddress";
		  $dato ="'".date('Y-m-d')."','$nombre','$apellido','$direccion','$telefono','$celular','".date('Y-m-d',StrToT($fnac))."','$email','$ci','$nacionalidad','$certificado','$edad','$civil','$hijos','$religion','$primaria','$bachillerato','$universitaria','".ArrToCad($tec_cap)."','$tec_nombre','".ArrToCad($mp)."','$mp_nombre','".ArrToCad($es1)."','".ArrToCad($es2)."','".ArrToCad($br)."','$medio','$medio_m','$aexp','$cursos','".ArrToCad($emp_nombre)."','".ArrToCad($emp_jefe)."','".ArrToCad($emp_mot)."','".ArrToCad($emp_tel)."','".ArrToCad($familiar)."','$fotro','$vivienda','".ArrToCad($ref_nombre)."','".ArrToCad($ref_tel)."','$comentario','$deacuerdo','$rif','$vehiculo','$cemp','$cnombre','$ip'";
		 $rs=iweb_guardar_data("iweb_profesional",$col,$dato);
		 mail($para,$asunto,$cuerpo,$from_header);
		$nombre = ""; 
		$ci = ""; 
		$apellido = ""; 
		$telefono = ""; 
		$fnac = "";  
		$celular = ""; 
		$email = ""; 	 
		$nacionalidad = ""; 
		$certificado = ""; 
		$edad =  ""; 
		$civil = ""; 
		$rif =  "";
		$religion =""; 
		$hijos =""; 
		$direccion =""; 
		$primaria =array(); 
		$bachillerato=array();
		$universitaria=array();
		$cursos= ""; 
		$familiar =array();
		$fotro=""; 
		$vehiculo =""; 
		$vivienda = ""; 
		$cemp = array();
		$cnombre = ""; 
		$ref_nombre=array();
		$ref_tel =array(); 
		$comentario="";
		$tec_cap =array();
		$tec_nombre="";
		$mp =array();
		$mp_nombre="";
		$medio =array();
		$medio_m=""; 
		$es1 =array();
		$es2 =array(); 
		$br =array();
		$aexp="";
		$emp_nombre=array();
		$emp_jefe =array();
		$emp_mot =array();
		$emp_tel =array();
		$deacuerdo ="";
		$error="";
		$cuerpo="";
		$exito ="1";
		
	}
 }
 }
?>
<script src="Scripts/jquery.min.js" type="text/javascript"></script>
<script src="Scripts/jquery.ui.draggable.js" type="text/javascript"></script>    
<script src="Scripts/jquery.alerts.js" type="text/javascript"></script>
<link href="css/jquery.alerts.css" rel="stylesheet" type="text/css" media="screen" />  
<script>
<? if($_POST && $error<>""){?>
jQuery(document).ready(function(){
 jAlert('error', '<?=$error;?>', 'Error');
}); 
<? }?>
</script>

<div id="AVA_CONTENEDOR_PRINCIPAL">
		<div id="home_cont_keep_out"  class="border-header-center" style=" clear:both;width:997px; min-height:540px; height:auto; overflow:auto; margin: 0 auto; background-color:#fff;padding-bottom:10px;">
			<div id="grey_box" style="width:877px;height:181px;margin:auto;"><img src="images/franchises.jpg" width="877" height="181" /></div>
			<div style="width:877px; min-height:450px; height:auto; margin:auto">
				<div class="AVA_TITULO" style="margin: 28px 0 0 0; height:100%; overflow:auto;text-align:justify">FORMATO DE ASOCIACI&Oacute;N</div>
				<div class="line_cont" style="height:6px;float:left;width:100%;"><img src="images/hor_line_cont_large.jpg" width="877" height="6" /></div>
				<form name="form1" action ="<?=$_SERVER["PHP_SELF"];?>" method="POST">
                  <div style="float:left;width:100%; height:auto; overflow:auto;">
						<!--lateral derecho-->
				    <div style="width:410px; height:auto; overflow:auto; float:left">
                        <div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">INFORMACI&Oacute;N PERSONAL</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="3">
								<tr>
								<td align="right" >Nombre:</td>
								<td><input id="nombre2" name="nombre" value="<?=$nombre;?>" style="width:98%"/></td>
							</tr>
							<tr class="gray_form_bg">
								<td align="right"  >Apellido:</td>
								<td><input id="apellido" name="apellido" value="<?=$apellido;?>" style="width:98%"/></td>
							</tr>
							<tr class="gray_form_bg">
								<td width="30%" align="right" >C.I.:</td>
								<td width="70%"><input id="ci" name="ci" value="<?=$ci;?>" style="width:98%"/></td>
							</tr>							
							<tr class="gray_form_bg">
								<td align="right"  >Tel&eacute;fono habitaci&oacute;n:</td>
								<td><input id="telefono" name="telefono" value="<?=$telefono;?>" style="width:98%"/></td>
							</tr>
							<tr>
								<td align="right"  >Celular:</td>
								<td><input id="celular" name="celular" value="<?=$celular;?>" style="width:98%"/></td>
							</tr>
							<tr class="gray_form_bg">
								<td align="right" >Fecha nacimiento:</td>
								<td><input id="fnac" name="fnac" value="<?=$fnac;?>" style="width:45%"/>&nbsp;(dd/mm/aaaa)</td>
							</tr>
							<tr>
								<td align="right" >E-mail:</td>
								<td><input id="email" name="email" value="<?=$email;?>" style="width:98%"/></td>
							</tr>
							<tr class="gray_form_bg">
								<td align="right" >Nacionalidad:</td>
								<td>
									V&nbsp;&nbsp;<input type="radio" name="nacionalidad" id="nacionalidad" value="V" <?=iif($nacionalidad=="V",'checked ="checked "',"");?> />&nbsp;&nbsp;&nbsp;
									E&nbsp;&nbsp;<input type="radio" name="nacionalidad" id="nacionalidad"  value="E" <?=iif($nacionalidad=="E",'checked ="checked "',"");?>/>
								</td>
							</tr>
							<tr>
								<td align="right" ><p>Certificado de salud vigente:</p></td>
								<td>Si&nbsp;&nbsp;<input type="radio" name="certificado" id="certificado" value="Si" <?=iif($certificado=="Si",'checked ="checked "',"");?>/>
								&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;
								<input type="radio" name="certificado" id="certificado" value="No" <?=iif($certificado=="No",'checked ="checked "',"");?>/> </td>
							</tr>
							<tr class="gray_form_bg">
								<td align="right" >Edad:</td>
								<td><input id="edad" name="edad" value="<?=$edad;?>" style="width:98%"/></td>
							</tr>
							<tr>
								<td align="right" >Estado civil:</td>
								<td><input id="civil" name="civil" value="<?=$civil;?>" style="width:98%"/></td>
							</tr>
							<tr>
								<td align="right" >R.I.F.:</td>
								<td><input id="civil3" name="rif" value="<?=$rif;?>" style="width:98%"/></td>
							</tr>
							<tr class="gray_form_bg">
								<td align="right" >Religi&oacute;n:</td>
								<td><input id="religion" name="religion" value="<?=$religion;?>" style="width:98%"/></td>
							</tr>
							<tr>
								<td align="right" valign="top" style="padding-top:4px;">Direcci&oacute;n:</td>
								<td><textarea name="direccion" rows="3" id="direccion" style="width:98%"><?=$direccion;?></textarea></td>
							</tr>
							</table>
							<br/>
							<div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">ESTUDIOS REALIZADOS</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
							<td width="30%" align="right" >Primaria:</td> 
							<td width="70%">Si&nbsp;&nbsp;<input type="radio" name="primaria" id="primaria" value="Si" <?=iif($primaria=="Si",'checked ="checked "',"");?>/>
							&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;
							<input type="radio" name="primaria" id="primaria" value="No" <?=iif($primaria=="No",'checked ="checked "',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right"  >Bachillerato:</td>
							<td>Si&nbsp;&nbsp;<input type="radio" name="bachillerato" id="bachillerato" value="Si" <?=iif($bachillerato=="Si",'checked ="checked "',"");?>/>
							&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;
							<input type="radio" name="bachillerato" id="bachillerato" value="No" <?=iif($bachillerato=="No",'checked ="checked "',"");?>/></td>
							</tr>
							<tr>
							<td align="right"  >Universitaria:</td>
							<td>Si&nbsp;&nbsp;<input type="radio" name="universitaria" id="universitaria" value="Si" <?=iif($universitaria=="Si",'checked ="checked "',"");?>/>
							&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;
							<input type="radio" name="universitaria" id="universitaria" value="No" <?=iif($universitaria=="No",'checked ="checked "',"");?>/></td>
							</tr>
							</table>		
							<br/>
							<div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">CURSOS REALIZADOS</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
							<td width="30%" valign="top" style="padding-top:4px;">Cursos realizados:</td> 
							<td width="70%"><textarea rows="3" style="width:98%" id="cursos" name="cursos"><?=$cursos;?></textarea></td>
							</tr>
							</table>
							<br/>	
							<div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">CARGA FAMILIAR</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
							<td align="right" >N&uacute;mero de hijos:</td>
							<td colspan="2"><input id="hijos" name="hijos" value="<?=$hijos;?>" style="width:98%"/></td>
							</tr>
							<tr class="gray_form_bg">
							<td width="30%" align="right" ><strong>Familiar:</strong></td> <td width="20%" align="right">Padre:</td>
							<td width="50%"><input name="familiar[]" type="checkbox" id="familiar1"  value="Padre" <?=iif(buscar($familiar,"Padre"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right"  >&nbsp;</td>
							<td align="right">Madre:</td>
							<td><input name="familiar[]" type="checkbox" id="familiar2" value="Madre" <?=iif(buscar($familiar,"Madre"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right"  >&nbsp;</td>
							<td align="right">Otros:</td>
							<td>
							<input name="familiar[]" type="checkbox" id="familiar3" onClick="ocultar('fotro');" value="Other" <?=iif(buscar($familiar,"Other"),'checked="checked"',"");?>/>
							<input type="text" name="fotro" id="fotro" value="<?=$fotro;?>" style="width:86%;<?=iif(buscar($familiar,"Other"),"","display:none;");?>"/></td>
							</tr>
							<tr>
							<td align="right"  ><p>Veh&iacute;culo propio:</p></td>
							<td colspan="2">Si&nbsp;&nbsp;
							<input type="radio" name="vehiculo" id="vehiculo" value="Si" <?=iif($vehiculo=="Si",'checked ="checked "',"");?>/>
							&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;
							<input type="radio" name="vehiculo" id="vehiculo" value="No" <?=iif($vehiculo=="No",'checked ="checked "',"");?>/></td>
							</tr>
							<tr>
							<td align="right"  >Vivienda:</td>
							<td colspan="2">Alquilada&nbsp;
							<input type="radio" name="vivienda" id="vivienda" value="Alquilada" <?=iif($vivienda=="Alquilada",'checked ="checked "',"");?>/>
							&nbsp;&nbsp;&nbsp;Propia&nbsp;&nbsp;
							<input type="radio" name="vivienda" id="vivienda" value="Propia" <?=iif($vivienda=="Propia",'checked ="checked "',"");?>/>&nbsp;&nbsp;&nbsp;Padre/Familiar
							<input type="radio" name="vivienda" id="vivienda" value="Padre/Familiar" <?=iif($vivienda=="Padre/Familiar",'checked ="checked "',"");?>/>
							</td>
							</tr>
							</table>	
							<br/>	
							<div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">DISPONIBILIDAD E INGRESOS</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
							<td width="40%" align="right" >Conoce a  alguien que trabaje en esta empresa:</td>
							<td width="60%" align="left" >Si&nbsp;&nbsp;
							<input type="radio" name="cemp" id="cemp" value="Si" <?=iif($cemp=="Si",'checked ="checked "',"");?>/>
							&nbsp;&nbsp;&nbsp;No&nbsp;&nbsp;
							<input type="radio" name="cemp" id="cemp" value="No" <?=iif($cemp=="No",'checked ="checked "',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" >Nombre:</td>
							<td align="right" ><input id="cnombre" name="cnombre" value="<?=$cnombre;?>" style="width:98%"/></td>
							</tr>
							</table>	
							<br/>	
							<div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">REFERENCIAS PERSONALES</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
							<td width="21%" align="center" ><b>Referencia 1:</b></td>
							<td width="23%" align="right" >Nombre:</td>
							<td width="56%" align="left" ><input id="ref_nombre1" name="ref_nombre[]" value="<?=$ref_nombre[0];?>" style="width:98%"/></td>
							</tr>
							<tr>
							<td align="center" >&nbsp;</td>
							<td align="right" >Tel&eacute;fono:</td>
							<td align="left" ><input id="ref_tel1" name="ref_tel[]" value="<?=$ref_tel[0];?>" style="width:98%"/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="center" ><b>Referencia 2:</b></td>
							<td align="right" >Nombre:</td>
							<td align="left" ><input id="ref_nombre2" name="ref_nombre[]" value="<?=$ref_nombre[1];?>" style="width:98%"/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="center" >&nbsp;</td>
							<td align="right" >Tel&eacute;fono:</td>
							<td align="left" ><input id="ref_tel3" name="ref_tel[]" value="<?=$ref_tel[1];?>" style="width:98%"/></td>
							</tr>
							<tr>
							<td align="center" ><b>Referencia 3:</b></td>
							<td align="right" >Nombre:</td>
							<td align="left" ><input id="ref_nombre3" name="ref_nombre[]" value="<?=$ref_nombre[2];?>" style="width:98%"/></td>
							</tr>
							<tr>
							<td align="center" >&nbsp;</td>
							<td align="right" >Tel&eacute;fono:</td>
							<td align="left" ><input id="ref_tel3" name="ref_tel[]" value="<?=$ref_tel[2];?>" style="width:98%"/></td>
							</tr>
							</table>
							<br/>
							<div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">COMENTARIO</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
							<td width="30%" align="center" >Comentario:</td>
							<td width="70%" align="left" ><textarea id="comentario" name="comentario"  style="width:98%"><?=$comentario;?></textarea></td>
							</tr>
							</table>

							</div>

							<div style="width:4px;height:1380px;float:left;margin:0 15px 0 15px;border-right:solid; border-color:#999;border-width:1px"></div>

							<!--lateral izquierdo-->
							<div style="width:430px; height:auto; overflow:auto; float:left">
							<div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">FORMATO DE ASOCIACI&Oacute;N	</div>
							<table width="100%" border="0" cellspacing="0" cellpadding="3">
							<tr>
							<td width="30%" align="right" valign="top" style="padding-top:4px;" ><strong>T&eacute;cnico capilar:</strong></td>
							<td width="19%" align="right">Avanzada:</td>
							<td width="51%"><input name="tec_cap[]" type="checkbox" id="tec_cap1" value="Avanzada" <?=iif(buscar($tec_cap,"Avanzada"),'checked="checked"',"");?>/></td>
							</tr>
							<tr>
							<td width="30%" align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Aprendiz:</td>
							<td><input name="tec_cap[]" type="checkbox" id="tec_cap2" value="Aprediz" <?=iif(buscar($tec_cap,"Aprendiz"),'checked="checked"',"");?>/></td>
							</tr>
							<tr>
							<td width="30%" align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Otros: </td>
							<td><input name="tec_cap[]" type="checkbox" id="tec_cap3" onClick="ocultar('tec_nombre');" value="Other" <?=iif(buscar($tec_cap,"Other"),'checked="checked"',"");?>/>
							<input id="tec_nombre" name="tec_nombre" value="<?=$tec_nombre;?>" style="width:87%;<?=iif(buscar($tec_cap,"Other"),"","display:none;");?>"/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" ><strong>Manicure Pedicure:</strong></td>
							<td align="right">Masajes Antiestres:</td>
							<td align="left"><input name="mp[]" type="checkbox" id="mp1" value="Masajes Antiestres" <?=iif(buscar($mp,"Masajes Antiestres"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Masoterapeuta (Reductivo):</td>
							<td align="left"><input name="mp[]" type="checkbox" id="mp2" value="Masoterapeuta (Reductivo)" <?=iif(buscar($mp,"Masoterapeuta (Reductivo)"),'checked="checked"',"");?>/>&nbsp;</td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Reflexología:</td>
							<td align="left"><input name="mp[]" type="checkbox" id="mp3" value="Reflexologia" <?=iif(buscar($mp,"Reflexologia"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Depilaci&oacute;n:</td>
							<td align="left"><input name="mp[]" type="checkbox" id="mp4" value="Depilaci&oacute;n" <?=iif(buscar($mp,"Depilación"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Mesoterapia:</td>
							<td align="left"><input name="mp[]" type="checkbox" id="mp5" value="Mesoterapia" <?=iif(buscar($mp,"Mesoterapia"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Drenaje Linf&aacute;tico:</td>
							<td align="left"><input name="mp[]" type="checkbox" id="mp6" value="Drenaje Linfatico" <?=iif(buscar($mp,"Drenaje Linfatico"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Aprendiz:</td>
							<td align="left"><input name="mp[]" type="checkbox" id="mp7" value="Aprediz" <?=iif(buscar($mp,"Aprendiz"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Otros:</td>
							<td align="left"><input name="mp[]" type="checkbox" id="mp8" onClick="ocultar('mp_nombre');" value="Other"<?=iif(buscar($mp,"Other"),'checked="checked"',"");?>/>
							<input id="mp_nombre" name="mp_nombre" value="<?=$mp_nombre;?>" style="width:87%;<?=iif(buscar($mp,"Other"),"","display:none;");?>"/></td>
							</tr>
							<tr>
							<td align="right" valign="top" style="padding-top:4px;" ><strong>Estilista I:</strong></td>
							<td align="right">Secado:</td>
							<td align="left"><input name="es1[]" type="checkbox" id="es11" value="Secado" <?=iif(buscar($es1,"Secado"),'checked="checked"',"");?>/></td>
							</tr>
							<tr>
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Corte:</td>
							<td align="left"><input name="es1[]" type="checkbox" id="es12" value="Corte" <?=iif(buscar($es1,"Corte"),'checked="checked"',"");?>/></td>
							</tr>
							<tr>
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right"> Colometr&iacute;a:</td>
							<td align="left"><input name="es1[]" type="checkbox" id="es13" value="Colometria" <?=iif(buscar($es1,"Colometria"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" ><strong>Estilista II:</strong></td>
							<td align="right">Secado:</td>
							<td align="left"><input name="es2[]" type="checkbox" id="es21" value="Secado" <?=iif(buscar($es2,"Secado"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Corte:</td>
							<td align="left"><input name="es2[]" type="checkbox" id="es22" value="Corte" <?=iif(buscar($es2,"Corte"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Colometr&iacute;a:</td>
							<td align="left"><input name="es2[]" type="checkbox" id="es23" value="Colometria"  <?=iif(buscar($es2,"Colometria"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Plantillas:</td>
							<td align="left"><input name="es2[]" type="checkbox" id="es24" value="Plantillas" <?=iif(buscar($es2,"Plantillas"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Mechas:</td>
							<td align="left"><input name="es2[]" type="checkbox" id="es25" value="Mechas" <?=iif(buscar($es2,"Mechas"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Peinado:</td>
							<td align="left"><input name="es2[]" type="checkbox" id="es26" value="Peinado" <?=iif(buscar($es2,"Peinado"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Desriz:</td>
							<td align="left"><input name="es2[]" type="checkbox" id="es27" value="Desrises" <?=iif(buscar($es2,"Desriz"),'checked="checked"',"");?>/></td>
							</tr>
							<tr>
							<td align="right" valign="top" style="padding-top:4px;" ><strong>Barbero:</strong></td>
							<td align="right">Corte:</td>
							<td align="left"><input name="br[]" type="checkbox" id="br1" value="Corte" <?=iif(buscar($br,"Corte"),'checked="checked"',"");?>/></td>
							</tr>
							<tr>
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Bigote:</td>
							<td align="left"><input name="br[]" type="checkbox" id="br2" value="Bigote" <?=iif(buscar($br,"Bigote"),'checked="checked"',"");?>/></td>
							</tr>
							<tr>
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Barba:</td>
							<td align="left"><input name="br[]" type="checkbox" id="br3" value="Barba" <?=iif(buscar($br,"Barba"),'checked="checked"',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" ><strong>A trav&eacute;s de que<br />medio se enter&oacute; de<br />nosotros:</strong></td>
							<td align="right">Asociado</td>
							<td align="left"><input name="medio" type="radio" id="medio"  value="Asociado" onClick="ocultar2('medio_m',this);"<?=iif($medio=="Asociado",'checked ="checked "',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Amigo</td>
							<td align="left"><input name="medio" type="radio" id="medio"  value="Amigo" onClick="ocultar2('medio_m',this);"<?=iif($medio=="Amigo",'checked ="checked "',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Prensa</td>
							<td align="left"><input name="medio" type="radio" id="medio"  value="Presa" onClick="ocultar2('medio_m',this);"<?=iif($medio=="Presa",'checked ="checked "',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Recomendado</td>
							<td align="left"><input name="medio" type="radio" id="medio"  value="Recomendado" onClick="ocultar2('medio_m',this);" <?=iif($medio=="Recomendado",'checked ="checked "',"");?>/></td>
							</tr>
							<tr class="gray_form_bg">
							<td align="right" valign="top" style="padding-top:4px;" >&nbsp;</td>
							<td align="right">Otro</td>
							<td align="left"><input name="medio" type="radio" id="medio"  value="Other"  onclick="ocultar2('medio_m',this);"<?=iif($medio=="Other",'checked ="checked "',"");?>/>
							<input type="text" name="medio_m" id="medio_m" value="<?=$medio_m;?>" style="width:88%;<?=iif($medio=="Other","","display:none");?>"/>
							</td>
							</tr>
							<tr >
							<td colspan="2" align="right" valign="top" style="padding-top:4px;" ><strong>A&ntilde;os de experiencia en el &aacute;rea:</strong></td>
							<td align="left"><input type="text" name="aexp" id="aexp" value="<?=$aexp;?>" style="width:96%"/></td>
							</tr>
							</table>
							<br/>
							
				 </div>
                   <div  style="float:left; margin-top:10px; width:100%;" >
						<br/>
		                      <b> Declaro que los  datos suministrados por mi en esta solicitud son ciertos y estar&eacute; de  acuerdo que los mismos sean verificados por la empresa:</b>					
                              &nbsp;&nbsp;<input type="checkbox" name="deacuerdo" id="deacuerdo" value="Si" <?=iif($deacuerdo=="Si",'checked ="checked "',"")?>/>
                         <br/>
				  </div>
                    <div  style="float:left; margin-top:10px; width:100%;" align="center">
						<input  type="submit" name="enviar" id="enviar"  width="73" height="24" value="Enviar"/>
				  </div>
                    
				</form>
			</div>
		</div>
</div>
  <?php  include("footer.html");?>



<script language="javascript">
	function ocultar(id){
		if (document.getElementById(id).style.display =="none")
			document.getElementById(id).style.display=""; 
		else	
			document.getElementById(id).style.display="none"; 
	}
	function ocultar2(id,este){
				var cad = este.value;
			if (cad=="Other")	
				document.getElementById(id).style.display=""; 
			else	
				document.getElementById(id).style.display="none"; 
	}
</script>

