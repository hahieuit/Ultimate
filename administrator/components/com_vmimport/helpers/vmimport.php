<?php
/**
 * @version     1.0.0
 * @package     com_vmimport
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Vien <viennguyenvan84@gmail.com> - http://joomdevelopers.com
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Vmimport helper.
 */
class VmimportHelper
{
        //parse price from Product Name ( From $x.xx part)
        public static function parsePrice($product_name) {
            $price = 0;
            if(strpos($product_name, '|') !== false ) {
                $price_str = trim(substr($product_name,strrpos($product_name, '|')+1 ));                
                //viennv #1186587647
                if(strpos($price_str, 'From') !== false && strpos($price_str, '$') !== false ) {
                     $price = substr($price_str,strrpos($price_str, '$')+1 );
                   
                }            
            }
            return floatval($price);
        }
        
        public static function buildQuery($priceRows,$productPrices) {
            $query = 'INSERT INTO #__virtuemart_product_prices (virtuemart_product_price_id,virtuemart_product_id, product_price, product_currency) VALUES ';
            $product_currency = 9; //USD
            $productPricesBk = $productPrices;
            //var_dump($productPricesBk);
            //var_dump($priceRows);
            $maxPriceID = 0;
            foreach ($priceRows as $priceRow) {
                if($priceRow->virtuemart_product_price_id > $maxPriceID) {
                    $maxPriceID = $priceRow->virtuemart_product_price_id;
                }
                if(isset($productPrices[$priceRow->virtuemart_product_id]) ) {
                    $queryUpdate[]  = ' ('. $priceRow->virtuemart_product_price_id . ','
                                . $priceRow->virtuemart_product_id . ','
                                . $productPrices[$priceRow->virtuemart_product_id] . ','                            
                                . $product_currency . ') ';      
                    unset($productPricesBk[$priceRow->virtuemart_product_id]);
                }
            }
             //var_dump($maxPriceID);    
            // var_dump($productPricesBk);
            if(count($productPricesBk)) {                            
                foreach ($productPricesBk as $virtuemart_product_id => $productPrice) {
                      $maxPriceID++ ;
                      $queryUpdate[]  = ' ('. $maxPriceID . ','
                                . $virtuemart_product_id . ','
                                . $productPrice . ','
                                . $product_currency. ') ';     
                }                              
            }
            //die();
            $query .= implode(',', $queryUpdate);
             
            $query .= ' ON DUPLICATE KEY UPDATE product_price= VALUES(product_price), product_currency= VALUES(product_currency) ';
            return $query;
        }
        
        public static function formatDescription($descRows,$priceTable) {
            //var_dump($descRows); die();
            $result ='<p><img src="/images/stories/pn.png" align="left" border="0"></p>';
            $result .='<p>&nbsp;</p>';
            $result .='<table width="86%" cellpadding="0" cellspacing="2" class="notesTbl">';
            $firstRow = true;
            for($i=0;$i< count($descRows); $i++) {
                if(is_array($descRows[$i]) && !empty($descRows[$i][0]) ) {
                     $result .='<tr><td width="169px" valign="top">';
                     $result .='<p><strong>'.$descRows[$i][0].'</strong></p>';
                     $result .='</td>';
                     $result .='<td width="5" valign="top">:</td><td valign="top">';
                     if($firstRow) {
                         $result .= '<span>' .$descRows[$i][1].'</span>';
                     }else {
                         $result .= $descRows[$i][1];
                     }                                                          
                     $result .='</td></tr>';
                     $firstRow = false;
                }
            }
            $result .='</table>';
            
            $result .='<p>&nbsp;</p>';
            $result .='<p><img src="/images/stories/pp1.png" align="left" border="0"></p>';
            $result .='<p>&nbsp;</p><p>&nbsp;</p>';          
            
            $result .='<table width="475" border="1" style="border-collapse:collapse;" class="priceTbl">';
            $priceTblHeader = $priceTable[0];            
            $skips = array();
            $colNum = 0;
            $result .='<tr>';
            for($i=0;$i<count($priceTblHeader); $i++) {
                if(empty($priceTblHeader[$i])) {
                    $skips[] = $i;
                }else{
                    $colNum++;
                    $result .='<td><strong>'.$priceTblHeader[$i].'</strong></td>';                   
                }
            }
            $result .='</tr>';
          
            $last = count($priceTable)-1;
            for($i=1;$i< count($priceTable); $i++) {                
                if($i==$last) {
                    $result .='<tr>';
                    $result .='<td>'.$priceTable[$last][0].'</td>';  
                    $result .='<td colspan="'.$colNum.'" style="text-align:center">'.$priceTable[$last][1].'</td>';  
                    $result .='</tr>';
                }else if(is_array($priceTable[$i]) && !empty($priceTable[$i][0]) ) {
                         $result .='<tr>';
                         for($j=0; $j<count($priceTable[$i]); $j++) {
                             if(!in_array($j,$skips)) {
                                $result .='<td>'.$priceTable[$i][$j].'</td>';  
                             }
                         }                                                                                     
                         $result .='</tr>';                    
                }
            }
            $result .='</table>';
            //echo $result; die();
            return $result;
        }
        
        public function findMimeType($filename) {
            //do a simple check
            switch (JFile::getExt($filename)) {
                case 'jpg':
                case 'jpeg':
                    return 'image/jpeg';
                    break;
                case 'png':
                    return 'image/png';
                    break;
                case 'gif':
                    return 'image/gif';
                    break;
                case 'bmp':
                    return 'image/bmp';
                    break;
                default:
                    return false;
                    break;
            }
        }
        
        public static function importData($productList) {
            $db = JFactory::getDbo();
            //require_once JPATH_ADMINISTRATOR. '/components/com_virtuemart/models/product.php';
            require_once JPATH_ADMINISTRATOR. '/components/com_vmimport/table/products.php';
            $products = $this->getTable('products');
             //	virtuemart_product_id
        }
        
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
//		JSubMenuHelper::addEntry(
//			JText::_('COM_VMIMPORT_TITLE_IMPORTS'),
//			'index.php?option=com_vmimport&view=imports',
//			$vName == 'imports'
//		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_vmimport';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}
