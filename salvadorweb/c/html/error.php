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

                          <li role="presentation">
                              <a href="/contacto.php" aria-controls="step1" role="tab" title="<?php echo _('Información del Cliente'); ?>">
                                  <span class="round-tab">
                                      <i class="fa fa-user"></i>
                                  </span>
                              </a>
                          </li>

                          <li role="presentation">
                              <a href="/contacto.php" aria-controls="step2" role="tab" title="<?php echo _('Información del Salón'); ?>">
                                  <span class="round-tab">
                                      <i class="fas fa-map-marker-alt"></i>
                                  </span>
                              </a>
                          </li>
                          <li role="presentation">
                              <a href="/contacto.php" aria-controls="step3" role="tab" title="<?php echo _('Detalle del Servicio'); ?>">
                                  <span class="round-tab">
                                      <i class="fas fa-envelope"></i>
                                  </span>
                              </a>
                          </li>

                          <li role="presentation" class="active">
                              <a href="#complete" aria-controls="complete" role="tab" title="<?php echo _('Completado'); ?>">
                                  <span class="round-tab">
                                      <i class="fas fa-check"></i>
                                  </span>
                              </a>
                          </li>
                      </ul>
                  </div>

                  <form action="c/api.php" method="POST">
                      <div class="tab-content">
                          <div class="tab-pane active" role="tabpanel" id="complete">
                              <div class="text-center">
                                <i style="font-size: 60px;" class="fas fa-times"></i>
                                <br><br>
                                <h2><?php echo _('Lo sentimos, ha ocurrido un error.'); ?></h2>
                                <p class="text-center"><?php echo _('Lamentablemente, ha ocurrido un error inesperado al momento de enviar los datos, te invitamos a ingresar nuevamente la información requerida.'); ?></p>
                                <br><br>
                                <img src="/c/img/salvador400.png" width="220px">
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