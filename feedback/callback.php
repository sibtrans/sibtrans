<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказать звонок");
?> 
<br />
 
<br />
 
<br />
 
<br />







<script src="//cdn.jsdelivr.net/jquery/3.0.0-beta1/jquery.min.js"></script><!-- библиотека нужна для корректного отображения всплювающих модальных окон-->
<script type="text/javascript">



	$(document).ready(function() {


	   function modalwindow(){
		$('.details_dialog_contentCallback123').dialogModal({
						topOffset: 0,
						top: '12%',
						onDocumentClickClose: false,
						onOkBut: function (event, el, current) { window.location.href = "../index.php";},
						onLoad: function (el, current) { },
						onClose: function (el, current) { window.location.href = "../index.php"; },
						onCancelBut: function (event, el, current) {  window.location.href = "../index.php";  }
					});

	   }


		$('#form_callback').off('click', 'input[type="submit"]').on('click', 'input[type="submit"]', function(){
			var form=$(this).parents('form');
			var dta=form.serialize()+"&action=callback2";
			$.ajax({
				type: "POST",
				url: "/formsSender.php",
				data: dta,
				dataType:"json",
				success: function(result){
					//console.log(result);
					//if(result.state=="success")
						modalwindow();
				}
				,complete: function(a,b){
				}
			});	
			return false;	
				
				
				
								
		});

	});


</script>

<div style="display:none">
    <div  class="details_dialog_contentCallback123">
        <div class="dialogModal_header">Отправка заявки</div>
        <div class="dialogModal_content">
            Ваша заявка отправлена! В ближайшее время наш специалист свяжется с вами.<br>
        </div>
        <div class="dialogModal_footer">
            <!--<button type="button" class="btn btn-primary" data-dialogmodal-but="next">ОК</button>-->
            <button type="button" class="btn btn-default" data-dialogmodal-but="ok">ОК</button>
        </div>
    </div>


</div>

 
<div class="pw">
	<div style="margin:0 auto; width:88%;">
  <h2 class="page-title">Заказать звонок</h2>
 	 
  				<div style="width:400px;" id="form_callback">
					 <form action="#" method="POST">
							<p style="font-size:12px; color:gray; padding-bottom:3px;">Как нам к Вам обращаться</p>
						 <div class="form-row" style="height:40px;">
								<input name="fio" type="text" value="" class="form-input w100" placeholder="Ф.И.О"/>
							</div>
						<br/>
							<p style="font-size:12px; color:gray; padding-bottom:3px;">Когда Вам будет удобнее ответить на звонок</p>
							<div class="form-row" style="height:50px;">
								<input name="dt" type="text" value="" class="form-input w50" placeholder="Дата: <?=date('d-m-Y')?>"/>
								<input name="tm" type="text" value="" class="form-input w50" placeholder="Время: 15:10"/>
								<div class="clear"></div>
							</div>
						 <label style="font-size:12px; color:gray; padding-bottom:3px;" class="required">Номер телефона</label> 
							<div class="form-row" style="height:52px;">
								<input name="phone_country" type="text" value="+7" class="form-input w10 digits"  maxlength="2"/>
								<input name="phone_city" type="text" value="" class="form-input w20 numbers" maxlength="3"/>
								<input name="phone_number" type="text" value="" class="form-input numbers" style="width:47.5%;"/>
								<div class="clear"></div>
							</div>
							<p style="padding-bottom:15px; font-size:11px; color:gray;">Специалисты &nbsp;сервиса &nbsp;&nbsp;"обратный &nbsp;звонок"&nbsp; &nbsp;обязательно&nbsp; &nbsp;ответят &nbsp;&nbsp;на &nbsp; ваш&nbsp;&nbsp;   вопрос&nbsp;   в &nbsp;   указанное &nbsp;  время  &nbsp; или &nbsp;   в  &nbsp; течении &nbsp; 15 &nbsp;  минут&nbsp;  после &nbsp; отправки запроса.
								Сервис &nbsp; предоставляется &nbsp; в &nbsp; рабочие дни, &nbsp; с 08:30 до 17:30 &nbsp; часов &nbsp; по новосибирскому времени.</p>
							<p style="padding-bottom:15px; font-size:11px; color:gray;">Нажимая&nbsp;&nbsp; на &nbsp;&nbsp;кнопку&nbsp;&nbsp; "Отправить",&nbsp; &nbsp;Вы&nbsp; даёте&nbsp; &nbsp;согласие&nbsp; на &nbsp;обработку&nbsp; персональных данных в соответствии с Политикой конфиденциальности.</p>
							<input type="submit" class="form-btn" style="margin:0" value="Отправить"/>
						 <div clear:both;></div>
						 </form>
						 
				</div>
	<br/>
	<br/>
 </div>
</div>

 <?$APPLICATION->AddChainItem($APPLICATION->GetTitle());?> <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>