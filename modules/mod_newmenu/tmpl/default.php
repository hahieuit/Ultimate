<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_footer
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
$db	   = JFactory::getDBO();
$query = "SELECT a.virtuemart_category_id as id, a.category_name as name FROM #__virtuemart_categories_en_gb a, #__virtuemart_category_categories b, #__virtuemart_categories c WHERE a.virtuemart_category_id = b.id AND a.virtuemart_category_id = c.virtuemart_category_id AND c.published = 1  AND b.category_parent_id = 0 ORDER BY a.category_name ASC";
$db->setQuery($query);
$rows = $db->loadObjectList();
$ac = array("A", "B", "C");
$dg = array("D", "E", "F", "G");
$hl = array("H", "I", "J", "K","L");
$mo = array("M", "N", "O");
$ps = array("P", "Q", "R", "S");
$tz = array("T", "U", "V", "W","X","Y","Z");
$listAC="<ul class='detail-menu'>";
$listDG="<ul class='detail-menu'>";
$listHL="<ul class='detail-menu'>";
$listMO="<ul class='detail-menu'>";
$listPS="<ul class='detail-menu'>";
$listTZ="<ul class='detail-menu'>";
foreach ( $rows as $row ){
	$urls =	JRoute::_('index.php?option=com_virtuemart&view=category&virtuemart_category_id='.$row->id);
	if (in_array($row->name[0], $ac)) {
		$listAC .= "<li id='item-".$row->id."' class = 'new-level3'><a href='".$urls."'>".implode('(', array_map('ucfirst', explode('(', ucwords(strtolower($row->name)))))."</a></li>";
	}else if(in_array($row->name[0], $dg)){
		$listDG .= "<li id='item-".$row->id."' class = 'new-level3'><a href='".$urls."'>".implode('(', array_map('ucfirst', explode('(', ucwords(strtolower($row->name)))))."</a></li>";
	}else if(in_array($row->name[0], $hl)){
		$listHL .= "<li id='item-".$row->id."' class = 'new-level3'><a href='".$urls."'>".implode('(', array_map('ucfirst', explode('(', ucwords(strtolower($row->name)))))."</a></li>";
	}else if(in_array($row->name[0], $mo)){
		$listMO .= "<li id='item-".$row->id."' class = 'new-level3'><a href='".$urls."'>".implode('(', array_map('ucfirst', explode('(', ucwords(strtolower($row->name)))))."</a></li>";
	}else if(in_array($row->name[0], $ps)){
		$listPS .= "<li id='item-".$row->id."' class = 'new-level3'><a href='".$urls."'>".implode('(', array_map('ucfirst', explode('(', ucwords(strtolower($row->name)))))."</a></li>";
	}else if(in_array($row->name[0], $tz)){
		$listTZ .= "<li id='item-".$row->id."' class = 'new-level3'><a href='".$urls."'>".implode('(', array_map('ucfirst', explode('(', ucwords(strtolower($row->name)))))."</a></li>";
	}
}

$listAC .="</ul>";
$listDG .="</ul>";
$listHL .="</ul>";
$listMO .="</ul>";
$listPS .="</ul>";
$listTZ .="</ul>";

// image
	$img1 	= $params->get('img1');
	$img2 	= $params->get('img2');
	$img3 	= $params->get('img3');
	$img4 	= $params->get('img4');
	$img5 	= $params->get('img5');
	$img6 	= $params->get('img6');
	$img7 	= $params->get('img7');
	$img8 	= $params->get('img8');
	$img9 	= $params->get('img9');
	$img10	= $params->get('img10');
	$img11 	= $params->get('img11');
	$img12 	= $params->get('img12');
	$img13 	= $params->get('img13');
	$img14 	= $params->get('img14');
	$img15 	= $params->get('img15');
	$img16 	= $params->get('img16');
	$img17 	= $params->get('img17');
	$img18 	= $params->get('img18');
	$img19 	= $params->get('img19');
	$img20	= $params->get('img20');
	$img21 	= $params->get('img21');
	$img22 	= $params->get('img22');
	$img23 	= $params->get('img23');
	$img24 	= $params->get('img24');
	$img25 	= $params->get('img25');
	$img26 	= $params->get('img26');
	$img27 	= $params->get('img27');
	$img28 	= $params->get('img28');
	$img29 	= $params->get('img29');
	$img30	= $params->get('img30');
	$img31 	= $params->get('img31');
	$img32 	= $params->get('img32');
	$img33 	= $params->get('img33');
	$img34 	= $params->get('img34');
	$img35 	= $params->get('img35');
	$img36 	= $params->get('img36');
	$img37 	= $params->get('img37');
	$img38 	= $params->get('img38');
	$img39 	= $params->get('img39');
	$img40	= $params->get('img40');
	$img41 	= $params->get('img41');
	$img42 	= $params->get('img42');
	$img43 	= $params->get('img43');
	$img44 	= $params->get('img44');
	$img45 	= $params->get('img45');
	$img46 	= $params->get('img46');
	$img47 	= $params->get('img47');
	$img48 	= $params->get('img48');
	$img49 	= $params->get('img49');
	$img50	= $params->get('img50');
