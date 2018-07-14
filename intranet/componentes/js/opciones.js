function mostrarBoton(){

    document.getElementById("boton").innerHTML = "<div align='center'><input type='submit' class='btn' name='submitSalon' value='Elegir'></div>";
};
function cambiarIdiomaEN(){
    document.getElementById('textoAbout').innerHTML = '<b>Salvador Hairdressing: <i>Intranet</i></b><br>Insert your corporate username and password in the login form to access Salvador Hairdressing\'s Intranet.';
    document.getElementById('ingresaemail').innerHTML = '<strong>INSERT YOUR CORPORATE LOGIN</strong>';
    document.getElementsByName('name')[0].placeholder='Insert your corporate username here';
    document.getElementsByName('passw')[0].placeholder='Insert your password here';
    document.getElementsByName('intra_uno')[0].value='LOGIN';
}
function cambiarIdiomaES(){
    document.getElementById('textoAbout').innerHTML = '<b>Salvador Hairdressing: <i>Intranet</i></b><br>Ingresa tu usuario y contraseña corporativo en el siguiente formulario para entrar a la Intranet de Salvador Hairdressing.';
    document.getElementById('ingresaemail').innerHTML = '<strong>INGRESA TU LOGIN CORPORATIVO</strong>';
    document.getElementsByName('name')[0].placeholder='Ingresa tu usuario';
    document.getElementsByName('passw')[0].placeholder='Ingresa tu contraseña';
    document.getElementsByName('intra_uno')[0].value='ENVIAR';
}

/*function blockButton(){
   //document.getElementById("abrirSuge").className = 'btn btn-default disabled';
        $('#pedidosugeridoventana').on('show.bs.modal', function (e) {
            var button = e.relatedTarget;
              //e.stopPropagation();
          });
}*/

$('#facturaventa').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var recipient = button.data('whatever');var recipientu = button.data('whatevertu');var recipientri = button.data('whatevertri');var modal = $(this)
    modal.find('.modal-body input').val(recipientu + ';' +recipient);
    loading(recipient + ';' + recipientu + ';' + recipientri, recipientu);
    });
    
$('#facturacxc').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var recipient = button.data('whatever');var recipientu = button.data('whatevertu');var recipientri = button.data('whatevertri');var modal = $(this)
    modal.find('.modal-body input').val(recipientu + ';' +recipient);
    loading(recipient + ';' + recipientu + ';' + recipientri, recipientu);
    });

$('#pedidosugeridoventana').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var recipient = button.data('psug');var modal = $(this);var recipient3 = button.data('var');
    if($(button).hasClass('one-time')) {
      event.stopPropagation();
    }  
    
    //modal.find('.modal-body input').val(recipient);
    loading(recipient + ";" + recipient3, "INV");
});

$('#opcSugerido').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var opcion = button.data('opc');var modal = $(this); 
    
    if(opcion == "copy"){
        document.getElementById("sugerido-header").innerHTML = '<h4 class="modal-title">Enviar Copia al Correo</h4>';

        document.getElementById("sugerido-body").innerHTML = "<p>Ingresa el correo en donde deseas recibir una copia:</p>"+
        "<p><div class='form-group'><label for='email'>Correo:</label><input type='email' name='mailCopia' class='form-control' id='mailCopia'><span id='errormailCopia'></span></div>";

        document.getElementById("sugerido-footer").innerHTML = '<button type="button" class="btn btn-default" id="btnsendcop" onclick="copMail()">Enviar</button>';


    } else if(opcion == "download"){
        document.getElementById("sugerido-header").innerHTML = '<h4 class="modal-title">Descargar Copia del Pedido</h4>';




    }


});
    
/*$('#pedidosugeridoventana').on('hidden.bs.modal', function (e) {
    document.getElementById("abrirSuge").setAttribute("data-target","#");
});*/

function volver(){
  var yourElement = document.getElementById("btnReg");
  var dataVal = yourElement.getAttribute("data-psug");
  location.href='?o='+dataVal;
}

$('#clientesespera').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var correla = button.data('whatever');    
    var modal = $(this)
    modal.find('.modal-body input').val(correla);
    loading(correla, 'ESPERA');
    });

$('#linkespera').click(function() {
            $.blockUI({ message: '<h4><img src="/intranet/componentes/images/loading-sm.gif" /> Cargando Resultados...</h4>' }); 
        }); 


function loading($id, $funcion) {
    if ($id === "") {
        document.getElementById("texto").innerHTML = "";
        return;
    } else {
        document.getElementById("texto").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
        show($id, $funcion);
    }
};

