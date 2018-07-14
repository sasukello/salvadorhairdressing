$('#operacionesplus').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var ident = button.data('id');var salon = button.data('location');var route = button.data('where');var modal = $(this);

    	//var loaded = document.getElementsByName("loaded")[0].value;

		$("#oper-body").css("display","block");
		document.getElementById("oper-body2").innerHTML = "";
		document.getElementById("oper-footer").innerHTML = "";

    	document.getElementById("oper-body").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
	    var datos = {id:ident, salon:salon, route:route};
	    var datosj = JSON.stringify(datos);

	    document.getElementsByName("keepmehere")[0].value = datosj;
	    if(b64DecodeUnicode(ident) == "P1"){var paso = 1;} else if(b64DecodeUnicode(ident) == "P2"){var paso = "S1";console.log("servicios 1");}
	    cargarContenidoPlus(datosj, paso);


});

function cargarContenidoPlus($dataset, $paso){

	if($paso == 1){
		document.getElementById("oper-titulo").innerHTML = "Consultando Productos:";

		$.ajax({
	        method : "POST",
	        url: '/intranet/live/externo.php',
	        data:{action:'plus', datos: $dataset, step: $paso},
	        success:function(html) {
	         document.getElementById("oper-body").innerHTML = html;
	         	$(document).ready(function() {
	         		$('#productosplus').DataTable({});
			    });

	         	cargarContenidoPlus($dataset, 2);
	        }
	   	});
	} else if($paso == 2){
		document.getElementById("plusproductos-filtro1").innerHTML = 'Cargando... <img src="/intranet/componentes/images/loading-sm.gif">';
		$.ajax({
	        method : "POST",
	        url: '/intranet/live/externo.php',
	        data:{action:'plus', datos: $dataset, step: $paso},
	        success:function(html) {
	        document.getElementById("plusproductos-filtro1-content").innerHTML = html;
			document.getElementById("plusproductos-filtro1").innerHTML = '<input type="hidden" value="" name="marsel">';

	        var marsel = document.getElementsByName("marsel")[0];
	        var myarray = new Array();

	        $('#filtro1').multiSelect({
	        	afterSelect: function(values){
	        		myarray.push(values);
	        		marsel.value = myarray;
				    //alert("Select value: "+values);
				  },
				  afterDeselect: function(values){
				    //alert("Deselect value: "+values);

				    var stringer = marsel.value;
				    var array = stringer.split(',');


				    var index = array.indexOf(""+values+"");
					if (index > -1) {
					  array.splice(index, 1);
					}

					marsel.value = array;
				  } })
	         	/*$(document).ready(function() {
	         		$('#productosplus').DataTable({});
			    });*/

	         	//cargarContenidoPlus($dataset, 2);

	        }
	   	});
	} else if($paso == 3){
		var marsel = document.getElementsByName("marsel")[0];
		if (marsel.value.trim() == ''){
			warnme("Debe seleccionar una opción para continuar.", "warning");
		} else{
			//console.log(marsel.value);
			$marcas = marsel.value;
	    	$dataset = document.getElementsByName("keepmehere")[0].value;
		    document.getElementById("plusproductos-filtro2-content").innerHTML = 'Cargando... <img src="/intranet/componentes/images/loading-sm.gif">';

			$.ajax({
		        method : "POST",
		        url: '/intranet/live/externo.php',
		        data:{action:'plus', datos: $dataset, adicional: $marcas, step: $paso},
		        success:function(html) {
		        	document.getElementById("plusproductos-filtro2-content").innerHTML = html;
					document.getElementById("plusproductos-filtro2-content").innerHTML += '<input type="hidden" value="" name="linsel">';

			        var linsel = document.getElementsByName("linsel")[0];
			        var myarray = new Array();

			        $('#filtro2').multiSelect({
		        		afterSelect: function(values){
		        		myarray.push(values);
		        		linsel.value = myarray;
					    //alert("Select value: "+values);
					  	},
					  	afterDeselect: function(values){
					    //alert("Deselect value: "+values);

					    var stringer = linsel.value;
					    var array = stringer.split(',');


					    var index = array.indexOf(""+values+"");
						if (index > -1) {
						  array.splice(index, 1);
						}

						linsel.value = array;

						console.log("desmarque el elemento: "+values);
						console.log(array);



					  } })
		         	//cargarContenidoPlus($dataset, 2);
		        }
		   	});



			/*
			NOTIFY MINIMALISTA - ARCHIVE
			$.notify({ icon: 'https://randomuser.me/api/portraits/med/men/77.jpg',
				title: 'Byron Morgan',
				message: 'Momentum reduce child mortality effectiveness incubation empowerment connect.'
			},{
				type: 'minimalist',
				delay: 5000,
				icon_type: 'image',
				template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' + '<img data-notify="icon" class="img-circle pull-left">' + '<span data-notify="title">{1}</span>' + '<span data-notify="message">{2}</span>' + '</div>',
			    z_index: 2000,
			});*/


		}
	} else if($paso == 4){ // CONSULTA DE PRODUCTOS
		var marsel = document.getElementsByName("marsel")[0];
		if (marsel.value.trim() == ''){
			warnme("Debe seleccionar una Marca para continuar.", "warning");
		} else{
			var linsel = document.getElementsByName("linsel")[0];
			if(linsel == 'undefined' || linsel == null || linsel == undefined){
				warnme("Debe seleccionar una o más Líneas para continuar.", "warning");
			} else if(linsel.value.trim() == ''){
				warnme("Seleccione la línea que desea consultar del listado.", "warning");
			} else{
	    		$dataset = document.getElementsByName("keepmehere")[0].value;
	    		/*document.getElementsByName("loaded")[0].value = "0";*/
				document.getElementById("oper-body").innerHTML = '<div class="row"><div class="text-center col-md-offset-3 col-md-6">Cargando... <img src="/intranet/componentes/images/loading-sm.gif"></div></div>';

				$.ajax({ // LOAD TABLA
			        method : "POST",
			        url: '/intranet/live/externo.php',
			        data:{action:'plus', datos: $dataset, step: $paso},
			        success:function(html) {
			        	document.getElementById("oper-body").innerHTML = html;
						retrieveProducts($dataset, marsel.value, linsel.value, 5);

						//Get the datatable which has previously been initialized
			            var dataTable= $('#productosplus').DataTable();
			            //recalculate the dimensions
			            dataTable.columns.adjust();
			        }
			   	});
			}
		}
	} else if($paso == "S1"){ // ABRE PARA SERVICIOS
		document.getElementById("oper-titulo").innerHTML = "Consultando Servicios:";

		$.ajax({
	        method : "POST",
	        url: '/intranet/live/externo.php',
	        data:{action:'plus', datos: $dataset, step: $paso},
	        success:function(html) {
	         document.getElementById("oper-body").innerHTML = html;
	         	//cargarContenidoPlus($dataset, 2);
	        }
	   	});

	} else if($paso == "S2"){ // AL HACER CLICK EN EL BOTON CARGA EL CONTENIDO DE LA TABLA SERVICIOS
		//document.getElementById("oper-titulo").innerHTML = "Servicios";
	    $dataset = document.getElementsByName("keepmehere")[0].value;

		$.ajax({
	        method : "POST",
	        url: '/intranet/live/externo.php',
	        data:{action:'plus', datos: $dataset, step: $paso},
	        success:function(html) {
	        	document.getElementById("plusservicios-filtro1-content").innerHTML = html;
				retrieveProducts($dataset, "", "", "S3");

		        /*$('#serviciosplus').DataTable();
	         	cargarContenidoPlus($dataset, "S3");*/
	        }
	   	});


	} else if($paso == "S3"){ console.log("aqui vamos");	}
}


