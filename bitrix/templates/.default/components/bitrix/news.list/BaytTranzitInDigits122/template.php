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
//$this->setFrameMode(true);
?>

 <div class="plates">

<?foreach($arResult["ITEMS"] as $arItem):?>

	<div class="pl-item">



		<p class="r1">
			<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

			<?if($arProperty["NAME"] == "Цифра"):?> 
              <span><?=$arProperty["DISPLAY_VALUE"];?></span>
            <?endif;?>

           <?endforeach;?>

            <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

			<?if($arProperty["NAME"] != "Цифра"):?> 
              <?=$arProperty["DISPLAY_VALUE"];?>
            <?endif;?>

           <?endforeach;?>
		  </p>

	    <p class="r2">
				<?echo $arItem["NAME"]?>
		</p>
	
	

	</div>

<?endforeach;?>

	</div>
