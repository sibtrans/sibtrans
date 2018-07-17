<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>


<?

// подключение API Bitrix
require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");
 
global $DB;



		$DB->Query("TRUNCATE TABLE  my_List");
		$DB->Query("TRUNCATE TABLE  my_Top");
		$DB->Query("TRUNCATE TABLE  my_Line");
		$DB->Query("TRUNCATE TABLE  my_Cell");
	    $DB->Query("TRUNCATE TABLE  my_Office");
        $DB->Query("TRUNCATE TABLE  my_OfficeItems");





?>




<?


$fp = fsockopen("212.20.61.195",80,$errno,$errstr) or die('Error '.$errno.': '.$errstr);
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


				//print_r($result);

			$result=json_decode($result,true);




			$result = $result["result"][0];
            $Office = $result["Office"];

            foreach($Office as $O)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_Office` (`ID`, `Name`, `Type`)
				VALUES ('".$O["ID"]."', '".$O["Name"]."', '".$O["Type"]."')"; 

              
 				$DB->Query($sql);
				// echo mysql_error();
            }

            $OfficeItems = $result["OfficeItems"];

            foreach($OfficeItems as $OI)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_OfficeItems` (`ID_Office`, `ID_OfficeItem`)
				VALUES ('".$OI["ID_Office"]."', '".$OI["ID_OfficeItem"]."')"; 

              
 				$DB->Query($sql);
				// echo mysql_error();
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

			$headers = "POST /SiteS/DataWEBDLL.dll/datasnap/rest/TServerMethods1/LoadPriceForWEB/ HTTP/1.1\r\n"
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

				//print_r($result);


			$result=json_decode($result,true);




			$result = $result["result"][0];
			$List = $result["List"];



            foreach($List as $L)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_List` (`ID`, `ID_Office`, `ID_TypeList`,  `MarkUpShort`, `MarkUp`)
				VALUES ('".$L["ID"]."', '".$L["ID_Office"]."', '".$L["ID_TypeList"]."', '".$L["MarkUpShort"]."', '".$L["MarkUp"]."')"; 


 				$DB->Query($sql);
				//echo mysql_error();
            }

            $Top = $result["Top"];

			?><pre><? //print_r($Top); ?><pre><?

			?><pre><?// print_r($result["Top"]); ?><pre><?


			$countTopID = 1;

            foreach($Top as $T)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_Top` (`ID`, `ID_List`, `Numpp`,  `Name`)
				VALUES ('".$countTopID."', '".$T["ID_List"]."', '".$T["Numpp"]."', '".$T["Name"]."')"; 

				$countTopID++;

 				$DB->Query($sql);
				 echo mysqli_connect_error();
            }


			$Line = $result["Line"];

            foreach($Line as $Li)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_Line` (`ID`, `ID_List`, `ID_Office`)
				VALUES ('".$Li["ID"]."', '".$Li["ID_List"]."', '".$Li["ID_Office"]."')"; 

 				$DB->Query($sql);
				//echo mysql_error();
            }



			$Cell = $result["Cell"];

            foreach($Cell as $C)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_Cell` (`ID`, `ID_Line`, `Numpp`, `Name`)
				VALUES ('".$C["ID"]."', '".$C["ID_Line"]."', '".$C["Numpp"]."', '".$C["Name"]."')"; 

 				$DB->Query($sql);
				//echo mysql_error();
            }


        }  


?>