/*********************************************/
/*************** CREATE P AND S **************/
/*********************************************/

function crearContenidoPlus($misc, $paso){
	if($paso == ""){
		//hubo un error
	} else if($paso == "P"){ // CREAR PRODUCTOS
		var marsel = document.getElementsByName("marsel")[0];
		if (marsel.value.trim() == ''){
			warnme("Debe seleccionar una Marca para continuar.", "warning");
		} else{
			var linsel = document.getElementsByName("linsel")[0];
			if(linsel == 'undefined' || linsel == null || linsel == undefined){
				warnme("Debe seleccionar una o más Líneas para continuar.", "warning");
			} else if(linsel.value.trim() == ''){
				warnme("Seleccione la línea que desea incluir el producto.", "warning");
			} else{

				var x = document.getElementById("filtro1");
                var txtmarca = "";
                var i;
                for (i = 0; i < x.length; i++) {
	               if (x.options[i].value == marsel.value){
                     txtmarca = x.options[i].text;
                    }
                }

                var x = document.getElementById("filtro2");
                var txtlinea = "";
                var i;
                for (i = 0; i < x.length; i++) {
	               if (x.options[i].value == linsel.value){
                     txtlinea = x.options[i].text;
                    }
                }


        		$("#oper-body").css("display","none");
		        document.getElementsByName("loaded")[0].value = "0";
		        document.getElementById("oper-titulo").innerHTML = "Crear Nuevo Producto:";
		        document.getElementById("oper-body2").innerHTML = armarEditPlantilla($paso, txtmarca, txtlinea, marsel.value, linsel.value);
		        document.getElementById("oper-footer").innerHTML = "<button type='button' id='' onclick='btnCrear(\"P\");' class='btn btn-default' style='float:left;'>Crear Producto</button>";
		     }
		}

	} else if($paso == "S"){ // CREAR SERVICIOS
		$("#oper-body").css("display","none");
		document.getElementsByName("loaded")[0].value = "0";
		document.getElementById("oper-titulo").innerHTML = "Crear Nuevo Servicio:";
		document.getElementById("oper-body2").innerHTML = armarEditPlantilla($paso, "", "", "", "");
		document.getElementById("oper-footer").innerHTML = "<button type='button' id='crearSbtn' onclick='btnCrear(\"S\");' class='btn btn-default'style='float:left;'>Crear Servicio</button>";
	}

}

