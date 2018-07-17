<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>


<? // подключение API Bitrix
 require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php" 
?>



<pre><?print_r($_POST['selected']); ?></pre>


<?

$ID_from = 0;
$ID_to = 0;

$ID_Cityto;
$ID_Cityfrom;

$browser = "";

//данные о выбранном тарифе
$tarifs_data = "";

$DateDeliveryCust_Id = "";  /* дата доставки груза клиентом*/
$Hour1DeliveryCust_Id = 0;  /* время "с" доставки груза клиентом*/
$Hour2DeliveryCust_Id = 0;  /* время "по" доставки груза клиентом*/




$sender_fis_Contact_Id = "";
$sender_fis_Phone_Id = "";
$sender_fis_TypeDoc_Id = "";
$sender_fis_SDoc_Id = "";
$sender_fis_NDoc_Id = "";

$sender_ur_Name_Id = "";
$sender_ur_OrgPravForm_Id = "";
// инн кпп отправителя
$sender_ur_INN_Id = "";
$sender_ur_KPP_Id = "";

$sender_ur_Contact_Id = "";
$sender_ur_Phone_Id = "";


$resiv_fis_Contact_Id = "";
$resiv_fis_Phone_Id = "";
$resiv_fis_TypeDoc_Id = "";
$resiv_fis_SDoc_Id = "";
$resiv_fis_NDoc_Id = "";


$resiv_ur_Name_Id = "";
$resiv_ur_OrgPravForm_Id = "";

// получатель ИНН КПП
$resiv_ur_INN_Id = "";
$resiv_ur_KPP_Id = "";

$resiv_ur_Contact_Id = "";
$resiv_ur_Phone_Id = "";


$pay_fis_Contact_Id = "";
$pay_fis_Phone_Id = "";
$pay_fis_TypeDoc_Id = "";
$pay_fis_SDoc_Id = "";
$pay_fis_NDoc_Id = "";


$pay_ur_Name_Id = "";
$pay_ur_OrgPravForm_Id = "";

// плательщик инн кпп
$pay_ur_INN_Id = "";
$pay_ur_KPP_Id = "";

$pay_ur_Contact_Id = "";
$pay_ur_Phone_Id = "";

$customer_Contact_Id = "";
$customer_Phone_Id = "";
$customer_Email_Id = "";
$customer_More_information_Id = "";


$get_callback_Id = 0;

$TypeOrder_Id = "-1";

$ID_Character = "0";
$DATA_Character = "";


$fweight = 0;
$fvolume = 0;
$fplace = 0;

$lenghMarkUp2 = 0;
$heightMarkUp2 = 0;
$widthMarkUp2 = 0;


$checkBOXDeliveryOut = "false"; // чекбокс забрать груз
$checkBOXDeliveryIn = "false";  // чекбокс доставить груз получателю 
$checkBOXDeliveryYourSelf = "false"; // чекбокс доставлю самостоятельно 



// Дополнительный сервис
// в пункте отправления, в пункте назначения
$ArService_Out_In;


// тип  отправитель физик или юрик
$typeClientSend = "";
$typeClientResiv = "";
$typeClientPayer = "";



?>





<?foreach($_POST['selected'] as $item): ?>

