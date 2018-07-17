<?
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
?>



<?
 // подключение API Bitrix
 require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php" ?>

<?  $selected = $_POST['selected'];

foreach($selected as $item)
{

	if($item['ID'] == 'from'){

	 $ID_from = $item['value'];

	}else if($item['ID'] == 'to'){

	 $ID_to = $item['value'];

	}else if($item['ID'] == 'DopServiceFrom_Id'){

	 $Check_DopServiceFrom = $item['value']; // доп услуги в пункте отправки

	}else if($item['ID'] == 'DopServiceTo_Id'){


	 $Check_DopServiceTo = $item['value'];   // доп услуги в пункте назначения

	}else if($item['ID'] == 'GorodFrom_Id'){

	 $Check_GorodFrom = $item['value']; // экспедирование по городу отправки

	}else if($item['ID'] == 'GorodTo_Id'){

	 $Check_GorodTo = $item['value']; // экспедирование по городу назначения

	}


}

?>




<? global $DB;  ?>


<?
// ОСНОВНОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 1 ШАПКА

    $my = $DB->Query(
                "select L.ID as ID_List,
				   L.ID_Office,
				   L.ID_TypeList,
				   L.MarkUpShort,
				   L.MarkUp,
				   T.ID as ID_Top,
				   T.Numpp,
					T.Name
			from my_List as L
			inner join
			my_Top as T
			on L.ID = T.ID_List
			where L.ID_Office = " .$ID_from. " and L.ID_TypeList = 1
			order by L.ID_TypeList, T.Numpp"
);
?>

<?

// ОСНОВНОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 1  ЯЧЕЙКИ
 $myPrice = $DB->Query(
  "select C.Name, C.Numpp
	from my_List as Li
	left join my_Line as L
	on Li.ID = L.ID_List
	left join my_Office as O
	on Li.ID_Office = O.ID
	left join my_Cell as C
	on C.ID_Line = L.ID
	where Li.ID_Office = " .$ID_from. " 
       and (" .$ID_to. " = 244 or L.ID_Office = " .$ID_to. ")
       and Li.ID_TypeList = 1
  order by O.Name, C.Numpp, L.ID");



?>



<?
// ОСНОВНОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 1 ШАПКА
while($res = $my->Fetch()){
     $arr['Name'][] = $res['Name'];
     $MarkUp['MarkUp'][] = $res['MarkUp'];
						  }

?>

<?
// ОСНОВНОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 1  ЯЧЕЙКИ

while($resPrice = $myPrice->Fetch())
{

	$myArray[$resPrice['Numpp']][] = array("Numpp" => $resPrice['Numpp'], "Name" => $resPrice['Name']); 

}
?>


<div <?if(count($myArray)==0){ echo 'hidden="hidden"';}?>>
<p class="price_titel">Основной прайс</p>

  <table id="preskurant" border="1" bordercolor="gray" style="border-style:solid;">
   <tbody>
		  <tr>

		   <? for($i = 0; $i < count($arr['Name']); $i++): ?>

			  <? if(strpos($arr['Name'][$i],'|')!==false): ?>

               <? $ar = explode("|", $arr['Name'][$i]); ?>
			

                        <th><span class="header_table_price">
							<? for($j = 0; $j < count($ar); $j++): ?>
							   <?if($j + 1 < count($ar)):?>
							<p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px; border-color:gray;"><?=$ar[$j]?></p>
								<?else:?>
							<p style="white-space:nowrap; padding:2px; border-color:gray;"><?=$ar[$j]?></p>
  								<?endif;?>

							<?endfor;?>
						</span></th>

			   <?else:?>

					<th><span class="header_table_price"><?=$arr['Name'][$i]?></span></th>

               <?endif;?>

			 <?endfor;?>
	      </tr>


	   <?for($d = 0; $d < count($myArray[1]); $d++ ):?> 
           <tr>
			   <?foreach($myArray as $Numpp):?>

                  <? $myName = $Numpp[$d]['Name']; ?>


                  <? if(strpos($myName,'|')!==false): ?>

                       <? $arrr = explode("|", $myName); ?>
                           <td style="text-align:center;">
 							<? for($j = 0; $j < count($arrr); $j++): ?>
							   <?if($j + 1 < count($arrr)):?>
							   <p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px; border-color:gray;"><?=$arrr[$j]?></p>
								<?else:?>
							   <p style="white-space:nowrap; padding:2px; border-color:gray;"><?=$arrr[$j]?></p>
  								<?endif;?>

							<?endfor;?>
							</td>

			   <?else:?>


					<?$pos = strpos($myName, '^*');?>
	
				   <?if($pos === false):?>
				   <td style="text-align:center;"><?=$myName;?></td>
				   <?else:?>
					   <? $strrr = str_replace("^*", "", $myName); ?>
					   <td style="text-align:center;"><b><?=$strrr;?></b></td>
					<?endif;?>


                  <?endif;?>

               <?endforeach;?>

		  </tr>
        <?endfor;?>


	  </tbody> 

</table>




<p><span class="price_prim_c">Примечание:</span>&nbsp;<span class="price_prim"><?=$MarkUp['MarkUp'][0]; ?></span></p>

</div>




<?

// РЕГИОНАЛЬНЫЙ ПРЕЙСКУРАНТ L.ID_TypeList = 2 ШАПКА

    $myRegion = $DB->Query(
                " select L.ID as ID_List,
				   L.ID_Office,
				   L.ID_TypeList,
				   L.MarkUpShort,
				   L.MarkUp,
				   T.ID as ID_Top,
			
				   T.Numpp,
					T.Name
			from my_List as L
			inner join
			my_Top as T
			on L.ID = T.ID_List
			where L.ID_Office = " .$ID_from. " and L.ID_TypeList = 2
			order by L.ID_TypeList, T.Numpp"
            );
?>


<?

// РЕГИОНАЛЬНЫЙ ПРЕЙСКУРАНТ L.ID_TypeList = 2  ЯЧЕЙКИ

 $myPriceRegion = $DB->Query(
  "select C.Name, C.Numpp
	from my_List as Li
	left join my_Line as L
	on Li.ID = L.ID_List
	left join my_Office as O
	on Li.ID_Office = O.ID
	left join my_Cell as C
	on C.ID_Line = L.ID
	where Li.ID_Office = " .$ID_from. " 
       and (" .$ID_to. " = 244 or L.ID_Office = " .$ID_to. ")
       and Li.ID_TypeList = 2
  order by O.Name, C.Numpp, L.ID" );

?>




<?
// РЕГИОНАЛЬНЫЙ ПРЕЙСКУРАНТ L.ID_TypeList = 2 ШАПКА
while($resRegion = $myRegion->Fetch()){
     $arrRegion['Name'][] = $resRegion['Name'];
     $MarkUpRegion['MarkUp'][] = $resRegion['MarkUp'];
						  }
?>




<?
// РЕГИОНАЛЬНЫЙ ПРЕЙСКУРАНТ L.ID_TypeList = 2  ЯЧЕЙКИ

while($resPriceRegion = $myPriceRegion->Fetch())
{

	$myArrayRegion[$resPriceRegion['Numpp']][] = array("Numpp" => $resPriceRegion['Numpp'], "Name" => $resPriceRegion['Name']); 

}
?>



<div <?if (count($myArrayRegion)==0){ echo 'hidden="hidden"';}?>>
<br/>
<br/>

	<p class="price_titel">Региональный прейскурант</p>
 <table id="preskurant" border="1" bordercolor="gray" style="border-style:solid;">
   <tbody>
		  <tr>

		   <? for($ir = 0; $ir < count($arrRegion['Name']); $ir++): ?>

			  <? if(strpos($arrRegion['Name'][$ir],'|')!==false): ?>

               <? $arRegion = explode("|", $arrRegion['Name'][$ir]); ?>
			

                       <th><span class="header_table_price">
							<? for($jr = 0; $jr < count($arRegion); $jr++): ?>
							   <?if($jr + 1 < count($arRegion)):?>
							<p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px; border-color:gray;"><?=$arRegion[$jr]?></p>
								<?else:?>
							<p style="white-space:nowrap; padding:2px; border-color:gray;"><?=$arRegion[$jr]?></p>
  								<?endif;?>

							<?endfor;?>
						</span></th>

			   <?else:?>

					 <th><span class="header_table_price"><?=$arrRegion['Name'][$ir]?></th>

               <?endif;?>

			 <?endfor;?>
	      </tr>


	   <?for($dr = 0; $dr < count($myArrayRegion[1]); $dr++ ):?> 
           <tr>
			   <?foreach($myArrayRegion as $NumppRegion):?>

                  <? $myNameRegion = $NumppRegion[$dr]['Name']; ?>


                  <? if(strpos($myNameRegion,'|')!==false): ?>

                       <? $arrrRegion = explode("|", $myNameRegion); ?>
                          <td style="text-align:center;">
 							<? for($jr = 0; $jr < count($arrrRegion); $jr++): ?>
							   <?if($jr + 1 < count($arrrRegion)):?>
							   <p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px;  border-color:gray;"><?=$arrrRegion[$jr]?></p>
								<?else:?>
							   <p style="white-space:nowrap; padding:2px;  border-color:gray;"><?=$arrrRegion[$jr]?></p>
  								<?endif;?>

							<?endfor;?>
							</td>

			   <?else:?>


					<?$posRegion = strpos($myNameRegion, '^*');?>
	
				   <?if($posRegion === false):?>
				   <td style="text-align:center;"><?=$myNameRegion;?></td>
				   <?else:?>
					   <? $strrrRegion = str_replace("^*", "", $myNameRegion); ?>
					   <td style="text-align:center;"><b><?=$strrrRegion;?></b></td>
					<?endif;?>


                  <?endif;?>

               <?endforeach;?>

		  </tr>
        <?endfor;?>

	  </tbody>
</table>

<br>
<p><span class="price_prim_c">Примечание:</span>&nbsp;<span class="price_prim"><?=$MarkUpRegion['MarkUp'][0]; ?></span></p>
</div>



<? if(strcmp($Check_GorodFrom,"true") == 0):?>


<?
// Экспедирование по городу в пункте отправления
// ВНУТРИГОРОДСКОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 3 ШАПКА



    $myInGor = $DB->Query(
                " select L.ID as ID_List,
				   L.ID_Office,
				   L.ID_TypeList,
				   L.MarkUpShort,
				   L.MarkUp,
				   T.ID as ID_Top,
			
				   T.Numpp,
					T.Name
			from my_List as L
			inner join
			my_Top as T
			on L.ID = T.ID_List
			where L.ID_Office = " .$ID_from. " and L.ID_TypeList = 3
			order by L.ID_TypeList, T.Numpp"
            );
?>

<?

// ВНУТРИГОРОДСКОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 3  ЯЧЕЙКИ

 $myPriceInGor = $DB->Query(
  "select C.Name, C.Numpp
	from my_List as Li
	left join my_Line as L
	on Li.ID = L.ID_List
	left join my_Office as O
	on Li.ID_Office = O.ID
	left join my_Cell as C
	on C.ID_Line = L.ID
	where O.ID = " .$ID_from. " and 
  Li.ID_TypeList = 3
  order by O.Name, C.Numpp, L.ID" );

?>



<?
// ВНУТРИГОРОДСКОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 3 ШАПКА
while($resInGor = $myInGor->Fetch()){
     $arrInGor['Name'][] = $resInGor['Name'];
     $MarkUpInGor['MarkUp'][] = $resInGor['MarkUp'];
						  }
?>



<?
// ВНУТРИГОРОДСКОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 3  ЯЧЕЙКИ

while($resPriceInGor = $myPriceInGor->Fetch())
{

	$myArrayInGor[$resPriceInGor['Numpp']][] = array("Numpp" => $resPriceInGor['Numpp'], "Name" => $resPriceInGor['Name']); 

}
?>







<div <?if(count($myArrayInGor)==0){ echo 'hidden="hidden"';}?>>
<br/>
<br/>

	<p class="price_titel">Экспедирование по городу в пункте отправления</p>
 <table id="preskurant" border="1" bordercolor="gray" style="border-style:solid;">
   <tbody>
		  <tr>

		   <? for($ig = 0; $ig < count($arrInGor['Name']); $ig++): ?>

			  <? if(strpos($arrInGor['Name'][$ig],'|')!==false): ?>

               <? $arInGor = explode("|", $arrInGor['Name'][$ig]); ?>
			

                          <th><span class="header_table_price">
							<? for($jg = 0; $jg < count($arInGor); $jg++): ?>
							   <?if($jg + 1 < count($arInGor)):?>
							<p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px;  border-color:gray;"><?=$arInGor[$jg]?></p>
								<?else:?>
							<p style="white-space:nowrap; padding:2px;  border-color:gray;"><?=$arInGor[$jg]?></p>
  								<?endif;?>

							<?endfor;?>
						</span></th>

			   <?else:?>

                 <th><span class="header_table_price"><?=$arrInGor['Name'][$ig]?></span></th>

               <?endif;?>

			 <?endfor;?>
	      </tr>


	   <?for($dg = 0; $dg < count($myArrayInGor[1]); $dg++ ):?> 
           <tr>
             <?$col1 = 0;?>
			   <?foreach($myArrayInGor as $NumppInGor):?>

                  <? $myNameInGor = $NumppInGor[$dg]['Name']; ?>


                  <? if(strpos($myNameInGor,'|')!==false): ?>

                       <? $arrrInGor = explode("|", $myNameInGor); ?>
						<td style="<?if($col1 > 0){ echo "text-align:center;";} ?>">
 							<? for($jg = 0; $jg < count($arrrInGor); $jg++): ?>
							   <?if($jg + 1 < count($arrrInGor)):?>
							   <p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px;  border-color:gray;"><?=$arrrInGor[$jg]?></p>
								<?else:?>
							   <p style="white-space:nowrap; padding:2px;  border-color:gray;"><?=$arrrInGor[$jg]?></p>
  								<?endif;?>

							<?endfor;?>

							</td>
                      <?$col1 = $col1+1; ?>
			   <?else:?>


					<?$posInGor = strpos($myNameInGor, '^*');?>
	
				   <?if($posInGor === false):?>
					<td style="<?if($col1 > 0){ echo "text-align:center;";} ?>"> <?=$myNameInGor;?></td>
				   <?else:?>
					   <? $strrrInGor = str_replace("^*", "", $myNameInGor); ?>
					<td style="<?if($col1 > 0){ echo "text-align:center;";} ?>"><b><?=$strrrInGor;?></b></td>
					<?endif;?>

	              <?$col1 = $col1+1; ?>
                  <?endif;?>

               <?endforeach;?>

		  </tr>
        <?endfor;?>

	  </tbody>
</table>

<br>
   <p><span class="price_prim_c">Примечание:</span>&nbsp;<span class="price_prim"><?=$MarkUpInGor['MarkUp'][0]; ?></span></p>
</div>


<?endif;?>




<? if(strcmp($Check_GorodTo,"true") == 0):?>

<?
// Экспедирование по городу в пункте назначения
// ВНУТРИГОРОДСКОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 3 ШАПКА

    $myInGorTo = $DB->Query(
                " select L.ID as ID_List,
				   L.ID_Office,
				   L.ID_TypeList,
				   L.MarkUpShort,
				   L.MarkUp,
				   T.ID as ID_Top,
			
				   T.Numpp,
					T.Name
			from my_List as L
			inner join
			my_Top as T
			on L.ID = T.ID_List
			where L.ID_Office = " .$ID_to. " and L.ID_TypeList = 3
			order by L.ID_TypeList, T.Numpp"
            );
?>

<?

// ВНУТРИГОРОДСКОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 3  ЯЧЕЙКИ

 $myPriceInGorTo = $DB->Query(
  "select C.Name, C.Numpp
	from my_List as Li
	left join my_Line as L
	on Li.ID = L.ID_List
	left join my_Office as O
	on Li.ID_Office = O.ID
	left join my_Cell as C
	on C.ID_Line = L.ID
	where O.ID = " .$ID_to. " and 
  Li.ID_TypeList = 3
  order by O.Name, C.Numpp, L.ID" );

?>




<?
// ВНУТРИГОРОДСКОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 3 ШАПКА
while($resInGorTo = $myInGorTo->Fetch()){
     $arrInGorTo['Name'][] = $resInGorTo['Name'];
     $MarkUpInGorTo['MarkUp'][] = $resInGorTo['MarkUp'];
						  }
?>

<?
// ВНУТРИГОРОДСКОЙ ПРЕЙСКУРАНТ L.ID_TypeList = 3  ЯЧЕЙКИ

while($resPriceInGorTo = $myPriceInGorTo->Fetch())
{

	$myArrayInGorTo[$resPriceInGorTo['Numpp']][] = array("Numpp" => $resPriceInGorTo['Numpp'], "Name" => $resPriceInGorTo['Name']); 

}
?>







<div <?if(count($myArrayInGorTo)==0){ echo 'hidden="hidden"';}?>>
<br/>
<br/>

	<p class="price_titel">Экспедирование по городу в пункте назначения</p>
 <table id="preskurant" border="1" bordercolor="gray" style="border-style:solid;">
   <tbody>
		  <tr>

		   <? for($igTo = 0; $igTo < count($arrInGorTo['Name']); $igTo++): ?>

			  <? if(strpos($arrInGorTo['Name'][$igTo],'|')!==false): ?>

               <? $arInGorTo = explode("|", $arrInGorTo['Name'][$igTo]); ?>


                         <th><span class="header_table_price">
							<? for($jgTo = 0; $jgTo < count($arInGorTo); $jgTo++): ?>
							   <?if($jgTo + 1 < count($arInGorTo)):?>
							<p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px;  border-color:gray;"><?=$arInGorTo[$jgTo]?></p>
								<?else:?>
							<p style="white-space:nowrap; padding:2px;  border-color:gray;"><?=$arInGorTo[$jgTo]?></p>
  								<?endif;?>

							<?endfor;?>
							</span></th>

			   <?else:?>

<th><span class="header_table_price"><?=$arrInGorTo['Name'][$igTo]?></span></th>

               <?endif;?>

			 <?endfor;?>
	      </tr>


	   <?for($dgTo = 0; $dgTo < count($myArrayInGorTo[1]); $dgTo++ ):?> 
           <tr>
               <? $col1=0; ?>
			   <?foreach($myArrayInGorTo as $NumppInGorTo):?>

                  <? $myNameInGorTo = $NumppInGorTo[$dgTo]['Name']; ?>


                  <? if(strpos($myNameInGorTo,'|')!==false): ?>

                       <? $arrrInGorTo = explode("|", $myNameInGorTo); ?>
                           	<td style="<?if($col1 > 0){ echo "text-align:center;";} ?>">
 							<? for($jgTo = 0; $jgTo < count($arrrInGorTo); $jgTo++): ?>
							   <?if($jgTo + 1 < count($arrrInGorTo)):?>
							   <p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px;  border-color:gray;"><?=$arrrInGorTo[$jgTo]?></p>
								<?else:?>
							   <p style="white-space:nowrap; padding:2px;  border-color:gray;"><?=$arrrInGorTo[$jgTo]?></p>
  								<?endif;?>

							<?endfor;?>
							</td>
                   <? $col1=$col1 + 1; ?>
			   <?else:?>


					<?$posInGorTo = strpos($myNameInGorTo, '^*');?>
	
				   <?if($posInGorTo === false):?>
				    	<td style="<?if($col1 > 0){ echo "text-align:center;";} ?>"><?=$myNameInGorTo;?></td>
				   <?else:?>
					   <? $strrrInGorTo = str_replace("^*", "", $myNameInGorTo); ?>
					    	<td style="<?if($col1 > 0){ echo "text-align:center;";} ?>"><b><?=$strrrInGorTo;?></b></td>
					<?endif;?>

                <? $col1=$col1 + 1; ?>
                  <?endif;?>

               <?endforeach;?>

		  </tr>
        <?endfor;?>

	  </tbody>
</table>

<br>
   <p><span class="price_prim_c">Примечание:</span>&nbsp;<span class="price_prim"><?=$MarkUpInGorTo['MarkUp'][0]; ?></span></p>
</div>

<?endif;?>




<? if(strcmp($Check_DopServiceFrom,"true") == 0):?>

<?

// СЕРВЕСНЫЙ ПРЕЙСКУРАНТ В ПУНКТЕ ОТПРАВЛЕНИЯ L.ID_TypeList = 4 ШАПКА 

 
    $myService = $DB->Query(
                " select L.ID as ID_List,
				   L.ID_Office,
				   L.ID_TypeList,
				   L.MarkUpShort,
				   L.MarkUp,
				   T.ID as ID_Top,
			
				   T.Numpp,
					T.Name
			from my_List as L
			inner join
			my_Top as T
			on L.ID = T.ID_List
			where L.ID_Office = " .$ID_from. " and L.ID_TypeList = 4
			order by L.ID_TypeList, T.Numpp"
            );
?>

<?

// СЕРВBСНЫЙ ПРЕЙСКУРАНТ L.ID_TypeList = 4  ЯЧЕЙКИ
 $myPriceService = $DB->Query(
  "select C.Name, C.Numpp
	from my_List as Li
	left join my_Line as L
	on Li.ID = L.ID_List
	left join my_Office as O
	on Li.ID_Office = O.ID
	left join my_Cell as C
	on C.ID_Line = L.ID
	where O.ID = " .$ID_from. " and 
  Li.ID_TypeList = 4
  order by O.Name, C.Numpp, L.ID" );



?>



<?
// СЕРВЕСНЫЙ ПРЕЙСКУРАНТ L.ID_TypeList = 4 ШАПКА
while($resService = $myService->Fetch()){
     $arrService['Name'][] = $resService['Name'];
     $MarkUpService['MarkUp'][] = $resService['MarkUp'];
						  }
?>



<?
// СЕРВЕСНЫЙ ПРЕЙСКУРАНТ L.ID_TypeList = 4 ЯЧЕЙКИ

while($resPriceService = $myPriceService->Fetch())
{

	$myArrayService[$resPriceService['Numpp']][] = array("Numpp" => $resPriceService['Numpp'], "Name" => $resPriceService['Name']); 

}
?>



<div <?if(count($myArrayService)==0){ echo 'hidden="hidden"';}?>>

<br/>
<br/>


	<p class="price_titel">Дополнительный сервис в пункте отправления</p>
 <table id="preskurant" border="1" bordercolor="gray" style="border-style:solid;">
   <tbody>
		  <tr>

		   <? for($is = 0; $is < count($arrService['Name']); $is++): ?>

			  <? if(strpos($arrService['Name'][$is],'|')!==false): ?>

               <? $arService = explode("|", $arrService['Name'][$is]); ?>


                          <th><span class="header_table_price">
							<? for($js = 0; $js < count($arService); $js++): ?>
							   <?if($js + 1 < count($arService)):?>
							<p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px;  border-color:gray;"><?=$arService[$js]?></p>
								<?else:?>
							<p style="white-space:nowrap; padding:2px;  border-color:gray;"><?=$arService[$js]?></p>
  								<?endif;?>

							<?endfor;?>
						</span></th>

			   <?else:?>

					<th><span class="header_table_price"><?=$arrService['Name'][$is]?></span></th>

               <?endif;?>

			 <?endfor;?>
	      </tr>


	   <?for($ds = 0; $ds < count($myArrayService[1]); $ds++ ):?> 
           <tr>
               <?$col1=0?>
			   <?foreach($myArrayService as $NumppService):?>

                  <? $myNameService = $NumppService[$ds]['Name']; ?>


                  <? if(strpos($myNameService,'|')!==false): ?>

                       <? $arrrService = explode("|", $myNameService); ?>
                           	<td style="<?if($col1 > 0){ echo "text-align:center;";} ?>">
 							<? for($js = 0; $js < count($arrrService); $js++): ?>
							   <?if($js + 1 < count($arrrService)):?>
							   <p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px;  border-color:gray;"><?=$arrrService[$js]?></p>
								<?else:?>
							   <p style="white-space:nowrap; padding:2px;  border-color:gray;"><?=$arrrService[$js]?></p>
  								<?endif;?>

							<?endfor;?>
							</td>
                  <?$col1=$col1+1; ?>
			   <?else:?>


					<?$posService = strpos($myNameService, '^*');?>

				   <?if($posService === false):?>
				   	<td style="<?if($col1 > 0){ echo "text-align:center;";} ?>"><?=$myNameService;?></td>
				   <?else:?>
					   <? $strrrService = str_replace("^*", "", $myNameService); ?>
					   	<td style="<?if($col1 > 0){ echo "text-align:center;";} ?>"><b><?=$strrrService;?></b></td>
					<?endif;?>

                  <?$col1=$col1+1; ?>
                  <?endif;?>

               <?endforeach;?>

		  </tr>
        <?endfor;?>

	  </tbody>
</table>

<br>
 <p><span class="price_prim_c">Примечание:</span>&nbsp;<span class="price_prim"><?=$MarkUpService['MarkUp'][0]; ?></span></p>
</div>

<?endif;?>




<? if(strcmp($Check_DopServiceTo,"true") == 0):?>

<?

// СЕРВЕСНЫЙ ПРЕЙСКУРАНТ В ПУНКТЕ НАЗНАЧЕНИЯ L.ID_TypeList = 4 ШАПКА 

 
    $myServiceTo = $DB->Query(
                " select L.ID as ID_List,
				   L.ID_Office,
				   L.ID_TypeList,
				   L.MarkUpShort,
				   L.MarkUp,
				   T.ID as ID_Top,
			
				   T.Numpp,
					T.Name
			from my_List as L
			inner join
			my_Top as T
			on L.ID = T.ID_List
			where L.ID_Office = " .$ID_to. " and L.ID_TypeList = 4
			order by L.ID_TypeList, T.Numpp"
            );
?>

<?

// СЕРВBСНЫЙ ПРЕЙСКУРАНТ L.ID_TypeList = 4  ЯЧЕЙКИ
 $myPriceServiceTo = $DB->Query(
  "select C.Name, C.Numpp
	from my_List as Li
	left join my_Line as L
	on Li.ID = L.ID_List
	left join my_Office as O
	on Li.ID_Office = O.ID
	left join my_Cell as C
	on C.ID_Line = L.ID
	where O.ID = " .$ID_to. " and 
  Li.ID_TypeList = 4
  order by O.Name, C.Numpp, L.ID" );



?>

<?
// СЕРВЕСНЫЙ ПРЕЙСКУРАНТ L.ID_TypeList = 4 ШАПКА
while($resServiceTo = $myServiceTo->Fetch()){
     $arrServiceTo['Name'][] = $resServiceTo['Name'];
     $MarkUpServiceTo['MarkUp'][] = $resServiceTo['MarkUp'];
						  }
?>

<?
// СЕРВЕСНЫЙ ПРЕЙСКУРАНТ L.ID_TypeList = 4 ЯЧЕЙКИ

while($resPriceServiceTo = $myPriceServiceTo->Fetch())
{

	$myArrayServiceTo[$resPriceServiceTo['Numpp']][] = array("Numpp" => $resPriceServiceTo['Numpp'], "Name" => $resPriceServiceTo['Name']); 

}
?>



<div <?if(count($myArrayServiceTo)==0){ echo 'hidden="hidden"';}?>>

<br/>
<br/>


	<p class="price_titel">Дополнительный сервис в пункте назначения</p>
 <table id="preskurant" border="1" bordercolor="gray" style="border-style:solid;">
   <tbody>
		  <tr>

		   <? for($isTo = 0; $isTo < count($arrServiceTo['Name']); $isTo++): ?>

			  <? if(strpos($arrServiceTo['Name'][$isTo],'|')!==false): ?>

               <? $arServiceTo = explode("|", $arrServiceTo['Name'][$isTo]); ?>


                          <th><span class="header_table_price">
							<? for($jsTo = 0; $jsTo < count($arServiceTo); $jsTo++): ?>
							   <?if($jsTo + 1 < count($arServiceTo)):?>
							<p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px;  border-color:gray;"><?=$arServiceTo[$jsTo]?></p>
								<?else:?>
							<p style="white-space:nowrap; padding:2px;  border-color:gray;"><?=$arServiceTo[$jsTo]?></p>
  								<?endif;?>

							<?endfor;?>
						</span></th>

			   <?else:?>

					<th><span class="header_table_price"><?=$arrServiceTo['Name'][$isTo]?></span></th>

               <?endif;?>

			 <?endfor;?>
	      </tr>

	   <?for($dsTo = 0; $dsTo < count($myArrayServiceTo[1]); $dsTo++ ):?> 
           <tr>
				<? $col1=0; ?>
			   <?foreach($myArrayServiceTo as $NumppServiceTo):?>

                  <? $myNameServiceTo = $NumppServiceTo[$dsTo]['Name']; ?>


                  <? if(strpos($myNameServiceTo,'|')!==false): ?>

                       <? $arrrServiceTo = explode("|", $myNameServiceTo); ?>
                           	<td style="<?if($col1 > 0){ echo "text-align:center;";} ?>">
 							<? for($jsTo = 0; $jsTo < count($arrrServiceTo); $jsTo++): ?>
							   <?if($jsTo + 1 < count($arrrServiceTo)):?>
							   <p style="white-space:nowrap; border-bottom:solid; border-width:thin; padding:2px;  border-color:gray;"><?=$arrrServiceTo[$jsTo]?></p>
								<?else:?>
							   <p style="white-space:nowrap; padding:2px;  border-color:gray;"><?=$arrrServiceTo[$jsTo]?></p>
  								<?endif;?>

							<?endfor;?>
							</td>
               <? $col1=$col1+1; ?>
			   <?else:?>


					<?$posServiceTo = strpos($myNameServiceTo, '^*');?>

				   <?if($posServiceTo === false):?>
				   <td style="<?if($col1 > 0){ echo "text-align:center;";} ?>"><?=$myNameServiceTo;?></td>
				   <?else:?>
					   <? $strrrServiceTo = str_replace("^*", "", $myNameServiceTo); ?>
					<td style="<?if($col1 > 0){ echo "text-align:center;";} ?>"><b><?=$strrrServiceTo;?></b></td>
					<?endif;?>

                 <? $col1=$col1+1; ?>
                  <?endif;?>

               <?endforeach;?>

		  </tr>
        <?endfor;?>

	  </tbody>
</table>

<br>
 <p><span class="price_prim_c">Примечание:</span>&nbsp;<span class="price_prim"><?=$MarkUpServiceTo['MarkUp'][0]; ?></span></p>
</div>


<?endif;?>



<br/>
<br/>




