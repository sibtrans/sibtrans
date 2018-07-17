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


<div class="right_block" style="margin-top:130px;">

<table border="1" class="table_block">
	  <tr>
		  <td>

				<form name="<?echo $arResult["FILTER_NAME"]."_form"?>" action="<?echo $arResult["FORM_ACTION"]?>" method="get">
					<?foreach($arResult["ITEMS"] as $arItem):
						if(array_key_exists("HIDDEN", $arItem)):
							echo $arItem["INPUT"];
						endif;
					endforeach;?>
					<table class="data-table" cellspacing="0" cellpadding="2" style="margin:30px;">
					<thead>
						<tr>
							<td colspan="2" align="center"></td>
						</tr>
					</thead>
					<tbody>
						<?foreach($arResult["ITEMS"] as $arItem):?>
							<?if(!array_key_exists("HIDDEN", $arItem)):?>
									<tr>
										<td style="padding:5px;" colspan="2"  valign="top"><b>
                                                          <? 
																$pos1 = $arItem["NAME"];
                                                            if(stripos($pos1, "Начало активности") === false)
															{ echo $arItem["NAME"];}else{ echo "Период";}   ?></b></td>
									</tr>
									<tr>
										<td style="padding:3px;" colspan="2"  valign="top"><?=$arItem["INPUT"]?></td>
								   </tr>
							<?endif?>
						<?endforeach;?>
					</tbody>
					<tfoot>
						<tr>

							<td colspan="2">
								<br/>
								<!-- <input type="submit" name="set_filter" value="<?=GetMessage("IBLOCK_SET_FILTER")?>" /> -->
								<input type="submit" name="set_filter" value="Применить" />
								<input type="hidden" name="set_filter" value="Y" />&nbsp;&nbsp;
								<input type="submit" name="del_filter" value="<?=GetMessage("IBLOCK_DEL_FILTER")?>" />
							</td>
						</tr>
					</tfoot>
					</table>
				</form>
		  </td>
		</tr>
	</table>
</div>