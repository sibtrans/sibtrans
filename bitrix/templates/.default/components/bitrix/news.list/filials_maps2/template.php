<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>


<?
$index = 1; // Порядковый номер объекта на карте
foreach($arResult["ITEMS"] as $arItem){
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    //Разбиваем координаты яндекс карты на X и Y координату
    $Yandex = explode(",", $arItem["PROPERTIES"]["YANDEX_MAP"]["VALUE"]);
    $Yandex_X = $Yandex[0];
    $Yandex_Y = $Yandex[1];

$city = $_GET["City"];

$pos = strpos($arItem["NAME"], $city);
?>

<?if($pos !== false || $_GET["City"] == ""):?>

<? $dhours = $arItem["PROPERTIES"]["DIF_HOUR_MOSCOW"]["VALUE"]; ?>

<?

		date_default_timezone_set('Europe/Moscow'); 

		$date = date("Y-m-d H:i:s");
		
		$newdate = strtotime ( '+'.$arItem["PROPERTIES"]["DIF_HOUR_MOSCOW"]["VALUE"].' hour' , strtotime ( $date ) ) ;
		$newdate = date ( 'Y-m-d H:i:s' , $newdate );
		
		$day_number = strftime("%w", strtotime($newdate));
		
		$day_number;

	$p_day = 'p_'.$day_number;
	$v_day = 'v_'.$day_number;
 ?>



<div class="shop-data" data-index="<?=$index?>" data-name="<?=$arItem["NAME"]?>"
    data-yandex-x="<?=$Yandex_X;?>"
    data-yandex-y="<?=$Yandex_Y;?>"
    data-address="<?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?>"

	data-resiv-send-cargo="<?=$arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"];?>"
	data-storage-cargo="<?=$arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"];?>" 
	data-office="<?=$arItem["PROPERTIES"]["OFFICE"]["VALUE"];?>" style="display:none;"
	data-ballon-id="b<?=$arItem["ID"];?>"></div>

<div style="display:none;" class="ballon_data" id="b<?=$arItem["ID"];?>">
	<div style="width:560px; padding:6px; padding-right:0;" id="<?=$arItem["ID"];?>">
		<div style="float:left; width:60%; padding-top:8px;">
			<a href="../<?=$arItem["PROPERTIES"]["TRANSLIT"]["VALUE"];?><?//='.php?Id'.$arItem["ID"];?>" style="color:#92211d; font-size:large; font-weight:bolder;" ><?=$arItem["NAME"];?></a>
			
