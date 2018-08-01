function showLoad($id, $tipo) {
    if ($id === "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        /*document.getElementById("txtHint").innerHTML = "<div align='center'><img src='/intranet/descargas/componentes/img/load.gif'></div><br>";*/
        document.getElementById("txtHint").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
        showUser($id, $tipo);
    }
};
function showUser($id, $tipo) {
    if ($id === "") {
        document.getElementById("txtHint").innerHTML = "";
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
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        if($tipo === '1'){
            xmlhttp.open("GET", "/sitio/sec/includes/main.php?a=" + $id, true);
            xmlhttp.send();
        }
    }
};