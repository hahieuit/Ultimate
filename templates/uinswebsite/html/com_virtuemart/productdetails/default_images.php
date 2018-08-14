<?php

/**

 *

 * Show the product details page

 *

 * @package	VirtueMart

 * @subpackage

 * @author Max Milbers, Valerie Isaksen



 * @link http://www.virtuemart.net

 * @copyright Copyright (c) 2004 - 2010 VirtueMart Team. All rights reserved.

 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php

 * VirtueMart is free software. This version may have been modified pursuant

 * to the GNU General Public License, and as distributed it includes or

 * is derivative of works licensed under the GNU General Public License or

 * other free or open source software licenses.

 * @version $Id: default_images.php 6188 2012-06-29 09:38:30Z Milbo $

 */

// Check to ensure this file is included in Joomla!

defined('_JEXEC') or die('Restricted access');



// Product Main Image

?>



<?php

if (!empty($this->product->images[0])) {

    ?>

   	<div class="mainImage" id="mainImage">

	<?php 

		

		$image = $this->product->images[0]->displayMediaFull("id='shortImage' alt='".$this->product->product_name."' ",false,'',false) ;

		

		echo JHTML::_('link', JURI::root().$this->product->images[0]->file_url,$image,array('title' => $this->product->product_name,'rel'=>'lightbox-images','id'=>'linkImage') );

	//	echo $this->product->images[0]->displayMediaFull('class="medium-image" id="medium-image"', true, "rel='lightbox-images' ", false); ?>

    </div>

<?php } // Product Main Image END ?>



<?php

// Showing The Additional Images

// if(!empty($this->product->images) && count($this->product->images)>1) {

if ((!empty($this->product->images) and count ($this->product->images)>1) || !empty($this->product->images[0])) {

    ?>

    <h2> More images (click to enlarge)</h2>

    <div id="altviews">

			<div class="alter_img">

	<?php

	// List all Images

	if (count($this->product->images) > 0) {
	    $d=1;	
	    foreach ($this->product->images as $k=>$image) {

	   	$fileurl=$image->file_url;


	    $image = $image->displayMediaThumb('class="product-image"', false, "", true, false) ;

		

		echo '<div class="floatleft">' .JHTML::_('link', JURI::root().$fileurl,$image,array('title' => $this->product->product_name,'rel'=>'lightbox-images', 'onmouseover'=>'changeView(\''.JURI::root().$fileurl.'\');') ). '</div>';
		if($d==4){echo '<div class="clear"></div>';$d=1;}else{
		   $d++;
		}
		
				
	//	echo '<div class="floatleft">' . $image->displayMediaThumb('class="product-image"', true, "rel='lightbox-images'", true, false) . '</div>'; //'class="modal"'

	    }

	}

	?>

        <div class="clear"></div>

        </div>

    </div>
<script>
	function changeView(image)
	{
 		var handle = document.getElementById('shortImage');
		var handle2= document.getElementById('linkImage');
 		handle.src = image;
		handle2.href= image;
	}
</script>
<?php

} // Showing The Additional Images END ?>
