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
    case 'modificarminutas':
       if(!isset($_POST["idminuta"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $idminuta = $_POST["idminuta"];    
        }

        if(!isset($_POST["iduser"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $iduser = $_POST["iduser"];    
        }
        if(!isset($_POST["tipominuta"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $tipominuta = $_POST["tipominuta"];    
        }
        if(!isset($_POST["accion"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $accion = $_POST["accion"];    
        }
        if(!isset($_POST["razon"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $razon = str_ireplace("'","",$_POST["razon"]);
    
        }

        modificarminutas($iduser, $idminuta, $tipominuta, $accion, $razon);
    case 'minutasalon':        
        if(!isset($_POST["idsalon"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $valor = $_POST["idsalon"];    
        }

        if(!isset($_POST["iduser"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $iduser = $_POST["iduser"];    
        }
        
        minutasalon($valor, $iduser, "salon");
        break;    
    case 'chargeminsalon':
        if(!isset($_POST["idminuta"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {

           $idmin = $_POST["idminuta"];    
           $tipomin = $_POST["tipomin"];
           $valorpri = $_POST["valoru"];
        }
        chargeminsalon($idmin, $tipomin, $valorpri);
        break;
    case 'selectall':
          $idmin = $_POST["iduser"];    
          $tipomin = "R";

          selectall($idmin, $tipomin);
          break;
    case 'minutacomite':        
        if(!isset($_POST["iduser"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $iduser = $_POST["iduser"];    
        }
        
        minutasalon("", $iduser, "comite");
        break;        
    case 'buscarminutassalon':        
        if(!isset($_POST["idsalon"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $idsalon = $_POST["idsalon"];    
        }
        
        if(!isset($_POST["semilla"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $semilla = $_POST["semilla"];    
        }

        if(!isset($_POST["detalles"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $detalles = $_POST["detalles"];    
        }
        buscarminutassalon($idsalon, $semilla, $detalles);
        break;
    case 'buscarminutasregion':        
        if(!isset($_POST["idregion"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $idregion = $_POST["idregion"];    
        }
        
        if(!isset($_POST["semilla"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $semilla = $_POST["semilla"];    
        }

        if(!isset($_POST["detalles"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $detalles = str_ireplace("'","",  $_POST["detalles"]);
        }
        
        buscarminutasregion($idregion, $semilla, $detalles);
        break;               
    case 'buscarminutascomite':        
                
        if(!isset($_POST["semilla"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $semilla = $_POST["semilla"];    
        }

        if(!isset($_POST["detalles"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $detalles = $_POST["detalles"];    
        }
        
        buscarminutascomite($semilla, $detalles);
        break;               
    case 'agregarminutas':        
        if(!isset($_POST["idsalon"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $idsalon = $_POST["idsalon"];    
        }

        if(!isset($_POST["idregion"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $idregion = $_POST["idregion"];    
        }
        
        if(!isset($_POST["iduser"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $iduser = $_POST["iduser"];    
        }

        if(!isset($_POST["datosminuta"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $datosminuta = str_ireplace("'","", $_POST["datosminuta"]);
        }

        if(!isset($_POST["tipominuta"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $tipominuta = $_POST["tipominuta"];    
        }

        if(!isset($_POST["prioridad"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $prioridad = $_POST["prioridad"];    
        }

        if ($tipominuta == "region"){
            $idsalon = $idregion;
        }
                
        agregarminutassalon($idsalon, $iduser, $datosminuta, $tipominuta, $prioridad);
        
        break;         
    case 'minutaregion':        
        if(!isset($_POST["idregion"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $valor = $_POST["idregion"];    
        }

        if(!isset($_POST["iduser"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $iduser = $_POST["iduser"];    
        }
        
        minutasalon($valor, $iduser, "region");
        break;
    case 'agregardetalles':        
        if(!isset($_POST["iduser"])){
          echo "Error Falta Variable API"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $iduser = $_POST["iduser"];    
        }

        if(!isset($_POST["detalleagregado"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $detalleagregado = $_POST["detalleagregado"];    
        }
        if(!isset($_POST["tipominuta"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $tipominuta = $_POST["tipominuta"];    
        }
        if(!isset($_POST["codigominuta"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $codigominuta = $_POST["codigominuta"];    
        }
        if(!isset($_POST["idsalon"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $idsalon = $_POST["idsalon"];    
        }
        if(!isset($_POST["idregion"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $idregion = $_POST["idregion"];               
        }

        if ($tipominuta == "region"){
            $idsalon = $idregion;
        }
        agregardetalleminuta($idsalon, $iduser, $detalleagregado, $tipominuta, $codigominuta);        
        break;     
    case 'detallesleidos':        
        if(!isset($_POST["iduser"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $iduser = $_POST["iduser"];    
        }

        if(!isset($_POST["detallesleidos"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $detallesleidos = $_POST["detallesleidos"];    
        }
        if(!isset($_POST["tipominuta"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $tipominuta = $_POST["tipominuta"];    
        }
        
        
        marcardetallesleidos($iduser, $detallesleidos, $tipominuta);
        break;     
    case 'privilegiosusuarios': 

        if(!isset($_POST["iduser"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $iduser = $_POST["iduser"];    
        } 

        privilegiosusuarios($iduser);       
        break;     
    default:
        echo "Error funcion api no definida"; //Por seguridad no indicar cual var falta
        exit;
   }

//********************************
//*** MODIFICAR MINUTAS        ***
//********************************
function modificarminutas($iduser, $idminuta, $tipominuta, $accion, $razon){

  //determina las tablas a modificar
  if ($tipominuta == "salon"){
     $tablamaestra = "MINUTASALON";
     $tabladetalle = "MINUTASALONDETALLE";
     $permiso      = "SALON1";
     $detallepermiso = "VERIFICARMINUTASALON";
  } elseif ($tipominuta == "region"){
     $tablamaestra = "MINUTAREGION";
     $tabladetalle = "MINUTAREGIONDETALLE";
     $permiso      = "REGION1";
     $detallepermiso = "VERIFICAMINUTAREGION";
  }  elseif ($tipominuta == "comite"){
     $tablamaestra = "MINUTACOMITE";
     $tabladetalle = "MINUTACOMITEDETALLE";
     $permiso      = "COMITE1";
  }

  //Determina la accion a ejecutar
  switch ($accion) {
    case 'A':
      $sqlmaestro = "UPDATE $tablamaestra SET ESTATUS = 0 WHERE CODIGO = $idminuta";
      $sqldetalle = "INSERT INTO $tabladetalle (CODIGOMINUTA, DESCRIPCIONDETALLE, USUARIOGENERADO) values ($idminuta, 'Reapertura ".$razon."', '".$iduser."')"; 
      break;

    case 'C':
      $sqlmaestro = "UPDATE $tablamaestra SET ESTATUS = 1, usuariocerrado = '".$iduser."', fechacerrado = current_date  WHERE CODIGO = $idminuta"; 
      break;

    case 'V':
      $sqlmaestro = "UPDATE $tablamaestra SET ESTATUS = 2, usuarioverificado = '".$iduser."', fechaverificado = current_date WHERE CODIGO = $idminuta"; 
      break;
  }

 require_once "libcon.php";

   $con = Conectarfb();

   //Valida si el usuario tiene los permisos necesarios
         $sql = "select count(*) as Permiso from perfilusuario where upper(nombreitem) = '".$permiso."' and upper(codigousuario) = '".$iduser."'";
         $resultmenu = ibase_query($con, $sql);
        if ($resultmenu===0){
           die('Error ' . ibase_errmsg());
           exit;
        }
        $datosacceso = ibase_fetch_object($resultmenu); 
        if ($datosacceso->PERMISO == 0){
          echo "Error: Usuario sin privilegios";
        }

        if ((($accion=="A") || ($accion=="V")) && ($tipominuta!="comite")){

           $sql = "Select b.VALOR From RESTRICCIONESMENU a, RESTRICCIONESUSUARIO b
                   Where a.IDRESTRICCION = b.IDRESTRICCION And b.HABILITADO = 'V' And b.CODIGOUSUARIO = '".$iduser."'   And Upper(b.NOMBREACCESO) = '".$permiso."'
                         And Upper(a.NOMBREVARIABLE) = '".$detallepermiso."'";
           $resultmenu = ibase_query($con, $sql);
           if ($resultmenu===0){
              die('Error ' . ibase_errmsg());
              exit;
           }
           
           $datosacceso = ibase_fetch_object($resultmenu); 
           if ($datosacceso->VALOR != "V"){
             echo "Error: Usuario sin privilegios para verificar o reabrir";
           }

        }

         $result = ibase_query($con, $sqlmaestro);
        if ($result===0){
           die('Error ' . ibase_errmsg());
           exit;
        }
      
      if (isset($sqldetalle)){  
         $result2 = ibase_query($con, $sqldetalle);
        if ($result2===0){
           die('Error ' . ibase_errmsg());
           exit;
        }
       }

        echo "[]";
        ibase_close($con);

}

//********************************
//*** MARCAR DETALLES LEIDOS   ***
//********************************
function marcardetallesleidos($iduser, $detallesleidos, $tipominuta){

  //determina las tablas a modificar
  if ($tipominuta == "salon"){
     $tablamaestra = "minutadetallesalon_leidos";
  } elseif ($tipominuta == "region"){
     $tablamaestra = "minutadetalleREGION_leidos";
  }   elseif ($tipominuta == "comite"){
     $tablamaestra = "minutadetalleCOMITE_leidos";
  }  

  $detalles = explode(",", $detallesleidos);  
 require_once "libcon.php";

   $con = Conectarfb();
   foreach ($detalles as $detalle) {
      $sql = "INSERT INTO ".$tablamaestra." (IDMINUTADETALLE, USUARIO, FECHAHORA) VALUES (".$detalle.", '".$iduser."', current_timestamp)";
      $result = ibase_query($con, $sql);
      if (!$result){
         die('Error ' . ibase_errmsg());
         exit;
      }      
    } 
      
    echo "[]";
    ibase_close($con);

}

//********************************
//*** MINUTAS DE SALON / REGION***
//********************************
function minutasalon($idsalon, $iduser, $tipominuta){
    //Recibe el codigo de salon y devuelve un array compuesto
    //donde un array es los datos de la minuta
    //y en un array dentro de esa linea los detalles de la minuta  
   
    if($tipominuta=="salon"){
       $tablamaestra = "MINUTASALON";
       $tabladetalle = "minutasalondetalle"; 
       $tablaleidos  = "minutadetallesalon_leidos";
       $campobusqueda= "codigosalon";
       $tablaactulizarusuario = "MINUTASALON_LEIDOS";
    }
    elseif ($tipominuta=="region"){
       $tablamaestra = "MINUTAREGION";
       $tabladetalle = "MINUTAREGIONDETALLE"; 
        $tablaleidos  = "MINUTADETALLEREGION_LEIDOS";
       $campobusqueda= "codigoregion";
       $tablaactulizarusuario = "MINUTAREGION_LEIDOS";
    }
    elseif ($tipominuta=="comite"){
       $tablamaestra = "MINUTACOMITE";
       $tabladetalle = "MINUTACOMITEDETALLE"; 
       $tablaleidos  = "MINUTADETALLECOMITE_LEIDOS";
       $campobusqueda= "";
       $tablaactulizarusuario = "MINUTACOMITE_LEIDOS";
    }
    require_once "libcon.php";
        
        $con = Conectarfb();

        $sql = "Select * from (select CODIGO, ";
                 if($campobusqueda!=""){              
                     $sql.=$campobusqueda.",";
                  } 
        $sql .= "DESCRIPCION, USUARIOCREADO, FECHACREADO,  HORACREADO,  USUARIOCERRADO, 
                        FECHACERRADO,  USUARIOVERIFICADO, FECHAVERIFICADO, ESTATUS,  PRIORIDAD, IDNOLEIDOS, COALESCE(FECHAMAXIMA, FECHACREADO) AS FECHAMAXIMA, iif(FechaCreado + HORACREADO < (Select Max(FechaHora) from ".$tablaactulizarusuario." where usuario = '".$iduser."'";
                         if($campobusqueda!=""){              
                            $sql.="and ". $campobusqueda." = '".$idsalon."'";
                         }  
                        $sql.= "), 0, 1) as NUEVOITEM from (SELECT * from (Select * from ".$tablamaestra." where ";
         if($campobusqueda!=""){              
             $sql .= $campobusqueda." = '".$idsalon."' and ";
          } 
        $sql .= " estatus in (0,1) AND PRIORIDAD = 3 )ms     LEFT JOIN

     (Select msd.codigominuta as codigoagrupado, cast(coalesce(LIST(CODIGO, ','), '') as varchar(600)) AS IDNOLEIDOS
      from ".$tabladetalle." msd
      where (Select count(*)
             from ".$tablaleidos."
             where idminutadetalle = codigo and usuario= '$iduser') = 0
      group by msd.codigominuta) NOLEIDOS

      ON MS.CODIGO = NOLEIDOS.CODIGOAGRUPADO) resultado left join (Select msd.codigominuta as codigoagrupado, MAX(FECHAGENERADO) AS FECHAMAXIMA 
       from ".$tabladetalle." msd group by msd.codigominuta) FECHAMAXIMA ON RESULTADO.CODIGO = FECHAMAXIMA.CODIGOAGRUPADO)  ";
        

        $sql .= "UNION ALL Select * from (select CODIGO, ";
                 if($campobusqueda!=""){              
                     $sql.=$campobusqueda.",";
                  } 
        $sql .= "DESCRIPCION, USUARIOCREADO, FECHACREADO,  HORACREADO,  USUARIOCERRADO, 
                        FECHACERRADO,  USUARIOVERIFICADO, FECHAVERIFICADO, ESTATUS,  PRIORIDAD, IDNOLEIDOS, COALESCE(FECHAMAXIMA, FECHACREADO) AS FECHAMAXIMA, iif(FechaCreado + HORACREADO < (Select Max(FechaHora) from ".$tablaactulizarusuario." where usuario = '".$iduser."'";
                         if($campobusqueda!=""){              
                            $sql.="and ". $campobusqueda." = '".$idsalon."'";
                         }  
                        $sql.= "), 0, 1) as NUEVOITEM  from (SELECT * from (Select * from ".$tablamaestra." where ";
         if($campobusqueda!=""){              
             $sql .= $campobusqueda." = '".$idsalon."' and ";
          } 
      $sql .= " estatus in (0,1) AND PRIORIDAD <> 3 )ms     LEFT JOIN

     (Select msd.codigominuta as codigoagrupado, cast(coalesce(LIST(CODIGO, ','), '') as varchar(600)) AS IDNOLEIDOS
      from ".$tabladetalle." msd
      where (Select count(*)
             from ".$tablaleidos."
             where idminutadetalle = codigo and usuario= '$iduser') = 0
      group by msd.codigominuta) NOLEIDOS

      ON MS.CODIGO = NOLEIDOS.CODIGOAGRUPADO) resultado left join (Select msd.codigominuta as codigoagrupado, MAX(FECHAGENERADO) AS FECHAMAXIMA 
       from ".$tabladetalle." msd group by msd.codigominuta) FECHAMAXIMA ON RESULTADO.CODIGO = FECHAMAXIMA.CODIGOAGRUPADO) ";


        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }


        $dataminuta = array();
        $i = 0; 
        while ($datosminuta = ibase_fetch_object($result)) {           
           //Ubica los detalles de la minuta
           $sql = "SELECT * FROM ".$tabladetalle." WHERE CODIGOMINUTA = ".$datosminuta->CODIGO;
           $result2 = ibase_query($con, $sql);
           if (!$result){
              die('Error ' . ibase_errmsg());
              exit;
           }   
           $j=0;
           $minutadetalle = array();
           while ($datosdetalle = ibase_fetch_object($result2)){
              $minutadetalle[$j] = $datosdetalle;
              $j++;
           }
           $dataminuta[$i]  = json_encode($datosminuta) . json_encode($minutadetalle);
           $i++;
        } //Recorre las minutas  
                                
        
        echo json_encode($dataminuta);

        //echo json_encode($sql);
        
        //Graba el ultimo acceso del usuario
        $sql = "INSERT INTO ".$tablaactulizarusuario." (USUARIO, FECHAHORA";
        if($campobusqueda!=""){              
             $sql .= ",".$campobusqueda;
        }
        $sql .= " ) VALUES ('".$iduser."', current_timestamp";
        if($campobusqueda!=""){              
             $sql .= ",'".$idsalon."'";
        }
        $sql .= ")";
        $result3 = ibase_query($con, $sql);
        if (!$result3){
           die('Error al registrar ultima fecha de usuario ' . ibase_errmsg());
           exit;
        }   
        ibase_free_result($result);
        ibase_close($con);
        
} //Minutas por salon

//********************************
//*** PRIVILEGIOS USUARIOS     ***
//********************************
function privilegiosusuarios($iduser){
    //Recibe el codigo de salon y una semilla
    //(Detalles 1 = Verdero 0 =  Falso)
    //devuelve el mismo array de busqeuda en salon
    require_once "libcon.php";
        
        $con = Conectarfb();
        $sql = "Select NOMBREITEM From PERFILUSUARIO Where   CODIGOUSUARIO = '".$iduser."' AND UPPER(NOMBREITEM) IN ('REGION1', 'SALON1', 'COMITE1')
                  UNION ALL
                select CAST(idrestriccion AS VARCHAR(100)) from RESTRICCIONESUSUARIO ru where upper(ru.NOMBREACCESO) IN ('SALON1', 'REGION1', 'COMITE1') and ru.CODIGOUSUARIO = '".$iduser."' and ru.VALOR = 'V'";
                
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }


        $dataminuta = array();
        $i = 0; 
        while ($datosdetalle = ibase_fetch_object($result)){
          $dataminuta[$i] = $datosdetalle;
          $i++;
        }
                                
        
        echo json_encode($dataminuta);
        
        
        ibase_free_result($result);
        ibase_close($con);
        
} //pRIVILEGIOS uSUARIOS

//********************************
//*** BUSQUEDA DE MINUTAS      ***
//********************************
function buscarminutassalon($idsalon, $semilla, $detalles){
    //Recibe el codigo de salon y una semilla
    //(Detalles 1 = Verdero 0 =  Falso)
    //devuelve el mismo array de busqeuda en salon
    require_once "libcon.php";
        
        $con = Conectarfb();
        if ($detalles==0){
           $sql = "SELECT * FROM MINUTASALON WHERE CODIGOSALON = '".$idsalon."' and upper(DESCRIPCION) like ('%".strtoupper($semilla)."%') order by FECHACREADO DESC, HORACREADO DESC ";
        }
        else{
           $sql = "SELECT ms.*
                   FROM MINUTASALON ms
                   WHERE CODIGOSALON = '".$idsalon."' and
                         ((upper(ms.DESCRIPCION) like ('%".strtoupper($semilla)."%')) or
                          (Select count(*)
                           from MINUTASALONDETALLE msd
                           where ms.codigo = msd.CODIGOMINUTA and
                                 (upper(msd.DESCRIPCIONDETALLE) like ('%".strtoupper($semilla)."%')))> 0)
                   order by FECHACREADO DESC, HORACREADO DESC";
        }

        
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }


        $dataminuta = array();
        $i = 0; 
        while ($datosminuta = ibase_fetch_object($result)) {           
           //Ubica los detalles de la minuta
           $sql = "SELECT * FROM MINUTASALONDETALLE WHERE CODIGOMINUTA = ".$datosminuta->CODIGO;
           $result2 = ibase_query($con, $sql);
           if (!$result){
              die('Error ' . ibase_errmsg());
              exit;
           }   
           $j=0;
           $minutadetalle = array();
           while ($datosdetalle = ibase_fetch_object($result2)){
              $minutadetalle[$j] = $datosdetalle;
              $j++;
           }
           $dataminuta[$i]  = json_encode($datosminuta) . json_encode($minutadetalle);
           $i++;
        } //Recorre las minutas  
                                
        
        echo json_encode($dataminuta);
        /*$sqla = array();
        $sqla[] = $sql;
        echo json_encode($sqla);*/
        
        ibase_free_result($result);
        ibase_close($con);
        
} //busqeuda de minutas salon

function buscarminutasregion($idregion, $semilla, $detalles){
    //Recibe el codigo de region y una semilla
    //(Detalles 1 = Verdero 0 =  Falso)
    //devuelve el mismo array de busqeuda en salon
    require_once "libcon.php";
        
        $con = Conectarfb();
        if ($detalles==0){
           $sql = "SELECT * FROM MINUTAREGION WHERE CODIGOREGION = ".$idregion." and upper(DESCRIPCION) like ('%".strtoupper($semilla)."%') order by FECHACREADO DESC, HORACREADO DESC ";
        }
        else{
           $sql = "SELECT ms.*
                   FROM MINUTAREGION ms 
                   WHERE CODIGOREGION = ".$idregion." and
                         ((upper(ms.DESCRIPCION) like ('%".strtoupper($semilla)."%')) or
                          (Select count(*)
                           from MINUTAREGIONDETALLE msd
                           where ms.codigo = msd.CODIGOMINUTA and
                                 (upper(msd.DESCRIPCIONDETALLE) like ('%".strtoupper($semilla)."%')))> 0)
                   order by FECHACREADO DESC, HORACREADO DESC";
        }

        
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }


        $dataminuta = array();
        $i = 0; 
        while ($datosminuta = ibase_fetch_object($result)) {           
           //Ubica los detalles de la minuta
           $sql = "SELECT * FROM MINUTAREGIONDETALLE WHERE CODIGOMINUTA = ".$datosminuta->CODIGO;
           $result2 = ibase_query($con, $sql);
           if (!$result){
              die('Error ' . ibase_errmsg());
              exit;
           }   
           $j=0;
           $minutadetalle = array();
           while ($datosdetalle = ibase_fetch_object($result2)){
              $minutadetalle[$j] = $datosdetalle;
              $j++;
           }
           $dataminuta[$i]  = json_encode($datosminuta) . json_encode($minutadetalle);
           $i++;
        } //Recorre las minutas  
                                
       
        echo json_encode($dataminuta);

        ibase_free_result($result);
        ibase_close($con);
        
} //busqeuda de minutas region

function chargeminsalon($idminuta, $tipo, $valorpriori){
    //Recibe el codigo de region y una semilla
  $tabla = "";
  switch ($tipo) {
    case 'region':
      $tabla = "MINUTAREGION";
      break;
    case 'salon':
      $tabla = "MINUTASALON";
      break;
    case 'comite':
      $tabla = "MINUTACOMITE";
      break; 
  }

    require_once "libcon.php";
        
        $con = Conectarfb();
           $sql = "UPDATE $tabla SET PRIORIDAD = ".$valorpriori." WHERE CODIGO = $idminuta;";

        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }

        echo "[]";
        ibase_close($con);
}

function selectall($idminuta, $tipo){
    //Recibe el codigo de region y una semilla
    require_once "libcon.php";
        
        $con = Conectarfb();
           $sql = "SELECT * FROM MINUTAREGION;";

        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }

        $dataminuta = array();
        $i = 0; 
        while ($datosdetalle = ibase_fetch_object($result)){
          $dataminuta[$i] = $datosdetalle;
          $i++;
        }
                                
        
        echo json_encode($dataminuta);
        
        
        ibase_free_result($result);
        ibase_close($con);



        //echo "[]";
        //ibase_close($con);
}

function buscarminutascomite($semilla, $detalles){
    //Recibe el codigo de region y una semilla
    //(Detalles 1 = Verdero 0 =  Falso)
    //devuelve el mismo array de busqeuda en salon
    require_once "libcon.php";
        
        $con = Conectarfb();
        if ($detalles==0){
           $sql = "SELECT * FROM MINUTACOMITE WHERE upper(DESCRIPCION) like ('%".strtoupper($semilla)."%') order by FECHACREADO DESC, HORACREADO DESC ";
        }
        else{
           $sql = "SELECT ms.*
                   FROM MINUTACOMITE ms 
                   WHERE ((upper(ms.DESCRIPCION) like ('%".strtoupper($semilla)."%')) or
                          (Select count(*)
                           from MINUTACOMITEDETALLE msd
                           where ms.codigo = msd.CODIGOMINUTA and
                                 (upper(msd.DESCRIPCIONDETALLE) like ('%".strtoupper($semilla)."%')))> 0)
                   order by FECHACREADO DESC, HORACREADO DESC";
        }

        
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }


        $dataminuta = array();
        $i = 0; 
        while ($datosminuta = ibase_fetch_object($result)) {           
           //Ubica los detalles de la minuta
           $sql = "SELECT * FROM MINUTACOMITEDETALLE WHERE CODIGOMINUTA = ".$datosminuta->CODIGO;
           $result2 = ibase_query($con, $sql);
           if (!$result){
              die('Error ' . ibase_errmsg());
              exit;
           }   
           $j=0;
           $minutadetalle = array();
           while ($datosdetalle = ibase_fetch_object($result2)){
              $minutadetalle[$j] = $datosdetalle;
              $j++;
           }
           $dataminuta[$i]  = json_encode($datosminuta) . json_encode($minutadetalle);
           $i++;
        } //Recorre las minutas  
                                
       
        echo json_encode($dataminuta);

        ibase_free_result($result);
        ibase_close($con);
        
} //busqeuda de minutas comite


//********************************
//***    AGREGAR  MINUTAS      ***
//********************************
function agregarminutassalon($idsalon, $iduser, $datosminuta, $tipominuta, $prioridad){
    //Recibe el codigo de salon y datos de la minuta    
    //devuelve el mismo array de busqeuda en salon en caso de exito
    //para replobar con la minuta agregada 
    require_once "libcon.php";

        if ($tipominuta == "salon"){
          $tablamaestra = "MINUTASALON";
          $codigo       = "CODIGOSALON";
        }
        elseif ($tipominuta == "region"){
          $tablamaestra = "MINUTAREGION";
          $codigo       = "CODIGOREGION";
        }
        elseif ($tipominuta == "comite"){
          $tablamaestra = "MINUTACOMITE";          
          $codigo       = ""; 
        }        
        
        $con = Conectarfb();

        if ($codigo=="") {
           $sql = "INSERT INTO ".$tablamaestra." (DESCRIPCION, USUARIOCREADO, 
                                         ESTATUS, PRIORIDAD)
                                 VALUES ('".$datosminuta."', '".$iduser."', 
                                         0, ".$prioridad.")";
        }
        else{
           $sql = "INSERT INTO ".$tablamaestra." (".$codigo.", DESCRIPCION, USUARIOCREADO, 
                                         ESTATUS, PRIORIDAD)
                                 VALUES ('".$idsalon."', '".$datosminuta."', '".$iduser."', 
                                         0, ".$prioridad.")";
        }

        
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error api ' . $sql . ibase_errmsg());
           exit;
        }

   
        ibase_close($con);

        minutasalon($idsalon, $iduser, $tipominuta);
    
        
        
        
} //agregar minutas

function agregardetalleminuta($idsalon, $iduser, $detalleagregado, $tipominuta, $codigominuta){
    //Recibe el codigo de salon y datos de la minuta    
    //devuelve el mismo array de busqeuda en salon en caso de exito
    //para replobar con la minuta agregada 
    require_once "libcon.php";


        if ($tipominuta == "salon"){
          $tablamaestra = "MINUTASALONDETALLE";
        }
        elseif ($tipominuta == "region"){
          $tablamaestra = "MINUTAREGIONDETALLE";
        }
        elseif ($tipominuta == "comite"){
          $tablamaestra = "MINUTACOMITEDETALLE";
        }
        
        $con = Conectarfb();
        $sql = "INSERT INTO ".$tablamaestra." (CODIGOMINUTA, DESCRIPCIONDETALLE, USUARIOGENERADO)
                                       VALUES ('".$codigominuta."', '".$detalleagregado."', '".$iduser."')";
        
        
        
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }

   
        ibase_close($con);        

        //echo "Error Sln ". $idsalon ." Usuario ". $iduser ." Minuta ". $tipominuta;
          
        minutasalon($idsalon, $iduser, $tipominuta);

    
        
        
        
} //agregar minutas


?>