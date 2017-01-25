<?php
/************************************************************************
 Product    : Home info
 Date       : 2013-05-20
 Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
 Contact    : dev@kjeholt.se
 Url        : http://dev.kjeholt.se
 Licence    : ---
 ---------------------------------------------------------
 File       : site/models/ajaxaccess.php
 Version    : 0.6.4
 Author     : Bjorn Kjeholt
 *************************************************************************/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla model library
jimport( 'joomla.application.component.modelitem' );

require_once JPATH_COMPONENT_ADMINISTRATOR .DS. 'helpers'.DS.'xmlconfig.php';
// JLoader::register('HomeInfoHelperError', dirname(__FILE__) . DS . 'helpers' . DS . 'error.php');
// JLoader::register('HomeInfoHelperXmlConfig', dirname(__FILE__) . DS . 'helpers' . DS . 'xmlconfig.php');

class HomeInfoModelAjaxAccess extends JModelItem {
	
	
	/**
	 *
	 * @param int $sensorId
	 * @param string $sensorType One of the three sensor types 'sample', 'ackumulated' or 'binary'
	 * @return array('time'=>int,'data'=>float|boolean value)
	 * @version 0.6.4
	 */
	public function getSensorInfo($sensorId) {
		$db =& JFactory::getDBO();

		
		switch ($this->getSensorType($sensorId)) {
			case 'sample':
				$dataType = 'float';
				break;
		
			case 'ackumulated':
				$dataType = 'float';
				break;
		
			case 'binary':
				$dataType = 'bool';
				break;
				
			default:
				$dataType = 'float';
				break;
		}
			
		$query = "
			SELECT		`time` AS `time`,
						`data` AS `data`
			FROM		`#__hi_data_" . $dataType . "`
			WHERE		(`sensor_id` = '" . $sensorId . "')
			ORDER BY	`time` DESC
			LIMIT 		0,1 ";
		$db->setQuery($query);
		$db->query();
		
			//		echo "Query = $query\n";
		
		if (($sensorDataInfoArray = $db->loadAssocList()) != null) {
			$sensorDataInfo = array();
			$sensorDataInfo['data'] = floatval($sensorDataInfoArray[0]['data']);
			$sensorDataInfo['time'] = floatval($sensorDataInfoArray[0]['time']);
			
			return $sensorDataInfo;
		} else {	
			return false;
		}
	}
	
	public function getSensorList() {
		$xmlConfigClass = new HomeInfoHelperXmlConfig();
		$xmlConfig = $xmlConfigClass->getInfoTree();
	
		$sensorListArray = $xmlConfig->xpath('//sensors/sensor');
	
		return $sensorListArray;
	}
	
	private function getSensorType($sensorId) {
		return "sample";
	}
}

