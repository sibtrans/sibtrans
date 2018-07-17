<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Чартерные авиаперевозки");
$APPLICATION->SetTitle("Чартерные авиаперевозки");
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
<? $APPLICATION->AddChainItem("Чартерные авиаперевозки","/uslugi/charternye-aviaperevozki.php"); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>