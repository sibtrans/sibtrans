<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявки");
?>
<div class="pw">
	<div class="lc bm requests">
		<div class="filter">
			<form method="POST" id="requests_filter">
				<input type="hidden" name="un" value="<?=$un;?>" />
				<input type="hidden" name="ss_code" value="<?=$ss_code;?>" />
				<div class="flt_archieve">
					<table>
					<tr>
						<td>Дата начала:</td>
						<td><input type="text" class="ServiceInput form-input" name="data_1" placeholder="___.___.______"/></td>
						<td>Дата окончания</td>
						<td><input type="text" class="ServiceInput form-input" name="data_2" placeholder="___.___.______"/></td>
						<td></td>
						<td><input type="button" class="custom red" value="Показать" /></td>
					</tr>
				</table>
				</div>
			</form>
		</div>
		<table class="result">
			<tr>
				<th></th>
				<th>№ документа</th>
				<th>Дата документа</th>
				<th>Статус</th>
				<th>Маршрут</th>
				<th>Плательщик</th>
				<th>Грузоотправитель</th>
				<th>Грузополучатель</th>
				<th>Флаг: «есть экспедирование»</th>
				<th>Дата и время доставки груза клиентом</th>
				<th></th>
			</tr>
		</table>
	</div>
</div><div class="spec_symvols"><div class="spec_yeas">Да</div><div class="spec_no">Нет</div><div class="no_data">Нет данных за период</div><div class="replaceRequest">Повторить</div><div class="unit">шт</div></div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>