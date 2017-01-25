<?php
/************************************************************************
Product    : Home info
Date       : 2013-05-28
Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/models/listofsensors.php
Version    : 0.6.3
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla modelitem library
jimport('joomla.application.component.modelitem');

require_once JPATH_COMPONENT_ADMINISTRATOR .DS. 'helpers'.DS.'xmlconfig.php';

/**
 * ListOfSensors Model
 */
class HomeInfoModelListOfSensors extends JModelItem {
	
	/**
	 * format:
	 * <group id="xx" name="xxxxxx">
	 * 		<sensor id="xx" 
	 * 				name="xxxxxx" 
	 * 				sensor_type="sample|ackumulated" 
	 * 				data_type="float|binary"
	 * 				source_type="device|calculated|undef">
	 * 			<alloc since="xxxxxx" offset="x.x" koef="x.x">
	 * 				<device id="xx"
	 * 						name="xxxxxxx" 
	 * 						device_type="sample|ackumulated" 
	 * 						data_type="float|binary">
	 * 					<path>temperature</path>
	 * 					<info param="xxxxx">xxxxxx</info>
	 * 					<info param="type">xxxxx</info>
	 * 				</device>	
	 * 			</alloc>
	 * 			<calc type="xxxx">
	 * 				<subsensor sensorid="xxx">
	 * 					<info param="xxxxx">xxxxxx</info>
	 *				</subsensor>
	 *				<subsensor sensorid="xxx"/>
	 *			</calc>
	 *			<data time="xxxxxx">xxxxx</data>
	 * 		</sensor>
	 * </group>
	 * @var SimpleXMLElement
	 */
	protected $xmlSensors;
	/**
	 * @var ArrayObject item
	 */
	protected $item;
 
	public function getXmlSensors() {
		$classXmlConfig = new HomeInfoHelperXmlConfig($debug);
		$xmlConfig = $classXmlConfig->getInfoTree();

		$this->xmlSensors = new SimpleXMLElement('<sensorlist ver="1.0"/>');
		
		
		/*
		 * Get list of groups
		 */
		
		$listOfGroups = array();
		
		if (($listOfGroups = $xmlConfig->xpath('//sensorgroups/group')) !== false) {
			foreach ($listOfGroups as $xmlSrcGroup) {
				$xmlGroup = $this->xmlSensors->addChild('group');
				$xmlGroup->addAttribute('id',$xmlSrcGroup['id']);
				$xmlGroup->addAttribute('name',$xmlSrcGroup['name']);
				
				$this->getGroups(&$xmlGroup, $xmlSrcGroup->xpath('sensor'));	
			}
		} else {
			// No groups defined, create one default group

			$xmlGroup = $this->xmlSensors->addChild('group');
			$xmlGroup->addAttribute('id','0');
			$xmlGroup->addAttribute('name','Default');

			$this->getGroups(&$xmlGroup, $xmlConfig->xpath('//sensor'));
		}
		
		/*
		 * Get latest stored data for each of the sensors
		 */
		
		$listOfSensors = $this->xmlSensors->xpath('//group/sensor');
		
		foreach ($listOfSensors as $xmlSensor) {
			/*
			 * Get data based on the sensor_id and data_type
			 */
			$dataValue ='TBD';
			$dataTime  = time();
			
			$xmlData = $xmlSensor->addChild('data', $dataValue);
			$xmlData->addAttribute('time', $dataTime);
		}

		return $xmlSensors;
	}
	
	protected function getGroups(&$xmlGroup, $listOfSensors) {
		
	}
}
