<?
	define("NO_KEEP_STATISTIC", true); //Не учитываем статистику
	define("NOT_CHECK_PERMISSIONS", true); //Не учитываем права доступа
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	$APPLICATION->SetTitle("Где взять номер");
?>
	 <form action="/post.php" method="POST">
		<p class="form-input-title">Как нам к Вам обращаться</p>
		<div class="form-row">
			<input name="fio" type="text" value="" class="form-input w100"/>
		</div>
		<p class="form-input-title">Когда Вам будет удобнее ответить на звонок</p>
		<div class="form-row">
			<input name="dt" type="text" value="" class="form-input w50"/>
			<input name="tm" type="text" value="" class="form-input w50"/>
			<div class="clear"></div>
		</div>
		<p class="form-input-title">Номер телефона</p>
		<div class="form-row">
			<input name="phone_country" type="text" value="" class="form-input w10 digits"/>
			<input name="phone_city" type="text" value="" class="form-input w20 digits"/>
			<input name="phone_number" type="text" value="" class="form-input w50 digits"/>
			<div class="clear"></div>
		</div>
		<p class="form-description">Некоторое описание формы Некоторое описание формы Некоторое описание формы Некоторое описание формы </p>
		<input type="submit" class="form-btn" value="Отправить"/>
	 </form>
	 <?//$APPLICATION->IncludeComponent(
	// "bitrix:form", 
	// "call-back", 
	// array(
		// "AJAX_MODE" => "Y",
		// "AJAX_OPTION_ADDITIONAL" => "",
		// "AJAX_OPTION_HISTORY" => "N",
		// "AJAX_OPTION_JUMP" => "N",
		// "AJAX_OPTION_STYLE" => "Y",
		// "CACHE_TIME" => "3600",
		// "CACHE_TYPE" => "A",
		// "CHAIN_ITEM_LINK" => "",
		// "CHAIN_ITEM_TEXT" => "",
		// "EDIT_ADDITIONAL" => "N",
		// "EDIT_STATUS" => "Y",
		// "IGNORE_CUSTOM_TEMPLATE" => "Y",
		// "NOT_SHOW_FILTER" => array(
			// 0 => "",
			// 1 => "",
		// ),
		// "NOT_SHOW_TABLE" => array(
			// 0 => "",
			// 1 => "",
		// ),
		// "RESULT_ID" => $_REQUEST[RESULT_ID],
		// "SEF_MODE" => "N",
		// "SHOW_ADDITIONAL" => "N",
		// "SHOW_ANSWER_VALUE" => "N",
		// "SHOW_EDIT_PAGE" => "N",
		// "SHOW_LIST_PAGE" => "N",
		// "SHOW_STATUS" => "N",
		// "SHOW_VIEW_PAGE" => "N",
		// "START_PAGE" => "new",
		// "SUCCESS_URL" => "",
		// "USE_EXTENDED_ERRORS" => "N",
		// "WEB_FORM_ID" => "1",
		// "COMPONENT_TEMPLATE" => "call-back",
		// "VARIABLE_ALIASES" => array(
			// "action" => "action",
		// )
	// ),
	// false
// );?>