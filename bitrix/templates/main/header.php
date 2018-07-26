<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
if($USER->isAuthorized()){
	$rsUser = CUser::GetList(($by="ID"), ($order="asc"), array("ID"=>$USER->GetID()), array("SELECT"=>array("UF_UN", "UF_SS_CODE")))->Fetch();
}

if(CSite::InDir('/lc/')){
	//define ("NEED_AUTH", true);
	$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
	$uid=$USER->GetID();
	if($uid=="")$uid=-1;
	$rsUser = CUser::GetList(($by="ID"), ($order="asc"), array("ID"=>$uid), array("SELECT"=>array("UF_UN", "UF_SS_CODE")))->Fetch();
	$un=$rsUser["UF_UN"];
	$ss_code=$rsUser["UF_SS_CODE"];
	$uInfo=array();
	$FA="N";
	if($un!=""){
		$uInfo=getUserInfo($un);
		$uInfo=$uInfo["klc"];
		$FA="Y";
	}
	foreach($uInfo as $k=>$v){
		if((is_array($v))&&(count($v)==0))$uInfo[$k]="";
	}
}
?>


<!DOCTYPE html>
<html>
	<head>
		
		
<meta name="viewport" content="width=1330px; initial-scale=1">

     	<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery-3.2.1.js");?>


        <? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/main.js");?>
		<? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/reset.css");?>
		<? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/font-awesome.css");?>
		<? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/main.css");?>
       	<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/popup.js");?>
		<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery-ui.js");?>
		<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/jquery.ui.datepicker-ru.js");?>
		<? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/jquery-ui.css");?>
		<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH_MAIN."js/jquery-1.10.2.min.js");?>

	<title><?$APPLICATION->ShowTitle();?></title>
		

		<link rel="apple-touch-icon" sizes="57x57" href="/fav/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/fav/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/fav/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/fav/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/fav/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/fav/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/fav/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/fav/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/fav/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/fav/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/fav/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png">
		<link rel="manifest" href="/fav/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">



<!--LiveInternet counter--> 
<script type="text/javascript">




	/*
	document.write("<a style=\"position:absolute\" href='//www.liveinternet.ru/click' target=_blank><img src='//counter.yadro.ru/hit?t14.2;r"+escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+""+screen.height+""+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";h"+escape(document.title.substring(0,150))+";"+Math.random()+
"' alt='' title='LiveInternet: показано число просмотров за 24"+
" часа, посетителей за 24 часа и за сегодня' "+
"border='0' width='88' height='31'><\/a>")
*/
</script> 
<!--/LiveInternet-->


<!-- Yandex.Metrika counter --> 
<script type="text/javascript" > 
(function (d, w, c) {
 (w[c] = w[c] || []).push(function() { 
	try { 
	w.yaCounter44883502 = new Ya.Metrika({ 
		id:44883502, 
		clickmap:true, 
		trackLinks:true, 
		accurateTrackBounce:true, 
	 	webvisor:true }); 
	  } catch(e) { } 
	}); var n = d.getElementsByTagName("script")[0], 
		s = d.createElement("script"), 
		f = function () { n.parentNode.insertBefore(s, n); }; 
	s.type = "text/javascript"; 
	s.async = true; 
	s.src = "https://mc.yandex.ru/metrika/watch.js";
	 if (w.opera == "[object Opera]") { 
		d.addEventListener("DOMContentLoaded", f, false); 
		} else { f(); }
	 })(document, window, "yandex_metrika_callbacks"); 
</script> <noscript><div><img src="https://mc.yandex.ru/watch/44883502" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
 <!-- /Yandex.Metrika counter -->


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-100486839-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'UA-100486839-1');
</script>

