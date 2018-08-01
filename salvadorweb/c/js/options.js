function loadDetails1($id, $paso){
	if($id == ""){
		alert("No se pudo cargar el formulario. Intente de nuevo.");
	} else {
	   if($paso == 1){
        document.getElementById("contentslideubi").innerHTML = "<img src='/c/img/loading.gif' width='32px' height='32px'>";
        document.getElementById("mapslideubi").innerHTML = "<img src='/c/img/loading.gif' width='32px' height='32px'>";

		$.ajax({
            method : "POST",
            url: '/c/api.php',
            data:{action:'loadone', data: $id, paso: $paso},
            success:function(html) {
                document.getElementById("contentslideubi").innerHTML = html;
            }
        });

		$.ajax({
            method : "POST",
            url: '/c/api.php',
            data:{action:'loadtwo', data: $id, paso: $paso},
            success:function(html) {
                document.getElementById("mapslideubi").innerHTML = html;
            }
        });

		} else if ($paso === 2) {
            document.getElementById("contentslideform").innerHTML = "<img src='/c/img/loading.gif' width='32px' height='32px'>";
            $language = document.getElementById("langsw").value;
            $.ajax({
                method : "POST",
                url: '/c/api.php',
                data:{action:'loadAcadProForm', data: $id, paso: $paso, lenguaje: $language},
                success:function(html) {
                    document.getElementById("contentslideform").innerHTML = html;
                }
            });

        }
	}
}

function switchlang($lang){
    console.log($lang);
    if($lang== ""){
    } else if($lang == "es_VE"){
        window.location.replace('./?lang='+$lang);
    } else if($lang == "en_US"){
        window.location.replace('./?lang='+$lang);
    } else if($lang == "it_IT"){
        window.location.replace('./?lang='+$lang);
    }
}

function validate_empty($campoid){ // FUNCIONA SOLO CON LOS ID, NO CON LOS NAME
  if(document.getElementById(""+$campoid+"").value.trim() == ''){

    var compare = document.getElementById("language").value;

    if (compare == 'en_US') {
      document.getElementById("error"+$campoid+"").innerHTML ="<i style='color:red;'>Complete this field</i>";
    } else if (compare == 'es_VE') {
      document.getElementById("error"+$campoid+"").innerHTML ="<i style='color:red;'>Completa este campo</i>";
    } else if (compare == 'it_IT') {
      document.getElementById("error"+$campoid+"").innerHTML ="<i style='color:red;'>Completa questo campo</i>";
    } 
    $result = 0;

  } else{
      document.getElementById("error"+$campoid+"").innerHTML ="";
      $result = 1;
  }
  return $result;
}

function listaSalon($id) {
  $('#salones').html('<div style="text-align: center;"><img src="/c/img/loading.gif" width="32px" height="32px"></div>');
  $.ajax({
      method : "POST",
      url: '/c/api.php',
      data:{action:'getSalon', datos: $id},
      success:function(html) {
      document.getElementById("salones").innerHTML = html;
    }
  });
};