function armarEditPlantilla($paso, $nombremarca, $nombrelinea, $codigomarca, $codigolinea){
	if($paso == "S"){
	$plantilla = '<div class="row"><input type="hidden" name="updatebtn" value="0"><div class="col-sm-12"><div class="alert alert-warning"><strong>¡Advertencia!</strong> Los valores decimales se deben denotar con punto (.)<br>Ejemplo: 10500.75</div></div>'+
    	'<div class="col-sm-12 col-md-12"><div class="form-group"><label class="control-label col-sm-4 col-md-2" for="cod">Código:</label><div class="col-sm-8 col-md-4" style="margin-bottom: 10px;"><input type="text" class="form-control" id="cod" placeholder="Ingresar el Código del Servicio" onchange="checkinputs(this.value, 1);" value=""><span id="errorcod"></span></div></div></div>'+

    	'<div class="col-sm-12 col-md-12"><div class="form-group"><label class="control-label col-sm-4 col-md-2" for="desc">Descripción:</label><div class="col-sm-8 col-md-4" style="margin-bottom: 10px;"><input type="text" class="form-control" id="desc" placeholder="Ingresar la Descripción para el Servicio" onchange="checkinputs(this.value, 2);" value=""><span id="errordesc"></span></div></div></div>'+

    	'<div class="col-sm-12"><div class="form-group"><label class="control-label col-sm-12" for="alic">Alicuota:</label></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-4" for="acompra">%Compra:</label><div class="col-sm-8" style="margin-bottom: 30px;"><input type="text" class="form-control" id="acompra" placeholder="Ingresar el % de Alic. de Compra" onchange="checkinputs(this.value, 3);" value=""><span id="erroracompra"></span></div></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-4" for="aventa">%Venta:</label><div class="col-sm-8" style="margin-bottom: 30px;"><input type="text" class="form-control" id="aventa" placeholder="Ingresar el % de Alic. de Venta" onchange="checkinputs(this.value, 4);" value=""><span id="erroraventa"></span></div></div></div>'+

    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-6" for="psi1">Precio Sin Impuesto 1:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="psi1" placeholder="Ingresa el Precio Sin Impuesto 1" onchange="checkinputs(this.value, 5);" value="0"><span id="errorpsi1"></span></div></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-6" for="pv1">Precio Venta 1:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="pv1" placeholder="Ingresa el Precio Venta 1" onchange="checkinputs(this.value, 6);" value="0"><span id="errorpv1"></span></div></div></div>'+

    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-6" for="psi2">Precio Sin Impuesto 2:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="psi2" placeholder="Ingresa el Precio Sin Impuesto 2" onchange="checkinputs(this.value, 7);" value="0"><span id="errorpsi2"></span></div></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-6" for="pv2">Precio Venta 2:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="pv2" placeholder="Ingresa el Precio Venta 2" onchange="checkinputs(this.value, 8);" value="0"><span id="errorpv2"></span></div></div></div>'+

    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-6" for="psi3">Precio Sin Impuesto 3:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="psi3" placeholder="Ingresa el Precio Sin Impuesto 3" onchange="checkinputs(this.value, 9);" value="0"><span id="errorpsi3"></span></div></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-6" for="pv3">Precio Venta 3:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="pv3" placeholder="Ingresa el Precio Venta 3" onchange="checkinputs(this.value, 10);" value="0"><span id="errorpv3"></span></div></div></div>'+

    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-6" for="psi4">Precio Sin Impuesto 4:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="psi4" placeholder="Ingresa el Precio Sin Impuesto 4" onchange="checkinputs(this.value, 11);" value="0"><span id="errorpsi4"></span></div></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-6" for="pv4">Precio Venta 4:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="pv4" placeholder="Ingresa el Precio Venta 4" onchange="checkinputs(this.value, 12);" value="0"><span id="errorpv4"></span></div></div></div>'+
    	'</div>';
    	return $plantilla;
    } else if($paso == "P"){
    	$plantilla = '<div class="row"><input type="hidden" name="updatebtn" value="0"><input type="hidden" id="codigomarca" name="codigomarca" value="'+$codigomarca+'"><input type="hidden" id="codigolinea" name="codigolinea" value="'+$codigolinea+'">'+
    	'<div class="col-sm-12"><div class="alert alert-warning"><strong>¡Advertencia!</strong> Los valores decimales se deben denotar con punto (.)<br>Ejemplo: 10500.75</div></div>'+
        '<div class="col-sm-12 col-md-12"><div class="form-group"><label class="control-label col-sm-4 col-md-2" for="cod">Código:</label><div class="col-sm-8 col-md-4" style="margin-bottom: 10px;"><input type="text" class="form-control" id="cod" placeholder="Ingresar el Código del Producto" value=""><span id="errorcod"></span></div></div></div>'+
        '<div class="col-sm-12 col-md-12"><div class="form-group"><label class="control-label col-sm-4 col-md-2" for="descripcion">Descripcion:</label><div class="col-sm-8 col-md-4" style="margin-bottom: 30px;"><input type="text" class="form-control" id="descripcion" placeholder="Ingrese la descripcion del Producto" value=""><span id="errordescripcion"></span></div></div></div>'+
        '<div class="col-sm-12" style="margin-bottom: 10px;"><div class="form-group"><label class="control-label col-sm-4" for="marca">Marca: ' + $nombremarca + '</label><label class="control-label col-sm-4" for="linea">Linea: '+$nombrelinea+'</label></div></div>'+
    	'<div class="col-sm-12"><div class="form-group"><label class="control-label col-sm-4" for="cu">Costo Unitario:</label><div class="col-sm-8"><input type="text" class="form-control" id="cu" placeholder="Modificar el Costo Unitario del Producto" value="0"><span id="errorcu"></span></div></div></div>'+

    	'<div class="col-sm-12"><div class="form-group"><label class="control-label col-sm-12" for="alic">Alicuota:</label></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-4" for="acompra">%Compra:</label><div class="col-sm-8" style="margin-bottom: 20px;"><input type="text" class="form-control" id="acompra" onchange="recalcularAutomatica(this.value, \'P\');" placeholder="Modificar el % de Alic. de Compra" value="0"><span id="erroracompra"></span></div></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-4" for="aventa">%Venta:</label><div class="col-sm-8" style="margin-bottom: 20px;"><input type="text" class="form-control" id="aventa" onchange="recalcularAutomatica(this.value, \'P\');" placeholder="Modificar el % de Alic. de Venta" value="0"><span id="erroraventa"></span></div></div></div>'+

    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-4" for="esta">Estatus:</label><div class="col-sm-8" style="margin-bottom: 20px;"><select class="form-control" id="esta"><option value="A">Activo</option><option value="I">Inactivo</option></select></div></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-4" for="tvent">Tipo de Venta:</label><div class="col-sm-8" style="margin-bottom: 20px;"><select class="form-control" id="tvent"><option value="R">Reventa</option><option value="T">Técnico</option></select></div></div></div>'+

    	'<div class="form-group"><div class="col-sm-12 col-md-offset-2 col-md-12" style="margin-bottom: 20px;"><a href="javascript:0;" class="btn btn-default" role="button" aria-pressed="true" onclick="calcValueAll(0, 10);">Calcular</a> <a href="javascript:0;" class="btn btn-default" role="button" aria-pressed="true" onclick="calcValueAll(0, 20);">Ingresar Manualmente</a></div></div>'+

    	'<div class="row"><div class="col-sm-12 col-md-3"><div class="form-group"><label class="control-label col-sm-6" for="ut1">Utilidad1:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="ut1" placeholder="Utilidad 1" onchange="calcValueAll(this.value, 11);" name="ut1" value="0"><span id="errorut1"></span></div></div></div>'+
    	'<div class="col-sm-12 col-md-4"><div class="form-group"><label class="control-label col-sm-6" for="psi1">Precio Sin Impuesto 1:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="psi1" placeholder="Ingresa el Precio Sin Impuesto 1" onchange="calcValueAll(this.value, 12);" disabled value="0"><span id="errorpsi1"></span></div></div></div>'+
    	'<div class="col-sm-12 col-md-5"><div class="form-group"><label class="control-label col-sm-6" for="pv1">Precio Venta 1:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="pv1" placeholder="Ingresa el Precio Venta 1" disabled onchange="calcValueAll(this.value, 13);" value="0"><span id="errorpv1"></span></div></div></div></div>'+

    	'<div class="row"><div class="col-sm-12 col-md-3"><div class="form-group"><label class="control-label col-sm-6" for="ut2">Utilidad2:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="ut2" placeholder="Utilidad 2" onchange="calcValueAll(this.value, 14);" value="0"><span id="errorut2"></span></div></div></div>'+
    	'<div class="col-sm-12 col-md-4"><div class="form-group"><label class="control-label col-sm-6" for="psi2">Precio Sin Impuesto 2:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="psi2" placeholder="Ingresa el Precio Sin Impuesto 2" onchange="calcValueAll(this.value, 15);" disabled value="0"><span id="errorpsi2"></span></div></div></div>'+
    	'<div class="col-sm-12 col-md-5"><div class="form-group"><label class="control-label col-sm-6" for="pv2">Precio Venta 2:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="pv2" placeholder="Ingresa el Precio Venta 2" onchange="calcValueAll(this.value, 16);" disabled value="0"><span id="errorpv2"></span></div></div></div></div>'+
    	'</div>';
    	return $plantilla;
    }

}


