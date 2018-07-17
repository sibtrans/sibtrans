<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="lc_menu">
<ul>
<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<li class="active"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<?if(($arParams["FULL_ACCESS"]=="N")&&($arItem["PARAMS"]["NEED_FULL"]=="Y")):?>
			<li class="disabled"><?=$arItem["TEXT"]?></li>
		<?else:?>
			<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
		<?endif;?>
	<?endif?>
	
<?endforeach?>

</ul>
</div>
<?endif?>