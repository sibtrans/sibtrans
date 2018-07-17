<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
if($USER->isAuthorized()){
	$rsUser = CUser::GetList(($by="ID"), ($order="asc"), array("ID"=>$USER->GetID()), array("SELECT"=>array("UF_UN", "UF_SS_CODE")))->Fetch(); //$USER->GetID()
}



if(CSite::InDir('/cost-calculation/')){
	$uid= $USER->GetID(); //$USER->GetID(); //$USER->GetID();
	if($uid=="")$uid=-1;
	$rsUser = CUser::GetList(($by="ID"), ($order="asc"), array("ID"=>$uid), array("SELECT"=>array("UF_UN", "UF_SS_CODE")))->Fetch();
	$un=$rsUser["UF_UN"];
	$code_1c = $rsUser["UF_SS_CODE"];
	$uInfo=array();
	$FA="N";
	if($un!=""){
		$uInfo=getUserInfo($un);
		$uInfo=$uInfo["klc"];
		
		$FA="Y";
	}
	if($code_1c!=''){
		$uInfo["code_1c"]=$code_1c;
	}else{
		if($un!=""){
			$code_1c_arr = getUIN($un);
			$code_1c_arr = json_decode($code_1c_arr, true);
			$uInfo["code_1c"] = $code_1c_arr['contragents'][0]['ss_code'];
		}
	}
	foreach($uInfo as $k=>$v){
		if((is_array($v))&&(count($v)==0))$uInfo[$k]="";
	}
}

echo json_encode($uInfo);

?>