function retrieveProducts($datos, $marcas, $linea, $paso){
	if($paso == 5){
		$('#productosplus').DataTable({
			dom: 'Bfrtlip',
	        buttons: [ 'excel', 'pdf' ],
	        "columnDefs": [
            {
                "targets": [6],
                "visible": false
            }],
	    	"ajax": {
	        	"url": "/intranet/live/externo.php",
	        	"dataSrc": "",
	        	"type": "POST",
	        	"data":{action:'plus', datos: $datos, marcas: $marcas, lineas: $linea, step: $paso}
	    	}
		});
	document.getElementById("oper-footer").innerHTML = '<button type="button" class="btn btn-default" style="float:left;" onclick="takemeto(\'/intranet/live/plus/productos.php?retrieveline='+b64EncodeUnicode($linea)+'&retrievebrands='+b64EncodeUnicode($marcas)+'&actiontrigger=plusproductedit&dataset='+b64EncodeUnicode($datos)+'&key=s6a5486dasdas31\');">¿Editar Productos?</button>';

	} else if($paso == "S3"){ // CARGO SERVICIOS
		$('#serviciosplus').DataTable({
			dom: 'Bfrtlip',
	        buttons: [ 'excel', 'pdf' ],
	    	"ajax": {
	        	"url": "/intranet/live/externo.php",
	        	"dataSrc": "",
	        	"type": "POST",
	        	"data":{action:'plus', datos: $datos, step: $paso}
	    	}
		});
	}
}

function getvalues(){

	var selected = document.querySelectorAll('#filtro1 option:checked');
	var values = Array.from(selected).map((el) => el.value);

	console.log(values);

}

function takemeto($url){
	location.replace(""+$url+"");
	return;
}


/*********************************************/
/*************** EDIT PRODUCTS ***************/
/*********************************************/

$('#miniprompt').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var ident = button.data('search');var tipo = button.data('type');var modal = $(this);
    var descrip = $("#desc"+ident+"").text();

    if(tipo == "p"){
    	document.getElementById("mini-titulo").innerHTML = "<strong>Editando:</strong> "+descrip+"<input type='hidden' id='codigop' name='codigop' value='"+ident+"'>";
    	document.getElementById("mini-footer").innerHTML = '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';

    	var p1 = $("#pv1"+ident+"").text();
    	var p2 = $("#pv2"+ident+"").text();
    	var psi1 = $("#psi1"+ident+"").text();
    	var psi2 = $("#psi2"+ident+"").text();
    	var cu = $("#cu"+ident+"").text();
    	var ac = $("#ac"+ident+"").text();
    	var av = $("#av"+ident+"").text();
    	var est = $("#estatus"+ident+"").text();
    	var tpvnt = $("#tpvnt"+ident+"").text();
    	var ut1 = $("#upuno"+ident+"").text();
    	var ut2 = $("#updos"+ident+"").text();

    	document.getElementById("mini-body").innerHTML = '<div class="row"><input type="hidden" name="updatebtn" value="0"><div class="col-sm-12"><h3>Asignar nuevos valores:</h3><div class="alert alert-warning"><strong>¡Advertencia!</strong> Los valores decimales se deben denotar con punto (.)<br>Ejemplo: 10500.75</div></div>'+
    	'<div class="col-sm-12"><div class="form-group"><label class="control-label col-sm-4" for="pv1">Costo Unitario:</label><div class="col-sm-8"><input type="text" class="form-control" id="cu" placeholder="Modificar el Costo Unitario del Producto" value="'+cu+'"></div></div></div>'+

    	'<div class="col-sm-12"><div class="form-group"><label class="control-label col-sm-12" for="alic">Alicuota:</label></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-4" for="acompra">%Compra:</label><div class="col-sm-8" style="margin-bottom: 20px;"><input type="text" class="form-control" id="acompra" placeholder="Modificar el % de Alic. de Compra" value="'+ac+'"></div></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-4" for="aventa">%Venta:</label><div class="col-sm-8" style="margin-bottom: 20px;"><input type="text" class="form-control" onchange="recalcularAutomatica(this.value, \'AC\');" id="aventa" placeholder="Modificar el % de Alic. de Venta" value="'+av+'"></div></div></div>'+

    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-4" for="esta">Estatus:</label><div class="col-sm-8" style="margin-bottom: 20px;"><select class="form-control" id="esta"><option value="A">Activo</option><option value="I">Inactivo</option></select></div></div></div>'+
    	'<div class="col-sm-12 col-md-6"><div class="form-group"><label class="control-label col-sm-4" for="tvent">Tipo de Venta:</label><div class="col-sm-8" style="margin-bottom: 20px;"><select class="form-control" id="tvent"><option value="R">Reventa</option><option value="T">Técnico</option></select></div></div></div>'+

    	'<div class="form-group"><div class="col-sm-12 col-md-offset-2 col-md-12" style="margin-bottom: 20px;"><a href="javascript:0;" class="btn btn-default" role="button" aria-pressed="true" onclick="calcValueAll(0, 1);">Calcular</a> <a href="javascript:0;" class="btn btn-default" role="button" aria-pressed="true" onclick="calcValueAll(0, 2);">Ingresar Manualmente</a></div></div>'+

    	'<div class="row"><div class="col-sm-12 col-md-3"><div class="form-group"><label class="control-label col-sm-6" for="ut1">Utilidad1:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="ut1" disabled placeholder="Utilidad 1" onchange="calcValueAll(this.value, 7);" name="unoo" value="'+ut1+'"></div></div></div>'+
    	'<div class="col-sm-12 col-md-4"><div class="form-group"><label class="control-label col-sm-6" for="psi1">Precio Sin Impuesto 1:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="psi1" placeholder="Ingresa el Precio Sin Impuesto 1" onchange="calcValueAll(this.value, 5);" disabled value="'+psi1+'"></div></div></div>'+
    	'<div class="col-sm-12 col-md-5"><div class="form-group"><label class="control-label col-sm-6" for="pv1">Precio Venta 1:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="pv1" placeholder="Ingresa el Precio Venta 1" disabled onchange="calcValueAll(this.value, 3);" value="'+p1+'"></div></div></div></div>'+

    	'<div class="row"><div class="col-sm-12 col-md-3"><div class="form-group"><label class="control-label col-sm-6" for="ut2">Utilidad2:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="ut2" disabled placeholder="Utilidad 2" onchange="calcValueAll(this.value, 8);" value="'+ut2+'"></div></div></div>'+
    	'<div class="col-sm-12 col-md-4"><div class="form-group"><label class="control-label col-sm-6" for="psi2">Precio Sin Impuesto 2:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="psi2" placeholder="Ingresa el Precio Sin Impuesto 2" onchange="calcValueAll(this.value, 6);" disabled value="'+psi2+'"></div></div></div>'+
    	'<div class="col-sm-12 col-md-5"><div class="form-group"><label class="control-label col-sm-6" for="pv2">Precio Venta 2:</label><div class="col-sm-6" style="margin-bottom: 20px;"><input type="text" class="form-control" id="pv2" placeholder="Ingresa el Precio Venta 2" onchange="calcValueAll(this.value, 4);" disabled value="'+p2+'"></div></div></div></div>'+
    	'</div>';

    	$("#esta").val(""+est+"");
    	$("#tvent").val(""+tpvnt+"");

    } else{
    	console.log('Tipo de datos no reconocido...')
    }
});

