<?
	function requestRest($proc,$data,$debug=false){
		$server="212.20.61.195";
		$port="80";
		$path="/SiteS/DataWEBDLL.dll/datasnap/rest/TServerMethods1/";
		$auth=array("CodeWord"=>"HFUEnfueGFoefn7834HIFe7438HUIFeo643JFIEfgh");
		$data=array_merge($data,$auth);
		$data=json_encode($data);
		$headers = "POST ".$path.$proc."/ HTTP/1.1\r\n"
					."Host: ".$server."\r\n"
					."Connection: Close"."\r\n"
					."Content-type: application/x-www-form-urlencoded\r\n"
					."Content-Length: ".strlen($data)."\r\n\r\n"
					.$data;
		if($debug)print_r($headers);
		$fp = fsockopen($server,$port,$errno,$errstr) or die('Error '.$errno.': '.$errstr);
		if($fp){
			fwrite($fp,$headers);
			$result="";
			while(!feof($fp))
				$result.=fread($fp,1024);
			fclose($fp);
			if($debug) echo "\r\n\r\n\r\n";
			if($debug)print_r($result);
			$result=preg_replace('^HTTP[\/0-9\.\ A-Za-z\:\-\,\;\=\r\n()]*[\r\n]*^','',$result);
			if($debug) echo "\r\n\r\n\r\n";
			if($debug)print_r($result);
			return $result;
		}
	}

function requestRest2($url,$data,$debug=false){
	$server="212.20.61.195";
		$port="80";
		$data=json_encode($data);
		$headers = "POST ".$url." HTTP/1.1\r\n"
					."Host: ".$server."\r\n"
					."Connection: Close"."\r\n"
					."Content-type: application/x-www-form-urlencoded\r\n"
					."Content-Length: ".strlen($data)."\r\n\r\n"
					.$data;
		if($debug)print_r($headers);
		$fp = fsockopen($server,$port,$errno,$errstr) or die('Error '.$errno.': '.$errstr);
		if($fp){
			fwrite($fp,$headers);
			$result="";
			while(!feof($fp))
				$result.=fread($fp,1024);
			fclose($fp);
			if($debug) echo "\r\n\r\n\r\n";
			if($debug)print_r($result);
			$result=preg_replace('^HTTP[\/0-9\.\ A-Za-z\:\-\,\;\=\r\n()]*[\r\n]*^','',$result);
			if($debug) echo "\r\n\r\n\r\n";
			if($debug)print_r($result);
			return $result;
		}
}


function getUIN($un){
	$fp = fsockopen("212.20.61.195",80,$errno,$errstr) or die('Error '.$errno.': '.$errstr);
	if($fp){
	
		$data = '{"contragents": [{"UN": "'.$un.'"}]}';
		$headers = "POST http://212.20.61.195//KA_Limarev/hs/ServiceAPI/getUIN HTTP/1.1\r\n"
			."Host: 212.20.61.195"."\r\n"
			."Connection: Close"."\r\n"
			."Content-type: application/x-www-form-urlencoded\r\n"
			."Content-Length: ".strlen($data)."\r\n\r\n"
			.$data;
		fwrite($fp,$headers);
		$result="";
		while(!feof($fp)){
			$result.=fread($fp,1024);
		}
		fclose($fp);	
		$result=preg_replace('^HTTP[\/0-9\.\ A-Za-z\:\-\,\;\=\r\n()]*[\r\n]*^','',$result);
		return $result;
	}
}

?>