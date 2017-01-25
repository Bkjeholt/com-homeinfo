<?php
/************************************************************************
Product    : Home info
Date       : 2012-11-02
Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/views/homeinfo/tmpl/default.php
Version    : 0.3.7
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidation');
JHtml::_('behavior.tooltip');

// get the menu parameters for use
$menuparams = $this->state->get("menuparams");
$headingtxtcolor = $menuparams->get("headingtxtcolor");
$headingbgcolor = $menuparams->get("headingbgcolor");

?>
<h1>COM_HOMEINFO_VIEW_ADDSENSOR_DEFAULT_HEADING_1</h1>
	<form action="<?php echo JRoute::_('index.php'); ?>" method="post" id="addsensor" name="addsensor">
	</form>
		<table>
		<thead>
			<tr>
				<th>id</th>
				<th>Sensor name</th>
				<th>Sensor type</th>
			</tr>
		</thead>
</table>

    <form class="form-validate" action="<?php echo JRoute::_('index.php'); ?>" method="post" id="addsensor" name="addsensor">
		<fieldset>
        	<dl>
          	    <dt><?php echo $this->form->getLabel('id'); ?></dt>
             	<dd><?php echo $this->form->getInput('id'); ?></dd>
                <dt></dt><dd></dd>
        	    <dt><?php echo $this->form->getLabel('greeting'); ?></dt>
        	    <dd><?php echo $this->form->getInput('greeting'); ?></dd>
                <dt></dt><dd></dd>
                <dt></dt>
            	<dd><input type="hidden" name="option" value="com_helloworld" />
            	    <input type="hidden" name="task" value="updhelloworld.submit" />
                </dd>
                <dt></dt>
                <dd><button type="submit" class="button"><?php echo JText::_('Submit'); ?></button>
			                <?php echo JHtml::_('form.token'); ?>
                </dd>
        	</dl>
        </fieldset>
    </form>
    <div class="clr"></div>