<?if($item["ID"]=="from"){

$ID_from = $item["value"];

}else if($item["ID"]=="to"){

	$ID_to = $item["value"];

}else if($item["ID"]=="Cityfrom"){

	$ID_Cityfrom =  $item["value"];


}else if($item["ID"]== "Cityto"){

   $ID_Cityto = $item["value"];

}else if($item["ID"] == "sender-fis-Contact_Id"){ // отправитель

	$sender_fis_Contact_Id = $item["value"];

}else if($item["ID"] == "sender-fis-Phone_Id"){

	$sender_fis_Phone_Id = $item["value"];

}else if($item["ID"] == "sender-ur-Name_Id"){

	$sender_ur_Name_Id = $item["value"];

}else if($item["ID"] == "sender-ur-OrgPravForm_Id"){

$sender_ur_OrgPravForm_Id =  $item["value"];


}else if($item["ID"] == "sender-ur-INN_Id"){


$sender_ur_INN_Id = $item["value"];


}else if($item["ID"] == "sender-ur-KPP_Id"){


$sender_ur_KPP_Id = $item["value"];


}else if($item["ID"] == "sender-ur-Contact_Id"){

 $sender_ur_Contact_Id = $item["value"];

}else if($item["ID"]  == "sender-ur-Phone_Id"){


$sender_ur_Phone_Id = $item["value"];


}else if($item["ID"] == "sender-fis-TypeDoc_Id"){

	$sender_fis_TypeDoc_Id = $item["value"];

}else if($item["ID"] == "sender-fis-SDoc_Id"){

$sender_fis_SDoc_Id = $item["value"];


}else if($item["ID"] == "sender-fis-NDoc_Id"){

  $sender_fis_NDoc_Id = $item["value"]; 


	}else if($item["ID"] == "resiv-fis-Contact_Id"){ // получатель физик
	
	
	$resiv_fis_Contact_Id = $item["value"];
	
	
	}else if($item["ID"] == "resiv-fis-Phone_Id"){

	
	$resiv_fis_Phone_Id = $item["value"];
	
	
	}else if($item["ID"] == "resiv-fis-TypeDoc_Id"){
	
	
	$resiv_fis_TypeDoc_Id = $item["value"];
	
	
	}else if($item["ID"] == "resiv-fis-SDoc_Id"){
	
	
	$resiv_fis_SDoc_Id = $item["value"];
	

	}else if($item["ID"] == "resiv-fis-NDoc_Id"){
	
	
	$resiv_fis_NDoc_Id = $item["value"];


			}else if($item["ID"]=="resiv-ur-Name_Id"){ // получатель юрик


				$resiv_ur_Name_Id = $item["value"];

			
			}else if($item["ID"]=="resiv-ur-OrgPravForm_Id"){

			
				$resiv_ur_OrgPravForm_Id = $item["value"];


			}else if($item["ID"]=="resiv-ur-INN_Id"){

			
				$resiv_ur_INN_Id = $item["value"];


			}else if($item["ID"]=="resiv-ur-KPP_Id"){


				$resiv_ur_KPP_Id = $item["value"];


			}else if($item["ID"]=="resiv-ur-Contact_Id"){


			$resiv_ur_Contact_Id = $item["value"]; 

			
			}else if($item["ID"]=="resiv-ur-Phone_Id"){
			
			
			$resiv_ur_Phone_Id = $item["value"];

					}else if($item["ID"]=="pay-fis-Contact_Id"){  // плательщик физик

						$pay_fis_Contact_Id = $item["value"];

					}else if($item["ID"]=="pay-fis-Phone_Id"){
					
						$pay_fis_Phone_Id = $item["value"];

					}else if($item["ID"]=="pay-fis-TypeDoc_Id"){
					
						$pay_fis_TypeDoc_Id = $item["value"];

					}else if($item["ID"]=="pay-fis-SDoc_Id"){

						$pay_fis_SDoc_Id = $item["value"];

					}else if($item["ID"]=="pay-fis-NDoc_Id"){

						$pay_fis_NDoc_Id = $item["value"];

								}else if($item["ID"] == "pay-ur-Name_Id"){  // плательщик юрик
		
									$pay_ur_Name_Id = $item["value"];

								}else if($item["ID"] == "pay-ur-OrgPravForm_Id"){
		
									$pay_ur_OrgPravForm_Id = $item["value"];

								}else if($item["ID"] == "pay-ur-INN_Id"){
		
									$pay_ur_INN_Id = $item["value"];

								}else if($item["ID"] == "pay-ur-KPP_Id"){

									$pay_ur_KPP_Id = $item["value"];

								}else if($item["ID"] == "pay-ur-Contact_Id"){
							
									$pay_ur_Contact_Id = $item["value"];
							
								}else if($item["ID"] == "pay-ur-Phone_Id"){

									$pay_ur_Phone_Id = $item["value"];

										}else if($item["ID"] == "customer-Contact_Id"){

											$customer_Contact_Id = $item["value"];

										}else if($item["ID"] == "customer-Phone_Id"){

											$customer_Phone_Id = $item["value"];

										}else if($item["ID"] == "customer_Email_Id"){

											$customer_Email_Id = $item["value"];

										}else if($item["ID"] == "customer-More-information_Id"){

											$customer_More_information_Id = $item["value"];
	
		}else if($item["ID"] == "get-callback_Id" &&  $item["value"] == "true"){ // требуется созвон
		
				$get_callback_Id = 1;
		
		
		}else if($item["ID"] ==	"TypeOrder_Id"){
		
				$TypeOrder_Id = $item["value"];
		
		
		}else if($item["ID"] == "ID_Character"){

			$ID_Character = $item["value"];
			$DATA_Character =  $item["data_val"];
	
	}else if($item["ID"]=="weight"){

		$fweight = $item["value"];

	}else if($item["ID"]=="volume"){

		$fvolume = $item["value"];

	}else if($item["ID"]=="place"){

		$fplace = $item["value"];

			}else if($item["ID"]=="lenghMarkUp2"){

				$lenghMarkUp2 = $item["value"];

			}else if($item["ID"]=="heightMarkUp2"){

				$heightMarkUp2 = $item["value"];

			}else if($item["ID"]=="widthMarkUp2"){

				$widthMarkUp2 = $item["value"];

			}else if($item["ID"]=="BOXDeliveryOut_Id"){

					$checkBOXDeliveryOut = $item["value"];
			
			}else if($item["ID"]=="BOXDeliveryIn_Id"){

					$checkBOXDeliveryIn = $item["value"];
			
			}else if($item["ID"] == "yourself_BOXDeliveryOut_Id"){
			
					$checkBOXDeliveryYourSelf = $item["value"];

			}else if($item["ID"]== "typeClientSend_fis_id" && $item["value"] == "true"){

			$typeClientSend = "1"; 

			}else if($item["ID"]== "typeClientSend_ur_id" && $item["value"] == "true"){

				$typeClientSend = "2";

			}else if($item["ID"]== "typeClientResiv_fis_id" && $item["value"] == "true"){

				$typeClientResiv = "1";

			}else if($item["ID"]== "typeClientResiv_ur_id" && $item["value"] == "true"){

				$typeClientResiv = "2";

			}else if($item["ID"]== "typeClientPay_fis_id" && $item["value"] == "true"){

				$typeClientPayer = "1";

			}else if($item["ID"]== "typeClientPay_ur_id" && $item["value"] == "true"){

				$typeClientPayer = "2";

			}else if($item["ID"] == "browser"){

				$browser = $item["value"];

			}else if($item["name"] == "tarifs" && $item["value"] == "true"){

					$tarifs_data =  $item["datacontent"];

			} 



