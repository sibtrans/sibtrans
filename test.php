<?
//SiteS/DataWEBDLL.dll/datasnap/rest/TServerMethods1/test/
$fp = fsockopen("212.20.61.195",80,$errno,$errstr) or die('Error '.$errno.': '.$errstr);
		if($fp){
			$data=array(
				"CodeWord"=>"HFUEnfueGFoefn7834HIFe7438HUIFeo643JFIEfgh",
				"Type"=>0,
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
						"JSON_MarkUp"=>"",
						"JSON_BOXDeliveryOut"=>"",
						"JSON_BOXDeliveryIn"=>"",
						"JSON_ServiceOut"=>"",
						"JSON_ServiceIn"=>""
			);
			$data=json_encode($data);
			
			$headers = "POST /SiteS/DataWEBDLL.dll/datasnap/rest/TServerMethods1/GetCostMain/ HTTP/1.1\r\n"
					."Host: 212.20.61.195"."\r\n"
					."Connection: Close"."\r\n"
					."Content-type: application/x-www-form-urlencoded\r\n"
					."Content-Length: ".strlen($data)."\r\n\r\n"
					.$data;
			?><pre><?echo $headers;?></pre><?
			// 



		}
?>