<?php
/************************************************************************
Product    : Home info
Date       : 2013-01-21
Copyright  : Copyright (C) 2013 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/views/showerrors/tmpl/default.php
Version    : 0.5.3
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<h1>List of errors</h1>
<table width="100%">
	<tr>
    	<th rowspan="3">Time</th>
    	<th colspan="4">Description</th>
    </tr>
    <tr>
		<th>Error code</th>
		<th>Severity</th>
		<th>type</th>
		<th>Id</th>
		</tr>
	<tr>	
		<th colspan="4">Suplementary info</th>
	</tr>
<?php
foreach ($this->xmlErrors->error as $xmlError) {
?>
	<tr>
		<td rowspan="3"><?php echo $xmlError['time']; ?></td>
		<td colspan="4"><?php echo $xmlError['desc']; ?></td>
	</tr>
	<tr>
		<td><?php echo $xmlError['code'];?></td>
		<td><?php echo $xmlError['sev'];?></td>
		<td><?php echo $xmlError['type'];?></td>
		<td><?php echo $xmlError['id'];?></td>
	</tr>
	<tr>
		<td colspan="4">
			<table>
				<tr>
					<th>Parameter</th>
					<th></th>
					<th>Value</th>
				</tr>
<?php 	
	foreach ($xmlError->info as $xmlErrorInfo) {
?>
				<tr>
					<td><?php echo $xmlErrorInfo['param']; ?></td>
					<td><?php echo "=>"; ?></td>
					<td><?php echo $xmlErrorInfo; ?></td>
				</tr>
<?php 
		;
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
?>