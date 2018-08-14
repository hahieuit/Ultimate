<?php

/**

*

* Show the products in a category

*

* @package	VirtueMart

* @subpackage

* @author RolandD

* @author Max Milbers

* @todo add pagination

* @link http://www.virtuemart.net

* @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.

* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php

* VirtueMart is free software. This version may have been modified pursuant

* to the GNU General Public License, and as distributed it includes or

* is derivative of works licensed under the GNU General Public License or

* other free or open source software licenses.

* @version $Id: default.php 6053 2012-06-05 12:36:21Z Milbo $

*/



//vmdebug('$this->category',$this->category);

vmdebug('$this->category '.$this->category->category_name);

// Check to ensure this file is included in Joomla!

defined('_JEXEC') or die('Restricted access');

JHTML::_( 'behavior.modal' );

/* javascript for list Slide

  Only here for the order list

  can be changed by the template maker

*/

$js = "

jQuery(document).ready(function () {

	jQuery('.orderlistcontainer').hover(

		function() { jQuery(this).find('.orderlist').stop().show()},

		function() { jQuery(this).find('.orderlist').stop().hide()}

	)

});

";



$document = JFactory::getDocument();

$document->addScriptDeclaration($js);



/*$edit_link = '';

if(!class_exists('Permissions')) require(JPATH_VM_ADMINISTRATOR.DS.'helpers'.DS.'permissions.php');

if (Permissions::getInstance()->check("admin,storeadmin")) {

	$edit_link = '<a href="'.JURI::root().'index.php?option=com_virtuemart&tmpl=component&view=category&task=edit&virtuemart_category_id='.$this->category->virtuemart_category_id.'">

		'.JHTML::_('image', 'images/M_images/edit.png', JText::_('COM_VIRTUEMART_PRODUCT_FORM_EDIT_PRODUCT'), array('width' => 16, 'height' => 16, 'border' => 0)).'</a>';

}



echo $edit_link; */
        $orderby = JRequest::getVar('orderby','product_name');    $dir = JRequest::getVar('dir','ASC');  
		if( ($orderby=='product_price') && ($dir=='ASC') ) {        $selected = 1;    }else if(($orderby=='product_price') && ($dir=='DESC')) {        $selected = 2;    }else{        $selected = 0;    }    $sortHtml    ='<select onchange="changeOrder()" name="sortBy" id="sortBy">';    $sortHtml    .='<option value="0" ';    if($selected==0) {         $sortHtml    .= 'selected="selected" ';    }    $sortHtml    .= '>Best Match</option>';    $sortHtml    .='<option value="1" ' ;    if($selected==1) {         $sortHtml    .= 'selected="selected" ';    }    $sortHtml    .= '>Price: Lowest First</option>';    $sortHtml    .='<option value="2" ' ;    if($selected==2) {         $sortHtml    .= 'selected="selected" ';    }    $sortHtml    .='>Price: Highest First</option>';    $sortHtml    .='</select>';$catID =  JRequest::getInt('virtuemart_category_id');$Itemid =  JRequest::getInt('Itemid');

	if($this->search && !empty($this->keyword)) {   
		$baseUrl =  'http://www.ultimateinspiration.com.au/list-all-products/page-1-20.html?keyword='.$this->keyword.'&limitstart=0&option=com_virtuemart&view=category'.'&';
	}else {
		$baseUrl =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$catID.'&Itemid='. $Itemid) . '?';
	} ?>
		<script>    function changeOrder() {        var sortBy = jQuery("#sortBy").val();               var baseUrl = '<?php echo $baseUrl;?>';        if(sortBy==1) {            window.location.href= baseUrl + 'ob=product_price&orderby=product_price&dir=ASC';        }else if(sortBy==2) {            window.location.href= baseUrl + 'ob=product_price&orderby=product_price&dir=DESC';        }else {            window.location.href= baseUrl + 'ob=product_name&orderby=product_name&dir=ASC';        }    }</script>    
<div style="width:100%; float:none;" id="product_list">

<?php
			$getnewvar = JRequest::getVar('ob'); echo 'ss'.$getnewvar;
			$getnewdir = JRequest::getVar('dir');
			$session = JFactory::getSession();
			if($getnewvar !='' && $session->get( 'obvar') != $getnewvar){
				$session->set( 'obvar', $getnewvar );
			}
			if($getnewdir !='' && $session->get( 'dirvar') != $getnewdir){
				$session->set( 'dirvar', $getnewdir );
			}

			$setSession1 = $session->get('dirvar');
			$setSession2 = $session->get('obvar');
			if(empty($setSession1)) $session->set('obvar','product_name');
			if(empty($setSession2)) $session->set('dirvar','ASC');

			$checkwhatob1 = vRequest::getVar ('ob');
			if($checkwhatob1 == ''){
				$checkwhatob1 = $session->get( 'obvar');
			}
			
			$checkwhatdir1 = vRequest::getVar ('dir');
			if($checkwhatdir1 == ''){
				$checkwhatdir1 = $session->get( 'dirvar');
			}				
