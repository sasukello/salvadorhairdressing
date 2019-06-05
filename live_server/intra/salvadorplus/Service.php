<?php
class Service
{
     public function PedirDatosUsuario($datos)
    {
        require_once('../sec/libcon.php');        
		    
        //var_dump($datos);

        //$codsalon = "S11"; $token = md5('0828S112018'); $usuario = "ALUGO"; $hash = "529902006369";


        $codsalon = $datos['codigosalon']; $token = $datos['token']; $usuario = $datos['usuario']; $hash = $datos['hash'];



        if(trim($codsalon) != "" && trim($token) != "" && trim($usuario) != "" && trim($hash) != ""){
			
          //funcion de validar token aqui
          $token = $this->checkToken($token, $codsalon);
          if($token){
            // token correcto
            // ahora: funcion de validar usuario y contraseña
            $validacion = $this->validarUser($usuario, $hash);			
            if($validacion == false){
              //Datos No Coinciden
		        $result = array( 'codigoerror'       => 'SPWS#0003',
                               'mensajeerror'      => 'Datos de Usuario no validos.'
                              ); 
		        return $result;
            exit;    
            } else {
              //Verifica que el usuario tenga acceso al salon deseado			
              $accesos = $this->checkAccesoSalon($usuario, $codsalon);            
      			  if ($accesos == 0){
      				  $result = array( 'codigoerror'       => 'SPWS#0005',
                                     'mensajeerror'      => 'El usuario no tiene acceso al salon'
                                    ); 
      		          return $result; 
      			  }
      			  else {
      				  //Verifica que se grabe el registro de actualizacion
      				  $save = $this->registrarLogin($usuario, $codsalon);
      				  if ($save) {
      					   $result = array('codigousuario' => $validacion['CODIGO'],
                                    'nombrecompleto' =>  $validacion['NOMBRECOMPLETO'],
      				                      'codigoerror'    => '0',
      									            'codigocorporativo' => $validacion['CODIGOCORPORATIVO'],
                                    'nivel'          => $validacion['NIVEL']);
      						return $result;			   
      				  }
      				  else{
      				     $result = array( 'codigoerror'       => 'SPWS#0006',
                                    'mensajeerror'      => 'No se pudo descargar el registro debido a un problema de auditoria'
                                          ); 
      		             return $result; 
      				  }  //Verifca que grabe la actualizacion
      				  
      			  } //Verifica que el usuario tenga acceso al salon
                    		      
            } //Usuario existe
          } //Token valido 
      		  else {
      		      $result = array( 'codigoerror'       => 'SPWS#0004',
                                     'mensajeerror'      => 'El token recibido no es valido'
                                    ); 
      		      return $result; 
      			} //Token no valido
          } else {
      		$result = array( 'codigoerror'       => 'SPWS#0002',
                            'mensajeerror'      => 'No se recibieron todos los datos'
                          ); 
      		return $result;   
          } //No se recibieron todos los datos
    } //Cierre de funcion

    public function checkToken($tokenrecibido, $codsalon){

      $mitokendeberiaser = gmdate("md")."".$codsalon."".gmdate("Y");
      $mitokencodif = md5($mitokendeberiaser);
	  

      if($mitokencodif == $tokenrecibido){
        return true;
      } else{
        return false;
      }
    }

    public function validarUser($user, $hash){

      $nombre = strtoupper($user);
      $con = Conectarfb();
      $sql = "SELECT CODIGO, NOMBRECOMPLETO, NIVEL, (SELECT CODIGOPERSONAL FROM PERSONAL WHERE PERSONAL.CODIGOUSUARIO = USUARIOS.CODIGO) as CODIGOCORPORATIVO FROM usuarios WHERE CODIGO = '".$nombre."' and clavehash = '".$hash."'";	  
	 
      $result = ibase_query($con, $sql);
      if (!$result){
        $result = array( 'codigoerror'       => 'SPWS#0007',
                          'mensajeerror'      => 'Error de Base de Datos: '.ibase_errmsg().' '
                                    ); 
        return $result; 
        exit;
      }
      $datosusuario = ibase_fetch_assoc($result);
      ibase_free_result($result);
      ibase_close($con);
      
      //var_dump($sql);

      return $datosusuario;
    }

    public function checkAccesoSalon($user = "", $salon = ""){
      // return: Si numero es mayor o igual a 1, tiene acceso.
      $nombre = strtoupper($user);
      $con = Conectarfb();

      $region = "1";

      $sql0 = "SELECT CODIGOREGION FROM SALONES WHERE CODIGO = '".$salon."'";
      $result0 = ibase_query($con, $sql0);
      if (!$result0){
        $result = array( 'codigoerror'       => 'SPWS#0008',
                          'mensajeerror'      => 'Error de Base de Datos: '.ibase_errmsg().' '
                                    ); 
        return $result; 
        exit;
      }
      $region = ibase_fetch_assoc($result0);

      $sql = "SELECT COUNT(*) FROM (select * from SALONESXUSUARIOREGION('".$nombre."', '".$region["CODIGOREGION"]."')) WHERE CODIGOSALON = '".$salon."'";
      $result = ibase_query($con, $sql);
      if (!$result){
          $result = array( 'codigoerror'       => 'SPWS#0009',
                          'mensajeerror'      => 'Error de Base de Datos: '.ibase_errmsg().' '
                                    ); 
          return $result; 
          exit;
      }

      $row = ibase_fetch_object($result);
        

      ibase_free_result($result);
      ibase_close($con);
      return $row->COUNT;
  }

    public function registrarLogin($user, $codsalon){

      $nombre = strtoupper($user);
      $con = Conectarfb();
      $sql = "INSERT INTO USUARIOSSALONESACTUALIZADOS (CODIGOUSUARIO, CODIGOSALON, FECHA, HORA, ACCION) VALUES (
      '".$nombre."', 
      '".$codsalon."', 
      CURRENT_DATE, 
      CURRENT_TIME, 
      0)";
      $result = ibase_query($con, $sql);
      if (!$result){
         return false;
      }
      ibase_close($con);
      return true;
    }

}