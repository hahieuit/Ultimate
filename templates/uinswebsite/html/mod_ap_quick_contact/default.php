<?php 

/**

 * @package 	AP Quick Contact Module

 * @version		3.2

 * @author		Aplikko

 * @email		contact@aplikko.com

 * @website		http://aplikko.com

 * @copyright	Copyright (C) 2014 Aplikko.com. All rights reserved.

 * @license		http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL

**/

 

// no direct access

defined('_JEXEC') or die;



if ($ap_script_required == '' OR $ap_script_required == ' ') { $ap_script_required = JText::_(SCRIPT_REQUIRED); }

if ($ap_script_email == '' OR $ap_script_email == ' ') { $ap_script_email = JText::_(SCRIPT_EMAIL); }

if ($ap_script_minlength == '' OR $ap_script_minlength == ' ') { $ap_script_minlength = JText::_(SCRIPT_MINLENGTH); }

?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div class="ap_quick_contact_form <?php echo $moduleclass_sfx ?>">

<?php

// check



if(isset($_POST['apsend'])) {

	$mail = JFactory::getMailer();		

	$config = JFactory::getConfig();

	$sender = array($_POST['email'],$_POST['name'] );

	$mail->setSender($sender);

	$mail->setSubject($subject);
		

	$company  	= clearData($_POST["company"]);

	$name 		= clearData($_POST["name"]);

	$email 		= clearData($_POST["email"]);

	$subject  	= "User's mail";

	$message 	= clearData($_POST["message"], "string_msg");
	
	$listRecipient = array($ap_my_email,$email );

	$mail->addRecipient($listRecipient);

	if (!isEmail($email)) {

		if ($ap_error_email == '' OR $ap_error_email == ' ') {

			$errMsg= JText::_(ERROREMAIL);

		} else {

			$errMsg = $ap_error_email;

			}



	}

	if ( $name=="" OR  $email=="" OR $message=="") {

		if($ap_error_field == '' OR $ap_error_field == ' ') {

			$errMsg = JText::_(ERRORFIELD);

		} else {

			$errMsg = $ap_error_field;

			}

	}

	if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])):
		//your site secret key
		$secret = '6Ld-mgoTAAAAANXKAPuxmoLwux50pHsettYKbgew';
		//get verify response data
		$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
		$responseData = json_decode($verifyResponse);
		if($responseData->success):
			
		else:
			$errMsg = 'Robot verification failed, please try again.';
		endif;
	else:
		$errMsg = 'Please click on the reCAPTCHA box.';
	endif;

	



	if($errMsg == '') {

		$mail->setSubject($subject);

		

		if(get_magic_quotes_gpc()) {

			$message = stripslashes($message);

		}

		

		$msg  = "
		
		<p>Thank you for your enquiry. We will endeavour to reply to you as soon as possile. Shall you do not hear from us within 24hours, kindly contact us by 1300 653 148.</p>

		<p>Company Name: \r\n <strong>".$company."</strong></p>

		<p>".$ap_name_label." \r\n <strong>".$name."</strong></p>

		<p>".$ap_email_label." \r\n ".$email."</p>

		<p style=\"padding:15px 0 10px;margin:0 auto;line-height:22px;display:block;clear:both;border:none;border-top:1px solid #ddd;\"><strong>".$ap_message_label."</strong> \r\n ".$message."</p>

		";

	

		$mail->setBody($msg);

		$mail->IsHTML(true);

		$send = $mail->Send();

		$emailSent = true;?>
		<?php 
		echo '<script>alert("Thanks for your enquiry, we will reply to you as soon as possible.");</script>';
	}else{
		echo '<script>alert("'.$errMsg.'");</script>';
	}
}?>

	<div class="ap_quick_contact row-fluid">
		<span style="color: #fff;">The QUICKEST way to hear from us !</span>
		<form id="ap_form_<?php echo $module->id;?>" class="form-horizontal span12" action="" method="post">
			<div class="control-group">
				<div class="controls input-append">
				  <input type="text" class="input-text company" name="company" placeholder="Company Name">
				  <input type="text" class="input-text name" name="name" placeholder="Full Name">
				</div>
			</div>   

			<div class="control-group">
				<div class="controls input-append">
				   <input type="text" class="input-text" name="email" placeholder="Email">
				</div>
			</div> 

			<div class="area control-group">
				<div class="controls input-append">
				  <textarea class="textarea" name="message" placeholder="Your Message"></textarea>
				</div>
			</div> 

			<div class="part-control-group">
				<div class="controls">
					<div class="g-recaptcha" data-sitekey="6Ld-mgoTAAAAADi1r23mT7CnAtvIbxFJn4Az5xGK" style="transform:scale(0.6);-webkit-transform:scale(0.6);transform-origin:0 0;-webkit-transform-origin:0 0;"></div>	
				</div>
			</div>

			<div class="part-control-group control-group-submit">
				<div class="controls">
					<button type="submit" class="btn submit" name="apsend" />SUBMIT</button>
				</div>
			</div> 
		</form>

	</div>
	<div style="clear:both;"></div>

</div>

