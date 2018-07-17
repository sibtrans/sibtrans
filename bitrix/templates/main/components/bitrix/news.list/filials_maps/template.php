<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>




<div id="ttt" style="width: 20%; background: white; opacity: 0.8; z-index: 100; position: relative; left: 10px; top: 20px;">
 <div class="tab">
        <button style="width: 22%; height: 79px;" class="tablinks active" onclick="openTab(event, 'London')">
            <div>
                <img src="/bitrix/templates/main/images/all_adres.png" alt="Все адреса" />
                <p>Все адреса</p>
            </div>
        </button> <button style="width: 25%; height: 79px;" class="tablinks" onclick="openTab(event, 'Paris')">
            <div>
                <img src="/bitrix/templates/main/images/resiv_send_cargo.png" alt="Приём-выдача груза" />
                <p>Приём-выдача груза</p>
            </div>
        </button> <button style="width: 33%; height: 79px;" class="tablinks" onclick="openTab(event, 'Tokyo')">
            <div>
                <img src="/bitrix/templates/main/images/storage_cargo.png" alt="Ответственное хранение груза" />
                <p>Ответственное хранение груза</p>
            </div>
        </button> <button style="width: 20%; height: 79px;" class="tablinks" onclick="openTab(event, 'novosib')">
            <div>
                <img src="/bitrix/templates/main/images/office.png" alt="Офис" />
                <p>Офис</p>
            </div>
        </button>
    </div>

 <div id="London" class="tabcontent" style="display: block;">

<?

