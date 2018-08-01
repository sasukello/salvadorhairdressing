<?php  include("header.html");
?>
<script type="text/javascript" src="Scripts/jquery.min.js"	></script>
<div id="AVA_CONTENEDOR_PRINCIPAL">
		<div id="home_cont_keep_out"  class="border-header-center" style=" clear:both;width:997px; min-height:540px; height:auto; overflow:auto; margin: 0 auto; background-color:#fff;padding-bottom:10px;">
			<div id="grey_box" style="width:877px;height:181px;margin:auto;"><img src="images/franchises.jpg" width="877" height="181" /></div>
			<div style="width:877px; min-height:450px; height:auto; margin:auto">
				<div class="AVA_TITULO" style="margin: 28px 0 0 0; height:100%; overflow:auto;text-align:justify">FORMATO DE EMPLEO</div>
				<div class="line_cont" style="height:6px;float:left;width:100%;"><img src="images/hor_line_cont_large.jpg" width="877" height="6" /></div>
				<form name="form1" action ="<?=$_SERVER["PHP_SELF"];?>" method="POST">
                    <div style="float:left;width:100%; height:auto; overflow:auto;">
						<!--lateral derecho-->
						<div style="width:410px; height:auto; overflow:auto; float:left">
                        <div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">INFORMACION PERSONAL</div>
						  <table width="100%" border="0" cellspacing="0" cellpadding="3">
						    <tr>
						      <td width="30%" align="right" >Nombre:</td>
                               <td width="70%"><input id="nombre" name="nommbre" value="<?=$nombre;?>" style="width:98%"/></td>
					        </tr>
						    <tr class="gray_form_bg">
						      <td align="right"  >Apellido:</td>
						      <td><input id="apellido" name="apellido" value="<?=$apellido;?>" style="width:98%"/></td>
					        </tr>
						    <tr>
						      <td align="right"  >tel&eacute;fono Habitaci&oacute;n</td>
						      <td><input id="telefono" name="telefono" value="<?=$telefono;?>" style="width:98%"/></td>
					        </tr>
						    <tr class="gray_form_bg">
						      <td align="right"  >&nbsp;</td>
						      <td>&nbsp;</td>
					        </tr>
					      </table>
						<br/>
						<div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">INFORMACION PERSONAL</div>
						  <table width="100%" border="0" cellspacing="0" cellpadding="3">
						    <tr>
						      <td width="30%" >&nbsp;</td> <td width="70%">&nbsp;</td>
					        </tr>
						    <tr class="gray_form_bg">
						      <td  >&nbsp;</td>
						      <td>&nbsp;</td>
					        </tr>
					      </table>		
						<br/>
						<div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">INFORMACION PERSONAL</div>
						  <table width="100%" border="0" cellspacing="0" cellpadding="3">
						    <tr>
						      <td width="30%" >&nbsp;</td> <td width="70%">&nbsp;</td>
					        </tr>
						    <tr class="gray_form_bg">
						      <td  >&nbsp;</td>
						      <td>&nbsp;</td>
					        </tr>
					      </table>	
						</div>
                        
						<div style="width:4px;height:280px;float:left;margin:0 15px 0 15px;border-right:solid; border-color:#999;border-width:1px"></div>
                        
				    <!--lateral izquierdo-->
						<div style="width:430px; height:auto; overflow:auto; float:left">
						 <div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">INFORMACION PERSONAL</div>
						 <table width="100%" border="0" cellspacing="0" cellpadding="3">
						    <tr>
						      <td width="30%" >&nbsp;</td> <td width="70%">&nbsp;</td>
					        </tr>
						    <tr class="gray_form_bg">
						      <td  >&nbsp;</td>
						      <td>&nbsp;</td>
					        </tr>
					      </table>
								<br/>
						<div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">INFORMACION PERSONAL</div>
						  <table width="100%" border="0" cellspacing="0" cellpadding="3">
						    <tr>
						      <td width="30%" >&nbsp;</td> <td width="70%">&nbsp;</td>
					        </tr>
						    <tr class="gray_form_bg">
						      <td  >&nbsp;</td>
						      <td>&nbsp;</td>
					        </tr>
					      </table>	
                          <br/>
						<div id="title" style="height:18px;background-color:#fc0606;color:#FFF;padding:3px 0 0 3px;font-weight:bold">INFORMACION PERSONAL</div>
						  <table width="100%" border="0" cellspacing="0" cellpadding="3">
						    <tr>
						      <td width="30%" >&nbsp;</td> <td width="70%">&nbsp;</td>
					        </tr>
						    <tr class="gray_form_bg">
						      <td  >&nbsp;</td>
						      <td>&nbsp;</td>
					        </tr>
					      </table>	
						</div>
					</div>
					<div  style="float:left; margin-top:10px; width:100%;" align="center">
						<input  type="submit" name="enviar" id="enviar"  width="73" height="24" value="Enviar"/>
					</div>
                    
				</form>
				<div style="float:left; width:auto; margin:10px 0 20px 30px;">
							<? if($error<>"" && $_POST){?><div class="error"><div><?=$error;?></div></div> <? }?>
							<? if($exito<>"" && $_POST){?><div class="exito"><div>su informaci&oacute;n ha sido enviada exitosamente.</div></div><? }?>
				 </div>
			</div>
		</div>
</div>
  <?php  include("footer.html");?>





