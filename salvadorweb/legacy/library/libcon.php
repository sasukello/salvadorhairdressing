<?php
  function conex2() {
  	// Create connection
    $link = mysqli_connect('localhost', 'root', '', 'sopor907_cp');
    // Check connection
    return $link;
  }

    function conex() {
  	// Create connection
    $link = mysqli_connect('www.salvadorpeluquerias.com', 'sopor907', 'H@Th9r9R5VH9', 'sopor907_cp');
    if (!$link) {
           //header('location: /mysteryshopper/index.php');
            return $link;
        }
    // Check connection
    return $link;
  }

  class Conexion{ 
   public $bd;
     public function __construct(){
         try {
             $this->bd= new PDO("mysql:host=localhost; dbname=sopor907_cp", "sopor907", "H@Th9r9R5VH9");
             $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);           
         } catch(PDOException $e){
             echo "Error en la linea: " . $e->getline();
         } 
     } // --> fin del contructor
  }  // --> fin de la clase Conexion
?>