function calcValueAll($valor, $step){
	/* 	1. CALCULAR TENIENDO COSTO UNITARIO
		2. INGRESAR MANUALMENTE
		3. PRECIO VENTA 1
		4. PRECIO VENTA 2
		5. PRECIO SIN IMP. 1
		6. PRECIO SIN IMP. 2
		7. UT. 1
		8. UT. 2

		----- CREAR PRODUCTO -----

		10. Calculo
		20. Ingresar Manualmente
		11. Ut. 1
		12. PSI. 1
		13. PCI. 1
		14. Ut. 2
		15. PSI. 2
		16. PCI. 2
	*/

	if($step == 1 || $step == "1" || $step == 10 || $step == "10"){ /* BOTON CALCULAR - COSTO UNITARIO*/
    	var u1 = $("#ut1").val(); var u2 = $("#ut2").val();
    	preciosi1 = calcValuePSI1(u1);
    	preciov1 = calcValuePV1(preciosi1);

    	preciosi2 = calcValuePSI2(u2);
    	preciov2 = calcValuePV2(preciosi2);
		//$("#psi1").css("background-color","lightgreen");

	} else if($step == 2 || $step == "2" || $step == 20 || $step == "20"){ /* HABILITA TODOS LOS INPUTS */

		$("#psi1").removeAttr("disabled");
		$("#psi2").removeAttr("disabled");
		$("#pv1").removeAttr("disabled");
		$("#pv2").removeAttr("disabled");
		$("#ut1").removeAttr("disabled");
		$("#ut2").removeAttr("disabled");

	} else if($step == 3 || $step == "3"){ /* CHANGE PV 1 */
    	var cu = $("#pv1").val();
    	preciosi1 = calcValuePSI1(cu);
    	preciov1 = calcValuePV1(preciosi1);
	} else if($step == 4 || $step == "4"){ /* CHANGE PV 2 */

	} else if($step == 5 || $step == "5"){ /* CHANGE PSI 1 */

	} else if($step == 6 || $step == "6"){ /* CHANGE PSI 2 */

	} else if($step == 7 || $step == "7"){ /* CHANGE UTILIDAD 1 */
		var utilidad = checkUtilityLimit(1);

		if(utilidad == "1"){
			var preciosi1 = calcValuePSI1($valor);
			calcValuePV1(preciosi1);
		}

	} else if($step == 8 || $step == "8"){ /* CHANGE UTILIDAD 2 */
		var preciosi2 = calcValuePSI2($valor);
		calcValuePV2(preciosi2);

	}

	var boton = document.getElementsByName("updatebtn")[0].value;
	if($step != "2" && $step != "20" && (boton == 0 || boton == "0")){
		document.getElementById("mini-footer").innerHTML += '<button type="button" class="btn btn-default" onclick="sendUpdateInfo(1);" style="float:left;">Actualizar</button>';
		document.getElementsByName("updatebtn")[0].value = "1";
	}

}

function calcValuePV1($data){
	var PSI = $data;
    var TIV = $("#aventa")[0].value;

    if($data == 0 || $data == "0"){
    	$("#pv1").val("0");
		$("#pv1").css("background-color","lightyellow");
		return "0";
    } else {
    	PCI = PSI * (1 + (TIV / 100));
		var final = roundToTwo(PCI);
		$("#pv1").val(final);
		$("#pv1").css("background-color","lightgreen");
		return final;
    }
}

