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

function newminuta1($idactividad, $idproyecto, $usuario, $accesos){
    if($idactividad == ""){
        document.getElementById("newminutaspace").innerHTML = "ERROR: Actividad no definida.";
    } else if ($idproyecto == ""){
        document.getElementById("newminutaspace").innerHTML = "ERROR: Proyecto no definido.";
    } else {
        document.getElementById("newminutaspace"+$idactividad).innerHTML = "<li class='list-group-item clist' style='background-color: #ebebeb;'><div class='form-group'><label for='newminuta'>Nueva Minuta:</label><input type='text' class='form-control' id='newminuta'></div><button type='button' onClick='' class='btn btn-default'>Guardar</button></li>";

    }
}

function newminuta20($idproyecto, $detalles, $usuario, $accesos){

}

function newminuta2($idproyecto, $idactividad, $usuario){
    
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

