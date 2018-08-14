<?php

/**

 * @copyright  Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.

 * @license    GNU/GPL, see LICENSE.php

 * Joomla! is free software. This version may have been modified pursuant

 * to the GNU General Public License, and as distributed it includes or

 * is derivative of works licensed under the GNU General Public License or

 * other free or open source software licenses.

 * See COPYRIGHT.php for copyright notices and details.

 */

// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$this->language = $doc->language;
$this->direction = $doc->direction;
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$product_id=JRequest::getVar("virtuemart_product_id");
if(empty($product_id) ){ //not remove mootools at product detail page
  //unset($doc->_scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
}
$params['maxTitleChars']  = 300;
$menu = $app->getMenu();
//if ($menu->getActive() == $menu->getDefault())
//JHTML::_('behavior.tooltip', '.hasTip', $params);	
//include_once (dirname(__FILE__).'/header_var.php');
if (JRequest::getCmd('view')=='frontpage'){
		$extra = 'home';
	}else {
		$extra = 'sub';
	}
if (JRequest::getCmd('option')=='com_rsform'){
	$check_com	=	'ttn-com';
} else {
	$check_com	=	'ttn-nocom';
}
$templateUrl = $this->baseurl.'/templates/'.$this->template;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
<!-- Toandx Fix IE -->
<!--<meta http-equiv="x-ua-compatible" content="IE=8">-->
<meta http-equiv="x-ua-compatible" content="IE=9">
<?php 
/* getting value in “view” variable */ 
$view= JRequest::getString('view', null); 

  switch ($_SERVER['REQUEST_URI'])
  {
    case "/corporate-gift-ideas.html":
      $atitle = "Unique Promotional Product Ideas - Corporate Gift Ideas";
      break;
    case "/melbourne.html":
      $atitle = "Promotional Products in Melbourne, VIC ";
      break;
    case "/gold-coast.html":
      $atitle = "Gold Coast Promotional Products, QLD";
      break;
    case "/brisbane.html":
      $atitle = "Promotional Products in Brisbane, QLD ";
      break;
    case "/corporate-gifts-adelaide.html":
      $atitle = "Promotional Products in Adelaide, SA ";
      break;
    case "/perth.html":
      $atitle = "Promotional Products in Perth, WA ";
      break;
    case "/sydney.html":
      $atitle = "Promotional Products in Sydney, NSW ";
      break;
      case "/canberra.html":
      $atitle = "Promotional Products in Canberra, ACT ";
      break;
	  
	   case "/confectionery-sweets/chocolate-beans/page-1-20.html":
      $atitle = "Buy Chocolate Beans in Custom Jars ";
	  $adescription ="For delicious, colourful chocolate beans packaged in adorable custom jars, turn to Ultimate Inspiration for your next campaign or event. Browse online now!";
      break;
    case "/confectionery-sweets/jellybeans/page-1-20.html":
      $atitle = "Buy Promotional Jellybeans Online  ";
	  $adescription ="From cute heart shaped containers to quirky noodle boxes, surprise your recipients with delicious jellybeans in unique, custom packaging. Browse online now.";
      break;
    case "/confectionery-sweets/mixed-jellybabies/page-1-20.html":
      $atitle = "Customised Mixed Lollies & Jellybabies  ";
	  $adescription ="Satisfy your recipients' sweet tooth cravings with Ultimate Inspiration's customisable mixed lollies & jellybabies. Choose unique packaging to match online!";
      break;
    case "/confectionery-sweets/mints/page-1-20.html":
      $atitle = "Custom Mints – Promotional Giveaway ";
	  $adescription ="Available online in all shapes, sizes & designs, choose from Ultimate Inspiration's range of promotional mints for your marketing needs. View online today!";
      break;
      case "/confectionery-sweets/mentos/page-1-20.html":
      $atitle = "Promotional Mentos – Custom Packaging  ";
	  $adescription ="Minty fresh, treat your clients & recipients with promotional Mentos in custom packaging from Ultimate Inspiration. Contact us today!";
      break;
	      case "/confectionery-sweets/candy-rolls/page-1-20.html":
      $atitle = "Branded Candy Rolls – Customise Online ";
	  $adescription ="Delicious, fun & colourful, give the gift of branded mint rolls in your next promotional campaign. Delivery Australia wide, order online today!";
      break;
	  case "/confectionery-sweets/wrapped-lollies/page-1-20.html":
      $atitle = "Custom Wrapped Lollies – All Flavours  ";
	  $adescription ="From single tingles to red jelly frogs and mini biscuits, find personalised wrapped lollies for your event from Ultimate Inspiration. Browse online!";
      break;
	  case "/confectionery-sweets/lollypops/page-1-20.html":
      $atitle = "Branded Lollipops – Buy Online  ";
	  $adescription ="From rainbow coloured to chocolate flavoured, you'll find all your customised lollipop promotional giveaways online from us. Delivery AUS wide, browse now!";
      break;
	  case "/confectionery-sweets/chocolates/page-1-20.html":
      $atitle = "Buy Chocolate in Personalised Wrappers  ";
	  $adescription ="Have your chosen picture imprinted on chocolates or customise the packaging with your message online at Ultimate Inspiration. Browse online & order today!";
      break;
	  case "/confectionery-sweets/chocolate-coins/page-1-20.html":
      $atitle = "Buy Chocolate Coins Online  ";
	  $adescription ="At affordable prices & delivery Australia wide, Ultimate Inspiration delivers a great range of chocolate coins for your next promo event. Browse online!";
      break;
	  case "/confectionery-sweets/humbugs/page-1-20.html":
      $atitle = "Promotional Humbugs – Buy Online ";
	  $adescription ="Perfectly melty-in-the-mouth, turn to Ultimate Inspiration for customised jars that you can fill with tasty humbugs & more! Contact us now.";
      break;
	  case "/confectionery-sweets/custom-rock-candy/page-1-20.html":
      $atitle = "Custom Rock Candy – Order Online ";
	  $adescription ="Sugary goodness with a hint of sourness, everybody loves rock candy! With customised jars available, browse online & boost your campaign or event today!";
      break;
	  	  case "/confectionery-sweets/nuts-savoury-range/page-1-20.html":
      $atitle = "Nuts & Savoury Treats – Custom Packaging ";
	  $adescription ="Perfect for snacking on, give your campaign or event an additional boost with our customisable nuts & savoury selections! Personalise packaging online now!";
      break;case "/confectionery-sweets/tin-range/page-1-20.html":
      $atitle = "Buy Mints & Candy in Customised Tins ";
	  $adescription ="From mints to jellybeans, chocolate beans & more, treat your recipients with customised tins filled with delicious, tasty goodness. Place an order now!";
      break;case "/confectionery-sweets/buckets/page-1-20.html":
      $atitle = "Buckets of Confectionary & Sweets ";
	  $adescription ="Whether you're a fan of mentos, jellybeans or other, Ultimate Inspiration delivers personalised buckets of candy for your event/ business. Order online now!";
      break;case "/confectionery-sweets/business-card-treats/page-1-20.html":
      $atitle = "Customisable Business Card Treats ";
	  $adescription ="Delivering Australia wide, complement your business campaign with personalised & branded business card treats from Ultimate Inspiration. Order today!!";
      break;case "/confectionery-sweets/canisters/page-1-20.html":
      $atitle = "Customised Canisters & Lollies Online  ";
	  $adescription ="Customise cannisters with your message or logo and fill them with a selection of delicious treats. Delivery Australia wide, order online from us today!";
      break;case "/confectionery-sweets/clip-lock-jars/page-1-20.html":
      $atitle = "Branded Clip Lock Jars for Candy & More ";
	  $adescription ="From mini M&Ms to humbugs & jellybeans, you can select from our range of personalised clip lock jars & fill with your candy of choice. Order online!";
      break;case "/confectionery-sweets/custom-rock-candy/page-1-20.html":
      $atitle = "Custom Rock Candy – Order Online ";
	  $adescription ="Sugary goodness with a hint of sourness, everybody loves rock candy! With customised jars available, browse online & boost your campaign or event today!";
      break;case "/confectionery-sweets/champagne-bottles/page-1-20.html":
      $atitle = "Champagne Bottles Filled with Candy  ";
	  $adescription ="Great for celebratory events, why not gift your guests with personalised champagne bottles filled with the candy of your choice? Browse & order online now!";
      break;
	  
	  case "/confectionery-sweets/squexagonal-jars/page-1-20.html":
      $atitle = "Buy Squexagonal Lolly Jars Online ";
	  $adescription ="Perfect as a promotional giveaway, personalise squexagonal jars with your message or logo or fill them with delicious lollies! Available online, order today!";
      break;
	  case "/confectionery-sweets/square-jars/page-1-20.html":
      $atitle = "Customise Square Jars for Sweets & More ";
	  $adescription ="Boost your marketing or business campaign with unforgettable personalised square lolly jars filled with whatever piques your fancy. Place an order now!";
      break;
	  case "/confectionery-sweets/tall-jars/page-1-20.html":
      $atitle = "Customisable Tall Jars filled with Sweets ";
	  $adescription ="Make a stance for your campaign with our exceptional range of customisable tall candy jars. Simply fill with candy of choice & choose your printed message!";
      break;
	  case "/confectionery-sweets/plastic-jars/page-1-20.html":
      $atitle = "Personalised Plastic Jars for Custom Lollies ";
	  $adescription ="A unique & practical giveaway for your next promotional campaign, customise plastic jars & fill with candy of choice. Delivered AUS wide, order online now!";
      break;
	  case "/confectionery-sweets/dollars-acrylic/page-1-20.html":
      $atitle = "Acrylic Dollar Jars – Order Online ";
	  $adescription ="Quirky & fun, fill acrylic dollar-shaped jars with delicious lollies & customise with your logo or message. Browse online & enjoy delivery Australia-wide!";
      break;
	  case "/confectionery-sweets/hearts-acrylic/page-1-20.html":
      $atitle = "Acrylic Heart Jars – Customisable ";
	  $adescription ="Adorable and a little bit fancy, fill our customisable acrylic heart jars with sweet treats & leave your clients/ recipients impressed. Order online now!";
      break;
	  case "/confectionery-sweets/noodle-boxes/page-1-20.html":
      $atitle = "Customisable Noodle Boxes – Buy Online ";
	  $adescription ="All good things come in small packages. For your next promotion, personalise quirky noodle boxes with your message & fill it with candy. Browse online now.";
      break;
	  case "/confectionery-sweets/pull-cans/page-1-20.html":
      $atitle = "Customise Pull Cans filled with Lollies ";
	  $adescription ="Fun & unique, why not complement your promotional campaign with our customisable pull cans filled with lollies of your choice. Browse online & contact us!";
      break;
	  case "/confectionery-sweets/test-tubes/page-1-20.html":
      $atitle = "Personalised Test Tubes for Candy ";
	  $adescription ="A little bit quirky, have some fun with your next business campaign with customisable test tubes filled with delicious sugary treats! View & order online!";
      break;
	  case "/confectionery-sweets/pet-tube/page-1-20.html":
      $atitle = "Pet Tubes Filled with Lollies – Order Online ";
	  $adescription ="Personalise our quality pet tubes with your logo or brand message & fill with M&Ms, mints & more for your next event or campaign. Order online now!";
      break;
	  
	  case "/confectionery-sweets/page-1-20.html":
      $atitle = "Promotional Lollies – Personalised Candy Australia ";
	  $adescription ="Perfect for all occasions; turn to Ultimate Inspiration for custom candy, personalised candy bags & more for your next giveaway. Browse & order online!";
      break;
	  case "/confectionery-sweets/personalised-mms/page-1-20.html":
      $atitle = "Personalised M&Ms – Delivered AUS Wide ";
	  $adescription ="These melt-in-your mouth personalised M&Ms are the perfect way to promote your business in a fun and unforgettably tasty way. Buy online today!";
      break;
	  case "/desk-office-stationery/page-1-20.html":
      $atitle = "Buy Custom Stationary Online ";
	  $adescription ="Complement your company's marketing campaign with branded & personalised promotional desk & office stationary from Ultimate Inspiration. Browse online!";
      break;
	  case "/promotional-stress-balls/page-1-20.html":
      $atitle = "Promotional Stress Balls – Custom Printed ";
	  $adescription ="For your next corporate promotional campaign, turn to Ultimate Inspiration for custom stress balls! Delivery Australia-wide, browse online today!";
      break;
    default:
      $atitle = $this->getTitle();
      break;
    }
