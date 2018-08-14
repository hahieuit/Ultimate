<?php
/*------------------------------------------------------------------------
# mod_livechat - Comm100 Live Chat
# ------------------------------------------------------------------------
# author    Comm100
# copyright Copyright (C) 2012 comm100.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.comm100.com/
# Technical Support:  Forum - http://hosted.comm100.com/HelpDesk/Main/Main.aspx?siteid=10000
-------------------------------------------------------------------------*/
// no direct access

defined( '_JEXEC' ) or die( 'Restricted access' );

<!--Begin Comm100 Live Chat Code-->
<div id="comm100-button-{%PLANID%}"></div>
<script type="text/javascript">
    var Comm100API=Comm100API||{chat_buttons:[]};
    Comm100API.chat_buttons.push({code_plan:{%PLANID%},div_id:"comm100-button-{%PLANID%}"});
	Comm100API.site_id={%SITEID%};Comm100API.main_code_plan={%PLANID%};
    (function(){
        var lc=document.createElement("script"); 
        lc.type="text/javascript";lc.async=true;
        lc.src="https://{%MAINCHATSERVERDOMAIN%}/livechat.ashx?siteId="+Comm100API.site_id;
        var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(lc,s);


    	setTimeout(function() {
    		if (!Comm100API.loaded) {
	            var lc1 = document.createElement("script");
	            lc1.type = "text/javascript";
	            lc1.async = true;
	            lc1.src = "https://{%STANDBYCHATSERVERDOMAIN%}/livechat.ashx?siteId=" + Comm100API.site_id;
	            var s1 = document.getElementsByTagName("script")[0];
	            s1.parentNode.insertBefore(lc1, s1);
    		}
    	}, 5000)
    })();
</script>
<!--End Comm100 Live Chat Code-->
