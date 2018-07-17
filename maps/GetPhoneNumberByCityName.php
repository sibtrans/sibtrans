<?
	define("NO_KEEP_STATISTIC", true); //Не учитываем статистику
	define("NOT_CHECK_PERMISSIONS", true); //Не учитываем права доступа
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	header('Content-Type: text/html; charset=utf-8', true);
	session_start();


	if(!empty($_POST['selected'][0]['PhoneCity'])){
			$_SESSION['PhoneCity'] = $_POST['selected'][0]['PhoneCity'];
	}else{
		?><pre><?print_r($_SESSION['PhoneCity']);?></pre><?
	}


 ?>