<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FS magazine &mdash; Nosotros</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="FS magazine. Revista de moda, actualidad, fashion, belleza y últimas noticias. Distribución internacional." />
	<meta name="keywords" content="FS magazine, Revista de moda, actualidad, fashion, belleza, noticias." />
	<meta name="author" content="Corporativo Salvador" />


	<?php include "componentes/header.php";
	cabecera("contacto");
	?>

	<header id="fh5co-header" class="fh5co-cover js-fullheight" role="banner" style="background-image: url(/componentes/images/hero_1.jpeg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<div class="display-t js-fullheight">
						<div class="display-tc js-fullheight animate-box" data-animate-effect="fadeIn">
							<h1><em>fs magazine</em></h1>
							<h2>Il magazine di <a href="#top">bellezza</a></h2>
							<a href="#formulario" class="btn btn-elegant">Contáctanos</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>


	<div id="fh5co-featured-testimony" class="fh5co-section">
		<div id="alineacion" class="container">
			<div class="row">
				<div class="col-md-12 fh5co-heading">
					<div class="col-md-10 col-md-offset-1">
					<h2><b>Publica con nosotros</b></h2>
					</div>
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<p>Somos un espacio de lectura para los apasionados de la belleza, con todas las novedades en diversos temas y los análisis de expertos en looks y tendencias, traemos a nuestros lectores los mejores complementos para estar siempre en lo mas In, presentando lo más actual del mundo de la moda y las pasarelas. 
							<br><br>FS magazine es una revista de alcance internacional con edición en Venezuela, que puedes encontrar en restaurantes exclusivos, salas de espera y consultorios médicos, además puedes adquirirla en las pasteleraias y cafeterías más reconocidas y en los principales puntos de venta alrededor del mundo.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="row margentop">
			    <div class="col-md-3 col-sm-6">
			        <div class="progress blue">
			            <span class="progress-left">
			                <span class="progress-bar"></span>
			            </span>
			            <span class="progress-right">
			                <span class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">60%</span>
			            </span>
			        </div>
			        <label>Venezuela</label>
			    </div>
			    <div class="col-md-3 col-sm-6">
			        <div class="progress yellow">
			            <span class="progress-right2">
			                <span class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">20%</span>
			            </span>
			        </div>
			        <label>Panamá</label>
			    </div>
			    <div class="col-md-3 col-sm-6">
			        <div class="progress yellow">
			            <span class="progress-right3">
			                <span class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%">10%</span>
			            </span>
			        </div>
			        <label>República Dominicana</label>
			    </div>
			    <div class="col-md-3 col-sm-6">
			        <div class="progress yellow">
			            <span class="progress-right3">
			                <span class="progress-bar" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width:10%">10%</span>
			            </span>
			        </div>
			        <label>Miami (USA)</label>
			    </div>
			</div>
		</div>
	</div>

	<div id="formulario" class="fh5co-section">
		<div id="alineacion space" class="container">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <h2 style="font-style: italic; color: #fff;">¡Déjanos tus datos para publicar con nosotros!</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">

                        <div class="row">
                            <form action="envio.php" method="post" name="contactform" class="contact-form">
                                <div class="col-md-6">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nombre">
                                    <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Teléfono">
                                </div>
                                <div class="col-md-6">
                                	<input type="text" name="empresa" id="empresa" class="form-control" placeholder="Empresa">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Correo Electrónico">
                                </div>
                                <div class="col-md-6">
                                	<input type="text" name="pais" id="pais" class="form-control" placeholder="País">
                                </div>
                                <div class="col-md-6">
                                	<input type="text" name="especificacion" id="especificacion" class="form-control" placeholder="Especificación de Página">
                                </div>
                                <div class="col-xs-12">
                                    <textarea class="form-control" name="message" id="message" rows="4" placeholder="Escribe tu mensaje"></textarea>
                                    <button type="submit" name="contact1fs" class="btn btn-elegant">Enviar Mensaje</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="meta">
                            <h4>Distribuido por:</h4>
                            <p>Corporativo Salvador C.A.<br>
                            Maracaibo, Venezuela<br></p>

                            <h4>Teléfonos</h4>
                            <p>Local: +58 261 000 00 00<br>
                            Móvil: +58 424 658 10 04</p>

                            <h4>Correo Electrónico</h4>
                            <p>marketing@fsinter.com<br>
                            ventas@fsinter.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

	<?php include "componentes/footer.php";?>

	</body>
</html>