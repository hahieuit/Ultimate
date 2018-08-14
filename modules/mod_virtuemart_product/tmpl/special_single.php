<?php // no direct access

defined('_JEXEC') or die('Restricted access');

?>

<div class="vmgroup<?php echo $params->get( 'moduleclass_sfx' ) ?>">



<?php if ($headerText) { ?>

	<div class="vmheader"><?php echo $headerText ?></div>

<?php } ?>



<div class="vmproduct<?php echo $params->get('moduleclass_sfx'); ?>">



<?php foreach ($products as $product) { ?>

	<div style="float:left;width:98%;text-align:top;padding:0px;" >

    	<div id="ttn-fp-colleft">

        	<div id="ttn-fp-colleft-inner">

<?php

 if (!empty($product->images[0]) )

 $image = $product->images[0]->displayMediaThumb('class="featuredProductImage" border="0"',false) ;

 else $image = '';

 echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id),$image,array('title' => $product->product_name.'::<img src=\''.JURI::root().$product->images[0]->file_url.'\'/>','class'=>'hasTip') );

 ?>

 </div></div>

  <div id="ttn-fp-colright">

        	<div id="ttn-fp-colright-inner">

            	<div id="ttn-fp-namepro"><?php

 $ttn_prdName = explode('|',$product->product_name,2);

 $url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id); ?>		

<a href="<?php echo $url ?>"><?php 

	 	if (count($ttn_prdName)==2){

						echo '<h4 class="ttn_prdName">'.$ttn_prdName[0].'</h4>';

						echo '<span class="ttn_prdName_subtitle">'.$ttn_prdName[1].'</span>';

					}else{

						echo '<h4 class="ttn_prdName">'.$product->product_name.'</h4>';

					}

	  ?></a>

     </div>

                <div id="ttn-fp-subnamepro"></div>

                <div id="ttn-short-desc"><?php echo $product->product_s_desc;?></div>

                <div id="ttn-desc-rm">

                <a title="<?php echo $product->product_name ?>" href="<?php echo $url; ?>">Read more</a>

                </div> </div>

        </div>

 		<?php



 if ($show_price) {

 // 		echo $currency->priceDisplay($product->prices['salesPrice']);

 if (!empty($product->prices['salesPrice'] ) ) echo $currency->createPriceDiv('salesPrice','',$product->prices,true);

 // 		if ($product->prices['salesPriceWithDiscount']>0) echo $currency->priceDisplay($product->prices['salesPriceWithDiscount']);

 if (!empty($product->prices['salesPriceWithDiscount']) ) echo $currency->createPriceDiv('salesPriceWithDiscount','',$product->prices,true);

 }

 if ($show_addtocart) echo mod_virtuemart_product::addtocart($product);

 ?>

 

 </div>



	<?php } ?>

<?php if ($footerText) { ?>

	<div class="vmheader"><?php echo $footerText ?></div>

<?php } ?>

</div>

</div>