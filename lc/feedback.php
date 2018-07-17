<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Обратная связь");
?>
<div class="pw">
	<div class="lc message">
		<form method="POST" id="frmLCFeedback">
			<h3 class="page-title">Отправить сообщение</h3>
			<p>Получатель:</p>
			<select name="who" class="select_ServiceInput form-input">
				<option value="Курирующий менеджер" selected>Курирующий менеджер</option>
				<option value="Коммерческий директор">Коммерческий директор</option>
				<option value="Директор">Генеральный директор</option>
			</select>


			<p>Тема:</p>
			<input type="text" name="subj" class="ServiceInput form-input" />
			<p>Сообщение:</p>
			<textarea class="ServiceInput form-input" id="textfb" name="text" style="height:200px;;"></textarea><br/>
			<input type="button" id="lc-sendmsg" name="text" class="custom red" value="Отправить"/>
		</form>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>