function calcValuePV2($data){
	var PSI = $data;
    var TIV = $("#aventa")[0].value;

    if($data == 0 || $data == "0"){
    	$("#pv2").val("0");
		$("#pv2").css("background-color","lightyellow");
		return "0";
    } else {
    	PCI = PSI * (1 + (TIV / 100));
		var final = roundToTwo(PCI);
		$("#pv2").val(final);
		$("#pv2").css("background-color","lightgreen");
		return final;
    }
}

function calcValuePSI1($data){

	var CU = $("#cu")[0].value;
    var PU = $data;

    if($data == 0 || $data == "0"){
    	$("#psi1").val("0");
		$("#psi1").css("background-color","lightyellow");
		return "0";
    } else{
    	PSI = (parseFloat(CU.replace(/,/g, '')) * (-1)) / ((PU / 100) - 1);
		var final = roundToTwo(PSI);
		$("#psi1").val(final);
		$("#psi1").css("background-color","lightgreen");
		return final;
    }
}

function calcValuePSI2($data){
	var CU = $("#cu")[0].value;
    var PU = $data;

    if($data == 0 || $data == "0"){
    	$("#psi2").val("0");
		$("#psi2").css("background-color","lightyellow");
		return "0";
    } else{
    	PSI = (parseFloat(CU.replace(/,/g, '')) * (-1)) / ((PU / 100) - 1);
		var final = roundToTwo(PSI);
		$("#psi2").val(final);
		$("#psi2").css("background-color","lightgreen");
		return final;
    }
}

function checkUtilityLimit($where){ /*** COMPRUEBA EL SI UTILITARIO ESTA DENTRO DEL RANGO DEL MAX Y MINIMO ***/
	var codigoprod = $("#codigop").val();
	if($where == "1"){
		var p1 = $("#ut1")[0].value;
		p1 = roundToTwo(p1);
		var umin = document.getElementById("utmin"+codigoprod+"").innerHTML;
		var umax = document.getElementById("utmax"+codigoprod+"").innerHTML;
		var utold = document.getElementById("upuno"+codigoprod+"").innerHTML;
		var psi = document.getElementById("psi1"+codigoprod+"").innerHTML;
		var pv = document.getElementById("pv1"+codigoprod+"").innerHTML;

		if(p1 >= umin && p1 <= umax){  // precio 1
			console.log("UT. INGRESADA ESTÁ DENTRO DEL RANGO ACEPTADO");
			return "1";
		} else{
			$("#ut1")[0].value = utold;
			warnme("La Utilidad ingresada ("+p1+"), no está dentro del rango aceptable (Mínima: "+umin+" y Máxima: "+umax+")", "warning");
			//console.log("UT. MINIMA ES: "+umin+". UT.MAX ES: "+umax+". LA UT INGRESADA NO ES VALIDA: "+p1);
			return "0";
		}


	} else if($where == "2"){ // precio 2
		var p2 = $("#ut2")[0].value;
		p2 = roundToTwo(p2);
		var umin = document.getElementById("utmin"+codigoprod+"").innerHTML;
		var umax = document.getElementById("utmax"+codigoprod+"").innerHTML;
		var utold = document.getElementById("updos"+codigoprod+"").innerHTML;
		var psi = document.getElementById("psi2"+codigoprod+"").innerHTML;
		var pv = document.getElementById("pv2"+codigoprod+"").innerHTML;

		if(utold == undefined || utold == "undefined"){
			utold = 0;
		}

		if(p2 >= umin && p1 <= umax){
			console.log("UT. INGRESADA ESTÃ DENTRO DEL RANGO ACEPTADO");
		} else{
			$("#ut2")[0].value = utold;

			warnme("La Utilidad ingresada ("+p2+"), no está dentro del rango aceptable (Mínima: "+umin+" y Máxima: "+umax+")", "warning");
			//console.log("UT. MINIMA ES: "+umin+". UT.MAX ES: "+umax+". LA UT INGRESADA NO ES VALIDA: "+p1);
		}
		return;
	}
}



function checkinputs($currentvalue, $step){
	if($step == "" || $step == 0){
		console.log("Error.");

	} else if($step == 1){ //CODIGO
		validate_zero("cod");

	} else if($step == 2){ //DESCRIPCION


	} else if($step == 3){ //A.COMPRA
		var acompra = $("#acompra")[0].value;
		if(acompra < 0 || acompra > 100){
			document.getElementById("erroracompra").innerHTML ="<i style='color:red;'>Debe ingresar un valor válido.</i>";
			$("#acompra")[0].value = 0;
		} else{
			document.getElementById("erroracompra").innerHTML ="";
		}

	}  else if($step == 4){ // A.VENTA
		var valor = $("#aventa")[0].value;
		if(valor < 0 || valor > 100){
			document.getElementById("erroraventa").innerHTML ="<i style='color:red;'>Debe ingresar un valor válido.</i>";
			$("#aventa")[0].value = 0;
		} else{
			document.getElementById("erroraventa").innerHTML ="";
			recalcularAutomatica($currentvalue, "S");
			//COMPRUEBO SI HAY VALORES EN PSI Y PV, PARA RECALCULAR AUTOMATICAMENTE
		}

	}  else if($step == 5){ //PS1
		if(validate_zero("aventa") == 1){
			var valor1 = $("#aventa")[0].value;
			var pci1 = $currentvalue * (1 + (valor1 / 100));
			$("#pv1")[0].value = roundToTwo(pci1);
		} else{
			$("#pv1")[0].value = "";
		}

	}  else if($step == 6){ //PV1
		if(validate_zero("aventa") == 1){
			var valor1 = $("#aventa")[0].value;
			var psi1 = $currentvalue / ((valor1 / 100) + 1);
			$("#psi1")[0].value = roundToTwo(psi1);
		} else{
			$("#psi1")[0].value = "";
		}

	}  else if($step == 7){ //PS2
		if(validate_zero("aventa") == 1){
			var valor1 = $("#aventa")[0].value;
			var resultCI = $currentvalue * (1 + (valor1 / 100));
			$("#pv2")[0].value = roundToTwo(resultCI);
		} else{
			$("#pv2")[0].value = "";
		}

	}  else if($step == 8){ //PV2
		if(validate_zero("aventa") == 1){
			var valor1 = $("#aventa")[0].value;
			var resultado = $currentvalue / ((valor1 / 100) + 1);
			$("#psi2")[0].value = roundToTwo(resultado);
		} else{
			$("#psi2")[0].value = "";
		}

	}  else if($step == 9){ //PS3
		if(validate_zero("aventa") == 1){
			var valor1 = $("#aventa")[0].value;
			var resultCI = $currentvalue * (1 + (valor1 / 100));
			$("#pv3")[0].value = roundToTwo(resultCI);
		} else{
			$("#pv3")[0].value = "";
		}

	}  else if($step == 10){ //PV3
		if(validate_zero("aventa") == 1){
			var valor1 = $("#aventa")[0].value;
			var resultado = $currentvalue / ((valor1 / 100) + 1);
			$("#psi3")[0].value = roundToTwo(resultado);
		} else{
			$("#psi3")[0].value = "";
		}

	}  else if($step == 11){ //PS4
		if(validate_zero("aventa") == 1){
			var valor1 = $("#aventa")[0].value;
			var resultCI = $currentvalue * (1 + (valor1 / 100));
			$("#pv4")[0].value = roundToTwo(resultCI);
		} else{
			$("#pv4")[0].value = "";
		}


	}  else if($step == 12){ //PV4
		if(validate_zero("aventa") == 1){
			var valor1 = $("#aventa")[0].value;
			var resultado = $currentvalue / ((valor1 / 100) + 1);
			$("#psi4")[0].value = roundToTwo(resultado);
		} else{
			$("#psi4")[0].value = "";
		}

	}
}

