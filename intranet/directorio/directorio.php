<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (isset($_POST['action'])) {
        $accion = $_POST['action'];
        switch ($accion) {
        case 'postdir1':
            $datos = $_POST['datos'];
            
            echo listaproveedores($datos);
        break;
        case 'diragregarp':
            $datos = $_POST['datos'];

            echo guardarproveedor($datos);
            break;

        }
    }
}

function listaproveedores($usuario){
  include "../sec/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    list($id,$region) = explode(';', $usuario);

    /* CONSULTAR LISTADOS DE PROVEEDORES */
    $sql = "SELECT * FROM intranet_directorio where region = '".$region."'";

    $result = array();
    $i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
        	$uno = $rw['calificacion'];

            switch ($uno) {
                case '0':
                    $ratingstar = '<i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i>';
                    break;
                case '1':
                    $ratingstar = '<i class="pe-7s-star star1"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i>';
                    break;
                case '2':
                    $ratingstar = '<i class="pe-7s-star star1"></i><i class="pe-7s-star star1"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i>';
                    break;
                case '3':
                    $ratingstar = '<i class="pe-7s-star star2"></i><i class="pe-7s-star star2"></i><i class="pe-7s-star star2"></i><i class="pe-7s-star"></i><i class="pe-7s-star"></i>';
                    break;
                case '4':
                    $ratingstar = '<i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star"></i>';
                    break;
                case '5':
                    $ratingstar = '<i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i><i class="pe-7s-star star4"></i>';
                    break;
                default:
                    # code...
                    break;
            }

        	$tres = $rw['proveedor'];
            $result[$i] = array('<a href="#" data-toggle="modal" data-target="#modificar" data-totales="'.base64_encode(json_encode($rw)).'">'.$tres.'</a>',$rw['servicios'],$rw['telefono'],$rw['correo'],$ratingstar);
            $i++;

        }
    } else {
        /*$result[$i] = "No hay resultados actualmente,0,0,0,0,0";
        $result[$i] = "N/A";
        $result[$i] = "N/A";
        $result[$i] = "N/A";
        $result[$i] = "N/A";
        $result[$i] = "N/A";*/
        
        $result = array
                (
                  array("No hay resultados actualmente",'N/A','N/A','N/A','N/A'),
                );
    }
    $result2 = json_encode($result);
    return $result2;
}

function guardarproveedor($datos){
	require "../sec/libcon.php";
		$dbh = dbconn();
	    mysqli_set_charset($dbh, 'utf8');

	    if (!$dbh) {
	        die('Error en Conexión: ' . mysqli_error($dbh));
	        exit;
	    }

        list($proveedor,$servicios,$telefono,$correo,$calificacion,$comentario,$region) = explode(';', $datos);

		$sql = "INSERT INTO intranet_directorio (proveedor, servicios, telefono, correo, calificacion, comentario, region) VALUES ('$proveedor', '$servicios', '$telefono', '$correo', '$calificacion', '$comentario', '$region')";

	    if (mysqli_query($dbh, $sql)) {
            $resultado = '<div class="alert alert-success"><strong>¡El proveedor fue agregado éxitosamente!</strong></div>';
        }
        else {
            $resultado = '<div class="alert alert-danger"><strong>¡Hubo un error!</strong> Sucedió un error al momento de agregar el proveedor.<br><br><strong>Detalle:</strong></div>';
        }
        mysqli_close($dbh);

        return $resultado;

}


?>