<style type="text/css">
  input[type="checkbox"], input[type="radio"]{
    display: none;
  }
</style>

<!--   Big container   -->
      <div class="container margin-contact">
          <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 mb-0">
              <div class="wizard">
                  <div class="text-center pt-50">
                      <h2 class="mb-5"><?php echo _('Formulario de Franquicias'); ?></h2>
                      <div class="row" style="padding-right: 10%; padding-left: 10%;"><p class="mb-0"><?php echo _('Obtén toda la información referente a franquicias Salvador Hairdressing dejando toda tu información en este formulario.'); ?></p></div>
                      <br>
                  </div>
                  <div class="wizard-inner">
                    
                    <div class="connecting-line"></div>
                      <ul class="nav nav-tabs" role="tablist">

                          <li role="presentation" class="active">
                              <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="<?php echo _('Información del Cliente'); ?>">
                                  <span class="round-tab">
                                      <i class="far fa-building"></i>
                                  </span>
                              </a>
                          </li>

                          <li role="presentation" class="disabled">
                              <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="<?php echo _('Información del Salón'); ?>">
                                  <span class="round-tab">
                                      <i class="fas fa-user"></i>
                                  </span>
                              </a>
                          </li>
                          <li role="presentation" class="disabled">
                              <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="<?php echo _('Detalle del Servicio'); ?>">
                                  <span class="round-tab">
                                      <i class="fas fa-clipboard"></i>
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

                  <form action="/c/api.php" name="franquicias" id="franquicias" method="POST">
                      <div class="tab-content">
                          <div class="tab-pane active" role="tabpanel" id="step1">
                              <div class="text-center">
                                <h3 class="mb-5"><?php echo _('Tipo de Franquicia'); ?></h3>
                                <p class="text-center"><?php echo _('Seleccione una opción para ver las características.'); ?></p><br>
                              </div>
                              <div class="row">
                                <div class="col-md-12 col-sm-12 inner-addon left-addon">
                                  <i class="far fa-dot-circle" id="icon-input"></i>
                                  <span id="salones">
                                    <select class="left-addon" name="tipo" id="tipo" onchange="tipof(this.value)">
                                      <option value=""><?php echo _('Seleccione una opción'); ?></option>
                                      <option value="s1"><?php echo _('Franquiciado Operador'); ?></option>
                                      <option value="s2"><?php echo _('Franquiciado Inversionista'); ?></option>
                                      <option value="s3"><?php echo _('Franquiciado Master'); ?></option>
                                      <option value="s4"><?php echo _('Franquiciado con Unidad de Negocio'); ?></option>
                                      <option value="s5"><?php echo _('Franquiciado Flag Ship'); ?></option>
                                    </select>
                                  </span>
                                  <span id="errortipo"></span>
                                </div>

                                <style type="text/css">
                                  #def-1, #def-2, #def-3, #def-4, #def-5, #sform1, #sform2, #sform3, #sform4, #sform5 {
                                    display: none;
                                  }
                                </style>

                                <div id="t-franquicia">

                                  <div class="col-md-12 col-sm-12 inner-addon left-addon" id="def-1">
                                    <div class="alert alert-info alert-dismissible">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <h3><?php echo _('Franquiciado Operador'); ?></h3>
                                      <span><?php echo _('Es aquel que es emprendedor, que desea establecer un negocio o diversificarse con un nuevo negocio.'); ?></span>
                                    </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 inner-addon left-addon" id="def-2">
                                    <div class="alert alert-info alert-dismissible">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <h3><?php echo _('Franquiciado Inversionista'); ?></h3>
                                      <span><?php echo _('Es aquel que es emprendedor que desea establecer un negocio o diversificarse con un nuevo negocio, dejando su operación en manos de terceros.'); ?></span>
                                    </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 inner-addon left-addon" id="def-3">
                                    <div class="alert alert-info alert-dismissible">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <h3><?php echo _('Franquiciado Master'); ?></h3>
                                      <span><?php echo _('Es el inversionista que adquiere los derechos para el desarrollo operativo y de crecimiento de la marca en una región o país.'); ?></span>
                                    </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 inner-addon left-addon" id="def-4">
                                    <div class="alert alert-info alert-dismissible">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <h3><?php echo _('Franquiciado con Unidad de Negocio'); ?></h3>
                                      <span><?php echo _('Es aquel que tiene condiciones profesionales, económica y actitudinales para establecerse como socio de una unidad de negocio ya establecida, remodelar un salón existente.'); ?></span>
                                    </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12 inner-addon left-addon" id="def-5">
                                    <div class="alert alert-info alert-dismissible">
                                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                      <h3><?php echo _('Franquiciado Flag Ship'); ?></h3>
                                      <span><?php echo _('Es cuando se tiene un negocio salón de belleza ya existente y quieres adquirir los derechos de conocimiento (know how) para el funcionamiento de la unidad de negocio.'); ?></span>
                                    </div>
                                  </div>

                                </div>
                              </div>

                              <ul class="list-inline pull-right">
                                  <li><a href="/franquicias/faq/"><i class="far fa-question-circle"></i><?php echo _(' FAQ: Preguntas Frecuentes'); ?></a></li>
                                  <li class="space-btm"></li>
                                  <li><button type="button" class="btn btn-primary next-step franq1"><?php echo _('Continuar'); ?></button></li>
                              </ul>
                              <span id="errorboton1"></span>
                          </div>

                          <div class="tab-pane" role="tabpanel" id="step2">
                              <div class="text-center">
                                <h3 class="mb-5"><?php echo _('Datos Personales'); ?></h3>
                                <p class="text-center"><?php echo _('Ingresa tus datos personales para que podamos contactarte.'); ?></p><br>
                              </div>
                              <div class="row">
                                <div class="col-md-4 col-sm-12 inner-addon left-addon">
                                  <i class="far fa-id-card" id="icon-input"></i>
                                  <input type="text" name="ci" id="ci" class="form-control" placeholder="<?php echo _('Documento de Identidad'); ?>">
                                  <span id="errorci"></span>
                                </div>
                                <div class="col-md-4 col-sm-12 inner-addon left-addon">
                                  <i class="fa fa-user" id="icon-input"></i>
                                  <input type="text" name="nombre" id="nombre" class="form-control" placeholder="<?php echo _('Nombre'); ?>">
                                  <span id="errornombre"></span>
                                </div>
                                <div class="col-md-4 col-sm-12 inner-addon left-addon">
                                  <i class="far fa-user" id="icon-input"></i>
                                  <input type="text" name="apellido" id="apellido" class="form-control" placeholder="<?php echo _('Apellido'); ?>">
                                  <span id="errorapellido"></span>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4 col-sm-12 inner-addon left-addon">
                                  <i class="far fa-calendar-alt" id="icon-input"></i>
                                  <input name="ffnn" type="text" id="ffnn" placeholder="<?php echo _('Fecha de Nacimiento'); ?>" class="datepicker form-date">
                                  <span id="errorffnn"></span>
                                </div>
                                <div class="col-md-8 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-map-pin" id="icon-input"></i>
                                  <input type="text" name="direccion" id="direccion" class="form-control" placeholder="<?php echo _('Dirección de Residencia'); ?>">
                                  <span id="errordireccion"></span>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-globe" id="icon-input"></i>
                                  <select class="form-control bfh-countries" name="pais" id="pais" data-country="00"></select>
                                  <span id="errorpais"></span>
                                </div>
                                <div class="col-md-4 col-sm-12 inner-addon left-addon">
                                  <i class="far fa-map" id="icon-input"></i>
                                  <input type="text" name="estado" id="estado" class="form-control" placeholder="<?php echo _('Provincia / Estado'); ?>">
                                  <span id="errorestado"></span>
                                </div>
                                <div class="col-md-4 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-map-marker-alt" id="icon-input"></i>
                                  <input type="text" name="ciudad" id="ciudad" class="form-control" placeholder="<?php echo _('Ciudad'); ?>">
                                  <span id="errorciudad"></span>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-4 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-phone" id="icon-input"></i>
                                  <input type="text" name="telf" id="telf" class="form-control" placeholder="<?php echo _('Teléfono de Habitación'); ?>">
                                  <span id="errortelf"></span>
                                </div>
                                <div class="col-md-4 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-phone-square" id="icon-input"></i>
                                  <input type="text" name="oficina" id="oficina" class="form-control" placeholder="<?php echo _('Teléfono de Oficina'); ?>">
                                  <span id="erroremail"></span>
                                </div>
                                <div class="col-md-4 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-mobile-alt" id="icon-input"></i>
                                  <input type="text" name="movil" id="movil" class="form-control" placeholder="<?php echo _('Teléfono Móvil'); ?>">
                                  <span id="errormovil"></span>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-envelope" id="icon-input"></i>
                                  <input type="email" name="correo" id="correo" class="form-control" placeholder="<?php echo _('Correo Electrónico'); ?>">
                                  <span id="errorcorreo"></span>
                                </div>
                                <div class="col-md-6 col-sm-12 inner-addon left-addon">
                                  <i class="fas fa-graduation-cap" id="icon-input"></i>
                                  <input type="text" name="nivel" id="nivel" class="form-control" placeholder="<?php echo _('Nivel Académico'); ?>">
                                  <span id="errornivel"></span>
                                </div>
                              </div>

                              <ul class="list-inline pull-right">
                                  <li><button type="button" class="btn btn-default prev-step"><?php echo _('Anterior'); ?></button></li>
                                  <li><button type="button" class="btn btn-primary next-step franq2"><?php echo _('Continuar'); ?></button></li>
                              </ul>
                          </div>
                          <div class="tab-pane" role="tabpanel" id="step3">
                            <div class="text-center">
                              <h3 class="mb-5"><?php echo _('Cuestionario de Solicitud'); ?></h3>
                              <p class="text-center"><?php echo _('Responde las siguientes preguntas para conocer más sobre sus necesidades de negocio.'); ?></p><br>
                            </div>
                            <div class="row">

                              <span id="sform1">
                                <?php include 'franquicias/operador.php'; ?>
                              </span>
                              <span id="sform2">
                                <?php include 'franquicias/inversionista.php'; ?>
                              </span>
                              <span id="sform3">
                                <?php include 'franquicias/master.php'; ?>
                              </span>
                              <span id="sform4">
                                <?php include 'franquicias/unidad.php'; ?>
                              </span>
                              <span id="sform5">
                                <?php include 'franquicias/flag.php'; ?>
                              </span>
                           
                              <ul class="list-inline pull-right">
                                  <li><button type="button" class="btn btn-default prev-step"><?php echo _('Anterior'); ?></button></li>
                                  <!--li><button type="button" class="btn btn-default next-step">Skip</button></li-->
                                  <input type="hidden" name="action" value="formFranquicias">
                                  <input type="hidden" name="ubicacion" value="S01">
                                  <input type="hidden" id="language" name="lenguaje" value="<?php echo $language; ?>">
                                  <li><button type="submit" onclick="validarDatos(event);" class="btn btn-primary btn-info-full next-step franq3" id="enviar"><?php echo _('Enviar'); ?></button></li>
                              </ul>
                            </div>
                          </div>
                          <div class="tab-pane" role="tabpanel" id="complete">
                              <div class="text-center">
                                <i class="size-iconp fas fa-check"></i><br><br>
                                <h2><?php echo _('Solicitud Enviada Exitosamente'); ?></h2>
                                <p class="text-center"><?php echo _('Muchas gracias por tu solicitud, revisaremos todos los datos suministrados y te contactaremos muy pronto.'); ?></p>
                                <br><br>
                                <img width="250px" src="/c/img/salvador400.png">
                                <br><br>
                                <a href="/franquicias/faq/"><i class="far fa-question-circle"></i><?php echo _(' FAQ: Preguntas Frecuentes'); ?></a>
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