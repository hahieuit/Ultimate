<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_latest
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */
// no direct access
defined('_JEXEC') or die;

?>

<div id="sliderWrapper" class="<?php echo $moduleclass_sfx; ?>">
    <div id="stage">
        <div id="slider">
            <div class="viewer">
                <div class="reel">
                    <?php foreach ($list as $slide) :  ?>
                      <?php if(is_array($slide) && count($slide)>0) : ?>
                        <div class="slide">                          
                            <ul class="myList">
                                <?php foreach ($slide as $item) : ?>
                                <li class="col<?php echo $item->column;?>">
                                    <?php if($item->link!="") { ?>
                                        <a href="<?php echo $item->link; ?>"><img src="<?php echo $item->src; ?>" style="border:none" /></a>
                                    <?php }else { ?>
                                        <img src="<?php echo $item->src; ?>" style="border:none" />
                                    <?php } ?>
                                </li>      
                                <?php endforeach; ?>
                            </ul>
                            
                        </div>
                        <?php endif;?>

                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="indicator">
                <ul>
                  <?php $i=0;
                  foreach ($list as $slide) : 
                    if(is_array($slide) && count($slide)>0) : 
                    $i++; ?>
                    <li class="<?php if($i==1) echo 'active'; ?>" ><?php echo $i;?></li>
                    <?php 
                    endif;
                  endforeach; ?>
                </ul>
            </div>
            
        </div>
    </div>
</div>

<script >
jQuery('#slider').slidertron({
					viewerSelector: '.viewer',
					reelSelector: '.viewer .reel',
					slidesSelector: '.viewer .reel .slide',
					advanceDelay: 5000,
					speed: 'slow',
					navPreviousSelector: '.previous-button',
					navNextSelector: '.next-button',
					indicatorSelector: '.indicator ul li',
					slideLinkSelector: '.link'
				});	
</script>