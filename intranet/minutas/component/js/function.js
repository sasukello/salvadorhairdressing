$('#sendmailMinutas').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var modal = $(this);
    var tipom = button.data('tip'); 
    var idmin = button.data('tip2');
    if (tipom === "") {
        document.getElementById("modalMinuta").innerHTML = "Error";
        return;
    } else {
        document.getElementById("modalMinuta").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        if(tipom == "R"){
          document.getElementById("modalMinuta").innerHTML = '<div class="col-md-12"><div class="form-group"><label for="email">Indique Direcciones de Correo Electrónico:</label><input type="email" class="form-control" id="email" name="email"></div>';
          document.getElementById("modalMinuta").innerHTML += '<button type="button" id="btnConEnv" onclick=enviarMinMail(11,'+idmin+',0,11) class="btn btn-default">Confirmar Envío</button><input type="hidden" name="hidMin" value="'+idmin+'"></div>';

        } else if(tipom == "S"){
          document.getElementById("modalMinuta").innerHTML = '<div class="col-md-12"><div class="form-group"><label for="email">Dirección de correo:</label><span id="spacedefaultinput"><input type="email" class="form-control" id="email" name="email" disabled></span></div><div class="form-group"><label for="email2">¿Enviar Copia de Listado a otra dirección? (separar por comas):</label><input type="email" class="form-control" id="email2" name="email2"></div>';
          document.getElementById("modalMinuta").innerHTML += '<button type="button" id="btnConEnv" onclick=enviarMinMail(22,0,0,22) class="btn btn-default">Confirmar Envío</button><input type="hidden" name="hidMin" value="'+idmin+'"></div>';
          document.getElementById("btnConEnv").disabled = true;
          enviarMinMail("a", "b", idmin, "2"); // idmin es id de salon
          //console.log(b64DecodeUnicode(document.getElementsByName("mintod")[0].value));
          /*if( document.getElementById("email").length == 0 ){
            console.log("no files selected");
          }*/

        } else if(tipom == "C"){
          document.getElementById("modalMinuta").innerHTML = '<div class="col-md-12"><div class="form-group"><label for="email">Indique Direcciones de Correo Electrónico:</label><input type="email" class="form-control" id="email" name="email"></div>';
          document.getElementById("modalMinuta").innerHTML += '<button type="button" id="btnConEnv" onclick=enviarMinMail(33,0,0,33) class="btn btn-default">Confirmar Envío</button><input type="hidden" name="hidMin" value="'+idmin+'"></div>';
        }
    }
});

