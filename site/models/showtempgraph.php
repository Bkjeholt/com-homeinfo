<?php
 /************************************************************************
  Product    : Home info
  Date       : 2012-10-17
  Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
  Contact    : dev@kjeholt.se
  Url        : http://dev.kjeholt.se
  Licence    : ---
  ------------------------------------------------------------------------
  File       : site/models/showtempgraph.php
  Version    : 0.3.4
  Author     : Bjorn Kjeholt
  *************************************************************************/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla model library
jimport( 'joomla.application.component.modelitem' );

require (JPATH_COMPONENT_ADMINISTRATOR .DS. 'helpers'.DS.'database.php');
require (JPATH_COMPONENT_ADMINISTRATOR .DS. 'helpers'.DS.'svggraph.php');

/**
 * Model class for the ShowTempGraph
 */

class HomeInfoModelShowTempGraph extends JModelItem {
	
	var $item;
	
	public function getItem() {
		$showNumberOfDays = $this->getState('message.number_of_days');
		$sensorId = $this->getState('message.sensor_id');
		
		$xmlSvgInfo = homeInfoHelperSvgGraph::getGraph(array($sensorId), (time() - 60*60*24*floatval($showNumberOfDays)), time());
		
		return $xmlSvgInfo;
		
	}
	
	protected function populateState()
	{
		$app = JFactory::getApplication();
		// Get the message id
		$sensorId = JRequest::getInt('sensor_id');
		$numberOfDays = JRequest::getInt('number_of_days');
		$this->setState('message.sensor_id', $sensorId);
		$this->setState('message.number_of_days', $numberOfDays);
		
		// Load the parameters.
		$params = $app->getParams();
		$this->setState('params', $params);
		parent::populateState();
	}
	
	
}