function tipof($prueba){ // Para Mostrar Cuestionario según Selección //
  if ($prueba == 's1') {
    document.getElementById("def-1").style.display = "block";
    document.getElementById("def-2").style.display = "none";
    document.getElementById("def-3").style.display = "none";
    document.getElementById("def-4").style.display = "none";
    document.getElementById("def-5").style.display = "none";
    document.getElementById("sform1").style.display = "block";
    document.getElementById("sform2").style.display = "none";
    document.getElementById("sform3").style.display = "none";
    document.getElementById("sform4").style.display = "none";
    document.getElementById("sform5").style.display = "none";
  } else if($prueba == 's2') {
    document.getElementById("def-1").style.display = "none";
    document.getElementById("def-2").style.display = "block";
    document.getElementById("def-3").style.display = "none";
    document.getElementById("def-4").style.display = "none";
    document.getElementById("def-5").style.display = "none";
    document.getElementById("sform1").style.display = "none";
    document.getElementById("sform2").style.display = "block";
    document.getElementById("sform3").style.display = "none";
    document.getElementById("sform4").style.display = "none";
    document.getElementById("sform5").style.display = "none";
  } else if($prueba == 's3') {
    document.getElementById("def-1").style.display = "none";
    document.getElementById("def-2").style.display = "none";
    document.getElementById("def-3").style.display = "block";
    document.getElementById("def-4").style.display = "none";
    document.getElementById("def-5").style.display = "none";
    document.getElementById("sform1").style.display = "none";
    document.getElementById("sform2").style.display = "none";
    document.getElementById("sform3").style.display = "block";
    document.getElementById("sform4").style.display = "none";
    document.getElementById("sform5").style.display = "none";
  } else if($prueba == 's4') {
    document.getElementById("def-1").style.display = "none";
    document.getElementById("def-2").style.display = "none";
    document.getElementById("def-3").style.display = "none";
    document.getElementById("def-4").style.display = "block";
    document.getElementById("def-5").style.display = "none";
    document.getElementById("sform1").style.display = "none";
    document.getElementById("sform2").style.display = "none";
    document.getElementById("sform3").style.display = "none";
    document.getElementById("sform4").style.display = "block";
    document.getElementById("sform5").style.display = "none";
  } else if($prueba == 's5') {
    document.getElementById("def-1").style.display = "none";
    document.getElementById("def-2").style.display = "none";
    document.getElementById("def-3").style.display = "none";
    document.getElementById("def-4").style.display = "none";
    document.getElementById("def-5").style.display = "block";
    document.getElementById("sform1").style.display = "none";
    document.getElementById("sform2").style.display = "none";
    document.getElementById("sform3").style.display = "none";
    document.getElementById("sform4").style.display = "none";
    document.getElementById("sform5").style.display = "block";
  } else {
    document.getElementById("def-1").style.display = "none";
    document.getElementById("def-2").style.display = "none";
    document.getElementById("def-3").style.display = "none";
    document.getElementById("def-4").style.display = "none";
    document.getElementById("def-5").style.display = "none";
    document.getElementById("sform1").style.display = "none";
    document.getElementById("sform2").style.display = "none";
    document.getElementById("sform3").style.display = "none";
    document.getElementById("sform4").style.display = "none";
    document.getElementById("sform5").style.display = "none";
  }
};

