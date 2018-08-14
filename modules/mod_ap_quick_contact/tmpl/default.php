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



<div class="ap_quick_contact_form <?php echo $moduleclass_sfx ?>">

<?php

// check



if(isset($_POST['apsend'])) {

	$mail = JFactory::getMailer();		

	$config = JFactory::getConfig();

	$sender = array($_POST['email'],$_POST['name'] );

	$mail->setSender($sender);

	$mail->setSubject($subject);

	$mail->addRecipient($ap_my_email);

		

	$name 		= clearData($_POST["name"]);

	$email 		= clearData($_POST["email"]);

	$subject  	= clearData($_POST["subject"]);

	$message 	= clearData($_POST["message"], "string_msg");



	if (!isEmail($email)) {

		if ($ap_error_email == '' OR $ap_error_email == ' ') {

			$errMsg= JText::_(ERROREMAIL);

		} else {

			$errMsg = $ap_error_email;

			}



	}

	if ( $name=="" OR  $email=="" OR $subject=="" OR $message=="") {

		if($ap_error_field == '' OR $ap_error_field == ' ') {

			$errMsg = JText::_(ERRORFIELD);

		} else {

			$errMsg = $ap_error_field;

			}

	}



	if($errMsg == '') {

		$mail->setSubject($subject);

		

		if(get_magic_quotes_gpc()) {

			$message = stripslashes($message);

		}

		

		$msg  = "

		<p>".$ap_name_label." \r\n <strong>".$name."</strong></p>

		<p>".$ap_email_label." \r\n ".$email."</p>

		<p>".$ap_subject_label." \r\n ".$subject."</p><br/>

		<p style=\"padding:15px 0 10px;margin:0 auto;line-height:22px;display:block;clear:both;border:none;border-top:1px solid #ddd;\"><strong>".$ap_message_label."</strong> \r\n ".$message."</p>

		";

	

		$mail->setBody($msg);

		$mail->IsHTML(true);

		$send = $mail->Send();

		$emailSent = true;

?>



			<div class="span12" style="text-align:center;">

			 <div class="alert alert-success">

			  <button type="button" class="close" data-dismiss="alert">&times;</button>

				<div id="message">

					<h4><?php echo $ap_send_message == '' ? JText::_(SENDMESSAGE) : $ap_send_message; ?><span class="label label-success">&nbsp;<?php echo JText::_(MOD_AP_QUICK_CONTACT_SUCCESS); ?>&nbsp;&nbsp;<i class="fa fa-check-square-o"></i></span></h4>

				</div>

			  </div>

			</div>

		<div style="clear:both;"></div>  

     <?php

   }

}

if(!isset($_POST['apsend']) || $errMsg != '') {

?>	



    <div class="ap_quick_contact row-fluid">

		<?php 

		if ($errMsg != ''){ 

			echo '

			<div class="span12">

			 <div class="alert alert-block">

			  <button type="button" class="close" data-dismiss="alert">&times;</button>

				<div id="message">

					<h4><span class="label label-important"><i class="fa fa-info-circle"></i>&nbsp;&nbsp;'.JText::_(MOD_AP_QUICK_CONTACT_IMPORTANT).'</span>'.$errMsg.'</h4>

				</div>

			  </div>

			</div>';

		}

		?>

 <form id="ap_form_<?php echo $module->id;?>" class="form-horizontal span12" action="" method="post">

        

  <div class="control-group">

    <label class="control-label visible-desktop" for="inputEmail"><?php echo $ap_name_label;?></label>

    <div class="controls input-append">

      <span class="add-on"><i class="fa fa-user"></i></span>

      <input type="text" class="text" name="name" placeholder="<?php echo $ap_name_label;?>">

    </div>

  </div> 

            

  <div class="control-group">

    <label class="control-label visible-desktop" for="inputEmail"><?php echo $ap_email_label;?></label>

    <div class="controls input-append">

      <span class="add-on"><i class="fa fa-envelope-o"></i></span>

       <input type="text" class="text" name="email" placeholder="<?php echo $ap_email_label;?>">

    </div>

  </div> 

  

  <div class="control-group">

    <label class="control-label visible-desktop" for="inputEmail"><?php echo $ap_subject_label;?></label>

    <div class="controls input-append">

      <span class="add-on"><i class="fa fa-reorder"></i></span>

      <input type="text" class="text" name="subject" placeholder="<?php echo $ap_subject_label;?>">

    </div>

  </div> 



  <div class="area control-group">

    <label class="control-label visible-desktop" for="inputEmail"><?php echo $ap_message_label;?></label>

    <div class="controls input-append">

      <textarea class="textarea" name="message" placeholder="<?php echo $ap_message_label;?>"></textarea>

    </div>

  </div> 

  

  <div class="control-group">

    <label class="control-label empty visible-desktop">&nbsp;</label>

    <div class="controls">

        <button type="submit" class="btn submit" name="apsend" />

         <i class="fa fa-share"></i><?php echo $ap_send_label;?>

        </button>

    </div>

  </div> 



 </form>

</div>



<?php } ?>

	<div style="clear:both;"></div>

</div>

<style type="text/css">

.ap_quick_contact .text{width:<?php echo $ap_fields_width;?>px;}

.ap_quick_contact .textarea{width:<?php echo $ap_fields_width + 42;?>px}

</style>

<script type="text/javascript">

jQuery("#ap_form_<?php echo $module->id;?>").validate({rules:{name:{required:true,minlength:3},email:{required:true,email:true},subject:{required:true,minlength:3},message:{required:true}},messages:{name:{required:"<?php echo $ap_script_required; ?>",minlength:"<?php echo $ap_script_minlength; ?> 3"},email:"<?php echo $ap_script_email; ?>",subject:{required:"<?php echo $ap_script_required; ?>",minlength:"<?php echo $ap_script_minlength; ?> 3"},message:{required:"<?php echo $ap_script_required; ?>"}},success:function(e){e.html("ok").removeClass("error").addClass("ok");setTimeout(function(){e.fadeOut(350)},2e3)}})

</script>