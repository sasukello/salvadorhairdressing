<?php

   ob_start();
$user = "";$iduser = "";$codUser = "";$codPermiso = "";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
    if(isset($_SESSION["codigo"])){
        $user = $_SESSION["usuario"];
        $iduser = $_SESSION["codigo"];
        $peruser = $_SESSION["permiso"];
        $hash = $_SESSION["hash"];
        $_SESSION['ubicacion'] = "live";
        $salon = $_SESSION["salon"];
        $rutabd = $_SESSION["ruta"];
        
        if($hash == "s6a5486dasdas31"){
            $bandera = true;
        } else{
        header("location:../logout.php");
        }
    } else{
       header("location:../logout.php");
    }
}


   $directory = "../lang/";
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submitIdioma'])) {
       $cargaridioma = $_POST['idioma'];
       if (isset($_POST['modulo'])) {
          $modulo=$_POST['modulo'];	
       } //Si ya viene el modulo seleccionado	
    } //Presiono el botn para buscar los lenguajes

    if (isset($_POST['grabarIdioma'])) {
       $cargaridioma = $_POST['idioma'];
       if (isset($_POST['modulo'])) {
          $modulo=$_POST['modulo']; 
       } //Si ya viene el modulo seleccionado 
       grabararchivo($directory.$cargaridioma."/".$modulo, $_POST["variables"], $_POST["valores"]);  
    } //Presiono el botn para buscar los lenguajes

    if (isset($_POST['submitNuevoModulo'])) {
         $nuevomodulo = 1;
    } //Presiono el botn para nuevo modulo

    if (isset($_POST['generarmodulo'])) {
         crearmodulo($_POST["txmodulo"], $directory);
    } //Presiono el botn para nuevo modulo

    if (isset($_POST['submitNuevoVar'])) {
         $llamarcrearvariabes = 1;
    } //Presiono el botn para generar variables

    if (isset($_POST['grabarvariables'])) {
         $llamargrabarvariabes = 1;
    } //Presiono el botn para grabar variables


   }//Si viene por un post

   function grabarvariables($ruta, $post){
       //Recorre las variables
       $idx = 0;
       foreach ($post['variables'] as $variable) {
         $variable = "$".$variable."="; 
         //busca los idiomas
         $scanned_directory = array_diff(scandir($ruta), array('..', '.'));
         $idiomas = array();
         foreach ($scanned_directory as $direct) {
           $ruta2 = $ruta . $direct;
           $variable2 = $variable.'"'.$post[$direct][$idx].'";';
           $archivo = file_get_contents($ruta2."/".$post["modulo"].".php");
           $archivo = str_replace("?>", "$variable2". PHP_EOL."?>", $archivo);
           file_put_contents($ruta2."/".$post["modulo"].".php", $archivo); 
           //echo $archivo;  
         } //recorre los idiomas

         $idx++;
        }//Recorre las variables
   }

   function crearvariables($ruta,$cntvar){


    echo '<div class="form-group">
                <label class="control-label col-sm-4" for="rango">Selecciona un Modulo para incluir estas variables:</label> 

                <div class="col-sm-6">
                    
                    <select name="modulo" class="form-control" tabindex="2" required>
                                                        <option value="">-Selecciona un Modulo-</option>';
                                                             $cargaridioma="esp";
                                                             $scanned_directory = array_diff(scandir($ruta.$cargaridioma), array("..", "."));
                                                             foreach ($scanned_directory as $direct){
                                                                if (!(is_dir($ruta.$cargaridioma."/".$direct))) {
                                                                   $direct=substr($direct, 0, -4); 
                                                                   echo "<option value=$direct ";
                                                                      if($direct==$modulo){
                                                                        echo "selected";
                                                                      }
                                                                   echo">$direct</option>";}
                                                             }//foreach
                                                         
                                                        


echo '                    </select>

                    

                </div></div>';

      echo '<table class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th>Variable (No comenzar con $)</th>';
                  $scanned_directory = array_diff(scandir($ruta), array('..', '.'));
                  $columnas = 0;
                  $idiomas = array();
                  foreach ($scanned_directory as $direct) {
                    echo "<th>$direct</th>";
                    $idiomas[]=$direct;
                    $columnas++;
                  }
      echo '         </tr>
            </thead>
            <tbody>';
      
      $idx=1;
      while($idx <= $cntvar) { 
            echo "<tr><td><input type='text' name='variables[]' required tabindex = ".$idx."0></td>";
            $cols = 1;
            //echo "columnas $columnas";
            while ($cols <= $columnas){ 
               echo "<td><input type='text' name='".$idiomas[$cols-1]."[]' tabindex=".$idx.$cols."></td>";
               $cols++;
           }
           echo "</tr>";
           $idx++;
          }
      

      echo '</tbody></table>';
       
echo '
      <div class="col-sm-offset-4 col-sm-6">

                           <button type="submit" class="btn" name="grabarvariables">Grabar Variables</button>

                     </div>';


   }

   function crearmodulo($nombremodulo, $dir){
      //Busca los directorios de lang y genera el php en cada uno
      $scanned_directory = array_diff(scandir($dir), array('..', '.'));
      $error = 0;
      foreach ($scanned_directory as $direct){
        if (is_dir($dir.$direct)) {
            if (file_exists($dir.$direct."/".$nombremodulo.".php")===0){
                echo "archivo existe".$dir.$direct."/".$nombremodulo.".php"."<br>";
                $error++;
            } else {
                $nombrearchivo = $dir.$direct."/".$nombremodulo.".php";
                $control = fopen($nombrearchivo,"w");
                if($control == false){
                    echo("No se ha podido crear el archivo para $direct.");
                    $error++;
                } else {
                    fwrite($control, "<?php".PHP_EOL);
                    fwrite($control, "?>".PHP_EOL);
                    fclose($control);
                }
                
            }    
        }                                                       
      }//foreach
      if ($error==0){
         header("location:lang.php");        
      }
   };

   function grabararchivo($ruta, $vars, $values){
       //Recorre los valores
       $i=0;
       $fp = fopen($ruta.".php", "w");
       fwrite($fp, "<?php". PHP_EOL);
       foreach ($vars as $varia) {
           fwrite($fp, $varia.'="'.$values[$i].'";'. PHP_EOL);
           $i++;
       }
       fwrite($fp, "?>". PHP_EOL);
       fclose($fp);

       header("location:lang.php");
       
   } //graba el archivo de traduccion

   function cargararchivoidioma($ruta){

      $fp = fopen($ruta.".php", "r");
      echo '<table class="table table-     striped table-bordered" cellspacing="0" width="100%">
            <thead>
               <tr>
                  <th>Variable</th>
                <th>Valor</th>
               </tr>
            </thead>
            <tbody>';
      fgets($fp);
      $idx=1;
      while(!feof($fp)) {
         $linea = fgets($fp);
         if (strpos($linea, "?>") == 0){
           if (trim($linea)!="") { 
            echo "<tr>
            <td><input type='hidden' name='variables[]' value = '".substr($linea, 0, strpos($linea, "="))."'>".substr($linea, 0, strpos($linea, "="))."</td>
            <td><input type='text' name='valores[]' value='".str_replace(";", "", str_replace("\"", "", substr($linea, strpos($linea, "=") + 1, strpos($linea, ";"))))."' required tabindex=$idx></td>
           </tr>";
           $idx++;
          }}
      }

      echo '</tbody></table>';
      fclose($fp);

   }

