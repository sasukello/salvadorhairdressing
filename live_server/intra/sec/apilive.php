<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
//***************************************************
//********  FUNCION API PARA LA CONSULTA DE DATOS ***
//********  DEL MODULO LIVE Y GENERALES           ***
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
    case 'opcionespermitidas':
        if(!isset($_POST["usuario"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
        $usuario = $_POST["usuario"];    
        }
        
        if(!isset($_POST["clave"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
        $clave = $_POST["clave"];    
        }
        
        opcionespermitidas($usuario, $clave);
        break;        
    case 'regionesusuario':
        if(!isset($_POST["usuario"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
        $usuario = $_POST["usuario"];    
        }
        
        
        regionesusuario($usuario);
        break;
    case 'salonesusuario':
        if(!isset($_POST["usuario"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
        $usuario = $_POST["usuario"];    
        }
        
        if(!isset($_POST["region"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
        $region = $_POST["region"];    
        }
        
        salonesusuario($usuario, $region);
        break;        
    case 'opcioneslive':
        if(!isset($_POST["usuario"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
        $usuario = $_POST["usuario"];    
        }
        
        opcioneslive($usuario);
        break;
    case 'ponerticket':
        if(!isset($_POST["usuario"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
        $usuario = $_POST["usuario"];    
        }
        
        if(!isset($_POST["detallecaso"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
        $detallecaso = $_POST["detallecaso"];    
        }
        
        ticketservicio($usuario, $detallecaso);
        break;
    case 'grabaconfiguracionusuario':
        if(!isset($_POST["usuario"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
        $usuario = $_POST["usuario"];    
        }
        
        if(!isset($_POST["valores"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $valor = $_POST["valores"];    
        }
        
        grabapreferenciasusuario($usuario, $valor);
        break;

        if(!isset($_POST["idsalon"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $valor = $_POST["idsalon"];    
        }
        
        minutasalon($valor);
        break;    
    case 'nombresalon':        
        if(!isset($_POST["idsalon"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $valor = $_POST["idsalon"];    
        }
        
        nombresalon($valor);
        break;    
    case 'nombreregion':        
        if(!isset($_POST["idregion"])){
          echo "Error Falta Variable"; //Por seguridad no indicar cual var falta  
          exit;
        }
        else {
           $valor = $_POST["idregion"];    
        }
        
        nombreregion($valor);
        break; 
    case 'inventariosugerido':    
        if(!isset($_POST["salon"]) || !isset($_POST["marca"])){
            echo "Error Variable Faltante"; //Por seguridad no indicar cual var falta  
            exit; 
        } else{
            $salon = $_POST["salon"];
            $marca = $_POST["marca"];
            $user = $_POST["usuario"];
        }
        enviarinventariosugerido($user, $salon, $marca);
        break;
    case 'tareaspendientes':
      if(!isset($_POST["usuario"])){
        echo "Error, variable faltante.";
        exit;
      } else{
        $user = $_POST["usuario"];
      }
      tareaspendientes($user);
      break;

    case 'resumenventaintranet':
        if(!isset($_POST["usuario"])){
            echo "Error, variable faltante";
            exit;
        } else{
            $user = $_POST["usuario"];
        }
        resumenventaintranet($user);
        break;

    case 'detalleventadashboard':
        if(!isset($_POST["idsalon"])){
            echo "Error, variable faltante";
            exit;
        } else{
            $idsalon = $_POST["idsalon"];
        }
        detalleventaintranet($idsalon);
        break;

    case 'enviarsugerido':
        if(!isset($_POST["usuario"]) || !isset($_POST["datos"]) || !isset($_POST["datosad"])) {
            echo "Error, variable faltante";
            exit;
        } else {
            $user = $_POST["usuario"];
            $pedido = $_POST["datos"];
            $adicionales = $_POST["datosad"];
        }
        pedidosugeridoorden($user, $pedido, $adicionales);
    break;
    /*** LISTA DEL PERSONAL CORPORATIVO - FRANQUICIADOS ***/
    case 'listapersonal':
        if(!isset($_POST["usuario"])) {
            echo "Error, variable faltante";
            exit;
        } else {
            $user = $_POST["usuario"];
        }
        listapersonal($user);
    break;

    /*** LISTA DEL PERSONAL CORPORATIVO - GENERAL ***/

    case 'listapersonalcorporativo':
      
      listapersonalcorporativo();

      break;
        case 'ordenespago':
          if(!isset($_POST["usuario"])) {
              echo "Error, variable faltante";
              exit;
          } else {
              $user = $_POST["usuario"];
          }
          ordenespago();
        break;

        case 'ordenespagoupdate':
          if(!isset($_POST["usuario"])) {
              echo "Error, variable faltante";
              exit;
          } else {
              $user = $_POST["usuario"];
              $rutafactura = $_POST["factura"];
              $fecha = $_POST["fechapago"];
              $observacion = $_POST["observacion"];
          }
          ordenesPagoUpdate($user, $rutafactura, $fecha, $observacion);
          break;
        case 'historicoproductos':
          if(!isset($_POST["usuario"])) {
              echo "Error, variable faltante";
              exit;
          } else {
              $user = $_POST["usuario"];
          }
          retrieveHistoricoProductos($user);
          break;

        case 'insertHistoricoProductos':
        if(!isset($_POST["usuario"])) {
              echo "Error, variable faltante";
              exit;
          } else {
              $user = $_POST["usuario"];
              $datos = $_POST["dataset"];
          }
          insertHistoricoProductos($user, $datos);
          updateProductos($user, $datos);

          break;
    default:
        echo "Error funcion api no definida"; //Por seguridad no indicar cual var falta
        exit;
   }

//********************************
//*** VALIDACION DE INICIO DE SESION     ***
//********************************
function opcionespermitidas($user, $password){
    //Recibe el usuario y el md5 del password ingresado por el usuario
    //Si no se puede validar el usuario devuelve un mensaje
    //en caso que el usuario pase la validacion 
    //El primer valor del json es el codigo, nombre del usuario e idioma preferido
    //El segundo valor son los items que tiene acceso el usuario
    require_once "libcon.php";

        $nombre = strtoupper($user);

        $con = Conectarfb();
        $sql = "SELECT CODIGO, NOMBRECOMPLETO, COALESCE(IDIOMAINTRANET, 'esp') as idioma, NIVEL FROM usuarios WHERE CODIGO = '".$nombre."' and clavehash = hash('".$password."')";
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }
                        
        $datosusuario = ibase_fetch_assoc($result);
        
        if (!empty($datosusuario)){
           //El usuario existe y la clave coincide 
           //Captura las opciones de menu
           $sql = "Select NOMBREITEM From PERFILUSUARIO Where CODIGOUSUARIO = '".$nombre."'";
           $result = ibase_query($con, $sql);
           if (!$result){
              die('Error ' . ibase_errmsg());
              exit;
           }
           
           $datamenu = array();
           $i = 0;
           //Agrega los datos de usuario
           $datamenu[$i] = $datosusuario;
           $i++;
           while ($row = ibase_fetch_object($result)) {
            $datamenu[$i] = $row;
            $i++;
           }

           echo json_encode($datamenu);
           
        }
        else 
           echo json_encode("Error Usuario o clave no existe - ");
        
        ibase_free_result($result);
        ibase_close($con);
        
} //funcion opciones permitidas


//********************************
//***      NOMBRE SALON       ***
//********************************
function nombresalon($idsalon){
    //Recibe el codigo de salon y devuelve un array compuesto
    //donde el primer valor es el nombre y el segundo el prefijorespaldo
    
    require_once "libcon.php";
        
        $con = Conectarfb();
        $sql = " select nombre, prefijorespaldo from salones where codigo = '".$idsalon."'";
        
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }


        $datasalon = array();        
        $datasalon[] = ibase_fetch_object($result);
        
        echo json_encode($datasalon);
        
        ibase_free_result($result);
        ibase_close($con);
        
} //Minutas por salon


//********************************
//***      NOMBRE REGION       ***
//********************************
function nombreregion($idregion){
    //Recibe el codigo de salon y devuelve un array compuesto
    //donde el primer valor es el nombre y el segundo el prefijorespaldo
    
    require_once "libcon.php";
        
        $con = Conectarfb();
        $sql = " select descripcion from regionoperaciones where codigo = ".$idregion;
        
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }


        $datasalon = array();        
        $datasalon[] = ibase_fetch_object($result);
        
        echo json_encode($datasalon);
        
        ibase_free_result($result);
        ibase_close($con);
        
} //Minutas por region


//********************************
//*** GRABA PREFERENCIASS DEL USUARIO     ***
//********************************
function grabapreferenciasusuario($user, $valores){
    //Actualiza la preferencia del usuario
    //en valores es una matriz que se recibe en el siguiente orden
    //0 = Idioma Usuario
        require_once "libcon.php";
        $valores = unserialize(urlsafe_b64decode($valores)); 
        $nombre = strtoupper($user);

        $con = Conectarfb();
        $sql = "UPDATE USUARIOS SET IDIOMAINTRANET = '".$valores[0]."' WHERE CODIGO = '".$nombre."'";
        $result = ibase_query($con, $sql);
        if ($result===0){
           die('Error ' . ibase_errmsg());
           exit;
        }
        
        echo "[]";
        ibase_close($con);
        
} //funcion opciones permitidas


//********************************
//***REGIONES PERMITIDAS AL USUARIO     ***
//********************************
function regionesusuario($user){
    //Recibe el usuario y el md5 del password ingresado por el usuario
    //Si no se puede validar el usuario devuelve un mensaje
    //en caso que el usuario pase la validacion 
    //El primer valor del json es el codigo y nombre del usuario
    //El segundo valor son los items que tiene acceso el usuario
    require_once "libcon.php";

        $nombre = strtoupper($user);

        $con = Conectarfb();
        $sql = "SELECT * FROM regionesxusuario('".$nombre."')";
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }
           
        $dataregion = array();
        $i = 0;
        while ($row = ibase_fetch_object($result)) {
         $dataregion[$i] = $row;
         $i++;
        }

        echo json_encode($dataregion);
           
        
        ibase_free_result($result);
        ibase_close($con);
        
}//funcion regiones usuario

//********************************
//***SALONES PERMITIDOS AL USUARIO EN LA REGION    ***
//********************************
function salonesusuario($user, $reg){
    //Recibe el usuario y el md5 del password ingresado por el usuario
    //Si no se puede validar el usuario devuelve un mensaje
    //en caso que el usuario pase la validacion 
    //El primer valor del json es el codigo y nombre del usuario
    //El segundo valor son los items que tiene acceso el usuario
    require_once "libcon.php";

        $nombre = strtoupper($user);

        $con = Conectarfb();
        $sql = "SELECT * FROM salonesxusuarioregion('".$nombre."', $reg) order by alias";
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }
           
        $datasalon = array();
        $i = 0;
        while ($row = ibase_fetch_object($result)) {
         $datasalon[$i] = $row;
         $i++;
        }

        echo json_encode($datasalon);
           
        
        ibase_free_result($result);
        ibase_close($con);
        
}//funcion salones usuario

function opcioneslive($user){
    //Recibe el usuario y el md5 del password ingresado por el usuario
    //Si no se puede validar el usuario devuelve un mensaje
    //en caso que el usuario pase la validacion 
    //El primer valor del json es el codigo y nombre del usuario
    //El segundo valor son los items que tiene acceso el usuario
    require_once "libcon.php";

        $nombre = strtoupper($user);

        $con = Conectarfb();
        $sql = "select idrestriccion from RESTRICCIONESUSUARIO ru where upper(ru.NOMBREACCESO) = 'ACCESOREMOTO1' and ru.CODIGOUSUARIO = '".$nombre."' and ru.VALOR = 'V'";
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }
           
        $data = array();
        $i = 0;
        while ($row = ibase_fetch_object($result)) {
         $data[$i] = $row;
         $i++;
        }

        echo json_encode($data);
           
        
        ibase_free_result($result);
        ibase_close($con);
        
}//funcion opcioneslive

//********************************
//***GENERA UN TICKET DE SERVICIO    ***
//********************************
function ticketservicio($usuario, $detallecaso){
   require_once "libcon.php";
   
   $con = Conectarfb();
                    
   $sql = " 
   insert into ticketservicio (CODIGOTICKET, CODIGOSALON,
                CODIGODEPARTAMENTO,
                REPORTADOPOR,
                DETALLECASO,
                CORREOSEGUIMIENTO,
                PRIORIDAD,
                ESTATUS,
                TIPOSERVICIO) values (-1,
                (Select first 1 CodigoDepartamento from personal where codigopersonal = (Select CODIGOPERSONAL From PERSONAL Where CODIGOUSUARIO = '".$usuario."')),
                1,
                '".$usuario."',
                '".$detallecaso."',
                (select CORREOEMPRESA From PERSONAL Where CODIGOUSUARIO = '".$usuario."'),
                1,
                0,
                'I'        
                )";
   
   $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        } else {
          echo "[]";  
        }
    
}//Ticket Servicio


//********************************
//***  ENVIAR PEDIDO SUGERIDO  ***
//********************************

function enviarinventariosugerido($usuario, $salon, $marca){
      date_default_timezone_set('America/Caracas');
      require_once "libcon.php";
   
      $con = Conectarfb();
            
      $sql =  "INSERT INTO LIVE_PEDIDOS (FECHAPEDIDO,FECHACREADO, CREADOPOR, SALON, MARCA) VALUES (
          '".date('Y-m-d')."', 
              '".date('Y-m-d H:i:s')."',
                  '$usuario', '$salon', '$marca')";

      $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        } else {
          echo "[]";  
        }
} //funcion pedido sugerido

//********************************
//***     TAREAS PENDIENTES    ***
//********************************

function tareaspendientes($usuario){
    //Recibe el codigo de USUARIO y devuelve un array compuesto
    //donde el primer valor es el nombre y el segundo el prefijorespaldo
    
    require_once "libcon.php";
        
        $con = Conectarfb();
        $sql = "select * FROM  TAREASPENDIENTESUSUARIOS('".$usuario."')";
        
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }
           
        $data = array();
        $i = 0;
        while ($row = ibase_fetch_object($result)) {
         $data[$i] = $row;
         $i++;
        }

        echo json_encode($data);
        
        ibase_free_result($result);
        ibase_close($con);
        
} //Tareas pendientes por Usuario

function resumenventaintranet($usuario){
   
    require_once "libcon.php";

    $nombre = strtoupper($usuario);

        $con = Conectarfb();
        $sql = "SELECT * FROM regionesxusuario('".$nombre."')";
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }
           
        $dataregion = array();
        $i = 0;
        while ($row = ibase_fetch_object($result)) {
         $dataregion[$i] = $row;
         $i++;
        }
        $mana = json_encode($dataregion);
        $manage = (array) json_decode($mana, true);
        //echo "<br><br><br>";
        //var_dump($manage);

        $i=0;
        $datasalon = array();
        foreach($manage as $dr){

          $con2 = Conectarfb();
          $sql2 = "SELECT * FROM salonesxusuarioregion('".$nombre."', '".$dr['CODIGO']."') order by alias";
          $result2 = ibase_query($con2, $sql2);
          if (!$result2){
            die('Error ' . ibase_errmsg());
            exit;
          }

          $j = 0;
          while ($row = ibase_fetch_object($result2)) {
           $manage[$i][$j] = $row;
           $j++;
          }
          $i++;

        }

        $mana2 = json_encode($manage);
        $manage2 = (array) json_decode($mana2, true);
        //echo "<br><br><br>";
        //var_dump($manage2);

        error_reporting(0);

        $k=0;
        $dataresultados = array();
        foreach($manage2 as $dr2){
          $l=0;
                      //var_dump($dr2);

          foreach ($dr2 as $dcs) {
           // echo "<br><br>";
          $con3 = Conectarfb();
          $sql3 = "select * from 
            (select mf.*, mf.VENTASINVENTARIOMONTO + mf.VENTASSERVICIOSMONTO as totalmonto from SALONESMONTOFECHA mf where tiporegistro = 1 and fechasalon = current_date - 1 and codigosalon = '".$dr2[$l]['CODIGOSALON']."') infodia,
            (select codigosalon,
                   avg(clientesatendidos) as promclientesatendidos, 
                   avg(clientesenespera) as promclientesenespera, 
                   avg(ventasserviciosmonto) promventasserviciosmonto, 
                   avg(ventasinventariomonto) promventasinventariomonto, 
                   avg(ventasinventariomonto + ventasserviciosmonto) promtotalmonto, 
                   avg(ventasserviciounidades) as promventasserviciounidades, 
                   avg(ventasinventariounidades) as promventasinventariounidades 
            from SALONESMONTOFECHA mf where tiporegistro = 1 and fechasalon >= current_date - 30 and fechasalon <= current_date - 1 and codigosalon = '".$dr2[$l]['CODIGOSALON']."'
            group by codigosalon) infoprom
            where infodia.codigosalon = infoprom.codigosalon";
          $result3 = ibase_query($con3, $sql3);
          if (!$result3){
            die('Error ' . ibase_errmsg());
            exit;
          }

          $m = 0;
          while ($row = ibase_fetch_object($result3)) {
           $manage2[$k][$l][$m] = $row;
           $m++;
          }
          $l++;
        }
        $k++;
        }
        //echo "<br>";
        //var_dump($manage2);

        echo json_encode($manage2);
            
        ibase_free_result($result);
        ibase_close($con);
        ibase_free_result($result2);
        ibase_close($con2);
        ibase_free_result($result3);
        ibase_close($con3);
    
        
}

function detalleventaintranet($codigosalon){
   
    require_once "libcon.php";

          $con3 = Conectarfb();
          $sql3 = "select mf.*, 
                         mf.VENTASINVENTARIOMONTO + mf.VENTASSERVICIOSMONTO as totalmonto,                      
                         (select prefijorespaldo from salones where salones.codigo = mf.codigosalon) as alias,
                         (select avg(clientesatendidos) from SALONESMONTOFECHA mfp where mfp.tiporegistro = 1 and mfp.fechasalon >= mf.FECHASALON - 30 and mfp.fechasalon <= mf.FECHASALON - 1 and mfp.codigosalon = mf.CODIGOSALON)  as promclientesatendidos, 
                         (select avg(clientesenespera) from SALONESMONTOFECHA mfp where mfp.tiporegistro = 1 and mfp.fechasalon >= mf.FECHASALON - 30 and mfp.fechasalon <= mf.FECHASALON - 1 and mfp.codigosalon = mf.CODIGOSALON) as promclientesenespera,
                         (select avg(ventasserviciosmonto) from SALONESMONTOFECHA mfp where mfp.tiporegistro = 1 and mfp.fechasalon >= mf.FECHASALON - 30 and mfp.fechasalon <= mf.FECHASALON - 1 and mfp.codigosalon = mf.CODIGOSALON) as promventasserviciosmonto, 
                         (select avg(ventasinventariomonto) from SALONESMONTOFECHA mfp where mfp.tiporegistro = 1 and mfp.fechasalon >= mf.FECHASALON - 30 and mfp.fechasalon <= mf.FECHASALON - 1 and mfp.codigosalon = mf.CODIGOSALON) as promventasinventariomonto, 
                         (select avg(ventasinventariomonto + ventasserviciosmonto) from SALONESMONTOFECHA mfp where mfp.tiporegistro = 1 and mfp.fechasalon >= mf.FECHASALON - 30 and mfp.fechasalon <= mf.FECHASALON - 1 and mfp.codigosalon = mf.CODIGOSALON) as promtotalmonto,
                         (select avg(ventasserviciounidades) from SALONESMONTOFECHA mfp where mfp.tiporegistro = 1 and mfp.fechasalon >= mf.FECHASALON - 30 and mfp.fechasalon <= mf.FECHASALON - 1 and mfp.codigosalon = mf.CODIGOSALON) as promventasserviciounidades,
                         (select avg(ventasinventariounidades) from SALONESMONTOFECHA mfp where mfp.tiporegistro = 1 and mfp.fechasalon >= mf.FECHASALON - 30 and mfp.fechasalon <= mf.FECHASALON - 1 and mfp.codigosalon = mf.CODIGOSALON) as promventasinventariounidades 
                                
                  from SALONESMONTOFECHA mf 
                  where tiporegistro = 1 and 
                        fechasalon >= current_date - 30 and 
                        codigosalon = '".$codigosalon."'
                  order by FechaSalon";
                               

          $result3 = ibase_query($con3, $sql3);
          if (!$result3){
            die('Error ' . ibase_errmsg());
            exit;
          }
          $miarray = array();$i=0;
          while ($row = ibase_fetch_object($result3)) {
            $miarray[$i] = $row;
            $i++;
          }


          $mijson = json_encode($miarray);

          echo $mijson;     
          ibase_free_result($result3);
          ibase_close($con3);
    
        
}

function trendingMonto($actual, $promedio){

    if($actual > $promedio){

        $resultado = "<td style='text-align: center;'>".number_format($actual,2)."<br><div style='width: 85%;'><a href='#c6' data-toggle='tooltip' data-placement='bottom' title='Monto por encima del promedio de últ. 30 dias'><img src='/intranet/componentes/images/trending-up-g.png'></a></div></td>";

        return $resultado;

    } else if($actual < $promedio){

        $resultado = "<td style='text-align: center;'>".number_format($actual,2)."<br><div style='width: 85%;'><a href='#c6' data-toggle='tooltip' data-placement='bottom' title='Monto por debajo del promedio de últ. 30 dias'><img src='/intranet/componentes/images/trending-down-r.png'></a></div></td>";

        return $resultado;

    } else if($actual == $promedio){

        $resultado = "<td style='text-align: center;'>".number_format($actual,2)."</td>";

        return $resultado;

    }

}


function pedidosugeridoorden($user, $pedido, $adicionales){

  require_once "libcon.php";
  date_default_timezone_set('America/Caracas');
  list($corre, $user, $codsalon, $marca) = explode(";", $adicionales);
        
        $sqlsug = "";
        $datosj = json_decode($pedido, true);
        $con = Conectarfb();

        $sql1 = "INSERT INTO LIVE_PEDIDOS (CORRELATIVO, FECHAPEDIDO,FECHACREADO, CREADOPOR, SALON, MARCA) VALUES ($corre, '".date('Y-m-d')."', '".date('Y-m-d H:i:s')."', '$user', '$codsalon', '$marca');";
        $result0 = ibase_query($con, $sql1);
        if (!$result0){
          die('[Error ' . ibase_errmsg().']');
          exit;
        } else {

          foreach ($datosj as $dt) {
            if($dt['CODIGO'] === "" || $dt['CODIGO'] === "CODIGO"){
                continue;
            } else{
                $sqlsug = "INSERT INTO LIVE_PEDIDODETALLES (CORRELATIVOPRINCIPAL, CODPRODUCTO, DESCRIPCION, SUGERIDO) VALUES ($corre, '".$dt['CODIGO']."', '".$dt['DESCRIPCION']."', ".$dt['SUGERIDO'].");";
                $result = ibase_query($con, $sqlsug);
                if (!$result){
                   die('[Error ' . ibase_errmsg().']');
                   exit;
                }
            }
        }
      }

        echo "[]";          
        //ibase_free_result($result);
        ibase_close($con);
}

function listapersonal($usuarios){

    require_once "libcon.php";

      $usuarios = (array) json_decode($usuarios, true);

      $lista="";
      $out = array();

      foreach ($usuarios as $user => $valor) {
          array_push($out, "'".$valor['idusuario']."'");
      }

      $lista = implode(', ', $out);

      $con = Conectarfb();
      $sql = "SELECT U.CODIGO, U.NOMBRECOMPLETO, U.NIVEL, U.ACCESOINTRANET, U.IDIOMAINTRANET, P.NOMBRE, P.APELLIDO, P.CORREOEMPRESA, P.ESTADO FROM  USUARIOS U INNER JOIN PERSONAL P ON U.CODIGO = P.CODIGOUSUARIO WHERE U.NIVEL = 11 AND U.CODIGO NOT IN (".$lista.")";
        
      $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }
           
      $data = array();
      $i = 0;
      while ($row = ibase_fetch_object($result)) {
         $data[$i] = $row;
         $i++;
      }

      echo json_encode($data);
        
      ibase_free_result($result);
      ibase_close($con);
      return;
}

function listapersonalcorporativo(){

    require_once "libcon.php";

    $con = Conectarfb();

    $sql = "SELECT U.CODIGO, P.NOMBRE, P.APELLIDO, P.CODIGOPERSONAL FROM  USUARIOS U INNER JOIN PERSONAL P ON U.CODIGO = P.CODIGOUSUARIO WHERE P.ESTADO IN (0, 1, 2, 3, 4, 5)";
    //$sql = "SELECT P.CODIGOUSUARIO, P.NOMBRE, P.APELLIDO FROM PERSONAL P WHERE P.ESTADO IN (0, 1, 2, 3, 4, 5) AND U.CODIGO NOT IN ('EBRAVO')";
        
    $result = ibase_query($con, $sql);
    if (!$result){
        die('Error ' . ibase_errmsg());
        exit;
    }
           
    $data = array();
    $i = 0;
    while ($row = ibase_fetch_object($result)) {
        $data[$i] = $row;
        $i++;
    }

    echo json_encode($data);
        
    ibase_free_result($result);
    ibase_close($con);
    return;
}

function ordenespago(){

    require_once "libcon.php";
        
        $con = Conectarfb();
        $sql = "select * FROM  ORDENESPAGO WHERE FECHAEJECUTADO is null";
        
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }
           
        $data = array();
        $i = 0;
        while ($row = ibase_fetch_object($result)) {
         $data[$i] = $row;
         $i++;
        }

        echo json_encode($data);
        
        ibase_free_result($result);
        ibase_close($con);
        return;

}

function ordenesPagoUpdate($user, $rutafactura, $fecha, $observacion){
    require_once "libcon.php";
        
        $con = Conectarfb();
        $sql = "UPDATE  ORDENESPAGO SET USUARIOEJECUTADO = '".$user."', FECHAEJECUTADO = '".$fecha."', OBSERVACION = 'RUTA FACTURA: ".$rutafactura." - COMENTARIOS: ".$observacion."';";
        
        $result = ibase_query($con, $sql);
        if ($result===0){
           die('Error ' . ibase_errmsg());
           exit;
        }
        
        echo "[]";
        ibase_close($con);
        return;
}

//************ SALVADOR+ LIVE - OPERACIONES  *********************//

function retrieveHistoricoProductos($user){
  require_once "libcon.php";
        
        $con = ConectarfbRespaldo();
        $sql = "SELECT * FROM HISTORICOPRODUCTOS";
        
        $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        }
           
        $data = array();
        $i = 0;
        while ($row = ibase_fetch_object($result)) {
         $data[$i] = $row;
         $i++;
        }

        echo json_encode($data);
        
        ibase_free_result($result);
        ibase_close($con);
        return;
}

function insertHistoricoProductos($user, $datos){
  require_once "libcon.php";

        $set = array();
        $set = (array) json_decode($datos, true);

        //var_dump($set);

        
        $con = ConectarfbRespaldo();

        $sql = "insert into historicoproductos (CODIGOPRODUCTO, DESCRIPCION, COSTOANTERIOR, COSTONUEVO, FECHACAMBIO, USUARIOCAMBIO)
                      VALUES ('".$set["codp"]."', 'ACTUALIZADO PRODUCTOS', ".$set["cuant"].", ".$set["cu"].", CURRENT_DATE, '".$user."');";
   
   $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        } else {
          echo "[]"; 
        }
        ibase_close($con);
        return;
}

function updateProductos($user, $datos){
  require_once "libcon.php";

        $set = array();
        $set = (array) json_decode($datos, true);

        //var_dump($set);
        $cu = $set["cu"];
        $cuant = $set["cuant"];
        $costpromed = ($cu + $cuant) / 2;

        $estatus = $set["estado"];
        if($estatus == "A"){
          $descont = "F";
        } else if($estatus == "I"){
          $descont = "V";
        }
        

        $con = ConectarfbRespaldo();

        $sql = "update productos SET DESCRIPCION = '', COSTOUNITARIO = ".$set["cu"].", ULTIMOCOSTO = ".$set["cuant"].", ALICUOTACOMPRA = ".$set["acompra"].", ALICUOTAVENTA = ".$set["aventa"].", PRECIOVENTA1 = ".$set["pv1"].", PRECIOVENTA2 = ".$set["pv2"].", PORCUTILIDAD1 = ".$set["ut1"].", PORCUTILIDAD2 = ".$set["ut2"].", FECHAMODIFICACION = CURRENT_DATE, USUARIOMODIFICADO = '".$user."', TIPOVENTA = '".$set["tvent"]."', COSTOPROMEDIO = ".$costpromed.", PRECIOSINIVA1 = ".$set["psi1"].", PRECIOSINIVA2 = ".$set["psi2"].", DESCONTINUADO = '".$descont." where CODIGO = '".$set["codp"]."';";
   
   $result = ibase_query($con, $sql);
        if (!$result){
           die('Error ' . ibase_errmsg());
           exit;
        } else {
          echo "[]"; 
        }
        ibase_close($con);
        return;
}
?>