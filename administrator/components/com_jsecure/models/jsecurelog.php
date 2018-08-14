<?php
/**
 * jSecure Authentication components for Joomla!
 * jSecure Authentication extention prevents access to administration (back end)
 * login page without appropriate access key.
 *
 * @author      $Author: Ajay Lulia $
 * @copyright   Joomla Service Provider - 2014
 * @package     jSecure3.2
 * @license     http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @version     $Id: jsecurelog.php  $
*/

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );
 class jSecureModeljSecureLog  extends JModelLegacy{
	
	function __construct(){
		parent::__construct();
 	}
 	
 	function getData(){ 		
 		 		
		$app    = &JFactory::getApplication();
		$limit		= $app->getUserStateFromRequest('global.list.limit', 'limit', $app->getCfg('list_limit'), 'int');
		$limitstart	= $app->getUserStateFromRequest('limitstart', 'limitstart', 0, 'int');

		// In case limit has been changed, adjust limitstart accordingly
		$limitstart = ( $limit != 0 ? (floor($limitstart / $limit) * $limit) : 0 );
		$search     = JRequest::getVar('search','');
		if($search){
		if(!strpos("*",$search)){
		$thisip =  explode("*", $search);
		$search     = $thisip[0];
		}
		}
		
		$db = $this->getDBO();
		
		$query = "SELECT * from #__jsecurelog";
		
 	if($search){
			$query .= " Where ip like '%".$search."%'";
		}
		
		if(!empty($this->id))
			$query .= " Where id=".$this->id;
			
		$query .= " ORDER BY id desc"; 
		
		if(!empty($this->id)){
			$db->setQuery( $query );
		} else {
			$db->setQuery( $query,$limitstart,$limit );
		}
		
		$rows = $db->loadObjectList();
		
		return $rows;
 	}
	
	function getLimitList(){
		$search     = JRequest::getVar('search','');
		if($search){
		if(!strpos("*",$search)){
		$thisip =  explode("*", $search);
		$search     = $thisip[0];
		}
		}
		$db = $this->getDBO();
		
		$query = "SELECT * from #__jsecurelog ORDER BY id desc LIMIT 0 , 10 ";
		if($search){
			$query .= " Where ip like '%".$search."%'";
		}
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return $rows;
	}

 	function getTotalList(){
		$search     = JRequest::getVar('search','');
		if($search){
		if(!strpos("*",$search)){
		$thisip =  explode("*", $search);
		$search     = $thisip[0];
		}
		}
		$db = $this->getDBO();
		
		$query = "SELECT * from #__jsecurelog";
		if($search){
			$query .= " Where ip like '%".$search."%'";
		}
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		return count($rows);
	}
	
function autoblockip(){                                          // auto block ip 
        jimport('joomla.filesystem.file');	
		$app        = JFactory::getApplication();
		$option		= JRequest::getVar('option', '', '', 'cmd');
		$post       = JRequest::get( 'post' );
		$basepath   = JPATH_ADMINISTRATOR .'/components/com_jsecure';
		$configFile	= $basepath.'/params.php';
		$xml	    = $basepath.'/com_jsecure.xml';
		$ipview       = $basepath.'/views/autoban/view.html.php';
		require_once($ipview);
		$ipv = new jsecureViewAutoban();
		require_once($configFile);
		if (JFile::exists($configFile)) {
			$content = JFile::read($configFile);
		}
$config	  = new JRegistry('JSecureConfig');
$oldValue = new JSecureConfig();
$date = date("Y-m-d H:i:s");
$interval = $oldValue->abiplist;
$attempts = $oldValue->abiptrylist;


$code = "JSECURE_EVENT_ACCESS_ADMIN_USING_WRONG_KEY";
$oriKey = JRequest::getVar('passkey','');
if( !empty( $oriKey ) )
{
	$code = "JSECURE_EVENT_ACCESS_ADMIN";
}



$db = $this->getDBO();
$query = 'SELECT ip, count(ip) AS `attempts` from `#__jsecurelog` where `ip` = "'.$_SERVER['REMOTE_ADDR'].'" and code = "'. $code .'"  and (date BETWEEN ("'.$date.'" - Interval '.$interval.' MINUTE) AND ("'.$date.'" + Interval '.$interval.' MINUTE))group by ip having  count(`ip`) >= '.$attempts;
$db->setQuery($query);
$rows = $db->loadObjectList(); 
if(empty($rows)){
$ipv->autobanip(null,$oldValue);
}
else{
$ipv->autobanip($rows[0]->ip,$oldValue);
}

}

	function insertLog($code, $change_variables=null){
		$db = $this->getDBO();
		
		$user = JFactory::getUser();
		$userid = $user->id;
		$session = JFactory::getSession();
		$UserIDBeforeLogin = $session->get('LogUserId');
		if($UserIDBeforeLogin != ''){
		$userid = $UserIDBeforeLogin;
		}
		$query = 'INSERT INTO #__jsecurelog(date, ip, userid, code, change_variable) VALUES ("'.date('Y-m-d H:i:s').'", "'.$_SERVER['REMOTE_ADDR'].'", '.$userid.', "'.$code.'", "'.htmlspecialchars($change_variables).'")';

		$db->setQuery($query);
		if($db->query()){
		$session->clear('LogUserId');
		}
		return true;
		
	}

	function deleteLog($month){
		$db = $this->getDBO();
		
		$date =  date('Y-m-d H:i:s',mktime( date('H'), date('i'), date('s'), date('m')-$month, date('d'), date('Y')));
		
		$WHERE =	" WHERE `date` < ' ".$date." '";
		
		$query = "DELETE FROM #__jsecurelog " . $WHERE ;
		
		$db->setQuery($query);
		$db->query();
		
		return true;
	}
	// function to create file for admin password save
	private function makeRandomPassword( $length = 32 )
	{
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;

		while ($i <= $length) {
			$num = rand() % 40;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
					
		return $pass;
	}
	
 public function create_files()
	{
		
        $server =$_SERVER['SERVER_SOFTWARE'];
		$isApache = substr($server,0,6) == 'Apache';
		if($isApache){
	  	$os = strtoupper(PHP_OS);
		
		$isWindows = substr($os,0,3) == 'WIN';

		$salt = $this->makeRandomPassword(2);
		$cryptpw = null;
		//$cryptpw = crypt($this->password, base64_encode($this->password));

		jimport('joomla.filesystem.file');
		if($isWindows) {
			$cryptpw=$this->password;
		}
		else{
			$cryptpw = crypt($this->password, $salt);
		}
		$htpasswd = $this->username.':'.$cryptpw."\n";
		clearstatcache();
		$status = JFile::write(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'.htpasswd', $htpasswd);

		if(!$status){  $app        = JFactory::getApplication();
			$link = "index.php?option=com_jsecure&task=pwdprotect";
			$msg = 'Could not write to the files check permissions.';
			$app->redirect($link, $msg, 'error'); }

		$path = rtrim(JPATH_ADMINISTRATOR,'/\\').DIRECTORY_SEPARATOR;
		$htaccess = <<<ENDHTACCESS
AuthUserFile "$path.htpasswd"
AuthName "Restricted Area"
AuthType Basic
require valid-user
ENDHTACCESS;
		$status = JFile::write(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'.htaccess', $htaccess);

		if(!$status)
		{
			JFile::delete(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'.htpasswd');
		}
		else
		{
			return true;
		}
		}
		else{
			 $app        = JFactory::getApplication();
			$link = "index.php?option=com_jsecure&task=pwdprotect";
			$msg = JText::_( 'APACHE_REQ' );
			$app->redirect($link, $msg, 'error');

		}

	}
	
	public function delete_files()
	{
      	$status = JFile::delete(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'.htaccess');
		if(!$status) return false;
		return JFile::delete(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'.htpasswd');
	}
	public function isFileExist()
	{
		jimport('joomla.filesystem.file');
		return JFile::exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'.htpasswd') && JFile::exists(JPATH_ADMINISTRATOR.DIRECTORY_SEPARATOR.'.htaccess');
	}
	public function purgeSessions()
	{
		$user = JFactory::getUser();
		$username = $user->username;
		$db = $this->getDBO();
        $qry =  "DELETE FROM #__session WHERE username!='".$username."' AND username!=''";
		$db->setQuery($qry);
        $db->query();
		$num_rows = $db->getAffectedRows();
		$db->setQuery('OPTIMIZE TABLE '.$db->quoteName('#__session'));
		$db->query();
		return $num_rows;
	}
	public function checkSafeID()
	{
	  $id = 42;
		// Check if a user with a low ID is present
		$db = $this->getDBO();

		$query = "select COUNT(*) from `#__users` where id < '".$id."'";
		$db->setQuery($query);
		$isuser = $db->loadResult();
		
		if(!$isuser) 
		{ 
			// If now low-ID user exists, check if a user with ID of 42 exists
	
			$query = "SELECT COUNT(*) FROM `#__users` WHERE `id` = ".$id."";
			$db->setQuery($query);
			$defaultuser = $db->loadResult();
			
			if($defaultuser) 
			{ 
				$user = JFactory::getUser($id);
				if($user->block) 
				{
					return false;
				} 
				else 
				{
					return true;
				}
			}
		    else 
			{
				return false;
			}
		}
		else 
		{
		 return false;
		}
	}
	public function changeSuperAdminId($newid=null)
	{
		
		$maxid = 41;
		if(empty($newid)) 
		{
			$newid = rand(1,$maxid);
		}
		// Load the existing user
		$db = $this->getDBO();
		
		$query = " SELECT * FROM `#__users` WHERE `id` = '".($maxid + 1)."'";
		$db->setQuery($query);
		$olduser = $db->loadAssoc();
		
		// Create a copy of the old user's data and update the ID
		$newuser = $olduser;
		$newuser['id'] = $newid;
		// Insert the new user to the database

	    $query = " INSERT INTO `#__users` ";
		$sql = 'INSERT INTO `#__users` ';
		$keys = array(); $values = array();
		foreach($newuser as $k => $v)
		{
			$keys[] = $db->quoteName($k);
			$values[] = $db->Quote($v);
		}
        $query.= "(".implode(', ',$keys).") values (".implode(', ',$values).")";
    	$db->setQuery($query);
		$db->query();
		
		jimport('joomla.database.table.user');
		$userTable = JTable::getInstance('user');
		// Time to promote the new user to a Super Administrator!
		$ugmap = (object)array(
			'user_id'	=> $newid,
			'group_id'	=> 8
		);
		$db->insertObject('#__user_usergroup_map', $ugmap);

		// Reset the old user's password to something stupid and block his access completely!
		jimport('joomla.user.helper');
		$prefix = $this->getState('prefix',null);
		if(empty($prefix)) {
			$prefix = JUserHelper::genRandomPassword(4);
		}
		$password = JUserHelper::genRandomPassword(32);
		$salt = JUserHelper::genRandomPassword(32);
		
		$olduser['username'] = $prefix.'_'.$olduser['username'];
		$olduser['password'] = JUserHelper::getCryptedPassword($password, $salt);
		$olduser['email'] = $prefix.'_'.$olduser['email'];
		$olduser['block'] = 1;
		$olduser['sendEmail'] = 0;
		if($userTable->save($olduser))
		   return true;
		else
		   return false;   
	}
	public function getUserlist()
	{
		$user = JFactory::getUser();
		$username = $user->username;
		$db = $this->getDBO();
		$query = "SELECT * FROM `#__users` WHERE `id` IN (SELECT `user_id` FROM `#__user_usergroup_map` WHERE `group_id` >5)";
		$db->setQuery($query);
        $rows = $db->loadObjectList();
		return $rows;
	}

	public function getComponentname()
	{
		$user = JFactory::getUser();
		$db = $this->getDBO();
        $query = "SELECT  * FROM #__extensions  WHERE `type` = 'component' AND `protected` =0 AND `enabled` =1" ;
		//$query = "SELECT  * FROM #__extensions as t1  Left JOIN #__menu as t2 ON t1.extension_id = t2.component_id WHERE t1.type = 'component' AND t1.protected = 0  AND t2.parent_id = 1";
		$db->setQuery($query);
        $rows = $db->loadObjectList();
		return $rows;
	}
	public function getPassword()
	{
		$user = JFactory::getUser();
		$db = $this->getDBO();
        $query = "SELECT  * FROM #__jsecurepassword" ;
		$db->setQuery($query);
        $rows = $db->loadObjectList();
		return $rows;
	}
    public function getNamecomp($cid)
	{
       $db = $this->getDBO();
        $query = "SELECT  * FROM #__extensions  WHERE `extension_id` = ".$cid;
		$db->setQuery($query);
        $name = $db->loadObjectList();
		return $name;

	}

	function incorrectHits()
	{  
		 $date=date("Y-m-d");
		 $db = JFactory::getDBO();
		 $i=0;
		 $sql="SELECT `incorrect_hits` from `#__jsecure_hits` WHERE `date` = '$date'";
		 $db->setQuery($sql);
		 $hitsearch=$db->loadObjectList();
		  if(isset($hitsearch) and $hitsearch != NULL)
		  { 
		      foreach($hitsearch as $item)
		      {
		       $i=$item->incorrect_hits;
		       $i++;
		      }
		      $sql1="UPDATE `#__jsecure_hits` SET `incorrect_hits` = ".$i." WHERE `date` = '$date'";
		      $db->setQuery($sql1);
		      $db->query();
		  }
		  else
          { 
		     $i++;
		     $sql2 = "INSERT INTO `#__jsecure_hits` (`incorrect_hits`, `date`) VALUES ('$i', '$date')";
		     $db->setQuery($sql2) ;
		     $db->query();
		  }      
	 }
	 
	 function correctHits()
	{  
		 $date=date("Y-m-d");
		 $db = JFactory::getDBO();
		 $i=0;
		 $sql="SELECT `correct_hits` from `#__jsecure_hits` WHERE `date` = '$date'";
		 $db->setQuery($sql);
		 $hitsearch=$db->loadObjectList();
		  if(isset($hitsearch) and $hitsearch != NULL)
		  { 
		      foreach($hitsearch as $item)
		      {
		       $i=$item->correct_hits;
		       $i++;
		      }
		      $sql1="UPDATE `#__jsecure_hits` SET `correct_hits` = ".$i." WHERE `date` = '$date'";
		      $db->setQuery($sql1);
		      $db->query();
		  }
		  else
          { 
		     $i++;
		     $sql2 = "INSERT INTO `#__jsecure_hits` (`correct_hits`, `date`) VALUES ('$i', '$date')";
		     $db->setQuery($sql2) ;
		     $db->query();
		  }      
	 }

	 function insertCaptchaKey($msg,$captchakey){
	
	 $db = JFactory::getDBO();
	 
	 $sql1 = "SELECT Value from #__apikeys where Name='Re-Captcha Secret Key'";
		
	 $db->setQuery($sql1) ;
			
	 $rows = $db->loadObjectList();
	 
	 
	
	 if(isset($rows) and $rows != NULL)
     {	 
	  
	  $sql2="UPDATE `#__apikeys` SET Value = '".$captchakey."' WHERE Name = '$msg'";
	  $db->setQuery($sql2);
	  $db->query();
	 }
	 else{

		$sql = "INSERT INTO `#__apikeys`(`Name`,`Value`) VALUES('$msg','$captchakey')";
	    $db->setQuery($sql) ;
		$db->query();
     }		
	}
	
	
	
	function insertCaptchaDataSiteKey($msg,$captchakey){
	
	 $db = JFactory::getDBO();
	 
	 $sql1 = "SELECT Value from #__apikeys where Name='Re-Captcha Site Key'";
		
	 $db->setQuery($sql1) ;
			
	 $rows = $db->loadObjectList();

	 if(isset($rows) and $rows != NULL)
     {	 
	  
	  $sql2="UPDATE `#__apikeys` SET Value = '".$captchakey."' WHERE Name = '$msg'";
	  $db->setQuery($sql2);
	  $db->query();
	 }
	 else{

		$sql = "INSERT INTO `#__apikeys`(`Name`,`Value`) VALUES('$msg','$captchakey')";
	    $db->setQuery($sql) ;
		$db->query();
     }		
	}

	function getCaptchaKey(){
	
	/*---Code to fetch captcha key from database----*/
		
		 $db = JFactory::getDBO();
		
		 $sql1 = "SELECT Value from #__apikeys where Name='Re-Captcha Secret Key'";
		
		 $db->setQuery($sql1);
				
		 $rows = $db->loadObjectList();
		 
				 
		 return $rows;
		 
		 
		/*---Code to fetch captcha key from database----*/
	
	}

	function getCaptchaDataSiteKey(){
	
	/*---Code to fetch captcha key from database----*/
		
		 $db = JFactory::getDBO();
		
		 $sql1 = "SELECT Value from #__apikeys where Name='Re-Captcha Site Key'";
		
		 $db->setQuery($sql1) ;
				
		 $rows = $db->loadObjectList();
		 
		 
				 
		 return $rows;
		 
		 
		/*---Code to fetch captcha key from database----*/
	
	}

	function getHoneyPotApiKey(){
	
	/*---Code to fetch captcha key from database----*/
		
		 $db = JFactory::getDBO();
		
		 $sql1 = "SELECT Value from #__apikeys where Name='http:BL Access Key'";
		
		 $db->setQuery($sql1);
				
		 $rows = $db->loadObjectList();
		 
				 
		 return $rows;
		 
		 
		/*---Code to fetch captcha key from database----*/
	
	}

	function insertHoneyPotApiKey($msg,$honeyPotApiKey){
	
	$db = JFactory::getDBO();
	 
	 $sql1 = "SELECT Value from #__apikeys where Name='http:BL Access Key'";
		
	 $db->setQuery($sql1) ;
			
	 $rows = $db->loadObjectList();
	 
	 
	
	 if(isset($rows) and $rows != NULL)
     {	 
	  
	  $sql2="UPDATE `#__apikeys` SET Value = '".$honeyPotApiKey."' WHERE Name = '$msg'";
	  $db->setQuery($sql2);
	  $db->query();
	 }
	 else{

		$sql = "INSERT INTO `#__apikeys`(`Name`,`Value`) VALUES('$msg','$honeyPotApiKey')";
	    $db->setQuery($sql) ;
		$db->query();
     }
		
	}
	
	function getSpamIpList(){
	
	/*---Code to fetch spam Ip List from database----*/
		
		 $db = JFactory::getDBO();
		
		 $sql1 = "SELECT spamip from #__spamip";
		
		 $db->setQuery($sql1);
				
		 $rows = $db->loadObjectList();
		 
				 
		 return $rows;
		 
		 
	/*---Code to fetch spam Ip List from database----*/
	
	
	}	
		
}
?>