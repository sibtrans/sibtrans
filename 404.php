<?
@define("ERROR_404","Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CHTTP::SetStatus("404 Not Found");
$APPLICATION->SetTitle("404");

?>
<br/>
<br/>
<br/>
<br/>
<div class="pw">
<div style="float:left;"><img src="../bitrix/templates/main/images/mouse404.png" alt="Мышь"></div>

<div style="float:left;">
	<div><img src="../bitrix/templates/main/images/yps__404.png" alt="Упс"></div>

	<div style="background-image: url(../bitrix/templates/main/images/paper404.png); height:220px;">
		<br/>
		<br/>		
		<br/>
		<div id="page404" style="padding-left:40px;">
			<p style="font-size:larger; padding:3px; color:#fffafa;">Приносим свои извинения,</p>
		<p style="font-size:larger; padding:3px; color:#fffafa;">страница возможно была удалена</p>
		<p style="font-size:larger; padding:3px; color:#fffafa;">или редактируется!</p>
		<br/>
		<br/>		
		<br/>
		<br/>
			<div><p style="font-size:large; padding:5px; padding-bottom:10px; color:gray;">Вы можете посетить другой раздел сайта:</p></div>

			<div style="height:27px;"><p style="font-size:medium; padding:5px;"><img style="vertical-align:middle;" src="../bitrix/templates/main/images/favicon-16x16.png" alt="Байт-Транзит">&nbsp;<a style="text-decoration:none;" onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';" href="../cost-calculation/cost-calculation.php">рассчитать стоимость перевозки;</a></p></div>

			<div style="height:27px;"><p style="font-size:medium; padding:5px;"><img style="vertical-align:middle;" src="../bitrix/templates/main/images/favicon-16x16.png" alt="Байт-Транзит">&nbsp;<a style="text-decoration:none;" onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';"  href="../cost-calculation/order.php">оформить заявку;</a></p></div>

			<div style="height:27px;"><p style="font-size:medium; padding:5px;"><img style="vertical-align:middle;" src="../bitrix/templates/main/images/favicon-16x16.png" alt="Байт-Транзит">&nbsp;<a  style="text-decoration:none;" onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';"  href="../rates/">посмотреть тарифы.</a></p></div>

			<div style="height:27px;"><p style="font-size:medium; padding:5px;"><img style="vertical-align:middle;" src="../bitrix/templates/main/images/favicon-16x16.png" alt="Байт-Транзит">&nbsp;<a  style="text-decoration:none;" onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';"  href="../lc/">войти в личный кабинет</a></p></div>

		</div>
	</div>

</div>
<div style="clear:both;"></div>
</div>
<br/>
<br/>
 <? $APPLICATION->AddChainItem($APPLICATION->GetTitle(), $APPLICATION->GetCurPage()); ?> 
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>