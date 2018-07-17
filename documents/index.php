<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Документы");
?> 
<style>
 




div.links {
            background:lightgray; /* Цвет фона */
            padding:0px;
			padding-top:7px;
			padding-bottom:7px;
            margin: 0px auto; 
            width: 800px;
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

	p{margin-left:0px;}

.news-item{ margin-top:16px;
}


</style>
 
<script type="text/javascript">

$(document).ready(function() {
     $("#prays").click();

    $('#prays').css('color', 'brown');
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
 
<div style="margin: 0px auto; width: 1100px;"> 
  <div style="margin: 0px auto; width: 800px; float: left;"> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc1",
		"EDIT_TEMPLATE" => ""
	)
);?> </div>
 </div>
 
<br />
 
<div style="clear: both;"></div>
 
<div style="margin: 0px auto; width: 1100px;"> 
  <div class="links" style="float: left;"> 	 <a class="ElementsMenu" href="#" onclick="funkSetHidden(this); return false;" id="prays" >Прайсы</a> <a class="ElementsMenu" href="#" onclick="funkSetHidden(this); return false;" id="dogovor" >Договоры</a> 		<a class="ElementsMenu" href="#" onclick="funkSetHidden(this); return false;" id="blank" >Бланки заявок</a> 		<a class="ElementsMenu" href="#" onclick="funkSetHidden(this); return false;" id="doverennost" >Доверенности</a> 		<a class="ElementsMenu" href="#" onclick="funkSetHidden(this); return false;" id="rekvizity" >Реквизиты</a> 		<a class="ElementsMenu" href="#" onclick="funkSetHidden(this); return false;" id="pravila-perevozki" >Правила перевозки</a> 	</div>
 </div>
 
<br />
 
<br />
 
<div style="margin: 0px auto; width: 1100px; min-height: 200px;"><?$APPLICATION->IncludeComponent(
	"bitrix:news",
	"list_documents",
	Array(
		"COMPONENT_TEMPLATE" => "list_documents",
		"IBLOCK_TYPE" => "documents",
		"IBLOCK_ID" => "6",
		"NEWS_COUNT" => "300",
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
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"DISPLAY_DATE" => "N",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "N",
		"USE_SHARE" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(0=>"NAME",1=>"",),
		"LIST_PROPERTY_CODE" => array(0=>"DocType",1=>"File",2=>"",),
		"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(0=>"",1=>"",),
		"DETAIL_PROPERTY_CODE" => array(0=>"DocType",1=>"File",2=>"",),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Документы",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"SEF_FOLDER" => "/documents/",
		"SEF_URL_TEMPLATES" => Array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/"
		),
		"VARIABLE_ALIASES" => Array(
			"news" => Array(),
			"section" => Array(),
			"detail" => Array(),
		)
	)
);?></div>
 
<div id="selenium-highlight"></div>
 
<div id="selenium-highlight"></div>
 
<div id="selenium-highlight"></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>