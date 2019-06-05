<?php

require 'libcon.php';
class Formularios extends Conexion{

    public function verRegistros(){
      
         $sql=$this->bd->prepare("SELECT * FROM deporte");
         $sql->execute();

         return $sql->fetchALL(PDO::FETCH_OBJ);

    }

    public function registrar($deporte,$equipo,$jugador){

             $sql=$this->bd->prepare("INSERT INTO deporte 

                 (nombre,equipo,jugador) values (:dep, :equi, :jug)");

             $sql->execute(array(":dep"=>$deporte, ":equi"=>$equipo, ":jug"=>$jugador));
             
    }
}

/**
* 
*/

class FormularioAcademy
{
	public function showProf($idioma, $data)
	{
		echo '<div class="row col-sm-12">
        <h2 class="text-center">'. _('Formulario para Equipo de Profesionales').'</h2>
				<h3 class="text-center">'. _('Rellena el siguiente formulario:').'</h3><br>
				<form action="../c/api.php" method="POST">

          <div class="row">
            <div class="col-sm-6">
    					<div class="form-field">
    				    	<label for="nombre">'. _('Nombre').':</label>
    				    	<input type="text" name="nombre" placeholder="'. _('Nombre').'" required="required">
              </div>
  				 	</div>
            <div class="col-sm-6">
  				  	<div class="form-field">
  				    	<label for="apellido">'. _('Apellido').':</label>
  				    	<input type="text" name="apellido" placeholder="'. _('Apellido').'" required="required">
              </div>
				  	</div>

            <div class="col-sm-6">
  				  	<div class="form-field">
  				    	<label for="id">'. _('Documento de Identificación').':</label>
  				    	<input type="text" name="id" placeholder="'. _('Documento de Identificación').'" required="required">
              </div>
  				  </div>
            <div class="col-sm-6">
  				  	<div class="form-field">
  				    	<label for="phone">'. _('Teléfono de Habitación').'</label>
  				    	<input type="text" name="phone" placeholder="'. _('Teléfono de Habitación').'">
  				  	</div>
            </div>

            <div class="col-sm-6">
  				  	<div class="form-field">
  				    	<label for="celphone">'. _('Teléfono Móvil').'</label>
  				    	<input type="text" name="celphone" placeholder="'. _('Teléfono Móvil').'">
              </div>
  				  </div>
            <div class="col-sm-6">
  				  	<div class="form-field">
  				    	<label for="ffnn">'. _('Fecha Nacimiento').'</label>
  				    	<input type="date" name="ffnn" required="required">
  				  	</div>
            </div>

            <div class="col-sm-12">
  				  	<div class="form-field">
  				    	<label for="email">'. _('Correo Electrónico').'</label>
  				    	<input type="email" name="email" placeholder="'. _('Correo Electrónico').'">
  				  	</div>
            </div>

            <div class="col-sm-6">
  				  	<div class="form-field">
  				    	<label for="nacionalidad">'. _('Nacionalidad').'</label>
  				    	<input type="text" name="nacionalidad" placeholder="'. _('Nacionalidad').'">
              </div>              
  				  </div>  
            <div class="col-sm-6">
				  	  <div class="form-field">
  				    	<label for="especialidad">'. _('Especialidad').'</label>
  				    	<input type="text" name="especialidad" placeholder="'. _('Especialidad').'">
              </div>
				  	</div>

            <!--div class="col-sm-12">
              <div class="form-field">
                <label for="fileToUpload">'. _('Adjunte su CV en formato PDF o Word (máx. 5mb)').'</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
              </div>
            </div-->
          </div>

          <input type="hidden" name="action" value="sendAcadProForm">
          <input type="hidden" name="ubicacion" value="'.$data.'">
          <input type="hidden" name="lenguaje" value="'.$idioma.'">

          <br>
					<div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-default">'. _('Enviar').'</button>
          </div>
          <br>
          <br>
          <br>
          <br>

				</form></div>';
        return;
	}

