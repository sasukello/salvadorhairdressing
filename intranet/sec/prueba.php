<?php


function urlsafe_b64decode($string) {
    $data = str_replace(array('-','_','.'),array('+','/','='),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
}

function microtime_float()
{
list($useg, $seg) = explode(" ", microtime());
return ((float)$useg + (float)$seg);
}

   require_once "armarconsulta.php";
   require_once "libfunc.php";
   


   $tiempo_inicio = microtime_float();
  

   $error = hacerpost("http://gruposalvador.dyndns.org/liveS10/apilivesalon.php?", "clavebd=salvasis1&consultas=".analisispromocion("T", ""), $resulta);

   echo "<br>Error " . $error;
   echo "<br>Resulta " . $resulta;

   /*if ($error == ""){

      echo $resulta;        
      $tiempo_fin = microtime_float();

      echo "Tiempo empleado: " . ($tiempo_fin - $tiempo_inicio); 
}
   else

      echo "Ha ocurrido el siguiente " . $error;*/

   

?>