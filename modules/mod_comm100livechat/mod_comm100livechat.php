<?php
/*------------------------------------------------------------------------
# mod_livechat - Comm100 Live Chat
# ------------------------------------------------------------------------
# author    Comm100
# copyright Copyright (C) 2012 comm100.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.comm100.com/
# Technical Support:  Forum - http://hosted.comm100.com/HelpDesk/Main/Main.aspx?siteid=10000
-------------------------------------------------------------------------*/
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' ); 

defined('_JEXEC') or die('Direct access to this location is not allowed.');
defined( '_JEXEC' ) or die( 'Restricted access' );
class Livechat
{
	var $_module_dir = NULL;

    var $_siteId = NULL;
    var $_planId = NULL;
    var $_email = NULL;

    var $_cpanel_domain = NULL;
    var $_main_chatserver_domain = NULL;
    var $_standby_chatserver_domain = NULL;

	function Livechat($module, $params)
	{
		$this->_module_dir = JPATH_BASE.'/modules/'.$module->module;

        $this->_siteId = $params->get('siteId');
        $this->_planId = $params->get('planId');	
        $this->_email = $params->get('email');

        $this->_cpanel_domain = $params->get('cpanel_domain');
        $this->_main_chatserver_domain = $params->get('main_chatserver_domain');
        $this->_standby_chatserver_domain = $params->get('standby_chatserver_domain');
    }

	function getChatButtonCode()
	{
		$path = $this->_module_dir . '/codes/chat_button_0.php';
		if (!file_exists($path)) return;
		if ($this->_siteId == '0')
			return '';

		$chat_button = file_get_contents($path);
		$chat_button = str_replace(array('{%SITEID%}', '{%PLANID%}', '{%MAINCHATSERVERDOMAIN%}', '{%STANDBYCHATSERVERDOMAIN%}'), 
                        array($this->_siteId, $this->_planId, $this->_main_chatserver_domain, $this->_standby_chatserver_domain), $chat_button);

		return $chat_button;
	}
}

$Livechat = new Livechat($module, $params);
echo $Livechat->getChatButtonCode();