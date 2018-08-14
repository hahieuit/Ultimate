<?php
/**
 * @version     1.0.0
 * @package     com_vmimport
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Vien <viennguyenvan84@gmail.com> - http://joomdevelopers.com
 */
// no direct access
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.keepalive');
// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_vmimport/assets/css/vmimport.css');
?>
<script type="text/javascript">
 

</script>


    <div class="width fltlft">
        <form action="<?php echo JRoute::_('index.php?option=com_vmimport'); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="import-form" class="form-validate">
        <fieldset id="uploadform">
            <legend><?php echo JText::_('COM_VMIMPORT_LEGEND_IMPORT'); ?></legend>	
            <fieldset id="upload-noflash" class="actions">
                <label for="upload-file" class="hidelabeltxt">Please Upload CSV files.</label>
                <input type="file" id="upload-file" name="Filedata"  />
                <label for="upload-submit" class="hidelabeltxt"><?php echo JText::_('COM_VMIMPORT_START_UPLOAD'); ?></label>
                <input class="btn btn-small btn-success" type="submit" id="upload-submit" value="<?php echo JText::_('COM_VMIMPORT_START_UPLOAD'); ?>"/>
            </fieldset>
          <input type="hidden" name="task" value="import.upload" />
            <?php echo JHtml::_('form.token'); ?>
          </form>

        </fieldset>
    </div>
<!--
    <div class="width-40 fltlft" >
        <form action="<?php echo JRoute::_('index.php?option=com_vmimport'); ?>" method="post" enctype="multipart/form-data" name="priceForm" id="price-form" class="form-validate">
         <fieldset id="priceform">
            <legend><?php echo JText::_('COM_VMIMPORT_LEGEND_UPDATEPRICE'); ?></legend>
            <p style="text-align:center">
                <input type="submit" style="float:none" class="btn btn-large" id="update-submit" value="<?php echo JText::_('COM_VMIMPORT_BTN_UPDATE'); ?>"/>
            </p>
         </fieldset>
         <input type="hidden" name="task" value="price.update" />
         <?php echo JHtml::_('form.token'); ?>
         </form>
    </div>    
-->    
    
    <div class="clr"></div>

    <style type="text/css">
        /* Temporary fix for drifting editor fields */
        .adminformlist li {
            clear: both;
        }
    </style>