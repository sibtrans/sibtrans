<?
	define("NO_KEEP_STATISTIC", true); //Не учитываем статистику
	define("NOT_CHECK_PERMISSIONS", true); //Не учитываем права доступа
	define ("NEED_AUTH", true);
	require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
	header('Content-Type: text/html; charset=utf-8', true);
	$type=$_GET['type'];
	$rsUser = CUser::GetList(($by="ID"), ($order="asc"), array("ID"=>$USER->GetID()), array("SELECT"=>array("UF_UN")))->Fetch();
	if($rsUser["UF_UN"]=="")die('Не присвоен уникальный номер клиента');
	$template="Неизвестная операция";
	?>
	<?
	switch($type){
		case "act_sverki":
			$ds=$_GET['ds'];$de=$_GET['de'];
			if(($ds=="")||($de==""))die('Неверная дата');
			$r=requestSoap("GetSverka",array($rsUser["UF_UN"],$_GET["ds"],$_GET["de"]));
			$result=json_decode(json_encode(new SimpleXMLElement($r)),TRUE);
			$info=requestSoap("KLInfo",array($_GET["un"]));
			$info=json_decode(json_encode(new SimpleXMLElement($info)),TRUE);;
			$info=$info["klc"];
			$result=$result["sverka"];
			$template=file_get_contents("./templates/act_sverki.html");
			$template=str_replace("{DATE_CHECK1}",$_GET['ds'],$template);
			$template=str_replace("{DATE_CHECK2}",$_GET['de'],$template);
			$template=str_replace("{INN_KPP_SHIPPER}",$result[0]["innkpp"],$template);
			$template=str_replace("{NAMeSHIPPER}",$info["org"]." ".$info["fullname"],$template);
			$rows="<tr>";
			$rows.="<td>".$result[0]["firmp"]."</td>";
			$rows.="<td>".$result[0]["itogo"]."</td>";
			$rows.="<td></td>";
			$rows.="<td></td>";
			$rows.="<td></td>";
			$rows.="<tr>";
			$sc2=0;
			$sc3=0;
			for($i=1;$i<count($result);$i++){
				$rows.="<tr>";
				$rows.="<td>".$result[$i]["firmp"]."</td>";
				$rows.="<td>".$result[$i]["sitogo"]."</td>";
				$rows.="<td>".$result[$i]["sprihod"]."</td>";
				$rows.="<td></td>";
				$rows.="<td></td>";
				$rows.="</tr>";
				$sc2+=$result[$i]["sitogo"];
				$sc3+=$result[$i]["sprihod"];
			}
			$template=str_replace("{ROWS}",$rows,$template);
			$template=str_replace("{SUM_COL2}",$sc2,$template);
			$template=str_replace("{SUM_COL3}",$sc3,$template);
			$itg=(-($result[0]["itogo"])-$sc2)+$sc3;
			$template=str_replace("{SUM_DIFFERENCE}",$itg,$template);
			break;
		case "schet":
			$un=$_GET['sch'];
			if(($un==""))die('Неверные параметры');
			$r=requestSoap("GetInvoice",array($un));
			$result=json_decode(json_encode(new SimpleXMLElement($r)),TRUE);
			$result=$result[array_keys($result)[0]];
			if((array_keys($result)[0])!="0"){
			 $result=array(0=>$result);
			 }
			$template=file_get_contents("./templates/schet.html");
			$template=str_replace("{SUM_ALL}",$result[0]["sums"],$template);
			$template=str_replace("{FIO_BOSS}",$result[0]["prez"],$template);
			$template=str_replace("{FIO_BUH}",$result[0]["buh"],$template);
			$template=str_replace("{NAME_BANK}",$result[0]["bank"],$template);
			$template=str_replace("{GOROD_BANK}",$result[0]["rbankcity"],$template);
			$template=str_replace("{INN_KPP}",$result[0]["inn"],$template);
			$template=str_replace("{BIK}",$result[0]["bik"],$template);
			$template=str_replace("{KORR_SCHET}",$result[0]["kc"],$template);
			$template=str_replace("{SELLER}",$result[0]["pred"],$template);
			$template=str_replace("{RASCH_SCHET}",$result[0]["pc"],$template);
			$template=str_replace("{N_SHET}",$result[0]["nschet"],$template);
			$template=str_replace("{D_SHET}",$result[0]["datsch"],$template);
			$template=str_replace("{ADDRESS_SELLER}",$result[0]["adrpred"],$template);
			$template=str_replace("{NAMeSHIPPER}",$result[0]["sender"],$template);
			$template=str_replace("{CARGO_TYPE}",$result[0]["chgr"],$template);
			$template=str_replace("{NUMBER_PIECES}",$result[0]["q"],$template);
			$template=str_replace("{WEIGHT}",$result[0]["p"],$template);
			$template=str_replace(",{SHIPPER_ADRESS}","",$template);
			$template=str_replace("{NAMeBUYER}",$result[0]["payer"],$template);
			$template=str_replace("{NAMeCONSIGNEE}",$result[0]["payee"],$template);
			$template=str_replace("{SUMMA_TEXT}",$result[0]["rstroc"],$template);
			
			$rows="";
			$s=0;
			$n=0;
			foreach($result as $val){
				foreach($val as $k=>$v){
					if((is_array($v))&&(count($v)==0))$val[$k]="";
				}
				$rows.="<tr>";
				$rows.="<td>".$val["usl"]."</td>";
				$rows.="<td>".$val["ed"]."</td>";
				$rows.="<td>".$val["kol"]."</td>";
				$rows.="<td>".$val["cena"]."</td>";
				$rows.="<td>".$val["s1"]."</td>";
				$rows.="<td>".$val["nds1"]."%</td>";
				$rows.="<td>".$val["snds"]."</td>";
				$rows.="<td>".$val["s"]."</td>";
				$rows.="</tr>";
				$s+=$val["s1"];
				$n+=$val["snds"];
			}
			$template=str_replace("{SUMMA}",$s,$template);
			$template=str_replace("{SUmNALOG}",$n,$template);
			$template=str_replace("{SUmYNALOG}",$result[0]["sums"],$template);
			$template=str_replace(",{BUYER_ADRESS}","",$template);
			$template=str_replace(",{CONSIGNEE_ADRESS}","",$template);
			$template=str_replace("{ROWS}",$rows,$template);
			// $template=str_replace("{}",$result[""],$template);
			// $template=str_replace("{}",$result[""],$template);
			// $template=str_replace("{}",$result[""],$template);
			
			break;
		case "ttn":
			$un=$_GET['ttn'];
			if(($un==""))die('Неверные параметры');
			$r=requestSoap("MDetail",array($un));
			$result=json_decode(json_encode(new SimpleXMLElement($r)),TRUE);
			$result=$result[array_keys($result)[0]];
			$template=file_get_contents("./templates/ttn.html");
			$template=str_replace("{DEPARTURE_POINT}",$result["pot"],$template);
			$template=str_replace("{DESTINATION_POINT}",$result["pnaz"],$template);
			$template=str_replace("{SENDER}",$result["firmo"],$template);
			$template=str_replace("{CONSIGNEE}",$result["firmp"],$template);
			$template=str_replace("{PAYER}",$result["firpl"],$template);
			$template=str_replace("{D_INPUTDB}",$result["datav"],$template);
			$template=str_replace("{FIO_OPERATOR}",$result["oper"],$template);
			$template=str_replace("{D_RECEIVE}",$result["pot"],$template);
			$template=str_replace("{CARGO_TYPE}",$result["chgr"],$template);
			$template=str_replace("{PRICE_VOL}",$result["cenav"],$template);
			$template=str_replace("{PRICE_WEI}",$result["cenap"],$template);
			$template=str_replace("{F_MEST}",$result["q"],$template);
			$template=str_replace("{W_MEST}",$result["qtpl"],$template);
			$template=str_replace("{O_MEST}",$result["qneg"],$template);
			$template=str_replace("{H_MEST}",$result["qhrup"],$template);
			$template=str_replace("{F_VOL}",$result["vttn"],$template);
			$template=str_replace("{W_VOL}",$result["vtpl"],$template);
			$template=str_replace("{O_VOL}",$result["vneg"],$template);
			$template=str_replace("{H_VOL}",$result["vhrup"],$template);
			$template=str_replace("{F_WEI}",$result["phrup"],$template);
			$template=str_replace("{W_WEI}",$result["ptpl"],$template);
			$template=str_replace("{O_WEI}",$result["pneg"],$template);
			$template=str_replace("{H_WEI}",$result["vhrup"],$template);
			$template=str_replace("{S_AO}",$result["savtom"],$template);
			$template=str_replace("{S_EO}",$result[""],$template);
			$template=str_replace("{S_AP}",$result["savton"],$template);
			$template=str_replace("{S_EP}",$result[""],$template);
			$template=str_replace("{SUM_DEP}",$result["sdopm"],$template);
			$template=str_replace("{SUM_ARR}",$result["sdopn"],$template);
			$template=str_replace("{SUM_PAY}",$result["itogo"],$template);
			$template=str_replace("{PAID}",$result["sopl"],$template);
			$template=str_replace("{TTN_NOTE}",$result["prim"],$template);
			$template=str_replace("{NTTN}",$result["vagr"],$template);
			$template=str_replace("{POINT_DEPAR}",$result["pot"],$template);
			$template=str_replace("{POINT_ARRI}",$result["pnaz"],$template);
			break;
		case "schetf":
			$un=$_GET['schf'];
			if(($un==""))die('Неверные параметры');
			$r=requestSoap("GetPakt",array($un));
			$result=json_decode(json_encode(new SimpleXMLElement($r)),TRUE);
			$result=$result[array_keys($result)[0]];
			if((array_keys($result)[0])!="0"){
			 $result=array(0=>$result);
			 }
			$template=file_get_contents("./templates/schetf.html");
			$template=str_replace("{SELLER}",$result[0]["seller"],$template);
			$template=str_replace("{ADDRESS_SELLER}",$result[0]["adrseller"],$template);
			$template=str_replace("{INN_KPP_SELLER}",$result[0]["innseller"],$template);
			$template=str_replace("{NSCH}",$result[0]["nschet"],$template);
			$template=str_replace("{D_NSCH}",$result[0]["datsch"],$template);
			$template=str_replace("{NAMeSHIPPER}, {SHIPPER_ADRESS}","-",$template);
			$template=str_replace("{NAMeCONSIGNEE}, {CONSIGNEE_ADRESS}",$result[0]["payee"],$template);
			$template=str_replace("{NPLAT_RASCHET_DOC} от {D_NPLAT}",$result[0]["nplat"],$template);
			$template=str_replace("{NAMeBUYER}",$result[0]["payer"],$template);
			$template=str_replace("{BUYER_ADRESS}",$result[0]["adrpayer"],$template);
			$template=str_replace("{INN_KPP_BUYER}",$result[0]["innpayer"],$template);
			$template=str_replace("{NAME_FOREX}, {KOD_FOREX}","Российский рубль, 643",$template);
			$template=str_replace("{SELLER}",$result[0]["seller"],$template);
			$template=str_replace("{FIO_BOSS}",$result[0]["prez"],$template);
			$template=str_replace("{FIO_BUH}",$result[0]["buh"],$template);
			$rows="";
			$s=0;
			$n=0;
			foreach($result as $val){
				foreach($val as $k=>$v){
					if((is_array($v))&&(count($v)==0))$val[$k]="";
				}
				$rows.="<tr>";
				$rows.="<td>".$val["usl"]."</td>";
				$rows.="<td>"."</td>";
				$rows.="<td>".$val["ed"]."</td>";
				$rows.="<td>".$val["kol"]."</td>";
				$rows.="<td>".$val["cena"]."</td>";
				$rows.="<td>".$val["s1"]."</td>";
				$rows.="<td>"."</td>";
				$rows.="<td>".$val["nds1"]."%</td>";
				$rows.="<td>".$val["snds"]."</td>";
				$rows.="<td>".$val["s"]."</td>";
				$rows.="<td>"."</td>";
				$rows.="<td>"."</td>";
				$rows.="<td>"."</td>";
				$rows.="</tr>";
				$s+=$val["s"];
				$n+=$val["snds"];
				$s1+=$val["s1"];
			}
			//$template=str_replace("{SUMMA}",$s,$template);
			$template=str_replace("{SUmNALOG}",$n,$template);
			$template=str_replace("{SUmNNALOG}",$s,$template);
			$template=str_replace("{SUmYNALOG}",$s1,$template);
			$template=str_replace("{ROWS}",$rows,$template);
			break;
		case "request":
			
			$r = getUserRequest($_GET['un'], $_GET['ss_code'], $_GET['code_1c']);
			$result = json_decode($r, true);
			
			/*echo "<br />";
			echo "<pre>";
			print_r($result);
			echo "</pre>";
			echo "<br /><br />";*/
			
			$template=file_get_contents("./templates/request.html");
			
			$template=str_replace("{doc_num}",$result["doc_num"],$template);
			
			//if($result["shipings"])
			
			$template=str_replace("{tarif}",$result["shipings"][0]["main_service"][0]["tarif"],$template);
			$template=str_replace("{doc_barcode}",$result["doc_barcode"],$template);
			$template=str_replace("{departure}",$result["shipings"][0]["departure"],$template);
			$template=str_replace("{destination}",$result["shipings"][0]["destination"],$template);
			$template=str_replace("{short_Name1}",$result["shipings"][0]["countragents"][1]['short_Name'],$template);
			$template=str_replace("{short_Name2}",$result["shipings"][0]["countragents"][2]['short_Name'],$template);
			$template=str_replace("{inn1}",$result["shipings"][0]["countragents"][1]['inn'],$template);
			$template=str_replace("{inn2}",$result["shipings"][0]["countragents"][2]['inn'],$template);
			$template=str_replace("{phone_1}",$result["shipings"][0]["countragents"][1]["contacts"][0]['phone_1'],$template);
			$template=str_replace("{phone_2}",$result["shipings"][0]["countragents"][2]["contacts"][0]['phone_1'],$template);
			$template=str_replace("{address1}",$result["shipings"][0]["countragents"][1]['address'],$template);
			$template=str_replace("{address2}",$result["shipings"][0]["countragents"][2]['address'],$template);
			$template=str_replace("{short_Name3}",$result["shipings"][0]["countragents"][0]['short_Name'],$template);
			$template=str_replace("{address3}",$result["shipings"][0]["countragents"][0]['address'],$template);
			$template=str_replace("{inn3}",$result["shipings"][0]["countragents"][0]['inn'],$template);
			$template=str_replace("{phone_3}",$result["shipings"][0]["countragents"][0]["contacts"][0]['phone_1'],$template);
			
			if(count($result["shipings"][0]["cargos"]) > 0){
				$strNames   = '';
				$placesMain = '';
				$weightMain = '';
				$amountMain = '';
				
				$places1    = '';
				$weight1    = '';
				$amount1    = '';
				
				$places2    = '';
				$weight2    = '';
				$amount2    = '';
				
				$places3    = '';
				$weight3    = '';
				$amount3    = '';
				
				foreach($result["shipings"][0]["cargos"] as $key => $val){
					
					$strNames .= $val['character'].', ';
					
					if($val['places'] != ''){
						$placesMain += $val['places'];
					}
					if($val['weight'] != ''){
						$weightMain += $val['weight'];
					}
					if($val['amount'] != ''){
						$amountMain += $val['amount'];
					}
					
					foreach($val['mark_ups'] as $key2 => $arrVal){
						if($key2 <= 2){
							if($key2 == 0){
								if($arrVal['pwa']['places'] != ''){
									$places1 += $arrVal['pwa']['places'];
								}
								if($arrVal['pwa']['weight'] != ''){
									$weight1 += $arrVal['pwa']['weight'];
								}
								if($arrVal['pwa']['amount'] != ''){
									$amount1 += $arrVal['pwa']['amount'];
								}
							}
							if($key2 == 1){
								if($arrVal['pwa']['places'] != ''){
									$places2 += $arrVal['pwa']['places'];
								}
								if($arrVal['pwa']['weight'] != ''){
									$weight2 += $arrVal['pwa']['weight'];
								}
								if($arrVal['pwa']['amount'] != ''){
									$amount2 += $arrVal['pwa']['amount'];
								}
							}
							if($key2 == 2){
								if($arrVal['pwa']['places'] != ''){
									$places3 += $arrVal['pwa']['places'];
								}
								if($arrVal['pwa']['weight'] != ''){
									$weight3 += $arrVal['pwa']['weight'];
								}
								if($arrVal['pwa']['amount'] != ''){
									$amount3 += $arrVal['pwa']['amount'];
								}
							}
						}
					}
				}
				$strNames = substr($strNames,0,-2);
				
				$template=str_replace("{character}",$strNames,$template);
				$template=str_replace("{places}",$placesMain,$template);
				$template=str_replace("{weight}",$weightMain,$template);
				$template=str_replace("{amount}",$amountMain,$template);
				$template=str_replace("{places1}", $places3,$template);
				$template=str_replace("{weight1}", $weight3,$template);
				$template=str_replace("{amount1}", $amount3,$template);
				$template=str_replace("{places2}", $places1,$template);
				$template=str_replace("{weight2}", $weight1,$template);
				$template=str_replace("{amount2}", $amount1,$template);
				$template=str_replace("{places3}", $places2,$template);
				$template=str_replace("{weight3}", $weight2,$template);
				$template=str_replace("{amount3}", $amount2,$template);
			}else{
				$template=str_replace("{character}",$result["shipings"][0]["cargos"][0]['character'],$template);
				$template=str_replace("{places}",$result["shipings"][0]["cargos"][0]['places'],$template);
				$template=str_replace("{weight}",$result["shipings"][0]["cargos"][0]['weight'],$template);
				$template=str_replace("{amount}",$result["shipings"][0]["cargos"][0]['amount'],$template);
				$template=str_replace("{places1}",$result["shipings"][0]["cargos"][0]['mark_ups'][2]['pwa']['places'],$template);
				$template=str_replace("{weight1}",$result["shipings"][0]["cargos"][0]['mark_ups'][2]['pwa']['weight'],$template);
				$template=str_replace("{amount1}",$result["shipings"][0]["cargos"][0]['mark_ups'][2]['pwa']['amount'],$template);
				$template=str_replace("{places2}",$result["shipings"][0]["cargos"][0]['mark_ups'][0]['pwa']['places'],$template);
				$template=str_replace("{weight2}",$result["shipings"][0]["cargos"][0]['mark_ups'][0]['pwa']['weight'],$template);
				$template=str_replace("{amount2}",$result["shipings"][0]["cargos"][0]['mark_ups'][0]['pwa']['amount'],$template);
				$template=str_replace("{places3}",$result["shipings"][0]["cargos"][0]['mark_ups'][1]['pwa']['places'],$template);
				$template=str_replace("{weight3}",$result["shipings"][0]["cargos"][0]['mark_ups'][1]['pwa']['weight'],$template);
				$template=str_replace("{amount3}",$result["shipings"][0]["cargos"][0]['mark_ups'][1]['pwa']['amount'],$template);
			}
			
			
			$insert_ervices_dop = '';
			$coll_insert_ervices_dop = 3;
			
			$template=str_replace("{spec_height}", "100px;",$template);
			if(count($result["shipings"][0]["services"][0]["service_in"]) > 0){
				
				$coll = count($result["shipings"][0]["services"][0]["service_in"]);
				$collNoQoantity = 0;
				
				
				foreach($result["shipings"][0]["services"][0]["service_in"] as $key=>$val){
					if($val['quantity'] != 0){
						
						$quantity = '';
						if($val['unit'] == 'шт'){
							$quantity = $val['quantity'];
							$val['quantity'] = '';
						}
						
						$insert_ervices_dop .= '<TR CLASS=R3>
							<TD CLASS="R17C2" COLSPAN=2>'.$val['name'].'</TD>
							<TD CLASS="R16C5"><SPAN>'.$quantity.'</SPAN></TD>
							<TD CLASS="R16C5"><SPAN></SPAN></TD>
							<TD CLASS="R16C5"><SPAN></SPAN></TD>
							<TD CLASS="R16C5"><SPAN>'.$val['quantity'].'</SPAN></TD>
							<TD CLASS="R16C5"><SPAN></SPAN></TD>
							<TD CLASS="R16C5"><SPAN></SPAN></TD>
							<TD></TD></TR>';
						$collNoQoantity++;
					}
					
				}
				$coll_insert_ervices_dop += $collNoQoantity;
			}
			
			//doc_rezerve2
			$template=str_replace("{doc_rezerve2}",$result["doc_rezerve2"],$template);
			$template=str_replace("{colservices}",$coll_insert_ervices_dop,$template);
			$template=str_replace("{insert_ervices_dop}",$insert_ervices_dop,$template);
			
			$template=str_replace("{address4}",$result["shipings"][0]["expedition"][0]["address"],$template);	
			$template=str_replace("{address5}",$result["shipings"][0]["expedition"][1]["address"],$template);
			$template=str_replace("{fio4}",$result["shipings"][0]["expedition"][0]["contacts"][0]["fio"],$template);
			$template=str_replace("{fio5}",$result["shipings"][0]["expedition"][1]["contacts"][0]["fio"],$template);
			$template=str_replace("{phone_4}",$result["shipings"][0]["expedition"][0]["contacts"][0]["phone_1"],$template);
			$template=str_replace("{phone_5}",$result["shipings"][0]["expedition"][1]["contacts"][0]["phone_1"],$template);
			
			$template=str_replace("{data_expedition4}",$result["shipings"][0]["expedition"][0]["data_expedition"],$template);	
			$template=str_replace("{data_expedition5}",$result["shipings"][0]["expedition"][1]["data_expedition"],$template);
			
			$template=str_replace("{time_expedition4}",$result["shipings"][0]["expedition"][0]["time_expedition"],$template);	
			$template=str_replace("{time_expedition5}",$result["shipings"][0]["expedition"][1]["time_expedition"],$template);
			
			
			//{phone_4}
			break;
		default:
			break;
	}
	
echo $template;
?>