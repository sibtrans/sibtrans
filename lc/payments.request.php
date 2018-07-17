<?
define("NO_KEEP_STATISTIC", true); //Не учитываем статистику
define("NOT_CHECK_PERMISSIONS", true); //Не учитываем права доступа
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$data=array();
foreach($_POST as $key=>$value){
	$data[trim(strip_tags(htmlspecialchars($key)))]=trim(strip_tags(htmlspecialchars($value)));
}

	echo getPayments($data);
?>