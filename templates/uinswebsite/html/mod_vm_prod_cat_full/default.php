<?php // no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );



/**

 * Outputs one level of categories and calls itself for any subcategories

 *

 * @access	public

 * @param int $catPId (the category_id of current parent category)

 * @param int $level (the current category level [main cats are 0, 1st subcats are 1])

 * @param object $params (the params object containing all params for this module)

 * @param int $current_cat (category_id from the request array, if it exists)

 * @return nothing - echos html directly

 **/

// Because this function is declared in the view, need to make sure it hasn't already been declared:

if ( ! function_exists( 'vmFCLBuildMenu' ) ) {

	function vmFCLBuildMenu($catPId = 0, $level = 1, $settings, $current_cat = 0, $active = array()) {

		$html	= '';

		if ( (!$settings['level_end'] || $level < $settings['level_end']) && $rows = modVMFullCategoryList::getCatChildren($catPId) ) :

			if ( $level >= $settings['level_start'] ) : ?>

			<?php 	$html	.='<ul class="level'.($level-1) . $settings["menu_class"] .'">';?>

			<?php endif;

			foreach( $rows as $row ) :

				//$cat_active = in_array( $row->virtuemart_category_id, $active );

				//if ( $settings['current_filter'] && $level < count( $active ) && ! $cat_active )

				//	continue;

				// Check for sub categories
				//if ( $row->virtuemart_category_id <> "124" && $row->virtuemart_category_id <> "4" && $row->virtuemart_category_id <> "21" && $row->virtuemart_category_id <> "25" && $row->virtuemart_category_id <> "110" && $row->virtuemart_category_id <> "5" && $row->virtuemart_category_id <> "82" && $row->virtuemart_category_id <> "165")				//{
				$sub =vmFCLBuildMenu( $row->virtuemart_category_id, $level + 1, $settings, $current_cat, $active );
			//	}
			//	else
			//	{
			//		$sub = '';
			//		}
				if ( $level >= $settings['level_start'] ) :
					
					$itemid = modVMFullCategoryList::getVMItemId($row->virtuemart_category_id);

					//$itemid = ($itemid ? '&Itemid='.$itemid : '');
					$itemid = '&Itemid=199';
					$link =	str_replace("page-1-30","page-1-25", str_replace("page-1-50","page-1-25", str_replace("page-1-20","page-1-25",JFilterOutput::ampReplace( JRoute::_( 'index.php?option=com_virtuemart' . '&view=category&virtuemart_category_id=' . $row->virtuemart_category_id . $itemid )))));
					$html .= '<li'.($current_cat == $row->virtuemart_category_id ? ' id="current"' : '').' test="'.$row->virtuemart_category_id.'">';

					$html .= '<a class="level'.($level-1) . $settings['menu_class'] . ($current_cat == $row->virtuemart_category_id ? ' active' : '').( empty( $sub)?'':' parent').'" href="'.$link.'" target="_self" '.($level == 2 ? ' ' : '').'>';


					if ($row->virtuemart_category_id <> "52"){

					$html .= htmlspecialchars(stripslashes(ucwords(strtolower($row->category_name))), ENT_COMPAT, 'UTF-8').'</a>'; 
					
					}
					else
					{
						$html .= htmlspecialchars(stripslashes($row->category_name), ENT_COMPAT, 'UTF-8').'</a>';
						
						}
					
					
					?>
						
						<?php $html .= $sub;?>
                     

				<?php 
				
				
				endif;				

				if ($level >= $settings['level_start']) : ?>

				<?php $html .='</li>';?>

			<?php endif;
			
			

			endforeach;

			if ($level >= $settings['level_start']) : ?>

			<?php $html .='</ul>';?>

			<?php endif;

		endif;

		return $html;

	}

}



// With what category, if any, do we start?

// Default to cat filter param:

$catid = $cat_filter;

$level = 1;

// Set up current category array (for displaying '.active' class and for current category filter, if applicable)

$active = array();

if ( $current_cat ) {

	$active = modVMFullCategoryList::getCatParentIds( $current_cat );

	if ( $settings['current_filter'] ) {

		$catid = $current_cat;

		$level = count( $active );

		if ( $settings['level_start'] ) {

			// Adjust the starting point

			array_unshift( $active, 0 );

			$catid = $active[$settings['level_start']-1];

			$level = $settings['level_start'];

		}

	}

}

if ( $cat_filter && ! $settings['current_filter'] ) {

	$parents = modVMFullCategoryList::getCatParentIds( $cat_filter );

	$level = count( $parents );

}

// Call the display function for the first menu item:

echo vmFCLBuildMenu( $catid, $level, $settings, $current_cat, $active );



// Are there any better ways to make this follow joomla's MVC pattern

// (by outputting a tree structure returned by helper class, for ex)? like:

// while ($item) {

	// output

	// $item = $item->child;

//}

// Probably way out of the scope of this module...

// see mod_mainmenu if you don't believe it

?>