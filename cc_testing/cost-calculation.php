

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Рассчитать стоимость");
?>

<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.2.620/styles/kendo.common.min.css" />
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.2.620/styles/kendo.uniform.min.css" />
<link rel="stylesheet" href="https://kendo.cdn.telerik.com/2018.2.620/styles/kendo.uniform.mobile.min.css" />


<script src="https://kendo.cdn.telerik.com/2018.2.620/js/kendo.all.min.js"></script>


<style>


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



    .sticky {
        position: fixed;
        z-index: 101;
    }
    .stop {
        position: relative;
        z-index: 101;
    }



</style>








<script type="text/javascript">



    $(document).ready(function ()
    {


		$("#place").on('input', function(){
			if(parseInt($(this).val()) > 699){
				$('#lblPlaceMax').css('display','block');
			}
			else{
				$('#lblPlaceMax').css('display','none');
				}
			});


        var val_from =  $('#form-calk').find('#city_from_List').find('input').val();
        var val_to = $('#form-calk').find('#city_to_List').find('input').val();
        $('#marshrut').text(val_from + ' - ' + val_to);



        $('#form-calk').on('submit', function(e) {



            var selected = [];


            $('input[type="checkbox"]').each(function(){

                selected.push({DATA_ID:$(this).attr('data-id'), ID:$(this).attr('id'), value: $(this).is(':checked'), name: $(this).attr('name') });

            });



            $('input[type="text"]').each(function(){

                selected.push({ID: $(this).attr('data-IDcheckbox'), value:  $(this).val(), name: $(this).attr('name'), wvc: $(this).attr('data-wvc') });

            });

            console.log( $('#form-calk').find('#city_from_List input').attr("selectedid"));
            console.log( $('#form-calk').find('#city_to_List input').attr("selectedid"));

            selected.push({ID: 'weight', value: $('#weight').val()});
            selected.push({ID: 'volume', value: $('#volume').val()});
            selected.push({ID: 'place', value: $('#place').val()});

            selected.push({ID: 'from', value: $('#form-calk').find('#city_from_List input').attr("selectedid") });
            selected.push({ID: 'to', value: $('#form-calk').find('#city_to_List input').attr("selectedid") });

            e.preventDefault();
            $.ajax({
                url :'/cost-calculation/calculation_Ajax.php',
                type: "POST",
                dataType: 'text',
                data: {selected: selected},
                success:function(data){



                    if(!data){
                        $('#content_cal').css("display","none");
                    }else{
                        $('#content_cal').css("display","");}
                    $('#content_cal').html(data);

                    $('#marshrut').html();

                    var val_from =  $('#form-calk').find('#city_from_List').find('input').val();
                    var val_to = $('#form-calk').find('#city_to_List').find('input').val();
                    $('#marshrut').text(val_from + ' - ' + val_to);


                }

            });



        });




    });








    function addurl(element){

        var from_id = $('#form-calk').find('#city_from_List').find('input').val();
        var to_id =	$('#form-calk').find('#city_to_List').find('input').val();

        var ccargo = $('input[name="input_Charakter_Cargo"]').val();

        var weight = $('#weight').val();
        var volume = $('#volume').val();
        var place = $('#place').val();

        var markup ="";

        $('[id^="MarkUp"]').each(function(){
            markup = markup + '&' + $(this).attr('id') + '=' +  $(this).is(':checked');

        });

        var BOXDeliveryOut_Id = $('#BOXDeliveryOut_Id').is(':checked');
        var BOXDeliveryOut_input = $('input[name="BOXDeliveryOut_input"]').val();

        var BOXDeliveryIn_Id = $('#BOXDeliveryIn_Id').is(':checked');
        var BOXDeliveryIn_input = $('input[name="BOXDeliveryIn_input"]').val();


        var serices_out = "";
        $('#div_input_ServiseDeliv_Out__kalc_d2l').find('input').each(function(){
            if($(this).is(':checkbox') == true)
            {
                serices_out = serices_out + '&' + $(this).attr('data-id') + '=' +  $(this).is(':checked');
            }else if($(this).is(':text') == true){
                serices_out = serices_out + '&data_idcheckbox' + $(this).attr('data-idcheckbox') + '=' +  $(this).val();
            }
        });

        var serices_in = "";
        $('#div_input_ServiseDeliv_Out__kalc_d2r').find('input').each(function(){
            if($(this).is(':checkbox') == true)
            {
                serices_in = serices_in + '&chBoxServiceDelivIn' + $(this).attr('data-id') + '=' +  $(this).is(':checked');
            }else if($(this).is(':text') == true){
                serices_in = serices_in + '&data_idcheckbox_In' + $(this).attr('data-idcheckbox') + '=' +  $(this).val();
            }
        });






        $(element).attr("href", '/cost-calculation/order.php' + '?from=' + from_id + '&to=' + to_id + '&ccargo='+ ccargo + '&weight=' + weight + '&volume=' + volume + '&place=' + place +
            markup + '&BOXDeliveryOut_Id=' + BOXDeliveryOut_Id + '&BOXDeliveryOut_input=' + BOXDeliveryOut_input + '&BOXDeliveryIn_Id=' + BOXDeliveryIn_Id + '&BOXDeliveryIn_input=' + BOXDeliveryIn_input + serices_out + serices_in);

    }






