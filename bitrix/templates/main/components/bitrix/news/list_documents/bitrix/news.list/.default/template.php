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
?>
<div class="news-list" id="list_documents" style="margin: 0px auto; min-height:320px;">
	<br/>



<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>



       	<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>

			<?else:?>

                <? if($pid === "DocType") 
	               {
                      if($arProperty["VALUE"])
                         {
                          ?> <p class="news-item" id="<?=$arProperty["VALUE"]; ?>"> <?

                         }
				   }
                ?>
			<?endif?>

		<?endforeach;?>



		<?echo rtrim($arItem["NAME"]); ?>


		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>



					<? if($pid === "File"): ?>

 						<? foreach($arProperty["FILE_VALUE"] as $k=>$val):?> 

							<?if($k === "SRC"):?>
					           <a href="<?print_r($val)?>">Загрузить</a>
							<?endif;?>

					 	<?endforeach;?>


				  <?endif;?>



		<?endforeach;?>
	</p>


<?endforeach;?>

</div>