// link		
	$link1 	= $params->get( 'link1');
	$link2 	= $params->get( 'link2');
	$link3 	= $params->get( 'link3');
	$link4 	= $params->get( 'link4');
	$link5 	= $params->get( 'link5');
	$link6 	= $params->get( 'link6');
	$link7 	= $params->get( 'link7');
	$link8 	= $params->get( 'link8');
	$link9 	= $params->get( 'link9');
	$link10	= $params->get( 'link10');
	$link11 	= $params->get( 'link11');
	$link12 	= $params->get( 'link12');
	$link13 	= $params->get( 'link13');
	$link14 	= $params->get( 'link14');
	$link15 	= $params->get( 'link15');
	$link16 	= $params->get( 'link16');
	$link17 	= $params->get( 'link17');
	$link18 	= $params->get( 'link18');
	$link19 	= $params->get( 'link19');
	$link20	= $params->get( 'link20');
	$link21 	= $params->get( 'link21');
	$link22 	= $params->get( 'link22');
	$link23 	= $params->get( 'link23');
	$link24 	= $params->get( 'link24');
	$link25 	= $params->get( 'link25');
	$link26 	= $params->get( 'link26');
	$link27 	= $params->get( 'link27');
	$link28 	= $params->get( 'link28');
	$link29 	= $params->get( 'link29');
	$link30	= $params->get( 'link30');
	$link31 	= $params->get( 'link31');
	$link32 	= $params->get( 'link32');
	$link33 	= $params->get( 'link33');
	$link34 	= $params->get( 'link34');
	$link35 	= $params->get( 'link35');
	$link36 	= $params->get( 'link36');
	$link37 	= $params->get( 'link37');
	$link38 	= $params->get( 'link38');
	$link39 	= $params->get( 'link39');
	$link40	= $params->get( 'link40');
	$link41 	= $params->get( 'link41');
	$link42 	= $params->get( 'link42');
	$link43 	= $params->get( 'link43');
	$link44 	= $params->get( 'link44');
	$link45 	= $params->get( 'link45');
	$link46 	= $params->get( 'link46');
	$link47 	= $params->get( 'link47');
	$link48 	= $params->get( 'link48');
	$link49 	= $params->get( 'link49');
	$link50	= $params->get( 'link50');

