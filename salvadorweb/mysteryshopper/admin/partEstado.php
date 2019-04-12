<?php

    include '../etc/modals.php';

    if (isset($_GET['a'])) {
        $iden = $_GET['a'];
        $id = base64_decode($iden);
        //echo "RESUMEN DEL PARTICIPANTE #000" . $id . "<BR>";
        partAprobarPend($id);
    } else if (isset($_GET['r'])) {
        $iden = $_GET['r'];
        $id = base64_decode($iden);
        //echo "RESUMEN DEL PARTICIPANTE #000" . $id . "<BR>";
        partRechazarPend($id);       
    } else if(isset($_GET['mail'])){
        if($_GET['t'] == 1){
            $id = base64_decode($_GET['mail']);
            partAprobarCorreo($id, 1);
        } else if ($_GET['t'] == 2){
            $id = base64_decode($_GET['mail']);
            partAprobarCorreo($id, 2);
        } else{
            echo "ACCESO RESTRINGIDO!";
        }
    }
    ?>