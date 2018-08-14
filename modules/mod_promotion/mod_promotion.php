<?php
if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' );
// image
	$img1 	= $params->get( 'img1');
	$img2 	= $params->get( 'img2');
	$img3 	= $params->get( 'img3');
	$img4 	= $params->get( 'img4');
	$img5 	= $params->get( 'img5');
	$img6 	= $params->get( 'img6');
	$img7 	= $params->get( 'img7');
	$img8 	= $params->get( 'img8');
	$img9 	= $params->get( 'img9');
	$img10	= $params->get('img10');
// link		
	  $link1 	= $params->get( 'link1');
	  $link2 	= $params->get( 'link2');
	  $link3 	= $params->get( 'link3');
	  $link4 	= $params->get( 'link4');
	  $link5 	= $params->get( 'link5');
	  $link6 	= $params->get( 'link6');
	  $link7 	= $params->get( 'link7');
	  $link8 	= $params->get( 'link8');
	  $link9 	= $params->get( 'link9');
	  $link10 	= $params->get( 'link10');
 ?>

<!--<script src="js/jquery_005.js" type="text/javascript"></script>-->
<?php /*?>
<script src="<?php echo $this->baseurl ?>/js/App.js" type="text/javascript"></script>
<?php */ ?>
<script src="js/App.js" type="text/javascript"></script>
	
<div id="SideDeal">
<div id="SideDealInner">
<div id="SideDealContent">
<div id="ScrollArrowUpHolder" class="ScrollArrow" style="display: block;"><img src="js/right4.jpg" border="0" alt="Move" /></div>
<div id="SideDealContentInner" style=" text-align:center;padding-bottom:30px; padding-top:0px;">
<?php if($img1){?>
<div class="SideDealContentInner " style=" margin-top: 0px; height:110px;"><?php if( $link1!='' && $link1!='#'){?><a href="<?php echo $link1?>"  ><img src="images/promotions/<?php echo $img1;?>" width="225" height="97" border="0" title="" class="img_promo" style="width:225px;" /></a><?php } else {?><img src="images/promotions/<?php echo $img1;?>" width="225" height="97"  border="0" title="" class="img_promo"  style="width:225px;" /><?php }?></div>
<?php } ?>
<?php if($img2){?>
<div class="SideDealContentInner " style=" margin-top: 0px; height:110px;"><?php if( $link2!='' && $link2!='#'){?><a href="<?php echo $link2?>"   ><img src="images/promotions/<?php echo $img2;?>" width="225" height="125"  border="0" title="" class="img_promo" style="width:225px;"  /></a><?php } else {?><img src="images/promotions/<?php echo $img2;?>" width="225" height="125" border="0" title="" class="img_promo" style="width:225px;" /><?php }?></div>
<?php } ?>
<?php if($img3){?>
<div class="SideDealContentInner " style=" margin-top: 0px; height:110px;"><?php if( $link3!='' && $link3!='#'){?><a href="<?php echo $link3?>"   ><img src="images/promotions/<?php echo $img3;?>" width="225" height="102"  border="0" title="" class="img_promo"  style="width:225px;"  /></a><?php } else {?><img src="images/promotions/<?php echo $img3;?>"  width="225" height="102"  border="0" title="" class="img_promo" style="width:225px;"  /><?php }?></div>
<?php } ?>
<?php if($img4){?>
<div class="SideDealContentInner " style=" margin-top: 0px; height:110px;"><?php if( $link4!='' && $link4!='#'){?><a href="<?php echo $link4?>"   ><img src="images/promotions/<?php echo $img4;?>"  width="225" height="106"  border="0" title="" class="img_promo" style="width:225px;"  /></a><?php } else {?><img src="images/promotions/<?php echo $img4;?>"  width="225" height="106"   border="0" title="" class="img_promo"  style="width:225px;"  /><?php }?></div>
<?php } ?>
<?php if($img5){?>
<div class="SideDealContentInner " style=" margin-top: 0px; height:110px;"><?php if( $link5!='' && $link5!='#'){?><a href="<?php echo $link5?>"   ><img src="images/promotions/<?php echo $img5;?>"  width="225" height="102"  border="0" title="" class="img_promo"  style="width:225px;"  /></a><?php } else {?><img src="images/promotions/<?php echo $img5;?>"  width="225" height="102"   border="0" title="" class="img_promo"  style="width:225px;"  /><?php }?></div>
<?php } ?>
<?php if($img6){?>
<div class="SideDealContentInner " style=" margin-top: 0px; height:110px;"> <?php if( $link6!='' && $link6!='#'){?><a href="<?php echo $link6?>"  ><img src="images/promotions/<?php echo $img6;?>" width="225" height="102"  border="0" title="" class="img_promo" style="width:225px;"   /></a><?php } else {?><img src="images/promotions/<?php echo $img6;?>" width="225" height="102"  border="0" title="" class="img_promo" style="width:225px;"  /><?php }?></div>
<?php } ?>
<?php if($img7){?>
<div class="SideDealContentInner " style=" margin-top: 0px; height:110px;"><?php if( $link7!='' && $link7!='#'){?><a href="<?php echo $link7?>"   ><img src="images/promotions/<?php echo $img7;?>" width="225" height="102" border="0" title="" class="img_promo"  style="width:225px;"  /></a><?php } else {?><img src="images/promotions/<?php echo $img7;?>" width="225" height="102" border="0" title="" class="img_promo" style="width:225px;"  /><?php }?></div>
<?php } ?>
<?php if($img8){?>
<div class="SideDealContentInner " style=" margin-top: 0px; height:110px;"><?php if( $link8!='' && $link8!='#'){?><a href="<?php echo $link8?>"   ><img src="images/promotions/<?php echo $img8;?>"  border="0" title="" class="img_promo"  style="width:225px;"  /></a><?php } else {?><img src="images/promotions/<?php echo $img8;?>"  border="0" title="" class="img_promo" style="width:225px;"  /><?php }?></div>
<?php } ?>
<?php if($img9){?>
<div class="SideDealContentInner " style=" margin-top: 0px; height:110px;"><?php if( $link9!='' && $link9!='#'){?><a href="<?php echo $link9?>"   ><img src="images/promotions/<?php echo $img9;?>" border="0" title="" class="img_promo" style="width:225px;"  /></a><?php } else {?><img src="images/promotions/<?php echo $img9;?>"  border="0" title="" class="img_promo" style="width:225px;"  /><?php }?></div>
<?php } ?>
<?php if($img10){?>
<div class="SideDealContentInner " style=" margin-top: 0px; height:110px;"><?php if( $link10!='' && $link10!='#'){?><a href="<?php echo $link10?>"><img src="images/promotions/<?php echo $img10;?>" border="0" title="" class="img_promo" style="width:225px;"  /></a><?php } else {?><img src="images/promotions/<?php echo $img10;?>"  border="0" title="" class="img_promo" style="width:225px;"  /><?php }?></div>
<?php } ?>

</div>
<div id="ScrollArrowDownHolder" class="ScrollArrow" style="display: block;"><img src="js/right3.jpg" border="0" alt="Move" /></div>
</div>
</div>
</div>
<script type="text/javascript">
	var visibleSideDeals =<?php echo $params->get( 'visible');?>;
</script>