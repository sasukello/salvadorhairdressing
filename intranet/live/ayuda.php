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
        $_SESSION['ubicacion'] = "live";
        
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
                        <p><h2>SalvadorPlus Live</h2>
                        <p><i>Ayuda / FAQ:</i>
                    </div>
                </div>
            </div>
        </div>
            <div class="container">
                <div class="row">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                              Salvador+ Live</a>
                            </h4>
                          </div>
                          <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <div class="panel-group">
                                    <div class="panel panel-primary">
                                      <div class="panel-heading">- No veo los botones de "Exportar" en los Reportes</div>
                                      <div class="panel-body">Para ver los botones de "Exportar" debes de activar el Flash en tu navegador.<br><br><b><i>Para Google Chrome</i></b>:
                                      <br><br>1) Haz click en el botón de información de la barra de direcciones:
                                      <br><img src="/intranet/componentes/images/paso-1.jpg" width="auto" height="auto" class="image-responsive">
                                      <br><br>2) Busca y ubica la opción de "Flash". Una vez ubicado, haz click en la opción a la derecha, que usualmente se encuentra en "Predeterminado":
                                      <br><img src="/intranet/componentes/images/paso-2.jpg" width="auto" height="auto" class="image-responsive">
                                      <br><br>3) Una vez hecho el click, selecciona la opción "Permitir siempre este sitio".
                                      <br><img src="/intranet/componentes/images/paso-3.jpg" width="auto" height="auto" class="image-responsive">
                                      <br><br>4) Verifica que la opción que se seleccionó sea la de "Permitir", y cierra este menu, al hacer click fuera de él:
                                      <br><img src="/intranet/componentes/images/paso-4.jpg" width="auto" height="auto" class="image-responsive">
                                      <br><br>5) Una vez cerrado, verás un mensaje donde te pide "cargar de nuevo" la página. Una vez cargada, podrás ver los botones para exportar los listados:
                                      <br><img src="/intranet/componentes/images/paso-5.jpg" width="auto" height="auto" class="image-responsive">
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
        </div>

        <?php include "../componentes/footer.php"; ?>  
    </body>
</html>
<?php ob_end_flush(); ?>