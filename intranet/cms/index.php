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
        $_SESSION['ubicacion'] = "cms";
        
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
        <title>CMS (Intranet) - Salvador Hairdressing</title>
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
                        <p><h2>Manejador de Contenidos</h2>
                        <p><i>Selecciona una sección para continuar:</i>
                    </div>
                </div>
            </div>
        </div>
          <div class="container">
              <div class="row">
                <div class="col-md-12 margen">

                  <section id="three" class="no-padding">
                        <div class="container-fluid">
                            <div class="row no-gutter">
                                <div class="col-lg-4 col-sm-6">
                                    <a href="web" class="gallery-box">
                                        <img src="../componentes/images/cms/web/main.jpg" class="img-responsive" alt="Image 1">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="ayudaset pe-7s pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption text-center">
                                        <h4>Salvador Hairdressing Web</h4>
                                    </div>
                                </div>
                                <!--<div class="col-lg-4 col-sm-6">
                                    <a href="fs" class="gallery-box">
                                        <img src="../componentes/images/cms/fs/1.jpg" class="img-responsive" alt="Image 1">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="ayudaset pe-7s pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption text-center">
                                        <h4><i>FS Magazine</i></h4>
                                    </div>
                                </div>-->
                                <div class="col-lg-4 col-sm-6">
                                    <a href="cicara" class="gallery-box">
                                        <img src="../componentes/images/cms/cicara/2.jpg" class="img-responsive" alt="Image 1">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="ayudaset pe-7s pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption text-center">
                                        <h4>Cicara Caffe</h4>
                                    </div>
                                </div>
                                <div class="clearfix hidden-lg"> </div>
                                <!--<div class="col-lg-4 col-sm-6">
                                    <a href="index-2.php" class="gallery-box">
                                        <img src="../componentes/images/news/kid.jpg" class="img-responsive" alt="Image 3">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="ayudaset pe-7s pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption text-center">
                                        <h4>Salvador Live</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="./assets/bike.jpg">
                                        <img src="../componentes/images/news/minutas2.jpg" class="img-responsive" alt="Image 4">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="ayudaset pe-7s pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption text-center">
                                        <h4>Minutas</h4>
                                    </div>
                                </div>
                                <div class="clearfix hidden-lg"> </div>
                                <div class="col-lg-4 col-sm-6">
                                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="./assets/city.jpg">
                                        <img src="../componentes/images/news/descargas2.jpg" class="img-responsive" alt="Image 5">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="ayudaset pe-7s pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption text-center">
                                        <h4>Descargas</h4>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="./assets/colors.jpg">
                                        <img src="../componentes/images/news/cc2.jpg" class="img-responsive" alt="Image 6">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="ayudaset pe-7s pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption text-center">
                                        <h4>Client Card</h4>
                                    </div>
                                </div>-->
                            </div>
                        </div>
                    </section>

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