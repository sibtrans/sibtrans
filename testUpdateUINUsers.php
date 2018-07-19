<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");



/*function UpdateUINUsers (){
	
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
	
}*/

/*function UpdateUINUsers (){
	
	$filter = Array
        (
        "GROUP_ID" => 7,
		"!UF_UN" => "",
		"=UF_SS_CODE" => ""
    );
	
	$rsUsers = CUser::GetList(($by = "id"), ($order = "desc"), $filter, array("SELECT" =>array("UF_UN", "UF_SS_CODE")));
	
	$result = array();
	$int = 0;
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
		
		$arUser["UF_SS_CODE"] = $ss_code;
		$result[$int] = $arUser;
		
		$int++;
	}
	return $result;
	
}*/

/*$result = UpdateUINUsers();

echo "<pre>";
print_r($result);
echo "</pre>";*/

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");