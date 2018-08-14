<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_articles_latest
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
require_once JPATH_SITE.'/components/com_content/helpers/route.php';
JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_content/models', 'ContentModel');

abstract class modSlidertronHelper
{
	public static function getList(&$params)
	{
            $folder = modSlidertronHelper::getFolder($params);                  
            $dir = JPATH_BASE . '/' . $folder;
            $baseUrl = JURI::base() .  str_replace(DIRECTORY_SEPARATOR, '/', $folder);
            //var_dump($dir);
            $slides = array();
            
            if (is_dir($dir))
            {
                //Read Csv file,  first row (header)       
                $i=0; 
               if (($handle = fopen($dir.'/'."slides.csv", "r")) !== FALSE) {                   
                  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) { 
                     // var_dump($data);
                      $pic = trim($data[0]);
                     // var_dump($dir. DS.$pic);
                      if(file_exists($dir. DS. $pic)) {
                         
                       //   var_dump($data[2]);
                          $item = new stdClass();
                          $item->src = $baseUrl."/". $pic;                         
                          $item->link = trim($data[1]);
                          
                          
                          $item->column= $data[2];
                          if(!isset($slides[$i]) ) {
                              $slides[$i] = array();                              
                          }
                          
                          if ($data[2]== '2') {
                              $i++;
                              $slides[$i] = array();     
                              $slides[$i][] =$item;
                              $i++;
                          }else if( count($slides[$i]) < 2) {
                              $slides[$i][] =$item;
                          }else {
                              $i++;
                              $slides[$i] = array();     
                              $slides[$i][] =$item;
                          }
                                                        
                      }
                  }
                    
                  fclose($handle);
               }
                    
            }
                       
            return $slides;
	}
        
        static function getFolder(&$params)
	{
		$folder	= $params->get('folder');

		$LiveSite	= JURI::base();

		// if folder includes livesite info, remove
		if (JString::strpos($folder, $LiveSite) === 0) {
			$folder = str_replace($LiveSite, '', $folder);
		}
		// if folder includes absolute path, remove
		if (JString::strpos($folder, JPATH_SITE) === 0) {
			$folder= str_replace(JPATH_BASE, '', $folder);
		}
		$folder = str_replace('\\', DIRECTORY_SEPARATOR, $folder);
		$folder = str_replace('/', DIRECTORY_SEPARATOR, $folder);

		return $folder;
	}
}
