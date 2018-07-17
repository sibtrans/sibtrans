<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>

<?
ShowMessage($arParams["~AUTH_RESULT"]);
ShowMessage($arResult['ERROR_MESSAGE']);
?>


<p style="font-size:122%; font-weight:bold; margin-bottom:7px;">Войти в личный кабинет</p>
<p style="font-size:72%; color: gray; margin-bottom: 2px;">Пользовались ранее услугами Байт Транзит?<p/>
<p style="font-size:72%; color: gray; margin-bottom: 2px;">У Вас уже создан личный кабинет.<p/>
<p style="font-size:72%; color: gray; margin-bottom: 2px;">Позвоните +7(383) 241 06 07 и получите<p/>
<p style="font-size:72%; color: gray; margin-bottom: 2px;">доступ к вашему кабинету</p>

<div class="bx-auth">


<?if($arResult["AUTH_SERVICES"]):?>
	<div class="bx-auth-title"><?echo GetMessage("AUTH_TITLE")?></div>
<?endif?>

	<form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">

		<input type="hidden" name="AUTH_FORM" value="Y" />
		<input type="hidden" name="TYPE" value="AUTH" />
		<input type="hidden" name="backurl" value="<?=urlencode("/lc/");?>" />
		<?foreach ($arResult["POST"] as $key => $value):?>
		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
		<?endforeach?>


		<p style="margin-bottom:3px;">E-mail:</p>


		<div class="form-row" style="height:40px;">
			<input  style="width:86%; max-width:370px;" class="form-input" type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["LAST_LOGIN"]?>" />
		</div>

		<div class="form-row" style="height:50px; margin-bottom:10px;">
		<p style="margin-bottom:3px; margin-top:10px;">Пароль:</p>
				<input style="width:46%;"  class="form-input" type="password" name="USER_PASSWORD" maxlength="255" autocomplete="off" />
				<input style="background:#92221e; margin-left:10px; width:82px; height:37px; cursor:pointer; color:white;" type="submit" name="Login" value="<?=GetMessage("AUTH_AUTHORIZE")?>" />
		</div>

				<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
			<script type="text/javascript">
			document.getElementById('bx_auth_secure').style.display = 'inline-block';
			</script>
			<?endif?>


<?if ($arResult["STORE_PASSWORD"] == "Y"):?>

			<input style="margin-top:7px;" type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" /><label style="font-size:80%; margin-top:7px;" for="USER_REMEMBER">&nbsp;<?=GetMessage("AUTH_REMEMBER_ME")?></label>

<?endif?>





<?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
		<noindex>
			<p style="border-bottom:solid; border-width:thin; text-align:right; margin-right:12px; margin-top:12px; border-bottom-color:gray; font-size:85%; max-width:390px;">
				<a style="text-decoration:none;" href="/lc/?forgot_password=yes" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
			</p>
		</noindex>
<?endif?>

<?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
		<noindex>
			<div style="padding-top:10px;">
				<div style="float:left">
						<p style="font-size:85%; margin-top:10px;">Ещё не пользуетесь</p>
					<p style="font-size:85%; margin-top:2px;">личным кабинетом?</p>
				</div>
				<div style="float:left;padding:5px;width:42%; text-align:right; ">
				<a style="cursor: pointer;
						border-style: solid;
						border-width: thin;
						border-radius: 4px;
						display: inline-block;
						width: 94%;
						line-height: 37px;
						text-align: center;
						text-decoration: none;
						font-size: 80%;
						padding-left: 2px;
						padding-right: 2px;" href="/register.php" rel="nofollow">Регистрация</a>
				</div>
				<div style="clear:left;"></div>
			</div>
		</noindex>
<?endif?>

	</form>
</div>

<script type="text/javascript">
<?if (strlen($arResult["LAST_LOGIN"])>0):?>
try{document.form_auth.USER_PASSWORD.focus();}catch(e){}
<?else:?>
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
<?endif?>
</script>

<?if($arResult["AUTH_SERVICES"]):?>
<?
$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "",
	array(
		"AUTH_SERVICES" => $arResult["AUTH_SERVICES"],
		"CURRENT_SERVICE" => $arResult["CURRENT_SERVICE"],
		"AUTH_URL" => $arResult["AUTH_URL"],
		"POST" => $arResult["POST"],
		"SHOW_TITLES" => $arResult["FOR_INTRANET"]?'N':'Y',
		"FOR_SPLIT" => $arResult["FOR_INTRANET"]?'Y':'N',
		"AUTH_LINE" => $arResult["FOR_INTRANET"]?'N':'Y',
	),
	$component,
	array("HIDE_ICONS"=>"Y")
);
?>
<?endif?>
