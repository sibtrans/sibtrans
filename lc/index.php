<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("TITLE", "Личный кабинет Компания «Байт Транзит»");
$APPLICATION->SetTitle("Главная");
$r=json_decode(json_encode(new SimpleXMLElement(requestSoap("GetSaldo",array($uInfo["un"])))),TRUE);
$saldo=$r["tmpsaldo"];
foreach($uInfo as $k=>$v){
	if((is_array($v))&&(count($v)==0))$uInfo[$k]="";
}
?>

<div class="pw">	
	<div class="lc bm">
		<table class="info" border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td>
					<p class="mt">Компания:</p>
					<p><?=$uInfo["org"];?> <?=$uInfo["fullname"];?></p>
				</td>
				<td>
					<p class="mt">E-mail:</p>
					<?=($uInfo["email"]!="")?"<p>".$uInfo["email"]."</p>":"";?>
					<?=($uInfo["email2"]!="")?"<p>".$uInfo["email2"]."</p>":"";?>
				</td>
			</tr>
			<tr>
				<td>
					<p class="mt">Реквизиты:</p>
					<p><?=$uInfo["adres"];?></p><br/>
					<p>Р/с <?=$uInfo["rc"];?></p>
					<p>КПП <?=$uInfo["mfo"];?></p>
				</td>
				<td>
					<p class="mt">Телефон/факс:</p>
					<?=($uInfo["tel1"]!="")?"<p>".$uInfo["tel1"]."</p>":"";?>
					<?=($uInfo["tel2"]!="")?"<p>".$uInfo["tel2"]."</p>":"";?>
				</td>
			</tr>
			<tr>
				<td>
					<p class="mt">ИНН:</p>
					<p><?=$uInfo["inn"];?></p>
				</td>
				<td>
					<p class="mt">Изменить пароль:</p>
					<p><a href="/lc/changepassword.php">перейти</a></p>
				</td>
			</tr>
		</table>
		<p class="mini_title">Расчеты</p>
		<table class="info" border="0" cellspacing="0" cellpadding="3">
			<tr>
				<td style="width:40%;padding:0;" nowrap><p class="mt">Сумма переплаты:</p>
				</td>
				<td style="width:10%;padding:0;padding-right:15px;" nowrap><?=$saldo["stk"];?> руб.
				</td>
				<td style="width:50%;padding:0;">
				</td>
			</tr>
			<tr>
				<td style="width:40%;padding:0;" nowrap><p class="mt">Сумма долга:</p>
				</td>
				<td style="width:10%;padding:0;padding-right:15px;" nowrap><?=$saldo["std"];?> руб.
				</td>
				<td style="width:50%;padding:0;"><a class="act_s" data-un="<?=$uInfo["un"];?>" href="#"><img id=prnt src="/images/print.png">Распечатать акт сверки</a>
				</td>
			</tr>
		</table>
	</div>
</div>
<?
?><!--pre><?print_r($uInfo);?></pre--><?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>
<style>
	#prnt {
		margin-right: 5px;
	}
	.act_s {
		text-decoration: unset;
	}

</style>