?>
<div id="product_list_inner1"><div id="product_list_inner2"><div id="product_list_inner3">
<!--     //viennv: #1186587026  -->    
	<?php if (!empty($this->products)) { ?>       
		<div class="sortBy" style="float:right">            Sort: 
			<?php //echo $sortHtml; ?>    
			<select id="sortBy" name="sortBy" onchange="changeOrder()">
				<option <?php if($checkwhatob1 == "product_name"){echo "selected";} ?> value="0">Best Match</option>
				<option <?php if($checkwhatob1 == "product_price" && $checkwhatdir1 == "ASC"){echo "selected";} ?> value="1">Price: Lowest First</option>
				<option <?php if($checkwhatob1 == "product_price" && $checkwhatdir1 == "DESC"){echo "selected";} ?> value="2">Price: Highest First</option>
			</select>    
		</div>    
	<?php } ?>




<!--2013-06-14 ROI H1 change-->
<?php $get_url=reset(explode("?", $_SERVER['REQUEST_URI']));
if($get_url=='/bags/non-woven-tote-bags.html'){ ?>
<h1 id="ttn-browsepage-title">Non-Woven Promotional Totes & Bags</h1>


<?php } elseif($get_url=='/bags/picnic-cooler-bags.html'){ ?>
<h1 id="ttn-browsepage-title">Promotional Cooler Bags</h1>

<?php } elseif($get_url=='/balloons.html'){ ?>
<h1 id="ttn-browsepage-title">Printed Promotional Balloons</h1>

<?php } elseif($get_url=='/clothing-apparel.html'){ ?>
<h1 id="ttn-browsepage-title">Promotional Apparel</h1>

<?php } elseif($get_url=='/clothing-apparel/jackets.html'){ ?>
<h1 id="ttn-browsepage-title">Promotional Jackets</h1>

<?php } elseif($get_url=='/clothing-apparel/polos.html'){ ?>
<h1 id="ttn-browsepage-title">Promotional Polo Shirts</h1>

<?php } elseif($get_url=='/clothing-apparel/shirts.html'){ ?>
<h1 id="ttn-browsepage-title">Promotional Shirts</h1>

<?php } elseif($get_url=='/clothing-apparel/t-shirts.html'){ ?>
<h1 id="ttn-browsepage-title">Promotional T-Shirt Printing</h1>

<?php } elseif($get_url=='/clothing-apparel/t-shirts.html'){ ?>
<h1 id="ttn-browsepage-title">Promotional T-Shirt Printing</h1>

<?php } elseif($get_url=='/confectionery-sweets.html'){ ?>
<h1 id="ttn-browsepage-title">Personalised Lollies and Candy</h1>

<?php } elseif($get_url=='/confectionery-sweets/mints.html'){ ?>
<h1 id="ttn-browsepage-title">Promotional Mints</h1>

<?php } elseif($get_url=='/special-offers-value-buys.html'){ ?>
<h1 id="ttn-browsepage-title">Discount Promotional Products</h1>

<?php } elseif($get_url=='/desk-office-stationery/page-1-20.html'){ ?>
<h1 id="ttn-browsepage-title">Buy Custom Stationary Online</h1>

<?php } elseif($get_url=='/confectionery-sweets/personalised-mms/page-1-20.html'){ ?>
<h1 id="ttn-browsepage-title">Personalised M&Ms</h1>

<?php } elseif($get_url=='/confectionery-sweets/page-1-20.html'){ ?>
<h1 id="ttn-browsepage-title">Promotional Lollies</h1>

<?php } else { ?>


<h1 id="ttn-browsepage-title"><?php 
if ($get_url <> "/it-electronic-products/page-1-20.html"){

					echo ucwords(strtolower($this->category->category_name)); 
					}
					else
					{
						echo $this->category->category_name; 
						
						}





?></h1>

<?php } ?>

<!--end-->






<div class="category_description" >

<?php echo $this->category->category_description ; ?>

</div>

<?php
/* Show child categories */



