<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
    	$action = $_POST['action'];
        include '../library/funciones.php';
    	switch ($action) {
			case 'loadone':
				$data = $_POST['data'];
				$paso = $_POST['paso'];

				echo armarUbicacionesDetalle($data, $paso);
				break;

            case 'loadtwo':
                $data = $_POST['data'];
                $paso = $_POST['paso'];

                echo armarUbicacionesMapa($data, $paso);
                break;

            case 'showSD':
                $data = $_POST['data'];
                $paso = $_POST['paso'];

                echo showUbiDet($data, $paso);
                break;

            case 'showRL':
                $data = $_POST['data'];
                $paso = $_POST['paso'];

                echo showRegDet($data, $paso);
                break;

            case 'loadAcadProForm':
                include '../library/formularios.php';
                $data = $_POST['data'];
                $paso = $_POST['paso'];
                $idioma = $_POST['lenguaje'];
                $view = new FormularioAcademy();

                if ($data == 'S01') {
                    $view->showProf($idioma, $data);
                } elseif ($data == 'S02') {
                    $view->showProf2($idioma, $data);
                }
                
                break;

            case 'sendAcadProForm':
                include '../library/formularios.php';
                $idioma = $_POST['lenguaje'];
                $donde = $_POST['ubicacion'];
                $datos = json_encode($_POST);

                if ($donde == 'S01') {
                    $ubicacion = '1';
                } elseif ($donde == 'S02') {
                    $ubicacion = '2';
                }

                saveAcadProForm($datos, $idioma, $ubicacion);
                break;

            case 'contactPrincipal':
                include '../library/formularios.php';
                $datos = json_encode($_POST);
                $donde = $_POST['ubicacion'];
                $idioma = $_POST['lenguaje'];
                $ubicacion = '';

                if ($donde == 'S00') {
                    $ubicacion = '0';
                } else {
                    $ubicacion = '';
                }

                saveContactForm($datos, $ubicacion, $idioma);
                break;

            case 'getSalon':
                include '../library/formularios.php';
                $id = $_POST['datos'];

                selectSalon($id);
                break;

            case 'formFranquicias':
                include '../library/formularios.php';
                $datos = $_POST;
                $donde = $_POST['ubicacion'];
                $idioma = $_POST['lenguaje'];
                $ubicacion = '';

                if ($donde == 'S01') {
                    $ubicacion = '1';
                }

                //var_dump($_POST);
                saveFranqForm($datos, $ubicacion, $idioma);
                break;

            case 'sendRating':
                $idsalon = $_POST['salon'];
                $valor = $_POST['cvalor'];

                echo ratingSalon($idsalon, $valor, 2);

            default:
                # code...
                break;

    		}	
    }
}

?>