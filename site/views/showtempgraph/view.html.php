<?php
/************************************************************************
 Product    : Home info
 Date       : 2012-10-17
 Copyright  : Copyright (C) 2011 Kjeholt Engineering. All rights reserved.
 Contact    : dev@kjeholt.se
 Url        : http://dev.kjeholt.se
 Licence    : ---
 ---------------------------------------------------------
 File       : site/views/showtempgraph/view.html.php
 Version    : 0.3.3
 Author     : Bjšrn Kjeholt
 *************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

jimport( 'joomla.application.component.view' );

/**
 * 
 */
class HomeInfoViewShowTempGraph extends JView {
	
//	var $xmlView;
//	var $xmlInternalInfo;
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
		
		$this->xmlSvgInfo = $this->get('Item');
		
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
	
	private function getTempGraph() {
		
	}
}