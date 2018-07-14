<?php
ob_start();
$user = "";$iduser = "";$codUser = "";$codPermiso = "";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION["codigo"])){
        $user = $_SESSION["usuario"];
        $iduser = $_SESSION["codigo"];
        $peruser = $_SESSION["permiso"];
        $hash = $_SESSION["hash"];
        $arrayMenu = unserialize($_SESSION["accesos"]);
        $_SESSION['ubicacion'] = "ayuda";
        
        $codUser = base64_encode($iduser);
        $codPermiso = base64_encode($peruser);        
        
        if($hash == "s6a5486dasdas31"){
            $bandera = true;
        } else{
        header("location:../logout.php");
        }
    } else{
       header("location:../logout.php");
    }
}

include "../sec/libfunc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
}

?>
<!DOCTYPE html>
<html>
        <head>
        <title>Salvador+ Live (Intranet) - Salvador Hairdressing</title>
        <?php   include "../componentes/header.php"; ?>
        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">
        <div id="top"></div>

        <!-- /.cabecera -->
        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu);?>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">

                        <!-- /.feature title -->
                        <p><h2>Ayuda</h2>
                        <p><i>Selecciona la pregunta de tu interés</i>
                    </div>
                </div>
            </div>
        </div>
          <div class="container">
              <div class="row">
                <div class="col-md-12 margen">

                   <!-- SECTION 8 -->
			        <div class="space">
			            <div class="container">
			                <div class="row">
			                    <div class="col-md-12 space-mb">
			                        <div class="space-dark clearfix">
			                            <ul class="nav nav-tabs style5">
			                                <li role="presentation" class="active">
			                                    <a href="#tab-14" role="tab" data-toggle="tab">
			                                        <i class="icon-basic-accelerator"></i>
			                                        <span class="hidden-xs">No veo los botones de "Exportar" en los reportes</span>
			                                    </a>
			                                </li>

			                                <li role="presentation">
			                                    <a href="#tab-15" role="tab" data-toggle="tab">
			                                        <i class="icon-ecommerce-megaphone"></i>
			                                        <span class="hidden-xs">Pregunta frecuente - FAQ</span>
			                                    </a>
			                                </li>

			                                <li role="presentation">
			                                    <a href="#tab-16" role="tab" data-toggle="tab">
			                                        <i class="icon-basic-gear"></i>
			                                        <span class="hidden-xs">Pregunta frecuente - FAQ</span>
			                                    </a>
			                                </li>

			                                <li role="presentation">
			                                    <a href="#tab-17" role="tab" data-toggle="tab">
			                                        <i class="icon-basic-display"></i>
			                                        <span class="hidden-xs">Pregunta frecuente - FAQ</span>
			                                    </a>
			                                </li>

			                                <li role="presentation">
			                                    <a href="#tab-18" role="tab" data-toggle="tab">
			                                        <i class="icon-ecommerce-cart-content"></i>
			                                        <span class="hidden-xs">Pregunta frecuente - FAQ</span>
			                                    </a>
			                                </li>

			                                <li role="presentation">
			                                    <a href="#tab-19" role="tab" data-toggle="tab">
			                                        <i class="icon-arrows-keyboard-right"></i>
			                                        <span class="hidden-xs">Pregunta frecuente - FAQ</span>
			                                    </a>
			                                </li>
			                            </ul>

			                            <div class="tab-content style5">
			                                <div class="tab-pane fade active in" id="tab-14">
			                                    <h4>No veo los botones de "exportar" en los reportes</h4>
			                                    <p>
			                                    Para ver los botones de "Exportar" debes de activar el Flash en tu navegador.
			                                    <br><b>Para Google Chrome:</b>
			                                    <br>1) Haz click en el botón de información de la barra de direcciones: 
			                                    <br><img src="../componentes/images/paso-1.jpg">
			                                    <br>2) Busca y ubica la opción de "Flash". Una vez ubicado, haz click en la opción a la derecha, que usualmente se encuentra en "Predeterminado":
			                                    <br><img src="../componentes/images/paso-2.jpg">
			                                    <br>3) Una vez hecho el click, selecciona la opción "Permitir siempre este sitio". 
			                                    <br><img src="../componentes/images/paso-3.jpg">
			                                    <br>4) Verifica que la opción que se seleccionó sea la de "Permitir", y cierra este menu, al hacer click fuera de él: 
			                                    <br><img src="../componentes/images/paso-4.jpg">
			                                    <br>5) Una vez cerrado, verás un mensaje donde te pide "cargar de nuevo" la página. Una vez cargada, podrás ver los botones para exportar los listados: 
			                                    <br><img src="../componentes/images/paso-5.jpg">
			                                    </p>
			                                </div><!-- // .tab-pane .fade -->

			                                <div class="tab-pane fade" id="tab-15">
			                                    <h4>Pregunta frecuente - FAQ</h4>
			                                    <p>Ut cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis miristum nulla sed fringilla vitae orci dignissim sed laoreet egestas ligula, et facilisis enim vulputate ellus pretium.</p>
			                                    <ul class="list">
			                                        <li>Fusce imperdiet mollis quam.</li>
			                                        <li>Suspendisse porttitor sit.</li>
			                                        <li>Etiam hendrerit est sit amet sem.</li>
			                                    </ul>
			                                </div><!-- // .tab-pane .fade -->

			                                <div class="tab-pane fade" id="tab-16">
			                                    <h4>Pregunta frecuente - FAQ</h4>
			                                    <p>Ut cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis miristum nulla sed fringilla vitae orci dignissim sed laoreet egestas ligula, et facilisis enim vulputate ellus pretium.</p>
			                                    <ul class="list">
			                                        <li>Fusce imperdiet mollis quam.</li>
			                                        <li>Suspendisse porttitor sit.</li>
			                                        <li>Etiam hendrerit est sit amet sem.</li>
			                                    </ul>
			                                </div><!-- // .tab-pane .fade -->

			                                <div class="tab-pane fade" id="tab-17">
			                                    <h4>Pregunta frecuente - FAQ</h4>
			                                    <p>Ut cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis miristum nulla sed fringilla vitae orci dignissim sed laoreet egestas ligula, et facilisis enim vulputate ellus pretium.</p>
			                                    <ul class="list">
			                                        <li>Fusce imperdiet mollis quam.</li>
			                                        <li>Suspendisse porttitor sit.</li>
			                                        <li>Etiam hendrerit est sit amet sem.</li>
			                                    </ul>
			                                </div><!-- // .tab-pane .fade -->

			                                <div class="tab-pane fade" id="tab-18">
			                                    <h4>Pregunta frecuente - FAQ</h4>
			                                    <p>Ut cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis miristum nulla sed fringilla vitae orci dignissim sed laoreet egestas ligula, et facilisis enim vulputate ellus pretium.</p>
			                                    <ul class="list">
			                                        <li>Fusce imperdiet mollis quam.</li>
			                                        <li>Suspendisse porttitor sit.</li>
			                                        <li>Etiam hendrerit est sit amet sem.</li>
			                                    </ul>
			                                </div><!-- // .tab-pane .fade -->

			                                <div class="tab-pane fade" id="tab-19">
			                                    <h4>Pregunta frecuente - FAQ</h4>
			                                    <p>Ut cursus massa at urnaaculis estie. Sed aliquamellus vitae ultrs condmentum leo massa mollis estiegittis miristum nulla sed fringilla vitae orci dignissim sed laoreet egestas ligula, et facilisis enim vulputate ellus pretium.</p>
			                                    <ul class="list">
			                                        <li>Fusce imperdiet mollis quam.</li>
			                                        <li>Suspendisse porttitor sit.</li>
			                                        <li>Etiam hendrerit est sit amet sem.</li>
			                                    </ul>
			                                </div><!-- // .tab-pane .fade -->

			                            </div><!-- // .tab-content -->
			                        </div>
			                    </div>
			                </div>
			            </div>
			        </div>


                </div>    
              </div>
          </div>
                </div>
            </div>	
        </div>

        <?php include "../componentes/footer.php"; ?>  
    </body>
</html>
<?php ob_end_flush(); ?>