<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */

$this->setFrameMode(true);
?>

<link rel="stylesheet" href="/bitrix/templates/main/components/bitrix/news/vakansii/bitrix/news.list/.default/aeon-grid.css">





<br><br><br><br>


<div class="container" style=" width: 1125px; height: auto;   ">
    <div class="row">
        <div class="col7">
           <div ><h1 class="vakansii">Карьера в «Байт Транзит»</h1></div><br>
            <div class="vac_text" style="padding-left: 10px;"><p class="vac_p"><br>Главная ценность «Байт Транзит» - это сотрудники.<br>Компания гордится тем, что многие руководители высшего и среднего звена начинали свой трудовой путь в компании с рядовых специальностей - водителей, операторов и логистов. Развитие компании «Байт Транзит» способствует созданию новых рабочих мест и успешному карьерному росту сотрудников.<br><br> В «Байт Транзит» развита корпоротивная культура. Конкурсы, спортивные соревнования, праздники, бесплатные детские подарки, подарки ко дню рождения.<br><br></p></div>
            <h2 class="nashi"><br>Наши сотрудники - это наши самые выгодные инвестиции! </h2><br><br>
        </div>
 <!--ССЫЛКУ НА КАРТИНКУ ВСТАВЛЯТЬ МЕЖДУ КОВЫЧЕК --> <div class="col5"> <img src="https://www.sibtrans.ru/upload/medialibrary/0c6/logo-na-avatarku.jpg">
        </div>
    </div>

    <div class="row">
        <div class="col12" style="width: 1117px; margin-left: 10px;" >
        	<h1 class="vakansii">Вакансии</h1><br>
            <div class="cities_filter" style="font-size: medium; text-align: center; font-family: Segoe UI"">
                <ul>

                    <li class="all_cities"  data-city="Все города" style="cursor: pointer; ">Все города</li>
                    <?
                    $k = 1;
                    $s = 0;
                    $arCities = array();
                    $arCategory = array();


                    foreach($arResult["ITEMS"] as $arItem):?>
                        <? foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):
                            if ($pid == "city") {?>
                                <li  class="city_filter" data-city="<?echo($arProperty["DISPLAY_VALUE"]);$arCities[$s]=$arProperty["DISPLAY_VALUE"];?>" data-id="<?echo ($k)?>" style="cursor: pointer" id="<?echo("city_li".$k)?>">
                                <?echo($arProperty["DISPLAY_VALUE"]);
                            } elseif ($pid == "category") {

                                $arCategory[$s]=$arProperty["DISPLAY_VALUE"];
                            }

                        endforeach;

                        ?>
                        <a id="<?echo("a".$k)?>"></a>
                        <?$s++;
                        $k++;?>
                        </li>
                    <?endforeach;
                    ?>





                </ul>

            </div>
            <hr class="line-grad1">
        </div>


    </div>
     <div class="row">
        <div class="col9" >
        	<div class = "news-list" style="min-height: 450px;">
