<?php
ob_start();
$user = "";
$iduser = "";
$codUser = "";
$codPermiso = "";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION["codigo"])){
        $user = $_SESSION["usuario"];
        $iduser = $_SESSION["codigo"];
        $peruser = $_SESSION["permiso"];
        $hash = $_SESSION["hash"];
        $_SESSION['ubicacion'] = "aud";
        
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
?>
<!DOCTYPE html>
<html>
        <head>
            <title>Salvador Hairdressing - Auditorias</title>
            <?php include "../componentes/header.php"; ?>
            <script src="/intranet/componentes/js/opciones.js"></script>
        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader -->
        <div id="top"></div>

        <!-- /.parallax full screen background image -->
        <?php include "../componentes/header2.php";
                include "../sec/libfunc.php";?>
				  
                        </div>
                    </div>
                </div> 
            </div> 
        </div>

        <!-- /.feature section -->
        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">

                        <!-- /.feature title -->
                        <br><h2>Auditorias</h2>
                        <p>Selecciona la opción a consultar:</b>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- /.client section -->
        <div id="client"> 
            <div class="container">
                <div class="row">
                    <?php if(isset($_GET['r'])){
                        $r = $_GET['r'];
                        salonesCargar($iduser, $r);
                    } else { ?>
                    <div class="col-sm-12 text-center" id="regiones">
                        <?php regionCargar($iduser); ?>
                    </div> <?php }?>
                </div>
            </div>	
        </div>

        <?php include "../componentes/footer.php"; ?>
        <script src="/intranet/componentes/js/opciones.js"></script>
        <!--<script>
            window.onload = function() {
            cargando(usuario.value);
            };
        </script>!-->
    </body>

</html>
<?php ob_end_flush(); ?>