<?php 
require "conexion.php";
$conex = mysqli_connect($server,$serveruser,$password,$name);
	if (mysqli_connect_errno()) {
		echo "Fallo la conexión";
		exit();
	}
	mysqli_set_charset($conex,"utf8");
		if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["edit"])) {
		$titulo = mysqli_real_escape_string($conex,strip_tags($_POST['titulo']));
		$descrip = mysqli_real_escape_string($conex,strip_tags($_POST['descripcion']));
		$id_editar = $_POST['id_editar'];
		$fechaactual = date("Y-m-d");
		
		if ($titulo === "" && $descrip === "" $fechaactual === "") {
			echo "<div class='alert alert-warning' role='alert'>
					Campos requeridos.
				 </div>";
		}
		else{ 
		$sql = "UPDATE salvador_noticias
				SET titulo='$titulo', descripcion = '$descrip', fecha = '$fechaactual'
				WHERE id = '$id_editar'";
		$consulta = mysqli_query($conex,$sql);
		if ($consulta === true) {
			echo "<div class='alert alert-success' role='alert'>
					La información ha sido editada exitosamente.
				  </div>";
		}
		else{
			echo "<div class='alert alert-warning' role='alert'>
					Ha ocurrido un error por favor vuelva a intentarlo.	
				 </div>";		
		}	
	}
}

?>