?>
<?php 
/* check if it is VirtueMart  category page*/
if ($view == 'category') 
{ 
$this->setTitle( ucwords(strtolower($atitle)). ' | ' . $app->getCfg( 'sitename' ) );
$this->setMetaData('description', $adescription );
} 
/* check if  it is VirtueMart product detail page*/
elseif ($view == 'productdetails') 
{
    $this->setTitle( substr($atitle,strrpos($atitle,":")+2,strlen($atitle)-strrpos($atitle,":") ) . ' | ' . $app->getCfg( 'sitename' ));
}
else
{
    $this->setTitle( $atitle . ' | ' . $app->getCfg( 'sitename' ) );
  }   
?>
	
<jdoc:include type="head" />

<link rel="stylesheet" href="<?php echo $templateUrl;?>/css/layout.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $templateUrl;?>/css/template.css" type="text/css" />

<!--[if lte IE 6]>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ieonly.css" rel="stylesheet" type="text/css" />
<![endif]-->
<?php
  
  if ($menu->getActive() == $menu->getDefault()) { 
?>

<link rel="stylesheet" href="/components/com_virtuemart/assets/css/vmsite-ltr.css" type="text/css" />
<script src="<?php echo JURI::base();?>/modules/mod_slidertron/js/jquery.slidertron-1.1.js"></script>

<?php
  }