?>


<?endforeach;?>




<?

	$ArMarkUp;

	$MarkUpMessage = "НЕТ";


 foreach($_POST['selected'] as $item)
 {
	 //{"ID":2, "ID_BOX":1, "Val_BOX":150},{"ID":2, "ID_BOX":2, "Val_BOX":2.003},


     if(strpos($item["ID"], "MarkUp")!== false && $item["value"] == "true")
	 {


			if(intval(trim(str_replace("MarkUp", "", $item["ID"]))) == 2)
			{
							$MarkUpMessage = str_replace("НЕТ", "", $MarkUpMessage);


								$arMark["ID_MarkUp"] = intval(trim(str_replace("MarkUp", "", $item["ID"])));  //ID наценки
			
									$ar_w["ID"] = 1;
									$ar_w["Val"] = $fweight;
						
									$ar_v["ID"] = 2;
									$ar_v["Val"] = $fvolume;
						
									$ar_p["ID"] = 4;
									$ar_p["Val"] = $fplace;

									// длина ширина высота
									$ar_lengh["ID"] = "длина";
									$ar_lengh["Val"] = $lenghMarkUp2;

									$ar_width["ID"] = "ширина";
									$ar_width["Val"] = $widthMarkUp2;

									$ar_height["ID"] = "высота";
									$ar_height["Val"] = $heightMarkUp2;

					// данные для письма
				$MarkUpMessage = $MarkUpMessage.' '.'<br/><u>'.$item["datacontent"].':'.'</u>'.'  длина: '.$lenghMarkUp2.'  ширина: '.$widthMarkUp2.'  высота: '.$heightMarkUp2; 



							$ar_box[] = $ar_w;
							$ar_box[] = $ar_v;
							$ar_box[] = $ar_p;
							$ar_box[] = $ar_lengh;
							$ar_box[] = $ar_width;
							$ar_box[] = $ar_height;

			
						$arMark["BOX"] =  $ar_box;
						unset($ar_box);
						unset($ar_w);
						unset($ar_v);
						unset($ar_p);

				$ArMarkUp[] = $arMark;


			}
			else
			{

					$MarkUpMessage = str_replace("НЕТ", "", $MarkUpMessage);

			// данные для письма
				$MarkUpMessage = $MarkUpMessage.' '.'<br/><u>'.$item["datacontent"].':'.'</u>'.' ДА'; 




								$arMark["ID_MarkUp"] = intval(trim(str_replace("MarkUp", "", $item["ID"])));  //ID наценки
			
									$ar_w["ID"] = 1;
									$ar_w["Val"] = $fweight;
						
									$ar_v["ID"] = 2;
									$ar_v["Val"] = $fvolume;
						
									$ar_p["ID"] = 4;
									$ar_p["Val"] = $fplace;
				
							$ar_box[] = $ar_w;
							$ar_box[] = $ar_v;
							$ar_box[] = $ar_p;
			
			
						$arMark["BOX"] =  $ar_box;
						unset($ar_box);
						unset($ar_w);
						unset($ar_v);
						unset($ar_p);
		
				$ArMarkUp[] = $arMark;
			}
 }
 }
?>


<? // Экспедирование

