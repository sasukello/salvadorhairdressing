<?php  include("header.html");
 include("iweb/sitio/funciones.php");
  if($_POST){
	$ip = getRealIP();
	$nombre=limpia($_POST['nombre']);
	$ciudad=limpia($_POST['ciudad']);
	$estado=limpia($_POST['estado']);
	$telefono=limpia($_POST['telefono']);
	$email=limpia($_POST['email']);
	$movil=limpia($_POST['movil']);
	$nivel=limpia($_POST['nivel']);
	$fechanac_day=$_POST['fechanac_day'];
	$fechanac_month=$_POST['fechanac_month'];
	$fechanac_year=$_POST['fechanac_year'];
	$fecha = $fechanac_year."-".$fechanac_month."-".$fechanac_day;
	$nnegocio=$_POST['nnegocio'];
	$conyuge=$_POST['conyuge'];
	$otra=$_POST['otra'];
	$ubicacionc=$_POST['ubicacionc'];
	$ubicacion=limpia($_POST['ubicacion']);
	$medio=$_POST['medio'];
	$salvador=$_POST['salvador'];
	if($nombre=="") {$error.=" - Debe ingresar un nombre<br/>"; $errorn="1";}
	if($estado=="") {$error.=" - Debe ingresar un estado<br/>"; $errorn="1";}
	if($ciudad=="") {$error.=" - Debe ingresar una ciudad<br/>"; $errorn="1";}
	if($telefono=="") {$error.=" - Debe ingresar un tel&eacute;fono<br/>"; $errorn="1";}
	if(!validmail($email)) {$error.=" - Debe ingresar un correo v&aacute;lido<br/>"; $errorn="1";}
	if($movil=="") {$error.=" - Debe ingresar un tel&eacute;fono m&oacute;vil<br/>"; $errorn="1";}
	if($nivel=="") {$error.=" - Debe ingresar un nivel de educaci&oacute;n<br/>"; $errorn="1";}
	if($fecha <>"" )
	if(!strtotime($fecha)){$error.=" - Fecha inv&aacute;lida<br/>"; $errorn="1";}
	if($nnegocio=="") {$error.=" - Debe seleccionar el tiempo de dedicaci&oacute;n<br/>"; $errorn="1";}
	if($conyuge=="") {$error.=" - Debe seleccionar si c&oacute;nyuge paticipar&aacute;<br/>"; $errorn="1";}
	if($otra=="") {$error.=" - Debe seleccionar si otra persona estar&aacute; a cargo<br/>"; $errorn="1";}
	if($ubicacionc=="") {$error.=" - Debe seleccionar si cuenta con un local <br/>"; $errorn="1";}
	if($ubicacionc=="Si" and $ubicacion=="") {$error.=" - Debe ingresar las medidas del local<br/>"; $errorn="1";}
	if($salvador=="") {$error.=" - Debe seleccionar alguna franquicia<br/>"; $errorn="1";}
		$cuerpo.='
	  <b>Nuevo Mensaje Web</b><br/>
	  <b>Nombre:</b> '.$nombre.'<br/>	
	  <b>Estado:</b> '.encode($estado).'<br/>	
	  <b>Ciudad:</b> '.encode($ciudad).'<br/>
	  <b>Tel&eacute;fono:</b> '.encode($telefono).'<br/>
	  <b>Tel&eacute;fono m&oacute;vil:</b> '.encode($movil).'<br/>
	  <b>Correo electr&oacute;nico:</b> '.encode($email).'<br/>
	  <b>Nivel acad&eacute;mico:</b> '.encode($nivel).'<br/>
	  <b>Fecha de nacimiento:</b> '.$fechanac_day.'-'.$fechanac_month.'-'.$fechanac_year.'<br/>
	  <b>Dedicaci&oacute;n a tiempo completo:</b> '.encode($nnegocio).'<br/>
	  <b>El c&oacute;nyuge participar&aacute;:</b> '.encode($conyuge).'<br/>
	  <b>Otra persona a cargo de la operaci&oacute;n:</b> '.encode($otra).'<br/>
	  <b>Local para la franquicia:</b> '.encode($ubicacionc).'<br/>';
if($ubicacionc=="Si"){
$cuerpo.='<b>Tama&ntilde;o local:</b> '.encode($ubicacion).'<br/>';
	}
 $cuerpo.='<b>Com&oacute; supo de nosotros:</b> '.encode($medio).'<br/>';
 $cuerpo.=' <b>Tipo de franquicia:</b> '.encode($salvador).'<br/><br/>';
	 $cuerpo.="<strong>Ip:</strong> $ip<br/>";
	if ($error==""){
	    $para="INFO@SALVADOR.COM.VE , ADMINISTRACION@SALVADOR.COM.VE , FRANQUICIAS@SALVADOR.COM.VE";
		//$para="franquicias@salvador.com.ve,administracion@salvador.com.ve,info@salvador.com.ve";
		$de="Info";
		$dominio="www.salvador.com.ve";
		$asunto="Nueva franquicia empresario";
		$from_header="MIME-Version: 1.0"."\r\n";
		$from_header.="Content-type: text/html; charset=iso-8859-1"."\r\n"; 
		$from_header.="From: ".$de." <info@".$dominio.">"."\r\n";
		$from_header.="Bcc: info@avacom.com.ve\r\n";
		if ($para<>"" and $de<>"" and $dominio<>"" and $asunto<>"" and $cuerpo<>"") {
		  mail($para,$asunto,$cuerpo,$from_header);
	    $rs=iweb_guardar_data("franquicia_emp","fecha,nombre,ciudad,estado,correo,telf,movil,educacion,fechan,tiempo,conyuge,otro,ubicacion,tamano,medio,salvador,ipaddress","now(),'$nombre','$ciudad','$estado','$email','$telefono','$movil','$nivel','$fecha','$nnegocio','$conyuge','$otra','$ubicacionc','$ubicacion','$medio','$salvador','$ip'");
		$dominio="";
		$nombre="";
		$ciudad="";
		$estado="";
		$telefono="";
		$email="";
		$movil="";
		$nivel="";
		$fechanac_day="";
		$fechanac_month="";
		$fechanac_year="";
		$fecha = "";
		$nnegocio="";
		$conyuge="";
		$otra="";
		$ubicacionc="";
		$ubicacion="";
		$medio="";
		$salvador="";
		$error="";
		$exito="1";
	}
  }
 }