<!--          <p class = "empty" style="display:none; margin-top: 50px;">К сожалению, в этом городе нет запрашиваемой вакансии</p>-->


                    <?$s = 0;?>

                    <?foreach($arResult["ITEMS"] as $arItem):?>
                    <?
                    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                    ?>

                    <p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>" >

                        <div   class = "<?echo("it");echo($s)?>" category="<?echo ($arCategory[$s]);?>"  city_name="siti_fl"  id = "<?echo($s)?>"data-name="<?echo ($arCities[$s]);?>" >
                            <div  class = "<?echo("item");echo($s)?>" name = "vac_item" >
                                <?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
                    <p class="vac_prop" id="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></p>
                <?endif?>
                    <?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
                        <?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
                            <p class="vac_prop2" id="vac_name" href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><?echo $arItem["NAME"]?></p><img class="vac_img" style="width: 24px; height: 30px;" src="https://www.sibtrans.ru/upload/medialibrary/04b/111.png">
                        <?else:?>
                            <b><?echo $arItem["NAME"]?></b>
                        <?endif;?>
                    <?endif;?>



                    <?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
                        <p href="#" name="<?echo($pid)?>"  class="<?echo($arProperty["DISPLAY_VALUE"]);?>">

                            <?if(is_array($arProperty["DISPLAY_VALUE"])):?>
                                <?=implode(" ", $arProperty["DISPLAY_VALUE"]);?>

                            <?else:?>
                                <?=$arProperty["DISPLAY_VALUE"];?>
                            <?endif?>

                        </p>
                    <?endforeach;
                    $x++;?></div>
                <br>
                    <div name = 'itm' class="<?echo ('item_detail');echo($s)?>" style="height: auto; display: none"> <?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
                        <?echo $arItem["PREVIEW_TEXT"];?><br>
                        <div class="res"  style="width: 222px; margin: 0 auto; border: 2px solid  brown; color: brown; font-size: medium;" ><a style="text-decoration: none;" href="https://www.sibtrans.ru/vacancy/resume.php" target="_blank"><img width="60px" src ="https://www.sibtrans.ru/upload/medialibrary/934/222.png">  Отправить резюме</a></div>
                        
                      
                            <a class="vac_pro" id="vac_name"  target="_blank" style="font-size: x-small; " href="<?echo $arItem["DETAIL_PAGE_URL"]?>">Открыть в отдельном окне</a>
                       <br><br>


                    <?endif;$s++;?>
                </div>

                <hr class="line-grad">

            </div>

            <?endforeach;?>
            

        </div>
    </div>
        <div id = "right_cat" class="col3" style=" float:right; font-family: Segoe UI">
        	<div class="category_filter" style="font-size: medium;">
                <h3 style="font-size: large; font-weight: bold; ">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspРод деятельности</h3>
                    <label class="cat_filter"><input class="inp7" id="Все категории" type="checkbox" disabled="disableddiv[name=vac_item]" />Все категории</label><br>
                    <label class="cat_filter"><input class="inp8" id="Административный персонал" type="checkbox" /><label>Административный персонал</label></label><br>
                    <label class="cat_filter"><input class="inp9" id="Безопастность" type="checkbox" />Безопастность</label><br>
                    <label class="cat_filter"><input class="inp10" id="Бухгалтерия, управленческий учет, финансы предприятия" type="checkbox" /><label>Бухгалтерия, управленческий &nbsp&nbsp&nbsp&nbsp&nbspучет, финансы предприятия</label></label><br>
                    <label class="cat_filter"><input class="inp11" id="Высший менеджмент" type="checkbox" />Высший менеджмент</label><br>
                    <label class="cat_filter"><input class="inp12" id="Закупки" type="checkbox" />Закупки</label><br>
                    <label class="cat_filter"><input class="inp13" id="Информационные технологии, интернет, телеком" type="checkbox" />Информационные технологии, &nbsp&nbsp&nbsp&nbsp&nbspинтернет, телеком</label><br>
                    <label class="cat_filter"><input class="inp14" id="Консультирование" type="checkbox" />Консультирование</label><br>
                    <label class="cat_filter"><input class="inp15" id="Маркетинг, реклама, PR" type="checkbox" />Маркетинг, реклама, PR</label><br>
                    <label class="cat_filter"><input class="inp16" id="Начало карьеры, студенты" type="checkbox" />Начало карьеры, студенты</label><br>
                    <label class="cat_filter"><input class="inp17" id="Продажи" type="checkbox" />Продажи</label><br>
                    <label class="cat_filter"><input class="inp18" id="Рабочий персонал" type="checkbox" />Рабочий персонал</label><br>
                    <label class="cat_filter"><input class="inp19" id="Транспорт, логистика" type="checkbox" />Транспорт, логистика</label><br>
                    <label class="cat_filter"><input class="inp20" id="Управление персоналом, тренинги" type="checkbox" />Управление персоналом, &nbsp&nbsp&nbsp&nbsp&nbspтренинги</label><br>
                    <label class="cat_filter"><input class="inp21" id="Юристы" type="checkbox" />Юристы</label><br>


                </div>

        </div>
    </div>
    <div class="next" style="margin: 0; float: right; width: 453px; font-size: large;"><p>Показать еще</p></div>
    <div class="row">
        <div id = "korp" class="col12" style="padding-top: 45px;">
          <h1 class = "vakansii" style="display: none;"> Корпоративная жизнь</h1>
        </div>


    </div>