<meta name="yandex-verification" content="36f6d98db4396bd2" />

       <? $APPLICATION->ShowHead(); ?> 

      <? CModule::IncludeModule("iblock"); 
		//id нужного инфоблока 
		$iblock_id = 5; 
		$arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE"=>"Y");
		$res_count = CIBlockElement::GetList(Array(), $arFilter, Array(), false, Array());
       ?>


		<? //$valutes = GetValute(); ?>








		<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/popModal.js" type="text/javascript"></script>
		<link rel="stylesheet" href="<? echo SITE_TEMPLATE_PATH; ?>/css/popModal.css">

		<? $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/custom.css");?>

	</head>
	<body>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
		<header style="
    box-shadow: 0 0 12px rgba(0,0,0,0.5); /*  */
    ">
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
								<a href="/lc/" id="lch" class="logged"><?=($rsUser["WORK_COMPANY"]!="")?$rsUser["WORK_COMPANY"]:"Личный кабинет"?></a><a href="?logout=yes" class="btnLogout"></a>
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
								<p class="phone" style="margin-top:0px;">
									<a href="tel:88007700040" style="text-decoration:none; color:#564c46;">8 800 77 000 40</a><br/>
									<a href="tel:" style="text-decoration:none; color:#564c46; font-size:20px;" id="phone-office-location"></a>
								</p>
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

			<?$APPLICATION->IncludeComponent(
	"bitrix:breadcrumb", 
	"nav", 
	array(
		"START_FROM" => "0",
		"PATH" => "",
		"SITE_ID" => "s1",
		"COMPONENT_TEMPLATE" => "nav"
	),
	false
);?> 
			
			</div>
			<div id="content_filials" style="display:none;">
				<div><p style="text-align:center; margin:0; color:#92211d; font-size:large; width:550px;"><b>Выбрать филиал</b></p></div>
				<div style="float:left; width:190px; border-right:solid; border-right-color:gray; border-width:thin; margin:10px;">
						<ul style="padding:0; padding-right:10px;">

							<li style="list-style-type: none; text-decoration:underline; margin-top:3px;"><a style="color:black;"  href="../maps/Russia.php?x=55.78&y=37.66&zoom=11&City=Москва&CityPhoneNumber=<?=GetPhoneNumberBySity("Москва");?>">Москва</a></li>
							<li style="list-style-type: none; text-decoration:underline; margin-top:3px;"><a style="color:black;"  href="../maps/Russia.php?x=55.0&y=83.0&zoom=11&City=Новосибирск&CityPhoneNumber=<?=GetPhoneNumberBySity("Новосибирск");?>">Новосибирск</a></li>
							<li style="list-style-type: none; text-decoration:underline; margin-top:3px;"><a style="color:black;"  href="../maps/Russia.php?x=56.9&y=60.60&zoom=11&City=Екатеринбург&CityPhoneNumber=<?=GetPhoneNumberBySity("Екатеринбург");?>">Екатеринбург</a></li>
							<li style="list-style-type: none; text-decoration:underline; margin-top:3px;"><a style="color:black;"  href="../maps/Russia.php?x=54.99&y=73.47&zoom=11&City=Омск&CityPhoneNumber=<?=GetPhoneNumberBySity("Омск");?>">Омск</a></li>
							<li style="list-style-type: none; text-decoration:underline; margin-top:3px;"><a style="color:black;"  href="../maps/Russia.php?x=56.025&y=92.79&zoom=12&City=Красноярск&CityPhoneNumber=<?=GetPhoneNumberBySity("Красноярск");?>">Красноярск</a></li>

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
						<span style="color: #4d4948">Ваш филиал - </span><div id=filials_cities style="display:inline-block;">
											<?foreach(getFilials() as $key=>$value):?>
																	<?foreach($value['Cities'] as $k=>$v):?>
											<div class="cities_of_filials" style="display:none;" data-filial-name="<?=$value["Name"];?>" data-filial-phone="<?=GetPhoneNumberBySity($value["Name"]);?>"  data-filial-id="<?=$key;?>" id="<?=$k;?>"> <?=$value["Name"];?></div>
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
<?
function GetPhoneNumberBySity($SityName)
{
    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");
	$arFilter = Array("IBLOCK_ID"=>IntVal("1"));
	if(CModule::IncludeModule("iblock")){

	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
	$arFilter = Array("IBLOCK_ID"=>IntVal("1"), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>300), $arSelect);
	while($ob = $res->GetNextElement()){
 
	 		$arFields = $ob->GetFields();  
	
			 if(strpos($arFields["NAME"], $SityName) !== false)
			 {
				 $arProps = $ob->GetProperties();

					if(strpos($arFields["NAME"], 'Новосибирск') !== false && $arFields["ID"] == 98)
					{
						return $arProps["PHONE_OOP"]["VALUE"][0];
					}
					else if(strpos($arFields["NAME"], 'Новосибирск') === false)
					{
						return $arProps["PHONE_OOP"]["VALUE"][0];
					}
			 }
		}
	}


}
?>



			<div id="callback_popup_content" style="display:none; width:400px;">
				<div style="width:400px;">
					 <form  method="POST" id="frmCallback">
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
							<input type="button" class="form-btn" style="margin:0" value="Отправить"/>

						 </form>
						 
				</div>
			</div>


			<div id="lch_content_popup" style="display:none;">
				<div style="width:230px;">
					<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.authorize", 
	"", 
	array(
		"COMPONENT_TEMPLATE" => "",
		"REGISTER_URL" => "",
		"FORGOT_PASSWORD_URL" => "/lc/",
		"PROFILE_URL" => "",
		"SHOW_ERRORS" => "N"
	),
	false
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
	<div id="lc-feedback-popup" class="dialog_contentCallback">
        <div class="dialogModal_header">Отправка сообщения</div>
        <div class="dialogModal_content">
            Ваше сообщение отправлено! Спасибо за обращение.<br>
        </div>
        <div class="dialogModal_footer">
            <!--<button type="button" class="btn btn-primary" data-dialogmodal-but="next">ОК</button>-->
            <button type="button" class="btn btn-default" data-dialogmodal-but="ok">ОК</button>
        </div>
    </div>


