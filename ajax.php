<?
	define("NO_KEEP_STATISTIC", true); //Не учитываем статистику
	define("NOT_CHECK_PERMISSIONS", true); //Не учитываем права доступа
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	$APPLICATION->SetTitle("Интерфейс работы с БД (ajax)");
	header('Content-Type: text/html; charset=utf-8', true);
	if($_SERVER["REQUEST_METHOD"]!="POST"){
		die();
	}
	$params=array();
	foreach($_POST as $key=>$value){
		$params[$key]=trim(strip_tags(htmlspecialchars(strip_data($value))));
	}
	if(isset($params["proc"])){
		switch($params["proc"]){
			case "miniCalc":
				$from=$params["from"];
				$to=$params["to"];
				$w=$params["w"];
				$v=$params["v"];
				if((!$from)||(!$to)||(!$w)||(!$v)){
					echo "{'error':'parameters error'}";
					break;
				}
				echo json_encode(calcMini($from,$to,$w,$v));
				//echo json_encode(calcMini(267,223,50,1));
				break;
			case "deliveryStatus":
				$dn=$params["from"];
				echo json_encode(deliveryStatus($dn));
				break;
			default:
				echo "{'error':'procedure error'}";
				break;
		}
	}
?>