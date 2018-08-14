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
class VmimportControllerPrice extends JControllerForm
{

    function __construct() {
        //$this->view_list = 'imports';
        parent::__construct();
    }

    public function update()
    {
        // Check for request forgeries
        JSession::checkToken('request') or jexit(JText::_('JINVALID_TOKEN'));
        $params = JComponentHelper::getParams('com_vmimport');
       
        $model = $this->getModel('price');
        $model->update();
        
        $msg = "Update prices successfully" ;
        $this->setRedirect( 'index.php?option=com_vmimport'  , $msg);
       // echo 'upload validated'; die();
    }
}