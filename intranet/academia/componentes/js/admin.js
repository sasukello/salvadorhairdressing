$("#modalInfo").on('shown.bs.modal', function (event) {
    $("#parte1").html('<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>');
    var button = $(event.relatedTarget);
    var idct = button.data('id');
    var tipo = button.data('tipo');
    // if (tipo == 'verCT') { // Muestra la tabla cursos - talleres en el administrador
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {id:idct, tipo: tipo}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo == 'modCT') { // Para modificar cursos y talleres en el administrador
    //   var usuario = document.getElementById('userid').value;
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {id:idct, tipo: tipo, user: usuario}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo = 'detCT') {
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {id: idct, tipo: tipo}, success: function(result) {
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo == 'verH') { // Muestra la tabla horarios en el administrador
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {idh:idct, tipo: tipo}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo == 'modH') { // Para modificar los horarios en el administrador
    //   var usuario = document.getElementById('userid').value;
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {idh:idct, tipo: tipo, user: usuario}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo == 'verIns') { // Muestra los inscritos por horario en la tabla horarios
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {ide:idct, tipo: tipo, user: usuario}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //     $(document).ready( function () {
    //       $("#inscritos").DataTable({
    //         dom: 'Bfrtip',
    //         buttons: [
    //           {
    //             extend: 'copy',
    //             title: null,
    //           }, {
    //             extend: 'excel',
    //             title: 'Salvador Academy - '+$titulo+'',
    //             messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
    //           },
    //           {
    //             extend: 'pdf',
    //             title: 'Salvador Academy - '+$titulo+'',
    //             messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
    //             messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
    //           },
    //           {
    //             extend: 'print',
    //             title: '<div><img src="/componentes/images/logos/logo.png"></div>',
    //             messageTop: 'Reporte de '+$titulo+' <br> Fecha: '+ new Date().toLocaleString() +'',
    //             messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
    //           }
    //         ]
    //       });
    //     } );
    //   }});
    // } else if (tipo == 'verEst') { // Muestra la informacion del estudiante en el modal
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {ide:idct, tipo: tipo}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo == 'modEst') { // Muestra el formulario para modificar datos del estudiante
    //   var usuario = document.getElementById('userid').value;
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {ide:idct, tipo: tipo, user: usuario}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //     $('form select.bfh-countries, span.bfh-countries, div.bfh-countries').each(function () {
    //       var $countries;
    //       $countries = $(this);
    //       if ($countries.hasClass('bfh-selectbox')) {
    //         $countries.bfhselectbox($countries.data());
    //       }
    //       $countries.bfhcountries($countries.data());
    //     });
    //   }});
    // } else if (tipo == 'verInfoProf') { // Muestra la informacion del profesor en el modal
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {idp:idct, tipo: tipo}, success: function(result){
    //     console.log(result);
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo == 'modInfoProf') { // Muestra el formulario para modificar datos del profesor
    //   var usuario = document.getElementById('userid').value;
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {idp:idct, tipo: tipo, user: usuario}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo == 'verInfoIns') {
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {idinsc:idct, tipo: tipo}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo == 'verInfoPago') {
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {id:idct, tipo: tipo}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo == 'modInsc') { // Muestra el formulario para modificar datos del profesor
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {idinsc:idct, tipo: tipo}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo == 'regPago') { // Muestra el formulario para modificar datos del profesor
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {idinsc:idct, tipo: tipo}, success: function(result){
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // } else if (tipo == 'addPagoM') { // Muestra el formulario para modificar datos del profesor
    //   var usuario = document.getElementById('userid').value;
    //   $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {idi:idct, tipo: tipo, user: usuario}, success: function(result){
    //     console.log(result);
    //     $variable = JSON.parse(result);
    //     $contenido = $variable[0];
    //     $titulo = $variable[1];
    //     $("#parte1").html($contenido);
    //     $("#myModalLabel").html($titulo);
    //   }});
    // }
  });

  function showContent($valor) { // Muestra el contenido según modulo seleccionado en sección de estudiantes
    if ($valor == 1) {
      document.querySelector(".active-int").classList.remove('active-int');
      document.getElementById('opt-1').classList.add('active-int');
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = '<i class="fa fa-book"></i> Bienvenido a la sección de Cursos - Talleres';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "consultarct"}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
        $(document).ready( function () {
          $("#cursos").DataTable({
            dom: 'Bfrtip',
            buttons: [
              {
                extend: 'copy',
                title: null,
              }, {
                extend: 'excel',
                title: 'Salvador Academy - Listado de Cursos y Talleres',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
              },
              {
                extend: 'pdf',
                title: 'Salvador Academy - Listado de Cursos y Talleres',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              },
              {
                extend: 'print',
                title: '<div><img src="/componentes/images/logos/logo.png"></div>',
                messageTop: 'Reporte: Listado de Cursos - Talleres <br> Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              }
            ],
            "order": [[ 0, "asc" ], [2, "asc"], [1, "asc"]]
          });
        } );
      }});
    } else if ($valor == 11) {
      var usuario = document.getElementById('userid').value;
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = "<i class='fa fa-plus'></i> Agregar: Curso - Taller";
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "formCT", user: usuario}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
      }});
    } else if ($valor == 111) {
      var usuario = document.getElementById('userid').value;
      var idcurso = document.getElementById('idcurso').value;
      document.getElementById('parte1').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "formImagen", user: usuario, idct: idcurso}, success: function(result){
        document.getElementById('parte1').innerHTML = result;
      }});
    } else if ($valor == 112) {
      var usuario = document.getElementById('userid').value;
      var idcurso = document.getElementById('idcurso').value;
      document.getElementById('parte1').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "formGuia", user: usuario, idct: idcurso}, success: function(result){
        document.getElementById('parte1').innerHTML = result;
      }});
    } else if ($valor == 2) {
      document.querySelector(".active-int").classList.remove('active-int');
      document.getElementById('opt-2').classList.add('active-int');
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = '<i class="fa fa-clock-o"></i> Bienvenido a la sección de Horarios';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "consultarhr"}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
        $(document).ready( function () {
          $("#horarios").DataTable({
            dom: 'Bfrtip',
            buttons: [
              {
                extend: 'copy',
                title: null,
              }, {
                extend: 'excel',
                title: 'Salvador Academy - Listado de Horarios',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
              },
              {
                extend: 'pdf',
                title: 'Salvador Academy - Listado de Horarios',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              },
              {
                extend: 'print',
                title: '<div><img src="/componentes/images/logos/logo.png"></div>',
                messageTop: 'Reporte: Listado de Horarios <br> Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              }
            ],
            "order": [[ 0, "asc" ], [1, "asc"]]
          });
        });
      }});
    } else if ($valor == 21) {
      var usuario = document.getElementById('userid').value;
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = "<i class='fa fa-plus'></i> Agregar Horario";
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "formhorario", user: usuario}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
      }});
    } else if ($valor == 22) {
      document.querySelector(".active-int").classList.remove('active-int');
      document.getElementById('opt-2').classList.add('active-int');
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = '<i class="fa fa-clock-o"></i> Bienvenido a la sección de Horarios';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "consultarhrActivos"}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
        $(document).ready( function () {
          $("#horarios").DataTable({
            dom: 'Bfrtip',
            buttons: [
              {
                extend: 'copy',
                title: null,
              }, {
                extend: 'excel',
                title: 'Salvador Academy - Listado de Horarios',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
              },
              {
                extend: 'pdf',
                title: 'Salvador Academy - Listado de Horarios',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              },
              {
                extend: 'print',
                title: '<div><img src="/componentes/images/logos/logo.png"></div>',
                messageTop: 'Reporte: Listado de Horarios <br> Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              }
            ],
            "order": [[ 0, "asc" ], [1, "asc"]]
          });
        });
      }});
    } else if ($valor == 3) {
      document.querySelector(".active-int").classList.remove('active-int');
      document.getElementById('opt-3').classList.add('active-int');
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = '<i class="fa fa-users"></i> Bienvenido a la sección de Estudiantes';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "consultarEst"}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
        $(document).ready( function () {
          $("#estudiantes").DataTable({
            dom: 'Bfrtip',
            buttons: [
              {
                extend: 'copy',
                title: null,
              }, {
                extend: 'excel',
                title: 'Salvador Academy - Listado de Estudiantes',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
              },
              {
                extend: 'pdf',
                title: 'Salvador Academy - Listado de Estudiantes',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              },
              {
                extend: 'print',
                title: '<div><img src="/componentes/images/logos/logo.png"></div>',
                messageTop: 'Reporte: Listado de Estudiantes <br> Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              }
            ],
            "order": [[ 3, "asc" ]]
          });
        } );
      }});
    }  else if ($valor == 31) {
      var usuario = document.getElementById('userid').value;
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = '<i class="fa fa-users"></i> Bienvenido a la sección de Estudiantes';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "formEstudiante"}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
        $('form select.bfh-countries, span.bfh-countries, div.bfh-countries').each(function () {
          var $countries;
          $countries = $(this);
          if ($countries.hasClass('bfh-selectbox')) {
            $countries.bfhselectbox($countries.data());
          }
          $countries.bfhcountries($countries.data());
        });
      }});
    } else if ($valor == 32) {
      document.querySelector(".active-int").classList.remove('active-int');
      document.getElementById('opt-3').classList.add('active-int');
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = '<i class="fa fa-users"></i> Bienvenido a la sección de Estudiantes';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "consultarEstMorosos"}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
        $(document).ready( function () {
          $("#estudiantes").DataTable({
            dom: 'Bfrtip',
            buttons: [
              {
                extend: 'copy',
                title: null,
              }, {
                extend: 'excel',
                title: 'Salvador Academy - Listado de Estudiantes',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
              },
              {
                extend: 'pdf',
                title: 'Salvador Academy - Listado de Estudiantes',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              },
              {
                extend: 'print',
                title: '<div><img src="/componentes/images/logos/logo.png"></div>',
                messageTop: 'Reporte: Listado de Estudiantes <br> Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              }
            ],
            "order": [[ 3, "asc" ]]
          });
        } );
      }});
    } else if ($valor == 4) {
      document.querySelector(".active-int").classList.remove('active-int');
      document.getElementById('opt-4').classList.add('active-int');
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = '<i class="fa fa-user-circle-o"></i> Bienvenido a la sección de Profesores';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "verProf"}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
        $(document).ready( function () {
          $("#profesores").DataTable({
            dom: 'Bfrtip',
            buttons: [
              {
                extend: 'copy',
                title: null,
              }, {
                extend: 'excel',
                title: 'Salvador Academy - Listado de Profesores',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
              },
              {
                extend: 'pdf',
                title: 'Salvador Academy - Listado de Profesores',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              },
              {
                extend: 'print',
                title: '<div><img src="/componentes/images/logos/logo.png"></div>',
                messageTop: 'Reporte: Listado de Profesores <br> Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              }
            ]
          });
        } );
      }});
    } else if ($valor == 41) {
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = '<i class="fa fa-plus"></i> Agregar Profesor';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "addProf"}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
      }});
    } else if ($valor == 5) {
      document.querySelector(".active-int").classList.remove('active-int');
      document.getElementById('opt-5').classList.add('active-int');
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = '<i class="fa fa-edit"></i> Bienvenido a la sección de Inscripciones';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "verInscritos"}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
        $(document).ready( function () {
          $("#inscripciones").DataTable({
            "columns": [
              null,
              null,
              null,
              null,
              { "width": "20%" },
            ],
            dom: 'Bfrtip',
            buttons: [
              {
                extend: 'copy',
                title: null,
              }, {
                extend: 'excel',
                title: 'Salvador Academy - Listado de Inscripciones',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
              },
              {
                extend: 'pdf',
                title: 'Salvador Academy - Listado de Inscripciones',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              },
              {
                extend: 'print',
                title: '<div><img src="/componentes/images/logos/logo.png"></div>',
                messageTop: 'Reporte: Listado de Inscripciones <br> Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              }
            ]
          });
        } );
      }});
    } else if ($valor == 51) {
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = '<i class="fa fa-credit-card"></i> Bienvenido a la sección de Pagos';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "inscManual"}, success: function(result){
        document.getElementById('content-section').innerHTML = result;
      }});
    } else if ($valor == 6) {
      document.querySelector(".active-int").classList.remove('active-int');
      document.getElementById('opt-6').classList.add('active-int');
      document.getElementById('content-section').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
      document.getElementById('title-section').innerHTML = '<i class="fa fa-credit-card"></i> Bienvenido a la sección de Pagos';
      $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "aPagos"}, success: function(result) {
        document.getElementById('content-section').innerHTML = result;
        $(document).ready( function () {
          $("#pagos").DataTable({
            "order": [[ 0, "desc" ]],
            "columns": [
              null,
              { "width": "30px" },
              null,
              null,
              { "width": "20%" },
              null
            ],
            dom: 'Bfrtip',
            buttons: [
              {
                extend: 'copy',
                title: null,
              }, {
                extend: 'excel',
                title: 'Salvador Academy - Listado de Inscripciones',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
              },
              {
                extend: 'pdf',
                title: 'Salvador Academy - Listado de Inscripciones',
                messageTop: 'Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              },
              {
                extend: 'print',
                title: '<div><img src="/componentes/images/logos/logo.png"></div>',
                messageTop: 'Reporte: Listado de Inscripciones <br> Fecha: '+ new Date().toLocaleString() +'',
                messageBottom: 'Este reporte fue generado desde el Administrador de Salvador Academy'
              }
            ]
          });
        } );
      }});
    }
  }

