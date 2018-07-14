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


function listaclientes(){

    ddesde = $("#desde").val();
    dhasta = $("#hasta").val();

    document.getElementById("contenedor").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    

    var request = $.ajax({
     url: "/intranet/sec/clientes.php",
     method: "POST",
     data: { listadoclientes : "1",
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

} //Llama la lista de clientes

function clientesperdidos(){

    dvisitas = $("#visitas").val();
    ddias    = $("#dias").val();

    document.getElementById("contenedor").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    

    var request = $.ajax({
     url: "/intranet/sec/clientes.php",
     method: "POST",
     data: { listadoclientesperdidos : "1",
             dias: ddias,
             visitas: dvisitas},             
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

} //Llama la lista de clientes perdidos


function listaclientesespera(){

    document.getElementById("listadoespera").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    

    var request = $.ajax({
     url: "/intranet/sec/clientes.php",
     method: "POST",
     data: { listadoclientesespera : "1"},             
     dataType: "html"
   });
 
   request.done(function( msg ) {
     if (msg.substring(0,5) != "Error"){        
      document.getElementById("listadoespera").innerHTML = msg;
      inicializatabla();
      var posicion = $("#btclientesespera").offset().top;
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

} //Llama la lista de clientes en espera

function seleccioneslistadoclientes(){

    //Inicializa la tabla 
       var table = $('#vt4').DataTable();

    
  
   //Abre el onclik    
    var data = table.rows( {selected:true} ).data();    
    var clientes = "";       
        for (var i=0; i < data.length ;i++){
           if (clientes != ""){
              clientes = clientes + ", ";
           }
           clientes = clientes + "'"+data[i][0]+"'";
        }
    
    document.getElementById("oculto").innerHTML = "<input type='hidden' name='is' value='"+clientes+"'>";    
    //Aqui se cierra el onclik   
    
    if (clientes==""){
      contenedor = document.getElementById("contenedor").innerHTML;
      document.getElementById("contenedor").innerHTML = "<div align='center' class='alert alert-danger'>No se seleccionaron registros</div><br>"+contenedor;
      inicializatabla();
      $("html, body").animate({
         scrollTop: 0
       }, 2000);
      exit();
    }
    document.getElementById("contenedor").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    

    var request = $.ajax({
     url: "/intranet/sec/clientes.php",
     method: "POST",
     data: { listadoclientesdetalles : "1",
             filtroclientes: clientes},             
     dataType: "html"
   });
 
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
    


} //Consulta la seleccion de listado clientes detalles


function seleccionesserviciosclientes(){

    //Inicializa la tabla 
       var table = $('#vt4').DataTable();

    
  
   //Abre el onclik    
    var data = table.rows( {selected:true} ).data();    
    var clientes = "";       
        for (var i=0; i < data.length ;i++){
           if (clientes != ""){
              clientes = clientes + ", ";
           }
           clientes = clientes + "'"+data[i][0]+"'";
        }
    
    document.getElementById("oculto").innerHTML = "<input type='hidden' name='is' value='"+clientes+"'>";    
    //Aqui se cierra el onclik   
    
    if (clientes==""){
      contenedor = document.getElementById("contenedor").innerHTML;
      document.getElementById("contenedor").innerHTML = "<div align='center' class='alert alert-danger'>No se seleccionaron registros</div><br>"+contenedor;
      inicializatabla();
      $("html, body").animate({
         scrollTop: 0
       }, 2000);
      exit();
    }
    document.getElementById("contenedor").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    

    var request = $.ajax({
     url: "/intranet/sec/clientes.php",
     method: "POST",
     data: { listadoclientesservicios : "1",
             filtroclientes: clientes},             
     dataType: "html"
   });
 
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
    


} //Consulta la seleccion de servicios por clientes