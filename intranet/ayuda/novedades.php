<?php
ob_start();
$user = "";$iduser = "";$codUser = "";$codPermiso = "";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION["codigo"])){
    $user = $_SESSION["usuario"];
    $iduser = $_SESSION["codigo"];
    $peruser = $_SESSION["permiso"];
    $hash = $_SESSION["hash"];
    $arrayMenu = unserialize($_SESSION["accesos"]);
    $_SESSION["ubicacion"] = "ayuda";
    
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

include "../sec/libfunc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
}

?>
<!DOCTYPE html>
<html>
        <head>
        <title>Novedades (Intranet) - Salvador Hairdressing</title>
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
                        <p><h2>Novedades</h2>
                        <p><i>Conoce las novedades de la Intranet</i>
                    </div>
                </div>
            </div>
        </div>
          <div class="container">
              <div class="row">
                <div class="col-md-12 margen">

                  <div class="col-md-4">
                    <section id="three" class="no-padding">
                        
                                <!--<div class="col-lg-6 col-sm-6">
                                    <a href="#galleryModal" class="gallery-box">
                                        <img src="../componentes/images/news/directorio2.jpg" class="img-responsive" alt="Minutas">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption">
                                        <h4>Directorio</h4>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <a href="#galleryModal" class="gallery-box">
                                        <img src="../componentes/images/news/minutas.jpg" class="img-responsive" alt="Directorio">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption">
                                        <h4>Minutas</h4>
                                    </div>
                                </div><br>
                                <div class="col-lg-6 col-sm-6">
                                    <a href="#galleryModal" class="gallery-box" onclick="mostrarNoticia(1);">
                                        <img src="../componentes/images/news/crm.jpg" class="img-responsive" alt="CRM">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="caption">
                                        <h4>CRM</h4>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="./assets/bike.jpg">
                                        <img src="../componentes/images/news/crm.jpg" class="img-responsive" alt="Image 4">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caption">
                                          <h4>Texto de Prueba</h4>
                                        </div>
                                    </a>
                                </div>
                        <div class="clearfix hidden-lg"> </div>
                                <div class="col-lg-6 col-sm-6">
                                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="./assets/city.jpg">
                                        <img src="../componentes/images/news/crm.jpg" class="img-responsive" alt="Image 5">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caption">
                                          <h4>Texto de Prueba</h4>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <a href="#galleryModal" class="gallery-box" data-toggle="modal" data-src="./assets/colors.jpg">
                                        <img src="../componentes/images/news/crm.jpg" class="img-responsive" alt="Image 6">
                                        <div class="gallery-box-caption">
                                            <div class="gallery-box-content">
                                                <div>
                                                    <i class="pe-7s-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caption">
                                          <h4>Texto de Prueba</h4>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>-->
                    </section>
                  </div>

                    <div class="col-md-8">
                        <div class="panel panel-primary">
                            <span id="result-news"></span>
                        </div>
                    </div>

                </div>    
              </div>
          </div>
                </div>
            </div>	
        </div>

        <?php include "../componentes/footer.php"; ?>  
        <script>
            $(document).ready(function() {
                 cargaTodasNoticias(<?php echo '"'.$codPermiso.'"'; ?>);
            });
        </script>


    </body>
</html>
<?php ob_end_flush(); ?>