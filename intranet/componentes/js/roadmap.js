function initLoad($user){
	if($user == ""){
            document.getElementById("texto").innerHTML = "No hay usuario definido.";
	} else{
        document.getElementById("texto").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";

      $.ajax({
        type: 'post',
        url: '/intranet/roadmap/api.php',
        data:{action:'roadinit', datos: $user},
        success: function(response) {           
            document.getElementById("texto").innerHTML = response;
            //initData($user);
        },
        error: function(response) {
            //console.log(response);
            document.getElementById("texto").innerHTML = "ERROR: "+response;
        }
    });
  }
}

$('#infopr').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var recipient = button.data('i');var recipientu = button.data('ii');var modal = $(this)    
        document.getElementById("modalprcontent").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        document.getElementById("prtit").innerHTML = recipientu;
        document.getElementById("prtit1").innerHTML = recipientu;

prtit
        dataProy(recipient);
    
});

$('#actipr').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var recipient = button.data('i');var recipientu = button.data('ii');var recipientri = button.data('iii');var modal = $(this)    
        document.getElementById("modalpracti").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";
        document.getElementById("practtit").innerHTML = recipientu;
        //document.getElementById("prtit1").innerHTML = recipientu;

        show(recipient+";"+recipientri, "roadActividades1");
        //dataProy(recipient);
    
});

function dataProy($id){
	if($id == ""){
            document.getElementById("modalprcontent").innerHTML = "Error en información.";
	} else{


      $.ajax({
        type: 'post',
        url: '/intranet/roadmap/api.php',
        data:{action:'roadproyect', datos: $id},
        success: function(response) {           
            document.getElementById("modalprcontent").innerHTML = response;

            //document.getElementById("osboton").disabled = true;
            //manejoJs(response);
        },
        error: function() {
            console.log(response);
            document.getElementById("modalprcontent").innerHTML = "ERROR: "+response;
        }
    });
  }
}