$Expedition;

	 foreach($_POST['selected'] as $item)
	 {

		if($checkBOXDeliveryOut == "true")
		{

			if($item["ID"] == "AddressBOXDeliveryOut_Id")
			{
					$expedOut["Address"] = $item["value"];
			}
			else if($item["ID"] == "DateBOXDeliveryOut_Id")
			{
					$expedOut["Date"] = $item["value"];
			}
			else if($item["ID"] == "Hour1BOXDeliveryOut_Id")
			{
					$expedOut["Hour1"] = $item["value"];
			}
			else if($item["ID"] == "Hour2BOXDeliveryOut_Id")
			{
					$expedOut["Hour2"] = $item["value"];
			}
			else if($item["ID"] == "ContactBOXDeliveryOut_Id")
			{
					$expedOut["Contact"] = $item["value"];
			}
			else if($item["ID"] == "PhoneBOXDeliveryOut_Id")
			{
					$expedOut["Phone"] = $item["value"];
			}

		}


		if($checkBOXDeliveryIn == "true")
		{

			if($item["ID"] == "AddressBOXDeliveryIn_Id")
			{
					$expedIn["Address"] = $item["value"];
			}
			else if($item["ID"] == "DateBOXDeliveryIn_Id")
			{
					$expedIn["Date"] = $item["value"];
			}
			else if($item["ID"] == "Hour1BOXDeliveryIn_Id")
			{
					$expedIn["Hour1"] = $item["value"];
			}
			else if($item["ID"] == "Hour1BOXDeliveryIn_Id")
			{
					$expedIn["Hour1"] = $item["value"];
			}
			else if($item["ID"] == "Hour2BOXDeliveryIn_Id")
			{
					$expedIn["Hour2"] = $item["value"];
			}
			else if($item["ID"] == "ContactBOXDeliveryIn_Id")
			{
					$expedIn["Contact"] = $item["value"];
			}
			else if($item["ID"] == "PhoneBOXDeliveryIn_Id")
			{
					$expedIn["Phone"] = $item["value"];
			}

		}


		if($checkBOXDeliveryYourSelf == "true")
		{

			if($item["ID"] == "DateDeliveryCust_Id")
			{
				$DateDeliveryCust_Id = $item["value"]; // дата доставки груза клиентом
			}
			if($item["ID"] == "Hour1DeliveryCust_Id")
			{
				$Hour1DeliveryCust_Id = $item["value"]; // время "с" доставки груза клиентом
			}
			if($item["ID"] == "Hour2DeliveryCust_Id")
			{
				$Hour2DeliveryCust_Id = $item["value"];  // время "по" доставки груза клиентом
			}

		}





	}

// Дополнительный сервис в пункте отравления данные для письма
$ServiceDelivOutMessage = "НЕТ";


