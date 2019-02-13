function cargar($id) {
    if ($id === "") {
        document.getElementById("salonesHidden").innerHTML = "";
        return;
    } else {
        /*document.getElementById("txtHint").innerHTML = "<div align='center'><img src='/intranet/descargas/componentes/img/load.gif'></div><br>";*/
        document.getElementById("salonesHidden").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
        
        
        mostrarSalones($id);
    }
};
function mostrarSalones($id) { 
    if ($id === "") {
        document.getElementById("salonesHidden").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("salonesHidden").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "/intranet/auditorias/componentes/salones.php?a=" + $id, true);
        xmlhttp.send();   
    }
};