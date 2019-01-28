<style type="text/css">
  input[type="checkbox"], input[type="radio"]{
    display: none;
  }
</style>
<meta charset="utf-8">

<!--   Big container   -->
      <div class="container margin-contact">
          <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1 mb-0">
              <div class="wizard">
                  <div class="text-center pt-50">
                      <h2 class="mb-5"><?php echo _('Formulario de Franquicias'); ?></h2>
                      <div class="row" style="padding-right: 10%; padding-left: 10%;"><p class="mb-0"><?php echo _('Obtén toda la información referente a franquicias Salvador Hairdressing dejando toda tu información en este formulario.'); ?></p></div>
                  </div>
                  <div class="wizard-inner">
                    
                    <div class="connecting-line"></div>
                      <ul class="nav nav-tabs" role="tablist">

                          <li role="presentation">
                              <a href="/franquicias.php" aria-controls="step1" role="tab" title="<?php echo _('Información del Cliente'); ?>">
                                  <span class="round-tab">
                                      <i class="far fa-building"></i>
                                  </span>
                              </a>
                          </li>

                          <li role="presentation">
                              <a href="/franquicias.php" aria-controls="step2" role="tab" title="<?php echo _('Información del Salón'); ?>">
                                  <span class="round-tab">
                                      <i class="fas fa-user"></i>
                                  </span>
                              </a>
                          </li>
                          <li role="presentation">
                              <a href="/franquicias.php" aria-controls="step3" role="tab" title="<?php echo _('Detalle del Servicio'); ?>">
                                  <span class="round-tab">
                                      <i class="fas fa-clipboard"></i>
                                  </span>
                              </a>
                          </li>

                          <li role="presentation" class="active">
                              <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="<?php echo _('Completado'); ?>">
                                  <span class="round-tab">
                                      <i class="fas fa-check"></i>
                                  </span>
                              </a>
                          </li>
                      </ul>
                  </div>

                  <form action="/c/api.php" method="POST">
                      <div class="tab-content">
                          <div class="tab-pane active" role="tabpanel" id="complete">
                              <div class="text-center">
                                <i class="size-iconp fas fa-times"></i><br><br>
                                <h2><?php echo _('Lo sentimos, ha ocurrido un error.'); ?></h2>
                                <p class="text-center"><?php echo _('Lamentablemente, ha ocurrido un error inesperado al momento de enviar los datos, te invitamos a ingresar nuevamente los datos de la solicitud.'); ?></p>
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