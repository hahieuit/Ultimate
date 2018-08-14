<?php
/*------------------------------------------------------------------------



# mod_endofslidebox module



# ------------------------------------------------------------------------



# author    WebKul



# copyright Copyright (C) 2010 webkul.com. All Rights Reserved.



# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL



# Websites: http://www.webkul.com



# Technical Support:  Forum - http://www.webkul.com/index.php?Itemid=86&option=com_kunena



-------------------------------------------------------------------------*/



// no direct access

defined('_JEXEC') or die;

require_once JPATH_SITE . '/components/com_content/helpers/route.php';
abstract class modSlideboxHelper
{
	public static function getList($params)
	{
		
		$db			= JFactory::getDbo();
		$app		= JFactory::getApplication();
		$user		= JFactory::getUser();
		$userId		= (int) $user->get('id');
		$count		= intval($params->get('count', 5));
		$groups		= implode(',', $user->getAuthorisedViewLevels());
		$date		= JFactory::getDate();
		
		$option		= JRequest::getCmd('option');
		$view		= JRequest::getCmd('view');

		$temp		= JRequest::getString('id');
		$temp		= explode(':', $temp);
		$id			= $temp[0];

		$nullDate	= $db->getNullDate();
		//$now		= $date->toMySQL();
				
		$now2		= date("Y-m-d H:i:s");  
		$now		= date("Y-m-d H:i:s", strtotime("$now2 + 4 hours"));


		//echo $now; exit;
		$related	= array();
		$query		= $db->getQuery(true);
		
		$matchkey		= $params->get('matchkey');
		$matchCategory		= $params->get('matchcategory');
		$catid		=	 $params->get('catid');
		
		if (1==1 || ($option == 'com_content' && $view == 'article' && $id)){
	
			// select the meta keywords from the item
			$query->select('metakey');
			$query->from('#__content');
			$query->where('id = ' . (int) $id);
			$db->setQuery($query);
			$metakey = trim($db->loadResult());	
			
			if ($metakey || $catid || $matchCategory || $matchkey){
				// explode the meta keys on a comma
				$keys = explode(',', $metakey);
				$likes = array ();
				// assemble any non-blank word(s)
				foreach ($keys as $key){
					$key = trim($key);
					if ($key) {
						$likes[] = ',' . $db->getEscaped($key) . ','; // surround with commas so first and last items have surrounding commas
					}
				}

				if ((count($likes)) || ($matchCategory)){	
				
					if (is_array($catid)){				
						if ($matchCategory) {
							$matchCategoryCondition = ' OR a.catid IN (' . implode(',', $catid ) . ') ';
						}				
					}else {				
						if ($matchCategory) {
							$matchCategoryCondition = ' OR a.catid = ' . $catid ;
						}	 					
					}
				

					if ($matchkey) {

						$keyword = ' CONCAT(",", REPLACE(a.metakey,", ",","),",") LIKE "%'.	implode('%" OR CONCAT(",", REPLACE(a.metakey,", ",","),",") LIKE "%', $likes).'%"';

					}else { 

						$keyword = ' 1 = 2 '; // just as a placeholder (so our AND's and OR's still work)

					}
					// select other items based on the metakey field 'like' the keys found
					$query->clear();
					$query->select('a.id');
					$query->select('a.title');
					$query->select('a.introtext');
					$query->select('DATE_FORMAT(a.created, "%Y-%m-%d") as created');
					$query->select('a.catid');
					$query->select('cc.access AS cat_access');
					$query->select('cc.published AS cat_state');
					$query->select('CASE WHEN CHAR_LENGTH(a.alias) THEN CONCAT_WS(":", a.id, a.alias) ELSE a.id END as slug');
					$query->select('CASE WHEN CHAR_LENGTH(cc.alias) THEN CONCAT_WS(":", cc.id, cc.alias) ELSE cc.id END as catslug');
					$query->from('#__content AS a');
					$query->leftJoin('#__content_frontpage AS f ON f.content_id = a.id');
					$query->leftJoin('#__categories AS cc ON cc.id = a.catid');
					$query->where('a.id != ' . (int) $id);
					$query->where('a.state = 1');
					$query->where('a.access IN (' . $groups . ')');
					$query->where($keyword.($matchCategory ? $matchCategoryCondition : '')); //remove single space after commas in keywords)
					$query->where('(a.publish_up = '.$db->Quote($nullDate).' OR a.publish_up <= '.$db->Quote($now).')');
					$query->where('(a.publish_down = '.$db->Quote($nullDate).' OR a.publish_down >= '.$db->Quote($now).') order by rand()');
					
					// Filter by language
					if ($app->getLanguageFilter()) {
						$query->where('a.language in (' . $db->Quote(JFactory::getLanguage()->getTag()) . ',' . $db->Quote('*') . ')');
					}

					$db->setQuery($query,0,$count);
					$temp = $db->loadObjectList();

					if (count($temp))
					{
						foreach ($temp as $row)
						{
							if ($row->cat_state == 1)
							{
								$row->route = JRoute::_(ContentHelperRoute::getArticleRoute($row->slug, $row->catslug));
								$related[] = $row;
							}
						}
					}
					unset ($temp);
				}
			}
		}
		//print_r($related); exit;
		return $related;
	}
}