?>
<script type="text/javascript" src="Scripts/jquery.min.js"	></script>
<script>
	$(document).ready(function(){
	<? if($_POST['ubicacionc'] ==="No"){?>
		$("#ubicacion").attr('disabled','-1');
	<?}?>
   $("#ubicacionc1").click(function(event){
   $("#ubicacion").removeAttr('disabled');     	
   });
   $("#ubicacionc2").click(function(event){
   $("#ubicacion").attr('disabled','-1');
   $("#ubicacion").val("");     	
   });
 });
</script>

<div id="AVA_CONTENEDOR_PRINCIPAL">
	<div id="home_cont_keep_out"  class="border-header-center" style="position:relative; clear:both;width:997px; min-height:540px; height:auto; overflow:auto; margin: 0 auto; background-color:#fff;padding-bottom:10px;">
		<div id="grey_box" style="width:877px;height:181px;margin:auto;"><img src="images/franchises.jpg" width="877" height="181" /></div>
<div style="width:877px; min-height:400px; height:auto !important; margin:auto">
	    
		<div class="AVA_TITULO" style="margin: 28px 0 0 0; height:100%; overflow:auto;text-align:justify">FRANQUICIAS</div>
		<div class="line_cont" style="height:6px;float:left;width:100%;"><img src="images/hor_line_cont_large.jpg" width="877" height="6" /></div>
		<div id="texto" style="text-align:justify;margin-bottom:20px">
		  <p><br />
		  </p>
		  <ol>
		    <li>Te brindamos asesoria en la realización de un estudio de mercado.</li>
		    <li> Prestamos ayuda en la búsqueda de locales o compra de salones existentes, <br />
	        en este caso realizamos la remodelacion y adaptacion a  nuestros conceptos.</li>
		    <li> Implantación: estudio de proyectos, creación y concepto de salón: elaboración de las obras.</li>
		    <li>Puesta en marcha de: material publicitario de apertura, capacitación inicial, pedido de productos capilares.</li>
            <li>Te ofrecemos ayuda en la captación de personal calificado para tu unidad de negocio.</li>
		  </ol>
