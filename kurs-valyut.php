<? // подключение API Bitrix
 require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php" ;


function GetValute2(){

	$valuta=file_get_contents($_SERVER["DOCUMENT_ROOT"]."/currentkurs.txt");

return $valuta;
}

echo  GetValute2();


?>


