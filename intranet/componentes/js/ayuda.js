function mostrarNoticia($id){
	if($id == ""){
		document.getElementById('result-news').innerHTML = "ERROR ID NO RECIBIDA";
	} else{
    	document.getElementById("result-news").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
	    $.ajax({
	        method : "POST",
	        url: '/intranet/ayuda/api.php',
	        data:{action:'n1', datos: $id},
	        success:function(html) {
	        	document.getElementById("result-news").innerHTML = html;
	        }/*,
	        error: function(data) {                   
	        	document.getElementById("result-news").innerHTML ='Error '+data;
	        }*/
	   	}); 
	}
}

function cargaTodasNoticias($permiso){
	if($permiso == ""){
		document.getElementById('three').innerHTML = "ERROR ID NO RECIBIDA";
	} else{
    	document.getElementById("three").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
	    $.ajax({
	        method : "POST",
	        url: '/intranet/ayuda/api.php',
	        data:{action:'n0', datos: $permiso},
	        success:function(html) {
	        	document.getElementById("three").innerHTML = html;
	        },
	        error: function(data) {                   
	        	document.getElementById("three").innerHTML ='Error '+data;
	        }
	   	}); 
	}
}