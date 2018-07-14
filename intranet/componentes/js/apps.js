$('#mov1').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var recipient = button.data('id');var recipientu = button.data('whatever');var modal = $(this)
    document.getElementById("modal-titulo").innerHTML = recipient;
    if (recipient === "") {
        document.getElementById("contenido-modal3").innerHTML = "";
        return;
    } else {
        document.getElementById("contenido-modal").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        mostrar(recipientu, "b");
    }
});

$('#cccli').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var recipient = button.data('id');var recipientu = button.data('user');var modal = $(this);
    //modal.find('.modal-body input').val(recipient+";"+recipientu);
    //document.getElementById('info-in').value = recipient+";"+recipientu;
    document.getElementById("contenido-modal2").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
    mostrar(recipient+";"+recipientu, "d");
});

$('#cccli2').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var recipient = button.data('id');var recipientu = button.data('user');var modal = $(this);
    //modal.find('.modal-body input').val(recipient+";"+recipientu);
    document.getElementById('info-in').value = recipient+";"+recipientu;
});


$('#appcli').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var recipient = button.data('id');var recipientu = button.data('u');
    document.getElementById("contenido-modal6").innerHTML = "";
    document.getElementById("contenido-modal7").innerHTML = "";
    document.getElementById("contenido-modal5").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
    cargar(recipientu, recipient);
});

$('#apps').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);//var recipient = button.data('id');var recipientu = button.data('u');
    document.getElementById("contenido-modal8").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
    cargarEstad("1");
});

$('#modalconvenios').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var user = button.data('u');
    document.getElementById("divlistaregion").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
    listarregiones(user);
});

/*PROMPT MINI SIZE*/
$('#miniprompt').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var tipo = button.data('tipo');var ui = button.data('ui');var encid = button.data('ei');var modal = $(this);
    if(tipo === "1" || tipo === 1){ // RESPONDER ENCUESTA ASIGNADA
        
        var datos = {user:ui, form:encid};
        var datosenc = b64EncodeUnicode(JSON.stringify(datos));

        document.getElementById("mini-titulo").innerHTML = "<h4>Encuesta: xxxxxx</h4>";
        document.getElementById("mini-body").innerHTML = "Descripción: xxxxxx";
        document.getElementById("mini-footer").innerHTML = "<input type='hidden' value='"+datosenc+"'><button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>";
        loadEncuestasCRM(datos, 2);
    } else if(tipo === "2" || tipo === 2){ // ASIGNAR ENCUESTA A USUARIO
        var datos = {user:ui, form:encid};
        var datosenc = b64EncodeUnicode(JSON.stringify(datos));

        document.getElementById("mini-titulo").innerHTML = "<h4>Asignar Encuesta a...</h4>";
        document.getElementById("mini-body").innerHTML = "<div align='center'>Cargando Información.<br><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        document.getElementById("mini-footer").innerHTML = "<button type='button' class='btn btn-default' style='display:none;vertical-align: sub;'>Asignar Encuestas</button><button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>";
        //loadEncuestasCRM(datos, 2);
        $.ajax({
            method : "POST",
            url: '/intranet/api.php',
            data:{action:'asignEnc', datos: datosenc},
            success:function(html) {
             document.getElementById("mini-body").innerHTML = html;

             $('#optgroup').multiSelect({ 

                afterSelect: function(values){
                    //document.getElementById("mini-body").innerHTML += "<button type='button' class='btn btn-default'>Asignar Encuestas</button>";
                },
                afterDeselect: function(values){
                    alert("Deselect value: "+values);
                }

            });
        },
            error: function(data) {                   
               document.getElementById("mini-body").innerHTML ='Error '+data;
            }
       }); 
    } else if(tipo == "3" || tipo == 3){
        //document.getElementById("mini-body").innerHTML ='Hola ';
        document.getElementById("mini-titulo").innerHTML = "<h4>Ver Respuestas de la Encuesta:</h4>";
        //document.getElementById("mini-body").innerHTML = "Descripción: xxxxxx";
        document.getElementById("mini-footer").innerHTML = "<input type='hidden' value='"+datosenc+"'><button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>";
        loadEncuestasCRM(encid, 5);

    } else if (tipo == "f1") { // CARGAR INFO MODAL SOLICITUDES DE FRANQUICIAS
        document.getElementById("mini-titulo").innerHTML = "<h4>Consulta de Solicitud</h4>";
        document.getElementById("mini-body").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div>";
        document.getElementById("mini-footer").innerHTML = "<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>";
        $.ajax({
            method : "POST",
            url: '/intranet/apps/crm/franquicias.php',
            data:{idfq: ui, tipof: 'f1'},
            success:function(html) {
                document.getElementById("mini-body").innerHTML = '<span id="datos">'+html+'</span><span id="datosback"></span>';
            },
            error: function(data) {                   
                document.getElementById("tabla-lista").innerHTML ='Error ' + html;
            }
        });
    }
});