function campo($valor){ // Para mostrar Campos Adicionales Segun SI/NO Radio Buttons //
  var tipofranq = document.getElementById('tipo').value;

  if (tipofranq == 's1') {

      if ($valor == 3) {
      document.getElementById("campo4").style.display = "block";
      } else if ($valor == 4) {
        document.getElementById("campo4").style.display = "none";
      } else if ($valor == 5) {
        document.getElementById("campo6").style.display = "block";
      } else if ($valor == 6) {
        document.getElementById("campo6").style.display = "none";
      } else if ($valor == 7) {
        document.getElementById("campo7").style.display = "block";
      } else if ($valor == 8) {
        document.getElementById("campo7").style.display = "none";
      } else if ($valor == 9) {
        document.getElementById("campo8").style.display = "block";
      } else if ($valor == 10) {
        document.getElementById("campo8").style.display = "none";
      } else if ($valor == 13) {
        document.getElementById("campo11").style.display = "block";
      } else if ($valor == 14) {
        document.getElementById("campo11").style.display = "none";
      }

  } else if (tipofranq == 's2') {

      if ($valor == 21) {
      document.getElementById("campo23").style.display = "block";
      } else if ($valor == 22) {
        document.getElementById("campo23").style.display = "none";
      } else if ($valor == 23) {
        document.getElementById("campo25").style.display = "block";
      } else if ($valor == 24) {
        document.getElementById("campo25").style.display = "none";
      } else if ($valor == 25) {
        document.getElementById("campo26").style.display = "block";
      } else if ($valor == 26) {
        document.getElementById("campo26").style.display = "none";
      } else if ($valor == 29) {
        document.getElementById("campo28").style.display = "block";
      } else if ($valor == 30) {
        document.getElementById("campo28").style.display = "none";
      } else if ($valor == 31) {
        document.getElementById("campo30").style.display = "block";
      } else if ($valor == 32) {
        document.getElementById("campo30").style.display = "none";
      } else if ($valor == 33) {
        document.getElementById("campo31").style.display = "block";
      } else if ($valor == 34) {
        document.getElementById("campo31").style.display = "none";
      }

  } else if (tipofranq == 's3') {

      if ($valor == 43) {
      document.getElementById("campo44").style.display = "block";
      } else if ($valor == 44) {
        document.getElementById("campo44").style.display = "none";
      } else if ($valor == 47) {
        document.getElementById("campo46").style.display = "block";
      } else if ($valor == 48) {
        document.getElementById("campo46").style.display = "none";
      } else if ($valor == 49) {
        document.getElementById("campo48").style.display = "block";
      } else if ($valor == 50) {
        document.getElementById("campo48").style.display = "none";
      } else if ($valor == 53) {
        document.getElementById("campo50").style.display = "block";
      } else if ($valor == 54) {
        document.getElementById("campo50").style.display = "none";
      } 

  } else if (tipofranq == 's4') {

      if ($valor == 63) {
        document.getElementById("campo64").style.display = "block";
      } else if ($valor == 64) {
        document.getElementById("campo64").style.display = "none";
      } else if ($valor == 67) {
        document.getElementById("campo67").style.display = "block";
      } else if ($valor == 68) {
        document.getElementById("campo67").style.display = "none";
      } 

  }
  
};

$('#rating-modal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);var salon = button.data('is'); var numstars = button.data('cal');var modal = $(this)
    var starsround = Math.round(numstars);
    if (salon === "") {
        document.getElementById("rating-body").innerHTML = "No se puede cargar la información.";
        return;
    } else {
        document.getElementById("rating-db").innerHTML = '<input type="hidden" id="idsalon" name="idsalon" value="'+salon+'">';
    }
    if (starsround == 0) {
      document.getElementById('estrellas-db').innerHTML = '<i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><small> N/D</small>';
    } else if (starsround == 1) {
      document.getElementById('estrellas-db').innerHTML = '<i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><small> '+numstars+'</small>';
    } else if (starsround == 2) {
      document.getElementById('estrellas-db').innerHTML = '<i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><small> '+numstars+'</small>';
    } else if (starsround == 3) {
      document.getElementById('estrellas-db').innerHTML = '<i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: gray;"></i><i class="fa fa-star" style="color: gray;"></i><small> '+numstars+'</small>';
    } else if (starsround == 4) {
      document.getElementById('estrellas-db').innerHTML = '<i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: gray;"></i><small> '+numstars+'</small>';
    } else if (starsround == 5) {
      document.getElementById('estrellas-db').innerHTML = '<i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><i class="fa fa-star" style="color: red;"></i><small> '+numstars+'</small>';
    }
});

function sendStars(){
  $rating = document.getElementById('calificacion').value;
  $idsalon = document.getElementById('idsalon').value;
  if ($rating == 0 || $rating == "") {
    alert('Selecciona un valor');
  } else {
    //document.getElementById('calificar-btn').disabled = true;
    $.ajax({
      method : "POST",
      url: '/c/api.php',
      data:{action: 'sendRating', salon: $idsalon, cvalor: $rating},
      success:function(html) {
        document.getElementById("result-rating").innerHTML = html;
      }
    });
  }
};

// Valida Radio Buttons //

