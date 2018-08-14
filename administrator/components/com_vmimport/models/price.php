<?php
/**
 * @version     1.0.0
 * @package     com_vmimport
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Vien <viennguyenvan84@gmail.com> - http://joomdevelopers.com
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');
require_once JPATH_COMPONENT.'/helpers/vmimport.php';

/**
 * Vmimport model.
 */
class VmimportModelPrice extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_VMIMPORT';
        public $virtuemart_product_id ;

        function update() {
            $db = JFactory::getDbo();
            //$productTable = $this->getTable('products');
            //$productPriceTable = $this->getTable('Product_prices');
            
            $q = "SELECT p.virtuemart_product_id, pl.product_name From #__virtuemart_products As p "
                 ." JOIN #__virtuemart_products_en_gb AS pl ON pl.virtuemart_product_id = p.virtuemart_product_id "
                 ." WHERE p.published=1 ";
            $db->setQuery($q);
            $rows = $db->loadObjectList();
           // var_dump($rows); die();
            $productPrices = array();
            foreach($rows as $row) {
                $product_price = VmimportHelper::parsePrice($row->product_name); 
                if(!empty($product_price) ) {
                    $productPrices[$row->virtuemart_product_id] = $product_price;
                }
            }            
            //var_dump($productPrices);
            
            $q = "SELECT virtuemart_product_price_id, virtuemart_product_id, product_price From #__virtuemart_product_prices ";
            $db->setQuery($q);
            $priceRows = $db->loadObjectList();
            //var_dump($priceRows); die();
            $queryBatch = VmimportHelper::buildQuery($priceRows,$productPrices); 
            //echo $queryBatch;
            //die();
            $db->setQuery($queryBatch);
            if(!$db->query()) {
                echo $db->getErrorMsg();
            }
            
            return true;
        }
	/**
	 * Method to get the record form.
	 *
	 * @param	array	$data		An optional array of data for the form to interogate.
	 * @param	boolean	$loadData	True if the form is to load its own data (default case), false if not.
	 * @return	JForm	A JForm object on success, false on failure
	 * @since	1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app	= JFactory::getApplication();

		// Get the form.
		$form = $this->loadForm('com_vmimport.price', 'price', array('control' => 'jform', 'load_data' => $loadData));
        
        
		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 * @since	1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_vmimport.edit.price.data', array());

		if (empty($data)) {
			//$data = $this->getItem();
            
		}

		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param	integer	The id of the primary key.
	 *
	 * @return	mixed	Object on success, false on failure.
	 * @since	1.6
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk)) {

			//Do any procesing on fields here if needed

		}

		return $item;
	}

	

}