<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['enviofsfoot'])) {
    	if (isset($_POST['nombre']) && !empty($_POST['nombre']) AND isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['apellido']) && !empty($_POST['apellido']) AND isset($_POST['mensajecontact']) && !empty($_POST['mensajecontact'])) {
    		require "envio.php";
            // Todo esta fino
            $nombre = stripslashes($_POST['nombre']);
            $apellido = stripslashes($_POST['apellido']);
            $email = stripslashes($_POST['email']);
            $mensaje = stripslashes($_POST['mensajecontact']);

            $datos = $nombre.';'.$apellido.';'.$email.';'.$mensaje;
            $result = enviarMensaje($datos, "1");
            if($result == "1"){
            	header("Location: gracias.php");
            } else if($result == "0"){
            	header("Location: error.php?e=1");
            }
        } else {
                header("Location: error.php?e=0"); //falto datos
        }
    }
}

?>

<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FS magazine &mdash; il magazine di bellezza</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="FS magazine. Revista de moda, actualidad, fashion, belleza y últimas noticias. Distribución internacional." />
	<meta name="keywords" content="FS magazine, Revista de moda, actualidad, fashion, belleza, noticias." />
	<meta name="author" content="Corporativo Salvador" />

	<?php include "componentes/header.php";
	cabecera("home");
	?>

	<header id="fh5co-header" class="fh5co-cover js-fullheight" role="banner" style="background-image: url(/componentes/images/bg/bg-main-1.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="display-t js-fullheight">
						<div class="display-tc js-fullheight animate-box" data-animate-effect="fadeIn">
							<h1><em>fs magazine</em></h1>
							<h2>Il magazine di <a href="#top">bellezza</a></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!--<div id="fh5co-about" class="fh5co-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-pull-4 img-wrap animate-box" data-animate-effect="fadeInLeft">
					<img src="images/hero_1.jpeg" alt="Free Restaurant Bootstrap Website Template by FreeHTML5.co">
				</div>
				<div class="col-md-5 col-md-push-1 animate-box">
					<div class="section-heading">
						<h2>The Restaurant</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repudiandae neque quisquam at deserunt ab praesentium architecto tempore saepe animi voluptatem molestias, eveniet aut laudantium alias, laboriosam excepturi, et numquam? Atque tempore iure tenetur perspiciatis, aliquam, asperiores aut odio accusamus, unde libero dignissimos quod aliquid neque et illo vero nesciunt. Sunt!</p>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam iure reprehenderit nihil nobis laboriosam beatae assumenda tempore, magni ducimus abentey.</p>
						<p><a href="#" class="btn btn-primary btn-outline">Our History</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>-->

	<div id="fh5co-featured-menu" class="fh5co-section" style="padding-top: 4em">
		<div class="">
			<div class="row">
				<div class="col-md-2 col-sm-12 col-xs-12 col-xxs-12">
				  	<div class="mt-80-pub">
				  		<img class="img-responsive" src="https://placeholdit.co//i/250x450?&bg=d6d6d6&fc=000000&text=Publicidad - 250x450">
				  	</div>
			    </div>
			    <div class="col-md-8">
			    	<div class="row">
						<div class="col-md-12 fh5co-heading animate-box text-center fuenteOfferings2" style="margin-bottom: 20px;">
							<h2>Últimas Noticias</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap animate-box spac">
								<div class="imgHolder">
									<img src="/componentes/images/dora.jpg" class="img-responsive">
					    			<span class="sombra"><b>Breves VIP</b></span>
								</div>
								<div class="fh5co-item notic">
								    <h3>Dora Explora las Salas de Cine en 2019</h3>
								    <p>El portal The Hollywood Reporter anunció el estreno de la película “Dora, la Exploradora”, bajo la producción de Paramount Pictures y Michael Bay.</p>
								    <ul class="stuff">
										<li>
											<a href="noticias/dora-explora-las-salas-de-cine-en-2019.php"><i class="icon-arrow-right22"></i> Leer más...</a>
										</li>
									</ul>
							     </div>
						    </div>
						    <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap animate-box spac">
								<div class="imgHolder">
									<img src="/componentes/images/pasarela261.jpg" class="img-responsive">
				    				<span class="sombra"><b>Moda</b></span>
								</div>
							    <div class="fh5co-item notic">
							      	<h3>Pasarela 261 en el CAMLB</h3>
							      	<p>Bajo la producción general de Yamlusi Agostini y Rubendario Marquez, acuerdan este evento que va hacia su cuarta edición de la mano de 12 diseñadores.</p>
							      	<ul class="stuff">
										<li>
											<a href="noticias/pasarela-261-en-el-centro-de-arte-de-maracaibo-lia-bermudez.php"><i class="icon-arrow-right22"></i> Leer más...</a>
										</li>
									</ul>
							    </div>
						    </div>
						    <div class="col-md-4 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap animate-box spac">
								<div class="imgHolder">
									<img src="/componentes/images/cicara.jpg" class="img-responsive">
				    				<span class="sombra"><b>Gastronomía</b></span>
								</div>
							    <div class="fh5co-item notic">
							    	<h3>Cicara Caffe, un pedacito de Italia cómoda y estilo</h3>
							      	<p>Para nadie es un secreto que visitar cafés está de moda, para muchos recorrer estos lugares es parte de sus pasatiempos favoritos.</p>
							      	<ul class="stuff">
										<li>
											<a href="noticias/cicara-caffe-un-pedacito-de-italia-comoda-y-estilo.php"><i class="icon-arrow-right22"></i> Leer más...</a>
										</li>
									</ul>
							    </div>
						    </div>
						</div>
					</div>
				    <div class="row">
				    	<div class="boton">
							<p><a href="noticias.php" class="btn btn-primary btn-outline fuenteOfferings">Más Noticias</a></p>
						</div>
				    </div>
				</div>
			
				<div class="col-md-2 col-sm-12 col-xs-12 col-xxs-12">
				  	<div class="mt-80-pub">
				  		<img class="img-responsive" src="https://placeholdit.co//i/250x450?&bg=d6d6d6&fc=000000&text=Publicidad - 250x450">
				  	</div>
			    </div>
		    </div> 	
		</div>
	</div>
	
	<div id="fh5co-started" class="fh5co-section animate-box" style="background-image: url(/componentes/images/portada2.jpg); margin-top: 100px;" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading ">
					<h2>En Portada</h2>
					<p> &ldquo; Jamás pensó llevar la responsabilidad de una corona a cuestas, ya que su actitud de chica tímida y su pasión por el deporte la orientaron desde muy pequeña a tomar otros caminos, como el deportivo.&rdquo;</p>
						<p class="author"><cite>&mdash; Ángela Galante</cite></p>
					<p><a href="ediciones.php" class="btn btn-primary btn-outline fuenteOfferings">Ver Edición</a></p>
				</div>
			</div>
		</div>
	</div>

	<?php include "componentes/footer.php";?>

	</body>
</html>