function cerrarminuta(div){
    //alert(div);
    document.getElementById("espera"+div).innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
     var request = $.ajax({
     url: "script.php",
     method: "POST",
     data: { iduser : $("#mnidusuario").val(),
             idminuta: $("#mnidminuta"+div).val(),
             tipominuta: $("#mntipominuta").val(),
             accion: "C",
             razon: $("#razonapertura"+div).val()},
     dataType: "html"
   });
 
   request.done(function( msg ) {
     if (msg == ""){
        $("#mncolor"+div).removeClass("alert-success").addClass("alert-warning");
        $("#lbcerrar"+div).removeClass("visible").addClass("oculto");
        $("#lbverificar"+div).removeClass("oculto").addClass("visible");
        $("#lbabrir"+div).removeClass("oculto").addClass("visible");
        $("#razonapertura"+div).val("");
      document.getElementById("espera"+div).innerHTML = "";
} else{
        document.getElementById("espera"+div).innerHTML = "";
        document.getElementById("espera"+div).innerHTML = "Request failed: " + msg ; 
     }
    });
 
   request.fail(function( jqXHR, textStatus ) {
     document.getElementById("espera"+div).innerHTML = "";
        document.getElementById("espera"+div).innerHTML = "Request failed: " + textStatus ;
   }); 
 }  

 function abrirminuta(div){
document.getElementById("espera"+div).innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";    
    var request = $.ajax({      
     url: "script.php",
     method: "POST",
     data: { iduser : $("#mnidusuario").val(),
             idminuta: $("#mnidminuta"+div).val(),
             tipominuta: $("#mntipominuta").val(),
             accion: "A",
             razon: $("#razonapertura"+div).val()},
     dataType: "html"
   });

   request.done(function( msg ) {
      if (msg == ""){

         $("#mncolor"+div).removeClass("alert-warning alert-danger").addClass("alert-success");
         $("#lbcerrar"+div).removeClass("oculto").addClass("visible");
         $("#lbverificar"+div).removeClass("visible").addClass("oculto");
         $("#lbabrir"+div).removeClass("visible").addClass("oculto");
         $("#razonapertura"+div).val("");
         document.getElementById("espera"+div).innerHTML = "";
    }else{
        document.getElementById("espera"+div).innerHTML = "";
        document.getElementById("espera"+div).innerHTML = "Request failed: " + msg ;} 
     });
 
   request.fail(function( jqXHR, textStatus ) {
     document.getElementById("espera"+div).innerHTML = "";
        document.getElementById("espera"+div).innerHTML = "Request failed: " + textStatus ;
   });  


   
 }

 function verificarminuta(div){

   document.getElementById("espera"+div).innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";

var request = $.ajax({
     url: "script.php",
     method: "POST",
     data: { iduser : $("#mnidusuario").val(),
             idminuta: $("#mnidminuta"+div).val(),
             tipominuta: $("#mntipominuta").val(),
             accion: "V",
             razon: $("#razonapertura"+div).val()},
     dataType: "html"
   });

   request.done(function( msg ) {
   if (msg == ""){   
      $("#mncolor"+div).removeClass("alert-warning").addClass("alert-danger");
      $("#lbcerrar"+div).removeClass("visible").addClass("oculto");
      $("#lbverificar"+div).removeClass("visible").addClass("oculto");
      $("#lbabrir"+div).removeClass("oculto").addClass("visible");  
      $("#razonapertura"+div).val("");
      document.getElementById("espera"+div).innerHTML = ""; 
      return;
    }else{
        document.getElementById("espera"+div).innerHTML = "";
        document.getElementById("espera"+div).innerHTML = "Request failed: " + msg ; 
     }
     
    });
 
   request.fail(function( jqXHR, textStatus ) {
     document.getElementById("espera"+div).innerHTML = "";
        document.getElementById("espera"+div).innerHTML = "Request failed: " + textStatus ;
   });   


   

 }  




 function agregarminuta(){
    document.getElementById("espera").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    var request = $.ajax({
     url: "script.php",
     method: "POST",
     data: { iduser : $("#mnidusuario").val(),
             datosminuta: $("#datosnuevaminuta").val(),
             tipominuta: $("#mntipominuta").val(),
             prioridad: $("#prioridad").val(),
             idsalon: $("#mnidsalon").val(),
             idregion: $("#mnidregion").val()},
     dataType: "html"
   });

   request.done(function( msg ) {
      if (msg.substring(0,5) != "Error"){
         document.getElementById("contenedorprincipal").innerHTML = msg;
         $("#datosnuevaminuta").val("");
         document.getElementById("espera").innerHTML = "";
    }else{
        document.getElementById("espera").innerHTML = "Request failed: " + msg ;} 
     });
 
   request.fail(function( jqXHR, textStatus ) {
        document.getElementById("espera").innerHTML = "Request failed: " + textStatus ;
   });  


   
 }

 function marcardetallesleidos(div){
    var request = $.ajax({
     url: "script.php",
     method: "POST",
     data: { iduser : $("#mnidusuario").val(),
             detallesleidos: $("#mnidnoleidos"+div).val(),
             tipominuta: $("#mntipominuta").val()
             },
     dataType: "html"
   });

   request.done(function( msg ) {
      if (msg.substring(0,5) != ""){         
        document.getElementById("espera"+div).innerHTML = "Request failed: Lectura no registrada";} 
      else {
        document.getElementById("espera"+div).innerHTML = "";
        document.getElementById("dvDetalles"+div).innerHTML = "";
      }
     });
 
   request.fail(function( jqXHR, textStatus ) {
        document.getElementById("espera"+div).innerHTML = "Request failed: Lectura no registrada " + textStatus ;
   });  


   
 }

