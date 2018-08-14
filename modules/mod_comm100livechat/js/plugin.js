var session_in_url = (navigator.userAgent.toLowerCase().indexOf('windows') > 0 ? '' : '(S(' + comm100livechat_session + '))/');
String.prototype.trim = function()
{
    return this.replace(/(^[\s]*)|([\s]*$)/g, "");
}

function html_encode(html) {
	var div=document.createElement("div");
	var txt=document.createTextNode(html);
	div.appendChild(txt);
	return div.innerHTML;
}

if (typeof comm100_script_id == 'undefined')
	comm100_script_id = 0;

function comm100_script_route(params, success, error) {
	comm100_script_request(params, success, error, "route.comm100.com/routeserver/pluginHandler.ashx", "route1.comm100.com/routeserver/pluginHandler.ashx");
}
function comm100_script_main_route(params, success, error) {  //for register only 30 sec timeout
	comm100_script_request(params, success, error, "route.comm100.com/routeserver/pluginHandler.ashx", null, 30);
}
function comm100_script_cpanel(params, success, error) {
	comm100_script_request(params, success, error, (comm100_cpanel_domain || "hosted.comm100.com") + "/AdminPluginService/livechatplugin.ashx");
}
function comm100_script_request(params, success, error, url, backup_url, timeoutsec) {
	timeoutsec = timeoutsec || 10;

	function request() {
		var _id,
			_success, _error,
			_timer_timeout,
			_self = this;

		function _append_script(src, timeout) {
			_id = 'comm100_script_' + comm100_script_id++;
			window[_id] = _self;

			var scr = document.createElement('script');
			scr.src = src + '&callback=' + _id + '.onresponse';
			scr.id = '_' + _id;
			scr.type = 'text/javascript';
			document.getElementsByTagName('head')[0].appendChild(scr);
			_timer_timeout = setTimeout(timeout, timeoutsec*1000);
		}
		function _remove_script() {
			if (_timer_timeout) clearTimeout(_timer_timeout);

			window[_id] = null;
			var scr = document.getElementById('_' + _id);
			document.getElementsByTagName('head')[0].removeChild(scr);			
		}
		this.send = function (url, backup_url, success, error) {
			_append_script(url, function() {
				if (backup_url) {
					_remove_script();
					
					_append_script(backup_url, function() {
						_error('Unexpected error. Please have a live chat with our support team or email to support@comm100.com.');
					});
				} else {					
					_error('Unexpected error. Please have a live chat with our support team or email to support@comm100.com.');
				}
			});

			_error = error || function() {};
			_success = success || function() {};		
		};
		this.onresponse = function _onresponse(response) {
			_remove_script();

			_success(response);
		};
	}

	var req = new request();
	if (backup_url) backup_url = 'https://' + backup_url + params;
	req.send('https://' + url + params, backup_url, success, error);
}

