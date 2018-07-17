<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?> Text here....<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"",
	Array(
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.73829999999371;s:10:\"yandex_lon\";d:37.59459999999997;s:12:\"yandex_scale\";i:10;s:10:\"PLACEMARKS\";a:3:{i:0;a:3:{s:3:\"LON\";d:44.25613234687012;s:3:\"LAT\";d:55.74298747999916;s:4:\"TEXT\";i:234234234;}i:1;a:3:{s:3:\"LON\";d:45.00869582343261;s:3:\"LAT\";d:55.49273736178402;s:4:\"TEXT\";s:10:\"gdfgdfgdfg\";}i:2;a:3:{s:3:\"LON\";d:45.89858840155761;s:3:\"LAT\";d:55.284797139728;s:4:\"TEXT\";s:9:\"dfgdfgdfg\";}}}",
		"MAP_WIDTH" => "600",
		"MAP_HEIGHT" => "500",
		"CONTROLS" => array("ZOOM", "MINIMAP", "TYPECONTROL", "SCALELINE"),
		"OPTIONS" => array("ENABLE_SCROLL_ZOOM", "ENABLE_DBLCLICK_ZOOM", "ENABLE_DRAGGING"),
		"MAP_ID" => ""
	),
false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>