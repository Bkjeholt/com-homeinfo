<?php
/************************************************************************
Product    : Home info
Date       : 2013-04-25
Copyright  : Copyright (C) 2012-2013 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : cli/ajax_sensors.php
Version    : 0.6.2
Author     : Bjorn Kjeholt
*************************************************************************/
 
/*
 * init Joomla Framework
*/

define( '_JEXEC', 1 );
define( 'DS', DIRECTORY_SEPARATOR );
define( 'JPATH_BASE', realpath(dirname(__FILE__).DS.'..'.DS.'..' ));

require_once ( JPATH_BASE.DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );

// Define the search path to the component declaration and class files

define( 'JPATH_ADMINISTRATOR_COMPONENT_PATH', JPATH_ADMINISTRATOR . DS .
												'components' . DS .
												'com_homeinfo' );

define( 'JPATH_ADMINISTRATOR_INCLUDES_PATH', JPATH_ADMINISTRATOR_COMPONENT_PATH . DS .
		'includes' );

define( 'JPATH_ADMINISTRATOR_HELPER_PATH', JPATH_ADMINISTRATOR_COMPONENT_PATH . DS .	
												'helpers' );

define( 'JPATH_ADMINISTRATOR_CONSTANT_PATH', JPATH_ADMINISTRATOR_COMPONENT_PATH . DS .
		'includes' );

require_once ( JPATH_ADMINISTRATOR_INCLUDES_PATH .DS. 'cli_include.php');
require_once ( JPATH_ADMINISTRATOR_HELPER_PATH .DS. 'ajaxServer.php');

$mainframe = JFactory::getApplication('site');

/*
 * -------------------------------------------------------------------------------
 * Client                                                        Server
 *               ------------------------------------------>
 *                    sensor_id='xxx'    
 *               <------------------------------------------
 *                    'xml stream'    
 *                    
 */

/*
 * check for clean input parameters and values
 */

// echo '<p>sensor_id = '. $sensorId .' </p>';
/*
 * Call the main class for authorizing and analyse
 */

// echo '<h3>com_homectrl_cli.php</h3>';

// $mainClassObj = JApplicationCli::getInstance('homeInfoHelperMain');
$ajaxClassObj = new HomeInfoHelperAjaxServer();
$ajaxClassObj->getSensorList();

?>