function show($id, $funcion) {
    if ($id === "") {
        document.getElementById("texto").innerHTML = "";
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
                document.getElementById("texto").innerHTML = xmlhttp.responseText;
            }
        }
        
        if($funcion === "FAC"){
            xmlhttp.open("GET", "/intranet/live/externo.php?f=" + $id, true);
            xmlhttp.send();
        } else if($funcion === "2b"){
            xmlhttp.open("GET", "/intranet/sec/inventa.php?m=" + $id, true);
            xmlhttp.send();
        } else if($funcion === "ESPERA"){
            xmlhttp.open("GET", "/intranet/sec/clientes.php?m=" + $id, true);
            xmlhttp.send();
        } else if($funcion === "INV"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'ped_sug', datos: $id},
                success:function(html) {

                 document.getElementById("texto").innerHTML = html;
                }

           });
        } else{
            document.getElementById("texto").innerHTML = "Hubo un error en el manejo de los datos.";
        }
    }
};


    $('.promo_table tr').click(function (event) {
        if (event.target.type !== 'radio') {
            $(':radio', this).trigger('click');
        }
    });

    $("input[type='radio']").change(function (e) {
        e.stopPropagation();
        $('.record_table tr').removeClass("highlight_row");        
        if ($(this).is(":checked")) {
            $(this).closest('tr').addClass("highlight_row");
        }     
    });

function miclick () { // BOTON ENVIAR ORDEN, DENTRO DE MODAL DE PEDIDO SUGERIDO
    //document.getElementById("texto").innerHTML = "CARGANDO....";
    var inputs, index;

    inputs = document.getElementsByTagName('input');
    
    var tbl = document.getElementById('tablaSug');
    var rCount = tbl.rows.length;

    var contador =2;
    var misugerido = [];
    var marca = GetCellValor(0,0);

    for (index = 1; index < rCount; ++index) {
        // deal with inputs[index] element.

        //document.getElementById('txt_name').value
        //misugerido.push("Codigo: "+GetCellValor(index, 1)+"// Descripción: "+GetCellValor(index, 2)+"// Valor Sugerido: "+inputs[contador].value);

        var objetosuge = {};
        objetosuge['CODIGO'] = GetCellValor(index, 1);
        objetosuge['DESCRIPCION'] = GetCellValor(index, 2);
        objetosuge['SUGERIDO'] = inputs[contador].value;

        misugerido.push(objetosuge);

        contador++;
        //alert(rCount);
        //alert(tbl.rows[rCount-1].cells[0].children[0].value);
        //var tbl = document.getElementById('tablaSug');
        //var rCount = tbl.rows.length;
        //console.log(rCount);
        //console.log(tbl.rows[rCount-1].cells[index].children[index].value);

    }
    document.getElementById('recipient-name').value = JSON.stringify(misugerido);
    var jsonsuge = JSON.stringify(misugerido);

      $.ajax({
        type: 'post',
        url: '/intranet/live/externo.php',
        data:{action:'ped_sug_mod', datos: jsonsuge, brand: marca},
        success: function(response) {            
            document.getElementById("texto").innerHTML = response;
            //document.getElementById("osboton").disabled = true;
        },
        error: function() {
            console.log(response);
            document.getElementById("texto2").innerHTML = "ERROR: ".response;
        }
    });
};

function GetCellValues() {
    var table = document.getElementById('tablaSug');
    for (var r = 0, n = table.rows.length; r < n; r++) {
        for (var c = 0, m = table.rows[r].cells.length; c < m; c++) {
            console.log(table.rows[r].cells[c].innerHTML);
        }
    }
}

function GetCellValor($rownumber, $cellnumber) {
    var table = document.getElementById('tablaSug');
    return table.rows[$rownumber].cells[$cellnumber].innerHTML;
}

function copMail(){
   // document.getElementById('texto2b').value = "<div class='form-inline'><div class='form-group'><label for='email'>Correo Electronico:</label><input type='email' class='form-control' id='email'></div>  <button type='submit' class='btn btn-default'>Enviar Copia</button></div>";

   $mailto = document.getElementById('mailCopia').value;$su = document.getElementById('recipient-name').value;$ad = document.getElementById('recipient-adic').value;


   //alert($mailto);


    if ($mailto === "") {
        return;
    } else {
        
      $.ajax({
        type: 'post',
        url: '/intranet/live/externo.php',
        data:{action:'copia_sug', d1: $mailto, d2: $su, d3: $ad},
        success: function(response) {           
            document.getElementById("resultcopia").innerHTML = response;
            //document.getElementById("osboton").disabled = true;
        },
        error: function() {
            console.log(response);
            document.getElementById("resultcopia").innerHTML = response;
        }
    });


    }
}

$(document).on('show.bs.modal', '.modal', function () {
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});

function b64EncodeUnicode(str) {
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function(match, p1) {
        return String.fromCharCode(parseInt(p1, 16))
    }))
}

function b64DecodeUnicode(str) {
    return decodeURIComponent(Array.prototype.map.call(atob(str), function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)
    }).join(''))
}

function test_campo($campoid){ // FUNCIONA SOLO CON LOS ID, NO CON LOS NAME
  if(document.getElementById(""+$campoid+"").value.trim() == ''){
      //alert("debug");
      //document.getElementById("error"+$campoid+"").style.display ="none";
      document.getElementById("error"+$campoid+"").innerHTML ="<b style='color:red;'>Debe ingresar un valor.</b>";
      $result = 0;
  } else{
      document.getElementById("error"+$campoid+"").innerHTML ="";
      $result = 1;
  }
  return $result;
}

function warnme($message, $tipo){
    $.notify({
        message: $message
    },{
        type: $tipo,
        z_index: 2000,
    });
}