function validateRadio (radios){
    for (i = 0; i < radios.length; ++ i){
        if (radios [i].checked) return true;
    }
    return false;
}
function validateForm(name){ //name: nombre del radio button (igual para todas las opciones)//
    if(validateRadio (document.forms["franquicias"][""+name+""])) {
        document.getElementById("error"+name+"").innerHTML ="";
        return true;
    }
    else {
        var compare = document.getElementById("language").value;
        if (compare == 'en_US') {
          document.getElementById("error"+name+"").innerHTML ="<i style='color:red;'>Complete this field</i>";
        } else if (compare == 'es_VE') {
          document.getElementById("error"+name+"").innerHTML ="<i style='color:red;'>Completa este campo</i>";
        } else if (compare == 'it_IT') {
          document.getElementById("error"+name+"").innerHTML ="<i style='color:red;'>Completa questo campo</i>";
        } 

        return false;
    }
}

  // ********************* //

function validarDatos(event){ // Para Validar Cuestionario de Franquicias //
    var origen = document.getElementById('tipo').value;
    if (origen == 's1') {
      event.preventDefault();
      var p1 = validate_empty('quest1');
      var p2 = validate_empty('quest2');
      var p3 = validateForm('quest3');
      var p4 = validateForm('quest4');
      var p5 = validate_empty('quest5');
      var p6 = validateForm('quest6');
      var p7 = validateForm('quest7');
      var p8 = validateForm('quest8');
      var p9 = validateForm('quest9');
      var p10 = validate_empty('quest10');
      var p11 = validateForm('quest11');            
      if (p1 == 1 && p2 == 1 && p3 == true && p4 == true && p5 == 1 && p6 == true && p7 == true && p8 == true && p9 == true && p10 == 1 && p11 == true) {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
        document.getElementById("franquicias").submit();
      }
    } else if (origen == 's2') {
      event.preventDefault();
      var p21 = validate_empty('quest21');
      var p22 = validate_empty('quest22');
      var p23 = validateForm('quest23');
      var p24 = validate_empty('quest24');
      var p25 = validateForm('quest25');
      var p26 = validateForm('quest26');
      var p27 = validateForm('quest27');
      var p28 = validateForm('quest28');
      var p29 = validate_empty('quest29');
      var p30 = validateForm('quest30');              
      var p31 = validateForm('quest31');              
      if (p21 == 1 && p22 == 1 && p23 == true && p24 == 1 && p25 == true && p26 == true && p27 == true && p28 == true && p29 == 1 && p30 == true && p31 == true) {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
        document.getElementById("franquicias").submit();
      }
    } else if (origen == 's3') {
      event.preventDefault();
      var p41 = validate_empty('quest41');
      var p42 = validate_empty('quest42');
      var p43 = validateForm('quest43');
      var p44 = validateForm('quest44');
      var p45 = validateForm('quest45');
      var p46 = validateForm('quest46');
      var p47 = validate_empty('quest47');
      var p48 = validateForm('quest48');
      var p49 = validateForm('quest49');
      var p50 = validateForm('quest50');              
      if (p41 == 1 && p42 == 1 && p43 == true && p44 == true && p45 == true && p46 == true && p47 == 1 && p48 == true && p49 == true && p50 == true) {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
        document.getElementById("franquicias").submit();
      }
    } else if (origen == 's4') {
      event.preventDefault();
      var p61 = validate_empty('quest61');
      var p62 = validate_empty('quest62');
      var p63 = validateForm('quest63');
      var p64 = validateForm('quest64');
      var p65 = validate_empty('quest65');
      var p66 = validateForm('quest66');
      var p67 = validateForm('quest67');
      var p68 = validateForm('quest68');
      if (p61 == 1 && p62 == 1 && p63 == true && p64 == true && p65 == 1 && p66 == true && p67 == true && p68 == true) {
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
        document.getElementById("franquicias").submit();
      }
    } else if (origen == 's5') {
        event.preventDefault();     
        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);
        document.getElementById("franquicias").submit();
    }
};