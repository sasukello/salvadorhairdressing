<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_FILES['archivo'])) {
	$url=$_FILES["archivo"]["name"];
	$tipo = $_FILES["archivo"]["type"];
	$tamano = $_FILES["archivo"]["size"];
	$contenido_archivo=$_FILES["archivo"]["tmp_name"];
	$destin = "img/";
	$target_file = $destin . basename($_FILES['archivo']["name"]);
	$dimensiones = getimagesize($_FILES["archivo"]["tmp_name"]);
    $ancho = $dimensiones[0];
    $altura = $dimensiones[1];
    $id_editar = $_POST['id_editar'];

    if ($tamano > 500*500) {
		echo "<div class='alert alert-warning' role='alert'>
				El tamaño maximo es 500KB.
			  </div>";
	}
	else if ($tipo != "image/jpeg" && $tipo != "image/jpg" && $tipo != "image/png") {
		echo "<div class='alert alert-warning' role='alert'>
				Solo se permiten extensiones JPEG/JPG/PNG.
			  </div>";	
	}	
	else if (file_exists($target_file)) {
		echo "<div class='alert alert-warning' role='alert'>
				La imagen ya existe, intente cargar otra imagen.
			 </div>";	
	}
	else if ($ancho > 224){
       echo "<div class='alert alert-warning' role='alert'>
				El ancho permitido es 225px.
			</div>";
    }
    else if ($altura > 225){
    	echo "<div class='alert alert-warning' role='alert'>
				La altura permitida es 225px.
			</div>";
    }else{
    	require "conexion.php";
    	$conex = mysqli_connect($server,$serveruser,$password,$name);
		if (mysqli_connect_errno()) {
			echo "Fallo la conexión";
			exit();
		}
		mysqli_set_charset($conex,"utf8");
		$sql = "UPDATE salvador_noticias SET url_img = '$url' WHERE id = '$id_editar'";
		$res = mysqli_query($conex,$sql);
		if ($res===true) {
			$src = $destin.$url;
			move_uploaded_file($contenido_archivo,$src);			
			echo "<div class='alert alert-success' role='alert'>
					La imagen ha sido editada correctamente "."<br>"."Haga clíck en el botón editar para enviar la información. 
				  </div>";
		}
    }
}
 ?>