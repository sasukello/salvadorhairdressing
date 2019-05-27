$(document).ready(function(){
	$("#envio_info").click(function(){
		var elem = $(this);
		var titulo = document.getElementById("titulo").value;
		var descri = document.getElementById("descripcion").value;
		var fecha = document.getElementById("fecha").value;
		if (titulo=="" && descri=="" && fecha== "") {
			$(".errorti").html('Ingrese un título');
			$(".errordes").html('Ingrese una descripción');			
			$(".errorfe").html('Ingrese una fecha');
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
		},4000)
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
		},4000)
	});
});
function cargar_imagen(){
	$(".msg_carga").text('Cargando...');
	var id_banner=$("#id_editar").val();
	var archivo_img = document.getElementById("file_archivo");
	var file = archivo_img.files[0];
	var data = new FormData();
	data.append('file_archivo',file);
	data.append('id',id_banner);
	$.ajax({
		url: "editar_img.php",    // Url to which the request is send
		type: "POST",             // Type of request to be send, called as method
		data: data, 			  // Data sent to server, a set of key/value pairs (i.e. form fields and values)
		contentType: false,       // The content type used when sending data to the server.
		cache: false,             // To unable request pages to be cached
		processData:false,        // To send DOMDocument or non processed data file it is set to false
		success: function(data)   // A function to be called if request succeeds
		{
			$("#msg_carga").html(data);
			window.setTimeout(function() {
			$(".alert-dismissible").fadeTo(500, 0).slideUp(500, function(){
			$(this).remove();
			});	
			}, 5000);
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