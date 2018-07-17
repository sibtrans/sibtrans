<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Перевозки");
?>
<div class="pw">
	<div class="lc bm transport">
		<div class="filter">
			<form method="POST" id="transport_filter">
			<input type="hidden" name="un" value="<?=$un;?>" />
			<input class="custom" type="radio" name="type" value="current" id="type_current"/><label for="type_current">Текущие перевозки</label>
			<input class="custom" type="radio" name="type" value="archieve" id="type_archieve"/><label for="type_archieve">История перевозок</label>
		
			<div class="clear"></div>
			<div class="flt_archieve">
				<table>
					<tr>
						<td>Дата начала:</td>
						<td><input type="text" class="ServiceInput form-input" name="date_from" placeholder="___.___.______"/></td>
						<td>Дата окончания</td>
						<td><input type="text" class="ServiceInput form-input" name="date_to" placeholder="___.___.______"/></td>
						<td></td>
					</tr>
						<td>Отправитель:</td>
						<td><input type="text" class="ServiceInput form-input" name="sender"/></td>
						<td>Получатель:</td>
						<td><input type="text" class="ServiceInput form-input" name="recipient"/></td>
						<td></td>
					<tr>
					</tr>
					<tr>
						<td>Город отправления:</td>
						<td><input type="text" class="ServiceInput form-input" name="city_from"/></td>
						<td>Город назначения:</td>
						<td><input type="text" class="ServiceInput form-input" name="city_to"/></td>
						<td><input type="button" class="custom red" value="Показать" /></td>
					</tr>
				</table>
			</div>
			</form>
		</div>
		<table class="result">
			<tr>
				<th></th>
				<th>Пункт отправления<br/>Пункт назначения</th>
				<th>Отправитель<br/>Получатель<br/>Плательщик</th>
				<th>Количество мест<br/>Вес<br/>Объем</th>
				<th>№ ТТН</th>
				<th>Принят к перевозке</th>
				<th>Ориентировочная дата прибытия в пункт назначения</th>
				<th>Статус груза</th>
				<th>Груз выдан получателю в пункте назначения</th>
				<th>Документы</th>
			</tr>
		</table>
        <label class="payer" style="display: none"><?=$uInfo["fullname"];?></label>
        <!-- <script>
            isPayer();
            function isPayer() {
                window.setTimeout(function () {
                    var table_payer = $(".table_payer").text().toUpperCase().replace(/\s/g, '').replace(/['"«»]/g, '');
                    var payer = $(".payer").text().toUpperCase().replace(/\s/g, '').replace(/['"«»]/g, '');
                    if (payer.indexOf(table_payer)=== -1) {
                        $(".docc").prop('onclick',null).off('click');
                    }
                    isPayer();
                }, 400)
            }
        </script> -->
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>