<?php 
include "../sec/seguro.php";
$_SESSION["ubicacion"] = "noticias";
$arrayMenu = unserialize($_SESSION["accesos"]);
$code64 = base64_encode($iduser);
include "../sec/libfunc.php";
require "conexion.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Salvador Hairdressing - Noticias</title>
	<?php include "../componentes/header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/alertify.min.css">
	<script>
	function eliminar(id){
		page=1;
		var parametros = {"action":"ajax","page":page,"id":id};
		alertify.confirm('Esta acción  eliminará de forma permanente el banner \n\n ¿Desea continuar?',
			function(){
				alertify.success('La noticia ha sido eliminada');
				$.ajax({
				url:'eliminar.php',
				data: parametros,
					success:function(data){
						$(".mostrar_contenido").html(data).fadeIn('slow');
						$("#elimi").remove();		
				  	}				
				})	
			},
			function(){
			    alertify.error('Ha cancelado esta acción');
			})
	}
	</script>
	
	
</head>
<body data-spy="scroll" data-target="#navbar-scroll">
	<div id="top"></div>	
    <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); 
        include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php");         
    ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-right">
				<a href='anadir.php' class="btn btn-default"><span class="glyphicon glyphicon-plus"></span>Agregar Noticia</a>
			</div>
			<br>
			
			<div id="mostrar_contenido"></div>
			<div class="row">
				<?php
				require_once "conexion.php";
				$conex = mysqli_connect($server,$serveruser,$password,$name);
				if (mysqli_connect_errno()) {
					echo "Fallo la conexión";
					exit();
				}
				mysqli_set_charset($conex,"utf8");
				$nums=1;
				$sql=mysqli_query($conex,"SELECT * FROM salvador_noticias ORDER BY id DESC");
				while($res=mysqli_fetch_array($sql)){
					$id = $res['id'];
					$titulo = $res['titulo'];
					$descri = $res['descripcion'];
					$url_img = $res['url_img'];
					?>					
						<div id="elimi" class="col-lg-4 col-md-4 col-xs-6 thumb animate-box spac secnot fadeInUp animated-fast">
						<div class="thumbnail">
						  <img src="img/<?php echo $url_img;?>" alt="..." class="img-responsive" width='300px' align="center">
						</div>
						<div class="caption fh5co-item notic" style="position: relative;bottom: 20px;">
							<h3 id=""><?php echo $titulo;?></h3>
							<p id="descrip" style=""><?php echo $descri;?></p>							
							<p class='text-right'><a href="editar.php?id=<?php echo $id;?>" class="btn btn-info" role="button"><i class='glyphicon glyphicon-edit'></i> Editar</a> <button type="button" class="btn btn-danger" role="button" onclick="eliminar('<?php echo $id;?>');"><i class='glyphicon glyphicon-trash'></i> Eliminar</button></p>
						</div>						
					  </div>
				<?php					
				}
				?>						
			</div>
		</div>
	</div>
<?php include "../componentes/footer.php"; ?>
<script src="js/alertify.min.js"></script>
<script src="/intranet/componentes/js/bootstrap-suggest.js"></script>
</body>
</html>
