<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отправить заявку");
?>



<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.inputmask-multi.min.js" type="text/javascript"></script>
<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.inputmask.bundle.js" type="text/javascript"></script>

<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.validate.js" type="text/javascript"></script>

<link rel="stylesheet" href="<? echo SITE_TEMPLATE_PATH; ?>/css/popModal.css">

<style type="text/css">



	#menu-current-order a:hover{color:#8e211e; background-color:#BCBCBC;}
	#menu-current-order a{color:black; padding:10px; display:block;}



	.type-transp{
        width: 32.5%;
    }

    #MenuTypeOrder #preskurant table {
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
	
	#signupForm {
		width: 400px;
	}

	#newsletter_topics label.error {
		display: none;
		margin-left: 103px;
	}



</style>






<script  type="text/javascript">




$(document).ready(function() {


		$().ready(function() {
			
			// get code_1c
			$.ajax({ 
				url :'/cost-calculation/userdata.php',
				type: "POST",
				dataType: 'json',
				success:function(data){
					$('#code_1c').val(data.code_1c);
				}
			});

			// данные из лк в Заполнить моими реквизитами из личного кабинета
			$(function(){
				$("#sender_ur_Zapolnit_lc_Id, #sender_fis_Zapolnit_lc_Id, #resiv_ur_Zapolnit_lc_Id, #resiv_fis_Zapolnit_lc_Id, #pay_ur_Zapolnit_lc_Id, #pay_fis_Zapolnit_lc_Id").change(function(){
					//$(":checkbox").change(function(){
						if($(this).is(":checked"))
						{
							var obj = $(this);

							$.ajax({ 
								url :'/cost-calculation/userdata.php',
								type: "POST",
								 dataType: 'json',
								 success:function(data){
									 		//console.log(data);
											console.log(data.org);
									if(data.org !== undefined)
									{
									 if(data.org.toString().trim().length > 0 && data.org.indexOf('ч/л') == -1){ // юрик
											if($(obj).attr('id').substr(0, 9) == "sender_ur"){

													$('#sender-ur-Name_Id').val(data.fullname);
													$('#sender-ur-OrgPravForm_Id').val(data.org);
													$('#sender-ur-INN_Id').val(data.inn);
													$('#sender-ur-KPP_Id').val(data.mfo);
													$('#sender-ur-Contact_Id').val(data.korc);

												if(data.tel2.trim().length > 0){
												   $('#sender-ur-Phone_Id').val(data.tel2.replace(/\8+/,"+7"));
												}else{
												   $('#sender-ur-Phone_Id').val(data.tel1.replace(/\8+/,"+7"));
												}

											}else if($(obj).attr('id').substr(0, 8) == "resiv_ur"){

													$('#resiv-ur-Name_Id').val(data.fullname);
													$('#resiv-ur-OrgPravForm_Id').val(data.org);
													$('#resiv-ur-INN_Id').val(data.inn);
													$('#resiv-ur-KPP_Id').val(data.mfo);
													$('#resiv-ur-Contact_Id').val(data.korc);
												if(data.tel2.trim().length > 0){
												   $('#resiv-ur-Phone_Id').val(data.tel2.replace(/\8+/,"+7"));
												}else{
												   $('#resiv-ur-Phone_Id').val(data.tel1.replace(/\8+/,"+7"));
												}


											}else if($(obj).attr('id').substr(0, 6) == 'pay_ur'){
													console.log($(obj).attr('id'));

													$('#pay-ur-Name_Id').val(data.fullname);
													$('#pay-ur-OrgPravForm_Id').val(data.org);
													$('#pay-ur-INN_Id').val(data.inn);
													$('#pay-ur-KPP_Id').val(data.mfo);
													$('#pay-ur-Contact_Id').val(data.korc);
												if(data.tel2.trim().length > 0){
												   $('#pay-ur-Phone_Id').val(data.tel2.replace(/\8+/,"+7"));
												}else{
												   $('#pay-ur-Phone_Id').val(data.tel1.replace(/\8+/,"+7"));
												}

											}
									 	}
								 	} 

									if(data.org !== undefined)
									{
										if(data.org.indexOf('ч/л') !== -1)
										{

												if($(obj).attr('id').substr(0, 10) == 'sender_fis'){
		

		
													if(data.tel2 !== undefined)
													{
														if(data.tel2.trim().length > 0)
														{
															$('#sender-fis-Phone_Id').val(data.tel2.replace(/\8+/,"+7"));
														}
														else
														{
															$('#sender-fis-Phone_Id').val(data.tel1.replace(/\8+/,"+7"));
														}
													}
		
															console.log('sender_fis');
		
												}else if($(obj).attr('id').substr(0, 9) == 'resiv_fis'){
													if(data.tel2 !== undefined)
													{
														if(data.tel2.trim().length > 0){
															$('#resiv-fis-Phone_Id').val(data.tel2.replace(/\8+/,"+7"));
														}else{
															$('#resiv-fis-Phone_Id').val(data.tel1.replace(/\8+/,"+7"));
														}
													}
															console.log('resiv_fis');
		
													}else if($(obj).attr('id').substr(0, 7) == 'pay_fis'){
													if(data.tel2 !== undefined)
													{
														if(data.tel2.trim().length > 0){
															$('#pay-fis-Phone_Id').val(data.tel2.replace(/\8+/,"+7"));
														}else{
															$('#pay-fis-Phone_Id').val(data.tel1.replace(/\8+/,"+7"));
														}
		
													}
														console.log('pay_fis');
												}
											 }
										}
									}
								});
						}


					   }); 

				});
		});
});


</script>

<script  type="text/javascript">




