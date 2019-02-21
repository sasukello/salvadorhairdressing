<?php
if(isset($_POST['action'])){
		$act = $_POST['action'];
		switch ($act) {
			case 'roadinit':
				$datos = $_POST['datos'];
				if(empty($datos)){
					echo "Error en transmisión de datos.";
				} else{
					include 'prfunc.php';
					listaProyectos($datos, 1);
				}
				break;
			case 'roadproyect':
				$datos = $_POST['datos'];
				if(empty($datos)){
					echo "Error en transmisión de datos.";
				} else{
					include 'prfunc.php';
					listaProyectDetalles($datos);
				}
				break;
			case 'roadActividades1':
				$datos = $_POST['datos'];
				if(empty($datos)){
					echo "Error en transmisión de datos.";
				} else{
					include 'prfunc.php';
					//var_dump($datos);
					actividadesMain($datos);
				}
				break;
			default:
				# code...
				break;
		}

	}
?>