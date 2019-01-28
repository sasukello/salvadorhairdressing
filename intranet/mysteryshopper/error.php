<?php 
	if (session_status() === PHP_SESSION_NONE) {
    	session_start();
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Salvador Hairdressing - Mistery Shopper: Área de Administrador</title>
        <?php include "../componentes/header.php"; ?>
        <link href="/mysteryshopper/css/estilo.css" rel="stylesheet" media="screen">

    </head>
    <body>
    <div class="col-lg-12">
		<div class="alert alert-warning">
  		<strong>¡Error!</strong> Hubo un error en la forma de acceder al sitio web. Intente de nuevo.
	</div>
</div>
    </body>
    	<?php include '../componentes/footer.php' ?>
</html>
