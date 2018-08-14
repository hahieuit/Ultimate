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
defined('DS') or define('DS', '\\');
defined('VMPATH_ROOT') or define('VMPATH_ROOT', JPATH_ROOT);
defined('VMPATH_ADMIN') or define('VMPATH_ADMIN', VMPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart');
require(VMPATH_ADMIN.DS.'helpers'.DS.'img2thumb.php');
require(JPATH_ROOT.DS.'administrator'.DS.'components'.DS.'com_virtuemart'.DS.'helpers'.DS.'config.php');
jimport('joomla.application.component.modeladmin');

/**
 * Vmimport model.
 */
class VmimportModelImport extends JModelAdmin
{
	/**
	 * @var		string	The prefix to use with controller messages.
	 * @since	1.6
	 */
	protected $text_prefix = 'COM_VMIMPORT';
        public $virtuemart_product_id ;

        function _productQuery($productData) {
            
            $productTable = $this->getTable('products');
            $user = JFactory::getUser();
            $date = JFactory::getDate();
            $db = JFactory::getDbo();
            
            if((int)$productData->virtuemart_product_id >0 ) {
                $productTable->load($productData->virtuemart_product_id);
            }
                
            $productData->modified_on = $date->toSQL();
            $productData->modified_by = $user->id;
                
             // Add a creating date if there is no product_id
			if (empty($productData->virtuemart_product_id)) {
				$productData->created_on = $date->toSQL();
				$productData->created_by = $user->id;
				$productData->published = 1;
			}
                
			if (empty($productData->product_sku)) {
				$productData->product_sku = $productData->product_name;			
			}
                
            $productTable->bind($productData);
               
            // We have a succesful save, get the product_id
			if ($productTable->store()) {
						$this->virtuemart_product_id = $productTable->virtuemart_product_id;
						// Store the debug message
						//$csvilog->addDebug(JText::_('COM_CSVI_PRODUCT_QUERY'), true);
			}else{
				//$csvilog->AddStats('incorrect', JText::sprintf('COM_CSVI_PRODUCT_NOT_ADDED', $this->_products->getError()));
				// Store the debug message
				//$csvilog->addDebug(JText::_('COM_CSVI_PRODUCT_QUERY'), true);
				return false;
			}
                
			// Save product language data	
			$productLangTable = $this->getTable('products_lang');
			$productLangData = new stdClass();
			$productLangData->virtuemart_product_id = $productTable->virtuemart_product_id;
			$productLangData->product_name = $productData->product_name;
			$productLangData->product_desc = $productData->product_desc;
			$productLangData->slug = $productLangTable->createSlug($productData->product_alias);
			//var_dump($productLangData); die();
			
			// Store the language fields
			if($productLangTable->load($productLangData->virtuemart_product_id) ) {
				$productLangTable->bind($productLangData);
				if ($productLangTable->store()) {
					//log
				}else {
					//log
					return false;
				}
			}else {
				$productLangTable->bind($productLangData);                    
				if($db->insertObject('#__virtuemart_products_en_gb', $productLangTable)) {
					//log                        
				}else {
					//log
					echo $db->getErrorMsg; die();
					return false;
				}
			}
             					  
			// Store the debug message
			//$csvilog->addDebug('COM_CSVI_PRODUCT_LANG_QUERY', true);

			// All good
			return true;
        }

        //viennv: #1186587026
        function _processMedia($productData) {
             
            $imageFiles = explode(',', $productData->imageFile);
            
            $virtuemart_vendor_id = 1;
            $product_images_path  = 'images/stories/virtuemart/product/';
            $db = JFactory::getDbo();
			$sqldelete = "DELETE FROM #__virtuemart_product_medias WHERE #__virtuemart_product_medias.virtuemart_product_id = ".$productData->virtuemart_product_id;
			$db->setQuery($sqldelete);
			$db->execute();
            $media = array();                 
			$ordering = 0;			
            foreach ($imageFiles as $imageFile ) {
				$imageFile = trim($imageFile);
                if(!empty($imageFile)) {
					
					$mediasTable = $this->getTable('Medias');
					$product_medias = $this->getTable('product_medias');
                    $media['virtuemart_vendor_id'] = $virtuemart_vendor_id;
                    $media['file_title'] = $productData->product_name;
                    $media['file_description'] = '';
                    $media['file_meta'] = '';
                    $media['file_mimetype'] = VmimportHelper::findMimeType($imageFile);
                    $media['file_type'] = 'product';
                    $media['file_is_product_image'] = 1;
                    $media['file_is_downloadable'] = 0;
                    $media['file_is_forSale'] = 0;
                    $media['file_url'] = $product_images_path . $imageFile;
                    //var_dump($media);
                    
                    // Bind the media data
                    $mediasTable->bind($media);

                    // Check if the media image already exists
                    $mediasTable->check();
					
                    // Store the media data
                    if ($mediasTable->store()) {
                        // Store the product image relation
                        $data = array();
                        $data['virtuemart_product_id'] = $productData->virtuemart_product_id;
                        $data['virtuemart_media_id'] = $mediasTable->virtuemart_media_id;
						$data['ordering'] = $ordering;
						$product_medias->bind($data);
						
						$sqls = "INSERT INTO `#__virtuemart_product_medias` (`virtuemart_product_id`,`virtuemart_media_id`,`ordering`) VALUES ('".$data['virtuemart_product_id']."','".$data['virtuemart_media_id']."','0') ON DUPLICATE KEY UPDATE `virtuemart_media_id`=".$data['virtuemart_media_id'];
						$db->setQuery($sqls);
						$result = $db->execute();
						
                       // $product_medias->store();
						$ordering++;
                        if (!$product_medias->check()) {
                            //do some log
                        }
						$this->createThumb($product_images_path,$imageFile);
                    }//end store media
                }
            }//end each
            return true;
        }
                
        public function _processCategories($productData) {
             
             $productCatTbl = $this->getTable('Product_categories_xref');
             $categories = explode(',', $productData->categories);
             //var_dump($categories);
             foreach ($categories as $category_id) {
                 if((int)$category_id > 0) {
                    $data = array();
                    $data['virtuemart_product_id'] = $productData->virtuemart_product_id;
                    $data['virtuemart_category_id'] = $category_id;
                    //var_dump($data);
                    $productCatTbl->bind($data);
                   
                    if(!$productCatTbl->store()) {
                        echo $productCatTbl->getError();
                        die();
                    }
                    // var_dump($productCatTbl);
                    
                 }
             }
             return true;
        }
        
        
        //updat price from title
        public function _processPrice($productData) {
				//var_dump($productData); die();
				$product_price = VmimportHelper::parsePrice($productData->product_name);
			 
				$db = JFactory::getDbo();
				$dbc = JFactory::getDbo();
			 	$checkrate = $productData->raten;
				$getnewprice1 = explode("$",$checkrate);
				$getnewprice2 = explode(" ",$getnewprice1[1]);
				$getnewprice = number_format($getnewprice2[0],6);
				//echo $productData->virtuemart_product_id; exit;
				$crdate = date("Y-m-d H:i:s");
				if($productData->virtuemart_product_id>0){
					$sqlprice = "INSERT INTO `#__virtuemart_product_prices`(`virtuemart_product_price_id`, `virtuemart_product_id`, `virtuemart_shoppergroup_id`, `product_price`, `override`, `product_override_price`, `product_tax_id`, `product_discount_id`, `product_currency`, `product_price_publish_up`, `product_price_publish_down`, `price_quantity_start`, `price_quantity_end`, `created_on`, `created_by`, `modified_on`, `modified_by`, `locked_on`, `locked_by`) VALUES 
								('', '".$productData->virtuemart_product_id."', '','".$getnewprice."','','','','','9','','','','','".$crdate."','62','','','','') ON DUPLICATE KEY UPDATE `product_price`='".$getnewprice."', `modified_on` = '".$crdate."', `modified_by` = '62'";
					$sqlprice2 = "UPDATE `#__virtuemart_product_prices` SET `product_price`=".$getnewprice.", `modified_on` = '".$crdate."', `modified_by` = '62' WHERE `virtuemart_product_id`=".$productData->virtuemart_product_id;	
					//$sqlprice = "UPDATE `#__virtuemart_product_prices` SET `product_price`=".$getnewprice." WHERE `virtuemart_product_id`=".$productData->virtuemart_product_id;
					//echo $sqlprice; exit;
					$sqlchecks = "SELECT virtuemart_product_price_id FROM #__virtuemart_product_prices WHERE virtuemart_product_id =".$productData->virtuemart_product_id;
					$dbc->setQuery($sqlchecks);
					$rowcheckss = $dbc->loadObjectList();

					if(count($rowcheckss)>0){
						$db->setQuery($sqlprice2);
					}else{
						$db->setQuery($sqlprice);
					}
					//$db->setQuery($sqlprice);
					$result = $db->execute();
				}else{
					 if(!empty($product_price)) {
						 $productPriceTbl = $this->getTable('Product_prices');
						 $data = array();
						 $data['virtuemart_product_id'] = $productData->virtuemart_product_id;
						 $data['product_price'] = floatval($product_price);
						 $data['product_currency'] = 9; //VM USD
							//var_dump($data);
						  $productPriceTbl->bind($data);                   
						  if(!$productPriceTbl->store()) {
								echo $productPriceTbl->getError();
								die();
						  }
					 }	
				}				
             return true;
        }
        
        
        public function importData($productList) {
            
            $productTable = $this->getTable('products');
            $user = JFactory::getUser();
            $date = JFactory::getDate();
            //var_dump($productTable);
            for($i=0;$i<count($productList);$i++) {
                $productData = $productList[$i];
               
                // Process product info
		if ($this->_productQuery($productData)) {
                   //echo 'insert success<br/>';
                   $productData->virtuemart_product_id = $this->virtuemart_product_id;
                   // var_dump($productData);
                  
                   // Handle the Price                    
                   $this->_processPrice($productData);
                                       
                    // Handle the images
                    if(!empty($productData->imageFile)) {
                        $this->_processMedia($productData);
                    }

                    // Check if the price is to be updated
//                    if (isset($this->product_price) || isset($this->price_with_tax))
//                        $this->_priceQuery();


                    // Process category path
                    if (!empty($productData->categories) ) {
                        $this->_processCategories($productData);                       
                    }
                
                }

            }//end for
            
        }
	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param	type	The table type to instantiate
	 * @param	string	A prefix for the table class name. Optional.
	 * @param	array	Configuration array for model. Optional.
	 * @return	JTable	A database object
	 * @since	1.6
	 */
//	public function getTable($type = 'Import', $prefix = 'VmimportTable', $config = array())
//	{
//		return JTable::getInstance($type, $prefix, $config);
//	}

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
		$form = $this->loadForm('com_vmimport.import', 'import', array('control' => 'jform', 'load_data' => $loadData));
        
        
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
		$data = JFactory::getApplication()->getUserState('com_vmimport.edit.import.data', array());

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

	/**
	 * Prepare and sanitise the table prior to saving.
	 *
	 * @since	1.6
	 */
	protected function prepareTable(&$table)
	{
		jimport('joomla.filter.output');

		if (empty($table->id)) {

			// Set ordering to the last item if not set
			if (@$table->ordering === '') {
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM import');
				$max = $db->loadResult();
				$table->ordering = $max+1;
			}

		}
	}
	
	public function createThumb($file_url_folder, $file_name, $width=0,$height=0) {
		if(empty($file_url_folder)){
			return FALSE;
		}

		if(empty($file_name)){
			return false;
		}
		$file_extension = array_pop(explode('.', $file_name));

		//now lets create the thumbnail, saving is done in this function
		$dim = self::determineWH($width, $height);
		$width = $dim['width'];
		$height = $dim['height'];
		$maxsize = false;
		$bgred = 255;
		$bggreen = 255;
		$bgblue = 255;
		
		$fullSizeFilenamePath = VMPATH_ROOT.DS.$file_url_folder.$file_name;
		$fullSizeFilenamePath = str_replace('/',DS,$fullSizeFilenamePath);
		$file_name_thumb = $this->createThumbName(str_replace('.'.$file_extension,'',$file_name),$width,$height);
		$resizedFilenamePath = VMPATH_ROOT.DS.$file_url_folder.'resized/'.$file_name_thumb.'.'.$file_extension;
		$resizedFilenamePath = str_replace('/',DS,$resizedFilenamePath);
		if (file_exists($fullSizeFilenamePath)) {
			if (!class_exists('Img2Thumb')) require(VMPATH_ADMIN.DS.'helpers'.DS.'img2thumb.php');
			$createdImage = new Img2Thumb($fullSizeFilenamePath, (int)$width, (int)$height, $resizedFilenamePath, $maxsize, $bgred, $bggreen, $bgblue);
			if($createdImage){
				return $resizedFilenamePath;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	}

	public function createThumbName($name,$width=0,$height=0){
		if(empty($name)) return false;
		$dim = self::determineWH($width, $height);
		return $name.'_'.$dim['width'].'x'.$dim['height'];
	}

	public function determineWH($width,$height){
		$dim = array();
		$dim['width'] = $width;
		$dim['height'] = $height;
		if(!$width and !$height){
			$dim['width'] = VmConfig::get('img_width',90);
			$dim['height'] = VmConfig::get('img_height',90);
		}
		$dim['width'] = (int)$dim['width'];
		$dim['height'] = (int)$dim['height'];;

		return $dim;
	}

}