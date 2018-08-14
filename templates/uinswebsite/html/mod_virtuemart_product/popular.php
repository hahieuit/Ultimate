<?php // no direct access
defined ('_JEXEC') or die('Restricted access');
$col = 1;
$pwidth = ' width' . floor (100 / $products_per_row-2);
if ($products_per_row > 1) {
	$float = "floatleft";
} else {
	$float = "center";
}
?>


<div class="vmgroup<?php echo $params->get ('moduleclass_sfx') ?>">

	<?php if ($headerText) { ?>
	<div class="vmheader"><?php echo $headerText ?></div>
	<?php
}
	if ($display_style == "div") {
			if(count ($products) > 5 && $params->get ('moduleclass_sfx')=='recent-viewed'){
		?>
			<link href="js/jss/style.css" rel="stylesheet" type="text/css" />
			<!--
			<script src="js/jss/jquery.js"></script>-->
			
			<script src="js/jss/recent-slideshow.js"></script>
			
			  <script type="text/javascript">
			
				jQuery.noConflict();
				jQuery(document).ready(function() {
				      initRecentSlideShow()	
				});
			
			  var autoSpeed = 1
			
				var itemLength = 155
			
				var itemsLength = 1232
			
				var autoStart = false;
			
			  </script>	
			<div id="recent-content">
				<a id="recent-prev" title="Previous" href="javascript:void(0);"></a>	
				<a id="recent-next" title="Next" href="javascript:void(0);"></a>	
				<div id="recent-relative">
	
				<ul style="left: 0px;" id="recent-content-content">
	
				 <?php foreach ($products as $product) { 
				 	 if (!empty($product->images[0])) {
						$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage" border="0" alt="'.$product->product_name.'"', FALSE);
						
					 } else {
						$image = '';
					 }	
				 ?>
				 	 <li class="recent-item"><div style="margin-bottom: 10px; height: 180px;" class="browseProductContainer"><?php echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name.'::<img src=\''.JURI::root().$product->images[0]->file_url.'\'/>', 'class'=>'hasTip')); 
							$url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .$product->virtuemart_category_id); ?><div class="title-item">
						<?php
							$ttn_prdName = explode('|',$product->product_name,2)	;
							if (count($ttn_prdName)==2){
						?>
	                                <p><a href="<?php echo $url ?>"><?php echo $ttn_prdName[0] ?></a></p>
	                                <span class="ttn-sbname-pro"><?php echo $ttn_prdName[1] ?></span>
	                                <?php
									
							}else{?>
								<a href="<?php echo $url ?>"><?php echo $product->product_name ?></a>                      
	                    
	                    	<?php  }?>
						</div></div>					
					</li>
				 <?php } ?>
				</ul>
				</div>			
			</div>
		<?php } else { ?>
			<div class="vmproduct<?php echo $params->get ('moduleclass_sfx'); ?>">
			<?php foreach ($products as $product) { ?>
			<div class="<?php echo $pwidth ?> <?php echo $float ?>" style="text-align: center; margin-bottom:10px; margin-right:10px;" >
				<div class="spacer">
				<div style=" height:100px;">
					<?php
					if (!empty($product->images[0])) {
						$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage" border="0" alt="'.$product->product_name.'"', FALSE);
					} else {
						$image = '';
					}
					echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name.'::<img src=\''.JURI::root().$product->images[0]->file_url.'\'/>', 'class'=>'hasTip'));
					echo '<div class="clear"></div></div>';
					$url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .
						$product->virtuemart_category_id); ?><div style="color:#BF0000;">
                        <?php
							$ttn_prdName = explode('|',$product->product_name,2)	;
							if (count($ttn_prdName)==2){
								?>
                                <p><a href="<?php echo $url ?>"><?php echo $ttn_prdName[0] ?></a></p>
                                <span class="ttn-sbname-pro"><?php echo $ttn_prdName[1] ?></span>
                                <?php
								
							}
							else
							{
						
						 ?>
					<a href="<?php echo $url ?>"><?php echo $product->product_name ?></a>                      
                    
                    <?php  
							}
					echo '<div class="clear"></div></div>';
							

					if ($show_price) {
						// 		echo $currency->priceDisplay($product->prices['salesPrice']);
						if (!empty($product->prices['salesPrice'])) {
							echo $currency->createPriceDiv ('salesPrice', '', $product->prices, TRUE);
						}
						// 		if ($product->prices['salesPriceWithDiscount']>0) echo $currency->priceDisplay($product->prices['salesPriceWithDiscount']);
						if (!empty($product->prices['salesPriceWithDiscount'])) {
							echo $currency->createPriceDiv ('salesPriceWithDiscount', '', $product->prices, TRUE);
						}
					}
					if ($show_addtocart) {
						echo mod_virtuemart_product::addtocart ($product);
					}
					?>
				</div>
			</div>
			<?php
			if ($col == $products_per_row && $products_per_row && $col < $totalProd) {
				echo "	</div><div style='clear:both;'>";
				$col = 1;
			} else {
				$col++;
			}
		} ?>
		</div>
		<br style='clear:both;'/>
		<?php
	}} else {
		$last = count ($products) - 1;
		?>

		<ul class="vmproduct<?php echo $params->get ('moduleclass_sfx'); ?>">
			<?php foreach ($products as $product) : ?>
			<li class="<?php echo $pwidth ?> <?php echo $float ?>">
				<?php
				if (!empty($product->images[0])) {
					$image = $product->images[0]->displayMediaThumb ('class="featuredProductImage" border="0"', FALSE);
				} else {
					$image = '';
				}
				echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name));
				echo '<div class="clear"></div>';
				$url = JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' .
					$product->virtuemart_category_id); ?>
				<a href="<?php echo $url ?>"><?php echo $product->product_name ?></a>        <?php    echo '<div class="clear"></div>';

				if ($show_price) {
					echo $currency->createPriceDiv ('salesPrice', '', $product->prices, TRUE);
					if ($product->prices['salesPriceWithDiscount'] > 0) {
						echo $currency->createPriceDiv ('salesPriceWithDiscount', '', $product->prices, TRUE);
					}
				}
				if ($show_addtocart) {
					echo mod_virtuemart_product::addtocart ($product);
				}
				?>
			</li>
			<?php
			if ($col == $products_per_row && $products_per_row && $last) {
				echo '
		</ul><div class="clear"></div>
		<ul  class="vmproduct' . $params->get ('moduleclass_sfx') . '">';
				$col = 1;
			} else {
				$col++;
			}
			$last--;
		endforeach; ?>
		</ul>
		<div class="clear"></div>

		<?php
	}
	if ($footerText) : ?>
		<div class="vmfooter<?php echo $params->get ('moduleclass_sfx') ?>">
			<?php echo $footerText ?>
		</div>
		<?php endif; ?>
</div>