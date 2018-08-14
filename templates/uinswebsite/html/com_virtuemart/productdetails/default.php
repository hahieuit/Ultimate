<?php

/**

 *

 * Show the product details page

 *

 * @package	VirtueMart

 * @subpackage

 * @author Max Milbers, Eugen Stranz

 * @author RolandD,

 * @todo handle child products

 * @link http://www.virtuemart.net

 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.

 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php

 * VirtueMart is free software. This version may have been modified pursuant

 * to the GNU General Public License, and as distributed it includes or

 * is derivative of works licensed under the GNU General Public License or

 * other free or open source software licenses.

 * @version $Id: default.php 6246 2012-07-09 19:00:20Z Milbo $

 */

// Check to ensure this file is included in Joomla!

defined('_JEXEC') or die('Restricted access');



// addon for joomla modal Box

JHTML::_('behavior.modal');

// JHTML::_('behavior.tooltip');

$url = JRoute::_('index.php?option=com_virtuemart&view=productdetails&task=askquestion&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component');

$document = JFactory::getDocument();

$document->addScript(JURI::base() . "components/com_virtuemart/assets/js/slimbox.js");

$document->addStyleSheet(JURI::base() . "components/com_virtuemart/assets/css/slimbox.css");



$document->addScriptDeclaration("

/*	jQuery(document).ready(function($) {

		$('a.ask-a-question').click( function(){

			$.facebox({

				iframe: '" . $url . "',

				rev: 'iframe|550|550'

			});

			return false ;

		}); */

	/*	$('.additional-images a').mouseover(function() {

			var himg = this.href ;

			var extension=himg.substring(himg.lastIndexOf('.')+1);

			if (extension =='png' || extension =='jpg' || extension =='gif') {

				$('.main-image img').attr('src',himg );

			}

			console.log(extension)

		});

	});*/

");

/* Let's see if we found the product */

if (empty($this->product)) {

    echo JText::_('COM_VIRTUEMART_PRODUCT_NOT_FOUND');

    echo '<br /><br />  ' . $this->continue_link_html;

    return;

}

?>

<div id="ttn_prdDetail_wrapper"><div id="product_list_inner1"><div id="product_list_inner2"><div id="product_list_inner3">





    <?php

    // Product Navigation

    if (VmConfig::get('product_navigation', 1)) {

	?>

        <div class="product-neighbours">

	    <?php

	    if (!empty($this->product->neighbours ['previous'][0])) {

		$prev_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['previous'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id);

		echo JHTML::_('link', $prev_link, $this->product->neighbours ['previous'][0]

			['product_name'], array('class' => 'previous-page'));

	    }

	    if (!empty($this->product->neighbours ['next'][0])) {

		$next_link = JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->neighbours ['next'][0] ['virtuemart_product_id'] . '&virtuemart_category_id=' . $this->product->virtuemart_category_id);

		echo JHTML::_('link', $next_link, $this->product->neighbours ['next'][0] ['product_name'], array('class' => 'next-page'));

	    }

	    ?>

    	

        </div><br clear="all">

    <?php } // Product Navigation END

    ?>



	<?php // Back To Category Button

	if ($this->product->virtuemart_category_id) {

		$catURL =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$this->product->virtuemart_category_id);

		$categoryName = $this->product->category_name ;

	} else {

		$catURL =  JRoute::_('index.php?option=com_virtuemart');

		$categoryName = jtext::_('COM_VIRTUEMART_SHOP_HOME') ;

	}

	?>





    <?php // Product Title   ?>

    <h1 class="prdName"><?php echo $this->product->product_name ?></h1>

    <?php // Product Title END   ?>



    <?php // afterDisplayTitle Event

    echo $this->product->event->afterDisplayTitle ;?>



    <?php

    // Product Edit Link

    echo $this->edit_link;

    // Product Edit Link END

    ?>



    <?php

    // PDF - Print - Email Icon

    if (VmConfig::get('show_emailfriend') || VmConfig::get('show_printicon') || VmConfig::get('pdf_button_enable')) {

	?>

        <div class="icons">

	    <?php

	    //$link = (JVM_VERSION===1) ? 'index2.php' : 'index.php';

	    $link = 'index.php?tmpl=component&option=com_virtuemart&view=productdetails&virtuemart_product_id=' . $this->product->virtuemart_product_id;

	    $MailLink = 'index.php?option=com_virtuemart&view=productdetails&task=recommend&virtuemart_product_id=' . $this->product->virtuemart_product_id . '&virtuemart_category_id=' . $this->product->virtuemart_category_id . '&tmpl=component';



	    if (VmConfig::get('pdf_icon', 1) == '1') {

		echo $this->linkIcon($link . '&format=pdf', 'COM_VIRTUEMART_PDF', 'pdf_button', 'pdf_button_enable', false);

	    }

	    echo $this->linkIcon($link . '&print=1', 'COM_VIRTUEMART_PRINT', 'printButton', 'show_printicon');

	    echo $this->linkIcon($MailLink, 'COM_VIRTUEMART_EMAIL', 'emailButton', 'show_emailfriend');

	    ?>

    	<div class="clear"></div>

        </div>

    <?php } // PDF - Print - Email Icon END

 





    if (!empty($this->product->customfieldsSorted['ontop'])) {

	$this->position = 'ontop';

	echo $this->loadTemplate('customfields');

    } // Product Custom ontop end

    ?>



   

	<div class="prdImages">

		<?php
		
		echo $this->loadTemplate('images');
		
		?>
		
		<div class="prdBotNote">

	    	<?php echo JText::_( 'BOTNOTE' );?>
	
	    </div>
	</div>



	



	<?php

	// Product Description

	if (!empty($this->product->product_desc)) {

	    ?>

        <div class="prdDesc_wrapper">

	<?php /** @todo Test if content plugins modify the product description */ ?>

    	

	<?php echo $this->product->product_desc;
		//echo nl2br($this->product->product_desc);
	?>

        </div>

	<?php

    } // Product Description END



    ?>
	
	<div class="vst_contact_form" style="background:#fff;width: 27%;float: left;margin-top: -20px;">
	   <?php  
		$zone = "vst_contact_form";
		$modules = &JModuleHelper::getModules($zone);
		foreach ($modules as $module)
			{
				echo JModuleHelper::renderModule($module);
			}
		?>
	</div>

