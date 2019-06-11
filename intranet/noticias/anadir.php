<?php 
include "../sec/seguro.php";
$_SESSION["ubicacion"] = "noticias";
$arrayMenu = unserialize($_SESSION["accesos"]);
$code64 = base64_encode($iduser);
include "../sec/libfunc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Salvador Hairdressing - Subir Noticias</title>
	<?php include "../componentes/header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">

</head>
<body data-spy="scroll" data-target="#navbar-scroll">
	<div id="top"></div>	
    <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); 
        include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php");         
    ?>
    <h2 style="text-align: center!important;"><b>Carga las noticias mas destacadas</b></h2>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-left">
				<a href='index.php' class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span> Regresar</a>
			</div>
		</div>
		<div class="row">		
			<form class="form-horizontal" id="Formulario" action="" method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<br>
					<div class="col-md-4 col-sm-offset-3">
					<label for="titulo">Titulo:</label>
						<input type="text" class="form-control" id="titulo" name="titulo">
						<div class="errorti" style="color:red;font-weight:bold"></div>	
					<label for="Descripción">Descripción:</label>
						<textarea class='form-control' name="descripcion" id="descripcion" rows="8"></textarea>					
						<div class="errordes" style="color:red;font-weight:bold"></div>	
					<label for="titulo">Fecha:</label>
						<input type="date" class="form-control" id="fecha" name="fecha">
						<div class="errorfe" style="color:red;font-weight:bold"></div><br>	
					<label for="Idioma">Idioma:</label>
					<select name="idioma" required id="idioma">
							<option value="">Seleccione una opción</option>
							<option value="es_VE">Español</option>
							<option value="en_US">Inglés</option>
							<option value="it_IT">Italiano</option>							
					</select>	
					<div class="erroridio" style="color:red;font-weight:bold"></div><br>	
					</div>
					<div class="col-md-4"><br>
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-new thumbnail">
								<img id="img1" class="img-rounded glyphicon glyphicon-picture" src="" style="font-size: 117px;padding:44px;text-align: center !important;display: inline-block;">
							</div>
							<br>
							<span class="btn btn-info btn-file" style="display: list-item;"><span class="fileinput-new">Selecciona una imagen</span>
							<span class="fileinput-exists"></span><input type="file" name="archivo" id="file_archivo"></span>
							<a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Cancelar</a>
							<div class="errorar" style="color:red;font-weight:bold"></div>		
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-offset-3">		
					<input type="button" id="envio_info" name="" value="Enviar" class="btn btn-default"><br>
					<span style="color:red;font-weight: bold;" id="mostrar"></span>
				</div>
			</form>
		</div>
	</div>
<?php include "../componentes/footer.php"; ?>
<script src="js/cargar_contenido.js"></script>
<script src="/intranet/componentes/js/bootstrap-suggest.js"></script>
</body>
</html>