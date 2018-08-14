<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_latest
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$list = modSlidertronHelper::getList($params);
//var_dump($list);

$doc = JFactory::getDocument();
$doc->addStyleSheet(JURI::base().'/modules/mod_slidertron/css/slider.css');
//$doc->addScript(JURI::base().'/modules/mod_slidertron/js/jquery.slidertron-1.0.js');
//slidesSelector: '.viewer .reel .slide',
$js ="$('#slider').slidertron({
					viewerSelector: '.viewer',
					reelSelector: '.viewer .reel',					
					advanceDelay: 5000,
					speed: 'slow',
					navPreviousSelector: '.previous-button',
					navNextSelector: '.next-button',
					indicatorSelector: '.indicator ul li',
					slideLinkSelector: '.link'
				});				
    " ;
//$doc->addScriptDeclaration($js);

//var_dump($list);
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_slidertron', $params->get('layout', 'default'));