var comm100_plugin = (function() {
    function _onexception(msg) {
        document.getElementById('login_submit_img').style.display = 'none';
        document.getElementById('login_submit').disabled = false;

        document.getElementById('register_submit_img').style.display = 'none';
        document.getElementById('register_submit').disabled = false;

        alert(msg);
    }

    function _get_timezone() {
        return ((new Date()).getTimezoneOffset() / -60.0).toString();
    }
    function _register() {
	    hide_element('register_cancel');
	    show_element('register_submit_img');
        document.getElementById('register_submit').disabled = true;

        var edition = encodeURIComponent(document.getElementById('register_edition').value);
        var name = encodeURIComponent(document.getElementById('register_name').value);
        var email = encodeURIComponent(document.getElementById('register_email').value);
        var password = encodeURIComponent(document.getElementById('register_password').value);
        var phone = encodeURIComponent(document.getElementById('register_phone').value);
        var website = encodeURIComponent(document.getElementById('register_website').value);
        var timezone = encodeURIComponent(_get_timezone());
        var referrer = encodeURIComponent(window.location.href);

        comm100_script_main_route('?action=register&edition=' + edition + '&name=' + name + '&email=' + email +
			'&password=' + password + '&phone=' + phone + '&website=' + website + '&timezone=' + timezone + '&referrer=' + referrer + '&source=joomla'
			, function(response) {
			    if(response.success) {
    				comm100_cpanel_domain = response.cpanel_domain;
					
					show_loading();
			    	var site_id = response.response;
			        _get_plans(site_id, function (plans) {
			        	if (plans.length == 0) {
			        		alert('Error: no code plan.');
			        	} else {
					        comm100_cpanel_domain = response.cpanel_domain;

					        save_settings(site_id, plans[0].id, decodeURIComponent(email), response.cpanel_domain, response.main_chatserver_domain, response.standby_chatserver_domain);
			        	}
			        });
			    }
			    else {
			        document.getElementById('register_error').style.display = '';
			        document.getElementById('register_error_text').innerHTML = response.error;
			    }

			    show_element('register_cancel');
			    hide_element('register_submit_img');
			    document.getElementById('register_submit').disabled = false;

			}, function(message) {
			    hide_element('register_submit_img');
			    document.getElementById('register_submit').disabled = false;

			    show_element('register_cancel');
			    document.getElementById('register_error').style.display = '';
			    document.getElementById('register_error_text').innerHTML = message;
			});
    }
    function _login() {
        document.getElementById('login_submit_img').style.display = '';
        document.getElementById('login_submit').disabled = true;

        var site_id = encodeURIComponent(document.getElementById('login_site_id').value.trim());
        var email = encodeURIComponent(document.getElementById('login_email').value);
        var password = encodeURIComponent(document.getElementById('login_password').value);
        var timezone = encodeURIComponent(_get_timezone());

        comm100_script_route('?action=login&siteId=' + site_id + '&email=' + email + '&password=' + password
			, function(response) {
			    if(response.success) {
					comm100_cpanel_domain = response.cpanel_domain;
					
					comm100_script_cpanel('?action=login&siteId=' + site_id + '&email=' + email + '&password=' + password,
						function() {
							show_loading();
					        _get_plans(site_id, function (plans) {
					        	if (plans.length == 0) {
					        		alert('Error: no code plan.');
					        	} else {
							        comm100_cpanel_domain = response.cpanel_domain;

							        save_settings(site_id, plans[0].id, decodeURIComponent(email), response.cpanel_domain, response.main_chatserver_domain, response.standby_chatserver_domain);
					        	}
					        });
						}, function(message) {
						    document.getElementById('login_submit_img').style.display = 'none';
						    document.getElementById('login_submit').disabled = false;

						    document.getElementById('login_error_').style.display = '';
						    document.getElementById('login_error_text').innerHTML = message;
						});
			    }
			    else {
			        document.getElementById('login_error_').style.display = '';
			        document.getElementById('login_error_text').innerHTML = response.error;
			    }
			    document.getElementById('login_submit_img').style.display = 'none';
			    document.getElementById('login_submit').disabled = false;
			}, function(message) {
			    document.getElementById('login_submit_img').style.display = 'none';
			    document.getElementById('login_submit').disabled = false;

			    document.getElementById('login_error_').style.display = '';
			    document.getElementById('login_error_text').innerHTML = message;
			});
    }
    function _get_plans(site_id, success, error) {
        comm100_script_cpanel('?action=plans&siteId=' + site_id, function(response) {
            if(response.error) {
                if (typeof error != 'undefined')
                    error('Site Id not exists.');
            } else {
                success(response.response);
            }
        });
    }
    function _get_code(site_id, plan_id, callback) {
        comm100_script_cpanel('?action=code&siteId=' + site_id + '&planId=' + plan_id, function(response) {
            callback(response.response);
        });
    }
    function _get_editions(callback) {
        comm100_script_cpanel('?action=editions', function(response) {
            callback(response.response);
        });
    }
    return {
        register: _register,
        login: _login,
        get_plans: _get_plans,
        get_code: _get_code,
        get_editions: _get_editions
    };
})();