function show($data, $paso){
    if($paso == ""){
        document.getElementById("modalpracti").innerHTML = "";
    } else{
        if($paso == "roadActividades1"){
            document.getElementById("modalpracti").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";

            $.ajax({
                type: 'post',
                url: '/intranet/roadmap/api.php',
                data:{action:'roadActividades1', datos: $data},
                success: function(response) {           
                    document.getElementById("modalpracti").innerHTML = response;

                    //document.getElementById("osboton").disabled = true;
                    //manejoJs(response);
                },
                error: function() {
                    console.log(response);
                    document.getElementById("modalpracti").innerHTML = "ERROR: "+response;
                }
            });
        }
    }
}
function newactivity($idpr, $categorypr, $paso){
    var newactividad= document.getElementById("newactivity").value;
    if($paso == 1){ //agregar actividad
        $.ajax({
                type: 'post',
                url: '/intranet/roadmap/libreria.php',
                data:{action:'agregarActividad', datos: newactividad, catacti: $categorypr, idpr: $idpr},
                success: function(response) {           
                   // document.getElementById("modalpracti").innerHTML = response;
                if (response != 0) { 
                var fila = '<tr colspan="4">    <td >    <div class="form-check">    <label class="form-check-label">    <input class="form-check-input" type="checkbox" value="" disabled>   <span class="form-check-sign">  <span class="check">    </span></span></label></div></td>   <td id="nombre'+response+'">'+newactividad+'</td><td class="td-actions text-right" style="float:right;"><button type="button" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-tipo= "verAct" data-otro="'+newactividad+'" data-id="'+response+'" data-target="#minimodal"><i class="material-icons">search</i></button><button type="button" rel="tooltip" title="Edit Task" class="btn btn-primary btn-link btn-sm" data-toggle="modal" data-tipo="modificarAct" data-otro="'+newactividad+'" data-target="#minimodal"  data-id="'+response+'"><i class="material-icons">edit</i></button><button type="button" rel="tooltip" title="Remove" class="btn btn-danger btn-link btn-sm" onclick="deleteactivity('+response+')"><i class="material-icons">close</i></button></td></tr>';
                        var btn = document.createElement("TR");   //crea Fila donde se insertara la actividad nueva
                        btn.innerHTML=fila;  //agrega contenido a la fila
                        btn.setAttribute('id',"actividad"+response); //le asigna id a la fila
                        document.getElementById("actividadagregada").appendChild(btn);
                        document.getElementById("nohay").innerHTML = "";
                        $('#minimodal').modal('hide');
                        $.notify({
                                  icon: "add_alert",
                                  message: "La actividad ha sido <b>Creada</b> satisfactoriamente."

                                }, {
                                  type: 'success',
                                  timer: 500,
                                  placement: {
                                    from: 'bottom',
                                    align: 'right'
                                  }
                                });
                        // document.getElementById("mensajemodal").innerHTML = "<div class='modal-body' style='text-align:center'><h3>Actividad creada.</h3></div>";
                        // document.getElementById("formulario").innerHTML = "";
                        // document.getElementById("m-titulo").innerHTML = "";
                        // document.getElementById("modal-footer").innerHTML = "";
                        // setTimeout(function(){ $('#minimodal').modal('hide'); }, 900);
                        

                
                
                 } 
                else { alert('no se creo nada'+response);
                        console.log(response); }
                }
                ,
                error: function() {
                    console.log(response);
                    
                   // document.getElementById("modalpracti").innerHTML = "ERROR: "+response;
                }
            });
    }
}
function deleteactivity($id){
    $.ajax({
                type: 'post',
                url: '/intranet/roadmap/libreria.php',
                data:{action:'eliminarActividad', id: $id},
                success: function(response) {           
                 
                if (response != 0) { 
            document.getElementById("actividad"+$id).innerHTML = "";
            // alert('Actividad Eliminada');
            $.notify({
      icon: "add_alert",
      message: "La actividad ha sido <b>Eliminada</b> satisfactoriamente."

    }, {
      type: 'danger',
      timer: 500,
      placement: {
        from: 'bottom',
        align: 'right'
      }
    });


} else {
    alert('Error al eliminar actividad');
}
}
})
}
function deleteminuta($id){
    $.ajax({
                type: 'post',
                url: '/intranet/roadmap/libreria.php',
                data:{action:'eliminarMinuta', id: $id},
                success: function(response) {           
                 
                if (response != 0) { 
            document.getElementById("hito"+$id).innerHTML = "";
            // alert('Actividad Eliminada');
            $.notify({
      icon: "add_alert",
      message: "El Hito ha sido <b>Eliminado</b> satisfactoriamente."

    }, {
      type: 'danger',
      timer: 500,
      placement: {
        from: 'bottom',
        align: 'right'
      }
    });


} else {
    alert('no se me elimino un sevillo');
}
}
})
}
function editactivity($id, $paso){
    var newname= document.getElementById("newname").value;
    if($paso == 1){ //agregar actividad
        $.ajax({
                type: 'post',
                url: '/intranet/roadmap/libreria.php',
                data:{action:'editarActividad', nuevonombre: newname, id: $id},
                success: function(response) {           
                   // document.getElementById("modalpracti").innerHTML = response;
                if (response != 0) { 
                        document.getElementById("mensajemodal").innerHTML = "<div class='modal-body' style='text-align:center'><h3>Modificada Con exito.</h3></div>";
                        document.getElementById("formulario").innerHTML = "";
                        document.getElementById("m-titulo").innerHTML = "";
                        document.getElementById("modal-footer").innerHTML = "";
                        setTimeout(function(){ $('#minimodal').modal('hide'); }, 900);
                        document.getElementById("nombre"+$id).innerHTML = newname;

                
                
                 } 
                else { alert('no se creo nada'+response);
                        console.log(response); }
                }
                ,
                error: function() {
                    console.log(response);
                    
                   // document.getElementById("modalpracti").innerHTML = "ERROR: "+response;
                }
            });
    }
}
function editminuta($id, $paso, $nombre){
    
    if($paso == 1){ //agregar actividad
       
                        document.getElementById("hito"+$id+"").innerHTML = '<li class"list-group-item clist"><span class="col-sm-8"><input type="text"  class="form-control" id="nuevonombre" value="'+$nombre+'"></span><span class="col-sm-4" onclick="editminuta('+$id+', 2, 0)" ></input><button style="cursor:pointer; float:right;" class="btn btn-info btn-sm"><i class="material-icons">done</i>Guardar</button></span></li><br>';
                     
    }
    if($paso ==2){ //insert en database
                        var nombrenuevo = document.getElementById("nuevonombre").value;
                         $.ajax({
                type: 'post',
                url: '/intranet/roadmap/libreria.php',
                data:{action:'editarMinuta', nuevonombre: nombrenuevo, id: $id},
                success: function(response) {           
                   // document.getElementById("modalpracti").innerHTML = response;
                if (response != 0) { 
                    setTimeout(function(){ $('#minimodal').modal('hide'); }, 100);
                       $.notify({
      icon: "add_alert",
      message: "El Hito ha sido <b>Modificado</b> satisfactoriamente."

    }, {
      type: 'success',
      timer: 500,
      placement: {
        from: 'top',
        align: 'center'
      }
    });


                
                
                 } 
                else { alert('no se creo nada'+response);
                        console.log(response); }
                }
                ,
                error: function() {
                    console.log(response);
                    
                   // document.getElementById("modalpracti").innerHTML = "ERROR: "+response;
                }
            });
}
}
function createCategory(){
    var newcategory= document.getElementById("newcategory").value;
    
        $.ajax({
                type: 'post',
                url: '/intranet/roadmap/libreria.php',
                data:{action:'crearCategoria', nuevacategoria: newcategory},
                success: function(response) {           
                   // document.getElementById("modalpracti").innerHTML = response;
                if (response != 0) { 
                        document.getElementById("mensajemodal").innerHTML = "<div class='modal-body' style='text-align:center'><h3>Creada Con exito.</h3></div>";
                        document.getElementById("formulario").innerHTML = "";
                        document.getElementById("m-titulo").innerHTML = "";
                        document.getElementById("modal-footer").innerHTML = "";
                        setTimeout(function(){ $('#minimodal').modal('hide'); }, 900);
                        document.getElementById("nombre"+$id).innerHTML = newname;

                
                
                 } 
                else { alert('no se creo nada'+response);
                        console.log(response); }
                }
                ,
                error: function() {
                    console.log(response);
                    
                   // document.getElementById("modalpracti").innerHTML = "ERROR: "+response;
                }
            });
    }