?>

<script>
function ttn_displayImg(id, flag){
    fullImgId = "prdFullImg_"+ id;    
    /*if(flag==1){
    
      document.getElementById(fullImgId).setAttribute("class", "ttn_display");
      
    }else{
    
      document.getElementById(fullImgId).setAttribute("class", "ttn_hidden");
    }*/
    return;  
}
  
jQuery.noConflict();

sfhover = function() {  

  var sfEls = document.getElementById("ttn-right").getElementsByTagName("LI");

  for (var i=0; i<sfEls.length; i++) {

    sfEls[i].onmouseover=function() {

      this.className+=" sfhover";

    }

    sfEls[i].onmouseout=function() {

      this.className=this.className.replace(new RegExp(" sfhover\\b"), "");

    }

  }

}

if (window.attachEvent) window.attachEvent("onload", sfhover);


</script>
<?php //if ($menu->getActive() != $menu->getDefault()) : ?>
<script type="text/javascript">
//jQuery.noConflict();

  </script>
 <?php //endif; ?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-6987311-1']);
  _gaq.push(['_trackPageview']);
  
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-41361672-1']);
  _gaq.push(['_trackPageview']);
  
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>

<body  class="site <?php echo $option
	. ' view-' . $view
	. ($layout ? ' layout-' . $layout : ' no-layout')
	. ($task ? ' task-' . $task : ' no-task')
	. ($itemid ? ' itemid-' . $itemid : '');
