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
                    <?php foreach ($list as $slide) : //var_dump($slide); ?>
                        <div class="slide">
                            <ul class="myList">
                                <?php foreach ($slide as $item) : ?>
                                <li class="col<?php echo $item->column;?>"><a href="<?php echo $item->link; ?>"><img src="<?php echo $item->src; ?>" style="border:none" /></a>
                                    <div><a href="<?php echo $item->link; ?>">View</a></div>
                                </li>      
                                <?php endforeach; ?>
                            </ul>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<style type="text/css">
    #slider {
        position: relative;
        width: 630px;
    }
    #slider .viewer {
        width: 630px;
        height: 280px;
        overflow: hidden;
    }
    #slider .viewer .reel {
        display: none;
        height: 280px;
    }
    #slider .viewer .reel .slide {
        position: relative;
        width: 630px;
        height: 280px;
    }
    ul.myList {
        padding: 0;
        margin:0;
        width: 2000px;
    }
    ul.myList li {
        list-style: none outside none;
        margin: 0px 10px 0px 0px;
        float: left;
        width: 305px;
        height: 270px;
        text-align:center;
        border: 2px solid #DEDEDE;
        padding: 0px;
        background: none repeat scroll 0% 0% #F9F9F9;
    }
    
    ul.myList li.col2 {        
        margin: 0px 10px 0px 0px;        
        width: 620px;   
        text-align:center;
    }
    ul.myList li.col2 img{
       
    }
    
    ul.myList li div {
        float: right;
        margin: 0px 4px 0px 0px;
    }
    ul.myList li div a {
        background: none repeat scroll 0% 0% #DEDEDE;
        border: 1px solid #DEDEDE;
        padding: 0px 12px;
        border-radius: 3px;
        display: inline-block;
        font-size: 10px;
        color: #999;
        text-decoration: none;
        cursor: pointer;
        margin-bottom: 20px;
        line-height: 21px;
        font-family: "HelveticaNeue","Helvetica Neue",Helvetica,Arial,sans-serif;
    }
</style>
<script >
	//slidesSelector: '.viewer .reel .slide',
jQuery('#slider').slidertron({
					viewerSelector: '.viewer',
					reelSelector: '.viewer .reel',					
					advanceDelay: 5000,
					speed: 'slow',
					navPreviousSelector: '.previous-button',
					navNextSelector: '.next-button',
					indicatorSelector: '.indicator ul li',
					slideLinkSelector: '.link'
				});	
</script>