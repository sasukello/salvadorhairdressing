$(document).ready(function(){
	$("#envio_info").click(function(){
		var elem = $(this);
		var titulo = document.getElementById("titulo").value;
		var descri = document.getElementById("descripcion").value;
		var fecha = document.getElementById("fecha").value;
		var select = $("#idioma").val();
		if (titulo== "" && descri== "" && fecha== "" && select== "") {
			$(".errorti").html('Ingrese un título');
			$(".errordes").html('Ingrese una descripción');			
			$(".errorfe").html('Ingrese una fecha');
			$(".erroridio").html('Ingrese un idioma correspodiente');
		}else{
			var formData = new FormData($("#Formulario")[0]);      
    		$.post({
				url: 'insertar.php',
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				success: function(res){
					$("#mostrar").html(res);
				}
			});     
		}		
		setTimeout(function(){
			$(".errorti").html('');
			$(".errordes").html('');
			$(".errorfe").html('');
			$(".erroridio").html('');
			$("#mostrar").html('');
		},5000)
	});
	$("#editar_info").click(function(){
		var elem = $(this);
		var titulo = document.getElementById("titulo");
		var descri = document.getElementById("descripcion");
		var fecha = document.getElementById("fecha");
		if (titulo=="" && descri=="" && fecha== "") {
			$(".errorti").html('Ingrese un título');
			$(".errordes").html('Ingrese una descripción');			
			$(".errorfe").html('Ingrese una fecha');
		}
		else{
			var formData = new FormData($("#Formulario_editar")[0]);
			$.post({
				url: 'editar_archivo.php',
				type: 'POST',
				data: formData,
				contentType: false,
				processData: false,
				success: function(res){
					$("#mostrar").html(res);
				}
			});
		}
		setTimeout(function(){
			$(".errorti").html('');
			$(".errordes").html('');
			$(".errorfe").html('');
			$("#mostrar").html('');
		},4000)
	});
});
function cargar_imagen(){
	$("#msg_carga").text('Cargando...');
	var id_editar=$("#id_editar").val();
	var archivo_img = document.getElementById("file_archivo");
	var file = archivo_img.files[0];
	var data = new FormData($("#Formulario_img")[0]);
	data.append('file_archivo',file);
	data.append('id',id_editar);
	$.post({
		url: "editar_img.php",
		type: "POST",  
		data: data, 	
		contentType: false,
		cache: false,      
		processData:false,        
		success: function(data){
			$("#msg_carga").html(data);			
		}
	});		
}
function init() {
  var archivo = document.getElementById('file_archivo');
  archivo.addEventListener('change', mostrarImagen, false);
}
function mostrarImagen(event) {
  var file = event.target.files[0];
  var reader = new FileReader();
  reader.onload = function(event) {
    var img = document.getElementById('img1');
    img.src= event.target.result;
  }
  reader.readAsDataURL(file);
}
window.addEventListener('load', init, false);