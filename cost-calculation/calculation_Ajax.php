<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>





<? // подключение API Bitrix
 require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php" 
?>

<?

$ID_from = 0;
$ID_to = 0;
$fweight = 0;
$fvolume = 0;
$checkBOXDeliveryOut;
$checkBOXDeliveryIn;

?>






<?foreach($_POST['selected'] as $item): ?>

<?if($item["ID"]=="from"){



$ID_from = $item["value"];

}else if($item["ID"]=="to"){



$ID_to = $item["value"];

}else if($item["ID"]=="weight"){

$fweight = $item["value"];

}else if($item["ID"]=="volume"){

$fvolume = $item["value"];

}else if($item["ID"]=="BOXDeliveryOut_Id"){

$checkBOXDeliveryOut = $item["value"];

}else if($item["ID"]=="BOXDeliveryIn_Id"){

$checkBOXDeliveryIn = $item["value"];

}



?>




<?endforeach;?>



<?



	//echo $ID_from;
//echo $ID_to;
//echo $fweight;
//echo $fvolume;
//echo $checkBOXDeliveryOut;
//echo $checkBOXDeliveryIn;

?>



<? 

  	$ArMarkUp;
	$ArBOXDeliveryOut;
	$ArBOXDeliveryIn;


// Дополнительный сервис
// в пункте отправления, в пункте назначения
	$ArServiceOut;
	$ArServiceIn;



 foreach($_POST['selected'] as $item)
 {
	 //{"ID":2, "ID_BOX":1, "Val_BOX":150},{"ID":2, "ID_BOX":2, "Val_BOX":2.003},


     if(strpos($item["ID"], "MarkUp")!== false && $item["value"] == "true")
	 {

         	$ar_w["ID"] = intval(trim(str_replace("MarkUp", "", $item["ID"])));
          	$ar_w["ID_BOX"] = 1;
			$ar_w["Val_BOX"] = $fweight;

			$ArMarkUp[] = $ar_w;

            $ar_v["ID"] = intval(trim(str_replace("MarkUp", "", $item["ID"]))); 
			$ar_v["ID_BOX"] = 2;
			$ar_v["Val_BOX"] = $fvolume;

			$ArMarkUp[] = $ar_v;



	 }else if(strpos($item["ID"],"BOXDeliveryOut_Id") !== false && $item["value"] == "true"){

               $ar_w_DO["ID"] = 1; 
			   $ar_w_DO["Val"] = $fweight;

				$ArBOXDeliveryOut[] = $ar_w_DO;

				$ar_v_DO["ID"] = 2; 
				$ar_v_DO["Val"] = $fvolume;

				$ArBOXDeliveryOut[] = $ar_v_DO;


	 }else if(strpos($item["ID"],"BOXDeliveryIn_Id") !== false && $item["value"] == "true"){

               $ar_w_DI["ID"] = 1; 
			   $ar_w_DI["Val"] = $fweight;

				$ArBOXDeliveryIn[] = $ar_w_DI;

				$ar_v_DI["ID"] = 2; 
				$ar_v_DI["Val"] = $fvolume;

				$ArBOXDeliveryIn[] = $ar_v_DI;

	 }else if($item["name"] == "chBoxServiceDelivOut" && $item["value"] == "true"){

		$ar_Service["ID"] = $item["DATA_ID"];
		$ar_Service["Count"] = 0;

		 $ar_box_wvc;  // если это штуки, для штук из табл. my_ServiceInOffice

				// ищем input text соответствующий ID услуги
				foreach($_POST['selected'] as $it)
				{
					if($it["name"] == "InputForChBoxServiceDelivOut" && $it["ID"] == $item["DATA_ID"])
					{
						if($it["wvc"] == "wvc2")
						{
						 $ar_Service["Count"] = $it["value"];
						}
						else
						{
								$ar_box_wvc["ID"] = $it["wvc"];
								$ar_box_wvc["Val"] = $it["value"];
						}
					}
				}

											$ar_box_w["ID"] = 1;
											$ar_box_w["Val"] = $fweight;
		
											$ar_box_v["ID"] = 2;
											$ar_box_v["Val"] = $fvolume;

									$ar_BOX[] = $ar_box_w;  unset($ar_box_w);
	
									$ar_BOX[] = $ar_box_v;  unset($ar_box_v);

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

        $ArServiceOut[] = $ar_Service;

		  unset($ar_Service);


	}else if($item["name"] == "chBoxServiceDelivIn" && $item["value"] == "true"){

		$ar_Service["ID"] = $item["DATA_ID"];
		$ar_Service["Count"] = 0;


		 $ar_box_wvc;  // если это штуки, для штук из табл. my_ServiceInOffice

				// ищем input text соответствующий ID услуги
				foreach($_POST['selected'] as $it)
				{
					if($it["name"] == "InputForChBoxServiceDelivIn" && $it["ID"] == $item["DATA_ID"])
					{
						if($it["wvc"] == "wvc2")
						{
						 $ar_Service["Count"] = $it["value"];
						}
						else
						{
								$ar_box_wvc["ID"] = $it["wvc"];
								$ar_box_wvc["Val"] = $it["value"];
						}
					}
				}

											$ar_box_w["ID"] = 1;
											$ar_box_w["Val"] = $fweight;
		
											$ar_box_v["ID"] = 2;
											$ar_box_v["Val"] = $fvolume;

									$ar_BOX[] = $ar_box_w;  unset($ar_box_w);
	
									$ar_BOX[] = $ar_box_v;  unset($ar_box_v);

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

        $ArServiceIn[] = $ar_Service;

		  unset($ar_Service);
	 }

 }



	 if(count($ArMarkUp) == 0)
	 {
				$ar_0["ID"] = 0;
				$ar_0["ID_BOX"] = 0;
				$ar_0["Val_BOX"] = 0;
	
			  $ArMarkUp[] = $ar_0;
	 }
	
	 if(count($ArBOXDeliveryOut) == 0)
	 {
		$ar_DO_0["ID"] = 0; 
		$ar_DO_0["Val"] = 0;
	
		$ArBOXDeliveryOut[] = $ar_DO_0;
	
	}

	if(count($ArBOXDeliveryIn) == 0)
	{
		$ar_DI_0["ID"] = 0; 
		$ar_DI_0["Val"] = 0;
	
		$ArBOXDeliveryIn[] = $ar_DI_0;

	}

	if(count($ArServiceOut) == 0)
	{

				$ar_Service["ID"] = 0;
				$ar_Service["Count"] = 0;



											$ar_box_w["ID"] = 0;
											$ar_box_w["Val"] = 0;
		
											$ar_box_v["ID"] = 0;
											$ar_box_v["Val"] = 0;

								$ar_BOX[] = $ar_box_w;  unset($ar_box_w);

								$ar_BOX[] = $ar_box_v;  unset($ar_box_v);

					$ar_Service["BOX"] = $ar_BOX;

  					unset($ar_BOX);


        $ArServiceOut[] = $ar_Service;

		  unset($ar_Service);

	}



	if(count($ArServiceIn) == 0)
	{

				$ar_Service["ID"] = 0;
				$ar_Service["Count"] = 0;



											$ar_box_w["ID"] = 0;
											$ar_box_w["Val"] = 0;
		
											$ar_box_v["ID"] = 0;
											$ar_box_v["Val"] = 0;

								$ar_BOX[] = $ar_box_w;  unset($ar_box_w);

								$ar_BOX[] = $ar_box_v;  unset($ar_box_v);

					$ar_Service["BOX"] = $ar_BOX;

  					unset($ar_BOX);


        $ArServiceIn[] = $ar_Service;

		  unset($ar_Service);

	}


