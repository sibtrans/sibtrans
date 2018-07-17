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



<table style="width:350px; margin-top:0px;">
				  <tbody>
					 <tr>
						<td class="preiskurant1">
							<p class="msect_title"><b>Особые условия транспортировки</b></p>
						</td>
					  </tr>
					 <tr>
					 <tr>
						 <td class="preiskurant1">
							<?foreach($ArrMarkUp as $key=>$value): ?>

							<input  type="checkbox" id="<?="MarkUp".$key;?>">

		 					 <label for="<?="MarkUp".$key;?>" <?if($key == 1){ echo 'class="hintModal"'; } ?>><?=$value;?><?if($key == 1){ echo '<div class="hintModal_container">Обращаем Ваше внимание! В тарифе Грузовой, режим Тепловой не применяется!</div>'; }?></label> 
									<?if($key == 1){ echo '<label class="hintModal" style="cursor:pointer; color:red; ">'.'<img src="../bitrix/templates/main/images/question.png" alt="?" />'.'<div class="hintModal_container">'.'Обращаем Ваше внимание! В тарифе Грузовой, режим Тепловой не применяется!'.'</div></label>'; } ?>
 									<?if($key == 2){ echo '<label class="hintModal" style="cursor:pointer;">'.'<img src="../bitrix/templates/main/images/question.png" alt="?" />'.'<div class="hintModal_container">'.'Доставка негабаритного груза, превышающего параметры: длина 250 см, высота 170 см, ширина 130 см, вес одного неделимого места 250 кг'.'</div></label>'; } ?>
								  <br/>
							<?endforeach;?>
						 </td>
					  </tr>
				   <tbody>
				</table>
					<p class="sect_title">Дополнительный сервис</p>
					<br/>
					<div  class="row">
						<div class="d2l" id="div_input_ServiseDeliv_Out__kalc_d2l">

							<input type="checkbox" data-show=".next" id="chBoxAddServiseDelivOut_Id"/><label for="chBoxAddServiseDelivOut_Id">в пункте отправления</label>

							<div class="data-show-content mla" style="margin-top:10px;">

								<? $idServ = -100000; ?>

								<?foreach($ServiceDelivOut as $serv):?>


									<?if($serv["ID"] != $idServ):?>
	
											<input type="checkbox" data-show=".next" data-id="<?=$serv["ID"]?>" name="chBoxServiceDelivOut" /><label><?=$serv["Name"]?></label><br/>

											<?if($serv["ID_BOX"] > 2):?>

											<div class="data-show-content mla" style="display: none;">
											<input type="text" data-IDcheckbox="<?=$serv["ID"]?>" maxlength="10" name="InputForChBoxServiceDelivOut" value="" class="numbers" style="width:70px; margin:5px;" data-wvc="<?=$serv["ID_BOX"]?>"><label><?=$serv["wvc1"]?></label><br/>
											</div>

											<?elseif(trim($serv["wvc2"]) != ""):?>

											<div class="data-show-content mla" style="display: none;">
											<input type="text" data-IDcheckbox="<?=$serv["ID"]?>"  maxlength="10" name="InputForChBoxServiceDelivOut" value="" class="numbers" style="width:70px; margin:5px;" data-wvc="wvc2"><label><?=$serv["wvc2"]?></label><br/>
											</div>
											<?else:?>
											<div class="data-show-content mla" style="display: none;">
											</div>

											<?endif;?>

									<? $idServ = $serv["ID"]; ?>

									<?else:?>

											<?if($serv["ID_BOX"] > 2 ):?>

											<div class="data-show-content mla" style="display: none;">
											<input type="text" data-IDcheckbox="<?=$serv["ID"]?>"  maxlength="10" name="InputForChBoxServiceDelivOut" value="" class="numbers" style="width:70px; margin:5px;" data-wvc="<?=$serv["ID_BOX"]?>"><label><?=$serv["wvc1"]?></label><br/>
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
						<div class="d2r" id="div_input_ServiseDeliv_Out__kalc_d2r">

							<input type="checkbox" data-show=".next" data-id="chBoxAddServiseDelivIn_Id"/><label for="chBoxAddServiseDelivIn_Id">в пункте назначения</label>

							<div class="data-show-content mla" style="margin-top:10px;">

								<? $idServ = -100000; ?>
								<?foreach($ServiceDelivIn as $serv):?>


									<?if($serv["ID"] != $idServ):?>

											<input type="checkbox" data-show=".next" data-id="<?=$serv["ID"]?>" name="chBoxServiceDelivIn" /><label><?=$serv["Name"]?></label><br/>

											<?if($serv["ID_BOX"] > 2):?>

											<div class="data-show-content mla" style="display: none;">
											<input type="text"  maxlength="10" data-IDcheckbox="<?=$serv["ID"]?>" name="InputForChBoxServiceDelivIn" value="" class="numbers" style="width:70px; margin:5px;" data-wvc="<?=$serv["ID_BOX"]?>"><label><?=$serv["wvc1"]?></label><br/>
											</div>

											<?elseif(trim($serv["wvc2"]) != ""):?>

											<div class="data-show-content mla" style="display: none;">
											<input type="text"  maxlength="10" data-IDcheckbox="<?=$serv["ID"]?>" name="InputForChBoxServiceDelivIn" value="" class="numbers" style="width:70px; margin:5px;" data-wvc="wvc2"><label><?=$serv["wvc2"]?></label><br/>
											</div>
											<?else:?>
											<div class="data-show-content mla" style="display: none;">
											</div>

											<?endif;?>

									<? $idServ = $serv["ID"]; ?>

									<?else:?>

											<?if($serv["ID_BOX"] > 2):?>

											<div class="data-show-content mla" style="display: none;">
											<input type="text"  maxlength="10" data-IDcheckbox="<?=$serv["ID"]?>" name="InputForChBoxServiceDelivIn" value="" class="numbers" style="width:70px; margin:5px;" data-wvc="<?=$serv["ID_BOX"]?>"><label><?=$serv["wvc1"]?></label><br/>
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






