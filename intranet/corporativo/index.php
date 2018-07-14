<?php
include "../sec/seguro.php";
$_SESSION["ubicacion"] = "default";
$_SESSION["calendar_live"] = 1;
$_SESSION["tabla_basica"] = 1;
$arrayMenu = unserialize($_SESSION["accesos"]);
$code64 = base64_encode($iduser);

include "../sec/libfunc.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
}
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
             ?>

                        </div>
                    </div>
                </div> 
            </div> 
        </div>
        
        <!-- /.seccion principal -->
        <div id="main">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title">
                        <!-- / titulo -->
                        <br><h2>Corporativo</h2>
                        <p>Operaciones para el Corporativo Salvador C.A.</p>
                    </div>
                </div>
                <div class="row row-feat">
                    <!-- /.CONTENIDO PRINCIPAL -->
                    <div class="col-md-12">
                    <a href="admin/" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Administración</a>
                    <a href="rrhh/" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Talento Humano</a>

                    </div>
                </div>
            </div>
                    
                  
        

        
        </div></div>

        <?php include "../componentes/footer.php"; ?>
        


    </body>
</html>
<?php ob_end_flush(); ?>