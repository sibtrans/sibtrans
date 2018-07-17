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

 <? $count = 1; ?>

  <div class="questions">

<?foreach($arResult["ITEMS"] as $arItem):?>



	  <?if($count == 1): ?>
        <div class="q-item active" id="h<? echo $count ?>">

			<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
				<?else:?>
					<b><?echo $arItem["NAME"]?></b><br />
				<?endif;?>
			<?endif;?>


	    </div>
      <?else:?>
        <div class="q-item" id="h<? echo $count ?>">

			<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
				<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
					<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
				<?else:?>
					<b><?echo $arItem["NAME"]?></b><br />
				<?endif;?>
			<?endif;?>


	    </div>
      <?endif;?>

<? $count = $count + 1; ?>

<?endforeach;?>

</div>

<div class="answers">

 <? $count = 1; ?>


	<?foreach($arResult["ITEMS"] as $arItem):?>


     <?if($count == 1): ?>
	   <div class="answer-item active" id="i<? echo $count ?>">
		
			   <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
					<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
								class="preview_picture"
								border="0"
								src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
								width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
								height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
								alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
								title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
								style="float:left; margin:7px;"
								/></a>
					<?else:?>
						<img
							class="preview_picture"
							border="0"
							src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
							width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
							height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
							alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
							title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
		style="float:left; margin:7px"
							/>
					<?endif;?>
				<?endif?>
		
				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<?echo $arItem["PREVIEW_TEXT"];?>
				<?endif;?>
		
				<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
					<div style="clear:both"></div>
				<?endif?>
	</div>
    <?else:?>
  <div class="answer-item" id="i<? echo $count ?>">
		
			   <?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
					<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
								class="preview_picture"
								border="0"
								src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
								width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
								height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
								alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
								title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
								style="float:left; margin:7px"
								/></a>
					<?else:?>
						<img
							class="preview_picture"
							border="0"
							src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
							width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
							height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
							alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
							title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
							style="float:left; margin:7px"
							/>
					<?endif;?>
				<?endif?>
		
				<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
					<?echo $arItem["PREVIEW_TEXT"];?>
				<?endif;?>
		
				<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
					<div style="clear:both"></div>
				<?endif?>
	</div>
  <?endif;?>

      <? $count = $count + 1; ?>




	<?endforeach;?>

</div>


