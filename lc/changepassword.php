<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("авторизация");
?>
<div class="pw">
<?$APPLICATION->IncludeComponent("bitrix:main.profile", "changepsw", Array(
	"AJAX_MODE" => "N",	// Включить режим AJAX
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"CHECK_RIGHTS" => "N",	// Проверять права доступа
		"SEND_INFO" => "N",	// Генерировать почтовое событие
		"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
		"USER_PROPERTY" => "",	// Показывать доп. свойства
		"USER_PROPERTY_NAME" => "",	// Название закладки с доп. свойствами
	),
	false
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>