<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
if($USER->isAuthorized()){
	$rsUser = CUser::GetList(($by="ID"), ($order="asc"), array("ID"=>$USER->GetID()), array("SELECT"=>array("UF_UN")))->Fetch();
}
if(CSite::InDir('/lc/')){
	define ("NEED_AUTH", true);
	$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
	$rsUser = CUser::GetList(($by="ID"), ($order="asc"), array("ID"=>$USER->GetID()), array("SELECT"=>array("UF_UN")))->Fetch();
	$un=$rsUser["UF_UN"];
	//$un='IN4936N5'; //ХИЛТИДИСТРИБЬЮШНЛТД
	$uInfo=array();
	$FA="N";
	if($un!=""){
		$uInfo=getUserInfo($un);
		$uInfo=$uInfo["klc"];
		$FA="Y";
	}
	if(is_array($uInfo["rc"]))$uInfo["rc"]="";

}
?><!DOCTYPE html>
<html>
	<head>

      <?//CUtil::InitJSCore(array('window'));?>



		<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery-3.2.1.js");?>
        <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/main.js");?>
		<? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/reset.css");?>
		<? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/font-awesome.css");?>
		<? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/main.css");?>


       <? $APPLICATION->ShowCSS(); ?>

       	<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/popup.js");?>
		<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.maskedinput.js");?>




			<script src="http://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>

			<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>


       <? $APPLICATION->ShowHead(); ?> 

      <? CModule::IncludeModule("iblock"); 
		//id нужного инфоблока 
		$iblock_id = 5; 
		$arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y");
		$res_count = CIBlockElement::GetList(Array(), $arFilter, Array(), false, Array());
       ?>


		<? //$valutes = GetValute(); ?>


		<title><?$APPLICATION->ShowTitle();?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 	


		<link rel="stylesheet" href="<? echo SITE_TEMPLATE_PATH; ?>/css/popModal.css">
		<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/popModal.js" type="text/javascript"></script>

	</head>
	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
		<header>
			<div class="line1">
				<div class="pw relative">
					<div class="r">
						<div id="s_city" class="rin" style="cursor:pointer;"><span></span>&nbsp;<i class="fa fa-caret-down" aria-hidden=""></i></div>
						<div id="term_ad_link" class="rin" style="color:rgb(85,81,80);"><a style="color:rgb(85,81,80); text-decoration:none;" href="#">Адреса терминалов</a> <span></span></div>
						<div id="divider" class="rin"></div>
						<div id="news_link" class="rin"><a style="color:rgb(85,81,80); text-decoration:none;" href="\news\index.php">Наши новости</a> <span style="color:#8e211e;"> <? echo $res_count; ?></span></div>
					</div>
				</div>
			</div>
			<div class="line2" style="background:#92221e;"><div class="pw relative">
					<div class="l"></div>
					<div class="r">
						<a href="/uslugi/index.php" class="wbtn">
							<img src="<?=SITE_TEMPLATE_PATH;?>/images/services.png" alt="Услуги"/>
							<p>Услуги</p>
						</a>
						<a onclick="AddParamsUrlCalkToMaxCalk(this);" class="wbtn" style="cursor:pointer;">
							<img src="<?=SITE_TEMPLATE_PATH;?>/images/calc.png" alt="Услуги"/>
							<p>Рассчитать стоимость</p>
						</a>
						<a href="/cost-calculation/order.php" class="wbtn">
							<img src="<?=SITE_TEMPLATE_PATH;?>/images/send.png" alt="Услуги"/>
							<p>Отправить заявку</p>
						</a>
						<div class="r1">
							<?if(!$USER->isAuthorized()):?>
								<a href="/lc/" id="lch">Личный кабинет</a>
							<?else:?>
								<a href="/lc/" id="lch" class="logged"><?=$rsUser["WORK_COMPANY"]?></a><a href="?logout=yes" class="btnLogout"></a>
							<?endif;?>
							<div id="currencies">
								<p class="currency usd">-</p>
								<p class="currency eur">-</p>
								<p class="currency cny">-</p>
							</div>
						</div>
					</div>
					<div class="c" style="background:url(../bitrix/templates/main/images/btk_index_line22.png); background-repeat:no-repeat;">
						<div class="logo">
							<a class="link-logo" href="/"></a>
						</div>
						<div class="comm">
							<div>
							<p class="phone">8 (383) 241 06 49</p>
							<p style="display:inline-block; width:92px;"></p><p id="id_callback_popup" class="link" style="display:inline-block; width:142px;  color:#8e211e; text-decoration:underline; cursor:pointer; white-space:nowrap;">Заказать звонок</p>
							</div>
							<p class="link">
								<a style="color:gray; text-decoration:none;" onmouseover="this.style.color ='#b00000';"
								onmouseout="this.style.color='gray';" href="/feedback">обратная связь</a>
                           </p>
							</div>
						</div>

					</div>			


			</div><div class="line3">
			</div>
			<div>

			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "nav", Array(
				"START_FROM" => "0",	// Номер пункта, начиная с которого будет построена навигационная цепочка
					"PATH" => "",	// Путь, для которого будет построена навигационная цепочка (по умолчанию, текущий путь)
					"SITE_ID" => "-",	// Cайт (устанавливается в случае многосайтовой версии, когда DOCUMENT_ROOT у сайтов разный)
				),
				false
			);?> 
			
			</div>
			<div id="content_filials" style="display:none;">
				<div><p style="text-align:center; margin:0; color:#92211d; font-size:large; width:550px;"><b>Выбрать филиал</b></p></div>
				<div style="float:left; width:190px; border-right:solid; border-right-color:gray; border-width:thin; margin:10px;">
						<ul style="padding:0; padding-right:10px;">
							<li style="list-style-type: none; text-decoration:underline; margin-top:3px;"><a style="color:black;" href="../maps/Russia.php?x=55.78&y=37.66&zoom=11&City=Москва">Москва</a></li>
							<li style="list-style-type: none; text-decoration:underline; margin-top:3px;"><a style="color:black;" href="../maps/Russia.php?x=55.0&y=83.0&zoom=11&City=Новосибирск">Новосибирск</a></li>
							<li style="list-style-type: none; text-decoration:underline; margin-top:3px;"><a style="color:black;" href="../maps/Russia.php?x=56.9&y=60.60&zoom=11&City=Екатеринбург">Екатеринбург</a></li>
							<li style="list-style-type: none; text-decoration:underline; margin-top:3px;"><a style="color:black;" href="../maps/Russia.php?x=54.99&y=73.47&zoom=11&City=Омск">Омск</a></li>
							<li style="list-style-type: none; text-decoration:underline; margin-top:3px;"><a style="color:black;" href="../maps/Russia.php?x=56.025&y=92.79&zoom=12&City=Красноярск">Красноярск</a></li>
					
							<li style="list-style-type: none; text-decoration:underline; margin-top:15px;"><b><a href="../maps/Russia.php">Все филиалы</a></b></li>
							<li id="AllFilialsByCityName" style="list-style-type:none; text-decoration:underline; margin-top:15px;"></li>
						</ul>
					</div>

					<div style="float:left; width:300px; margin: 10px; ">
						<p style="font-size:x-small; color:gray; margin-bottom:2px;">подобрать филиал</p>
						<div id="mini-calc_List" style="position:inherit; padding:0;">
							<div id="city_from_List" class="city-select_List nocalc">
								<div class="btn_down_List"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
								<div class="city_list_List">

                                <?foreach(getCities() as $key=>$value):?>
                                <div class="city_item_List" id="city<?=$key;?>"><?=$value;?></div>
                                <?endforeach;?>
					
								</div>
							</div>
						</div>
						<br />
						<span>Ваш филиал - </span><div id=filials_cities style="display:inline-block;">
											<?foreach(getFilials() as $key=>$value):?>
																	<?foreach($value['Cities'] as $k=>$v):?>
											<div class="cities_of_filials" style="display:none;" data-filial-name="<?=$value["Name"];?>" data-filial-id="<?=$key;?>" id="<?=$k;?>"> <?=$value["Name"];?></div>
																	<?endforeach;?>

											<?endforeach;?>
										</div>
						
						<br />
						<br />
						<br />
						<br />
						<a href="../maps/Russia.php">Все адреса</a>
					</div>

				</div>

			<div id="callback_popup_content" style="display:none;">
				<div style="width:400px;">
					 <form action="#" method="POST">
							<p style="font-size:12px; color:gray; padding-bottom:3px;">Как нам к Вам обращаться</p>
						 <div class="form-row" style="height:40px;">
								<input name="fio" type="text" value="" class="form-input w100" placeholder="Ф.И.О"/>
							</div>
						<br/>
							<p style="font-size:12px; color:gray; padding-bottom:3px;">Когда Вам будет удобнее ответить на звонок</p>
							<div class="form-row" style="height:50px;">
								<input name="dt" type="text" value="" class="form-input w50" placeholder="Дата: <?=date('d-m-Y')?>"/>
								<input name="tm" type="text" value="" class="form-input w50" placeholder="Время: 15:10"/>
								<div class="clear"></div>
							</div>
						 <label style="font-size:12px; color:gray; padding-bottom:3px;" class="required">Номер телефона</label> 
							<div class="form-row" style="height:52px;">
								<input name="phone_country" type="text" value="+7" class="form-input w10 digits"  maxlength="2"/>
								<input name="phone_city" type="text" value="" class="form-input w20 numbers" maxlength="3"/>
								<input name="phone_number" type="text" value="" class="form-input numbers" style="width:47.5%;"/>
								<div class="clear"></div>
							</div>
							<p style="padding-bottom:15px; font-size:11px; color:gray;">Специалисты &nbsp;сервиса &nbsp;"обратный &nbsp;звонок" &nbsp;обязательно&nbsp; ответят &nbsp;&nbsp;на  &nbsp;ваш&nbsp;&nbsp;   вопрос&nbsp;   в &nbsp;   указанное &nbsp;  время  &nbsp; или &nbsp;   в  &nbsp; течении &nbsp; 15 &nbsp;  минут&nbsp;  после  отправки запроса.
								Сервис предоставляется в рабочие дни, с 08:30 до 17:30 часов по новосибирскому времени.</p>
							<p style="padding-bottom:15px; font-size:11px; color:gray;">Нажимая&nbsp;&nbsp; на &nbsp;&nbsp;кнопку&nbsp;&nbsp; "Отправить",&nbsp; &nbsp;Вы&nbsp; даёте&nbsp; &nbsp;согласие&nbsp; на &nbsp;обработку&nbsp; персональных данных в соответствии с Политикой конфиденциальности.</p>


						 </form>
						 <input type="submit" class="form-btn" style="margin:0" value="Отправить"/>
				</div>
			</div>


			<div id="lch_content_popup" style="display:none;">
				<div style="width:400px;">
					<?$APPLICATION->IncludeComponent(
						"bitrix:system.auth.form",
						"",
						Array()
					);?>
				</div>
			</div>





