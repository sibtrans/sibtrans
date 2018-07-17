<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Перевозки");
$r=json_decode(json_encode(new SimpleXMLElement(requestSoap("GetSaldo",array($uInfo["un"])))),TRUE);
$saldo=$r["tmpsaldo"];
?>
<div class="pw">
	<div class="lc bm payments">
		<div class="filter">
			<form method="POST" id="payments_filter">
			<input type="hidden" name="un" value="<?=$un;?>" />
				<p>с <input type="text" class="ServiceInput form-input" name="date_from" placeholder="___.___.______"/> по <input type="text" class="ServiceInput form-input" name="date_to" placeholder="___.___.______"/> <input type="button" class="csw" value="Показать" />
			</form>
		</div>
		<table class="result">
			<tr>
				<th></th>
				<th>Информация об оплате</th>
				<th>Дата оплаты</th>
				<th>Сумма, руб</th>
			</tr>
		</table>
		<p class="mini_title">Расчеты</p>
			<table class="info" border="0" cellspacing="0" cellpadding="3">
				<tr>
					<td style="width:40%;padding:0;"><p class="mt">Сумма переплаты:</p>
					</td>
					<td style="width:10%;padding:0;" nowrap><?=($saldo["stk"]-$saldo["std"]>0)?$saldo["stk"]-$saldo["std"]:"0.00";?> руб.
					</td>
					<td style="width:50%;padding:0;">
					</td>
				</tr>
				<tr>
					<td style="width:40%;padding:0;"><p class="mt">Сумма долга:</p>
					</td>
					<td style="width:10%;padding:0;" nowrap><?=($saldo["stk"]-$saldo["std"]<0)?abs($saldo["stk"]-$saldo["std"]):"0.00";?> руб.
					</td>
					<td style="width:50%;padding:0;padding-left:20px;"><a class="act_s" data-un="<?=$uInfo["un"];?>" href="#"><img id=prnt src="/images/print.png">Распечатать акт сверки</a>
					</td>
				</tr>
				<!-- <tr>
					<td style="width:40%;padding:0;"><p class="mt">Текущее сальдо:</p>
					</td>
					<td style="width:10%;padding:0;" nowrap><?=abs($saldo["stk"]-$saldo["std"]);?> руб.
					</td>
					<td style="width:50%;padding:0;">
					</td>
				</tr> -->
			</table>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<style>
	#prnt {
		margin-right: 5px;
	}
	.act_s {
		text-decoration: unset;
	}

</style>