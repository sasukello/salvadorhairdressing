<?php 
include "../sec/seguro.php";
$_SESSION["ubicacion"] = "noticias";
$arrayMenu = unserialize($_SESSION["accesos"]);
$code64 = base64_encode($iduser);
include "../sec/libfunc.php";
require "PDO_Pagination.php";
require_once "conexion.php";
$connection = new PDO("mysql:host=$server;dbname=$name;", $serveruser, $password);
$connection->exec("SET CHARACTER SET utf8");
$pagination = new PDO_Pagination($connection);
$pagination->rowCount("SELECT * FROM salvador_noticias");
$pagination->config(3, 8);
$sql = "SELECT * FROM salvador_noticias ORDER BY id DESC LIMIT $pagination->start_row, $pagination->max_rows";
$query = $connection->prepare($sql);
$query->execute();
$model = array();
while($rows = $query->fetch())
{
    $model[] = $rows;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Salvador Hairdressing - Noticias</title>
	<?php include "../componentes/header.php"; ?>
	<link rel="stylesheet" type="text/css" href="css/alertify.min.css">
	<style type="text/css">
		<style>
            .btn{
				text-decoration: none;
				background: #ad3b3b !important;
    			color: #fff !important;
    			font-size: 20px;
          	}
            .active{background: #ad3b3b;color:#fff; font-size: 15px;}
        </style>
	</style>
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
				beforeSend: function(objeto){
					$("#loader").html("<img src='img/loading.gif'>");
		  		},
					success:function(data){
						$("#mostrar_contenido").html(data).fadeIn('slow');
						$("#elimi").remove();	
						$("#loader").html("");

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
		<div class="text-right">
			<a href='anadir.php' class="btn btn-default"><span class="glyphicon glyphicon-plus"></span>Agregar una noticia</a>
		</div>
		<br>

		<div class="row">
			<?php
				foreach ($model as $key) {						
				$id = $key['id'];
				$titulo = $key['titulo'];
				$descri = $key['descripcion'];
				$url_img = $key['url_img'];
				$caracteres = 100;
				?>
				<div id="elimi" class="col-sm-6 col-md-3 clearfix">					
					<div class="thumbnail">
						<img src="img/<?php echo $url_img;?>" alt="...">
					<div class="caption">	
						<h3 id=""><?php echo $titulo;?></h3>
						<p><?php echo $descri;?></p>
						<p class='text-right'><a href="editar.php?id=<?php echo $id;?>" class="btn btn-info" role="button"><i class='glyphicon glyphicon-edit'></i> Editar</a> <button type="button" class="btn btn-danger" role="button" onclick="eliminar('<?php echo $id;?>');"><i class='glyphicon glyphicon-trash'></i> Eliminar</button></p>
					</div>
				</div>
			  </div>					
			<?php					
			}
			?>						
		</div>
		<div id="loader" class="text-center"></div>
		<div id="mostrar_contenido" style="color:red;"></div>
		<div class="paginado">
		<?php
			$pagination->pages("btn");
		?>
		</div>
	</div>
<?php include "../componentes/footer.php"; ?>
<script src="js/alertify.min.js"></script>
<script src="/intranet/componentes/js/bootstrap-suggest.js"></script>
</body>
</html>
