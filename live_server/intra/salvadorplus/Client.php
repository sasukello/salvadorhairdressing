<?php
 
class Client
{
    private $_soapClient = null;
 
    public function __construct()
    {
        require_once(getcwd() . '/lib/nusoap.php');
        $this->_soapClient= new nusoap_client("http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '/Server.php?wsdl');
        $this->_soapClient->soap_defencoding = 'UTF-8';
    }

	public function PedirDatosUsuario()
	{
	    try
	    {
	        $result = $this->_soapClient->call('Service.PedirDatosUsuario', array('codigosalon' => 'S11', 'token' => md5('0908S112018'), 'usuario' => 'ALUGO', 'hash' => '521902006369'));
	        $this->_soapResponse($result);
	 
	    }
	    catch (SoapFault $fault)
	    {
	        trigger_error("SOAP Fault: (faultcode: {$fault->faultcode}, faultstring: {$fault->faultstring})", E_USER_ERROR);
	    }
	}

	/**
	 * @param $result
	 */
	private function _soapResponse($result)
	{
	    echo '<h2>Result</h2>';
	    echo '<h2>Request</h2>' . print_r($result);
	    echo '<h2>XML Response</h2>';
	    echo $this->_soapClient->responseData;
	    echo '<h2>Request</h2>' . htmlspecialchars($this->_soapClient->request, ENT_QUOTES);
	    echo '<h2>Response</h2>' . htmlspecialchars($this->_soapClient->response, ENT_QUOTES);
	    echo '<h2>Debug</h2>' . htmlspecialchars($this->_soapClient->debug_str, ENT_QUOTES);
	}

}