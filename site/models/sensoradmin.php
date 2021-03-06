<?php
/************************************************************************
Product    : Home info
Date       : 2013-01-25
Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/models/sensoradmin.php
Version    : 0.5.3
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla model library
jimport( 'joomla.application.component.modelitem' );

/**
 * Model class for the Home Information Component
 */
require (JPATH_COMPONENT_ADMINISTRATOR .DS. 'helpers'.DS.'xmlconfig.php');
//require (JPATH_COMPONENT_ADMINISTRATOR .DS. 'helpers'.DS.'error.php');

class HomeInfoModelShowSensors extends JModelItem
{
	
	protected $item;
	
	/**
	 * @var SimpleXMLElement
	 */
	protected $xmlConfig;
	protected $classXmlConfig;
	
	function __construct($debug=false) {
		;
		$this->classXmlConfig = new HomeInfoHelperXmlConfig($debug);
		
		return parent::__construct();
	}
	/*
	 * See the document 'docs/internalInfo.xml' for a detailed description of 
	 * the XML-structure
	 */
	public function getItem() {
		if (!isset($this->xmlConfig)) {
		$this->xmlConfig = $classXmlConfig->getListOfDestinations();
			
//			echo "<p>getItem = " . htmlspecialchars($this->item->asXML()) . "</p>";
		}
		
		return $this->xmlConfig;
	}

	public function getSensorList() {
		
	}
	
	public function add() {
		
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
 
	/**
	 * Method to get the 
	 * 
	 * @param	int		$figureId
	 * 
	 * @return	SimpleXMLElement
	 * 	<view>
	 * 		<figure id=$figureId name="xxxx">
	 * 			
	 * 		</figure>
	 * 	</view>
	 */
	
	public function getFigureItem() {
		
		$strSearch = array();
		$strReplace = array();

		if (!isset($this->item)) {
//			echo "<comment><h3>HomeInfoModelHomeInfo::getFigureItem</h3>
//				this->item not set</comment>";
			
			$this->item = HomeInfoHelperDatabase::getInfoTree($getData=true);
		}
		$figureId = $this->getState('message.figure_id');
		
//echo "<comment><h3>HomeInfoModelHomeInfo::getFigureItem</h3>
//		xmlInternalInfo = " . htmlspecialchars($this->item->asXML())."</comment>";

		$xmlIntFigArray = $this->item->xpath('//figures/figure[@id="' . $figureId . '"]');

		$viewSvg = false;
		
		foreach ($xmlIntFigArray as $xmlIntFig) {
			$xmlIntFigSensorArray = $xmlIntFig->xpath('//references/reference');
//echo "<comment><h3>HomeInfoModelHomeInfo::getFigureItem</h3>
//		<p>xmlIntFig = " . htmlspecialchars($xmlIntFig->asXML())."</p></comment>";
			
			foreach ($xmlIntFigSensorArray as $xmlIntFigSensor) {
				$data = "---";
				
				$sensorDataArray = HomeInfoHelperDatabase::getSensorData();
/*					
				foreach (($this->item->xpath('//sensor[@id="'. $xmlIntFigSensor['sensorid'] .'"]/data')) as $xmlSensorData) {
					$data = (string) $xmlSensorData;
				}
*/
				$strSearch[] = (string) $xmlIntFigSensor;
				$strReplace[] = $data;
			}

			$xmlViewSvg = new SimpleXMLElement($xmlIntFig['url'], NULL, true);
			$xmlViewSvgMod = new SimpleXMLElement(str_replace($strSearch, $strReplace, $xmlViewSvg->asXML()));
			
			$viewSvg = array(
							'figid'=>$figureId,
							'name'=>$xmlIntFig['name'],
							'url'=>$xmlIntFig['url'],
							'xml_svg'=>$xmlViewSvgMod );
		}
		
		return $viewSvg;
	}
	
	/**
	 * 
	 */
	
	public function getTempGraph() {
/*		if (!isset($this->item)) {
				
			$this->item = HomeInfoHelperDatabase::getInfoTree($getData=true);
		}
*/		
		$xmlSvgInfo = homeInfoHelperSvgGraph::getGraph(array(3,4), (time() - 60*60*24*7), time());

		return $xmlSvgInfo;
	}

/*
	private function createGraph($xMin, $xMa) {
		$xmlSvg = new SimpleXMLElement('<svg xmlns="http://www.w3.org/2000/svg" version="1.1"></svg>');
		$xmlSvgYaxis = $xmlSvg->addChild('line');
		$xmlSvgYaxis->addAttribute('x1', 30);
		$xmlSvgYaxis->addAttribute('y1', 30);
		$xmlSvgYaxis->addAttribute('x2', 30);
		$xmlSvgYaxis->addAttribute('y2', 450);
		$xmlSvgYaxis->addAttribute('style', "stroke:rgb(255,0,0);stroke-width:2");

		$xmlSvgXaxis = $xmlSvg->addChild('line');
		$xmlSvgXaxis->addAttribute('x1', 30);
		$xmlSvgXaxis->addAttribute('y1', 450);
		$xmlSvgXaxis->addAttribute('x2', 610);
		$xmlSvgXaxis->addAttribute('y2', 450);
		$xmlSvgXaxis->addAttribute('style', "stroke:rgb(255,0,0);stroke-width:2");
		
		return $xmlSvg;
	}
	*/
}

