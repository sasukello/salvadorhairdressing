<?php
//***************************************************
//********  FUNCION API PARA LA CONSULTA DE DATOS ***
//********  DEL MODULO DE  MINUTAS                ***
//*************************************************** 
//Recibe las variables por POST   
function urlsafe_b64decode($string) {
    $data = str_replace(array('-','_','.'),array('+','/','='),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     
       if(!isset($_POST["funcion"])){ 
          echo "Error No hay llamada a la funcion"; //Por seguridad no indicar cual var falta
       }
       else {
        $funcion = $_POST["funcion"];    
       }
     
   }
   else {
    echo "Error Pagina llamada incorrectamente"; //Por seguridad no indicar cual var falta
     exit;
   }
  
   
   //Verifica la funcion que se ejecutara
   switch ($funcion) {    
    case 'buscardirectorio':
       if(!isset($_POST["semilla"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $semilla = $_POST["semilla"];    
        }

        if(!isset($_POST["iduser"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $iduser = $_POST["iduser"];    
        }
        
        buscardirectorio($iduser, $semilla);
        break;
    default:
        echo "Error funcion api no definida"; //Por seguridad no indicar cual var falta
        exit;
   }

//********************************
//*** BUSCARDIRECTORIO         ***
//********************************
function buscardirectorio($iduser, $semilla){
  require_once "libcon.php";        

        $con = Conectarfb();
        $sql = "";
        $result = ibase_query($con, $sql);
        $data = ibase_fetch_assoc($result);
        echo json_encode($data);
}


?>