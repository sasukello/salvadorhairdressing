<?php

    function Conectarfb() {
        global $pssw;
        $pssw = "salvasis1";
        $conn = ibase_connect("server:d:\\CorporativoPlus\\nuevo.FDB", "SYSDBA", $pssw);
        if (!$conn) {
            $result = array(    'codigoerror'       => 'Server#0001',
                                'mensajeerror'      => 'Error de conexión: '.ibase_errmsg().' '
                            ); 
            return $result;
        }
        return $conn;
    }

     function ConectarfbRespaldo() {
        global $pssw;
        $pssw = "salvasis1";
        $conn = ibase_connect("server:d:\\salvadorplus\\salvadorexpress\\salvador.fdb", "SYSDBA", $pssw);
        if (!$conn) {
            return "Hubo un error.";
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

    function dbconn2() {
  	// Create connection
    $link = mysqli_connect('localhost', 'root', '', 'salvador');
    // Check connection
    return $link;
    }
?>