</div>
<div class="container" style="width: 1385px; display: none"> 
    <div id="rery" class="col12" style="margin-bottom:-15px; "> 
      <br />
     <?$APPLICATION->IncludeComponent(
    "hmweb:medialibrary.slider", 
    ".default", 
    array(
        "TEMPLATE_THEME" => "red",
        "USE_JQUERY" => "Y",
        "USE_THUMB_IMG" => "Y",
        "USE_FANCYBOX" => "N",
        "COUNT_ELEMENT_DEFAULT" => "3",
        "CAROUSEL_WRAP" => "circular",
        "USE_PAGINATION" => "N",
        "USE_AUTOSCROLL" => "Y",
        "START_ELEMENT_SLIDER" => "6",
        "COLLECTIONS" => array(
            0 => "5",
        ),
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "N",
        "COMPONENT_TEMPLATE" => ".default",
        "THUMB_IMG_WIDTH" => "440",
        "THUMB_IMG_HEIGHT" => "320",
        "RESIZE_TYPE" => "BX_RESIZE_IMAGE_EXACT",
        "AUTOSCROLL_INTERVAL" => "4"
    ),
    false
);?> 
</div>
<div id="rery" class="col12" style="margin-bottom: 35px;"> 
      <br />
     <?$APPLICATION->IncludeComponent(
    "hmweb:medialibrary.slider", 
    ".default", 
    array(
        "TEMPLATE_THEME" => "red",
        "USE_JQUERY" => "Y",
        "USE_THUMB_IMG" => "Y",
        "USE_FANCYBOX" => "N",
        "COUNT_ELEMENT_DEFAULT" => "3",
        "CAROUSEL_WRAP" => "circular",
        "USE_PAGINATION" => "N",
        "USE_AUTOSCROLL" => "Y",
        "START_ELEMENT_SLIDER" => "3",
        "COLLECTIONS" => array(
            0 => "6",
        ),
        "CACHE_TYPE" => "A",
        "CACHE_TIME" => "36000000",
        "CACHE_GROUPS" => "N",
        "COMPONENT_TEMPLATE" => ".default",
        "THUMB_IMG_WIDTH" => "440",
        "THUMB_IMG_HEIGHT" => "320",
        "RESIZE_TYPE" => "BX_RESIZE_IMAGE_EXACT",
        "AUTOSCROLL_INTERVAL" => "4"
    ),
    false
);?> 
</div>
 </div>
