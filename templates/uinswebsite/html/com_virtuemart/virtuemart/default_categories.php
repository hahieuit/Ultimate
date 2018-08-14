<?php

// Access

defined('_JEXEC') or die('Restricted access');



// Category and Columns Counter

$iCol = 1;

$iCategory = 1;



// Calculating Categories Per Row

$categories_per_row = VmConfig::get('categories_per_row', 3);

$category_cellwidth = ' width' . floor(100 / $categories_per_row);



// Separator

$verticalseparator = " vertical-separator";

?>

<div class="ttn-newmenu">
	<h3>Products</h3>
	{module Products}
</div>	

<div class="category-view" id="ttn-list-cat">

<div id="product_list_inner1"><div id="product_list_inner2"><div id="product_list_inner3">

    <h1 id="ttn-categories"><?php echo JText::_('Products') ?></h1>



    <?php

    // Start the Output

    foreach ($this->categories as $category) {







	// this is an indicator wether a row needs to be opened or not

	if ($iCol == 1) {

	    ?>

	    <div class="row">

	    <?php

	    }



	    // Show the vertical seperator

	    if ($iCategory == $categories_per_row or $iCategory % $categories_per_row == 0) {

		$show_vertical_separator = ' ';

	    } else {

		$show_vertical_separator = $verticalseparator;

	    }



	    // Category Link

	    $caturl = JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id=' . $category->virtuemart_category_id);



	    // Show Category

	    ?>

    	<div class="category floatleft<?php echo $category_cellwidth . $show_vertical_separator ?> browseProductImageContainer">

    	    <div class="spacer">

    		

    		    <a href="<?php echo $caturl ?>" title='<?php echo $category->category_name ?>::<img src="<?php echo JURI::root().$category->images[0]->file_url;?>"/>' class="hasTip">

    	    <?php

	    if (!empty($category->images)) {

		echo $category->images[0]->displayMediaThumb("", false);

	    }

	    ?>

	    

    			

    		    </a>

    		

    	    </div>

    	    		<h3 class="browseProductTitle" style="text-align:center">

    	    	<a href="<?php echo $caturl ?>" title="<?php echo $category->category_name ?>">

                

        <?php if ($category->virtuemart_category_id <> "52"){



					echo implode('(', array_map('ucfirst', explode('(', ucwords(strtolower($category->category_name)))));

					}

					else

					{

						echo $category->category_name;

						

						}

		?>

			</a>

        	</h3>

    	</div>

	<?php

	$iCategory++;



	// Do we need to close the current row now?

	if ($iCol == $categories_per_row) {

	    ?>

		<div class="clear"></div>

	    </div>

	<?php

	$iCol = 1;

    } else {

	$iCol++;

    }

}

// Do we need a final closing row tag?

if ($iCol != 1) {

    ?>

        <div class="clear"></div>

    </div>

    <?php

}

?>

</div></div></div></div>

	<div id="ttn-fp"><div id="ttn-fp-inner1"><div id="ttn-fp-inner2"><div id="ttn-fp-inner3">

	<h3>SPECIAL OFFERS</h3>

<?php

    jimport('joomla.application.module.helper');

   $module = JModuleHelper::getModule('mod_virtuemart_product','Special Offers Single');

   echo JModuleHelper::renderModule($module);

?>

	</div></div></div></div>
<div id="ttn-fp"><div id="ttn-fp-inner1"><div id="ttn-fp-inner2"><div id="ttn-fp-inner3">

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