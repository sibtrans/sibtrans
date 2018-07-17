<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка успешно отправлена");
?>


<? $APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y"); ?>
<meta http-equiv="refresh" content="15; /">
	<div class="pw relative">
	<br/><br/><br/>
		Ваша заявка отправлена! В ближайшее время наш специалист свяжется с вами.<br/>
		Вы будете автоматически перенаправлены на главную страницу сайта через 15 секунд.<br/>
		Если не хотите ждать - нажмите на <a href="/">ссылку</a>
		<br/><br/><br/><br/>
	</div>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>