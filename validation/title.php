<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>



<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.validate.js"></script>


<script>
	$.validator.setDefaults({
		submitHandler: function() {
			alert("submitted!");
			
			OrderSend();
			
			
		}
	});
	
	// отправка заявки
	    function OrderSend(){


		}

	
	

	$().ready(function() {
		// validate the comment form when it is submitted
		$("#commentForm").validate();

		// validate signup form on keyup and submit
		$("#signupForm").validate({
			rules: {
				firstname: "required",
				lastname: "required",
				username: {
					required: true,
					minlength: 2
				},

				email_name: {
					required: true,
					email: true
				},
				topic: {
					required: "#newsletter:checked",
					minlength: 2
				},
				agree: "required"
			},
			messages: {
				firstname: "Please enter your firstname",
				lastname: "Please enter your lastname",
				username: {
					required: "Please enter a username",
					minlength: "Your username must consist of at least 2 characters"
				},

				email_name: "Please enter a valid email address",
				agree: "Please accept our policy",
				topic: "Please select at least 2 topics"
			}
			
		});

		

	
	});
	</script>

	<style>

	#commentForm {
		width: 500px;
	}
	#commentForm label {
		width: 250px;
	}
	#commentForm label.error, #commentForm input.submit {
		margin-left: 253px;
	}
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





<br/><br/><br/><br/><br/><br/><br/><br/><br/>


<div>


<input type="text" id="customer_phone" value="7" size="25"><br>

</div>

<div>

	
	<form id="signupForm" method="post" action="">
		<fieldset>
			<legend>Validating a complete form</legend>
			<p>
				<label for="firstname">Firstname</label>
				<input id="firstname" name="firstname" type="text">
			</p>
			<p>
				<label for="lastname">Lastname</label>
				<input id="lastname" name="lastname" type="text">
			</p>
			<p>
				<label for="username">Username</label>
				<input id="username" name="username" type="text">
			</p>
	
			<p>
				<label for="email">Email</label>
				<input id="email" name="email_name" type="email">
			</p>
			<p>
				<label for="agree">Please agree to our policy</label>
				<input type="checkbox" class="checkbox" id="agree" name="agree">
			</p>
		
	
			<p>
				<input class="submit" type="submit" value="Submit">
			</p>
		</fieldset>
	</form>
	
	
	
</div>



<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.inputmask-multi.min.js" type="text/javascript"></script>
<script src="<? echo SITE_TEMPLATE_PATH; ?>/js/jquery.inputmask.bundle.js" type="text/javascript"></script>
<script>
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

$('#customer_phone').inputmasks(maskOpts);


</script>









<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>