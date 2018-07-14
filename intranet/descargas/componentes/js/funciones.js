/* AJAX 1 */
function showLoad($id, $tipo) {
    if ($id === "") {
        document.getElementById("txtHint").innerHTML = "";
        document.getElementById("txtHint2").innerHTML = "";
        return;
    } else {
        document.getElementById("txtHint").innerHTML = "<div align='center'><img src='/intranet/descargas/componentes/img/load.gif'></div><br>";
        document.getElementById("txtHint2").innerHTML = "";
        showUser($id, $tipo);
    }
}
function showUser($id, $tipo) {
    if ($id === "") {
        document.getElementById("txtHint").innerHTML = "";
        document.getElementById("txtHint2").innerHTML = "";
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
        if($tipo === '2b'){
        xmlhttp.open("GET", "../../s/nk5w7835.php?w=" + $id, true);
        xmlhttp.send();   
        } else if ($tipo === '3a'){
            xmlhttp.open("GET", "../../s/nk5w7835.php?x=" + $id, true);
            xmlhttp.send(); 
        } else if ($tipo === '3c'){
            xmlhttp.open("GET", "../../s/nk5w7835.php?x=" + $id, true);
            xmlhttp.send(); 
        } else{
            xmlhttp.open("GET", "../../s/nk5w7835.php?q=" + $id, true);
            xmlhttp.send();
        }
    }
}

function showModCat($id2, $tipo2) {
    if ($id2 === "") {
        document.getElementById("txtHint2").innerHTML = "";
        return;
    } else {
        document.getElementById("txtHint2").innerHTML = "<div align='center'><img src='/intranet/descargas/componentes/img/load.gif'></div><br>";
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint2").innerHTML = xmlhttp.responseText;
            }
        }
        if($tipo2 === '2bb'){
        xmlhttp.open("GET", "../../s/nk5w7835.php?ww=" + $id2, true);
        xmlhttp.send();   
        } else if ($tipo2 === '3aa'){
            xmlhttp.open("GET", "../../s/nk5w7835.php?xx=" + $id2, true);
            xmlhttp.send();  
        }
    }
}