<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST["action"])){
		$opc = $_POST["action"];
		switch ($opc) {
			case 'mspend':
				include "modals.php";
				partPend();
				break;
			case 'msact':
				include "modals.php";
				partAct(1, "");
				break;
			case 'mspv':
				include "modals.php";
				progUno();
				break;
			case 'msrv':
				include "modals.php";
				reporteVisitasGeneral();
				break;
			case 'updateVisit':
				include "modals.php";
				$paso = $_POST["paso"];
				$id = $_POST["id"];
				$contenido = $_POST["fechan"];
				$res = actualizarVisita($id, $contenido, $paso);
				echo $res;
				break;
			case 'showplaces':
			include "func.php";
				$paso = $_POST["paso"];
				if($paso == "3"){
					cargaListSalon();
				}
				break;
			default:
				# code...
				break;
		}

	}


}




?>