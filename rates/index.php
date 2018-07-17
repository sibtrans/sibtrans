<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тарифы");
?> 
<style>


div.links {
            background:lightgray; /* Цвет фона */
            padding:0px;
			padding-top:7px;
			padding-bottom:7px;
            margin: 0px auto; 
		display:inline-block;
           font-family:'Segoe UI';
           font-size: 13pt;
        }

            div.links a {
                color:#3C3333; /* Цвет ссылок */
                display: inline-block; /* Строчно-блочный элемент */
                border-left: 1px solid #3C3333; /* Параметры рамки слева */
                padding: 0px 10px; /* Поля вокруг ссылок */
                text-decoration:none;
            }

                div.links a:first-child {
                    border-left: none; /* Убираем первую линию слева */
                }

                div.links a:hover{ color:brown;}


div#wrapper	a:link { 
		color:black;
		text-decoraton:none;
        }
	div#wrapper a:hover{ color:brown; }
  ul {
    list-style:disc outside;
   
   }





</style>
 
<script type="text/javascript">

$(document).ready(function() {
     $("#Russia").click();

    $('#Russia').css('color', 'brown');
});



function funkSetHidden(elem) {

  var vol = document.getElementsByClassName("ElementsMenu");

  for (var i = 0; i < vol.length; i++)
   {
		  if(vol[i].id === elem.id)
		  {
			vol[i].style.color = 'brown'; 
		  }
	      else{ 
			vol[i].style.color = '#3C3333';
		  }
   }





  var elems =document.getElementsByClassName('news-item');

   for (var i = 0; i < elems.length; i++)
   {
      if(elem.id === elems[i].id)
	  {
         elems[i].style.display = "";

	  }
      else
	  {
       elems[i].style.display = "none";
     
	  }
   }
}




</script>
 
<br />
 
<br />
 
<br />
 
<br />
 
<br />
 
<br />
 
<br />
 
<div style="margin: 0px auto; width: 1100px;"> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc1",
		"EDIT_TEMPLATE" => ""
	)
);?> </div>
 

 <?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"Rates",
	Array(
		"COMPONENT_TEMPLATE" => "Rates",
		"IBLOCK_TYPE" => "Rates",
		"IBLOCK_ID" => "8",
		"NEWS_COUNT" => "20",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(0=>"PREVIEW_TEXT",1=>"",),
		"LIST_PROPERTY_CODE" => array(0=>"RateType",1=>"TypeRate",2=>"",),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "N",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(0=>"",1=>"",),
		"DETAIL_PROPERTY_CODE" => array(0=>"RateType",1=>"",),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "N",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "N",
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
		"VARIABLE_ALIASES" => Array(
			"SECTION_ID" => "SECTION_ID",
			"ELEMENT_ID" => "ELEMENT_ID"
		)
	)
);?> 
<br />
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>