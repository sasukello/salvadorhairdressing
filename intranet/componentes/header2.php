<?php

include 'header2menu.php';

if(isset($iduser)){
    $usuario = $iduser;
} else if(isset($cod)){
    $usuario = $cod;
}


?>

<div class="fullscreen landing parallax" style="background-image:url('/intranet/componentes/images/bg/miniheader.jpg');background-repeat: no-repeat;height:175px;" data-img-width="2000" data-img-height="1333" data-diff="100">
            <div class="overlay">
                <div class="container">
                    <div class="row">
                         <div class="col-md-7">

                     
                         <!-- /.logo -->
                         <div class="logo wow fadeInDown"> <a href=""><img src="/intranet/componentes/images/s-white.png" alt="logo"></a>

                         <!-- /.main title-->
                            <h1 class="wow fadeInLeft" style="float: right;margin:0px;">
                                Intranet
                            </h1> 
                         </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <!-- NAVIGATION -->
        <div id="menu">
            <nav class="navbar-wrapper navbar-default" role="navigation">
                <div id="activo" style="float:left;position: absolute;width:20%;">
                    <ul class="nav navbar-nav" style="margin-top: 0px;">
                            <li><a href="#">Usuario: <?php echo $usuario; ?> </a></li>
                        </ul>
                </div>
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-backyard">
                            <span class="sr-only">Intranet</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!--<a class="navbar-brand site-name" href="#top"><img src="images/salvador-logo-wh.jpg" alt="logo"></a>-->
                    </div>
                    <?php if(isset($_SESSION['ubicacion'])){
                        $ubi = $_SESSION['ubicacion'];
                        menuheader($ubi);
                    } else if(!isset($_SESSION['ubicacion'])){
                        $ubi = "default";
                        menuheader($ubi);
                    }?>
                </div>
            </nav>
        </div>