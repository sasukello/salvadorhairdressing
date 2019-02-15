<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    if(isset($_POST["action"])){
	      $action = htmlspecialchars($_POST["action"]);

	      switch ($action) {
	      	case 'load':
	      		$paramRec = htmlspecialchars($_POST["datos"]);
	      		$loadInit = loadFormacion($paramRec);
	      		echo $loadInit;
	      		break;
	      	
	      	default:
	      		# code...
	      		break;
	      }
	      
	  }
}


function loadFormacion($paramRec){
	if($paramRec == "load1"){
		
		  $search = searchFormacionCursos();
		  if($search[0]){
		  	$msg = '
		  	<div class="table-responsive">
			  <table class="table">
			    <thead>
			    	<th>Nombre</th>
			    	<th>Comienza</th>
			    	<th>Termina</th>
			    	<th>Opciones</th>
			    </thead>
			    <tbody>';
		  	foreach ($search as $curso) {
		  		$msg .= '
		  		<tr>
			    	<td>'.$curso["nombrecurso"].'</td>
			    	<td>'.formatMiFecha($curso["fechacomienzo"]).'</td>
			    	<td>'.formatMiFecha($curso["fechafin"]).'</td>
			    	<td>Ver | Cerrar</td>
			    </tr>';
		  	}
		  	$msg .= '	
			    </tbody>
			  </table>
			</div>';

			var_dump($search);
		  } else {
		  	$msg = '<div class="alert alert-warning">
					  Actualmente <strong>no hay cursos</strong> abiertos.</div>
					  <p class="text-center"><button class="btn btn-default">¿Abrir Curso?</button></p>';
		  }

	} else if($paramRec == "load2"){
		$msg = '<div class="alert alert-warning">
		  Actualmente <strong>no hay cursos</strong> abiertos.</div>
		  <p class="text-center">Abre un curso para poder evaluarlo.</p>';


	}

	return $msg;
}

function searchFormacionCursos(){
	include '../cms/library/common.php';

	$sql = "SELECT * FROM intranet_form_curso A INNER JOIN intranet_form_horario B ON A.idcurso = B.idcurso";
	$search = (array) json_decode(mibusquedaSQL($sql), true);
	return $search;

}


?>