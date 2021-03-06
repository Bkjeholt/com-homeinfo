<?php
/************************************************************************
Product    : Home info
Date       : 2012-10-17
Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
Contact    : dev@kjeholt.se
Url        : http://dev.kjeholt.se
Licence    : ---
---------------------------------------------------------
File       : site/views/showtempgraph/tmpl/default.php
Version    : 0.3.4
Author     : Bjorn Kjeholt
*************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<h1>Home information overview</h1>
<?php 
if ($this->xmlSvgInfo != false) {
?>
<h2><?php echo 'Temperature statistics'; ?></h2>
<div>
<?php 
	foreach ($this->xmlSvgInfo->svg as $xmlSvg) {
		echo $xmlSvg->asXML();
	}
}
?>
</div>