<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Таможенный склад временного хранения");
$APPLICATION->SetTitle("Таможенный склад временного хранения");
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
</style>

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
	),
false
);?>


</div>

<? $APPLICATION->AddChainItem("Таможенный склад временного хранения","/uslugi/tamozhennyy-sklad-vremennogo-khraneniya.php"); ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>