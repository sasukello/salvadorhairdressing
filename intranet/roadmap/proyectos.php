<?php
include "../sec/seguro.php";
$_SESSION["ubicacion"] = "default";
$_SESSION["calendar_live"] = 1;
$arrayMenu = unserialize($_SESSION["accesos"]);

include "../sec/libfunc.php";


?>

<!DOCTYPE html>
<html>
        <head>
        <title>Salvador Hairdressing - Intranet</title>
        <?php include "../componentes/header.php"; ?>
        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader 
        <div id="preloader"></div>-->
        <div id="top"></div>

        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); 
           // include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php"); ?>

                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <!-- /.seccion principal -->
        <div class="container">
          <h3 class="titl">Todos los Proyectos</h3>
          <div class="row">
              <!--Nueva Franquicia-->
              <div class="col-md-6">
                  <div class="panel panel-primary">
                      <div class="panel-heading2 clickable">
                          <h1 class="panel-title" style="font-size: 18px;">Nueva Franquicia</h1>
                          <span class="pull-right" style="padding-right: 10px;"><i class="pe-7s-plus"></i></span>
                      </div>
                      <div class="panel-body" style="border: 1px solid #428bca">          
                          <div class="panel box-v6">
                            <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="MG"></span><span data-letters="EC"></span>
                                      <h4>Nombre del Proyecto 1</h4>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> 70 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                             <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="MG"></span><span data-letters="EC"></span><span data-letters="AL"></span>
                                      <h4>Nombre del Proyecto 2</h4>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:56%"> 56 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>

              <!--Proyecto Sistemas-->
              <div class="col-md-6">
                  <div class="panel panel-primary">
                      <div class="panel-heading2 clickable">
                          <h2 class="panel-title" style="font-size: 18px;">
                              Proyecto Sistemas</h2>
                          <span class="pull-right" style="padding-right: 10px;"><i class="pe-7s-plus"></i></span>
                      </div>
                      <div class="panel-body" style="border: 1px solid #428bca">  
                          <div class="panel box-v6">
                            <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="AL"></span><span data-letters="EC"></span><span data-letters="MC"></span><span data-letters="EJ"></span>
                                      <h4>Nombre del Proyecto 1</h4>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:14%"> 14 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                             <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="MG"></span><span data-letters="EC"></span>
                                      <h4>Nombre del Proyecto 2</h4>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:92%"> 92 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                             <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="MG"></span><span data-letters="EC"></span>
                                      <h4>Nombre del Proyecto 3</h4>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:42%"> 42 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
           
          <div class="row">
              <!--Nueva Franquicia-->
              <div class="col-md-6">
                  <div class="panel panel-primary">
                      <div class="panel-heading2 clickable">
                          <h2 class="panel-title" style="font-size: 18px;">
                              Categoría 3</h2>
                          <span class="pull-right" style="padding-right: 10px;"><i class="pe-7s-plus"></i></span>
                      </div>
                      <div class="panel-body" style="border: 1px solid #428bca">      
                          <div class="panel box-v6">
                            <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="MG"></span><span data-letters="EC"></span><span data-letters="AL"></span>
                                      <h4>Nombre del Proyecto 1</h4>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:56%"> 56 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                             <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="AL"></span><span data-letters="EC"></span><span data-letters="MC"></span><span data-letters="EJ"></span>
                                      <h4>Nombre del Proyecto 2</h4>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:14%"> 14 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>

              <!--Proyecto Sistemas-->
              <div class="col-md-6">
                  <div class="panel panel-primary">
                      <div class="panel-heading2 clickable">
                          <h2 class="panel-title" style="font-size: 18px;">
                              Categoría 4</h2>
                          <span class="pull-right" style="padding-right: 10px;"><i class="pe-7s-plus"></i></span>
                      </div>
                      <div class="panel-body" style="border: 1px solid #428bca">
                          <div class="panel box-v6">
                            <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="MG"></span><span data-letters="EC"></span>
                                      <h4>Nombre del Proyecto 1</h4>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%;"> 70 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                             <div class="col-md-12 padding-0 pad" style="height:127px;">
                                <div class="col-md-12 col-sm-12 box-v6-content-bg pad" data-progress="100%"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12 padding-0 box-v6-content pad">
                                  <div class="col-md-7 col-sm-7 col-xs-7">
                                    <span data-letters="MG"></span><span data-letters="EC"></span><span data-letters="AL"></span>
                                      <h4>Nombre del Proyecto 2</h4>
                                  </div>
                                  <div class="col-md-5 col-sm-5 text-center box-v6-progress">
                                    <div class="progress">
                                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:56%"> 56 % Completo
                                      </div>
                                    </div>
                                    <p style="font-size: 14px;">Última Modificación: 14/09/2017</p>
                                  </div>
                                </div>
                            </div>
                        </div>
                      </div>
                  </div>
              </div>
        </div>

        <div class="text-right"><button class="btn btn-info" onclick="goBack()">Regresar</button></div>


        <?php include "../componentes/footer.php"; ?>
    </body>
</html>
<?php ob_end_flush(); ?>

<script type="text/javascript">
$(document).on('click', '.panel-heading span.clickable', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('pe-7s-less').addClass('pe-7s-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('pe-7s-plus').addClass('pe-7s-less');
    }
});
$(document).on('click', '.panel div.clickable', function (e) {
    var $this = $(this);
    if (!$this.hasClass('panel-collapsed')) {
        $this.parents('.panel').find('.panel-body').slideUp();
        $this.addClass('panel-collapsed');
        $this.find('i').removeClass('pe-7s-less').addClass('pe-7s-plus');
    } else {
        $this.parents('.panel').find('.panel-body').slideDown();
        $this.removeClass('panel-collapsed');
        $this.find('i').removeClass('pe-7s-plus').addClass('pe-7s-less');
    }
});
$(document).ready(function () {
    $('.panel-heading span.clickable').click();
    $('.panel div.clickable').click();
});
</script>

<!--GoBack-->
<script>
function goBack() {
    window.history.back();
}
</script>
<!---->