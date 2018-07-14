<?php
error_reporting(1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];
		switch ($action) {
			case 'n1':
				$idnews = $_POST["datos"];
				echo loadNews($idnews);
				break;
			case 'n0':
				$permisos = $_POST["datos"];
				echo checkPermisos($permisos);
			default:
				# code...
				break;
		}

	}
}

function loadNews($id){
	require_once "../sec/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    $sql = "SELECT * FROM intranet_ayuda WHERE idsubcategoria = $id;";
	$result = array();$i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    if ($match > 0) {
        while ($rw = mysqli_fetch_array($search)) {
        	$result[$i] =   '<div class="panel-heading" style="background-color: #000 !important;"><h3>'.$rw["titulo"].'</h3></div><div class="panel-body">'.$rw["contenido"].'</div>';
        }
    } else {
        $result = "No se encontraron resultados.";
    }
    mysqli_close($dbh);
    return $result[$i];
}

function checkPermisos($permisos){
	return loadHeadlines($permisos);;
}

function loadHeadlines($permisos){
	require_once "../sec/libcon.php";
    $dbh = dbconn();
    mysqli_set_charset($dbh, 'utf8');

    if (!$dbh) {
        die('Error en Conexión: ' . mysqli_error($dbh));
        exit;
    }

    $sql = "SELECT * FROM intranet_ayuda WHERE idcategoria = 1;";
	$i = 0;
    $search = mysqli_query($dbh, $sql) or die(mysqli_error($dbh));
    $match = mysqli_num_rows($search);
    $result = "Nada";
    if ($match > 0) {
    	$result = '<div class="container-fluid"><div class="row no-gutter">';
        while ($rw = mysqli_fetch_array($search)) {
        	$result .=   '<div class="col-lg-6 col-sm-6">
                                    <a href="#galleryModal" class="gallery-box" onclick="mostrarNoticia('.$rw["id"].')">
                                        <img src="../componentes/images/'.$rw["imagen_url"].'" class="img-responsive" alt="'.$rw["titulo"].'">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption">
                                        <h4>'.$rw["titulo"].'</h4>
                                    </div>
                                </div>';
        }
        $result .= '</div></div>';
    } else {
        $result = "No se encontraron resultados.";
    }
    mysqli_close($dbh);
    return $result;
}






?>