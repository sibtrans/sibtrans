<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Главная");
?>
<div class="pw">
    <?getFilials();?>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>