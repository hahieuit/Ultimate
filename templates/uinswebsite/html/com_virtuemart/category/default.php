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
	if(!empty($this->keyword)) {   
		$baseUrl =  'http://www.ultimateinspiration.com.au/index.php?keyword='.$this->keyword.'&limitstart=0&option=com_virtuemart&view=category'.'&';
	}else {
		$baseUrl =  JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$catID.'&Itemid='. $Itemid) . '?';
	} ?>
		<script>    function changeOrder() {        var sortBy = jQuery("#sortBy").val();               var baseUrl = '<?php echo $baseUrl;?>';  if(sortBy==1) {            window.location.href= baseUrl + 'ob=product_price&orderby=product_price&dir=ASC';        }else if(sortBy==2) {            window.location.href= baseUrl + 'ob=product_price&orderby=product_price&dir=DESC';        }else {            window.location.href= baseUrl + 'ob=product_name&orderby=product_name&dir=ASC';        }    }</script>    

<div class="ttn-newmenu">
	<h3>Products</h3>
	{module Products}
</div>			
<div style="width:100%; float:none;" id="product_list">

<div id="product_list_inner1"><div id="product_list_inner2"><div id="product_list_inner3">
<!--     //viennv: #1186587026  -->    
	<?php if (!empty($this->products)) { ?>       
		<div class="sortBy" style="float:right">            Sort: 
			<?php echo $sortHtml; ?>       
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

					echo implode('(', array_map('ucfirst', explode('(', ucwords(strtolower($this->category->category_name))))); 
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
<div class="loadnew" id="ajaxloading">
	<div id="extraloading" style="width: 100%; display: inline-block;"></div>
</div>
</div><!-- end browse-view -->

</div></div></div></div>

<!-- /div removed valerie -->
<?php if($this->vmPagination->getPagesLinks()){ ?>
<div class="loadingmore" id="loadingmores" style="text-align: center; cursor: pointer;">Load more...</div>
<?php } ?>
<div align="right" style="padding-right:20px;">

	<div class="vm-pagination">
		<?php 
			$checkwhatob = vRequest::getVar ('ob', 'product_name');
			$checkwhatdir = vRequest::getVar ('dir', 'ASC');
			if($checkwhatob == "product_name"){
				echo str_replace("option=com_virtuemart","option=com_virtuemart&ob=".$checkwhatob,$this->vmPagination->getPagesLinks()); 
			}else{
				echo str_replace("option=com_virtuemart","option=com_virtuemart&ob=".$checkwhatob."&dir=".$checkwhatdir,$this->vmPagination->getPagesLinks()); 
			}
		?>
	</div>
	<br/><br/>

	<div class="display-number">Display # <?php echo $this->vmPagination->getLimitBox(); ?></div>

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

	<input type="hidden" id="cat" value="<?php echo JRequest::getInt('virtuemart_category_id',147); ?>">
	<input type="hidden" id="ob" value="<?php echo JRequest::getVar('ob', 'product_name').'_'.JRequest::getVar('dir', 'asc'); ?>">
	<input type="hidden" id="limitstart" value="<?php if(JRequest::getInt('limitstart') != 0 ){ echo JRequest::getInt('limitstart'); }else { echo '30'; } ?>">
	
<script type="text/javascript">	
 	jQuery(document).ready(function() { 
		jQuery("body").on("click", "#loadingmores", function(event){
			  var cat= jQuery("#cat").val();
			  var obs= jQuery("#ob").val();
			  var lmitstart= jQuery("#limitstart").val();
			  var data = 'cat='+cat+'&ob='+obs+'&limitstart='+lmitstart;
			  var newval = parseInt(lmitstart)+18;
			jQuery.ajax({
				type: "POST",
				url: "loadingajax.php",
				data: data,
				beforeSend: function () {
					jQuery("#extraloading").html('<p style="text-align: center; line-height: 18px; margin-bottom: 25px; margin-top: 25px;"><img src="http://www.ultimateinspiration.com.au/loading.gif" style="vertical-align: middle;" /> Loading...</p>');
				},				
				success: function(data){
					if(!data || data == '' || data == ' '){
						jQuery('#loadingmores').addClass("disableloads");
					}
					jQuery("#limitstart").attr("value",newval);
					jQuery('#extraloading').show("slow");
					jQuery('#extraloading').html(data);		
					jQuery('#extraloading').attr("id","row");
					jQuery( "#ajaxloading" ).append( '<div id="extraloading" style="width: 100%; display: inline-block;"></div>' );


					 jQuery('.hasTip').each(function(el) {
						 var title = el.get('title');
						 if (title) {
						 var parts = title.split('::', 2);
						 el.store('tip:title', parts[0]);
						 el.store('tip:text', parts[1]);
						 }
					 });

				}
			});
		  });

		jQuery(document).on('mousemove', '#ajaxloading .browseProductImageContainer', function(e) {
		    var whichid = '#proid'+jQuery(this).data('pid');
			var whichbox = '#product'+jQuery(this).data('pid');

			var p = jQuery(whichbox);
			var offset = p.offset();
			var heightContain = jQuery(whichid).height();
			console.log(heightContain);

        	//var left = e.pageX - jQuery(this).offset().left + 100;
			var left = e.pageX - jQuery('#ajaxloading').offset().left + 45;
        	//var top  = e.pageY - jQuery('#ajaxloading').offset().top;
        	//var left = offset.left;
			//alert(e.pageX ); alert(jQuery(this).offset().left);

			//var left = e.pageX - 190;
        	//var top  = offset.top - 230; // good
			var top  = e.pageY-heightContain+jQuery(this).height();
			//alert(offset.top);
			//alert(e.screenY);
			//alert(jQuery(window).height());
			//alert(p.height());
			if(jQuery(window).height() - e.screenY < heightContain){
				top  = top-heightContain+jQuery(this).height();
			}

			jQuery("#ttn-right").css('z-index', 0);

			jQuery(whichid).css({top: top,left: left}).show();

		});

		jQuery(document).on('mouseout', '#ajaxloading .browseProductImageContainer', function(e) {
		    var whichid = '#proid'+jQuery(this).data('pid');
	        jQuery(whichid).hide();
			jQuery("#ttn-right").css('z-index', 1);
	    });

	});
</script>	