<? // подключение API Bitrix
 require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php" 
?>

<? CModule::IncludeModule("iblock"); ?>


<?

function number($n, $titles) {
  $cases = array(2, 0, 1, 1, 1, 2);
  return $titles[($n % 100 > 4 && $n % 100 < 20) ? 2 : $cases[min($n % 10, 5)]];
}

	$city = $_POST["selected"][0]["value"];

	$arSelect = Array("IBLOCK_ID","NAME","TRANSLIT","ID");

	$arFilter = Array("IBLOCK_ID"=>"1", "NAME" => $city."%");

	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);


$count_filials = 0;
$translit = "";
$city = "";
$Yandex_X = 0;
$Yandex_Y = 0;

	while($ob = $res->GetNextElement())
	{
		 $arFields = $ob->GetFields();

		// print_r($arFields);

		$arProps = $ob->GetProperties();


    //Разбиваем координаты яндекс карты на X и Y координату
		 $Yandex = explode(",", $arProps["YANDEX_MAP"]["VALUE"]);
		 $Yandex_X = $Yandex[0];
		 $Yandex_Y = $Yandex[1];


		$city =  $arFields["NAME"];

		$count_filials = $count_filials + 1;
	}

//	$_SESSION['data-adress'] = $count_filials;
//	$_SESSION['data-city'] = $city;


echo '<a data-city="'.$city.'" data-adress="'.$count_filials.'" href="../maps/Russia.php?x='.$Yandex_X.'&y='.$Yandex_Y.'&zoom=11&City='.$city.'&count='.$count_filials.' ">'.$count_filials.' '.number($count_filials, array('адрес', 'адреса', 'адресов')).' '.'в '.$city.'</a>';

?> 

