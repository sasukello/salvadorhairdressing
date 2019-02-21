$('#cms').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);var tipo = button.data('tipo');var modal = $(this);
    if(tipo == ""){
		window.console.log("Error.");
    } else{
    	if(tipo == "faq"){
    		$seccion = "faq";
    		$step="faq1";
			moduloFAQ($seccion, $step);
    	} else if(tipo == "stopgo"){
    		$seccion = "stopgo";
    		$step=1;
    		cicara($seccion, $step);
    	}

    }
});

function moduloFAQ($seccion, $step){
	if($step == ""){
		document.getElementById("message").innerHTML = '<div class="alert alert-warning"><strong>Error:</strong> Intente de nuevo.</div>';
	} else{
		document.getElementById("titulocms").innerHTML = "Sección de FAQ: Preguntas Frecuentes";
		document.getElementById("bodycms").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
	    $.ajax({
	        type: 'post',
	        url: '/intranet/api.php',
	        data:{action:$seccion, datos: $step},
	        success: function(response) { 
	            document.getElementById("bodycms").innerHTML = response;
	        },
	        error: function(response) {
	    		document.getElementById("bodycms").innerHTML = "Error: "+response;
	        }
	    });
	}
}

async function fetchWooProducts1(){
	const resp = await fetch('https://jsonplaceholder.typicode.com/users');
	const productsWoo = await resp.json();
	return productsWoo;
}

async function fetchWooProducts(){
	fetch('https://jsonplaceholder.typicode.com/users')
	.then(resp=>resp.json())
	.then(data=>console.log(data));
}

const cicara = (seccion, paso) => {
	document.getElementById("titulocms").innerHTML = "Cicara Caffe: Stop & Go";
	document.getElementById("bodycms").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br><table id='products' class='display' width='100%'></table>";
	
	const myProducts = this.fetchWooProducts();
 	console.log(myProducts);
    $('#products').DataTable ({
        "data" : myProducts,
        "columns" : [
            { "data" : "name" },
            { "data" : "username" },
            { "data" : "email" },
            { "data" : "id" },
            { "data" : "phone" },
            { "data" : "website" }
        ]
    });

}




/*function saveFAQ($step, $datos){
	if($datos == ""){
		document.getElementById("message").innerHTML = '<div class="alert alert-warning"><strong>Error:</strong> Intente de nuevo.</div>';
	} else{
		document.getElementById("bodycms").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";

		/*$(document).on('click','#savefaqbtn', function(){
			var faqbtn = $('categoria').val();
			var faqbtn2 = $('categorianpt').val();
		    console.log(faqbtn);console.log(faqbtn2);
		});*/


    	/*$datos = document.getElementById('categorianpt');
		console.log($datos);
		/*$.ajax({
	        type: 'post',
	        url: '/intranet/api.php',
	        data:{action:'faq', datos: $step, contenido:faqbtn},
	        success: function(response) { 
	            document.getElementById("bodycms").innerHTML = response;
	        },
	        error: function(response) {
	    		document.getElementById("bodycms").innerHTML = "Error: "+response;
	        }
	    });*/

	/*}

}*/