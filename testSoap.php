



<?

ini_set("display_errors","1");


function showXML($t){
	return trim(str_replace("<","&lt;",$t));
}
$soap=new SoapClient('http://212.20.61.195/SiteS/SiteS.WSDL');
?><pre><?print_r($soap->__getFunctions());?></pre><?
?><pre><?//print_r($soap->GetMInfo(1577589));?></pre><?
?><pre><?//print_r($soap->__soapCall("GetMInfo",array(1577589)));?></pre><?
$r=$soap->__soapCall("KlMovingsU",array("IN4936N5",100,0));
?><pre><?echo showXML($r);?></pre><?
?><pre><?print_r(new SimpleXMLElement($r));?></pre><?
?><pre><?print_r(json_decode(json_encode(new SimpleXMLElement($r)),TRUE));?></pre><?
//$r=$soap->__soapCall("KlMovingsP",array("IN4936N5","","","","","","",100,0));
?><pre><?//echo showXML($r);?></pre><?
//print_r($soap->TestHello("asdasd"));
//print_r($soap->testcom.TestWrkResponse()));

?>


