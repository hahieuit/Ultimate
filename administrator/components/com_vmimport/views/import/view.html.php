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

jimport('joomla.application.component.view');

/**
 * View to edit
 */
class VmimportViewImport extends JViewLegacy
{
	protected $state;
	protected $item;
	protected $form;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
             
		//$this->state	= $this->get('State');               
		//$this->item		= $this->get('Item');
                
		$this->form		= $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
		}

		$this->addToolbar();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 */
	protected function addToolbar()
	{
		//JFactory::getApplication()->input->set('hidemainmenu', true);

		$user		= JFactory::getUser();
	
		$canDo		= VmimportHelper::getActions();

		JToolBarHelper::title(JText::_('COM_VMIMPORT_TITLE_IMPORT'), 'import.png');

		//JToolBarHelper::preview('index.php?option=com_virtuemart','Goto VirtueMart');
                JToolBarHelper::preferences('com_vmimport');

	}
}
