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
<div class="news-list">

<? $count = 0; ?>
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
			<div class="pl">
				<div class="card">
					<figure class="front"><img src="<?=$arItem["FIELDS"]["PREVIEW_PICTURE"]["SRC"]; ?>"></figure>
					<figure class="back"><?=$arItem["FIELDS"]["PREVIEW_TEXT"];?></figure>
				</div>
			</div>
		<? $count = $count + 1;?>
		<?if($count == 7):?>
				<div class="pl center-text">«Байт Транзит»</div>
		<?endif;?>

<?endforeach;?>

</div>
