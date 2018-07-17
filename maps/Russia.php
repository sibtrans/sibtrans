<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Филиалы \"Байт-Транзит\"");
$APPLICATION->SetTitle("Title");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");?> 

	<script src="https://yandex.st/jquery/2.2.3/jquery.min.js" type="text/javascript"></script>

			<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>



  <style type="text/css">
        html, body, #map {
            width: 100%;
            padding: 0;
            margin: 0;
            font-family: Arial;

        }

        #map {
            height: 600px;
        }
  
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
			padding-top: 82px;
			margin-top: 1px;
    		min-height: 0;
		}
	
		p {
			font-size: 9pt;
		}

		  .tabmenu{ width: 20%; 
					background: white; 
					opacity: 0.8; 
					z-index: 100; 
					position: absolute; 
					left: 10px; 
					top: 20px;
					}


	#map_container {
		width:100%;
	
		display:block;
	}

	  .day_week{ border-style:solid; border-color:#8e211e; color:black; border-width:thin; border-radius:6px;}

    </style>





<?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"filials_maps2", 
	array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "fls",
		"IBLOCK_ID" => "1",
		"NEWS_COUNT" => "300",
		"SORT_BY1" => "NAME",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "NAME",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "PHONE_OOP",
			1 => "Email",
			2 => "ADDRESS",
			3 => "YANDEX_MAP",
			4 => "STORAGE_CARGO",
			5 => "OFFICE",
			6 => "v_Sun",
			7 => "v_Tue",
			8 => "v_Fri",
			9 => "v_Sat",
			10 => "v_Thu",
			11 => "v_Mon",
			12 => "v_Wed",
			13 => "RESIV_SEND_CARGO",
			14 => "p_Fri",
			15 => "p_Sun",
			16 => "p_Tue",
			17 => "p_Mon",
			18 => "p_Sat",
			19 => "p_Wed",
			20 => "p_Thu",
			21 => "DIF_HOUR_MOSCOW",
			22 => "URL_ACTION",
			23 => "PHONE_D",
			24 => "TRANSLIT",
			25 => "PHONE",
			26 => "",
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
		"CACHE_TYPE" => "N",
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
		"COMPONENT_TEMPLATE" => "filials_maps2",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?> 






<script type="text/javascript">

$(document).ready(function(){




var timer;
	function getLocationTime(nd){



			var ndd = nd;
			var mseconds = 0;
		   (function(){
	
			var date = new Date(ndd + mseconds);

			var time = date.getHours() +':'+date.getMinutes()+':'+date.getSeconds();
	
			   // console.log(date); //.addClass('day_week');



			mseconds = mseconds + 1000;


		 $('.location_time').empty();
		  $('.location_time').append(time);
		   clearTimeout(timer);
		   timer = window.setTimeout(arguments.callee, 1000);
		  })();
	};

	function getTimeMoscow(obj)
	{
  		var dif_hour_Moscow = $(obj).find('#dif_hour_Moscow').text();

		//console.log(dif_hour_Moscow); // разница в часах от Москвы

			$.ajax({
				url :'../maps/get-time-Moscow.php',
				type: "POST",
                 dataType: 'text',
				 success:function(Moscow_time){
					 //var date = new Date(html);
					 // console.log(html);  // Московское время
						var arr = Moscow_time.split("|");
						var d = new Date(arr[2],arr[1]-1,arr[0],arr[3],arr[4],arr[5]);
						var nd = d.getTime()+ parseInt(dif_hour_Moscow)*60*60*1000;

					 //	var nd=new Date(d.getTime()+ parseInt(dif_hour_Moscow)*60*60*1000);
					 //console.log(nd);
					 //var hours = nd.getHours(); //returns 0-23
					 //if(hours < 10){hours = '0' + hours;}
					 // var minutes = nd.getMinutes(); //returns 0-59
					 //  if(minutes < 10){minutes = '0' + minutes;}
					 /// var seconds = nd.getSeconds(); //returns 0-59


					 // $('.location_time').text(hours + ' : ' + minutes );

					 getLocationTime(nd);

					}
				});



	}



	function openTab(evt, cityName) {
			$('.tabcontent').css('display','none');
			$('.tablinks').removeClass("active");
			$('#'+cityName).css('display','block');
			evt.addClass("active");
		}



	$.urlParam = function(name){

			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			return results[1] || 0;

	}





 $('#map').css('height', ($(document).height() - $('header').height())+'px');


// Группы объектов
	var g0={name:"Все адреса", image:"/bitrix/templates/main/images/all_adres.png", id:"London", items:[]};
	var g1={name:"Приём-выдача груза", image:"/bitrix/templates/main/images/resiv_send_cargo.png",  id:"Paris",  items:[]};
	var g2={name:"Ответственное хранение груза", image:"/bitrix/templates/main/images/storage_cargo.png",  id:"Tokyo",  items:[]};
	var g3={name:"Офис",  image:"/bitrix/templates/main/images/office.png",  id:"novosib", items:[]};







 $(".shop-data").each(function(){
	 var item={
		 center: [parseFloat($(this).attr("data-yandex-x")),parseFloat($(this).attr("data-yandex-y"))],
		 name: $(this).attr("data-name"),
		 adress:  $(this).attr("data-address"),
		 resiv_send_cargo: $(this).attr("data-resiv-send-cargo"), 
		 data_storage_cargo: $(this).attr("data-storage-cargo"),  
		 data_office:$(this).attr("data-office"), 
		 ballon_id:$(this).attr("data-ballon-id")



	 };
	 //console.log(this);
	 //console.log(item);
		g0.items.push(item);

	 if($(this).attr("data-resiv-send-cargo")=="1"){
		g1.items.push(item);
	 };
	 if($(this).attr("data-storage-cargo")=="1"){
			g2.items.push(item);
		 };
	 if($(this).attr("data-office")=="1"){
			g3.items.push(item);
		 };
	 });
var groups = [g0,g1,g2,g3];
	//console.log(groups);
ymaps.ready(init);

var myMap;

function init() {


var xx = undefined;
var yy = undefined;
var xyzoom = undefined;



	if(window.location.href.indexOf("?x") > -1 && window.location.href.indexOf("&y") > -1 && window.location.href.indexOf("&zoom") > -1)
	{
		xx = $.urlParam('x');
		yy = $.urlParam('y');
		xyzoom = $.urlParam('zoom');



	}

	if(window.location.href.indexOf("&CityPhoneNumber") > -1)
	{
		var phone =  $.urlParam('CityPhoneNumber').replace(new RegExp('%20', 'g'), ' ');
	    $("#phone-office-location").text(phone);
		$("#phone-office-location").attr("href", phone);

		//console.log(phone);

							// запись данных в сессию
									getPhoneNumberCityFromSession((function(output){
										//console.log('запись данных в сессию', PhoneCity);
									}), phone);


	}





		if(xx == undefined || yy == undefined || xyzoom == undefined)
		{
			// Создание экземпляра карты.
			 myMap = new ymaps.Map('map', {
				 center: [50.443705, 30.530946],
				zoom: 4,
				controls: ['typeSelector',  'fullscreenControl'] 
			});
		}
		else
		{
			//	console.log(xx);
			//console.log(yy);
			//console.log(xyzoom);





			// Создание экземпляра карты.
			 myMap = new ymaps.Map('map', {
				 center: [xx, yy],
				zoom: xyzoom,
				controls: ['typeSelector',  'fullscreenControl'] 
			});

		}

			
	

				var searchControl = new ymaps.control.SearchControl({
				 options: {
					 float: 'right',
					 floatIndex: 100,
					 noPlacemark: true
				 }
			});
			myMap.controls.add(searchControl);




        // Контейнер для меню.
	//    menu = $('<ul class="menu"/>');

	menu = $('<div class="tab"/>');

    for (var i = 0, l = groups.length; i < l; i++) {
        createMenuGroup(groups[i], i);
    }

    function createMenuGroup(group, index) {
        // Пункт меню.
		// var menuItem = $('<li><a href="#">' + group.name + '</a></li>'),  
		var menuItem;
		var state;
		if(index == 0)
		{

 		menuItem = $('<button style="width: 25%; height: 83px; position:absolute; top:0%;" data-group="'+group.id+'" class="tablinks active">' +
							'<div>' +
								'<img src="' + group.image + '" alt="' + group.name + '" />' +
								'<p>' + group.name + '</p>' +
						 '</div>' +
						'</button>' +
 							'<div id="'+group.id+'" class="tabcontent" style="display:block;">');

		}else{

			menuItem = $('<button style="width: 25%; height: 83px; position:absolute; top:0%; left:'+ 25 * index  +'%" data-group="'+group.id+'" class="tablinks">' +
							'<div>' +
								'<img src="' + group.image + '" alt="' + group.name + '" />' +
								'<p>' + group.name + '</p>' +
						 '</div>' +
						'</button>' +
							'<div id="'+group.id+'" class="tabcontent" style="display:none;">'); 
		}



        // Коллекция для геообъектов группы.
            var collection = new ymaps.GeoObjectCollection(null, { }),

        // Контейнер для подменю.
				  submenu = $('<div style="background-color:white">');
		collection.options.set({ balloonMaxWidth:600, balloonMaxHeight:600 });


        // Добавляем коллекцию на карту.
        myMap.geoObjects.add(collection);
        // Добавляем подменю.
        menuItem
			 .append(submenu)
            // Добавляем пункт в меню.
            .appendTo(menu)
            // По клику удаляем/добавляем коллекцию на карту //и скрываем/отображаем подменю.
			//.find('button')
            .bind('click', function () {
				//console.log(collection.getParent());

				// if(collection.getParent()) {
					 //myMap.geoObjects.remove(collection);
					 myMap.geoObjects.removeAll();
					 //myMap.geoObjects.add(collection);
					 // submenu.hide();
				//   } else {
					 myMap.geoObjects.add(collection);
					   // submenu.show();
				//}
            });

        for (var j = 0, m = group.items.length; j < m; j++) {
            createSubMenu(group.items[j], collection, submenu);
        }
    }

    function createSubMenu(item, collection, submenu) {

       var images = "";

		if(item.resiv_send_cargo == "1")
		{
			images = '<img src="/bitrix/templates/main/images/resiv_send_cargo.png" alt="Приём-выдача груза" />';
		}
		if(item.data_storage_cargo == "1")
		{
			images = images + '<img src="/bitrix/templates/main/images/storage_cargo.png" alt="Ответственное хранение груза" />';
		}
		if(item.data_office == "1")
		{
			images = images + '<img src="/bitrix/templates/main/images/office.png" alt="Офис" />';
		}
		 data_office:$(this).attr("data-office")



        // Пункт подменю.
        var submenuItem = $('<div style="padding: 10px;">'+
								'<div style="border-width: thin; border-bottom-style: solid; border-color: lightgray; padding: 10px;">' +
									'<div style="float: left; width: 50%; text-align: left;">'+
										'<p style="color: rgb(142, 33, 30); font-weight: 700;"><a href="#">' + item.name + '</a></p><br/>' +
										'<p>'+ item.adress +'</p>'+
									'</div>'+
									'<div style="float: left; width: 50%; text-align: right;">'+
										images +
									'</div>'+
                					'<div style="clear:left;"></div>'+
								'</div>'+
							'</div>'),
        // Создаем метку.
			placemark = new ymaps.Placemark(item.center, { balloonContent: $('#'+item.ballon_id).html(), balloonMaxWidth:600, balloonMaxHeight:600}, {
				 iconLayout: 'default#image',
				 iconImageHref: '/bitrix/templates/main/images/filials.png',
				 iconImageSize: [50, 50], 
				 iconImageOffset: [-35, 70],
				 iconOffset: [-35, -70],
 				iconLayout: 'default#imageWithContent'

			 });



					placemark.events.add("click", function (e) {
							
											var props  = e.get('target').properties,
											bContent = props.get('balloonContent');
											getTimeMoscow(bContent);
						//console.log(bContent);
							
										});


        // Добавляем метку в коллекцию.
		collection.add(placemark);




        // Добавляем пункт в подменю.
        submenuItem
            .appendTo(submenu)
            // При клике по пункту подменю открываем/закрываем баллун у метки.
            .find('a')  
            .bind('click', function () {


            
                myMap.geoObjects.each(function (collection) {

                    collection.each(function (obj) {

                        obj.options.set({ iconImageHref: '/bitrix/templates/main/images/filials.png'}); 
						obj.options.set({ zIndex: 100,  balloonMaxWidth:600, balloonMaxHeight:600 }); 
					

                    });

                });


				placemark.options.set({ zIndex:200,  balloonMaxWidth:600, balloonMaxHeight:600 });

				placemark.options.set({ iconImageHref: '/bitrix/templates/main/images/gray_filials.png' });




                // Плавно меняем центр карты на координаты метки.
                myMap.panTo(placemark.geometry.getCoordinates(), {
                    delay: 0,
                    callback: function (e) {
		
                    }
                });



                if (!placemark.balloon.isOpen()) {
					placemark.balloon.open(); 

					var props  = placemark.properties,
					bContent = props.get('balloonContent');
					getTimeMoscow(bContent);
					//console.log(bContent);


                } else {
                    placemark.balloon.close();

                }  
                return false;
            });   
    }


    

    // Добавляем меню в тэг BODY.
    menu.appendTo($('#ttt'));


    // Выставляем масштаб карты чтобы были видны все группы.
	if(xx == undefined || yy == undefined || xyzoom == undefined){
			 myMap.setBounds(myMap.geoObjects.getBounds());
	}
	//else{
	//		$('#ttt').css('display','none');
	//	}

	$('button').click(function(){
				openTab($(this), $(this).attr('data-group'));

	});




}
	});

</script>

<div class="relative">

<div id="ttt" class="tabmenu"></div>





    <div id="map"></div>

</div>

</body>
</html>