?>




<?



function calcMax($from,$to,$weight,$vol, $ArMarkUp, $ArBOXDeliveryOut, $ArBOXDeliveryIn, $ArServiceOut, $ArServiceIn){



	$data=array(
		"Type"=>1,
		"ID_OfficeOut"=>$from,
		"ID_OfficeIn"=>$to,
		"JSON_BOX"=>array(
			array(
				"ID"=>1,
				"Val"=>$weight
			),
			array(
				"ID"=>2,
				"Val"=>$vol
			)
		),
		"JSON_MarkUp"=> $ArMarkUp,

		"JSON_BOXDeliveryOut"=>$ArBOXDeliveryOut,

		"JSON_BOXDeliveryIn"=>$ArBOXDeliveryIn,

		"JSON_ServiceOut"=>$ArServiceOut,
		"JSON_ServiceIn"=>$ArServiceIn
	);
	$result=requestRest("GetCostMain",$data,false);
	$result=json_decode($result,true);
	$result=$result['result'][0]['Calc'];
	return $result;
}

$ArResult = calcMax($ID_from, $ID_to, $fweight, $fvolume, $ArMarkUp, $ArBOXDeliveryOut, $ArBOXDeliveryIn, $ArServiceOut, $ArServiceIn);

?>



<?foreach($ArResult as $tarifs):?>
<tr>
	 <td>
		<?=trim($tarifs["SpeedCategory"]);?>
	</td>
	 <td>
		<?=$tarifs["DeliveryTime"].'-'.$tarifs["DeliveryTimeTo"];?>
	</td>
	 <td>
		<?=$tarifs["Cost"];?>
	</td>
</tr>
<?endforeach;?>



<?


function calcData($from,$to,$weight,$vol, $ArMarkUp, $ArBOXDeliveryOut, $ArBOXDeliveryIn, $ArServiceOut, $ArServiceIn){


	$data=array(
		"Type"=>1,
		"ID_OfficeOut"=>$from,
		"ID_OfficeIn"=>$to,
		"JSON_BOX"=>array(
			array(
				"ID"=>1,
				"Val"=>$weight
			),
			array(
				"ID"=>2,
				"Val"=>$vol
			)
		),
		"JSON_MarkUp"=> $ArMarkUp,

		"JSON_BOXDeliveryOut"=>$ArBOXDeliveryOut,

		"JSON_BOXDeliveryIn"=>$ArBOXDeliveryIn,

		"JSON_ServiceOut"=>$ArServiceOut,
		"JSON_ServiceIn"=>$ArServiceIn
	);
	//$result=requestRest("GetCostMain",$data,false);
	//$result=json_decode($result,true);
	//$result=$result['result'][0]['Calc'][0];
	return $data;
}




//$ArResultD = calcData($ID_from, $ID_to, $fweight, $fvolume, $ArMarkUp, $ArBOXDeliveryOut, $ArBOXDeliveryIn, $ArServiceOut, $ArServiceIn);




?>

<pre><? //print_r(json_encode($ArResultD));?></pre>