function hide_element(id) {
	document.getElementById(id).style.display = 'none';
}
function show_element(id, display) {
	document.getElementById(id).style.display = display || '';
}
function is_empty(str) {
	return (!str || /^\s*$/.test(str));
}
function is_email(str) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(str);
}
function is_input_empty(input_id) {
	return is_empty(document.getElementById(input_id).value);
}
function is_input_email(input_id) {
	return is_email(document.getElementById(input_id).value);
}
function show_login() {
	hide_element('div_register');
	hide_element('div_loading');
	hide_element('div_settings');
	hide_element('login_error_');

	show_element('div_login');
}
function show_register() {
	hide_element('div_login');
	hide_element('div_loading');
	hide_element('div_settings');
	hide_element('success');
	hide_element('register_error');

	hide_element('register_name_required');
	hide_element('register_email_required');
	hide_element('register_password_required');
	hide_element('register_phone_required');

	show_element('div_register');
}
function show_loading () {
	hide_element('div_login');
	hide_element('div_register');
	hide_element('div_settings');
	hide_element('success');
	
	show_element('div_loading');
}
function save_settings (site_id, plan_id, email, cpanel_domain, main_chatserver_domain, standby_chatserver_domain) {
	document.getElementById('jform_params_siteId').value = site_id;
	document.getElementById('jform_params_email').value = email;
	document.getElementById('jform_params_planId').value = plan_id;

	document.getElementById('jform_params_cpanel_domain').value = cpanel_domain;
	document.getElementById('jform_params_main_chatserver_domain').value = main_chatserver_domain;
	document.getElementById('jform_params_standby_chatserver_domain').value = standby_chatserver_domain;
	
	Joomla.submitbutton('module.apply');
}
function show_settings(site_id, default_plan_id, email) {
	document.getElementById('jform_params_siteId').value = site_id;
	document.getElementById('jform_params_email').value = email;
	document.getElementById('jform_params_planId').value = default_plan_id;

	load_code_plans(site_id, default_plan_id, function (plans) {
		document.getElementById('settings_siteId').innerHTML = site_id;
		document.getElementById('settings_email').innerHTML = email;

		hide_element('div_register');
		hide_element('div_loading');
		hide_element('div_login');

		if (plans && plans.length > 1) {
			show_element('multi_plan');
			hide_element('single_plan');
		} else {
			document.getElementById('a_visitor_monitor').href = 'https://'+comm100_cpanel_domain+'/livechat/visitormonitor.aspx?siteid=' + site_id;
			document.getElementById('a_single_plan_customize').href = 'http://'+comm100_cpanel_domain+'/livechatfunc/codeplan/chatbutton.aspx?siteid=' 
					+ site_id + '&ifeditplan=true&codeplanid=' + plans[0].id;
			show_element('single_plan');
			hide_element('multi_plan');
		}

		show_element("div_settings");
	}, function (error) {
	});

}
function validate_register_input(name) {
	if (is_input_empty("register_" + name)) {
		show_element("register_" + name + "_required");
		return false;
	} else {
		hide_element("register_" + name + "_required");
		return true;
	}
}
function validate_register_input_email(name) {
	if (is_input_empty("register_" + name)) {
		show_element("register_" + name + "_required");
		hide_element("register_" + name + "_valid");
		return false;
	} else if (!is_input_email("register_" + name)) {
		hide_element("register_" + name + "_required");
		show_element("register_" + name + "_valid");
		return false;
	} else {
		hide_element("register_" + name + "_required");
		hide_element("register_" + name + "_valid");
		return true;
	}
}
function validate_register_inputs() {
	var fields = ["name", "password", "phone"];
	var pass = true;

	for (var i = 0, len = fields.length; i < len; i++) {
		if (!validate_register_input(fields[i])) {
			pass = false;
		}
	}

	if (!validate_register_input_email("email")) {
		pass = false;
	}

	return pass;
}