</div>
		<div style="float:left; text-align:center; width:22%;">
			<?if($arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"] == 1):?>
				<img src="/bitrix/templates/main/images/resiv_send_cargo.png" alt="Приём-выдача груза" />
			<?endif;?>
			<?if($arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"] == 1):?>
				<img src="/bitrix/templates/main/images/storage_cargo.png" alt="Ответственное хранение груза" />
			<?endif;?>
			<?if($arItem["PROPERTIES"]["OFFICE"]["VALUE"] == 1):?>
				<img style="margin-bottom: 6px;" src="/bitrix/templates/main/images/office.png" alt="Офис" />
			<?endif;?>
		</div>
		<div class="location_time" style="float:left; width:18%; text-align:right; font-size:large; padding-top:8px;">
		</div>
		<div style="display:none;" id="dif_hour_Moscow"><?=$arItem["PROPERTIES"]["DIF_HOUR_MOSCOW"]["VALUE"];?></div>
		<div style="clear:left;"></div>
	</div>

	<div style="width:560px; padding:6px; padding-right:0;">
		<div style="float:left; width:50%; border-bottom: solid; border-width: thin; border-color:whitesmoke;">
			<p><?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?></p>

		</div>
		<div style="float:left; width:50%;">
		</div>
		<div style="clear:left;"></div>
	</div>

	<div style="width:560px; padding:6px; padding-right:0;">
		<div style="float:left; width:50%;">
			<p>Перед отправкой груза рекомендуем предварительно <a href="../cost-calculation/order.php">оформить заявку</a></p>
		</div>
		<div style="float:left; width:50%; border-bottom:solid; border-width:thin; border-color:gray; padding-bottom:5px;">
			<div style="float:left; width:30%; text-align:center;">
				<img src="../bitrix/templates/main/images/documents.png" width="50" height="50" alt="Документы" />
			</div>
			<div style="float:left; width:70%; line-height:50px;">
				<a href="../documents/">Документы</a>
			</div>
		</div>
		<div style="clear:left;"></div>
	</div>

	<div style="width:560px; padding:6px; padding-right:0;">
		<div style="float:left; width:50%;">
			<p style="font-weight:bolder">График работы</p>

			<div style="width:100%; <?if($arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"] == 0){ echo 'display:none;'; } ?>">
			<p style="margin-top:10px; margin-bottom:10px;"><?=$arItem["PROPERTIES"]["NAME_SCHEDULE_1"]["VALUE"];?></p>

				<div class="p_1 <? if($p_day == 'p_1'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>пн</p>
					<hr style="color:gray; height:2px; background-color:gray; border-style:solid;">
					<? $arMon = preg_split('[/]',$arItem["PROPERTIES"]["p_Mon"]["VALUE"]);?>
					<p><?=$arMon[0];?></p>
					<p><?=$arMon[1];?></p>
				</div>
				<div class="p_2 <? if($p_day == 'p_2'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>вт</p>
					<hr style="color:gray; height:2px; background-color:gray; border-style:solid;">
					<? $arTue = preg_split('[/]',$arItem["PROPERTIES"]["p_Tue"]["VALUE"]);?>
					<p><?=$arTue[0];?></p>
					<p><?=$arTue[1];?></p>
				</div>
				<div class="p_3 <? if($p_day == 'p_3'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>ср</p>
					<hr style="color:gray; height:2px; background-color:gray; border-style:solid;">
					<? $arWed = preg_split('[/]',$arItem["PROPERTIES"]["p_Wed"]["VALUE"]);?>
					<p><?=$arWed[0];?></p>
					<p><?=$arWed[1];?></p>
				</div>
				<div class="p_4 <? if($p_day == 'p_4'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>чт</p>
					<hr style="color:gray; height:2px; background-color:gray; border-style:solid;">
					<? $arThu = preg_split('[/]',$arItem["PROPERTIES"]["p_Thu"]["VALUE"]);?>
					<p><?=$arThu[0];?></p>
					<p><?=$arThu[1];?></p>
				</div>
				<div class="p_5 <? if($p_day == 'p_5'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>пт</p>
					<hr style="color:gray; height:2px; background-color:gray; border-style:solid;">
					<? $arFri = preg_split('[/]',$arItem["PROPERTIES"]["p_Fri"]["VALUE"]);?>
					<p><?=$arFri[0];?></p>
					<p><?=$arFri[1];?></p>
				</div>

				<div class="p_6 <? if($p_day == 'p_6'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>сб</p>
					<hr style="color:gray; height:2px; <? if(strpos($arItem["PROPERTIES"]["p_Sat"]["VALUE"], '-') !== false){ echo 'background-color:#8e211e;'; }else { echo 'background-color:gray;'; } ?>  border-style:solid;">
					<? $arSat = preg_split('[/]',$arItem["PROPERTIES"]["p_Sat"]["VALUE"]);?>
					<p><?if(empty($arSat[0])){ echo '-'; }else{ echo $arSat[0]; }?></p>
					<p><?if(empty($arSat[1])){ echo '-'; }else{ echo $arSat[1]; }?></p>
				</div>

				<div class="p_0 <? if($p_day == 'p_0'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>вс</p>
					<hr style="color:gray; height:2px; <? if(strpos($arItem["PROPERTIES"]["p_Sun"]["VALUE"], '-') !== false){ echo 'background-color:#8e211e;'; }else { echo 'background-color:gray;'; } ?>  border-style:solid;">
					<? $arSun = preg_split('[/]',$arItem["PROPERTIES"]["p_Sun"]["VALUE"]);?>
					<p><?if(empty($arSun[0])){ echo '-'; }else{ echo $arSun[0]; }?></p>
					<p><?if(empty($arSun[1])){ echo '-'; }else{ echo $arSun[1]; }?></p>


				</div>

			<div style="clear:left;"></div>
			</div>



			<div style="width:100%; <?if($arItem["PROPERTIES"]["OFFICE"]["VALUE"] == 0){ echo 'display:none;'; }?>">
					<p style="margin-top:10px; margin-bottom:10px;"><?=$arItem["PROPERTIES"]["NAME_SCHEDULE_2"]["VALUE"];?></p>
					<div class="v_1 <? if($v_day == 'v_1'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>пн</p>
					<? $varMon = preg_split('[/]',$arItem["PROPERTIES"]["v_Mon"]["VALUE"]);?>
					<p><?=$varMon[0];?></p>
					<p><?=$varMon[1];?></p>
					</div>
					<div class="v_2 <? if($v_day == 'v_2'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>вт</p>
					<? $varTue = preg_split('[/]',$arItem["PROPERTIES"]["v_Tue"]["VALUE"]);?>
					<p><?=$varTue[0];?></p>
					<p><?=$varTue[1];?></p>
					</div>
					<div class="v_3 <? if($v_day == 'v_3'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>ср</p>
					<? $varWed = preg_split('[/]',$arItem["PROPERTIES"]["v_Wed"]["VALUE"]);?>
					<p><?=$varWed[0];?></p>
					<p><?=$varWed[1];?></p>
					</div>
					<div class="v_4 <? if($v_day == 'v_4'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>чт</p>
					<? $varThu = preg_split('[/]',$arItem["PROPERTIES"]["v_Thu"]["VALUE"]);?>
					<p><?=$varThu[0];?></p>
					<p><?=$varThu[1];?></p>
					</div>

					<div class="v_5 <? if($v_day == 'v_5'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>пт</p>
						<? $varFri = preg_split('[/]',$arItem["PROPERTIES"]["v_Fri"]["VALUE"]);?>
						<p><?=$varFri[0];?></p>
						<p><?=$varFri[1];?></p>
					</div>

					<div class="v_6 <? if($v_day == 'v_6'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>сб</p>
						<? $varSat = preg_split('[/]',$arItem["PROPERTIES"]["v_Sat"]["VALUE"]);?>
						<p><?if(empty($varSat[0])){ echo '-'; }else{ echo $varSat[0]; }?></p>
						<p><?if(empty($varSat[1])){ echo '-'; }else{ echo $varSat[1]; }?></p>
					</div>

					<div class="v_0 <? if($v_day == 'v_0'){ echo 'day_week'; } ?>" style="float:left; width:10%; padding:4px; text-align:center;">
					<p>вс</p>
						<? $varSun = preg_split('[/]',$arItem["PROPERTIES"]["v_Sun"]["VALUE"]);?>
						<p><?if(empty($varSun[0])){ echo '-'; }else{ echo $varSun[0]; }?></p>
						<p><?if(empty($varSun[1])){ echo '-'; }else{ echo $varSun[1]; }?></p>
					</div>
				<div style="clear:left;"></div>
				</div>




		</div>
			<div style="float:left;  width:50%;">
				<div style="border-bottom:solid; border-width:thin; border-color:gray; padding-bottom: 5px;">
					<div style="float:left; width:30%; text-align:center;">
						<img src="../bitrix/templates/main/images/rates.png" width="50" height="50" alt="Тарифы" />
					</div>
					<div style="float:left; width:70%; line-height:50px;">
						<a href="../rates/">Тарифы</a>
					</div>
					<div style="clear:left;"></div>
				</div>

				<div class="btn-driving-directions">
					<div style="float:left; width:30%; text-align:center;">
						<img src="../bitrix/templates/main/images/sp_icon.png" width="75" height="45" alt="Схема проезда" />
					</div>
					<a href="../maps/driving-directions.php?id=<?=$arItem["ID"];?>" style="text-decoration:underline; cursor:pointer; line-height: 45px;">Схема проезда</a>
				</div>

				<div style="clear:left;"></div>
				<!--
				<div style="border-bottom:solid; border-width:thin; border-color:gray; padding-bottom:5px; padding-top:10px;">
					<div style="float:left; width:30%; text-align:center;">
						<img src="../bitrix/templates/main/images/free_storege.png" width="50" height="50" alt="Бесплатное хранение груза на терминале в течении 2 дней" />
					</div>
					<div style="float:left; width:70%; padding-top:5px;">
						<p style="color:#8e211e;">Бесплатное хранение груза на терминале в течении 2 дней</p>
					</div>
					<div style="clear:left;"></div>
				</div>-->
			</div>
		<div style="clear:left;"></div>
	</div>

	<div style="width:560px; padding:6px; padding-right:0;">
		<div style="float:left; width:50%;">
			<div>



				<div>
					<br/>
					<p style="font-weight:bolder;">Контакты</p>
					<p style="color:#8e211e;">Отдел организации перевозок</p>
					<?$one = 0;?>
					<?foreach($arItem["PROPERTIES"]["PHONE_OOP"]["VALUE"] as $valo):?>
					<p><? echo $valo; if($one == 0){ echo '&nbsp;&nbsp;&nbsp;'.$arItem["PROPERTIES"]["Email"]["VALUE"]; $one = 1; }   ?> </p>
					<?endforeach;?>
					<p style="color:#8e211e;">Диспетчерская</p>
					<?foreach($arItem["PROPERTIES"]["PHONE_D"]["VALUE"] as $vald):?>
					<p><?=$vald;?></p>
					<?endforeach;?>
				</div>
			</div>
		</div>
			<div style="float:left;  width:50%;">
				<div style="border-bottom:solid; border-width:thin; border-color:gray; padding-bottom: 5px;">

					<p style="font-weight:bolder;">Акции в <?=$arItem["NAME"]?></p>
					<?
								$arSelect = Array("IBLOCK_ID","ID", "NAME", "ACTIVE_FROM");
								$arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "ID"=>$arItem["PROPERTIES"]["ACTION"]["VALUE"]);

								$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

								 while($ob = $res->GetNextElement())
								 {
								 	$arOb = $ob->GetFields();
									$arProps = $ob->GetProperties();
				
					?>
					<a href="<?=$arProps["URL_ACTION"]["VALUE"]?>" style="text-decoration:underline; cursor:pointer; color:black;"><p><?=$arOb["ACTIVE_FROM"].' '.$arOb["NAME"];?></p></a>  
					<? } ?>

				</div>
				<div style="border-bottom:solid; border-width:thin; border-color:gray; padding-bottom: 5px;padding-top: 5px;">

					<p style="font-weight:bolder;">Новости в <?=$arItem["NAME"]?></p>
					<?
								$arSelect = Array("ID", "NAME", "ACTIVE_FROM");
								$arFilter = Array("IBLOCK_ID"=>5, "ACTIVE"=>"Y", "ID"=>$arItem["PROPERTIES"]["NEWS"]["VALUE"]);
								
								$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
								 while($ob = $res->GetNextElement())
								 {
								 $arOb = $ob->GetFields();


					?>
					<a href="<?='../news/index.php?ELEMENT_ID='.$arOb["ID"]?>" style="text-decoration:underline; cursor:pointer; color:black;"><p><?=$arOb["ACTIVE_FROM"].' '.$arOb["NAME"];?></p></a>  
					<? } ?>

				</div>

			</div>
		<div style="clear:left;"></div>
	</div>
</div>

<?endif;?>
<?} ?>