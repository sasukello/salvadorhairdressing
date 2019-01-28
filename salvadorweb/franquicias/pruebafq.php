<!-- Note :
   - You can modify the font style and form style to suit your website. 
   - Code lines with comments ���Do not remove this code���  are required for the form to work properly, make sure that you do not remove these lines of code. 
   - The Mandatory check script can modified as to suit your business needs. 
   - It is important that you test the modified form before going live.-->
<div id='crmWebToEntityForm' style='width:600px;margin:auto;'>
   <META HTTP-EQUIV ='content-type' CONTENT='text/html;charset=UTF-8'>
   <form action='https://crm.zoho.com/crm/WebToLeadForm' name=WebToLeads3356890000000163241 method='POST' onSubmit='javascript:document.charset="UTF-8"; return checkMandatory()' accept-charset='UTF-8'>

	 <!-- Do not remove this code. -->
	<input type='text' style='display:none;' name='xnQsjsdp' value='62069ecb21c931e194ff77f311237c6859484b1a6a0f433690d03243f19605e4'/>
	<input type='hidden' name='zc_gad' id='zc_gad' value=''/>
	<input type='text' style='display:none;' name='xmIwtLD' value='ec77fdaaaaecf1d23c32af6ffb97244aa50de8f5ddff21459b6b2b64acc466ba'/>
	<input type='text' style='display:none;'  name='actionType' value='TGVhZHM='/>

	<input type='text' style='display:none;' name='returnURL' value='test.salvadorhairdressing.com&#x2f;franquicias&#x2f;prueba2.php' /> 

	<!--<input type='text' style='display:none;' name='returnURL' value='https&#x3a;&#x2f;&#x2f;salvadorhairdressing.com&#x2f;franquicias&#x2f;prueba2.php' /> 
	  Do not remove this code. -->
	<style>
		tr , td { 
			padding:6px;
			border-spacing:0px;
			border-width:0px;
			}
	</style>
	<table style='width:600px;background-color:white;color:black'>

	<tr><td colspan='2' style='text-align:left;color:black;font-family:Arial;font-size:14px;'><strong>Formulario de Franquicias</strong></td></tr>

	<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Tipo de Franquicia<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='100' name='Designation' /></td></tr>

	<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Nombre<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='40' name='First Name' /></td></tr>

	<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Apellidos<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='80' name='Last Name' /></td></tr>

	<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Correo electr&oacute;nico<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='100' name='Email' /></td></tr>

	<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Pa&iacute;s<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='30' name='Country' /></td></tr>

	<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Estado<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='30' name='State' /></td></tr>

	<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Ciudad<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='30' name='City' /></td></tr>

	<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Direcci&oacute;n<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='250' name='Street' /></td></tr>

	<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Tel&eacute;fono<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='30' name='Phone' /></td></tr>

	<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>Pregunta 1<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='40' name='CustomQuestion1' /></td></tr>

	<tr><td  style='nowrap:nowrap;text-align:left;font-size:12px;font-family:Arial;width:200px;'>M&oacute;vil<span style='color:red;'>*</span></td><td style='width:250px;' ><input type='text' style='width:250px;'  maxlength='30' name='Mobile' /></td></tr>

	<tr><td colspan='2' style='text-align:center; padding-top:15px;font-size:12px;'>
		<input style='font-size:12px;color:black'  type='submit' value='Enviar' />
		<input  type='reset' style='font-size:12px;color:black' value='Restablecer' />
	    </td>
	</tr>
   </table>
	<script>
 	  var mndFileds=new Array('First Name','Last Name','Designation','Email','Phone','Mobile','Street','City','State','Country');
 	  var fldLangVal=new Array('Nombre','Apellidos','Tipo de Franquicia','Correo electrónico','Teléfono','Móvil','Dirección','Ciudad','Estado','País');
		var name='';
		var email='';

 	  function checkMandatory() {
		for(i=0;i<mndFileds.length;i++) {
		  var fieldObj=document.forms['WebToLeads3356890000000163241'][mndFileds[i]];
		  if(fieldObj) {
			if (((fieldObj.value).replace(/^\s+|\s+$/g, '')).length==0) {
			 if(fieldObj.type =='file')
				{ 
				 alert('Seleccione un archivo para cargar.'); 
				 fieldObj.focus(); 
				 return false;
				} 
			alert(fldLangVal[i] +' no puede estar vacío.'); 
   	   	  	  fieldObj.focus();
   	   	  	  return false;
			}  else if(fieldObj.nodeName=='SELECT') {
  	   	   	 if(fieldObj.options[fieldObj.selectedIndex].value=='-None-') {
				alert(fldLangVal[i] +' no puede ser nulo.'); 
				fieldObj.focus();
				return false;
			   }
			} else if(fieldObj.type =='checkbox'){
 	 	 	 if(fieldObj.checked == false){
				alert('Please accept  '+fldLangVal[i]);
				fieldObj.focus();
				return false;
			   } 
			 } 
			 try {
			     if(fieldObj.name == 'Last Name') {
				name = fieldObj.value;
 	 	 	    }
			} catch (e) {}
		    }
		}
	     }
	   
</script>
	</form>
</div>