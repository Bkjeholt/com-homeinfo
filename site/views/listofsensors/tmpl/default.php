<?php
/************************************************************************
Product    : Home info
Date       : 2012-10-23
Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/views/listofsensors/tmpl/default.php
Version    : 0.3.6
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/*
 * Add JavaScript for updating of sensor info
 */

$document->addScriptDeclaration('
		function updSensorInfo(sensor_id) {
			alert(sensor_id);
		};
	');

?>
<h1>Home information overview</h1>

<?php 
$listOfXmlGroups = $this->xmlSensorInfo->xpath('//group');

foreach ($listOfXmlGroups as $xmlGroup) {
?>
<h2>Sensor group: <?php echo $xmlGroup['name'] . ' (Sensor id: ' . $xmlGroup['id'] . ')'; ?></h2>
<table>
	<thead>
		<tr>
    		<th>Sensor Id</th>
			<th>Sensor Name</th>
			<th>Latest data</th>
			<th>Additional info</th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="4" align="center">
			---
			</td>
		</tr>
	</tfoot>
	<tbody><?php 
	foreach ($xmlGroup->sensor as $xmlSensor) {
?>
		<tr onclick="updSensorInfo(<?php echo $xmlSensor['id']; ?>);">
			<td><?php echo $xmlSensor['id'];?></td>
			<td><?php echo $xmlSensor['name'];?></td>
			<td><?php if (($listOfSensorData = $xmlSensor->xpath('data')) !== false) { 
							$xmlData=$listOfSensorData[0]; 
							echo (string) $xmlData;
						} else {
							echo 'N/A';
						} ?></td>
			<td>TBD</td>
					</tr>
<?php 
		;
	}
	?>
	</tbody>
</table>
<?php
} 
?>

<div id="com_homeinfo_upd_sensor_info"/>
<?php 
