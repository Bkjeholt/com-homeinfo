<?php
/************************************************************************
Product    : Home info
Date       : 2013-02-01
Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/views/adminsensors/tmpl/default.php
Version    : 0.5.6
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<h1>Home information sensor administration</h1>
<h2>List of defined sensors</h2>
<?php
foreach ($this->xmlView->sensors as $xmlViewSensors) {
?>
<table width="100%">
	<tr>
    	<th>Sensor Id</th>
		<th>Sensor Name</th>
		<th>Sensor Data</th>
		<th>Connected device information</th>
	</tr>
<?php 
	foreach ($xmlViewSensors->sensor as $xmlViewSensor) {
?>
	<tr>
		<td><?php echo $xmlViewSensor['id']; ?></td>
		<td><?php echo $xmlViewSensor['name']; ?></td>
		<td><?php echo $xmlViewSensor['data'] . $xmlViewSensor['unitname']; ?></td>
		<td>
<?php 
		if ($xmlViewSensor->device != null) {
?>
			<table width="100%">
				<tr>
	    			<th>Device id</th>
					<th>Device name</th>
    				<th>Since</th>
    				<th>Until</th>
    			</tr>
				
<?php 
						
			foreach ($xmlViewSensor->device as $xmlViewDevice) {
?> 
				<tr>
					<td><?php echo $xmlViewDevice['id']; ?></td>
					<td><?php echo $xmlViewDevice['name']; ?></td>
					<td><?php echo $xmlViewDevice['since']; ?></td>
					<td><?php echo $xmlViewDevice['until']; ?></td>
				</tr>
<?php 
			}
?> 
			</table>
<?php 
		}
?>
		</td>
	</tr>		
<?php 		
	}
?>
</table>
<?php 	
}
?>
<h2>Devices</h2>
<?php 
if (($xmlSources = $this->xmlInternalInfo->xpath("//sources/source")) != false) {
?>
<table width="100%">
	<tr>
		<th valign="top">Id</th>
		<th valign="top">Source name</th>
		<th valign="top">Source key</th>
	</tr>
<?php 
	foreach ($xmlSources as $xmlSource) {
?>
  	<tr>
    	<td rowspan="2" valign="top"><?php echo $xmlSource['id']; ?></td>
    	<td valign="top"><?php echo $xmlSource['name']; ?></td>
	   	<td valign="top"><?php echo $xmlSource['key']; ?></td>
  	</tr>
  	<tr>
  		<td colspan="2">
  			<table>
  				<tr>
  					<th colspan="3" valign="top">List of devices related to this source</th>
  				</tr>
  				<tr>
  					<th valign="top">id</th>
  					<th valign="top">name</th>
  					<th valign="top">type</th>
  				</tr>
<?php 
		foreach ($xmlSource->device as $xmlDevice) {
?>
				<tr>
					<td valign="top"><?php echo $xmlDevice['id']; ?></td>
					<td valign="top"><?php echo $xmlDevice['name']; ?></td>
					<td valign="top"><?php echo $xmlDevice['det']; ?></td>
				</tr>
<?php 
		}
?>
  			</table>
  		</td>
  		
  	</tr>
<?php
	}
?>
</table>
<?php 
	;
}
?>
