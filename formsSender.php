<?
define("NO_KEEP_STATISTIC", true); //Не учитываем статистику
define("NOT_CHECK_PERMISSIONS", true); //Не учитываем права доступа
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if($_SERVER['REQUEST_METHOD']!="POST")die();
if((!isset($_POST['action']))||($_POST["action"]==""))die(json_encode(array("result"=>"error","msg"=>"Неизвестный идентификатор действия")));
$act=$_POST["action"];
$_REQUEST=array();
$FORM_ID=-1;
switch($act){
	case "callback":
		$FORM_ID=2;
		$_REQUEST=array(
			"form_text_4" => $_POST["fio"], //ФИО
			"form_text_5" => $_POST["dt"]." ".$_POST["tm"], // Время
			"form_text_6" => $_POST["phone_country"]."-".$_POST["phone_city"]."-".$_POST["phone_number"] // телефон
		);
		break;
	case "callback2":
		$FORM_ID=4;
		$_REQUEST=array(
			"form_text_10" => $_POST["fio"], //ФИО
			"form_text_11" => $_POST["dt"]." ".$_POST["tm"], // Время
			"form_text_12" => $_POST["phone_country"]."-".$_POST["phone_city"]."-".$_POST["phone_number"] // телефон
		);
		break;
	case "lc-msg":
		$FORM_ID=3;
		$_REQUEST=array(
			"form_text_7" => $_POST["who"], //ФИО
			"form_text_8" => $_POST["subj"], // Время
			"form_text_9" => $_POST["text"] // телефон
		);
		break;
	case "os-mail":
		$FORM_ID=5;
		$_REQUEST=array(
			"form_text_13" => $_POST["fio"], //ФИО
			"form_text_14" => $_POST["subject"], // Тема
			"form_text_15" => $_POST["message"], // 
			"form_text_19" => $_POST["phone"], // телефон
			"form_text_20" => $_POST["email"] // 
		);
		break;
	case "os-idea":
		$FORM_ID=6;
		$_REQUEST=array(
			"form_text_16" => $_POST["fio"], //ФИО
			"form_text_17" => $_POST["email"], // 
			"form_text_18" => $_POST["message"] // 
		);
		break;
	default:
		die(json_encode(array("result"=>"error","msg"=>"Неизвестный идентификатор действия ("+$act+")")));
		break;
}
	CModule::IncludeModule('form');
	$result=array(
		"state"=>"",
		"data"=>""
	);
	$error=CForm::Check($FORM_ID);
	if (strlen($error)<=0){
		$r=CFormResult::Add($FORM_ID,$_REQUEST);
		CFormResult::Mail($r);
		$result["state"]="success";
		$result["data"]=$r;
	} else {
		$result["state"]="error";
		$result["data"]=$error;
	}
	echo json_encode($result);
?>