<div style="display:none">
    <div id="dialog_contentCallback" class="dialog_contentCallback">
        <div class="dialogModal_header">Отправка заявки</div>
        <div class="dialogModal_content">
            Ваша заявка отправлена! В ближайшее время наш специалист свяжется с вами.<br>
        </div>
        <div class="dialogModal_footer">
            <!--<button type="button" class="btn btn-primary" data-dialogmodal-but="next">ОК</button>-->
            <button type="button" class="btn btn-default" data-dialogmodal-but="ok">ОК</button>
        </div>
    </div>


</div>










<?$APPLICATION->IncludeComponent("bitrix:news.list", "Action_transp", Array(
	"DISPLAY_DATE" => "N",	// Выводить дату элемента
		"DISPLAY_NAME" => "Y",	// Выводить название элемента
		"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
		"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
		"AJAX_MODE" => "N",	// Включить режим AJAX
		"IBLOCK_TYPE" => "Action_transp",	// Тип информационного блока (используется только для проверки)
		"IBLOCK_ID" => "11",	// Код информационного блока
		"NEWS_COUNT" => "5",	// Количество новостей на странице
		"SORT_BY1" => "ACTIVE_FROM",	// Поле для первой сортировки новостей
		"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
		"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
		"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
		"FILTER_NAME" => "",	// Фильтр
		"FIELD_CODE" => array(	// Поля
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(	// Свойства
			0 => "ActionID",
			1 => "",
		),
		"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
		"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
		"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
		"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
		"DISPLAY_PANEL" => "N",
		"SET_TITLE" => "N",	// Устанавливать заголовок страницы
		"SET_STATUS_404" => "N",	// Устанавливать статус 404
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
		"PARENT_SECTION" => "",	// ID раздела
		"PARENT_SECTION_CODE" => "",	// Код раздела
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "3600",	// Время кеширования (сек.)
		"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
		"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
		"DISPLAY_BOTTOM_PAGER" => "Y",	// Выводить под списком
		"PAGER_TITLE" => "Акции",	// Название категорий
		"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
		"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
		"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
		"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
		"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
		"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
		"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
		"COMPONENT_TEMPLATE" => ".default",
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
		"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
		"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
		"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
		"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
		"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
		"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
		"SHOW_404" => "N",	// Показ специальной страницы
		"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
	),
	false
);?> 




<script type="text/javascript">





 $(function(){



function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}


	function getCountAdressFilials(handleData,name){

				console.log('имя города для определения числа филиалов ' + name);
							var selected = [];
							selected.push({ value: name});

										//получаем все по названию города все филиалы в данном городе
										$.ajax({
											url :'../maps/GetFilialsByName.php',
													type: "POST",
													 dataType: 'text',
													 data:{selected: selected}, 
													 success:function(data){

													 handleData(data); 

													 }
												});

   }







function getSityFromSession(handleData, city) {

	var selected = [];
		selected.push({ city: city});

	console.log('сработала ф-ия определения или установки города: ' + city);

 	 $.ajax({
   			url:'../maps/Save-data-maps.php',
			type: "POST",
			dataType: 'text',
			data:{selected: selected}, 

			success:function(data){
				handleData(data); 
			}
 		 });
}


					var myCity = undefined;

			//*** если параметр City определён **********************
					if(window.location.href.indexOf("&City") > -1)
					{

						// получаем название города и запаретров GET и устанавливаем город
						myCity = getParameterByName('City', window.location.href);
						console.log(myCity);
						//console.log(decodeURI(window.location.href));
						//getCountAdressFilials(myCity);

						$('#s_city').find('span').html(myCity);


								//получает число филиалов по названию города и устанавливает это число
								getCountAdressFilials((function(output){
										$('#AllFilialsByCityName').html(output);

									var count = $(output).attr('data-adress');
									$('#term_ad_link').find('span').text(count);
									$('#term_ad_link').find('a').attr('href', $(output).attr('href'));

								}),myCity);


							// запись данных в сессию
							getSityFromSession((function(output){
								console.log('запись данных в сессию!!!' + myCity);
								//$('#s_city').prepend($(output).text());
								}), myCity);

					}else{

						// если город не определен пытаемся получить его из сессиии
						getSityFromSession((function(output){
							console.log('имя города из сессии: ' + $(output).text());

							$('#s_city').find('span').html($(output).text());





						//*******************************
						// если из сессии получить город неудалось
						if($(output).text().trim() == '')
						{
							console.log('из сессии получить город неудалось, определяем через яндекс API');

								ymaps.ready(init);

								function init() {

								ymaps.geolocation.get({
									// Зададим способ определения геолокации
									// на основе ip пользователя.
								provider: 'yandex',
									// Включим автоматическое геокодирование результата.
									autoReverseGeocode: true
								}).then(function (result) {
									// Выведем результат геокодирования.


								//если город не был передан в парметрах, получае его и устанавливаем
								myCity = result.geoObjects.get(0).properties.get('metaDataProperty.GeocoderMetaData.AddressDetails.Country.AddressLine');
								$('#s_city').find('span').html(myCity);

								// запись данных в сессию
								getSityFromSession((function(output){
									console.log('запись данных в сессию!!!' + myCity);
									//$('#s_city').prepend($(output).text());
									}), myCity);



								//получает число филиалов по названию города и устанавливает это число
								getCountAdressFilials((function(output){
									//число филиалов в выпадающем окне -- пример:(4 адреса в Новосибирск)
										$('#AllFilialsByCityName').html(output);

									//число адресов терминалов в хедере -- пример(Адреса терминалов 4)
										var count = $(output).attr('data-adress');
										$('#term_ad_link').find('span').text(count);
										$('#s_city').find('span').html($(output).attr('data-city'));
										$('#term_ad_link').find('a').attr('href', $(output).attr('href'));
										}),myCity);
									},function (error) {

													$('#s_city').find('span').html('Новосибирск');

										});
								}


						}


						if($(output).text().trim() !== '')
						{
 							// получили город из сесии
										//получает число филиалов по названию города и устанавливает это число
														getCountAdressFilials((function(output){
																$('#AllFilialsByCityName').html(output);

																	console.log(output);
						
															var count = $(output).attr('data-adress');
															$('#term_ad_link').find('span').text(count);
															$('#term_ad_link').find('a').attr('href', $(output).attr('href'));
														}), $(output).text().trim());

						}


						}), '');


					}









        function showList(sel, full) {
            if (sel === undefined) return;
            if (full === undefined) full = true;
            if (full == '') full = true;
            var list = sel.find('.city_list_List');
            var inp = sel.find('input');
            list.find('.city_item_List').each(function () {
                if (full == true) {
                    $(this).removeClass('disabled');
                    $(this).html($(this).text());
                } else {
                    var txt = inp.val().toLowerCase();
                    var itm = $(this).text().toLowerCase();
                    if (itm.indexOf(txt) !== -1) {
                        $(this).removeClass('disabled');
                        $(this).html(itm.replace(txt, '<b>' + txt + '</b>'));
                    } else {
                        $(this).addClass('disabled');
                    }
                }
                $(this).unbind('click').bind('click', function () {
                    inp.val($(this).text());
                    inp.attr("selectedID", $(this).attr("id").replace('city', ''));

					//console.log(inp.attr("selectedID"));


					$('#filials_cities').find('.cities_of_filials').each(function(){

						$(this).css('display', 'none');

						if(inp.attr('selectedid') == this.id)
						{

								//получает число филиалов по названию города и устанавливает это число
								getCountAdressFilials((function(output){

								// пишем ссылку с названием города и кол-во филиалов в выпад окне: пример 4 адреса в Новосибирск
									$('#AllFilialsByCityName').html(output);

									// пишем колво филиалов
									var count = $(output).attr('data-adress');
									$('#term_ad_link').find('span').text(count);

									// пишем ссылку в шапке
									var ccc = $(output).attr('data-city');
									$('#s_city').find('span').html(ccc);
									//console.log('пишем ссылку в шапке' + output);
									$('#term_ad_link').find('a').attr('href', $(output).attr('href'));

									// запись данных в сессию
									getSityFromSession((function(output){
										console.log('запись данных в сессию!!!' + ccc);
										//$('#s_city').prepend($(output).text());
									}), ccc);


								}),$(this).attr('data-filial-name'));





						$(this).css('display', 'inline-block');

						}


					});





					// doMiniCalcReq();
                    list.fadeOut(100);
                });
                if (!$(this).hasClass('disabled')) {
                    $(this).html(fl2Upper($(this).html()));
                }
            });
            list.fadeIn(200);
        }



            $('#s_city').click(function () {


                $('#s_city').popModal({

                    html: $('#content_filials').html(),

                    // Popup position (string).
                    // 'bottomCenter', 'bottomRight', 'leftTop', 'leftCenter', 'rightTop', 'rightCenter'
                    placement: 'bottomLeft',
                    // show/hide close button on popup (boolean).
                    showCloseBut: true,
                    // close popup when click on any place (boolean).
                    onDocumentClickClose: true,
                    // prevent close popup when click on specified elements (string).
                    onDocumentClickClosePrevent: '',
                    // overflow content (boolean).
                   overflowContent: false,
                    // create popup relative element (boolean).
                    inline: true,
                    // use popup for show as dropdown menu
                    // size of popup
                    size: {'width':'750'},
                    // show text, before loading content (string).
                    beforeLoadingContent: 'Please, waiting...',
                    // code execution by clicking on OK button, contained in popup (function).
					onOkBut: function (event, el) { },
                    // code execution by clicking on Cancel button, contained in popup (function).
                    onCancelBut: function (event, el) { },
                    // code execution before popup shows (function).
                    onLoad: function (el) { 

						var btn=el.find('.btn_down_List');
 						 var list = el.find('.city_list_List');

						var input=el.find('input');
						var par=el.find('.city-select_List');


			btn.click(function(){
				if(par.find('.city_list_List').css("display")=="none"){
					showList(par,true);
				} else {
					input.trigger("blur");
					par.find('.city_list_List').css("display","none");
				}
			});


         input.unbind('click').bind('click', function () {
                $(this).trigger('keyup');
            });

            input.unbind('keyup').bind('keyup', function (e) {
                var code = e.keyCode || e.which;
                if (code == 13) {
                    var show = list.find('.city_item').not('.disabled');
                    if (show.length > 0) {
                        $(show[0]).trigger('click');

                    }
                } else {

					 showList(par, $(this).val());


				}
            });



					},
                    // code execution after popup closed (function).
                    onClose: function () {  }
				});


            });



	//**********************************АКЦИИ
  $('#SpecialOffer_transp_zd').click(function () {




                $('#SpecialOffer_transp_zd').popModal({

                    html: $('#SpecialOffer_transp_zd_content').html(),

                    // Popup position (string).
                    // 'bottomCenter', 'bottomRight', 'leftTop', 'leftCenter', 'rightTop', 'rightCenter'
                    placement: 'bottomLeft',
                    // show/hide close button on popup (boolean).
                    showCloseBut: true,
                    // close popup when click on any place (boolean).
                    onDocumentClickClose: true,
                    // prevent close popup when click on specified elements (string).
                    onDocumentClickClosePrevent: '',
                    // overflow content (boolean).
                   overflowContent: false,
                    // create popup relative element (boolean).
                    inline: true,
                    // use popup for show as dropdown menu
                    // size of popup
                    size: {'width':'750'},
                    // show text, before loading content (string).
                    beforeLoadingContent: 'Please, waiting...',
                    // code execution by clicking on OK button, contained in popup (function).
					onOkBut: function (event, el) { },
                    // code execution by clicking on Cancel button, contained in popup (function).
                    onCancelBut: function (event, el) { },
                    // code execution before popup shows (function).
					onLoad: function (el) { },
                    // code execution after popup closed (function).
                    onClose: function () {  },
				});
   			});


	//**********************************АКЦИИ
  $('#SpecialOffer_transp_auto').click(function () {




                $('#SpecialOffer_transp_auto').popModal({

                    html: $('#SpecialOffer_transp_auto_content').html(),

                    // Popup position (string).
                    // 'bottomCenter', 'bottomRight', 'leftTop', 'leftCenter', 'rightTop', 'rightCenter'
                    placement: 'bottomLeft',
                    // show/hide close button on popup (boolean).
                    showCloseBut: true,
                    // close popup when click on any place (boolean).
                    onDocumentClickClose: true,
                    // prevent close popup when click on specified elements (string).
                    onDocumentClickClosePrevent: '',
                    // overflow content (boolean).
                   overflowContent: false,
                    // create popup relative element (boolean).
                    inline: true,
                    // use popup for show as dropdown menu
                    // size of popup
                    size: {'width':'750'},
                    // show text, before loading content (string).
                    beforeLoadingContent: 'Please, waiting...',
                    // code execution by clicking on OK button, contained in popup (function).
					onOkBut: function (event, el) { },
                    // code execution by clicking on Cancel button, contained in popup (function).
                    onCancelBut: function (event, el) { },
                    // code execution before popup shows (function).
					onLoad: function (el) { },
                    // code execution after popup closed (function).
                    onClose: function () {  },
				});
   			});

	//**********************************АКЦИИ
  $('#SpecialOffer_transp_ship').click(function () {


                $('#SpecialOffer_transp_ship').popModal({

                    html: $('#SpecialOffer_transp_ship_content').html(),

                    // Popup position (string).
                    // 'bottomCenter', 'bottomRight', 'leftTop', 'leftCenter', 'rightTop', 'rightCenter'
                    placement: 'bottomLeft',
                    // show/hide close button on popup (boolean).
                    showCloseBut: true,
                    // close popup when click on any place (boolean).
                    onDocumentClickClose: true,
                    // prevent close popup when click on specified elements (string).
                    onDocumentClickClosePrevent: '',
                    // overflow content (boolean).
                   overflowContent: false,
                    // create popup relative element (boolean).
                    inline: true,
                    // use popup for show as dropdown menu
                    // size of popup
                    size: {'width':'750'},
                    // show text, before loading content (string).
                    beforeLoadingContent: 'Please, waiting...',
                    // code execution by clicking on OK button, contained in popup (function).
					onOkBut: function (event, el) { },
                    // code execution by clicking on Cancel button, contained in popup (function).
                    onCancelBut: function (event, el) { },
                    // code execution before popup shows (function).
					onLoad: function (el) { },
                    // code execution after popup closed (function).
                    onClose: function () {  },
				});
   			});

	//**********************************АКЦИИ
  $('#SpecialOffer_transp_air').click(function () {


                $('#SpecialOffer_transp_air').popModal({

                    html: $('#SpecialOffer_transp_air_content').html(),

                    // Popup position (string).
                    // 'bottomCenter', 'bottomRight', 'leftTop', 'leftCenter', 'rightTop', 'rightCenter'
                    placement: 'bottomLeft',
                    // show/hide close button on popup (boolean).
                    showCloseBut: true,
                    // close popup when click on any place (boolean).
                    onDocumentClickClose: true,
                    // prevent close popup when click on specified elements (string).
                    onDocumentClickClosePrevent: '',
                    // overflow content (boolean).
                   overflowContent: false,
                    // create popup relative element (boolean).
                    inline: true,
                    // use popup for show as dropdown menu
                    // size of popup
                    size: {'width':'750'},
                    // show text, before loading content (string).
                    beforeLoadingContent: 'Please, waiting...',
                    // code execution by clicking on OK button, contained in popup (function).
					onOkBut: function (event, el) { },
                    // code execution by clicking on Cancel button, contained in popup (function).
                    onCancelBut: function (event, el) { },
                    // code execution before popup shows (function).
					onLoad: function (el) { },
                    // code execution after popup closed (function).
                    onClose: function () {  },
				});
   			});


	//**********************************АКЦИИ
  $('#SpecialOffer_transp_box').click(function () {


                $('#SpecialOffer_transp_box').popModal({

                    html: $('#SpecialOffer_transp_box_content').html(),

                    // Popup position (string).
                    // 'bottomCenter', 'bottomRight', 'leftTop', 'leftCenter', 'rightTop', 'rightCenter'
                    placement: 'bottomLeft',
                    // show/hide close button on popup (boolean).
                    showCloseBut: true,
                    // close popup when click on any place (boolean).
                    onDocumentClickClose: true,
                    // prevent close popup when click on specified elements (string).
                    onDocumentClickClosePrevent: '',
                    // overflow content (boolean).
                   overflowContent: false,
                    // create popup relative element (boolean).
                    inline: true,
                    // use popup for show as dropdown menu
                    // size of popup
                    size: {'width':'750'},
                    // show text, before loading content (string).
                    beforeLoadingContent: 'Please, waiting...',
                    // code execution by clicking on OK button, contained in popup (function).
					onOkBut: function (event, el) { },
                    // code execution by clicking on Cancel button, contained in popup (function).
                    onCancelBut: function (event, el) { },
                    // code execution before popup shows (function).
					onLoad: function (el) { },
                    // code execution after popup closed (function).
                    onClose: function () {  },
				});
   			});




	//**********************************
  $('#id_callback_popup').click(function () {



                $('#id_callback_popup').popModal({

				     html: $('#callback_popup_content').html(),

                    // Popup position (string).
                    // 'bottomCenter', 'bottomRight', 'leftTop', 'leftCenter', 'rightTop', 'rightCenter'
                    placement: 'bottomLeft',
                    // show/hide close button on popup (boolean).
                    showCloseBut: true,
                    // close popup when click on any place (boolean).
                    onDocumentClickClose: true,
                    // prevent close popup when click on specified elements (string).
                    onDocumentClickClosePrevent: '',
                    // overflow content (boolean).
                    overflowContent: false,
                    // create popup relative element (boolean).
                    inline: true,
                    // use popup for show as dropdown menu
                    // size of popup
                    size: {'width':'750'},

                    // show text, before loading content (string).
                    beforeLoadingContent: 'Please, waiting...',
                    // code execution by clicking on OK button, contained in popup (function).
					onOkBut: function (event, el) { },
                    // code execution by clicking on Cancel button, contained in popup (function).
                    onCancelBut: function (event, el) { },
                    // code execution before popup shows (function).
					onLoad: function (el) {
						$(el).find('.popModal_content').css('margin','0');

							$(".numbers").keydown(function (e) {
								// Allow: backspace, delete, tab, escape, enter and .
								if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
									// Allow: Ctrl+A, Command+A
									(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) ||
									// Allow: home, end, left, right, down, up
									(e.keyCode >= 35 && e.keyCode <= 40)) {
									// let it happen, don't do anything
									return;
								}
								// Ensure that it is a number and stop the keypress
								if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
									e.preventDefault();
								}
							});


						$(el).off('click', 'input[type="submit"]').on('click', 'input[type="submit"]', function(){
  								$('#id_callback_popup').popModal("hide");

								$('#dialog_contentCallback').dialogModal({
									topOffset: 0,
									top: '12%',
									onDocumentClickClose: false,
									onOkBut: function (event, el, current) { },
									onLoad: function (el, current) { },
									onClose: function (el, current) {  },
								  onCancelBut: function (event, el, current) {  }
								});



						});



					 },
                    // code execution after popup closed (function).
                    onClose: function () { 




				 },
				});
   			});




	//**********************************
	$('#lch').click(function (ee) {
		if(!$(this).hasClass("logged")){
			ee.preventDefault();
			$('#lch').popModal({
				html: $('#lch_content_popup').html(),
	
				// Popup position (string).
				// 'bottomCenter', 'bottomRight', 'leftTop', 'leftCenter', 'rightTop', 'rightCenter'
				placement: 'bottomRight',
				// show/hide close button on popup (boolean).
				showCloseBut: true,
				// close popup when click on any place (boolean).
				onDocumentClickClose: true,
				// prevent close popup when click on specified elements (string).
				onDocumentClickClosePrevent: '',
				// overflow content (boolean).
				overflowContent: false,
				// create popup relative element (boolean).
				inline: false,
				// use popup for show as dropdown menu
				// size of popup
				size: {'width':'750'},
	
				// show text, before loading content (string).
				beforeLoadingContent: 'Please, waiting...',
				// code execution by clicking on OK button, contained in popup (function).
				onOkBut: function (event, el) { },
				// code execution by clicking on Cancel button, contained in popup (function).
				onCancelBut: function (event, el) { },
				// code execution before popup shows (function).
				onLoad: function (el) {
				   },
		// code execution after popup closed (function).
		onClose: function () { 
	
		},
	
		});
	
	}
	


   });





		});




   $(function () {


	   //получаем курсы валют
		 $.ajax({
				url:'../kurs-valyut.php',
				type: "POST",
				dataType: "json",
				data:'', 
				success:function(data){
					console.log(data['usd']);
					$('#currencies').find('.usd').text(data['usd']);
					$('#currencies').find('.eur').text(data['eur']);
					$('#currencies').find('.cny').text(data['cny']);

				}
			 });
   });

    </script>
		</header>
		<?if(CSite::InDir('/lc/')):?>
			<div class="pw" style="margin-bottom:15px;">
			<h2 class="page-title">Личный кабинет</h2>
			<?$APPLICATION->IncludeComponent("bitrix:menu", "lc", Array(
				"ALLOW_MULTI_SELECT" => "N",	// Разрешить несколько активных пунктов одновременно
					"CHILD_MENU_TYPE" => "left",	// Тип меню для остальных уровней
					"DELAY" => "N",	// Откладывать выполнение шаблона меню
					"MAX_LEVEL" => "1",	// Уровень вложенности меню
					"MENU_CACHE_GET_VARS" => array(	// Значимые переменные запроса
						0 => "",
					),
					"MENU_CACHE_TIME" => "3600",	// Время кеширования (сек.)
					"MENU_CACHE_TYPE" => "N",	// Тип кеширования
					"MENU_CACHE_USE_GROUPS" => "Y",	// Учитывать права доступа
					"ROOT_MENU_TYPE" => "left",	// Тип меню для первого уровня
					"USE_EXT" => "N",	// Подключать файлы с именами вида .тип_меню.menu_ext.php
					"FULL_ACCESS" => $FA
				),
				false
			);?>
			
		<?endif;?>