function newminuta1($idactividad, $otro, $paso){
 
    if($paso == 1){  //MOSTRAT BOTON INPUT DE AGREGAR MINUTA
        document.getElementById("mensaje0").innerHTML ="";
        if($idactividad == ""){
            document.getElementById("newminutaspace").innerHTML = "ERROR: Actividad no definida.";
        }  else {
            document.getElementById("newminutaspace").innerHTML = "<li class='list-group-item clist' style='background-color: #ebebeb;'><div class='form-group'><label for='newminuta'>Nuevo Hito:</label><input type='text' class='form-control' id='newminuta'></div><button type='button' onClick='newminuta1("+$idactividad+",0,2)' class='btn btn-default'>Agregar</button></li>";

        }
    } else if($paso == 2){  //AGREGAR MINUTA
            var newminuta= document.getElementById("newminuta").value;
           document.getElementById("newminutaspace0").innerHTML += '<li class="list-group-item clist" data-checked="true"><div class="form-check"><label class="form-check-label"><input class="form-check-input" type="checkbox" value="'+$idactividad+'"><span class="form-check-sign"><span class="check"></span></span>'+newminuta+'</label></div></li>';
            document.getElementById("newminutaspace").innerHTML ="";

            $.ajax({
                type: 'post',
                url: '/intranet/roadmap/libreria.php',
                data:{action:'agregarMinuta', datos: newminuta, idac: $idactividad},
                success: function(response) {           
                if (response == 1) {
                 $.notify({
      icon: "add_alert",
      message: "La minuta ha sido <b>Creada</b> satisfactoriamente."

    }, {
      type: 'success',
      timer: 500,
      placement: {
        from: 'top',
        align: 'left'
      }
    });
                  } 
                else { alert('no se creo nada'+response);
                        console.log(response); }
                }
                ,
                error: function() {
                    console.log(response);
                    
                   // document.getElementById("modalpracti").innerHTML = "ERROR: "+response;
                }
            });
    }


}
function changestatus($idminuta){
    $.ajax({
        type: 'post',
        url: '/intranet/roadmap/libreria.php',
        data: {action: 'cambiarStatus', datos: $idminuta},
        success: function(response) {           
                if (response == 1) { alert('status cambiado'); } 
                else { alert('no se creo nada'+response);
                        console.log(response); }
                }
                ,
                error: function() {
                    console.log(response);
                    
                   // document.getElementById("modalpracti").innerHTML = "ERROR: "+response;
                }
    });
    }

$('#minimodal').on('show.bs.modal', function (event) {   //modifica contenido del modal by id (m-titulo, m-body)
    var button = $(event.relatedTarget);var id = button.data('id');var tipo = button.data('tipo');var otro = button.data('otro'); var modal = $(this)    

        document.getElementById("m-body").innerHTML = "<div align='center'><img src='/intranet/componentes/images/loading-sm.gif'></div><br>";

  

        $.ajax({
        type: 'post',
        url: '/intranet/roadmap/api.php',
        data:{action:tipo, datos: id, categoria: otro}, // ver id=idactividad-- nuevo id=idproyecto
        success: function(response) {           
            document.getElementById("m-body").innerHTML = response;
             var tituloModal = document.getElementById("title").value;
             document.getElementById("m-titulo").innerHTML = tituloModal;
            //document.getElementById("osboton").disabled = true;
            //manejoJs(response);
        },
        error: function() {
            console.log(response);
            //document.getElementById("contentRoadmap").innerHTML = "ERROR: "+response;
        }
    });


    
});

