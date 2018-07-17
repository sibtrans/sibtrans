<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<? BXClearCache(true, "/bitrix/templates/main/components/bitrix/news.list/filials_details/template.php"); ?>




		<?
					// получение времени кокретного города за счёт разницы в часахъ от Моквы !!!
						date_default_timezone_set('Europe/Moscow'); 
				
						$date = date("Y-m-d H:i:s");

						$newdate = strtotime ( '+'.$arItem["PROPERTIES"]["DIF_HOUR_MOSCOW"]["VALUE"].' hour' , strtotime ( $date ) ) ;
						$newdate = date ( 'Y-m-d H:i:s' , $newdate );
						
						$day_number = strftime("%w", strtotime($newdate));
						
						$day_number;
				
					$p_day = 'p_'.$day_number;
					$v_day = 'v_'.$day_number;



				function check_param($value,$novalue='') {
				return (eval('return (isset('.$value.') ? '.$value.' : \''.$novalue.'\');'));
				}



		 ?>




<?
$index = 1; // Порядковый номер объекта на карте
$counter = 0;


function startsWith2($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
}


foreach($arResult["ITEMS"] as $arItem){
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

	

?>

<?if(check_param('$_GET[\'Id\']','null') == 'null'):?>



		<?if(strpos($_SERVER['REQUEST_URI'], $arItem["CODE"])!== false && startsWith2(trim($_SERVER['REQUEST_URI'],'/'), $arItem["CODE"]) == 1 ):?>
		<?$counter++;?>

				
				<div class="relative">
				
				
					<div class="ballon_data" id="b<?=$arItem["ID"];?>" style="margin: 0 auto; width:1100px; margin-top: 40px; margin-bottom: 40px;">
							<div style="display:none;" id="dif_hour_Moscow"><?=$arItem["PROPERTIES"]["DIF_HOUR_MOSCOW"]["VALUE"];?></div>
				
						<div style="padding-bottom:60px;">
								<div style="float:left; width:80%;">
									<div style="float:left; border-bottom:solid; border-width:thin; border-bottom-style:dashed; border-color:gray;">
										<p style="color:#92211d; font-size:x-large; font-weight:500;"><?=$arItem["NAME"];?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
									</div>
									<div style="float:left; height: 50px;">
										<?if($arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"] == 1):?>
											<img src="../bitrix/templates/main/images/gray_resivs_send_cargo.png" alt="Приём-выдача груза" />
										<?endif;?>
										<?if($arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"] == 1):?>
											<img src="../bitrix/templates/main/images/gray_storege_cargo30.png" alt="Ответственное хранение груза" />
										<?endif;?>
										<?if($arItem["PROPERTIES"]["OFFICE"]["VALUE"] == 1):?>
											<img src="../bitrix/templates/main/images/gray_office30.png" alt="Офис" />
										<?endif;?>
									</div>
								</div>
					
								<div style="float:left;  min-height: 50px;">
									<?if($counter==1){ echo '<p class="location_time" style="font-size:x-large; font-weight:400; color:gray;">12:16</p>'; }?>

								</div>
				
								<div style="clear:left;"></div>
							</div>
				
				
							<div style="padding-bottom:30px;">
								<div style="float:left; width:28%; border-bottom: solid; border-bottom-style: dotted; border-color: gray; margin-right:30px;  min-height: 60px;">
									<div style="float:left; width:20%; ">
										<img src="../bitrix/templates/main/images/gray_address40.png" alt="Адрес" />
									</div>
									<div style="float:left; width:80%;">
										<p style="color:#92211d; font-weight:bolder;">Адрес:</p>
										<p><?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?></p>
									</div>
								</div>
				
								<div style="float:left; width:28%; border-bottom: solid; border-bottom-style: dotted; border-color: gray; margin-right:30px;  min-height: 60px;">
									<div style="float:left; width:20%;">
										<img src="../bitrix/templates/main/images/gray_resiv_send_cargo40.png" alt="Офис" />
									</div>
									<div style="float:left; width:80%;">
										<p style="color:#92211d; font-weight:bolder;">График работы на приём и выдачу груза:</p>
										<? $arDayp = preg_split('[\/]', $arItem["PROPERTIES"]["p_Mon"]["VALUE"]); ?>
										<p>пн-пт с <?=$arDayp[0];?> по <?=$arDayp[1];?></p>
									</div>
								</div>
				
								<div style="float:left; width:37%; border-bottom: solid; border-bottom-style: dotted; border-color: gray;  min-height: 60px;">
									<p style="padding:6px;">Перед отправкой груза на этот терминал рекомендуем предварительно <a href="../cost-calculation/order.php">оформить заявку</a></p>
								</div>
				
								<div style="clear:left;"></div>
							</div>
				
				
				
							<div style="padding-bottom:30px;">
								<div style="float:left; width:28%; border-bottom: solid; border-bottom-style: dotted; border-color: gray; margin-right:30px;  min-height: 60px;">
									<div style="float:left; width:20%;">
										<img src="../bitrix/templates/main/images/gray_phone40.png" alt="Телефон" />
									</div>
									<div style="float:left; width:80%;">
										<p style="color:#92211d; font-weight:bolder;">Телефон:</p>
										<p style="font-weight:bolder;">Отдел организации перевозок</p>
											<?foreach($arItem["PROPERTIES"]["PHONE_OOP"]["VALUE"] as $valo):?>
											<p><?=$valo; ?></p>
											<?endforeach;?>
				
				
										<p style="font-weight:bolder; <?if($arItem["PROPERTIES"]["PHONE_D"]["VALUE"][0] == ""){ echo 'display:none;';} ?>">Диспетчерская</p>
											<?foreach($arItem["PROPERTIES"]["PHONE_D"]["VALUE"] as $vald):?>
											<p><?=$vald;?></p>
											<?endforeach;?>
				
										
									</div>
								</div>
				
								<div style="float:left; width:28%; border-bottom: solid; border-bottom-style: dotted; border-color: gray; margin-right:30px;  min-height: 60px;">
									<div style="float:left; width:20%;">
										<img src="../bitrix/templates/main/images/gray_grafic_work_office40.png" alt="График работы с клиентами" />
									</div>
									<div style="float:left; width:80%;">
										<p style="color:#92211d; font-weight:bolder;">График работы с клиентами:</p>
										<? $arDayv = preg_split('[\/]', $arItem["PROPERTIES"]["v_Mon"]["VALUE"]); ?>
										<p>пн-пт с <?=$arDayv[0];?> по <?=$arDayv[1];?></p>
									</div>
								</div>
				
								<div style="float:left; width:37%; border-bottom: solid; border-bottom-style: dotted; border-color: gray;  min-height: 60px;">
										<p style="color:#92211d; font-weight:bolder;">Акции в <?=$arItem["NAME"];?>:</p>
											<?
														$arSelect = Array("ID", "NAME", "ACTIVE_FROM");
														$arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "ID"=>$arItem["PROPERTIES"]["ACTION"]["VALUE"]);
														
														$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
														 while($ob = $res->GetNextElement())
														 {
														 $arOb = $ob->GetFields();
						
													
											?>
											<p><?=$arOb["ACTIVE_FROM"].' '.$arOb["NAME"];?></p>  
											<? } ?>
								</div>
				
								<div style="clear:left;"></div>
							</div>
				
				
				
							<div style="padding-bottom:30px;">
								<div style="float:left; width:28%; border-bottom: solid; border-bottom-style: dotted; border-color: gray; margin-right:30px;  min-height: 60px;">
									<div style="float:left; width:20%; ">
										<img src="../bitrix/templates/main/images/gray_email40.png" alt="e-mail" />
									</div>
									<div style="float:left; width:80%;">
										<p style="color:#92211d; font-weight:bolder;">e-mail:</p>
										<p><?=$arItem["PROPERTIES"]["Email"]["VALUE"];?></p>
									</div>
								</div>
				
				
								<div style="clear:left;"></div>
							</div>
				
				
				
				
				
					</div>
				
				</div>
		
		<?endif;?>


<?elseif($_GET['Id'] == $arItem["ID"]):?> 







<?
	// получение времени кокретного города за счёт разницы в часахъ от Моквы !!!
		date_default_timezone_set('Europe/Moscow'); 

		$date = date("Y-m-d H:i:s");
		
		$newdate = strtotime ( '+'.$arItem["PROPERTIES"]["DIF_HOUR_MOSCOW"]["VALUE"].' hour' , strtotime ( $date ) ) ;
		$newdate = date ( 'Y-m-d H:i:s' , $newdate );
		
		$day_number = strftime("%w", strtotime($newdate));
		
		$day_number;

	$p_day = 'p_'.$day_number;
	$v_day = 'v_'.$day_number;
 ?>


<div class="relative">


	<div class="ballon_data" id="b<?=$arItem["ID"];?>" style="margin: 0 auto; width:1100px; margin-top: 40px; margin-bottom: 40px;">
			<div style="display:none;" id="dif_hour_Moscow"><?=$arItem["PROPERTIES"]["DIF_HOUR_MOSCOW"]["VALUE"];?></div>

			<div style="padding-bottom:60px;">
				<div style="float:left; width:80%;">
					<div style="float:left; border-bottom:solid; border-width:thin; border-bottom-style:dashed; border-color:gray;">
						<p style="color:#92211d; font-size:x-large; font-weight:500;"><?=$arItem["NAME"];?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
					</div>
					<div style="float:left; height: 50px;">
						<?if($arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"] == 1):?>
							<img src="../bitrix/templates/main/images/gray_resivs_send_cargo.png" alt="Приём-выдача груза" />
						<?endif;?>
						<?if($arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"] == 1):?>
							<img src="../bitrix/templates/main/images/gray_storege_cargo30.png" alt="Ответственное хранение груза" />
						<?endif;?>
						<?if($arItem["PROPERTIES"]["OFFICE"]["VALUE"] == 1):?>
							<img src="../bitrix/templates/main/images/gray_office30.png" alt="Офис" />
						<?endif;?>
					</div>
				</div>
	
				<div style="float:left;  min-height: 50px;">
					<p class="location_time" style="font-size:x-large; font-weight:400; color:gray;">12:16</p>
				</div>

				<div style="clear:left;"></div>
			</div>


			<div style="padding-bottom:30px;">
				<div style="float:left; width:28%; border-bottom: solid; border-bottom-style: dotted; border-color: gray; margin-right:30px;  min-height: 60px;">
					<div style="float:left; width:20%; ">
						<img src="../bitrix/templates/main/images/gray_address40.png" alt="Адрес" />
					</div>
					<div style="float:left; width:80%;">
						<p style="color:#92211d; font-weight:bolder;">Адрес:</p>
						<p><?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?></p>
					</div>
				</div>

				<div style="float:left; width:28%; border-bottom: solid; border-bottom-style: dotted; border-color: gray; margin-right:30px;  min-height: 60px;">
					<div style="float:left; width:20%;">
						<img src="../bitrix/templates/main/images/gray_resiv_send_cargo40.png" alt="Офис" />
					</div>
					<div style="float:left; width:80%;">
						<p style="color:#92211d; font-weight:bolder;">График работы на приём и выдачу груза:</p>
						<? $arDayp = preg_split('[\/]', $arItem["PROPERTIES"]["p_Mon"]["VALUE"]); ?>
						<p>пн-пт с <?=$arDayp[0];?> по <?=$arDayp[1];?></p>
					</div>
				</div>

				<div style="float:left; width:37%; border-bottom: solid; border-bottom-style: dotted; border-color: gray;  min-height: 60px;">
					<p style="padding:6px;">Перед отправкой груза на этот терминал рекомендуем предварительно <a href="../cost-calculation/order.php">оформить заявку</a></p>
				</div>

				<div style="clear:left;"></div>
			</div>



			<div style="padding-bottom:30px;">
				<div style="float:left; width:28%; border-bottom: solid; border-bottom-style: dotted; border-color: gray; margin-right:30px;  min-height: 60px;">
					<div style="float:left; width:20%;">
						<img src="../bitrix/templates/main/images/gray_phone40.png" alt="Телефон" />
					</div>
					<div style="float:left; width:80%;">
						<p style="color:#92211d; font-weight:bolder;">Телефон:</p>
						<p style="font-weight:bolder;">Отдел организации перевозок</p>
							<?foreach($arItem["PROPERTIES"]["PHONE_OOP"]["VALUE"] as $valo):?>
							<p><?=$valo; ?></p>
							<?endforeach;?>


						<p style="font-weight:bolder; <?if($arItem["PROPERTIES"]["PHONE_D"]["VALUE"][0] == ""){ echo 'display:none;';} ?>">Диспетчерская</p>
							<?foreach($arItem["PROPERTIES"]["PHONE_D"]["VALUE"] as $vald):?>
							<p><?=$vald;?></p>
							<?endforeach;?>

						
					</div>
				</div>

				<div style="float:left; width:28%; border-bottom: solid; border-bottom-style: dotted; border-color: gray; margin-right:30px;  min-height: 60px;">
					<div style="float:left; width:20%;">
						<img src="../bitrix/templates/main/images/gray_grafic_work_office40.png" alt="График работы с клиентами" />
					</div>
					<div style="float:left; width:80%;">
						<p style="color:#92211d; font-weight:bolder;">График работы с клиентами:</p>
						<? $arDayv = preg_split('[\/]', $arItem["PROPERTIES"]["v_Mon"]["VALUE"]); ?>
						<p>пн-пт с <?=$arDayv[0];?> по <?=$arDayv[1];?></p>
					</div>
				</div>

				<div style="float:left; width:37%; border-bottom: solid; border-bottom-style: dotted; border-color: gray;  min-height: 60px;">
						<p style="color:#92211d; font-weight:bolder;">Акции в <?=$arItem["NAME"];?>:</p>
							<?
										$arSelect = Array("ID", "NAME", "ACTIVE_FROM");
										$arFilter = Array("IBLOCK_ID"=>9, "ACTIVE"=>"Y", "ID"=>$arItem["PROPERTIES"]["ACTION"]["VALUE"]);
										
										$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
										 while($ob = $res->GetNextElement())
										 {
										 $arOb = $ob->GetFields();
		
									
							?>
							<p><?=$arOb["ACTIVE_FROM"].' '.$arOb["NAME"];?></p>  
							<? } ?>
				</div>

				<div style="clear:left;"></div>
			</div>



			<div style="padding-bottom:30px;">
				<div style="float:left; width:28%; border-bottom: solid; border-bottom-style: dotted; border-color: gray; margin-right:30px;  min-height: 60px;">
					<div style="float:left; width:20%; ">
						<img src="../bitrix/templates/main/images/gray_email40.png" alt="e-mail" />
					</div>
					<div style="float:left; width:80%;">
						<p style="color:#92211d; font-weight:bolder;">e-mail:</p>
						<p><?=$arItem["PROPERTIES"]["Email"]["VALUE"];?></p>
					</div>
				</div>


				<div style="clear:left;"></div>
			</div>





	</div>

</div>

<?endif;?>

<?} ?>