function agregardetalle(div){
  console.log(div);
    document.getElementById("espera"+div).innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    var request = $.ajax({
     url: "script.php",
     method: "POST",
     data: { iduser : $("#mnidusuario").val(),
             detalleagregado: $("#detallesnuevaminuta"+div).val(),
             tipominuta: $("#mntipominuta").val(),
             codigominuta: $("#mnidminuta"+div).val(),
             idsalon: $("#mnidsalon").val(),
             idregion: $("#mnidregion").val()
             },
     dataType: "html"
   });

   request.done(function( msg ) {
      if (msg.substring(0,5) != "Error"){
         document.getElementById("contenedorprincipal").innerHTML = msg;                 
    }else{
        document.getElementById("espera"+div).innerHTML = "Failed received: " + msg;} 
     });
 
   request.fail(function( jqXHR, textStatus ) {
        document.getElementById("espera"+div).innerHTML = "Request failed: " + textStatus;
   });  
 }

 function marcardestacada(div, $valor){
  if(div === ""){
    document.getElementById("resultpinnednone").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
  } else{
    //alert("Variable: "+div);
      document.getElementById("resultpinned"+div).innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
     var request = $.ajax({
     url: "script.php",
     method: "POST",
     data: { action: "updtprior",
             idminuta: $("#mnidminuta"+div).val(),
             tipominuta: $("#mntipominuta").val(),
             valorupdt: $valor,
             razon: "Minuta pinned"},
     dataType: "html"
   });
 
   request.done(function( msg ) {
     if (msg == ""){
       /* $("#mncolor"+div).removeClass("alert-success").addClass("alert-warning");
        $("#lbcerrar"+div).removeClass("visible").addClass("oculto");
        $("#lbverificar"+div).removeClass("oculto").addClass("visible");
        $("#lbabrir"+div).removeClass("oculto").addClass("visible");
        $("#razonapertura"+div).val("");*/
      document.getElementById("resultpinned"+div).innerHTML = "<br>¡Cambio de estado para la Minuta realizado!";
      refresh();
} else{
        document.getElementById("resultpinned"+div).innerHTML = "";
        document.getElementById("resultpinned"+div).innerHTML = "Error: " + msg ; 
     }
    });
 
   request.fail(function( jqXHR, textStatus ) {
     document.getElementById("resultpinned"+div).innerHTML = "";
        document.getElementById("resultpinned"+div).innerHTML = "Error: " + textStatus ;
   });
  }
 }

 function mostrarbusqueda(){

    if ($("#semillabusqueda").hasClass("oculto")){
       $("#semillabusqueda").removeClass("oculto").addClass("visible");
       $("#semilla").focus();
    } 
    else {
       $("#semillabusqueda").removeClass("visible").addClass("oculto");
    }
} //mostrar busqueda



 function buscarminuta(e){

  tecla = (document.all) ? e.keyCode : e.which;

  if (tecla==13) {



      document.getElementById("espera").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
      document.getElementById("contenedorprincipal").innerHTML = "";
  
      if (document.getElementById("semilladetalle").checked){
         mostrardetalles=1;
      }
      else{
         mostrardetalles=0;
      }
       
    

      var request = $.ajax({
         url: "script.php",
         method: "POST",
         data: { semilla : $("#semilla").val(),
                 idsalon: $("#mnidsalon").val(),
                 idregion: $("#mnidregion").val(),                 
                tipominuta: $("#mntipominuta").val(),
                detalles: mostrardetalles},
                dataType: "html"
               });

       request.done(function( msg ) {            
          if (msg.substring(0,5) != "Error"){         
            //Hace el llamado a la funcion para llenar el innerhtml con los resultados de la busqeuda
            
            var pagina = $.ajax({
                url: "script.php",
                method: "POST",
                data: { funcion: "cargar",
                        registros: msg,
                        tipominuta: $("#mntipominuta").val(),
                        semilla: $("#semilla").val()
                      },
                dataType: "html"
            }); //Fin del .ajax

            pagina.done(function( html1 ) {
                document.getElementById("contenedorprincipal").innerHTML = html1;
                document.getElementById("espera").innerHTML = "";
            });

            pagina.fail(function( jqXHR, textStatus ) {
                document.getElementById("espera").innerHTML = "";
                document.getElementById("espera").innerHTML = "Request failed: " + textStatus ;
            });   

          }else{
               
                document.getElementById("espera").innerHTML = "Request failed: " + msg ; 
          }
     
        });
 
       request.fail(function( jqXHR, textStatus ) {
         
           document.getElementById("espera").innerHTML = "";
           document.getElementById("espera").innerHTML = "Request failed: " + textStatus ;
       });   
       return false;

} //Si se presiona la  tecla enter
   

 }  //buscar minuta


 function refresh() { // refresh la página
    setTimeout(function () {
        location.reload()
    }, 100);
}