</div>










<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"Action_transp", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "Action_transp",
		"IBLOCK_ID" => "11",
		"NEWS_COUNT" => "5",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "ActionID",
			1 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "ID=#ELEMENT_ID#",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DISPLAY_PANEL" => "N",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "N",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Акции",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "Action_transp",
		"CACHE_GROUPS" => "Y",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => ""
	),
	false
);?> 




<script type="text/javascript">





 $(function(){




							// определяем тел из сессии 
							getPhoneNumberCityFromSession((function(output){
								console.log('тел из сессии ', $(output).text());
								if($(output).text().trim().trim() !== '')
								{
									 $('#phone-office-location').attr('href', "tel:" + $(output).text());
									 $('#phone-office-location').text($(output).text());
								}
								else
								{

								console.log('Записб тел в сессию ', $(output).text());

									$('#phone-office-location').text("+7(383) 241-06-49");
									$('#phone-office-location').attr('href', "tel:+7(383) 241-06-49");
									
									getPhoneNumberCityFromSession((function(output){
										}),'+7(383) 241-06-49')
								}

							}),'')





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

							/*ymaps.ready(init);

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
								}*/

								$('#s_city').find('span').html('Новосибирск');

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

							//	console.log("data-filial-phone " + $(this).attr('data-filial-phone'));
									var PhoneCity = $(this).attr('data-filial-phone');
									$("#phone-office-location").text(PhoneCity);
									$("#phone-office-location").attr("href", "tel:" + PhoneCity);


									// запись данных в сессию
									getPhoneNumberCityFromSession((function(output){
										console.log('запись данных в сессию', PhoneCity);
									}), PhoneCity);





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

						var btn=$(el).find('.btn_down_List');
 						 var list = $(el).find('.city_list_List');

						var input=$(el).find('input');
						var par=$(el).find('.city-select_List');


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
                var show = list.find('.city_item_List').not('.disabled');

 				if(code==13){

					if(show.length>0){
						$(show[0]).trigger('click');
					}
				}else if(show.length==1 && input.val().toLowerCase() == $(show[0]).text().toLowerCase() ){

				$(show[0]).trigger('click');


				} else {
					showList(par,$(this).val());
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
						$(this).find('.popModal_content').css('margin','0');
						  //console.log($(this).find('.popModal'));

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
							//
							var form= $(el).find('form');
							form.find('input[type=button]').unbind("click").bind("click",function(){
								var btn=$(this);
								btn.attr('disabled','1');
								var dta=form.serialize()+"&action=callback";
								$.ajax({
									type: "POST",
									url: "/formsSender.php",
									data: dta,
									dataType:"json",
									success: function(result){
										if(result.state=="success")
										$('#dialog_contentCallback').dialogModal({
											topOffset: 0,
											top: '12%',
											onDocumentClickClose: false,
											onOkBut: function (event, el, current) { $('#id_callback_popup').popModal('hide');btn.removeAttr('disabled'); },
											onLoad: function (el, current) { },
											onClose: function (el, current) { $('#id_callback_popup').popModal('hide');btn.removeAttr('disabled'); },
											onCancelBut: function (event, el, current) { $('#id_callback_popup').popModal('hide');btn.removeAttr('disabled'); }
										});
									}
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
				size: {'width':'250'},
	
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
	   var d,n;
		 $.ajax({
				url:'/kurs-valyut.php',
				type: "POST",
				dataType: "json",
				data:'',
				async: true,
				success:function(data){
					console.log(data,typeof data);
					if(data !== null){
						$('#currencies').find('.usd').text(data['usd']);
						$('#currencies').find('.eur').text(data['eur']);
						$('#currencies').find('.cny').text(data['cny']);
					}
				}
			 });
   });






    </script>
		</header>
		<?if(CSite::InDir('/lc/')):?>
			<div class="pw" style="margin-bottom:15px;">
			<h2 class="page-title">Личный кабинет</h2>
			<?if($USER->isAuthorized()):?>
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
		<?endif;?>