$index = 1; // Порядковый номер объекта на карте
foreach($arResult["ITEMS"] as $arItem) { ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
 
 <?
    //Разбиваем координаты яндекс карты на X и Y координату
    $Yandex = explode(",", $arItem["PROPERTIES"]["YANDEX_MAP"]["VALUE"]);
    $Yandex_X = $Yandex[0];
    $Yandex_Y = $Yandex[1];
?>

    <!--Засовываем данные для формирования точки на карте в атрибуты контейнера div-->
    <div class="shop-data" data-index="<?=$index?>" data-name="<?=$arItem["NAME"]?>"
    data-yandex-x="<?=$Yandex_X;?>"
    data-yandex-y="<?=$Yandex_Y;?>"
    data-address="<?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?>"
    data-hours="<?=$arItem["PROPERTIES"]["HOURS"]["VALUE"];?>"
    data-phone="<?=$arItem["PROPERTIES"]["PHONE"]["VALUE"];?>"
    data-shop-manager="<?=$arItem["PROPERTIES"]["SHOP_MANAGER"]["VALUE"];?>"
	data-resiv-send-cargo="<?=$arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"];?>"
	data-storage-cargo="<?=$arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"];?>" 
	data-storage-cargo="<?=$arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"];?>"
	data-office="<?=$arItem["PROPERTIES"]["OFFICE"]["VALUE"];?>"
     style="padding: 10px;">
		<div style="border-width: thin; border-bottom-style: solid; border-color: lightgray; padding: 10px;">
        <!--Выводим информацию для пользователя-->
                    <div style="float: left; width: 50%; text-align: left;">
                        <p style="color: rgb(142, 33, 30); font-weight: 700;"><a href="#"><?=$arItem["NAME"];?></a></p>
                        <br/>
                        <p> <?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?></p>
                    </div>
                    <div style="float: left; width: 50%; text-align: right;">
						<?if($arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/resiv_send_cargo.png" alt="Приём-выдача груза" />' ?>
						<?endif;?>

						<?if($arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/storage_cargo.png" alt="Ответственное хранение груза" />' ?>
						<?endif;?>

						<?if($arItem["PROPERTIES"]["OFFICE"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/office.png" alt="Офис" />' ?>
						<?endif;?>
                    </div>
 				 <div style="clear: left;"></div>

    </div>
 </div>
<? ++$index; } unset($index); ?>
 </div>

 <div id="Paris" class="tabcontent" style="display: none;">

<?

$index = 1; // Порядковый номер объекта на карте
foreach($arResult["ITEMS"] as $arItem) { ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>

<?if($arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"] == 1):?>

 <?
    //Разбиваем координаты яндекс карты на X и Y координату
    $Yandex = explode(",", $arItem["PROPERTIES"]["YANDEX_MAP"]["VALUE"]);
    $Yandex_X = $Yandex[0];
    $Yandex_Y = $Yandex[1];
?>

    <!--Засовываем данные для формирования точки на карте в атрибуты контейнера div-->
    <div class="shop-data" data-index="<?=$index?>" data-name="<?=$arItem[" name"]?>"
    data-yandex-x="<?=$Yandex_X;?>"
    data-yandex-y="<?=$Yandex_Y;?>"
    data-address="<?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?>"
    data-hours="<?=$arItem["PROPERTIES"]["HOURS"]["VALUE"];?>"
    data-phone="<?=$arItem["PROPERTIES"]["PHONE"]["VALUE"];?>"
    data-shop-manager="<?=$arItem["PROPERTIES"]["SHOP_MANAGER"]["VALUE"];?>"
	data-resiv-send-cargo="<?=$arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"];?>"
	data-storage-cargo="<?=$arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"];?>" 
	data-storage-cargo="<?=$arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"];?>"
	data-office="<?=$arItem["PROPERTIES"]["OFFICE"]["VALUE"];?>"
     style="padding: 10px;">
		<div style="border-width: thin; border-bottom-style: solid; border-color: lightgray; padding: 10px;">
        <!--Выводим информацию для пользователя-->
                    <div style="float: left; width: 50%; text-align: left;">
                        <p style="color: rgb(142, 33, 30); font-weight: 700;"><a href="#"><?=$arItem["NAME"];?></a></p>
                        <br/>
                        <p> <?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?></p>
                    </div>
                    <div style="float: left; width: 50%; text-align: right;">
						<?if($arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/resiv_send_cargo.png" alt="Приём-выдача груза" />' ?>
						<?endif;?>

						<?if($arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/storage_cargo.png" alt="Ответственное хранение груза" />' ?>
						<?endif;?>

						<?if($arItem["PROPERTIES"]["OFFICE"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/office.png" alt="Офис" />' ?>
						<?endif;?>
                    </div>
 				 <div style="clear: left;"></div>

    </div>
 </div>
<?endif;?>
<? ++$index; } unset($index); ?>
 </div>

 <div id="Tokyo" class="tabcontent" style="display: none;">

<?

$index = 1; // Порядковый номер объекта на карте
foreach($arResult["ITEMS"] as $arItem) { ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>

<?if($arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"] == 1):?>

 <?
    //Разбиваем координаты яндекс карты на X и Y координату
    $Yandex = explode(",", $arItem["PROPERTIES"]["YANDEX_MAP"]["VALUE"]);
    $Yandex_X = $Yandex[0];
    $Yandex_Y = $Yandex[1];
?>

    <!--Засовываем данные для формирования точки на карте в атрибуты контейнера div-->
    <div class="shop-data" data-index="<?=$index?>" data-name="<?=$arItem[" name"]?>"
    data-yandex-x="<?=$Yandex_X;?>"
    data-yandex-y="<?=$Yandex_Y;?>"
    data-address="<?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?>"
    data-hours="<?=$arItem["PROPERTIES"]["HOURS"]["VALUE"];?>"
    data-phone="<?=$arItem["PROPERTIES"]["PHONE"]["VALUE"];?>"
    data-shop-manager="<?=$arItem["PROPERTIES"]["SHOP_MANAGER"]["VALUE"];?>"
	data-resiv-send-cargo="<?=$arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"];?>"
	data-storage-cargo="<?=$arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"];?>" 
	data-storage-cargo="<?=$arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"];?>"
	data-office="<?=$arItem["PROPERTIES"]["OFFICE"]["VALUE"];?>"
     style="padding: 10px;">
		<div style="border-width: thin; border-bottom-style: solid; border-color: lightgray; padding: 10px;">
        <!--Выводим информацию для пользователя-->
                    <div style="float: left; width: 50%; text-align: left;">
                        <p style="color: rgb(142, 33, 30); font-weight: 700;"><a href="#"><?=$arItem["NAME"];?></a></p>
                        <br/>
                        <p> <?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?></p>
                    </div>
                    <div style="float: left; width: 50%; text-align: right;">
						<?if($arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/resiv_send_cargo.png" alt="Приём-выдача груза" />' ?>
						<?endif;?>

						<?if($arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/storage_cargo.png" alt="Ответственное хранение груза" />' ?>
						<?endif;?>

						<?if($arItem["PROPERTIES"]["OFFICE"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/office.png" alt="Офис" />' ?>
						<?endif;?>
                    </div>
 				 <div style="clear: left;"></div>

    </div>
 </div>
<?endif;?>
<? ++$index; } unset($index); ?>
 </div>


 <div id="novosib" class="tabcontent" style="display: none;">

<?

$index = 1; // Порядковый номер объекта на карте
foreach($arResult["ITEMS"] as $arItem) { ?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>

<?if($arItem["PROPERTIES"]["OFFICE"]["VALUE"] == 1):?>

 <?
    //Разбиваем координаты яндекс карты на X и Y координату
    $Yandex = explode(",", $arItem["PROPERTIES"]["YANDEX_MAP"]["VALUE"]);
    $Yandex_X = $Yandex[0];
    $Yandex_Y = $Yandex[1];
?>

    <!--Засовываем данные для формирования точки на карте в атрибуты контейнера div-->
    <div class="shop-data" data-index="<?=$index?>" data-name="<?=$arItem[" name"]?>"
    data-yandex-x="<?=$Yandex_X;?>"
    data-yandex-y="<?=$Yandex_Y;?>"
    data-address="<?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?>"
    data-hours="<?=$arItem["PROPERTIES"]["HOURS"]["VALUE"];?>"
    data-phone="<?=$arItem["PROPERTIES"]["PHONE"]["VALUE"];?>"
    data-shop-manager="<?=$arItem["PROPERTIES"]["SHOP_MANAGER"]["VALUE"];?>"
	data-resiv-send-cargo="<?=$arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"];?>"
	data-storage-cargo="<?=$arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"];?>" 
	data-storage-cargo="<?=$arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"];?>"
	data-office="<?=$arItem["PROPERTIES"]["OFFICE"]["VALUE"];?>"
     style="padding: 10px;">
		<div style="border-width: thin; border-bottom-style: solid; border-color: lightgray; padding: 10px;">
        <!--Выводим информацию для пользователя-->
                    <div style="float: left; width: 50%; text-align: left;">
                        <p style="color: rgb(142, 33, 30); font-weight: 700;"><a href="#"><?=$arItem["NAME"];?></a></p>
                        <br/>
                        <p> <?=$arItem["PROPERTIES"]["ADDRESS"]["VALUE"];?></p>
                    </div>
                    <div style="float: left; width: 50%; text-align: right;">
						<?if($arItem["PROPERTIES"]["RESIV_SEND_CARGO"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/resiv_send_cargo.png" alt="Приём-выдача груза" />' ?>
						<?endif;?>

						<?if($arItem["PROPERTIES"]["STORAGE_CARGO"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/storage_cargo.png" alt="Ответственное хранение груза" />' ?>
						<?endif;?>

						<?if($arItem["PROPERTIES"]["OFFICE"]["VALUE"] == 1):?>
                        	<? echo '<img src="/bitrix/templates/main/images/office.png" alt="Офис" />' ?>
						<?endif;?>
                    </div>
 				 <div style="clear: left;"></div>

    </div>
 </div>
<?endif;?>
<? ++$index; } unset($index); ?>
 </div>


</div> 
<!--Контейнер в который прилетит сформированная яндекс карта-->
<div id="map_container"></div>


