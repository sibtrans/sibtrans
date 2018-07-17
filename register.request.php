<?
define("NO_KEEP_STATISTIC", true); //Не учитываем статистику
define("NOT_CHECK_PERMISSIONS", true); //Не учитываем права доступа
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$un=$_POST["un"];


if($un=="")die('{"result":"error","msg":"unique failed"}');
if(strlen($un)!=8)die('{"result":"error","msg":"unique length"}');
$rsUser = CUser::GetList(($by="ID"), ($order="asc"), array("UF_UN"=>$un), array("SELECT"=>array("UF_UN")))->Fetch();
if(isset($rsUser["ID"])){
	die('{"result":"error","msg":"user exists"}');
}
$data=getUserInfo($un);


if(!isset($data["klc"]))die('{"result":"error","msg":"unknown uid"}');
$data=$data["klc"];
$user = new CUser;
$group_id=array();
$rsGroups = CGroup::GetList ($by = "c_sort", $order = "asc", Array ("STRING_ID" => "client_grp"))->Fetch();
$group_id[]= $rsGroups["ID"];
$email=($data["email"]!="")?$data["email"]:$data["email2"];
$arFields = Array(
	"EMAIL"             => $email,
	"LOGIN"             => $email,
	"GROUP_ID"          => $group_id,
	"UF_UN"				=> $un
);
$arAdd=array(
	"PASSWORD"			=> $un,
	"CONFIRM_PASSWORD"	=> $un,
	"ACTIVE"			=> "Y",
	"TIMESTAMP_X"		=> ConvertTimeStamp(time(),"FULL"),
	"WORK_COMPANY"		=> $data["org"]." ".$data["firma"],
);
$arFields=array_merge($arFields,$arAdd);
COption::SetOptionString("main","new_user_email_uniq_check","N");
$ID = $user->Add($arFields);
COption::SetOptionString("main","new_user_email_uniq_check","Y");
if(!$ID)die('{"result":"error","msg":"'.$user->LAST_ERROR.'"}');
GLOBAL $USER;
$USER->Authorize($ID);
?>{"result":"ok","login":"<?=$email;?>","psw":"<?=$un;?>"}