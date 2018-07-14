<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
   
    $_SESSION["usuario"] = "Armando A. Lugo Salazar";
    $_SESSION["codigo"] = "ALUGO";
    $_SESSION["hash"] = "s6a5486dasdas31";
    $_SESSION["permiso"] = "50";
    
}


?>
<html>
    <a href="descargas">DESCARGAS</a>
    <br><a href="index.php">INTRANET</a>
</html>