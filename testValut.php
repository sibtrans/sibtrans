<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>

<p><? $date = date("d/m/Y"); echo $date; ?></p>


<?

function GetValute1()
{
		$date = date("d/m/Y");
		$http = new CHTTP;
		$http->HTTPQuery('GET', "http://www.cbr.ru/scripts/XML_daily.asp?date_req=".$date);


	
		$pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i";
		preg_match_all($pattern, $http->result, $out, PREG_SET_ORDER); 



	   $valuta;

        foreach($out as $cur) 
		{ 
			if($cur[2] == 840) 
			{ 
				$usd = str_replace(",", ".", $cur[4]); 

				    $valuta['usd'] = $usd; 


			} // Доллар США 
	
			if($cur[2] == 978) 
			{ 
				 $eur = str_replace(",", ".", $cur[4]);
				      $valuta['eur'] = $eur; 

			} // Евро 
	
			if($cur[2] == 156) 
			{ 
				$cny = str_replace(",", ".", $cur[4]);
				    $valuta['cny'] = $cny;   

			} // Китайский юань
      }

return $valuta;
}

?>




<? $vv = GetValute1(); ?>

<pre><?print_r($vv);?></pre>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>