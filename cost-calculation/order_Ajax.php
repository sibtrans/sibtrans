<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>



<? // подключение API Bitrix
 require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php" 
?>




<? 
$ID_from =  $_POST['from'];

$ID_to =  $_POST['to'];
?>




<? 
		
		   global $DB;

		
			$MarkUp = $DB->Query(" select t.ID, t.ShortName 
			 from my_TypeMarkUp as t 
			 left join
			 my_TypeMarkUpForOffice as ty
			 on t.ID = ty.ID_MarkUp
			 where ty.ID_OfficeOut = " .$ID_from. "");
		

		while($mp = $MarkUp->Fetch()){
		$ArrMarkUp[$mp['ID']] = $mp['ShortName'];
		}

?>






<?


		$ServiceOut = $DB->Query("select s.ID, 
										s.Name, 
										 so.ID_BOX,
								(select b.Name from my_BOX as b where b.ID = so.ID_BOX) as wvc1, 
								(select bb.Name from my_BOX as bb where bb.ID = s.ID_BOX) as wvc2
								from my_ServiceInOffice as so
								join my_Service as s
								on so.ID_Service = s.ID
								where ID_Office = " .$ID_from. "");


		while($so = $ServiceOut->Fetch()){
		$ServiceDelivOut[] = $so;
		}



?>




<?

		$ServiceIn = $DB->Query("select s.ID, 
										s.Name, 
										 so.ID_BOX,
								(select b.Name from my_BOX as b where b.ID = so.ID_BOX) as wvc1, 
								(select bb.Name from my_BOX as bb where bb.ID = s.ID_BOX) as wvc2
								from my_ServiceInOffice as so
								join my_Service as s
								on so.ID_Service = s.ID
								where ID_Office = " .$ID_to. "");


		while($si = $ServiceIn->Fetch()){
		$ServiceDelivIn[] = $si;
		}


?>



<table id="TableMarkUp" style="width:350px; margin-top:0px;">
				  <tbody>
					 <tr>
						<td class="preiskurant1">
							<p class="msect_title"><b>Особые условия транспортировки</b></p>
						</td>
					  </tr>
					 <tr>
						 <td class="preiskurant1">
				
							<?foreach($ArrMarkUp as $key=>$value): ?>
								<? $kyyy = "MarkUp".$key; ?>
							<div style="display:inline-block;" <?if($key == 1){ echo 'class="hintModal"';}?>>
							 <input  type="checkbox"   id="<?="MarkUp".$key; ?>" data-content="<?=$value;?>" <?if($key == 2){ echo "data-show";}?> <?if($_GET[$kyyy] == "true"){ echo "checked";}?>> 
								<?if($key == 1){ echo '<div class="hintModal_container">Обращаем Ваше внимание! В тарифе Грузовой, режим Тепловой не применяется!</div>'; }?>
							 </div>
							 <label for="<?="MarkUp".$key;?>"><?=$value;?></label> 
								<?if($key == 2){ echo '<label class="hintModal" style="cursor:pointer;">'.'<img src="../bitrix/templates/main/images/question.png" alt="?" />'.'<div class="hintModal_container">'.'Доставка негабаритного груза, превышающего параметры: длина 250 см, высота 170 см, ширина 130 см, вес одного неделимого места 250 кг'.'</div></label>'; } ?>
								<?if($key == 1){ echo '<label class="hintModal" style="cursor:pointer; color:red; ">'.'<img src="../bitrix/templates/main/images/question.png" alt="?" />'.'<div class="hintModal_container">'.'Обращаем Ваше внимание! В тарифе Грузовой, режим Тепловой не применяется!'.'</div></label>'; } ?>
							 <?if($key == 2):?>
							<div class="data-show-content">

							 &nbsp;&nbsp;<label style="margin-right:40px; margin-top: 4px;">Длина</label><label style="margin-right:36px; margin-top: 4px;">Высота</label><label style="margin-top:4px;">Ширина</label><br/>
								<input type="text"  maxlength="10" id="lengh<?="MarkUp".$key; ?>"  name="lengh" value="" class="numbers_comma" style="width:70px; margin:5px;" placeholder="                м">
								<input type="text"  maxlength="10" id="height<?="MarkUp".$key; ?>"  name="height" value="" class="numbers_comma" style="width:70px; margin:5px;" placeholder="                м">
								<input type="text"  maxlength="10" id="width<?="MarkUp".$key; ?>"  name="width" value="" class="numbers_comma" style="width:70px; margin:5px;" placeholder="                м">
							 </div>
							<?endif;?>
   							<br/>
							<?endforeach;?>
						 </td>
					  </tr>
				   <tbody>
				</table>
					<p class="sect_title">Дополнительный сервис</p>
					<br/>
					<div id="div_input_ServiseDeliv_Out_In" class="row">
						<div class="d2l" id="div_input_ServiseDeliv_Out__d2l">

							<input type="checkbox" data-show=".next" id="chBoxAddServiseDelivOut_Id"   <?if($_GET['chBoxAddServiseDelivOut_Id'] == "true"){ echo 'checked'; } ?>/><label for="chBoxAddServiseDelivOut_Id">в пункте отправления</label>

							<div class="data-show-content mla" style="margin-top:10px;">

								<? $idServ = -100000; ?>

									<? $col = 0; ?>
								<?foreach($ServiceDelivOut as $serv):?>


									<?if($serv["ID"] != $idServ):?>

								<input type="checkbox" data-show=".next" data-id="<?=$serv["ID"]?>" data-content="<?=$serv["Name"]?>" name="chBoxServiceDelivOut" <?if($_GET[$serv["ID"]] == "true"){ echo 'checked'; }?>/><label><?=$serv["Name"]?></label><br/>

								<? $key_get_input = "data_idcheckbox".$serv["ID"]; // ключ для get массива ?> 

											<?if($serv["ID_BOX"] > 2):?>

											<div class="data-show-content mla" style="display: none;">
												<input type="text"  maxlength="10" data-IDcheckbox="<?=$serv["ID"]?>" name="InputForChBoxServiceDelivOut<? echo $col++; ?>" value="<? echo $_GET[$key_get_input]; ?>" class="numbers" style="width:70px; margin:5px; text-align:center;" data-wvc="<?=$serv["ID_BOX"]?>" placeholder="            <?=$serv["wvc1"]?>"><br/>
											</div>

											<?elseif(trim($serv["wvc2"]) != ""):?>

											<div class="data-show-content mla" style="display: none;">
											<input type="text"  maxlength="10" data-IDcheckbox="<?=$serv["ID"]?>" name="InputForChBoxServiceDelivOut<? echo $col++; ?>" value="<? echo $_GET[$key_get_input]; ?>" class="numbers" style="width:70px; margin:5px;text-align:center;" data-wvc="wvc2" placeholder="            <?=$serv["wvc2"]?>"><br/>
											</div>
											<?else:?>
											<div class="data-show-content mla" style="display: none;">
											</div>

											<?endif;?>

									<? $idServ = $serv["ID"]; ?>

									<?else:?>

											<?if($serv["ID_BOX"] > 2 ):?>

											<div class="data-show-content mla" style="display: none;">
											<input type="text"  maxlength="10" data-IDcheckbox="<?=$serv["ID"]?>" name="InputForChBoxServiceDelivOut<? echo $col++; ?>" value="<? echo $_GET[$key_get_input]; ?>" class="numbers" style="width:70px; margin:5px; text-align:center;" data-wvc="<?=$serv["ID_BOX"]?>" placeholder="            <?=$serv["wvc1"]?>"><br/>
											</div>

											<?else:?>
											<div class="data-show-content mla" style="display: none;">
											</div>
											<?endif;?>
									<?endif;?>
									<br/>

								<?endforeach;?>
							</div>
						</div>
						<div class="d2r" id="div_input_ServiseDeliv_In__d2r">

							<input type="checkbox" data-show=".next" id="chBoxAddServiseDelivIn_Id" <? if($_GET["chBoxServiceDelivInchBoxAddServiseDelivIn_Id"] == "true"){ echo "checked"; } ?>><label for="chBoxAddServiseDelivIn_Id">в пункте назначения</label>

							<div class="data-show-content mla" style="margin-top:10px;">

								<? $idServ = -100000; ?>

									<? $count = 0; ?>
								<?foreach($ServiceDelivIn as $serv):?>


									<?if($serv["ID"] != $idServ):?>

								<input type="checkbox" data-show=".next" data-id="<?=$serv["ID"]?>" data-content="<?=$serv["Name"]?>" name="chBoxServiceDelivIn" <?if($_GET["chBoxServiceDelivIn".$serv["ID"]] == "true"){ echo "checked"; }?> /><label><?=$serv["Name"]?></label><br/>

											<?if($serv["ID_BOX"] > 2):?>

											<div class="data-show-content mla" style="display: none;">
											<input type="text"  maxlength="10" data-IDcheckbox="<?=$serv["ID"]?>" name="InputForChBoxServiceDelivIn<? echo $count++; ?>" value="<? echo $_GET["data_idcheckbox_In".$serv["ID"]]; ?>" class="numbers" style="width:70px; margin:5px; text-align:center;" data-wvc="<?=$serv["ID_BOX"]?>" placeholder="            <?=$serv["wvc1"]?>"><br/>
											</div>

											<?elseif(trim($serv["wvc2"]) != ""):?>

											<div class="data-show-content mla" style="display: none;">
											<input type="text"  maxlength="10" data-IDcheckbox="<?=$serv["ID"]?>" name="InputForChBoxServiceDelivIn<? echo $count++; ?>" value="<? echo $_GET["data_idcheckbox_In".$serv["ID"]]; ?>" class="numbers" style="width:70px; margin:5px; text-align:center;" data-wvc="wvc2" placeholder="            <?=$serv["wvc2"]?>"><br/>
											</div>
											<?else:?>
											<div class="data-show-content mla" style="display: none;">
											</div>

											<?endif;?>

									<? $idServ = $serv["ID"]; ?>

									<?else:?>

											<?if($serv["ID_BOX"] > 2):?>

											<div class="data-show-content mla" style="display: none;">
											<input type="text"  maxlength="10" data-IDcheckbox="<?=$serv["ID"]?>" name="InputForChBoxServiceDelivIn<? echo $count++; ?>" value="<? echo $_GET["data_idcheckbox_In".$serv["ID"]]; ?>" class="numbers" style="width:70px; margin:5px; text-align:center;" data-wvc="<?=$serv["ID_BOX"]?>" placeholder="            <?=$serv["wvc1"]?>"><br/>
											</div>

											<?else:?>
											<div class="data-show-content mla" style="display: none;">
											</div>
										<?endif;?>
									<?endif;?>
									<br/>

								<?endforeach;?>
							</div>
						</div>
					</div>