// Дополнительный сервис в пункте назначения данные для письма
$ServiceDelivInMessage = "НЕТ";


		// Дополнительный сервис
   	foreach($_POST['selected'] as $item)
	{
			if($item["name"] == "chBoxServiceDelivOut" && $item["value"] == "true")
			{
			$ar_Service["Direction"] = 0;
			$ar_Service["ID_Service"] = $item["DATA_ID"];
			$ar_Service["Count"] = 0;

				$ServiceDelivOutMessage = str_replace("НЕТ", "", $ServiceDelivOutMessage); // контент письма
				$ServiceDelivOutMessage = $ServiceDelivOutMessage.' '.$item["datacontent"]; // контент письма


			 $ar_box_wvc;  // если это штуки, для штук из табл. my_ServiceInOffice
	
					// ищем input text соответствующий ID услуги
					foreach($_POST['selected'] as $it)
					{
						$pos = strpos($it["name"], "InputForChBoxServiceDelivOut");

						if($pos !== false && $it["ID"] == $item["DATA_ID"])
						{
							if($it["wvc"] == "wvc2")
							{
									 $ar_Service["Count"] = $it["value"];
		
								$ServiceDelivOutMessage = $ServiceDelivOutMessage.': '. $it["value"]; // контент письма
							}
							else
							{
									$ar_box_wvc["ID"] = $it["wvc"];
									$ar_box_wvc["Val"] = $it["value"];

								$ServiceDelivOutMessage = $ServiceDelivOutMessage.': '. $it["value"]; // контент письма

							}
						}
					}

					$ServiceDelivOutMessage = $ServiceDelivOutMessage.'<br/>'; // контент письма


												$ar_box_w["ID"] = 1;
												$ar_box_w["Val"] = $fweight;
			
												$ar_box_v["ID"] = 2;
												$ar_box_v["Val"] = $fvolume;

												$ar_box_p["ID"] = 4;
												$ar_box_p["Val"] = $fplace;

	
										$ar_BOX[] = $ar_box_w;  unset($ar_box_w);
		
										$ar_BOX[] = $ar_box_v;  unset($ar_box_v);

										$ar_BOX[] = $ar_box_p;  unset($ar_box_p);
	
									if(count($ar_box_wvc)>0)
									{
										$ar_BOX[] = $ar_box_wvc; unset($ar_box_wvc);
									}
	
	
			$ar_Service["BOX"] = $ar_BOX;
	
						unset($ar_BOX);
			 //"JSON_ServiceOut":[{"ID":128, "Count":0, "BOX": [{ "ID":1, "Val":150},{"ID":2, "Val":2.003}]},
	
	
			 //"JSON_ServiceOut"=>array(
			 //array("ID"=>128, "Count"=>0, "BOX"=>array(array("ID"=>1, "Val"=>$weight),array("ID"=>2, "Val"=>$vol))),
			 //array("ID"=>121, "Count"=>0, "BOX"=>array(array( "ID"=>1, "Val"=>$weight),array("ID"=>2, "Val"=>$vol)))
			 //),
	
			$ArService_Out_In[] = $ar_Service;
	
			  unset($ar_Service);
	


		}else if($item["name"] == "chBoxServiceDelivIn" && $item["value"] == "true"){
			$ar_Service["Direction"] = 1;
			$ar_Service["ID_Service"] = $item["DATA_ID"];
			$ar_Service["Count"] = 0;


				$ServiceDelivInMessage = str_replace("НЕТ", "", $ServiceDelivInMessage); // контент письма
				$ServiceDelivInMessage = $ServiceDelivInMessage.' '.$item["datacontent"]; // контент письма


			 $ar_box_wvc;  // если это штуки, для штук из табл. my_ServiceInOffice
	
					// ищем input text соответствующий ID услуги
					foreach($_POST['selected'] as $it)
					{
						$pos = strpos($it["name"], "InputForChBoxServiceDelivIn");

						if($pos !== false && $it["ID"] == $item["DATA_ID"])
						{
							if($it["wvc"] == "wvc2")
							{
							 $ar_Service["Count"] = $it["value"];

								$ServiceDelivInMessage = $ServiceDelivInMessage.': '. $it["value"]; // контент письма
							}
							else
							{
									$ar_box_wvc["ID"] = $it["wvc"];
									$ar_box_wvc["Val"] = $it["value"];

								$ServiceDelivInMessage = $ServiceDelivInMessage.': '. $it["value"]; // контент письма
							}
						}
					}


					$ServiceDelivInMessage = $ServiceDelivInMessage.'<br/>'; // контент письма

	
												$ar_box_w["ID"] = 1;
												$ar_box_w["Val"] = $fweight;
			
												$ar_box_v["ID"] = 2;
												$ar_box_v["Val"] = $fvolume;

												$ar_box_p["ID"] = 4;
												$ar_box_p["Val"] = $fplace;

	
										$ar_BOX[] = $ar_box_w;  unset($ar_box_w);
		
										$ar_BOX[] = $ar_box_v;  unset($ar_box_v);

										$ar_BOX[] = $ar_box_p;  unset($ar_box_p);

	
									if(count($ar_box_wvc)>0)
									{
										$ar_BOX[] = $ar_box_wvc; unset($ar_box_wvc);
									}
	
	
	
						$ar_Service["BOX"] = $ar_BOX;
	
						unset($ar_BOX);
			 //"JSON_ServiceOut":[{"ID":128, "Count":0, "BOX": [{ "ID":1, "Val":150},{"ID":2, "Val":2.003}]},
	
	
			 //"JSON_ServiceOut"=>array(
			 //array("ID"=>128, "Count"=>0, "BOX"=>array(array("ID"=>1, "Val"=>$weight),array("ID"=>2, "Val"=>$vol))),
			 //array("ID"=>121, "Count"=>0, "BOX"=>array(array( "ID"=>1, "Val"=>$weight),array("ID"=>2, "Val"=>$vol)))
			 //),
	
			$ArService_Out_In[] = $ar_Service;
	
			  unset($ar_Service);
		 }

	}


$NoteOrderTypeVidilenMejdunarod = "";

	if($TypeOrder_Id == 2)
	{
	
		foreach($_POST['selected'] as $item)
		{
		    if($item["name"] == "tip-polupricepa-kontejnera" && $item["value"] == "true")
			{
				$NoteOrderTypeVidilenMejdunarod = $NoteOrderTypeVidilenMejdunarod.'\\'.$item["datacontent"];
			}
		}

		$NoteOrderTypeVidilenMejdunarod = trim($NoteOrderTypeVidilenMejdunarod, '\\');

	}
	else if($TypeOrder_Id == 3)
	{
		foreach($_POST['selected'] as $item)
		{
			if($item["name"] == "vid-perevozki" && $item["value"] == "true")
			{
				$NoteOrderTypeVidilenMejdunarod = $NoteOrderTypeVidilenMejdunarod.'\\'.$item["datacontent"];
			}

			else if($item["name"] == "dop-servis-usluga" && $item["value"] == "true" )
			{
				$NoteOrderTypeVidilenMejdunarod = $NoteOrderTypeVidilenMejdunarod.'\\'.$item["datacontent"];
			}
		}

		$NoteOrderTypeVidilenMejdunarod = trim($NoteOrderTypeVidilenMejdunarod, '\\');
	}











	// делаем дополнение

   	if(count($expedOut) > 0)
	{
		$expedOut["ID_Office"] = $ID_from;
		$expedOut["Direction"] = 0;

		$Expedition[] = $expedOut;
	}


   	if(count($expedIn) > 0)
	{
		$expedIn["ID_Office"] = $ID_to;
		$expedIn["Direction"] = 1;

		$Expedition[] = $expedIn;
	}

    if(count($Expedition) == 0)
	{
			$exped_0["ID_Office"] = 0;
  			$exped_0["Direction"] = 0; 
           	$exped_0["Address"] = ""; 
         	$exped_0["Contact"] = ""; 
         	$exped_0["Phone"] = "";
         	$exped_0["Date"] = "";
         	$exped_0["Hour1"] = 0; 
         	$exped_0["Hour2"] = 0;


			$Expedition[] = $exped_0;
	}



