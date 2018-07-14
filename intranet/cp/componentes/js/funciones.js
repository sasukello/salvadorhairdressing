/* AJAX 1 */
function showLoad($id, $tipo) {
    if ($id === "") {
        if(isset(document.getElementById("txtHint"))){document.getElementById("txtHint").innerHTML = "";} else 
        if(isset(document.getElementById("txtHint2"))){
        document.getElementById("txtHint2").innerHTML = "";} else
        if(isset(document.getElementById("txtHint3"))){document.getElementById("txtHint3").innerHTML = "";} else
        if(isset(document.getElementById("txtHint4"))){document.getElementById("txtHint4").innerHTML = "";}
        return;
    } else {
        if($tipo === '1a'){
            document.getElementById("txtHint").innerHTML = "<div align='center'><img src='/intranet/descargas/componentes/img/load.gif'></div><br>";
            showUser($id, $tipo);
        } else if ($tipo === '1c'){
            document.getElementById("txtHint2").innerHTML = "<div align='center'><img src='/intranet/descargas/componentes/img/load.gif'></div><br>";
            showVerCC($id, $tipo);
        } else if ($tipo === '1d'){
            document.getElementById("txtHint4").innerHTML = "<div align='center'><img src='/intranet/descargas/componentes/img/load.gif'></div><br>";
            showMail($id, $tipo); 
        } else if ($tipo === '1e'){
            document.getElementById("txtHint3").innerHTML = "<div align='center'><img src='/intranet/descargas/componentes/img/load.gif'></div><br>";
            showPassw($id, $tipo); 
        }
    }
}
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
        if($tipo === '1a'){
        xmlhttp.open("GET", "/intranet/cp/sec/libfunc.php?a=" + $id, true);
        xmlhttp.send();   
        }
    }
}

function showVerCC($id, $tipo) {
    if ($id === "") {
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
                document.getElementById("txtHint2").innerHTML = xmlhttp.responseText;
            }
        }
        if($tipo === '1c'){
        xmlhttp.open("GET", "/intranet/cp/sec/libfunc.php?c=" + $id, true);
        xmlhttp.send();   
        }
    }
}

function showPassw($id, $tipo) {
    if ($id === "") {
        document.getElementById("txtHint3").innerHTML = "";
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
                document.getElementById("txtHint3").innerHTML = xmlhttp.responseText;
            }
        }
        if($tipo === '1e'){
        xmlhttp.open("GET", "/intranet/cp/sec/libfunc.php?e=" + $id, true);
        xmlhttp.send();   
        }
    }
}

function showMail($id, $tipo) {
    if ($id === "") {
        document.getElementById("txtHint4").innerHTML = "";
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
                document.getElementById("txtHint4").innerHTML = xmlhttp.responseText;
            }
        }
        if($tipo === '1d'){
        xmlhttp.open("GET", "/intranet/cp/sec/libfunc.php?d=" + $id, true);
        xmlhttp.send();   
        }
    }
}