<?php

  if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["pay"])){
      if ($_GET["pay"] == 'fail') {
        $msg = $_GET["msg"];
        $mensaje = '<div class="text-center mb-20">
                      <h3 style="color: #e32028; font-weight: bold;"><i class="fa fa-times-circle-o"></i> Transacción Rechazada</h3>
                      <h5>Ha ocurrido un error al procesar el pago, intenta nuevamente.
                      <br><br>Respuesta del banco:<br> <b>'.$msg.'</b></h5><br>
                      <input type="button" class="btn btn-default" name="submit" value="Intentar Nuevamente" onClick="showContent(5)" />
                  </div>';
      } elseif ($_GET["pay"] == 'success') {
        $ref = $_GET["ref"];
        $voucher = consultarRespuestas($ref);
        $mensaje = '<div class="text-center mb-20">
                      <h3 style="color: green; font-weight: bold;"><i class="fa fa-check-circle-o"></i> Transacción Exitosa</h3>
                      <h5>El pago ha sido procesado exitosamente.</h5>
                      <br>
                      <center>
                        '.$voucher.'
                      <center><br>
                      <input type="button" class="btn btn-default" name="submit" value="Continuar" onClick="showContent(5)" />
                  </div>';
      } elseif ($_GET["pay"] == 'error') {
        $mensaje = '<div class="text-center mb-20">
                      <h3 style="color: #e32028; font-weight: bold;"><i class="fa fa-plug"></i> Error de Conexión</h3>
                      <h5>Ha ocurrido un error de conexión. Intenta nuevamente
                      <br><br>
                      <input type="button" class="btn btn-default" name="submit" value="Intentar Nuevamente" onClick="showContent(5)" />
                  </div>';
      }
    } elseif (isset($_GET["resct"])) {
      if ($_GET["resct"] == 'success') {
        $tipo = $_GET["tipo"];
        if ($tipo == 1) {
          $tipo = 'Curso';
        } elseif ($tipo == 2) {
          $tipo = 'Taller';
        }
        $mensaje = '<div class="text-center mb-20">
                      <h3 style="color: green; font-weight: bold;"><i class="fa fa-check-circle-o"></i> '.$tipo.' Agregado Exitosamente</h3>
                      <center><h5 style="width: 80%;">El proceso fue completado exitosamente, para agregar un nuevo curso o taller inicia el proceso nuevamente seleccionando la sección <b>"Cursos"</b>.</h5></center></div>';
      } elseif ($_GET["resct"] == 'fail') {
        $tipo = $_GET["tipo"];
        if ($tipo == 1) {
          $tipo = 'Curso';
        } elseif ($tipo == 2) {
          $tipo = 'Taller';
        }
        $mensaje = '<div class="text-center mb-20">
                      <h3 style="color: #e32028; font-weight: bold;"><i class="fa fa-times"></i> Error de conexión </h3>
                      <center><h5 style="width: 80%;">El proceso no fue completado, intenta nuevamente el proceso seleccionando la sección <b>"Cursos"</b>.</h5></center></div>';
      } elseif ($_GET["resct"] == 'error') {
        $tipo = $_GET["tipo"];
        if ($tipo == 1) {
          $tipo = 'Curso';
        } elseif ($tipo == 2) {
          $tipo = 'Taller';
        }
        $mensaje = '<div class="text-center mb-20">
                      <h3 style="color: #e32028; font-weight: bold;"><i class="fa fa-times"></i> Ha ocurrido un error</h3>
                      <center><h5 style="width: 80%;">Verifica los archivos cargados, intenta cambiando el nombre de los mismos e intenta nuevamente.</h5></center></div>';
      } 
    } elseif (isset($_GET["horario"])) {
        if ($_GET["horario"] == 'success') {
          $mensaje = '<div class="text-center mb-20">
                        <h3 style="color: green; font-weight: bold;"><i class="fa fa-check-circle-o"></i> Horario Agregado Exitosamente</h3>
                        <center><h5 style="width: 80%;">El proceso fue completado exitosamente, para agregar un nuevo curso o taller inicia el proceso nuevamente seleccionando la sección <b>"Cursos"</b>.</h5></center></div>';
        } elseif ($_GET["horario"] == 'fail') {
          $mensaje = '<div class="text-center mb-20">
                        <h3 style="color: #e32028; font-weight: bold;"><i class="fa fa-times"></i> Ha ocurrido un error</h3>
                        <center><h5 style="width: 80%;">El proceso no fue completado, intenta nuevamente el proceso seleccionando la sección <b>"Horarios"</b>.</h5></center></div>';
        }
    } elseif (isset($_GET["change"])) {
        if ($_GET["change"] == 'true') {
          $mensaje = '<div class="alert alert-success text-center"><span style="color: green; font-size: 20px; font-weight: bold;"><i class="fa fa-check-circle-o"></i></span> <strong>El cambio de contraseña ha sido exitoso.</strong></div>';
        } 
    } elseif (isset($_GET["ctupd"])) {
        $tipo = "";
        if (isset($_GET["tipo"])) {
          $tipo = $_GET["tipo"];
        }
        if ($tipo == 1) {
          $tipo = "Curso";
        } elseif ($tipo == 2) {
          $tipo = "Taller";
        } else {
          $tipo = "Curso o Taller";
        }
        if ($_GET["ctupd"] == 'success') {
          $mensaje = '<div class="alert alert-success text-center"><span style="color: green; font-size: 20px; font-weight: bold;"><i class="fa fa-check-circle-o"></i></span> <strong>El '.$tipo.' fue modificado exitosamente.</strong></div>';
        } elseif ($_GET["ctupd"] == 'fail') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr: El '.$tipo.' no fue modificado.</strong></div>';
        } 
    } elseif (isset($_GET["hrupd"])) {
        if ($_GET["hrupd"] == 'success') {
          $mensaje = '<div class="alert alert-success text-center"><span style="color: green; font-size: 20px; font-weight: bold;"><i class="fa fa-check-circle-o"></i></span> <strong>El horario fue modificado exitosamente.</strong></div>';
        } elseif ($_GET["hrupd"] == 'fail') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr: El horario no fue modificado.</strong></div>';
        } 
    } elseif (isset($_GET["updest"])) {
        if ($_GET["updest"] == 'success') {
          $mensaje = '<div class="alert alert-success text-center"><span style="color: green; font-size: 20px; font-weight: bold;"><i class="fa fa-check-circle-o"></i></span> <strong>Los datos del estudiante ha sido modificado exitosamente.</strong></div>';
        } elseif ($_GET["updest"] == 'fail') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr: Los datos no fueron modificado.</strong></div>';
        } 
    } elseif (isset($_GET["addest"])) {
        if ($_GET["addest"] == 'success') {
          $mensaje = '<div class="alert alert-success text-center"><span style="color: green; font-size: 20px; font-weight: bold;"><i class="fa fa-check-circle-o"></i></span> <strong>Se han agregado los datos del estudiante exitosamente, la contraseña de acceso se ha enviado al correo registrado.</strong></div>';
        } elseif ($_GET["addest"] == 'fail') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr: Los datos no fueron agregado, intenta nuevamente.</strong></div>';
        } 
    } elseif (isset($_GET["updprof"])) {
        if ($_GET["updprof"] == 'success') {
          $mensaje = '<div class="alert alert-success text-center"><span style="color: green; font-size: 20px; font-weight: bold;"><i class="fa fa-check-circle-o"></i></span> <strong>Los datos del profesor han sido actualizados exitosamente.</strong></div>';
        } elseif ($_GET["updprof"] == 'fail') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr: Los datos no fueron actualizados, intenta nuevamente.</strong></div>';
        } 
    } elseif (isset($_GET["addprof"])) {
        if ($_GET["addprof"] == 'success') {
          $mensaje = '<div class="alert alert-success text-center"><span style="color: green; font-size: 20px; font-weight: bold;"><i class="fa fa-check-circle-o"></i></span> <strong>Los datos del profesor han sido guardados exitosamente.</strong></div>';
        } elseif ($_GET["addprof"] == 'fail') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr de conexión: Los datos no fueron guardados, intenta nuevamente más tarde.</strong></div>';
        } elseif ($_GET["addprof"] == 'verify') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr: Las contraseñas no coinciden, verifica la información e intenta nuevamente más tarde.</strong></div>';
        } 
    } elseif (isset($_GET["updatos"])) {
        if ($_GET["updatos"] == 'success') {
          $mensaje = '<div class="alert alert-success text-center"><span style="color: green; font-size: 20px; font-weight: bold;"><i class="fa fa-check-circle-o"></i></span> <strong>Los datos han sido modificados  exitosamente.</strong></div>';
        } elseif ($_GET["updatos"] == 'fail') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr de conexión: Los datos no fueron guardados, intenta nuevamente más tarde.</strong></div>';
        }
    } elseif (isset($_GET["i"])) {
        if ($_GET["i"] == 'success') {
          $mensaje = '<div class="alert alert-success text-center"><span style="color: green; font-size: 20px; font-weight: bold;"><i class="fa fa-check-circle-o"></i></span> <strong>La inscripción ha sido modificada  exitosamente.</strong></div>';
        } elseif ($_GET["i"] == 'fail') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr de conexión: Los datos no fueron guardados, intenta nuevamente más tarde.</strong></div>';
        }
    } elseif (isset($_GET["payM"])) {
        if ($_GET["payM"] == 'success') {
          $mensaje = '<div class="alert alert-success text-center"><span style="color: green; font-size: 20px; font-weight: bold;"><i class="fa fa-check-circle-o"></i></span> <strong>El pago fue registrado exitosamente.</strong></div>';
        } elseif ($_GET["payM"] == 'fail') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr de conexión: El pago no fue guardado, intenta nuevamente más tarde.</strong></div>';
        } elseif ($_GET["payM"] == 'denied') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr de pago: El monto a pagar no puede ser mayor a la deuda.</strong></div>';
        }
    } elseif (isset($_GET["insM"])) {
        if ($_GET["insM"] == 'success') {
          $mensaje = '<div class="alert alert-success text-center"><span style="color: green; font-size: 20px; font-weight: bold;"><i class="fa fa-check-circle-o"></i></span> <strong>La inscripción fue registrada exitosamente.</strong></div>';
        } elseif ($_GET["insM"] == 'fail') {
          $mensaje = '<div class="alert alert-danger text-center"><span style="color: #e32028; font-size: 20px; font-weight: bold;"><i class="fa fa-times-circle-o"></i></span> <strong>Erorr de conexión: La inscripción no fue registrada, intenta nuevamente más tarde.</strong></div>';
        }
    } elseif (isset($_GET["errorTDC"])) {
        if ($_GET["errorTDC"] == 01) {
          $mensaje = '<div class="alert alert-danger"><strong>Erorr: Verifica el monto ingresado, debe estar en el formato solicitado.</strong></div>';
        } elseif ($_GET["errorTDC"] == 02) {
          $mensaje = '<div class="alert alert-danger text-center"><strong>Erorr: Verifica que la información de tu nombre este en el formato solicitado.</strong></div>';
        } elseif ($_GET["errorTDC"] == 03) {
          $mensaje = '<div class="alert alert-danger text-center"><strong>Erorr: Verifica tu documento de identidad, el formato no puede ser diferente al solicitado.</strong></div>';
        } elseif ($_GET["errorTDC"] == 04) {
          $mensaje = '<div class="alert alert-danger text-center"><strong>Erorr: El número de tu TDC es inválido, verificalo e intenta nuevamente.</strong></div>';
        } elseif ($_GET["errorTDC"] == 05) {
          $mensaje = '<div class="alert alert-danger text-center"><strong>Erorr: Verifica el código de tu TDC es, solo debes ingresar los tres dígitos que se encuentra en el reverso de la TDC.</strong></div>';
        } elseif ($_GET["errorTDC"] == 06) {
          $mensaje = '<div class="alert alert-danger text-center"><strong>Erorr: La TDC que has ingresado se encuentra vencida o has ingresado los datos incorrectamente.</strong></div>';
        } elseif ($_GET["errorTDC"] == 99) {
          $mensaje = '<div class="alert alert-danger text-center"><strong>Erorr: Verifica los datos de tu TDC, puede que hayas ingresado los datos incorrectamente.</strong></div>';
        }
    }
  }

  function consultarRespuestas($ref){
    include 'conexion.php';
    $dbh = dbconnlocal2();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
      die('Error en Conexión: ' . mysqli_error($dbh));
      exit;
    }

    $sql = "SELECT * FROM pagos WHERE referencia=".$ref."";

    $voucher= "";
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
      $rw = mysqli_fetch_array($search);
      $voucher = $rw['voucher'];
    } else {
      $voucher = "";
    }

    return $voucher;
  }

?>