<?php
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
 
class Server
{
    private $_soapServer = null;
 
    public function __construct()
    {
        require_once(getcwd() . '/lib/nusoap.php');
        require_once(getcwd() . '/Service.php');
        $this->_soapServer = new soap_server();
        $this->_soapServer->configureWSDL("Salvador+Plus+WebService");

		$this->_soapServer->register(
		    "Service.PedirDatosUsuario",
		    array('datos' => "tns:datos_validar_usuario"),
		    array("return" => "tns:datos_usuario"),
		    false,
		    false,
		    "rpc",
		    "encoded",
		    "Servicio que devuelve los datos de un usuario especifico"
		);

		$this->_soapServer->wsdl->addComplexType('datos_validar_usuario', 
          	'complexType', 
	        'struct', 
	        'all', 
	        '', 
	        array('codigosalon' => array('name' => 'codigosalon', 'type' => 'xsd:string'),
                'token' => array('name' => 'token', 'type' => 'xsd:string'),
                'usuario' => array('name' => 'usuario', 'type' => 'xsd:string'),
                'hash' => array('name' => 'hash', 'type' => 'xsd:string')
		));
		
		$this->_soapServer->wsdl->addComplexType('datos_usuario', 
          	'complexType', 
	        'struct', 
	        'all', 
	        '', 
	        array('codigousuario' => array('name' => 'codigousuario', 'type' => 'xsd:string'),
                'nombrecompleto' => array('name' => 'token', 'type' => 'xsd:string'),
				'codigoerror' => array('name' => 'codigoerror', 'type' => 'xsd:string'),
                'mensajeerror' => array('name' => 'mensajeerror', 'type' => 'xsd:string'),
                'codigocorporativo' => array('name' => 'codigocorporativo', 'type' => 'xsd:integer'),				
                'nivel' => array('name' => 'nivel', 'type' => 'xsd:integer')                
		));
		
		
		 
		//procesamos el webservice
		$this->_soapServer->service(file_get_contents("php://input"));

    }
}
$server = new Server();