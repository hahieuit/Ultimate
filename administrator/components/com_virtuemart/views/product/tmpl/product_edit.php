<?php
/**
*
* Description
*
* @package	VirtueMart
* @subpackage
* @author
* @link https://virtuemart.net
* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* @version $Id: product_edit.php 9499 2017-04-11 13:42:24Z Milbo $
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');
AdminUIHelper::startAdminArea($this);

$document = JFactory::getDocument();

vmJsApi::JvalideForm();
$this->editor = JFactory::getEditor();

$origLang = '';
if(!empty($this->product->_loadedWithLangFallback)){
	$origLang = '(<span class="allflags flag-'.$this->product->_loadedWithLangFallback.'"></span>)';
}

$this->origLang = '<span class="langfallback">'.$origLang.'</span>';


?>
<form method="post" name="adminForm" action="index.php" enctype="multipart/form-data" id="adminForm">

<?php // Loading Templates in Tabs
$tabarray = array();
$tabarray['information'] = 'COM_VIRTUEMART_PRODUCT_FORM_PRODUCT_INFO_LBL';
$tabarray['description'] = 'COM_VIRTUEMART_PRODUCT_FORM_DESCRIPTION';
$tabarray['status'] = 'COM_VIRTUEMART_PRODUCT_FORM_PRODUCT_STATUS_LBL';
$tabarray['dimensions'] = 'COM_VIRTUEMART_PRODUCT_FORM_PRODUCT_DIM_WEIGHT_LBL';
$tabarray['images'] = 'COM_VIRTUEMART_PRODUCT_FORM_PRODUCT_IMAGES_LBL';
if(!empty($this->product_childs)){
	$tabarray['childs'] = 'COM_VIRTUEMART_PRODUCT_CHILD_LIST';
}

$tabarray['custom'] = 'COM_VIRTUEMART_PRODUCT_FORM_PRODUCT_CUSTOM_TAB';
//$tabarray['emails'] = 'COM_VIRTUEMART_PRODUCT_FORM_EMAILS_TAB';
// $tabarray['customer'] = 'COM_VIRTUEMART_PRODUCT_FORM_CUSTOMER_TAB';


AdminUIHelper::buildTabs ( $this,  $tabarray, $this->product->virtuemart_product_id );
// Loading Templates in Tabs END ?>


<!-- Hidden Fields -->

	<?php echo $this->addStandardHiddenToForm(); ?>
<input type="hidden" name="virtuemart_product_id" value="<?php echo $this->product->virtuemart_product_id; ?>" />

</form>
<?php AdminUIHelper::endAdminArea();

vmJsApi::addJScript( '/administrator/components/com_virtuemart/assets/js/products.js', false, false );

$app = JFactory::getApplication();
$l = 'index.php?option=com_virtuemart&view=product&task=getData&format=json&virtuemart_product_id='.$this->product->virtuemart_product_id;
if($app->isAdmin()){
	$jsonLink = JURI::root(false).'administrator/'.$l;
} else {
	$jsonLink = JRoute::_($l);
}

$j = 'if (typeof Virtuemart === "undefined")
	Virtuemart = {};
	Virtuemart.nextCustom ="'.count($this->product->customfields).'";
	Virtuemart.jsonLink ="'.$jsonLink.'";
	Virtuemart.virtuemart_product_id ="'.$this->product->virtuemart_product_id.'";
	Virtuemart.urlDomain = "'.JURI::root ().'";
	Virtuemart.msgsent = "'.addslashes (vmText::_ ('COM_VIRTUEMART_PRODUCT_NOTIFY_MESSAGE_SENT')).'";
	Virtuemart.enterSubj = "'.vmText::_ ('COM_VIRTUEMART_PRODUCT_EMAIL_ENTER_SUBJECT').'";
	Virtuemart.enterBody = "'.vmText::_ ('COM_VIRTUEMART_PRODUCT_EMAIL_ENTER_BODY').'";
	Virtuemart.customfields;
	Virtuemart.prdcustomer;
	Virtuemart.edit_status;
	';
vmJsApi::addJScript('onReadyProduct',$j);


//$document->addScriptDeclaration( 'jQuery(window).load(function(){ jQuery.ajaxSetup({ cache: false }); })'); ?>
<script>
	function parsePrice () {
	    var sku = jQuery("#product_sku").val();
	    var n = sku.indexOf("|");     
		if(n>-1) {
	        sku = sku.substr(n+1) ;
			if( (sku.indexOf("From") > -1) &&  (sku.indexOf("$") > -1) ) { 
				sku = sku.substr( sku.indexOf("$")  +1) ;
                var newPrice = parseFloat(sku);
				jQuery("#costPrice").val(newPrice);
	        }   
		}
	}
</script>