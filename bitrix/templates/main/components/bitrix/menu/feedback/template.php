<div style="margin:0px auto; width:1190px; min-height:330px; ">
	<div style="margin-top:30px; margin-bottom:40px; margin-left:65px;">
    <div><p class="titel-obratnaya-svyaz">Всегда на связи</p></div>

<div class="news-list">

<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<br/><br/>
   <?
     foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
   ?>
	<p style="margin-bottom:6px; margin-top:5px;"><a href="<?=$arItem["LINK"]?>" <?=(substr($arItem["LINK"],0,4)=="http")?'target="_blank"':'';?>><?=$arItem["TEXT"]?></a></p> 

  <? if($arItem["PARAMS"])
   {

      foreach($arItem["PARAMS"] as $descr)
	  {
         echo $descr;
	  }
   }

  ?><br/>
	
	<hr class="line-gradient"><br/>
	<?endforeach?>



<?endif?>

</div>
</div>
</div>
