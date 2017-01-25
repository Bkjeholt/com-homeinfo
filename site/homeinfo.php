<?php
/************************************************************************
 Product    : Home control
 Date       : 2013-05-22
 Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
 Contact    : dev@kjeholt.se
 Url        : http://dev.kjeholt.se
 Licence    : ---
 ---------------------------------------------------------
 File       : site/homecontrol.php
 Version    : 0.6.3
 Author     : Bjorn Kjeholt
 *************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_COMPONENT.DS.'controller.php');

// import joomla controller library
jimport('joomla.application.component.controller');
jimport('joomla.html.html');
 
JHtml::addIncludePath( JPATH_COMPONENT_ADMINISTRATOR .DS. 'helpers');

/*
 * Get the JavaScript functions useful for this module
 */
JHtml::_('behavior.framework', true);
$document = JFactory::getDocument();
$document->addScript('/media/com_homeinfo/js/sensors0.6.3.js');

// Get an instance of the controller prefixed by HelloWorld
$controller = JController::getInstance('HomeInfo');
 
// Perform the Request task
$controller->execute(JRequest::getCmd('task'));
 
// Redirect if set by the controller
$controller->redirect();
