<?php
/************************************************************************
Product    : Home info
Date       : 2013-02-01
Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/models/homeinfo.php
Version    : 0.5.6
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Include dependancy of the main model form
jimport('joomla.application.component.modelform');
// import Joomla model library
jimport( 'joomla.application.component.modelitem' );
// Include dependancy of the dispatcher
jimport('joomla.event.dispatcher');

/**
 * Model class for the Home Information Component
 */
require (JPATH_COMPONENT_ADMINISTRATOR .DS. 'helpers'.DS.'sensordata.php');
require (JPATH_COMPONENT_ADMINISTRATOR .DS. 'helpers'.DS.'xmlconfig.php');

class HomeInfoModelAdminSensors extends JModelForm
{
	
	protected $item;
	
	protected $classSensorData;
	protected $classXmlConfig;
	/**
	 * 
	 * @var SimpleXMLElement
	 */
	protected $xmlConfig;
	protected $flag_xmlConfigPopulatedWithSensorData;
	
	function __construct($debug=false) {
		$this->classSensorData = new HomeInfoHelperSensorData($debug);
		$this->classXmlConfig = new HomeInfoHelperXmlConfig($debug);
		$this->xmlConfig = $this->classXmlConfig->getInfoTree();
		
		return parent::__construct();
	}

	/**
	 * Get the data for a new qualification
	 */
	public function getForm($data = array(), $loadData = true)
	{
	
		$app = JFactory::getApplication('site');
	
		// Get the form.
		$form = $this->loadForm('com_homeinfo.addsensor', 
								'addsensor', 
								array('control' => 'jform', 'load_data' => true));
		if (empty($form)) {
			return false;
		}
		return $form;
	
	}
	
	/**
	 * Get the message
	 * @return object The message to be displayed to the user
	 */
	function &getItem()
	{
	
		if (!isset($this->_item))
		{
			$cache = JFactory::getCache('com_helloworld', '');
			$id = $this->getState('helloworld.id');
			$this->_item =  $cache->get($id);
			if ($this->_item === false) {
	
			}
		}
		return $this->_item;
	
	}
	
	public function updItem($data)
	{
		// set the variables from the passed data
		$sensorId = $data['id'];
		
		$id = $data['id'];
		$greeting = $data['greeting'];
	
		// set the data into a query to update the record
		$db             = $this->getDbo();
		$query  = $db->getQuery(true);
		$query->clear();
		$query->update(' #__helloworld ');
		$query->set(' greeting = '.$db->Quote($greeting) );
		$query->where(' id = ' . (int) $id );
	
		$db->setQuery((string)$query);
	
		if (!$db->query()) {
			JError::raiseError(500, $db->getErrorMsg());
			return false;
		} else {
			return true;
		}
	}
	
	
	
	
	/*
	 * See the document 'docs/internalInfo.xml' for a detailed description of 
	 * the XML-structure
	 */
	
	/**
	 * @return array of SimpleXMLElement
	 * @version 0.5.6
	 */
	public function getSensors() {
		if (!isset($this->xmlConfig)) {
				
			$this->xmlConfig = $this->classXmlConfig->getInfoTreeWithData();
			$this->flag_xmlConfigPopulatedWithSensorData = true;
		}
		$listXmlSensor = $this->xmlConfig->xpath('//sensors/sensor');
		return $listXmlSensor;
		
	}
		
	/**
	 * Method to auto-populate the model state.
	 *
	 * This method should only be called once per instantiation and is designed
	 * to be called on the first call to the getState() method unless the model
	 * configuration flag to ignore the request is set.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @return	void
	 * @since	1.6
	 */
	protected function populateState() 
	{
		$app = JFactory::getApplication();
		// Get the message id
		$id = JRequest::getInt('figure_id');
		$this->setState('message.figure_id', $id);
 
		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
		parent::populateState();
	}
 
}

/**
 * UpdHelloWorld Model
 */
class HelloWorldModelUpdHelloWorld extends JModelForm
{
	/**
	 * @var object item
	 */
	protected $item;

}
