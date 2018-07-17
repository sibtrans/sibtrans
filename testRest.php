<?
//SiteS/DataWEBDLL.dll/datasnap/rest/TServerMethods1/test/
/*$fp = fsockopen("212.20.61.195",80,$errno,$errstr) or die('Error '.$errno.': '.$errstr);
		if($fp)
			{
			$data=array(
				"CodeWord"=>"HFUEnfueGFoefn7834HIFe7438HUIFeo643JFIEfgh",
			);
			$data=json_encode($data);
			
			$headers = "POST /SiteS/DataWEBDLL.dll/datasnap/rest/TServerMethods1/LoadDepartmentForWEB/ HTTP/1.1\r\n"
					."Host: 212.20.61.195"."\r\n"
					."Connection: Close"."\r\n"
					."Content-type: application/x-www-form-urlencoded\r\n"
					."Content-Length: ".strlen($data)."\r\n\r\n"
					.$data;
			?><pre><?echo $headers;?></pre><?
			// 
			// $headers = "POST /php/doquery.utf8.php HTTP/1.1\r\n"
					// ."Host: plk-work.vector-best.ru"."\r\n"
					// ."Connection: Close"."\r\n"
					// ."Content-type: application/x-www-form-urlencoded\r\n"
					// ."Content-Length: ".strlen($data)."\r\n\r\n"
					// .$data;
			fwrite($fp,$headers);
			$result="";
			while(!feof($fp))
				$result.=fread($fp,1024);
			fclose($fp);



			$result=preg_replace('^HTTP[\/0-9\.\ A-Za-z\:\-\,\;\=\r\n()]*[\r\n]*^','',$result);





			$result=json_decode($result,true);

?><pre><? print_r($result);?></pre><?


			//

			$result=$result["result"][0];
			///Список городов
			$f=array();
			$of=array();
			foreach($result["Office"] as $o)
			{
				$of[$o["ID"]]=$o;
				unset($of[$o["ID"]]["ID"]);

			}
			foreach($result["OfficeItems"] as $o)
			{
				if(!isset($f[$o["ID_Office"]]))
				{
					$f[$o["ID_Office"]]=array(
						"Name"=>$of[$o["ID_Office"]]["Name"],
						"Cities"=>array(
							$o["ID_Office"]=>$of[$o["ID_Office"]]["Name"]
						)
					);
				}
				$f[$o["ID_Office"]]["Cities"][$o["ID_OfficeItem"]]=$of[$o["ID_OfficeItem"]]["Name"];
			}
?><pre><? print_r($f);?></pre><?
			//
			//$result=unserialize($result);
		}*/
/*function requestRest2($url,$data,$debug=false){
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
}*/

/*$data = array(
	'ss_code' => 'd7e8364c-9df1-11e7-aef7-0cc47aa9af59'
);*/
/*$data = array(
	'ss_code' => 'd8b67f8b-9ded-11e7-aef7-0cc47aa9af59',
	'link_1C' => '62c4a3dc-790b-11e8-bc8b-0cc47aa9af59'
);
	
$r = requestRest2('http://212.20.61.195//KA_Limarev/hs/ServiceAPI/getRequest/', $data, false);

echo strlen($r);
echo "<br />";
echo "<pre>";
print_r($r);
echo "</pre>";*/


/*function getUIN(){
	$fp = fsockopen("212.20.61.195",80,$errno,$errstr) or die('Error '.$errno.': '.$errstr);
	if($fp){
	
		$data = '{"contragents": [{"ss_code": "5bf4e03d-9df3-11e7-aef7-0cc47aa9af59","UN": "PPH269PI"}]}';
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
		
		print_r($result);
		//return $result;
	}
}
getUIN();*/
function getUIN(){
	$un = 'K1A7421B';
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
		//print_r($result);
		return $result;
	}
}
$result = getUIN();
print_r(json_decode($result, true));
echo "<br />4";



?>
<script>
	var urlArr = location.href.split('/');
	console.log(urlArr);
</script>