?>
<!--
***************  CARGA LA PAGINA PRINCIPAL DEL TRADUCTOR ***************************
-->

<!DOCTYPE html>
<html>
        <head>
        <title>Traductor (Intranet) - Salvador Hairdressing</title>
        <?php   include "../componentes/header.php"; ?>
        </head>

        <body data-spy="scroll" data-target="#navbar-scroll">

        <!-- /.preloader -->
        <div id="top"></div>

        <!-- /.parallax full screen background image -->
        <?php include "../componentes/header2.php"; ?>
                  
                        </div>
                    </div>
                </div> 
            </div> 
        </div>

 <form action="lang.php" id="filtrosinventa" method="post" class="form-horizontal">

        
           <br> <div class="col-sm-offset-4 col-sm-6">
                <div class="form-group"> 
              <button type="submit" class="btn" name="submitNuevoModulo">Nuevo Modulo</button>
              </div>
            </div>

            <div class="col-sm-offset-4 col-sm-6">
                <div class="form-group"> 
             Generar: <input type = "text" name="cantidadvar"> <button type="submit" class="btn" name="submitNuevoVar">Nuevas Variables</button>
            </div>
                </div>

        </div>
        <div class="form-group">

                <label class="control-label col-sm-4" for="rango">Selecciona un Idioma:</label>

                <div class="col-sm-6">
                    
                    <select name="idioma" class="form-control" tabindex="1">

                                                        <option value="">-Selecciona un Idioma-</option>
                                                        <?php
                                                             $scanned_directory = array_diff(scandir($directory), array('..', '.'));
                                                             foreach ($scanned_directory as $direct){
                                                             	if (is_dir($directory.$direct)) {
                                                             	   echo "<option value=$direct ";
                                                             	      if($direct==$cargaridioma){
                                                             	      	echo "selected";
                                                             	      }
                                                             	   echo">$direct</option>";}
                                                             }//foreach
                                                         
                                                        ?>


                    </select>

                    

                </div> </div>
     <?php 

        if (isset($cargaridioma)) {

            echo '<div class="form-group">
                <label class="control-label col-sm-4" for="rango">Selecciona un Modulo:</label> 

                <div class="col-sm-6">
                    
                    <select name="modulo" class="form-control" tabindex="2" required>
                      <option value="">-Selecciona un Modulo-</option>';
                           $scanned_directory = array_diff(scandir($directory.$cargaridioma), array("..", "."));
                           foreach ($scanned_directory as $direct){
                              if (!(is_dir($directory.$cargaridioma."/".$direct))) {
                                 $direct=substr($direct, 0, -4); 
                                 echo "<option value=$direct ";
                                    if($direct==$modulo){
                                      echo "selected";
                                    }
                                 echo">$direct</option>";}
                           }//foreach
echo '                    </select>
                </div></div>';}  //Carga el listado de modulos activos
        elseif (isset($nuevomodulo)) {

            echo '<div class="form-group">
                <label class="control-label col-sm-4" for="rango">Nombre del Modulo (Sin extensiones):</label> 

                <div class="col-sm-6">
                    
                    <input type = "TEXT" name = "txmodulo">

                    <div class="col-sm-offset-4 col-sm-6">

                           <button type="submit" class="btn" name="generarmodulo">Generar Modulo</button>

                     </div>   
                  
                </div></div>';} //Genera un nuevo modulo

         

     ?>               
                

            
        <span id = "texto"></span>                    
        <div class="form-group"> 

            <div class="col-sm-offset-4 col-sm-6">

              <button type="submit" class="btn" name="submitIdioma">Cargar Idioma</button>

            </div>

        </div>

        <div class="form-group"> 

            <div class="col-sm-offset-4 col-sm-6">

        <?php
            if (isset($cargaridioma) && isset($modulo)){
                cargararchivoidioma($directory.$cargaridioma."/".$modulo);
            } 
            elseif (isset($llamarcrearvariabes)) {
                crearvariables($directory, $_POST["cantidadvar"]);
            }
            elseif (isset($llamargrabarvariabes)) {
                grabarvariables($directory, $_POST);
            }
        ?>
        </div> 
        <?php
            if (isset($cargaridioma) && isset($modulo)){
              echo '  <div class="col-sm-offset-4 col-sm-6">

              <button type="submit" class="btn" name="grabarIdioma">Grabar Idioma</button>

               </div>

               </div>';

            }
        ?>
        </div>
    </form>
<?php include "../componentes/footer.php"; ?>  
        
    </body>
</html>
<?php ob_end_flush(); ?>