$(document).ready(function() {


		$().ready(function() {





		//установка списка в третье лицо при правке на вкаладке ОТПРАВИТЕЛЬ для ЮРИКА
		$('.data-show-send-content-ur input').unbind('input').on('input',function(e){

			if($("#resiv_ur_IsSenderIsPayer option:selected").text().indexOf('Отправитель')!==-1){
					$("#resiv_ur_IsSenderIsPayer").val('Третье лицо');
			}

			if($("#pay_ur_IsSenderIsResiver option:selected").text().indexOf('Отправитель')!==-1){
					$("#pay_ur_IsSenderIsResiver").val('Третье лицо');
			}

		});

		//установка списка в третье лицо при правке на вкаладке ОТПРАВИТЕЛЬ для ФИЗИКА
		$('.data-show-send-content-fis input').unbind('input').on('input',function(e){

			if($("#resiv_fis_IsSenderIsPayer option:selected").text().indexOf('Отправитель')!==-1){
					$("#resiv_fis_IsSenderIsPayer").val('Третье лицо');
			}

			if($("#pay_fis_IsSenderIsResiver option:selected").text().indexOf('Отправитель')!==-1){
					$("#pay_fis_IsSenderIsResiver").val('Третье лицо');
			}

		});

		//установка списка в третье лицо при правке на вкаладке ПОЛУЧАТЕЛЬ для ЮРИКА
		$('.data-show-resiv-content-ur input').unbind('input').on('input',function(e){

			if($("#pay_ur_IsSenderIsResiver option:selected").text().indexOf('Получатель')!==-1){
					$("#pay_ur_IsSenderIsResiver").val('Третье лицо');
			}

		});

		//установка списка в третье лицо при правке на вкаладке ПЛАТЕЛЬЩИК для ЮРИКА
		$('.data-show-pay-content-ur input').unbind('input').on('input',function(e){

			if($("#resiv_ur_IsSenderIsPayer option:selected").text().indexOf('Плательщик')!==-1){
					$("#resiv_ur_IsSenderIsPayer").val('Третье лицо');
			}

		});

		//установка списка в третье лицо при правке на вкаладке ПОЛУЧАТЕЛЬ для ФИЗИКА
		$('.data-show-resiv-content-fis input').unbind('input').on('input',function(e){

			if($("#pay_fis_IsSenderIsResiver option:selected").text().indexOf('Получатель')!==-1){
					$("#pay_fis_IsSenderIsResiver").val('Третье лицо');
			}

		});

		//установка списка в третье лицо при правке на вкаладке ПЛАТЕЛЬЩИК для ФИЗИКА
		$('.data-show-pay-content-fis input').unbind('input').on('input',function(e){

			if($("#resiv_fis_IsSenderIsPayer option:selected").text().indexOf('Плательщик')!==-1){
					$("#resiv_fis_IsSenderIsPayer").val('Третье лицо');
			}

		});



			$(function(){

						// ГЛАВНЫЙ ВАЛИДАТОР
						var AjaxSendCounter=0;
						$.validator.setDefaults({

							submitHandler: function(){

								$('input[type="submit"]').focusin(function() {

									if(AjaxSendCounter==0){
											AjaxSendCounter=1;
											OrderSend();
									}
									//	return false;
								});

							}
						});



					$(document.body).unbind( "click",  'input[type="submit"]' ).on('click', 'input[type="submit"]', function(){
									SubmitFormValidator(true);
					});


				   //удаление прибавления элементов списка в зависимости от условии для соответствующей вкладке в зависимоти от положения ЮРИК ИЛИ ФИЗИК
					$('#typeClientSend_ur_id, #typeClientSend_fis_id, #typeClientResiv_fis_id, #typeClientResiv_ur_id, #typeClientPay_ur_id, #typeClientPay_fis_id').unbind("click").on('click', function(){

						////// ДЛЯ ЮРИКОВ ////////////////////////////////////////////
						if($("#typeClientResiv_ur_id").is(':checked')){

							if($("#typeClientSend_ur_id").is(':checked')){

									if($("#resiv_ur_IsSenderIsPayer option:contains('Отправитель')").length == 0){
										$('#resiv_ur_IsSenderIsPayer').append($("<option></option>").text('Отправитель'));} 
							}else{

								  $("#resiv_ur_IsSenderIsPayer option:contains('Отправитель')").remove();
							}

							if($("#typeClientPay_ur_id").is(':checked')){

									if($("#resiv_ur_IsSenderIsPayer option:contains('Плательщик')").length == 0){
										$('#resiv_ur_IsSenderIsPayer').append($("<option></option>").text('Плательщик'));} 
							}else{

								  $("#resiv_ur_IsSenderIsPayer option:contains('Плательщик')").remove();
							}

						}

						if($("#typeClientPay_ur_id").is(':checked')){

							if($("#typeClientSend_ur_id").is(':checked')){

									if($("#pay_ur_IsSenderIsResiver option:contains('Отправитель')").length == 0){
										$('#pay_ur_IsSenderIsResiver').append($("<option></option>").text('Отправитель'));} 
							}else{

								  $("#pay_ur_IsSenderIsResiver option:contains('Отправитель')").remove();
							}

							if($("#typeClientResiv_ur_id").is(':checked')){

									if($("#pay_ur_IsSenderIsResiver option:contains('Получатель')").length == 0){
										$('#pay_ur_IsSenderIsResiver').append($("<option></option>").text('Получатель'));} 
							}else{

								  $("#pay_ur_IsSenderIsResiver option:contains('Получатель')").remove();
							}
						}

						////// ДЛЯ ФИЗИКОВ ////////////////////////////////////////////
						if($("#typeClientResiv_fis_id").is(':checked')){

							if($("#typeClientSend_fis_id").is(':checked')){

									if($("#resiv_fis_IsSenderIsPayer option:contains('Отправитель')").length == 0){
										$('#resiv_fis_IsSenderIsPayer').append($("<option></option>").text('Отправитель'));} 
							}else{

								  $("#resiv_fis_IsSenderIsPayer option:contains('Отправитель')").remove();
							}

							if($("#typeClientPay_fis_id").is(':checked')){

									if($("#resiv_fis_IsSenderIsPayer option:contains('Плательщик')").length == 0){
										$('#resiv_fis_IsSenderIsPayer').append($("<option></option>").text('Плательщик'));} 
							}else{

								  $("#resiv_fis_IsSenderIsPayer option:contains('Плательщик')").remove();
							}

						}

						if($("#typeClientPay_fis_id").is(':checked')){

							if($("#typeClientSend_fis_id").is(':checked')){

									if($("#pay_fis_IsSenderIsResiver option:contains('Отправитель')").length == 0){
										$('#pay_fis_IsSenderIsResiver').append($("<option></option>").text('Отправитель'));} 
							}else{

								  $("#pay_fis_IsSenderIsResiver option:contains('Отправитель')").remove();
							}

							if($("#typeClientResiv_fis_id").is(':checked')){

									if($("#pay_fis_IsSenderIsResiver option:contains('Получатель')").length == 0){
										$('#pay_fis_IsSenderIsResiver').append($("<option></option>").text('Получатель'));} 
							}else{

								  $("#pay_fis_IsSenderIsResiver option:contains('Получатель')").remove();
							}
						}


					});



					//ЮРИК
					// вкладка получатель
					$("#resiv_ur_IsSenderIsPayer").change(function(){


									if($("#resiv_ur_IsSenderIsPayer option:selected").text().indexOf('Отправитель')!==-1){

										//$("#typeClientSend_ur_id").prop("checked", true);
										//$('.data-show-send-content-fis').css("display","none");
										//$('.data-show-send-content-fis').find('input[type="text"]').each(function(){ $(this).val("");})
										//$('.data-show-send-content-ur').css("display","block");
										$( "#sender_fis_Zapolnit_lc_Id" ).prop('checked', false); // снимаем галочку с Физика при переключ на Юрика 

												SubmitFormValidator();
												$("#form-calk-order").submit();

										if($('.data-show-send-content-ur').find('input.error:text').length > 0){

												$("#LBLresiv_ur_IsSenderIsPayer").text('');
												$("#LBLresiv_ur_IsSenderIsPayer").append("Отправитель заполнен некорректно");
												$("#LBLresiv_ur_IsSenderIsPayer").css('display', 'block');

											$("#resiv_ur_IsSenderIsPayer").val('Третье лицо');

										}else{ 	$("#LBLresiv_ur_IsSenderIsPayer").text(''); 
												$('#resiv-ur-Name_Id').val( $('#sender-ur-Name_Id').val() );
												$('#resiv-ur-OrgPravForm_Id').val( $('#sender-ur-OrgPravForm_Id').val() );
												$('#resiv-ur-INN_Id').val( $('#sender-ur-INN_Id').val() );
												$('#resiv-ur-KPP_Id').val( $('#sender-ur-KPP_Id').val() );
												$('#resiv-ur-Contact_Id').val( $('#sender-ur-Contact_Id').val() );
												$('#resiv-ur-Phone_Id').val( $('#sender-ur-Phone_Id').val() );

												$("#form-calk-order").submit();
										}

									}else if($("#resiv_ur_IsSenderIsPayer option:selected").text().indexOf('Плательщик')!==-1){

										//$("#typeClientPay_ur_id").prop("checked", true);
										//$('.data-show-pay-content-fis').css("display","none");
										//$('.data-show-pay-content-fis').find('input[type="text"]').each(function(){ $(this).val("");})
										//$('.data-show-pay-content-ur').css("display","block");
										$( "#pay_fis_Zapolnit_lc_Id" ).prop('checked', false); // снимаем галочку с Физика при переключ на Юрика 

												SubmitFormValidator();
												$("#form-calk-order").submit();

										if($('.data-show-pay-content-ur').find('input.error:text').length > 0){

												$("#LBLresiv_ur_IsSenderIsPayer").text('');
												$("#LBLresiv_ur_IsSenderIsPayer").append("Плательщик заполнен некорректно");
												$("#LBLresiv_ur_IsSenderIsPayer").css('display', 'block');

											$("#resiv_ur_IsSenderIsPayer").val('Третье лицо');

										}else{ 	$("#LBLresiv_ur_IsSenderIsPayer").text(''); 
												$('#resiv-ur-Name_Id').val( $('#pay-ur-Name_Id').val() );
												$('#resiv-ur-OrgPravForm_Id').val( $('#pay-ur-OrgPravForm_Id').val() );
												$('#resiv-ur-INN_Id').val( $('#pay-ur-INN_Id').val() );
												$('#resiv-ur-KPP_Id').val( $('#pay-ur-KPP_Id').val() );
												$('#resiv-ur-Contact_Id').val( $('#pay-ur-Contact_Id').val() );
												$('#resiv-ur-Phone_Id').val( $('#pay-ur-Phone_Id').val() );

												$("#form-calk-order").submit();

										}
									}
					});

					//ЮРИК
					// вкладка плательщик
					$("#pay_ur_IsSenderIsResiver").change(function() {



									if($("#pay_ur_IsSenderIsResiver option:selected").text().indexOf('Отправитель')!==-1){

										//$("#typeClientSend_ur_id").prop("checked", true);
										//$('.data-show-send-content-fis').css("display","none");
										//$('.data-show-send-content-fis').find('input[type="text"]').each(function(){ $(this).val("");})
										//$('.data-show-send-content-ur').css("display","block");
										$( "#sender_fis_Zapolnit_lc_Id" ).prop('checked', false); // снимаем галочку с Физика при переключ на Юрика  

												SubmitFormValidator();
												$("#form-calk-order").submit();

										if($('.data-show-send-content-ur').find('input.error:text').length > 0){

												$("#LBLPayer_ur_IsSenderIsPayer").text('');
												$("#LBLPayer_ur_IsSenderIsPayer").append("Отправитель заполнен некорректно");
												$("#LBLPayer_ur_IsSenderIsPayer").css('display', 'block');

											$("#pay_ur_IsSenderIsResiver").val('Третье лицо');

										}else{ 	$("#LBLPayer_ur_IsSenderIsPayer").text(''); 
												$('#pay-ur-Name_Id').val( $('#sender-ur-Name_Id').val() );
												$('#pay-ur-OrgPravForm_Id').val( $('#sender-ur-OrgPravForm_Id').val() );
												$('#pay-ur-INN_Id').val( $('#sender-ur-INN_Id').val() );
												$('#pay-ur-KPP_Id').val( $('#sender-ur-KPP_Id').val() );
												$('#pay-ur-Contact_Id').val( $('#sender-ur-Contact_Id').val() );
												$('#pay-ur-Phone_Id').val( $('#sender-ur-Phone_Id').val() );

												$("#form-calk-order").submit();

										}

									}else if($("#pay_ur_IsSenderIsResiver option:selected").text().indexOf('Получатель')!==-1){


										//$("#typeClientResiv_ur_id").prop("checked", true);
										//$('.data-show-resiv-content-fis').css("display","none");
										//$('.data-show-resiv-content-fis').find('input[type="text"]').each(function(){ $(this).val("");})
										//$('.data-show-resiv-content-ur').css("display","block");
										$( "#resiv_fis_Zapolnit_lc_Id" ).prop('checked', false); // снимаем галочку с Физика при переключ на Юрика 

											SubmitFormValidator();
											$("#form-calk-order").submit();

										if($('.data-show-resiv-content-ur').find('input.error:text').length > 0){

												$("#LBLPayer_ur_IsSenderIsPayer").text('');
												$("#LBLPayer_ur_IsSenderIsPayer").append("Получатель заполнен некорректно");
												$("#LBLPayer_ur_IsSenderIsPayer").css('display', 'block');

											$("#pay_ur_IsSenderIsResiver").val('Третье лицо');

										}else{ 	$("#LBLPayer_ur_IsSenderIsPayer").text(''); 
												$('#pay-ur-Name_Id').val( $('#resiv-ur-Name_Id').val() );
												$('#pay-ur-OrgPravForm_Id').val( $('#resiv-ur-OrgPravForm_Id').val() );
												$('#pay-ur-INN_Id').val( $('#resiv-ur-INN_Id').val() );
												$('#pay-ur-KPP_Id').val( $('#resiv-ur-KPP_Id').val() );
												$('#pay-ur-Contact_Id').val( $('#resiv-ur-Contact_Id').val() );
												$('#pay-ur-Phone_Id').val( $('#resiv-ur-Phone_Id').val() );

												$("#form-calk-order").submit();
										}
									}
					});

					//ФИЗИК
					// вкладка получатель
					$("#resiv_fis_IsSenderIsPayer").change(function() {



									if($("#resiv_fis_IsSenderIsPayer option:selected").text().indexOf('Отправитель')!==-1){

										//$("#typeClientSend_fis_id").prop("checked", true);
										//$('.data-show-send-content-fis').css("display","block");
										//$('.data-show-send-content-ur').css("display","none");
										//$('.data-show-send-content-ur').find('input[type="text"]').each(function(){ $(this).val("");})
										$("#sender_ur_Zapolnit_lc_Id").prop('checked', false); // снимаем галочку с Юрика  при переключ на  Физика 

											SubmitFormValidator();
											$("#form-calk-order").submit();

										if($('.data-show-send-content-fis').find('input.error:text').length > 0){
												$("#LBLresiv_fis_IsSenderIsPayer").text('');
												$("#LBLresiv_fis_IsSenderIsPayer").append("Отправитель заполнен некорректно");
												$("#LBLresiv_fis_IsSenderIsPayer").css('display', 'block');

											$("#resiv_fis_IsSenderIsPayer").val('Третье лицо');

										}else{ 	$("#LBLresiv_fis_IsSenderIsPayer").text('');
												$('#resiv-fis-Contact_Id').val( $('#sender-fis-Contact_Id').val() );
												$('#resiv-fis-Phone_Id').val( $('#sender-fis-Phone_Id').val() );
												$('#resiv-fis-SDoc_Id').val( $('#sender-fis-SDoc_Id').val() );
												$('#resiv-fis-NDoc_Id').val( $('#sender-fis-NDoc_Id').val() );

												$("#form-calk-order").submit();
										}

									}else if($("#resiv_fis_IsSenderIsPayer option:selected").text().indexOf('Плательщик')!==-1){


										//$("#typeClientPay_fis_id").prop("checked", true);
										//$('.data-show-pay-content-fis').css("display","block");
										//$('.data-show-pay-content-ur').css("display","none");
										//$('.data-show-pay-content-ur').find('input[type="text"]').each(function(){ $(this).val("");})
										$("#pay_ur_Zapolnit_lc_Id").prop('checked', false); // снимаем галочку с Юрика  при переключ на  Физика 

											SubmitFormValidator();
											$("#form-calk-order").submit();

										if($('.data-show-pay-content-fis').find('input.error:text').length > 0){
												$("#LBLresiv_fis_IsSenderIsPayer").text('');
												$("#LBLresiv_fis_IsSenderIsPayer").append("Плательщик заполнен некорректно");
												$("#LBLresiv_fis_IsSenderIsPayer").css('display', 'block');
											$("#resiv_fis_IsSenderIsPayer").val('Третье лицо');

										}else{ 	$("#LBLresiv_fis_IsSenderIsPayer").text('');
												$('#resiv-fis-Contact_Id').val( $('#pay-fis-Contact_Id').val() );
												$('#resiv-fis-Phone_Id').val( $('#pay-fis-Phone_Id').val() );
												$('#resiv-fis-SDoc_Id').val( $('#pay-fis-SDoc_Id').val() );
												$('#resiv-fis-NDoc_Id').val( $('#pay-fis-NDoc_Id').val() );

												$("#form-calk-order").submit();
										}
									}
					});

					//ФИЗИК
					// вкладка плательщик
					$("#pay_fis_IsSenderIsResiver").change(function() {



									if($("#pay_fis_IsSenderIsResiver option:selected").text().indexOf('Отправитель')!==-1){

										//$("#typeClientSend_fis_id").prop("checked", true);
										//$('.data-show-send-content-fis').css("display","block");
										//$('.data-show-send-content-ur').css("display","none");
										//$('.data-show-send-content-ur').find('input[type="text"]').each(function(){ $(this).val("");})
										$("#sender_ur_Zapolnit_lc_Id").prop('checked', false); // снимаем галочку с Юрика  при переключ на  Физика 

											SubmitFormValidator();
											$("#form-calk-order").submit();

										if($('.data-show-send-content-fis').find('input.error:text').length > 0){

												$("#LBLPayer_fis_IsSenderIsPayer").text('');
												$("#LBLPayer_fis_IsSenderIsPayer").append("Отправитель заполнен некорректно");
												$("#LBLPayer_fis_IsSenderIsPayer").css('display', 'block');
											$("#pay_fis_IsSenderIsResiver").val('Третье лицо');
										}else{ 	$("#LBLPayer_fis_IsSenderIsPayer").text('');
												$('#pay-fis-Contact_Id').val( $('#sender-fis-Contact_Id').val() );
												$('#pay-fis-Phone_Id').val( $('#sender-fis-Phone_Id').val() );
												$('#pay-fis-SDoc_Id').val( $('#sender-fis-SDoc_Id').val() );
												$('#pay-fis-NDoc_Id').val( $('#sender-fis-NDoc_Id').val() );

												$("#form-calk-order").submit();

										}

									}else if($("#pay_fis_IsSenderIsResiver option:selected").text().indexOf('Получатель')!==-1){

										//$("#typeClientResiv_fis_id").prop("checked", true);
										//$('.data-show-resiv-content-fis').css("display","block");
										//$('.data-show-resiv-content-ur').css("display","none");
										//$('.data-show-resiv-content-ur').find('input[type="text"]').each(function(){ $(this).val("");})
										$("#resiv_ur_Zapolnit_lc_Id").prop('checked', false); // снимаем галочку с Юрика  при переключ на  Физика 

											SubmitFormValidator();
											$("#form-calk-order").submit();

										if($('.data-show-resiv-content-fis').find('input.error:text').length > 0){

												$("#LBLPayer_fis_IsSenderIsPayer").text('');
												$("#LBLPayer_fis_IsSenderIsPayer").append("Получатель заполнен некорректно");
												$("#LBLPayer_fis_IsSenderIsPayer").css('display', 'block');
											$("#pay_fis_IsSenderIsResiver").val('Третье лицо');
										}else{ 	$("#LBLPayer_fis_IsSenderIsPayer").text('');

												$('#pay-fis-Contact_Id').val( $('#resiv-fis-Contact_Id').val() );
												$('#pay-fis-Phone_Id').val( $('#resiv-fis-Phone_Id').val() );
												$('#pay-fis-SDoc_Id').val( $('#resiv-fis-SDoc_Id').val() );
												$('#pay-fis-NDoc_Id').val( $('#resiv-fis-NDoc_Id').val() );
										}
									}
					});



			});
	});

});


	function SubmitFormValidator(ChangeTabsValid)
	{

					AjaxSendCounter = 0;

				//$(document.body).off('click', 'input[type="submit"]');


							$('#form-calk-order').removeData('validator'); //  This will remove validation for the form then initialize it again with the new settings




						//   check CharakterCargo
						$.validator.addMethod("CharakterCargo", function(value, elem) {

							var element = $('#city_from_List_cc');
							var id = parseInt(element.find('input').attr('selectedid'));

							if(id > 0)   // или value
							{
							    if($.trim(element.find('input').val().toLowerCase()) == $.trim(element.find('div#'+ id).text().toLowerCase()))
									{
										return true;
									}
							}
							else
							{
								return false;
							}

							},"Выберите значение из списка");


						//   check CorrectHour
						$.validator.addMethod("CorrectHour", function(value, elem) {

							var inputHour = parseInt($(elem).val());  // или value

							if(inputHour <= 23)   // или value
							{
										return true;
							}
							else if(inputHour > 23)
							{
								$(elem).val('23');

								return true;
							}

							},"");


						//   check INN
						$.validator.addMethod("inn", function(value, elem) {

							var inputNumber = $(elem).val();  // или value
							console.log(inputNumber);
							//преобразуем в строку
							inputNumber = "" + inputNumber;
							//преобразуем в массив
							inputNumber = inputNumber.split('');
							//для ИНН в 10 знаков
							if((inputNumber.length == 10) &&
								(inputNumber[9] ==
									((2 * inputNumber[  0] + 4 * inputNumber[1] + 10 *
									 inputNumber[2] + 3 * inputNumber[3] + 5 *
									 inputNumber[4] + 9 * inputNumber[5] + 4 *
									 inputNumber[6] + 6 * inputNumber[7] + 8 *
									 inputNumber[8]) % 11) % 10))
							{
								return true;
							//для ИНН в 12 знаков
							}
							else if((inputNumber.length == 12) &&
								((inputNumber[10] == ((7 * inputNumber[ 0] + 2 *
								inputNumber[1] + 4 * inputNumber[2] + 10 *
								inputNumber[3] + 3 * inputNumber[4] + 5 *
								inputNumber[5] + 9 * inputNumber[6] + 4 *
								inputNumber[7] + 6 * inputNumber[8] + 8 *
								inputNumber[9]) % 11) % 10) &&
								(inputNumber[11] == ((3 * inputNumber[ 0] + 7 *
								 inputNumber[1] + 2 * inputNumber[2] + 4 *
								 inputNumber[3] + 10 * inputNumber[4] + 3 *
								 inputNumber[5] + 5 * inputNumber[6] + 9 *
								 inputNumber[7] + 4 * inputNumber[8] + 6 *
								 inputNumber[9] + 8 * inputNumber[10]) % 11) % 10)))
							{
								return true;
							} 
							else
							{
								return false;
							}

							},"Введите корректный ИНН");
						
						jQuery.validator.addMethod("kpp", function(value, element, param) {
						 return this.optional(element) || value.length == param;
						}, $.validator.format("КПП должен содержать {0} символов."));



							//   check phone
				  $.validator.addMethod("ALLphone", function(value, elem) {
								var inputNumber = $(elem).val();  // или value
							var ph = $(elem).attr("placeholder").split('_').length;

							//console.log(ph);
							//console.log(inputNumber);
					  		
					  		var autoUrlArr = location.href.split('order.php');
					  		
					  		if(autoUrlArr[1].indexOf('link_1C=') + 1){
								inputNumber = inputNumber.replace(/[^0-9]/g, '');
							}
							   
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

									customer_Email:{
												required: true,
												normalizer: function(value) {
													  return $.trim(value);
													},
												email: true
											},

									customer_Contact:{
												required: true,
											  	normalizer: function(value) {
												  return $.trim(value);
												},
												minlength: 3
											},


								PhoneBOXDeliveryOut:{
											required: true,           
											ALLphone: true
									},
								customer_Phone:{
											required: true,           
											ALLphone: true
								},
								PhoneBOXDeliveryIn:{
											required: true,           
											ALLphone: true
								},

								//забрать груз****************************
								AddressBOXDeliveryOut:{
											required: true,
										    normalizer: function(value) {
											  return $.trim(value);},
								},
								DateBOXDeliveryOut:{
											required: true
								},
								Hour1BOXDeliveryOut:{
											required: true,
									     	CorrectHour:true
								},
								Hour2BOXDeliveryOut:{

											required: true,
											CorrectHour:true
								},

								ContactBOXDeliveryOut:{

											required: true,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								//***********************************
								//Доставлю самостоятельно
								DateDeliveryCust:{
											required: true,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								Hour1DeliveryCust:{
											required: true,
											CorrectHour:true
									//CorrectHour: true
								},
								Hour2DeliveryCust:{
											required: true,
											CorrectHour:true
								},
								//***********************************
								//доставить груз получателю 
								AddressBOXDeliveryIn:{
											required: true,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								DateBOXDeliveryIn:{
											required: true,

								},
								Hour1BOXDeliveryIn:{
											required: true,
											CorrectHour:true
								},
								Hour2BOXDeliveryIn:{
											required: true,
											CorrectHour:true
								},
								ContactBOXDeliveryIn:{
											required: true,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								// вес объём мест
								weight:{
											required: true,
											number:true,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								volume:{
											required: true,
											number:true,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								place:{
											required: true,
											number:true,
											max:699,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								//доп сервис в пункте назначения
								InputForChBoxServiceDelivIn:{
											required: true,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								//доп сервис в пункте отправления
								InputForChBoxServiceDelivOut:{
											required: true,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								//Особые условия транспортировки
								lengh:{
											required: true,
											number:true,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								height:{
											required: true,
											number:true,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								width:{
											required: true,
											number:true,
												normalizer: function(value) {
													  return $.trim(value);
													}
								},
								input_Charakter_Cargo:{
									//required: true,
									CharakterCargo: true,
											required: true,
												normalizer: function(value) {
													  return $.trim(value);
													}
									}

							};
				/////////////////////////




					if($('#typeClientSend_ur_id').is(':checked'))
					{
						//console.log('отправ юрик');

						var sender_ur_Contact = {};
						sender_ur_Contact.required = true;
						sender_ur_Contact.minlength = 3;
						sender_ur_Contact.normalizer = function(value) {  return $.trim(value); };
						rules["sender_ur_Contact"] = sender_ur_Contact;

						var sender_ur_Name = {};
						sender_ur_Name.required = true;
						sender_ur_Name.minlength = 1;
						sender_ur_Name.normalizer = function(value) {  return $.trim(value); };
						rules["sender_ur_Name"] = sender_ur_Name;

						var sender_ur_OrgPravForm = {};
						sender_ur_OrgPravForm.required = true;
						sender_ur_OrgPravForm.minlength = 2;
						sender_ur_OrgPravForm.normalizer = function(value) {  return $.trim(value); };
						rules["sender_ur_OrgPravForm"] = sender_ur_OrgPravForm;

						var sender_ur_INN = {};
						sender_ur_INN.required = true;
						//sender_ur_INN.inn = true;
						sender_ur_INN.number = true;
						sender_ur_INN.normalizer = function(value) {  return $.trim(value); };
						rules["sender_ur_INN"] = sender_ur_INN;

						sender_ur_KPP = {};
						//sender_ur_KPP.required = true;
						//sender_ur_KPP.kpp = 9;
						sender_ur_KPP.number = true;
						rules["sender_ur_KPP"] = sender_ur_KPP;

						var sender_ur_Phone = {};
						sender_ur_Phone.required = true;
						sender_ur_Phone.ALLphone = true;
						sender_ur_Phone.normalizer = function(value) {  return $.trim(value); };
						rules["sender_ur_Phone"] = sender_ur_Phone;


					}else if($('#typeClientSend_fis_id').is(':checked')){

						//console.log('отправ физик');

 					  	var sender_fis_Contact = {};
						sender_fis_Contact.required = true;
						sender_fis_Contact.minlength = 3;
						sender_fis_Contact.normalizer = function(value) {  return $.trim(value); };
						rules["sender_fis_Contact"] = sender_fis_Contact;

 					  	var sender_fis_NDoc = {};
						sender_fis_NDoc.required = true;
						sender_fis_NDoc.normalizer = function(value) {  return $.trim(value); };
						rules["sender_fis_NDoc"] = sender_fis_NDoc;

 					  	var sender_fis_SDoc = {};
						sender_fis_SDoc.required = true;
						sender_fis_SDoc.normalizer = function(value) {  return $.trim(value); };
						rules["sender_fis_SDoc"] = sender_fis_SDoc;

 					  	var sender_fis_Phone = {};
						sender_fis_Phone.required = true;
						sender_fis_Phone.ALLphone = true;
						rules["sender_fis_Phone"] = sender_fis_Phone;

					}

					if($('#typeClientResiv_ur_id').is(':checked'))
					{
					

						var resiv_ur_Name = {};
						resiv_ur_Name.required = true;
						resiv_ur_Name.normalizer = function(value) {  return $.trim(value); };
						rules["resiv_ur_Name"] = resiv_ur_Name;

 					  	var resiv_ur_OrgPravForm = {};
						resiv_ur_OrgPravForm.required = true;
						resiv_ur_OrgPravForm.minlength = 2;
						resiv_ur_OrgPravForm.normalizer = function(value) {  return $.trim(value); };
						rules["resiv_ur_OrgPravForm"] = resiv_ur_OrgPravForm;

 					  	var resiv_ur_Contact = {};
						resiv_ur_Contact.required = true;
						resiv_ur_Contact.minlength = 3;
						resiv_ur_Contact.normalizer = function(value) {  return $.trim(value); };
						rules["resiv_ur_Contact"] = resiv_ur_Contact;

 					  	var resiv_ur_INN = {};
						resiv_ur_INN.required = true;
						//resiv_ur_INN.inn = true;
						resiv_ur_INN.number = true;
						resiv_ur_INN.normalizer = function(value) {  return $.trim(value); };
						rules["resiv_ur_INN"] = resiv_ur_INN;

						resiv_ur_KPP = {};
						//resiv_ur_KPP.required = true;
						//resiv_ur_KPP.kpp = 9;
						resiv_ur_KPP.number = true;
						rules["resiv_ur_KPP"] = resiv_ur_KPP;

 					  	var resiv_ur_Phone = {};
						resiv_ur_Phone.required = true;
						resiv_ur_Phone.ALLphone =true;
						rules["resiv_ur_Phone"] = resiv_ur_Phone;

					}else if($('#typeClientResiv_fis_id').is(':checked')){

 					  	var resiv_fis_SDoc = {};
						resiv_fis_SDoc.required = true;
						resiv_fis_SDoc.normalizer = function(value) {  return $.trim(value); };
						rules["resiv_fis_SDoc"] = resiv_fis_SDoc;

 					  	var resiv_fis_NDoc = {};
						resiv_fis_NDoc.required = true;
						resiv_fis_NDoc.normalizer = function(value) {  return $.trim(value); };
						rules["resiv_fis_NDoc"] = resiv_fis_NDoc;

 					  	var resiv_fis_Contact = {};
						resiv_fis_Contact.required = true;
						resiv_fis_Contact.minlength = 3;
						resiv_fis_Contact.normalizer = function(value) {  return $.trim(value); };
						rules["resiv_fis_Contact"] = resiv_fis_Contact;

 					  	var resiv_fis_Phone = {};
						resiv_fis_Phone.required = true;
						resiv_fis_Phone.ALLphone =true;
						rules["resiv_fis_Phone"] = resiv_fis_Phone;

					}


					if($('#typeClientPay_ur_id').is(':checked'))
					{

						var pay_ur_Name = {};
						pay_ur_Name.required = true;
						pay_ur_Name.normalizer = function(value) {  return $.trim(value); };
						rules["pay_ur_Name"] = pay_ur_Name;


 					  	var pay_ur_OrgPravForm = {};
						pay_ur_OrgPravForm.required = true;
						pay_ur_OrgPravForm.minlength = 2;
						pay_ur_OrgPravForm.normalizer = function(value) {  return $.trim(value); };
						rules["pay_ur_OrgPravForm"] = pay_ur_OrgPravForm;

 					  	var pay_ur_Contact = {};
						pay_ur_Contact.required = true;
						pay_ur_Contact.minlength = 3;
						pay_ur_Contact.normalizer = function(value) {  return $.trim(value); };
						rules["pay_ur_Contact"] = pay_ur_Contact;

 					  	var pay_ur_INN = {};
						pay_ur_INN.required = true;
						pay_ur_INN.number = true;
						//pay_ur_INN.inn = true;
						pay_ur_INN.normalizer = function(value) {  return $.trim(value); };
						rules["pay_ur_INN"] = pay_ur_INN;

						pay_ur_KPP = {};
						//pay_ur_KPP.required = true;
						//pay_ur_KPP.kpp = 9;
						pay_ur_KPP.number = true;
						rules["pay_ur_KPP"] = pay_ur_KPP;

 					  	var pay_ur_Phone = {};
						pay_ur_Phone.required = true;
						pay_ur_Phone.ALLphone =true;
						rules["pay_ur_Phone"] = pay_ur_Phone;

					}else if($('#typeClientPay_fis_id').is(':checked')){

 					  	var pay_fis_SDoc = {};
						pay_fis_SDoc.required = true;
						pay_fis_SDoc.normalizer = function(value) {  return $.trim(value); };
						rules["pay_fis_SDoc"] = pay_fis_SDoc;

 					  	var pay_fis_NDoc = {};
						pay_fis_NDoc.required = true;
						pay_fis_NDoc.normalizer = function(value) {  return $.trim(value); };
						rules["pay_fis_NDoc"] = pay_fis_NDoc;

 					  	var pay_fis_Contact = {};
						pay_fis_Contact.required = true;
						pay_fis_Contact.minlength = 3;
						pay_fis_Contact.normalizer = function(value) {  return $.trim(value); };
						rules["pay_fis_Contact"] = pay_fis_Contact;

 					  	var pay_fis_Phone = {};
						pay_fis_Phone.required = true;
						pay_fis_Phone.ALLphone =true;
						rules["pay_fis_Phone"] = pay_fis_Phone;

					}

				///////////////////////

				var messages = {



								input_Charakter_Cargo:{
									required: ""
								},

								//Особые условия транспортировки
								lengh:{
											required: "",
											number:""
																			},
								height:{
											required: "",
											number:""
								},
								width:{
											required: "",
											number:""
								},
								//доп сервис в пункте назначения
								InputForChBoxServiceDelivIn:{
											required: ""
								},
								//доп сервис в пункте отправления
								InputForChBoxServiceDelivOut:{
											required: ""
								},
								// вес объём мест
								weight:{
											required: "Введите вес",
											number:"Данные некорректны"
								},
								volume:{
											required: "Введите объём",
											number:"Данные некорректны"
								},
								place:{
											required: "Введите кол-во мест",
											number:"Данные некорректны",
											max: "Максимальное количество мест 699"
								},

								//***********************************
								//доставить груз получателю 
								AddressBOXDeliveryIn:{
													required:"Это поле должно быть заполнено"
												},
								DateBOXDeliveryIn:{
													required:""
												},
								Hour1BOXDeliveryIn:{
													required:""
												},
								Hour2BOXDeliveryIn:{
													required:""
												},
								ContactBOXDeliveryIn:{
													required:"Это поле должно быть заполнено"
												},
								//***********
								DateDeliveryCust:{
								required:""
								},
								Hour1DeliveryCust:{
								required:""
								},
								Hour2DeliveryCust:{
								required:""
								},
								ContactBOXDeliveryOut:{
													 required: "Это поле должно быть заполнено"
													},
								AddressBOXDeliveryOut: {
													required:"Это поле должно быть заполнено"
												},
								DateBOXDeliveryOut: {
													required:""
												},
								Hour1BOXDeliveryOut:{
														required: ""
											},
								Hour2BOXDeliveryOut:{
														required: ""
											},
								customer_Email: {
													required:"Введите корректный email адрес"
												},
								customer_Contact: { required: "Это поле должно быть заполнено",
												    minlength:"ФИО должно быть не менее трёх символов" 
												},
								sender_ur_Contact: { required: "Это поле должно быть заполнено",
												    minlength:"ФИО должно быть не менее трёх символов" 
												},
								sender_fis_Contact:{ required: "Это поле должно быть заполнено",
												    minlength:"ФИО должно быть не менее трёх символов" 
												},

								sender_fis_NDoc:{
												required: "Это поле должно быть заполнено"
												},
								sender_fis_SDoc:{
												required: "Это поле должно быть заполнено"
												},

								resiv_fis_NDoc:{
												required: "Это поле должно быть заполнено"
												},
								resiv_fis_SDoc:{
												required: "Это поле должно быть заполнено"
												},



								pay_fis_SDoc:{
												required: "Это поле должно быть заполнено"
												},

								pay_fis_NDoc:{
												required: "Это поле должно быть заполнено"
												},


								resiv_fis_Contact:{ required: "Это поле должно быть заполнено",
												    minlength:"ФИО должно быть не менее трёх символов" 
												},
								resiv_ur_Contact:{ required: "Это поле должно быть заполнено",
												    minlength:"ФИО должно быть не менее трёх символов" 
												},

								pay_fis_Contact:{ required: "Это поле должно быть заполнено",
												    minlength:"ФИО должно быть не менее трёх символов" 
												},

								pay_ur_Contact:{ required: "Это поле должно быть заполнено",
												    minlength:"ФИО должно быть не менее трёх символов" 
												},

								sender_ur_Name: {
												required: "Это поле должно быть заполнено",
												 minlength:"Это поле должно быть заполнено"
												},

								pay_ur_Name: {
												required: "Это поле должно быть заполнено",
												 minlength:"Это поле должно быть заполнено"
												},

								resiv_ur_Name: { required: "Это поле должно быть заполнено"

												},
								sender_ur_OrgPravForm: { required: "Это поле должно быть заполнено",
												    minlength:"Организационно-правовая форма должна содержать не менее двух букв" 
												},
								resiv_ur_OrgPravForm: { required: "Это поле должно быть заполнено",
												    minlength:"Организационно-правовая форма должна содержать не менее двух букв" 
												},
								pay_ur_OrgPravForm: { required: "Это поле должно быть заполнено",
												    minlength:"Организационно-правовая форма должна содержать не менее двух букв" 
												},

								inputCharakterCargo:{
													required:"Выбирите характер груза"
												},


								  sender_ur_INN:{
													required: "Это поле должно быть заполнено",
									  				number: "Пожалуйста, введите корректное число"
												  },
								  sender_ur_KPP:{
													required: "Это поле должно быть заполнено",
 													number: "Пожалуйста, введите корректное число"
												  },

								  resiv_ur_INN:{
													required: "Это поле должно быть заполнено",
													 number: "Пожалуйста, введите корректное число"        
												  },
								  resiv_ur_KPP:{
													required: "Это поле должно быть заполнено",
 													number: "Пожалуйста, введите корректное число"
												  },

								 		pay_ur_INN:{
													required: "Это поле должно быть заполнено",
 													number: "Пожалуйста, введите корректное число"     
												  },
										pay_ur_KPP:{
													required: "Это поле должно быть заполнено",
 													number: "Пожалуйста, введите корректное число"
												  },


								PhoneBOXDeliveryOut:{
													required: "Введите корректный номер"
													},
								customer_Phone:{
													required: "Введите корректный номер"
													},
								PhoneBOXDeliveryIn:{
													required: "Введите корректный номер"
													},
								sender_ur_Phone:{
													required: "Введите корректный номер"
													},
								resiv_ur_Phone:{
													required: "Введите корректный номер"
													},
								pay_ur_Phone:{
													required: "Введите корректный номер"
													},
								sender_fis_Phone:{
													required: "Введите корректный номер"
													},
								resiv_fis_Phone:{
													required: "Введите корректный номер"
													},
								pay_fis_Phone:{
													required: "Введите корректный номер"
								}
				};

						$('[name^="InputForChBoxServiceDelivIn"]').each(function(){
							rules[$(this).attr("name")]={
											required: true,
											number:true
								};

						});
						$('[name^="InputForChBoxServiceDelivIn"]').each(function(){
							messages[$(this).attr("name")]={
											required: "Это поле должно быть заполнено",
											number:"Некорректные данные"
								};

						});

						$('[name^="InputForChBoxServiceDelivOut"]').each(function(){
							rules[$(this).attr("name")]={
											required: true,
											number:true
								};

						});
						$('[name^="InputForChBoxServiceDelivOut"]').each(function(){
							messages[$(this).attr("name")]={
											required: "Это поле должно быть заполнено",
											number: "Некорректные данные"
								};

						});

						//**************************************************************************
						// Делаем текущую вкладку таб ту в которой нет заполненных данных
						//**************************************************************************
								if(ChangeTabsValid == true)
								{
										var tab = $('.tab');

											var tabPay = $('#tab3-pay');
											var rbtCheckPay = tabPay.find('input[type=radio]:checked');

												if(rbtCheckPay.attr('id') == 'typeClientPay_fis_id'){

													$('.data-show-pay-content-fis').find('input').each(function(){

																 if($(this).val() == '' || $(this).hasClass("error") == true)
																 {
                            										openTab($('button[name="payer"]'), 'tab3-pay');
																	tab.find('button[name="payer"]').addClass('active');
																		return false;
																 }
													 });




												}else if(rbtCheckPay.attr('id')  == 'typeClientPay_ur_id'){

													$('.data-show-pay-content-ur').find('input').each(function(){

																 if( ($(this).val() == '' && $(this).attr('id').indexOf('pay-ur-KPP_Id')!== 0) || $(this).hasClass("error") == true)
																 {
                            										openTab($('button[name="payer"]'), 'tab3-pay');
																	tab.find('button[name="payer"]').addClass('active');
																		return false;
																 } 
													 });
												}

											var tabResiv = $('#tab2-resiv');
											var rbtCheckResiv =	tabResiv.find('input[type=radio]:checked');

												if(rbtCheckResiv.attr('id') == 'typeClientResiv_fis_id'){

													$('.data-show-resiv-content-fis').find('input').each(function(){

																 if($(this).val() == '' || $(this).hasClass("error") == true)
																 {
                            										openTab($('button[name="resiver"]'), 'tab2-resiv');
																	tab.find('button[name="resiver"]').addClass('active');
																		return false;
																 } 
													 });

												}else if(rbtCheckResiv.attr('id')  == 'typeClientResiv_ur_id'){

													$('.data-show-resiv-content-ur').find('input').each(function(){

																 if(($(this).val() == '' && $(this).attr('id').indexOf('resiv-ur-KPP_Id')!== 0) || $(this).hasClass("error") == true)
																 {
                            										openTab($('button[name="resiver"]'), 'tab2-resiv');
																	tab.find('button[name="resiver"]').addClass('active');
																		return false;
																 } 
													 });
												}


											var tabSend = $('#tab1-send');
											var rbtCheckSend =	tabSend.find('input[type=radio]:checked');

												if(rbtCheckSend.attr('id') == 'typeClientSend_fis_id'){

													$('.data-show-send-content-fis, data-show-send-content-ur').find('input').each(function(){

																 if( $(this).val() == ''  || $(this).hasClass("error") == true)
																 {
                            										openTab($('button[name="sender"]'), 'tab1-send');
																	tab.find('button[name="sender"]').addClass('active');
																		return false;
																 } 
													 });



												}else if(rbtCheckSend.attr('id')  == 'typeClientSend_ur_id'){

													$('.data-show-send-content-ur').find('input').each(function(){



																 if(($(this).val() == '' && $(this).attr('id').indexOf('sender-ur-KPP_Id')!== 0) || $(this).hasClass("error") == true)
																 {
																	 //console.log('делаем вкладку отправитель юрик активной',  this);

                            										openTab($('button[name="sender"]'), 'tab1-send');
																	tab.find('button[name="sender"]').addClass('active')
																		return false;
																 } 
													 });


												}
										}








						// validate signup form on keyup and submit
					$("#form-calk-order").validate({


						focusInvalid: false,
						ignore:':hidden:not(.not_ignor)',
 						rules:rules,

						highlight: function(el) {
									var element=$(el);
									if(element.attr("name")=="input_Charakter_Cargo"){
										element.parent().addClass('error');
										element.parent().css('border-color','red');
									}else{
											element.addClass('error');
									}
								},

						unhighlight: function(el) {
									var element=$(el);
									if(element.attr("name")=="input_Charakter_Cargo"){
										element.parent().removeClass('error');
										element.parent().addClass('valid');
										element.parent().css('border-color','gray');

										//}else if(String(element.attr("name")).indexOf("sender_fis_") !== -1){

										//console.log(element.attr("name"));

									}else{
											element.removeClass('error');
									}	
								},

							messages: messages

						});
	}


	</script>





<script type="text/javascript">



	 $(document).ready(function ()
	{	



			$("#DateBOXDeliveryOut_Id, #DateDeliveryCust_Id, #DateBOXDeliveryIn_Id").datepicker({
							dateFormat: "dd-mm-yy",
							minDate:0,
						  maxDate: "2m",
							changeMonth: true
						 }).datepicker($.datepicker.regional["ru"]);
		
				$("#DateBOXDeliveryOut_Id, #DateDeliveryCust_Id, #DateBOXDeliveryIn_Id").datepicker("setDate", "+0d");



			$("#DateBOXDeliveryOut_Id, #DateDeliveryCust_Id, #DateBOXDeliveryIn_Id").click(function(){


			 			$(this).datepicker({
											 dateFormat: "dd-mm-yy",
											 minDate:0,
											 maxDate: "2m",
											 changeMonth: true
											 }).datepicker($.datepicker.regional["ru"]).datepicker('show');
											});



		$('#form-calk-order').unbind('submit').on('submit', function(e) {
			//	alert('калькулятор');

			var selected = [];
			//доп сервисы 
		$('#div_input_ServiseDeliv_Out_In').find('input[type="checkbox"]').each(function(){

			selected.push({DATA_ID: $(this).attr('data-id'), value: $(this).is(':checked'), name: $(this).attr('name') });

		});


		$('#TableMarkUp').find('input[type="checkbox"]').each(function(){

			selected.push({ID: $(this).attr('id'), value: $(this).is(':checked'), name: $(this).attr('name') });

		});


			//selected.push({ID: $('#get-callback_Id').attr('id'), value: $('#get-callback_Id').is(':checked'), name: $('#get-callback_Id').attr('name') });



		$('#BOXDeliveryOut_Id').each(function(){

			selected.push({ID: $(this).attr('id'), value: $(this).is(':checked'), name: $(this).attr('name') });

		});



		$('#BOXDeliveryIn_Id').each(function(){

			selected.push({ID: $(this).attr('id'), value: $(this).is(':checked'), name: $(this).attr('name') });

		});





				$('input[type="text"]').each(function(){

					selected.push({ID: $(this).attr('data-IDcheckbox'), value:  $(this).val(), name: $(this).attr('name'), wvc: $(this).attr('data-wvc') });

				});



				$('#content_cal').find('input[type="radio"]').each(function(){ 
					 if($(this).is(':checked')){
						 selected.push({ID:$(this).attr('id'), name: 'tarifs', value: 'true'});
							console.log($(this).attr('id'));

						} 
				});


			selected.push({ID: 'weight', value: $('#weight').val()});
			selected.push({ID: 'volume', value: $('#volume').val()});
			selected.push({ID: 'place', value: $('#place').val()});

			selected.push({ID: 'from', value: $('#form-calk-order').find('#city_from_List input').attr("selectedid") });
			selected.push({ID: 'to', value: $('#form-calk-order').find('#city_to_List input').attr("selectedid") });

			console.log();
			//console.log($('#form-calk-order').find('#city_to_List input').attr("selectedid"));
			$('#marshrut').text($('#form-calk-order').find('#city_from_List input').val() + ' - ' + $('#form-calk-order').find('#city_to_List input').val());


			e.preventDefault();
			$.ajax({
				url :'/cost-calculation/cost-order_Ajax.php',
				type: "POST",
                 dataType: 'text',
				 data: {selected: selected},
				 success:function(data){
					  if(!data){ 
					 $('#content_cal').css("display","none"); 
					  }else{ 
							$('#content_cal').html(data); 
					  		$('#content_cal').css("display","");



							// ф-ия подцветки выбранного тарифа
							$('#content_cal').off('click').on('click', function(event){ 
		
								$(this).find('input[type="radio"]').each(function(){
										if($(this).is(':checked'))
										{
											$(this).closest('tr').css('background-color','lightgray')
										}else
										{
												$(this).closest('tr').css('background-color','');
										}
								});
		
							 });
		
							// ф-ия выбора тарифа
							$('#result tr').click(function() {
									console.log(this);
		
								$(this).find('td input:radio').prop('checked', true);



							});




					 }

	 		    }

			});
		});













			$("#menu-current-order a").click(function(){

				$("#menu-current-order a").each(function(){ 
					$(this).css('color','black');
					$(this).css('background-color','lightgray');
 					$(this).removeAttr('data-orderType')
				})

				$(this).css('color','#8e211e');
					$(this).css('background-color','#A0A0A0');
                $(this).attr('data-orderType','current')


				if($(this).attr('id').indexOf("VidelTransPoRossii") >= 0)
				{
					$('#div_tip_polupricepa_kontejnera').css('display','block');
					$('#div_vid-perevozki').css('display','none');

				}
				else if($(this).attr('id').indexOf("megdunarodGrusoper") >= 0){
 
					$('#div_tip_polupricepa_kontejnera').css('display','none');
					$('#div_vid-perevozki').css('display','block');
				}
				else{
						$('#div_tip_polupricepa_kontejnera').css('display','none');
						$('#div_vid-perevozki').css('display','none');
					}
			});




				$("input[name=tip-polupricepa-kontejnera]:radio").change(function () {
					if ($('#tentovannyj').is(":checked")) {

						$('#ZadnyayaBokovayaVerxnyaya').css("display","block");
					} else {

							$('#ZadnyayaBokovayaVerxnyaya').css("display","none");
							$('#ZadnyayaBokovayaVerxnyaya').find('input').each(function(){
								$(this).attr('checked', false);
							});
					}
				});



					// textarea event handler to add support for maxlength attribute // ДЛЯ ПОДДЕРЖКИ maxlength в IE
			$(document).on('input keyup', 'textarea[maxlength]', function(e) {
				// maxlength attribute does not in IE prior to IE10
				// http://stackoverflow.com/q/4717168/740639
				var $this = $(this);
				var maxlength = $this.attr('maxlength');
				if (!!maxlength) {
					var text = $this.val();
			
					if (text.length > maxlength) {
						// truncate excess text (in the case of a paste)
						$this.val(text.substring(0,maxlength));
						e.preventDefault();
					}
			
				}
			
			});








	});






	//**********************************************************************

		function addURL(element)
		{
				$(element).attr('href', function() {

					var from_id = $('#city_from_List').find('input').val();
					var to_id =	$('#city_to_List').find('input').val();


					return this.href + '?from=' + from_id + '&to=' + to_id;
				});
		}




			function openTab(evt, cityName) {
					// Declare all variables
					var i, tabcontent, tablinks;
					// Get all elements with class="tabcontent" and hide them
					tabcontent = $(".tabcontent");
					for (i = 0; i < tabcontent.length; i++) {
					$(tabcontent[i]).css("display","none");
					}

					// Get all elements with class="tablinks" and remove the class "active"
					tablinks = $(".tablinks");
					tablinks.each(function(e){
						$(this).removeClass("active");
					});

					// Show the current tab, and add an "active" class to the button that opened the tab
					$('#'+cityName).css('display','block');
					$(evt.currentTarget).addClass("active");
            }


		
		function OrderSend() // отправка заявки
		{
					$('.btn-Order').attr("disabled","disabled");

				var selected = [];

			// экспедирование в Пункте назначения

		$('#BOXDeliveryIn_Id').each(function(){

			selected.push({ID: $(this).attr('id'), value: $(this).is(':checked'), name: $(this).attr('name') });

		});






			// доп сервисы
				$('#div_input_ServiseDeliv_Out_In').find('input[type="checkbox"]').each(function(){
			
					selected.push({DATA_ID: $(this).attr('data-id'), value: $(this).is(':checked'), name: $(this).attr('name'), datacontent: $(this).attr('data-content') });
			
					});
			
			
					$('#TableMarkUp').find('input[type="checkbox"]').each(function(){
			
						selected.push({ID: $(this).attr('id'), value: $(this).is(':checked'), name: $(this).attr('name'), datacontent: $(this).attr('data-content') });
			
					});

			// звонок
			selected.push({ID: $('#get-callback_Id').attr('id'), value: $('#get-callback_Id').is(':checked'), name: $('#get-callback_Id').attr('name') });



			$('input[type="radio"]').each(function(){
	
				selected.push({ID: $(this).attr('id'), value: $(this).is(':checked'), name: $(this).attr('name'), datacontent: $(this).attr('data-content') });
	
			});

			// ПОЛУЧАЕМ ИНФОРМАЦИЮ О плательщик получатель отправитель
			$('#tabs-srp').find('input[type="text"]').each(function(){

					selected.push({ID: $(this).attr('id'), value: $(this).val()});

			});


			// ПОЛУЧАЕМ ИНФОРМАЦИЮ О типе докумнта плательщик, получатель, отправитель
			if($('#typeClientSend_fis_id').is(':checked') == true)
			{
			selected.push({ ID: $("#sender-fis-TypeDoc_Id").attr('id'), value: $("#sender-fis-TypeDoc_Id option:selected").text() });
			}
			if($('#typeClientResiv_fis_id').is(':checked') == true)
			{
			selected.push({ ID: $("#resiv-fis-TypeDoc_Id").attr('id'), value: $("#resiv-fis-TypeDoc_Id option:selected").text() });
			}
			if($('#typeClientPay_fis_id').is(':checked') == true)
			{
			selected.push({ ID: $("#pay-fis-TypeDoc_Id").attr('id'), value: $("#pay-fis-TypeDoc_Id option:selected").text() });
			}






			// ПОЛУЧАЕМ ИНФОРМАЦИЮ О заказщике 
			$('#max_calc_result').find('input[type="text"]').each(function(){

				selected.push({ID: $(this).attr('id'), value: $(this).val()});

			});


			selected.push({ID: $('#customer-More-information_Id').attr('id'), value: $('#customer-More-information_Id').val() });


				$('#div_input_ServiseDeliv_Out_In input[type="text"]').each(function(){
	
					selected.push({ID: $(this).attr('data-IDcheckbox'), value:  $(this).val(), name: $(this).attr('name'), wvc: $(this).attr('data-wvc') });
	
				});

				// информация о маркап
				$('#TableMarkUp').find('input[type="text"]').each(function(){

				selected.push({ID: $(this).attr('id'), value: $(this).val()});

				});

			//информация о экспедировании //забрать груз  // доставлю самостоятельно //  доставить груз получателю 
				$('#div_BOXDeliveryOut_Id, #div_BOXDeliveryIn_Id').find('input[type="text"]').each(function(){
					
					
					/*if($(this).attr('id') == 'DateBOXDeliveryOut_Id'){
						var arrDate = $(this).val().split('-');
						var modDate = String(arrDate[1]+'.'+arrDate[0]+'.'+arrDate[2]);
						 $(this).val(modDate.replace(/[^0-9]/g, '.'));
					}
					if($(this).attr('id') == 'DateBOXDeliveryIn_Id'){
						var arrDate = $(this).val().split('-');
						var modDate = String(arrDate[1]+'.'+arrDate[0]+'.'+arrDate[2]);
						 $(this).val(modDate);
					}*/
					
					selected.push({ID: $(this).attr('id'), value: $(this).val()});

				});



			if($('#yourself_BOXDeliveryOut_Id').is(':checked')){
				$('div.data-show-content-yourself').find('input').each(function(){

					selected.push({ID: $(this).attr('id'), value: $(this).val(), name:$(this).attr('name') });
				});
			}



			navigator.sayswho= (function(){
					var ua= navigator.userAgent, tem, 
					M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
					if(/trident/i.test(M[1])){
						tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
						return 'IE '+(tem[1] || '');
					}
					if(M[1]=== 'Chrome'){
						tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
						if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
					}
					M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
					if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
					return M.join(' ');
				})();

			//console.log(navigator.sayswho);



			var current_id = $('#menu-current-order [data-ordertype=current]').attr('id');

			function searchText( string, needle ) {
			   return !!(string.search( needle ) + 1);
			}

			var current_id_val = 0;

			if(searchText('sbornieGrusPerPoRossii', current_id)){ current_id_val = "1";}
			if(searchText('VidelTransPoRossii', current_id)){ current_id_val = "2"; }    
			if(searchText('megdunarodGrusoper', current_id)){ current_id_val = "3"; } 

			selected.push({ID: 'TypeOrder_Id' , value: current_id_val });



			selected.push({ID: 'weight', value: $('#weight').val()});
			selected.push({ID: 'volume', value: $('#volume').val()});
			selected.push({ID: 'place', value: $('#place').val()});

			selected.push({ID: 'from', value: $('#form-calk-order').find('#city_from_List input').attr("selectedid") });
			selected.push({ID: 'to', value: $('#form-calk-order').find('#city_to_List input').attr("selectedid") });
			selected.push({ID: 'Cityfrom', value: $('#form-calk-order').find('#city_from_List input').val() });
			selected.push({ID: 'Cityto', value: $('#form-calk-order').find('#city_to_List input').val() });

			selected.push({ID: 'ID_Character', value:  $('#city_from_List_cc input').attr("selectedid"), data_val: $('#form-calk-order').find('#city_from_List_cc input').val() });




			selected.push({ID: 'browser', value: navigator.sayswho });
			selected.push({ID: 'code_1c', value: $('#code_1c').val() });
			
			/*
			$('#pay_ur_IsSenderIsResiver option:selected').text()
			*/
			
			var autoZapolnenitFirst = 0;
			
			
			
			if($('#sender_ur_Zapolnit_lc_Id').is(':checked')){
				selected.push({ID: 'duble_data_user1', value: "Y" });
				autoZapolnenitFirst = 1;
				//console.log('duble_data_user1:Y');
			}else{
				selected.push({ID: 'duble_data_user1', value: "" });
				//console.log('duble_data_user1:N');
			}
			
			if(autoZapolnenitFirst == 1){
			
				
				if($('#resiv_ur_IsSenderIsPayer option:selected').text() == 'Отправитель'){
					selected.push({ID: 'duble_data_user2', value: "Y" });
					//console.log('duble_data_user2:Y');
				}else{
					selected.push({ID: 'duble_data_user2', value: "" });
					//console.log('duble_data_user2:N');
				}
				
				if($('#pay_ur_IsSenderIsResiver option:selected').text() == 'Отправитель'){
					selected.push({ID: 'duble_data_user3', value: "Y" });
					//console.log('duble_data_user3:Y');
				}else{
					selected.push({ID: 'duble_data_user3', value: "" });
					//console.log('duble_data_user3:N');
				} 
				
			}else{
				selected.push({ID: 'duble_data_user1', value: "" });
				selected.push({ID: 'duble_data_user2', value: "" });
				selected.push({ID: 'duble_data_user3', value: "" });
			}
			
			selected.push({ID: 'NameSC', value: "" });
			selected.push({ID: 'ID_SC', value: "" });
			
			var selectedRName = '';
			var selectedRType = '';
			
			$('#max_calc_result #result #content_cal tr').each(function(){
				
				if($(this).attr('style') != 'display:none;'){
					var input = $(this).find('input');
					if($(this).find('input').is(':checked')){
						selectedRName = input.attr('id');
					}
				}
			});
			
			if(selectedRName == 'скорый'){
				selectedRType = 0;
			}
			if(selectedRName == 'стандарт'){
				selectedRType = 1;
			}
			if(selectedRName == 'грузовой'){
				selectedRType = 2;
			}
			//console.log('NameSC: '+selectedRName+', ID_SC:'+selectedRType);
			
			selected.push({ID: 'NameSC', value: selectedRName });
			selected.push({ID: 'ID_SC', value: selectedRType });
			

			$.ajax({
				type:'POST',
				url:'/cost-calculation/order-send.php',
				dataType:'text',
				data: {selected: selected}, //$('#form-calk-order').serialize()  + '&OrderType=' + $("[data-orderType=current]").attr('id'),
				success: function(response){
					//$('#result-order-send').html(response); 
					//console.log(response);

					var result = $(response).find('#result_order_send').text();
					if($.trim(result) !== "1"){
								$(function () {
									$('.dialog_content_error').dialogModal({
										topOffset: 0,
										top: '12%',
										onDocumentClickClose: false,
										onOkBut: function (event, el, current) { },
										onLoad: function (el, current) { },
										onClose: function (el, current) {  },
                    					onCancelBut: function (event, el, current) {  }
									});
								}); 

							$('.btn-Order').attr("disabled","");

					}
					else if($.trim(result) == "1"){

						window.location.href = "../cost-calculation/order-secsess.php";

						//$(function () {

						//$('.dialog_content').dialogModal({
						//	topOffset: 0,
						//	top: '12%',
						//	onDocumentClickClose: false,
						//	onOkBut: function (event, el, current) { window.location.href = "../index.php";},
						//	onLoad: function (el, current) { },
						//	onClose: function (el, current) { window.location.href = "../index.php"; },
						//	onCancelBut: function (event, el, current) {  window.location.href = "../index.php";  }
						//});
						//}); 
					}


				}
			});

				
		}



</script>








<div class="pw relative">

    <br/><br/><br/><br/><br/><br/>
    <h2 class="page-title">Оформить заявку</h2>


<input type="hidden" name="code_1c" id="code_1c" />
<div class="loadingProcess"></div>
<form action="" method="post" id="form-calk-order" name="form-calk">

			<div id="max_calc_result" >
				<p class="title">Результаты расчета</p>
				<div class="wrp">
					<p id="marshrut" style="text-align:center;">Москва - Новосибирск</p>
					<table id="result" border="1" cellspacing="1">
						<tr>
							<th>Категория скорости</th>
							<th>Срок доставки, дни</th>
							<th>Стоимость, руб.</th>
						</tr>
						<tfoot style="cursor:pointer;" id="content_cal"></tfoot>
					</table>
		
					<a onclick="addURL(this)" href="../rates/sbornye-avto-zhd-perevozki.php">Посмотреть прайс-лист</a><br/><br/>
		
					<p style="font-size:small;"><b>Обращаем Ваше внимание</b></p>
					<p style="font-size:small;">
						Результаты расчета калькулятора являются предварительными.<br />
						Окончательная стоимость формируется только после сдачи груза.<br />
						Если есть особенности транспортировки Вашего груза, рекомендуем связаться с менеджерами компании.
					</p>
						<br/>
								<label class="required">Ваши ФИО</label><br />
								<input type="text" id="customer-Contact_Id" class="ServiceInput" name="customer_Contact" style="width:92%;" />
						<br/>
							<div class=dfull>
								<div class=d2l>
									<label class="required">Контактный телефон</label><br/>
									<input type="text" name="customer_Phone" id="customer-Phone_Id" class="ServiceInput" style="width:92%;" />
								</div>
							<br/>
								<div class=d2r>
									<label class="required">Контактный e-mail</label><br/>
									<input type="text" maxlength="100" name="customer_Email" id="customer_Email_Id" type="email" class="ServiceInput" style="width:92%;" />
								</div>
							</div>
						<br/>
								<label>Более подробная информация</label><br />
					<textarea id="customer-More-information_Id" rows="5" name="customer_More_information"  cols="43" type="text" class="ServiceInput" maxlength="500"></textarea>
					<br/><br/>
						<div style="width:200px; margin:0 auto;">

						<input type="submit" class="btn-Order" id="btn_order_sending" value="Отправить заявку" />


						</div>
					</div>
			</div>




    <div id="max_calc">

 <p class="sect_title required">Вид перевозки</p>
	<br/>
		<div id="menu-current-order">
			<div class="type-transp"><a id="sbornieGrusPerPoRossii" style="color:rgb(142, 33, 30); background-color: rgb(160, 160, 160);" data-ordertype="current">Сборные грузоперевозки<br/>по России</a></div><div class="type-transp"><a id="VidelTransPoRossii" >Выделенный транспорт<br/>по России</a></div><div class="type-transp" style="border-right:none;">
				<a id="megdunarodGrusoper" >Международные<br/>грузоперевозки</a></div>
		</div>
	<br/>
	<br/><br/>
	<br/>


            <div class="row">

                <div id="mini-calc_List" style="position:inherit; padding:0;">
                    <div class="d2l">
                        <p class="sect_title required">Пункт отправления</p>

                        <div id="city_from_List" class="city-select_List" style="width:400px;">
                            <div class="btn_down_List"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                            <div class="city_list_List">

                                <?foreach(getCities() as $key=>$value):?>
                                <div class="city_item_List" id="city<?=$key;?>"><?=$value;?></div>
                                <?endforeach;?>

                            </div>
                        </div>
                        <div class="mla" id="div_BOXDeliveryOut_Id" style="margin:0px;">
							<br/>
							<input type="radio" name="BOXDeliveryOutServiceOrYourSelf" style="width:5%; margin-left:0;" id="BOXDeliveryOut_Id" data-show=".next" <?if($_GET['BOXDeliveryOut_Id'] == "true"){ echo 'checked'; }?>><label for="BOXDeliveryOut_Id" style="margin-right:10px;">забрать груз</label>

							<input type="radio"  name="BOXDeliveryOutServiceOrYourSelf" style="width:5%;" id="yourself_BOXDeliveryOut_Id" data-show-yourself=".next" <?if($_GET['BOXDeliveryOut_Id'] !== "true"){ echo 'checked'; }?>><label for="yourself_BOXDeliveryOut_Id">доставлю самостоятельно</label>


							<br/><br/>

                            <div class="data-show-content">
								<label class="titel-form-order required">Адрес грузоотправителя</label>
                                <input type="text" maxlength="200"  name="AddressBOXDeliveryOut" id="AddressBOXDeliveryOut_Id" class="ServiceInput" style="width:380px;" placeholder="Улица, дом, корпус" value="<?=$_GET['BOXDeliveryOut_input']; ?>"/>
								<br/><br/>

								<label class="titel-form-order required" style="margin-right:115px">Дата отправки</label> <label class="titel-form-order required">Время отправки (часы)</label><br/>

									<input type="text" name="DateBOXDeliveryOut" id="DateBOXDeliveryOut_Id" class="ServiceInput" style="width:190px;"  readonly="readonly" placeholder="__-__-____"/>

								<label class="titel-form-order titel-addres" style="vertical-align:middle; padding:4px;">&nbsp;с</label>
								<input type="text" maxlength="2" name="Hour1BOXDeliveryOut" id="Hour1BOXDeliveryOut_Id" class="ServiceInput numbers" style="width:40px; text-align:center;" placeholder="__"/>

								<label class="titel-form-order titel-addres" style="vertical-align:middle; padding:4px;">по</label>
								<input type="text" maxlength="2" name="Hour2BOXDeliveryOut" id="Hour2BOXDeliveryOut_Id" class="ServiceInput numbers" style="width:40px; text-align:center;" placeholder="__" />

								<br/><br/>
								<label class="titel-form-order required">Контактное лицо</label>
								<input type="text" name="ContactBOXDeliveryOut" maxlength="100" id="ContactBOXDeliveryOut_Id" class="ServiceInput" style="width:380px;" placeholder="ФИО" />
								<br/><br/>
								<label class="titel-form-order required">Контактный телефон</label>
								<input type="text" name="PhoneBOXDeliveryOut" id="PhoneBOXDeliveryOut_Id" class="ServiceInput" style="width:380px;" placeholder="Телефон" />

                            </div>


    						<div class="data-show-content-yourself">
								<label class="titel-form-order required" style="margin-right:190px">Когда</label><label class="titel-form-order required">Во сколько (часы)</label><br/>

								<input name="DateDeliveryCust" id="DateDeliveryCust_Id" type="text" class="ServiceInput" style="width:190px;" readonly="readonly"  placeholder="__.__.____"/>

								<label class="titel-form-order titel-addres" style="vertical-align:middle; padding:4px;">&nbsp;с</label>
								<input name="Hour1DeliveryCust" maxlength="2" id="Hour1DeliveryCust_Id" type="text" class="ServiceInput numbers" style="width:40px; text-align:center;" placeholder="__" />

								<label class="titel-form-order titel-addres" style="vertical-align:middle; padding:4px;">по</label>
								<input name="Hour2DeliveryCust" maxlength="2" id="Hour2DeliveryCust_Id" type="text" class="ServiceInput numbers" style="width:40px; text-align:center;" placeholder="__" />
                            </div>



                        </div>
                    </div>
                    <div class="d2r">
                        <p class="sect_title required">Пункт назначения</p>

                        <div id="city_to_List" class="city-select_List" style="width:400px;">
                            <div class="btn_down_List"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
                            <div class="city_list_List">

                                <?foreach(getCities() as $key=>$value):?>
                                <div class="city_item_List" id="city<?=$key;?>"><?=$value;?></div>
                                <?endforeach;?>

                            </div>
                        </div>
                        <div class="mla" id="div_BOXDeliveryIn_Id" style="margin:0px;">
							<br/>
                            <input type="checkbox" name="BOXDeliveryIn" id="BOXDeliveryIn_Id" data-show=".next" <?if($_GET['BOXDeliveryIn_Id'] == "true"){ echo 'checked'; }?>>
                            <label for="BOXDeliveryIn_Id">доставить груз получателю</label>
							<br/><br/>

                            <div class="data-show-content">

								<label class="titel-form-order required">Адрес грузополучателя</label>
                                <input type="text" maxlength="200" name="AddressBOXDeliveryIn" id="AddressBOXDeliveryIn_Id" class="ServiceInput" style="width:380px;" placeholder="Улица, дом, корпус" value="<?=$_GET['BOXDeliveryIn_input']; ?>"/>
								<br/><br/>

								<label class="titel-form-order required" style="margin-right:125px">Дата доставки</label><label class="titel-form-order required">Время доставки (часы)</label><br/>
								<input type="text" name="DateBOXDeliveryIn" id="DateBOXDeliveryIn_Id" class="ServiceInput" style="width:190px;" readonly="readonly"  placeholder="__.__.____" />

								<label class="titel-form-order titel-addres" style="vertical-align:middle; padding:4px;">&nbsp;с</label>
								<input type="text" maxlength="2" name="Hour1BOXDeliveryIn" id="Hour1BOXDeliveryIn_Id" class="ServiceInput numbers" style="width:40px; text-align:center;" placeholder="__" />

								<label class="titel-form-order titel-addres" style="vertical-align:middle; padding:4px;">по</label>
								<input type="text" maxlength="2" name="Hour2BOXDeliveryIn" id="Hour2BOXDeliveryIn_Id" class="ServiceInput numbers" style="width:40px; text-align:center;" placeholder="__" />

								<br/><br/>
								<label class="titel-form-order required">Контактное лицо</label>
								<input type="text" name="ContactBOXDeliveryIn"  maxlength="100" id="ContactBOXDeliveryIn_Id" class="ServiceInput" style="width:380px;" placeholder="ФИО" />
								<br/><br/>
								<label class="titel-form-order required">Контактный телефон</label>
								<input type="text" name="PhoneBOXDeliveryIn" id="PhoneBOXDeliveryIn_Id" class="ServiceInput" style="width:380px;" placeholder="Телефон" />
                            </div>
                        </div>

                        <div id="weight_List" style="display:none;"><input value="1" /></div>
                        <div id="vol_List" style="display:none;"><input value="1" /></div>
                        <div class="clear"></div>

                    </div>
                </div>
            </div>

			<div class="row" id="div_tip_polupricepa_kontejnera" style="display:none;">
						<br /><br/>
						<hr class="line-gradient">
						<br /><br/>
						<p class="sect_title">Тип полуприцепа/контейнера</p><br /><br/>


						<div class="d2l">
							<div class="mla">
								<input type="radio" name="tip-polupricepa-kontejnera" style="width:5%; margin-left:0;" data-content="Рефрижератор" id="refrizherator" ><label for="refrizherator">Рефрижератор</label>
								<br/><br/>
								<input type="radio" name="tip-polupricepa-kontejnera" style="width:5%; margin-left:0;" data-content="Тентованный" id="tentovannyj" checked><label for="tentovannyj" >Тентованный</label>
								<br/><br/>
								<div class="mla" id="ZadnyayaBokovayaVerxnyaya" style="display:block;">
									<input type="checkbox" name="tip-polupricepa-kontejnera" data-content="задняя" id="zadnyaya" checked><label for="zadnyaya">задняя</label><br/>
									<input type="checkbox" name="tip-polupricepa-kontejnera" data-content="боковая" id="bokovaya"><label for="bokovaya">боковая</label><br/>
									<input type="checkbox" name="tip-polupricepa-kontejnera" data-content="верхняя" id="verxnyaya"><label for="verxnyaya">верхняя</label>
									<br/><br/>
								</div>
								<input type="radio" name="tip-polupricepa-kontejnera" style="width:5%; margin-left:0;" data-content="Изотермический" id="izotermicheskij" ><label for="izotermicheskij">Изотермический</label>
								<br/><br/>
								<input type="radio" name="tip-polupricepa-kontejnera" style="width:5%; margin-left:0;"  data-content="Контейнер" id="kontejner" ><label for="kontejner">Контейнер</label>
								<br/><br/>
								<input type="radio" name="tip-polupricepa-kontejnera" style="width:5%; margin-left:0;"  data-content="Затрудняюсь ответить" id="zatrudnyayus-otvetit" ><label for="zatrudnyayus-otvetit">Затрудняюсь ответить</label>
								<br/><br/>
							</div>
						</div>
				</div>

				<div class="row" id="div_vid-perevozki" style="display:none;">
							<br /><br/>
							<hr class="line-gradient">
							<br /><br/>
							<p class="sect_title">Вид перевозки</p><br/>
							<div class="d2l">
								<div class="mla">
									<input type="radio" name="vid-perevozki" style="width:5%; margin-left:0;" data-content="Железнодорожные" id="zheleznodorozhnye"><label for="zheleznodorozhnye">Железнодорожные</label>
									<br/><br/>
									<input type="radio" name="vid-perevozki" style="width:5%; margin-left:0;" data-content="Автомобильные" id="avtomobilnye"><label for="avtomobilnye" >Автомобильные</label>
									<br/><br/>
									<input type="radio" name="vid-perevozki" style="width:5%; margin-left:0;"  data-content="Контейнерные" id="kontejnernye" ><label for="kontejnernye">Контейнерные</label>
									<br/><br/>
									<input type="radio" name="vid-perevozki" style="width:5%; margin-left:0;" data-content="Авиа" id="avia" ><label for="avia">Авиа</label>
									<br/><br/>
									<input type="radio" name="vid-perevozki" style="width:5%; margin-left:0;" data-content="Затрудняюсь ответить" id="vid-perevozki-zatrudnyayus-otvetit" checked><label for="vid-perevozki-zatrudnyayus-otvetit">Затрудняюсь ответить</label>
									<br/><br/>
								</div>
								<br/>
						
							<p class="sect_title">Дополнительные услуги</p><br/>
							
								<div class="mla">
									<input type="checkbox" name="dop-servis-usluga" data-content="Услуга грузоперевозки" id="usluga-gruzoperevozki"><label for="usluga-gruzoperevozki">Услуга грузоперевозки</label>
									<br/><br/>
									<input type="checkbox" name="dop-servis-usluga" data-content="Расчёт таможенных платежей"  id="raschyot-tamozhennyx-platezhej"><label for="raschyot-tamozhennyx-platezhej">Расчёт таможенных платежей</label>
									<br/><br/>
									<input type="checkbox" name="dop-servis-usluga" data-content="Услуга контрактодержателя"  id="usluga-kontraktoderzhatelya"><label for="usluga-kontraktoderzhatelya">Услуга контрактодержателя</label>
									<br/><br/>
								</div>
							</div>
					</div>

			<br/>
			   <hr class="line-gradient">
            <br/><br/>
            <p class="sect_title">Параметры груза</p><br /><br />

            <div class="row"> 
                <div class="d2l" id="div_params_gruz">
                    <div class="mla">
                        <div class="d3">
                            <label class="required">Вес</label><br />
							<input  id="weight" value="<? echo $_GET['weight']; ?>"  placeholder="               кг" type="text" class="weight-size-characteristics numbers_comma" style="width:90px; text-align:center; " name="weight" maxlength="10">
                        </div>

                        <div class="d3">
                            <label class="required">Объём</label><br />
                            <input id="volume" value="<? echo $_GET['volume']; ?>"  placeholder="               м3"  class="weight-size-characteristics numbers_comma" style="width:90px; text-align:center;" name="volume" maxlength="10">
                        </div>
                        <div class="d3">
                            <label class="required">Мест</label><br />
                            <input id="place" value="<? echo $_GET['place']; ?>" placeholder="              шт"   class="weight-size-characteristics numbers" style="width:90px; text-align:center;" name="place" maxlength="10">
                        </div>
                      
                    </div>
                </div>

                <div class="d2r" id="div_Character_Cargo">
                    <label class="required">Характер груза</label>
                    <div id="mini-calc_List" style="position:inherit; padding:0px;">
                        <div id="city_from_List_cc" name="inputCharakterCargo" class="city-select_List" data-CharacterCargo="text" style="width:400px;">

								<div class="btn_down_List"><i class="fa fa-caret-down" aria-hidden="true"></i></div>
								<div class="city_list_List">
	
									 <?foreach(GetCharacterCargo() as $key=>$value):?>
									<div class="city_item_List" id="<?=$key;?>"><?=$value;?></div>
									<?endforeach;?>
	
								</div>

                        </div>
                    </div>
                </div>

                    <div id="content_p" class="mla dfull"></div>

                </div>


            <br/><br/>


             <div class="tab">

				<button type="button" name="sender" class="tablinks active" onclick="openTab(event, 'tab1-send')"><p class="msect_title"><b>Отправитель</b></p></button>
                <button  type="button" name="resiver" class="tablinks" onclick="openTab(event, 'tab2-resiv')"><p class="msect_title"><b>Получатель</b></p></button>
                <button  type="button" name="payer" class="tablinks" onclick="openTab(event, 'tab3-pay')"><p class="msect_title"><b>Плательщик</b></p></button>
            </div>
			<div id="tabs-srp">
            	<div id="tab1-send" class="tabcontent row" >

						<div  style="float:left; height:440px;">
							<div class="left-menu-order" style="margin-top:69px;">
		
								<input type="radio" name="typeClientSend" id="typeClientSend_fis_id" style="width:29px" data-show-fis=".next">
								<label for="typeClientSend_fis_id">Физическое лицо&nbsp;&nbsp;</label>
							</div>
		
							<div class="left-menu-order" style="margin-top:171px;">
		
								<input type="radio" name="typeClientSend" id="typeClientSend_ur_id" checked="checked" style="width:29px" data-show-ur=".next">
								<label for="typeClientSend_ur_id">Юридическое лицо&nbsp;&nbsp;</label>
		
							</div>
						</div>

	
					<div class="data-show-send-content-fis" style="display:none;">
						<div class="dfull" <?if(!$USER->IsAuthorized()){ echo 'style="display:none;"'; } ?>>
							<br/>
							<input type="checkbox" id="sender_fis_Zapolnit_lc_Id" name="sender_fis_Zapolnit_lc_Name"/>
							<label for="sender_fis_Zapolnit_lc_Id">Заполнить моими реквизитами из личного кабинета</label>
							<br />
						</div>

						<div class="d2l" style="width:44%;">
							<br/><br/>
						<label class="required">Контактное лицо</label><br />
						<input type="text" maxlength="100" name="sender_fis_Contact" id="sender-fis-Contact_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="ФИО" />
						</div>

						<div class="d2r" style="width:44%;">
							<br/><br/>
						<label class="required">Контактный телефон</label><br />
						<input type="text" name="sender_fis_Phone" id="sender-fis-Phone_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="Телефон"/>
						</div>

						<div class="d2l" style="width:42%;">
							<br/>
							<label class="required">Тип документа</label><br />
							<select id="sender-fis-TypeDoc_Id" class="order-type-document">
							  <option selected>Паспорт</option>
							  <option>Заграничный паспорт</option>
							  <option>Водительское удостоверение</option>
							</select>

						</div>
						<div class="d2r">
							</div>

						<div class="d2l" style="width:44%;">
							<br/>
								<label  class="required">Серия</label><br />
								<input type="text"  maxlength="14" name="sender_fis_SDoc" id="sender-fis-SDoc_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="Серия" />
							<br/>
							<br/>
						</div>
	
						<div class="d2r" style="width:44%;">
							<br/>
								<label  class="required">Номер документа</label><br />
								<input type="text" maxlength="14" name="sender_fis_NDoc" id="sender-fis-NDoc_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="Номер" />
							<br/>
							<br/>
						</div>

					</div>

					<div class="data-show-send-content-ur" style="display:block;">

						<div class="dfull" <?if(!$USER->IsAuthorized()){ echo 'style="display:none;"'; } ?>>
							<br/>
							<input type="checkbox" id="sender_ur_Zapolnit_lc_Id"  name="sender_ur_Zapolnit_lc_Name"/>
							<label for="sender_ur_Zapolnit_lc_Id">Заполнить моими реквизитами из личного кабинета</label>
							<br />
						</div>
	
						<div class="dfull">
							<br/>
							<label class="required">Название организации</label><br />
							<input type="text" id="sender-ur-Name_Id" class="ServiceInput not_ignor" maxlength="90"  style="width:715px;" placeholder="Полное название организации"  name="sender_ur_Name"/>
						</div>

						<div class="dfull">
							<br/>
							<label class="required">Организационно-правовая форма</label><br />
							<input type="text" name="sender_ur_OrgPravForm" id="sender-ur-OrgPravForm_Id" class="ServiceInput not_ignor" style="width:715px;" maxlength="10" placeholder="ООО, ОАО, ЗАО, ИП" />
						</div>

						<div class="dfull">
						<div class="d2l">
							<br/>
								<label class="required">ИНН</label><br/>
								<input type="text" maxlength="12" name="sender_ur_INN"  id="sender-ur-INN_Id" class="ServiceInput not_ignor numbers" style="width:330px;" placeholder="ИНН" />
							<br/>

						</div>
	
						<div class="d2r">
							<br/>
							<label class="required">КПП</label><br/>
								<input type="text" maxlength="9" name="sender_ur_KPP" id="sender-ur-KPP_Id" class="ServiceInput not_ignor numbers" style="width:330px;" placeholder="КПП" />
							<br/>

						</div>
						</div>


						<div class="dfull">
						<div class="d2l">
							<br/>
								<label class="required">Контактное лицо</label><br/>
								<input type="text"  maxlength="100" name="sender_ur_Contact" id="sender-ur-Contact_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="ФИО" />
							<br/>
							<br/>
						</div>
	
						<div class="d2r">
							<br/>
								<label class="required">Контактный телефон</label><br/>
								<input type="text" name="sender_ur_Phone" id="sender-ur-Phone_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="Телефон" />
							<br/>
							<br/>
						</div>
						</div>

					</div>

			</div>

            <div id="tab2-resiv" class="tabcontent row">




						<div style="float:left; height:440px;">
							<div class="left-menu-order" style="margin-top:69px;">

								<input type="radio" name="typeClientResiv" id="typeClientResiv_fis_id" style="width:29px" data-show-fis=".next">
								<label for="typeClientResiv_fis_id">Физическое лицо&nbsp;&nbsp;</label>
							</div>
		
							<div class="left-menu-order" style="margin-top:171px;">
		
								<input type="radio" name="typeClientResiv" id="typeClientResiv_ur_id" checked="checked" style="width:29px" data-show-ur=".next">
								<label for="typeClientResiv_ur_id">Юридическое лицо&nbsp;&nbsp;</label>
		
							</div>
						</div>



					<div class="data-show-resiv-content-fis" style="display:none;">
						<div class="dfull">
							<div class="d2l" <?if(!$USER->IsAuthorized()){ echo 'style="display:none;"'; } ?>>
								<br/>
								<input type="checkbox" id="resiv_fis_Zapolnit_lc_Id"  name="resiv_fis_Zapolnit_lc_Name"/>
								<label for="resiv_fis_Zapolnit_lc_Id">Заполнить моими реквизитами из личного кабинета</label>
								<br />
							</div>
							<div class="d2r">
								<label id="LBLresiv_fis_IsSenderIsPayer" style="color:red; font-style:italic; display:block; font-size:small; padding:3px; display:none;"></label>
								<select id="resiv_fis_IsSenderIsPayer" class="order-type-document">
								  <option >Отправитель</option>
								  <option>Плательщик</option>
								  <option selected="">Третье лицо</option>
								</select>
							</div>
						</div>
						<div class="dfull">
							<div class="d2l" >
								<br/><br/>
							<label class="required">Контактное лицо</label><br />
							<input type="text"  maxlength="100" name="resiv_fis_Contact" id="resiv-fis-Contact_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="ФИО" />
							</div>
	
							<div class="d2r" >
								<br/><br/>
							<label class="required">Контактный телефон</label><br />
							<input type="text" name="resiv_fis_Phone" id="resiv-fis-Phone_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="Телефон" />
							</div>
						</div>
						<div class="dfull" style="width:42%;">
							<br/>
							<label class="required">Тип документа</label><br />
							<select id="resiv-fis-TypeDoc_Id" class="order-type-document">
							  <option selected>Паспорт</option>
							  <option>Заграничный паспорт</option>
							  <option>Водительское удостоверение</option>
							</select>
						</div>
						<div class="d2r">
						</div>

						<div class="dfull">
							<div class="d2l">
								<br/>
									<label class="required">Серия</label><br />
									<input type="text"   maxlength="14" name="resiv_fis_SDoc" id="resiv-fis-SDoc_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="Серия" />
								<br/>
								<br/>
							</div>
		
							<div class="d2r">
								<br/>
									<label class="required">Номер документа</label><br />
									<input type="text"  maxlength="14" name="resiv_fis_NDoc" id="resiv-fis-NDoc_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="Номер" />
								<br/>
								<br/>
							</div>
						</div>

					</div>

					<div class="data-show-resiv-content-ur" style="display:block;">
						<div class="dfull">
							<div class="d2l" <?if(!$USER->IsAuthorized()){ echo 'style="display:none;"'; } ?>>
								<br/>
								<input type="checkbox" id="resiv_ur_Zapolnit_lc_Id"  name="resiv_ur_Zapolnit_lc_Name"/>
								<label for="resiv_ur_Zapolnit_lc_Id">Заполнить моими реквизитами из личного кабинета</label>
								<br />
							</div>
							<div class="d2r">
								<label id="LBLresiv_ur_IsSenderIsPayer" style="color:red; font-style:italic; display:block; font-size:small; padding:3px; display:none;"></label>
								<select id="resiv_ur_IsSenderIsPayer" class="order-type-document">
								  <option >Отправитель</option>
								  <option>Плательщик</option>
								  <option selected="">Третье лицо</option>
								</select>
							</div>
						</div>
						<div class="dfull">
							<br/>
							<label class="required">Название организации</label><br />
							<input type="text" name="resiv_ur_Name" id="resiv-ur-Name_Id" class="ServiceInput not_ignor" style="width:715px;" maxlength="90" placeholder="Полное название организации" />
						</div>

						<div class="dfull">
							<br/>
							<label class="required">Организационно-правовая форма</label><br />
							<input type="text" name="resiv_ur_OrgPravForm" id="resiv-ur-OrgPravForm_Id" class="ServiceInput not_ignor" style="width:715px;"  maxlength="10" placeholder="ООО, ОАО, ЗАО, ИП" />
						</div>


						<div class="dfull">
						<div class="d2l">
							<br/>
								<label class="required">ИНН</label><br/>
								<input type="text" maxlength="12" name="resiv_ur_INN"  id="resiv-ur-INN_Id" class="ServiceInput not_ignor numbers" style="width:330px;" placeholder="ИНН" />
							<br/>

						</div>

						<div class="d2r">
							<br/>
							<label style="margin-top:9px;">КПП</label><br/>
								<input type="text" maxlength="9" name="resiv_ur_KPP" id="resiv-ur-KPP_Id" class="ServiceInput not_ignor numbers" style="width:330px;" placeholder="КПП" />
							<br/>

						</div>
						</div>

						<div class="dfull">
							<div class="d2l" >
								<br/>
									<label class="required">Контактное лицо</label><br/>
									<input type="text"  maxlength="100" name="resiv_ur_Contact" id="resiv-ur-Contact_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="ФИО" />
								<br/>
								<br/>
							</div>

							<div class="d2r" >
								<br/>
									<label class="required">Контактный телефон</label><br/>
									<input type="text" name="resiv_ur_Phone" id="resiv-ur-Phone_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="Телефон" />
								<br/>
								<br/>
							</div>
						</div>
	
					</div>





            </div>

            <div id="tab3-pay" class="tabcontent row">

                 <div style="float:left; height: 440px;">
                    <div class="left-menu-order" style="margin-top:69px;">

						<input type="radio" name="typeClientPay" id="typeClientPay_fis_id" style="width:29px">
                        <label for="typeClientPay_fis_id">Физическое лицо&nbsp;&nbsp;</label>
                    </div>

                    <div class="left-menu-order" style="margin-top:171px;">

                        <input type="radio" name="typeClientPay" id="typeClientPay_ur_id" checked="checked" style="width:29px">
                        <label for="typeClientPay_ur_id">Юридическое лицо&nbsp;&nbsp;</label>
                    </div>
                </div>


 					<div class="data-show-pay-content-fis" style="display:none;">

						<div class="dfull">
							<div class="d2l"  <?if(!$USER->IsAuthorized()){ echo 'style="display:none;"'; } ?>>
								<br/>
									<input type="checkbox" id="pay_fis_Zapolnit_lc_Id"  name="pay_fis_Zapolnit_lc_Name"/>
									<label for="pay_fis_Zapolnit_lc_Id">Заполнить моими реквизитами из личного кабинета</label>
								<br />
							</div>
							<div class="d2r">
								<label id="LBLPayer_fis_IsSenderIsPayer" style="color:red; font-style:italic; display:block; font-size:small; padding:3px; display:none;"></label>
								<select id="pay_fis_IsSenderIsResiver" class="order-type-document">
								  <option >Отправитель</option>
								  <option>Получатель</option>
								  <option selected="">Третье лицо</option>
								</select>
							</div>
						</div>

						<div class="dfull">
							<div class="d2l">
								<br/><br/>
							<label class="required">Контактное лицо</label><br />
							<input type="text"  maxlength="100" name="pay_fis_Contact" id="pay-fis-Contact_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="ФИО" />
							</div>
	
							<div class="d2r">
								<br/><br/>
							<label class="required">Контактный телефон</label><br />
							<input type="text" name="pay_fis_Phone" id="pay-fis-Phone_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="Телефон" />
							</div>
						</div>


						<div class="d2l" style="width:42%;">
							<br/>
							<label class="required">Тип документа</label><br />
							<select id="pay-fis-TypeDoc_Id" class="order-type-document">
							  <option selected>Паспорт</option>
							  <option>Заграничный паспорт</option>
							  <option>Водительское удостоверение</option>
							</select>
						</div>
						<div class="d2r">
						</div>


						<div class="dfull">
							<div class="d2l">
								<br/>
									<label class="required">Серия</label><br />
									<input type="text" name="pay_fis_SDoc"  maxlength="14" id="pay-fis-SDoc_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="Серия" />
								<br/>
								<br/>
							</div>
		
							<div class="d2r">
								<br/>
									<label class="required">Номер документа</label><br />
									<input type="text"  maxlength="14" name="pay_fis_NDoc" id="pay-fis-NDoc_Id"  class="ServiceInput not_ignor" style="width:330px;" placeholder="Номер" />
								<br/>
								<br/>
							</div>
						</div>

					</div>

					<div class="data-show-pay-content-ur" style="display:block;">

						<div class="dfull">
							<div class="d2l"  <?if(!$USER->IsAuthorized()){ echo 'style="display:none;"'; } ?>>
								<br/>
									<input type="checkbox" id="pay_ur_Zapolnit_lc_Id"  name="pay_ur_Zapolnit_lc_Name"/>
									<label for="pay_ur_Zapolnit_lc_Id">Заполнить моими реквизитами из личного кабинета</label>
								<br />
							</div>
							<div class="d2r">
								<label id="LBLPayer_ur_IsSenderIsPayer" style="color:red; font-style:italic; display:block; font-size:small; padding:3px; display:none;"></label>
								<select id="pay_ur_IsSenderIsResiver" class="order-type-document">
								  <option >Отправитель</option>
								  <option>Получатель</option>
								  <option selected="">Третье лицо</option>
								</select>
							</div>
						</div>

						<div class="dfull">
							<br/>
							<label class="required">Название организации</label><br />
							<input type="text" name="pay_ur_Name" id="pay-ur-Name_Id" class="ServiceInput not_ignor" maxlength="90"  style="width:715px;" placeholder="Полное название организации" />
						</div>

						<div class="dfull">
							<br/>
							<label class="required">Организационно-правовая форма</label><br />
							<input type="text" name="pay_ur_OrgPravForm" id="pay-ur-OrgPravForm_Id" class="ServiceInput not_ignor" style="width:715px;"  maxlength="10" placeholder="ООО, ОАО, ЗАО, ИП" />
						</div>

						<div class="dfull">
							<div class="d2l">
								<br/>
									<label class="required">ИНН</label><br/>
									<input type="text" maxlength="12" name="pay_ur_INN"  id="pay-ur-INN_Id" class="ServiceInput not_ignor numbers" style="width:330px;" placeholder="ИНН" />
								<br/>
							</div>
							<div class="d2r">
								<br/>
								<label style="margin-top:9px;">КПП</label><br/>
									<input type="text" maxlength="9" name="pay_ur_KPP" id="pay-ur-KPP_Id" class="ServiceInput not_ignor numbers" style="width:330px;" placeholder="КПП" />
								<br/>
							</div>
						</div>

						<div class="dfull">
							<div class="d2l">
								<br/>
									<label class="required">Контактное лицо</label><br/>
									<input type="text"  maxlength="100" name="pay_ur_Contact" id="pay-ur-Contact_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="ФИО" />
								<br/>
								<br/>
							</div>
		
							<div class="d2r">
								<br/>
									<label class="required">Контактный телефон</label><br/>
									<input type="text" name="pay_ur_Phone"  id="pay-ur-Phone_Id" class="ServiceInput not_ignor" style="width:330px;" placeholder="Телефон" />
								<br/>
								<br/>
							</div>
						</div>
	
					</div>



            </div>
		</div>

			<div class="mla">
							<br/>
                            <input type="checkbox" name="get-callback" id="get-callback_Id" >
                            <label for="get-callback_Id">Заказать обратный звонок</label>
                            <br/>
                            <br/>
                            <br/>
                            <p style="font-size: 12px"><span style="color: brown">* </span>Подписание настоящей заявки означает согласие Заказчика (акцепт) с предложением (оферта) Исполнителя заключить <a href="https://www.sibtrans.ru/upload/iblock/c0d/Dogovor-publichnoy-oferty-BTK-aktualnaya-redaktsiya-_Sberbank_.pdf" target="_blank" style="color: brown; cursor: pointer; text-decoration: none;">договор</a>, текст которого размещен на сайте Исполнителя в информационно-коммуникационной сети "Интернет" по адресу: www.sibtrans.ru. Заказчик ознакомлен с условиями договора, принимает их полностью и безоговорочно.</p>
                            <br/>
                            
	    	</div>

			<div style="clear:both;"></div>

    </div>
   </form>

			<br/>
			<br/>
			<br/>




</div>

<br />


<div style="clear:both;"></div>
<p id="result-order-send"></p>




    <div style="display:none">
           <div id="dialog_content" class="dialog_content">
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

    <div style="display:none">
           <div id="dialog_content_error" class="dialog_content_error">
            <div class="dialogModal_header">Отправка заявки</div>
            <div class="dialogModal_content">
                Сервер недоступен. Повторите попытку позже.<br>
            </div>
            <div class="dialogModal_footer">
                <!--<button type="button" class="btn btn-primary" data-dialogmodal-but="next">ОК</button>-->
                <button type="button" class="btn btn-default" data-dialogmodal-but="ok">ОК</button>
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

	$('#PhoneBOXDeliveryOut_Id, #PhoneBOXDeliveryIn_Id, #sender-fis-Phone_Id, #sender-ur-Phone_Id, #resiv-fis-Phone_Id, #resiv-ur-Phone_Id, #pay-fis-Phone_Id, #pay-ur-Phone_Id, #customer-Phone_Id').inputmasks(maskOpts);


</script>



 <? $APPLICATION->AddChainItem($APPLICATION->GetTitle(), $APPLICATION->GetCurPage()); ?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>






<link rel="stylesheet" href="<? echo SITE_TEMPLATE_PATH; ?>/css/jquery-ui.css">


<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery-ui.js"  type="text/javascript"></script>

<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.ui.datepicker-ru.js"  type="text/javascript"></script>



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
})(jQuery);



</script>



<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/popModal.js" type="text/javascript"></script>



