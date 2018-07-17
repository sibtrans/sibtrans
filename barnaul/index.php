<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "🚚 Перевозка грузов Барнаул — Транспортная Компания «Байт Транзит». Грузоперевозки в любом объёме: железнодорожным, автомобильным, морским и авиатранспортом по России и всему Миру!");
$APPLICATION->SetPageProperty("TITLE", "Грузоперевозки Барнаул — Транспортная Компания «Байт Транзит»");
$APPLICATION->SetTitle("Барнаул");
?> 
<style>
	.ballon_data p{padding:3px;}
</style>
 
<script>

$(document).ready(function(){

var timer;
	function getLocationTime(nd){

				var ndd = nd;
				var mseconds = 0;
			   (function(){
		
				var date = new Date(ndd + mseconds);
	
				var time = date.getHours() +':'+date.getMinutes()+':'+date.getSeconds();
		
				   // console.log(date); //.addClass('day_week');
	
	
	
				mseconds = mseconds + 1000;
	
	
			 $('.location_time').empty();
			  $('.location_time').append(time);
			   clearTimeout(timer);
			   timer = window.setTimeout(arguments.callee, 1000);
			  })();
		};
	
		function getTimeMoscow()
		{
			var dif_hour_Moscow = $('#dif_hour_Moscow').text();
	
			console.log(dif_hour_Moscow); // разница в часах от Москвы
	
				$.ajax({
					url :'../maps/get-time-Moscow.php',
					type: "POST",
					 dataType: 'text',
					 success:function(Moscow_time){
						 //var date = new Date(html);
						 // console.log(html);  // Московское время
							var arr = Moscow_time.split("|");
							var d = new Date(arr[2],arr[1]-1,arr[0],arr[3],arr[4],arr[5]);
							var nd = d.getTime()+ parseInt(dif_hour_Moscow)*60*60*1000;
	
						 //	var nd=new Date(d.getTime()+ parseInt(dif_hour_Moscow)*60*60*1000);
						 //console.log(nd);
						 //var hours = nd.getHours(); //returns 0-23
						 //if(hours < 10){hours = '0' + hours;}
						 // var minutes = nd.getMinutes(); //returns 0-59
						 //  if(minutes < 10){minutes = '0' + minutes;}
						 /// var seconds = nd.getSeconds(); //returns 0-59
	
	
						 // $('.location_time').text(hours + ' : ' + minutes );
	
						 getLocationTime(nd);
	
						}
					});
		}


			getTimeMoscow();



	});


</script>
 
<br />
 
<br />
 
<br />
 
<br />
 
<br />
 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"filials_details",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "fls",
		"IBLOCK_ID" => "1",
		"NEWS_COUNT" => "300",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(0=>"ID",1=>"",),
		"PROPERTY_CODE" => array(0=>"PHONE_OOP",1=>"Email",2=>"ADDRESS",3=>"p_Sun",4=>"p_Tue",5=>"p_Mon",6=>"p_Fri",7=>"p_Sat",8=>"p_Wed",9=>"p_Thu",10=>"v_Sun",11=>"v_Tue",12=>"v_Mon",13=>"v_Fri",14=>"v_Sat",15=>"v_Wed",16=>"v_Thu",17=>"YANDEX_MAP",18=>"STORAGE_CARGO",19=>"OFFICE",20=>"RESIV_SEND_CARGO",21=>"DIF_HOUR_MOSCOW",22=>"PHONE_D",23=>"TRANSLIT",24=>"",),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
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
		"COMPONENT_TEMPLATE" => "filials_details",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>