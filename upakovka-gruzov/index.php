<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Упаковка грузов");
$APPLICATION->SetTitle("Упаковка грузов");
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
<? $APPLICATION->AddChainItem("Упаковка грузов","/uslugi/upakovka-gruzov.php"); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>