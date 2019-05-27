<?php 
include "../sec/seguro.php";
$_SESSION["ubicacion"] = "noticias";
$arrayMenu = unserialize($_SESSION["accesos"]);
$code64 = base64_encode($iduser);
include "../sec/libfunc.php";
require "conexion.php";

$id_editar = $_GET['id'];
$conex = mysqli_connect($server,$serveruser,$password,$name);
	if (mysqli_connect_errno()) {
		echo "Fallo la conexión";
		exit();
	}
	mysqli_set_charset($conex,"utf8");
	$sql = "SELECT * FROM salvador_noticias WHERE id = '$id_editar'";
	$consulta = mysqli_query($conex,$sql);
	$res = mysqli_fetch_array($consulta,MYSQLI_ASSOC);
	$titulo=$res['titulo'];
	$descrip=$res['descripcion'];
	$url_image=$res['url_img'];
	$fecha = $res['fecha'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Salvador Hairdressing - Editar Noticia</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<?php include "../componentes/header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">

</head>
<body data-spy="scroll" data-target="#navbar-scroll">
	<div id="top"></div>	
    <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); 
        include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php");         
    ?>
    <h2 style="text-align: center!important;">¡Actualiza tu noticia!</h2>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-left">
				<a href='index.php' class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span>Volver</a>
			</div>
		</div>
		<div class="row">		
			<div class="form-group">
				<form class="form-horizontal" id="Formulario_editar" action="" method="POST" enctype="multipart/form-data">
					<br>
					<div class="col-md-4 col-sm-offset-3">
					<label for="titulo">Titulo:</label>
						<input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo;?>">
						<input type="hidden" class="form-control" id="id_editar" value="<?php echo $id_editar;?>" name="id_editar">
						<div class="errorti" style="color:red;font-weight:bold"></div>	
					<label for="Descripción">Descripción:</label>
						<textarea class='form-control' name="descripcion" id="descripcion" rows="5"><?php echo $descrip;?></textarea>					
						<div class="errordes" style="color:red;font-weight:bold"></div>	
					<label for="titulo">Fecha:</label>
						<input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $fecha;?>">
						<div class="errorfe" style="color:red;font-weight:bold"></div>	
						<br>
						<input type="button" id="editar_info" name="edit" value="Editar" class="btn btn-default"><br>
						<span style="color:red;font-weight: bold;" id="mostrar"></span>
	
					</div>
				</form>
			</div>
				<div class="form-group">
				<form class="" id="Formulario_img" action="" method="POST" enctype="multipart/form-data">
					<div class="col-md-4">
						<div class="fileinput fileinput-new" data-provides="fileinput" style="margin-top: 17px;">
							<div  class="fileinput-new thumbnail">
								<img id="img1" class="img-rounded glyphicon glyphicon-picture" src="img/<?php echo $url_image;?>" style="font-size: 47px;padding:44px;text-align: center !important;display: inline-block;">
							</div><br>
							<span class="btn btn-info btn-file"><span class="fileinput-new">Selecciona una imagen</span>
							<span class="fileinput-exists"></span><input type="file" name="archivo" id="file_archivo" required onchange="cargar_imagen();"></span>
							<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Cancelar</a>
						</div>
						<input type="hidden" name="img" id="img">
						<div id="msg_carga"></div>
					</div>
				</form>
			</div>			
		</div>
	</div>
<?php include "../componentes/footer.php"; ?>

<script src="js/cargar_contenido.js"></script>
<script src="/intranet/componentes/js/bootstrap-suggest.js"></script>
</body>
</html>