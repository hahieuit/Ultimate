<?php



/*------------------------------------------------------------------------

# mod_endofslidebox module

# ------------------------------------------------------------------------

# author    WebKul

# copyright Copyright (C) 2010 webkul.com. All Rights Reserved.

# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

# Websites: http://www.webkul.com

# Technical Support:  Forum - http://www.webkul.com/index.php?Itemid=86&option=com_kunena

-------------------------------------------------------------------------*/

// no direct accessdefined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once



require_once __DIR__ . '/helper.php';


?>



<link rel="stylesheet" href="<?php echo JURI::base() ?>modules/mod_endofslidebox/css/slide.css" type="text/css"/>

<?php



$list = modSlideboxHelper::getList($params);

if (!count($list)) {
	return;
}

$count	 = trim($params->get('count'));

$limittext	= trim($params->get('limittext'));

$height	= trim($params->get('height'));

$width	= trim($params->get('width'));

$color	= trim($params->get('color'));

$matchkey		= trim($params->get('matchkey'));

$matchcategory		= trim($params->get('matchcategory'));

$catid		=	 $params->get('catid');

$moduleclasssfx	= trim($params->get('moduleclasssfx'));



$showpercent	= trim($params->get('showpercent'));

$header_text	= trim($params->get('header_text'));

$header_bgcolor	= trim($params->get('header_bgcolor'));
$enablefb	= trim($params->get('enablefb'));
$enabletweet	= trim($params->get('enabletweet'));



require(JModuleHelper::getLayoutPath('mod_endofslidebox'));



