<style type="text/css">
	li {
		position: relative;

border-left: 1px solid gray;
font-size: 18px;
}

</style>
<?
$aMenuLinks = Array(
	Array(
		"Главная", 
		"/lc/", 
		Array(), 
		Array("NEED_FULL"=>"N"), 
		"" 
	),
	Array(
		"Заявки", 
		"/lc/requests.php", 
		Array(), 
		Array("NEED_FULL"=>"Y"), 
		"" 
	),
	Array(
		"Перевозки", 
		"/lc/transportations.php", 
		Array(), 
		Array("NEED_FULL"=>"Y"), 
		"" 
	),
	Array(
		"Платежи", 
		"/lc/payments.php", 
		Array(), 
		Array("NEED_FULL"=>"Y"), 
		"" 
	),
	Array(
		"Обратная связь", 
		"/lc/feedback.php", 
		Array(), 
		Array("NEED_FULL"=>"N"), 
		"" 
	)
);
?>