?>





<?

	 // в случае отсутствия маркап


	 if(count($ArMarkUp) == 0)
	 {


				$arMark["ID_MarkUp"]  = 0;

									$ar_0["ID"] = 0;
									$ar_0["Val"] = 0;

							$ar_box[] = $ar_0;

				$arMark["BOX"] = $ar_box;

				$ArMarkUp[] = $arMark;

	 }


// в случае отсутствия дополнительных сервисов

	if(count($ArService_Out_In) == 0)
	{


     $ArService_Out_In = array(array(  
							"Direction"=>0,
							"ID_Service"=>0, 
							"Count"=>0, 
							"BOX"=>array(
										array(
											"ID"=>0, 
											"Val"=>0
											)
										)
							)
						);
	}



?>

<pre><?print_r(json_encode($ArService_Out_In));?></pre>




<?
		//******* ПИСЬМО *******************

		$getCargo = "";
		// забрать груз
		if($checkBOXDeliveryOut == "true"){ 
			$getCargo = "ДА".', Адрес грузоотправителя: '.$expedOut["Address"].', Дата отправки: '.$expedOut["Date"].', Время отправки: c '.$expedOut["Hour1"].' по '.$expedOut["Hour2"].', Контактное лицо: '.$expedOut["Contact"].', Контактный телефон:'.$expedOut["Phone"]; 
		}else{
			$getCargo = "НЕТ";
		}

		$YourSelfGetCargo = "";
        //доставлю самостоятельнто
		if($checkBOXDeliveryYourSelf == "true"){
			$YourSelfGetCargo = "ДА".', Когда: '.$DateDeliveryCust_Id.', Во сколько: c '.$Hour1DeliveryCust_Id.' по '.$Hour2DeliveryCust_Id;
		}else{
			$YourSelfGetCargo = "НЕТ";
		}

		$DostavitCargo = "";
		//доставить груз получателю
		if($checkBOXDeliveryIn == "true"){
			$DostavitCargo = "ДА".', Адрес грузополучателя: '.$expedIn["Address"].', Дата отправки: '.$expedIn["Date"].', Время отправки: c '.$expedIn["Hour1"].' по '.$expedIn["Hour2"].', Контактное лицо: '.$expedIn["Contact"].', Контактный телефон:'.$expedIn["Phone"]; 
		}else{
			$DostavitCargo = "НЕТ";
		}

		$senderOrder = "";
			//отправитель
		if($typeClientSend == "1"){
			$senderOrder = 'Контактное лицо: '.$sender_fis_Contact_Id.', Контактный телефон: '.$sender_fis_Phone_Id.', Тип документа: '.$sender_fis_TypeDoc_Id.', Серия: '.$sender_fis_SDoc_Id.', Номер документа: '.$sender_fis_NDoc_Id;
		}else{
			$senderOrder = 'Название организации: '.$sender_ur_Name_Id.', Организационно-правовая форма: '. $sender_ur_OrgPravForm_Id.', ИНН: '.$sender_ur_INN_Id.', КПП: '.$sender_ur_KPP_Id.', Контактное лицо '.$sender_ur_Contact_Id.', Контактный телефон: '.$sender_ur_Phone_Id; 
		}

		$resiverOrder = "";
			//получатель
		if($typeClientSend == "1"){
			$resiverOrder = 'Контактное лицо: '.$resiv_fis_Contact_Id.', Контактный телефон: '.$resiv_fis_Phone_Id.', Тип документа: '.$resiv_fis_TypeDoc_Id.', Серия: '.$resiv_fis_SDoc_Id.', Номер документа: '.$resiv_fis_NDoc_Id;
		}else{
			$resiverOrder = 'Название организации: '.$resiv_ur_Name_Id.', Организационно-правовая форма: '. $resiv_ur_OrgPravForm_Id.', ИНН: '.$resiv_ur_INN_Id.', КПП: '.$resiv_ur_KPP_Id.', Контактное лицо '.$resiv_ur_Contact_Id.', Контактный телефон: '.$resiv_ur_Phone_Id; 
		}




		$paerOrder = "";
		//плательщик
		if($typeClientPayer == "1"){

  			$paerOrder = 'Контактное лицо: '.$pay_fis_Contact_Id.', Контактный телефон: '.$pay_fis_Phone_Id.', Тип документа: '.$pay_fis_TypeDoc_Id.', Серия: '.$pay_fis_SDoc_Id.', Номер документа: '.$pay_fis_NDoc_Id;
		}else{

			$paerOrder = 'Название организации: '.$pay_ur_Name_Id.', Организационно-правовая форма: '. $pay_ur_OrgPravForm_Id.', ИНН: '.$pay_ur_INN_Id.', КПП: '.$pay_ur_KPP_Id.', Контактное лицо '.$pay_ur_Contact_Id.', Контактный телефон: '.$pay_ur_Phone_Id; 
		}




