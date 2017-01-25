<?php
/************************************************************************
 Product    : Home info
 Date       : 2013-02-01
 Copyright  : Copyright (C) 2011 Kjeholt Engineering. All rights reserved.
 Contact    : dev@kjeholt.se
 Url        : http://dev.kjeholt.se
 Licence    : ---
 ---------------------------------------------------------
 File       : site/views/adminsensors/view.html.php
 Version    : 0.5.6
 Author     : Bjorn Kjeholt
 *************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view' );

/**
 * 
 * @author UABBJOM
 *
 */
class HomeInfoViewAdminSensors extends JView {
	
	var $xmlView;
	var $xmlInternalInfo;
	var $svgArray;
	/**
	 * 
	 * @var SimpleXMLElement
	 */
	var $xmlSvgInfo;


	function display($tpl = null) {
		/*
		 * 
		 */

		
		$this->xmlSvgInfo = $this->get('TempGraph');
		
//		echo "<comment>xmlSvgInfo = " . htmlspecialchars($this->xmlSvgInfo->asXML()) . "</comment>";
		$this->svgArray = $this->get('FigureItem');
		/*
		 * 
		 */
		$item = $this->get('Item');
		
		$this->xmlInternalInfo = $item;
		
		$this->xmlView = new SimpleXMLElement('<view/>');
		$xmlViewSensors = $this->xmlView->addChild('sensors');
		
		$xmlSensorArray = $item->xpath("//sensor");
		foreach ($xmlSensorArray as $xmlSensor) {
			/*
			 * Catch sensor information
			 */
			$xmlViewSensor = $xmlViewSensors->addChild('sensor');
			$xmlViewSensor->addAttribute('id', $xmlSensor['id']);
			$xmlViewSensor->addAttribute('name', $xmlSensor['name']);
			$xmlViewSensor->addAttribute('type', $xmlSensor['type']);
			/*
			 * Catch sensor data
			 */	
			foreach ($xmlSensor->data as $xmlData) {
				$xmlViewSensor->addAttribute('data', (string) $xmlData);
			}
			/*
			 * Catch unit names if applicable
			 */
			
			
			if (isset($xmlSensor['unit'])) {
				$xmlUnitList = $this->xmlInternalInfo->xpath('//units/unit[@id="' . $xmlSensor['unit'] . '"]');
				if ($xmlUnitList != null) {
					$xmlUnit = $xmlUnitList[0];
					$xmlViewSensor->addAttribute('unitname',$xmlUnit['name']);
				}
			}
			
			/*
			 * Catch sensor related device information
			 */
			
			$xmlAllocArray = $item->xpath('//alloc[@sensorid="' . $xmlSensor['id'] . '"]/parent::*');
			foreach ($xmlAllocArray as $xmlAllocParent) {
				if (($xmlAllocParent->getName()) == 'device') {
					/*
					 * The parent is a single device
					*/
					$deviceId = $xmlAllocParent['id'];
					$deviceName = $xmlAllocParent['name'];
					$validSince = $xmlAllocParent['since'];
					$validUntil = $xmlAllocParent['until'];
				} else {
					/*
					 * The parent is a sub device
					*/
					$xmlAllocDevArray = $xmlAllocParent->xpath('parent::*');
					$xmlAllocDev = $xmlAllocDevArray[0];
					
					$deviceId = $xmlAllocDev['id'];
					$deviceName = $xmlAllocDev['name'] . ':' . $xmlAllocParent['id'];
					$validSince = $xmlAllocParent['since'];
					$validUntil = $xmlAllocParent['until'];
				}
				$xmlViewAllocDevice = $xmlViewSensor->addChild('device');
				$xmlViewAllocDevice->addAttribute('id', $deviceId);
				$xmlViewAllocDevice->addAttribute('name', $deviceName);
				$xmlViewAllocDevice->addAttribute('since', $validSince);
				$xmlViewAllocDevice->addAttribute('until', $validUntil);
			}
		}

		parent::display($tpl);
	}

	function getToolbar() {
		// add required stylesheets from admin template
		$document    = & JFactory::getDocument();
		$document->addStyleSheet('administrator/templates/system/css/system.css');
		//now we add the necessary stylesheets from the administrator template
		//in this case i make reference to the bluestork default administrator template in joomla 1.6
		$document->addCustomTag(
				'<link href="administrator/templates/bluestork/css/template.css" rel="stylesheet" type="text/css" />'."\n\n".
				'<!--[if IE 7]>'."\n".
				'<link href="administrator/templates/bluestork/css/ie7.css" rel="stylesheet" type="text/css" />'."\n".
				'<![endif]-->'."\n".
				'<!--[if gte IE 8]>'."\n\n".
				'<link href="administrator/templates/bluestork/css/ie8.css" rel="stylesheet" type="text/css" />'."\n".
				'<![endif]-->'."\n".
				'<link rel="stylesheet" href="administrator/templates/bluestork/css/rounded.css" type="text/css" />'."\n"
		);
		//load the JToolBar library and create a toolbar
		jimport('joomla.html.toolbar');
		$bar =& new JToolBar( 'toolbar' );
		//and make whatever calls you require
		$bar->appendButton( 'Standard', 'save', 'Save', 'savetask', false );
		$bar->appendButton( 'Separator' );
		$bar->appendButton( 'Standard', 'cancel', 'Cancel', 'canceltask', false );
		//generate the html and return
		return $bar->render();
	}
	
}