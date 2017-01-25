<?php
 /************************************************************************
 Product    : Home info
 Date       : 2013-02-02
 Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
 Contact    : dev@kjeholt.se
 Url        : http://dev.kjeholt.se
 Licence    : ---
 ------------------------------------------------------------------------
 File       : site/controllers/adminsensors.php
 Version    : 0.5.6
 Author     : Bjorn Kjeholt
 *************************************************************************/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Include dependancy of the main controllerform class
jimport('joomla.application.component.controllerform');

class HomeInfoControllerAdminSensors extends JControllerForm
{

	public function getModel($name = '', $prefix = '', $config = array('ignore_request' => true))
	{
		return parent::getModel($name, $prefix, array('ignore_request' => false));
	}

	public function submit()
	{
		// Check for request forgeries.
		JRequest::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app    = JFactory::getApplication();
		$model  = $this->getModel('addsensor');

		// Get the data from the form POST
		$data = JRequest::getVar('jform', array(), 'post', 'array');

		// Now update the loaded data to the database via a function in the model
		$upditem        = $model->updItem($data);

		// check if ok and display appropriate message.  This can also have a redirect if desired.
		if ($upditem) {
			echo "<h2>The added/updated sensor information is stored</h2>";
		} else {
			echo "<h2>The sensor storage failed.</h2>";
		}

		return true;
	}

}
