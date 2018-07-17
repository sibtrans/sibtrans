<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Калькулятор (макси)");
?>
<div class="pw relative">

	<br/><br/><br/><br/><br/><br/>
   <h2 class="page-title">Расчитать стоимость</h2>
	<div id="max_calc_result">
		<p class="title">Результаты расчета</p>
		<div class="wrp">
			<p id="marshrut">Москва - Новосибирск</p>
			<table id="result" border="1" cellspacing="1">
				<tr>
					<th>Категория скорости</th>
					<th>Срок доставки</th>
					<th>Стоимость</th>
				</tr>
				<tr>
					<td>321</td>
					<td>2</td>
					<td>3</td>
				</tr>
				<tr>
					<td>4</td>
					<td>5</td>
					<td>6</td>
				</tr>
			</table>
			<a href="#">Посмотреть прайс-лист</a>
			<p>Обращаем Ваше внимание</p>
			<p>не могу разобрать текст</p>
			
		</div>
		
	</div>
	<div id="max_calc">
		<div class="row">
			<div class="d2l">
				<p class="sect_title required">Пункт отправления</p>
				<select name="f_from">
				</select>
				<div class="mla">
					<input type="checkbox" data-show=".next"/><label>забрать груз отправителя</label>
					<div class="data-show-content">
						<label>Адрес грузоотправителя</label><br/>
						<input type="text"/>
					</div>
				</div>
			</div>
			<div class="d2r">
				<p class="sect_title required">Пункт назначения</p>
				<select name="f_to">
				</select>
				<div class="mla">
					<input type="checkbox" data-show=".next"/><label>доставить груз получателю</label>
					<div class="data-show-content">
						<label>Адрес грузополучателя</label><br/>
						<input type="text"/>
					</div>
				</div>
			</div>
		</div>
		<hr/>
		<div class="row">
			<p class="sect_title">Параметры груза</p>
			<div class="place" id="place_0">
				<div class="row">
					<div class="d2l">
						<div class="place_num">1 место</div>
						<label class="required" for="ch_0">Характер груза</label>
						<select name="ch_0" id="ch_0"></select>
						<div class="mla">
							<div class="row">
								<div class="d3">
									<label class="required">Вес</label><br/>
									<input type="text" />
								</div>
								<div class="d3">
									<label class="required">Объем</label><br/>
									<input type="text" />
								</div>
								<div class="d3">
									<label class="required">Мест</label><br/>
									<input type="text" />
								</div>
							</div>
							<p class="msect_title">Особые условия транспортировки</p>
							<input type="checkbox" /><label>Тепловой</label><br/>
							<input type="checkbox" /><label>Негабарит</label><br/>
							<input type="checkbox" /><label>Хрупкий</label><br/>
						</div>
					</div>
				</div>
				<p class="sect_title">Дополнительный сервис</p>
				<div class="row">
					<div class="d2l">
						<input type="checkbox" data-show=".next" /><label>в пункте отправления</label>
						<div class="data-show-content mla">
							<input type="checkbox" /><label>Погрузо-разгрузочные работы</label><br/>
							<input type="checkbox" /><label>Упаковка стретчпленкой</label><br/>
							<input type="checkbox" /><label>Упаковка в полипропиленовый мешок под пломбу</label><br/>
							<input type="checkbox" /><label>Паллетирование</label><br/>
							<input type="checkbox" /><label>Маркировка груза при отправлении</label><br/>
							<input type="checkbox" /><label>Консолидация груза для отправки в одной партии</label><br/>
							<input type="checkbox" /><label>Прием груза после 17:30 часов (по предварительной заявке)</label><br/>
							<input type="checkbox" /><label>Изготовление деревянной обрешетки</label><br/>
							<input type="checkbox" /><label>Выдача дубликатов</label><br/>
							<input type="checkbox" /><label>Прием груза к перевозке с внутренним пересчетом каждого места</label><br/>
							<input type="checkbox" /><label>Перевозка груза на который сверзу нельзя размещать другие грузы</label><br/>
						</div>
					</div>
					<div class="d2r">
						<input type="checkbox" data-show=".next" /><label>в пункте назначения</label>
						<div class="data-show-content mla">
							<input type="checkbox" /><label>Выдача дубликатов</label><br/>
							<input type="checkbox" /><label>Хранение груза на складе в сутки (первые сутки-день выгрузки)</label><br/>
							<input type="checkbox" /><label>Помещение груза с вагона на склад</label><br/>
							<input type="checkbox" /><label>Погрузочно-разгрузочные работы (кроме негабарита)</label><br/>
							<input type="checkbox" /><label>Растентовка автомобиля</label><br/>
						</div>
					</div>
				</div>
				<input type="button" class="add-new-place" value="+"/>
				<hr/>
			</div>
		</div>
	</div>
	<div id="max_calc-button">
		<input type="button" value="Расчитать стоимость" class="calc-request-result"/>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>