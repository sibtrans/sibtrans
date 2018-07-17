<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("TITLE", "Грузоперевозки Барнаул - Транспортная Компания «Байт Транзит»");
$APPLICATION->SetTitle("Пожелания и замечания");
?> 



<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.validate.js" type="text/javascript"></script>

<style>
	/*проверка перед отправкой*/
	input.error {border:1px; border-style:solid; border-color:red;}
	input.error:focus{border-color:gray;}
	
	input:focus {
    outline: 0;
	}

	label.error {
		color: red;
		font-style: italic;
		display: block;
    	font-size: small;
	}
	



</style>


<script  type="text/javascript">



$(document).ready(function() {

		$().ready(function() {


		var AjaxSendCounter=0;
		$.validator.setDefaults({

			submitHandler: function(){

				if(AjaxSendCounter==0){
						AjaxSendCounter=1;
					OrderSend();

				}
				//	return false;
			}
		});


				$(document.body).off('click', '#feedback_idea input[type="submit"]').on('click', '#feedback_idea input[type="submit"]', function(){

				AjaxSendCounter = 0;

				$('#feedback_idea').removeData('validator'); //  This will remove validation for the form then initialize it again with the new settings




				var rules = {
										email:{
											  required: true,
												email: true
											},
											fio:{
												required: true,
												minlength: 3
											},
										message:{
											required: true,
											minlength: 20}
							};

							var messages = {
												fio: { required: "Это поле должно быть заполнено",
												    minlength:"ФИО должно быть не менее трёх символов" 
												},

										message:{
												required: "Это поле должно быть заполнено",
												    minlength:"Сообщение должно быть не менее 20 символов" 
												},
										email: {
													required:"Это поле должно быть заполнено",
													email:"Введите корректный email адрес"
												}
										};




						// validate signup form on keyup and submit
					$("#feedback_idea").validate({
						focusInvalid: false,
							ignore:':hidden:not(.not_ignor)',
 							rules:rules,
							highlight: function(el) {},
							unhighlight: function(el) {	},
							messages: messages
						});
				});



		function OrderSend() // отправка 
		{

			$('.form-btn').attr("disabled","disabled");

			//var form=$(this).parents('form');
				var form = $('#feedback_idea');
				var dta=form.serialize()+"&action=os-idea";
				$.ajax({
					type: "POST",
					url: "/formsSender.php",
					data: dta,
					dataType:"json",
					success: function(result){
						console.log(result);
						if(result.state=="success")
						window.location.href = "../feedback/feedback-secsess.php";

					}
					,complete: function(a,b){
					}
				});	
				return false;	
		}


			});
		});
	</script>


 
<div style="display: none;"> 
  <div id="details_dialog_contentEMAIL" class="details_dialog_contentEMAIL"> 
	  <div class="dialogModal_header"><h2 class="page-title" style="margin:0;">Пожелания и замечания</h2></div>
   
	  <div class="dialogModal_content"><b>Благодарим Вас за оставленный отзыв. Ваше мнение очень Важно для нас.</b>
      <br />
     </div>
   
    <div class="dialogModal_footer"> 
<!--<button type="button" class="btn btn-primary" data-dialogmodal-but="next">ОК</button>-->
 <button type="button" class="btn btn-default" data-dialogmodal-but="ok">ОК</button> </div>
   </div>
 </div>
 
<br />
 
<br />
 
<br />
 
<br />
 
<div class="pw"> 
  <div style="margin: 0px auto; width: 88%;"> 	
    <h2 class="page-title">Пожелания и замечания</h2>
   	
    <div style="width: 700px;" id="form_email">
		<form id="feedback_idea" action="/post.php" method="POST"> 			
        <div class="form-row"> 				
          <div style="float: left; width: 50%;"> 					
			<span style="font-size: 14px; font-weight: bolder; color: rgb(78, 75, 73); text-size-adjust: none;" class="required">Ваше имя</span> 					
			<input name="fio" type="text" value="" class="form-input" style="width: 90%; margin-top: 5px;" /> 				</div>
         				
          <div style="float: left; width: 50%;"> 					
			<span style="font-size: 14px; font-weight: bolder; color: rgb(78, 75, 73); text-size-adjust: none;" class="required">Ваш e-mail</span> 					
			<input name="email" type="text" value="" class="form-input" style="width: 90%; margin-top: 5px;" /> 				</div>
         				
          <div style="clear: left;"></div>
         			</div>
       			
        <br />
       			
        <div class="form-row"> 				
          <div style="float: left; width: 100%;"><span style="font-size: smaller; font-weight: bolder; color: rgb(78, 75, 73); text-size-adjust: none;" class="required">Комментарий</span> 				
			<textarea name="message" class="form-input" style="width: 95%; padding-right: 10px; padding-left: 10px; margin-top: 3px;  border-style: solid; border-color: gray; border-width: thin;"></textarea> 		
		</div>
          <div style="clear: left;"></div>
       </div>
       			
        <br />
       			
        <div class="form-row"> 						
          <div style="float: left; width: 100%;"> 							
            <p style="padding-bottom: 15px; font-size: 11px; color: gray; text-size-adjust: none;">Специалисты сервиса &nbsp;&quot;обратной&nbsp;связи&quot;&nbsp; обязательно&nbsp;ответят&nbsp;на &nbsp; ваш&nbsp; вопрос&nbsp; в &nbsp; ближайшее &nbsp; время. &nbsp; Сервис &nbsp; предоставляется &nbsp; в &nbsp; рабочие дни, 							&nbsp; с 08:30 до 17:30 &nbsp; часов &nbsp; по новосибирскому времени.</p>
          
            <p style="padding-bottom: 15px; font-size: 11px; color: gray; text-size-adjust: none;">Нажимая&nbsp;&nbsp; на &nbsp;&nbsp;кнопку&nbsp;&nbsp; &quot;Отправить&quot;,&nbsp; &nbsp;Вы&nbsp; даёте&nbsp; &nbsp;согласие&nbsp; на &nbsp;обработку&nbsp; персональных данных в соответствии с Политикой конфиденциальности.</p>
           						</div>
         					
          <div style="clear: left;"></div>
         			</div>
        <br />
			<input type="submit" class="form-btn" value="Отправить" /> 

       		</form>
		</div>
  
    <div style="width: 700px;" id="form_email"></div>



 <?$APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"reviewes", 
	array(
		"DISPLAY_DATE" => "N",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "N",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_MODE" => "Y",
		"IBLOCK_TYPE" => "review",
		"IBLOCK_ID" => "12",
		"NEWS_COUNT" => "2",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(
			0 => "NAME",
			1 => "PREVIEW_TEXT",
			2 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "TIME_REVIEW",
			2 => "DATE_REVIEW",
			3 => "",
		),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_BROWSER_TITLE" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PAGER_TEMPLATE" => "grid",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Отзывы",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"COMPONENT_TEMPLATE" => "reviewes",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
 	</div>
</div>

<?$APPLICATION->AddChainItem($APPLICATION->GetTitle());?> 
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>