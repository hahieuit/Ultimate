<?php
/*------------------------------------------------------------------------

# mod_endofslidebox module

# ------------------------------------------------------------------------

# author    WebKul

# copyright Copyright (C) 2010 webkul.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.webkul.com

# Technical Support:  Forum - http://www.webkul.com/index.php?Itemid=86&option=com_kunena

-------------------------------------------------------------------------*/

// no direct access

// Check to ensure this file is within the rest of the framework
defined('JPATH_BASE') or die();

class JFormFieldENDSQL extends JFormFieldList
{
	/**
	 * Element name
	 *
	 * @access	protected
	 * @var		string
	 */
	public $type = 'ENDSQL';

	protected function getOptions()
	{
		$options = array();
		$key = $this->element('key_field') ? (string) $this->element('key_field') : 'value';
		$value	= $this->element['value_field'] ? (string) $this->element['value_field'] : (string) $this->element['name'];
		$query	= (string) $this->element['query'];

		// Get the database object.
		$db = JFactory::getDBO();
		
		// Set the query and get the result list.
		$db->setQuery($query);
		$items = $db->loadObjectlist();
		
			// Check for an error.
		if ($db->getErrorNum()) {
			JError::raiseWarning(500, $db->getErrorMsg());
			return $options;
		}

		if ($node->attributes('multiple')) {
			$size = $node->attributes('size') ? $node->attributes('size') : '5';
			$multiple = ' multiple="multiple" size="'.$size.'"';
			$multipleArray = "[]";
		} else {
			$multiple = '';
			$multipleArray = '';
		}
		$attributes = 'class="inputbox" ' . $multiple;


		return JHTML::_('select.genericlist',  $items, ''.$control_name.'['.$name.']'.$multipleArray, $attributes, $key, $val, $value, $control_name.$name);
	}
}