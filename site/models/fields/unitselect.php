<?php
/************************************************************************
Product    : Home info
Date       : 2013-02-01
Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/models/fields/sensorselect.php
Version    : 0.5.6
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
class JFormFieldUnitSelect extends JFormFieldList
{
	/**
	 * The field type.
	 *
	 * @var		string
	 */
	protected $type = 'UnitSelect';
	
	/**
	 * 
	 * Enter description here ...
	 * €ndrade frŒn getInput till getOptions 2012-10-10
	 */
	public function getOptions() {
		$classXmlConfig = new HomeInfoHelperXmlConfig();
		$xmlConfig = $classXmlConfig->getInfoTree();
		$listXmlUnit = $xmlConfig->xpath('//units/unit');
		
		$options = array();		
		foreach ($listXmlUnit as $xmlUnit) {
			$options[] = JHtml::_(	'select.option', 
									$xmlUnit['id'],
									$xmlUnit['name'] );
		}
		$options = array_merge(parent::getOptions(), $options);
		
		return $options;		
	}	
}
