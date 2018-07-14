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




function listadoserviciossalon(){

    document.getElementById("listadoespera").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    

    var request = $.ajax({
     url: "/intranet/sec/servicios.php",
     method: "POST",
     data: { listadoserviciossalon : "1"},             
     dataType: "html"
   });
 
   request.done(function( msg ) {
     if (msg.substring(0,5) != "Error"){        
      document.getElementById("listadoespera").innerHTML = msg;
      inicializatabla();
      var posicion = $("#btserviciossalon").offset().top;
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


function listaservicios(){

    ddesde = $("#desde").val();
    dhasta = $("#hasta").val();

    document.getElementById("contenedor").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    

    var request = $.ajax({
     url: "/intranet/sec/servicios.php",
     method: "POST",
     data: { listadoservicios : "1",
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

} //Llama la lista de servicios



