<?
	define("NO_KEEP_STATISTIC", true); //Не учитываем статистику
	define("NOT_CHECK_PERMISSIONS", true); //Не учитываем права доступа
	if(!$_SERVER["DOCUMENT_ROOT"])$_SERVER["DOCUMENT_ROOT"]="/home/bitrix/www";
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	$APPLICATION->SetTitle("Обновление курса (раз в час)");
	$server="www.cbr.ru";
	$port="80";
	$path="/scripts/XML_daily.asp?date_req=".date("d/m/Y");
	$headers = "GET ".$path." HTTP/1.1\r\n"
				."Host: ".$server."\r\n"
				."Connection: Close"."\r\n"
				."\r\n"
				."";
	$fp = fsockopen($server,$port,$errno,$errstr,2) or die('Error '.$errno.': '.$errstr);
	if($fp){
		fwrite($fp,$headers);
		$result="";
		while(!feof($fp))
			$result.=fread($fp,1024);
		fclose($fp);
		$result=explode("\r\n\r\n",$result);
		$result=json_decode(json_encode(new SimpleXMLElement($result[1])),TRUE);
		$kurs=array();
		$need=array("USD","EUR","CNY");
		foreach($result["Valute"] as $val){
			if(in_array($val["CharCode"],$need))$kurs[strtolower($val["CharCode"])]=(str_replace(",",".",$val["Value"])*1.0)/($val["Nominal"]*1.0);
		}
		file_put_contents($_SERVER["DOCUMENT_ROOT"]."/currentkurs.txt",json_encode($kurs));
	}
?>