<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,300i,400,400i,500,600i,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="/componentes/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="/componentes/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="/componentes/css/bootstrap.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="/componentes/css/flexslider.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="/componentes/css/style.css">
	<link rel="stylesheet" href="/componentes/css/estilos.css">

	<!-- Modernizr JS -->
	<script src="/componentes/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">


	<?php function cabecera($ubicacion){

		$opciones = "";
		switch ($ubicacion) {
			case 'home':
				$opciones = '<li class="active"><a href="index.php">Inicio</a></li>
							<li><a href="/nosotros.php">Nosotros</a></li>
							<li class="has-dropdown">
								<a href="/ediciones.php">Ediciones</a>
								<ul class="dropdown">
									<li><a href="/ediciones/actual.php">Ed. Actual</a></li>
									<li><a href="/ediciones/anteriores.php">Ed. Anteriores</a></li>
								</ul>
							</li>
							<li><a href="/noticias.php">Noticias</a></li>
							<li><a href="/publicate.php">Publícate</a></li>';
				break;
			case 'ediciones':
				$opciones = '<li><a href="/index.php">Inicio</a></li>
							<li><a href="/nosotros.php">Nosotros</a></li>
							<li class="active has-dropdown">
								<a href="/ediciones.php">Ediciones</a>
								<ul class="dropdown">
									<li><a href="/ediciones/actual.php">Ed. Actual</a></li>
									<li><a href="/ediciones/anteriores.php">Ed. Anteriores</a></li>
								</ul>
							</li>
							<li><a href="/noticias.php">Noticias</a></li>
							<li><a href="/publicate.php">Publícate</a></li>';
				break;
			case 'noticias':
				$opciones = '<li><a href="/index.php">Inicio</a></li>
							<li><a href="/nosotros.php">Nosotros</a></li>
							<li class="has-dropdown">
								<a href="/ediciones.php">Ediciones</a>
								<ul class="dropdown">
									<li><a href="/ediciones/actual.php">Ed. Actual</a></li>
									<li><a href="/ediciones/anteriores.php">Ed. Anteriores</a></li>
								</ul>
							</li>
							<li class="active"><a href="/noticias.php">Noticias</a></li>
							<li><a href="/publicate.php">Publícate</a></li>';
				break;
			case 'contacto':
				$opciones = '<li><a href="/index.php">Inicio</a></li>
							<li><a href="/nosotros.php">Nosotros</a></li>
							<li class="has-dropdown">
								<a href="/ediciones.php">Ediciones</a>
								<ul class="dropdown">
									<li><a href="/ediciones/actual.php">Ed. Actual</a></li>
									<li><a href="/ediciones/anteriores.php">Ed. Anteriores</a></li>
								</ul>
							</li>
							<li><a href="/noticias.php">Noticias</a></li>
							<li class="active"><a href="/publicate.php">Publícate</a></li>';
				break;
			case 'nosotros':
				$opciones = '<li><a href="/index.php">Inicio</a></li>
							<li class="active"><a href="/nosotros.php">Nosotros</a></li>
							<li class="has-dropdown">
								<a href="/ediciones.php">Ediciones</a>
								<ul class="dropdown">
									<li><a href="/ediciones/actual.php">Ed. Actual</a></li>
									<li><a href="/ediciones/anteriores.php">Ed. Anteriores</a></li>
								</ul>
							</li>
							<li><a href="/noticias.php">Noticias</a></li>
							<li><a href="/publicate.php">Publícate</a></li>';
				break;
			default:
				# code...
				break;
		}


	echo '<nav class="fh5co-nav" role="navigation">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 text-center logo-wrap">
						<div id="fh5co-logo"><a href="/index.php"><span><img src="/componentes//images/logo-fs-most-01min.png" height="100px"></span></a></div>
					</div>
					<div class="col-xs-12 text-center menu-1 menu-wrap">
						<ul>
							'.$opciones.'
						</ul>
					</div>
				</div>
			</div>
	</nav>';
	}
?>