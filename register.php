<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
?>
<div class="pw" style="margin-bottom:15px;">
	<br/>
	<h2 class="page-title">Регистрация</h2>

	<p style="font-size:14px; width:30%;">Чтобы начать процесс регистрации, введите уникальный идентификатор, полученный у оператора</p>
	<div>
	<div style="float: left; width: 390px; margin-right: 40px;">
	<input type="text" class="ServiceInput not_ignor" maxlength="90" style="width:100%; margin-top:7px;" placeholder="Уникальный идентификатор" name="uid"/>
	</div>
	<div style="float:left;">
	<input type="button" class="custom red" id="btnRegisterUser" value="Продолжить" style="float:right; margin-top:7px;"/>
	</div>
	</div>

	<div class="clear"></div>
	<br/>
	<br/>
	<div id="registerResult">
	</div>
</div>
<div style="display:none;"> 
	<div id="dlgRegister" class="details_dialog_contentEMAIL"> 
		<div class="dialogModal_header"><h2 class="page-title" style="margin:0;">Регистрация пользователя</h2></div>
		<div class="dialogModal_content">
		</div>
		<div class="dialogModal_footer"> 
			<button type="button" class="btn btn-default" data-dialogmodal-but="ok">ОК</button> 
		</div>
	</div>
</div>	
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>