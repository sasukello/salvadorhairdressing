<?php include 'header.html'; ?>

    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Contacto
                </h1>
                <ol class="breadcrumb">
                    <li><a href="index.php">Inicio</a>
                    </li>
                    <li class="active">Contacto</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->

        <!-- Content Row -->
        <div class="row">
            <!-- Map Column -->
            <div class="col-md-8">
                <!-- Embedded Google Map -->
                <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;ie=UTF8&amp;ll=37.0625,-95.677068&amp;spn=56.506174,79.013672&amp;t=m&amp;z=4&amp;output=embed"></iframe>
            </div>
            <!-- Contact Details Column -->
            <div class="col-md-4">
                <h3>Detalles de Contacto</h3>
                <p>
                    Calle 67 "Cecilio Acosta" con Av. 8B. Edificio Egeón, P1.<br>Maracaibo, Zulia.<br>
                </p>
                <p><i class="fa fa-phone"></i> 
                    <abbr title="Teléfono">P</abbr>: +58 (261) 797-2596</p>
                <p><i class="fa fa-envelope-o"></i> 
                    <abbr title="Correo Eléctronico">E</abbr>: <a href="mailto:academy@salvadoracademy.com">academy@salvadoracademy.com</a>
                </p>
                <p><i class="fa fa-clock-o"></i> 
                    <abbr title="Horario">H</abbr>: Lunes - Viernes: 8:00 AM to 6:00 PM</p>
                <ul class="list-unstyled list-inline list-social-icons">
                    <li>
                        <a href="http://www.facebook.com/salvadoracademy"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="http://www.twitter.com/salvadoracademy"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="http://www.instagram.com/salvadoracademy"><i class="fa fa-google-plus-square fa-2x"></i></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /.row -->

        <!-- Contact Form -->
        <!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
        <div class="row">
            <div class="col-md-8">
                <h3>¿Preguntas? Contáctanos</h3>
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Nombre Completo:</label>
                            <input type="text" class="form-control" id="name" required data-validation-required-message="Por favor ingresa tu nombre.">
                            <p class="help-block"></p>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Número de Teléfono:</label>
                            <input type="tel" class="form-control" id="phone" required data-validation-required-message="Por favor ingresa tu teléfono.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Correo Electrónico:</label>
                            <input type="email" class="form-control" id="email" required data-validation-required-message="Por favor ingresa tu dirección de correo electrónico.">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <div class="controls">
                            <label>Mensaje:</label>
                            <textarea rows="10" cols="100" class="form-control" id="message" required data-validation-required-message="Por favor ingresa tu mensaje." maxlength="999" style="resize:none"></textarea>
                        </div>
                    </div>
                    <div id="success"></div>
                    <!-- For success/fail messages -->
                    <button type="submit" class="btn btn-primary">Enviar Mensaje</button>
                </form>
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include 'footer.html'; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Contact Form JavaScript -->
    <!-- Do not edit these files! In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

</body>

</html>
