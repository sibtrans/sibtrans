<?
ini_set("dispay_errors",true);
include('rest.php');
include('soap.php');
GLOBAL $filialsArray;
AddEventHandler("main", "OnAfterUserAuthorize", "OnAfterUserAuthorizeHandler");
AddEventHandler("main", "OnAdminTabControlBegin", "MyOnAdminTabControlBegin");
// AddEventHandler("main", "OnEpilog", "_Check404Error");
	// function _Check404Error(){
		// if(defined('ERROR_404') && ERROR_404=='Y' || CHTTP::GetLastStatus() == "404 Not Found"){
			// GLOBAL $APPLICATION;
			// $APPLICATION->RestartBuffer();
			
			// require $_SERVER['DOCUMENT_ROOT'].'/404.php';
			
		// }
	// }
function OnAfterUserAuthorizeHandler($arUser){
	if($_SERVER['PHP_SELF']!="/register.request.php"){
		$path='/lc/';
		LocalRedirect($path);
	}
} 
function MyOnAdminTabControlBegin(&$form){
	if($GLOBALS["APPLICATION"]->GetCurPage() == "/bitrix/admin/fileman_menu_edit.php"){
		CJSCore::Init(array("jquery"));
		?>
			<script type="text/javascript">
				$(document).ready(function(){
					$('input').each(function(){
						var nm=$(this).attr('name');
						if(typeof nm != "undefined"){
							if(nm.indexOf('param_value')!=-1){
								var inp=$(this);
								var area=$('<textarea></textarea>');
								area.attr("name",nm);
								area.html(inp.val());
								area.css("width","300px");
								area.css("height","100px");
								inp.replaceWith(area);
							}
						}
					});
				});
			</script>
		<?
	}
}
function strip_data($text)
	{
		$quotes = array ("\x27", "\x22", "\x60", "\t", "\n", "\r", "*", "%", "<", ">", "?", "!" );
		$goodquotes = array ("-", "+", "#" );
		$repquotes = array ("\-", "\+", "\#" );
		 $text = trim( strip_tags( $text ) );
		  $text = str_replace( $quotes, '', $text );
		  $text = str_replace( $goodquotes, $repquotes, $text );
		  $text = preg_replace("'[+]'", ' ', $text);

		return $text;
	}