	public function showProf2($idioma, $data)
	{
		echo '<div class="row col-sm-12">
        <h2 class="text-center">'. _('Formulario para Equipo Administrativo').'</h2>
        <h3 class="text-center">'. _('Rellena el siguiente formulario:').'</h3><br>
        <form action="../c/api.php" method="POST">

          <div class="row">
            <div class="col-sm-6">
              <div class="form-field">
                  <label for="nombre">'. _('Nombre').'</label>
                  <input type="text" name="nombre" placeholder="'. _('Nombre').'" required="required">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-field">
                <label for="apellido">'. _('Apellido').'</label>
                <input type="text" name="apellido" placeholder="'. _('Apellido').'" required="required">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-field">
                <label for="id">'. _('Documento de Identificación').'</label>
                <input type="text" name="id" placeholder="'. _('Documento de Identificación').'" required="required">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-field">
                <label for="phone">'. _('Teléfono de Habitación').'</label>
                <input type="text" name="phone" placeholder="'. _('Teléfono de Habitación').'">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-field">
                <label for="celphone">'. _('Teléfono Móvil').'</label>
                <input type="text" name="celphone" placeholder="'. _('Teléfono Móvil').'">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-field">
                <label for="ffnn">'. _('Fecha Nacimiento').'</label>
                <input type="date" name="ffnn" required="required">
              </div>
            </div>

            <div class="col-sm-4">
              <div class="form-field">
                <label for="gen">'. _('Género').'</label>
                <select style="background-color: #f2f2f2; border-bottom: none;" name="gen">
                  <option value="">'. _('Seleccione').'</option>
                  <option value="femenino">'. _('Femenino').'</option>
                  <option value="masculino">'. _('Masculino').'</option>
                </select>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="form-field">
                <label for="email">'. _('Correo Electrónico').'</label>
                <input type="email" name="email" placeholder="'. _('Correo Electrónico').'">
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-field">
                <label for="nacionalidad">'. _('Nacionalidad').'</label>
                <input type="text" name="nacionalidad" placeholder="'. _('Nacionalidad').'">
              </div>              
            </div>              
            <div class="col-sm-6">
              <div class="form-field">
                <label for="interes">'. _('Área de Interés').'</label>
                <input type="text" name="interes" placeholder="'. _('Área de Interés').'">
              </div>
            </div>

            <div class="col-sm-12">
              <div class="form-field">
                <label for="experience">'. _('Experiencia Laboral').'</label>
                <textarea type="text" name="experience" placeholder="'. _("Describa brevemente su experiencia laboral") . '"></textarea>
              </div>
            </div>

            <!--div class="col-sm-12">
              <div class="form-field">
                <label for="fileToUpload">'. _('Adjunte su CV en formato PDF o Word (máx. 5mb)').'</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
              </div>
            </div-->
          </div>

          <input type="hidden" name="action" value="sendAcadProForm">
          <input type="hidden" name="ubicacion" value="'.$data.'">
          <input type="hidden" name="lenguaje" value="'.$idioma.'">

          <br>
          <div class="col-sm-12 text-center">
            <button type="submit" class="btn btn-default">'. _('Enviar').'</button>
          </div>
          <br>
          <br>
          <br>
          <br>

        </form></div>';
        return;
	}
}

function saveAcadProForm($datos, $idioma, $ubicacion) {

    $sql = "INSERT INTO `web_forms` (respuestas, origen, idioma) VALUES ('".$datos."', '".$ubicacion."', '".$idioma."')";
    $funcion = miActionSQL($sql);

    if ($funcion == 1) {
      header("Location: ../academy/index.php?e=0");

      if ($ubicacion == 1) {
        sendEmailAToDep($datos);
      } elseif ($ubicacion == 2) {
        sendEmailBToDep($datos);
      }
      
    } else {
      header("Location: ../academy/index.php?e=1");
    }
    
}

function sendEmailAToDep($datos){

    $datosArray = get_object_vars(json_decode($datos));

    $nombre = $datosArray['nombre'];
    $apellido = $datosArray['apellido'];
    $id = $datosArray['id'];
    $phone = $datosArray['phone'];
    $celphone = $datosArray['celphone'];
    $ffnn = $datosArray['ffnn'];
    $fn = date("d-m-Y", strtotime($ffnn));
    $email = $datosArray['email'];
    $nacionalidad = $datosArray['nacionalidad'];
    $especialidad = $datosArray['especialidad'];

    $to = "programacion@salvadorhairdressing.com"; // this is your Email address

    $subject = "Nueva Solicitud de Asociación de " .$nombre;
    $message = $nombre . " " . $apellido . " está solicitando un puesto para la especialidad de: " . $especialidad;

    $plantilla = file_get_contents("../c/mails/correoempleo.html");

    $plantilla = str_replace("%nombre%",$nombre,$plantilla);
    $plantilla = str_replace("%apellido%",$apellido,$plantilla);
    $plantilla = str_replace("%id%",$id,$plantilla);
    $plantilla = str_replace("%phone%",$phone,$plantilla);
    $plantilla = str_replace("%celphone%",$celphone,$plantilla);
    $plantilla = str_replace("%ffnn%",$fn,$plantilla);
    $plantilla = str_replace("%email%",$email,$plantilla);
    $plantilla = str_replace("%nacionalidad%",$nacionalidad,$plantilla);
    $plantilla = str_replace("%especialidad%",$especialidad,$plantilla);

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    mail($to,$subject,$plantilla,$headers);
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    // You cannot use header and echo together. It's one or the other.

}

function sendEmailBToDep($datos){

    $datosArray = get_object_vars(json_decode($datos));

    $nombre = $datosArray['nombre'];
    $apellido = $datosArray['apellido'];
    $id = $datosArray['id'];
    $phone = $datosArray['phone'];
    $celphone = $datosArray['celphone'];
    $ffnn = $datosArray['ffnn'];
    $fn = date("d-m-Y", strtotime($ffnn));
    $gen = $datosArray['gen'];
    $email = $datosArray['email'];
    $nacionalidad = $datosArray['nacionalidad'];
    $interes = $datosArray['interes'];
    $experience = $datosArray['experience'];

    $to = "programacion@salvadorhairdressing.com"; // this is your Email address

    $subject = "Nueva Solicitud de Empleo de " .$nombre;
    $message = $nombre . " " . $apellido . " está solicitando un puesto para la especialidad de: " . $especialidad;

    $plantilla = file_get_contents("../c/mails/correoempleob.html");

    $plantilla = str_replace("%nombre%",$nombre,$plantilla);
    $plantilla = str_replace("%apellido%",$apellido,$plantilla);
    $plantilla = str_replace("%id%",$id,$plantilla);
    $plantilla = str_replace("%phone%",$phone,$plantilla);
    $plantilla = str_replace("%celphone%",$celphone,$plantilla);
    $plantilla = str_replace("%ffnn%",$fn,$plantilla);
    $plantilla = str_replace("%gen%",$gen,$plantilla);
    $plantilla = str_replace("%email%",$email,$plantilla);
    $plantilla = str_replace("%nacionalidad%",$nacionalidad,$plantilla);
    $plantilla = str_replace("%interes%",$interes,$plantilla);
    $plantilla = str_replace("%experience%",$experience,$plantilla);

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= 'From: Salvador Hairdressing<noreply@salvadorhairdressing.com>' . "\r\n";
    mail($to,$subject,$plantilla,$headers);
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    // You cannot use header and echo together. It's one or the other.

}

function saveContactForm($datos, $donde, $idioma) {

    include 'correos.php';

    $sql = "INSERT INTO `web_forms` (respuestas, origen, idioma) VALUES ('".$datos."', '".$donde."', '".$idioma."')";
    $funcion = miActionSQL($sql);

    if ($funcion == 1) {
      $sendMail = sendEmailContactToDep($datos);
      if ($sendMail == 1) {
        header("Location: ../contacto.php?e=success");
      } else {
        header("Location: ../contacto.php?e=fail");
      }
    } else {
      header("Location: ../contacto.php?e=fail");
    }

}

function changeNumToAns($q1){

    switch ($q1) {
      case '1':
        return 'Si';
        break;

      case '2':
        return 'No';
        break;

      case '3':
        return 'Si';
        break;

      case '4':
        return 'No';
        break;

      case '5':
        return 'Té';
        break;
        
      case '6':
        return 'Café';
        break;

      case '7':
        return 'Agua';
        break;

      case '8':
        return 'Tratamientos';
        break;

      case '9':
        return 'GiftCard';
        break;

      case '10':
        return 'ClientCard';
        break;

      case '11':
        return 'Otro';
        break;

      case '12':
        return 'Ninguno';
        break;

      case '13':
        return '1: Muy malo';
        break;
        
      case '14':
        return '2: Malo';
        break;

      case '15':
        return '3: Regular';
        break;

      case '16':
        return '4: Bueno';
        break;

      case '17':
        return '5: Muy bueno';
        break;
      
      default:
        # code...
        break;
    }

}

function selectCountry(){
    $dbh = conex();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    
    $sql = "SELECT ID, CAMPO, CAMPO2 FROM ms_configuracion WHERE campo5 = 1";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    echo '<select class="left-addon" onchange="listaSalon(this.value);" name="country" id="country"><option value="">' . _("Seleccione una opción") . '</option>';
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            echo "<option value='".base64_encode($rw['CAMPO'])."'>".$rw['CAMPO2']."</option>";
        }
    } else {
        echo "<option value=''>". _('No disponible') ."</option>";
    }  
    echo '</select>';

}

