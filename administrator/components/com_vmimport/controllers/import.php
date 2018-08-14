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

jimport('joomla.application.component.controllerform');
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
/**
 * Import controller class.
 */
class VmimportControllerImport extends JControllerForm
{

    function __construct() {
        //$this->view_list = 'imports';
        parent::__construct();
    }

    public function upload()
    {
        // Check for request forgeries
        JSession::checkToken('request') or jexit(JText::_('JINVALID_TOKEN'));
        $params = JComponentHelper::getParams('com_vmimport');
        // Get some data from the request
        $file = JRequest::getVar('Filedata', '', 'files');
        //var_dump($file);
       
        // The request is valid
        $err = null;
        require_once JPATH_ADMINISTRATOR. '/components/com_media/helpers/media.php';
        if (!MediaHelper::canUpload($file, $err)) {
            // The file can't be upload
            JError::raiseNotice(100, JText::_($err));
            return false;
        }

        //Upload
       
        $file['filepath'] = JPath::clean(implode(DIRECTORY_SEPARATOR, array(JPATH_ROOT.'/'.$params->get('upload_path', 'tmp'), $file['name']) ));
        if (!JFile::upload($file['tmp_name'], $file['filepath'])) {
            // Error in upload
            JError::raiseWarning(100, JText::_('COM_VMIMPORT_ERROR_UNABLE_TO_UPLOAD_FILE'));
            return false;
        } 

        //Process data       
        //echo 'start process <br/>';
        $productSeparator = 'EndOfProduct';  
        $priceTableKey = 'Price Table';
        require_once JPATH_COMPONENT.'/helpers/vmimport.php';
        //$keys = array('Product ID','Product Name','VM Categories','Product Category','Image File');
        if (($handle = fopen($file['filepath'], "r")) !== FALSE) {
        
            $productList = array();
            $product = new stdClass();
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {               
                if($data[0]==$productSeparator) {
                    $product->product_desc =  VmimportHelper::formatDescription($descRows,$priceTable);                    
                    $product->product_name  = str_replace( '"' , "", $product->product_name)  ;
                    $productList[] = $product;
                    
                    //Init new Product
                    $product = new stdClass();                    
                    $descRows = array();
                    $endDescription = false;
                    $priceTable = array();
                    $startPriceTable = false;
                }else {
                    switch ($data[0]) {
                        case 'Product ID':
                            $product->virtuemart_product_id = trim($data[1]);
                            break;
                        case 'Product Name':
                            $product->product_name = trim($data[1]);
                            $product->product_alias = trim($data[1]);                            
                            break;
                        case 'Rate':
                            if(!empty($data[1])) {                                
                                $product->product_name .= "|From " . trim($data[1]);
								$product->raten = trim($data[1]);
                            }
                            break;
                         case 'VM Categories':
                            $product->categories = trim($data[1]);
                            break;
                        case 'Image File':
                            $endDescription = true;
                            $product->imageFile = trim($data[1]);
                            break; 
                        case 'Price Table':
                            $startPriceTable = true;
                            break; 
                        default:
                            if(!$endDescription) {                               
                               $descRows[] = array_slice($data, 0, 2) ;                               
                            }else if($startPriceTable) {
                                $priceTable[]= $data;
                            }
                            break;
                    }
                  
                }
                
            }
            fclose($handle);
        }
        //var_dump($productList);
        
        //Import to database
        //echo 'start importing <br/>';
        $model = $this->getModel('import');
        $model->importData($productList);
            
        $msg = "Import successfully" ;
        $this->setRedirect( 'index.php?option=com_vmimport'  , $msg);
       // echo 'upload validated'; die();
    }
}