function prueba($mensaje){
    alert($mensaje);
}


function manejoJs($data){

	console.log($data);
	/*$respuesta = JSON.parse($data);
	alert($respuesta);
	for (var i = 0; i < $respuesta.length; i++){
	  //document.write("<br><br>array index: " + i);
	  var obj = $respuesta[i];
	  for (var key in obj){
	    var value = obj[key];
	    //document.write("<br> - " + key + ": " + value);
	    alert(i);
	    document.getElementById("proyid"+i).innerHTML = "OK";
//proyid
	  }
	}*/



	//console.log($respuesta[0]["nombrepr"]);
    //document.getElementById("texto").innerHTML = "OK";
    //console.log($respuesta);

}

  $(function () {
    $('.list-group.checked-list-box .list-group-item').each(function () {
        
        // Settings
        var $widget = $(this),
            $checkbox = $('<input type="checkbox" class="hidden" />'),
            color = ($widget.data('color') ? $widget.data('color') : "primary"),
            style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };
            
        $widget.css('cursor', 'pointer')
        $widget.append($checkbox);

        // Event Handlers
        $widget.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });
          

        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $widget.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $widget.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$widget.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $widget.addClass(style + color + ' active');
            } else {
                $widget.removeClass(style + color + ' active');
            }
        }

        // Initialization
        function init() {
            
            if ($widget.data('checked') == true) {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
            }
            
            updateDisplay();

            // Inject the icon if applicable
            if ($widget.find('.state-icon').length == 0) {
                $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
            }
        }
        init();
    });
    
    $('#get-checked-data').on('click', function(event) {
        event.preventDefault(); 
        var checkedItems = {}, counter = 0;
        $("#check-list-box li.active").each(function(idx, li) {
            checkedItems[counter] = $(li).text();
            counter++;
        });
        $('#display-json').html(JSON.stringify(checkedItems, null, '\t'));
    });
});

function cargarProyecto(id){  //envia x ajax la informacion para cargar informacion de proyecto en contentRoadmap
    $idpr=id;
     $.ajax({
        type: 'post',
        url: '/intranet/roadmap/libreria.php',
        data:{action:'cargarP', datos: $idpr},
        success: function(response) {
        document.getElementById("contentRoadmap").innerHTML = response; 
         // $( document ).ready(function() {
         //     $(".nav li").on("click", function(){
         //        $(".nav").find(".active").removeClass("active");
         //        $(this).addClass("activopr");
         //     });
         // });

            // if (document.getElementsByTagName("LI")[0].classList.contains("active")) { 
            //     document.getElementsByTagName("LI").removeAttribute("class", "active");
            //     document.getElementById("pro"+id+"").setAttribute("class", "active");
            //   }
            // else {
            // document.getElementById("pro"+id+"").setAttribute("class", "active");
            // }
            //document.getElementById("osboton").disabled = true;
            //manejoJs(response);
        },
        error: function() {
            console.log(response);
            document.getElementById("contentRoadmap").innerHTML = "ERROR: "+response;
        }
    });
    
}
function cargarCategorias(){  //envia x ajax la informacion para cargar informacion de proyecto en contentRoadmap
        $.ajax({
        type: 'post',
        url: '/intranet/roadmap/libreria.php',
        data:{action:'cargarCateg'},
        success: function(response) {           
            document.getElementById("contentRoadmap").innerHTML = response;

            //document.getElementById("osboton").disabled = true;
            //manejoJs(response);
        },
        error: function() {
            console.log(response);
            document.getElementById("contentRoadmap").innerHTML = "ERROR: "+response;
        }
    });
    
}

function showNotification(from, align) {
    type = ['', 'info', 'danger', 'success', 'warning', 'rose', 'primary'];

    color = Math.floor((Math.random() * 6) + 1);

    $.notify({
      icon: "add_alert",
      message: "Welcome to <b>Material Dashboard</b> - a beautiful freebie for every web developer."

    }, {
      type: type[color],
      timer: 3000,
      placement: {
        from: from,
        align: align
      }
    });
  }

