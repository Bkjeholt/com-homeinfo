<?php
/************************************************************************
Product    : Home info
Date       : 2013-04-26
Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/views/homeinfo/tmpl/default.php
Version    : 0.6.2
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$document = JFactory::getDocument();
/*

$document->addScriptDeclaration('
 		window.addEvent("domready", 
						function() {
								var sensorObject = new Sensors();
 								sensorObject.getList("com_homeinfo_sensor_list","/cli/com_homeinfo/ajax_sensors.php");
 						} );
 		');
*/
$document->addScriptDeclaration('
		window.addEvent("domready",
						function() {
							getSensorList("com_homeinfo_sensor_list",
							              "http://dev.kjeholt.se/index.php?format=raw&option=com_homeinfo&task=get_sensor_list");
						});');
?>
<h1>Home information overview</h1>
<h2>Sensor list</h2>
<div id="com_homeinfo_sensor_list"></div>
<h2>Device list</h2>
<div id="com_homeinfo_device_list"></div>

<?php 
