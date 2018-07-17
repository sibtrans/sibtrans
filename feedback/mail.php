<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отправить e-mail");
?>



<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.inputmask-multi.min.js" type="text/javascript"></script>
<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.inputmask.bundle.js" type="text/javascript"></script>

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


			$(document.body).off('click', '#feedback-form input[type="submit"]').on('click', '#feedback-form input[type="submit"]', function(){

				AjaxSendCounter = 0;

				$('#feedback-form ').removeData('validator'); //  This will remove validation for the form then initialize it again with the new settings


							//   check phone
						$.validator.addMethod("ALLphone", function(value, elem) {
								var inputNumber = $(elem).val();  // или value
							var ph = $(elem).attr("placeholder").split('_').length;

							console.log(ph);
							console.log(inputNumber);


							if(inputNumber.length == (ph - 1))
							{
								return true;

							}
							else
							{
								return false;
							}

							},"Введите корректный номер");

				var rules = {

										email:{
											//required: true,
												email: true
											},
											fio:{
												required: true,
												minlength: 3
											},
										subject:{	
											required: true,
											minlength: 3},

										message:{
											required: true,
											minlength: 20},

										phone:{
											//required: true,           
											//ALLphone: true
								}
							};

							var messages = {


												fio: { required: "Это поле должно быть заполнено",
												    minlength:"ФИО должно быть не менее трёх символов" 
												},
										subject:{
												required: "Это поле должно быть заполнено",
												    minlength:"Тема должна быть не менее трёх символов" 
												},
										message:{
												required: "Это поле должно быть заполнено",
												    minlength:"Сообщение должно быть не менее 20 символов" 
												},
										email: {
													required:"Введите корректный email адрес",
													email:"Введите корректный email адрес"
												},
										phone:{
											required: "Введите корректный номер"
												}
										};




						// validate signup form on keyup and submit
					$("#feedback-form").validate({
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
				var form = $('#feedback-form');
				var dta=form.serialize()+"&action=os-mail";
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







<div style="display:none">
    <div id="details_dialog_contentEMAIL" class="details_dialog_contentEMAIL">
        <div class="dialogModal_header" style="position:absolute; left:29%;">Отправка сообщения</div>
        <div class="dialogModal_content">
           Cообщение отправлено. Cпасибо!<br>
        </div>
        <div class="dialogModal_footer">
            <!--<button type="button" class="btn btn-primary" data-dialogmodal-but="next">ОК</button>-->
            <button type="button" class="btn btn-default" data-dialogmodal-but="ok">ОК</button>
        </div>
    </div>


</div>


<br/>
<br/>
<br/>
<br/>
<div class="pw">
<div style="margin:0 auto; width:88%;">
	<h2 class="page-title">Отправить e-mail</h2>
	<div style="width:700px;" id="form_email">
		<form id="feedback-form" action="/post.php" method="POST">


			<div class="form-row">
				<div style="float:left; width:50%;">
					<span style="font-size:14px; font-weight:bolder; color:#4e4b49; text-size-adjust:none;" class="required">Ваше имя</span>
					<input name="fio" type="text" value="" class="form-input" style="width:90%; margin-top:5px;"/> 
				</div>
				<div style="float:left; width:50%;">
					<span style="font-size:14px; font-weight:bolder; color:#4e4b49; text-size-adjust:none;" class="required">Тема сообщения</span>
					<input name="subject" type="text" value=""  class="form-input" style="width:90%; margin-top:5px;"/>
				</div>
				<div style="clear:left;"></div>
			</div>
			<br/>

			<div class="form-row">
				<div style="float:left; width:100%;">
				<span style="font-size:smaller; font-weight:bolder; color:#4e4b49; text-size-adjust:none;" class="required">Ваше сообщение</span>
				<textarea name="message"  class="form-input" style="width:95%; padding-right:10px; padding-left:10px; margin-top:3px; border-style: solid; border-color: gray; border-width: thin;"></textarea>
				</div>
					<div style="clear:left;"></div>
			</div>
			<br/>


			<div class="form-row">
				<div style="float:left; width:50%;">
					<span style="font-size:14px; font-weight:bolder; color:#4e4b49; text-size-adjust:none;"  >Контактный телефон</span>
					<input name="phone" id="feedback_phone" type="text" value="" class="form-input"  style="width:90%; margin-top:5px;"/> 
				</div>
				<div style="float:left; width:50%;">
					<span style="font-size:14px; font-weight:bolder; color:#4e4b49; text-size-adjust:none;"  >e-mail</span>
					<input name="email" type="text" value=""  class="form-input" style="width:90%; margin-top:5px;"/>
				</div>
				<div style="clear:left;"></div>
			</div>
			<br/>


			<div class="form-row">
						<div style="float:left; width:100%;">
							<p style="padding-bottom:15px; font-size:11px; color:gray; text-size-adjust:none;">Специалисты сервиса &nbsp;"обратной&nbsp;связи"&nbsp; обязательно&nbsp;ответят&nbsp;на &nbsp; ваш&nbsp;   вопрос&nbsp;   в &nbsp;   ближайшее &nbsp;  время. &nbsp; Сервис &nbsp; предоставляется &nbsp; в &nbsp; рабочие дни, 
							&nbsp; с 08:30 до 17:30 &nbsp; часов &nbsp; по новосибирскому времени.</p><p style="padding-bottom:15px; font-size:11px; color:gray; text-size-adjust:none;">Нажимая&nbsp;&nbsp; на &nbsp;&nbsp;кнопку&nbsp;&nbsp; "Отправить",&nbsp; &nbsp;Вы&nbsp; даёте&nbsp; &nbsp;согласие&nbsp; на &nbsp;обработку&nbsp; персональных данных в соответствии с Политикой конфиденциальности.</p>
						</div>
					<div style="clear:left;"></div>
			</div>
			<br/>
			<input type="submit" class="form-btn" value="Отправить"/>
		</form>
			
		</div>
	</div>
</div>



<script  type="text/javascript">


	var maskList = $.masksSort($.masksLoad("<? echo SITE_TEMPLATE_PATH; ?>/json/phone-codes.json"), ['#'], /[0-9]|#/, "mask");
	var maskOpts = {
		inputmask: {
			definitions: {
				'#': {
					validator: "[0-9]",
					cardinality: 1
				}
			},
			//clearIncomplete: true,
			showMaskOnHover: false,
			autoUnmask: true
		},
		match: /[0-9]/,
		replace: '#',
		list: maskList,
		listKey: "mask",
		onMaskChange: function(maskObj, completed) {
			if (completed) {
				var hint = maskObj.name_ru;
				if (maskObj.desc_ru && maskObj.desc_ru != "") {
					hint += " (" + maskObj.desc_ru + ")";
				}

			}
			$(this).attr("placeholder", $(this).inputmask("getemptymask"));
		}
	};

$('#feedback_phone').inputmasks(maskOpts);


</script>




<?$APPLICATION->AddChainItem($APPLICATION->GetTitle());?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>