</script>




<div class="pw relative" style="width: 1100px">
    <br/><br/><br/><br/><br/><br/>
    <h2 class="page-title">Рассчитать стоимость</h2>
    <div id="example">
        <div class="demo-section k-content">
            <h4><label for="countries">Choose shipping countries:</label></h4>
            <input id="countries" style="width: 100%;" />
            <div class="demo-hint">Start typing the name of an European country</div>
        </div>

        <script>
            $(document).ready(function () {
                var data = [
                    "Albania",
                    "Andorra",
                    "Armenia",
                    "Austria",
                    "Azerbaijan",
                    "Belarus",
                    "Belgium",
                    "Bosnia & Herzegovina",
                    "Bulgaria",
                    "Croatia",
                    "Cyprus",
                    "Czech Republic",
                    "Denmark",
                    "Estonia",
                    "Finland",
                    "France",
                    "Georgia",
                    "Germany",
                    "Greece",
                    "Hungary",
                    "Iceland",
                    "Ireland",
                    "Italy",
                    "Kosovo",
                    "Latvia",
                    "Liechtenstein",
                    "Lithuania",
                    "Luxembourg",
                    "Macedonia",
                    "Malta",
                    "Moldova",
                    "Monaco",
                    "Montenegro",
                    "Netherlands",
                    "Norway",
                    "Poland",
                    "Portugal",
                    "Romania",
                    "Russia",
                    "San Marino",
                    "Serbia",
                    "Slovakia",
                    "Slovenia",
                    "Spain",
                    "Sweden",
                    "Switzerland",
                    "Turkey",
                    "Ukraine",
                    "United Kingdom",
                    "Vatican City"
                ];

                //create AutoComplete UI component
                $("#countries").kendoAutoComplete({
                    dataSource: data,
                    filter: "startswith",
                    placeholder: "Select country...",
                    separator: ", "
                });
            });
        </script>
    </div>

    <div id="max_calc_result" >
        <p class="title">Результаты расчета</p>
        <div class="wrp">
            <p id="marshrut" style="text-align:center;"></p>
            <table id="result" border="1" cellspacing="1">
                <tr>
                    <th>Категория скорости</th>
                    <th>Срок доставки, дни</th>
                    <th>Стоимость, руб.</th>
                </tr>
                <tfoot id="content_cal"></tfoot>
            </table>

            <a onclick="addURL(this)" href="../rates/sbornye-avto-zhd-perevozki.php">Посмотреть прайс-лист</a><br/><br/>

            <p style="font-size:small; color: #858585"><b>Обращаем Ваше внимание</b></p>
            <p style="font-size:small; color: #858585">
                Результаты расчета калькулятора являются предварительными.<br />
                Окончательная стоимость формируется только после сдачи груза.<br />
                Если есть особенности транспортировки Вашего груза, рекомендуем связаться с менеджерами компании.
            </p>
            <br/>

            <div style="width:200px; margin:0 auto;">
                <div class="btn-Order"><a style="color:white; text-decoration:none; font-weight:400;" id="href_order_params" onclick="addurl(this);">Оформить заявку</a></div>
            </div>
        </div>
    </div>



    <div id="max_calc">

        <form action="" method="post" id="form-calk" name="form-calk">

            <div class="row">

                <div id="mini-calc_List" style="position:inherit; padding:0;">
                    <div class="d2l">
                        <p class="sect_title required" style="margin-bottom: 10px;">Пункт отправления</p>

                        <div id="city_from_List" class="city-select_List" style="width:350px; margin-bottom: 10px;">
                            <div class="btn_down_List"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                            <div class="city_list_List">
                                <?foreach(getCities() as $key=>$value):?>
                                    <div class="city_item_List" id="city<?=$key;?>"><?=$value;?></div>
                                <?endforeach;?>
                            </div>
                        </div>
                        <div class="mla" style="margin:0px;">
                            <input type="checkbox" name="CheckService" id="BOXDeliveryOut_Id" data-show=".next">
                            <label for="BOXDeliveryOut_Id">забрать груз у отправителя</label>
                            <div class="data-show-content">
                                <input type="text" name="BOXDeliveryOut_input" class="ServiceInput" style="width:380px;" placeholder="Улица, дом, корпус" />
                            </div>
                        </div>
                    </div>
                    <div class="d2r">
                        <p class="sect_title required" style="margin-bottom: 10px;">Пункт назначения</p>

                        <div id="city_to_List" class="city-select_List" style="width:350px; margin-bottom: 10px;">
                            <div class="btn_down_List"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                            <div class="city_list_List">
                                <?foreach(getCities() as $key=>$value):?>
                                    <div class="city_item_List" id="city<?=$key;?>"><?=$value;?></div>
                                <?endforeach;?>
                            </div>
                        </div>
                        <div class="mla" style="margin:0px;">
                            <input type="checkbox" name="CheckService" id="BOXDeliveryIn_Id" data-show=".next">
                            <label for="BOXDeliveryIn_Id">доставить груз получателю</label>
                            <div class="data-show-content">
                                <input type="text" name="BOXDeliveryIn_input" class="ServiceInput" style="width:380px;" placeholder="Улица, дом, корпус" />
                            </div>
                        </div>

                        <div id="weight_List" style="display:none;"><input value="1" /></div>
                        <div id="vol_List" style="display:none;"><input value="1" /></div>
                        <div class="clear"></div>

                    </div>
                </div>
            </div>


            <br />
            <hr class="line-gradient">
            <br /><br />
            <p class="sect_title">Параметры груза</p><br /><br />

            <div class="row">
                <div class="d2l">
                    <div class="mla">
                        <div class="d3">
                            <label class="required">Вес</label><br />
                            <input id="weight" type="text"  class="weight-size-characteristics numbers_comma" style="width:90px; text-align:center; margin-top: 5px;" placeholder="               кг" value="<? if($_GET["weight"] !== "undefined"){ echo $_GET["weight"]; } ?>">
                        </div>

                        <div class="d3">
                            <label class="required">Объём</label><br />
                            <input id="volume" class="weight-size-characteristics numbers_comma" style="width:90px; text-align:center; margin-top: 5px;" placeholder="               м3"   value="<? if($_GET["volume"] !== "undefined"){ echo $_GET["volume"]; } ?>">
                        </div>
                        <div class="d3">
                            <label class="required">Мест</label><br />
                            <input id="place" class="weight-size-characteristics numbers" style="width:90px; text-align:center; margin-top: 5px" placeholder="              шт">
							<label id="lblPlaceMax" style="display:none; color:red; font-size:smaller; font-style:italic;">Максимальное количество мест &lt;=699</label>
                        </div>

                    </div>
                </div>
 				<div class="row">
                <div class="d2r">
                    <label class="required" style="margin-top: -2px;">Характер груза</label>
                    <div id="mini-calc_List" style="position:inherit; padding:0px; margin-top: 5px;">
                        <div id="city_from_List" class="city-select_List" data-CharacterCargo="text" style="width:350px;">
                            <div class="btn_down_List"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                            <div class="city_list_List">
                                <?foreach(GetCharacterCargo() as $key=>$value):?>
                                    <div class="city_item_List" id="<?=$key;?>"><?=$value;?></div>
                                <?endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div id="content_p" class="mla"></div>

            </div>


            <br /><br />


            <div style="width:200px; margin:0 auto;">
                <button class="btn-Order" style="width:100%; height:100%; cursor:pointer; color:white; font-weight: 400; float: left !important;" type="submit">Рассчитать стоимость</button>
            </div>


            <br />

        </form>





    </div>






