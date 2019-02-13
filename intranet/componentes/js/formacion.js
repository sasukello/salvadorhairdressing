const loadingGif = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
let bodyf="";

$('#form1').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);const tipo = button.data('tipo');const modal = $(this);
    document.getElementById("form1body1").innerHTML = loadingGif;
    
    formacionInit(tipo);
});

$('#form2').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget);const tipo = button.data('tipo');const modal = $(this);
    document.getElementById("mini-body").innerHTML = loadingGif;
    
    formacionInit(tipo);
});

const formacionInit = (tipo) => 
{
	$.ajax({
            method : "POST",
            url: 'instruct.php',
            data:{action:'load', datos: tipo},
            success:function(html) {
            	if(tipo == "load1"){
					document.getElementById("form1titulo").innerHTML = "Formación: Cursos";
            		document.getElementById("form1body1").innerHTML = html;
                    
            	} else if(tipo == "load2"){
            		
            		document.getElementById("form1body1").innerHTML = html;
            	}
        	},
            error: function(data) {  
            	if(tipo == "load1"){
            	document.getElementById("form1body1").innerHTML ='Error '+data;
            	} else if(tipo == "load2"){
            		document.getElementById("form1body1").innerHTML ='Error '+data;
            	}
            }
    }); 
}

const formacionDetalle = (id) =>
{
    document.getElementById("mini-extra-info").innerHTML = loadingGif;





}