<?php
		$db=&JFactory::getDBO();
		//$product_id=$_GET['virtuemart_product_id'];
		$product_id=JRequest::getVar('virtuemart_product_id');
		$sql="SELECT a.product_sku,b.product_name FROM #__virtuemart_products as a,#__virtuemart_products_en_gb as b WHERE a.virtuemart_product_id=b.virtuemart_product_id  and a.virtuemart_product_id=".$product_id;
		$db->setQuery($sql);
		$result=$db->loadObject();
	?>
	<?php if($result){ ?>
		<input type="hidden" value="<?php echo $result->product_sku; ?>" name="vst_sku" id="vst_sku" />
		<input type="hidden" value="<?php echo $result->product_name; ?>" name="vst_name" id="vst_name" />
		<script>
			jQuery(document).ready(function(){
				var curentUrl = window.location.href;
				var finalUrl = curentUrl.split("?")[0];
				jQuery("#vst_product_sku").val(jQuery("#vst_sku").val());
				jQuery("#vst_product_name").val(jQuery("#vst_name").val());
				jQuery("#vst_product_link").val(finalUrl);
			});
		</script>
		<style>
		.vst_form_fields{margin-right:20px;}
		.vst_form_fields #Send{background:#ededed !important;}
		</style>
	<?php } ?>

</div></div></div></div>

<div id="ttn-fp"><div id="ttn-fp-inner1"><div id="ttn-fp-inner2"><div id="ttn-fp-inner3">

	<h3>SPECIAL OFFERS</h3>

<?php

    jimport('joomla.application.module.helper');

   $module = JModuleHelper::getModule('mod_virtuemart_product','Special Offers Single');

   echo JModuleHelper::renderModule($module);

?>

	</div></div></div></div>
<div id="ttn-fp" class="recent-product"><div id="ttn-fp-inner1"><div id="ttn-fp-inner2"><div id="ttn-fp-inner3">

	<h3>Recently Viewed Products</h3>

	<?php
	
	    jimport('joomla.application.module.helper');
	
	   $module = JModuleHelper::getModule('mod_virtuemart_product','Recently Viewed Products');
	
	   echo JModuleHelper::renderModule($module);
	
	?>
</div></div></div></div>

<div id="ttn-sub-button">
	<div class="ttn-promotions">
		<h3 style=" font-size: 40px; text-transform: uppercase; color: #3F3F3F; text-align: center; line-height: 50px; font-family: Roboto; font-weight: 900;">INSPIRED <span style="color:#EC1C24;">PROMOTIONS </span></h3>
		{module Promotions}
	</div>
	<div class="line"></div>
	<div class="ttn-our-clients">
		<h3 style="font-size: 40px; text-transform: uppercase; color: #3F3F3F; text-align: center; line-height: 50px; font-family: Roboto; font-weight: 900;">OUR <span style="color:#EC1C24;">CLIENTS</span></h3>
		{module Our clients}
	</div>  
</div>