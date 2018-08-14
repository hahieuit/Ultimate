<?php // no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// This function outputs each menu item:

/**
 * Outputs one level of categories and calls itself for any subcategories
 *
 * @access	public
 * @param int $catPId (the category_id of current parent category)
 * @param int $level (the current category level [main cats are 0, 1st subcats are 1])
 * @param object $params (the params object containing all params for this module)
 * @param int $currentCat (category_id from the request array, if it exists)
 * @return nothing - echos html directly
 **/
// Because this function is declared in the view, need to make sure it hasn't already been declared:
if (!function_exists('vmFCLBuildMenu')) {
	function vmFCLBuildMenu($catPId = 0, $level = 0, $params, $currentCat = null) {
		// prepare params:
		$levelStart = (int) $params->get('level_start');
		$levelEnd = (int) $params->get('level_end');
		$menuClass = $params->get('menuclass_sfx');
		$html	= '';
	
		// Check for category_id (to figure out current category, if applicable):
		if ($currentCat === null)  $currentCat = JRequest::getInt('category_id', -1);
		
		if ( (!$levelEnd || $level < $levelEnd) && $rows = modVMFullCategoryList::vmFCLGetCatSiblings($catPId, $params) ) {
			if ($level >= $levelStart) :
				$html .= '<ul class="level'.$level . $menuClass.'">';
			endif;
			foreach( $rows as $row ) {
				// Check for sub categories
				$sub	= vmFCLBuildMenu($row->category_id, $level + 1, $params, $currentCat);
				if ($level >= $levelStart) :
					$itemid = modVMFullCategoryList::vmFCLGetVMItemId($row->category_id);
					$itemid = ($itemid ? '&Itemid='.$itemid : '');
					$link =	JFilterOutput::ampReplace(JRoute::_('index.php?option=com_virtuemart'
							.'&page=shop.browse&category_id='.$row->category_id . $itemid ));							
					$html .= '<li'.($currentCat == $row->category_id ? ' id="current"' : '').'>';
					$html .= '<a class="level'.$level . $menuClass . ($currentCat == $row->category_id ? ' active' : '').( empty( $sub)?'':' parent').'" href="'.$link.'" target="_self">';
					$html .= htmlspecialchars($row->category_name, ENT_COMPAT, 'UTF-8').'</a>';
					$html .= $sub;
				endif;
				if ($level >= $levelStart) :
					$html .= '</li>';
				endif;
			} // end foreach
			if ($level >= $levelStart) :
				$html .= '</ul>';
			endif;
		}
		return $html;
	}
}
// Call the function for the first menu item:
echo vmFCLBuildMenu(0, 0, $params);

// Are there any better ways to make this follow joomla's MVC pattern
// (by outputting a tree structure returned by helper class, for ex)? like:
// while ($item) {
	// output
	// $item = $item->child;
//}
// Probably way out of the scope of this module...
// see mod_mainmenu if you don't believe it
?>