if ( VmConfig::get('showCategory',1) and empty($this->keyword)) {

	if ($this->category->haschildren) {



		// Category and Columns Counter

		$iCol = 1;

		$iCategory = 1;



		// Calculating Categories Per Row

		$categories_per_row = VmConfig::get ( 'categories_per_row', 5 );

		$category_cellwidth = ' width'.floor ( 100 / $categories_per_row);



		// Separator

		$verticalseparator = " vertical-separator";

		?>



		<div class="category-view" >



		<?php // Start the Output

		if(!empty($this->category->children)){

		foreach ( $this->category->children as $category ) {

			// this is an indicator wether a row needs to be opened or not

			if ($iCol == 1) { ?>

			<div class="row">

			<?php }



		



			// Category Link

			$caturl = JRoute::_ ( 'index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id );



				// Show Category ?>

				<div class="category floatleft<?php echo $category_cellwidth  ?>">

					<div class="browseProductImageContainer">

						<div>

							<a href="<?php echo $caturl ?>" title="<?php echo $category->category_name ?>">						

							<?php // if ($category->ids) {

								if (!empty($category->images[0]) )

								 $image = $category->images[0]->displayMediaThumb('',false) ;

								 else $image = '';

								 echo JHTML::_('link', $caturl,$image,array('title' => $category->category_name.'::<img src=\''.JURI::root().$category->images[0]->file_url.'\'/>','class'=>'hasTip') );

							//	echo $category->images[0]->displayMediaThumb("",false);

							//} ?>

							</a>

						</div>

								<h3 class="browseProductTitle" style="text-align:center">

				<a href="<?php echo $caturl ?>" title="<?php echo $category->category_name ?>">

							<?php if ($category->virtuemart_category_id <> "52"){ ?>
							<?php echo ucwords(strtolower($category->category_name)) ?></a>                            
							<?php } else { ?>
                            <?php echo $category->category_name ?></a>
                            <?php } ?>
        	</h3>

					</div>

				</div>

			<?php

			$iCategory ++;



		// Do we need to close the current row now?

		if ($iCol == $categories_per_row) { ?>

		<div class="clear"></div>

		</div>

			<?php

			$iCol = 1;

		} else {

			$iCol ++;

		}

	}

	}

	// Do we need a final closing row tag?

	if ($iCol != 1) { ?>

		<div class="clear"></div>

		</div>

	<?php } ?>

</div>



<?php }

}

?>

<div class="browse-view">

	

    <?php

if (!empty($this->keyword)) {

	?>

	<h3>Search Result : <?php echo $this->keyword; ?></h3>

	<?php

} ?>

 	



<?php // Show child categories

if (!empty($this->products)) {

?>





<?php

// Category and Columns Counter

$iBrowseCol = 1;

$iBrowseProduct = 1;



// Calculating Products Per Row

$BrowseProducts_per_row = $this->perRow;

$Browsecellwidth = ' width'.floor ( 100 / $BrowseProducts_per_row -2);



// Separator

$verticalseparator = " vertical-separator";



// Count products

$BrowseTotalProducts = 0;

foreach ( $this->products as $product ) {

   $BrowseTotalProducts ++;

}



// Start the Output

foreach ( $this->products as $product ) {



	



	// this is an indicator wether a row needs to be opened or not

	if ($iBrowseCol == 1) { ?>

	<div class="row">

	<?php }



	// Show the vertical seperator

	if ($iBrowseProduct == $BrowseProducts_per_row or $iBrowseProduct % $BrowseProducts_per_row == 0) {

		$show_vertical_separator = ' ';

	} else {

		$show_vertical_separator = $verticalseparator;

	}



		// Show Products ?>

		<div class="product floatleft<?php echo $Browsecellwidth . $show_vertical_separator ?>" style="margin-right: 5px;">

			<div class="browseProductContainer"><div class="browseProductImageContainer" style="height:80px;">

				<div style="text-align:center">

					<?php /** @todo make image popup */

							$ttn_prdName = explode('|',$product->product_name,2)	;

							if (!empty($product->images[0]) )

					 $image = $product->images[0]->displayMediaThumb('class="browseProductImage" border="0" alt="'.$product->product_name.'" ',false,'');

					 else $image = '';

					 echo JHTML::_('link', JRoute::_('index.php?option=com_virtuemart&view=productdetails&virtuemart_product_id='.$product->virtuemart_product_id.'&virtuemart_category_id='.$product->virtuemart_category_id),$image,array('title' => $product->product_name.'::<img src=\''.JURI::root().$product->images[0]->file_url.'\'/>','class'=>'hasTip') );

 

							

						?>

				</div></div>

							<?php

							if (count($ttn_prdName)==2){

						echo '<h3 class="browseProductTitle" style="text-align:center">'.JHTML::link($product->link, $ttn_prdName[0]).'</h3>';

						echo '<span class="ttn-sbname-pro">'.$ttn_prdName[1].'</span>';

					}else{

						echo '<h3 class="browseProductTitle" style="text-align:center">'.JHTML::link($product->link, $product->product_name).'</h3>';

					}

							?>

			</div><!-- end of spacer -->

		</div> <!-- end of product -->

	<?php



   // Do we need to close the current row now?

   if ($iBrowseCol == $BrowseProducts_per_row || $iBrowseProduct == $BrowseTotalProducts) {?>

   <div class="clear"></div>

   </div> <!-- end of row -->

      <?php

      $iBrowseCol = 1;

   } else {

      $iBrowseCol ++;

   }



   $iBrowseProduct ++;

} // end of foreach ( $this->products as $product )

// Do we need a final closing row tag?

if ($iBrowseCol != 1) { ?>

	<div class="clear"></div>



<?php

}

?>



<?php } elseif ($this->search !==null && !empty($this->keyword) ) echo JText::_('COM_VIRTUEMART_NO_RESULT').($this->keyword? ' : ('. $this->keyword. ')' : '')

?>

</div><!-- end browse-view -->

</div></div></div></div>

<!-- /div removed valerie -->

<div align="right" style="padding-right:20px;">

	<div class="vm-pagination">
		<?php 

			$checkwhatob = vRequest::getVar ('ob');
			if($checkwhatob == ''){
				$checkwhatob = $session->get( 'obvar');
			}
			
			$checkwhatdir = vRequest::getVar ('dir');
			if($checkwhatdir == ''){
				$checkwhatdir = $session->get( 'dirvar');
			}		

			$checkitemids = vRequest::getVar ('Itemid', '199');
			$checkcatids = vRequest::getVar ('virtuemart_category_id', '35');
/*
			if($checkwhatob == "product_name"){
				if($checkitemids == '199' && $checkcatids == '35'){
					echo str_replace("Itemid=199","Itemid=198",str_replace("option=com_virtuemart","option=com_virtuemart&ob=".$checkwhatob,$this->vmPagination->getPagesLinks())); 					
				}else{
					echo str_replace("option=com_virtuemart","option=com_virtuemart&ob=".$checkwhatob,$this->vmPagination->getPagesLinks()); 
				}
			}else{
				    echo str_replace("option=com_virtuemart","option=com_virtuemart&ob=".$checkwhatob."&dir=".$checkwhatdir,$this->vmPagination->getPagesLinks()); 
			}
*/
			if($checkitemids == '199' && ($checkcatids == '35' || $checkcatids == '14' || $checkcatids == '22' || $checkcatids == '185' || $checkcatids == '184' || $checkcatids == '46' || $checkcatids == '94' || $checkcatids == '2' || $checkcatids == '1' || $checkcatids == '15' || $checkcatids == '12' || $checkcatids == '53')){
					echo str_replace("Itemid=199","Itemid=198",str_replace("option=com_virtuemart","option=com_virtuemart&ob=".$checkwhatob."&dir=".$checkwhatdir,$this->vmPagination->getPagesLinks())); 					
				}else{
				    echo str_replace("option=com_virtuemart","option=com_virtuemart&ob=".$checkwhatob."&dir=".$checkwhatdir,$this->vmPagination->getPagesLinks());
				}
		?>
	</div>
	<br/><br/>

	<div class="display-number">Display # 
		<?php 
			$checkitemids = vRequest::getVar ('Itemid', '199');
			$checkcatids = vRequest::getVar ('virtuemart_category_id', '35');
			
			if($checkitemids == '199' && $checkcatids == '35'){
				$newpaging = $this->vmPagination->getLimitBox();
				$newpaging1 = str_replace('value="/drink-wares-accessories/promotional-travel-mugs.html?start=20">30','value="/drink-wares-accessories/promotional-travel-mugs/page-1-30.html">30',$newpaging);
				$newpaging2 = str_replace('value="/drink-wares-accessories/promotional-travel-mugs.html?start=20">40','value="/drink-wares-accessories/promotional-travel-mugs/page-1-40.html">40',$newpaging1);
				$newpaging3 = str_replace('value="/drink-wares-accessories/promotional-travel-mugs.html?start=20">50','value="/drink-wares-accessories/promotional-travel-mugs/page-1-50.html">50',$newpaging2);
				$newpaging4 = str_replace('value="/drink-wares-accessories/promotional-travel-mugs.html?start=20">100','value="/drink-wares-accessories/promotional-travel-mugs/page-1-100.html">100',$newpaging3);
				echo $newpaging4;
			}else{
				echo $this->vmPagination->getLimitBox();
			}
		?>
	</div>

	</div>

<!-- /div removed valerie -->


<?php

if ( empty($this->keyword) ) {

	?>



	<?php

}
?>


<div id="ttn-fp"><div id="ttn-fp-inner1"><div id="ttn-fp-inner2"><div id="ttn-fp-inner3">

	<h3>SPECIAL OFFERS</h3>

<?php

    jimport('joomla.application.module.helper');

   $module = JModuleHelper::getModule('mod_virtuemart_product','Special Offers Single');

   echo JModuleHelper::renderModule($module);

?>

	</div></div></div></div>