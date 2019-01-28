<style type="text/css">
  input[type="checkbox"], input[type="radio"]{
    display: none;
  }
</style>

<!--   Big container   -->
      <div class="container margin-contact">
          <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 mb-0">
              <div class="wizard">
                  <div class="text-center pt-50">
                      <h2 class="mb-5"><?php echo _('Formulario de Contacto'); ?></h2>
                      <p class="mb-0"><?php echo _('¿Qué te pareció tu visita a nuestros salones? Haznos llegar tus comentarios.'); ?></p>
                  </div>
                  <div class="wizard-inner">
                    
                    <div class="connecting-line"></div>
                      <ul class="nav nav-tabs" role="tablist">

                          <li role="presentation" class="active">
                              <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="<?php echo _('Información del Cliente'); ?>">
                                  <span class="round-tab">
                                      <i class="fa fa-user"></i>
                                  </span>
                              </a>
                          </li>

                          <li role="presentation" class="disabled">
                              <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="<?php echo _('Información del Salón'); ?>">
                                  <span class="round-tab">
                                      <i class="fas fa-map-marker-alt"></i>
                                  </span>
                              </a>
                          </li>
                          <li role="presentation" class="disabled">
                              <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="<?php echo _('Detalle del Servicio'); ?>">
                                  <span class="round-tab">
                                      <i class="fas fa-envelope"></i>
                                  </span>
                              </a>
                          </li>

                          <li role="presentation" class="disabled">
                              <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="<?php echo _('Completado'); ?>">
                                  <span class="round-tab">
                                      <i class="fas fa-check"></i>
                                  </span>
                              </a>
                          </li>
                      </ul>
                  </div>

                  <form action="c/api.php" method="POST">
                      <div class="tab-content">
                          <div class="tab-pane active" role="tabpanel" id="step1">
                              <div class="text-center">
                                <h3 class="mb-5"><?php echo _('Información Personal'); ?></h3>
                                <p class="text-center"><?php echo _('Ingresa tus datos personales para que podamos contactarte.'); ?></p><br>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="fa fa-user" id="icon-input"></i>
                                  <input type="text" name="name" id="name" class="form-control" placeholder="<?php echo _('Nombre'); ?>">
                                  <span id="errorname"></span>
                                </div>
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="far fa-user" id="icon-input"></i>
                                  <input type="text" name="lastname" id="lastname" class="form-control" placeholder="<?php echo _('Apellido'); ?>">
                                  <span id="errorlastname"></span>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-phone" id="icon-input"></i>
                                  <input type="text" name="phone" id="phone" class="form-control" placeholder="<?php echo _('Teléfono'); ?>">
                                  <span id="errorphone"></span>
                                </div>
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-envelope" id="icon-input"></i>
                                  <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _('Correo Electrónico'); ?>">
                                  <span id="erroremail"></span>
                                </div>
                              </div>
                              <ul class="list-inline pull-right">
                                  <li><button type="button" class="btn btn-primary next-step boton1"><?php echo _('Continuar'); ?></button></li>
                              </ul>
                              <span id="errorboton1"></span>
                          </div>

                          <div class="tab-pane" role="tabpanel" id="step2">
                              <div class="text-center">
                                <h3 class="mb-5"><?php echo _('Información del Salón'); ?></h3>
                                <p class="text-center"><?php echo _('Ingresa los datos del salón que visitaste.'); ?></p><br>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-users" id="icon-input"></i>
                                  <input type="text" name="asociado" class="form-control" placeholder="<?php echo _('Nombre del Estilista'); ?>">
                                </div>
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                    <i class="far fa-calendar-alt" id="icon-input"></i>
                                    <input name="date" type="text" id="txtBirth" placeholder="<?php echo _('Fecha de la visita'); ?>" class="datepicker form-date">
                                    <span id="errortxtBirth"></span>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-globe" id="icon-input"></i>
                                  
                                  <?php selectCountry(); ?>

                                  <span id="errorcountry"></span>
                                </div>
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-map-marker-alt" id="icon-input"></i>
                                  <span id="salones">
                                    <select class="left-addon" name="salon" id="salon">
                                      <option value="">Nombre del Salón</option>
                                    </select>
                                  </span>
                                  <span id="errorsalon"></span>
                                </div>
                              </div>
                              <ul class="list-inline pull-right">
                                  <li><button type="button" class="btn btn-default prev-step"><?php echo _('Anterior'); ?></button></li>
                                  <li><button type="button" class="btn btn-primary next-step boton2"><?php echo _('Continuar'); ?></button></li>
                              </ul>
                          </div>
                          <div class="tab-pane" role="tabpanel" id="step3">
                            <div class="text-center">
                              <h3 class="mb-5"><?php echo _('Calificación del Servicio'); ?></h3>
                              <p class="text-center"><?php echo _('Queremos saber si estamos haciendo de tu Experiencia Salvador la mejor posible. Dinos que estamos haciendo y en que podemos mejorar, valoramos tus comentarios.'); ?></p>
                            </div>

                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group cuestionario">
                                  <h6 for="group1"><?php echo _('¿Al llegar al salón te dieron la "Bienvenida a la Excelencia?'); ?></h6>
                                  <div class="text-left">
                                    <input name="group1" type="radio" id="1" value="1" /><label for="1"><?php echo _('Si'); ?></label>
                                    <input name="group1" type="radio" id="2" value="2" /><label for="2"><?php echo _('No'); ?></label>
                                  </div>
                                  <span id="errorgroup1"></span>
                                </div>
                              </div>

                              <div class="col-sm-12">
                                <div class="form-group cuestionario">
                                  <h6 for="group2"><?php echo _('¿Recibiste un diagnóstico antes del servicio?'); ?></h6>
                                  <div class="text-left">
                                    <input name="group2" type="radio" id="3" value="3" /><label for="3"><?php echo _('Si'); ?></label>
                                    <input name="group2" type="radio" id="4" value="4" /><label for="4"><?php echo _('No'); ?></label>
                                  </div>
                                  <span id="errorgroup2"></span>
                                </div>
                              </div>

                              <div class="col-sm-12">
                                <div class="form-group cuestionario">
                                  <h6 for="group3"><?php echo _('¿Te ofrecieron...?'); ?></h6>
                                  <div class="text-left">
                                    <div class="col-sm-12 ps-0">
                                      <div class="col-md-4 col-xs-12 mb-0 ps-0" style="float: none;">
                                        <p class="mb-0"><input name="group3[]" type="checkbox" id="11" value="5" /><label for="11"><?php echo _('Té'); ?></label></p>
                                        <p class="mb-0"><input name="group3[]" type="checkbox" id="12" value="6" /><label for="12"><?php echo _('Café'); ?></label></p>
                                        <p class="mb-0"><input name="group3[]" type="checkbox" id="13" value="7" /><label for="13"><?php echo _('Agua'); ?></label></p>
                                      </div>
                                      <div class="col-md-4 col-xs-12 mb-0 ps-0" style="float: none;">
                                        <p class="mb-0"><input name="group3[]" type="checkbox" id="14" value="8" /><label for="14"><?php echo _('Tratamientos'); ?></label></p>
                                        <p class="mb-0"><input name="group3[]" type="checkbox" id="15" value="9" /><label for="15"><?php echo _('GiftCard'); ?></label></p>
                                        <p class="mb-0"><input name="group3[]" type="checkbox" id="16" value="10" /><label for="16"><?php echo _('ClientCard'); ?></label></p>
                                      </div>
                                      <div class="col-md-4 col-xs-12 ps-0" style="float: none;">
                                        <p class="mb-0"><input name="group3[]" type="checkbox" id="17" value="11" /><label for="17"><?php echo _('Otro'); ?></label></p>
                                        <p class="mb-0"><input name="group3[]" type="checkbox" id="18" value="12" /><label for="18"><?php echo _('Ninguno'); ?></label></p>
                                      </div>
                                    </div>
                                    <span id="errorgroup3"></span>
                                  </div>
                                </div>
                              </div>

                              <div class="col-sm-12">
                                <div class="form-group cuestionario">
                                  <h6 for="group4"><?php echo _('Calificación del servicio <small><br>(1: Muy malo, 2: Malo, 3: Regular, 4: Bueno, 5: Muy bueno)</small>'); ?></h6>
                                  <div class="text-left">
                                    <input name="group4" type="radio" id="5" value="13" /><label class="calpd" for="5">1</label>
                                    <input name="group4" type="radio" id="6" value="14" /><label class="calpd" for="6">2</label>
                                    <input name="group4" type="radio" id="7" value="15" /><label class="calpd" for="7">3</label>
                                    <input name="group4" type="radio" id="8" value="16" /><label class="calpd" for="8">4</label>
                                    <input name="group4" type="radio" id="9" value="17" /><label class="calpd" for="9">5</label>
                                  </div>
                                  <span id="errorgroup4"></span>
                                </div>
                              </div>

                              <div class="col-sm-12">
                                <div class="form-group cuestionario">
                                  <h6><?php echo _('Comentarios'); ?></h6>
                                  <input type="text" name="comments" id="comments" class="form-control" required placeholder="<?php echo _('Escriba sus comentarios aquí...'); ?>">
                                </div>
                                <span id="errorcomments"></span>
                              </div>

                              </div>

                              <ul class="list-inline pull-right">
                                  <li><button type="button" class="btn btn-default prev-step"><?php echo _('Anterior'); ?></button></li>
                                  <!--li><button type="button" class="btn btn-default next-step">Skip</button></li-->
                                  <input type="hidden" name="action" value="contactPrincipal">
                                  <input type="hidden" name="ubicacion" value="S00">
                                  <input type="hidden" id="language" name="lenguaje" value="<?php echo $language; ?>">
                                  <li><button type="submit" class="btn btn-primary btn-info-full next-step boton3"><?php echo _('Enviar'); ?></button></li>
                              </ul>
                          </div>
                          <div class="tab-pane" role="tabpanel" id="complete">
                              <div class="text-center">
                                <i class="size-iconp fas fa-check"></i>
                                <h2><?php echo _('Mensaje Enviado'); ?></h2>
                                <p class="text-center"><?php echo _('Gracias por dejarnos tus comentarios, analizaremos tu mensaje y esperamos poderte contactar pronto.'); ?></p>
                                <br>
                                <img src="/c/img/salvador400.png">
                                <br><br><br><br>
                              </div>
                          </div>
                          <div class="clearfix"></div>
                      </div>
                  </form>
              </div>
            </div>
          </div><!-- end row -->
      </div> <!--  big container -->