</div>
 <form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="form1" id="form1">      
        <div style="width:410px; height:230px;float:left">
          <div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">INFORMACI&Oacute;N PERSONAL</div>
          <table width="394" border="0" cellspacing="0" cellpadding="3">
  <tr style="height:30px">
    <td width="171">Nombre:</td>
    <td width="214"><input name="nombre" type="text" style=" width:85%" value="<?=$nombre;?>"/>
      <span>(*)</span></td>
  </tr>
  <tr class="gray_form_bg">
    <td>Ciudad:</td>
    <td><input name="ciudad" type="text" size="33"   style=" width:85%" value="<?=$ciudad;?>"/>
      <span >(*)</span></td>
  </tr>
  <tr style="height:30px">
    <td>Estado / regi&oacute;n</td>
    <td><input name="estado" type="text" size="33"  style=" width:85%" value="<?=$estado;?>"/></td>
  </tr>
  <tr class="gray_form_bg">
    <td>Correo electr&oacute;nico:</td>
    <td><input name="email" type="text" size="33"  style=" width:85%" value="<?=$email;?>"/>
      <span >(*)</span></td>
  </tr>
  <tr style="height:30px">
    <td>Tel&eacute;fono habitaci&oacute;n:</td>
    <td><input name="telefono" type="text" size="33" style=" width:85%" value="<?=$telefono;?>"/>
      <span >(*)</span></td>
  </tr>
  <tr class="gray_form_bg">
    <td>Tel&eacute;fono m&oacute;vil:</td>
    <td><input name="movil" type="text" size="33" style=" width:85%" value="<?=$movil;?>"/>
      <span >(*)</span></td>
  </tr>
  <tr style="height:30px">
    <td>Nivel de educaci&oacute;n:</td>
    <td><input name="nivel" type="text" size="33" style=" width:85%" value="<?=$nivel;?>"/>
      <span >(*)</span></td>
  </tr>
  <tr class="gray_form_bg">
    <td>Fecha de nacimiento:</td>
    <td><table >
      <tbody>
        <tr >
          <td ><div>
            <select id="fechanac_day" name="fechanac_day">
              <option  value="">Dia</option>
              <? for ($i =1 ; $i<=31;$i++){?>
              <option <?=iif($fechanac_day== $i,'selected="selected"',"")?>value="<?=iif($i<10,"0".$i,$i);?>">
                <?=$i;?>
                </option>
              <? }?>
            </select>
            /
            <select id="fechanac_month" name="fechanac_month" >
              <option selected="selected" value="">Mes</option>
              <? for ($i =1 ; $i<=12;$i++){?>
              <option <?=iif($fechanac_month== $i,'selected="selected"',"")?>value="<?=iif($i<10,"0".$i,$i);?>">
                <?=$i;?>
                </option>
              <? }?>
            </select>
            /
            <select id="fechanac_year" name="fechanac_year">
              <option selected="selected" value="">A&ntilde;o</option>
              <? for ($i=1961; $i<=date("Y");$i++){?>
              <option <?=iif($fechanac_year== $i,'selected="selected"',"")?>value="<?=$i;?>">
                <?=$i;?>
                </option>
              <? }?>
            </select>
          </div></td>
          <td ><div class="help"></div></td>
        </tr>
      </tbody>
    </table></td>
  </tr>
</table>

          
        </div>
        
