<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Экспедирование по городу");
$APPLICATION->SetTitle("Экспедирование по городу");
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
Array(),
false
);?>

</div>
<? $APPLICATION->AddChainItem("Экспедирование по городу","/uslugi/ekspedirovanie-po-gorodu.php"); ?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>