<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="/style/images/favicon.png">

	<title>Contáctanos - Salvador Hairdressing</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="assets/img/favicon.png" />

	<!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<!-- CSS Files -->
	<link href="/salvadorweb/style/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

	<!-- CSS Just for demo purpose, don't include it in your project -->

	<!-- Custom -->
	<link href="/c/fonts/fa/fontawesome.min.css" rel="stylesheet">
	<link href="/c/fonts/fa/fa-brands.min.css" rel="stylesheet">

</head>

<body>

	<?php include '../c/navbar.php'; ?>

	<div class="image-container set-full-height" style="background-image: url('assets/img/instituto.jpg')">
	    <!--   Creative Tim Branding   >
	    <a href="http://creative-tim.com">
	         <div class="logo-container">
	            <div class="logo">
	                <img src="assets/img/new_logo.png">
	            </div>
	            <div class="brand">
	                Creative Tim
	            </div>
	        </div>
	    </a-->

		<!--  Made With Material Kit  -->
		<!--a href="http://demos.creative-tim.com/material-kit/index.html?ref=material-bootstrap-wizard" class="made-with-mk">
			<div class="brand">MK</div>
			<div class="made-with">Made with <strong>Material Kit</strong></div>
		</a-->

	    <!--   Big container   -->
	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">
		            <!--      Wizard container        -->
		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="red" id="wizardProfile">
		                    <form action="" method="">
		                <!--        You can switch " data-color="purple" "  with one of the next bright colors: "green", "orange", "red", "blue"       -->

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        	   Formulario de Contacto
		                        	</h3>
									<h5>¿Qué te pareció tu visita a nuestros salones? Haznos llegar tus comentarios.</h5>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#about" data-toggle="tab">Cliente</a></li>
			                            <li><a href="#account" data-toggle="tab">Salón</a></li>
			                            <li><a href="#address" data-toggle="tab">Servicio</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="about">
		                              <div class="row">
		                                	<h4 class="info-text"> Ingresa tus datos personales para que podamos contactarte.</h4>
		                                	<!--div class="col-sm-4 col-sm-offset-1">
		                                    	<div class="picture-container">
		                                        	<div class="picture">
                                        				<img src="assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
		                                            	<input type="file" id="wizard-picture">
		                                        	</div>
		                                        	<h6>Choose Picture</h6>
		                                    	</div>
		                                	</div-->
		                                	<div class="col-sm-5 col-sm-offset-1">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">face</i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Nombre <small>(requerido)</small></label>
			                                          <input name="firstname" type="text" class="form-control" required>
			                                        </div>
												</div>
		                                	</div>

		                                	<div class="col-sm-5">
		                                		<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">record_voice_over</i>
													</span>
													<div class="form-group label-floating">
													  <label class="control-label">Apellido <small>(requerido)</small></label>
													  <input name="lastname" type="text" class="form-control" required>
													</div>
												</div>
											</div>

		                                	<div class="col-sm-4 col-sm-offset-1">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">phone</i>
													</span>
													<div class="form-group label-floating">
			                                          <label class="control-label">Teléfono <small>(requerido)</small></label>
			                                          <input name="phone" type="text" class="form-control" required>
			                                        </div>
												</div>
		                                	</div>


											<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
													<div class="form-group label-floating">
			                                            <label class="control-label">Correo Electrónico <small>(requerido)</small></label>
			                                            <input name="email" type="email" class="form-control" required>
			                                        </div>
												</div>
		                                	</div>

		                            	</div>
		                            </div>

		                            <div class="tab-pane" id="account">
		                                <h4 class="info-text"> Ingresa los datos del salón que visitaste. </h4>
		                                <div class="row">

		                                    <div class="col-sm-5 col-sm-offset-1">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">person</i>
													</span>
													<div class="form-group label-floating">
				                                        <label class="control-label">Nombre del Estilista <small>(requerido)</small></label>
				                                        <input name="asociado" type="text" class="form-control" required>
				                                    </div>
												</div>
		                                	</div>

		                                	<div class="col-sm-5">
			                                	<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">date_range</i>
													</span>
						                            <div class="form-group label-floating"> 
						                                <label class="control-label"> <span id="Birthday"></span> </label>
						                                <input name="Birthday" type="text" id="txtBirth" placeholder="Fecha de la visita" class="datepicker form-date" required> 
						                            </div>
					                        	</div>
				                            </div>

		                                </div>

		                                <div class="row">

		                                	<div class="col-sm-5 col-sm-offset-1">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">language</i>
													</span>
													<div class="form-group label-floating">
			                                       	<label class="control-label">País</label>
			                                       		<select name="country" class="form-control" required>
															<option disabled="" selected=""></option>
			                                               	<option value="50"> Curazao </option>
			                                               	<option value="51"> Ecuador </option>
			                                               	<option value="52"> Estados Unidos </option>
			                                               	<option value="53"> Panamá </option>
			                                                <option value="54"> República Dominicana </option>
			                                               	<option value="55"> Venezuela </option>
				                                       	</select>
				                                    </div>
												</div>
			                                </div>

		                                	<div class="col-sm-5">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">store</i>
													</span>
													<div class="form-group label-floating">
			                                       	<label class="control-label">Nombre del Salón</label>
			                                       		<select name="salon" class="form-control" required>
															<option disabled="" selected=""></option>
			                                               	<option value="1"> 1 </option>
			                                               	<option value="2"> 2 </option>
			                                               	<option value="3"> 3 </option>
			                                               	<option value="4"> 4 </option>
			                                                <option value="5"> 5 </option>
			                                               	<option value="6"> 6 </option>
				                                       	</select>
				                                    </div>
												</div>
			                                </div>

		                                </div>
		                            </div>
		                            <div class="tab-pane" id="address">
		                                <div class="row">
		                                    <div class="col-sm-12">
		                                        <h4 class="info-text"> Queremos saber si estamos haciendo de tu Experiencia Salvador la mejor posible. Dinos que estamos haciendo y en que podemos mejorar, valoramos tus comentarios. </h4>
		                                    </div>

		                                    <div class="col-sm-10 col-sm-offset-1">
	                                    		<div class="form-group cuestionario">
												    <label for="group1">¿Al llegar al salón te dieron la "Bienvenida a la Excelencia?</label>
												    <div class="text-left">
												    	<input name="group1" type="radio" id="1" /><label for="1">Si</label>
												    	<input name="group1" type="radio" id="2" /><label for="2">No</label>
												    </div>
												</div>
											</div>

											<div class="col-sm-10 col-sm-offset-1">
	                                    		<div class="form-group cuestionario">
												    <label for="group2">¿Recibiste un diagnóstico antes del servicio?</label>
												    <div class="text-left">
												    	<input name="group2" type="radio" id="3" /><label for="3">Si</label>
												    	<input name="group2" type="radio" id="4" /><label for="4">No</label>
												    </div>
												</div>
											</div>

											<div class="col-sm-10 col-sm-offset-1">
	                                    		<div class="form-group cuestionario">
												    <label for="group2">¿Te ofrecieron...?</label>
												    <div class="text-left">
												    	<div class="col-sm-6">
													    	<p class="no-marginbot"><input type="checkbox" id="11" /><label for="11">Té</label></p>
													    	<p class="no-marginbot"><input type="checkbox" id="12" /><label for="12">Café</label></p>
													    	<p class="no-marginbot"><input type="checkbox" id="13" /><label for="13">Agua</label></p>
													    	<p class="no-marginbot"><input type="checkbox" id="14" /><label for="14">Tratamientos</label></p>
													    </div>
													    <div class="col-sm6" style="margin-left: 15px;">
													    	<p class="no-marginbot"><input type="checkbox" id="15" /><label for="15">GiftCard</label></p>
													    	<p class="no-marginbot"><input type="checkbox" id="16" /><label for="16">ClientCard</label></p>
													    	<p class="no-marginbot"><input type="checkbox" id="17" /><label for="17">Otro</label></p>
													    	<p class="no-marginbot"><input type="checkbox" id="18" /><label for="18">Ninguno</label></p>
													    </div>
												    </div>
												</div>
											</div>

											<div class="col-sm-10 col-sm-offset-1">
	                                    		<div class="form-group cuestionario">
												    <label for="group3">Calificación del servicio <small style="color: #7a7a7a"><br>(1: Muy malo, 2: Malo, 3: Regular, 4: Bueno, 5: Muy bueno)</small></label>
												    <div class="text-left">
												    	<input name="group3" type="radio" id="5" /><label class="calpd" for="5">1</label>
												    	<input name="group3" type="radio" id="6" /><label class="calpd" for="6">2</label>
												    	<input name="group3" type="radio" id="7" /><label class="calpd" for="7">3</label>
												    	<input name="group3" type="radio" id="8" /><label class="calpd" for="8">4</label>
												    	<input name="group3" type="radio" id="9" /><label class="calpd" for="9">5</label>
												    </div>
												</div>
											</div>

		                                    <div class="col-sm-10 col-sm-offset-1">
	                                    		<div class="form-group cuestionario">
		                                            <label>Comentarios</label>
		                                            <textarea class="form-control" placeholder="" rows="2" required></textarea>
		                                        </div>
		                                    </div>

		                                </div>
		                            </div>
		                        </div>
		                        <div class="wizard-footer">
		                            <div class="pull-right">
		                                <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Siguiente' />
		                                <input type='submit' class='btn btn-finish btn-fill btn-success btn-wd' name='finish' value='Enviar' />
		                            </div>

		                            <div class="pull-left">
		                                <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Anterior' />
		                            </div>
		                            <div class="clearfix"></div>
		                        </div>
		                    </form>
		                </div>
		            </div> <!-- wizard container -->
		        </div>
	        </div><!-- end row -->
	    </div> <!--  big container -->

	    <div class="footer">
	        <div class="container text-center">
	             <!--Made with <i class="fa fa-heart heart"></i> by <a href="http://www.creative-tim.com">Creative Tim</a>. Free download <a href="http://www.creative-tim.com/product/bootstrap-wizard">here.</a-->
	        </div>
	    </div>
	</div>