function btnCrear($tipo){
	if($tipo == "P"){
		var flag1 = false;var flag2 = false;var flag3 = false;var flag4 = false;var flag5 = false;var flag6 = false; var flag7 = false;
		var cod = $("#cod").val();
		var desc = $("#descripcion").val();
		var cu = $("#cu").val();
		var ac = $("#acompra").val();
		var av = $("#aventa").val();
		var ut1 = $("#ut1").val();
		var ut2 = $("#ut2").val();
		var psi1 = $("#psi1").val();
		var psi2 = $("#psi2").val();
		var pv1 = $("#pv1").val();
		var pv2 = $("#pv2").val();
		var esta = $("#esta").val();
		var tvent = $("#tvent").val();
		var linea = $("#codigolinea").val();
		var marca = $("#codigomarca").val();



		if(validate_zero("cod") == 1){ if(validate_empty("cod") == 1){ flag1 = true; } }
		if(validate_zero("descripcion") == 1){ if(validate_empty("descripcion") == 1){ flag2 = true; } }
		if(validate_zero("ut1") == 1){ if(validate_empty("ut1") == 1){ flag5 = true; } }
		if(validate_zero("psi1") == 1){ if(validate_empty("psi1") == 1){ flag6 = true; } }
		if(validate_zero("pv1") == 1){ if(validate_empty("pv1") == 1){ flag7 = true; } }

		if(flag1 == true && flag2 == true && flag3 == true && flag4 == true && flag5 == true && flag6 == true && flag7 == true){

			var whoisthis = document.getElementsByName("keepmehere")[0].value;
			var userid = document.getElementsByName("ui")[0].value;
			var dataset = {
				codigo: cod,
				descripcion: desc,
				alic: ac,
				alicv: av,
				psi1: psi1,
				psi2: psi2,
				pv1: roundToTwo(pv1),
				pv2: roundToTwo(pv2),
				ut1: ut1,
				ut2: ut2,
				cu: cu,
				linea: linea,
				marca: marca,
				estado: esta,
				tvent: tvent,
				id: b64EncodeUnicode('P3')
			}

			var datosj = JSON.stringify(dataset);

			/*if(userid == ""){
			    warnme("Debe actualizar la página, para cargar de nuevo la información","warning");
			} else {*/
				$.ajax({
			        method : "POST",
			        url: '/intranet/live/externo.php',
			        data:{action:'plus', datos: datosj, usuario: userid, step: "2", route: whoisthis},
			        success:function(html) {
		            	warnme("Los cambios fueron almacenados éxitosamente","success");
		           		$("#crearPbtn").attr('disabled','disabled');
		           		refrescame(3000);
			         },
			         error:function(html) {
			            warnme("Error al grabar los cambios, " + html,"danger");
			         }
			   	});
			//}

		}



	} else if($tipo == "S"){
		var flag1 = false;var flag2 = false;var flag3 = false;var flag4 = false;var flag5 = false;var flag6 = false;
		var cod = $("#cod").val();
		var desc = $("#desc").val();
		var ac = $("#acompra").val();
		var av = $("#aventa").val();
		var psi1 = $("#psi1").val();
		var psi2 = $("#psi2").val();
		var psi3 = $("#psi3").val();
		var psi4 = $("#psi4").val();
		var pv1 = $("#pv1").val();
		var pv2 = $("#pv2").val();
		var pv3 = $("#pv3").val();
		var pv4 = $("#pv4").val();

		if(validate_zero("cod") == 1){ if(validate_empty("cod") == 1){ flag1 = true; } }
		if(validate_zero("desc") == 1){ if(validate_empty("desc") == 1){ flag2 = true; } }
		if(validate_zero("psi1") == 1){ if(validate_empty("psi1") == 1){ flag5 = true; } }
		if(validate_zero("pv1") == 1){ if(validate_empty("pv1") == 1){ flag6 = true; } }

		if(flag1 == true && flag2 == true && flag3 == true && flag4 == true && flag5 == true && flag6 == true){

			var whoisthis = document.getElementsByName("keepmehere")[0].value;
			var userid = document.getElementsByName("ui")[0].value;
			var dataset = {
				codigo: cod,
				descripcion: desc,
				alic: ac,
				alicv: av,
				psi1: psi1,
				psi2: psi2,
				psi3: psi3,
				psi4: psi4,
				pv1: roundToTwo(pv1),
				pv2: roundToTwo(pv2),
				pv3: roundToTwo(pv3),
				pv4: roundToTwo(pv4),
				id: b64EncodeUnicode('P3')
			}

			var datosj = JSON.stringify(dataset);

			/*if(userid == ""){
			    warnme("Debe actualizar la página, para cargar de nuevo la información","warning");
			} else {*/
				$.ajax({
			        method : "POST",
			        url: '/intranet/live/externo.php',
			        data:{action:'plus', datos: datosj, usuario: userid, step: "3", route: whoisthis},
			        success:function(html) {
		            	warnme("Los cambios fueron almacenados éxitosamente","success");
		           		$("#crearSbtn").attr('disabled','disabled');
		           		refrescame(3000);
			         },
			         error:function(html) {
			            warnme("Error al grabar los cambios, " + html,"danger");
			         }
			   	});
			//}
		}
	}

}