function clirepind(){
    var tempo = document.getElementById('info-in').value;
    document.getElementById("contenido-modal-pre2").innerHTML = "";
    document.getElementById("contenido-modal9").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
    mostrar(tempo, "d-1");      
}

function clirepgen(){
    var tempo = document.getElementById('info-in').value;
    document.getElementById("contenido-modal-pre2").innerHTML = "";
    document.getElementById("contenido-modal9").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
    mostrar(tempo, "d-2");      
}

function listarsalones(){
    if ($('#txtlistaregiones').val() !== -1) {
       document.getElementById("cntSalones").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
       $.ajax({
                method : "POST",
                url: '/intranet/apps/convenios.php',
                data:{action:'r1', datos: $('#txtlistaregiones').val()},
                success:function(html) {
                 document.getElementById("cntSalones").innerHTML = html;
                },
                error: function(data) {                   
                   document.getElementById("cntSalones").innerHTML ='Error '+data;
                }
           });   
    }
}

function listarregiones(sUsuario){
   $.ajax({
        method : "POST",
        url: '/intranet/apps/convenios.php',
        data:{action:'r2', datos:sUsuario},
        success:function(html) {
         document.getElementById("divlistaregion").innerHTML = html;
        },
        error: function(data) {                   
           document.getElementById("divlistaregion").innerHTML ='Error '+data;
        }
   });
}
        
function alerta(){
    alert("En esta función podrás consultar todos los clientes en general.");
}

function mostrarB($num){
    if($num === '100' || $num === '200'){
        document.getElementById("contenido-modal7").innerHTML = "<p><div class='form-group'><div class='col-sm-offset-4 col-sm-6'><input type='submit' name='subcc1' class='btn btn-active'></div></div></p>";
    } else if($num === 'cc2a'){
        document.getElementById("contenido-modal11").innerHTML = "<p><div class='form-group'><label class='control-label col-sm-4' for='paiscc'>Año:</label><div class='col-sm-4'><select class='form-control' name='yearcc' onChange='mostrarB(202);'><option value=''></option><option value='2016'>2016</option><option value='2017'>2017</option><option value='2018'>2018</option></select></div></div></p><span id='contenido-modal11b'></span>";
        //document.getElementById("contenido-modal11").innerHTML = "<p><div class='form-group'><div class='col-sm-offset-4 col-sm-6'><input type='submit' name='subcc1' class='btn btn-active'></div></div></p>";
    } else if($num === 'cc2b'){
        document.getElementById("contenido-modal10").innerHTML = "<p><div class='form-group'><label class='control-label col-sm-4' for='paiscc'>Año:</label><div class='col-sm-4'><select class='form-control' name='yearcc' onChange='mostrarB(201);'><option value=''></option><option value='2016'>2016</option><option value='2017'>2017</option><option value='2018'>2018</option></select></div></div></p><span id='contenido-modal10b'></span>";
        //document.getElementById("contenido-modal10").innerHTML = "<p><div class='form-group'><div class='col-sm-offset-4 col-sm-6'><input type='submit' name='subcc2' class='btn btn-active'></div></div></p>";
    } else if($num == '201'){
        document.getElementById("contenido-modal10b").innerHTML = "<p><div class='form-group'><div class='col-sm-offset-4 col-sm-6'><input type='submit' name='subcc2' class='btn btn-active'></div></div></p>";
    } else if($num == '202'){
        document.getElementById("contenido-modal11b").innerHTML = "<p><div class='form-group'><div class='col-sm-offset-4 col-sm-6'><input type='submit' name='subcc1' class='btn btn-active'></div></div></p>";
    }  else {
        document.getElementById("contenido-modal4").innerHTML = "<p><div class='form-group'><div class='col-sm-offset-4 col-sm-6'><input type='submit' name='subcc1' class='btn btn-active'></div></div></p>";
    }        
}