$arEventFields = array(
					"ID_Cityto" => $ID_Cityto,
					"ID_Cityfrom" => $ID_Cityfrom,
					"weight" => $fweight,
					"volume" =>	$fvolume,
					"place" => $fplace,
					"DATA_Character"=>$DATA_Character,
					"getCargo" => $getCargo,
					"YourSelfGetCargo" => $YourSelfGetCargo,
					"DostavitCargo" => $DostavitCargo,

					"customer_Contact" =>$customer_Contact_Id, 
					"customer_Phone" => $customer_Phone_Id, 
					"customer_Email" =>	$customer_Email_Id, 
					"customer_More_information"=>$customer_More_information_Id,

					"senderOrder" => $senderOrder,
					"resiverOrder"=> $resiverOrder,
					"paerOrder"=> $paerOrder,

					"MarkUp"=>$MarkUpMessage,
					"ServiceDelivOut" => $ServiceDelivOutMessage,
					"ServiceDelivIn" => $ServiceDelivInMessage,
					"tarifs_data" => $tarifs_data,
					"browser" => $browser
				);



	CEvent::Send("SEND_ORDER", "s1", $arEventFields, "N", "35", "", "");






function OrderSend($from, $to, 
					$Cityfrom, $Cityto, 
					$DateDeliveryCust, $Hour1DeliveryCust, $Hour2DeliveryCust, 

					$sender_fis_Contact, $sender_fis_Phone, $sender_fis_TypeDoc,$sender_fis_SDoc, $sender_fis_NDoc, 
					$sender_ur_Name, $sender_ur_OrgPravForm, $sender_ur_INN, $sender_ur_KPP ,$sender_ur_Contact, $sender_ur_Phone,

					$resiv_fis_Contact, $resiv_fis_Phone, $resiv_fis_TypeDoc, $resiv_fis_SDoc, $resiv_fis_NDoc,
					$resiv_ur_Name, $resiv_ur_OrgPravForm, $resiv_ur_INN ,$resiv_ur_KPP, $resiv_ur_Contact, $resiv_ur_Phone,

					$pay_fis_Contact, $pay_fis_Phone, $pay_fis_TypeDoc, $pay_fis_SDoc, $pay_fis_NDoc,
					$pay_ur_Name, $pay_ur_OrgPravForm, $pay_ur_INN, $pay_ur_KPP, $pay_ur_Contact, $pay_ur_Phone,

					$customer_Contact, $customer_Phone, $customer_Email, $customer_More_information,
					$get_callback,
					$TypeOrder,
					$IDCharacter,
					$weight, $volume, $place,
					$ArrayMarkUp,
					$ExpeditionAr,
					$ArServiceOutIn,
					$NoteOrderTypeVidMejd,
					$typeClientSend_fis_ur,
					$typeClientResiv_fis_ur,
					$typeClientPayer_fis_ur,
					$tarifs__data)
{




	$NoteOrder = trim($customer_More_information.'\\'.$customer_Email.'\\'.$NoteOrderTypeVidMejd.'\\'.$tarifs__data,'\\');


	$data=array("ID_Users"=>1,
				"DateOrder"=>date("d.m.Y"),
				"ID_OfficeOut"=>$from,
				"Name_OfficeOut"=>$Cityfrom,
				"ID_OfficeIn"=>$to,
				"Name_OfficeIn"=>$Cityto,
				"DateDeliveryCust"=>$DateDeliveryCust,
				"Hour1DeliveryCust"=>$Hour1DeliveryCust,
				"Hour2DeliveryCust"=>$Hour2DeliveryCust,
				"Agents"=>array(
					array(
  						"AgentOnOrder"=>"1", // заказчик
						"TypeAgent"=>"1",
					"Name"=>$customer_Contact,
					"INN"=>"",
					"KPP"=>"",
					"GUID"=>"",
					"Contact"=>$customer_Contact,
					"Phone"=>$customer_Phone,
					"TypeDoc"=>"",
					"NDoc"=>"",
					"SDoc"=>""
					),
					array(
						"AgentOnOrder"=>"2", // отправитель
					"TypeAgent"=>$typeClientSend_fis_ur,
					"Name"=>$sender_ur_Name.' '.$sender_ur_OrgPravForm.''.$sender_fis_Contact,
					"INN"=>$sender_ur_INN,
					"KPP"=>$sender_ur_KPP,
					"GUID"=>"",
					"Contact"=>$sender_fis_Contact.$sender_ur_Contact,
					"Phone"=>$sender_fis_Phone.$sender_ur_Phone,
					"TypeDoc"=>$sender_fis_TypeDoc,
					"NDoc"=>$sender_fis_NDoc,
					"SDoc"=>$sender_fis_SDoc
					),
					array(
						"AgentOnOrder"=>"3", // получатель
						"TypeAgent"=>$typeClientResiv_fis_ur, //
					"Name"=>$resiv_ur_Name.' '.$resiv_ur_OrgPravForm.''.$resiv_fis_Contact,
					"INN"=>$resiv_ur_INN,
					"KPP"=>$resiv_ur_KPP,
					"GUID"=>"",
					"Contact"=>$resiv_fis_Contact.$resiv_ur_Contact,
					"Phone"=>$resiv_fis_Phone.$resiv_ur_Phone,
					"TypeDoc"=>$resiv_fis_TypeDoc,
					"NDoc"=>$resiv_fis_NDoc,
					"SDoc"=>$resiv_fis_SDoc
					),
					array(
					"AgentOnOrder"=>"4", // плательщик
					"TypeAgent"=>$typeClientPayer_fis_ur,
					"Name"=>$pay_ur_Name.' '.$pay_ur_OrgPravForm.''.$pay_fis_Contact,
					"INN"=>$pay_ur_INN, 
					"KPP"=>$pay_ur_KPP, 
					"GUID"=>"",
					"Contact"=>$pay_fis_Contact.$pay_ur_Contact,
					"Phone"=>$pay_fis_Phone.$pay_ur_Phone,
					"TypeDoc"=>$pay_fis_TypeDoc,
					"NDoc"=>$pay_fis_NDoc,
					"SDoc"=>$pay_fis_SDoc 
					)
				),
				"RequiresPhone"=>$get_callback,
				"Note"=>$NoteOrder,
				"TypeOrder"=>$TypeOrder,
				"Cargo"=>array(
								array(
								"ID_Character"=>$IDCharacter,
													"BOX"=>array(
																	array(
																	"ID"=>1,
																	"Val"=>$weight
																	),
																	array(
																	"ID"=>2,
																	"Val"=>$volume
																	),
																	array(
																	"ID"=>4,
																	"Val"=>$place
																	)
													)
								)
				),
				"MarkUp"=>$ArrayMarkUp,
				"Service"=>$ArServiceOutIn,
				"Expedition"=>$ExpeditionAr

				);



	$result=requestRest("GetOrderFromWEB",$data,false);

	$result=json_decode($result,true);

?><pre><? echo json_encode($data);?></pre><?

	return  $result;

}

