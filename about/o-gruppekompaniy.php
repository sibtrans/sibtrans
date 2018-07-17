<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О группе компаний");
?> 

<style>
div#wrapper	a:link { 
		color:black;
		text-decoration:none;
        }
	div#wrapper a:hover{ color:brown; }
  ul {
    list-style:disc outside;

   
   }

</style>

  <br />
 
  <br />
 
  <br />
 
  <br />
 
  <br />
 
  <br />
 
  <div id="wrapper" style="margin: 0px auto; width: 1100px; min-height: 320px;"> <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
	"AREA_FILE_SHOW" => "page",	// Показывать включаемую область
		"AREA_FILE_SUFFIX" => "inc",	// Суффикс имени файла включаемой области
		"EDIT_TEMPLATE" => "",	// Шаблон области по умолчанию
	)
);?> </div>
 
  <br />
 <? $APPLICATION->AddChainItem($APPLICATION->GetTitle(), $APPLICATION->GetCurPage()); ?> </st><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>