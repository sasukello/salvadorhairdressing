<?php 

function caragaminsalon(){
  //Cargar privilegio de usuario
  //81= VERIFICAR REGION
  //85= VERIFICAR SALON
  $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=selectall&iduser=".$_SESSION["codigo"], $resulta);
  $nombrearray = json_decode($resulta, true);
     if ($error==""){
         $accesosminuta = $nombrearray;          
     }
     else
     {
         $accesosminuta = array();         
     } 

     var_dump($accesosminuta);
     return;

}


function cargarprivilegiosusuario(){
  //Cargar privilegio de usuario
  //81= VERIFICAR REGION
  //85= VERIFICAR SALON
  $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=privilegiosusuarios&iduser=".$_SESSION["codigo"], $resulta);
  $nombrearray = json_decode($resulta, true);
     if ($error==""){
         $accesosminuta = $nombrearray;          
     }
     else
     {
         $accesosminuta = array();         
     } 

     $_SESSION["accesosminuta"] = $accesosminuta;
     

}


function cargarnombresalon($idsalon){
     global $salonnombre;
     global $salonalias;
     $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "funcion=nombresalon&idsalon=".$idsalon, $resulta);
     $nombrearray = json_decode($resulta, true);
     if ($error==""){
         $salonnombre = $nombrearray[0]["NOMBRE"]; 
         $salonalias  = $nombrearray[0]["PREFIJORESPALDO"];
     }
     else
     {
         $salonnombre = $error; 
         $salonalias  = $error;
     }     
}

function cargarnombreregion($idregion){
     global $regionnombre;
     $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apilive.php?", "funcion=nombreregion&idregion=".$idregion, $resulta);
     $nombrearray = json_decode($resulta, true);
     if ($error==""){
         $regionnombre = $nombrearray[0]["DESCRIPCION"]; 
     }
     else
     {
         $regionnombre = $error; 
     }     
}


//Carga las minutas del salon
function cargarminutasalon($idsalon ){
   include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/minutaslang.php"; 
   include_once "script.php";
   $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=minutasalon&idsalon=".$idsalon."&iduser=".$_SESSION["codigo"], $resulta);


   ?>
    <input type = "hidden" name = "salones" value = "<?php echo $idsalon ?>">
    
   <?php 
   if ($error == "") {

      $registros = (array)json_decode($resulta, true); 
      datosminuta($registros, "", "salon");
      //var_dump($registros);
   }
   else

      echo "Ha ocurrido el siguiente " . $error;  
}

function cargarminutacomite(){
   include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/minutaslang.php"; 
   include_once "script.php";
   $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=minutacomite&idsalon=".$idsalon."&iduser=".$_SESSION["codigo"], $resulta);
   
   if ($error == "") {
      $registros = (array)json_decode($resulta, true); 
      datosminuta($registros, "", "comite");
   }
   else
      echo "Ha ocurrido el siguiente " . $error;  
}

//Carga las minutas de la region
function cargarminutaregion($idregion ){
   include $_SESSION["idiomaruta"].$_SESSION["idioma"]."/minutaslang.php"; 
   include_once "script.php";
   $error = hacerpost("http://gruposalvador.dyndns.org/intra/sec/apiminutas.php?", "funcion=minutaregion&idregion=".$idregion."&iduser=".$_SESSION["codigo"], $resulta);
   ?>
    <input type = "hidden" name = "regiones" value = "<?php echo $idregion ?>">
    
   <?php 
   if ($error == "") {

      $registros = (array)json_decode($resulta, true); 
      //var_dump($registros);
      datosminuta($registros, "", "region");
   }
   else

      echo "Ha ocurrido el siguiente " . $error;  
}

?>