function checkSize(){
  var sizeimg = document.getElementById('image').files[0].size;
  var imgd = document.getElementById('image');
  var imagenn = new Image(imgd);
  var widthimg = imagenn.width;
  var heightimg = imagenn.height;
  console.log(widthimg);
  console.log(heightimg);
  if (sizeimg > 524288) {
    alert('El tamaño de la imagen es mayor al permitido');
    document.getElementById('image').value = "";
  }
}

function selImagen(img){
  var usuario = document.getElementById('user').value;
  var idct = document.getElementById('idct').value;
  document.getElementById('parte1').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
  $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "chgImg", user: usuario, id: idct, image: img}, success: function(result){
    document.getElementById('parte1').innerHTML = result;
  }});
}

function selGuia(arc){
  var usuario = document.getElementById('usuario').value;
  var idct = document.getElementById('idct').value;
  document.getElementById('parte1').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
  $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "chgArch", user: usuario, id: idct, documento: arc}, success: function(result){
    document.getElementById('parte1').innerHTML = result;
  }});
}

function deleteFile(id) {
  document.getElementById('parte1').innerHTML = '<div class="text-center"><img src="/intranet/academia/componentes/ajax-load/ajax-loader.gif"></div>';
  $.ajax({method: 'POST', url: "/intranet/academia/api.php", data: {tipo: "deleteFile", id: id}, success: function(result){
    document.getElementById('parte1').innerHTML = result;
  }});
}

