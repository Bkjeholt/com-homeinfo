<?php
/************************************************************************
Product    : Home info
Date       : 2013-05-21
Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
Contact    : http://joomladev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : controller.php
Version    : 0.6.3
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');


jimport('joomla.application.component.controller');

class HomeInfoController extends JController {
	function display() {
		parent::display();
	}
	
	/**
	 * @param void
	 * @return void
	 * @version 0.6.4
	 */
	public function get_temperature() {

		$sensorId = JRequest::getVar('sensor_id');
		
		$model = $this->getModel('ajaxaccess');
		
		$sensorInfoArray =& $model->getSensorInfo($sensorId);
		
		$resultStr  = '<?xml version="1.0"?>';
		$resultStr .= '<msg ver="1.0">';
		$resultStr .=    '<sample sensor_id="'.$sensorId.'" time="'.$sensorInfoArray['time'].'">';
		$resultStr .=       $sensorInfoArray['data'];
		$resultStr .=    '</sample>';
		$resultStr .= '</msg>';
		
		echo $resultStr;		
	}
	
	function get_sensor_list() {
		$model = $this->getModel('ajaxaccess');
		$sensorListArray =& $model->getSensorList($sensorId);
		
		$resultStr  = '<?xml version="1.0"?>';
		$resultStr .= '<msg ver="1.0">';
		
		foreach ($sensorListArray as $xmlSensor) {
			$resultStr .= $xmlSensor->asXML();
		}
		
		$resultStr .= '</msg>';
		
		echo $resultStr;		
	}
}