<br><br>


 <script type="text/javascript">
                        var pressed = 0;
                       var last_city_press = "Все города";
                        //для городов
                        var li = $('.city_filter');
                        // получаем содержимое списков (данные внутри тегов)
                        var vals = li.map(function(){
                            return $(this).text().replace(/[0-9]/g, '').trim();
                        }).get();
                        console.log('vals = ' + vals);
                        $('.city_filter').empty();
                        console.log('vals after empty ' + vals);

                        var result = {};

                        for (var i = 0; i < vals.length; ++i)
                        {
                            var a = vals[i];
                            if (result[a] !== undefined)
                                ++result[a];
                            else
                                result[a] = 1;
                        }

                        console.log( result)
                        var size_result = Object.keys(result).length;
                        console.log('result size = ' + size_result)
                        var z= 0;
                        for (var i=0; i<size_result; i++) {
                            z = i+1;
                            console.log(z)
                            $('#city_li'+z).attr('data-city', (Object.keys(result)[i]))

                            
                            $('<label>', { class: 'nc', text: Object.keys(result)[i] }).appendTo('#city_li'+z);

                            $('<label>', { class: 'num_city', style: "color: brown", text: " (" + result[Object.keys(result)[i]]+")"}).appendTo('#city_li'+z);
                        }
                        $('<label>', { class: 'num_city', style: "color: brown", text: " (" + vals.length+")"}).appendTo('.all_cities');

                        var data_city
                        const clone_all = $('div[city_name="siti_fl"]')
                        var clone;
                       // Фильтр городов, diplay none и display show
                        $('div[name="itm"]').hide()
                        $('.city_filter[data-city]').on("click", function() {
                            $('.all_cities[data-city]').css('color', '#4d4948')
                            $('.city_filter[data-city]').css('color', '#4d4948')
                            $(this).css('color', 'brown')
                            data_city = $(this).data('city');
                            $('div[city_name="siti_fl"]').remove()
                            $('.news-list').append(clone_all)
                            clone = $('div[data-name="'+data_city+'"]')
                            console.log(clone)
                            $('div[city_name="siti_fl"]').remove()
                            $('.news-list').append(clone)
                            for (i=0; i<vals.length; i++){
                            	$('.it'+i+':not(:first)').remove();}
                            $('div[city_name="siti_fl"]').hide();
                            $('div[city_name="siti_fl"]').show('slow')
                            for (var i =0; i<vals.length; i++){
                                click_item('item'+i,'item_detail'+i)}
                                $('.empty').hide()
                                
                                $('div[category='+'"'+inp_id8_click+'"]').show();
                                $('div[category='+'"'+inp_id9_click+'"]').show(); $('div[category='+'"'+inp_id17_click+'"]').show();
                                $('div[category='+'"'+inp_id10_click+'"]').show(); $('div[category='+'"'+inp_id18_click+'"]').show();
                                $('div[category='+'"'+inp_id11_click+'"]').show(); $('div[category='+'"'+inp_id19_click+'"]').show();
                                $('div[category='+'"'+inp_id12_click+'"]').show(); $('div[category='+'"'+inp_id20_click+'"]').show();
                                $('div[category='+'"'+inp_id13_click+'"]').show(); $('div[category='+'"'+inp_id21_click+'"]').show();
                                $('div[category='+'"'+inp_id14_click+'"]').show();
                                $('div[category='+'"'+inp_id15_click+'"]').show();
                                $('div[category='+'"'+inp_id16_click+'"]').show();
                                $('div[name="itm"]').hide()
                            next_hide()
                                
                  
                               
                              
                            

                            $('.all_cities[data-city]').on("click", function () {
                                $('div[name="itm"]').hide()
                                $('.city_filter[data-city]').css('color', '#4d4948')
                                $('.all_cities[data-city]').css('color', '#4d4948')
                                $(this).css('color', 'brown')
                                var data_city = $(this).data('city');
                                $('div[city_name="siti_fl"]').remove()
                                $('.news-list').append(clone_all)
                                for (i=0; i<vals.length; i++){
                            	$('.it'+i+':not(:first)').remove();}
                                $('div[city_name="siti_fl"]').hide();
                                $('div[city_name="siti_fl"]').show('slow')
                                for (var i =0; i<vals.length; i++){
                                    click_item('item'+i,'item_detail'+i)}
                                    $('.empty').hide()
                                    
                                $('div[category='+'"'+inp_id8_click+'"]').show();
                                $('div[category='+'"'+inp_id9_click+'"]').show(); $('div[category='+'"'+inp_id17_click+'"]').show();
                                $('div[category='+'"'+inp_id10_click+'"]').show(); $('div[category='+'"'+inp_id18_click+'"]').show();
                                $('div[category='+'"'+inp_id11_click+'"]').show(); $('div[category='+'"'+inp_id19_click+'"]').show();
                                $('div[category='+'"'+inp_id12_click+'"]').show(); $('div[category='+'"'+inp_id20_click+'"]').show();
                                $('div[category='+'"'+inp_id13_click+'"]').show(); $('div[category='+'"'+inp_id21_click+'"]').show();
                                $('div[category='+'"'+inp_id14_click+'"]').show();
                                $('div[category='+'"'+inp_id15_click+'"]').show();
                                $('div[category='+'"'+inp_id16_click+'"]').show();
                                $('div[name="itm"]').hide()
                                next_hide()


                                
                            })
                        })

