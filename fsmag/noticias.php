<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>FS magazine &mdash; Noticias</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="FS magazine. Revista de moda, actualidad, fashion, belleza y últimas noticias. Distribución internacional." />
	<meta name="keywords" content="FS magazine, Revista de moda, actualidad, fashion, belleza, noticias." />
	<meta name="author" content="Corporativo Salvador" />

	
	<?php include "componentes/header.php";
	cabecera("noticias");
	?>

	<link rel="stylesheet" href="/componentes/css/slideshow.css">

	<div>
	<!--slideshow-->
	<div class="w3-content w3-display-container" style="margin-top: 10em">
		<div class="w3-display-container mySlides">
		  <img src="/componentes/images/explorer.jpg" style="width:100%;">
		  <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black">
		    Dora la Exploradora se presenta en las salas de cine en 2019
		  </div>
		</div>

		<div class="w3-display-container mySlides">
		  <img src="/componentes/images/cafe.jpg" style="width:100%;">
		  <div class="w3-display-bottomright w3-large w3-container w3-padding-16 w3-black">
		    Cicara Caffe, un pedacito de Italia cómoda y estilo
		  </div>
		</div>

		<div class="w3-display-container mySlides">
		  <img src="/componentes/images/lavadora.jpg" style="width:100%;">
		  <div class="w3-display-bottomleft w3-large w3-container w3-padding-16 w3-black">
		    Samsung nos vuelve a sorprende con la Lavadora AddWash Serie 6 
		  </div>
		</div>

		<div class="w3-display-container mySlides">
		  <img src="/componentes/images/ivanka.jpg" style="width:100%;">
		  <div class="w3-display-bottomright w3-large w3-container w3-padding-16 w3-black">
		    La moda Low Cost de Ivanka Trump se impone en su guardarropa
		  </div>
		</div>

		<button class="w3-button w3-display-left w3-black" onclick="plusDivs(-1)">&#10094;</button>
		<button class="w3-button w3-display-right w3-black" onclick="plusDivs(1)">&#10095;</button>
	</div>

	<!--UnderSlideshow-->
	<div class="w3-content w3-display-container">
	<div class="mslid">
		<div class="w3-col s4">
		<img class="demo w3-opacity w3-hover-opacity-off" src="/componentes/images/explorer2.jpg" style="width:100%" onclick="currentDiv(1)">
		</div>
		<div class="w3-col s4">
		<img class="demo w3-opacity w3-hover-opacity-off" src="/componentes/images/cafe2.jpg" style="width:100%" onclick="currentDiv(2)">
		</div>
		<div class="w3-col s4">
		<img class="demo w3-opacity w3-hover-opacity-off" src="/componentes/images/lavadora2.jpg" style="width:100%" onclick="currentDiv(3)">
		</div>
		<div class="w3-col s4" style="padding-right: 0px;">
		<img class="demo w3-opacity w3-hover-opacity-off" src="/componentes/images/ivanka2.jpg" style="width:100%;" onclick="currentDiv(4)">
		</div>
	</div>
	</div>

	</div>

	<!--Noticias-->
	<div class="col-md-8 col-md-offset-2 text-center" style="padding-top:6em;">
		<h2 class="fuente">Más Noticias</h2>
	</div>
	<div id="fh5co-featured-menu">
		<div class="container">
			<div class="rowa" style="margin-top: 13em;">
				<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 animate-box spac secnot">
				<div class="imgHolder">
				<img src="/componentes/images/dora.jpg" class="img-responsive img-respons">
    				<span class="sombra" style="padding: 5px;"><b>Breves VIP</b></span>
				</div>
			     <div class="fh5co-item notic">
			      <h3>Dora Explora las Salas de Cine en 2019</h3>
			      <p>El portal The Hollywood Reporter anunció el estreno de la película “Dora, la Exploradora”, bajo la producción de Paramount Pictures.</p>
			      		<ul class="stuff">
							<li><a href="noticias/dora-explora-las-salas-de-cine-en-2019.php"><i class="icon-arrow-right22"></i> Leer más...</a></li>
						</ul>
			     </div>
			    </div>
			    <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 animate-box spac secnot">
				<div class="imgHolder">
				<img src="/componentes/images/cicara.jpg" class="img-responsive img-respons">
    				<span class="sombra" style="padding: 5px;"><b>Gastronomía</b></span>
				</div>
			     <div class="fh5co-item notic">
			      <h3>Cicara Caffe, un pedacito de Italia cómoda y estilo</h3>
			      <p>Para nadie es un secreto que visitar cafés está de moda, para muchos recorrer estos lugares es parte de sus pasatiempos favoritos.</p>
			      		<ul class="stuff">
							<li><a href="noticias/cicara-caffe-un-pedacito-de-italia-comoda-y-estilo.php"><i class="icon-arrow-right22"></i> Leer más...</a></li>
						</ul>
			     </div>
			    </div>
			    <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 animate-box spac secnot">
				<div class="imgHolder">
				<img src="/componentes/images/pasarela261.jpg" class="img-responsive img-respons">
    				<span class="sombra" style="padding: 5px;"><b>Moda</b></span>
				</div> 
			     <div class="fh5co-item notic">
			      <h3>Pasarela 261 en el CAMLB</h3>
			      <p>Bajo la producción general de Yamlusi Agostini y Rubendario Marquez, acuerdan este evento que va hacia su cuarta edición de la mano de 12 diseñadores.</p>
			      		<ul class="stuff">
							<li><a href="noticias/pasarela-261-en-el-centro-de-arte-de-maracaibo-lia-bermudez.php"><i class="icon-arrow-right22"></i> Leer más...</a></li>
						</ul>
			     </div>
			    </div>
			    <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 animate-box spac secnot">
				<div class="imgHolder">
				<img src="/componentes/images/samsung.jpg" class="img-responsive img-respons">
    				<span class="sombra" style="padding: 5px;"><b>Tecnología</b></span>
				</div>
			     <div class="fh5co-item notic">
			      <h3>Samsung nos sorprende con la Lavadora AddWash</h3>
			      <p>Lo mejor de la nueva lavadora Samsung es que no tienes que estar delante de la lavadora para controlar sus ciclos, pues aquí entra en juego tu Smartphone..</p>
			      		<ul class="stuff">
							<li><a href="noticias/samsung-nos-vuelve-a-sorprende-con-la-lavadora-addWash-serie-6.php"><i class="icon-arrow-right22"></i> Leer más...</a></li>
						</ul>
			     </div>
			    </div>
			    <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 animate-box spac secnot">
				<div class="imgHolder">
				<img src="/componentes/images/ivankanew.jpg" class="img-responsive img-respons">
    				<span class="sombra" style="padding: 5px;"><b>Moda</b></span>
				</div>
			     <div class="fh5co-item notic">
			      <h3>La moda de Ivanka Trump se impone en su guardarropa</h3>
			      <p>La hija mayor del presidente de EEUU califica en primeras páginas de las revistas de moda, al elegir por tercera ocasión prendas de la firma Zara.</p>
			      		<ul class="stuff">
							<li><a href="noticias/la-moda-low-cost-de-ivanka-trump-se-impone-en-su-guardarropa.php"><i class="icon-arrow-right22"></i> Leer más...</a></li>
						</ul>
			     </div>
			    </div>
			    <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 animate-box spac secnot">
				<div class="imgHolder">
				<img src="/componentes/images/norkys.jpg" class="img-responsive img-respons">
    				<span class="sombra" style="padding: 5px;"><b>Breves VIP</b></span>
				</div>
			     <div class="fh5co-item notic">
			      <h3>Norkis Batista no pudo entrar a los Estados Unidos</h3>
			      <p>A la actriz venezolana Norkys Batista le prohibieron entrar al país norteamericano, ya que presenta algunos inconvenientes.</p>
			      		<ul class="stuff">
							<li><a href="noticias/norkis-batista-no-pudo-entrar-a-los-estados-unidos.php"><i class="icon-arrow-right22"></i> Leer más...</a></li>
						</ul>
			     </div>
			    </div>
			    <!--div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 animate-box spac secnot">
				<div class="imgHolder">
				<img src="images/gallery_9.jpeg" class="img-responsive img-respons">
    				<span class="sombra" style="padding: 5px;"><b>Sociale</b></span>
				</div>
			     <div class="fh5co-item notic">
			      <h3>Bake Potato Pizza</h3>
			      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos nihil cupiditate ut vero alias quaerat inventore molestias vel suscipit explicabo.</p>
			      		<ul class="stuff">
							<li><a href="noticias/mas.php"><i class="icon-arrow-right22"></i> Leer más...</a></li>
						</ul>
			     </div>
			    </div>
			    <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 animate-box spac secnot">
				<div class="imgHolder">
				<img src="images/gallery_9.jpeg" class="img-responsive img-respons">
    				<span class="sombra" style="padding: 5px;"><b>Música</b></span>
				</div>
			     <div class="fh5co-item notic">
			      <h3>Bake Potato Pizza</h3>
			      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quos nihil cupiditate ut vero alias quaerat inventore molestias vel suscipit explicabo.</p>
			      		<ul class="stuff">
							<li><a href="noticias/mas.php"><i class="icon-arrow-right22"></i> Leer más...</a></li>
						</ul>
			     </div>
			    </div-->
			</div>
		</div>
	</div>

	<?php include "componentes/footer.php";?>

	</body>
</html>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  x[slideIndex-1].style.display = "block";  
}
</script>

<script>
var slideIndex = 1;
showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
  }
  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " w3-opacity-off";
}
</script>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 6000); // Change image every 2 seconds
}

</script>

</body>
</html>