
<? require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php" ?>

<?


if(!empty($_POST["referal"]))
{ //Принимаем данные

    $referal = trim(strip_tags(stripcslashes(htmlspecialchars($_POST["referal"]))));

 global $DB;

 $offices = $DB->Query("select O.Name as name, O.ID from my_Office as O  WHERE O.Name LIKE '%".$referal."%'"." order by O.Name");

         while($row = $offices->Fetch()){
         echo "\n<li>".$row["name"]."</li>"; //$row["name"] - имя поля таблицы

    }


}
?>