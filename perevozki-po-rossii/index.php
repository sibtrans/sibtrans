<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Перевозки по России");
$APPLICATION->SetTitle("Перевозки по России");
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
<div id="wrapper" style="margin: 0px auto; width: 1100px; min-height:320px;">


 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
Array(),
false
);?>

</div>
<? $APPLICATION->AddChainItem("Перевозки по России","/uslugi/perevozki-po-Rossii.php"); ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>