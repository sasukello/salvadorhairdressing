$('#partActivos2').on('show.bs.modal', function (event) {     
    var button = $(event.relatedTarget); var valor1 = button.data('id');
    var modal = $(this);

    showLoad(valor1);

});

$('#partPendientes').on('show.bs.modal', function (event) {     
    var button = $(event.relatedTarget); var valor1 = button.data('id');
    var modal = $(this);
    var data = "";
    document.getElementById("mspendientes").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    $.ajax({
       method : "POST",
       url: '/mysteryshopper/etc/api.php',
       data:{action:'mspend', datos: data},
       success:function(html) {

        document.getElementById('mspendientes').innerHTML = html;
       }
    });

});

$('#partActivos').on('show.bs.modal', function (event) {     
    var button = $(event.relatedTarget); var valor1 = button.data('id');
    var modal = $(this);
    var data = "";
    document.getElementById("msactivos").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    $.ajax({
       method : "POST",
       url: '/mysteryshopper/etc/api.php',
       data:{action:'msact', datos: data},
       success:function(html) {

        document.getElementById('msactivos').innerHTML = html;
       }
    });

});

$('#progVisita').on('show.bs.modal', function (event) {     
    var button = $(event.relatedTarget); var valor1 = button.data('id');
    var modal = $(this);
    var data = "";
    document.getElementById("msprogvisita").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    $.ajax({
       method : "POST",
       url: '/mysteryshopper/etc/api.php',
       data:{action:'mspv', datos: data},
       success:function(html) {

        document.getElementById('msprogvisita').innerHTML = html;
       }
    });

});

$('#repVisita').on('show.bs.modal', function (event) {     
    var button = $(event.relatedTarget); var valor1 = button.data('id');
    var modal = $(this);
    var data = "";
    document.getElementById("msrepvisita").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
    $.ajax({
       method : "POST",
       url: '/mysteryshopper/etc/api.php',
       data:{action:'msrv', datos: data},
       success:function(html) {

        document.getElementById('msrepvisita').innerHTML = html;
       }
    });

});

function showLoad($id) {
    if ($id === "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        /*document.getElementById("txtHint").innerHTML = "<div align='center'><img src='/intranet/descargas/componentes/img/load.gif'></div><br>";*/
        document.getElementById("txtHint").innerHTML = "<div align='center'><img src='/mysteryshopper/images/loading.gif'></div><br>";
        showUser($id);
    }
};
function showUser($id) {
    if ($id === "") {
        document.getElementById("txtHint").innerHTML = "";
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
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET", "/mysteryshopper/admin/partResumen.php?i=" + $id, true);
        xmlhttp.send();   
    }
};

$(document).on("click", "button.func", function myAjax() {
    var $this = $(this), // Pointing to the clicked element (a button in this case)
    $obtenerValor = $this.attr('name');
    //alert($obtenerValor);
    //var sw_name = document.getElementById("inputCorreos").getAttribute('name');
    //alert(sw_name);
    $.ajax({
       method : "POST",
       url: 'verification.php',
       data:{action:'call_this', cantidad: $obtenerValor},
       success:function(html) {

        document.getElementById('textoVacio').innerHTML = html;
       }

  });
});

function edVisitaMS($id){
  if($id == ""){
    document.getElementById("newfechams").innerHTML = "<br>Hubo un erorr al procesar su solicitud.<br>";
  } else{
    document.getElementById("newfechams").innerHTML = "<br><div class='alert alert-warning alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><div class='form-group'><label class='control-label col-sm-5'>Modificar Fecha: </label><div class='col-sm-5'><input type='text' class='form-control' id='date_new' name='date_new'></div></div><br><input type='button' class='btn btn-active' onclick='saveND("+$id+", 1);' value='Actualizar'><br></div>";
    $(function() {
       $( "#date_new" ).datepicker({
          // The hidden field to receive the date
          altField: "#hiddate",
          // The format you want
          altFormat: "yy-mm-dd",
          // The format the user actually sees
          dateFormat: "dd/mm/yy"});
       $( "#date" ).datepicker();
       $( "#date_new" ).datepicker('setDate', new Date());
     });
  }
}

