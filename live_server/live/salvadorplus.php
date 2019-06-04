<?php
header("Content-type: text/xml");

require_once "../lib/nusoap.php";

function getLogin($user){
  if($user == "ALUGO"){
    return join(",", array(
      "Armando Lugo Salazar",
      "50",
      "success"));
  } else{
    return "error: #11";
  }
}

function manejarEntradas($datos){
  switch ($datos['funcion']) {
    case 'datosusuario':

      getLoginInfo($datos);
      break;
    
    default:
      # code...
      break;
  }
}

function getLoginInfo($datos) {


    /*
      Retorno
      -1=ERROR DE CONEXION
      0=EXITOSO!!!
      1=REGION YA REGISTRADO
      2=ERROR AL REGISTRAR LA REGION


      $datos['codigosalon'] . "'," .
                              "'" . $datos['token'] . "'," .
                              "'" . $datos['funcion'] . "', ".
                                    $datos['otros']
     */
        //BUSCO EL TOKEN
        if(!empty($datos['token'])){
          $continuar=true;

          //funcion de validar token aqui

          //funcion de validar usuario y contraseña
          list($user, $password) = explode(";", $datos['otros']);








        } else{ 
          $continuar=false;
          $error="02"; // no recibió token
        }

    //Conecta a la base de datos
    /*$dbh = dbconn();
    if (!$dbh) {
        return "-1";
        exit;
    }*/
    //Registra la region
    /*$sql = "insert into REGIONES (CODREGION, NOMBRE, MONEDA, MULTIPLICADORPUNTOS) " .
                 "     values ('" . $datos['codigosalon'] . "'," .
                              "'" . $datos['token'] . "'," .
                              "'" . $datos['funcion'] . "', ".
                                    $datos['otros'] . ") on duplicate key update " .
                              "NOMBRE = '" . $datos['nombre'] . "'," .
                              "MONEDA = '" . $datos['moneda'] . "',".
                              "MULTIPLICADORPUNTOS = " . $datos['multiplicadorpuntos'] . ";";*/

   
    



    /*if (mysqli_query($dbh, $sql)) {
       return "0";
    } else {
       return $sql;
    }
    mysqli_close($dbh);*/

    return "000";
    
}

function validarUser($user, $password){

    require_once "libcon.php";

    $nombre = strtoupper($user);
    $con = Conectarfb();
    $sql = "SELECT CODIGO, NOMBRECOMPLETO, NIVEL FROM usuarios WHERE CODIGO = '".$nombre."' and clavehash = hash('".$password."')";
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


}

function checkAccesoSalon(){
  // return: Si numero es mayor o igual a 1, tiene acceso.

  /*
  SELECT COUNT(*) FROM (
select * from SALONESXUSUARIOREGION(:USUARIO, :REGION))
WHERE CODIGOSALON = :SALON*/


}




$server = new soap_server();
$server->configureWSDL("logear", "urn:salvadorplus");

$server->wsdl->addComplexType('datos_usuario', 
                              'complexType', 
                              'struct', 
                              'all', 
                              '', 
                              array('codigosalon' => array('name' => 'codigosalon', 'type' => 'xsd:string'),
                                    'token' => array('name' => 'token', 'type' => 'xsd:string'),
                                    'funcion' => array('name' => 'funcion', 'type' => 'xsd:string'),
                                    'otros' => array('name' => 'otros', 'type' => 'xsd:string')
));

$server->register('manejarEntradas', // nombre del metodo o funcion
        array('datos' => 'tns:datos_usuario'), // parametros de entrada
        array('return' => 'xsd:string'), // parametros de salida
        'urn:salvadorplus', // namespace
        'urn:salvadorplus#manejarEntradas', // soapaction debe ir asociado al nombre del metodo
        'rpc', // style
        'encoded', // use
        'La2' // documentation
);

$server->register("getLogin",
  array("user" => "xsd: string"),
  array("return" => "xsd: string"),
  "urn:salvadorplus",
  "urn:salvadorplus#getLogin",
  "rpc",
  "encoded",
  "Funcion1");


  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';  
  $server->service($HTTP_RAW_POST_DATA);

?>