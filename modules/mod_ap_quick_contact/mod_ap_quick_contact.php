<?php 
/**
 * @package 	mod_ap_quick_contact.php - AP Quick Contact Module
 * @version		3.2
 * @author		Aplikko
 * @email		contact@aplikko.com
 * @website		http://aplikko.com
 * @copyright	Copyright (C) 2014 Aplikko.com. All rights reserved.
 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
**/
 
// no direct access
defined('_JEXEC') or die;
ini_set('display_errors',0);

$document = JFactory::getDocument();
$document->addStyleSheet('modules/mod_ap_quick_contact/assets/css/default.css', 'text/css');
$document->addStyleSheet('//netdna.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css');// font awesome url

//Params
$ap_load_validate			= (int)$params->get('ap_load_validate', 1);
$ap_load_scripts			= (int)$params->get('ap_load_scripts', 1);
$moduleclass_sfx			= $params->get('moduleclass_sfx');
$ap_my_email				= $params->get('ap_my_email');

$ap_fields_width			= $params->get('ap_fields_width', '250');
$ap_name_label				= $params->get('ap_name_label', 'Name:');
$ap_email_label				= $params->get('ap_email_label', 'e-mail:');
$ap_subject_label			= $params->get('ap_subject_label', 'Subject:');
$ap_message_label			= $params->get('ap_message_label', 'Message:');
$ap_send_label				= $params->get('ap_send_label', 'Send');
$ap_send_message			= $params->get('ap_send_message');
$ap_error_email				= $params->get('ap_error_email');
$ap_error_field				= $params->get('ap_error_field');
$ap_script_required			= $params->get('ap_script_required');
$ap_script_email			= $params->get('ap_script_email');
$ap_script_minlength		= $params->get('ap_script_minlength');


if ($ap_load_validate == 1) {			
	if ($ap_load_scripts == 0) {
		$document->addCustomTag('<script src="modules/mod_ap_quick_contact/assets/js/jquery.validate.min.js" type="text/javascript"></script>'); 
	}
	if ($ap_load_scripts == 1) { 
		echo '<script type="text/javascript" src="modules/mod_ap_quick_contact/assets/js/jquery.validate.min.js"></script>';
	}
}

$errMsg  = '';
$name    = '';
$email   = '';
$subject = ''; 
$message = '';

// clear data 
function clearData ($data, $type="string") {
	switch ($type) {
		case "string": 
					return trim(strip_tags($data));
					break;
		case "string_msg":
					return trim(htmlspecialchars($data,ENT_QUOTES));
					break;
		case "int":
					return (int)$data;
					break;
	}
}

// check email
function isEmail($email) {
	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|rs|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
}

require JModuleHelper::getLayoutPath('mod_ap_quick_contact', $params->get('layout', 'default'));
?>