function recalcularAutomatica($cuota, $tipo){
	if($tipo == "S"){
		calcPV($cuota, "psi1", "pv1");
		calcPV($cuota, "psi2", "pv2");
		calcPV($cuota, "psi3", "pv3");
		calcPV($cuota, "psi4", "pv4");

		calcPSI($cuota, "pv1", "psi1");
		calcPSI($cuota, "pv2", "psi2");
		calcPSI($cuota, "pv3", "psi3");
		calcPSI($cuota, "pv4", "psi4");

	} else if($tipo == "P"){
		calcPV($cuota, "psi1", "pv1");
		calcPV($cuota, "psi2", "pv2");

		calcPSI($cuota, "pv1", "psi1");
		calcPSI($cuota, "pv2", "psi2");
	} else if($tipo == "AC"){
		console.log($cuota);
    calcPSIAVenta($cuota, "aventa");

	}
}

function calcPV($alicuota, $origen, $destino){

	var valor = $("#"+$origen)[0].value;
	if(valor.trim() == ''){ valor = 0;} else if(valor == 0 || valor == "0"){valor = 0;} else{
		var resultado = valor * (1 + ($alicuota / 100));
		$("#"+$destino)[0].value = roundToTwo(resultado);
	}
}

function calcPSI($alicuota, $origen, $destino){
	var valor = $("#"+$origen)[0].value;
	if(valor.trim() == ''){valor = 0;} else if(valor == 0 || valor == "0"){valor = 0;} else{
		var resultado = valor / (($alicuota / 100) + 1);
		$("#"+$destino)[0].value = roundToTwo(resultado);
	}
}

function calcPSIAVenta($alicuota, $origen){
  var valor = $("#"+$origen)[0].value;
	if(valor.trim() == ''){valor = 0;} else if(valor == 0 || valor == "0"){valor = 0;} else{
    var PSI1 = parseFloat($("#psi1").val().replace(/,/g, ''));
    var resultado = PSI1 * (1 + ($alicuota / 100));
		$("#pv1")[0].value = roundToTwo(resultado);
	}
}

function validate_zero($campoid){ // FUNCIONA SOLO CON LOS ID, NO CON LOS NAME
	var valor = $("#"+$campoid)[0].value;
	if(valor == 0 || valor == "0"){
		document.getElementById("error"+$campoid).innerHTML ="<i style='color:red;'>Debe ingresar un valor distinto de 0</i>";
		$("#"+$campoid)[0].value = 0;
		$result = 0;
	} else{
		document.getElementById("error"+$campoid).innerHTML ="";
		$result = 1;
	}
	return $result;
}


function validate_empty($campoid){ // FUNCIONA SOLO CON LOS ID, NO CON LOS NAME
  if(document.getElementById(""+$campoid+"").value.trim() == ''){
      //alert("debug");
      //document.getElementById("error"+$campoid+"").style.display ="none";
      document.getElementById("error"+$campoid+"").innerHTML ="<i style='color:red;'>Debe ingresar un valor.</i>";
      $("#"+$campoid)[0].value = 0;
      $result = 0;
  } else{
      document.getElementById("error"+$campoid+"").innerHTML ="";
      $result = 1;
  }
  return $result;
}

function roundToTwo(num) {
    return +(Math.round(num + "e+2")  + "e-2");
}

function refrescame($tiempo){
    setTimeout(function(){
        location.reload();
    },+$tiempo);
}

function sendUpdateInfo($step){
	var codigoprod = $("#codigop").val();
	var costounit = parseFloat($("#cu").val().replace(/,/g, ''));
	var costounitante = document.getElementById("cu"+codigoprod+"").innerHTML;
 	var whoisthis = document.getElementsByName("keepmehere")[0].value;


	var dataset = {
		codp: codigoprod,
		cu: costounit,
		cuant: parseFloat(costounitante.replace(/,/g, '')),
		estado: $("#esta").val(),
		tvent: $("#tvent").val(),
		ut1: $("#ut1").val(),
		ut2: $("#ut2").val(),
		ut1ant: document.getElementById("upuno"+codigoprod+"").innerHTML,
		ut2ant: document.getElementById("updos"+codigoprod+"").innerHTML,
		psi1: $("#psi1").val(),
		psi2: $("#psi2").val(),
		pv1: roundToTwo($("#pv1").val()),
		pv2: roundToTwo($("#pv2").val()),
		codp: $("#codigop").val(),
		acompra: $("#acompra").val(),
		aventa: $("#aventa").val(),
		id: b64EncodeUnicode('P3')
	}
	var datosj = JSON.stringify(dataset);

	var userid = document.getElementsByName("ui")[0].value;
	$paso = "savePlus";

	$.ajax({
	        method : "POST",
	        url: '/intranet/live/externo.php',
	        data:{action:'plus', datos: datosj, usuario: userid, step: $step, route: whoisthis},
	        success:function(html) {
            	warnme("Los cambios fueron almacenados éxitosamente","success");
           		$("#savePbtn").attr('disabled','disabled');
           		refrescame(3000);
	         },
	         error:function(html) {
	            warnme("Error al grabar los cambios, " + html,"danger");
	         }
	   	});
}