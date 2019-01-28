<?php
error_reporting(1);
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    if (isset($_POST['action'])) {
	    	$action = $_POST['action'];
	    	switch ($action) {
	      		case 'faq':
	      			require 'cms/library/faq.php';
	      			$step = $_POST['datos'];

	      			switch ($step) {
	      				case 'faq1':
	      					echo initFAQ();
	      					break;
	      				case 'faq2':
	      					echo bodyFAQ($step, "");
	      					break;
	      				case 'faq2a':
	      					$categoria = $_POST["categoria"];
	      					$op = bodyFAQ($step, $categoria);
	      					if($op == "1"){
	      						header("location: cms/web/index.php?m=success");
	      					} else if($op == "0"){
	      						header("location: cms/web/index.php?m=error");
	      					} else{
	      						echo "Error al procesar.";
	      					}
	      					break;
	      				case 'faq3':
	      					echo bodyFAQ($step, "");
	      					break;
	      				case 'faq3a':
	      					$pregunta = $_POST["pregunta"];
	      					$respuesta = $_POST["respuesta"];
	      					$categoria = $_POST["categoria"];
	      					$datos = array($pregunta, $respuesta, $categoria);
	      					$op = bodyFAQ($step, $datos);
	      					if($op == "1"){
	      						header("location: cms/web/index.php?m=success");
	      					} else if($op == "0"){
	      						header("location: cms/web/index.php?m=error");
	      					} else{
	      						echo "Error al procesar.";
	      					}
	      					break;
	      				default:
	      					echo "Instrucción en FAQ no reconocida.";
	      					break;
	      			}
	      			break;
	      		case 'loadEnc1':
	      			require 'cms/library/common.php';
	      			require 'sec/forms.php';

	      			$ui = $_POST["datos"];
	      			echo checkEnc($ui);
	      			break;

	      		case 'loadEncDesc':
		      		require 'cms/library/common.php';
	      			require 'sec/forms.php';

	      			$datos = $_POST["datos"];
	      			$user = base64_decode($datos["user"]);
	      			$form = $datos["form"];

	      			checkEncDesc($form);
	      			//echo $user . " y " . $form;
	      			break;
	      		case 'asignEnc':
	      			require 'cms/library/common.php';
	      			require 'sec/forms.php';

	      			$datos = base64_decode($_POST["datos"]);
	      			$datosj = json_decode($datos, true);

	      			$user = base64_decode($datosj["user"]);
	      			$form = $datosj["form"];
	      			
	      			echo asignarUsers1($user, $form);
	      			break;
	      		case 'saveUserEnc':
	      			require 'cms/library/common.php';
	      			require 'sec/forms.php';
	      			$newuser = $_POST["who"];
	      			$datos = base64_decode($_POST["datos"]);
	      			$datos2 = (array) json_decode($datos, true);
	      			//var_dump($datos2);
	      			//var_dump($newuser);

	      			asignarUsers2($datos2, $newuser);
	      			break;
	      		case 'getEncResp':
	      			require 'cms/library/common.php';
	      			require 'sec/forms.php';
	      			$fid = $_POST["datos"];
	      			getEncResp($fid, 2);
	      			break;
	      		case 'getEncResp2':
	      			require 'cms/library/common.php';
	      			require 'sec/forms.php';
	      			$fid = $_POST["datos"];
	      			getEncResp($fid, 1);
	      			break;
	      		case 'pagop':
	      			require 'cms/library/common.php';
	      			require 'sec/corporativo.php';
	      			
	      			//$datos = base64_decode($_POST["datos"]);
	      			

	      			//$arreglo=array
     				//(
      				//array("Salvador Galerias",'1.300.000Bs','Banco Venezuela 01024562021052489602','ESTATUS PENDIENTE'),
      				//array('Salvador Corporativo','3.400.000Bs', 'Banco Provincial 01084562021052489602', 'ESTATUS PENDIENTE')
      				//);
					//$result= json_encode($arreglo);
					//echo $result;

					$pagovar=consultapagos("S11");
					echo ($pagovar);
	      			break;

	      		case 'actionconsulta':
			    	require 'cms/library/common.php';
			      	require 'sec/corporativo.php';

	      			echo "<table class='table'>
	      			<thead class='thead-dark'>
					  <tr>
					</thead>
					    <td>Banco</td>

					    <td>N° de cuenta</td>

					    <td>Tipo</td>

					  </tr>
					  <tr>

					    <td>Provincial</td>

					    <td>01080415451232154587</td>

					    <td>Corriente</td>

					  </tr>

					</table>";
	      			break;


	      		default:
	      			echo "Instrucción API no reconocida.";
	      			break;
	    	}
	    }
	} else{
		echo "Petición no aceptada.";
	}
?>