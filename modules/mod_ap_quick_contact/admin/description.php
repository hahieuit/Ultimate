<?php
/**
 * @package 	description.php
 * @author		Aplikko
 * @email		contact@aplikko.com
 * @website		http://aplikko.com
 * @copyright	Copyright (C) 2014 Aplikko.com. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
**/

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldDescription extends JFormField {
	protected $type = 'Description';

	/**
	* Method to get a form field markup for the field input.
	*/
	protected function getInput() {
	
	//$doc = JFactory::getDocument();
	$srcpath = JURI::root(true).'/modules/'.basename(dirname(__DIR__));

	$moduleName = str_replace('_',' ',str_replace(array('mod_'), '', basename(dirname(__DIR__))));
	$moduleName = ucwords($moduleName);
    $moduleName[1] = strtoupper($moduleName[1]);
	
	return '
	 <div class="intro">
			<h2>'.$moduleName.'<span class="pro">FREE</span><span class="version">ver. 3.2</span></h2>
			<p>'.$moduleName.' module displays a responsive, bootstrapped, quick <b>contact form</b> with data validation on the fly. For best results, we recommend to choose <b>SMTP</b> as a default mailer in Global Configuration (Global Configuration > Server Settings > Mail Settings > SMTP). It is powered by jQuery. Powerfully simple!</p>
	     <hr />
		 <div class="license">
		   <img class="img-rounded" style="width:110px;height:auto;float:left;margin:0 20px 0 10px;" src="'.$srcpath.'/admin/images/ap_quick_contact.png" alt="" />
		   <span class="title">'.$moduleName.'<span class="pro">FREE</span><small style="color:#fff;">ver. 3.2</small><br /><br /></span>
		   <div class="getmore">Get more extensions from Aplikko <a class="hasTooltip" title="Aplikko Extensions Page" href="http://www.aplikko.com/joomla-extensions" target="_blank">extensions</a> page.<br />Powerfully simple! From <a href="http://www.aplikko.com" target="_blank">Aplikko.com</a>.</div>
		  </div>  
	   </div>';	
	}
	
	
	/**
	 * Method to get a control group with label and input.
	 * @since   3.2
	 */
	public function renderField($options = array()) {
	  return $this->getInput();
 	}
	
}