function cargar($id, $funcion) {
    if ($id === "") {
        document.getElementById("report").innerHTML = "";
        return;
    } else {
        if($funcion === '0'){
        document.getElementById("report").innerHTML = "<div class='btn-group'>"+
                                        "<a href='#cccli' data-toggle='modal' data-id='1' data-user='"+$id+"' class='btn btn-primary'>Clientes Registrados</a>"+
                                        "<a href='#cccli' data-toggle='modal' data-id='0' data-user='"+$id+"' class='btn btn-primary'>Clientes Sin Registrar</a>"+
                                    "</div>";
        } else if($funcion === 'app1' || $funcion === 'app3' || $funcion === 'cc2'){
            mostrar($id, $funcion);
        } else if($funcion === 'apptest1'){
            mostrar($id, $funcion);
        }else {
            document.getElementById("report").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
            mostrar($id, $funcion);
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

function cargarc($id, $funcion) {
    if ($id === "") {
        document.getElementById("report1b").innerHTML = "";
        return;
    } else {
        document.getElementById("report1b").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
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
        
        if($funcion === "a"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'r1', datos: $id},
                success:function(html) {

                 document.getElementById("report").innerHTML = "<div class='col-sm-12 text-center' id='regiones'><p><h2>Selecciona la región a consultar:</h2></p><p>"+html+"</p></div>";
                }

           });
        } else if($funcion === "b"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'r2', datos: $id},
                success:function(html) {

                 document.getElementById("contenido-modal").innerHTML = html;
                }

           });
       } else if($funcion === "c"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'r1b', datos: $id},
                success:function(html) {

                 document.getElementById("report1b").innerHTML = html;
                }

           });
       } else if($funcion === "d"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'rcc', datos: $id},
                success:function(html) {

                 document.getElementById("contenido-modal2").innerHTML = html;
                },
                error: function error() {
                    alert("Error conectando, por favor intente de nuevo mas tarde.");
                }

           });

       } else if($funcion === "d-1"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'rcc-ind', datos: $id},
                success:function(html) {

                 document.getElementById("contenido-modal9").innerHTML = html;
                },
                error: function error() {
                    alert("Error conectando, por favor intente de nuevo mas tarde.");
                }

           });
       } else if($funcion === "d-2"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'rcc-gen', datos: $id},
                success:function(html) {

                 document.getElementById("contenido-modal9").innerHTML = html;
                },
                error: function error() {
                    alert("Error conectando, por favor intente de nuevo mas tarde.");
                }

           });
       } else if($funcion === "e"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'rcc2', datos: $id+";1"},
                success:function(html) {

                 document.getElementById("contenido-modal3").innerHTML = html;
                }
           });
       }  else if($funcion === "f"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'rcc2', datos: $id+";0"},
                success:function(html) {

                 document.getElementById("contenido-modal3").innerHTML = html;
                }
           });
       }  else if($funcion === "app1"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'app1', datos: $id},
                success:function(html) {

                 document.getElementById("contenido-modal5").innerHTML = html;
                }
           });
       } else if($funcion === "app2"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'rcc2', datos: $id+";100"},
                success:function(html) {

                 document.getElementById("contenido-modal6").innerHTML = html;
                }
           });
       } else if($funcion === "app3"){
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
       } else if($funcion === "cc2a"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'cc2', datos: $id+";cc2a"},
                success:function(html) {

                document.getElementById("contenido-modal10").innerHTML = html;
                }
           });
       } else if($funcion === "apptest1"){
            $.ajax({
                method : "POST",
                url: '/intranet/apps/cc.php',
                data:{action:'t1', datos: "apptest1"},
                success:function(html) {

                document.getElementById("contenido-modal5").innerHTML = "RESULTADO: <br><br>"+html;
                }
           });
       } else {
            document.getElementById("report").innerHTML = "Hubo un error en el manejo de los datos.";
        }
    }
};

