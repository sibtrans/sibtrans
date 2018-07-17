<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("keywords", "Россия, транспортная компания, Байт Транзит, грузоперевозки, доставка грузов, перевозка грузов");
$APPLICATION->SetPageProperty("description", "Перевозка грузов по России и всему Миру - Транспортная Компания «Байт Транзит». Грузоперевозки в любом объёме: железнодорожным, автомобильным, морским и авиатранспортом по России и всему Миру!");
$APPLICATION->SetPageProperty("TITLE", "Грузоперевозки по России и всему Миру - Транспортная Компания «Байт Транзит»");
$APPLICATION->SetTitle("Главная");
?>
<script type="text/javascript">



	$(document).ready(function ()
	{
			if(document.all && !window.atob){
				//код для IE9 и ниже
			$('#btk-info').css('display','none');

			}
	});
</script>


<? $APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y"); ?>


<section id="underhead">
	<div class="pw relative">
		<div id="shares">
			<span style="font-size:29px;"><a id="aktsii" href="http://www.sibtrans.ru/aktsii">Акции</a>&nbsp;
			<img style="cursor:pointer;  margin-left:8px;" src="<?=SITE_TEMPLATE_PATH;?>/images/gd5.png" id="SpecialOffer_transp_zd"/>
			<img style="cursor:pointer;  margin-left:8px;" src="<?=SITE_TEMPLATE_PATH;?>/images/auto5.png" id="SpecialOffer_transp_auto"/>
			<img style="cursor:pointer;  margin-left:8px;" src="<?=SITE_TEMPLATE_PATH;?>/images/ship5.png" id="SpecialOffer_transp_ship"/>
			<img style="cursor:pointer;  margin-left:8px;" src="<?=SITE_TEMPLATE_PATH;?>/images/air5.png" id="SpecialOffer_transp_air"/>
			<img style="cursor:pointer;  margin-left:8px;" src="<?=SITE_TEMPLATE_PATH;?>/images/box5.png" id="SpecialOffer_transp_box"/>
			</span>
		</div>
		<div id="mini-calc">
			<p class="title">Расcчитать стоимость<span id="miniCalcLoader"><i class="fa fa-spinner fa-pulse  fa-fw"></i></span></p>
			<div id="city_from" class="city-select"><div class="btn_down"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
				<div class="city_list">
					<?foreach(getCities() as $key=>$value):?>
						<div class="city_item" id="city<?=$key;?>"><?=$value;?></div>
					<?endforeach;?>
				</div>
			</div>
			<div id="city_to" class="city-select"><div class="btn_down"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
				<div class="city_list">
					<?foreach(getCities() as $key=>$value):?>
						<div class="city_item" id="city<?=$key;?>"><?=$value;?></div>
					<?endforeach;?>
				</div>
			</div>
			<div class="btn_reverse"></div>
			<div id="weight" class="txt-wh weight"><input value="40.2" class="numbers_comma"/></div>
			<div id="vol" class="txt-wh volume"><input value="0.2" class="numbers_comma"/></div>
			<div class="clear"></div>
			<div id="result_summ" class="result">---</div>
			<div id="result_days" class="result"><p>---</p></div>
			<div class="clear"></div>
			<div id="calc_submit" class="form_button"><a style="color:white; text-decoration:none;" onclick="AddParamsUrlCalkToOrder(this);">Оформить заявку</a></div>
		</div>
		<div id="status-form">
			<p class="title">Статус перевозки*</p>
			<p class="whereid popup-wnd"><a href="/status/gde-vzyat-nomer.php" style="color:rgb(85,81,80); text-decoration:none;">Где взять номер?</a></p>
			<div id="stat_text" class="txt-search"><input type="text" class="numbers" />
				<a  class="btn-search fa fa-search" 
					style="cursor:pointer; color:#555150; text-decoration:none;" onmouseover="this.style.color ='#b00000';" onmouseout="this.style.color='#555150';">
				</a>
			</div>
			<p class="where_s" style="color:rgb(85,81,80); font-size:14px;">*Узнать где груз</p>
		</div>
		<div id="uh-buttons">

			<a class="uh-button graph" href="/grafik-vykhoda-ts.php"><p>график выхода ТС</p></a>
			<a href="../sroki-dostavki.php" class="uh-button sr-dost"><p>сроки доставки</p></a>
			<a class="uh-button tarifs" style="vertical-align:middle; line-height:48px;" href="rates/index.php">тарифы</a>
			<div class="clear"></div>
		</div>
	</div>
