<?
	function requestSoap($proc,$params){
		$soap=new SoapClient('http://212.20.61.195/SiteS/SiteS.WSDL');
		$result = $soap->__soapCall($proc,$params);
		return $result;
	}
?>