<!-- Footer -->
  <div class="light-wrapper">
    <div class="container">
      <div class="row text-center">

        <div class="thin text-center" style="padding-top: 5%;">
          <h3 class="section-title">Síguenos</h3>
          <div style="border-bottom: 2px solid; width: 80px; margin-left: auto; margin-right: auto;"></div>
        </div>

        <div class="iconos-principal">
            <a target="_blank" href="https://es-la.facebook.com/SalvadorWorld/"><i class="size-iconp fab fa-facebook-f"></i></a>
            <a target="_blank" href="https://www.instagram.com/mundosalvador"><i class="size-iconp fab fa-instagram"></i></a>
            <a target="_blank" href="https://twitter.com/mundosalvador"><i class="size-iconp fab fa-twitter"></i></a>
            <a target="_blank" href="https://www.pinterest.com/mundosalvador/"><i class="size-iconp fab fa-pinterest-p"></i></a>
            <a target="_blank" href="https://www.youtube.com/user/salvadorpeluqueria"><i class="size-iconp fab fa-youtube" style="padding-right: 0;"></i></a>
        </div>

      </div> 
    </div>
  </div>

  <!-- /.light-wrapper -->
  <footer class="footer inverse-wrapper" id="footer">
    <div class="padding-50">
      <div class="row">
        <div class="col-sm-12">
        <div class="col-sm-4 col-sm-offset-4">
          <div class="widget text-center">
            <h4 class="widget-title">Suscríbete al Boletín</h4>
            <form class="searchform" method="get">
              <input type="text" id="s2" name="s" value="Ingresa tu correo electronico" onfocus="this.value=''" onblur="this.value='Suscribete'">
              <button type="submit" class="btn btn-default">Aceptar</button>
            </form><p></p><p></p>
          </div>
        </div>
        </div>
        <div class="col-sm-12 onmob-pad">
            <div class="widget">
                <div class="text-center">
                  <h5 id="onmob-line">
                    <a class="link-footer" href="/nosotros.php">NOSOTROS</a>
                    <a class="link-footer" href="/servicios.php">SERVICIOS</a>
                    <a class="link-footer" href="/modelos/">MODELOS DE NEGOCIO</a>
                    <a class="link-footer" href="/franquicias">FRANQUICIAS</a>
                    <a class="link-footer" href="/ubicaciones">UBICACIONES</a>
                    <a class="link-footer" href="/contacto.php">CONTACTO</a>
                  </h5>
                </div>
            </div>
        </div>       
      </div>
      <!-- /.row --> 
    </div>
    <!-- .container -->
    
    <div class="sub-footer">
      <div class="container inner">
        <p class="text-center">© 2011-2017 Salvador Hairdressing. Todos los derechos reservados.</p>
      </div>
      <!-- .container --> 
    </div>
    <!-- .sub-footer --> 
  </footer>
  <!-- /footer -->

</body>
	<!--   Core JS Files   -->
    <script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<!--  Plugin for the Wizard -->
	<script src="assets/js/material-bootstrap-wizard.js"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/	 -->
	<script src="assets/js/jquery.validate.min.js"></script>

	<!-- Custom -->
	<script src="assets/js/materialize.js"></script>
	<script src="assets/js/date_picker/picker.date.js"></script>
	<script type="text/javascript">
		 $('.datepicker').pickadate({
	    selectMonths: true, // Creates a dropdown to control month
	    selectYears: 15, // Creates a dropdown of 15 years to control year,
	    today: 'Hoy',
	    clear: 'Limpiar',
	    close: 'Aceptar',
	    closeOnSelect: false // Close upon selecting a date,
	  });      
	</script>

</html>