<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Услуги");

$APPLICATION->SetTitle("Услуги");
?> 
<style>
#line_block { 
        width:320px; 
        
       
        float:left; 
        margin: 0 15px 15px 0; 
        text-align:left;
        padding: 10px;
        }



div#wrapper a, a:link {
    color:black;
   text-decoration:none;
   }

 div#wrapper a:hover {
   color:brown; /* Цвет ссылки */ 
   } 




</style>
 
<div id="wrapper" style="margin: 0px auto; width: 1100px;"> 	 
  <br />
 
  <br />
 
  <div id="uslugi"> 					 
    <br />
   					 
    <br />
   
    <br />
   
    <br />
   					 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc4",
		"EDIT_TEMPLATE" => ""
	)
);?> 
    <br />

    <br />
   				</div>
 				 
  <div id="line_block"> 					 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	".default",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_TEMPLATE" => "standard.php"
	)
);?> 				</div>
 						 
  <div id="line_block"> 							 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc2",
		"EDIT_TEMPLATE" => ""
	)
);?> 						</div>
 					 
  <div id="line_block"> 						 <?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "page",
		"AREA_FILE_SUFFIX" => "inc3",
		"EDIT_TEMPLATE" => ""
	)
);?> 					</div>
 	</div>
 
<div style="clear: both;"> </div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>