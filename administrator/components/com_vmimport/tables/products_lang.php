<?php
/**
 * Virtuemart product table
 *
 * @author 		Roland Dalmulder
 * @link 		http://www.csvimproved.com
 * @copyright 	Copyright (C) 2006 - 2013 RolandD Cyber Produksi. All rights reserved.
 * @license 	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * @version 	$Id: products_lang.php 2319 2013-02-08 07:30:17Z RolandD $
 */

// No direct access
defined('_JEXEC') or die;

class TableProducts_lang extends JTable {

	/**
	 * Table constructor
	 *
	 * @copyright
	 * @author 		RolandD
	 * @todo
	 * @see
	 * @access 		public
	 * @param
	 * @return
	 * @since 		4.0
	 */
	public function __construct($db) {            
            parent::__construct('#__virtuemart_products_en_gb', 'virtuemart_product_id', $db);		
	}

	
	/**
	 * Validate a slug
	 *
	 * @copyright
	 * @author 		RolandD
	 * @todo
	 * @see
	 * @access 		public
	 * @param
	 * @return
	 * @since 		4.0
	 */
	public function createSlug($name) {
		
		// Transliterate
		$lang = JFactory::getLanguage();
		$str = $lang->transliterate($name);

		// Trim white spaces at beginning and end of alias and make lowercase
		$str = trim(JString::strtolower($str));

		// Remove any duplicate whitespace, and ensure all characters are alphanumeric
		$str = preg_replace('/(\s|[^A-Za-z0-9\-])+/', '-', $str);

		// Trim dashes at beginning and end of alias
		$str = trim($str, '-');

		// If we are left with an empty string, make a date with random number
		if (trim(str_replace('-', '', $str)) == '') {
			$jdate = JFactory::getDate();
			$str = $jdate->format("Y-m-d-h-i-s").mt_rand();
		}
                
                // Check if the slug exists
		$db = JFactory::getDbo();
		$query = $db->getQuery(true)
			->select('COUNT('.$db->qn($this->_tbl_key).')')
			->from($this->_tbl)
			->where($db->qn('slug').' = '.$db->q($str));
			//->where($db->qn($this->_tbl_key).' != '.$db->q($this->virtuemart_product_id));
		$db->setQuery($query);
		$slugs = $db->loadResult();
		
		if ($slugs > 0) {
			$jdate = JFactory::getDate();
			$str .= $jdate->format("Y-m-d-h-i-s").mt_rand();
		}
                
		return $str;
	
	}

	/**
	 * Reset the table fields, need to do it ourselves as the fields default is not NULL
	 *
	 * @copyright
	 * @author 		RolandD
	 * @todo
	 * @see
	 * @access 		public
	 * @param
	 * @return
	 * @since 		4.0
	 */
	public function reset() {
		// Get the default values for the class from the table.
		foreach ($this->getFields() as $k => $v) {
			// If the property is not private, reset it.
			if (strpos($k, '_') !== 0) {
				$this->$k = NULL;
			}
		}
	}

}