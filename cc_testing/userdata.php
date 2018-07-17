<?
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
if($USER->isAuthorized()){
	$rsUser = CUser::GetList(($by="ID"), ($order="asc"), array("ID"=>$USER->GetID()), array("SELECT"=>array("UF_UN")))->Fetch(); //$USER->GetID()
}



if(CSite::InDir('/cost-calculation/')){
	$uid= $USER->GetID(); //$USER->GetID(); //$USER->GetID();
	if($uid=="")$uid=-1;
	$rsUser = CUser::GetList(($by="ID"), ($order="asc"), array("ID"=>$uid), array("SELECT"=>array("UF_UN")))->Fetch();
	$un=$rsUser["UF_UN"];
	$uInfo=array();
	$FA="N";
	if($un!=""){
		$uInfo=getUserInfo($un);
		$uInfo=$uInfo["klc"];
		$FA="Y";
	}
	foreach($uInfo as $k=>$v){
		if((is_array($v))&&(count($v)==0))$uInfo[$k]="";
	}
}

echo json_encode($uInfo);

?>


