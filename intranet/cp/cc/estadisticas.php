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
        $_SESSION['ubicacion'] = "default";
        
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

if(isset($_GET["o"])){
    if($_GET["o"] == base64_encode('est1')){
        $opcion = 1;
    } else {$opcion = 0;}
} else {$opcion = 0;}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Salvador Hairdressing - Intranet: Panel de Control</title>
        <?php include "../../componentes/header.php"; ?>
        <link href="/intranet/cp/componentes/estilos.css" rel="stylesheet">
    </head>

    <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader
        <div id="preloader"></div> -->
        <div id="top"></div>

        <?php include "../../componentes/header2.php"; ?>

                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <?php if($opcion == 0){?>
        <div id="feature">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">

                        <!-- /.feature title -->
                        <h2>ClientCard</h2>
                        <p>Opciones Disponibles:</p>
                    </div>
                </div>
                <div class="row row-feat">
                    <div class="col-md-4 text-center">

                        <!-- /.feature image -->
                        <div class="feature-img">
                            <img src="/intranet/componentes/images/cc-mini.png" alt="image" class="img-responsive wow fadeInLeft">
                        </div>
                    </div>

                    <div class="col-md-8">

                        <!-- /.feature 1 -->
                        <div class="col-sm-6 feat-list">
                            <i class="pe-7s-notebook pe-5x pe-va wow fadeInUp"></i>
                            <div class="inner">
                                <a href="<?php echo "?o=".base64_encode('est1');?>"><h4>Reporte: General</h4></a>
                                <p>.</p>
                            </div>
                        </div>

                        <!-- /.feature 2 
                        <div class="col-sm-6 feat-list">
                            <i class="pe-7s-cash pe-5x pe-va wow fadeInUp" data-wow-delay="0.2s"></i>
                            <div class="inner">
                                <h4>App Monetization</h4>
                                <p>Content builds relationships. Relationships are built on trust. Trust drives revenue. - Andrew Davis</p>
                            </div>
                        </div>-->

                        <!-- /.feature 3 
                        <div class="col-sm-6 feat-list">
                            <i class="pe-7s-cart pe-5x pe-va wow fadeInUp" data-wow-delay="0.4s"></i>
                            <div class="inner">
                                <h4>Store Optimization</h4>
                                <p>Never doubt a small group of thoughtful, committed people can change the world. Indeed, it is the only thing that ever has.</p>
                            </div>
                        </div>-->

                        <!-- /.feature 4
                        <div class="col-sm-6 feat-list">
                            <i class="pe-7s-users pe-5x pe-va wow fadeInUp" data-wow-delay="0.6s"></i>
                            <div class="inner">
                                <h4>User Management</h4>
                                <p>Instead of using technology to automate processes, think about using technology to enhance human interaction.</p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>



        <!-- /.download section -->
        <div id="download">
            <div class="action fullscreen parallax" style="background-image:url('images/bg.jpg');" data-img-width="2000" data-img-height="1333" data-diff="100">
                <div class="overlay">
                    <div class="container">
                        <div class="col-md-8 col-md-offset-2 col-sm-12 text-center">

                            <!-- /.download title -->
                            <h2 class="wow fadeInRight">Would like to know more?</h2>
                            <p class="download-text wow fadeInLeft">We'll research the market, identify the right target audience, analyze competitors and avoid users churn to increase retention. Download now for free and join with thousands happy clients.</p>

                            <!-- /.download button -->
                            <div class="download-cta wow fadeInLeft">
                                <a href="#contact" class="btn-secondary">Get Connected</a>
                            </div>
                        </div>	
                    </div>	
                </div>
            </div>
        </div>

        

        <!-- /.client section -->
        <div id="client"> 
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img alt="client" src="images/client1.png" class="wow fadeInUp">
                        <img alt="client" src="images/client2.png" class="wow fadeInUp" data-wow-delay="0.2s">
                        <img alt="client" src="images/client3.png" class="wow fadeInUp" data-wow-delay="0.4s">
                        <img alt="client" src="images/client4.png" class="wow fadeInUp" data-wow-delay="0.6s">
                    </div>
                </div>
            </div>	
        </div>
        <?php } else if($opcion == 1){ ?>

        <div id="feature">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">

                        <!-- /.feature title -->
                        <h2>ClientCard</h2>
                        <p>Reporte: General</p>
                    </div>
                </div>
                </div>
                
                <div class="row row-feat">
                    <div class="col-md-4 text-center">

                        <!-- /.feature image -->
                        <div class="feature-img">
                            <img src="/intranet/componentes/images/cc-mini.png" alt="image" id="imagenCenter" class="img-responsive wow fadeInLeft">
                        </div>
                    </div>

                    <div class="col-md-8">

                        <!-- /.feature 1 -->
                        

                    </div>
                </div>
            </div>
        
        <!-- /.footer -->
        <?php } include "../../componentes/footer.php"; ?>  
    </body>
</html>
<?php ob_end_flush(); ?>