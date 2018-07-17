<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>

<?

// подключение API Bitrix
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");
 
global $DB;

		$DB->Query("TRUNCATE TABLE  my_CharacterCargo");
		$DB->Query("TRUNCATE TABLE  my_Service");
		$DB->Query("TRUNCATE TABLE  my_ServiceInOffice");
		$DB->Query("TRUNCATE TABLE  my_BOX");
	    $DB->Query("TRUNCATE TABLE  my_TypeMarkUp");
        $DB->Query("TRUNCATE TABLE  my_TypeMarkUpForOffice");



       echo mysql_error();

?>



<?


$fp = fsockopen("212.20.61.195",80,$errno,$errstr) or die('Error '.$errno.': '.$errstr);
		if($fp)
			{
			$data=array(
				"CodeWord"=>"HFUEnfueGFoefn7834HIFe7438HUIFeo643JFIEfgh",
			);
			$data=json_encode($data);

			$headers = "POST /SiteS/DataWEBDLL.dll/datasnap/rest/TServerMethods1/LoadServiceMarkUp/ HTTP/1.1\r\n"
					."Host: 212.20.61.195"."\r\n"
					."Connection: Close"."\r\n"
					."Content-type: application/x-www-form-urlencoded\r\n"
					."Content-Length: ".strlen($data)."\r\n\r\n"
					.$data;


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





				$result = $result["result"][0];

				$Service = $result["Service"];


            foreach($Service as $S)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_Service` (`ID`, `Name`, `ID_BOX`)
				VALUES ('".$S["ID"]."', '".$S["Name"]."', '".$S["ID_BOX"]."')"; 

              
 				$DB->Query($sql);
                 echo mysql_error();
				$sql = "";
            }



			$ServiceInOffice = $result["ServiceInOffice"];

            foreach($ServiceInOffice as $SiO)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_ServiceInOffice` (`ID`, `ID_Office`, `ID_Service`, `ID_BOX`)
				VALUES ('".$SiO["ID"]."', '".$SiO["ID_Office"]."', '".$SiO["ID_Service"]."' , '".$SiO["ID_BOX"]."')"; 

              
 				$DB->Query($sql);
                 echo mysql_error();
            }


	       $BOX = $result["BOX"];

            foreach($BOX as $B)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_BOX` (`ID`, `Name`, `Capacity`)
				VALUES ('".$B["ID"]."', '".$B["Name"]."' , '".$B["Capacity"]."')"; 


 				$DB->Query($sql);
                 echo mysql_error();
            }


            $TypeMarkUp = $result["TypeMarkUp"];

            foreach($TypeMarkUp as $TM)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_TypeMarkUp` (`ID`, `Name`, `ShortName`)
				VALUES ('".$TM["ID"]."', '".$TM["Name"]."' , '".$TM["ShortName"]."')"; 


 				$DB->Query($sql);
                 echo mysql_error();
            }


             $TypeMarkUpForOffice = $result["TypeMarkUpForOffice"];

            foreach($TypeMarkUpForOffice as $TMFO)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_TypeMarkUpForOffice` (`ID_MarkUp`, `ID_OfficeOut`, `TypeOfficeIn`)
				VALUES ('".$TMFO["ID_MarkUp"]."', '".$TMFO["ID_OfficeOut"]."' , '".$TMFO["TypeOfficeIn"]."')"; 


 				$DB->Query($sql);
                 echo mysql_error();
            }

			}
?>




<?


$fp = fsockopen("212.20.61.195",80,$errno,$errstr) or die('Error '.$errno.': '.$errstr);
		if($fp)
			{
			$data=array(
				"CodeWord"=>"HFUEnfueGFoefn7834HIFe7438HUIFeo643JFIEfgh",
			);
			$data=json_encode($data);

			$headers = "POST /SiteS/DataWEBDLL.dll/datasnap/rest/TServerMethods1/LoadCharacterCargo/ HTTP/1.1\r\n"
					."Host: 212.20.61.195"."\r\n"
					."Connection: Close"."\r\n"
					."Content-type: application/x-www-form-urlencoded\r\n"
					."Content-Length: ".strlen($data)."\r\n\r\n"
					.$data;


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




				$result = $result["result"][0];
				$CharacterCargo = $result["CharacterCargo"];






           foreach($CharacterCargo as $C)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_CharacterCargo` (`ID`, `Name`)
				VALUES ('".$C["ID"]."', '".$C["Name"]."')"; 


 				$DB->Query($sql);
                 echo mysql_error();
            }

			


			}

?>
