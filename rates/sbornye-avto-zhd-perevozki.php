<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сборные авто и ж/д перевозки");
?>




<style>
    div#wrapper a:link {
        color: white;
        text-decoraton: none;
    }

    div#wrapper a:hover {
        color: brown;
    }

    ul {
        list-style: disc outside;
    }

    #preskurant table {
        width: auto;
        border: solid;
        border-width: thin;
    }

    #preskurant tr {
        border: solid;
        border-width: thin;
    }

    #preskurant td {
        padding: 2px;
        border: solid;
        border-width: thin;
        font-size: small;
        vertical-align: middle;
        border-color: gray;
        padding-top: 4px;
        padding-bottom: 4px;
    }

    #preskurant th {
        padding: 2px;
        border: solid;
        border-width: thin;
        font-size: small;
        vertical-align: middle;
        border-color: gray;
        padding-top: 4px;
        padding-bottom: 4px;
        background: lightgray;
    }
</style>


<script type="text/javascript">



	 $(document).ready(function ()
	{




			// закрывание выпадающего списка
				$('body').click(function(){
					$('.btn_down_List').click(function(e) {  

						//console.log(this);
							return false;
					});

					if($('input:focus').length == 0)
					{
						$('.city_list_List').css('display','none');
					}
		
				});


				$('.btn_reverse_List_rates').click(function(){

					var Idfrom =  $('#rates-form').find('#city_from_List').find('input').attr('selectedid');
					//var cIdfrom = $(Idfrom).clone();

					var valfrom =  $('#rates-form').find('#city_from_List').find('input').val();
					//var cvalfrom = $(valfrom).clone();




					var IdTo =  $('#rates-form').find('#city_to_List').find('input').attr('selectedid');
					//var cIdTo = $(IdTo).clone();

					var valTo =  $('#rates-form').find('#city_to_List').find('input').val();
					//var cvalTo = $(valTo).clone();




					 $('#rates-form').find('#city_to_List').find('input').attr('selectedid', Idfrom);
					 $('#rates-form').find('#city_to_List').find('input').val(valfrom);



					 $('#rates-form').find('#city_from_List').find('input').attr('selectedid', IdTo);
					 $('#rates-form').find('#city_from_List').find('input').val(valTo);



				



					//	$('#city_to_List').find('input').text(Txtfrom);


				});




		$('#rates-form').on('submit', function(e) {



			var selected = [];

			selected.push({ID: 'GorodFrom_Id', value: $('#GorodFrom_Id').is(':checked')});
			selected.push({ID: 'GorodTo_Id',  value: $('#GorodTo_Id').is(':checked')});

			selected.push({ID: 'DopServiceFrom_Id', value: $('#DopServiceFrom_Id').is(':checked') });
			selected.push({ID: 'DopServiceTo_Id', value: $('#DopServiceTo_Id').is(':checked') });


			console.log( $('#rates-form').find('#city_from_List input').attr("selectedid"));
			console.log( $('#rates-form').find('#city_to_List input').attr("selectedid"));

			selected.push({ID: 'from', value: $('#rates-form').find('#city_from_List input').attr("selectedid") });
			selected.push({ID: 'to', value: $('#rates-form').find('#city_to_List input').attr("selectedid") });

			e.preventDefault();
			$.ajax({
				url :'../rates/sbornye-avto-zhd-perevozki_Ajax.php',
				type: "POST",
                 dataType: 'text',
				 data: {selected: selected},
				 success:function(data){
							$('#content_p').html(data); 


	 		    }

			});



		});




	});

</script>





<div id="wrapper" style="margin: 0px auto; width: 1250px; min-height:320px;">
    <br /> <br /> <br /> <br /> <br /><br /><br /><br />

    <p style="text-align:left">
        <font color="#790000" size="5" style="font-family:Tahoma;"><? echo $APPLICATION->GetTitle(); ?></font>
    </p>

    <div id="mini-calc_List" style="position:inherit; padding-left:0;">
		<form action="" method="post" id="rates-form" name="rates-form">
        <table>
            <tbody>
                <tr>
                    <td>

                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        <div>
                                            <p style="font-size: x-small; margin-bottom:4px; color:gray;">Город отправления</p>
                                            <div id="city_from_List" class="city-select_List">
                                                <div class="btn_down_List"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                                <div class="city_list_List">
                                                    <?foreach(getCities() as $key=>$value):?>
                                                    <div class="city_item_List" id="city<?=$key;?>"><?=$value;?></div>
                                                    <?endforeach;?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="vertical-align:bottom;">
                                        <div class="btn_reverse_List_rates" style="position:inherit;"></div>
                                    </td>
                                    <td>
                                        <div>
                                            <p style="font-size: x-small; margin-bottom:4px; color:gray;">Город назначения</p>
                                            <div id="city_to_List" class="city-select_List">
                                                <div class="btn_down_List"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                                                <div class="city_list_List">
                                                    <?foreach(getCities() as $key=>$value):?>
                                                    <div class="city_item_List" id="city<?=$key;?>"><?=$value;?></div>
                                                    <?endforeach;?>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="preiskurant1">
                                        <input type="checkbox" name="CheckService" value="GorodFrom" id="GorodFrom_Id">
                                        <label for="GorodFrom_Id" id="LGorodFrom_Id">Экспедирование по городу</label>
                                    </td>
                                    <td></td>
                                    <td class="preiskurant1">
                                        <input type="checkbox" name="CheckService" value="GorodTo" id="GorodTo_Id">
                                        <label for="GorodTo_Id">Экспедирование по городу</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="preiskurant">
                                        <input type="checkbox" name="CheckService" value="DopServiceFrom" id="DopServiceFrom_Id">
                                        <label for="DopServiceFrom_Id">Дополнительный сервис</label>
                                    </td>
                                    <td></td>
                                    <td class="preiskurant">
                                        <input type="checkbox" name="CheckService" value="DopServiceTo" id="DopServiceTo_Id">
                                        <label for="DopServiceTo_Id">Дополнительный сервис</label>
                                    </td>
                                </tr>
                            </tbody> 
                        </table> 

                    </td>
                    <td> 
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>
                    <td style="vertical-align:middle; padding-top:13px;">
                        <button style="margin-bottom:14px;" class="btn-city-select_List" type="submit">Показать</button>
						<br/>
						 <div class="ref-city-select_List">
								 <table id="hrefPrice" style="margin:0px; width:100%;">
									 <tr>
										 <td style="text-align:center; border-right:solid; border-width:thin; width:33.7%;">
											 <input class="print-btn" type="button" onclick="printDiv()" value="Печать" />
										 </td>
										 <td style="text-align:center;">
											 <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
											 "AREA_FILE_SHOW" => "page",
											 "AREA_FILE_SUFFIX" => "inc",
											 "AREA_FILE_RECURSIVE" => "N",
											 "EDIT_TEMPLATE" => "standard.php"
											 )
											 );?>
	
										 </td>
									 </tr>
								 </table>
							 </div>

                   </td> 
                </tr>
                 <tr>
                     <td></td>
                     <td></td>
                     <td>

                     </td>
                </tr>
            <tbody>
        </table>
		</form>
    </div>

    <div id="printableArea">
        <div id="content_p"></div>
    </div>


</div>
<br>
 <? $APPLICATION->AddChainItem($APPLICATION->GetTitle(), $APPLICATION->GetCurPage()); ?>


<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>