?>">
<div id="ttn-wrapper">
  <div id="ttn-wrapper-inner">
    <?php if($this->countModules('search')) { ?>
    <div id="ttn-search">
      <jdoc:include type="modules" name="search" style="xhtml" />
    </div>
    <?php } ?>
    <div id="ttn-banner">
      <div id="ttn-logo"><a href="<?php echo $this->baseurl; ?>" title="Promotional Products & Corporate Gifts">
    <img src="<?php echo $templateUrl;?>/images/logo.jpg" width="176" height="240" alt="Ultimate Inspiration Promotional Products & Corporate Gifts" /></a></div>
    </div>
    <div id="ttn-nav">
      <div id="ttn-nav-inner">
        <jdoc:include type="modules" name="nav" />
        <div style="clear:both"></div>
      </div>
    </div>
    <div id="ttn-mainpage">
      <div id="ttn-mainpage-inner">
        <div id="ttn-left">
          <div id="ttn-left-inner">
            <?php if(($this->countModules('latestnews')) || ($this->countModules('international')) || ($this->countModules('featurepro')) || ($this->countModules('user1')) || ($this->countModules('user2'))) { ?>
            <div id="ttn-left-inner-mod">
              <?php if(($this->countModules('latestnews')) || ($this->countModules('international')) || ($this->countModules('user1')) || ($this->countModules('user2'))) { ?>
              <div id="ttn-left-inner-mod-left">
                <?php if($this->countModules('user1')) { ?>
                <div class="line">
                  <div id="user1">
                    <jdoc:include type="modules" name="user1" style="rounded" />
                  </div>
                </div>
                <?php } ?>
                <?php if($this->countModules('user2')) { ?>
                <div class="line">
                  <div id="user2">
                    <jdoc:include type="modules" name="user2" style="xhtml" />
                  </div>
                </div>
                <?php } ?>
                <?php if(($this->countModules('latestnews')) || ($this->countModules('international'))){ ?>
                <div class="line">
                  <?php if($this->countModules('latestnews')) { ?>
                  <div id="latestnews">
                    <jdoc:include type="modules" name="latestnews" style="xhtml" />
                  </div>
                  <?php } ?>
                  <?php if($this->countModules('international')) { ?>
                  <div id="international">
                    <jdoc:include type="modules" name="international" style="xhtml" />
                  </div>
                  <?php } ?>
                  <div style="clear:both"></div>
                </div>
                <?php } ?>
              </div>
              <?php } ?>
              <?php if($this->countModules('featurepro')) { ?>
              <div id="ttn-left-inner-mod-right">
                <jdoc:include type="modules" name="featurepro" style="xhtml" />
              </div>
              <?php } ?>
              <div style="clear:both"></div>
            </div>
            <?php } ?>
            <div id="content-<?php echo $extra; ?>" class="<?php echo $check_com; ?>">
              <div id="content-inner">
                <jdoc:include type="message" />
				
                <?php 



                 $product_id=JRequest::getVar("virtuemart_product_id");



                if($product_id){



                if($this->countModules('slideproduct')) { ?>
                <div  style="margin-top:15px;">
                  <jdoc:include type="modules" name="slideproduct" style="xhtml" />
                </div>
                <?php }} ?>
				
                <div class="span-12" id="breadcrumb">
                  <jdoc:include type="modules" name="breadcrumb" style="xhtml" />
				  <?php if($this->countModules('breadcrumb-all') && JRequest::getVar("virtuemart_product_id")){ ?>
				    <jdoc:include type="modules" name="breadcrumb-all" style="xhtml" />
				  <?php }?>
                </div>
				
				
                <jdoc:include type="component" />
                <?php if($this->countModules('randomproducts')){?>
                <div>
                  <h3 style=" font-size:18px; text-transform:uppercase; color:#8C8C8C; tex-align:left; line-height:30px;font-family:Trajan Pro;">Popular Products</h3>
                  <jdoc:include type="modules" name="randomproducts" style="xhtml" />
                </div>
                <?php }?>
              </div>
            </div>
            <!--content--> 
            
          </div>
          <!--left--> 
          
        </div>
        <div id="ttn-right">
          <div id="ttn-right-inner">
            <jdoc:include type="modules" name="right" style="rounded" />            
          </div>
        </div>
        <!--right-->
        
        <div style="clear:both"></div>
      </div>
    </div>
    <!--end of mainpage-->
    
    <div id="ttn-bottom">
      <div id="ttn-bottom-inner">
        <?php if(($this->countModules('links')) || ($this->countModules('contact'))) { ?>
        <div id="bottom-mod">
          <?php if ($this->countModules('links')) { ?>
          <div id="bottom-mod-left">
            <div id="bottom-mod-left-inner">
              <jdoc:include type="modules" name="links" style="xhtml" />
            </div>
			
			<div style="float: left; margin-top: 5px">
                <div id="footer_links" >
                   <a href="index.php?option=com_content&Itemid=146&catid=2&id=81&view=article">Melbourne</a> | 
                   <a href="index.php?option=com_content&view=article&id=90">Brisbane</a> | 
                   <a href="index.php?option=com_content&Itemid=212&catid=2&id=82&view=article">Gold Coast</a> | 
                   <a href="index.php?option=com_content&Itemid=210&catid=2&id=84&view=article">Sydney</a> |  
                   <a href="index.php?option=com_content&view=article&id=89">Adelaide</a> | 
                   <a href="index.php?option=com_content&Itemid=211&catid=2&id=83&view=article">Perth</a> | 
                   <a href="index.php?option=com_content&Itemid=213&catid=38&id=72&view=article">Canberra</a> 
                </div>   
                <div id="copyright">
					COPYRIGHT &copy; ULTIMATE INSPIRATION ABN 73 463 036 345 ALL RIGHTS RESERVED. 
					<a href="index.php?option=com_content&view=article&id=54">TERMS &amp; CONDITIONS</a> 
				</div>
            </div>
			<div id="footer_logo"  style="width: 210px; height: 70px; float: right;  margin-top: 5px;">
				<img src="<?php echo $templateUrl;?>/images/APPA_Member_Logo.jpg" />
			</div>
          
		  
          </div>
          <?php } ?>
          <?php if ($this->countModules('contact')){?>
          <div id="bottom-mod-right">
            <div id="bottom-mod-right-inner">
              <jdoc:include type="modules" name="contact" style="xhtml" />
            </div>
          </div>
          <?php } ?>
          <div style="clear:both"></div>
        </div>
        <?php } ?>
      
      </div>
    </div>
    <!--end of bottom-->
    
    <div style="clear:both"></div>
  </div>
</div>
<script type="text/javascript">

/* <![CDATA[ */

var google_conversion_id = 1021672865;

var google_custom_params = window.google_tag_params;

var google_remarketing_only = true;

/* ]]> */

</script>

<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">

</script>

<noscript>

<div style="display:inline;">

<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1021672865/?value=0&amp;guid=ON&amp;script=0"/>

</div>

</noscript>
<!--enf of wrapper-->
<?php ?>
<jdoc:include type="modules" name="debug" />

</body>
</html>