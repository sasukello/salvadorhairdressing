<?php
$user = "";$iduser = "";$codUser = "";$codPermiso = "";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION["codigo"])){
        $user = $_SESSION["usuario"];
        $iduser = $_SESSION["codigo"];
        $peruser = $_SESSION["permiso"];
        $hash = $_SESSION["hash"];
        $arrayMenu = unserialize($_SESSION["accesos"]);
        $_SESSION['ubicacion'] = "cms";
        
        $codUser = base64_encode($iduser);
        $codPermiso = base64_encode($peruser);        
        
        if($hash == "s6a5486dasdas31"){
            $bandera = true;
        } else{
        header("location:../../logout.php");
        }
    } else{
       header("location:../../logout.php");
    }
}

include "../../sec/libfunc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["savefaqbtn"])){
        $dato = $_POST["savefaqbtn"];
    }
} else if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["m"])){
        $msg = $_GET["m"];
        switch ($msg) {
            case 'success':
                $display = "<div class='alert alert-success'><strong>¡Información Añadida Éxitosamente!</strong></div>";
                break;
            case 'error':
                $display = "<div class='alert alert-danger'><strong>Hubo un error al guardar la información.</strong> Intenta de nuevo.</div>";
                break;
            
            default:
                # code...
                break;
        }
    }
} 

?>
<!DOCTYPE html>
<html>
        <head>
        <title>Cicara Caffe - CMS (Intranet) - Salvador Hairdressing</title>
        <?php   include "../../componentes/header.php"; ?>
        <link href="/intranet/componentes/css/cms.css" rel="stylesheet" media="screen">
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
                        <p><h2>Manejador de Contenidos</h2></p>
                        <p><h3>Cicara Caffe</h3></p>
                    </div>
                </div>
            </div>
        </div>
          <div class="container">
            <?php if(isset($msg)){
                echo "<div class='row text-center'>".$display."</div>";
            }?>
            
              <div class="row">
                <div class="col-md-12 margen">

                  <section id="three" class="no-padding">
                        <div class="container-fluid">
                            <div class="row no-gutter">
                                <div class="col-lg-4 col-sm-6">
                                    <a href="#cms" class="gallery-box" data-toggle="modal" data-tipo="stopgo">
                                        <img src="../../componentes/images/cms/cicara/2.jpg" class="img-responsive" alt="Image 1">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="ayudaset pe-7s pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption text-center">
                                        <h4>Stop & Go</h4>
                                    </div>
                                </div>
                                <div class="clearfix hidden-lg"> </div>
                            </div>
                        </div>
                    </section>

                </div>    
              </div>
          </div>
                </div>
            </div>	
        </div>

        <div id="cms" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="titulocms"></h4>
              </div>
              <div class="modal-body" id="bodycms">
                <p>Cargando...</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
            </div>

          </div>
        </div>

        <?php include "../../componentes/footer.php"; ?>  
        <script src="/intranet/componentes/js/cms.js"></script>




    </body>
</html>