</section>
<div id="topline">
</div>
<section id="faq">
	<div class="pw relative">
		   <?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"question-answer", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "QuestionAnswer",
		"IBLOCK_ID" => "7",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "Y",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "Y",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"DETAIL_STRICT_SECTION_CHECK" => "Y",
		"SET_TITLE" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"SET_LAST_MODIFIED" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "Y",
		"SHOW_404" => "Y",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"USE_PERMISSIONS" => "Y",
		"GROUP_PERMISSIONS" => array(
			0 => "2",
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"NUM_NEWS" => "20",
		"NUM_DAYS" => "30",
		"YANDEX" => "Y",
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array(
			0 => "0",
			1 => "1",
			2 => "2",
			3 => "3",
			4 => "4",
			5 => "",
		),
		"CATEGORY_IBLOCK" => "",
		"CATEGORY_CODE" => "CATEGORY",
		"CATEGORY_ITEMS_COUNT" => "5",
		"MESSAGES_PER_PAGE" => "10",
		"USE_CAPTCHA" => "Y",
		"REVIEW_AJAX_POST" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"FORUM_ID" => "1",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "Y",
		"POST_FIRST_MESSAGE" => "Y",
		"SEF_FOLDER" => "/",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "question-answer",
		"AJAX_OPTION_ADDITIONAL" => "",
		"STRICT_SECTION_CHECK" => "Y",
		"DISPLAY_AS_RATING" => "rating",
		"USE_SHARE" => "N",
		"FILE_404" => "",
		"VARIABLE_ALIASES" => array(
			"SECTION_ID" => "SECTION_ID",
			"ELEMENT_ID" => "ELEMENT_ID",
		)
	),
	false
);?>


		<div class="clear"></div>
	</div>
</section>
<section id="btk-info">
	<div class="pw relative w1062">

		<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"Advertising_block", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "N",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "Advertising_block",
		"IBLOCK_ID" => "14",
		"NEWS_COUNT" => "14",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "PREVIEW_TEXT",
			1 => "PREVIEW_PICTURE",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "Advertising_block",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>

		<div class="clear"></div>
	</div>
</section>
<section id="b4">
	<div class="pw">

	<?$APPLICATION->IncludeComponent("bitrix:news.list", "BaytTranzitInDigits123", Array(
	"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "N",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"IBLOCK_TYPE" => "BaytTranzitInDigits",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_ID" => "10",	// Код информационного блока
		"NEWS_COUNT" => "20",	// Количество новостей на странице
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"FILTER_NAME" => "",	// Фильтр
		"FIELD_CODE" => array(	// Поля
			0 => "NAME",
			1 => "",
		),
		"PROPERTY_CODE" => array(	// Свойства
			0 => "unit",
			1 => "digit",
			2 => "",
		),
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"INCLUDE_SUBSECTIONS" => "Y",	// Показывать элементы подразделов раздела
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
		"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"PAGER_TITLE" => "Новости",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"SHOW_404" => "N",	// Показ специальной страницы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"COMPONENT_TEMPLATE" => "BaytTranzitInDigits",
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?> 

      <div class="clear"></div>
		<p style="color:gray; margin-left:40px; font-size:14px;">*по данным маркетингового исследования компании</p>
		<br/>
	</div>
</section>
<section id="b5">
	<div class="pw w1062">
		<div class="slider" spp="2">
			<div class="slide-btn ar-left"></div>
			<div class="slide-btn ar-right"></div>
			<div class="view-area">
				<div class="container">
						 <?$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"SpecialOffer", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "SpecialOffer",
		"IBLOCK_ID" => "9",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "Y",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "N",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "N",
		"DETAIL_STRICT_SECTION_CHECK" => "Y",
		"SET_TITLE" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"SET_LAST_MODIFIED" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"PAGER_BASE_LINK" => "",
		"PAGER_PARAMS_NAME" => "arrPager",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"GROUP_PERMISSIONS" => array(
			0 => "1",
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => "",
		"FILTER_PROPERTY_CODE" => "",
		"NUM_NEWS" => "20",
		"NUM_DAYS" => "30",
		"YANDEX" => "Y",
		"MAX_VOTE" => "5",
		"VOTE_NAMES" => array(
			0 => "0",
			1 => "1",
			2 => "2",
			3 => "3",
			4 => "4",
		),
		"CATEGORY_IBLOCK" => "",
		"CATEGORY_CODE" => "CATEGORY",
		"CATEGORY_ITEMS_COUNT" => "5",
		"MESSAGES_PER_PAGE" => "10",
		"USE_CAPTCHA" => "Y",
		"REVIEW_AJAX_POST" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"FORUM_ID" => "1",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "Y",
		"POST_FIRST_MESSAGE" => "Y",
		"SEF_FOLDER" => "/",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "SpecialOffer",
		"AJAX_OPTION_ADDITIONAL" => "",
		"STRICT_SECTION_CHECK" => "N",
		"USE_SHARE" => "N",
		"SEF_URL_TEMPLATES" => array(
			"news" => "search/",
			"section" => "rss/",
			"detail" => "#ELEMENT_ID#/",
		)
	),
	false
);?>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
</section>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>