$ArResult = OrderSend($ID_from, $ID_to, $ID_Cityfrom,  $ID_Cityto, 
						$DateDeliveryCust_Id, $Hour1DeliveryCust_Id, $Hour2DeliveryCust_Id, 

						$sender_fis_Contact_Id, $sender_fis_Phone_Id, $sender_fis_TypeDoc_Id, 
						$sender_fis_SDoc_Id, $sender_fis_NDoc_Id, $sender_ur_Name_Id, $sender_ur_OrgPravForm_Id, $sender_ur_INN_Id, $sender_ur_KPP_Id, $sender_ur_Contact_Id, $sender_ur_Phone_Id,

						$resiv_fis_Contact_Id, $resiv_fis_Phone_Id, $resiv_fis_TypeDoc_Id, $resiv_fis_SDoc_Id, $resiv_fis_NDoc_Id,
						$resiv_ur_Name_Id, $resiv_ur_OrgPravForm_Id, $resiv_ur_INN_Id, $resiv_ur_KPP_Id, $resiv_ur_Contact_Id, $resiv_ur_Phone_Id,

						$pay_fis_Contact_Id, $pay_fis_Phone_Id, $pay_fis_TypeDoc_Id, $pay_fis_SDoc_Id, $pay_fis_NDoc_Id, 
						$pay_ur_Name_Id, $pay_ur_OrgPravForm_Id, $pay_ur_INN_Id, $pay_ur_KPP_Id, $pay_ur_Contact_Id, $pay_ur_Phone_Id,

						$customer_Contact_Id, $customer_Phone_Id, $customer_Email_Id, $customer_More_information_Id,
						$get_callback_Id,
						$TypeOrder_Id,
						$ID_Character,
						$fweight, $fvolume, $fplace,
						$ArMarkUp,
						$Expedition, $ArService_Out_In,
						$NoteOrderTypeVidilenMejdunarod,
						$typeClientSend,
						$typeClientResiv,
						$typeClientPayer,
						$tarifs_data);


$res = $ArResult['result'];
$res = $res[0];
$res = $res['result'];
?>



<pre><p id="result_order_send"><? print_r($res); ?><p></pre>


