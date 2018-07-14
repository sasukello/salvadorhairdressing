/* 
 * Intranet - Inicio.
 */
//'use strict';

function cargaInicial(usuario){
  if (usuario === "") {
        document.getElementById("componente1").innerHTML = "";
        document.getElementById("componente2").innerHTML = "";
        document.getElementById("componente3").innerHTML = "";
        document.getElementById("componente4").innerHTML = "";
        document.getElementById("componente5").innerHTML = "";
        document.getElementById("c6").innerHTML = "";
        return;
    } else {
        postIntranet(usuario, "2");
        postIntranet(usuario, "1");
        postIntranet(usuario, "3");
        document.getElementById("componente1").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        document.getElementById("componente2").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        document.getElementById("componente3").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        document.getElementById("componente4").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        /*mostrar($id, $funcion);*/
    }
};

$('#modaldashboard').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var recipient = button.data('cs');var recipientu = button.data('ns');var modal = $(this)    
        document.getElementById("contenedormodaldashboard").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        document.getElementById("aliasvd").innerHTML = recipientu;
        detallesdashboard(recipient);
    
});

function componente1($usuario){
    if ($usuario === "") {
        document.getElementById("componente1").innerHTML = "";
        return;
    } else {
        $resultado1 = postMinutas($usuario, "region");
        return "Tienes "+$resultado1+" Minutas por leer.";
    }
};

function postMinutas($usuario, $tipo){
    if ($tipo === "") {
        return "Error";
    } else if($tipo === "region") {
           
        $resultado1 = postMinutas($usuario, "region");
        return "Tienes "+$resultado1+" Minutas por leer.";
    }  
};

function postIntranet($usuario, $paso){
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        var xmlhttp = new XMLHttpRequest();
    } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var myObj = JSON.parse(this.responseText);
            document.getElementById("componente2").innerHTML = myObj;
            
            
            //document.getElementById("componente1").innerHTML = xmlhttp.responseText;
        }
    };

    if($paso === "1"){
        $.ajax({
            method : "POST",
            url: '/intranet/live/externo.php',
            data:{action:'postintranet', datos: $usuario},
            success:function(html) {
            // document.getElementById("componente1").innerHTML = html;
            //document.getElementById("componente2").innerHTML = myObj;
            manejarJson(html);
            
             return;
            }
       });
    } else if ($paso === "2") {
        $.ajax({
            method: "POST",
            url: '/intranet/live/externo.php',
            data:{action:'postintranetbeta', datos: $usuario},
            success: function(html){
                document.getElementById("componente5").innerHTML = html;
                return;
            }
        });
    } else if ($paso === "3") {
        $.ajax({
            method: "POST",
            url: '/intranet/live/externo.php',
            data:{action:'postintranet3', datos: $usuario},
            success: function(html){
                document.getElementById("c6").innerHTML = html;
                //armarDT();
                return;
            }
        });
    }
};

function armarDT(){
        $('.datatable').each(function(index){
             $('#'+$(this).attr('id')).dataTable( {
                "bProcessing": true,
                "sAjaxSource": $(this).children('caption').html(),
                "bSort": false,
                "ajax": {
                        "url": "convenios.php",
                        "dataSrc": "",
                        "type": "POST",
                        "data":{action:'postconvenios', datos: '<?php echo $iduser;?>' }
                },
                "fnDrawCallback": function() {
                 }
            });
        });
}

function manejarJson($html){
    var myObj = JSON.parse($html);
    //console.log(myObj);
    var $mreg = parseInt(myObj[0]["MINUTASREGION"]);
    var $msal = myObj[0]["MINUTASSALON"];
    var msl2 = myObj[0]["DETALLESMINUTASALON"];
    var $mcom = myObj[0]["MINUTASCOMITE"];
    var $t1 = myObj[0]["TICKETSPENDIENTE"];
    var $t2 = myObj[0]["TICKETSACTIVO"];
    var $t3 = myObj[0]["TICKETSPAUSADO"];
    var $t4 = myObj[0]["TICKETSREASIGNADO"];
    
    if($mreg < 1){
        var $f1=0;
    } 
    if($msal < 1 && msl2 <1){
        var $f2=0;
    } 
    if($mcom < 1){
        var $f3=0;
    }
    
    if($t1 < 1 && $t2 < 1 && $t3 < 1 && $t4 < 1){
        var $f4=0;
    }
    
    if($f1 === 0 && $f2 === 0 && $f3 === 0 && $f4 === 0){
        document.getElementById("c1").innerHTML = "<div class='alert alert-success'><strong>¡No tienes tareas pendientes!</strong></div>";
        document.getElementById("c2").innerHTML = "";
        document.getElementById("c3").innerHTML = "";
        document.getElementById("c4").innerHTML = "";

    }
    else{
        if($f1!==0){
            showc1(myObj);
        } else if($f1<1){
            document.getElementById("c1").innerHTML = "";
        }
        if($f2!==0){
            showc2(myObj);
        } else if($f2<1){
            document.getElementById("c2").innerHTML = "";
        }
        if($f3!==0){
            showc3(myObj);
        } else if($f3<1){
            document.getElementById("c3").innerHTML = "";
        }
        if($f4!==0){
            showc4(myObj);
        } else if($f4<1){
            document.getElementById("c4").innerHTML = "";
        }
        
        //document.getElementById("componente1").innerHTML = "¡Tienes tareas pendientes!";
        var noti = $mreg + $msal + $mcom;
        if (noti == 0){ noti = "!";}
        document.getElementById("notHead").innerHTML = "<span id='notHead' class='notificationHead'>"+noti+"</span>";
        console.log("Carga Completa!");
    }
}

