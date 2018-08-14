<?php
/*------------------------------------------------------------------------
# mod_endofslidebox module
# ------------------------------------------------------------------------
# author    WebKul
# copyright Copyright (C) 2010 webkul.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.webkul.com
# Technical Support:  Forum - http://www.webkul.com/index.php?Itemid=86&option=com_kunena
-------------------------------------------------------------------------*/
// no direct access
defined('_JEXEC') or die('Restricted access'); 
?>
<style>
#share{
    width: 300px;
    display: block;
    float: left;
    position: absolute;
	height:22px;
    left: 30px;
    z-index: 99999;
}

#fbdiv{
 display: block;
 float:left;
 width:90px;
}
#twtdiv{
	display: block;
	float:left;
	width:100px;
}

#relateddata{
	max-height:<?php echo $height-'60'; ?>px;
	padding: 8px;
}

#sliderpop {
    border: 1px solid black;
    box-shadow: -3px 3px 3px #888888;
    display: none;
    overflow: hidden;
	height:<?php echo $height-'5'; ?>px;
	background-color: #FFFFFF;
}

#sliderpop div.header {
    background-color: <?php echo $header_bgcolor; ?>;
    color: white;
    font-family: Arial;
    font-weight: 900;
    padding-left: 10px;
}

#slidebox<?php echo $moduleclasssfx; ?>{
    width:<?php echo $width; ?>px;
    height:<?php echo $height; ?>px;	
    padding:20px;
    position:fixed;
    bottom:0px;
    right:-500px;
    opacity:0;	
	z-index:9999;
}

#slidebox<?php echo $moduleclasssfx; ?> h1{
    color:<?php echo $color; ?>;
	font-size:18px;
    margin:0px;
}
</style>

<div id="slidebox<?php echo $moduleclasssfx; ?>">
	<div id="sliderpop" style="display: block;">
		<div class="header">
			<?php echo $header_text; ?>
			<a class="close"></a>	
		</div>
		<div id="relateddata">
			<?php if ($count == 1) {
			 		foreach ($list as $item) :	?>
						<!-- <p><a href="http://www.ultimateinspiration.com.au/buy-with-confidence.html#clientreview<?php //echo $item->route; ?>">
					<?php echo $item->title; ?></a></p> -->
					<?php	
						$str = $item->introtext; 
						$substr = substr_replace($str,"",$limittext);
						echo $substr;
					?>
						<p><a href="http://www.ultimateinspiration.com.au/buy-with-confidence.html#clientreview">Read More</a></p>
					<?php				
					endforeach; 
				} else {  ?>
				<ul>
					<?php foreach ($list as $item) :  ?>		
						<li>
							<a href="<?php echo $item->route; ?>">
							<?php echo $item->title; ?> </a>
						</li>
					<?php endforeach;  ?>
				</ul>
			<?php } ?>
		</div>
	<?php if($enablefb==1 || $enabletweet ==1 ){?>
	<div id="share">
	<?php 
	$uri = & JFactory::getURI();
	$pageURL = $uri->toString();
	?>
		<?php if($enablefb==1) {?>
			<div id="fbdiv">
			<div id="fb-root"></div>
			<script>(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));</script>
			<div class="fb-like" data-href="<?php echo $pageURL; ?>" data-send="false" data-layout="button_count" data-width="80" data-show-faces="true"></div>
			</div>
		<?php } 
			if($enabletweet==1)
			{
		?>
		<div id="twtdiv">
		<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
</div>

</div>



<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js" type="text/javascript"></script>-->



<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js" type="text/javascript"></script>

<script type="text/javascript">



jQuery.noConflict();

jQuery(document).ready(function(){

    jQuery(window).scroll(function(){//alert(jQuery(document).height()/2); //1583

	//alert(jQuery(window).height());  //692

	//alert(jQuery(window).scrollTop()/2); //881

		

		var yt=<?php echo $showpercent; ?>;

		var ht=100/yt;

		//alert(yt);

        if((jQuery(window).scrollTop()) >= (jQuery(document).height() - jQuery(window).height())/ht)

        {



            jQuery("#slidebox<?php echo $moduleclasssfx; ?>").stop(true).animate({"right":"0px","opacity":"1"}, { queue: false, duration: 500, easing: "easeInCubic" });          



        }



        else



        {



           jQuery("#slidebox<?php echo $moduleclasssfx; ?>").stop(true).animate({"right":"-500px","opacity":"0"},{queue: false, duration: 500});          



        }



    });

jQuery("#slidebox<?php echo $moduleclasssfx; ?> .close").bind("click",function(){

jQuery("#slidebox<?php echo $moduleclasssfx; ?>").stop(true).animate({"right":"-500px","opacity":"0"},{queue: false, duration: 500});

});

});       

</script>