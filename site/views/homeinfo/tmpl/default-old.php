<?php
/************************************************************************
Product    : Home info
Date       : 16 aug 2012
Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/views/homeinfo/tmpl/default.php
Version    : 0.0.1
Author     : Bjšrn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$xmlInfo = $this->item;

?>
<h1>Home information overview</h1>
<table>
  <tr>
    <th>Sensor Name</th>
    <th>Sensor Info</th>
    <th>Connected device information</th>
  </tr>
<?php 
	$xmlSensorArray = $this->item->xpath("//sensor");
	foreach ($xmlSensorArray as $xmlSensor) {
?>
  <tr>
    <td><?php echo $xmlSensor['name']; ?></td>
    <td><?php echo $xmlSensor['id']; ?></td>
    <td>
		<table>
    		<tr>
    			<th>Device name</th>
    			<th>Since</th>
    			<th>Until</th>
    		</tr>
<?php 
		$xmlAllocArray = $this->item->xpath('//alloc[@sensorid="' . $xmlSensor['id'] . '"]/parent::*');
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
				$deviceSubId = $xmlAllocParent['id'];
				$validSince = $xmlAllocParent['since'];
				$validUntil = $xmlAllocParent['until'];
				;
				$xmlAllocDevArray = $xmlAllocParent->xpath('parent::*');
				$xmlAllocDev = $xmlAllocDevArray[0];
				$deviceName = $xmlAllocDev['name'] . ':' . $deviceSubId;
			}
?>
			<tr>
				<td><?php echo $deviceName;?></td>
				<td><?php echo $validSince;?></td>
				<td><?php echo $validUntil;?></td>
			</tr>
<?php 
		}
?>		
		</table>
<?php 
	}
?>
</table>

<code>
	<?php echo htmlspecialchars($this->item->asXML()); ?>
</code>