function selectSalon($id){
    $dbh = conex();
    mysqli_set_charset($dbh, 'utf8');
    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }
    $idregion = base64_decode($id);
    $sql = "SELECT ID, CONCEPTO, NOMBRECOMPLETO from web_salones where REGIONSALON = $idregion AND ESTADO != 3";
    $search = mysqli_query($dbh, $sql);
    $match = mysqli_num_rows($search);
    echo '<select class="left-addon" name="salon" id="salon"><option value="">' . _("Seleccione una opción") . '</option>';
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
            echo "<option value='".base64_encode($rw['ID'].";".$rw['NOMBRECOMPLETO'])."'>".nombreConcepto($rw['CONCEPTO']). " - " .$rw['NOMBRECOMPLETO']."</option>";
        }
    } else {
        echo "<option value=''>". _('No disponible') ."</option>";
    }  
}

function nombreConcepto($concepto){
    switch ($concepto) {
      case '1':
        return 'Instituto';
        break;
      
      case '2':
        return 'Express';
        break;

      case '3':
        return 'Kids';
        break;

      case '4':
        return 'UOMO';
        break;

      case '5':
        return 'Nailsbar';
        break;

      case '6':
        return 'Store';
        break;

      case '7':
        return 'Academy';
        break;

      case '8':
        return 'Barber Shop';
        break;

      default:
        # code...
        break;
    }
}