<div style="width:4px;height:280px;float:left;margin:0 15px 0 15px;border-right:solid; border-color:#999;border-width:1px"></div>
<div style="width:430px; height:auto;float:left">
        <div id="title2" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">OBJETIVOS Y METAS GERENCIALES</div>
        <table width="430" border="0" cellspacing="0" cellpadding="3">
              <tr style="height:30px">
                <td width="69%" ><span >&iquest;Dedicar&aacute; tiempo completo a su nuevo negocio?:</span></td>
                <td width="31%"  align="left"><span class="cell">
                  <input id="nnegocio1" name="nnegocio" value="Si"  type="radio"  <?=iif($nnegocio=="Si",'checked="checked"',"")?>/>
                  <label  for="t21_0" style="width:auto;display:inline;">Si</label>
                </span> <span class="cell">
                <input id="nnegocio2" name="nnegocio" value="No" type="radio" <?=iif($nnegocio=="No",'checked="checked"',"")?>/>
                <label  for="t21_1" style="width:auto;display:inline;">No</label>
            (*)</span></td>
              </tr>
              <tr class="gray_form_bg">
                <td>&iquest;Va a participar con su c&oacute;nyuge?:</td>
                <td align="left"><span class="cell">
                  <input id="conyuge1" name="conyuge" value="Si"  type="radio" <?=iif($conyuge=="Si",'checked="checked"',"")?>/>
                  <label  for="t21_8" style="width:auto;display:inline;">Si</label>
                </span>
                  <input id="conyuge2" name="conyuge" value="No"  type="radio" <?=iif($conyuge=="No",'checked="checked"',"")?>/>
                  <label  for="t21_9" style="width:auto;display:inline;">No</label>
                  (*)</td>
              </tr>
              <tr style="height:30px">
                <td>&iquest;Dejar&aacute; a otra persona a cargo de la operaci&oacute;n?:</td>
                <td align="left"><span class="cell">
                  <input id="otra1" name="otra" value="Si"  type="radio"  <?=iif($otra=="Si",'checked="checked"',"")?>/>
                  <label  for="t21_10" style="width:auto;display:inline;">Si</label>
                </span>
                  <input id="otra2" name="otra" value="No"  type="radio" <?=iif($otra=="No",'checked="checked"',"")?> />
                  <label  for="t21_11" style="width:auto;display:inline;">No</label>
                  (*)</td>
              </tr>
              <tr class="gray_form_bg">
                <td>&iquest;Cuenta con una ubicaci&oacute;n para montar su franquicia?:</td>
                <td align="left"><span class="cell">
                  <input id="ubicacionc1" name="ubicacionc" value="Si"  type="radio" <?=iif($ubicacionc=="Si",'checked="checked"',"")?>/>
                  <label  for="t21_12" style="width:auto;display:inline;" >Si</label>
                </span>
                  <input id="ubicacionc2" name="ubicacionc" value="No" type="radio" <?=iif($ubicacionc=="No",'checked="checked"',"")?>/>
                  <label  for="t21_13" style="width:auto;display:inline;">No</label>
            (*)<br /></td>
              </tr>
              <tr style="height:30px">
                <td>&iquest;Cuantos M&sup2; tiene la ubicaci&oacute;n que propone?:</td>
                <td align="left"><input name="ubicacion" type="text" id="ubicacion" style=" width:50%" size="33" value="<?=$ubicacion;?>"/>
                  <span >(*)</span></td>
              </tr>
              <tr class="gray_form_bg">
                <td>&iquest;A trav&eacute;s de cu&aacute;l medio conoci&oacute; nuestras franquicias?</td>
                <td align="left">
                <select name="medio" id="medio">
                  <option value="">seleccione</option>
                  <option <?=iif($medio=="Revista",'selected="selected"',"")?> value="Revista">Revista</option>
                  <option <?=iif($medio=="Valla",'selected="selected"',"")?> value="Valla">Valla</option>
                  <option <?=iif($medio=="Amigo",'selected="selected"',"")?> value="Amigo">Amigo</option>
                </select></td>
              </tr>
              <tr>
                <td valign="top">&iquest;En cu&aacute;l salvador est&aacute; interesado en invertir:(*)</td>
                <td align="left"><table width="96%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td width="133" height="21"><span class="cell">
                      <input id="salvador1" name="salvador" value="Instituto de Belleza"  type="radio" <?=iif($salvador=="Instituto de Belleza",'checked="checked"',"")?>/>
                      <label  for="t26_10" style="width:auto;display:inline;">Instituto de Belleza</label>
                    </span></td>
                    </tr>
                  <tr>
                    <td><span class="cell">
                      <input id="salvador2" name="salvador" value="Express"  type="radio"  <?=iif($salvador=="Express",'checked="checked"',"")?>/>
                      <label  for="t26_14" style="width:auto;display:inline;">Express</label>
                    </span></td>
                    </tr>
                  <tr>
                    <td><span class="cell">
                      <input id="salvador3" name="salvador" value="UOMO"  type="radio" <?=iif($salvador=="UOMO",'checked="checked"',"")?>/>
                      <label  for="t26_13" style="width:auto;display:inline;">UOMO</label>
                    </span></td>
                    </tr>
                  <tr>
                    <td><span class="cell">
                      <input id="salvador4" name="salvador" value="Kids" type="radio" <?=iif($salvador=="Kids",'checked="checked"',"")?>/>
                      <label  for="t26_15" style="width:auto;display:inline;">Kids</label>
                    </span></td>
                    </tr>
                </table>
				</td>
              </tr>
		</table>
      </div>
   
 <div id="obj_metas_form" style="float:left;margin:20px 0 0 0; width:100%;" align="center">
	      <input  type="submit" name="enviar" id="enviar"  width="73" height="24" value="Enviar"/>
      </div>  
	</form>
  <div style="float:left; width:350px; margin:-20px 0 20px 30px;">
							<? if($error<>"" && $_POST){?><div class="error"><div><?=$error;?></div></div> <? }?>
							<? if($exito<>"" && $_POST){?><div class="exito"><div>Su informaci&oacute;n ha sido enviada exitosamente.</div></div><? }?>
	  </div>	
</div>
  </div>	
</div>
  <?php  include("footer.html");?>