<?
define("NO_KEEP_STATISTIC", true); //Не учитываем статистику
define("NOT_CHECK_PERMISSIONS", true); //Не учитываем права доступа
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if($_SESSION['ss_code'] != ''){
	$r = getUserRequest($_POST['un'], $_SESSION['ss_code'], $_POST['code_1c']);
	echo $r;
}

?>