function showc1($objeto){
    var $msal = $objeto[0]["MINUTASREGION"];
    var $nr = $objeto[0]["NOMBRESREGIONES"];
    var $ndr = $objeto[0]["NOMBREDETALLESREGION"];
    
    var $nr2 = limpiar($nr);
    
    var $nr3 = colorear($nr2);
    var $ndr2 = limpiar($ndr);

    document.getElementById("componente1").innerHTML = "<p>Tienes <strong>"+$msal+" minutas</strong>, en las regiones:<br>"+$nr3+".</p>Se hicieron observaciones a <strong>"+$objeto[0]["DETALLESMINUTAREGION"]+" puntos</strong> en las Minutas de las Regiones: <br>"+$ndr2+".";
}

function showc2($objeto){
    var $msal = $objeto[0]["MINUTASSALON"];
    var $nr = $objeto[0]["NOMBRESSALONES"];
    var $ndr = $objeto[0]["NOMBREDETALLESSALON"];
    
    var $nr2 = limpiar($nr);
    var $ndr2 = limpiar($ndr);

    if($msal < 1){
        document.getElementById("componente2").innerHTML = "<p>Se hicieron observaciones a <strong>"+$objeto[0]["DETALLESMINUTASALON"]+" puntos</strong> en las Minutas de los Salones: <br>"+$ndr2+".</div>";
    } else {
        document.getElementById("componente2").innerHTML = "<p>Tienes <strong>"+$msal+" minutas</strong>, en los salones:<br>"+$nr2+".<span tabindex='0' onclick='showhide();return;'><i i class='material-icons text-danger pe-7s-info moreicon'></i></span></p><div class='txtadicional' id='txadicional' style='display:none;'>Se hicieron observaciones a <strong>"+$objeto[0]["DETALLESMINUTASALON"]+" puntos</strong> en las Minutas de los Salones: <br>"+$ndr2+".</div>";
    }

}

function showc3($objeto){
    var $msal = $objeto[0]["MINUTASCOMITE"];
    var $nr = $objeto[0]["MINUTASCOMITEDETALLE"];
    
    document.getElementById("componente3").innerHTML = "<p>Tienes <strong>"+$msal+" minutas</strong> de Comité.</p>Se hicieron observaciones a <strong>"+$nr+" puntos</strong> en las Minutas de Comité.<br>";
}

function showc4($objeto){
    var $t1 = $objeto[0]["TICKETSPENDIENTE"];
    var $t2 = $objeto[0]["TICKETSACTIVO"];
    var $t3 = $objeto[0]["TICKETSPAUSADO"];
    var $t4 = $objeto[0]["TICKETSREASIGNADO"];
    
    var c1 = prioridad($t1);var c2 = prioridad($t2);var c3 = prioridad($t3);var c4 = prioridad($t4);
    
    document.getElementById("componente4").innerHTML = "<p><strong>Resumen:</strong><ul class='list-group'><li class='list-group-item "+c1+"'>Tickets Pendientes <span class='badge'> "+$t1+"</span></li><li class='list-group-item "+c2+"'>Tickets Activos <span class='badge'> "+$t2+"</span></li><li class='list-group-item "+c3+"'>Tickets Pausados <span class='badge'> "+$t3+"</span></li><li class='list-group-item "+c4+"'>Tickets Reasignados <span class='badge'> "+$t4+"</span></li></ul></p>";
}

function limpiar($texto){
    var $n = $texto.startsWith(",", 0);
    if($n === true){
        var res = $texto.replace(",", "");
        return res;
    }
}

function showhide(){
    
    if(document.getElementById("txadicional").style.display === "none"){
        document.getElementById("txadicional").style.display = "inline-block";
    } else if(document.getElementById("txadicional").style.display === "inline-block"){
        document.getElementById("txadicional").style.display = "none";
    }
    return;
}

function prioridad($numero){
    var clase = "";
    if($numero < 5){
        clase = "list-group-item-success";
    } else if($numero >= 5 || $numero < 20){
        clase = "list-group-item-warning";
    } else if($numero >= 20){
        clase = "list-group-item-danger";
    }
    return clase;
}

function colorear($texto){
        var res = $texto.split(",");
        return res;
}

function detallesdashboard(codigosalon){
    //alert(div);    
     var request = $.ajax({
     url: '/intranet/live/externo.php',
     method: "POST",
     data:{action:'detalleventadashboard', datos: codigosalon},
     /*data: { idsalon : codigosalon,
             funcion: "detalleventadashboard"},*/
     success: function(html){
                document.getElementById("contenedormodaldashboard").innerHTML = html;
                return;
            }
   });
}            

function sortTable(n, origen) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  var nombre = "trvd"+origen;
  table = document.getElementById(nombre);
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/


      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];

      //x = a.replace(',', '');
      //y = b.replace(',', '');

      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}