function changeCantNotas() {
  var value = $('#cant_notas').val();
  if ($('#tipo_eval').val() == 1) {
    if (value >= 1) {
      $('#porc_nota1').show();
    } else {
      $('#porc_nota1').hide();
    }
    if (value >= 2) {
      $('#porc_nota2').show();
    } else {
      $('#porc_nota2').hide();
    }
    if (value >= 3) {
      $('#porc_nota3').show();
    } else {
      $('#porc_nota3').hide();
    }
    if (value >= 4) {
      $('#porc_nota4').show();
    } else {
      $('#porc_nota4').hide();
    }
    if (value == 5) {
      $('#porc_nota5').show();
    } else {
      $('#porc_nota5').hide();
    }
  } else {
    $('#porc_nota1').hide();
    $('#porc_nota2').hide();
    $('#porc_nota3').hide();
    $('#porc_nota4').hide();
    $('#porc_nota5').hide();
  }
}

function validateForm() {
  $('#errorPoct').hide();
  if ($('#tipo_eval').val() == 1) {
    var value = $('#cant_notas').val();
    if (value == 1) {
      if (parseInt($('input[name=porc_nota1]').val()) == 100) {
        return true;
      } else {
        $('#errorPoct').show();
        return false;
      }
    }
    if (value == 2) {
      if ((parseInt($('input[name=porc_nota1]').val()) + parseInt($('input[name=porc_nota2]').val())) == 100) {
        return true;
      } else {
        $('#errorPoct').show();
        return false;
      }
    }
    if (value == 3) {
      if ((parseInt($('input[name=porc_nota1]').val()) + parseInt($('input[name=porc_nota2]').val()) + parseInt($('input[name=porc_nota3]').val())) == 100) {
        return true;
      } else {
        $('#errorPoct').show();
        return false;
      }
    }
    if (value == 4) {
      if ((parseInt($('input[name=porc_nota1]').val()) + parseInt($('input[name=porc_nota2]').val()) + parseInt($('input[name=porc_nota3]').val()) + parseInt($('input[name=porc_nota4]').val())) == 100) {
        return true;
      } else {
        $('#errorPoct').show();
        return false;
      }
    }
    if (value == 5) {
      if ((parseInt($('input[name=porc_nota1]').val()) + parseInt($('input[name=porc_nota2]').val()) + parseInt($('input[name=porc_nota3]').val()) + parseInt($('input[name=porc_nota4]').val()) + parseInt($('input[name=porc_nota5]').val())) == 100) {
        return true;
      } else {
        $('#errorPoct').show();
        return false;
      }
    }
  } else {
    return true;
  }
  return false;
}