</div>

<br />
<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/placeholders.min.js"></script>
<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery-1.10.2.min.js"></script>

<div style="clear:both;"></div>
<br>

<? $APPLICATION->AddChainItem($APPLICATION->GetTitle(), $APPLICATION->GetCurPage()); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>



<script type="text/javascript">



    (function(){
        var a = document.querySelector('#max_calc_result'), b = null, P = 0;  // если ноль заменить на число, то блок будет прилипать до того, как верхний край окна браузера дойдёт до верхнего края элемента. Может быть отрицательным числом
        window.addEventListener('scroll', Ascroll, false);
        document.body.addEventListener('scroll', Ascroll, false);
        function Ascroll() {
            if (b == null) {
                var Sa = getComputedStyle(a, ''), s = '';
                for (var i = 0; i < Sa.length; i++) {
                    if (Sa[i].indexOf('overflow') == 0 || Sa[i].indexOf('padding') == 0 || Sa[i].indexOf('border') == 0 || Sa[i].indexOf('outline') == 0 || Sa[i].indexOf('box-shadow') == 0 || Sa[i].indexOf('background') == 0) {
                        s += Sa[i] + ': ' +Sa.getPropertyValue(Sa[i]) + '; '
                    }
                }
                b = document.createElement('div');
                b.style.cssText = s + ' box-sizing: border-box; width: ' + a.offsetWidth + 'px;';
                a.insertBefore(b, a.firstChild);
                var l = a.childNodes.length;
                for (var i = 1; i < l; i++) {
                    b.appendChild(a.childNodes[1]);
                }
                a.style.height = b.getBoundingClientRect().height + 'px';
                a.style.padding = '0';
                a.style.border = '0';
            }
            var Ra = a.getBoundingClientRect(),
                R = Math.round(Ra.top + b.getBoundingClientRect().height - document.querySelector('#footer').getBoundingClientRect().top + 0);  // селектор блока, при достижении верхнего края которого нужно открепить прилипающий элемент;  Math.round() только для IE; если ноль заменить на число, то блок будет прилипать до того, как нижний край элемента дойдёт до футера
            if ((Ra.top - P) <= 0) {
                if ((Ra.top - P) <= R) {
                    b.className = 'stop';
                    b.style.top = - R +'px';
                } else {
                    b.className = 'sticky';
                    b.style.top = P + 'px';
                }
            } else {
                b.className = '';
                b.style.top = '';
            }
            window.addEventListener('resize', function() {
                a.children[0].style.width = getComputedStyle(a, '').width
            }, false);
        }
    })()


</script>




