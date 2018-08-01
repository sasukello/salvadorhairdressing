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
    if (isset($_POST['submitSalon'])) {
        $salon = $_POST["salones"];
        $msgError = datossalon($salon);
        if ($msgError == "") {
           //Conecto correctamente a salon  
           menuLiveCargar($iduser, $salon);
        } 
    }
    elseif (isset($_POST['ponerTicket'])) {        
        
        //Hacer el post con hacer post a apilive para poner el ticket
        $resulta = "";
        $msgError = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "usuario=".$_SESSION['codigo']."&clave=salvasis1&funcion=ponerticket&detallecaso=Configurar%20ruta%20live%20a%20".$_POST['codigosalon']."%20Recuerden redireccionar el puerto 80", $resulta);
        if ($msgError == ""){
           $msgError = "Ticket de servicio colocado";
        } else {
           $msgError = "No se pudo colocar el ticket de servicio ".$msgError; 
        }
    } //Caso de poner ticket
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
        <?php menu1HeaderIntranet($iduser, $_SESSION['ubicacion'], $arrayMenu); 
        ?>
        
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
                        <p><i>Selecciona la opción a consultar:</i>
                    </div>
                </div>
            </div>
        </div>
        <div id="client"> 
            <div class="container">
                <div class="row">
                    <?php 
                       if (isset($msgError)){ if($msgError != ""){
                           echo $msgError;
                       }}
                       else if(isset($_GET['r'])){
                        $r = $_GET['r'];
                        echo "<div class='alert alert-warning text-center' style='color:#777;font-weight:400;'>Esta conexión depende del internet del salón seleccionado. Ayúdanos a mejorar.</div><br>";
                        salonesCargarIntra1($iduser, $r);
                    } else { ?>
                    <div class="col-sm-12 text-center" id="regiones">
                        <?php regionCargar($iduser); ?>
                    </div> <?php }?>
                </div>
            </div>	
        </div>

        <?php include "../componentes/footer.php"; ?>  
        <script src="/intranet/componentes/js/opciones.js"></script>
    </body>
</html>
<?php ob_end_flush(); ?>