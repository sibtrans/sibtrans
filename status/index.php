<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Статус перевозки");
$id=trim(strip_tags(htmlspecialchars(strip_data($_GET["n"]))));
$result=getDeliveryStatus($id);
$xml=simplexml_load_string($result);

?>

<br/>
<br/>
<br/>
<br/>

<div class="pw" style="width: 1100px;">
	<h2 class="page-title">Статус перевозки</h2>
	<table class="status-result colored">
		<tr>
			<th>№</th>
			<th>Дата</th>
			<th>Информация</th>
		</tr>
	<?foreach($xml as $row):
		$i++;
		$row=(array)$row;
		$dt=strtotime($row["dact"]);
		$act=$row["cact"];
	?>
		<tr>
			<td><?=$i;?></td>
			<td><?=($dt)?date("d.m.Y",$dt):"";?></td>
			<td><?=$act;?></td>
		</tr>
	<?endforeach;?>
	</table>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>