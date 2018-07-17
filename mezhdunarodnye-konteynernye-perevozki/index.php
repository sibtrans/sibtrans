<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Международные перевозки");
$APPLICATION->SetTitle("Международные перевозки");
?>


<style>
div#wrapper	a:link { 
		color:black;
		text-decoraton:none;
        }
	div#wrapper a:hover{ color:brown; }
  ul {
    list-style:disc outside;   
   }
	table,tr,td {border-style:solid; border-width:1px;} 

</style>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div id="wrapper" style="margin: 0px auto; width: 1100px; min-height:320px;">


 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => ""

	)
);?>


</div>
 <br>
 <? $APPLICATION->AddChainItem($APPLICATION->GetTitle(), $APPLICATION->GetCurPage()); ?> 

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>