function limpiarTab(){
    document.getElementById("report").innerHTML = "";
}

function cargarEstad($paso){
    if($paso === "1"){
        document.getElementById("contenido-modal8").innerHTML = "Bien.";
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {  // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("contenido-modal8").innerHTML = xmlhttp.responseText;
            }
        }
        
        if($funcion === "1"){
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'apps-est1', datos: "1"},
                success:function(html) {
                 document.getElementById("contenido-modal8").innerHTML = html;
                }
           });
        }
    } else{
        document.getElementById("contenido-modal8").innerHTML = "Error.";
    }
}


function listapersonal(){
        document.getElementById("resultadopersonal").innerHTML = "<br><div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div>";

        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {  // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("resultadopersonal").innerHTML = xmlhttp.responseText;
            }
        }
        
            $.ajax({
                method : "POST",
                url: '/intranet/live/externo.php',
                data:{action:'listapersonal'},
                success:function(html) {
                 document.getElementById("resultadopersonal").innerHTML = html;
                }
           });

}


function loadEncuestasCRM($id, $paso){
    if($id === "" || $id === "null"){
        //hubo un error
    } else{
        if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {  // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("formspace").innerHTML = xmlhttp.responseText;
            }
        }
        if ($paso == 1) {
            $.ajax({
                method : "POST",
                url: '/intranet/api.php',
                data:{action:'loadEnc1', datos: $id}, // id = id del usuario
                success:function(html) {

                    var response = JSON.parse(html);

                    var existeAsignar = !!document.getElementById("formspace2");
                    if(existeAsignar == true){
                        document.getElementById("formspace2").innerHTML = response[0];
                    }

                    document.getElementById("formspace").innerHTML = response[1];
                    document.getElementById("formspace3").innerHTML = response[2];
                }
            });
        } else if($paso == 2){
            $.ajax({
                method : "POST",
                url: '/intranet/api.php',
                data:{action:'loadEncDesc', datos: $id}, // id = objeto con id de user + id encuesta
                success:function(html) {
                    //console.log(html);
                    var obj = JSON.parse(html);
                    document.getElementById("mini-titulo").innerHTML = "<h4>"+obj[0]["titulo"]+"</h4>";
                    document.getElementById("mini-body").innerHTML = "<p><strong>Descripción:</strong></p><p>"+obj[0]["descripcion"]+"</p>";
                    document.getElementById("mini-body").innerHTML += "<p><strong>¿Desea tomar la encuesta?</strong></p><p><button type='button' onclick='loadEncuestasCRM(\" "+b64EncodeUnicode(html)+" \", 3);' class='btn btn-default'>Sí</button> <button type='button' class='btn btn-default' data-dismiss='modal'>No</button></p>";

                    console.log(obj);
                    /*document.getElementById("mini-titulo").innerHTML = "<h4>Encuesta: xxxxxx</h4>";
                    document.getElementById("mini-body").innerHTML = "Descripción: xxxxxx";


                    document.getElementById("mini-body").innerHTML = html;*/
                }
            });
        } else if($paso == 3){
            //console.log("Estoy en el paso 3");

            var obj = JSON.parse(b64DecodeUnicode($id));
            var iden = obj[0]["id"];

            nextStep(iden, 1);

        } else if($paso == 4){ /* GUARDAR ASIGNACIÓN DE USUARIO A ENCUESTA FRANQ */

            var nuevo = $id.split(";");
            console.log(nuevo[1]);

            var elementExists = !!document.getElementById("user"+nuevo[0]);
            if(elementExists == true){
                warnme("Este usuario ya se encuentra asignado a esta encuesta.", "warning");
            } else{
                document.getElementById("newUserA").innerHTML += '<span id="user'+nuevo[0]+'" class="badge ">'+nuevo[0]+'</span> ';
                $.ajax({
                    method : "POST",
                    url: '/intranet/api.php',
                    data:{action:'saveUserEnc', who: nuevo[0], datos: nuevo[1]}, // who = id de nuevo user --- datos = id de user + id encuesta
                    success:function(html) {
                        console.log(html);
                        $("#user"+nuevo[0]).addClass("badge-success");
                        
                        /*document.getElementById("mini-titulo").innerHTML = "<h4>Encuesta: xxxxxx</h4>";
                        document.getElementById("mini-body").innerHTML = "Descripción: xxxxxx";
                        document.getElementById("mini-body").innerHTML = html;*/
                    }
                });
            }

        } else if($paso == 5){
            $.ajax({
                method : "POST",
                url: '/intranet/api.php',
                data:{action:'getEncResp', datos: $id}, // id = id del usuario
                success:function(html) {
                    document.getElementById("mini-body").innerHTML = html;
                }
            });
        } else if($paso == 6){
            document.getElementById("mini-body").innerHTML = "LOADING....";
            $.ajax({
                method : "POST",
                url: '/intranet/api.php',
                data:{action:'getEncResp2', datos: $id}, // id = id del usuario
                success:function(html) {
                    document.getElementById("mini-body").innerHTML = html;
                }
            });
        }
    }
}