function load_code_plans(site_id, default_plan_id, success_handler, error_handler) {

	comm100_plugin.get_plans(site_id, function(plans){

	    if (plans.length == 0) {
			alert('Error: no code plan.');
			return;
		}

		var list_plans = document.getElementById('list_code_plans');
			list_plans.innerHTML = '';

		document.getElementById('jform_params_planId').value = default_plan_id || plans[0].id;

		for (var i = 0; i < plans.length; i++) {
			var opt = document.createElement('OPTION');
			opt.innerHTML = plans[i].name;
			opt.value = plans[i].id;
			if (default_plan_id == plans[i].id) {
				opt.selected = 'selected';
			}
			list_plans.appendChild(opt);
		};

		if (success_handler) {
			success_handler(plans);
		}
	}, function(error){
		if (error_handler) {
			error_handler(error);
		}
	});
}
function register_click () {
	show_loading();

	var list_editions = document.getElementById('register_edition');
	list_editions.innerHTML = '';
	show_register();
	return false;
}
function reset_settings () {
	document.getElementById('jform_params_siteId').value = '';
	document.getElementById('jform_params_email').value = '';
	document.getElementById('jform_params_planId').value = '';
	document.getElementById('jform_params_cpanel_domain').value = '';
	document.getElementById('jform_params_main_chatserver_domain').value = '';
	document.getElementById('jform_params_standby_chatserver_domain').value = '';

	show_login();
}

function open_customize(plan_id) {
	var site_id = document.getElementById('jform_params_siteId').value;
	window.open('http://'+comm100_cpanel_domain+'/LiveChatFunc/codeplan/chatbutton.aspx?siteId=' + site_id + '&ifEditPlan=true&codePlanId=' 
		+ plan_id);
}