next_hide()

function next_hide() {
   for (var i =0; i<250; i++){
                    if (i>19) $('.it'+i).hide()

                         }
}


$('.next').on("click", function () { $('div[city_name="siti_fl"]').each(function () {
                        $('div[city_name="siti_fl"]').show('slow')
                })
 } )


                    
                   

                        var inp_id8_click =0;var inp_id9_click =0;var inp_id10_click =0;var inp_id11_click =0;
                        var inp_id12_click =0;var inp_id13_click =0;var inp_id14_click =0;var inp_id15_click =0;
                        var inp_id16_click =0;var inp_id17_click =0;var inp_id18_click =0;var inp_id19_click =0;
                        var inp_id20_click =0;var inp_id21_click =0;


                        if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                        	$('.inp7').prop('checked',true);
                        }


for (var i =0; i<vals.length; i++){
    click_item('item'+i,'item_detail'+i)
}
                        function click_item(item, item_detail) {
                            $('.'+item).on('click', function () {
                                if ($('.'+item_detail).css('display') === 'none') {

                                    $('.'+item_detail).show('slow')
                                } else if ($('.'+item_detail).css('display') !== 'none') {

                                    $('.'+item_detail).hide('slow')
                                }
                            });
                        }

                        $('.inp7').on('change', function () {
                            if (this.checked) {
                                
                                console.log('Check')
                                
                                $('.empty').hide()
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }

                            } else {
                                inp_id8_click=0;
                                console.log("Uncheck")
                                

                                if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                    $('.inp7').prop('checked',true);}
                                
                                
                            }
                        });

                       $('.inp8').on('change', function () {
                           if (this.checked) {
                               inp_id8_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                                $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                                $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                                $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                                $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                                $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                                $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                                $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                                $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                                $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }

                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show('slow')
                                   else if (e>0) $('.empty').hide('slow')
                               })
                                $('.item_detail').show('slow')
                           } else {
                               inp_id8_click=0;
                               console.log("Uncheck")
                               $('div[category="Административный персонал"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                        	$('.inp7').prop('checked',true);
                        	$('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                        }
                       });



                         $('.inp9').on('change', function () {
                           if (this.checked) {
                               inp_id9_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })
                           } else {

                               inp_id9_click=0;
                               console.log("Uncheck")
                               $('div[category="Безопастность"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp10').on('change', function () {
                           if (this.checked) {
                               inp_id10_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })


                           } else {
                               inp_id10_click=0;
                               console.log("Uncheck")
                               $('div[category="Бухгалтерия, управленческий учет, финансы предприятия"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp11').on('change', function () {
                           if (this.checked) {
                               inp_id11_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })
                           } else {
                               inp_id11_click=0;
                               console.log("Uncheck")
                               $('div[category="Высший менеджмент"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp12').on('change', function () {
                           if (this.checked) {
                               inp_id12_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })
                           } else {
                               inp_id12_click=0;
                               console.log("Uncheck")
                               $('div[category="Закупки"]').hide('slow')
                               $('.empty').hide('slow')
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp13').on('change', function () {
                           if (this.checked) {
                               inp_id13_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show('slow')
                                   else if (e>0) $('.empty').hide('slow')
                               })
                           } else {
                               inp_id13_click=0;
                               console.log("Uncheck")
                               $('div[category="Информационные технологии, интернет, телеком"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp14').on('change', function () {
                           if (this.checked) {
                               inp_id14_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })
                           } else {
                               inp_id14_click=0;
                               console.log("Uncheck")
                               $('div[category="Консультирование"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp15').on('change', function () {
                           if (this.checked) {
                               inp_id15_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })
                           } else {
                               inp_id15_click=0;
                               console.log("Uncheck")
                               $('div[category="Маркетинг, реклама, PR"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp16').on('change', function () {
                           if (this.checked) {
                               inp_id16_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })
                           } else {
                               inp_id16_click=0;
                               console.log("Uncheck")
                               $('div[category="Начало карьеры, студенты"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp17').on('change', function () {
                           if (this.checked) {
                               inp_id17_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })
                           } else {
                               inp_id17_click=0;
                               console.log("Uncheck")
                               $('div[category="Продажи"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp18').on('change', function () {
                           if (this.checked) {
                               inp_id18_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })
                           } else {
                               inp_id18_click=0;
                               console.log("Uncheck")
                               $('div[category="Рабочий персонал"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp19').on('change', function () {
                           if (this.checked) {
                               inp_id19_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })
                           } else {

                               inp_id19_click=0;
                               console.log("Uncheck")
                               $('div[category="Транспорт, логистика"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp20').on('change', function () {
                           if (this.checked) {
                               inp_id20_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }
                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })
                           } else {
                               inp_id20_click=0;
                               console.log("Uncheck")
                               $('div[category="Управление персоналом, тренинги"]').hide()
                               $('.empty').hide()
                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });

                         $('.inp21').on('change', function () {
                           if (this.checked) {
                               inp_id21_click = $(this).attr('id');
                               console.log('Check')
                               $('div[city_name="siti_fl"]').hide('slow')
                               $('div[category='+'"'+inp_id8_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id9_click+'"]').show('slow'); $('div[category='+'"'+inp_id17_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id10_click+'"]').show('slow'); $('div[category='+'"'+inp_id18_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id11_click+'"]').show('slow'); $('div[category='+'"'+inp_id19_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id12_click+'"]').show('slow'); $('div[category='+'"'+inp_id20_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id13_click+'"]').show('slow'); $('div[category='+'"'+inp_id21_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id14_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id15_click+'"]').show('slow');
                               $('div[category='+'"'+inp_id16_click+'"]').show('slow');
                                if ( (inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click) !== 0){ $('.inp7').prop('checked',false); }



                               var e =0
                               $('div[city_name="siti_fl"]').each(function () {
                                   if ($(this).css('display')!=='none')  {
                                       e = e+1;
                                       console.log('yes ' + e)
                                   } else console.log('none ' +e);
                                   if (e === 0) $('.empty').show()
                                   else if (e>0) $('.empty').hide()
                               })
                           } else {
                               inp_id21_click=0;
                               console.log("Uncheck")
                               $('div[category="Юристы"]').hide()
                               $('.empty').hide()


                               if ((inp_id8_click+inp_id9_click+inp_id10_click+inp_id11_click+inp_id12_click+inp_id13_click+inp_id14_click+inp_id15_click+inp_id16_click+inp_id17_click+inp_id18_click+inp_id19_click+inp_id20_click+inp_id21_click)===0) {
                                   $('.inp7').prop('checked',true);
                                   $('div[city_name="siti_fl"]').show('slow') }
                               $('div[name="itm"]').hide()
                           }
                         });




//Создаем функции для скрытия и инвиза
                        (function($) {
    $.fn.none = function() {
        return this.each(function() {
            $(this).css("display", "none");
        }); //.prop('p_city', 'pressed');
    };
    $.fn.show1 = function() {
        return this.each(function() {
            $(this).css("display", "");
        });
    };

    $.fn.val_all = function() {
        return this.each(function() {
            $('div[city_name="siti_fl"]').hide();
        $('.selector').val([inp_id8_click, inp_id9_click, inp_id10_click, inp_id11_click,inp_id12_click, inp_id13_click, inp_id14_click, inp_id15_click, inp_id16_click, inp_id17_click, inp_id18_click, inp_id19_click, inp_id20_click, inp_id21_click])
        });
    };
    $.fn.p_city = function() {
        return this.each(function() {
            $('div[city_name="siti_fl"]').attr('press_city', 0);         //вроде ок
            $(this).attr('press_city', 1);
            $('div[category="Бухгалтерия, управленческий учет, финансы предприятия"]').attr('name') == "Москва"
                console.log('true')
             console.log('false')
            // $(this).attr('press_main', 0);

            // $('div[name='+'"'+data_city+'"]').attr('press_city', "pressed"); //вроде ок
            // p_city = 1;
            // p_main = 0;
            // p_cat_all = p_city+p_cat

        });
    };


                            $.fn.p_cat = function() {
                                return this.each(function() {
                                    $(this).attr('press_cat', 1);
                                    // $(this).attr('p_cat_all', 2)

                                    // p_cat_all = p_city+p_cat

                                });
                            };
                            $.fn.p_cat_all = function() {
                                return this.each(function() {
                                //     $(this).attr('p_cat_all',$('div[category="Бухгалтерия, управленческий учет, финансы предприятия"]').attr('p_city')+$('div[category="Бухгалтерия, управленческий учет, финансы предприятия"]').attr('p_cat')+$('div[category="Бухгалтерия, управленческий учет, финансы предприятия"]').attr('p_main') );
                                // // });
                                //     var a = $('div[city_name="siti_fl"]').attr('p_city')
                                //    var b = $('div[city_name="siti_fl"]').attr('p_cat')
                                //     var c = $('div[city_name="siti_fl"]').attr('p_main')

                                     var abc = $('div[city_name="siti_fl"]').attr('press_city')+$('div[city_name="siti_fl"]').attr('press_cat')+$('div[city_name="siti_fl"]').attr('press_main')
                                    console.log($('div[city_name="siti_fl"]').attr('press_main'))
                                    console.log(parseInt(abc))
                                     // $(this).attr('p_cat_all', (toString($('div[city_name="siti_fl"]').attr('p_city'))+toString($('div[city_name="siti_fl"]').attr('p_cat'))+toString($('div[city_name="siti_fl"]').attr('p_main') )))

                                    $(this).attr('p_cat_all', (parseInt($('div[city_name="siti_fl"]').attr('press_city'))+parseInt($('div[city_name="siti_fl"]').attr('press_cat'))+parseInt($('div[city_name="siti_fl"]').attr('press_main'))))
                                    // alert(abc)
                                    // $(this).attr('p_cat_all', 1+3)

                                });
                            };
}(jQuery));


                       if ($('div[category="Бухгалтерия, управленческий учет, финансы предприятия"]').attr('name') == "Москва")
                        console.log($('div[city_name="siti_fl"]').attr('press_city'))



$(function() {
    $('#checkbox').change(function () {
        setInterval(function () {
            moveRight();
        }, 3000);
    });

    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width();
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;

    $('#slider').css({
        width: slideWidth,
        height: slideHeight
    });

    $('#slider ul').css({
        width: sliderUlWidth,
        marginLeft: -slideWidth
    });

    $('#slider ul li:last-child').prependTo('#slider ul');

    function moveLeft() {
        $('#slider ul').animate({
            left: +slideWidth
        }, 200, function () {
            $('#slider ul li:last-child').prependTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    function moveRight() {
        $('#slider ul').animate({
            left: -slideWidth
        }, 200, function () {
            $('#slider ul li:first-child').appendTo('#slider ul');
            $('#slider ul').css('left', '');
        });
    };

    $('a.control_prev').click(function () {
        moveLeft();
    });

    $('a.control_next').click(function () {
        moveRight();
    });
});

    </script>
<div id="selenium-highlight"></div>