<div class="container">
<div class="row-fluid">


	<?php
	  $baseUrl = Yii::app()->theme->baseUrl; 
	  $cs = Yii::app()->getClientScript();
	  Yii::app()->clientScript->registerCoreScript('jquery');
	?>

  <div class="span6">
		<a href="" class="logo"></a>
  </div><!--/.span6 -->
  <div class="span6" style="margin-top: 10px;">
		<img class="pull-right"  style="margin-left: 5px; margin-top:3px;" src="<?php echo $baseUrl;?>/img/ico/de-flag.png">
		<span class="pull-right" >Deutschland</span>
  </div><!--/.span6 -->
  
  <!-- <div class="span6">
    <div class="social-icons pull-right clearfix">
        <div class="" style="text-align:right;"><img src="<?php echo $baseUrl;?>/img/icons/social/facebook.png"  alt="Facebook" /> <img src="<?php echo $baseUrl;?>/img/icons/social/twitter.png"  alt="Twitter" /> <img src="<?php echo $baseUrl;?>/img/icons/social/linkedin.png"  alt="LinkedIn" /> <img src="<?php echo $baseUrl;?>/img/icons/social/google.png"  alt="Google+" /> <img src="<?php echo $baseUrl;?>/img/icons/social/rss.png"  alt="RSS" /></div>
        <div class="header-text" style="">TOLL FREE: (123) 456 7890</div>
    </div>   
  </div> -->

</div><!--/.row-fluid header -->
</div>