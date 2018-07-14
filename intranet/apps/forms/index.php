<?php
include "../../sec/seguro.php";
$_SESSION["ubicacion"] = "default";
$_SESSION["calendar_live"] = 1;
$_SESSION["tabla_basica"] = 1;
$arrayMenu = unserialize($_SESSION["accesos"]);
$code64 = base64_encode($iduser);

include "../../sec/libfunc.php";
include "../../sec/forms.php";
include "../../cms/library/common.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET["ide"]) && !empty($_GET["ide"])){
        $idencuesta = $_GET["ide"];
    }
} else if($_SERVER["REQUEST_METHOD"] == "POST"){
    //var_dump($_POST);
    if(isset($_POST["enviarFormFranq"])){
        $idencuesta = htmlspecialchars($_GET["ide"]);
        $respuestas = htmlspecialchars($_POST);
        unset($_POST['enviarFormFranq']);
        $codigo = json_encode($_POST);
        $save = saveEncuestaResult($codigo, $idencuesta, $iduser);
    }    
}

?>

<!DOCTYPE html>
<html>
        <head>
        <title>Salvador Hairdressing - Intranet: CRM - Encuestas</title>
        <?php include "../../componentes/header.php"; ?>
        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader 
        <div id="preloader"></div>-->
        <div id="top"></div>

        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); 
            include ($_SESSION["idiomaruta"].$_SESSION["idioma"]."/crm.php"); ?>

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
                        <?php if(isset($save)){echo $save;} ?>
                        <!-- / titulo -->
                        <h2>CRM: Encuestas</h2>
                        <p>Encuesta #<?php echo $idencuesta;?>: </p>
                    </div>
                </div>
                <div class="row">
                    <!-- /.CONTENIDO PRINCIPAL -->
                    <div class="col-md-12">
                        <a href="/intranet/apps/"><button type="button" class="btn-default">Volver a CRM</button></a>
                    </div>

                    <div class="col-md-12">
                        
                        <?php echo encuestaInit($idencuesta, $iduser); ?>

                    </div>
                </div>
            </div>
        </div>

        <?php include "../../componentes/footer.php"; ?>
        <script src="/intranet/componentes/js/apps.js"></script>
        <script src="/intranet/componentes/js/bootstrap-suggest.js"></script>

    </body>
</html>
<?php ob_end_flush(); ?>