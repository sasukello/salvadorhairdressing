<?php
require_once "config.php";

function urlsafe_b64decode($string) {
    $data = str_replace(array('-','_','.'),array('+','/','='),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}


//Recibe las variables por POST   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  
       if(!isset($_POST["clavebd"])){ 
          echo "Error No se especifico la clave de la BD"; //Por seguridad no indicar cual var falta
          exit;
       }
       else {
	      $clavebd = $_POST["clavebd"];
              if(!isset($_POST["consultas"])){
                  echo "Error Falta Consultas"; //Por seguridad no indicar cual var falta  
                  exit;
                }
                else {                                          
                      $consultas = unserialize(urlsafe_b64decode($_POST["consultas"]));	
                      
                }


                funcionbase($consultas);
       }
       
	   
   }
   else {
    echo "Error Pagina llamada incorrectamente"; //Por seguridad no indicar cual var falta
	   exit;
   }
   
   function Conectarfb() {
       global $clavebd;
        $conn = ibase_connect(rutabd(), "SYSDBA", $clavebd, "ISO8859_1");
        if (!$conn) {
            return null;
        }
        return $conn;
    }

//********************************
//*** VALIDACION DE INICIO DE SESION     ***
//********************************
function funcionbase($consultas){
        //conecta con la bd 
        $con = Conectarfb();
        
        if (!$con){
                echo "Error No se realizo la conexion con la bd";
        }
        $j=0;
        $resultado = array();
        foreach ($consultas as $sql) {
            
            //echo $sql;
            
            $result = ibase_query($con, $sql);
            if (!$result){
               die('Error ' . ibase_errmsg());
               exit;
            }
            
            $data = array();
            $i = 0;

            while ($row = ibase_fetch_assoc($result)) {              
              $data[$i] = $row;
              $i++;
            }
             
            
            $resultado[$j] = $data; 
            $j++;
            ibase_free_result($result);


            
        }        

        array_walk_recursive($resultado, function(&$value, $key) {
            if (is_string($value)) {
               $value = iconv('windows-1252', 'utf-8', $value);
            }
        });

        echo json_encode($resultado);        
        //ibase_free_result($result);
        ibase_close($con);
        
} //funcion venta total


?>