function enviarMinMail($datos, $tipom, $idmin, $paso){

  if($datos == ""){
        document.getElementById("modalMinuta").innerHTML = '<div class="alert alert-danger"><strong>Hubo un error al cargar la información.</strong><br>Cód. Error: SM0001.</div>';
  } else {
    $nombre = "";
    if($paso == "1" || $paso == "2"){
      if($paso == "1"){$nombre = "initreg";} else if($paso == "2"){$nombre = "initsal"}

      $.ajax({
            method : "POST",
            url: 'script.php',
            data:{action:'sMM', datos: $idmin, paso: $nombre},
            success:function(html) {
             document.getElementById("spacedefaultinput").innerHTML = '<input type="email" class="form-control" id="email" name="email" value="'+html+'" disabled>';
             document.getElementById("btnConEnv").disabled = false;
            },
            error: function(data) {                   
               document.getElementById("spacedefaultinput").innerHTML ='Error al traer los datos: '+data;
            }
       });
    } else if($paso == "11"){
      var totmin = document.getElementsByName("mintod")[0].value;
      var email = document.getElementsByName("email")[0].value;var idmin = document.getElementsByName("hidMin")[0].value;

      document.getElementById("modalMinuta").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
      $.ajax({
            method : "POST",
            url: 'script.php',
            data:{action:'sMM', datos: totmin, correo1: email, idsalon: idmin, paso: 'sendReg'},
            success:function(html) {
              document.getElementById("modalMinuta").innerHTML = html;
            },
            error: function(data) {                   
              document.getElementById("modalMinuta").innerHTML ='<div class="alert alert-danger"><strong>Error al traer los datos: </strong><br>'+data+'</div>';
            }
       });

    } else if($paso == "22"){
      var totmin = document.getElementsByName("mintod")[0].value;
      var email = document.getElementsByName("email")[0].value;var email2 = document.getElementsByName("email2")[0].value;var idmin = document.getElementsByName("hidMin")[0].value;

      //console.log(totmin2);console.log(email);console.log(email2);
      document.getElementById("modalMinuta").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
      $.ajax({
            method : "POST",
            url: 'script.php',
            data:{action:'sMM', datos: totmin, correo1: email, correo2: email2, idsalon: idmin, paso: 'sendSal'},
            success:function(html) {
             /*document.getElementById("modalMinuta").innerHTML = '<input type="email" class="form-control" id="email" name="email" value="'+html+'" disabled>';
             document.getElementById("btnConEnv").disabled = true;*/
             document.getElementById("modalMinuta").innerHTML = html;
            },
            error: function(data) {                   
               document.getElementById("modalMinuta").innerHTML ='<div class="alert alert-danger"><strong>Error al traer los datos: </strong><br>'+data+'</div>';
            }
       });
    } else if($paso == "33"){
      var totmin = document.getElementsByName("mintod")[0].value;
      var email = document.getElementsByName("email")[0].value;var idmin = document.getElementsByName("hidMin")[0].value;

      document.getElementById("modalMinuta").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
      $.ajax({
            method : "POST",
            url: 'script.php',
            data:{action:'sMM', datos: totmin, correo1: email, idsalon: idmin, paso: 'sendCom'},
            success:function(html) {
             document.getElementById("modalMinuta").innerHTML = html;
            },
            error: function(data) {                   
               document.getElementById("modalMinuta").innerHTML ='<div class="alert alert-danger"><strong>Error al traer los datos: </strong><br>'+data+'</div>';
            }
       });
    }
  }
}

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