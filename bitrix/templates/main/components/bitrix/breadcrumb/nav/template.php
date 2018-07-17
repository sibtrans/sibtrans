<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */
?>



<?

global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
$css = $APPLICATION->GetCSSArray();
if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css))
{
	$strReturn .= '<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";
}

   $strReturn .= '<div class="bx-breadcrumb">';

$itemSize = count($arResult);



for($index = 0; $index < $itemSize; $index++)
{
     //исключаем из навигации пункт с URL ...  && $arResult[$index]["LINK"] != '/cost-calculation/order.php' && $arResult[$index]["LINK"] != '/cost-calculation/cost-calculation.php'
	if($arResult[$index]["LINK"]!='/about/index.php' && $arResult[$index]["LINK"] != '/cost-calculation/' &&  $arResult[$index]["LINK"] != '/perevozka-sbornogo-gruza/' &&
	   $arResult[$index]["LINK"]!= '/sbornye-gruzoperevozki-po-rossii/' && $arResult[$index]["LINK"]!= '/avtoperevozki/' && $arResult[$index]["LINK"]!= '/pryamaya-mashina/' &&
	   $arResult[$index]["LINK"]!= '/pochasovaya-arenda-avtotransporta/' && $arResult[$index]["LINK"]!= '/mezhdugorodnyaya-perevozka/'  && $arResult[$index]["LINK"]!= '/mezhdunarodnaya-avtoperevozka/' &&
	   $arResult[$index]["LINK"]!= '/zheleznodorozhnye-perevozki/' && $arResult[$index]["LINK"]!= '/perevozki-pochtovo-bagazhnoy-skorostyu/' &&  $arResult[$index]["LINK"]!= '/perevozka-gruzovoy-skorostyu/' &&
		$arResult[$index]["LINK"]!= '/perevozka-v-uskorennykh-poezdakh/' && $arResult[$index]["LINK"]!= '/konteynernye-perevozki/' && $arResult[$index]["LINK"]!= '/perevozki-po-rossii/' &&
	   $arResult[$index]["LINK"]!= '/mezhdunarodnye-konteynernye-perevozki/' && $arResult[$index]["LINK"]!= '/aviaperevozki/'  && $arResult[$index]["LINK"]!= '/aviaperevozki-po-rossii/' &&
	   $arResult[$index]["LINK"]!= '/mezhdunarodnye-aviaperevozki/' && $arResult[$index]["LINK"]!= '/charternye-aviaperevozki/'  && $arResult[$index]["LINK"]!= '/morskie-perevozki/' &&
	   $arResult[$index]["LINK"]!= '/perevozka-avtomobiley/' && $arResult[$index]["LINK"]!= '/perevozka-avtomobiley-zhd-konteynerami/' && $arResult[$index]["LINK"]!= '/perevozka-avtovozami/' &&
		$arResult[$index]["LINK"]!= '/perevozka-zernovykh-i-sypuchikh-gruzov-nasypyu/' && $arResult[$index]["LINK"]!= '/perevozka-zernovykh-kultur-nasypyu/' &&
	   $arResult[$index]["LINK"]!= '/perevozki-slozhnykh-i-negabaritnykh-gruzov/' &&  $arResult[$index]["LINK"]!= '/tamozhennoe-oformlenie/' &&  $arResult[$index]["LINK"]!= '/oformlenie-tamozhennykh-dokumentov/' &&
	   $arResult[$index]["LINK"]!= '/opredelenie-stoimosti-tamozhennykh-operatsiy/' &&  $arResult[$index]["LINK"]!= '/uslugi-kontraktoderzhatelya/' && $arResult[$index]["LINK"]!= '/inye-uslugi/' &&
	   $arResult[$index]["LINK"]!= '/upakovka-gruzov/' && $arResult[$index]["LINK"]!= '/ekspedirovanie-po-gorodu/' && $arResult[$index]["LINK"]!= '/khranenie-gruza/' && $arResult[$index]["LINK"]!= '/otvetstvennoe-khranenie/' &&
	   $arResult[$index]["LINK"]!= '/khranenie-na-teplom-sklade/' &&  $arResult[$index]["LINK"]!= '/tamozhennyy-sklad-vremennogo-khraneniya/')
		{



	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	$nextRef = ($index < $itemSize-2 && $arResult[$index+1]["LINK"] <> ""? ' itemref="bx_breadcrumb_'.($index+1).'"' : '');
	$child = ($index > 0? ' itemprop="child"' : '');



    $arrow = ($index > 0 ? '<i class="fa fa-angle-right"></i>' : '');


	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .= '
			<div class="bx-breadcrumb-item" style="margin-bottom:0px;" id="bx_breadcrumb_'.$index.'" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"'.$child.$nextRef.'>
				'.$arrow.'
				<a style="text-decoration:none;" href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url">
					<span  itemprop="title">'.$title.'</span>
				</a>
		</div>';
	}
	else
	{
	  $strReturn .= '
	   <div class="bx-breadcrumb-item" style="margin-bottom:0px;">
		 '.$arrow.'
	   <span style="text-decoration:none;">'.$title.'</span>

		</div>';
	 }


	 }

   }



$strReturn .= '<div style="clear:both"></div><hr class="line-gradient"><br/><br/></div><br/>';

return $strReturn;
?>


