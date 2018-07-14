function inicializamultipletablas(cnt){

   for (i = 1; i <= cnt; i++) { 
      var table = $('#vt'+ i).DataTable( {
        responsive: true,
        lengthChange: false,
        scrollX: true,
        select: {style: 'multi'},
        dom: 'Bfrtlip',
        buttons: [ 'copy', 'excel', 'pdf' ]
      });

      table.buttons().container()
        .appendTo( '#vt'+i+'_wrapper .col-sm-6:eq(0)' );
   }

}


function listaasociados(){

    ddesde = $("#desde").val();
    dhasta = $("#hasta").val();

    document.getElementById("contenedor").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    

    var request = $.ajax({
     url: "/intranet/sec/asociados.php",
     method: "POST",
     data: { listadoasociados : "1",
             desde: ddesde,
             hasta: dhasta},             
     dataType: "html"
   });
 
   request.done(function( msg ) {
     if (msg.substring(0,5) != "Error"){        
      document.getElementById("contenedor").innerHTML = msg;
      inicializatabla();
      $("html, body").animate({
         scrollTop: 0
       }, 2000);
} else{        
        document.getElementById("contenedor").innerHTML = "Request failed (done): " + msg ; 
     }
    });
 
   request.fail(function( jqXHR, textStatus ) {     
        document.getElementById("contenedor").innerHTML = "Request failed (fail): " + textStatus ;
   }); 

   return  false;

} //Llama la lista de asociados


function listadoasociadossalon(){

    document.getElementById("listadoespera").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    

    var request = $.ajax({
     url: "/intranet/sec/asociados.php",
     method: "POST",
     data: { listadoasociadossalon : "1"},             
     dataType: "html"
   });
 
   request.done(function( msg ) {
     if (msg.substring(0,5) != "Error"){        
      document.getElementById("listadoespera").innerHTML = msg;
      inicializatabla();
      var posicion = $("#btasociadossalon").offset().top;
      $("html, body").animate({
         scrollTop: posicion
       }, 2000); 
} else{        
        document.getElementById("listadoespera").innerHTML = "Request failed (done): " + msg ;         
     }
    });
 
   request.fail(function( jqXHR, textStatus ) {     
        document.getElementById("listadoespera").innerHTML = "Request failed (fail): " + textStatus ;
   }); 

   return  false;

} //Llama la lista de asociados en salon

function seleccioneslistadoasociados(funcion){

    ddesde = $("#fechadesde").val();
    dhasta = $("#fechahasta").val();

    //Inicializa la tabla 
       var table = $('#vt4').DataTable();

    
  
   //Abre el onclik    
    var data = table.rows( {selected:true} ).data();    
    var asociados = "";       
        for (var i=0; i < data.length ;i++){
           if (asociados != ""){
              asociados = asociados + ",";              
           }
           asociados = asociados + ""+data[i][0]+"";
        }
    
    //document.getElementById("oculto").innerHTML = "<input type='hidden' name='is' value='"+asociados+"'>";    
    //Aqui se cierra el onclik   
    
    if (asociados==""){
      contenedor = document.getElementById("contenedor").innerHTML;
      document.getElementById("contenedor").innerHTML = "<div align='center' class='alert alert-danger'>No se seleccionaron registros</div><br>"+contenedor;
      inicializatabla();
      $("html, body").animate({
         scrollTop: 0
       }, 2000);
      exit();
    }
    document.getElementById("contenedor").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    

    if (funcion==="d"){
       //Para el detalle de los asociados
       var request = $.ajax({
       url: "/intranet/sec/asociados.php",
        method: "POST",
       data: { listadoasociadosdetalles : "1",
             filtroasociados: asociados,
             desdedet: ddesde,
             hastadet: dhasta
           },             
        dataType: "html"
       });
    }
    else if (funcion==="s"){
       //Para los servicios realizados
       var request = $.ajax({
       url: "/intranet/sec/asociados.php",
        method: "POST",
       data: { servicios : "1",
             asociado: asociados,
             desde: ddesde,
             hasta: dhasta
           },             
        dataType: "html"
       });
    }
    else if (funcion==="c"){
       //Para los servicios realizados
       var request = $.ajax({
       url: "/intranet/sec/asociados.php",
        method: "POST",
       data: { clientes : "1",
             asociado: asociados,
             desde: ddesde,
             hasta: dhasta
           },             
        dataType: "html"
       });
    }
 
   request.done(function( msg ) {
     if (msg.substring(0,5) != "Error"){        
      document.getElementById("contenedor").innerHTML = msg;
      inicializamultipletablas($("#registros").val());
      $("html, body").animate({
         scrollTop: 0
       }, 2000);
} else{        
        document.getElementById("contenedor").innerHTML = "Request failed (done): " + msg ; 
     }
    });
 
   request.fail(function( jqXHR, textStatus ) {     
        document.getElementById("contenedor").innerHTML = "Request failed (fail): " + textStatus ;
   }); 

   return  false;
    


} //Consulta la seleccion de listado de asociados

function conciliaciondiariaasociados(asociado, fecha){
    //pone el tiempo de espera
    document.getElementById("texto").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    //Muestra el modal
    $("#modalconciliaciondiaria").modal();
    //Pide los datos de conciliacion 
    var request = $.ajax({
     url: "/intranet/sec/asociados.php",
     method: "POST",
     data: { conciliaciondiaria : "1",
             asociado: asociado,
             fecha: fecha
           },             
     dataType: "html"
   });

 
   request.done(function( msg ) {
     if (msg.substring(0,5) != "Error"){        
      document.getElementById("texto").innerHTML = msg;
      inicializatabla();      
} else{        
        document.getElementById("texto").innerHTML = "Request failed (done): " + msg ; 
     }
    });
 
   request.fail(function( jqXHR, textStatus ) {     
        document.getElementById("texto").innerHTML = "Request failed (fail): " + textStatus ;
   }); 
    


} //Consulta la seleccion de listado de asociados detalles



