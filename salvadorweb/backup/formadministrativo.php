<?php  include("header.html");
	 include("iweb/sitio/funciones.php");
  if($_POST){
  
  
	$nombre=limpia($_POST['nombre']);
	$apellido=limpia($_POST['apellido']);
	$telefono=limpia($_POST['telefono']);
	$sexo=limpia($_POST['sexo']);
	$email=limpia($_POST['email']);
	$area=limpia($_POST['area']);
	$experiencia=limpia($_POST['experiencia']);
	if($nombre=="") {$error.=" - Debe ingresar su nombre <br/>"; }
	if($apellido=="") {$error.=" - Debe ingresar su apellido <br/>"; }
	if($telefono=="") {$error.=" - Debe ingresar una tel&eacute;fono <br/>";}
	if($sexo=="") {$error.=" - Debe seleccionar un sexo <br/>"; }
	if($email=="") {$error.=" - Debe ingresar un correo val&iacute;do <br/>"; }
	if($area=="") {$error.=" - Debe ingresar un &aacute;rea de Inter&eacute;s <br/>";}
	if($experiencia=="") {$error.=" - Debe ingresar alguna experiencia laboral <br/>"; }
	
	if ($error==""){
		
		$para="franquicia@salvador.com.ve,administracion@salvador.com.ve,info@salvador.com.ve";
		$de="Info";
		$dominio="www.salvador.com.ve";
		$asunto="Nueva solicitud de personal";
		$from_header="MIME-Version: 1.0"."\r\n";
		$from_header.="Content-type: text/html; charset=iso-8859-1"."\r\n"; 
		$from_header.="From: ".$de." <info@".$dominio.">"."\r\n";
		$from_header.="Bcc: eirausquin@avacom.com.ve\r\n";
		$cuerpo="ha recibido una solicitud de imcorporacion como empleado<br/><br/><br/><br/>
		se ha recibido los siguentes datos:<br/><br/>
		nombres: $nombre<br/>
		Apellidos: $apellidos<br/>
		Telefono : $telefono<br/>
		Sexo: $sexo<br/>
		Email: $email<br/>
		Área de interes: $area<br/>
		Experiencia laboral: $experiencia<br/>";
			if ($para<>"" and $de<>"" and $dominio<>"" and $asunto<>"" and $cuerpo<>"") {
				//mail($para,$asunto,$cuerpo,$from_header);
				$rs=iweb_guardar_data("iweb_administrativo","nombre,apellido,telefono,sexo,email,experincia,estado","'$nombre','$apellido','$telefono','$sexo','$email','$experiencia','0'");
					$dominio="";
					$nombre="";
					$apellido="";
					$telefono="";
					$email="";
					$sexo="";
					$experiencia;
					$area="";
					$error="";
					$exito="1";
			}
		}
	}
?>
<script type="text/javascript" src="Scripts/jquery.min.js"	></script>
<div id="AVA_CONTENEDOR_PRINCIPAL">
		<div id="home_cont_keep_out"  class="border-header-center" style=" clear:both;width:997px; min-height:540px; height:auto; overflow:auto; margin: 0 auto; background-color:#fff;padding-bottom:10px;">
			<div id="grey_box" style="width:877px;height:181px;margin:auto;"><img src="images/franchises.jpg" width="877" height="181" /></div>
			<div style="width:877px; min-height:450px; height:auto; margin:auto">
				<div class="AVA_TITULO" style="margin: 28px 0 0 0; height:100%; overflow:auto;text-align:justify">FORMATO DE EMPLEO</div>
				<div class="line_cont" style="height:6px;float:left;width:100%;"><img src="images/hor_line_cont_large.jpg" width="877" height="6" /></div>
				<form name="form1" action ="<?=$_SERVER["PHP_SELF"];?>" method="POST">
					<div style="width:410px; height:230px;float:left">
					  <div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">INFORMACION PERSONAL</div>
						<table style="width:100%" cellspacing="0" cellpadding="3">
							<tr>	
								<td align="right" width="30%">Nombre:</td>
								<td align="left" width="70%"><input name="nombre" id ="nombre" value="<?=$nombre;?>" style="width:98%"></td>
							</tr>
							<tr class="gray_form_bg">
								<td align="right" >Apellidos:</td>
								<td align="left"><input name="apellido" id ="apellido" value="<?=$apellido;?>"style="width:98%"></td>						
							</tr>
							<tr>
								<td align="right" >Telefono:</td>
								<td align="left"><input name="telefono" id ="telefono" value="<?=$telefono;?>"style="width:98%"></td>						
							</tr>
							<tr class="gray_form_bg">
								<td align="right" >Sexo:</td>
								<td align="left">Femenino: &nbsp;<input type="radio" name="sexo" value="M" <?iif($sexo =="M",'checked="checked"',"");?>/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Masculino: &nbsp;<input type="radio" name="sexo" value="M" <?iif($sexo =="F",'checked="checked"',"");?>/></td>						
							</tr>	
							<tr>
								<td align="right" >Email:</td>
								<td align="left"><input name="email" id ="email" value="<?=$email;?>"style="width:98%"></td>						
							</tr>
							<tr class="gray_form_bg">
								<td align="right" >&Aacute;rea de Inter&eacute;s:</td>
								<td align="left"><input name="area" id ="area" value="<?=$area;?>"style="width:98%"></td>						
							</tr>
						</table>	
					</div>
					<div style="width:4px;height:200px;float:left;margin:0 15px 0 15px;border-right:solid; border-color:#999;border-width:1px"></div>
					<div style="width:430px; height:300px;float:left">
					<table style="width:100%;" cellspacing="0" cellpadding="3">
						<tr >
						<td align="right" width="30%" valign="top" style="padding-top:10px">Experiencia Laboral:<td>
						<td align="left" width="70%"><textarea id="experiencia" name="experiencia" style="width:98%;height:190px"><?$experiencia;?></textarea><td>
						</tr>
					</table>
					</div>
					 <div  style="float:left; margin-top:-30px; width:100%;" align="center">
						<input  type="submit" name="enviar" id="enviar"  width="73" height="24" value="Enviar"/>
					</div>
				</form>
				<div style="float:left; width:350px; margin:-60px 0 20px 30px;">
							<? if($error<>"" && $_POST){?><div class="error"><div><?=$error;?></div></div> <? }?>
							<? if($exito<>"" && $_POST){?><div class="exito"><div>su informaci&oacute;n ha sido enviada exitosamente.</div></div><? }?>
				 </div>
			</div>
		</div>
</div>
  <?php  include("footer.html");?>





