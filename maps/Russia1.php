<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Карат России");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");?> 
<style>
    /* Style the tab */
    div.tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #ccc;
        width: 100%;
        margin: 0;
        border: none;
    }

        /* Style the buttons inside the tab */
        div.tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 7px;
            transition: 0.3s;
            font-size: 17px;
        }

            /* Change background color of buttons on hover */
            div.tab button:hover {
                background-color: #ddd;
            }

            /* Create an active/current tablink class */
            div.tab button.active {
                background-color: white;
                border: none;
            }

    /* Style the tab content */
    .tabcontent {
        display: none;
        border: 1px solid #ccc;
        border-top: none;
        width: 100%;
		max-height: 650px;
		height:auto;
        overflow-y: auto;
        padding: 0;
        border: none;
        padding-top: 10px;
		margin-top: 1px;
    }

    p {
        font-size: 8pt;
    }

#map_container {
    width:100%;

    display:block;
}
 
.marker-circ {
    color: #404040;
    font-size: 14px;
    font-weight: normal;
    height: 80px;
    line-height: 56px;
    width: 58px;
}
 


</style>

<script src="http://yandex.st/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
 
<script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>



<div class="relative"> 


   
 
<script type="text/javascript">
var map;
var Placemark,myClusterer;
function openTab(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
	<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"filials_maps", 
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "fls",
		"IBLOCK_ID" => "1",
		"NEWS_COUNT" => "20",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "PHONE",
			1 => "ADDRESS",
			2 => "YANDEX_MAP",
			3 => "STORAGE_CARGO",
			4 => "OFFICE",
			5 => "RESIV_SEND_CARGO",
			6 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"STRICT_SECTION_CHECK" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_NOTES" => "",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Новости",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "filials_maps",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>



</div>
<script type="text/javascript">
$(document).ready(function(){

 $('#map_container').css('height', ($(document).height() - $('header').height())+'px');
	// $('#ttt').css('height', ($('#map_container').height()-150)+'px');
	//$('.tabcontent').css('height', ($('#ttt').height()-85)+'px');

    //Если на странице есть контейнер для яндекс карты с id map_container, начинаем её формировать
    if($("#map_container").length > 0)
    {
 
        //yandex map
        ymaps.ready(function() {


            map = new ymaps.Map("map_container", {
                center: [54.980586598654526, 82.90562717079112], //Создаём карту с центром в городе "Ростов-на-Дону"
                zoom: 4,   //Увеличение 11
  				controls: ['typeSelector',  'fullscreenControl'] }

			);


			var searchControl = new ymaps.control.SearchControl({
				 options: {
					 float: 'right',
					 floatIndex: 100,
					 noPlacemark: true
				 }
			});
			map.controls.add(searchControl);



 
            //HTML шаблон балуна, того самого всплывающего блока, который появляется при щелчке на карту
            var myBalloonLayout = ymaps.templateLayoutFactory.createClass(
                       '<address class="address-map">'+
                       '<p><strong>$[properties.name]</strong><br/></p>'+
                       '<ul class="balloon-info">'+
                            '<li><strong>Адрес:&nbsp;</strong>$[properties.address]</li>'+
                            '<li><strong>Часы работы:&nbsp;</strong>$[properties.hours]</li>'+
                            '<li><strong>Телефон:&nbsp;</strong>$[properties.phone]</li>'+
                            '<li><strong>Руоководитель:&nbsp;</strong>$[properties.manager]</li>' +
                        '</ul>' +
                    '</address>'
                    );

			Placemark = {}; //Пустой объекта, куда будут помещены точки на для карты
 
            //Перебираем все блоки с картой и считываем данные для формирования точки и балуна по ранее заданному шаблону
            $(".shop-data").each(function(){




                //Координаты точки
                var X = $(this).attr("data-yandex-x");
                var Y = $(this).attr("data-yandex-y");
 
                Obj = $(this).attr("pointindex");
 
                //Создаём объект с заданными координатами и доп.свойствами
                Placemark[Obj] = new ymaps.Placemark([X,Y], {
                    name: $(this).attr("data-name"),    //Наименование магазина
                    address: $(this).attr("data-address"),  //Адрес
                    hours: $(this).attr("data-hours"),  //Часы работы
                    phone: $(this).attr("data-phone"),  //Контактный телефон
                    manager: $(this).attr("data-shop-manager"), //Руководитель
 					resiv_send_cargo: $(this).attr("data-resiv-send-cargo"), //Приём выдача груза
					data_storage_cargo: $(this).attr("data-storage-cargo"), //Хранение груза
					data_office: $(this).attr("data-office"),  // Офис
					iconContent: ''// '<div class="marker-circ">'+$(this).attr("data-index")+"</div>",   //Порядковый номер на карте
                },
					{	//Ниже некоторые параметры точки и балуна
			            balloonContentLayout: myBalloonLayout,	
			            balloonOffset: [5,0],
			            balloonCloseButton: true,
			            balloonMinWidth: 450,
			            balloonMaxWidth:450,
			            balloonMinHeught:150,
			            balloonMaxHeught:200,
			            iconImageHref: '/bitrix/templates/main/images/filials.png',	//Путь к картинке точки
			            iconImageSize: [70, 70],
			            iconImageOffset: [-24, -70],
			            iconLayout: 'default#imageWithContent',
			            iconactive: '/bitrix/templates/main/images/filials.png' //Путь к картинке точки при наведении курсора мыши
			        }
				);


							$(this).find('a').bind('click', function () {

										console.log(Placemark[Obj]);

											map.geoObjects.each(function (e){

												e.options.set({ iconImageHref:  '/bitrix/templates/main/images/filials.png'  }); 

											});


										Placemark[Obj].options.set({ iconImageHref: '/bitrix/templates/main/images/gray_filials.png' });


					

								});





  					map.geoObjects.add(Placemark[Obj]);




					






        });

			// $(".shop-data").css('display', 'none');



    }); 

		

}
});

</script>
</body>
</html>