function nextStep($dato, $paso){
    if($paso === "1" || $paso === 1){
        window.location.replace("forms/?ide="+$dato);
    }
}


/*function b64EncodeUnicode(str) {
    return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g, function(match, p1) {
        return String.fromCharCode(parseInt(p1, 16))
    }))
}

function b64DecodeUnicode(str) {
    return decodeURIComponent(Array.prototype.map.call(atob(str), function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)
    }).join(''))
}*/

function refrescame($tiempo){
    setTimeout(function(){
        location.reload();
    },+$tiempo);
}

String.prototype.trim = function() {
      return this.replace(/^\s+|\s+$/g,"");
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

function cargarFranquicias($id, $funcion) {
    if ($id === "") {
        document.getElementById("report1b").innerHTML = "";
        return;
    } else {
        document.getElementById("report1b").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        mostrar($id, $funcion);
    }
};

function cargarListadoFranquicias($tipo){
    document.getElementById("tabla-lista").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
    /*document.getElementById('fq1').style.display = "block";
    document.getElementById('fq2').style.display = "block";
    document.getElementById('fq3').style.display = "block";
    document.getElementById('fq4').style.display = "block";*/
    $.ajax({
        method : "POST",
        url: '/intranet/apps/crm/franquicias.php',
        data:{tipof:'fq01'/*+$tipo*/},
        success:function(html) {
            document.getElementById("tabla-lista").innerHTML = html;
            document.getElementById('fq'+$tipo).style.display = "none";
            $('#franq').DataTable({
                dom: 'Bfrtlip',
                buttons: [ 'excel', 'pdf' ]
            });
        },
        error: function(data) {                   
            document.getElementById("tabla-lista").innerHTML ='Error ' + html;
        }
    });
};

function cargarPreguntas(variable){
    var info = b64EncodeUnicode(document.getElementById("datos").innerHTML);
    document.getElementById("datosback").innerHTML = '<input type="hidden" id="backdatos" value="'+info+'">';
    document.getElementById("datos").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
    $.ajax({
        method : "POST",
        url: '/intranet/apps/crm/franquicias.php',
        data:{tipof: 'q1', idfq: variable},
        success:function(html) {
            document.getElementById('datos').innerHTML = html;
            //document.getElementById('datosper').style.display = "none";
        },
        error: function(data) {                   
            document.getElementById("tabla-lista").innerHTML ='Error ' + html;
        }
    });
};

function goBackDatos(){
    document.getElementById("datos").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
    document.getElementById("datos").innerHTML = b64DecodeUnicode(document.getElementById('backdatos').value);
};