function dateSQL2UNI($sql){
	if(gettype($sql)!="string")return $sql;
	$a=explode("-",$sql);
	return $a[2].".".$a[1].".".$a[0];
}
function changeDates($data,$arr){
}
function getFilials(){
	GLOBAL $DB;
	//$filials=requestRest("LoadDepartmentForWEB",array());
	//$filials=json_decode($filials,true);
	//$result=$filials["result"][0];	
	$result=array(
	    "Office"=>array(),
	    "OfficeItems"=>array()
	);
	$arr_of=$DB->Query("select * from my_Office");
	while ($arr_of_item=$arr_of->Fetch()){
	    $result["Office"][]=$arr_of_item;
	}
	$arr_ofi=$DB->Query("select * from my_OfficeItems");
	while ($arr_ofi_item=$arr_ofi->Fetch()){
	    $result["OfficeItems"][]=$arr_ofi_item;
	}

	$f=array();
	$of=array();
	foreach($result["Office"] as $o){
		$of[$o["ID"]]=$o;
		unset($of[$o["ID"]]["ID"]);
		if($o["Type"]==0){
			$f[$o["ID"]]=array(
				"Name"=>$o["Name"],
				"Cities"=>array(
					$o["ID"]=>$o["Name"]
				)
			);

		}
	}

	foreach($result["OfficeItems"] as $o){
		if(!isset($f[$o["ID_Office"]])){
			//print($o["ID_Office"]."<br/>");
			$f[$o["ID_Office"]]=array(
				"Name"=>$of[$o["ID_Office"]]["Name"],
				"Cities"=>array(
					$o["ID_Office"]=>$of[$o["ID_Office"]]["Name"]
				)
			);
		}
		$f[$o["ID_Office"]]["Cities"][$o["ID_OfficeItem"]]=$of[$o["ID_OfficeItem"]]["Name"];
	}
	return $f;
}
function getCities($f=null){
	GLOBAL $filialsArray;
	$c=array();
	if(is_null($f)){
		foreach($filialsArray as $val){
			foreach($val["Cities"] as $id=>$name){
				$c[$id]=$name;
			}
			//print_r($val["Cities"]);
		}
	}else{
		$c=$filialsArray[$f]["Cities"];
	}
	asort($c);
	return $c;
}
function deliveryStatus($dn){
	$data=array(
		"nrc"=>$dn
	);
	$result=requestRest("GetMInfo",$data,true);
	//$result=json_decode($result,true);
	return $result;
}
function calcMini($from,$to,$weight,$vol){
	$data=array(
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
	$result=requestRest("GetCostMain",$data,false);
	$result=json_decode($result,true);
	$result=$result['result'][0]['Calc'][0];
	return $result;
}

function getDeliveryStatus($n){
	$r=requestSoap("GetMInfo",array($n));
	return $r;
}
function getUserInfo($un){
	$r=requestSoap("KLInfo",array($un));
	return json_decode(json_encode(new SimpleXMLElement($r)),TRUE);
}
function getUserTransportaitions($un){
	$r=requestSoap("KlMovingsU",array($un,10000,0));
	$r=json_decode(json_encode(new SimpleXMLElement($r)),TRUE);
	$k=array_keys($r)[0];
	$dc=array("data","datr","datskl","dato");
	foreach($r[$k] as $key1=>$value1){
		foreach($value1 as $key2=>$value2){
			if(in_array($key2,$dc))$r[$k][$key1][$key2]=dateSQL2UNI($value2);
		}
	}
	return json_encode($r);
}
function getUserTransportaitionsArch($data){
	$r=requestSoap("KlMovingsP",array($data["un"],$data["date_from"],$data["date_to"],$data["sender"],$data["recipient"],$data["city_from"],$data["city_to"],10000,0));
	$r=json_decode(json_encode(new SimpleXMLElement($r)),TRUE);
	$k=array_keys($r)[0];
	$dc=array("data","datr","datskl","dato");
	foreach($r[$k] as $key1=>$value1){
		foreach($value1 as $key2=>$value2){
			if(in_array($key2,$dc))$r[$k][$key1][$key2]=dateSQL2UNI($value2);
		}
	}
	return json_encode($r);
}

function getUserRequests($data){
	
	if($data['ss_code'] == ''){
		$codes = getUIN($data["un"]);
		$arr = json_decode($codes, true);
		$data['ss_code'] = $arr['contragents'][0]['ss_code'];
		$_SESSION['ss_code'] = $data['ss_code'];
	}else{
		$_SESSION['ss_code'] = $data['ss_code'];
	}
	
	$data1 = explode('.', $data['data_1']);
	$data['data_1'] = $data1[2].$data1[1].$data1[0];
	$data2 = explode('.', $data['data_2']);
	$data['data_2'] = $data2[2].$data2[1].$data2[0];
	$r=requestRest2('http://212.20.61.195//BTK_Plus/hs/ServiceAPI/getListRequests/', $data, false);
	return $r;
}
//KA_Limarev/hs/ServiceAPI
//BTK_Plus/hs/ServiceAPI
function getUserRequest($un, $ss_code, $code_1c){
	if($ss_code == ''){
		$codes = getUIN($un);
		$arr = json_decode($codes, true);
		$ss_code = $arr['contragents'][0]['ss_code'];
	}
	
	$data = array(
		'ss_code' => $ss_code,
		'link_1C' => $code_1c
	);
	$r=requestRest2('http://212.20.61.195//BTK_Plus/hs/ServiceAPI/getRequest/', $data, false);
	return $r;
	
}
function getPayments($data){
	$r=requestSoap("GetPayments",array($data["un"],$data["date_from"],$data["date_to"]));
	$r=json_decode(json_encode(new SimpleXMLElement($r)),TRUE);
	$k=array_keys($r)[0];
	$dc=array("dat","datplat","dfopl","dvvod");
	foreach($r[$k] as $key1=>$value1){
		foreach($value1 as $key2=>$value2){
			if(in_array($key2,$dc))$r[$k][$key1][$key2]=dateSQL2UNI($value2);
		}
	}
	return json_encode($r);
}
$filialsArray=getFilials();




function GetValute1(){
	 $date = date("d/m/Y");
	 $http = new CHTTP;
	 $http->HTTPQuery('GET', "https://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date);
	 $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i";
	 preg_match_all($pattern, $http->result, $out, PREG_SET_ORDER); 
    $valuta=array();
	 foreach($out as $cur) 
	 { 
		 if($cur[2] == 840) 
		 { 
			 $usd = str_replace(",", ".", $cur[4]); 

				 $valuta['usd'] = $usd; 


		 }
		 if($cur[2] == 978) 
		 { 
			  $eur = str_replace(",", ".", $cur[4]);
				   $valuta['eur'] = $eur; 

		}
		 if($cur[2] == 156) 
		 { 
			 $cny = str_replace(",", ".", $cur[4]);
			 $valuta['cny'] = $cny;   
		 } 
   }
	//$valuta=file_get_contents($_SERVER["DOCUMENT_ROOT"]."/currentkurs.txt");
	//return json_encode($valuta);


	// return file_put_contents(json_encode($valuta), );

	file_put_contents($_SERVER["DOCUMENT_ROOT"]."/currentkurs.txt", json_encode($valuta));


	return "GetValute1();";

}



function GetCharacterCargo()
{

	GLOBAL $DB;

    $result=array();

	$arr_cc = $DB->Query("select C.ID, C.Name from my_CharacterCargo as C order by C.Name");

	while ($arr_cc_item = $arr_cc->Fetch()){
	    $result[$arr_cc_item["ID"]] = $arr_cc_item["Name"];
	}


  return $result;
}


function LoadPriceDepartment1() // загрузка данных для прейскуранта
{


	// подключение API Bitrix
	//require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");
 
global $DB;



		$DB->Query("TRUNCATE TABLE  my_List");
		$DB->Query("TRUNCATE TABLE  my_Top");
		$DB->Query("TRUNCATE TABLE  my_Line");
		$DB->Query("TRUNCATE TABLE  my_Cell");
	    $DB->Query("TRUNCATE TABLE  my_Office");
        $DB->Query("TRUNCATE TABLE  my_OfficeItems");






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













			return "LoadPriceDepartment1();";
}








function LoadDataService(){

// подключение API Bitrix
	//require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/prolog_before.php");

global $DB;

		$DB->Query("TRUNCATE TABLE  my_CharacterCargo");
		$DB->Query("TRUNCATE TABLE  my_Service");
		$DB->Query("TRUNCATE TABLE  my_ServiceInOffice");
		$DB->Query("TRUNCATE TABLE  my_BOX");
	    $DB->Query("TRUNCATE TABLE  my_TypeMarkUp");
        $DB->Query("TRUNCATE TABLE  my_TypeMarkUpForOffice");



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
				// echo mysql_error();
				$sql = "";
            }



			$ServiceInOffice = $result["ServiceInOffice"];

            foreach($ServiceInOffice as $SiO)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_ServiceInOffice` (`ID`, `ID_Office`, `ID_Service`, `ID_BOX`)
				VALUES ('".$SiO["ID"]."', '".$SiO["ID_Office"]."', '".$SiO["ID_Service"]."' , '".$SiO["ID_BOX"]."')"; 

              
 				$DB->Query($sql);
				// echo mysql_error();
            }


	       $BOX = $result["BOX"];

            foreach($BOX as $B)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_BOX` (`ID`, `Name`, `Capacity`)
				VALUES ('".$B["ID"]."', '".$B["Name"]."' , '".$B["Capacity"]."')"; 


 				$DB->Query($sql);
				//echo mysql_error();
            }


            $TypeMarkUp = $result["TypeMarkUp"];

            foreach($TypeMarkUp as $TM)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_TypeMarkUp` (`ID`, `Name`, `ShortName`)
				VALUES ('".$TM["ID"]."', '".$TM["Name"]."' , '".$TM["ShortName"]."')"; 


 				$DB->Query($sql);
				// echo mysql_error();
            }


             $TypeMarkUpForOffice = $result["TypeMarkUpForOffice"];

            foreach($TypeMarkUpForOffice as $TMFO)
			{

				// sql query for INS ERT IN TO 
				$sql = "INSERT INTO `my_TypeMarkUpForOffice` (`ID_MarkUp`, `ID_OfficeOut`, `TypeOfficeIn`)
				VALUES ('".$TMFO["ID_MarkUp"]."', '".$TMFO["ID_OfficeOut"]."' , '".$TMFO["TypeOfficeIn"]."')"; 


 				$DB->Query($sql);
				// echo mysql_error();
            }

			}





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
				//echo mysql_error();
            }

			


			}

		return "LoadDataService();";
}

function UpdateUINUsers (){
	
	$filter = Array
        (
        "GROUP_ID" => 7,
		"!UF_UN" => "",
		"=UF_SS_CODE" => ""
    );
	
	$rsUsers = CUser::GetList(($by = "id"), ($order = "desc"), $filter, array("SELECT" =>array("UF_UN", "UF_SS_CODE")));
	
	while ($arUser = $rsUsers ->Fetch()){
		
		$ID = $arUser["ID"];
		$getArrServUIN = getUIN($arUser["UF_UN"]);
		$getArrServUIN = json_decode($getArrServUIN, true);
		$ss_code = $getArrServUIN['contragents'][0]['ss_code'];
		
		if($ss_code != ''){
			// add ss_code user
			$user = new CUser;
			$fields = Array(
			  "UF_SS_CODE" => $ss_code,
			  );
			$user->Update($ID, $fields);
		}
	}
	return "UpdateUINUsers();";
	
}