function nombrePaises($country) {
    switch ($country) {
      case '1':
        return 'Venezuela';
        break;
      case '2':
        return 'Panamá';
        break;
      case '3':
        return 'Estados Unidos';
        break;
      case '72':
        return 'República Dominicana';
        break;
      case '249':
        return 'Colombia';
        break;
      case '302':
        return 'Ecuador';
        break;
      case '304':
        return 'Curazao';
        break;
      case '376':
        return 'Mexico';
        break;
      case '378':
        return 'Perú';
        break;

      default:
        # code...
        break;
    }
}

function saveFranqForm($datos, $ubicacion, $idioma) {

    $datosj = json_encode($datos);
    include 'correos.php';

    $sql = "INSERT INTO `web_franquicias_forms` (preguntas, respuestas, origen, idioma) VALUES ('FORM2','".$datosj."', '".$ubicacion."', '".$idioma."')";
    $funcion = miActionSQL($sql);

    if ($funcion == 1) {
      $sendMail = sendEmailFranqToDep($datos);
      if ($sendMail == 1) {
        header("Location: ../franquicias.php?e=success");
      } else {
        header("Location: ../franquicias.php?e=fail");
      }
    } else {
      header("Location: ../franquicias.php?e=fail");
    }

}

function changeNum($valor){
    switch ($valor) {
      case 's1':
        return 'Franquiciado Operador';
        break;
      case 's2':
        return 'Franquiciado Inversionista';
        break;
      case 's3':
        return 'Franquiciado Master';
        break;
      case 's4':
        return 'Franquiciado con Unidad de Negocio';
        break;
      case 's5':
        return 'Franquiciado Flag Ship';
        break;
      case 'opt-1':
        return 'Soy Cliente';
        break;
      case 'opt-2':
        return 'Por un amigo';
        break;
      case 'opt-3':
        return 'Página web';
        break;
      case 'opt-4':
        return 'Buscador';
        break;
      case 'opt-5':
        return 'Otros';
        break;
      case '1':
      case '3':
      case '5':
      case '7':
      case '9':
      case '11':
      case '13':
      case '21':
      case '23':
      case '25':
      case '27':
      case '29':
      case '31':
      case '33':
      case '41':
      case '43':
      case '45':
      case '47':
      case '49':
      case '51':
      case '53':
      case '61':
      case '63':
      case '65':
      case '67':
      case '69':
        return 'Si';
        break;
      case '2':
      case '4':
      case '6':
      case '8':
      case '10':
      case '12':
      case '14':
      case '22':
      case '24':
      case '26':
      case '28':
      case '30':
      case '32':
      case '34':
      case '42':
      case '44':
      case '46':
      case '48':
      case '50':
      case '52':
      case '54':
      case '62':
      case '64':
      case '66':
      case '68':
      case '70':
        return 'No';
        break;
      /*case '3':
        return 'Si';
        break;
      case '4':
        return 'No';
        break;*/
      case 'opt-6':
        return '$ 0 - 100.000,00';
        break;
      case 'opt-7':
        return '$ 100.001,00 - 200.000,00';
        break;
      case 'opt-8':
        return '$ 200.001,00 - más';
        break;
      case 'opt-9':
        return '3 meses';
        break;
      case 'opt-10':
        return '5 meses';
        break;
      case 'opt-11':
        return '1 año';
        break;

      default:
        # code...
        break;
    }
}

?>