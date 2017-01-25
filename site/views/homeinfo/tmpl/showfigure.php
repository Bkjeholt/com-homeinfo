<?php
/************************************************************************
 Product    : Home info
 Date       : 2012-09-18
 Copyright  : Copyright (C) 2012 Kjeholt Engineering. All rights reserved.
 Contact    : dev@kjeholt.se
 Url        : http://dev.kjeholt.se
 Licence    : ---
 ---------------------------------------------------------
 File       : site/views/homeinfo/tmpl/default.php
 Version    : 0.2.1
 Author     : Bjorn Kjeholt
 *************************************************************************/
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<h1>Home information overview</h1>
<?php 
if ($this->svgArray != false) {
?>
<h2><?php echo $this->svgArray['name']; ?></h2>

<?php 
	echo $this->svgArray['xml_svg']->asXML();
}
?>