function editarMS($idvisita, $paso){
  if($paso == 1){
      if($idvisita == ""){
        document.getElementById("newinstrms").innerHTML = "<br>Hubo un erorr al procesar su solicitud.<br>";
      } else{
        document.getElementById("newinstrms").innerHTML = "<br><div class='alert alert-warning alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><div class='form-group'><label class='control-label col-sm-5'>Modificar Instrucciones: </label><div class='col-sm-5'><input type='text' class='form-control' id='instrucciones_new' name='instrucciones_new'></div></div><br><input type='button' class='btn btn-active' onclick='saveND("+$idvisita+", 2);' value='Actualizar'><br></div>";
      }
  } else if($paso == 2){
      if($idvisita == ""){
        document.getElementById("newservms").innerHTML = "<br>Hubo un erorr al procesar su solicitud.<br>";
      } else{
        document.getElementById("newservms").innerHTML = "<br><div class='alert alert-warning alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><div class='form-group'><label class='control-label col-sm-5'>Modificar Servicios: </label><div class='col-sm-5'><input type='text' class='form-control' id='servicios_new' name='servicios_new'></div></div><br><input type='button' class='btn btn-active btn-md' onclick='saveND("+$idvisita+", 3);' value='Actualizar'><br></div>";
      }
  } else if($paso == 3){
      if($idvisita == ""){
        document.getElementById("newsalonms").innerHTML = "<br>Hubo un erorr al procesar su solicitud.<br>";
      } else{
        document.getElementById("newsalonms").innerHTML = "<br><div class='alert alert-warning alert-dismissable'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><div class='form-group'><label class='control-label col-sm-5'>Modificar Salón: </label><span id='res-salon'><img src='/mysteryshopper/images/loading.gif' height='30' width='auto'></span><span id='res-salon2'></span></div><br><div class='row text-center'><input type='button' id='btnMSSal' class='btn btn-active btn-md' onclick='saveND("+$idvisita+", 4);' value='Actualizar' disabled></div></div>";
          $.ajax({
           method : "POST",
           url: '/mysteryshopper/etc/api.php',
           data:{action:'showplaces', paso: $paso},
            success:function(html) {
              //document.getElementById($location).innerHTML = "<br><div class='alert alert-success'>¡Información actualizada <strong>éxitosamente!</strong><br></div>";
              document.getElementById("res-salon").innerHTML = html;
            }
          });
      }
  }

}

function showbuttonMS(){
  document.getElementById("btnMSSal").disabled = false;
}

function saveND($id, $paso){
  if($id==""){
    console.log("No se puede actualizar los datos.");
  } else {
    if($paso == 1){$fechan = document.getElementsByName("hiddate")[0].value; $location = "newfechams"; $newfield = "fecha";}
    else if($paso == 2){$fechan = document.getElementById("instrucciones_new").value; $location = "newinstrms"; $newfield = "vis_obser"}
    else if($paso == 3){$fechan = document.getElementsByName("servicios_new")[0].value; $location = "newservms"; $newfield = "servicios"}
    else if($paso == 4){$fechan = document.getElementsByName("salon_new")[0].value; $location = "newsalonms"; $newfield = "id_salon"}


    $.ajax({
       method : "POST",
       url: '/mysteryshopper/etc/api.php',
       data:{action:'updateVisit', paso: $paso, id: $id, fechan:$fechan},
        success:function(html) {
          if(html == "1"){
          document.getElementById($location).innerHTML = "<br><div class='alert alert-success'>¡Información actualizada <strong>éxitosamente!</strong><br></div>";
          if($paso == 2){document.getElementById($newfield).value = $fechan;} else
          if($paso == 3){document.getElementsByName($newfield)[0].value = $fechan;} else
          if($paso == 4){document.getElementsByName($newfield)[0].value = "Información Actualizada";}
          
          } else {
          document.getElementById($location).innerHTML = "<br><div class='alert alert-success'><strong>:(</strong><br>Hubo un problema al guardar los datos, intenta de nuevo.<br></div>";
        }}
      });
  }
}

function edDescripMS($id){
  if($id==""){
      console.log("No se puede actualizar los datos.");
    } else {
      $descn = document.getElementsByName("hiddescr")[0].value;
      //$fechatemp = document.getElementsByName("date_new")[0].value;
      $.ajax({
         method : "POST",
         url: '/mysteryshopper/etc/api.php',
         data:{action:'updateVisit', paso: "2", id: $id, fechan:$descn},
          success:function(html) {
            if(html == "1"){
            document.getElementById('newfechams').innerHTML = "<br><div class='alert alert-success'>¡Instrucciones actualizadas <strong>éxitosamente!</strong><br></div>";
            document.getElementsByName("vis_obser")[0].value = $descn;
            } else {
            document.getElementById('newfechams').innerHTML = "<br><div class='alert alert-success'><strong>:(</strong><br>Hubo un problema al guardar los datos, intenta de nuevo.<br></div>";
          }}
        });
    }
}

$(document).ready(function(){
    $('body').on('click', '.supp', function(){
      var elem = $(this);
      pri = elem.parents('.principal');
      pri.attr('style', 'display:none;');

    });
});
$(document).ready(function(){
    $('body').on('click','.suppDos', function(){
      var elem = $(this);
      prin = elem.parents('.principal');
      prin.attr('style', 'display:none;');
    });
});