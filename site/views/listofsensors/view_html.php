<?php
/************************************************************************
Product    : Home info
Date       : 16 aug 2012
Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/views/listofsensors/view_html.php
Version    : 0.0.1
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HTML View class for the Home information Component
 */
class HomeInfoViewListOfSensors extends JView
{
	// Overwriting JView display method
	function display($tpl = null)
	{
		// Assign data to the view
		$this->xmlSensorInfo = $this->get('getXmlSensors');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		}
		// Display the view
		parent::display($tpl);
	}
}
