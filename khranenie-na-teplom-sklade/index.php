<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Хранение на теплом складе");
$APPLICATION->SetTitle("Хранение на теплом складе");
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
<? $APPLICATION->AddChainItem("Хранение на теплом складе","/uslugi/khranenie-na-teplom-sklade.php"); ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>