?>
<div class="new-menus">
	<ul class="mainnewmenu">
		<li id = "item-newmenu-1" class="new-level1">
			<a href="/products"style="height: 140px;display: inline-block;width:100%;"></a>
			<ul class="detail-menu" id="detailmenu">
				<?php if($listAC != "<ul class='detail-menu'></ul>"){ ?>
					<li class="new-level2"><span>A - C</span>
						<?php echo $listAC; ?>
					</li>
				<?php } ?>

				<?php if($listDG != "<ul class='detail-menu'></ul>"){ ?>
					<li class="new-level2"><span>D - G</span>
						<?php echo $listDG; ?>
					</li>
				<?php } ?>

				<?php if($listHL != "<ul class='detail-menu'></ul>"){ ?>
					<li class="new-level2"><span>H - L</span>
						<?php echo $listHL; ?>
					</li>
				<?php } ?>

				<?php if($listMO != "<ul class='detail-menu'></ul>"){ ?>
					<li class="new-level2"><span>M - O</span>
						<?php echo $listMO; ?>
					</li>
				<?php } ?>

				<?php if($listPS != "<ul class='detail-menu'></ul>"){ ?>
					<li class="new-level2"><span>P - S</span>
						<?php echo $listPS; ?>
					</li>
				<?php } ?>

				<?php if($listTZ != "<ul class='detail-menu'></ul>"){ ?>
					<li class="new-level2 last"><span>T - Z</span>
						<?php echo $listTZ; ?>
					</li>
				<?php } ?>				
			</ul>
		</li>
		<li id = "item-newmenu-2" class="new-level1">
			<a href="#" alt="" style="height: 140px;display: inline-block;width:100%;"></a>
			<ul id="popular-cat">
				<?php if($img1 && $link1 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link1;?>" alt=""><img src="<?php echo $img1;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img2 && $link2 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link2;?>" alt=""><img src="<?php echo $img2;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img3 && $link3 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link3;?>" alt=""><img src="<?php echo $img3;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img4 && $link4 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link4;?>" alt=""><img src="<?php echo $img4;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img5 && $link5 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link5;?>" alt=""><img src="<?php echo $img5;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img6 && $link6 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link6;?>" alt=""><img src="<?php echo $img6;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img7 && $link7 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link7;?>" alt=""><img src="<?php echo $img7;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img8 && $link8 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link8;?>" alt=""><img src="<?php echo $img8;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img9 && $link9 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link9;?>" alt=""><img src="<?php echo $img9;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img10 && $link10 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link10;?>" alt=""><img src="<?php echo $img10;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img11 && $link11 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link11;?>" alt=""><img src="<?php echo $img11;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img12 && $link12 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link12;?>" alt=""><img src="<?php echo $img12;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img13 && $link13 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link13;?>" alt=""><img src="<?php echo $img13;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img14 && $link14 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link14;?>" alt=""><img src="<?php echo $img14;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img15 && $link15 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link15;?>" alt=""><img src="<?php echo $img15;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img16 && $link16 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link16;?>" alt=""><img src="<?php echo $img16;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img17 && $link17 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link17;?>" alt=""><img src="<?php echo $img17;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img18 && $link18 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link18;?>" alt=""><img src="<?php echo $img18;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img19 && $link19 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link19;?>" alt=""><img src="<?php echo $img19;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img20 && $link20 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link20;?>" alt=""><img src="<?php echo $img20;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img21 && $link21 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link21;?>" alt=""><img src="<?php echo $img21;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img22 && $link22 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link22;?>" alt=""><img src="<?php echo $img22;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img23 && $link23 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link23;?>" alt=""><img src="<?php echo $img23;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img24 && $link24 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link24;?>" alt=""><img src="<?php echo $img24;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img25 && $link25 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link25;?>" alt=""><img src="<?php echo $img25;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img26 && $link26 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link26;?>" alt=""><img src="<?php echo $img26;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img27 && $link27 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link27;?>" alt=""><img src="<?php echo $img27;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img28 && $link28 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link28;?>" alt=""><img src="<?php echo $img28;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img29 && $link29 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link29;?>" alt=""><img src="<?php echo $img29;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img30 && $link30 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link30;?>" alt=""><img src="<?php echo $img30;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img31 && $link31 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link31;?>" alt=""><img src="<?php echo $img31;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img32 && $link32 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link32;?>" alt=""><img src="<?php echo $img32;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img33 && $link33 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link33;?>" alt=""><img src="<?php echo $img33;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img34 && $link34 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link34;?>" alt=""><img src="<?php echo $img34;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img35 && $link35 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link35;?>" alt=""><img src="<?php echo $img35;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img36 && $link36 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link36;?>" alt=""><img src="<?php echo $img36;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img37 && $link37 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link37;?>" alt=""><img src="<?php echo $img37;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img38 && $link38 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link38;?>" alt=""><img src="<?php echo $img38;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img39 && $link39 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link39;?>" alt=""><img src="<?php echo $img39;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img40 && $link40 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link40;?>" alt=""><img src="<?php echo $img40;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img41 && $link41 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link41;?>" alt=""><img src="<?php echo $img41;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img42 && $link42 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link42;?>" alt=""><img src="<?php echo $img42;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img43 && $link43 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link43;?>" alt=""><img src="<?php echo $img43;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img44 && $link44 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link44;?>" alt=""><img src="<?php echo $img44;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img45 && $link45 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link45;?>" alt=""><img src="<?php echo $img45;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img46 && $link46 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link46;?>" alt=""><img src="<?php echo $img46;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img47 && $link47 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link47;?>" alt=""><img src="<?php echo $img47;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img48 && $link48 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link48;?>" alt=""><img src="<?php echo $img48;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img49 && $link49 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link49;?>" alt=""><img src="<?php echo $img49;?>" alt=""/></a>
					</li>
				<?php } ?>
				<?php if($img50 && $link50 !='http://'){?>
					<li class="pocat-level2">
						<a href="<?php echo $link50;?>" alt=""><img src="<?php echo $img50;?>" alt=""/></a>
					</li>
				<?php } ?>		
			</ul>
		</li>
		<li id = "item-newmenu-3" class="new-level1"><a href="index.php?option=com_virtuemart&Itemid=199&limit=25&limitstart=0&view=category&virtuemart_category_id=83" alt="" style="height: 140px;display: inline-block;width:100%;"></a></li>
		<li id = "item-newmenu-4" class="new-level1"><a href="index.php?option=com_virtuemart&Itemid=199&limit=25&limitstart=0&view=category&virtuemart_category_id=94" alt="" style="height: 140px;display: inline-block;width:100%;"></a></li>
		<li id = "item-newmenu-5" class="new-level1"><a href="index.php?option=com_virtuemart&Itemid=199&limit=25&limitstart=0&view=category&virtuemart_category_id=185" alt="" style="height: 140px;display: inline-block;width:100%;"></a></li>
		<li id = "item-newmenu-6" class="new-level1"><a href="index.php?option=com_virtuemart&Itemid=199&limit=25&limitstart=0&view=category&virtuemart_category_id=184" alt="" style="height: 140px;display: inline-block;width:100%;"></a></li>
	</ul>
</div>

<script>
	jQuery(document).ready(function(){
        var path = window.location.href;
		var finalPath = path.split("/")[3];
		jQuery('.mainnewmenu li a').each(function() {
            if (this.href === path) {
                jQuery(this).addClass('item-active');
            }
        });
    });
</script>
	