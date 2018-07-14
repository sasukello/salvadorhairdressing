$('#desaso').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var iddata = button.data('id');var usuario = button.data('u');var modal = $(this)
    document.getElementById("contenido-modal6").innerHTML = "";
    document.getElementById("contenido-modal7").innerHTML = "";
    document.getElementById("contenido-modal5").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
    cargar(usuario, iddata);
});

function cargar($id, $funcion) {
    if ($id === "") {
        document.getElementById("report").innerHTML = "";
        return;
    } else {      
      mostrar($id, $funcion);
    }
    
};

function mostrar($id, $funcion) {

   
    if ($id === "") {
        document.getElementById("report").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {  // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("report").innerHTML = xmlhttp.responseText;
            }
        }
        
        
        if($funcion === "app3"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'app3', datos: $id},
                success:function(html) {

                 document.getElementById("contenido-modal5").innerHTML = html;
                }
           });
       } else if($funcion === "app4"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'rcc2', datos: $id+";200"},
                success:function(html) {

                 document.getElementById("contenido-modal6").innerHTML = html;
                }
           });
       } 


       else {
            document.getElementById("report").innerHTML = "Hubo un error en el manejo de los datos.";
        }
    } 
};

function listaSuc($id, $user, $funcion) {
    if ($id === "") {
        document.getElementById("contenido-modal3").innerHTML = "";
        return;
    } else if($funcion === 'app2' || $funcion === 'app4'){
        document.getElementById("contenido-modal6").innerHTML = "<br><div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div>";
        mostrar($id+";"+$user, $funcion);
    } else if($funcion === 'cc2a'){
        document.getElementById("contenido-modal10").innerHTML = "<br><div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div>";
        mostrar($id+";"+$user, $funcion);
    } else {
        document.getElementById("contenido-modal3").innerHTML = "<br><div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div>";
        mostrar($id+";"+$user, $funcion);
    }
};

function mostrarB($num){
    if($num === '100' || $num === '200'){
        document.getElementById("contenido-modal7").innerHTML = "<p><div class='form-group'><div class='col-sm-offset-4 col-sm-6'><input type='submit' name='subcc1' class='btn btn-active'></div></div></p>";
    } else {
        document.getElementById("contenido-modal4").innerHTML = "<p><div class='form-group'><div class='col-sm-offset-4 col-sm-6'><input type='submit' name='subcc1' class='btn btn-active'></div></div></p>";
    }        
};

function desbloquearasociado($asociado){
    var miarreglo = $asociado.split(";");
    document.getElementById(miarreglo[0]).innerHTML ="<div align='left'>" + "<img src='/intranet/componentes/images/loading-sm.gif'></div>";
    $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'desaso', datos: $asociado},
                success:function(html) {
                 document.getElementById(miarreglo[0]).innerHTML = "<h2><i class='pe-7s-check' style='visibility: visible; animation-name: fadeInUp;'></i></h2>";
                }

           });
}


