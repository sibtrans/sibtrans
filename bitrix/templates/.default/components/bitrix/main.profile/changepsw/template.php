<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<h2 class="page-title">Изменение пароля</h3>
<div class="bx-auth-profile">

<?ShowError($arResult["strProfileError"]);?>
<?
if ($arResult['DATA_SAVED'] == 'Y')
	ShowNote(GetMessage('PROFILE_DATA_SAVED'));
?>
<form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
<?=$arResult["BX_SESSION_CHECK"]?>
<input type="hidden" name="lang" value="<?=LANG?>" />
<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
<input type="hidden" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
<input type="hidden" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />

	<label class="required"><?=GetMessage('NEW_PASSWORD_REQ')?></label><br/>
	<input type="password" name="NEW_PASSWORD"   maxlength="50" value="" autocomplete="off" class="ServiceInput not_ignor bx-auth-input"/><br/><br/>
	<label class="required"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label><br/>
	<input type="password" name="NEW_PASSWORD_CONFIRM"   maxlength="50" value="" autocomplete="off" class="ServiceInput not_ignor bx-auth-input"/>
	
	<br/><br/>
	<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p><br/>
	<p><input type="submit" name="save" class="custom red" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">&nbsp;&nbsp;<!--input type="reset" value="<?=GetMessage('MAIN_RESET');?>"--></p>
</form>
</div>