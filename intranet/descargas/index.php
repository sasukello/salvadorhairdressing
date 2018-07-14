<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    
}
$alerta = "";
if (isset($_GET['m'])) {
    // id index exists
    $alerta = $_GET['m'];
}

if(isset($_SESSION["permiso"])){
    $permiso = $_SESSION["permiso"];
    if($permiso >= 50){
        header("location: admin/index.php");
    } else if($permiso < 50){
        header("location: cuenta/index.php");    
    }
} else{
    $alerta = 3;
}

?>
<html xmlns="http://www.w3.org/1999/xhtml"  class="no-js">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
            <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>Salvador Peluquerías - Área de Descargas</title>
                </head>
    <body>
        <?php include_once("s/analyticstracking.php"); ?>
        <div class="menuMain">
            <div class="contenedorIngreso">
                <?php
                if ($alerta == 1) {
                    echo "<div class='alertaNoExiste'>¡Bienvenido a Salvador Descargas!
                <br/>Inicia Sesión, para confirmar tus datos.</div>";
                } else if ($alerta == 2) {
                    echo "<div class='alertaNoExiste'>Hubo un error :(<br>Intenta ingresar a tu cuenta de nuevo.</div>";
                } else if ($alerta == 3){
                    echo "<div class='alertaNoExiste'>La contraseña ingresada no coincide con nuestros registros.</div>";
                }
                ?>
                <div class="textoIngreso">
                    <div id="activaMain">

                        <?php echo "Nombre: ".$_SESSION['usuario']."";
                        echo "<br>Codigo: ".$_SESSION['codigo']."";
                        echo "<br>Hash: ".$_SESSION['hash']."";
                        echo "<br>Permiso: ".$_SESSION['permiso']."";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php ob_end_flush();?>