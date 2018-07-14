$('#modalPago').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var iddata = button.data('id');var tipodat = button.data('tipo');var modal = $(this)
    if (tipodat == "banco") {
    	document.getElementById("pago-titulo").innerHTML="Información Bancaria";
    	consultapagos(iddata);
    }
    else if (tipodat=="factura") {
    	document.getElementById("pago-titulo").innerHTML="Ingrese el Pago";
    	document.getElementById("pago-body").innerHTML="<div align='center'><input type='file' align='center'></div><br>";
    }
    else {
    	document.getElementById("pago-titulo").innerHTML="No Posee Información";
    }
});

function consultapagos($iddata){
   $.ajax({
            method : "POST",
            url: '/intranet/api.php',
            data:{action:'actionconsulta', datos:$iddata},

            success:function(html) {
             document.getElementById("pago-body").innerHTML = html;
            },
            error: function(data) {
               document.getElementById("pago-body").innerHTML ='Error '+data;
            }
       });
}
