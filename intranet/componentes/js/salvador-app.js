var UsuarioActual = "";
var NombreUsuario = "";
var paiss = [];
var ests = [];
var sucs = [];
var promos = [];
var citas = [];
var servs = [];
var VersActual = "";
var curLang = "es";
var $m = jQuery.noConflict();
var $ = jQuery;
var pag = "http://app.salvadorhairdressing.com/MkDminf.aspx?Brincar=SoloLista";
var pagp = "http://app.salvadorhairdressing.com/MkDminf.aspx";


function exam($id) {
    if ($id === "") {
        document.getElementById("asoc").innerHTML = "";
        return;
    } else {
        document.getElementById("asoc").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        //lista_asociados($id, $funcion);
        var us = 'a.lugo@salvador.com.ve';
        var pw = '*Enc_EA_MTIz';
        if($id === "0"){
            var res = ValidaUsuario(us, pw, 0, 1);        
        } else if($id === "1"){
            salones('sucs', sucs, 'sucs');
        } else if($id === "2"){
            salones('servs', servs, 'servs');
        } else if($id === '3'){
            salones('ests', servs, 'ests');
        } else if($id === '4'){
            salones('paises', paiss, 'paises');
        }
    }
};


function ValidaUsuario(us, po, silent, pintabots) {

    if (!po) {

        return null;
    }
    //window.atob(encodedData);
    //var url = pag + "&Tip=vl&p1=" + us + "&p2=" + pw;
    var pw = po.startsWith("*Enc_EA_") ? po : "*Enc_EA_" + encryp(po);
    //alert(pw);
    var url = pagp;
    $m.ajax({
        type: "POST",
        url: url,
        data: { Tip: 'vl', p1: us, p2: pw, Brincar: 'SoloLista', p3: curLang },
        headers: {
            'IntType': "SalvadorMookEAApp-v" + VersActual
        },
        crossDomain: false,
        success: function success(response) {
            //console.error(JSON.stringify(response));
            //alert("resp1 - " + response);
            document.getElementById("asoc").innerHTML = "<p>"+response+"</p>";
        }
    });
}

function salones(info, variable, ctl, usri, pw, valadic) {
    var usri = 'a.lugo@salvador.com.ve';
    var pw = '*Enc_EA_MTIz';
    //if (!po) {

    //    return null;
    //}
    //window.atob(encodedData);
    //var url = pag + "&Tip=vl&p1=" + us + "&p2=" + pw;
    //var pw = po.startsWith("*Enc_EA_") ? po : "*Enc_EA_" + encryp(po);
    //alert(pw);
    var url = pagp;
    $m.ajax({
        type: "POST",
        url: url,
        data: { Tip: 'in', cmod: usri, p1: info, Brincar: 'SoloLista', p4: usri, p5: pw, p6: valadic },
        headers: {
            'IntType': "SalvadorMookEAApp-v" + VersActual
        },
        crossDomain: false,
        success: function success(response) {
            //console.error(JSON.stringify(response));
            //alert("resp1 - " + response);
            document.getElementById("asoc").innerHTML = "<p>"+response+"</p>";
        }
    });
}
