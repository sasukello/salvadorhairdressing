<?php
error_reporting(1);

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
    $link = mysqli_connect('www.salvadorhairdressing.com', 'sopor907_admin', 'salvaAdmin2', 'sopor907_cp');
    // Check connection
    if (!$link) {
           //header('location: /mysteryshopper/index.php');
       // alert("ERROR");
            return $link;
        }
    return $link;
    }
    
   /*function dbconncc() {
  	// Create connection
    $link = mysqli_connect('www.salvadorhairdressing.com', 'sopor907_cc', 'salvasis1', 'sopor907_clientcard');
    if (!$link) {
      //header('location: /mysteryshopper/index.php');
      // alert("ERROR");
      die("Error al conectarse");
    }
    // Check connection
    return $link;
  }*/

     function dbconncc() {
    // Create connection
    $link = mysqli_connect('localhost', 'root', '', 'sopor907_clientcard');
    // Check connection
    return $link;
  }

   function dbconnlocal() {
    // Create connection
    $link = mysqli_connect('localhost', 'root', '', 'sopor907_cp');
    // Check connection
    return $link;
  }

  class Db { 
    private $mysql; 
      
    function __construct() { 
        $this->mysql = new mysqli('localhost', 'root', '', 'sopor907_cp') or die('problem'); 
    } 
}

?>