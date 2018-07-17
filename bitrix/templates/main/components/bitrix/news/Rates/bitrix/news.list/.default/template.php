<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?><div class="news-list">



<div style="margin: 0px auto; width: 1100px;"> 
  <div class="links"> 	 



<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>



						<?foreach($arItem["PROPERTIES"] as $pid=>$arProperty):?>
			
									 <? if($pid == "RateType")
										{
										  if($arProperty["VALUE"])
											{

	                      ?><a class="ElementsMenu" href="#" onclick="funkSetHidden(this); return false;" id="<?=$arProperty["VALUE"]; ?>"><?echo $arItem["NAME"]?></a> <?
			
											}
										} ?>
						<?endforeach;?>



<?endforeach; ?>

   </div>
 </div>


<div id="wrapper" style="margin: 0px auto; width: 1100px; min-height: 320px;">
	<br/>
    <?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>



                 	<?foreach($arItem["PROPERTIES"] as $pid=>$arProperty):?>
			
									 <? if($pid == "RateType")
										{
										  if($arProperty["VALUE"])
											{

												?> <div class="news-item" id="<?=$arProperty["VALUE"]; ?>">

                                                            <?echo $arItem["PREVIEW_TEXT"];?>
									
												 </div>
											<? }
										} ?>
						<?endforeach;?>


   <?endforeach; ?>





</div>