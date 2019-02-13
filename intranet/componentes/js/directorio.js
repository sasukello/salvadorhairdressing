$('#modificar').on('show.bs.modal', function (event) {     
    var button = $(event.relatedTarget); var valor1 = button.data('totales');
    var modal = $(this);

    //document.getElementById("texto").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";

    //mostrarProsp1($datos, valor1);
    var valor2 = atob(valor1);
    console.log(valor2);

    manejarResultados(valor2, "1");

});


function addproveedor(){
    $provee = document.getElementsByName("proveedor")[0].value;
    $servic = document.getElementsByName("servicios")[0].value;
    $telefo = document.getElementsByName("telefono")[0].value;
    $corre = document.getElementsByName("correo")[0].value;
    $calific = document.getElementsByName("calificacion")[0].value;
    $coment = document.getElementById("comentario").value;
    $regio = document.getElementsByName("region")[0].value;

    $todoslosdatos = $provee+';'+$servic+';'+$telefo+';'+$corre+';'+$calific+';'+$coment+';'+$regio;

    $.ajax({
            method : "POST",
            url: '/intranet/directorio/directorio.php',
            data:{action:'diragregarp', datos: $todoslosdatos},
            success:function(html) {
            document.getElementById("cuerpomodal").innerHTML = html;

            }
       });
}


function manejarResultados($datos, $paso){
	if($paso == "1"){
		var myObj = JSON.parse($datos);
    	//console.log(myObj);
        $prov = myObj[1];
        $serv = myObj[2];
        $tele = parseInt(myObj[3]);
        $corr = myObj[4];
        $cali = parseInt(myObj[5]);
        $come = myObj[6];
        $regi = myObj[7];

        document.getElementById("proveedor1").innerHTML = $prov;
        document.getElementById("servicios1").innerHTML = $serv;
        document.getElementById("telefono1").innerHTML = $tele;
        document.getElementById("correo1").innerHTML = $corr;
        /**document.getElementById("calificacion1").innerHTML = $cali;**/
        document.getElementById("comentario1").innerHTML = $come;
        document.getElementById("region1").innerHTML = $regi;

        if($cali == 0){
            $valorrating = '<i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i>';
        }
        else if ($cali == 1){
            $valorrating = '<i class="pe-7s-star star1"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i>';
        }
        else if ($cali == 2){
            $valorrating = '<i class="pe-7s-star star1"></i><i class="pe-7s-star star1"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i>';
        }
        else if ($cali == 3){
            $valorrating = '<i class="pe-7s-star star2"></i><i class="pe-7s-star star2"></i><i class="pe-7s-star star2"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i>';
        }
        else if ($cali == 4){
            $valorrating = '<i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star"></i>';
        }
        else if ($cali == 5 || $cali > 5){
            $valorrating = '<i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i>';
        }

        document.getElementById("calificacion1").innerHTML = $valorrating;

	}
}