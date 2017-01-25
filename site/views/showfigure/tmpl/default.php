<?php
/************************************************************************
Product    : Home info
Date       : 2012-09-18
Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/views/showfigure/tmpl/default.php
Version    : 0.2.1
Author     : Bjšrn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<h1>Home information overview</h1>
<?php
foreach ($this->xmlView->sensors as $xmlViewSensors) {
?>
<table width="100%">
	<tr>
    	<th>Sensor Id</th>
		<th>Sensor Name</th>
		<th>Sensor Info</th>
		<th>Connected device information</th>
	</tr>
<?php 
	foreach ($xmlViewSensors->sensor as $xmlViewSensor) {
?>
	<tr>
		<td><?php echo $xmlViewSensor['id']; ?></td>
		<td><?php echo $xmlViewSensor['name']; ?></td>
		<td><?php echo $xmlViewSensor['type']; ?></td>
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

<h2>xml view info</h2>
<code><?php echo htmlspecialchars($this->xmlView->asXML()); ?></code>
<h2>xml internal info</h2>
<code><?php echo htmlspecialchars($this->xmlInternalInfo->asXML()); ?></code>

<h2>Vedeldningskretsen</h2>
<?php 
	$fp=&fopen('http://dev.kjeholt.se/media/media/images/vedeldningskretsen.svg','r');
	while (($buffer = fgets($fp, 4096)) !== false) {
		echo $buffer;
	}
	if (!feof($fp)) {
		echo "Error: unexpected fgets() fail\n";
	}

?>
<h2>svg picture</h2>
<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
	<g id="vedeldning">
		<rect id="Ackutank"
			  x="20" 
			  y="20" 
			  width="60" 
			  height="120"
			  style="fill:rgb(0,0,128);stroke-width:1;stroke:rgb(0,0,0)"/>
		<rect id="Vedpanna"
			  x="280"
			  y="20" 
			  width="60" 
			  height="120"
			  style="fill:rgb(0,0,128);stroke-width:1;stroke:rgb(0,0,0)"/>
		<circle id="Laddomat"
			    cx="180" 
				cy="120" 
				r="10" 
				stroke="red"
				stroke-width="1" 
				fill="red"/>		  
		<line id="Returledning_Ackutank"
			  x1="80" y1="40" 
			  x2="280" y2="40"
			  style="stroke:rgb(255,0,0);stroke-width:2"/>
		<line id="Framledning_Oblandad"
			  x1="80" y1="120" 
			  x2="170" y2="120"
			  style="stroke:rgb(255,0,0);stroke-width:2"/>
		<line id="Framledning_Blandad"
			  x1="190" y1="120" 
			  x2="280" y2="120"
			  style="stroke:rgb(255,0,0);stroke-width:2"/>
		<line id="Returledning_Laddomat"
			  x1="180" y1="40" 
			  x2="180" y2="110"
			  style="stroke:rgb(255,0,0);stroke-width:2"/>
	</g>
</svg>
