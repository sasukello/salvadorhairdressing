<?php

/*
 * ARCHIVOS DE CONEXION FIREBIRD/ MYSQL
 */

function Conectarfb() {
    global $pssw;
    $pssw = "salvasis1";
    $conn = ibase_connect("server:d:\\CorporativoPlus\\nuevo.FDB", "SYSDBA", $pssw);
    if (!$conn) {
        alertaError();
        return null;
    }
    return $conn;
}

function dbconn() {
// Create connection
$link = mysqli_connect('www.salvadorpeluquerias.com', 'sopor907_admin', 'salvaAdmin2', 'sopor907_cp');
// Check connection
if (!$link) {
        alertaError();
       header('location: /mysteryshopper/index.php');
        //return null;
    }
return $link;
}

function dbconncc() {
// Create connection
$link = mysqli_connect('www.salvadorpeluquerias.com', 'sopor907_cc', 'salvasis1', 'sopor907_clientcard');
// Check connection
return $link;
}

function alertaError() {
    echo "Tiempo de espera excedido.";
}
?>