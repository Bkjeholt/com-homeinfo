<?php
/************************************************************************
Product    : Home info
Date       : 2012-09-18
Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/views/homeinfo/tmpl/listsensors.php
Version    : 0.2.1
Author     : Bj�rn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
JHTML::_('script','system/multiselect.js',false,true);
$user	= JFactory::getUser();
$userId	= $user->get('id');
$listOrder	= $this->state->get('list.ordering');
$listDirn	= $this->state->get('list.direction');
$saveOrder	= $listOrder == 'a.ordering';

$canOrder	= $user->authorise('core.edit.state', 'com_homectrl');
$canCreate	= $user->authorise('core.create',		'com_homectrl');
$canEdit	= $user->authorise('core.edit',			'com_homectrl');
$canCheckin	= $user->authorise('core.manage',		'com_homectrl');
$canChange	= $user->authorise('core.edit.state',	'com_homectrl');

?>
<h1>COM_HOMEINFO_HOMEINFO_VIEW_LIST_SENSORS_H1_TITLE</h1>
<h2>COM_HOMEINFO_HOMEINFO_VIEW_LIST_SENSORS_H2_SENSOR_TITLE</h2>
<?php 
foreach ($this->xmlView->sensors as $xmlViewSensors) {
?>
<table width="100%">
	<thead>
		<tr>
    		<th>Sensor Id</th>
			<th>Sensor Name</th>
			<th>Sensor Type</th>
			<th>Sensor Info</th>
		</tr>
	</thead>
	<tbody>
<?php 
	foreach ($xmlViewSensors->sensor as $xmlViewSensor) {
?>
	<tr>
		<td><?php echo $xmlViewSensor['id']; ?></td>
		<td><?php echo $xmlViewSensor['name']; ?></td>
		<td><?php echo $xmlViewSensor['type']; ?></td>
	</tr>		
<?php 		
	}
?>
	</tbody>
</table>
<?php 
}

if ($canCreate) {
?>
<h2>COM_HOMEINFO_HOMEINFO_VIEW_ADD_SENSOR</h2>
<form action="<?php echo JRoute::_('index.php?option=com_homeinfo&layout=listsensors&id='.(int) $this->item->id); ?>" 
	  method="post" 
	  name="addSensorForm" 
	  id="homeinfo-addsensor-form" 
	  class="form-validate">
<?php echo $this->getToolbar(); ?>
 	 
	<div>
		<input type="hidden" name="task" value="homeinfo.listsensors" />
        <input type = "hidden" name = "option" value = "com_homeinfo" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>

<?php 
}
?>