function init(argument) {
	var div_login = document.createElement('DIV');
	div_login.id = 'div_login';
	div_login.innerHTML = 
'<div style="padding-bottom:5px;display:none;" id="login_error_">\
	<div style="border:1px solid #c00;background-color:#ffebe8;margin: 5px 0 15px;padding: 5px;border-radius: 3px;">\
		<b>Error</b>:&nbsp;<span id="login_error_text"></span>\
	</div>\
</div>\
<span style="font-size:1.1em;">Link up to your current Comm100 account</span>\
<table class="form-table">\
	<tr>\
		<td scope="row" style="width: 80px;"><label for="login_site_id" style="font-size:12px;min-width:80px;">Site Id</label></td>\
		<td><input type="text" style="width: 180px;float:none;" name="login_site_id" id="login_site_id">\
            <span>\
                <a href="https://hosted.comm100.com/Admin/ForgotSiteId.aspx" target="_blank" tabindex="-1">Forgot Site Id?</a>\
            </span>\
        </td>\
	</tr>\
	<tr>\
		<td scope="row" style="width: 80px;"><label for="login_email" style="font-size:12px;min-width:80px;">Email</label></td>\
		<td><input type="text" style="width: 180px;float:none;" name="login_email" id="login_email"></td>\
		<td></td>\
	</tr>\
	<tr>\
		<td scope="row" style="width: 80px;"><label for="login_password" style="font-size:12px;min-width:80px;">Password</label></td>\
		<td><input type="password" style="width: 180px;float:none;" name="login_password" id="login_password">\
            <span>\
                <a href="https://www.comm100.com/secure/forgotpassword.aspx" target="_blank" tabindex="-1">Forgot your password?</a>\
            </span>\
        </td>\
	</tr>\
	<tr>\
		<td scope="row" style="width: 80px;"></td>\
		<td>\
			<input onmouseout="this.style.backgroundColor=\'#009999\';" onmouseover="this.style.backgroundColor=\'#00a2a2\';" \
			style="border:none;box-shadow:1px 1px 5px gray;-moz-box-shadow:1px 1px 5px gray;-webkit-box-shadow:1px 1px 5px gray;padding-top:2px;padding-bottom:2px;margin:0px 0px 0px-1px;\
			background-color:#009999;color:white;border-radius:3px;cursor:pointer;" type="button" id="login_submit" name="login_submit" value="Link Up" onclick="comm100_plugin.login();return false;"/><img id="login_submit_img" src="../modules/mod_comm100livechat/images/ajax_loader.gif" title="waitting" style="display:none;"/>\
        </td>\
	</tr>\
</table>\
<div style="font-size:1.1em;padding-top:10px;">Don\'t have Comm100 Account? <a href="javascript:void(0);" onclick="return register_click();">Register Now!</a></div>';
	div_login.cssText = 'display:none;';

	var div_settings = document.createElement('DIV');
	div_settings.id = 'div_settings';
	div_settings.innerHTML = 
'<div id="success" style="display:none;background-color: #E1FDC5;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px; border:solid 1px #6AC611;margin: 5px 0 15px;padding: 5px;">\
    Congratulations! Your Comm100 Live Chat account has been set up successfully.\
</div>\
<table class="form-table">\
  <tr>\
    <td style="font-size: 1.1em;padding-bottom:8px;" >Your Linked Comm100 Account:</td>\
  </tr>\
  <tr>\
    <td scope="row" style="padding-left:30px;">\
    	Site Id:&nbsp;<span style="padding: 10px 0 0 0px;" id="settings_siteId"> </span>\
    </td>\
  </tr>\
  <tr>\
    <td scope="row" style="padding-left:30px;">\
    	Email:&nbsp;<span style="padding: 10px 0 0 0px;" id="settings_email"> </span>\
    </td>\
  </tr>\
  <tr id="multi_plan" style="display:none;">\
    <td scope="row" style="padding:10px 0;">\
    	<span style="font-size:1.1em;line-height:25px;">Select Code Plan:</span><br>\
    	<span style="display:inline;">\
    		<select id="list_code_plans" style="float:none;margin-left:30px;" onchange="document.getElementById(\'jform_params_planId\').value=this.value">\
    		</select><a href="#" style="float:none;" onclick="open_customize(document.getElementById(\'jform_params_planId\').value);return false;">Customize</a>\
    	</span>\
    </td>\
  </tr>\
  <tr id="single_plan" style="display:none;">\
    <td scope="row" style="padding:10px 0;">\
         Now you can <a id="a_visitor_monitor" href="https://hosted.comm100.com/LiveChat/VisitorMonitor.aspx" target="_blank">Get Online & Chat</a> or <a id="a_single_plan_customize" target="_blank" href="#" style="float:none;">customize</a> your live chat styles.\
    </td>\
  </tr>\
  <tr>\
    <td style="font-size: 0.9em;padding-top:20px;" >\
		Something went wrong? <a style="color: #999;" href="javascript:void(0);"\
   		onclick="if (confirm(\'Are you sure you wish to reset your account?\'))reset_settings();">Reset your account</a>.\
    </td>\
  </tr>\
</table>';
	div_settings.cssText = 'display:none;';

	var div_loading = document.createElement('DIV');
	div_loading.id = 'div_loading';
	div_loading.innerHTML = '<img style="float:none;margin:0px;" src="../modules/mod_comm100livechat/images/ajax_loader.gif" title="Please wait..."/>Loading';
	div_loading.cssText = 'display:none;';

	var div_register = document.createElement('DIV');
	div_register.id = 'div_register';
	div_register.innerHTML = 
'<div style="padding-bottom:5px;display:none;" id="register_error">\
	<div style="border:1px solid #c00;background-color:#ffebe8;margin: 5px 0 15px;padding: 5px;-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;">\
		<b>Error</b>:&nbsp;<span id="register_error_text"></span>\
	</div>\
</div>\
<table class="form-table">\
  <tr>\
    <td colspan="2" style="font-size: 1.2em;padding:10px 0;font-weight:bold;" >15 days FREE trial, no credit card required.</td>\
  </tr>\
  <tr style="display:none;">\
    <td scope="row" style="width: 100px;">\
      <label for="register_edition" style="min-width:100px;">Live Chat Edition</label>\
    </td>\
    <td>\
      <input id="register_edition" name="register_edition" value="74" style="width:180px;float:none;margin-right:0px;" />\
      <span style="padding-left:3px;">\
        <a href="http://livechat.comm100.com/featurelist.aspx" target="_blank">Feature Comparison</a>\
      </span>\
    </td>\
  </tr>\
  <tr>\
    <td scope="row" style="width: 100px;">\
      <label for="register_name" style="min-width:100px;">Full Name</label>\
    </td>\
    <td>\
      <input id="register_name" name="register_name" type="text" style="width:180px;float:none;margin-right:0px;"		onblur="validate_register_input(\'name\')" value=""/>\
      <span style="color:red">* </span>\
      <span id="register_name_required" style="color:red;display:none;">Required</span>\
    </td>\
  </tr>\
  <tr>\
    <td scope="row" style="width: 100px;">\
      <label for="register_email" style="min-width:100px;">Email</label>\
    </td>\
    <td>\
      <input id="register_email" name="register_email" type="text" style="width:180px;float:none;margin-right:0px;" onblur="validate_register_input_email(\'email\');" value=""/>\
      <span style="color:red">* </span>\
      <span id="register_email_required" style="color:red;display:none;">Required</span>\
      <span id="register_email_valid" style="color:red;display:none;">Invalid Email</span>\
    </td>\
  </tr>\
  <tr>\
    <td scope="row" style="width: 100px;">\
      <label for="register_password" style="min-width:100px;">Password</label>\
    </td>\
    <td>\
      <input id="register_password" name="register_password" type="password" style="width:180px;float:none;margin-right:0px;" onblur="validate_register_input(\'password\')"/>\
      <span style="color:red">* </span>\
      <span id="register_password_required" style="color:red;display:none;">Required</span>\
    </td>\
  </tr>\
  <tr>\
    <td scope="row" style="width: 100px;">\
      <label for="register_phone" style="min-width:100px;">Telephone</label>\
    </td>\
    <td>\
      <input id="register_phone" name="register_phone" type="text" style="width:180px;float:none;margin-right:0px;" onblur="validate_register_input(\'phone\')" value=""/>\
      <span style="color:red">* </span>\
      <span id="register_phone_required" style="color:red;display:none;">Required</span>\
    </td>\
  </tr>\
  <tr>\
    <td scope="row" style="width: 100px;">\
      <label for="register_website" style="min-width:100px;">Website</label>\
    </td>\
    <td>\
      <input id="register_website" name="register_website" type="text" style="width:180px;float:none;margin-right:0px;" value=""/>\
    </td>\
  </tr>\
  <tr>\
    <th style="width: 100px;"></th>\
    <td>\
      <table style="border-spacing:0px;">\
        <tr>\
          <td>\
            <input onmouseout="this.style.backgroundColor=\'#009999\';" onmouseover="this.style.backgroundColor=\'#00a2a2\';" style="border:none;box-shadow:1px 1px 5px gray;-moz-box-shadow:1px 1px 5px gray;-webkit-box-shadow:1px 1px 5px gray;padding-top:2px;padding-bottom:2px;margin:0px 0px 0px-1px;background-color:#009999;color:white;border-radius:3px;cursor:pointer;" type="button" id="register_submit" name="register_submit" value="Create Account" onclick="if (validate_register_inputs()){comm100_plugin.register();}return false;"/>\
            <img id="register_submit_img" src="../modules/mod_comm100livechat/images/ajax_loader.gif" title="Please wait..." alt="waitting" style="display:none;">		\
          </td>\
          <td>\
            <span id="register_cancel">\
              or <a href="javascript:show_login();">Cancel</a>\
            </span>\
          </td>\
        </tr>\
      </table>\
    </td>\
  </tr>\
  <tr>\
    <th style="width: 100px;"></th>\
    <td>\
      <div style="font-size: smaller;">\
        By clicking "Create Account", you agree to Comm100 <a href="http://hosted.comm100.com/admin/help/Comm100-Agreement.htm" id="aHref" target="_blank">Hosted Service Agreement</a> and <a href="http://www.comm100.com/privacy/" target="_blank">Privacy Policy</a>.\
      </div>\
    </td>\
  </tr>\
</table>';
	div_register.cssText = 'display:none;';

	var site_id = document.getElementById('jform_params_siteId').value;
	var email = document.getElementById('jform_params_email').value;
	var plan_id = document.getElementById('jform_params_planId').value;

	comm100_cpanel_domain = document.getElementById('jform_params_cpanel_domain').value;
	comm100_main_chatserver_domain = document.getElementById('jform_params_main_chatserver_domain').value;
	comm100_standby_chatserver_domain = document.getElementById('jform_params_standby_chatserver_domain').value;

	var label = document.getElementById('jform_params__spacer-lbl');
	label.style.display = 'none';

	label.parentNode.appendChild(div_login);
	label.parentNode.appendChild(div_settings);
	label.parentNode.appendChild(div_loading);
	label.parentNode.appendChild(div_register);

	setTimeout(function () {
		if (site_id == 0) {
			show_login();
		} else {
			show_loading();
			show_settings(site_id, plan_id, email);
		}
	}, 100);
}