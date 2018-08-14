<?php

if( !defined( '_VALID_MOS' ) && !defined( '_JEXEC' ) ) die( 'Direct Access to '.basename(__FILE__).' is not allowed.' ); 

/* slide Products Module

*/

if (!class_exists ('VmConfig')) {
		require(JPATH_ADMINISTRATOR . '/components/com_virtuemart/helpers/config.php');
	}
	VmConfig::loadConfig ();
	// Load the language file of com_virtuemart.
	JFactory::getLanguage ()->load ('com_virtuemart');
	
	if (!class_exists ('VmImage')) {
		require(JPATH_ADMINISTRATOR . '/components/com_virtuemart/helpers/image.php');
	}	
	if (!class_exists ('VirtueMartModelProduct')) {
		JLoader::import ('product', JPATH_ADMINISTRATOR . '/components/com_virtuemart/models');
	}

	$category_id=JRequest::getVar("virtuemart_category_id");
	$productModel = VmModel::getModel('Product');

	$products = $productModel->getProductListing('random', 20, false, true, false,true, $category_id);
	$productModel->addImages($products);


?>

<link href="js/jss/style.css" rel="stylesheet" type="text/css" />
<!--
<script src="js/jss/jquery.js"></script>-->

<script src="js/jss/image-slideshow.js"></script>

  <script type="text/javascript">

  jQuery.noConflict();

	jQuery(document).ready(function() {
	      initSlideShow();
	});

  var autoSpeed = 1

	var itemLength = 160

	var itemsLength = 1232

	var autoStart = false;

  </script>	

		<div id="portfolio-content">

			<a id="portfolio-prev" title="Previous" href="javascript:void(0);"></a>	

			<a id="portfolio-next" title="Next" href="javascript:void(0);"></a>	

			<div id="portfolio-relative">

			<ul style="left: 0px;" id="portfolio-content-content">

			 <?php foreach ($products as $product) { 
			 	 if (!empty($product->images[0])) {
					$image = $product->images[0]->displayMediaThumb ('class="browseProductImage" border="0"', FALSE);
					
				 } else {
					$image = '';
				 }	
			 ?>
			 	 <li class="portfolio-item"><div style="margin-bottom: 10px; height: 180px;" class="browseProductContainer"><?php echo JHTML::_ ('link', JRoute::_ ('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $product->virtuemart_product_id . '&virtuemart_category_id=' . $product->virtuemart_category_id), $image, array('title' => $product->product_name.'::<img src=\''.JURI::root().$product->images[0]->file_url.'\'/>', 'class'=>'hasTip')); echo '<div class="title-item">'.JHTML::link($product->link, $product->product_name).'</div>'; ?></div>					
					</li>
			 <?php } ?>
			</ul>

			</div>			

		</div>

		

	

			

		