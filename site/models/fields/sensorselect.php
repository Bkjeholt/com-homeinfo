<?php
/************************************************************************
Product    : Home info
Date       : 2013-01-27
Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/models/fields/sensorselect.php
Version    : 0.5.3
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import the list field type
jimport('joomla.form.formfield');
 
require (JPATH_ADMINISTRATOR.DS.'components'.DS.'com_homeinfo'.DS.'helpers'.DS.'xmlconfig.php');

/**
 * HomeInfo Form Field class for the HomeInfo component
 */
class JFormFieldSensorSelect extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'SensorSelect';
	
	/**
	 * 
	 * Enter description here ...
	 * €ndrade frŒn getInput till getOptions 2012-10-10
	 */
	public function getOptions() {
		$classXmlConfig = new HomeInfoHelperXmlConfig();
		$xmlConfig = $classXmlConfig->getInfoTree();
		$xmlSensorArray = $xmlConfig->xpath('//sensors/sensor');
		
		$options = array();		
		foreach ($xmlSensorArray as $xmlSensor) {
			$options[] = JHtml::_(	'select.option', 
									$xmlSensor['id'],
									$xmlSensor['name'] );
		}
		$options = array_merge(parent::getOptions(), $options);
		
		return $options;		
	}	
}
