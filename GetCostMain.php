


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
?>


<?


function calcMax($from,$to,$weight,$vol){
	$data=array(
		"Type"=>1,
		"ID_OfficeOut"=>$from,
		"ID_OfficeIn"=>$to,
		"JSON_BOX"=>array(
			array(
				"ID"=>1,
				"Val"=>$weight
			),
			array(
				"ID"=>2,
				"Val"=>$vol
			)
		),
		"JSON_MarkUp"=>array(
               array("ID"=>4, 
					 "ID_BOX"=>1, 
					 "Val_BOX"=>5000.00
			    ),
                array("ID"=>4, 
					  "ID_BOX"=>2, 
					  "Val_BOX"=>2.003
			    )
		),
		"JSON_BOXDeliveryOut"=>array(
		array("ID"=>1, "Val"=>5000.00),
  		array("ID"=>5, "Val"=>11),
		array("ID"=>2, "Val"=>2.003)
		),
		"JSON_BOXDeliveryIn"=>array(
		array("ID"=>1, "Val"=>5000.00), 
		array("ID"=>5, "Val"=>11),
		array("ID"=>2, "Val"=>2.003)
		),
		"JSON_ServiceOut"=>array(
		array("ID"=>126, "Count"=>10, "BOX"=>array(array("ID"=>1, "Val"=>2000.00),array("ID"=>2, "Val"=>1.05))),
		array("ID"=>121, "Count"=>0, "BOX"=>array(array( "ID"=>1, "Val"=>5000.00),array("ID"=>2, "Val"=>2.003)))
		),
		"JSON_ServiceIn"=>array(
		array("ID"=>126, "Count"=>10, "BOX"=>array(array("ID"=>1, "Val"=>2000.00),array("ID"=>2, "Val"=>1.05))),
		array("ID"=>121, "Count"=>0, "BOX"=>array(array( "ID"=>1, "Val"=>5000.00),array("ID"=>2, "Val"=>2.003)))
		)
	);
	$result=requestRest("GetCostMain",$data,false);
	$result=json_decode($result,true);
	$result=$result['result'][0]['Calc'][0];
	return $result;
}



?>

<pre><? print_r(calcMax("236", "267", "40", "1")); ?></pre>
